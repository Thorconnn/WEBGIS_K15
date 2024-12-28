<?php
        // thử thông báo có chạy không
        // echo "Tôi đã nhận được thông tin";


    $host = "localhost";
    $port = "5432";
    $user = "postgres";
    // tên database mình đặt trong con voi (phân biệt hoa, thường)
    $db = "GIS_LAM";   
    // với pass tự đặt ban đầu để vào app:
    $pass = "25062003";


    $connect = pg_connect("host = $host port = $port user = $user dbname = $db password = $pass")
    or die ("Kết nối thất bại");

        // thử thông báo có chạy không
        // echo "Kết nối đến database thành công!"


    // Xử lý thông tin đăng ký, trong [] là dữ liệu trước: trong ajax
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];
    $phanquyen ='user';

        // thử thông báo có chạy không
        // echo $name;


    // Đưa vào database thành lập: users -> tên bảng;
    // username, email... -> các cột biến trong bảng users
    $sql = "INSERT INTO users (username, email, phone, pass, phanquyen) 
            VALUES ('$name', '$email', '$phone', '$pass', '$phanquyen')";

    // pg_query là câu lệnh để chạy 2 biến $connect, $sql
    $query = pg_query($connect, $sql) or die ("Thất bại!");

    // "" phải giống câu lệnh tham chiếu, phân biệt hoa, thường => if (data == "Thành công")
    echo "Thành công";


?>