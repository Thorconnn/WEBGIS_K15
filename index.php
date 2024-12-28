<!DOCTYPE html>
<html lang="en">
<?php
if(isset($_COOKIE['taikhoan'])){
    header("Location: trangchu.php");

}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
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
                        <label for="" class="fw-bold mb-5">ĐĂNG NHẬP</label> <br>
                    </div>
                    <form action="#" id="form_dk">

                        <!-- Nhập email -->
                        <label for="">EMAIL</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                            <input type="search" class="form-control" placeholder="Nhập email" id="mail">
                        </div>
                        <div class="mb-3">
                            <span class="text-danger" id="loimail"></span>
                        </div>

                        <!-- Nhập mật khẩu -->
                        <label for="">PASSWORD</label><br>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Nhập mật khẩu" id="mk">
                        </div>
                        <div class="mb-3">
                            <span class="text-danger" id="loimk"></span>
                        </div>

                        <!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" -->

                        <!-- Nút điều khiển  -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-info  text-white fw-bold w-100 mb-1"> Đăng nhập</button>
                            <button type="reset" class="btn btn-info text-white w-100">Reset</button>
                        </div>
                        <div class="mb-3">
                            <span class="text-danger" id="loidk"></span>
                        </div>
                    </form>

                    <!-- Dòng hỏi  -->
                    <div class="col-12 text-center mb-4 text-white ">
                        <label for="">Bạn chưa có tài khoản? </label>
                        <a href="dangky.php"> Đăng ký</a>
                    </div>

                </div>
            </div>

            <div class="col-md-4"></div>
        </div>
    </div>
</body>

<script>
    document.getElementById("mail").addEventListener("blur", function() {
        var mail = document.getElementById("mail").value.trim();
        if (mail == "") {
            document.getElementById("loimail").innerText = " Vui lòng nhập email";
        } else {
            document.getElementById("loimail").innerText = "";
        }
    });


    // đoạn này làm cho mật khẩu
    document.getElementById("mk").addEventListener("blur", function() {
        var mk = document.getElementById("mk").value.trim();
        if (mk == "") {
            document.getElementById("loimk").innerText = "Vui lòng nhập mật khẩu"
        } else {
            document.getElementById("loimk").innerText = "";
        }
    });


    // đoạn này làm nút đăng ký
    document.getElementById("form_dk").addEventListener("submit", function(e) {
        e.preventDefault();
        // dừng không cho trang chạy đi tùm lum
        var mail = document.getElementById("mail").value.trim();
        var mk = document.getElementById("mk").value.trim();
        if (mail == "" || mk == "") {
            document.getElementById("loimail").innerText = " Vui lòng nhập email";
            document.getElementById("loimk").innerText = "Vui lòng nhập mật khẩu";
            document.getElementById("loidk").innerText = "Thông tin đăng nhập chưa hợp lệ";
        } else {
            document.getElementById("loidk").innerText = "";
            $.ajax({
                type: 'POST',
                url: 'xulydangnhap.php',
                data: {
                    email: mail,
                    pass: mk,
                },
                success: function(data) {
                    // alert(data);
                    // return false;
                    if (data == "Thành công") {
                        document.getElementById("loidk").innerText = "Đăng nhập thành công";
                        document.getElementById("loidk").classList.remove('text-danger')
                        document.getElementById("loidk").classList.add('text-info');
                        setTimeout(function() {window.location.href = "trangchu.php";}, 500);
                    } else {
                        document.getElementById("loidk").innerText = "Đăng nhập thất bại";
                        document.getElementById("loidk").classList.remove('text-info')
                        document.getElementById("loidk").classList.add('text-danger');
                    }
                }
            })
        }
    });



    document.getElementById("form_dk").addEventListener("reset", function() {
        document.getElementById("mail").innerText = "";
        document.getElementById("mk").innerText = "";
        document.getElementById("loimail").innerText = "";
        document.getElementById("loimk").innerText = "";
    });
</script>

</html>