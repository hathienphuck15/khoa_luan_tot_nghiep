<div class="data" style="margin-left: 5px;">

    <!-- Table dữ liệu -->
	<table class="table table-hover">

        <!-- Tiêu đề table -->
		<thead style="font-family: 'Lora', serif;">
            <tr>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">ID</th>
				<th style="border-right: 3px solid #fff; vertical-align: middle;">Tài khoản</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Tên nhân viên</th>
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
            include_once(__DIR__ . "/../Controller/cNvien.php");

            // Kiểm tra biến POST keyword có tồn tại không
            if(isset($_REQUEST['keyword'])) {

                // Khai báo biến
                $searchnv  = $_REQUEST['keyword'];

                // Gọi class Controller
                $p = new controlNhanvien();

                // Dùng hàm xử lý tìm kiếm nhân viên của Controller
                $kq = $p->SearchNhanvien($searchnv);

                if($kq) {
                    if(mysqli_num_rows($kq) > 0) {
                        
                        // Xuất kết quả tìm kiếm nhân viên theo vòng lặp
                        while($row = mysqli_fetch_assoc($kq)) {
                            echo "<tr>";
                                echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>".$row['manv']."</td>";
                                echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black;'>".$row['tendn']."</td>";
                                echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>".$row['tennv']."</td>";
                                echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black;'>".$row['diachi']."</td>";
                                echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black;'>".$row['sodienthoai']."</td>";
                                echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>".$row['email']."</td>";
                                echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'><img width=80px height=90px src='Image/".$row['hinhanh']."'></td>";
                    
                                // Nút xóa nhân viên
                                echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>
                                    <button type='button' class='btn btn-danger xoabtn'>Xóa</button>
                                </td>";
                            echo "</tr>";
                        }
        echo "</tbody>";

                    } else {
                        echo '<script>
                            alert("Không tìm thấy dữ liệu.");
                            window.location.href="quanly.php?nvien";
                        </script>';
                    }

                } else {
                    echo '<script>
                        alert("Lỗi.");
                        window.location.href="quanly.php?nvien";
                    </script>';
                }
            }
        ?>
    </table>
</div>

<script>
    // Xóa nhân viên
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
            $('#manv').val(data[0]);
        });
    });
</script>