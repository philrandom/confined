<?php
require('config.php');

class dispatcher
{

		protected $tree;
		protected $h_code;

    function __construct()
    {
				echo "ok";
			/*	if($type == 'path'){
					$h_code = search_by_path($link,$tree_structure);
				}
				if($type == 'hashcode'){
					$this->$tree = search_by_hash($link,$tree_structure);
				}*/
				//if( $type != 'path' & $type != 'hashcode') return "[ERROR] in \$type parameter";
    }

		function hello()
		{
				echo "hloo";

		}

}
?>
