<?php
require("config.php");
require("sql/db_dispatcher.php");
class dispatcher
{

		protected $tree;
		protected $h_code;



    function __construct($link)
    {
				echo "[ok]construct<br>";

				if($this->is_hash($link)){	//is a HASH
					$this->h_code = $link;
					echo $this->h_code." is hash";
					echo "<br>connexion is init<br>";
					$cnnx = new db_dispatcher();
					$this->tree = $cnnx->search_by_hash($this->h_code);
					print_r($this->tree);
					$cnnx->kill();

				}
				/*if($this->is_path($link)){
					/*$cnnx = new db_dispatcher();
					$this->$h_code = $cnnx->search_by_path($link,$tree_structure);
					$cnnx->kill();*/
				//}


				//if( $type != 'path' & $type != 'hashcode') return "[ERROR] in \$type parameter";
    }



		function is_hash($possible_hash){
			$hash = const_dispatcher::hash;
			return ( strlen($hash("test"))==preg_match_all('/[a-f0-9]/', $possible_hash) ) & ( strlen($hash("test"))==strlen($possible_hash) ) ;
		}


}
?>
