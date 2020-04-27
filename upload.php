<?php
require("./etc/file_dispatcher/config.php");
require("./etc/sql.php");
require("./modules/file_dispatcher/sql/db_dispatcher.php");
require('./modules/file_dispatcher/main.php');?>

<?php
	session_start();
	echo 'POST'.$_POST["article"].$_SESSION["path"];
	$z = new dispatcher("./data",str_replace("/write/","",$_SERVER['REQUEST_URI']),'r',1);
	if( $z->get_h_code() != "NOT_FOUND" )	//UPDATE
		$z = new dispatcher("./data",$_SESSION["path"],'c',1);
	else	//CREATE
		$z = new dispatcher("./data",$_SESSION["path"],'c',1);
	$z->new_version();
	$z->save_in_file($_POST['article']);
	header("Location: "."/lecture/".$_SESSION["path"]);
?>
