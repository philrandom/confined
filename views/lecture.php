<?php

$z = new dispatcher("./data",str_replace("/lecture/","",$_SERVER['REQUEST_URI']),'r');
print_r($z->get_h_code());

?>
<head>
	<link rel="stylesheet" href="/views/style/lecture.css">
	<meta charset="UTF-8">
</head>
<body>
<script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js?skin=doxy"></script>

<?php 
if( $z->get_h_code() != "NOT_FOUND" )
	echo str_replace("<pre><code class=\"","<pre style=\"background-color: #0f0f0f\"><code class=\"prettyprint linenums ",$z->read_from_file()); 
else
	print_r($z->get_summary());

?>
</body>
