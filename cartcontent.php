<?php 
    // Kết nối CSDL
    include_once(__DIR__ . "/Model/ketnoi.php");

    // Gọi hàm trong class của Model
    $p = new clsketnoi();
    $connect = $p->ketnoiDB($con);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ITBOOK</title>

        <!-- CSS phần nội dung giỏ hàng -->
        <style>
            body {
                font-family: 'Lora', serif;
            }

            * {
                box-sizing: border-box;
            }

            table{
                width: 1170px;
                margin-left: -17px;
    
            }

            table, th, td {
                border: 1px solid black;
            }

            td {
                text-align: center;
            }

            table .product-img img {
                max-width: 80px;
            }

            table .product-name {
                width: 200px;
                padding-left: 20px;
                color: black;
                font-size: 16px;
            }

            table .product-img {
                width: 120px;
                text-align: center;
            }

            table .product-number {
                width: 30px;
                text-align: center;
                color: black;
                font-size: 16px;
            }

            table .product-price {
                width: 100px;
                text-align: center;
                color: black;
                font-size: 16px;
                font-weight: bold;
            }

            table .product-quantity input {
                width: 40px;
                text-align: center;
            }

            table .product-quantity {
                width: 70px;
                text-align: center;
                color: black;
                font-size: 16px;
                font-weight: bold;
            }

            table .total-money {
                width: 100px;
                text-align: center;
                color: black;
                font-size: 16px;
                font-weight: bold;
            }

            .product-delete {
                width: 50px;
                text-align: center;
                font-size: 16px;
            }

            #row-total {
                background: #eee;
                color: #000;
            }

            .product-quantity {
                margin-top: 10px;
            }

            .product-delete a {
                display: block;
                padding: 0 10px;
                color: #ff7a5c;
                font-weight:bold;
                font-size:16px;
                border: 2px solid black;
                width: fit-content;
                margin-left: 40px;
            }

            .product-delete a:hover {
                background-color: #95adbe;
                color: #fff;
            }

            #order-cart-button {
                display: inline-block;
                border: 2px solid black;
                margin-top: 20px;
                margin-left: 510px;
                padding-left: 10px;
                padding-right: 10px;
            }

            #order-cart-button:hover {
                background-color: #95adbe;
            }

            #order-cart-button a {
                font-size: 16px;
                font-weight: bold;
                color: black;
                text-transform: none;
                text-align: center;
            }

            #order-cart-button a:hover {
                color: #fff;
            }
        </style>
    </head>

    <body>
        <h1 style="color: black; margin-left:478px;">Giỏ hàng</h1>

        <?php
            // Câu truy vấn SQL để lấy thông tin sản phẩm có mã nằm trong danh sách mã sản phẩm có trong giỏ hàng dùng implode để nối khóa của mảng lại thành một chuỗi
            if (!empty($_SESSION["cart"])) {
                $products = mysqli_query($con, "SELECT * FROM `sanpham` WHERE `masp` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
            }
        ?>

        <!-- Table hiển thị thông tin sản phẩm trong giỏ hàng -->
        <form id="cart-form" action="processcart.php?action=update" method="POST">
            <table style=" border: 2px solid black;">

                <!-- Tiêu đề table -->
                <tr style="color: black; text-align:center; vertical-align: middle;">
                    <th class="product-number">STT</th>
                    <th class="product-name">Tên sản phẩm</th>
                    <th class="product-name" style="width: 130px;">Tác giả</th>
                    <th class="product-img">Ảnh sản phẩm</th>
                    <th class="product-price">Đơn giá</th>
                    <th class="product-quantity">Số lượng</th>
                    <th class="total-money">Thành tiền</th>
                    <th class="product-delete">Xóa</th>
                </tr>

                <?php
                    // Kiểm tra biến products có bị trống không
                    if (!empty($products)) {

                        // Khai báo biến
                        $total = 0;
                        $dem = 1;

                        // Xuất sản phẩm thêm vào theo vòng lặp
                        while ($row = mysqli_fetch_array($products)) {
                ?>

                <!-- Nội dung table -->
                <tr>
                    <td class="product-number" style="vertical-align: middle;"><?php echo $dem++ ?></td>
                    <td class="product-name" style="text-align: left; vertical-align: middle;"><?= $row['tensp'] ?></td>
                    <td class="product-name" style="width: 130px; vertical-align: middle;"><?= $row['tacgia'] ?></td>
                    <td class="product-img" style="vertical-align: middle;"><img src="Image/<?php echo $row['hinhanh'] ?>" /></td>

                    <!-- Hàm number_format định dạng tiền tệ -->
                    <td class="product-price" style="vertical-align: middle;"><?php echo number_format($row['giaban'], 0, ',', '.'); ?> VNĐ</td>

                    <!-- Nhập số lượng cập nhật và xử lý chức năng cập nhật số lượng -->
                    <td class="product-quantity" style="vertical-align: middle;"><input oninput="javascript:updateQuantity(this.value)" type="text" value="<?php echo $_SESSION["cart"][$row['masp']] ?>" name="soluong[<?php echo $row['masp'] ?>]" /></td>
                    
                    <!-- Công thức tính cột thành tiền -->
                    <td class="total-money" style="vertical-align: middle;"><?php echo number_format($row['giaban'] * $_SESSION["cart"][$row['masp']], 0, ',', '.') ?> VNĐ</td>
                    
                    <!-- Nút xóa và xử lý chức năng xóa sản phẩm -->
                    <td class="product-delete" style="vertical-align: middle;"> 
                        <section class="wrap-button">
                            <section class="left-buy-button"></section>

                            <section class="content-buy-button">
                                <a href="javascript:deleteCart(<?php echo $row['masp'] ?>)">Xóa</a>
                            </section>

                            <section class="right-buy-button"></section>
                            <section class="clear-both"></section>
                        </section>
                    </td>             
                </tr>

                <?php
                    // Công thức tính tổng tiền
                    $total += $row['giaban'] * $_SESSION["cart"][$row['masp']];
                    }
                ?>

                <!-- Hiển thị phần tổng tiền -->
                <tr id="row-total" style="vertical-align: middle;">                            
                    <td colspan="2" class="product-name" style="font-weight:bold; font-size:16px; color:black;">Tổng tiền</td>
                    <td class="product-number">&nbsp;</td>
                    <td class="product-img">&nbsp;</td>
                    <td class="product-price">&nbsp;</td>
                    <td class="product-quantity">&nbsp;</td>
                    <td colspan="2" class="total-money" style="color: red;"><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</td>
                </tr>
                
                <?php } ?>
            </table>
             
            <!-- Nút mua hàng -->
            <section id="order-cart-button" class="wrap-button" >
                <section class="content-buy-button">
                    <a href="checkout.php">Mua hàng</a>
                </section>

                <section class="clear-both"></section>
            </section>
        </form>
    </body>
</html>