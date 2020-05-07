<?php
require("./etc/file_dispatcher/config.php");
require("./etc/sql.php");
require("./modules/file_dispatcher/sql/db_dispatcher.php");
require('./modules/file_dispatcher/main.php');?>

<?php
	session_start();
	echo 'POST'.$_POST["article"].$_SESSION["path"];
	$z = new dispatcher("./data",$_SESSION["path"],'r',1);
	echo '<br>lecture mode get this code:'.$z->get_h_code().'<br>';
	if( $z->get_h_code() != "NOT_FOUND" ){	//UPDATE
		$z = new dispatcher("./data",$_SESSION["path"],'u',1);
		echo $_SESSION["path"]." - 'u',1";
		echo $z->getError();

	}
	else {	//CREATE
		echo "<script>alert('vous n avez pas les droits');<script>";	
	}
	$a = $z->get_version();
	$z->new_version();
	$z->save_in_file($_POST['article']);
	$z->set_version($a);
	header("Location: "."/lecture/".$_SESSION["path"]);
?>
