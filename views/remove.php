<?php
    $z = new dispatcher("./data",str_replace("/remove/","",$_SERVER['REQUEST_URI']),'u',1);
    $z->rm();
    header("Location:/");