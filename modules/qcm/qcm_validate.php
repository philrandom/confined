<?php

	//display errors
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
	$z = new dispatcher("./data",$_POST['h_code'],'u');
	// $hash = $_POST['h_code'];
	echo $z->get_all_row_qcm();
	// foreach($z->get_all_row_qcm() as $question) {
		// $idq = $question['idq'];
		// $V = $question['V'];
		// foreach($_POST as $submit) {
		// 	if(explode('-',$_POST['question-'.$idq])[1] != $V)
		// 	{
		// 		echo "faux !";
		// 		// header('location:'.$z->get_tree());
		// 	}
		// 	else
		// 	{
		// 		echo "vrai";
		// 	}
		// }
	// }
