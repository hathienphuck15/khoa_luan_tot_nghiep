<div class="data" style="margin-left: 5px;">

    <!-- Table dữ liệu -->
	<table class="table table-hover" style="width: 104%;">

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

            // Kiểm tra biến POST keyword có tồn tại không
            if(isset($_REQUEST['keyword'])) {

                // Khai báo biến
                $searchncc  = $_REQUEST['keyword'];

                // Gọi class Controller
                $p = new controlNhacungcap();

                // Dùng hàm xử lý tìm kiếm nhà cung cấp của Controller
                $kq = $p->SearchNhacungcap($searchncc);

                if($kq) {
                    if(mysqli_num_rows($kq) > 0) {
                        
                        // Xuất kết quả tìm kiếm nhà cung cấp theo vòng lặp
                        while($row = mysqli_fetch_assoc($kq)) {
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
                        echo '<script>
                            alert("Không tìm thấy dữ liệu.");
                            window.location.href="quanly.php?nccap";
                        </script>';
                    }

                } else {
                    echo '<script>
                        alert("Lỗi.");
                        window.location.href="quanly.php?nccap";
                    </script>';
                }
            }
        ?>
    </table>
</div>

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
</script>