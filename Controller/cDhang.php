<?php
    // Kết nối file của Model
    include_once(__DIR__ . "/../Model/mDhang.php");

    // Class Controller
    class controlDonhang {

        // Hàm cho hiện tất cả hóa đơn
        function getAllDonhang() {
            $p = new modelDonhang();
            $tblorder = $p->SelectAllDonhang();
            return $tblorder;
        }

        // Hàm cho hiện theo mã hóa đơn
        function getDonhang($hd) {
            $p = new modelDonhang();
            $tblorder = $p->SelectDonhang($hd);
            return $tblorder;
        }

        // Hàm cho hiện theo mã khách hàng
        function getAllDonhangbyKhachhang($makh) {
            $p = new modelDonhang();
            $tblorder = $p->SelectAllDonhangbyKhachhang($makh);
            return $tblorder;
        }

        // Hàm cho hiện theo mã nhân viên
        function getAllDonhangbyNhanvien($manv) {
            $p = new modelDonhang();
            $tblorder = $p->SelectAllDonhangbyNhanvien($manv);
            return $tblorder;
        }

        // Hàm xử lý tìm kiếm hóa đơn
        function SearchDonhang($searchhd) {
            $p = new modelDonhang();
            $tblorder = $p->SearchDonhang($searchhd);
            return $tblorder;
        }

        // Hàm xử lý xác nhận đơn hàng
        function XacnhanDonhang($mahd) {
            $p = new modelDonhang();
            $tblorder = $p->XacnhanDonhang($mahd);
            return $tblorder;
        }

        // Hàm cho hiện tất cả hóa đơn của bảng chi tiết hóa đơn
        function getAllCTDonhang($mahd) {
            $p = new modelDonhang();
            $tblorder = $p->SelectAllCTDonhang($mahd);
            return $tblorder;
        }

        // Hàm xử lý xác nhận giao hàng
        function GiaohangDonhang($mahd) {
            $p = new modelDonhang();
            $tblorder = $p->GiaohangDonhang($mahd);
            return $tblorder;
        }

        // Hàm xử lý hoàn thành giao hàng
        function HoanthanhDonhang($mahd) {
            $p = new modelDonhang();
            $tblorder = $p->HoanthanhDonhang($mahd);
            return $tblorder;
        }
    }
?>