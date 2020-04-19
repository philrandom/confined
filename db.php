<?php
class connection
{

    public $cnnx;

    function __construct()
    {
        $this->cnnx  = new PDO('mysql:dbname=confined;host=localhost', 'confined', 'confined0');
    }

    function kill()
    {
        $this->cnnx = null;
    }

		function search_by_hash($h_code)
		{
			$sql = $this->cnnx->prepare("SELECT type , username FROM `USERS` WHERE email = :email AND password = :password ");
			$sql->execute([':email' => $email, ':password' => md5($password)]);
			$type = $sql->fetchAll();



		}



    function login($email, $password)
    {
        $sql = $this->cnnx->prepare("SELECT type , username FROM `USERS` WHERE email = :email AND password = :password ");
        $sql->execute([':email' => $email, ':password' => md5($password)]);
        $type = $sql->fetchAll();
        echo "TYPES : " . $types;
        if ($types == "") header('location: ../index.php?login_status=wrong');
        foreach ($type as $types) {
            //if($types['type']=="" && $types['username']=="")   header('location: ../index.php');
            $_SESSION['type'] = $types['type'];
            $_SESSION['username'] = $types['username'];
        }
        if (isset($_SESSION['type']) && isset($_SESSION['username'])) {
            header('location: ../index.php');
        }
    }


}
