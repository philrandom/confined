<?php
?>
<head>
	<link rel="stylesheet" href="/views/style/dashboard.css">
</head>
<body>
<?php
if($_SESSION['stype']=='user' ) { 					//USER
?>
<div style="margin:20%;">
		<h1>VOTRE SCORE nombre de grilles QCM validées
		<?php
			$cnnx = new db_dispatcher();
			print_r($cnnx->score_global_qcm($_SESSION['user']));
		echo "</h1>";
			foreach( $cnnx->get_all_correct_grid_qcm($_SESSION['user']) as $hash ) {
				$z = new dispatcher('./data',$hash['h_code'],'r',1);
				foreach($z->get_tree() as $p)
					echo $p.'/';
				echo "<br>";

			}
echo "</div>";
}



else if($_SESSION['stype']=='admin' ) { 				//ADMIN
?>
<div style="margin:20%;">
		<h1>Nouvelle commits</h1>
		<?php
			$cnnx = new db_dispatcher();
			foreach( $cnnx->get_all_articles() as $hash) {
				$z = new dispatcher('./data',$hash,'r');
				if($z->get_last_version() != $z->get_version()) {
					echo "<a href='/v/".$z->get_h_code()."'>";
					foreach($z->get_tree() as $p)
						echo $p.'/';
					echo "</a><br>";
				}

			}
	echo "</div>";
}?>





</body>
