<?php
    // Kết nối file của Model
    include_once(__DIR__ . "/../Model/mKhang.php");

    // Class Controller
    class controlKhachhang {

        // Hàm cho hiện tất cả khách hàng
        function getAllKhachhang() {
            $p = new modelKhachhang();
            $tblcustomer = $p->SelectAllKhachhang();
            return $tblcustomer;
        }

        // Hàm cho hiện theo mã khách hàng
        function getKhachhang($kh) {
            $p = new modelKhachhang();
            $tblcustomer = $p->SelectKhachhang($kh);
            return $tblcustomer;
        }

        // Hàm cho hiện theo mã tài khoản
        function getAllKhachhangbyTaikhoan($matk) {
            $p = new modelKhachhang();
            $tblcustomer = $p->SelectAllKhachhangbyTaikhoan($matk);
            return $tblcustomer;
        }

        // Hàm xử lý xóa khách hàng
        function DeleteKhachhang($makh) {
            $p = new modelKhachhang();
            $del = $p->DeleteKhachhang($makh);

            if($del) {
                return 1; // Xóa thành công
            } else {
                return 0; // Xóa thất bại
            }
        }

        // Hàm xử lý tìm kiếm khách hàng
        function SearchKhachhang($searchkh) {
            $p = new modelKhachhang();
            $tblcustomer = $p->SearchKhachhang($searchkh);
            return $tblcustomer;
        }
    }
?>