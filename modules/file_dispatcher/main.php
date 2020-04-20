<?php
require("config.php");
require("sql/db_dispatcher.php");
class dispatcher
{

		protected $tree;
		protected $h_code;
		protected $v;
		private $right;

		private $error;

		/*
		$link 	enter your hash or path;
		$right choose between
						r : read
						u : update
						c : create
		*/
    function __construct($link,$right,$author=-1)
    {
			if(preg_match_all('/[rcu]/',$right)!=strlen($right) & ( preg_match_all('/[ru]/',$right)!=0 ^ preg_match_all('/c/',$right)!=0 ))
			{
				$this->error[] = "[file_dispatcher:__construct()] $right isn't correct";
				return -1;
			}
				echo "[ok]construct<br>";
			if(preg_match_all('/[^c]/', $right)){
				//--------READING or UPDATE
				echo "reading...<br>";
				if($this->is_hash($link)){	//is a HASH
					echo "[ok] hash<br>";
					$this->h_code = $link;
					$cnnx = new db_dispatcher();
					$this->tree = $cnnx->search_by_hash($this->h_code);
					print_r($this->tree);
					$this->v = $cnnx->get_version($this->h_code);
					$cnnx->kill();

				}else if($this->is_path($link)){
					echo "this is a path";
					$this->tree = explode("/",$link);
					unset($this->tree[sizeof($this->tree)-1]);
					print_r($this->tree);
					$cnnx = new db_dispatcher();
					$this->h_code = $cnnx->search_by_path($this->tree);
					if( $this->h_code == 'NOT_FOUND' )
						$this->error[] = "[file_dispatcher:__construct():is_path() reading] $link NOT_FOUND";
					echo $this->h_code;
					$this->v = $cnnx->get_version($this->h_code);
					$cnnx->kill();

				}else {
					$this->error[] = "[file_dispatcher:__construct()] $link isn't hash nor path";
					return -1;
				}
			} else if(preg_match_all('/[^ru]/', $right)!=0){
				echo "<br>[construct] creation...";
				//---------CREATION
				if($this->is_path($link)){
					//needed information are author date;
					echo "<br>[construct creation] enter...";
					if( $author==-1 ) {
						$this->error[] = "[file_dispatcher:__construct():is_path() creation] specify author";
						return -1;
					}
					
					$cnnx = new db_dispatcher();
					$this->tree = explode("/",$link);
					unset($this->tree[sizeof($this->tree)-1]);
					print_r($this->tree);
					
					//verify is file exist
					$this->h_code = $cnnx->search_by_path($this->tree);
					if( $this->h_code != 'NOT_FOUND' ) {
						$this->error[] = "[file_dispatcher:__construct():is_path() creation] $link allready EXIST";
						return -1;
					}
					echo "[contruct creation] path is free";
					//create file
					$cnnx = new db_dispatcher();
					$hash = const_dispatcher::hash;
					$cnnx->create_file($hash($link.$author),$link,$author);
					$this->$h_code = $cnnx->create_path($this->tree);
					$cnnx->kill();
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

}
?>
