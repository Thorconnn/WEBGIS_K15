<!DOCTYPE html>
<html lang="en">
<?php
if(isset($_COOKIE['taikhoan'])){
    header("Location: index.php");

}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            background-image: url('1.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            /* tổ hợp bg-size:cover, bg-position:center, bg-attachment:fixed cho ra ảnh nằm full màn hình ở mọi chế độ phóng o, thu nhỏ */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4"></div>

            <div class="col-md-4">
                <div class="row form-control bg-secondary text-white bg-opacity-75" style="border-radius: 15px;">
                    <div class="col-12 text-center mt-4">
                        <label for="" class="fw-bold">ĐĂNG KÝ TÀI KHOẢN</label> <br>
                        <small>Vui lòng nhập các thông tin bên dưới để đăng ký</small><br><br>
                    </div>
                    <form action="#" id="form_dk">

                        <!-- Nhập họ tên  -->
                        <label for="">HỌ VÀ TÊN</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-regular fa-circle-user"></i></span>
                            <input type="search" class="form-control" placeholder="Nhập họ và tên" id="hoten">
                        </div>
                        <div class="mb-3">
                            <span class="text-danger " id="loihoten"></span>
                        </div>

                        <!-- Nhập email -->
                        <label for="">EMAIL</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                            <input type="search" class="form-control" placeholder="Nhập email" id="mail">
                        </div>
                        <div class="mb-3">
                            <span class="text-danger" id="loimail"></span>
                        </div>

                        <!-- Nhập điện thoại  -->
                        <label for="">PHONE</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                            <input type="tel" pattern="[0-9]{10}" class="form-control" placeholder="Nhập số điện thoại" id="sdt">
                        </div>
                        <div class="mb-3">
                            <span class="text-danger" id="loisdt"></span>
                        </div>

                        <!-- Nhập mật khẩu -->
                        <label for="">PASSWORD</label><br>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Nhập mật khẩu" id="mk">
                        </div>

                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" id="mkk">
                        </div>
                        <div class="mb-3">
                            <span class="text-danger" id="loimk"></span>
                        </div>
                        <!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" -->

                        <!-- Nút điều khiển  -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-info  text-white fw-bold w-100 mb-1"> Đăng ký</button>
                            <button type="reset" class="btn btn-info text-white w-100">Reset</button>
                        </div>
                        <div class="mb-3">
                            <span class="text-danger" id="loidk"></span>
                        </div>
                    </form>

                    <!-- Dòng hỏi  -->
                    <div class="col-12 text-center mb-4 text-white ">
                        <label for="">Bạn đã có tài khoản? </label>
                        <a href="index.php"> Đăng nhập ngay</a>
                    </div>

                </div>
            </div>

            <div class="col-md-4"></div>
        </div>
    </div>
</body>

<script>
    // var loi 
    document.getElementById("hoten").addEventListener("blur", function() {
        var hoten = document.getElementById("hoten").value.trim();
        if (hoten == "") {
            document.getElementById("loihoten").innerText = " Vui lòng nhập họ tên";
        } else {
            document.getElementById("loihoten").innerText = "";
        }
    });

    document.getElementById("mail").addEventListener("blur", function() {
        var mail = document.getElementById("mail").value.trim();
        if (mail == "") {
            document.getElementById("loimail").innerText = " Vui lòng nhập email";
        } else {
            document.getElementById("loimail").innerText = "";
        }
    });

    document.getElementById("sdt").addEventListener("blur", function() {
        var dt = document.getElementById("sdt").value.trim();
        if (dt == "") {
            document.getElementById("loisdt").innerText = " Vui lòng nhập số điện thoại";
        } else {
            document.getElementById("loisdt").innerText = "";
        }
    });


    // đoạn này làm cho mật khẩu
    document.getElementById("mk").addEventListener("blur", function() {
        var mk = document.getElementById("mk").value.trim();
        var mkk = document.getElementById("mkk").value.trim();
        if (mk == "") {
            document.getElementById("loimk").innerText = "Vui lòng nhập mật khẩu"
        } else {
            if (mk !== mkk && mkk == "") {
                document.getElementById("loimk").innerText = "Vui lòng nhập lại mật khẩu"
            } else if (mk !== "" && mk !== mkk) {
                document.getElementById("loimk").innerText = "Mật khẩu bạn vừa nhập không đúng"
            } else {
                document.getElementById("loimk").innerText = "";
            }
        }
    });

    document.getElementById("mkk").addEventListener("keyup", function() {
        var mk = document.getElementById("mk").value.trim();
        var mkk = document.getElementById("mkk").value.trim();
        if (mkk == "") {
            document.getElementById("loimk").innerText = "Vui lòng nhập lại mật khẩu"
        } else {
            if (mkk !== mk && mk == "") {
                document.getElementById("loimk").innerText = "Vui lòng nhập lại mật khẩu"
            } else if (mkk !== "" && mk !== mkk) {
                document.getElementById("loimk").innerText = "Mật khẩu bạn vừa nhập không đúng";
            } else {
                document.getElementById("loimk").innerText = "";
            }
        }
    });



    // đoạn này làm nút đăng ký
    document.getElementById("form_dk").addEventListener("submit", function(e) {
        e.preventDefault();
        // dừng không cho trang chạy đi tùm lum
        var hoten = document.getElementById("hoten").value.trim();
        var mail = document.getElementById("mail").value.trim();
        var dt = document.getElementById("sdt").value.trim();
        var mk = document.getElementById("mk").value.trim();
        var mkk = document.getElementById("mkk").value.trim();
        if (hoten == "") {
            document.getElementById("loihoten").innerText = " Vui lòng nhập họ tên";
        }
        if (mail == "") {
            document.getElementById("loimail").innerText = " Vui lòng nhập email";
        }
        if (dt == "") {
            document.getElementById("loisdt").innerText = " Vui lòng nhập số điện thoại";
        }
        if (mk == "") {
            document.getElementById("loimk").innerText = "Vui lòng nhập mật khẩu"
        } else {
            if (mk !== mkk && mkk == "") {
                document.getElementById("loimk").innerText = "Vui lòng nhập lại mật khẩu"
            } else if (mk !== "" && mk !== mkk) {
                document.getElementById("loimk").innerText = "Mật khẩu bạn vừa nhập không đúng"
            } else {
                document.getElementById("loimk").innerText = "";
            }
        }
        if (mkk == "") {
            document.getElementById("loimk").innerText = "Vui lòng nhập lại mật khẩu"
        } else {
            if (mkk !== mk && mk == "") {
                document.getElementById("loimk").innerText = "Vui lòng nhập lại mật khẩu"
            } else if (mkk !== "" && mk !== mkk) {
                document.getElementById("loimk").innerText = "Mật khẩu bạn vừa nhập không đúng";
            } else {
                document.getElementById("loimk").innerText = "";
            }
        }
        if (hoten == "" || mail == "" || dt == "" || mk == "" || mkk == ""|| mk !== mkk) {
            document.getElementById("loidk").innerText = "Đăng ký chưa thành công";
            document.getElementById("loidk").classList.remove('text-info');
            document.getElementById("loidk").classList.add('text-danger');
        } else {
            $.ajax({
                type: 'POST',
                url: 'xulydangky.php',
                data: {
                    name: hoten,
                    email: mail,
                    phone: dt,
                    pass: mk,
                },
                success: function(data) {
                    // alert(data); =>thông báo qua trang xulydangky nếu trang đó thành công
                    if (data == "Thành công") {
                        document.getElementById("loidk").innerText = "Đăng ký thành công";
                        document.getElementById("loidk").classList.remove('text-danger')
                        document.getElementById("loidk").classList.add('text-info');
                        setTimeout(function() {
                            window.location.href = "index.php";
                        }, 500);

                    }
                }
            })



        }
    });



    document.getElementById("form_dk").addEventListener("reset", function() {
        document.getElementById("hoten").innerText = "";
        document.getElementById("loihoten").innerText = "";
        document.getElementById("mail").innerText = "";
        document.getElementById("sdt").innerText = "";
        document.getElementById("mk").innerText = "";
        document.getElementById("loimail").innerText = "";
        document.getElementById("loisdt").innerText = "";
        document.getElementById("loimk").innerText = "";
    });
</script>

</html>