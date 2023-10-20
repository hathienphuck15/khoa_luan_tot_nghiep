<?php
    // Kết nối CSDL
    include_once(__DIR__ . "/ketnoi.php");

    // Class Model
    class modelNhacungcap {

        // Hàm Select tất cả dữ liệu của nhà cung cấp
        function SelectAllNhacungcap() {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * FROM `nhacungcap` ORDER BY mancc ASC";
                $table = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false; 
            }
        }

        // Hàm Select theo mã nhà cung cấp
        function SelectNhacungcap($ncc) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * FROM `nhacungcap` WHERE `mancc` = '$ncc'";
                $table = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false; 
            }
        }

        // Hàm thêm nhà cung cấp
        function InsertNhacungcap($tenncc, $diachi, $sodienthoai, $email) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "INSERT INTO `nhacungcap`( `tenncc`, `diachi`, `sodienthoai`, `email`) VALUES('$tenncc', '$diachi', '$sodienthoai', '$email')";
                $kq = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $kq;
            } else {
                return false; 
            }
        }

        // Hàm sửa nhà cung cấp
        function UpdateNhacungcap($tenncc, $diachi, $sodienthoai, $email, $ncc) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "UPDATE `nhacungcap` SET `tenncc` = '$tenncc', `diachi`='$diachi', `sodienthoai`= '$sodienthoai', `email` = '$email' WHERE `mancc` = '$ncc'";
                $kq = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $kq;
            } else {
                return false; 
            }
        }

        // Hàm xóa nhà cung cấp
        function DeleteNhacungcap($mancc) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "DELETE FROM `nhacungcap` WHERE `mancc` = '$mancc'";
                $kq = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $kq;
            } else {
                return false; 
            }
        }

        // Hàm tìm kiếm nhà cung cấp
        function SearchNhacungcap($searchncc) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * from nhacungcap WHERE tenncc LIKE '%$searchncc%' OR diachi LIKE '%$searchncc%' OR sodienthoai LIKE '%$searchncc%' OR email LIKE '%$searchncc%' ORDER BY mancc ASC";
                $kq = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $kq;
            } else {
                return false; 
            }
        }
    }
?>