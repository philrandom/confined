<?php
    //display errors
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

	$z = new dispatcher("./data",str_replace("/write/","",$_SERVER['REQUEST_URI']),'r',1);
	$hash = $z->get_h_code();
	$cnnx = new PDO('mysql:dbname=confined;host=localhost', 'root', 'root');
	$sql = "SELECT user.user FROM `file_ref` INNER JOIN user ON user.iduser= file_ref.author WHERE h_code = '$hash' GROUP BY h_code";
    $res = $cnnx->prepare($sql);
    $res->execute();
	$res = $res->fetchAll();
	$author = $res[0]['user'];
	include('./views/tag-tree.php');
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
			session_start();
			$_SESSION['path']=str_replace("/write/","",$_SERVER['REQUEST_URI']);
		?>
		<?php if($_SESSION['stype'] == 'admin' or $res[0]['user'] == $_SESSION['user']){?>
				<br>
				<textarea rows="40" cols="80" name="article" form="uform"><?php if($z->get_h_code()!='NOT_FOUND') print_r($z->read_from_file());?></textarea>
				<br>
				<form action='/upload.php' method="post" id="uform" >
					<input type="submit" class='button' value='Publish' >
				</form>
		<?php echo "<p id=\"author\">Author : $author</p>";}
			//si le visiteur n'a pas les droits, il doit stage sa commit et ne peut pas upload directement
			else if(isset($_SESSION['user'])){?>
				<br>
				<textarea rows="40" cols="80" name="article" form="uform"><?php if($z->get_h_code()!='NOT_FOUND') print_r($z->read_from_file());?></textarea>
				<br>
				<form action='/stage_commit.php' method="post" id="uform" >
				<input type="submit" class='button' value='Submit' >
			</form>
		<?php echo "<p id=\"author\">Author : $author</p>";}
			else 
			{
				echo "<div style='margin:20%; margin-left:35%; width: 100%; height:100%; font-family:arial;'><h1>404: Maybe you are lost ?</h1></div>";
			}
		?>
		<br>
	</body>

</html>