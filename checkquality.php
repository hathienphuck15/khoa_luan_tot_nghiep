<?php
    // Hàm bắt đầu session	
    session_start();

    // Kết nối CSDL
    include_once(__DIR__ . "/Model/ketnoi.php");

    // Gọi hàm trong class của Model
    $p = new clsketnoi();
    $connect = $p->ketnoiDB($con);

    // Kiểm tra biến POST cột số lượng có tồn tại không
    if(isset($_POST['soluong'])){
        // Gán khóa (key) đầu tiên trong mảng vào biến 
        $masp = (array_keys($_POST['soluong']))[0];

        // Giá trị của phần tử với khóa và biến trong mảng 
        $soluong = $_POST['soluong'][$masp];

        //Kiểm tra số lượng sản phẩm tồn kho
        $addProduct = mysqli_query($con, "SELECT `soluong` FROM `sanpham` WHERE `masp` = " . $masp);
        $addProduct = mysqli_fetch_assoc($addProduct);

        if(isset($_SESSION["cart"][$masp])){
            $soluong += $_SESSION["cart"][$masp];
        }

        // Kiểm tra số lượng nhập có lớn hơn số lượng tồn kho không
        if ($soluong > $addProduct['soluong']) {
            echo json_encode("Số lượng tồn kho không đủ, chỉ có thể mua tối đa: " .$addProduct['soluong']. " sản phẩm. Vui lòng kiểm tra lại giỏ hàng.");
        }else{
            echo json_encode(true);
        }
    }
?>