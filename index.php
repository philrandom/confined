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
      { $top = str_replace("#0984e3","#27ae60",$top); }
    if( $_SESSION["stype"] == "helper" )
      { $top = str_replace("#0984e3","#d63031",$top); }
    //echo $top;


	$url = explode("/",$_SERVER['REQUEST_URI']);
	unset($url[sizeof($url)-1]);
	
	if( $url[1] == 'lecture' ) {
		include('./views/tag.php');
		include('./views/lecture.php');
	} 
?>
</html>
