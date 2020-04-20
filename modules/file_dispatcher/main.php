<?php
require('config.php');

class dispatcher
{

		public $tree;
		public $h_code;

    function __construct($link, $type)
    {
				echo "ok";
				/*if($type == 'path'){
					$h_code = search_by_path($link,$tree_structure);
				}*/
				if($type == 'hashcode'){
					if(!$this->is_hash($link))		return "[ERROR] not a hash";
					$cnnx = new connection();
					$this->$tree = $cnnx->search_by_hash($link,$tree_structure);
					$cnnx->kill();
				}
				if( $type != 'path' & $type != 'hashcode') return "[ERROR] in \$type parameter";
    }

		function hello()
		{
				echo "hloo";

		}

		function is_hash($possible_hash){
			if(sizeof($hash("test"))!=sizeof($possible_hash))		return false;


		}


}

echo(strlen($hash("test")));
echo "<br>".$hash("test");
?>
