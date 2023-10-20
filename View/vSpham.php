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
        <!-- Modal Form sửa sản phẩm -->
        <div class="modal" id="suamodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="margin-left: 85px; margin-top: 5px;">Sửa thông tin sản phẩm</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                    </div>

                    <!-- Form xử lý chức năng sửa sản phẩm -->
                    <form action="View/vEditSpham.php" method="POST">
                        
                        <!-- Body -->
                        <div class="modal-body">
                            <div class="mb-3" style="margin-top: -16px;">
                                <input type="hidden" class="form-control" id="masp" name="masp">
                            </div>

                            <div class="mb-3" style="margin-top: 20px;">
                                <label class="form-label" style=" font-weight:600;">Tên sản phẩm:</label>
                                <input type="text" class="form-control" id="tensp" placeholder="Nhập tên sản phẩm" name="tensp">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Nhà cung cấp:</label>

                                <!-- Lựa chọn nhà cung cấp -->
                                <select class="form-select" id="nhacungcap" name="nhacungcap">
                               
                                    <?php
                                        // Kết nối file Controller
                                        include_once(__DIR__ . "/../Controller/cNhacc.php");

                                        // Gọi class Controller
                                        $nhacungcap = new controlNhacungcap();

                                        // Gọi hàm cho hiện tất cả nhà cung cấp của Controller
                                        $tblcomp = $nhacungcap->getAllNhacungcap();

                                        // Xuất dữ liệu nhà cung cấp theo vòng lặp
                                        while($rows = mysqli_fetch_assoc($tblcomp)) {
                                            echo '<option value="'.$rows['mancc'].'">'.$rows['tenncc'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Danh mục:</label>

                                <!-- Lựa chọn danh mục -->
                                <select class="form-select" id="loaisp" name="loaisp">

                                    <?php
                                        // Kết nối file Controller
                                        include_once(__DIR__ . "/../Controller/cDmuc.php");
                                        
                                        // Gọi class Controller
                                        $danhmuc = new controlDanhmuc();

                                        // Gọi hàm cho hiện tất cả danh mục của Controller
                                        $tblloai = $danhmuc->getAllDanhmuc();
                                        
                                        // Xuất dữ liệu danh mục theo vòng lặp
                                        while($rows = mysqli_fetch_assoc( $tblloai)) {
                                            echo '<option value="'.$rows['maloai'].'">'.$rows['tenloai'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Tác giả:</label>
                                <input type="text" class="form-control" id="tacgia" placeholder="Nhập tên tác giả" name="tacgia">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Số lượng:</label>
                                <input type="number" class="form-control" id="soluong" placeholder="Nhập số lượng" name="soluong">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Giá bán:</label>
                                <input type="text" class="form-control" id="giaban" placeholder="Nhập giá bán" name="giaban">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Ngày xuất bản:</label>
                                <input type="date" class="form-control" id="ngayxuatban" name="ngayxuatban">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Hình ảnh:</label>
                                <input type="file" class="form-control" id="hinhanh" name="hinhanh">
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

        <!-- Modal Form xóa sản phẩm -->
        <div class="modal" id="xoamodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="margin-left: 88px; margin-top: 5px;">Xóa thông tin sản phẩm</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                    </div>
                    
                    <!-- Form xử lý chức năng xóa sản phẩm -->
                    <form action="View/vDelSpham.php" method="POST">

                        <!-- Body -->
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="msp" name="msp">

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

        <!-- Modal Form thêm sản phẩm -->
        <div class="modal" id="themmodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="margin-left: 80px; margin-top: 5px;">Thêm thông tin sản phẩm</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                    </div>
                    
                    <!-- Form xử lý chức năng thêm sản phẩm -->
                    <form action="View/vAddSpham.php" method="POST">

                        <!-- Body -->
                        <div class="modal-body">
                            <div class="mb-3" style="margin-top: -16px;">
                                <input type="hidden" class="form-control" id="idsp" name="idsp">
                            </div>

                            <div class="mb-3" style="margin-top: 20px;">
                                <label class="form-label" style=" font-weight:600;">Tên sản phẩm:</label>
                                <input type="text" class="form-control" id="tsp" placeholder="Nhập tên sản phẩm" name="tsp">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Nhà cung cấp:</label>

                                <!-- Lựa chọn nhà cung cấp -->
                                <select class="form-select" id="idncc" name="idncc">
                               
                                    <?php
                                        // Kết nối file Controller
                                        include_once(__DIR__ . "/../Controller/cNhacc.php");

                                        // Gọi class Controller
                                        $nhacungcap = new controlNhacungcap();

                                        // Gọi hàm cho hiện tất cả nhà cung cấp của Controller
                                        $tblcomp = $nhacungcap->getAllNhacungcap();
                                    
                                        // Xuất dữ liệu nhà cung cấp theo vòng lặp
                                        while($rows = mysqli_fetch_assoc($tblcomp)) {
                                            echo '<option value="'.$rows['mancc'].'">'.$rows['tenncc'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Danh mục:</label>

                                <!-- Lựa chọn danh mục -->
                                <select class="form-select" id="iddm" name="iddm">

                                    <?php
                                        // Kết nối file Controller
                                        include_once(__DIR__ . "/../Controller/cDmuc.php");
                                        
                                        // Gọi class Controller
                                        $danhmuc = new controlDanhmuc();

                                        // Gọi hàm cho hiện tất cả danh mục của Controller
                                        $tblloai = $danhmuc->getAllDanhmuc();
                                        
                                        // Xuất dữ liệu danh mục theo vòng lặp
                                        while($rows = mysqli_fetch_assoc( $tblloai)) {
                                            echo '<option value="'.$rows['maloai'].'">'.$rows['tenloai'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Tác giả:</label>
                                <input type="text" class="form-control" id="tg" placeholder="Nhập tên tác giả" name="tg">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Số lượng:</label>
                                <input type="number" class="form-control" id="sl" placeholder="Nhập số lượng" name="sl">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Giá bán:</label>
                                <input type="text" class="form-control" id="gb" placeholder="Nhập giá bán" name="gb">
                               
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Ngày xuất bản:</label>
                                <input type="date" class="form-control" id="nxb" name="nxb">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style=" font-weight:600;">Hình ảnh:</label>
                                <input type="file" class="form-control" id="hinh" name="hinh">
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
		<h1>Thông tin sản phẩm</h1>
               
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
        <div class="search" style="margin-left: 70px; margin-bottom: -50px;">
            <label class="form-label" style="font-weight:600; font-size: 18px;">Tìm kiếm:</label>
            <input type="text" class="form-control" placeholder="Nhập từ khóa..." id="searchsp" style="width: 15%; display: inline-flex; margin-left: 10px; border: 1px solid black;">
        </div>
        
        <!-- Nút thêm sản phẩm -->
        <div class="adddata" style="margin-left: 1220px; margin-bottom: -10px; margin-top: 10px;">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#themmodal" style="font-size: 18px;">Thêm sản phẩm</button>
        </div>
        
        <div class="data" style="margin-left: 60px; height: 1160px;" id="resultsp">

            <!-- Table dữ liệu -->
			<table class="table table-hover" style="width: 97%;">

                <!-- Tiêu đề table -->
				<thead style="font-family: 'Lora', serif;">
					<tr>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">ID</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Tên sản phẩm</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle; width: 12%;">Nhà cung cấp</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">Danh mục</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Tác giả</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle; width: 8%">Số lượng</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Giá bán</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle; width: 12%;">Ngày xuất bản</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle; width: 8%;">Hình ảnh</th>
						<th style="border-right: 3px solid #fff; vertical-align: middle;">Sửa</th>
						<th style="vertical-align: middle;">Xóa</th>
					</tr>
				</thead>

				<!-- Nội dung table -->
                <tbody>

				<?php
                        // Kết nối file Controller
                        include_once(__DIR__ . "/../Controller/cSpham.php");
                  
                        // Gọi class Controller
                        $p = new controlSanpham();
                     
                        // Dùng hàm cho hiện tất cả sản phẩm của Controller
                        $tblproduct = $p->getAllSanpham();
                        
                        if($tblproduct) {
                            if(mysqli_num_rows($tblproduct) > 0) {    
                        
                                // Xuất dữ liệu sản phẩm theo vòng lặp
                                while($row = mysqli_fetch_assoc($tblproduct)) {
                                    echo "<tr>";
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>".$row['masp']."</td>";
                                        echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>".$row['tensp']."</td>";
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>".$row['tenncc']."</td>";
                                        echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>".$row['tenloai']."</td>";
                                        echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>".$row['tacgia']."</td>";
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>".$row['soluong']."</td>";

                                        // Hàm number_format định dạng tiền tệ
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 11%;'>".number_format($row['giaban'], 0, ',', '.')." VNĐ</td>";

                                        // Hàm strtotime() sẽ chuyển đổi một chuỗi thời gian, hàm date() định dạng giá trị thời gian theo một định dạng cụ thể
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>".date('d/m/Y', strtotime($row['ngayxuatban']))."</td>";
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'><img width=80px height=90px src='Image/".$row['hinhanh']."'></td>";
                                        
                                        // Nút sửa sản phẩm
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 1%;'>
                                            <button type='button' class='btn btn-primary suabtn'>Sửa</button>
                                        </td>";
                    
                                        // Nút xóa sản phẩm
                                        echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 1%;'>
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
            // Sửa sản phẩm
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
                    console.log(data);

                    // Đặt giá trị phần tử đầu vào thành phần tử đầu tiên của mảng dữ liệu, được truy cập bằng chỉ mục
                    $('#masp').val(data[0]);
                    $('#tensp').val(data[1]);
                    
                    // Lấy giá trị cột từ mảng dữ liệu
                    var nhacc = data[2];
                    var danhmuc = data[3];

                    // Đặt giá trị của select là giá trị của cột nhà cung cấp
                    $("#nhacungcap option").filter(function() {
                    return $(this).text() === nhacc;
                    }).prop("selected", true);

                    // Đặt giá trị của select là giá trị của cột danh mục
                    $("#loaisp option").filter(function() {
                    return $(this).text() === danhmuc;
                    }).prop("selected", true);

                    $('#tacgia').val(data[4]);
                    $('#soluong').val(data[5]);
                   
                    // Chuỗi đại diện cho giá trị tiền tệ, chuyển đổi thành đồng Việt Nam và đặt giá trị phần tử đầu vào được chỉ định thành giá trị chuyển đổi đó
                    var giaBan = parseFloat(data[6].replace(/[^0-9.-]+/g, ""));
                    var giaBanVND = giaBan * 1000;
                    $('#giaban').val(giaBanVND);

                    // Định dạng thành chuỗi trong định dạng ISO và thiết lập giá trị phần tử đầu vào được chỉ định cho ngày định dạng ISO đó
                    var date_str = data[7];
                    var date_parts = date_str.split('/');
                    var iso_date = date_parts[2] + '-' + date_parts[1] + '-' + date_parts[0];
                    $('#ngayxuatban').val(iso_date);

                    // Kiểm tra các trường của Form
                    $('#suamodal form').submit(function(event) {

                        // Lấy giá trị của trường vào HTML và lưu trữ nó
                        var tensp = $('#tensp').val().trim();
                        var tacgia = $('#tacgia').val().trim();
                        var soluong = $('#soluong').val().trim();
                        var giaban = $('#giaban').val().trim();
                        var ngayxuatban = $('#ngayxuatban').val().trim();

                        // Kiểm tra tên sản phẩm
                        if (!tensp) {
                            alert('Chưa nhập tên sản phẩm.');
                            event.preventDefault();
                        }

                        // Kiểm tra tên tác giả
                        if (!tacgia) {
                            alert('Chưa nhập tên tác giả.');
                            event.preventDefault();
                        }

                        // Kiểm tra số lượng
                        if (!soluong) {
                            alert('Chưa nhập số lượng.');
                            event.preventDefault();
                        } else if (soluong < 0) {
                            alert('Không nhập số lượng âm.');
                            event.preventDefault();
                        }

                        // Kiểm tra giá bán bằng đệ quy
                        if (!giaban) {
                            alert('Chưa nhập giá bán.');
                            event.preventDefault();
                        } else if (giaban <= 0 || !/^\d+$/.test(giaban)) {
                            alert('Không nhập số âm, số 0, số thập phân và ký tự đặc biệt.');
                            event.preventDefault();
                        } else if (!/^\d+000$/.test(giaban)) {
                            alert('Giá bán phải kết thúc bằng 3 số 0.');
                            event.preventDefault();
                        }

                        // Kiểm tra ngày xuất bản
                        if (!ngayxuatban) {
                            alert('Chưa nhập ngày xuất bản.');
                            event.preventDefault();
                        }
                    });
                });
            });

            // Xóa sản phẩm
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
                    $('#msp').val(data[0]);
                });
            });

            // Thêm sản phẩm
            // Kiểm tra các trường của Form
            $('#themmodal form').submit(function(event) {

                // Lấy giá trị của trường vào HTML và lưu trữ nó
                var tensp = $('#tsp').val().trim();
                var tacgia = $('#tg').val().trim();
                var soluong = $('#sl').val().trim();
                var giaban = $('#gb').val().trim();
                var ngayxuatban = $('#nxb').val().trim();

                // Kiểm tra tên sản phẩm
                if (!tensp) {
                    alert('Chưa nhập tên sản phẩm.');
                    event.preventDefault();
                }

                // Kiểm tra tên tác giả
                if (!tacgia) {
                    alert('Chưa nhập tên tác giả.');
                    event.preventDefault();
                }

                // Kiểm tra số lượng
                if (!soluong) {
                    alert('Chưa nhập số lượng.');
                    event.preventDefault();
                } else if (soluong < 0) {
                    alert('Không nhập số lượng âm.');
                    event.preventDefault();
                }

                // Kiểm tra giá bán bằng đệ quy
                if (!giaban) {
                    alert('Chưa nhập giá bán.');
                    event.preventDefault();
                } else if (giaban <= 0 || !/^\d+$/.test(giaban)) {
                    alert('Không nhập số âm, số 0, số thập phân và ký tự đặc biệt.');
                    event.preventDefault();
                } else if (!/^\d+000$/.test(giaban)) {
                    alert('Giá bán phải kết thúc bằng 3 số 0.');
                    event.preventDefault();
                }

                // Kiểm tra ngày xuất bản
                if (!ngayxuatban) {
                    alert('Chưa nhập ngày xuất bản.');
                    event.preventDefault();
                }
            });

            // Tìm kiếm sản phẩm theo dạng live search 
            $(document).ready(function() {

                // Khi nhập từ khóa vào input
                $('#searchsp').on('input', function() {
                    var searchKeyword = $(this).val();

                    // Kiểm tra từ khóa có độ dài ký tự bằng 2 có nằm trong CSDL không
                    if (searchKeyword.length >= 2) {
                        $.ajax({
                        url: 'View/vSearchSpham.php',
                        type: 'POST',
                        data: {
                            keyword: searchKeyword
                        },
                        success: function(data) {
                            $('#resultsp').html(data);
                        }
                    });

                    // Ngược lại nếu không nhập hoặc xóa từ khóa sẽ hiện ra tất cả sản phẩm
                    } else {
                        $.ajax({
                            url: 'View/vSearchSpham.php',
                            type: 'POST',
                            data: {
                                keyword: ''
                            },
                            success: function(data) {
                                $('#resultsp').html(data);
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>


