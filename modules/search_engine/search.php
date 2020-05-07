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
            //quand on search un tag
            $query = $_GET['query'];
            header("location:/tag/".$query."/");
        }
        else
        {
            //quand on accède à la frontpage par le bouton 
            $query = '%%';
            $cnnx = new PDO('mysql:dbname=confined;host=localhost', 'root', 'root');
            $sql = "SELECT * FROM tag WHERE tag LIKE :query GROUP BY tag ORDER BY weight DESC";
            $res = $cnnx->prepare($sql);
            $res->bindParam(':query',$query);
            $res->execute();
            $res = $res->fetchAll();
    
            //on récupère les infos de connection pour ne pas se déconnecter si on est connecté
            $connected = false;
            if(isset($_SESSION['user']))
            {
                $iduser = $_SESSION['iduser'];
                $user = $_SESSION['user'];
                $stype = $_SESSION['stype'];
                $connected = true;
            }
            session_destroy();
            session_start();
            unset($_SESSION['resQuery']);
            $_SESSION['resQuery'] = $res;
            if($connected)
            {
                $_SESSION['iduser'] = $iduser;
                $_SESSION['user'] = $user;
                $_SESSION['stype'] = $stype;
            }
            header('location:/frontpage/');
        }

    }
    //if this page isn't accessed the right way
    else
    {
        //404 error
        echo "<div style='margin:20%; margin-left:35%; width: 100%; height:100%; font-family:arial;'><h1>404: Maybe you are lost ?</h1></div>";
    }