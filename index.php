<?php

    include '/Controllers/studentController';

    $top = file_get_contents('Views/top.html');
    if( $_SESSION["stype"] == "eleve" )
      { $top = str_replace("#0984e3","#27ae60",$top); }
    if( $_SESSION["stype"] == "helper" )
      { $top = str_replace("#0984e3","#d63031",$top); }
    echo $top;

?>
