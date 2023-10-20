<?php
	// Hàm bắt đầu session	
	session_start();

	// Kết nối CSDL
	include_once(__DIR__ . "/Model/ketnoi.php");

	// Gọi hàm trong class của Model
	$p = new clsketnoi();
	$connect = $p->ketnoiDB($con);

	// Kiểm tra biến SESSION tendn có tồn tại không
	if(!isset($_SESSION['tendn'])) {
		echo '<script>
            alert("Bạn vui lòng đăng nhập.");
            window.location.href="login_kh.php";
        </script>';
        exit;
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>ITBOOK</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Link phông chữ -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

		<!-- Link Font Awesome -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<!-- Link CSS -->
		<link rel="stylesheet" href="CSS/animate.css">
		<link rel="stylesheet" href="CSS/owl.carousel.min.css">
		<link rel="stylesheet" href="CSS/owl.theme.default.min.css">
		<link rel="stylesheet" href="CSS/magnific-popup.css">
		<link rel="stylesheet" href="CSS/flaticon.css">
		<link rel="stylesheet" href="CSS/index.css">
		<link rel="stylesheet" href="CSS/locsp.css">
		<link rel="stylesheet" href="CSS/quanly.css">
    
		<!-- Link Bootstrap -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
		
		<!-- Link Boxicons -->
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

		<style>
			/* Table */
			.product-img img {
				max-width: 100px;
				height: auto;
				border-radius: 5px;
			}

			/* Form */
			input[type="submit"] {
				background-color: #4CAF50;
				color: white;
				padding: 8px 16px;
				border: none;
				border-radius: 4px;
				cursor: pointer;
			}

			input[type="submit"]:hover {
				background-color: #45a049;
			}

			label {
				display: block;
				margin-bottom: 10px;
			}

			input[type="text"], input[type="tel"] {
				padding: 8px;
				width: 100%;
				border-radius: 4px;
				border: 1px solid #ccc;
				box-sizing: border-box;
				margin-bottom: 20px;
			}

			button[type="submit"] {
				background-color: #4CAF50;
				color: white;
				padding: 8px 16px;
				border: none;
				border-radius: 4px;
				cursor: pointer;
			}

			button[type="submit"]:hover {
				background-color: #45a049;
			}

			.form-group {
				margin-bottom: 15px;
			}

			label {
				display: block;
				margin-bottom: 5px;
			}

			input[type="text"], input[type="tel"] {
				width: 100%;
				height: 35px;
				border: 1px solid #ccc;
				border-radius: 4px;
				padding: 5px;
				font-size: 16px;
			}

			.payment-method {
				border: 1px solid #ccc;
				border-radius: 4px;
				padding: 10px;
			}

			.form-check {
				margin-bottom: 10px;
			}

			.form-check-label {
				margin-left: 5px;
			}

			.btn {
				background-color: #dc3545;
				color: #fff;
				border: none;
				border-radius: 4px;
				padding: 10px 20px;
				font-size: 16px;
				cursor: pointer;
			}

			.btn:hover {
				background-color: #c82333;
			}

			form {
				width: 500px; /* Đặt độ rộng của form */
				margin: 0 auto; /* Để căn giữa form theo chiều ngang */
				padding: 20px; /* Để tạo khoảng cách giữa nội dung form và khung viền */
				background-color: #fff; /* Đặt màu nền cho form */
				border: 1px solid #ddd; /* Đặt đường viền cho form */
				border-radius: 5px; /* Đặt bo góc cho form */
				box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1); /* Đặt đổ bóng cho form */
				display: inline-block;
				margin-bottom: 20px;
			}
	
			.form-container {
				width: 100%; /* Đặt độ rộng của khung viền bằng với chiều rộng của form */
				display: flex; /* Để các phần tử bên trong khung viền hiển thị theo chiều ngang */
				justify-content: center; /* Để căn giữa form theo chiều ngang */
				background-color: #f5f5f5; /* Đặt màu nền cho khung viền */
				padding: 20px; /* Để tạo khoảng cách giữa khung viền và các phần tử khác trên trang */
				margin-bottom: -40px;
			}
		</style>
	</head>

  	<body>
		<!-- Header -->
		<div class="container-fluid px-md-4  pt-3 pt-md-4">
			<div class="row justify-content-between">
				<div class="col-md-8 order-md-last">
					<div class="row">

						<!-- Logo -->
						<div class="col-md-6 text-center">
							<a class="navbar-brand" href="index.php" style="font-size: 40px; margin-left: 625px;">IT<span>BOOK</span> <small>Thế giớ sách công nghệ</small></a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Menu -->
		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
			<div class="container-fluid">

				<!-- Sidebar -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="fa fa-bars"></span> Menu
				</button>

				<!-- Menu ngang -->
				<div class="collapse navbar-collapse" id="ftco-nav" style="margin-left: 260px;">
					<ul class="navbar-nav m-auto">
						<li class="nav-item"><a href="index.php" class="nav-link" style="font-size: 14px;">Trang chủ</a></li>
						<li class="nav-item"><a href="about.php" class="nav-link" style="font-size: 14px;">Giới thiệu</a></li>
						<li class="nav-item"><a href="sanpham.php" class="nav-link" style="font-size: 14px;">Sản phẩm</a></li>
						<li class="nav-item"><a href="lienhe.php" class="nav-link" style="font-size: 14px;">Liên hệ</a></li>
					</ul>
				</div>

				<!-- Kiểm tra tên đăng nhập có tồn tại không -->
				<?php
					if(isset($_SESSION['tendn'])) {
						// Khai báo biến
						$tendnkh = $_SESSION['tendn'];

						// Lấy cột hình ảnh từ CSDL thuộc bảng khách hàng
						$query = "SELECT * FROM taikhoan tk JOIN khachhang kh ON tk.matk = kh.matk WHERE tendn = '$tendnkh'";
						$result = mysqli_query($con, $query);
						$row = mysqli_fetch_assoc($result);
				?>
				
				<!-- Thông tin cá nhân -->
				<?php
					// Kiểm tra tên đăng nhập có tồn tại không
					if(isset($_SESSION['tendn'])) {

						// Kiểm tra xem cột hình ảnh có giá trị hay không nếu rỗng thì xuất file hình chandung.jpg và ngược lại 
						$hinhanh = ($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg';
				?>
						<img src="Image/<?php echo $hinhanh; ?>" class="user" onclick="toggleMenu()" style="height: 40px; margin-right: 230px;">

				<div class="submenudoc" id="subMenu" style="z-index: 1; height: 280px; margin-right: 150px;">
					
					<!-- Submenu -->
					<div class="submenu">
						<div class="ttcn">
							
							<img src="Image/<?php echo $hinhanh; ?>">

					<?php } ?>
							
							<!-- Xuất tên đăng nhập -->
							<h4 style="margin-top: 10px;"><?php echo $_SESSION['tendn']?></h4>
						</div>

						<hr>

						<a href="thongtinchung.php" class="submenulink" style="margin-top: -5px;">
							<i class='bx bx-user'></i>
							<p style="font-size: 16px; margin-top:15px;">Thông tin chung</p>
							<span> > </span>
						</a>

						<a href="xemlsdh.php" class="submenulink" style="margin-top: -20px;">
							<i class='bx bx-history'></i>
							<p style="font-size: 16px; margin-top:15px;">Lịch sử đơn hàng</p>
							<span> > </span>
						</a>

						<a href="logout_kh.php" class="submenulink" style="margin-top:-20px;">
							<i class='bx bx-log-out'></i>
							<p style="font-size: 16px; margin-top:15px;">Đăng xuất</p>
							<span> > </span>
						</a>
					</div>
				</div>
				
				<?php } else { ?>

					<ul class="navbar-nav m-auto">
						<li class="nav-item"><a href="login_kh.php" class="nav-link" style="font-size: 14px; margin-right: 150px;">Đăng nhập</a></li>
					</ul>
							
				<?php } ?>
			</div>
		</nav>

    	<!-- Banner -->
		<section class="hero-wrap hero-wrap-2" style="background-image: url('Image/bg_5.jpg');" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>

			<div class="container">
				<div class="row no-gutters slider-text align-items-center justify-content-center">
					<div class="col-md-9 ftco-animate mb-0 text-center">
						<h1 class="mb-0 bread">Thanh toán</h1>
					</div>
				</div>
			</div>
		</section>
		
		<!-- Nội dung -->
		<section class="ftco-section">

			<?php
				// Kết nối CSDL
				include_once(__DIR__ . "/Model/ketnoi.php");

				// Gọi hàm trong class của Model
				$p = new clsketnoi();
				$connect = $p->ketnoiDB($con);

				// Kiểm tra xem giỏ hàng có sản phẩm không
				if (!empty($_SESSION["cart"])) {

					// Lấy thông tin sản phẩm có trong giỏ hàng từ database
					$products = mysqli_query($con, "SELECT * FROM `sanpham` WHERE `masp` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
			?>

			 <!-- Table hiển thị thông tin sản phẩm trong giỏ hàng -->
        	<table style="border-collapse: collapse; margin-bottom: 40px; margin-top: -60px; width: 96%; margin-left: 30px;">

				<!-- Tiêu đề table -->
				<thead>
					<tr>
						<th style="background-color: #f2f2f2; color: black; font-family: 'Lora', serif; text-align: center; padding: 8px; width: fit-content; border-right: 1px solid black; vertical-align: middle;">STT</th>
						<th style="background-color: #f2f2f2; color: black; font-family: 'Lora', serif; text-align: center; padding: 8px; width: fit-content; border-right: 1px solid black; vertical-align: middle;">Tên sản phẩm</th>
						<th style="background-color: #f2f2f2; color: black; font-family: 'Lora', serif; text-align: center; padding: 8px; width: fit-content; border-right: 1px solid black; vertical-align: middle;">Tác giả</th>
						<th style="background-color: #f2f2f2; color: black; font-family: 'Lora', serif; text-align: center; padding: 8px; width: fit-content; border-right: 1px solid black; vertical-align: middle;">Hình ảnh</th>
						<th style="background-color: #f2f2f2; color: black; font-family: 'Lora', serif; text-align: center; padding: 8px; width: fit-content; border-right: 1px solid black; vertical-align: middle;">Số lượng</th>
						<th style="background-color: #f2f2f2; color: black; font-family: 'Lora', serif; text-align: center; padding: 8px; width: fit-content; border-right: 1px solid black; vertical-align: middle;">Đơn giá</th>
						<th style="background-color: #f2f2f2; color: black; font-family: 'Lora', serif; text-align: center; padding: 8px; width: fit-content; vertical-align: middle;">Thành tiền</th>
					</tr>
				</thead>

				<!-- Nội dung table -->
            	<tbody>
					<?php
						// Khởi tạo biến tổng tiền, biến đếm
						$total = 0;
						$dem = 1;

						// Xuất sản phẩm trong giỏ hàng theo vòng lặp
						while ($row = mysqli_fetch_array($products)) {

							// Biến row đã thêm vào giỏ hàng trong phiên làm việc hiện tại. Biến này sử dụng giá trị lưu trữ trong $_SESSION["cart"] để gán giá trị cho nó. Nếu sản phẩm có masp chưa thêm vào giỏ hàng, giá trị của biến quantity là NULL hoặc 0
							$quantity = $_SESSION["cart"][$row['masp']];

							// Khai báo biến
							$price = $row['giaban'];
							$hinhanh = $row['hinhanh'];

							// Công thức tính cột thành tiền
							$subtotal = $price * $quantity;

							// Công thức tính dòng tổng tiền
							$total += $subtotal;
					?>
							<tr>
								<td style="text-align: center; padding: 8px; border-bottom: 1px solid black; color: black; vertical-align: middle;"><?php echo $dem++; ?></td>
								<td style="text-align: center; padding: 8px; border-bottom: 1px solid black; color: black; vertical-align: middle;"><?php echo $row['tensp']; ?></td>
								<td style="text-align: center; padding: 8px; border-bottom: 1px solid black; color: black; vertical-align: middle;"><?php echo $row['tacgia']; ?></td>
								<td class="product-img" style="text-align: center; padding: 8px; border-bottom: 1px solid black; color: black; vertical-align: middle;"><img src="Image/<?php echo $row['hinhanh'] ?>" /></td>
								<td style="text-align: center; padding: 8px; border-bottom: 1px solid black; color: black; vertical-align: middle;"><?php echo $quantity; ?></td>
								<td style="text-align: center; padding: 8px; border-bottom: 1px solid black; color: black; vertical-align: middle;"><?php echo number_format($price, 0, ',', '.'); ?> VNĐ</td>
								<td style="text-align: center; padding: 8px; border-bottom: 1px solid black; color: black; vertical-align: middle;"><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</td>
							</tr>
					<?php } ?>

					<!-- Xuất kết quả từ công thức tính dòng tổng tiền -->	
					<tr style="background-color: #f2f2f2; height: 40px; text-align: right; font-family: 'Lora', serif; font-weight: 600; color: red;">
						<td colspan="6">Tổng tiền:</td>
						<td style="padding-right: 20px;"><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</td>
					</tr>
            	</tbody>
        	</table>

			<?php
				// Kiểm tra nếu đã đăng nhập thì lấy thông tin thanh toán từ tài khoản đó
				if(isset($_SESSION['makh'])) {
					$user_id = $_SESSION['makh'];

					// Lấy thông tin khách hàng từ CSDL
					$query = "SELECT * FROM khachhang WHERE makh = $user_id";
					$result = mysqli_query($con, $query);
					$user = mysqli_fetch_array($result);
				}
			?>

			<!-- Bắt đầu khung viền -->
			<div class="form-container">

				<!-- Form nhập thông tin thanh toán, onsubmit="return validateForm()" gọi hàm của Javascript nếu đúng nó sẽ gửi thông cập nhật còn sai nó sẽ hiển thị lỗi đã thiết lập trong hàm -->
 				<form method="POST" onsubmit="return validateForm()">

					<!-- In ra thông tin cá nhân của khách hàng trước khi thanh toán -->
					<div class="form-group">
						<label for="name">Họ tên:</label>
						<input type="text" name="name" value="<?php echo $user['tenkh']; ?>" required>
					</div>

					<div class="form-group">
						<label for="phone">Số điện thoại:</label>
						<input type="text" name="phone" id="sdthoai" value="<?php echo  $user['sodienthoai']; ?>" required>
					</div>

					<div class="form-group">
						<label for="address">Địa chỉ:</label>
						<input type="text" name="address" value="<?php echo $user['diachi']; ?>" required>
					</div>

					<!-- In ra tồng tiền, mã hóa đơn dùng cho thanh toán MoMo -->
					<input type="hidden" name="total" value="<?php echo $total = isset($total) ? $total : ""; ?>">
					<input type="hidden" name="order_id" value="<?php echo $orderId = isset($orderId) ? $orderId : ""; ?>">

					<div class="form-group payment-method">
						<label>Phương thức thanh toán:</label>

						<div class="form-check">

							<!-- Lựa chọn thanh toán MoMO -->
							<input class="form-check-input" type="radio" name="payment_method" id="momo" value="momo" onclick="this.form.action='xulythanhtoanmomo.php?total=<?php echo $total?>'" required>
							<label class="form-check-label" for="momo">Thanh toán MoMo ATM</label>
							<img src="Image/momo.jpg" alt="momo logo" width="50px">
						</div>

						<div class="form-check">

							<!-- Lựa chọn thanh toán khi nhận hàng -->
							<input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" onclick="this.form.action='xulythanhtoancod.php'" required>
							<label class="form-check-label" for="cod">Thanh toán khi nhận hàng</label>
							<img src="Image/cod.jpg" alt="COD logo" width="70px" height="50px" >
						</div>

						<!-- Nút thanh toán -->
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-danger">Thanh toán</button>
						</div>
  					</div>
				</form>
				
			</div>

			<?php
				 
				} else {
					echo '<script>
							alert("Giỏ hàng trống. Bạn nên mua hàng.");
							window.location.href="sanpham.php";
						</script>';
				}
			?>
		</section>

		<!-- Footer -->
		<footer class="ftco-footer">
			<div class="container" style="margin-top: -70px;">
				<div class="row mb-5">
					<div class="col-sm-12 col-md">
						<div class="ftco-footer-widget mb-4" style="margin-left: -100px;">
							<h2 class="ftco-heading-2 logo blinking"><a href="#">Kết nối</a></h2>
							<p>Dù gần hay xa chỉ cần có đam mê ITBook luôn có thể đến với Bạn!</p>
							<ul class="ftco-footer-social list-unstyled mt-2">
								<li class="ftco-animate"><a href="#"><span class="fa fa-twitter" style="color:skyblue;"></span></a></li>
								<li class="ftco-animate"><a href="#"><span class="fa fa-facebook"  style="color:blue;"></span></a></li>
								<li class="ftco-animate"><a href="#"><span class="fa fa-instagram "  style="color:Brown;"></span></a></li>
							</ul>
						</div>
					</div>

					<div class="col-sm-12 col-md">
						<div class="ftco-footer-widget mb-4 ml-md-4" style="width:100%;">
							<h2 class="ftco-heading-2">Thành viên nhóm 660</h2>
							<ul class="list-unstyled">
								<li>Nguyễn Thanh Tân - 19454801</li>
								<li>Hà Thiên Phúc - 19437521</li>
							</ul>
						</div>
					</div>
						
					<div class="col-sm-12 col-md">
						<div class="ftco-footer-widget mb-4" style="margin-left: 50px;">
							<h2 class="ftco-heading-2">Liên kết nhanh</h2>
							<ul class="list-unstyled">
								<li><a href="index.php"><span class="fa fa-chevron-right mr-2"></span>Trang chủ</a></li>
								<li><a href="about.php"><span class="fa fa-chevron-right mr-2"></span>Giới thiệu</a></li>
								<li><a href="sanpham.php"><span class="fa fa-chevron-right mr-2"></span>Sản phẩm</a></li>
								<li><a href="lienhe.php"><span class="fa fa-chevron-right mr-2"></span>Liên hệ</a></li>
							</ul>
						</div>
					</div>

					<div class="col-sm-12 col-md">
						<div class="ftco-footer-widget mb-4 ml-md-4" style="width:100%;">
							<h2 class="ftco-heading-2">ITBOOK</h2>
							<ul class="list-unstyled" style="font-family: 'Poppins', sans-serif; font-size: 18px;">
								<li style="width: 150%;"><i class='bx bx-map'> 12 Nguyễn Văn Bảo, phường 4, quận Gò Vấp</i></li>
								<li><i class='bx bx-envelope'> itbook660@gmail.com</i></li>
								<li><i class='bx bx-phone' > 0835799064</i></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>

		<!-- Thanh dưới Footer -->
		<div class="container-fluid px-0 py-3 bg-black" style="margin-top: -50px;">
      		<div class="container">
      			<div class="row">
	          		<div class="col-md-12">
	            		<p class="mb-0" style="color: rgba(255,255,255,.5); text-align: center;">
							Cảm ơn quý khách đã chọn sản phẩm của chúng tôi <i class="fa fa-heart color-danger" aria-hidden="true"></i> <a href="index.php">ITBOOK</a>
						</p>	
					</div>
	        	</div>
      		</div>
      	</div>
		
		<!-- loader -->
		<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

		<!-- Link Javascript, Jquery -->
		<script src="JS/jquery.min.js"></script>
		<script src="JS/jquery-migrate-3.0.1.min.js"></script>
		<script src="JS/popper.min.js"></script>
		<script src="JS/bootstrap.min.js"></script>
		<script src="JS/jquery.easing.1.3.js"></script>
		<script src="JS/jquery.waypoints.min.js"></script>
		<script src="JS/jquery.stellar.min.js"></script>
		<script src="JS/owl.carousel.min.js"></script>
		<script src="JS/jquery.magnific-popup.min.js"></script>
		<script src="JS/jquery.animateNumber.min.js"></script>
		<script src="JS/scrollax.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
		<script src="JS/google-map.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
		<script src="JS/main.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="JS/jquery.validate.min.js"></script>

		<script>
			// Javascript submenu
			let subMenu = document.getElementById("subMenu");
				function toggleMenu() {
				subMenu.classList.toggle("open-menu");
				}
			
			// Hàm kiểm tra các trường của Form
			function validateForm() {

				// Khai báo biến để lấy giá trị của trường nhập với id
				var sodienthoai = document.getElementById("sdthoai").value;

				// Kiểm tra số điện thoại
				// Khai báo biến cho bằng biểu thức đệ quy để kiểm tra
				var sodienthoaiRegex = /^0[0-9]{9}$/;

				if (!sodienthoaiRegex.test(sodienthoai)) {
					alert("Số điện thoại không đúng định dạng!");

					// Ngăn chặn Form gửi đi nếu sai 
					event.preventDefault();
				}

				// Quay về true sau khi cập nhật lại
				return true;
			}
		</script>
  	</body>
</html>