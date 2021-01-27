<?php

    //display errors
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);   

    $url = $_SERVER['REQUEST_URI'];
    $url = explode("/",$url);
    unset($url[1]);
    $path = join("/",$url);
    if($path == '/')
    {
        $path = '';
    }
    else
    {
        include('./views/tag-tree.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Course creation</title>
        <link rel="stylesheet" href="/views/style/add_course.css">
    </head>
    <body>
        <div id='wrapper'>
            <h1>Page creation</h1>
            <form action="/course_adding.php" method="POST">
                <div class="form-group" id="text-input">
                    <label for="course_name">Course/chapter Name</label>
                    <input class="form-control" type="text" name="course_name" required>
                    <input type="hidden" name="tree" value="<?php echo $path ?>">
                </div>
                <div class="form-group" id="buton-sub">
                    <input class="btn btn-default sbmat" type="submit" value="Create">
                </div>
            </form>
        </div>
    </body>
</html>