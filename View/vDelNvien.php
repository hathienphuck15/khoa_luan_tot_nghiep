<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cNvien.php");

    // Kiểm tra biến REQUEST delete có tồn tại không
    if(isset($_REQUEST['delete'])) {

        // Khai báo biến
        $manv = $_REQUEST['manv'];

        // Gọi class Controller
        $p = new controlNhanvien();

        // Gọi hàm xử lý xóa nhân viên của Controller
        $del = $p->DeleteNhanvien($manv);

        // Xét điều kiện của biến đã gọi hàm
        if($del == 1) {
            echo '<script>alert("Xóa thông tin nhân viên thành công.")</script>';
            echo header("refresh: 0; url='../quanly.php?nvien'");
        
        } elseif($del == 0) {
            echo '<script>alert("Xóa thông tin nhân viên thất bại.")</script>';
            echo header("refresh: 0; url='../quanly.php?nvien'");
            
        } else {
            echo '<script>alert("Lỗi.")</script>';
            echo header("refresh: 0; url='../quanly.php?nvien'");
        }
    }
?>