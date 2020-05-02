<?php
    //display errors
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    //if this page is accessed through the registeration form
    if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['mail']) && isset($_POST['type']))
    {
        //initialiazation of the user info
        $pass = $_POST['pass'];
        $user = $_POST['user'];
        $mail = $_POST['mail'];
        $type = $_POST['type'];

        //oppening the database
        require("../../etc/sql.php");
        $cnnx = new PDO(const_sql::type_sql.':dbname='.const_sql::dbname.';host='.const_sql::server, const_sql::user_sql, const_sql::pass_sql);

        //searching for the user
        $sql = "INSERT INTO `user` VALUES (NULL, :user, :mail, :pass, NULL, :type)";
        $res = $cnnx->prepare($sql);
        $res->bindParam(':user',$user);
        $res->bindParam(':pass',$pass);
        $res->bindParam(':mail',$mail);
        $res->bindParam(':type',$type);
        $res->execute();

        //connection and user redirection to the front page 
        session_start();
        $_SESSION['user'] = $user;
        $_SESSION['stype'] = $type;
        header("Location:/");
        
    }
    else //if this page isn't accessed through the registeration form
    {
        //404 error
        echo "<div style='margin:20%; width: 100%; height:100%; font-family:arial;'><h1>404: Maybe you are lost ?</h1></div>";
        echo var_dump($_POST);
    }
