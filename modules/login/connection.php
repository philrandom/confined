<?php
    //display errors
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    //if this page is accessed through the login form
    if(isset($_POST['user']) && isset($_POST['pass']))
    {
        //initialiazation of the user info
        $pass = $_POST['pass'];
        $user = $_POST['user'];
        $mail = $_POST['user'];

        //oppening the database
        require("../../etc/sql.php");
        $cnnx = new PDO(constant('type_sql').':dbname='.constant('dbname').';host='.constant('server'), constant('user_sql'), constant('pass_sql'));

        //searching for the user
        $sql = "SELECT * FROM user WHERE (user = :user AND pass = :pass) OR (mail = :mail AND pass = :pass)";
        $res = $cnnx->prepare($sql);
        $res->bindParam(':user',$user);
        $res->bindParam(':pass',$pass);
        $res->bindParam(':mail',$mail);
        $res->execute();
        $r = $res->fetch(PDO::FETCH_ASSOC);

        //if found
        if(count($r) != 0)
        {
			print_r($r);
            session_start();
            $_SESSION['iduser'] = $r['iduser'];
            $_SESSION['user'] = $r['user'];
            $_SESSION['stype'] = $r['type'];
			$_SESSION['mail'] = $r['mail'];
			$_SESSION['photo'] = $r['photo'];
            $cnnx = null;
            header("Location:/");
        }
        else //if not found
        {
            header ("Location:/login/error.php/");
        }
    }
    else //if this page isn't accessed through the login form
    {
        //404 error
        echo "<div style='margin:20%; margin-left:35%; width: 100%; height:100%; font-family:arial;'><h1>404: Maybe you are lost ?</h1></div>";
    }
