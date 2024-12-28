<?php
$host = "localhost";
$port = "5432";
$user = "postgres";
$db = "GIS_LAM";   
$pass = "25062003";
$connect = pg_connect("host = $host port = $port user = $user dbname = $db password = $pass")
or die ("Kết nối thất bại");

$gid = $_POST['gid'];
$sql = "SELECT to_so, thua_so, loai_dat, dien_tich,
                ST_X(ST_Centroid(geom)) AS tam_x,
                ST_Y(ST_Centroid(geom)) AS tam_y FROM tanchanhhiep WHERE gid = $gid";
$query = pg_query($connect, $sql) or die ("Truy vấn thất bại");
$toado = pg_fetch_all($query);
$toado = json_encode($toado);

echo $toado;
?>