<?php
if($_SESSION['stype']=='admin') {
	$a = str_replace("/activate/","",$_SERVER['REQUEST_URI']);
	$h_code = explode("/",$a)[0];
	$v = explode("/",$a)[1];
	print_r($h_code);

	$z = new dispatcher("./data",$h_code,'r');

	$z->set_version($v);

	echo "<div style='margin:20%'>La version $v est active </div>";
} else
	echo "<div style='margin:20%'>404 Error </div>";

?>
