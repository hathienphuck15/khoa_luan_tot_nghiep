<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cKhang.php");

    // Kiểm tra biến REQUEST delete có tồn tại không
    if(isset($_REQUEST['delete'])) {

        // Khai báo biến
        $makh = $_REQUEST['makh'];

        // Gọi class Controller
        $p = new controlKhachhang();

        // Gọi hàm xử lý xóa khách hàng của Controller
        $del = $p->DeleteKhachhang($makh);

        // Xét điều kiện của biến đã gọi hàm
        if($del == 1) {
            echo '<script>alert("Xóa thông tin khách hàng thành công.")</script>';
            echo header("refresh: 0; url='../quanly.php?khang'");
        
        } elseif($del == 0) {
            echo '<script>alert("Xóa thông tin khách hàng thất bại.")</script>';
            echo header("refresh: 0; url='../quanly.php?khang'");
            
        } else {
            echo '<script>alert("Lỗi.")</script>';
            echo header("refresh: 0; url='../quanly.php?khang'");
        }
    }
?>