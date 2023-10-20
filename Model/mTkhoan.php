<?php
    // Kết nối CSDL
    include_once(__DIR__ . "/ketnoi.php");

    // Class Model
    class modelTaikhoan {

        // Hàm Select tất cả dữ liệu của tài khoản
        function SelectAllTaikhoan() {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * FROM `taikhoan` ORDER BY matk ASC";
                $table = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false; 
            }
        }

        // Hàm Select theo mã tài khoản
        function SelectTaikhoan($tk) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * FROM `taikhoan` WHERE `matk` = '$tk'";
                $table = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false; 
            }
        }

        // Hàm sửa tài khoản
        function UpdateTaikhoan($tendn, $tk) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "UPDATE `taikhoan` SET `tendn` = '$tendn' WHERE `matk` = '$tk'";
                $kq = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $kq;
            } else {
                return false; 
            }
        }

        // Hàm xóa tài khoản
        function DeleteTaikhoan($matk) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "DELETE FROM `taikhoan` WHERE `matk` = '$matk'";
                $kq = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $kq;
            } else {
                return false; 
            }
        }

        // Hàm tìm kiếm tài khoản
        function SearchTaikhoan($searchtk) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * from taikhoan WHERE tendn LIKE '%$searchtk%' OR nguoidung LIKE '%$searchtk%' ORDER BY matk ASC";
                $kq = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $kq;
            } else {
                return false;
            }
        }

        // Hàm khôi phục mật khẩu
        function KhoiphucTaikhoan($matk) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string= "UPDATE `taikhoan` SET matkhau = '306ce8aa58eadd5a9a87e0f348907b59' WHERE `matk` = '$matk'";
                $table = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false;
            }
        }

        // Hàm khóa tài khoản
        function KhoaTaikhoan($matk) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string= "UPDATE `taikhoan` SET khoatk = '1' WHERE `matk` = '$matk'";
                $table = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false;
            }
        }

        // Hàm mở khóa tài khoản
        function MokhoaTaikhoan($matk) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string= "UPDATE `taikhoan` SET khoatk = '0' WHERE `matk` = '$matk'";
                $table = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false;
            }
        }
    }
?>