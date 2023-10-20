<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cSpham.php");

    // Kiểm tra biến REQUEST delete có tồn tại không
    if(isset($_REQUEST['delete'])) {

        // Khai báo biến
        $masp = $_REQUEST['msp'];

        // Gọi class Controller
        $p = new controlSanpham();

        // Gọi hàm xử lý xóa nhà cung cấp của Controller
        $del = $p->DeleteSanpham($masp);

        // Xét điều kiện của biến đã gọi hàm
        if($del == 1) {
            echo '<script>alert("Xóa thông tin sản phẩm thành công.")</script>';
            echo header("refresh: 0; url='../quanly.php?spham'");
        
        } elseif($del == 0) {
            echo '<script>alert("Xóa thông tin sản phẩm thất bại.")</script>';
            echo header("refresh: 0; url='../quanly.php?spham'");
            
        } else {
            echo '<script>alert("Lỗi.")</script>';
            echo header("refresh: 0; url='../quanly.php?spham'");
        }
    }
?>