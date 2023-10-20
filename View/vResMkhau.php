<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cTkhoan.php");

    // Kiểm tra biến REQUEST restore có tồn tại không
    if(isset($_REQUEST['restore'])) {

        // Khai báo biến
        $matk = $_REQUEST['mtk'];

        // Gọi class Controller
        $p = new controlTaikhoan();

        // Gọi hàm xử lý khôi phục mật khẩu của Controller
        $reset = $p->KhoiphucTaikhoan($matk);

        // Xét điều kiện của biến đã gọi hàm
        if($reset == 1) {
            echo '<script>alert("Khôi phục mật khẩu thành công.")</script>';
            echo header("refresh: 0; url='../quanly.php?tkhoan'");
        
        } elseif($reset == 0) {
            echo '<script>alert("Khôi phục mật khẩu thất bại.")</script>';
            echo header("refresh: 0; url='../quanly.php?tkhoan'");
            
        } else {
            echo '<script>alert("Lỗi.")</script>';
            echo header("refresh: 0; url='../quanly.php?tkhoan'");
        }
    }
?>