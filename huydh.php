<?php 
    // Kết nối đến CSDL
    include_once(__DIR__ . "/Model/ketnoi.php");

    // Gọi hàm trong class của Model
    $p = new clsketnoi();
    $connect = $p->ketnoiDB($con);

    // Kiểm tra biến GET mahd có tồn tại không
    if (isset($_GET['mahd'])) {

        // Khai báo biến và giải mã hóa base64_decode biến GET
        $mahd  = base64_decode($_GET['mahd']);

        // Cập nhật vào cột trạng thái thuộc bảng hóa đơn
        $huydhang = "UPDATE hoadon SET trangthai = '4' WHERE mahd = '$mahd'";
        $kqhdh = mysqli_query($con, $huydhang);

        // Kiểm tra biến xử lý cập nhật cột trạng thái có tồn tại không
        if (isset($kqhdh)) {

            // Cập nhật cột số lượng trong bảng sản phẩm
            $upsl = "UPDATE sanpham SET soluong = soluong + (SELECT soluongban FROM chitiethoadon WHERE mahd = '$mahd' AND sanpham.masp = chitiethoadon.masp) WHERE masp IN (SELECT masp FROM chitiethoadon WHERE mahd = '$mahd')";
            $kqupsl = mysqli_query($con, $upsl);

            if(isset($kqupsl)) {
                echo '<script>
                    alert("Hủy đơn hàng thành công");
                    window.location.href="xemlsdh.php";
                </script>';
            }
        }
    }
?>