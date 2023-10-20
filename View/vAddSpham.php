<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cSpham.php");

    // Kiểm tra biến REQUEST add có tồn tại không
    if(isset($_REQUEST['add'])) {

        // Khai báo biến
        $mancc = $_REQUEST['idncc'];
        $maloai = $_REQUEST['iddm'];
        $tensp = $_REQUEST['tsp'];
        $tacgia = $_REQUEST['tg'];
        $soluong = $_REQUEST['sl'];
        $giaban = $_REQUEST['gb'];
        $ngayxuatban = $_REQUEST['nxb'];
        $hinhanh = $_REQUEST['hinh'];

        // Kiểm tra xem mảng $ _FILES có phần tử hinhanh đại diện cho tệp được tải lên không. Nếu là đúng, tên tạm thời của tệp được tải lên gán cho $_FILES['hinhanh']['tmp_name']. Nếu không, biến file gán một chuỗi trống
        $file = isset($_FILES['hinhanh']['tmp_name']) ? $_FILES['hinhanh']['tmp_name'] : "";

        // Gán cho biến type bằng cách sử dụng $_FILES['hinhanh']['type'], nếu tệp hình ảnh tải lên và type, toán tử "?" gán giá trị $_FILES['hinhanh']['type'] cho biến type, nếu tệp hình ảnh chưa tải lên, toán tử : gán một chuỗi trống cho biến type
        $type = isset($_FILES['hinhanh']['type']) ? $_FILES['hinhanh']['type'] : "";

        // Gọi class Controller
        $p = new controlSanpham();

        // Gọi hàm xử lý thêm sản phẩm của Controller
        $kq = $p->AddSanpham($mancc, $maloai, $tensp, $tacgia, $soluong, $giaban, $ngayxuatban, $hinhanh, $type, $file);

        // Xét điều kiện của biến đã gọi hàm
        if($kq == 1) {
            echo '<script>alert("Thêm thông tin sản phẩm thành công.")</script>';
            echo header("refresh: 0; url='../quanly.php?spham'");

        } elseif($kq == 0) {
            echo '<script>alert("Thêm thông tin sản phẩm thất bại.")</script>';
            echo header("refresh: 0; url='../quanly.php?spham'");

        } else {
            echo '<script>alert("Lỗi.")</script>';
            echo header("refresh: 0; url='../quanly.php?spham'");
        }
    }
?>