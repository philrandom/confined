<?php
require("./etc/file_dispatcher/config.php");
require("./etc/sql.php");
require("./modules/file_dispatcher/sql/db_dispatcher.php");
require('./modules/file_dispatcher/main.php');?>

<?php
	session_start();
	//echo 'POST'.$_POST["article"].$_SESSION["path"];
	$z = new dispatcher("./data",$_SESSION["path"],'c',1);
	$z->new_version();
	$z->save_in_file($_POST['article']);
	//echo $z->read_from_file();
	header("Location: "."/lecture/".$_SESSION["path"]);
?>
