<?php
    // Kết nối file của Model
    include_once(__DIR__ . "/../Model/mNhacc.php");

    // Class Controller
    class controlNhacungcap {

        // Hàm cho hiện tất cả nhà cung cấp
        function getAllNhacungcap() {
            $p = new modelNhacungcap();
            $tblcomp = $p->SelectAllNhacungcap();
            return $tblcomp;
        }

        // Hàm cho hiện theo mã nhà cung cấp
        function getNhacungcap($ncc) {
            $p = new modelNhacungcap();
            $tblcomp = $p->SelectNhacungcap($ncc);
            return $tblcomp;
        }

        // Hàm xử lý thêm nhà cung cấp
        function AddNhacungcap($tenncc, $diachi, $sodienthoai, $email) {
            $p = new modelNhacungcap();
            $add = $p->InsertNhacungcap($tenncc, $diachi, $sodienthoai, $email);

            if($add) {
                return 1; // Thêm thành công
            } else {
                return 0; // Thêm thất bại
            }
        }

        // Hàm xử lý sửa nhà cung cấp
        function EditNhacungcap($tenncc, $diachi, $sodienthoai, $email, $ncc) {
            $p = new modelNhacungcap();
            $edit = $p->UpdateNhacungcap($tenncc, $diachi, $sodienthoai, $email, $ncc);

            if($edit) {
                return 1; // Sửa thành công
            } else {
                return 0; // Sửa thất bại
            }
        }

        // Hàm xử lý xóa nhà cung cấp
        function DeleteNhacungcap($mancc) {
            $p = new modelNhacungcap();
            $del = $p->DeleteNhacungcap($mancc);

            if($del) {
                return 1; // Xóa thành công
            } else {
                return 0; // Xóa thất bại
            }
        }

        // Hàm xử lý tìm kiếm nhà cung cấp
        function SearchNhacungcap($searchncc) {
            $p = new modelNhacungcap();
            $tblcomp = $p->SearchNhacungcap($searchncc);
            return $tblcomp;
        }
    }
?>