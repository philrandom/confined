<?php
require('main.php');

//$z = new dispatcher("fc1154a11d6d9eaa2706f044e99f80a8",'r');
echo "[main_test]";
//$z = new dispatcher("C/network/socket/",'r');
//print_r("is_hash=" . $z->is_hash("098f6bcd4621d373cade4e832627b4f6") . ".<br>");
echo "[creation]";
$z = new dispatcher("C/memory/pointers/",'r');
$z->save_in_file("divny znaky");
echo $z->read_from_file();
//print_r($z->getError());
 ?>
