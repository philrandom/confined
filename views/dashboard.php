<?php
?>
<head>
	<link rel="stylesheet" href="/views/style/dashboard.css">
</head>
<body>
<?php
if($_SESSION['stype']=='user' ) { 
?>
<div style="margin:20%;">
		<h1>VOTRE SCORE nombre de grilles QCM validées
		<?php
			$cnnx = new db_dispatcher();
			print_r($cnnx->score_global_qcm($_SESSION['user']));
		}
		?>
		</h1>
		<?php
			foreach( $cnnx->get_all_correct_grid_qcm($_SESSION['user']) as $hash ) {
				$z = new dispatcher('./data',$hash['h_code'],'r',1);
				foreach($z->get_tree() as $p)
					echo $p.'/';
				echo "<br>";

			}

		?>

</div>






</body>
