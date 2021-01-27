<?php
    session_start();
    if(isset($_POST['tree']) && isset($_POST['course_name']))
    {
        $tree = $_POST['tree'];
        $path = $_POST['tree'].$_POST['course_name'] . '/';
        $_SESSION['path'] = $path;
        header('location:/upload.php');
        if($tree == ''){
            // header('location:/write/'.$_POST['tree'].$_POST['course_name'].'/');            
        }
        else
        {
            // header('location:/write'.$_POST['tree'].$_POST['course_name'].'/');
        }
    }
    else
    {
        header('location:/');
    }