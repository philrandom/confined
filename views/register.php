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
            <?php  echo $_GET['error']; if($_GET['error'] == 'true') echo "<p class=\"alert alert-danger\">Error, you misstyped your username or your password</p>"?>
            
            <div class="title">
                <h1>Register</h1>
            </div>

            <form action="/modules/login/inscription.php" method="POST">

                <div class="form-group">
                    <label for="mail">Your E-mail</label>
                    <input class="form-control" type="text" name="mail" required>
                </div>

                <div class="form-group">
                    <label for="user">New Username</label>
                    <input class="form-control" type="text" name="user" required>
                </div>

                <div class="form-group">
                    <label for="pass">New Password</label>
                    <input class="form-control" type="password" name="pass" required>
                </div>

                <div id="choose" class="form-group">
                    <div class="center-radio">
                        <label for="eleve">Student</label>
                        <input type="radio" id="eleve" value="eleve" name="type" checked>
                    </div>
                    <div class="center-radio">
                        <label for="prof">Teacher</label>
                        <input type="radio" id="prof" value="prof" name="type">
                    </div>
                </div>
                
                <div class="title">
                    <button type="submit" class="btn btn-default sbmit">Register</button>
                </div>

            </form>

        </div>

    </body>

</html>