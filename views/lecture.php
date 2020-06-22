<?php
	$z = new dispatcher("./data",str_replace("/lecture/","",$_SERVER['REQUEST_URI']),'r');
	$hash = $z->get_h_code();
	//print_r($z->get_h_code());
	//print_r($z->getError());
	//echo '<br><br><br><br><br><br><br><br><br><br>';
	//print_r(preg_match_all("[/]",$_SERVER['REQUEST_URI'])-2);
?>

<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
	<link rel="stylesheet" href="/views/style/lecture.css">
	<!--<link rel="stylesheet" href="/views/style/lecture-dark.css">-->
	<meta charset="UTF-8">
</head>

<body>

	<?php if(isset($_SESSION['user'])){?>
		<a href="<?php echo str_replace("/lecture/","/write/",$_SERVER['REQUEST_URI']) ?>" class="modif fa fa-pencil"></a>
	<?php } ?>
	
	<script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js?skin=doxy"></script> <!-- prettify to colorify code blocks -->

	<?php 
	if( $z->get_h_code() != "NOT_FOUND" )	//print article
		echo "<div class=article>".str_replace("<pre><code class=\"","<pre style=\"background-color: #0f0f0f\"><code class=\"prettyprint linenums ",$z->read_from_file())."</div>"; 
	//else
		if( sizeof($z->get_summary()) != 0 ) {	//SUMMARY
			for($k=0; $k<3; $k++)	echo '<br>';
			if( sizeof($z->get_summary()) > 1 )	echo "<div style='border-top: medium dashed grey;'><h1>Summary</h1></div>";
			foreach($z->get_summary() as $tree)
				for($i=preg_match_all("[/]",$_SERVER['REQUEST_URI'])-2; $i<sizeof($tree);$i++) {
						echo "<br>";
						for($j=0; $j<($i-1); $j++)	print_r("&nbsp;&nbsp;&nbsp;&nbsp;");
						echo "<a href='/lecture/";
						for($k=0; $k<$i+1; $k++) echo $tree[$k].'/';
						echo "'>".$tree[$i]."</a>";
				}
			
			//QCM

			//vérification de l'existence du qcm
			$cnnx = new PDO(const_sql::type_sql.':dbname='.const_sql::dbname.';host='.const_sql::server, const_sql::user_sql, const_sql::pass_sql);
			$sql = "SELECT * FROM qcm WHERE h_code='".$hash."'";
			$res = $cnnx->prepare($sql);
			$res->execute();
			$res = $res->fetchAll();
			if(count($res) !=0)
			{

			//récupération du score de l'user dans la table score
			$sql = "SELECT * FROM score WHERE iduser=".$_SESSION['iduser']." AND h_code='".$hash."'";
			$res = $cnnx->prepare($sql);
			$res->execute();
			$res = $res->fetchAll();

			//si l'user a réussi le QCM
			if(count($res) != 0)
			{
				echo "<p id=\"reussite\">Vous avez réussi l'évaluation pour ce cours</p>";
			}
			else 
			{//sinon, on lui affiche le qcm 
			?>
				<!--QCM-->
				<div id="bloc-qcm-lecture">						

						<h1>QCM</h1>
						
						<form action="/modules/qcm/qcm_validate.php" method="POST">
							<?php 
								foreach($z->get_all_row_qcm() as $row_qcm) {
							?>
								<div class="bloc-question">

									<?php $idq = $row_qcm['idq'];?>
									
									<div class="question"><?php echo $row_qcm['question']; ?></div>								
									
									<label for="r-A-<?php echo $idq; ?>"><?php echo $row_qcm['A'] ?></label>
									<input type="radio" id="r-A-<?php echo $idq; ?>" name="question-<?php echo $idq; ?>" value="r-A-<?php echo $idq; ?>">

									<label for="r-B-<?php echo $idq; ?>"><?php echo $row_qcm['B'] ?></label>
									<input type="radio" id="r-B-<?php echo $idq; ?>" name="question-<?php echo $idq; ?>" value="r-B-<?php echo $idq; ?>">

									<label for="r-C-<?php echo $idq; ?>"><?php echo $row_qcm['C'] ?></label>
									<input type="radio" id="r-C-<?php echo $idq; ?>" name="question-<?php echo $idq; ?>" value="r-C-<?php echo $idq; ?>">

									<label for="r-D-<?php echo $idq; ?>"><?php echo $row_qcm['D'] ?></label>
									<input type="radio" id="r-D-<?php echo $idq; ?>" name="question-<?php echo $idq; ?>" value="r-D-<?php echo $idq; ?>">	
									
								</div>
							<?php } ?>
							<input style='display:none' type=text name="h_code" value="<?php echo $hash ?>"></div>
							<input class="button-lecture" style="margin-left:5%;padding:2%;" type="submit" value="Envoyer">
						</form>					

				</div>

			<?php }
			}

			//récupération de l'auteur de l'article
			$z = new dispatcher("./data",str_replace("/lecture/","",$_SERVER['REQUEST_URI']),'r',1);
			$hash = $z->get_h_code();
			$cnnx = new PDO(const_sql::type_sql.':dbname='.const_sql::dbname.';host='.const_sql::server, const_sql::user_sql, const_sql::pass_sql);
			$sql = "SELECT user.user FROM `file_ref` INNER JOIN user ON user.iduser= file_ref.author WHERE h_code = '$hash' GROUP BY h_code";
			$res = $cnnx->prepare($sql);
			$res->execute();
			$res = $res->fetchAll();
			$author = $res[0]['user'];
			if($author != null)
			{
				echo "<p id=\"author\">Author : $author</p>";
			}	
		}
		else{ 	//CREATION PAGE
		?>
			<!-- on cache le crayon -->
			<style>.modif{display: none;}</style>
		<?php
			echo "<div style='margin-top:40%;'>Woops, this page does not exist, do you want to create it? <br><u><a style='text-decoration:none; color:#2aa3b7;' href=".str_replace("/lecture/","/write/",$_SERVER['REQUEST_URI']) .">Create this page</a></u></div>";
		}
	//print_r($z->getError());
	?>
</body>
