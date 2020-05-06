<?php
require("../etc/file_dispatcher/config.php");
require("../etc/sql.php");
require("../modules/file_dispatcher/sql/db_dispatcher.php");
require('../modules/file_dispatcher/main.php');?>


<?php
	echo "POST#";
	print_r($_POST);
	echo "#<br>";
	$z = new dispatcher("../data",$_POST['h_code'],'u');
	if( $z->add_row_qcm($_POST['qu'],$_POST['A'],$_POST['B'],$_POST['C'],$_POST['D'],$_POST['V']) )
		echo "#6eae1e";
	else
		echo "#f90000";
?>
