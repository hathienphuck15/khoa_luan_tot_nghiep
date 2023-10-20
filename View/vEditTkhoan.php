<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cTkhoan.php");

    // Kiểm tra biến REQUEST edit có tồn tại không
    if(isset($_REQUEST['edit'])) {

        // Khai báo biến
        $tendn = $_REQUEST['tendn'];
        $tk = $_REQUEST['matk'];

        // Gọi class Controller
        $p = new controlTaikhoan();

        // Gọi hàm xử lý sửa tài khoản của Controller
        $kq = $p->EditTaikhoan($tendn, $tk);

        // Xét điều kiện của biến đã gọi hàm
        if($kq == 1) {
            echo '<script>alert("Sửa thông tin tài khoản thành công.")</script>';
            echo header("refresh: 0; url='../quanly.php?tkhoan'");

        } elseif($kq == 0) {
            echo '<script>alert("Sửa thông tin tài khoản thất bại.")</script>';
            echo header("refresh: 0; url='../quanly.php?tkhoan'");
        
        } else {
            echo '<script>alert("Lỗi.")</script>';
            echo header("refresh: 0; url='../quanly.php?tkhoan'");
        }
    }
?>

