<?php

$z = new dispatcher("./data",str_replace("/lecture/","",$_SERVER['REQUEST_URI']),'r');?>

<head>
	<link rel="stylesheet" href="/views/style/lecture.css">
	<meta charset="UTF-8">
</head>

<?php echo $z->read_from_file(); ?>
