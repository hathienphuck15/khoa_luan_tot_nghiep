<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cDmuc.php");

    // Kiểm tra biến REQUEST edit có tồn tại không
    if(isset($_REQUEST['edit'])) {

        // Khai báo biến
        $tenloai = $_REQUEST['tenloai'];
        $dm = $_REQUEST['maloai'];

        // Gọi class Controller
        $p = new controlDanhmuc();

        // Gọi hàm xử lý sửa nhà cung cấp của Controller
        $kq = $p->EditDanhmuc($tenloai, $dm);

        // Xét điều kiện của biến đã gọi hàm
        if($kq == 1) {
            echo '<script>alert("Sửa thông tin loại sản phẩm thành công.")</script>';
            echo header("refresh: 0; url='../quanly.php?dmuc'");

        } elseif($kq == 0) {
            echo '<script>alert("Sửa thông tin loại sản phẩm thất bại.")</script>';
            echo header("refresh: 0; url='../quanly.php?dmuc'");
        
        } else {
            echo '<script>alert("Lỗi.")</script>';
            echo header("refresh: 0; url='../quanly.php?dmuc'");
        }
    }
?>

