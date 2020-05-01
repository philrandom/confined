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
        $cnnx = new PDO(const_sql::type_sql.':dbname='.const_sql::dbname.';host='.const_sql::server, const_sql::user_sql, const_sql::pass_sql);

        //searching for the user
        $sql = "SELECT * FROM USER WHERE (user = :user AND pass = :pass) OR (mail = :mail AND pass = :pass)";
        $res = $cnnx->prepare($sql);
        $res->bindParam(':user',$user);
        $res->bindParam(':pass',$pass);
        $res->bindParam(':mail',$mail);
        $res->execute();
        $r = $res->fetch(PDO::FETCH_ASSOC);

        //if found
        if(count($r) != 0)
        {
            session_start();
            $_SESSION['user'] = $r['user'];
            $_SESSION['stype'] = $r['type'];
            $cnnx = null;
            header("Location:/index.php");
        }
        else //if not found
        {
            header ("Location:/login/error.php/");
        }
    }
    else //if this page isn't accessed through the login form
    {
        //404 error
        echo "<div style='margin:20%; width: 100%; height:100%; font-family:arial;'><h1>404: Maybe you are lost ?</h1></div>";
    }
