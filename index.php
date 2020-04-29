<?php
require("./etc/file_dispatcher/config.php");
require("./etc/sql.php");
require("./modules/file_dispatcher/sql/db_dispatcher.php");
require('./modules/file_dispatcher/main.php');?>
<html>


<?php
	session_start();
    $top = file_get_contents('views/top.html');
    if( $_SESSION["stype"] == "eleve" )
      { $top = str_replace("#2aa3b7","#27ae60",$top); }
    if( $_SESSION["stype"] == "helper" )
      { $top = str_replace("#2aa3b7","#d63031",$top); }
    echo $top;


	$url = explode("/",$_SERVER['REQUEST_URI']);
	unset($url[sizeof($url)-1]);
	
	if( $url[1] == 'lecture' ) {
		include('./views/tag-tree.php');
		include('./views/lecture.php');
	}else 
	if( $url[1] == 'write' ) {
		include('./views/tag-tree.php');
		include('./views/write.php');
	}else	
	if( $url[1] == 'login' ) {
		include('./views/login.php');
	}else
	if( $url[1] == 'v' ) {
		include('./views/version.php');
	} else
	if( $url[1] != '' ) {
		echo "<div style='margin:20%; width: 100%; height:100%; font-family:arial;'><h1>404: Maybe you are lost ?</h1></div>";
	}
?>
</html>
