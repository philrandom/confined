<?php

$z = new dispatcher("./data",str_replace("/lecture/","",$_SERVER['REQUEST_URI']),'r');
//print_r($z->get_h_code());
//echo '<br><br><br><br><br><br><br><br><br><br>';
//print_r(preg_match_all("[/]",$_SERVER['REQUEST_URI'])-2);
?>
<head>
	<link rel="stylesheet" href="/views/style/lecture.css">
	<link rel="stylesheet" href="/views/style/lecture-dark.css">
	<meta charset="UTF-8">
</head>
<body>
<script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js?skin=doxy"></script>

<?php 
if( $z->get_h_code() != "NOT_FOUND" )
	echo str_replace("<pre><code class=\"","<pre style=\"background-color: #0f0f0f\"><code class=\"prettyprint linenums ",$z->read_from_file()); 
else
	if( sizeof($z->get_summary()) != 0 ) {
		//print_r($z->get_summary());
		for($k=0; $k<3; $k++)	echo '<br>';
		foreach($z->get_summary() as $tree)
			for($i=preg_match_all("[/]",$_SERVER['REQUEST_URI'])-2; $i<sizeof($tree);$i++) {
					echo "<br>";
					for($j=0; $j<($i-1); $j++)	print_r("&nbsp;&nbsp;&nbsp;&nbsp;");
					echo "<a href='/lecture/";
					for($k=0; $k<$i+1; $k++) echo $tree[$k].'/';
					echo "'>".$tree[$i]."</a>";
			}
	}
	else echo "<div style='margin-top:40%'>What do you want to make?<br><a href=".str_replace("/lecture/","/write/",$_SERVER['REQUEST_URI']) .">page</a></div>";

?>
</body>