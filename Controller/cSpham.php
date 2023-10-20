<?php
    // Kết nối file của Model
    include_once(__DIR__ . "/../Model/mSpham.php");

    // Class Controller
    class controlSanpham {

        // Hàm cho hiện tất cả sản phẩm
        function getAllSanpham() {
            $p = new modelSanpham();
            $tblproduct = $p->SelectAllSanpham();
            return $tblproduct;
        }

        // Hàm cho hiện theo mã sản phẩm
        function getSanpham($sp) {
            $p = new modelSanpham();
            $tblproduct = $p->SelectSanpham($sp);
            return $tblproduct;
        }

        // Hàm cho hiện theo mã nhà cung cấp
        function getAllSanphambyNhacungcap($mancc){
            $p = new modelSanpham();
            $tblproduct = $p->SelectAllSanphambyNhacungcap($mancc);
            return $tblproduct;
        }

        // Hàm cho hiện theo mã loại sản phẩm
        function getAllSanphambyDanhmuc($maloai){
            $p = new modelSanpham();
            $tblproduct = $p->SelectAllSanphambyDanhmuc($maloai);
            return $tblproduct;
        }

        // Hàm xử lý thêm sản phẩm
        function AddSanpham($mancc, $maloai, $tensp, $tacgia, $soluong, $giaban, $ngayxuatban, $hinhanh, $type, $file) {

            // Kiểm tra hình ảnh
            if(empty($hinhanh)) {
                echo '<script>alert("Không upload hình ảnh.")</script>';
                echo header("refresh: 0; url='../quanly.php?spham'");
                return;
            }
                
            // Kiểm tra định dạng hình ảnh
            // Khai báo mảng
            $type = array('png', 'jpg', 'jpeg');

            // Sử dụng pathInfo với hằng số pathinfo_extension để lấy phần mở rộng tệp của biến và chuyển đổi nó thành chữ thường với strtolower
            $file = strtolower(pathinfo($hinhanh, PATHINFO_EXTENSION));

            // Kiểm tra 2 biến trong mảng
            if(!in_array($file, $type)) {
                echo '<script>alert("Upload hình ảnh không đúng định dạng.")</script>';
                echo header("refresh: 0; url='../quanly.php?spham'");
                return;
            }

            $p = new modelSanpham();
            $add = $p->InsertSanpham($mancc, $maloai, $tensp, $tacgia, $soluong, $giaban, $ngayxuatban, $hinhanh);

            if($add) {
                return 1; // Thêm thành công
            } else {
                return 0; // Thêm thất bại
            }
        }

        // Hàm xử lý sửa sản phẩm
        function EditSanpham($mancc, $maloai, $tensp, $tacgia, $soluong, $giaban, $ngayxuatban, $hinhanh, $type, $file, $sp) {
            // Kiểm tra hình ảnh
            if(empty($hinhanh)) {
                echo '<script>alert("Không upload hình ảnh.")</script>';
                echo header("refresh: 0; url='../quanly.php?spham'");
                return;
            }
                
            // Kiểm tra định dạng hình ảnh
            // Khai báo mảng
            $type = array('png', 'jpg', 'jpeg');

            // Sử dụng pathInfo với hằng số pathinfo_extension để lấy phần mở rộng tệp của biến và chuyển đổi nó thành chữ thường với strtolower
            $file = strtolower(pathinfo($hinhanh, PATHINFO_EXTENSION));

            // Kiểm tra 2 biến trong mảng
            if(!in_array($file, $type)) {
                echo '<script>alert("Upload hình ảnh không đúng định dạng.")</script>';
                echo header("refresh: 0; url='../quanly.php?spham'");
                return;
            }
             
            $p = new modelSanpham();
            $edit = $p->UpdateSanpham($mancc, $maloai, $tensp, $tacgia, $soluong, $giaban, $ngayxuatban, $hinhanh , $sp);

            if($edit) {
                return 1; // Sửa thành công
            } else {
                return 0; // Sửa thất bại
            }       
        }

        // Hàm xử lý xóa sản phẩm
        function DeleteSanpham($masp) {
            $p = new modelSanpham();
            $del = $p->DeleteSanpham($masp);

            if($del) {
                return 1; // Xóa thành công
            } else {
                return 0; // Xóa thất bại
            }
        }

        // Hàm xử lý tìm kiếm sản phẩm
        function SearchSanpham($searchsp) {
            $p = new modelSanpham();
            $tblproduct = $p->SearchSanpham($searchsp);
            return $tblproduct;
        }
    }
?>