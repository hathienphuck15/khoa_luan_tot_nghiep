<?php
    // Kết nối file của Model
    include_once(__DIR__ . "/../Model/mNvien.php");

    // Class Controller
    class controlNhanvien {

        // Hàm cho hiện tất cả nhân viên
        function getAllNhanvien() {
            $p = new modelNhanvien();
            $tblstaff = $p->SelectAllNhanvien();
            return $tblstaff;
        }

        // Hàm cho hiện theo mã nhân viên
        function getNhanvien($nv) {
            $p = new modelNhanvien();
            $tblstaff = $p->SelectNhanvien($nv);
            return $tblstaff;
        }

        // Hàm cho hiện theo mã tài khoản
        function getAllNhanvienbyTaikhoan($matk) {
            $p = new modelNhanvien();
            $tblstaff = $p->SelectAllNhanvienbyTaikhoan($matk);
            return $tblstaff;
        }

        // Hàm xử lý xóa nhân viên
        function DeleteNhanvien($manv) {
            $p = new modelNhanvien();
            $del = $p->DeleteNhanvien($manv);

            if($del) {
                return 1; // Xóa thành công
            } else {
                return 0; // Xóa thất bại
            }
        }

        // Hàm xử lý tìm kiếm nhân viên
        function SearchNhanvien($searchnv) {
            $p = new modelNhanvien();
            $tblstaff = $p->SearchNhanvien($searchnv);
            return $tblstaff;
        }
    }
?>