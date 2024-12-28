<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cập nhật</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <style>
    #form_dk {
      margin-top: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      box-shadow: none;
    }

    #alo {
      background: #02ffb3;
    }

    a {
      text-decoration: none;
      color: black;
    }

    .nutbam {
      align-items: center;
      width: 100%;
    }

    label {
      font-weight: bold;
      color: blue;
    }
  </style>
</head>

<body>

  <!-- Lấy thông tin(gid) bằng pp GET(đi nổi), đi chìm:POST; cách lấy ?gid='' -->
  <?php
  $gid = $_GET['gid'];
  $host = "localhost";
  $port = "5432";
  $user = "postgres";
  $db = "GIS_LAM";
  $pass = "25062003";
  $connect = pg_connect("host = $host port = $port user = $user dbname = $db password = $pass")
    or die("Kết nối thất bại");

  $sql = "SELECT * FROM tanchanhhiep WHERE gid = $gid";
  $query = pg_query($connect, $sql) or die("Truy vấn xảy ra lỗi");
  $row = pg_num_rows($query);
  if ($row > 0) {
    $ketqua = pg_fetch_all($query);
    $to_so = $ketqua[0]['to_so'];
    $gid = $ketqua[0]['gid'];
    $thua_so = $ketqua[0]['thua_so'];
    $loai_dat = $ketqua[0]['loai_dat'];
    $dien_tich = $ketqua[0]['dien_tich'];
  }

  $sql_loaidat = "SELECT loai_dat FROM tanchanhhiep GROUP BY loai_dat";
  $query_loaidat = pg_query($connect, $sql_loaidat);
  $row_loaidat = pg_num_rows($query_loaidat);
  if ($row_loaidat > 0) {
    $option = '';
    while ($loaidat = pg_fetch_array($query_loaidat)) {
      $option .= '<option value="' . $loaidat['loai_dat'] . '">' . $loaidat['loai_dat'] . '</option>';
    }
  }

  ?>

  <div class="container">
  <input type="number" min=0 class="d-none form-control mt-2" placeholder="Nhập tờ bản đồ số ..." id="gid" value="<?= $gid ?>">
    <form action="update.php" id="form_update">

      <div class="row">
        <div class="col-md-3 mt-3 text-nowrap">
          <label for="">SỐ TỜ</label>
          <input type="number" min=0 class="form-control mt-2" placeholder="Nhập tờ bản đồ số ..." id="to_so" value="<?= $to_so ?>">
          
        </div>

        <div class="col-md-3 mt-3 text-nowrap">
          <label for="">SỐ THỬA</label>
          <input type="number" min=0 class="form-control mt-2" placeholder="Nhập thửa đất số ..." id="thua_so" value="<?= $thua_so ?>">
        </div>


        <!-- nối danh sách vào php -->
        <div class="col-md-3 mt-3 text-nowrap">
          <label for="">LOẠI ĐẤT</label>
          <select class="form-select mt-2" id="loai_dat" value="<?= $loai_dat ?>">
            <option><?= $loai_dat ?></option>
            <?= $option ?>
          </select>
        </div>
        
        <div class="col-md-3 mt-3 text-nowrap">
          <label for="">DIỆN TÍCH</label>
          <input type="number" step=0.1 min=0 class="form-control mt-2" placeholder="Nhập loại đất" id="dien_tich" value="<?= $dien_tich ?>" disabled>
        </div>
      </div>

      <div class="nutbam btn-group mt-4">
        <button type="submit" class="btn btn-info" id="capnhat">Cập nhật</button>
        <button type="reset" class="btn btn-secondary">Đặt lại</button>
        <a class="btn btn-success" href="http://localhost/22_12_2024/trangchu.php">Trở lại</a>
        
      </div>

    </form>

    <span class="text-secondary fw-bold" id="thongbao"></span>
  </div>

</body>
<script>
  document.getElementById('form_update').addEventListener('submit', function(e) {
    e.preventDefault();
    document.getElementById('thongbao').textContent = 'Vui lòng chờ trong giây lát';
    var gid = document.getElementById('gid').value;
    var to_so = document.getElementById('to_so').value;
    var thua_so = document.getElementById('thua_so').value;
    var loai_dat = document.getElementById('loai_dat').value.trim().toUpperCase();
    var dien_tich = document.getElementById('dien_tich').value;
    $.ajax({
      type: 'POST',
      url: 'xulicapnhat.php',
      data: {
        gid: gid,
        to_so: to_so,
        thua_so: thua_so,
        loai_dat: loai_dat,
        dien_tich: dien_tich,
      },
      success: function(data) {
        if (data == 'success') {
          // đếm ngược thời gian
          var time = 5;
          var dem_nguoc = setInterval(function() {
            time--;
            document.getElementById('thongbao').textContent = 'Cập nhật thành công, chuyển hướng sau ' + time + 's';
            document.getElementById('thongbao').classList.add('text-success');
            if (time <= 0) {
              clearInterval(dem_nguoc);
              window.location.href = 'http://localhost/22_12_2024/trangchu.php';
            }
          }, 1000);
        } else {
          document.getElementById('thongbao').textContent = 'Cập nhật thất bại';
          document.getElementById('thongbao').classList.add('text-danger');
        }
      }
    })
  });
</script>

</html>