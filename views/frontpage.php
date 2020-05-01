<?php
    $db = new db_dispatcher;
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

        <div id="bloc-cours">
            <?php foreach($res as $cours){?>
                <div class = "cours"><?php echo "";?></div>
            <?php } ?>
        </div>
    </body>

</html>