<div class="data" style="margin-left: 5px;">

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

            // Kiểm tra biến POST keyword có tồn tại không
            if(isset($_REQUEST['keyword'])) {

                // Khai báo biến
                $searchtk  = $_REQUEST['keyword'];

                // Gọi class Controller
                $p = new controlTaikhoan();

                // Dùng hàm xử lý tìm kiếm tài khoản của Controller
                $kq = $p->SearchTaikhoan($searchtk);

                if($kq) {
                    if(mysqli_num_rows($kq) > 0) {
                        
                        // Xuất kết quả tìm kiếm tài khoản theo vòng lặp
                        while($row = mysqli_fetch_assoc($kq)) {
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
                        echo '<script>
                            alert("Không tìm thấy dữ liệu.");
                            window.location.href="quanly.php?tkhoan";
                        </script>';
                    }

                } else {
                    echo '<script>
                        alert("Lỗi.");
                        window.location.href="quanly.php?tkhoan";
                    </script>';
                }
            }
        ?>
    </table>
</div>

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

                // Kiểm tra tài khoản
                if (!tendn) {
                    alert('Chưa nhập tài khoản.');
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
</script>