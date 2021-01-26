
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dashboard</title>
		<link rel="stylesheet" href="/views/style/dashboard.css">
	</head>

	<body>

		<?php
		if($_SESSION['stype']=='user') {				//USER	
		?>		
		<div style="margin:20%;">
				<h1><?php echo $_SESSION['user']." : ".$_SESSION['stype']; ?></h1>
				<h2>Nombre de quizz validés =>
				<?php
					$cnnx = new db_dispatcher();
					print_r($cnnx->score_global_qcm($_SESSION['user']));
					echo "/";
					print_r($cnnx->get_number_of_grid_qcm());
				echo " :</h2>";
					foreach( $cnnx->get_all_correct_grid_qcm($_SESSION['user']) as $hash ) {
						echo "<h3>";
						$z = new dispatcher('./data',$hash['h_code'],'r',1);
						foreach($z->get_tree() as $p)
							echo $p.'/';
						echo "</h3><br>";

					}
		echo "</div>";
		}



		else if($_SESSION['stype']=='admin' ) { 				//ADMIN
		?>
		<div style="margin:20%;">
				<h1><?php echo $_SESSION['user']." : ".$_SESSION['stype']; ?></h1>
				<h2>Nouvelles demandes de modification de cours :</h2>
				<?php
					$tmp=0;
					$cnnx = new db_dispatcher();
					foreach( $cnnx->get_all_articles() as $hash) {
						$z = new dispatcher('./data',$hash,'r');
						if($z->get_last_version() != $z->get_version()) {
							echo "<a href='/v/".$z->get_h_code()."'>";
							foreach($z->get_tree() as $p)
								echo $p.'/';
							echo "</a><br>";
							$tmp++;
						}
					}
					if($tmp==0)		echo "Aucune nouvelle demande";
			echo "</div>";
		}?>

	</body>

</html>
