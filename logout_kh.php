<?php
    // Hàm bắt đầu session
    session_start();

    // Kiểm tra session của biến tên đăng nhập có tồn tại hay không
    if(isset($_SESSION['tendn'])) {

        // Kiểm tra session của biến người dùng là khách hàng có tồn tại hay không
        if(isset($_SESSION['nguoidungkh']) == 'Khách hàng') {
            
            // Hủy biến session
            unset($_SESSION['tendn']);
            unset($_SESSION['nguoidungkh']);

            // Quay về trang đăng nhập của khách hàng
            echo '<script>window.location.href="login_kh.php";</script>';
        }
    }
?>

