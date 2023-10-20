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
        <!-- Modal Form sửa loại sản phẩm -->
        <div class="modal" id="suamodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="margin-left: 65px; margin-top: 5px;">Sửa thông tin loại sản phẩm</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                    </div>

                    <!-- Form xử lý chức năng sửa loại sản phẩm -->
                    <form action="View/vEditDmuc.php" method="POST">
                        
                        <!-- Body -->
                        <div class="modal-body">
                            <div class="mb-3" style="margin-top: -16px;">
                                <input type="hidden" class="form-control" id="maloai" name="maloai">
                            </div>

                            <div class="mb-3" style="margin-top: 20px;">
                                <label class="form-label" style=" font-weight:600;">Tên loại sản phẩm:</label>
                                <input type="text" class="form-control" id="tenloai" placeholder="Nhập tên loại sản phẩm" name="tenloai">
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

        <!-- Modal Form xóa loại sản phẩm -->
        <div class="modal" id="xoamodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="margin-left: 65px; margin-top: 5px;">Xóa thông tin loại sản phẩm</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                    </div>
                    
                    <!-- Form xử lý chức năng xóa loại sản phẩm -->
                    <form action="View/vDelDmuc.php" method="POST">

                        <!-- Body -->
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="iddm" name="iddm">

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

        <!-- Modal Form thêm loại sản phẩm -->
        <div class="modal" id="themmodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="margin-left: 65px; margin-top: 5px;">Thêm thông tin loại sản phẩm</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                    </div>
                    
                    <!-- Form xử lý chức năng thêm loại sản phẩm -->
                    <form action="View/vAddDmuc.php" method="POST">

                        <!-- Body -->
                        <div class="modal-body">
                            <div class="mb-3" style="margin-top: 5px;">
                                <label class="form-label" style=" font-weight:600;">Tên loại sản phẩm:</label>
                                <input type="text" class="form-control" id="loaisp" placeholder="Nhập tên loại sản phẩm" name="loaisp"> 
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
		<h1>Thông tin loại sản phẩm</h1>
               
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
        <div class="search" style="margin-left: 300px; margin-bottom: -50px;">
            <label class="form-label" style="font-weight:600; font-size: 18px;">Tìm kiếm:</label>
            <input type="text" class="form-control" placeholder="Nhập từ khóa..." id="searchdm" style="width: 15%; display: inline-flex; margin-left: 10px; border: 1px solid black;">
        </div>
               
        <!-- Nút thêm loại sản phẩm -->
        <div class="adddata" style="margin-left: 860px; margin-bottom: -10px; margin-top: 10px;">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#themmodal" style="font-size: 18px;">Thêm loại sản phẩm</button>
        </div>
               
        <div class="data" style="margin-left: 300px;" id="resultdm">
       
            <!-- Table dữ liệu -->
            <table class="table table-hover" style="width: 211%;">
       
                <!-- Tiêu đề table -->
                <thead style="font-family: 'Lora', serif;">
                    <tr>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">ID</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">Tên loại sản phẩm</th>
                        <th style="border-right: 3px solid #fff; vertical-align: middle;">Sửa</th>
                        <th style="vertical-align: middle;">Xóa</th>
                    </tr>
                </thead>
       
                <!-- Nội dung table -->
                <tbody>
       
                <?php
                    // Kết nối file Controller
                    include_once(__DIR__ . "/../Controller/cDmuc.php");
       
                    // Gọi class Controller
                    $p = new controlDanhmuc();
       
                    // Dùng hàm cho hiện tất cả loại sản phẩm của Controller
                    $tblloai = $p->getAllDanhmuc();
       
                    if($tblloai) {
                        if(mysqli_num_rows($tblloai) > 0) {    
                               
                            // Xuất dữ liệu loại sản phẩm theo vòng lặp
                            while($row = mysqli_fetch_assoc($tblloai)) {
                                echo "<tr>";
                                    echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>".$row['maloai']."</td>";
                                    echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>".$row['tenloai']."</td>";
       
                                    // Nút sửa loại sản phẩm
                                    echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>
                                        <button type='button' class='btn btn-primary suabtn'>Sửa</button>
                                    </td>";
                           
                                    // Nút xóa loại sản phẩm
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
            // Sửa loại sản phẩm
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
                    $('#maloai').val(data[0]);
                    $('#tenloai').val(data[1]);
                });

                // Kiểm tra các trường của Form khi nút submit được bấm
                $('#suamodal form').submit(function(event) {

                    // Lấy giá trị của trường vào HTML và lưu trữ nó
                    var tenloai = $('#tenloai').val().trim();

                    // Kiểm tra tên loại sản phẩm
                    if (!tenloai) {
                        alert('Chưa nhập tên loại sản phẩm.');
                        event.preventDefault();
                    }
                });
            });

            // Xóa loại sản phẩm
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
                    $('#iddm').val(data[0]);
                });
            });

            // Thêm loại sản phẩm
            // Kiểm tra các trường của Form
            $('#themmodal form').submit(function(event) {

                // Lấy giá trị của trường vào HTML và lưu trữ nó
                var tenloai = $('#loaisp').val().trim();

                // Kiểm tra tên loại sản phẩm
                if (!tenloai) {
                    alert('Chưa nhập tên loại sản phẩm.');
                    event.preventDefault();
                }
            });

            // Tìm kiếm nhà cung cấp theo dạng live search 
            $(document).ready(function() {

            // Khi nhập từ khóa vào input
                $('#searchdm').on('input', function() {
                    var searchKeyword = $(this).val();

                    // Kiểm tra từ khóa có độ dài ký tự bằng 2 có nằm trong CSDL không
                    if (searchKeyword.length >= 2) {
                        $.ajax({
                            url: 'View/vSearchDmuc.php',
                            type: 'POST',
                            data: {
                                keyword: searchKeyword
                            },
                            success: function(data) {
                                $('#resultdm').html(data);
                            }
                        });

                    // Ngược lại nếu không nhập hoặc xóa từ khóa sẽ hiện ra tất cả danh mục
                    } else {
                        $.ajax({
                            url: 'View/vSearchDmuc.php',
                            type: 'POST',
                            data: {
                                keyword: ''
                            },
                            success: function(data) {
                                $('#resultdm').html(data);
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>