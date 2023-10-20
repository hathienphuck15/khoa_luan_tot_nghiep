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
        <!-- Modal Form sửa tài khoản -->
        <div class="modal" id="suamodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="margin-left: 90px; margin-top: 5px;">Sửa thông tin tài khoản</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                    </div>

                    <!-- Form xử lý chức năng sửa tài khoản -->
                    <form action="View/vEditTkhoan.php" method="POST">
                        
                        <!-- Body -->
                        <div class="modal-body">
                            <div class="mb-3" style="margin-top: -16px;">
                                <input type="hidden" class="form-control" id="matk" name="matk">
                            </div>

                            <div class="mb-3" style="margin-top: 20px;">
                                <label class="form-label" style=" font-weight:600;">Tài khoản:</label>
                                <input type="text" class="form-control" id="tendn" placeholder="Nhập tài khoản" name="tendn">
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

        <!-- Modal Form xóa tài khoản -->
        <div class="modal" id="xoamodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="margin-left: 90px; margin-top: 5px;">Xóa thông tin tài khoản</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                    </div>
                    
                    <!-- Form xử lý chức năng xóa tài khoản -->
                    <form action="View/vDelTkhoan.php" method="POST">

                        <!-- Body -->
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="idtk" name="idtk">

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

        <!-- Modal Form khôi phục mật khẩu -->
        <div class="modal" id="khoiphucmodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="margin-left: 115px; margin-top: 5px;">Khôi phục mật khẩu</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                    </div>
                    
                    <!-- Form xử lý chức năng khôi phục mật khẩu -->
                    <form action="View/vResMkhau.php" method="POST">

                        <!-- Body -->
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="mtk" name="mtk">

                            <h3 class="modal-title" style="margin-left: 50px; font-family: 'Lora', serif; color: red; font-weight:600;">Bạn có muốn khôi phục không ?</h3>
                        </div>

                        <!-- Footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" name="restore">Đồng ý</button>
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Hủy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Hiển thị dữ liệu dạng table -->
        <!-- Tiêu đề -->
		<h1>Thông tin tài khoản</h1>
               
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
        <div class="search" style="margin-left: 270px; margin-bottom: -10px;">
            <label class="form-label" style="font-weight:600; font-size: 18px;">Tìm kiếm:</label>
            <input type="text" class="form-control" placeholder="Nhập từ khóa..." id="searchtk" style="width: 15%; display: inline-flex; margin-left: 10px; border: 1px solid black;">
        </div>
        
        <div class="data" style="margin-left: 260px;" id="resulttk">

            <!-- Table dữ liệu -->
			<table class="table table-hover">

                <!-- Tiêu đề table -->
				<thead style="font-family: 'Lora', serif;">
					<tr>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">ID</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Tài khoản</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Người dùng</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Khóa tài khoản</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">Khôi phục mật khẩu</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Sửa</th>
						<th style="vertical-align: middle;">Xóa</th>
					</tr>
				</thead>

				<!-- Nội dung table -->
                <tbody>

				<?php
                        // Kết nối file Controller
                        include_once(__DIR__ . "/../Controller/cTkhoan.php");

                        // Gọi class Controller
                        $p = new controlTaikhoan();

                        // Dùng hàm cho hiện tất cả tài khoản của Controller
                        $tblaccount = $p->getAllTaikhoan();

                        if($tblaccount) {
                            if(mysqli_num_rows($tblaccount) > 0) {    
                        
                                // Xuất dữ liệu tài khoản theo vòng lặp
                                while($row = mysqli_fetch_assoc($tblaccount)) {
                                    echo "<tr>";
                                        echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>".$row['matk']."</td>";
                                        echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>".$row['tendn']."</td>";
                                        echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>".$row['nguoidung']."</td>";
                                    
                                        // Thiết lập quyền người dùng với chức năng trong quản lý tài khoản
                                        if($row['nguoidung'] == 'Nhân viên giao hàng' || $row['nguoidung'] == 'Nhân viên bán hàng') {
                                            
                                            // Nút khóa/mở tài khoản
                                            if($row['khoatk'] == 0) {
                                                echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>
                                                    <a class='btn btn-warning' href='View/vLocTkhoan.php?matk=".$row['matk']."'>Mở khóa</a>
                                                </td>";

                                            } else {
                                                echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>
                                                    <a class='btn btn-warning' href='View/vMoTkhoan.php?matk=".$row['matk']."'>Khóa</a>
                                                </td>";
                                            }

                                            // Nút khôi phục mật khẩu
                                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>
                                                <button type='button' class='btn btn-success khoiphucbtn'>Khôi phục</button>
                                            </td>";

                                            // Nút sửa tài khoản
                                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>
                                                <button type='button' class='btn btn-primary suabtn'>Sửa</button>
                                            </td>";

                                        } elseif($row['nguoidung'] == 'Quản lý' || $row['nguoidung'] == 'Khách hàng') {

                                            // Thông báo không có chức năng khóa tài khoản đối với khách hàng, quản lý
                                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>
                                                <p style='margin-top: 15px; color: red;'><b>Không</b></p>
                                            </td>";

                                            // Thông báo không có chức năng khôi phục mật khẩu đối với khách hàng, quản lý
                                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>
                                                <p style='margin-top: 15px; color: red;'><b>Không</b></p>
                                            </td>";
                                        }
                                        
                                        // Thiết lập quyền người dùng với chức năng trong quản lý tài khoản
                                        if($row['nguoidung'] == 'Quản lý') {

                                            // Nút sửa tài khoản
                                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>
                                                <button type='button' class='btn btn-primary suabtn'>Sửa</button>
                                            </td>";
                                        
                                        } elseif($row['nguoidung'] == 'Khách hàng') {

                                            // Thông báo không có chức năng sửa tài khoản đối với khách hàng
                                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>
                                                <p style='margin-top: 15px; color: red;'><b>Không</b></p>
                                            </td>";
                                        }
                    
                                        // Nút xóa tài khoản
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

        <!-- Link Javascript, Jquery-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <script>
            // Sửa tài khoản
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
                    $('#matk').val(data[0]);
                    $('#tendn').val(data[1]);

                    // Kiểm tra các trường của Form
                    $('#suamodal form').submit(function(event) {

                        // Lấy giá trị của trường vào HTML và lưu trữ nó
                        var tendn = $('#tendn').val().trim();

                        // Kiểm tra tài khoản và độ dài tài khoản
                        if (!tendn) {
                            alert('Chưa nhập tài khoản.');
                            event.preventDefault();

                        } else if (tendn.length < 5) {
                            alert('Tài khoản phải có ít nhất 5 ký tự.');
                            event.preventDefault();
                        }
                    });
                });
            });

            // Xóa tài khoản
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
                    $('#idtk').val(data[0]);
                });
            });

            // Khôi phục mật khẩu
            $(document).ready(function () {

                // Bấm nút khôi phục
                $('.khoiphucbtn').on('click', function () {

                    // Hiện Modal Form
                    $('#khoiphucmodal').modal('show');

                    // Tìm phần tử hàng gần nhất với phần tử kích hoạt sự kiện và gán nó cho biến tr
                    $tr = $(this).closest('tr');

                    // Tạo ra mảng chuỗi chứa nội dung văn bản của mỗi phần tử ô bảng là con của phần tử hàng bảng gần nhất với phần tử đã kích hoạt sự kiện. Mỗi chuỗi trong mảng tương ứng với một cột duy nhất của hàng
                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();

                    // Kiểm tra giá trị của biến dữ liệu
                    console.log(data);

                    // Đặt giá trị phần tử đầu vào thành phần tử đầu tiên của mảng dữ liệu, được truy cập bằng chỉ mục
                    $('#mtk').val(data[0]);
                });
            });

            // Tìm kiếm tài khoản theo dạng live search 
            $(document).ready(function() {

                // Khi nhập từ khóa vào input
                $('#searchtk').on('input', function() {
                    var searchKeyword = $(this).val();

                    // Kiểm tra từ khóa có độ dài ký tự bằng 2 có nằm trong CSDL không
                    if (searchKeyword.length >= 2) {
                        $.ajax({
                        url: 'View/vSearchTkhoan.php',
                        type: 'POST',
                        data: {
                            keyword: searchKeyword
                        },
                        success: function(data) {
                            $('#resulttk').html(data);
                        }
                    });

                    // Ngược lại nếu không nhập hoặc xóa từ khóa sẽ hiện ra tất cả tài khoản
                    } else {
                        $.ajax({
                            url: 'View/vSearchTkhoan.php',
                            type: 'POST',
                            data: {
                                keyword: ''
                            },
                            success: function(data) {
                                $('#resulttk').html(data);
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>


