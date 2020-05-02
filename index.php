<?php
	//display errors
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);

	require("./etc/file_dispatcher/config.php");
	require("./etc/sql.php");
	require("./modules/file_dispatcher/sql/db_dispatcher.php");
	require('./modules/file_dispatcher/main.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Confined</title>
	<link rel="favicon" type="image/x-icon" href="/favicon.ico">
</head>

<html>

	<?php

		//on récupère les infos de l'utilisateur actuel
		session_start();
		
		//header 
		$top = file_get_contents('views/top.php');
		if( $_SESSION["stype"] == "prof" )
		{
			$top = str_replace("#444444","#2aa3b7",$top);
		}
		if( $_SESSION["stype"] == "eleve" )
		{
			$top = str_replace("#2aa3b7","#444444",$top);
		}
		echo $top;

		$url = explode("/",$_SERVER['REQUEST_URI']);
		unset($url[sizeof($url)-1]);

		if( $url[1] == ''){
			include('./modules/search_engine/search.php');
		}else
		if( $url[1] == 'frontpage' ) {
			include('./views/frontpage.php');
		}else
		if( $url[1] == 'lecture' ) {
			include('./views/tag-tree.php');
			include('./views/lecture.php');
		}else
		if( $url[1] == 'write' ) {
			include('./views/tag-tree.php');
			include('./views/write.php');
		}else
		if( $url[1] == 'tag' ) {
			include('./views/tag.php');
		}else	
		if( $url[1] == 'login' ) {
			if($url[-1] == '?error=true')
				include('./views/login.php?error=true');
			else
				include('./views/login.php');
		}else	
		if( $url[1] == 'register' ) {
			if($url[-1] == '?error=true')
				include('./views/register.php?error=true');
			else
				include('./views/register.php');
		}else
		if( $url[1] == 'dashboard' ) {
			include('./views/dashboard.php');
		}else
		if( $url[1] == 'disconnect' ) {
			include('./modules/login/disconnection.php');
		}else
		if( $url[1] == 'v' ) {
			include('./views/version.php');
		}else
		if( $url[1] != '' ) {
			echo "<div style='margin:20%; width: 100%; height:100%; font-family:arial;'><h1>404: Maybe you are lost ?</h1></div>";
		}
	?>

</html>
