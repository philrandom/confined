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
		$cnnx = new db_dispatcher();
		$z = new dispatcher("./data",$_SESSION["path"],'c',$cnnx->get_userid($_SESSION['user']));

		echo $_SESSION["path"]." - 'c',1";
		echo $z->getError();
	}
	$a = $z->get_version();
	$z->new_version();
	$z->save_in_file($_POST['article']);
	$z->set_version($a);
	
	echo "<br><br>FILES : ";	
	print_r($_FILES);
	echo "<br>finfiles<br>";
	$z->create_attach($_FILES['fileToUpload']);

	echo '<br>H8CODE'.$z->get_h_code()." saved in:";
	print_r($z->get_tree());
	header("Location: "."/lecture/".$_SESSION["path"]);
?>
