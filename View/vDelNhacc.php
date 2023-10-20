<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cNhacc.php");

    // Kiểm tra biến REQUEST delete có tồn tại không
    if(isset($_REQUEST['delete'])) {

        // Khai báo biến
        $mancc = $_REQUEST['idsp'];

        // Gọi class Controller
        $p = new controlNhacungcap();

        // Gọi hàm xử lý xóa nhà cung cấp của Controller
        $del = $p->DeleteNhacungcap($mancc);

        // Xét điều kiện của biến đã gọi hàm
        if($del == 1) {
            echo '<script>alert("Xóa thông tin nhà cung cấp thành công.")</script>';
            echo header("refresh: 0; url='../quanly.php?nccap'");
        
        } elseif($del == 0) {
            echo '<script>alert("Xóa thông tin nhà cung cấp thất bại.")</script>';
            echo header("refresh: 0; url='../quanly.php?nccap'");
            
        } else {
            echo '<script>alert("Lỗi.")</script>';
            echo header("refresh: 0; url='../quanly.php?nccap'");
        }
    }
?>