<?php
    // Kết nối CSDL
    include_once(__DIR__ . "/ketnoi.php");

    // Class Model
    class modelNhanvien {

        // Hàm Select tất cả dữ liệu của nhân viên
        function SelectAllNhanvien() {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * FROM nhanvien nv JOIN taikhoan tk ON nv.matk = tk.matk ORDER BY manv ASC";
                $table = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false; 
            }
        }

        // Hàm Select theo mã nhân viên
        function SelectNhanvien($nv) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * FROM `nhanvien` WHERE `manv` = '$nv'";
                $table = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false;
            }
        }

        // Hàm Select theo mã tài khoản
        function SelectAllNhanvienbyTaikhoan($matk) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * FROM `nhanvien` WHERE `matk` = '$matk'";
                $table = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false;
            }
        }

        // Hàm xóa nhân viên
        function DeleteNhanvien($manv) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "DELETE FROM `nhanvien` WHERE `manv` = '$manv'";
                $kq = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $kq;
            } else {
                return false; 
            }
        }

        // Hàm tìm kiếm nhân viên
        function SearchNhanvien($searchnv) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * FROM nhanvien nv JOIN taikhoan tk ON nv.matk = tk.matk WHERE tennv LIKE '%$searchnv%' OR diachi LIKE '%$searchnv%' OR email LIKE '%$searchnv%' OR tendn LIKE '%$searchnv%' ORDER BY manv ASC";
                $kq = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $kq;
            } else {
                return false; 
            }
        }
    }
?>