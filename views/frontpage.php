<?php

    //display errors
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //le résultat de la recherche est récupéré par $_SESSION
    if(isset($_SESSION['resQuery']))
    {
        $res = $_SESSION['resQuery'];

        //on détermine le poids max des tags obtenus
        $maxweight = 0;
        for($i = 0, $j = sizeof($res); $i < $j; $i++)
        {
            if($maxweight < $res[$i]['weight'])
            {
                $maxweight = $res[$i]['weight'];
            }
        }

        //on trie les tags par poids et on les range par poids croissant dans res_trie
        $res_trie = array();
        $parcours = 0;
        for($i = 0, $j = $maxweight; $i <= $j; $i++)
        {
            $res_trie[$parcours] = array();
            for($k = 0, $l = sizeof($res); $k < $l; $k++)
            {
                
                if($res[$k]['weight'] == $i)
                {
                    array_push($res_trie[$parcours],$res[$k]);
                }
            }
            $parcours ++;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="/views/style/frontpage.css">
        <link rel="stylesheet" href="/views/style/top.css">
        <?php 		
            if(!isset($_SESSION['user']))
            {
        ?>
                <style>#btn-loupe{background-color: #444444;}</style>
        <?php
            }
            else if( $_SESSION["stype"] == "admin" )
            {
        ?>
                <style>#btn-loupe{background-color: #2aa3b7;}</style>
        <?php
            }
            else if( $_SESSION["stype"] == "user" )
            {
        ?>
                <style>#btn-loupe{background-color: #004d5a;}</style>
        <?php 
            }
        ?>
    </head>

    <body>
    
        <form id="form-search" action="/modules/search_engine/search.php" method="GET">
            <div id="search-bar">
                <input id="input" type="text" name="query" placeholder="Search for a topic">
                <button id="btn-loupe" type="submit"><i id="loupe-container" class="fa fa-search"><img src="/assets/icons/loupe2.png"></i></button>
            </div>
        </form>

        <div id="bloc-des-cours">
            <?php $disp = true;
                for($i = 0, $j = sizeof($res_trie); $i < $j; $i++){
                    if(isset($res_trie[$i][0]))
                    {
                        if($res_trie[$i][0]['weight'] == 0)
                        {
                            echo '<h2 id="topics">Topics</h2>';
                        }
                        if($res_trie[$i][0]['weight'] >= 1 && $disp == true)
                        {
                            $disp = false;
                            echo '<h2 id="courses">Courses</h2>';
                        }
                    }
                    foreach($res_trie[$i] as $cours){ 
                        $z = new dispatcher("./data",$cours['h_code'],'r');
                        $path_array = $z->get_tree();
                        $path = '/lecture/';
                        for($l = 0, $m = $res_trie[$i][0]['weight']; $l <= $m; $l++)
                        {
                            $path = $path.$path_array[$l];
                            $path = $path.'/';
                        } 
            ?>
                        <div class="bloc-cours">
                            <a class="lien-cours" href="<?php echo $path ?>">
                                <?php                                
                                    echo '<br>';   
                                    echo var_dump($path);                                                                      
                                ?>
                            </a>
                        </div>
            <?php   } 
                } 
            ?>
        </div>
        
    </body>

</html>