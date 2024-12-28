<?php
    require_once 'connect.php';

    // khai báo biến
    $to_so = $_POST['to_so'];
    $gid = $_POST['gid'];
    $thua_so = $_POST['thua_so'];
    $loai_dat = $_POST['loai_dat'];
    $dien_tich = $_POST['dien_tich'];

    // update
    $sql = "UPDATE tanchanhhiep SET to_so = $to_so, thua_so = $thua_so, loai_dat = '$loai_dat', dien_tich = $dien_tich
    WHERE gid= $gid";

    $update = pg_query($connect, $sql);
    echo "success";


?>