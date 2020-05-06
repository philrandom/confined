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
		<script>
			$(document).ready(function()
            {
				$("#add-question").click(function(){
				  var xhttp = new XMLHttpRequest();
				  xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("bloc-qcm").innerHTML = this.responseText +"<div id='bloc-q'>"+ document.getElementById("bloc-q").innerHTML+"</div>" ;
						}
				  };
				  xhttp.open("POST", "/ajax/qcm_upload.php", true);
				  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				  var str = "h_code="+document.getElementById("hash_code").innerHTML+"&qu="+document.getElementById("q").value+"&A="+document.getElementById("A").value+"&B="+document.getElementById("B").value+"&C="+document.getElementById("C").value+"&D="+document.getElementById("D").value+"&V="+document.getElementById("V").value;
				  xhttp.send(str);
				});
			});
		</script>
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
		
			echo "<p id=\"indications\">Course edition :<br><br>Your course must be written in correct html in the following textarea. You can include all the content that you wish, including customized styles.<br><br>To include a ressource in your course, please use the url \"/data/attachement/<span id='hash_code'>$hash</span>/<your_ressource.format>\"<br>For instance, to include an uploaded image named \"analyse.png\", use the img markup with the source attribute : src=\"/data/attachement/$hash/analyse.png\"<br><br>To include an evaluation to your course adding a multiple-choice questionnaire to it, you can use the questionnaire utility below the textarea</p>";
		
			//if the user is an admin 
			if($_SESSION['stype'] == 'admin'){
		?>
				<textarea rows="40" cols="80" name="article" form="uform"><?php if($z->get_h_code()!='NOT_FOUND') print_r($z->read_from_file());?></textarea>

				<!-- <textarea rows="40" cols="80" name="article" form="uform"><?php //if($z->get_h_code()!='NOT_FOUND') print_r($z->get_qcm_responses());?></textarea> -->

				<form enctype="multipart/form-data" action='/upload.php' method="post" id="uform">
					<input type="submit" class='button' value='Publish'>
					<input type="file" name="fileToUpload" id="fileToUpload">
				</form>

				<!--QCM-->
				<div id="bloc-qcm">

					<!--BLOC DE LA PREMIERE QUESTION-->
					<div id="bloc-q">
					  <div class="div-bloc-question"><!--div only for style-->
						<!--UNE QUESTION-->
						<div class="question">
							<label >Nouvelle question </label>
							<input name="q-1" id="q" type="text">
						</div>
						
						<!--4 REPONSES-->
						<div class = bloc-questions>
							<div class="response">
								<label for="q-1-1">A</label>
								<input id="A" type="text">
							</div>
							<div class="response">
								<label for="q-1-2">B</label>
								<input name="q-1-2" id="B" type="text">
							</div>
							<div class="response">
								<label for="q-1-3">C</label>
								<input name="q-1-3" id="C" type="text">
							</div>
							<div class="response">
								<label for="q-1-4">D</label>
								<input name="q-1-4" id="D" type="text">
							</div>
							<div class="response">
								<label for="q-1-4">V</label>
								<input name="q-1-4" id="V" type="text">
							</div>
						</div>
					  </div>
					</div>
				</div>
				<div id="add-question" class="fa fa-plus-square"></div>

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
