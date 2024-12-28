<?php
    $host = "localhost";
    $port = "5432";
    $user = "postgres";
    $db = "GIS_LAM";   
    $pass = "25062003";

    $connect = pg_connect("host = $host port = $port user = $user dbname = $db password = $pass")
    or die ("Kết nối thất bại");
    ?>