<?php
    $server = "localhost";
    $user = "root";
    $pw = "";
    $db = "sia";

    $konek = mysqli_connect($server, $user, $pw, $db);
    if(!$konek){
        echo "Database tidak ditemukan";
    }

