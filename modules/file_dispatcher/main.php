<?php
//require("../etc/file_dispatcher/config.php");
//require("sql/db_dispatcher.php");
class dispatcher
{

		protected $tree;
		protected $h_code;
		protected $v;
		protected $backup;
		private $right;

		private $error;

		/*
		$link 	enter your hash or path;
		$right choose between
						r : read
						u : update
						c : create
		*/
    function __construct($backup, $link,$right,$author=-1)
    {
    		$this->backup=$backup;
    		$this->right=$right;
			if(preg_match_all('/[rcu]/',$right)!=strlen($right) & ( preg_match_all('/[ru]/',$right)!=0 ^ preg_match_all('/c/',$right)!=0 ))
			{
				$this->error[] = "[file_dispatcher:__construct()] $right isn't correct";
				return -1;
			}
				//echo "[ok]construct<br>";
			if(preg_match_all('/[^c]/', $right)){
				//--------READING or UPDATE
				//echo "reading...<br>";
				if($this->is_hash($link)){	//is a HASH
					//echo "[ok] hash<br>";
					$this->h_code = $link;
					$cnnx = new db_dispatcher();
					$this->tree = $cnnx->search_by_hash($this->h_code);
					//print_r($this->tree);
					$this->v = $cnnx->get_version($this->h_code);
					$cnnx->kill();

				}else if($this->is_path($link)){
					//echo "this is a path";
					$this->tree = explode("/",$link);
					unset($this->tree[sizeof($this->tree)-1]);
					//print_r($this->tree);
					$cnnx = new db_dispatcher();
					$this->h_code = $cnnx->search_by_path($this->tree);
					if( $this->h_code == 'NOT_FOUND' )
						$this->error[] = "[file_dispatcher:__construct():is_path() reading] $link NOT_FOUND";
					else if( $this->tree != $cnnx->search_by_hash($this->h_code) ) {
						$this->error[] = "[file_dispatcher:__construct():is_path() reading] $link NOT_FOUND";
						$this->h_code = 'NOT_FOUND';
					}
					//echo $this->h_code;
					$this->v = $cnnx->get_version($this->h_code);
					$cnnx->kill();

				}else {
					$this->error[] = "[file_dispatcher:__construct()] $link isn't hash nor path";
					return -1;
				}
			} else if(preg_match_all('/[^ru]/', $right)!=0){
				//echo "<br>[construct] creation...";
				//---------CREATION
				if($this->is_path($link)){
					//needed information are author date;
					//echo "<br>[construct creation] enter...<br>";
					
					if( $author==-1 ) {
						$this->error[] = "[file_dispatcher:__construct():is_path() creation] specify author";
						return -1;
					}
					
					$cnnx = new db_dispatcher();
					$this->tree = explode("/",$link);
					unset($this->tree[sizeof($this->tree)-1]);
					//print_r($this->tree);
					
					//verify is file exist
					$this->h_code = $cnnx->search_by_path($this->tree);
					if( $this->h_code != 'NOT_FOUND' ) {
						$this->error[] = "[file_dispatcher:__construct():is_path() creation] $link allready EXIST";
						return -1;
					}
					$this->v = 0;
					//echo "[contruct creation] path is free";
					//create file
					$cnnx = new db_dispatcher();
					$hash = const_dispatcher::hash;
					$this->h_code = $hash($link.$author);
					$cnnx->create_file($this->h_code,$author);
					$cnnx->create_path($this->h_code,$this->tree);
					$cnnx->kill();
					//echo $this->backup.'/'.$this->h_code;
					if(!mkdir($this->backup.'/'.$this->h_code, 0777, true))
						$this->error[] = 'error will writing on disk. <u>tips</u> verify right';
					
				}else {
					$this->error[] = "[file_dispatcher:__construct()] $link isn't path; specify path for creation mode";
					return -1;
				}
			}
    }

		function is_path($possible_path){
			return preg_match_all('/[a-zA-Z0-9\ \/]/', $possible_path)==strlen($possible_path) & preg_match_all('/\//', $possible_path)!=0  &  $possible_path[strlen($possible_path)-1]=='/';
		}

		function is_hash($possible_hash){
			$hash = const_dispatcher::hash;
			return ( strlen($hash("test"))==preg_match_all('/[a-f0-9]/', $possible_hash) ) & ( strlen($hash("test"))==strlen($possible_hash) );
		}

		function getError(){
			print_r($this->error);
			return sizeof($this->error);
		}
		
		function save_in_file($data){
			$this->get_version();
			if( preg_match_all('/c|u/',$this->right) == 0 ){
				$this->error[] = "[file_dispatcher:save_in_file] stream for ". $this->h_code ." doesn't have right for writing";
				return -1;
			}
			//echo $this->backup . '/' . $this->h_code . '/' . $this->v;
			$fp = fopen($this->backup . '/' . $this->h_code . '/' . $this->v,"wb");
			fwrite($fp,$data);
			fclose($fp);
		}
		
		function read_from_file(){
			return stream_get_contents(fopen($this->backup . '/' . $this->h_code . '/' . $this->v , "rb"));
		}
		
		function rm(){
			$cnnx = new db_dispatcher();
			$cnnx->rm($this->h_code);
			$cnnx->kill();

			$files = scandir($this->backup . '/' . $this->h_code.'/');
		 	unset($files[0]);unset($files[1]);
		
			foreach($files as $file) 
				unlink($this->backup . '/' . $this->h_code.'/'.$file);
			rmdir($this->backup . '/' . $this->h_code);
		}
		
		
		function new_version(){
			$this->get_last_version();
			$this->set_version($this->v+1);
		}
		
		function set_version($v){
			echo 'set_version';
			$this->v=$v;
			$cnnx = new db_dispatcher();
			$cnnx->update_current_version($this->h_code,$this->v);
			$cnnx->kill();
			if(const_dispatcher::rm_old_versions == 'no' & const_dispatcher::compression_type!=Phar::NONE){
				if($this->v - const_dispatcher::max_version == 1 ){
					echo '=1  run compres';
					$this->archive_compress();
				}
				if($this->v - const_dispatcher::max_version > 1) {
					echo '>1  run uncompress -> compres';
					$this->archive_uncompress();
					echo '<script>alert(\'...\')</script>';
					$this->archive_compress();
				}
			} else if(const_dispatcher::rm_old_versions == 'yes'){
				for ($i = 0; $i <= $this->v - const_dispatcher::max_version ; $i++) {
					unlink($this->backup . '/' . $this->h_code . '/' . $i);
				}
			}
		}
		
		function get_version(){
			$cnnx = new db_dispatcher();
			$this->v = $cnnx->get_version($this->h_code);
			$cnnx->kill();
			return $this->v;
		}

		function get_last_version(){
			$cnnx = new db_dispatcher();
			$this->v = $cnnx->get_last_version($this->h_code);
			$cnnx->kill();
			return $this->v;
		}

		function archive_compress(){
			try{
				echo '<br>[...]compress';
				$a = new PharData($this->backup . '/' . $this->h_code . '/archive.tar');
				echo '<br>construct';
				// ADD FILES TO archive.tar FILE
				for ($i = 0; $i <= $this->v - const_dispatcher::max_version ; $i++){
					$a->addFile($this->backup . '/' . $this->h_code . '/' . $i,$i);
					unlink($this->backup . '/' . $this->h_code . '/' . $i);
					echo '<br>addfile'.$i;
				}
				// COMPRESS archive.tar FILE. COMPRESSED FILE WILL BE archive.tar.gz
				///$a->compress(const_dispatcher::compression_type);
				$a->compress(const_dispatcher::compression_type);
				echo '<br>compressing';
				// NOTE THAT BOTH FILES WILL EXISTS. SO IF YOU WANT YOU CAN UNLINK archive.tar
				unlink($this->backup . '/' . $this->h_code . '/archive.tar');
				echo '<br>unlink tar';
				echo '<br>[OK]compress';
			} catch (Exception $e)
			{
				echo '<br>[FAIL]compress';
				echo "Exception : " . $e;
			}
		}
		
		function archive_uncompress(){
			echo '<br>[...]uncompress';
			// decompress from gz
			$p = new PharData($this->backup . '/' . $this->h_code . '/archive.tar.gz');
			$p->decompress(); // creates /path/to/my.tar
			unlink($this->backup . '/' . $this->h_code . '/archive.tar.gz');
			// unarchive from the tar
			$phar = new PharData($this->backup . '/' . $this->h_code . '/archive.tar');
			$phar->extractTo($this->backup . '/' . $this->h_code . '/');
			
			unlink($this->backup . '/' . $this->h_code . '/archive.tar');
			echo '<br>[OK]uncompress';
		}
/*
	GETTER
*/
		function get_h_code(){
			return $this->h_code;
		}
		
		function get_tree(){
			return $this->tree;
		}
}
?>
