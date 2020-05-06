<?php
$z = new dispatcher("./data",str_replace("/lecture/","",$_SERVER['REQUEST_URI']),'r');
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
			echo "<div style='border-top: medium dashed grey;'><h1>Summary</h1></div>";
			foreach($z->get_summary() as $tree)
				for($i=preg_match_all("[/]",$_SERVER['REQUEST_URI'])-2; $i<sizeof($tree);$i++) {
						echo "<br>";
						for($j=0; $j<($i-1); $j++)	print_r("&nbsp;&nbsp;&nbsp;&nbsp;");
						echo "<a href='/lecture/";
						for($k=0; $k<$i+1; $k++) echo $tree[$k].'/';
						echo "'>".$tree[$i]."</a>";
				}
			
			//QCM
			$cnnx = new PDO('mysql:dbname=confined;host=localhost', 'root', 'root');
			$sql = "SELECT * FROM `user` INNER JOIN score ON user.iduser=score.iduser WHERE score.iduser=".$_SESSION['user'];
			$res = $cnnx->prepare($sql);
			$res->execute();
			$res = $res->fetchAll();

			//si l'user a réussi le QCM
			if(count($res) != 0)
			{
				echo "<p>Vous avez réussi l'évaluation pour ce cours</p>";
			}
			else
			{//sinon, on lui affiche le qcm
			?>
				<!--QCM-->
				<div id="bloc-qcm">

					<?php 
						$cnnx = new PDO('mysql:dbname=confined;host=localhost', 'root', 'root');
						$sql = "SELECT * FROM `qcm` WHERE h_code=$hash";
						$res = $cnnx->prepare($sql);
						$res->execute();
						$res = $res->fetchAll();
						foreach($res as $question)
						{
							echo var_dump($question);
						}
					?>

				</div>

			<?php }

			//récupération de l'auteur de l'article
			$z = new dispatcher("./data",str_replace("/lecture/","",$_SERVER['REQUEST_URI']),'r',1);
			$hash = $z->get_h_code();
			$cnnx = new PDO('mysql:dbname=confined;host=localhost', 'root', 'root');
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
