<?php
    session_start();
    if(isset($_SESSION['user']))
    {
        print($_SESSION['user']);
    }
    else
        print('');