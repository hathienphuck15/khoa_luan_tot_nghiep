<?php
    // Hàm bắt đầu session	
    session_start();

    // Kết nối CSDL
    include_once(__DIR__ . "/Model/ketnoi.php");

    // Gọi hàm trong class của Model
    $p = new clsketnoi();
    $connect = $p->ketnoiDB($con);

    // Kiểm tra biến POST submit có tồn tại không
    if (isset($_POST['submit'])) {

        // Lấy thông tin khách hàng từ form thanh toán
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $total = $_POST['total'];
        $paymentMethod = $_POST['payment_method'];

        // Lấy thông tin khách hàng từ session
        if (isset($_SESSION['makh'])) {
            $user_id = $_SESSION['makh'];

            // Lấy thông tin khách hàng từ CSDL
            $query = "SELECT * FROM khachhang WHERE makh = $user_id";
            $result = mysqli_query($con, $query);
            $user = mysqli_fetch_array($result);
        }

        // Lấy ngẫu nhiên 1 nhân viên từ bảng nhanvien
        $query = "SELECT manv FROM nhanvien ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($con, $query);
        $nv = mysqli_fetch_array($result);
        $manv = $nv['manv'];

        // Tạo đối tượng hoá đơn mới
        $invoice = new stdClass();
        $invoice->makh = $user_id;
        $invoice->manv = $manv;
        $invoice->tenkhnew = $name;
        $invoice->emailnew = $user['email'];
        $invoice->diachinew = $address;
        $invoice->sodienthoainew = $phone;
        $invoice->tongtien = $total;
        $invoice->phuongthuctt = $paymentMethod;

        // Lấy thời gian và ngày, tháng, năm thời điểm hiện tại
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $invoice->ngaylap = date('Y-m-d H:i:s', time());
        
        $invoice->tinhtrangtt = 'Chưa thanh toán';
        $invoice->trangthai = 0;
        
        // Thêm hoá đơn vào CSDL
        $query = "INSERT INTO hoadon (makh, manv, tenkhnew, emailnew, diachinew, sodienthoainew, tongtien, phuongthuctt, ngaylap, tinhtrangtt, trangthai) VALUES ('$invoice->makh', '$invoice->manv', '$invoice->tenkhnew', '$invoice->emailnew', '$invoice->diachinew', '$invoice->sodienthoainew', '$invoice->tongtien', '$invoice->phuongthuctt', '$invoice->ngaylap', '$invoice->tinhtrangtt', '$invoice->trangthai')";
    
        if (mysqli_query($con, $query)) {

            // Lấy id hoá đơn mới được tạo
            $invoice_id = mysqli_insert_id($con);
        
            // Thêm thông tin sản phẩm vào bảng chitiethoadon
            foreach ($_SESSION["cart"] as $product_id => $quantity) {
                $product = mysqli_query($con, "SELECT * FROM `sanpham` WHERE `masp` = '$product_id'");
                $row = mysqli_fetch_assoc($product);
                
                $product_price = $row['giaban'];
                $query = "INSERT INTO chitiethoadon (mahd, masp, soluongban, giaban) VALUES ('$invoice_id', '$product_id', '$quantity', '$product_price')";
                mysqli_query($con, $query);
        
                // Cập nhật số lượng sản phẩm trong CSDL
                $quantity_sold = $row['soluong'] - $quantity;
                $query = "UPDATE sanpham SET soluong = $quantity_sold WHERE masp = '$product_id'";
                mysqli_query($con, $query);
            }
        
            // Hiển thị thông báo đặt hàng thành công
            echo '<script>alert("Chúng tôi sẽ sớm liên hệ với bạn để xác nhận đơn hàng. Xin cảm ơn.");</script>';
        
            // Xóa giỏ hàng
            unset($_SESSION['cart']);
        
            // Chuyển hướng về trang sản phẩm
            echo '<script>window.location.href="sanpham.php";</script>';
        }
    }    

    // Đóng kết nối CSDL
    mysqli_close($con);
?>

