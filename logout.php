<?php
    setcookie('taikhoan', $_COOKIE['username'], time() -10);
    header('Location: index.php');
?>