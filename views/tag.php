<head>
	<link rel="stylesheet" href="/views/style/tag_tree.css">
	<meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#tree-tag").click(function(){
  	if( document.getElementById ("tree-tag").innerHTML == "#tree" ) {
  		document.getElementById ("tree-tag").innerHTML = "#tag";
	  	$(".shift-r").removeClass("grow-r");
		$(".shift-r").addClass("dead-r");
		$(".shift-l").removeClass("grow-l");
		$(".shift-l").addClass("dead-l");
    } else if( document.getElementById ("tree-tag").innerHTML == "#tag" ) {
    	document.getElementById ("tree-tag").innerHTML = "#tree";
    	$(".shift-r").addClass("grow-r");
		$(".shift-r").removeClass("dead-r");
		$(".shift-l").addClass("grow-l");
		$(".shift-l").removeClass("dead-l");
    }
  });
});
</script>
</head>
<body>

<div id='englobe-tag'>
<?php
$z = new dispatcher("./data",str_replace('/'.explode("/",$_SERVER['REQUEST_URI'])[1].'/',"",$_SERVER['REQUEST_URI']),'r');
foreach($z->get_tree() as $leaf) {
	echo "<div class='shift-l grow-l'> </div><div class='bloc'>$leaf</div><div class='shift-r grow-r'> </div>";	
}
?>
</div>
<div id='tree-tag'>#tree</div>


</body>

