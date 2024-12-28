<?php

    $host = "localhost";
    $port = "5432";
    $user = "postgres";
    $db = "GIS_LAM";   
    $pass = "25062003";


    $connect = pg_connect("host = $host port = $port user = $user dbname = $db password = $pass")
    or die ("Kết nối thất bại");

    $soto = $_POST['soto'];
    $sothua = $_POST['sothua'];
    $loaidat = $_POST['loaidat'];

    $where = "  WHERE 1=1";
    if(!empty($soto)){
      $where .= " AND to_so = $soto";
    }
    if(!empty($sothua)){
      $where .= " AND thua_so = $sothua";
    }
    if(!empty($loaidat)){
      $where .= " AND loai_dat ILIKE '$loaidat'";
    }

    if (!empty($soto) || !empty($sothua) || !empty($loaidat)) {
    $sql = "SELECT* FROM tanchanhhiep ". $where;
        // $loaidat la kí tự nên để trong nháy '' nếu đã có "" là của câu lệnh sql hoặc ngược lại

    // echo $sql;
    $query = pg_query($connect, $sql) or die ('không truy vấn được');
    $row = pg_num_rows($query);
    // echo $row;

    if ($row>0) {
        $stt = 0;
        // echo "có ".$row." kết quả!";

        // .= là nối trong php giữa 2 biến cùng tên
        $ketqua = '
        
         <table class="table table-hover">
    <thead>
      <tr>
        <th class ="text-nowrap">STT</th>
        <th class ="text-nowrap"></th>
        <th class ="text-nowrap">Số tờ</th>
        <th class ="text-nowrap">Số thửa</th>
        <th class ="text-nowrap">Diện tích</th>
        <th class ="text-nowrap">Loại đất</th>
        <th class ="text-nowrap">Ghi chú</th>
        <th class ="text-nowrap">Cập nhật</th>
      </tr>
    </thead>
    <tbody>';
     while($arr = pg_fetch_array($query)) {
        $stt++;                 //vào vòng lặp while sẽ chạy tiếp từ giá trị 0 được gán phía trên, ++ là mỗi lần công thêm 1
        $ketqua .= '<tr>
        
        <td>'.$stt.'</td>
        <td>
            <a href="javascript:;" onclick=vitrithuadat('.$arr['gid'].')>
              <i class="fa-solid fa-location-dot" style="color: #ee6868;"></i>
            </a>
        </td>
        <td class ="text-nowrap">'.$arr['to_so'].'</td>
        <td class ="text-nowrap">'.$arr['thua_so'].'</td>
        <td class ="text-nowrap">'.$arr['dien_tich'].' m<sup>2</sup></td>
        <td class ="text-nowrap">'.$arr['loai_dat'].'</td>
        <td class ="text-nowrap">....</td>
        <td class ="text-nowrap">
          <a href = "http://localhost/22_12_2024/update.php?gid='.$arr['gid'].'">
          <i class="fa-solid fa-pen-to-square"></i>
        </td>
      </tr>';
     }
    $ketqua .= '</tbody>
  </table>';
  echo $ketqua;
} else {
        echo "không có kết quả nào được tìm thấy";
    };
}
?>