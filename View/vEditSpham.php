<?php
    // Kết nối file Controller
    include_once(__DIR__ . "/../Controller/cSpham.php");

    // Kiểm tra biến REQUEST edit có tồn tại không
    if(isset($_REQUEST['edit'])) {

        // Khai báo biến
        $mancc = $_REQUEST['nhacungcap'];
        $maloai = $_REQUEST['loaisp'];
        $tensp = $_REQUEST['tensp'];
        $tacgia = $_REQUEST['tacgia'];
        $soluong = $_REQUEST['soluong'];
        $giaban = $_REQUEST['giaban'];
        $ngayxuatban = $_REQUEST['ngayxuatban'];
        $hinhanh = $_REQUEST['hinhanh'];
        $sp = $_REQUEST['masp'];

        // Kiểm tra xem mảng $ _FILES có phần tử hinhanh đại diện cho tệp được tải lên không. Nếu là đúng, tên tạm thời của tệp được tải lên gán cho $_FILES['hinhanh']['tmp_name']. Nếu không, biến file gán một chuỗi trống
        $file = isset($_FILES['hinhanh']['tmp_name']) ? $_FILES['hinhanh']['tmp_name'] : "";

        // Gán cho biến type bằng cách sử dụng $_FILES['hinhanh']['type'], nếu tệp hình ảnh tải lên và type, toán tử "?" gán giá trị $_FILES['hinhanh']['type'] cho biến type, nếu tệp hình ảnh chưa tải lên, toán tử : gán một chuỗi trống cho biến type
        $type = isset($_FILES['hinhanh']['type']) ? $_FILES['hinhanh']['type'] : "";

        // Gọi class Controller
        $p = new controlSanpham();

        // Gọi hàm xử lý sửa sản phẩm của Controller
        $kq = $p->EditSanpham($mancc, $maloai, $tensp, $tacgia, $soluong, $giaban, $ngayxuatban, $hinhanh, $type, $file, $sp);

        // Xét điều kiện của biến đã gọi hàm
        if($kq == 1) {
            echo '<script>alert("Sửa thông tin sản phẩm thành công.")</script>';
            echo header("refresh: 0; url='../quanly.php?spham'");

        } elseif($kq == 0) {
            echo '<script>alert("Sửa thông tin sản phẩm thất bại.")</script>';
            echo header("refresh: 0; url='../quanly.php?spham'");
        
        } else {
            echo '<script>alert("Lỗi.")</script>';
            echo header("refresh: 0; url='../quanly.php?spham'");
        }
    }
?>
