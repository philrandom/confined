
<?php
session_start();
$_SESSION['text'] = $_SESSION['text'].$_POST['text'];
print_r('result'.$_SESSION['text']);
?>

