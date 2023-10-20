<?php
    // Kết nối CSDL
    include_once(__DIR__ . "/ketnoi.php");

    // Class Model
    class modelKhachhang {

        // Hàm Select tất cả dữ liệu của khách hàng
        function SelectAllKhachhang() {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * FROM khachhang kh JOIN taikhoan tk ON kh.matk = tk.matk ORDER BY makh ASC";
                $table = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false; 
            }
        }

        // Hàm Select theo mã khách hàng
        function SelectKhachhang($kh) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * FROM `khachhang` WHERE `makh` = '$kh'";
                $table = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false;
            }
        }

        // Hàm Select theo mã tài khoản
        function SelectAllKhachhangbyTaikhoan($matk) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * FROM `khachhang` WHERE `matk` = '$matk'";
                $table = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false;
            }
        }

        // Hàm xóa khách hàng
        function DeleteKhachhang($makh) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "DELETE FROM `khachhang` WHERE `makh` = '$makh'";
                $kq = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $kq;
            } else {
                return false; 
            }
        }

        // Hàm tìm kiếm khách hàng
        function SearchKhachhang($searchkh) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * FROM khachhang kh JOIN taikhoan tk ON kh.matk = tk.matk WHERE tenkh LIKE '%$searchkh%' OR diachi LIKE '%$searchkh%' OR email LIKE '%$searchkh%' OR tendn LIKE '%$searchkh%' ORDER BY makh ASC";
                $kq = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $kq;
            } else {
                return false; 
            }
        }
    }
?>