<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cTkhoan.php");

    // Kiểm tra biến GET matk có tồn tại không
    if(isset($_GET['matk'])) {

        // Khai báo biến
        $matk = $_GET['matk'];

        // Gọi class Controller
        $p = new controlTaikhoan();

        // Gọi hàm xử lý mở khóa tài khoản của Controller
        $tblaccount = $p->MokhoaTaikhoan($matk);
        
        // Quay về trang quản lý
        echo header("refresh: 0; url='../quanly.php?tkhoan'"); 
    }
?>
