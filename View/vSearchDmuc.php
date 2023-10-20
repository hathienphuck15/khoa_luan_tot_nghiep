<div class="data" style="margin-left: 3px;">

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

            // Kiểm tra biến POST keyword có tồn tại không
            if(isset($_REQUEST['keyword'])) {

                // Khai báo biến
                $searchdm  = $_REQUEST['keyword'];

                // Gọi class Controller
                $p = new controlDanhmuc();

                // Dùng hàm xử lý tìm kiếm loại sản phẩm của Controller
                $kq = $p->SearchDanhmuc($searchdm);

                if($kq) {
                    if(mysqli_num_rows($kq) > 0) {
                        
                        // Xuất kết quả tìm kiếm loại sản phẩm theo vòng lặp
                        while($row = mysqli_fetch_assoc($kq)) {
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
                        echo '<script>
                            alert("Không tìm thấy dữ liệu.");
                            window.location.href="quanly.php?dmuc";
                        </script>';
                    }

                } else {
                    echo '<script>
                        alert("Lỗi.");
                        window.location.href="quanly.php?dmuc";
                    </script>';
                }
            }
        ?>
    </table>
</div>

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
</script>
