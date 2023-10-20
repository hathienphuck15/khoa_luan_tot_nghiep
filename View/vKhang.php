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
        <!-- Modal Form xóa khách hàng -->
        <div class="modal" id="xoamodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="margin-left: 75px; margin-top: 5px;">Xóa thông tin khách hàng</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                    </div>
                    
                    <!-- Form xử lý chức năng xóa khách hàng -->
                    <form action="View/vDelKhang.php" method="POST">

                        <!-- Body -->
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="makh" name="makh">

                            <h3 class="modal-title" style="margin-left: 80px; font-family: 'Lora', serif; color: red; font-weight:600;">Bạn có muốn xóa không ?</h3>
                        </div>

                        <!-- Footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" name="delete">Đồng ý</button>
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Hủy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Hiển thị dữ liệu dạng table -->
        <!-- Tiêu đề -->
		<h1>Thông tin khách hàng</h1>
               
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

        <!-- Thanh tìm kiếm -->
        <div class="search" style="margin-left: 100px; margin-bottom: -10px;">
            <label class="form-label" style="font-weight:600; font-size: 18px;">Tìm kiếm:</label>
            <input type="text" class="form-control" placeholder="Nhập từ khóa..." id="searchkh" style="width: 15%; display: inline-flex; margin-left: 10px; border: 1px solid black;">
        </div>
        
        <div class="data" style="margin-left: 80px;" id="resultkh">

            <!-- Table dữ liệu -->
			<table class="table table-hover">

                <!-- Tiêu đề table -->
				<thead style="font-family: 'Lora', serif;">
					<tr>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">ID</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Tài khoản</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">Tên khách hàng</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">Địa chỉ</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Phone</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Email</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">Hình ảnh</th>
						<th style="vertical-align: middle;">Xóa</th>
					</tr>
				</thead>

				<!-- Nội dung table -->
                <tbody>

				<?php
                        // Kết nối file Controller
                        include_once(__DIR__ . "/../Controller/cKhang.php");
                  
                        // Gọi class Controller
                        $p = new controlKhachhang();
                     
                        // Dùng hàm cho hiện tất cả khách hàng của Controller
                        $tblcustomer = $p->getAllKhachhang();
                        
                        if($tblcustomer) {
                            if(mysqli_num_rows($tblcustomer) > 0) {    
                        
                                // Xuất dữ liệu khách hàng theo vòng lặp
                                while($row = mysqli_fetch_assoc($tblcustomer)) {
                                    echo "<tr>";
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>".$row['makh']."</td>";
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>".$row['tendn']."</td>";
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>".$row['tenkh']."</td>";
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>".$row['diachi']."</td>";
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>".$row['sodienthoai']."</td>";
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>".$row['email']."</td>";
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'><img width=80px height=90px src='Image/".$row['hinhanh']."'></td>";
                    
                                        // Nút xóa khách hàng
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>
                                            <button type='button' class='btn btn-danger xoabtn'>Xóa</button>
                                        </td>";
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

        <script>
            // Xóa khách hàng
            $(document).ready(function () {

                // Bấm nút xóa
                $('.xoabtn').on('click', function () {

                    // Hiện Modal Form
                    $('#xoamodal').modal('show');

                    // Tìm phần tử hàng gần nhất với phần tử kích hoạt sự kiện và gán nó cho biến tr
                    $tr = $(this).closest('tr');

                    // Tạo ra mảng chuỗi chứa nội dung văn bản của mỗi phần tử ô bảng là con của phần tử hàng bảng gần nhất với phần tử đã kích hoạt sự kiện. Mỗi chuỗi trong mảng tương ứng với một cột duy nhất của hàng
                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();

                    // Kiểm tra giá trị của biến dữ liệu
                    console.log(data);

                    // Đặt giá trị phần tử đầu vào thành phần tử đầu tiên của mảng dữ liệu, được truy cập bằng chỉ mục
                    $('#makh').val(data[0]);
                });
            });

            // Tìm kiếm khách hàng theo dạng live search 
            $(document).ready(function() {

                // Khi nhập từ khóa vào input
                $('#searchkh').on('input', function() {
                    var searchKeyword = $(this).val();

                    // Kiểm tra từ khóa có độ dài ký tự bằng 2 có nằm trong CSDL không
                    if (searchKeyword.length >= 2) {
                        $.ajax({
                        url: 'View/vSearchKhang.php',
                        type: 'POST',
                        data: {
                            keyword: searchKeyword
                        },
                        success: function(data) {
                            $('#resultkh').html(data);
                        }
                    });

                    // Ngược lại nếu không nhập hoặc xóa từ khóa sẽ hiện ra tất cả khách hàng
                    } else {
                        $.ajax({
                            url: 'View/vSearchKhang.php',
                            type: 'POST',
                            data: {
                                keyword: ''
                            },
                            success: function(data) {
                                $('#resultkh').html(data);
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>
