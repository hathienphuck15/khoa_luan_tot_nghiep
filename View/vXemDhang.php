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

            /* Ẩn bảng table */
            .hidden-element {
                display: none;
            }
        </style>
    </head>

    <body>
        <!-- Hiển thị dữ liệu dạng table -->
        <!-- Tiêu đề -->
		<h1>Thông tin đơn hàng</h1>
               
        <div class="left">
            <hr>                
        </div>

        <div class="right">
            <hr>
        </div>

        <!-- Boxicons -->
        <div class="icon" style="margin-top: -31px; margin-left: 705px; font-size: 25px;">
            <i class='bx bxs-book-reader'></i>
        </div>
        
        <div class="data" style="margin-left: 330px;">

            <!-- Table dữ liệu -->
			<table class="table table-hover">

                <!-- Tiêu đề table -->
				<thead style="font-family: 'Lora', serif;">
					<tr>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">ID</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Tên sản phẩm</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">Số lượng</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">Giá bán</th>
						<th style="vertical-align: middle;">Thành tiền</th>
					</tr>
				</thead>

				<!-- Nội dung table -->
                <tbody>

				    <?php
                        // Kết nối file Controller
                        include_once(__DIR__ . "/../Controller/cDhang.php");

                        // Kiểm tra biến GET mahd có tồn tại không
                        if(isset($_GET['mahd'])) {

                            // Khai báo biến và giải mã hóa base64_decode biến GET
                            $mahd  = base64_decode($_GET['mahd']);

                            // Gọi class Controller
                            $p = new controlDonhang();
                            
                            // Dùng hàm cho hiện tất cả hóa đơn thuộc bảng chi tiết hóa đơn của Controller
                            $tblorder = $p->getAllCTDonhang($mahd);
                                
                            if($tblorder) {
                                if(mysqli_num_rows($tblorder) > 0) { 
                                    
                                    // Khai báo biến tổng tiền
                                    $tongtien = 0;
                                
                                    // Xuất dữ liệu hóa đơn của bảng chi tiết hóa đơn theo vòng lặp
                                    while($row = mysqli_fetch_assoc($tblorder)) {

                                        // Công thức tính cột thành tiền
                                        $thanhtien = $row['giaban']* $row['soluongban'];

                                        // Gán biến tổng tiền = biến thành tiền
                                        $tongtien += $thanhtien;

                                        echo "<tr>";
                                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>".$row['macthd']."</td>";
                                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>".$row['tensp']."</td>";
                                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>".$row['soluongban']."</td>";
                                            
                                            // Hàm number_format định dạng tiền tệ
                                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>".number_format($row['giaban'], 0, ',', '.')." VNĐ</td>";
                                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>".number_format($thanhtien, 0, ',', '.')." VNĐ</td>";
                                        echo "</tr>";
                                    }
    
                echo "</tbody>";

                                    // Cột tổng tiền
                                    echo "<td colspan='5' style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>";

                                        // Hàm number_format định dạng tiền tệ
                                        echo "<p style='color: red; font-weight: 600; margin-bottom: 5px; margin-left: 510px;'>Tổng tiền: ".number_format($tongtien, 0, ',', '.')." VNĐ</p>";
                                    echo "</td>";
                
                                } else {
                                    echo '<script>alert("Không có dữ liệu.")</script>';
                                }

                            } else {
                                echo '<script>alert("Lỗi.")</script>';
                            }
                        }
                    ?>
			</table>

            <!-- Nút quay về -->
            <?php
                // Kiểm tra quyền là quản lý hoặc nhân viên bán hàng
                if($_SESSION['nguoidung'] == 'Quản lý' || $_SESSION['nguoidung'] == 'Nhân viên bán hàng') {
            ?>

                    <!-- Quay về trang nhân viên bán hàng, quản lý -->
                    <a href="quanly.php?dhang" class="btn btn-warning" style="margin-left: 340px; font-size: 18px;">Quay về</a>

            <?php } else { ?>

                    <!-- Quay về trang nhân viên giao hàng -->
                    <a href="quanly.php?dhangnvgh" class="btn btn-warning" style="margin-left: 340px; font-size: 18px;">Quay về</a>
            <?php } ?>
        </div>

        <!-- Link Javascript, Jquery-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>