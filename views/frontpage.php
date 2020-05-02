<?php

    //display errors
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if(isset($_SESSION['resQuery']))
    {
        $res = $_SESSION['resQuery'];

        $maxweight = 0;
        for($i = 0, $j = sizeof($res); $i < $j; $i++)
        {
            if($maxweight < $res[$i]['weight'])
            {
                $maxweight = $res[$i]['weight'];
            }
        }

        $res_trie = array();
        $parcours = 0;
        for($i = $maxweight; $i != 0; $i--)
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
    </head>

    <body>
        <form id="form-search" action="/modules/search_engine/search.php" method="GET">
            <div id="search-bar">
                <input id="input" type="text" name="query" placeholder="Search for a topic">
                <button id="btn-loupe" type="submit"><i id="loupe-container" class="fa fa-search"><img src="/assets/icons/loupe.png"></i></button>
            </div>
        </form>

        <div id="bloc-des-cours">
            <?php foreach($res_trie as $poids){ 
                    foreach($poids as $cours){ 
                        $z = new dispatcher("./data",$cours['h_code'],'r');
                        $path_array = $z->get_tree();
                        $path = '/lecture/';
                        foreach($path_array as $elt)
                        {
                            $path = $path.$elt;
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