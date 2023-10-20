<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cTkhoan.php");

    // Kiểm tra biến REQUEST delete có tồn tại không
    if(isset($_REQUEST['delete'])) {

        // Khai báo biến
        $matk = $_REQUEST['idtk'];

        // Gọi class Controller
        $p = new controlTaikhoan();

        // Gọi hàm xử lý xóa tài khoản của Controller
        $del = $p->DeleteTaikhoan($matk);

        // Xét điều kiện của biến đã gọi hàm
        if($del == 1) {
            echo '<script>alert("Xóa thông tin tài khoản thành công.")</script>';
            echo header("refresh: 0; url='../quanly.php?tkhoan'");
        
        } elseif($del == 0) {
            echo '<script>alert("Xóa thông tin tài khoản thất bại.")</script>';
            echo header("refresh: 0; url='../quanly.php?tkhoan'");
            
        } else {
            echo '<script>alert("Lỗi.")</script>';
            echo header("refresh: 0; url='../quanly.php?tkhoan'");
        }
    }
?>