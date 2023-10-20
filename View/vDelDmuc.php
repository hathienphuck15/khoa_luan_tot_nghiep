<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cDmuc.php");

    // Kiểm tra biến REQUEST delete có tồn tại không
    if(isset($_REQUEST['delete'])) {

        // Khai báo biến
        $maloai = $_REQUEST['iddm'];

        // Gọi class Controller
        $p = new controlDanhmuc();

        // Gọi hàm xử lý xóa loại sản phẩm của Controller
        $del = $p->DeleteDanhmuc($maloai);

        // Xét điều kiện của biến đã gọi hàm
        if($del == 1) {
            echo '<script>alert("Xóa thông tin loại sản phẩm thành công.")</script>';
            echo header("refresh: 0; url='../quanly.php?dmuc'");
        
        } elseif($del == 0) {
            echo '<script>alert("Xóa thông tin loại sản phẩm thất bại.")</script>';
            echo header("refresh: 0; url='../quanly.php?dmuc'");

        } else {
            echo '<script>alert("Lỗi.")</script>';
            echo header("refresh: 0; url='../quanly.php?dmuc'");
        }
    }
?>