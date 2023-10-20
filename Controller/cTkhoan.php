<?php
    // Kết nối file của Model
    include_once(__DIR__ . "/../Model/mTkhoan.php");

    // Class Controller
    class controlTaikhoan {

        // Hàm cho hiện tất cả tài khoản
        function getAllTaikhoan() {
            $p = new modelTaikhoan();
            $tblaccount = $p->SelectAllTaikhoan();
            return $tblaccount;
        }

        // Hàm cho hiện theo mã tài khoản
        function getNhacungcap($tk) {
            $p = new modelTaikhoan();
            $tblaccount = $p->SelectTaikhoan($tk);
            return $tblaccount;
        }

        // Hàm xử lý sửa tài khoản
        function EditTaikhoan($tendn, $tk) {
            $p = new modelTaikhoan();
            $edit = $p->UpdateTaikhoan($tendn, $tk);

            if($edit) {
                return 1; // Sửa thành công
            } else {
                return 0; // Sửa thất bại
            }
        }

        // Hàm xử lý xóa tài khoản
        function DeleteTaikhoan($matk) {
            $p = new modelTaikhoan();
            $del = $p->DeleteTaikhoan($matk);

            if($del) {
                return 1; // Xóa thành công
            } else {
                return 0; // Xóa thất bại
            }
        }

        // Hàm xử lý tìm kiếm tài khoản
        function SearchTaikhoan($searchtk) {
            $p = new modelTaikhoan();
            $tblaccount = $p->SearchTaikhoan($searchtk);
            return $tblaccount;
        }

        // Hàm xử lý khôi phục mật khẩu
        function KhoiphucTaikhoan($matk) {
            $p = new modelTaikhoan();
            $reset = $p->KhoiphucTaikhoan($matk);

            if($reset) {
                return 1; // Khôi phục thành công
            } else {
                return 0; // Khôi phục thất bại
            }
        }

        // Hàm xử lý khóa tài khoản
        function KhoaTaikhoan($matk) {
            $p = new modelTaikhoan();
            $tblaccount = $p->KhoaTaikhoan($matk);
            return $tblaccount;
        }

        // Hàm xử lý mở khóa tài khoản
        function MokhoaTaikhoan($matk) {
            $p = new modelTaikhoan();
            $tblaccount = $p->MokhoaTaikhoan($matk);
            return $tblaccount;
        }
    }
?>