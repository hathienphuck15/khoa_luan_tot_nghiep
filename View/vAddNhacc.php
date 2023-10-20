<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cNhacc.php");

    // Kiểm tra biến REQUEST add có tồn tại không
    if(isset($_REQUEST['add'])) {

        // Khai báo biến
        $tenncc = $_REQUEST['tncc'];
        $diachi = $_REQUEST['dc'];
        $sodienthoai = $_REQUEST['sdt'];
        $email = $_REQUEST['mail'];

        // Gọi class Controller
        $p = new controlNhacungcap();

        // Gọi hàm xử lý thêm nhà cung cấp của Controller
        $kq = $p->AddNhacungcap($tenncc, $diachi, $sodienthoai, $email);

        // Xét điều kiện của biến đã gọi hàm
        if($kq == 1) {
            echo '<script>alert("Thêm thông tin nhà cung cấp thành công.")</script>';
            echo header("refresh: 0; url='../quanly.php?nccap'");

        } elseif($kq == 0) {
            echo '<script>alert("Thêm thông tin nhà cung cấp thất bại.")</script>';
            echo header("refresh: 0; url='../quanly.php?nccap'");

        } else {
            echo '<script>alert("Lỗi.")</script>';
            echo header("refresh: 0; url='../quanly.php?nccap'");
        }
    }
?>