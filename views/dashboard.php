<?php
?>

<head>
	<link rel="stylesheet" href="/views/style/dashboard.css">
</head>

<body>

<?php
<<<<<<< HEAD
	if($_SESSION['stype']=='user' ) { 
?>
	<div style="margin:20%;">

	<h1>VOTRE SCORE (nombre de grilles de QCM validées) :

	<?php

		$cnnx  = new PDO(const_sql::type_sql.':dbname='.const_sql::dbname.';host='.const_sql::server, const_sql::user_sql, const_sql::pass_sql);
		$str = "SELECT iduser FROM user where user=:user";
		$sql = $cnnx->prepare($str);
		$sql->execute([':user'=>$_SESSION['user']]);
		$_SESSION['iduser'] = $sql->fetchAll()[0]['iduser'];
		$str = "SELECT count(h_code) c FROM score where iduser=:iduser";
		$sql = $cnnx->prepare($str);
		$sql->execute([':iduser'=>$_SESSION['iduser']]);
		print_r($sql->fetchAll()[0]['c']);
		
	}
	?>

	</h1>


</body>
