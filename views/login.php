<?php 
    // if(isset($_GET['error'])) 
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="/views/style/login.css">
        <link rel="stylesheet" href="/views/style/top.css">
        <script></script>
    </head>

    <body>

        <div class="wrapper">

            <!-- If the user had used wrong connection info, error message -->
            <?php  if(isset($_GET['error'])) {echo $_GET['error']; if($_GET['error'] == 'true') { echo "<p class=\"alert alert-danger\">Error, you misstyped your username or your password</p>";}}?>
            
            <div class="title">
                <h1>Log in</h1>
            </div>

            <form action="/modules/login/connection.php" method="POST">

                <div class="form-group">
                    <label for="user">Username</label>
                    <input class="form-control" type="text" name="user" required>
                </div>

                <div class="form-group">
                    <label for="pass">Password</label>
                    <input class="form-control" type="password" name="pass" required>
                </div>
                
                <div class="title">
                    <button type="submit" class="btn btn-default sbmit">Log in</button>
                </div>

            </form>

        </div>

    </body>

</html>