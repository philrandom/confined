<?php

	require("../../etc/file_dispatcher/config.php");
	require("../../etc/sql.php");
	require("../../modules/file_dispatcher/sql/db_dispatcher.php");
	require('../../modules/file_dispatcher/main.php');


	//display errors
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);
	
	//on créé un fdispatcher pour accéder au cours actuel
	$z = new dispatcher("./data",$_POST['h_code'],'u');
	$hash = $_POST['h_code'];
	//on clean up le post pour n'avoir que les réponses du qcm
	unset($_POST['h_code']);

	//on récupère le qcm de la bdd associé au cours et on vérifie les réponses envoyés en POST
	$reussite = true;
	foreach($z->get_all_row_qcm() as $question) {
		$idq = $question['idq'];
		$V = $question['V'];
		if(explode('-',$_POST['question-'.$idq])[1] != $V)
		{
			//si la réponse est mauvaise, l'évaluation échoue et l'utilisateur doit recommencer
			$reussite = false;
		}
	}

	//à la fin, si toutes les réponses sont justes, on ajoute une entrée à l'user pour le qcm correspondant dans le table score
	if($reussite)
	{
		//on récupère l'user puis on valide son qcm 
		session_start();
		$iduser = $_SESSION['iduser'];

		$cnnx = new PDO(const_sql::type_sql.':dbname='.const_sql::dbname.';host='.const_sql::server, const_sql::user_sql, const_sql::pass_sql);
		$sql = "INSERT INTO score VALUES ($iduser,'$hash')";
		$res = $cnnx->prepare($sql);
		$res->execute();
		echo var_dump($res->errorInfo());
	}
	//retour à la page du cours
	header('location:'."/lecture/".implode('/',$z->get_tree())."/");
	
