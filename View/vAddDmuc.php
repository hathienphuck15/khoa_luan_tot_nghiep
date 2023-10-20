<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cDmuc.php");

    // Kiểm tra biến REQUEST add có tồn tại không
    if(isset($_REQUEST['add'])) {

        // Khai báo biến
        $tenloai = $_REQUEST['loaisp'];

        // Gọi class Controller
        $p = new controlDanhmuc();

        // Gọi hàm xử lý thêm loại sản phẩm của Controller
        $kq = $p->AddDanhmuc($tenloai);

        // Xét điều kiện của biến đã gọi hàm
        if($kq == 1) {
            echo '<script>alert("Thêm thông tin loại sản phẩm thành công.")</script>';
            echo header("refresh: 0; url='../quanly.php?dmuc'");

        } elseif($kq == 0) {
            echo '<script>alert("Thêm thông tin loại sản phẩm thất bại.")</script>';
            echo header("refresh: 0; url='../quanly.php?dmuc'");

        } else {
            echo '<script>alert("Lỗi.")</script>';
            echo header("refresh: 0; url='../quanly.php?dmuc'");
        }
    }
?>