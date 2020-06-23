<?php

    //display errors
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $tag = '%'.explode("/",$_SERVER['REQUEST_URI'])[2].'%';
    if($tag=='%%')
    {
        header('location:/frontpage/');
    }

    $cnnx = new PDO(const_sql::type_sql.':dbname='.const_sql::dbname.';host='.const_sql::server, const_sql::user_sql, const_sql::pass_sql);
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
                <button id="btn-loupe" type="submit"><i id="loupe-container" class="fa fa-search"></i></button>
            </div>
        </form>

        <div id="bloc-des-tags">
            <?php $disp = true;
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
                        $path = explode("/",$path);
                        unset($path[0]);
                        unset($path[1]);
                        array_pop($path);
                        $title = end($path);
                        $path = join("/",$path);
                        $path = $path."/";
            ?>
                    <div class="bloc-tag">
                        <a class="lien-tag" href="<?php echo "/lecture/".$path ?>">
                            <div class="course-title"><?php echo $title;?></div>
                            <div class="course_thumbnail">
                                <img 
                                src= 
                                    <?php
                                        if($disp == true){
                                            $zi = new dispatcher("./data",$path,'r');
                                            $h_code = $zi->get_h_code();
                                        }
                                        else{
                                            $h_code = $cours['h_code'];
                                        }
                                        $link = "http://localhost:81/data/attachement/".$h_code."/thumbnail.png";
                                        $file_headers = @get_headers($link);
                                        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
                                            $link = "http://localhost:81/data/attachement/".$h_code."/thumbnail.jpg";
                                            $file_headers = @get_headers($link);
                                            if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {                                                    
                                                $link = "/assets/icons/thumbnail.png";
                                            }
                                            else{
                                                $link = "/data/attachement/".$h_code."/thumbnail.jpg";
                                            }
                                        }
                                        else{
                                            $link = "/data/attachement/".$h_code."/thumbnail.png";
                                        }
                                        echo $link;
                                    ?>
                                alt="<?php echo $h_code;echo $path; ?>" 
                                width="100" 
                                height="100"
                                >
                                <br>
                            </div>
                        </a>
                    </div>
            <?php
                }
            ?>
        </div>

    </body>

</html>
