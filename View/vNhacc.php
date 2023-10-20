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
        <!-- Modal Form sửa nhà cung cấp -->
        <div class="modal" id="suamodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="margin-left: 65px; margin-top: 5px;">Sửa thông tin nhà cung cấp</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                    </div>

                    <!-- Form xử lý chức năng sửa nhà cung cấp -->
                    <form action="View/vEditNhacc.php" method="POST">
                        
                        <!-- Body -->
                        <div class="modal-body">
                            <div class="mb-3" style="margin-top: -16px;">
                                <input type="hidden" class="form-control" id="mancc" name="mancc">
                            </div>

                            <div class="mb-3" style="margin-top: 20px;">
                                <label class="form-label" style=" font-weight:600;">Tên nhà cung cấp:</label>
                                <input type="text" class="form-control" id="tenncc" placeholder="Nhập tên nhà cung cấp" name="tenncc">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Địa chỉ:</label>
                                <input type="text" class="form-control" id="diachi" placeholder="Nhập địa chỉ" name="diachi">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Phone:</label>
                                <input type="text" class="form-control" id="sodienthoai" placeholder="Nhập số điện thoại" name="sodienthoai"> 
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email">
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" name="edit">Xác nhận</button>
                            <input type="reset" class="btn btn-success" value="Reset">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Form xóa nhà cung cấp -->
        <div class="modal" id="xoamodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="margin-left: 65px; margin-top: 5px;">Xóa thông tin nhà cung cấp</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                    </div>
                    
                    <!-- Form xử lý chức năng xóa nhà cung cấp -->
                    <form action="View/vDelNhacc.php" method="POST">

                        <!-- Body -->
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="idsp" name="idsp">

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

        <!-- Modal Form thêm nhà cung cấp -->
        <div class="modal" id="themmodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="margin-left: 65px; margin-top: 5px;">Thêm thông tin nhà cung cấp</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                    </div>
                    
                    <!-- Form xử lý chức năng thêm nhà cung cấp -->
                    <form action="View/vAddNhacc.php" method="POST">

                        <!-- Body -->
                        <div class="modal-body">
                            <div class="mb-3" style="margin-top: 5px;">
                                <label class="form-label" style=" font-weight:600;">Tên nhà cung cấp:</label>
                                <input type="text" class="form-control" id="tncc" placeholder="Nhập tên nhà cung cấp" name="tncc"> 
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Địa chỉ:</label>
                                <input type="text" class="form-control" id="dc" placeholder="Nhập địa chỉ" name="dc">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Phone:</label>
                                <input type="text" class="form-control" id="sdt" placeholder="Nhập số điện thoại" name="sdt">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Email:</label>
                                <input type="email" class="form-control" id="mail" placeholder="Nhập email" name="mail">
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" name="add">Xác nhận</button>
                            <input type="reset" class="btn btn-success" value="Reset">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Hiển thị dữ liệu dạng table -->
        <!-- Tiêu đề -->
		<h1>Thông tin nhà cung cấp</h1>
               
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
        <div class="search" style="margin-left: 140px; margin-bottom: -50px;">
            <label class="form-label" style="font-weight:600; font-size: 18px;">Tìm kiếm:</label>
            <input type="text" class="form-control" placeholder="Nhập từ khóa..." id="searchncc" style="width: 15%; display: inline-flex; margin-left: 10px; border: 1px solid black;">
        </div>
        
        <!-- Nút thêm nhà cung cấp -->
        <div class="adddata" style="margin-left: 1138px; margin-bottom: -10px; margin-top: 10px;">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#themmodal" style="font-size: 18px;">Thêm nhà cung cấp</button>
        </div>
        
        <div class="data" style="margin-left: 135px;" id="resultncc">

            <!-- Table dữ liệu -->
			<table class="table table-hover">

                <!-- Tiêu đề table -->
				<thead style="font-family: 'Lora', serif;">
					<tr>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">ID</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Tên nhà cung cấp</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Địa chỉ</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Phone</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Email</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Sửa</th>
						<th style="vertical-align: middle;">Xóa</th>
					</tr>
				</thead>

				<!-- Nội dung table -->
                <tbody>

				<?php
                        // Kết nối file Controller
                        include_once(__DIR__ . "/../Controller/cNhacc.php");

                        // Gọi class Controller
                        $p = new controlNhacungcap();

                        // Dùng hàm cho hiện tất cả nhà cung cấp của Controller
                        $tblcomp = $p->getAllNhacungcap();

                        if($tblcomp) {
                            if(mysqli_num_rows($tblcomp) > 0) {    
                        
                                // Xuất dữ liệu nhà cung cấp theo vòng lặp
                                while($row = mysqli_fetch_assoc($tblcomp)) {
                                    echo "<tr>";
                                        echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>".$row['mancc']."</td>";
                                        echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>".$row['tenncc']."</td>";
                                        echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>".$row['diachi']."</td>";
                                        echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>".$row['sodienthoai']."</td>";
                                        echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>".$row['email']."</td>";

                                        // Nút sửa nhà cung cấp
                                        echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>
                                            <button type='button' class='btn btn-primary suabtn'>Sửa</button>
                                        </td>";
                    
                                        // Nút xóa nhà cung cấp
                                        echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>
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

        <!-- Link Javascript, Jquery -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <script>
            // Sửa nhà cung cấp
            $(document).ready(function() {

                // Bấm nút sửa
                $('.suabtn').on('click', function() {

                    // Hiện Modal Form
                    $('#suamodal').modal('show');

                    // Tìm phần tử hàng gần nhất với phần tử kích hoạt sự kiện và gán nó cho biến tr
                    $tr = $(this).closest('tr');

                    // Tạo ra mảng chuỗi chứa nội dung văn bản của mỗi phần tử ô bảng là con của phần tử hàng bảng gần nhất với phần tử đã kích hoạt sự kiện. Mỗi chuỗi trong mảng tương ứng với một cột duy nhất của hàng
                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    // Kiểm tra giá trị của biến dữ liệu
                    console.log(data)

                    // Đặt giá trị phần tử đầu vào thành phần tử đầu tiên của mảng dữ liệu, được truy cập bằng chỉ mục
                    $('#mancc').val(data[0]);
                    $('#tenncc').val(data[1]);
                    $('#diachi').val(data[2]);
                    $('#sodienthoai').val(data[3]);
                    $('#email').val(data[4]);

                    // Kiểm tra các trường của Form
                    $('#suamodal form').submit(function(event) {

                        // Lấy giá trị của trường vào HTML và lưu trữ nó
                        var tenncc = $('#tenncc').val().trim();
                        var diachi = $('#diachi').val().trim();
                        var sodienthoai = $('#sodienthoai').val().trim();
                        var email = $('#email').val().trim();

                        // Kiểm tra tên nhà cung cấp
                        if (!tenncc) {
                            alert('Chưa nhập tên nhà cung cấp.');
                            event.preventDefault();
                        }

                        // Kiểm tra địa chỉ
                        if (!diachi) {
                            alert('Chưa nhập địa chỉ.');
                            event.preventDefault();
                        }

                        // Kiểm tra số điện thoại
                        if (!sodienthoai) {
                            alert('Chưa nhập số điện thoại');
                            event.preventDefault();
                        } else if (sodienthoai.length != 10 || !/^\d+$/.test(sodienthoai)) {
                            alert('Số điện thoại không đúng định dạng.');
                            event.preventDefault();
                        }

                        // Kiểm tra email
                        if (!email) {
                            alert('Chưa nhập email.');
                            event.preventDefault();
                        } else if (!/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                            alert('Email không đúng định dạng.');
                            event.preventDefault();
                        }
                    });
                });
            });

            // Xóa nhà cung cấp
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
                    $('#idsp').val(data[0]);
                });
            });

            // Thêm nhà cung cấp
            // Kiểm tra các trường của Form
            $('#themmodal form').submit(function(event) {

                // Lấy giá trị của trường vào HTML và lưu trữ nó
                var tenncc = $('#tncc').val().trim();
                var diachi = $('#dc').val().trim();
                var sodienthoai = $('#sdt').val().trim();
                var email = $('#mail').val().trim();

                // Kiểm tra tên nhà cung cấp
                if (!tenncc) {
                    alert('Chưa nhập tên nhà cung cấp.');
                    event.preventDefault();
                }

                // Kiểm tra địa chỉ
                if (!diachi) {
                    alert('Chưa nhập địa chỉ.');
                    event.preventDefault();
                }

                // Kiểm tra số điện thoại
                if (!sodienthoai) {
                    alert('Chưa nhập số điện thoại');
                    event.preventDefault();
                } else if (sodienthoai.length != 10 || !/^\d+$/.test(sodienthoai)) {
                    alert('Số điện thoại không đúng định dạng.');
                    event.preventDefault();
                }

                // Kiểm tra email
                if (!email) {
                    alert('Chưa nhập email.');
                    event.preventDefault();
                } else if (!/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                    alert('Email không đúng định dạng.');
                    event.preventDefault();
                }
            });

            // Tìm kiếm nhà cung cấp theo dạng live search 
            $(document).ready(function() {

                // Khi nhập từ khóa vào input
                $('#searchncc').on('input', function() {
                    var searchKeyword = $(this).val();

                    // Kiểm tra từ khóa có độ dài ký tự bằng 2 có nằm trong CSDL không
                    if (searchKeyword.length >= 2) {
                        $.ajax({
                        url: 'View/vSearchNhacc.php',
                        type: 'POST',
                        data: {
                            keyword: searchKeyword
                        },
                        success: function(data) {
                            $('#resultncc').html(data);
                        }
                    });

                    // Ngược lại nếu không nhập hoặc xóa từ khóa sẽ hiện ra tất cả nhà cung cấp
                    } else {
                        $.ajax({
                            url: 'View/vSearchNhacc.php',
                            type: 'POST',
                            data: {
                                keyword: ''
                            },
                            success: function(data) {
                                $('#resultncc').html(data);
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>


