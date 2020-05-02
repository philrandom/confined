<?php

	$z = new dispatcher("./data",str_replace("/write/","",$_SERVER['REQUEST_URI']),'r',1);
	print_r($z->get_h_code());	

	// $cnnx = new PDO('mysql:dbname=confined;host=localhost', 'root', 'root');
	// $sql = "SELECT author FROM tag WHERE tag LIKE :query GROUP BY tag ORDER BY weight DESC";
    // $res = $cnnx->prepare($sql);
    // $res->bindParam(':query',$query);
    // $res->execute();
    // $res = $res->fetchAll();

	// if($_SESSION['stype'] == 'admin')
	// {

	// }
	// else
	// {
	// 	header('location:/error/');
	// }

?>
<head>
	<link rel="stylesheet" href="/views/style/lecture.css">
	<meta charset="UTF-8">
	<title>CREATION</title>
	<style>
	.button {
		  background-color: #2aa3b7;
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
	</style>
</head>
<body>

<?php

	session_start();
	$_SESSION['path']=str_replace("/write/","",$_SERVER['REQUEST_URI']);
	?>

	<br>
	<textarea rows="40" cols="80" name="article" form="uform" ><?php if($z->get_h_code()!='NOT_FOUND') print_r($z->read_from_file());?></textarea>
	<br>
	<form action='/upload.php' method="post" id="uform"  enctype="multipart/form-data">
		<input type="file" name="fileToUpload" id="fileToUpload">
	  <input type="submit" class='button' value='Publish' >
	</form>
	<br>



</body>
