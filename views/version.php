<?php
$z = new dispatcher("./data",str_replace("/v/","",$_SERVER['REQUEST_URI']),'r');
$current_v = $z->get_version();
echo "<div style='margin-left:20%; margin-top:20%; font-family: arial'>";
if($z->get_h_code() != 'NOT_FOUND') {
	
	print_r("there is exactly a maximum of ".$z->get_last_version());
	for($i=0; $i<=$z->get_last_version(); $i++) {
		print_r("<h1> version : ".$i."</h1>");
		echo "<textarea rows=\"40\" cols=\"80\">".$z->read_from_file_by_version($i)."</textarea>";
		if($i != $current_v ) 
			echo "<br><a href='/activate/".$z->get_h_code()."/".$i."'>activate the version ".$i."</a>";
		else
			echo "<br>This is the current version ".$i;
	}
	echo "<br>";

}else 
	echo "there is no versions for this page";
echo "</div>";
?>
