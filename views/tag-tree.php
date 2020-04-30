<?php $z = new dispatcher("./data",str_replace('/'.explode("/",$_SERVER['REQUEST_URI'])[1].'/',"",$_SERVER['REQUEST_URI']),'r'); ?>

<head>
	<link rel="stylesheet" href="/views/style/tag_tree.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
var table = [ <?php foreach($z->get_tree() as $leaf) echo "\"$leaf\","; ?> "" ];

$(document).ready(function(){

	var str="";
	for(var i = 0; i < table.length-1; i++) {
		str = str + table[i] + '/';
		console.log(str);
		$("#"+table[i]).html("<a href='/lecture/"+str+"'>"+table[i]+"</a>");
	}

  $("#tree-tag").click(function(){
  	if( document.getElementById("tree-tag").innerHTML == "<i class=\"fa fa-eye\"></i>tree" ) {
  		document.getElementById("tree-tag").innerHTML = "<i class=\"fa fa-eye\"></i>tag";
	  	$(".shift-r").removeClass("grow-r");
		$(".shift-r").addClass("dead-r");
		$(".shift-l").removeClass("grow-l");
		$(".shift-l").addClass("dead-l");
		for(var i = 0; i < table.length-1; i++) {
			console.log(table[i]);
			$("#"+table[i]).html("<a href='/tag/"+table[i]+"'>"+table[i]+"</a>");
		}
    } else if( document.getElementById ("tree-tag").innerHTML == "<i class=\"fa fa-eye\"></i>tag" ) {
    	document.getElementById ("tree-tag").innerHTML = "<i class=\"fa fa-eye\"></i>tree";
    	$(".shift-r").addClass("grow-r");
		$(".shift-r").removeClass("dead-r");
		$(".shift-l").addClass("grow-l");
		$(".shift-l").removeClass("dead-l");
		var str="";
		for(var i = 0; i < table.length-1; i++) {
			str = str + table[i] + '/';
			console.log(str);
			$("#"+table[i]).html("<a href='/lecture/"+str+"'>"+table[i]+"</a>");
		}
    }
  });
});
</script>
</head>
<body>

<div id='englobe-tag'>
<?php
foreach($z->get_tree() as $leaf) {
	echo "<div class='shift-l grow-l'> </div><div class='bloc' id='$leaf'>$leaf</div><div class='shift-r grow-r'> </div>";	
}
?>
</div>
<div id='tree-tag'><i class="fa fa-eye"></i>tree</div>


</body>

