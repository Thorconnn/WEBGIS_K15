<?php
    // echo "Xử lý đăng nhập";

    // kết nối database
    $host = "localhost";
    $port = "5432";
    $user = "postgres";
    $db = "GIS_LAM";   
    $pass = "25062003";
    $connect = pg_connect("host = $host port = $port user = $user dbname = $db password = $pass")
    or die ("Kết nối thất bại");

    // Lấy thông tin dangnhap.php truyền qua
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // echo "Email là " . $email . "mật khẩu là " . $pass; => test coi thành công chưa

    // xử lý đăng nhập 
    $sql = "SELECT * FROM users WHERE email ILIKE '$email' AND pass = '$pass'";

    $query = pg_query($connect, $sql) or die ("Truy vấn thất bại");

    $row = pg_num_rows($query);

    if($row>0) {
        while($ketqua = pg_fetch_array($query)){
            // gán cookie
            setcookie('taikhoan',$ketqua['username'],time() + 1*24*60*60);
            setcookie('phanquyen',$ketqua['phanquyen'],time() + 1*24*60*60);
        }
        echo "Thành công";
    } else {
        echo "Thất bại";
    }

?>