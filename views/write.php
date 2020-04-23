<?php

$z = new dispatcher("./data",str_replace("/write/","",$_SERVER['REQUEST_URI']),'r',1);
print_r($z->get_h_code());

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
	<textarea rows="40" cols="80" name="article" form="uform"><?php if($z->get_h_code()!='NOT_FOUND') print_r($z->read_from_file());?></textarea>
	<br>
	<form action='/upload.php' method="post" id="uform" >
	  <input type="submit" class='button' value='Publish' >
	</form>
	<br>



</body>
