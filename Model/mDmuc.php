<?php
    // Kết nối CSDL
    include_once(__DIR__ . "/ketnoi.php");

    // Class Model
    class modelDanhmuc {

        // Hàm Select tất cả dữ liệu của loại sản phẩm
        function SelectAllDanhmuc() {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * FROM `loaisanpham` ORDER BY maloai ASC";
                $table = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false; 
            }
        }

        // Hàm Select theo mã loại sản phẩm
        function SelectDanhmuc($dm) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * FROM `loaisanpham` WHERE `maloai` = '$dm'";
                $table = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false; 
            }
        }

        // Hàm thêm loại sản phẩm
        function InsertDanhmuc($tenloai) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "INSERT INTO `loaisanpham` (`tenloai`) VALUES ('$tenloai')";
                $kq = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $kq;
            } else {
                return false; 
            }
        }

        // Hàm sửa loại sản phẩm
        function UpdateDanhmuc($tenloai, $dm) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "UPDATE `loaisanpham` SET `tenloai` = '$tenloai' WHERE `maloai` = '$dm'";
                $kq = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $kq;
            } else {
                return false; 
            }
        }

        // Hàm xóa loại sản phẩm
        function DeleteDanhmuc($maloai) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "DELETE FROM `loaisanpham` WHERE `maloai` = '$maloai'";
                $kq = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $kq;
            } else {
                return false; 
            }
        }

        // Hàm tìm kiếm loại sản phẩm
        function SearchDanhmuc($searchdm) {
            $p = new clsketnoi();
            if($p->ketnoiDB($con)) {
                $string = "SELECT * from loaisanpham WHERE tenloai LIKE '%$searchdm%' ORDER BY maloai ASC";
                $kq = mysqli_query($con, $string);
                $p->dongketnoi($con);
                return $kq;
            } else {
                return false; 
            }
        }
    }
?>