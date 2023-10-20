<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cNhacc.php");

    // Kiểm tra biến REQUEST edit có tồn tại không
    if(isset($_REQUEST['edit'])) {

        // Khai báo biến
        $tenncc = $_REQUEST['tenncc'];
        $diachi = $_REQUEST['diachi'];
        $sodienthoai = $_REQUEST['sodienthoai'];
        $email = $_REQUEST['email'];
        $ncc = $_REQUEST['mancc'];

        // Gọi class Controller
        $p = new controlNhacungcap();

        // Gọi hàm xử lý sửa nhà cung cấp của Controller
        $kq = $p->EditNhacungcap($tenncc, $diachi, $sodienthoai, $email, $ncc);

        // Xét điều kiện của biến đã gọi hàm
        if($kq == 1) {
            echo '<script>alert("Sửa thông tin nhà cung cấp thành công.")</script>';
            echo header("refresh: 0; url='../quanly.php?nccap'");

        } elseif($kq == 0) {
            echo '<script>alert("Sửa thông tin nhà cung cấp thất bại.")</script>';
            echo header("refresh: 0; url='../quanly.php?nccap'");
        
        } else {
            echo '<script>alert("Lỗi.")</script>';
            echo header("refresh: 0; url='../quanly.php?nccap'");
        }
    }
?>

