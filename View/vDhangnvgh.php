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
		<h1>Thông tin giao hàng</h1>
               
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
        
        <div class="data" style="margin-left: 45px;" id="resulthd">

            <!-- Table dữ liệu -->
			<table class="table table-hover" style="width: 97%;">

                <!-- Tiêu đề table -->
				<thead style="font-family: 'Lora', serif;">
					<tr>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">ID</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">Khách hàng</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">Địa chỉ</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Phone</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Email</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Tổng tiền</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">Hình thức</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">Tình trạng</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Trạng thái</th>
						<th style="vertical-align: middle;">Xem</th>
					</tr>
				</thead>

				<!-- Nội dung table -->
                <tbody>

				<?php
                    // Kết nối file Controller
                    include_once(__DIR__ . "/../Controller/cDhang.php");
                  
                    // Gọi class Controller
                    $p = new controlDonhang();
                     
                    // Dùng hàm cho hiện tất cả hóa đơn của Controller
                    $tblorder = $p->getAllDonhang();
                        
                    if($tblorder) {
                        if(mysqli_num_rows($tblorder) > 0) {    
                        
                            // Xuất dữ liệu hóa đơn theo vòng lặp
                            while($row = mysqli_fetch_assoc($tblorder)) {
                                echo "<tr>";
                                    echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>".$row['mahd']."</td>";
                                    echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 10%;'>".$row['tenkhnew']."</td>";
                                    echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>".$row['diachinew']."</td>";
                                    echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>".$row['sodienthoainew']."</td>";
                                    echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>".$row['emailnew']."</td>";

                                    // Hàm number_format định dạng tiền tệ
                                    echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 10%;'>".number_format($row['tongtien'], 0, ',', '.')." VNĐ</td>";
                                    echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 8%;'>".$row['phuongthuctt']."</td>";

                                    echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 9%; color: red; class='tinhtrangtt'>".$row['tinhtrangtt']."</td>";
                ?>

                                    <td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 10%;' class="trangthai">
                                    
                                        <?php
                                            //  Kiểm tra cột trạng thái xuất ra các trường hợp để nhân viên giao hàng cập nhật tình trạng đơn hàng
                                            if($row['trangthai'] == 0) {
                                                echo 'Chờ xác nhận';
                                            
                                            } elseif($row['trangthai'] == 1) {
                                                echo '<a class="btn btn-primary" href="View/vDeliDhang.php?mahd='.$row['mahd'].'">Giao hàng</a>';
                                            
                                            } elseif($row['trangthai'] == 2) {
                                                echo '<a class="btn btn-warning" href="View/vFinishDhang.php?mahd='.$row['mahd'].'">Hoàn thành</a>';
                                            
                                            } elseif($row['trangthai'] == 4) {
                                                echo 'Đã hủy';

                                            } else {
                                                echo 'Giao hàng thành công';
                                            }
                                        ?>
                                    </td>

                <?php
                                    // Nút xem chi tiết đơn hàng và mã hóa base64_encode cho biến row chứa dữ liệu cột mã hóa đơn
                                    echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'><a class='btn btn-success' href='quanly.php?xemdhang&mahd=".base64_encode($row['mahd'])."'>Xem</a></td>";
                                echo "</tr>";
                            }
    
                echo "</tbody>";
                
                        } else {
                            echo '<script>alert("Không có dữ liệu.")</script>';
                        }

                    } else {
                        echo '<script>alert("Lỗi.")</script>';
                    }
                ?>
			</table>
        </div>

        <!-- Link Javascript, Jquery-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </body>
</html>