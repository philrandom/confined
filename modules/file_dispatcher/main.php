<?php
/*---REQUIRED FILES
config files in :
/etc/file_dispatcher/config.php
/etc/sql.php

and the sql motor dispatcher :
./sql/db_dispatcher.php
*/
class dispatcher
{

		protected $tree;		//path to the current file
		protected $h_code;		//hash of the current file
		protected $v;			//version
		protected $backup;
		private $right;

		private $error;			//array of errors

		/*
		$backup 	hard link in server where to backup
		$link 		enter your hash or path;
		$right 		choose between
						r : read
						u : update
						c : create
		*/
		function __construct($backup, $link,$right,$author=-1)
		{
				$this->backup=$backup;
				$this->right=$right;
				//verify if $right is correct
				if(preg_match_all('/[rcu]/',$right)!=strlen($right) & ( preg_match_all('/[ru]/',$right)!=0 ^ preg_match_all('/c/',$right)!=0 )){
					$this->error[] = "[file_dispatcher:__construct()] $right isn't correct";
					return -1;
				}

				if(preg_match_all('/[^c]/', $right)){
					//---READ or UPDATE
		
					if($this->is_hash($link)){	//is a HASH
						$this->h_code = $link;
						$cnnx = new db_dispatcher();
						$this->tree = $cnnx->search_by_hash($this->h_code);
						$this->v = $cnnx->get_version($this->h_code);
						$cnnx->kill();

					}else if($this->is_path($link)){
						$this->tree = explode("/",$link);
						unset($this->tree[sizeof($this->tree)-1]);

						$cnnx = new db_dispatcher();
						//echo "CONSTRUCT SEARCHBYPATHREFILTERED";
						//print_r($this->tree);
						$this->h_code = $cnnx->search_by_path_refiltered($this->tree);
						if( $this->h_code == 'NOT_FOUND' )
							$this->error[] = "[file_dispatcher:__construct():is_path() reading] $link NOT_FOUND : h_code is NOT_FOUND";
						else if( $this->tree != $cnnx->search_by_hash($this->h_code) ) {
							$this->error[] = "[file_dispatcher:__construct():is_path() reading] $link NOT_FOUND : tree doesn't match";
							$this->h_code = 'NOT_FOUND';
						}

						$this->v = $cnnx->get_version($this->h_code);
						$cnnx->kill();

					}else {
						$this->error[] = "[file_dispatcher:__construct()] $link isn't hash nor path";
						return -1;
					}

				} else if(preg_match_all('/[^ru]/', $right)!=0){
					//---CREATION
					if($this->is_path($link)){
						//needed information are author date;
						
						if( $author==-1 ) {
							$this->error[] = "[file_dispatcher:__construct():is_path() creation] specify author";
							return -1;
						}
						
						$cnnx = new db_dispatcher();
						$this->tree = explode("/",$link);
						unset($this->tree[sizeof($this->tree)-1]);
						
						//verify if file exists
						$this->h_code = $cnnx->search_by_path_refiltered($this->tree);
						if( $this->h_code != 'NOT_FOUND' ) {
							$this->error[] = "[file_dispatcher:__construct():is_path() creation] $link allready EXIST. its h_code is : ".$this->h_code;
							print_r("formal tree : ");
							print_r($this->tree);
							return -1;
						}

						//create file
						$this->v = 0;
						$cnnx = new db_dispatcher();
						$hash = const_dispatcher::hash;
						$this->h_code = $hash($link.$author);
						$cnnx->create_file($this->h_code,$author);			//SQL TABLE file_ref
						$cnnx->create_path($this->h_code,$this->tree);		//SQL TABLE tag
						$cnnx->kill();
						if(!mkdir($this->backup.'/'.$this->h_code, 0777, true))
							$this->error[] = 'error while writing on disk. <u>tips</u> verify right';
						
					}else{
						$this->error[] = "[file_dispatcher:__construct()] $link isn't path; specify path for creation mode";
						return -1;
					}
				}
		}


/*----------------
SECTION is_
-----------------*/
		function is_path($possible_path){
			return preg_match_all('/[a-zA-Z0-9\ \/]/', $possible_path)==strlen($possible_path) & preg_match_all('/\//', $possible_path)!=0  &  $possible_path[strlen($possible_path)-1]=='/';
		}

		function is_hash($possible_hash){
			$hash = const_dispatcher::hash;
			return ( strlen($hash("test"))==preg_match_all('/[a-f0-9]/', $possible_hash) ) & ( strlen($hash("test"))==strlen($possible_hash) );
		}

/*-------------------------
SECTION FILESYSTEM
--------------------------*/
		function save_in_file($data){
			$data = str_replace("?","&#63;",$data); //to avoid malecious code <\?\php
			$this->get_version();
			if( preg_match_all('/c|u/',$this->right) == 0 ){
				$this->error[] = "[file_dispatcher:save_in_file] stream for ". $this->h_code ." doesn't have right for writing";
				return -1;
			}
			$fp = fopen($this->backup . '/' . $this->h_code . '/' . $this->v,"wb");
			fwrite($fp,$data);
			fclose($fp);
		}
		
		function read_from_file(){
			return stream_get_contents(fopen($this->backup . '/' . $this->h_code . '/' . $this->v , "rb"));
		}

		function read_from_file_by_version($v){
			return stream_get_contents(fopen($this->backup . '/' . $this->h_code . '/' . $v , "rb"));
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
/*---------------------------
SECTION attachement
---------------------------*/

		function create_attach($file) {

			if(! in_array(strtolower(pathinfo($file['name'],PATHINFO_EXTENSION)),const_dispatcher::authorized_ext)) {
				$this->error[] = "[file_dispatcher:create_attachement] extension is not valid";
				return -1;
			}

			//define path of location 
			if( const_dispatcher::separate_location == 'yes' ) {
				$final_place = $this->backup. '/' . const_dispatcher::name_dir_attachement;
				if (!file_exists($final_place))
					mkdir( $final_place, 0777);
				$final_place = $this->backup. '/' . const_dispatcher::name_dir_attachement . '/' . $this->h_code;

			}
			else {
				$final_place = $this->backup. '/' . $this->h_code . '/'  . const_dispatcher::name_dir_attachement;
			}
			//create directory
			if (!file_exists($final_place))
				mkdir( $final_place, 0777);

			if (file_exists($target_file)) {
				$this->error[] = "Sorry, file already exists.";
				return -1;
			}
			

			if (move_uploaded_file($file["tmp_name"], $final_place.'/'.$file["name"])) {
				echo "The file ". basename( $file["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
			return $final_place.'/'.$file["name"];
		}



/*---------------------------		
SECTION versionning
---------------------------*/
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


/*---------------------------
SECTION archive
-----------------------------*/
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
			$p->decompress(); 
			unlink($this->backup . '/' . $this->h_code . '/archive.tar.gz');
			// unarchive from the tar
			$phar = new PharData($this->backup . '/' . $this->h_code . '/archive.tar');
			$phar->extractTo($this->backup . '/' . $this->h_code . '/');
			
			unlink($this->backup . '/' . $this->h_code . '/archive.tar');
			echo '<br>[OK]uncompress';
		}


/*----------------------
SECTION getter
-----------------------*/

		function get_h_code(){
			return $this->h_code;
		}
		
		function get_tree(){
			return $this->tree;
		}
		
		function get_summary() {
			$cnnx = new db_dispatcher();
			$sum = $cnnx->summary($this->tree);
			$a = array();
			foreach( $sum as $point ) {
				$a[] = $cnnx->search_by_hash($point['h_code']);
			}
			$cnnx->kill();
			/*//----TEST
			$a = [["mammifere","rongeur","rat"],["mammifere","rongeur","octodon"], ["poisson","requin"]];
			$tab=array();
			$max_node_level = 3;
			for($l=0; $l<$max_node_level; $l++)
				$tab[$l] = $this->get_cat_by_level($a,$l);
			print_r($tab);	
			//----ENDTEST*/

			return $a;
		}
		function get_cat_by_level($a,$l) {
			$level=array();
			for($i=0; $i<sizeof($a); $i++) //branch
				if($l<sizeof($a[$i]) | $l==0)
					if(!in_array($a[$i][$l],array_keys($level)))
						$level = array_merge($level,[$a[$i][$l] => 0]);	
			return $level;
		}
		function getError(){
			print_r($this->error);
			return sizeof($this->error);
		}
/*----------------------
SECTION QCM
-----------------------*/
		/*
			add_row_qcm				will add a question in db.
									$qu		refere to question
									$A		answer A
									$B		answer B
									$C		answer C
									$D		answer D
									$V		refere to the only valid correct answere
											'A','B','C' or 'D'
		*/
		function add_row_qcm($qu,$A,$B,$C,$D,$V) {
			if($this->right == 'r' ) {
				$this->error[] = "[file_dispacther:add_row_question] You don't have rights to edit a qcm";
				return false;
			}
			if(!(preg_match_all('/[A-D]/',$V)==1 & strlen($V)==1  )) {
				$this->error[] = "[file_dispacther:add_row_question] The V parameters isn't correct";
				return false;
			}
			$cnnx = new db_dispatcher();
			$st = $cnnx->add_row_qcm_sql($this->h_code,$qu,$A,$B,$C,$D,$V);
			$cnnx->kill();
			return $st;
		}


		function get_all_row_qcm() {
			$cnnx = new db_dispatcher();
			$resultat = $cnnx->get_all_row_qcm_sql($this->h_code);
			$cnnx->kill();

			return $resultat;
		}


}
?>
