<?php

    //display errors
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $tag = '%'.explode("/",$_SERVER['REQUEST_URI'])[2].'%';

    $cnnx = new PDO('mysql:dbname=confined;host=localhost', 'root', 'root');
    $sql = "SELECT * FROM tag WHERE tag LIKE :tag";
    $res = $cnnx->prepare($sql);
    $res->bindParam(':tag',$tag);
    $res->execute();
    $res = $res->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="/views/style/tag.css">
        <link rel="stylesheet" href="/views/style/top.css">
        <link rel="stylesheet" href="/views/style/frontpage.css">
    </head>

    <body>

        <form id="form-search" action="/modules/search_engine/search.php" method="GET">
            <div id="search-bar">
                <input id="input" type="text" name="query" placeholder="Search for a topic">
                <button id="btn-loupe" type="submit"><i id="loupe-container" class="fa fa-search"><img src="/assets/icons/loupe2.png"></i></button>
            </div>
        </form>

        <h1>Related Tags</h1>

        <div id="bloc-des-tags">
            <?php
                foreach($res as $r)
                {
                    $z = new dispatcher("./data",$r['h_code'],'r');
                        $path_array = $z->get_tree();
                        $path = '/lecture/';
                        foreach($path_array as $next)
                        {
                            $path = $path.$next;
                            $path = $path.'/';
                        } 
            ?>
                    <div class="bloc-tag">
                        <a class="lien-tag" href="<?php echo $path ?>">
                            <?php                                
                                echo '<br>';   
                                echo var_dump($path);                                                                      
                            ?>
                        </a>
                    </div>
            <?php
                }
            ?>
        </div>
        
    </body>

</html>