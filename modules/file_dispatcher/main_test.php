<?php
require('main.php');

//$z = new dispatcher("fc1154a11d6d9eaa2706f044e99f80a8",'r');
echo "[main_test]";
//$z = new dispatcher("C/network/socket/",'r');
//print_r("is_hash=" . $z->is_hash("098f6bcd4621d373cade4e832627b4f6") . ".<br>");
echo "[creation]";
$z = new dispatcher("C/memory/pointers/",'c',1);
//$z = new dispatcher("C/memory/pointers/",'u');
$z->save_in_file("v0");
echo $z->read_from_file();

$z = new dispatcher("C/memory/pointers/",'u',1);
$z->new_version();
$z->save_in_file("v1");
echo $z->read_from_file();

/*$z->new_version();
$z->save_in_file("v2");
echo $z->read_from_file();*/
print_r($z->getError());
 ?>
