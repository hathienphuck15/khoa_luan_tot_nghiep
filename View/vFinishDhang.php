<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cDhang.php");

    // Kiểm tra biến GET mahd có tồn tại không
    if(isset($_GET['mahd'])) {

        // Khai báo biến
        $mahd = $_GET['mahd'];

        // Gọi class Controller
        $p = new controlDonhang();

        // Gọi hàm xử lý hoàn thành giao hàng của Controller
        $tblorder = $p->HoanthanhDonhang($mahd);
            
        // Quay về trang nhân viên giao hàng
        echo header("refresh: 0; url='../quanly.php?dhangnvgh'");
    }
?>
