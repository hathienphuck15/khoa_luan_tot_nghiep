<?php
  // Kết nối file Controller
  include_once(__DIR__ . "/../Controller/cDhang.php");

  // Kiểm tra biến GET mahd có tồn tại không
  if(isset($_GET['mahd'])) {

    // Khai báo biến
    $mahd = $_GET['mahd'];

    // Gọi class Controller
    $p = new controlDonhang();

    // Gọi hàm xử lý xác nhận đơn hàng của Controller
    $tblorder = $p->XacnhanDonhang($mahd);
        
    // Quay về trang quản lý
    echo header("refresh: 0; url='../quanly.php?dhang'");
  }
?>
