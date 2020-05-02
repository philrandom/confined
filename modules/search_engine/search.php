<?php

    //display errors
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //if this page is accessed through a tag search or upon frontpage click
    if(isset($_GET['query']) or explode("/",$_SERVER['REQUEST_URI'])[1] == '')
    {
        if(isset($_GET['query']))
        {
            $query = '%'.$_GET['query'].'%';
        }
        else
        {
            $query = '%%';
        }
        $cnnx = new PDO('mysql:dbname=confined;host=localhost', 'root', 'root');
        $sql = "SELECT * FROM tag WHERE tag LIKE :query GROUP BY tag ORDER BY weight DESC";
        $res = $cnnx->prepare($sql);
        $res->bindParam(':query',$query);
        $res->execute();
        $res = $res->fetchAll();
        session_destroy();
        session_start();
        unset($_SESSION['resQuery']);
        $_SESSION['resQuery'] = $res;
        header('location:/frontpage/');
    }
    //if this page isn't accessed the right way
    else
    {
        //404 error
        echo "<div style='margin:20%; width: 100%; height:100%; font-family:arial;'><h1>404: Maybe you are lost ?</h1></div>";
    }