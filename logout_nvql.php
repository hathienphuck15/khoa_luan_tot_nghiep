<?php
    // Hàm bắt đầu session
    session_start();

    // Kiểm tra session của biến tên đăng nhập có tồn tại hay không
    if(isset($_SESSION['user_name'])) {

        // Kiểm tra session của biến người dùng là nhân viên, quản lý có tồn tại hay không
        if(isset($_SESSION['nguoidung']) == 'Nhân viên giao hàng' || isset($_SESSION['nguoidung']) == 'Nhân viên bán hàng' || isset($_SESSION['nguoidung']) == 'Quản lý') {
            
            // Hủy biến session
            unset($_SESSION['user_name']);
            unset($_SESSION['nguoidung']);

            // Quay về trang đăng nhập của nhân viên, quản lý
            echo '<script>window.location.href="login_nvql.php";</script>';
        }
    }
?>