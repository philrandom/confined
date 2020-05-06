<?php

	$z = new dispatcher("./data",str_replace("/write/","",$_SERVER['REQUEST_URI']),'r',1);

	$hash = $z->get_h_code();
	$cnnx = new PDO('mysql:dbname=confined;host=localhost', 'root', 'root');
	$sql = "SELECT user.user FROM `file_ref` INNER JOIN user ON user.iduser= file_ref.author WHERE h_code = '$hash' GROUP BY h_code";
    $res = $cnnx->prepare($sql);
    $res->execute();
	$res = $res->fetchAll();
	$author = $res[0]['user'];

?>
<!DOCTYPE html>
<html>

	<head>
		<link rel="stylesheet" href="/views/style/lecture.css">
		<meta charset="UTF-8">
		<title>CREATION</title>
		<style>
		.button {
			background-color: #004d5a;
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
		}
		.button:hover 
		{
			background-color: #2aa3b7;
			color: white;
			-webkit-transition: 100ms linear;
			-ms-transition: 100ms linear;
			transition: 100ms linear;
		}
		</style>
	</head>

	<body>
		
		<?php
			//updating the url path in session
			session_start();
			$_SESSION['path']=str_replace("/write/","",$_SERVER['REQUEST_URI']);

			//getting the title of the course
			$url = explode("/",$_SERVER['REQUEST_URI']);
			$size = sizeof($url) - 2;

			//titre
			echo "<h1 id=\"titre-write\">".$url[$size]."</h1>";
		
			echo "<p id=\"indications\">Course edition :<br><br>Your course must be written in correct html. You can include all the content that you wish, including customized styles.<br><br>To include a ressource in your course, please use the url \"/data/attachement/$hash/<your_ressource.format>\"<br>For instance, to include an uploaded image named \"analyse.png\", use the img markup with the source attribute : src=\"/data/attachement/$hash/analyse.png\"<br><br>To include an evaluation to your course adding a multiple-choice questionnaire to it, you can use a form and add the responses to your questions in the second text box in a JSON format.</p>";
		
			//if the visitor is an admin or is the user author of the article
			if($_SESSION['stype'] == 'admin' or $res[0]['user'] == $_SESSION['user']){
		?>
				<textarea rows="40" cols="80" name="article" form="uform"><?php if($z->get_h_code()!='NOT_FOUND') print_r($z->read_from_file());?></textarea>

				<!-- <textarea rows="40" cols="80" name="article" form="uform"><?php //if($z->get_h_code()!='NOT_FOUND') print_r($z->get_qcm_responses());?></textarea> -->

				<form enctype="multipart/form-data" action='/upload.php' method="post" id="uform">
					<input type="submit" class='button' value='Publish'>
					<input type="file" name="fileToUpload" id="fileToUpload">
				</form>
		<?php   if($author != null){
					echo "<p id=\"author\">Author : $author</p>";
				}
			}
			//si le visiteur n'a pas les droits, il doit stage sa commit et ne peut pas upload directement
			else if(isset($_SESSION['user'])){
		?>
				<textarea rows="40" cols="80" name="article" form="uform"><?php if($z->get_h_code()!='NOT_FOUND') print_r($z->read_from_file());?></textarea>

				<!-- <textarea rows="40" cols="80" name="article" form="uform"><?php //if($z->get_h_code()!='NOT_FOUND') print_r($z->get_qcm_responses());?></textarea> -->
				
				<form enctype="multipart/form-data" action='/stage_commit.php' method="post" id="uform">
					<input type="submit" class='button' value='Submit'>
					<input type="file" name="fileToUpload" id="fileToUpload">				
				</form>
		<?php 
				if($author != null){
					echo "<p id=\"author\">Author : $author</p>";
				}
			}
			else 
			{
				echo "<div style='margin:20%; margin-left:35%; width: 100%; height:100%; font-family:arial;'><h1>404: Maybe you are lost ?</h1></div>";
			}
		?>
		<br>
	</body>

</body>
</html> 