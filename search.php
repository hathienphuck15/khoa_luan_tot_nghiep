<?php 
	// Hàm bắt đầu session
	session_start();

	// Kết nối CSDL
	include_once(__DIR__ . "/Model/ketnoi.php");

	// Gọi hàm trong class của Model
	$p = new clsketnoi();
	$connect = $p->ketnoiDB($con);
?>

<div class="container">
	<div class="row justify-content-center mb-4" >
        <div class="col-md-10" >
          	<div class="row mb-4" >

				<!-- Thanh lọc giá sản phẩm -->
				<div class="sort-buttons" style="margin-bottom: -10px; margin-left:-280px;">
					<h4>Lọc sản phẩm theo giá</h4>

					<!-- Truyền hàm Javascript xử lý lọc giá tăng dần, giảm dần vào 2 nút button -->
					<button onclick="sortAsc()">Giá từ thấp đến cao</button>
					<button onclick="sortDesc()">Giá từ cao đến thấp</button>
				</div>
			</div>
        </div>
    </div>
</div>

<div class="container-fluid px-md-5">
    <div class="row">

		<?php
			// Số sản phẩm trên một trang
			$items_per_page = 6;

			// Trang hiện tại
			$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

			// Tính vị trí bắt đầu của sản phẩm trong truy vấn SQL
			$start = ($current_page - 1) * $items_per_page;

			// Câu truy vấn SQL, lưu trữ thông tin về kết quả lọc vào biến session
			if (isset($_GET['sort'])) {
				$_SESSION['sort'] = $_GET['sort'];	
			}

			// Kiểm tra biến POST keyword có tồn tại không
			if(isset($_POST["keyword"])) {

				// real_escape_string là phương thức bảo vệ chống lại cuộc tấn công SQL Injection bằng cách mã hóa đầu vào người dùng để tránh lỗ hổng bảo mật
				$search  = $con->real_escape_string($_POST["keyword"]);

				// Khai báo biến và kiểm tra sự tồn tại của biến SESSION sort
				$sort_asc = isset($_SESSION['sort']) ? $_SESSION['sort'] : '';
				$sort = isset($_SESSION['sort']) ? $_SESSION['sort'] : '';

				// Tìm kiếm bằng văn bản kết hợp lọc danh mục, phân trang
				if ($sort_asc == 'asc') {
					$timkiem = "SELECT * FROM sanpham WHERE tensp LIKE '%$search%' OR maloai IN (SELECT maloai FROM loaisanpham WHERE tenloai LIKE '%$search%') ORDER BY giaban ASC LIMIT $start, $items_per_page";
				} elseif ($sort == 'desc') {
					$timkiem = "SELECT * FROM sanpham WHERE tensp LIKE '%$search%' OR maloai IN (SELECT maloai FROM loaisanpham WHERE tenloai LIKE '%$search%') ORDER BY giaban DESC LIMIT $start, $items_per_page";
				} else {
					if ($search == '') {
						$timkiem = "SELECT * FROM sanpham WHERE giaban > 0 LIMIT $start, $items_per_page";
					} else {
						$timkiem = "SELECT * FROM sanpham WHERE tensp LIKE '%$search%' OR maloai IN (SELECT maloai FROM loaisanpham WHERE tenloai LIKE '%$search%') AND giaban > 0 LIMIT $start, $items_per_page";
					}
				}
			
				$result = mysqli_query($con, $timkiem);

				if (mysqli_num_rows($result) > 0) {

					// Xuất kết quả tìm kiếm sản phẩm theo vòng lặp
					while ($row = mysqli_fetch_array($result)) { ?>

						<!-- Hiển thị kết quả tìm kiếm, lọc danh mục, phân trang -->
						<div class="col-md-6 col-lg-4 d-flex">
							<div class="book-wrap d-lg-flex">
								<div class="img d-flex justify-content-end" style="background-image: url(Image/<?php echo $row['hinhanh']; ?>);">
									<div class="in-text">

										<?php
											// Kiểm tra tên đăng nhập có tồn tại không
											if(isset($_SESSION['tendn'])) {
										?>

										<!-- Nút icon giỏ hàng và xử lý chức năng thêm vào giỏ hàng -->
										<form class="giohang" action="processcart.php?action=add" method="POST" data-available="<?php echo ($row['soluong'] > 0 ? '1' : '0'); ?>">
											<input type="hidden" style="width: 10%; height: 10%;" value="1" name="soluong[<?php echo $row['masp'] ?>]"/>

											<a class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Thêm vào giỏ hàng">
												<span class="flaticon-shopping-cart"></span>
											</a>
										</form>

										<?php } ?>

										<!-- Nút icon xem chi tiết sản phẩm -->
										<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Xem chi tiết" onclick="viewDetail(<?php echo $row['masp']; ?>)">
											<span class="flaticon-visibility"></span>
										</a>
									</div>
								</div>

								<div class="text p-4">
									<p class="mb-2"><span class="price" style="font-size: 20px;"><?php echo number_format($row['giaban'], 0, ',', '.'); ?> VNĐ</span></p>
									<h2><a href="#"><?php echo $row['tensp']; ?></a></h2>
									<span class="position">Tác giả: <?php echo $row['tacgia']; ?></span>

									<!-- Kiểm tra cột số lượng -->
									<span>
										<?php 
											if ($row['soluong'] > 0) {
										?>
													
										<strong style="color: #ff7a5c; font-size: 20px; font-family: 'Lora', serif;">Còn hàng</strong>
										
										<?php } else { ?>

										<strong style="color: #ff7a5c; font-size: 20px; font-family: 'Lora', serif;">Hết hàng</strong>

										<?php } ?>
									</span>
								</div>
							</div>
						</div>

		<?php 
					}

				} else {
					echo '<script>
							alert("Không tìm thấy sản phẩm");
							window.location.href="sanpham.php";
						</script>';
				}

			}
		?>
	</div>

	<!-- Phân trang -->
	<div class="row mt-5">
		<div class="col text-center">
			<div class="block-27">
				<ul>

					<?php
						// Số sản phẩm trên một trang
						$items_per_page = 6;

						// Câu truy vấn SQL
						$product_count = "SELECT COUNT(*) as total FROM sanpham";
						$result_count = mysqli_query($con, $product_count);
						$row_count = mysqli_fetch_assoc($result_count);

						// Tổng số trang
						$total_pages = ceil($row_count['total'] / $items_per_page);

						// Trang hiện tại
						$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

						// Tạo link phân trang
						if ($current_page > 1) {
							echo '<li><a href="?page='.($current_page-1).'">&lt;</a></li>';
						}

						for ($i = 1; $i <= $total_pages; $i++) {
							if ($i == $current_page) {
								echo '<li class="active"><span>'.$i.'</span></li>';
							} else {
								echo '<li><a href="?page='.$i.'">'.$i.'</a></li>';
							}
						}

						if ($current_page < $total_pages) {
							echo '<li><a href="?page='.($current_page+1).'">&gt;</a></li>';
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>

<!-- Link xử lý giỏ hàng -->
<script src="JS/cart.js"></script>
