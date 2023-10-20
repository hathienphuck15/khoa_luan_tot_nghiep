<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ITBOOK</title>

        <!-- Link CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
        <style>
            #order-detail-wrapper {
                width: 470px;
                margin: 50px auto;
                border: 4px solid #000;
                padding: 5px;
            }

            #order-detail {
                border: 1px solid #000;
                padding: 20px;
                line-height: 20px;
            }

            #order-detail ul {
                margin: 0;
                padding: 0;
            }

            #order-detail ul li {
                list-style: none;
            }

            #order-detail label {
                font-weight: bold;
            }
        </style>
    </head>

    <body style="font-family: 'Lora', serif;">
        <div id="order-detail-wrapper">
            <div id="order-detail">

                <!-- Tiêu đề -->
                <h1 style="text-align: center;">Thông tin hóa đơn</h1>

                <?php 
                    // Kết nối file Controller
                    include_once(__DIR__ . "/../Controller/cDhang.php");

                    // Gọi class Controller
                    $p = new controlDonhang();

                    // Kiểm tra biến GET mahd có tồn tại không
                    if(isset($_GET['mahd'])) {

                        // Khai báo biến và giải mã hóa base64_decode biến GET
                        $hd  = base64_decode($_GET['mahd']);
                     
                    // Dùng hàm cho hiện tất cả hóa đơn theo mã hóa đơn của Controller ra phiếu in đơn hàng
                    $tblorder = $p->getDonhang($hd);
                    $row = mysqli_fetch_assoc($tblorder);
                ?>

                <!-- Xuất dữ liệu hóa đơn theo mã -->
                <label>Người nhận:</label><span> <?php echo $row['tenkhnew']; ?></span><br>
                <label>Địa chỉ:</label><span> <?php echo $row['diachinew']; ?></span><br>
                <label>Điện thoại:</label><span> <?php echo $row['sodienthoainew']; ?></span><br>
                <label>Email:</label><span> <?php echo $row['emailnew']; ?></span><br>
                <label>Phương thức thanh toán: </label><span > <?php echo $row['phuongthuctt']; ?></span><br>
                <label>Nhân viên:</label><span> <?php echo $row['tennv']; ?></span><br>
                <label>Ngày lập:</label><span> <?php echo date('d/m/Y', strtotime($row['ngaylap'])); ?></span><br>

                <?php } ?>
                <hr>

                <!-- Tiêu đề -->
                <h3>Danh sách sản phẩm</h3>
                <ul>
                    <?php
                        // Kiểm tra biến GET mahd có tồn tại không
                        if(isset($_GET['mahd'])) {

                            // Khai báo biến và giải mã hóa base64_decode biến GET
                            $mahd  = base64_decode($_GET['mahd']);
                     
                            // Dùng hàm cho hiện tất cả hóa đơn của bảng chi tiết hóa đơn theo mã của Controller ra phiếu in đơn hàng
                            $tblorder = $p->getAllCTDonhang($mahd);

                            // Khai báo biến
                            $tongsl = 0;
                            $tongtien = 0;

                            // Xuất dữ liệu hóa đơn của bảng chi tiết hóa đơn theo mã theo vòng lặp
                            while($row = mysqli_fetch_assoc($tblorder)) {
                    ?>
                            <li>
                                <!-- Xuất tên sản phẩm và số lượng theo mã -->
                                <span><?php echo $row['tensp']; ?></span>
                                <span> - SL: <?php echo $row['soluongban']; ?> sản phẩm</span>
                            </li>
                    <?php
                            // Công thức tính tổng tiền
                            $tongtien += ($row['giaban'] * $row['soluongban']);

                            // Khai báo biến
                            $tongsl += $row['soluongban'];
                        }
                    ?>
                </ul>

                <hr>

                <!-- Xuất kết quả tổng sl và tổng tiền -->
                <label>Tổng SL:</label> <?php echo $tongsl; ?> - <label>Tổng tiền:</label> <?php echo number_format($tongtien, 0, ',', '.'); ?> VNĐ

                <?php } ?>
            </div>
        </div>

        <!-- Nút quay về -->
        <a href="../quanly.php?dhang" class="btn btn-warning" style="margin-left: 720px; margin-top: -40px; font-size: 20px;">Quay về</a>
        

        <!-- Link Javascript, Jquery-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>