<?php
    if(isset($_POST['tree']) && isset($_POST['course_name']))
    {
        $tree = $_POST['tree'];
        if($tree == ''){
            header('location:/write/'.$_POST['tree'].$_POST['course_name'].'/');
        }
        else
        {
            header('location:/write'.$_POST['tree'].$_POST['course_name'].'/');
        }
    }
    else
    {
        header('location:/');
    }