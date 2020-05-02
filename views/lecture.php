<?php
$z = new dispatcher("./data",str_replace("/lecture/","",$_SERVER['REQUEST_URI']),'r');
//print_r($z->get_h_code());
//print_r($z->getError());
//echo '<br><br><br><br><br><br><br><br><br><br>';
//print_r(preg_match_all("[/]",$_SERVER['REQUEST_URI'])-2);
?>
<head>
	<link rel="stylesheet" href="/views/style/lecture.css">
	<!--<link rel="stylesheet" href="/views/style/lecture-dark.css">-->
	<meta charset="UTF-8">
</head>
<body>
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
	}
	else 	//CREATION PAGE
		echo "<div style='margin-top:40%;'>Woops, this page does not exist, do you want to create it? <br><u><a style='text-decoration:none; color:#2aa3b7;' href=".str_replace("/lecture/","/write/",$_SERVER['REQUEST_URI']) .">Create this page</a></u></div>";
//print_r($z->getError());
?>
</body>
