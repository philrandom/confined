<?php
require("./etc/file_dispatcher/config.php");
require("./etc/sql.php");
require("./modules/file_dispatcher/sql/db_dispatcher.php");
require('./modules/file_dispatcher/main.php');?>

<?php
	session_start();
	// echo 'POST'.$_POST["article"].$_SESSION["path"];
	$z = new dispatcher("./data",$_SESSION["path"],'r',1);
	// echo $z->get_h_code();
	if( $z->get_h_code() != "NOT_FOUND" ){	//UPDATE
		if($_SESSION['write_right'] == 'yes')
		{
			$z->new_version();
			$z = new dispatcher("./data",$_SESSION["path"],'u',1);
		}
		else
		{
			$z = new dispatcher("./data/staged_commits",$_SESSION["path"],'c',1);
			$z = new dispatcher("./data/staged_commits",$_SESSION["path"],'u',1);	
			$z->save_in_file($_POST['article']);
		}
		// echo $_SESSION["path"]." - 'u',1";

	}
	else {	//CREATE
		$z = new dispatcher("./data",$_SESSION["path"],'c',1);

		// echo $_SESSION["path"]." - 'c',1";
		// echo $z->getError();
	}


	// echo "<br><br>FILES : ";	
	// print_r($_FILES);
	// echo "<br>finfiles<br>";
	$z->create_attach($_FILES['fileToUpload']);

	// echo '<br>'.$z->get_h_code();
	header("Location: "."/lecture/".$_SESSION["path"]);
?>
