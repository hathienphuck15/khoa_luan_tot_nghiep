<div class="data" style="margin-left: 5px;">

    <!-- Table dữ liệu -->
	<table class="table table-hover" style="width: 96%;">

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

            // Kiểm tra biến POST keyword có tồn tại không
            if(isset($_REQUEST['keyword'])) {

                // Khai báo biến
                $searchsp  = $_REQUEST['keyword'];

                // Gọi class Controller
                $p = new controlSanpham();

                // Dùng hàm xử lý tìm kiếm sản phẩm của Controller
                $kq = $p->SearchSanpham($searchsp);

                if($kq) {
                    if(mysqli_num_rows($kq) > 0) {
                        
                        // Xuất kết quả tìm kiếm sản phẩm theo vòng lặp
                        while($row = mysqli_fetch_assoc($kq)) {
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
                        echo '<script>
                            alert("Không tìm thấy dữ liệu.");
                            window.location.href="quanly.php?spham";
                        </script>';
                    }

                } else {
                    echo '<script>
                        alert("Lỗi.");
                        window.location.href="quanly.php?spham";
                    </script>';
                }
            }
        ?>
    </table>
</div>

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
</script>