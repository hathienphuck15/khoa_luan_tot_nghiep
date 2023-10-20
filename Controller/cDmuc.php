<?php
    // Kết nối file của Model
    include_once(__DIR__ . "/../Model/mDmuc.php");

    // Class Controller
    class controlDanhmuc {

        // Hàm cho hiện tất cả loại sản phẩm
        function getAllDanhmuc() {
            $p = new modelDanhmuc();
            $tblloai = $p->SelectAllDanhmuc();
            return $tblloai;
        }

        // Hàm cho hiện theo mã loại sản phẩm
        function getDanhmuc($dm) {
            $p = new modelDanhmuc();
            $tblloai = $p->SelectDanhmuc($dm);
            return $tblloai;
        }

        // Hàm xử lý thêm loại sản phẩm
        function AddDanhmuc($tenloai) {
            $p = new modelDanhmuc();
            $add = $p->InsertDanhmuc($tenloai);

            if($add) {
                return 1; // Thêm thành công
            } else {
                return 0; // Thêm thất bại
            }
        }

        // Hàm xử lý sửa loại sản phẩm
        function EditDanhmuc($tenloai, $dm) {
            $p = new modelDanhmuc();
            $edit = $p->UpdateDanhmuc($tenloai, $dm);

            if($edit) {
                return 1; // Sửa thành công
            } else {
                return 0; // Sửa thất bại
            }
        }

        // Hàm xử lý xóa loại sản phẩm
        function DeleteDanhmuc($maloai) {
            $p = new modelDanhmuc();
            $del = $p->DeleteDanhmuc($maloai);

            if($del) {
                return 1; // Xóa thành công
            } else {
                return 0; // Xóa thất bại
            }
        }

        // Hàm xử lý tìm kiếm loại sản phẩm
        function SearchDanhmuc($searchdm) {
            $p = new modelDanhmuc();
            $tblloai = $p->SearchDanhmuc($searchdm);
            return $tblloai;
        }
    }
?>