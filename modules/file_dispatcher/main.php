<?php
error_reporting(E_ALL);
include './config.php';

class Dispatcher
{

		protected $tree;
		protected $h_code

    function __construct($link, $type)
    {
				if($type == 'path'){
					$h_code = search_by_path($link);
				}
				if($type == 'hashcode'){
					$tree = search_by_hash($link);
				}
				if( $type != 'path' & $type != 'hashcode') return "[ERROR] in \$type parameter"
    }






}
?>

<?php
	$a = new Dispatcher('098f6bcd4621d373cade4e832627b4f6','hashcode');

 ?>
