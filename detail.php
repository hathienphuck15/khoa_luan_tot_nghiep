<?php
	// Hàm bắt đầu session	
	session_start();

	// Kết nối CSDL
	include_once(__DIR__ . "/Model/ketnoi.php");

	// Gọi hàm trong class của Model
	$p = new clsketnoi();
	$connect = $p->ketnoiDB($con);
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
    
		<!-- Link fancybox của giỏ hàng -->
		<link rel="stylesheet" href="CSS/jquery.fancybox.min.css">

		<!-- Link Bootstrap -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
		
		<!-- Link Boxicons -->
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

		<style>
      		/* CSS icon micro */
			#micro:hover {
				border-radius: 20%;
				background-color: rgba(0, 0, 0, 0.2);
				width: 70%;
				padding-top: 7px;
				padding-bottom: 5px;
				margin-bottom: 35px;
				color: whitesmoke;
			}

      		/* CSS icon giỏ hàng */
			#cart-icon {
				position: fixed;
				top: 30%;
				right: 0;
				margin-right: 20px;
				border-radius: 100%;
				overflow: hidden;
			}

			#cart-icon span {
				display: block;
				color: black;
				position: absolute;
				top: 18px;
				right: 14px;
				background: whitesmoke;
				padding: 5px;
				border-radius: 100%;
				font-size: 13px;
				font-family: 'Lora', serif;
				margin-top: -5px;
				font-weight: bold;
			}

			/* CSS trang chi tiết sản phẩm */
			.product-container {
				border: 1px solid #006F8E;
				padding: 20px;
				max-width: 1200px;
				margin-top: 30px;
				margin-left: 250px;
				margin-bottom: 50px;
				display: flex;
				justify-content: center;
				align-items: center;
				background-color: #f2f2f2;
				margin-right: 220px;
			}

			.product-container img {
				max-width: 35%;
				height: 500px;
				margin-right: 50px;
			}

			.product-container .product-details {
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: flex-start;
				max-width: 50%;
				height: auto;
			}

			.product-container h2 {
				font-size: 28px;
				margin: 0;
			}

			.product-container p {
				font-size: 18px;
				margin-bottom: 10px;
				max-height: 300px;
				overflow-y: auto;
			}

			.product-container .product-price {
				font-size: 24px;
				font-weight: bold;
				color: red;
			}

			.product-container .product-author {
				font-size: 18px;
				font-style: italic;
				width: 50%;
			}

			.product-container #add-to-cart-button {
				background-color: #008CBA;
				color: white;
				padding: 10px 20px;
				border: none;
				border-radius: 5px;
				font-size: 18px;
				cursor: pointer;
				transition: background-color 0.3s ease-in-out;
				margin-top: 10px;
			}

			.product-container #add-to-cart-button:hover {
				background-color: #006F8E;
				transform: scale(1.1);
				transition: transform 0.2s ease-in-out;
			}

			.product-container label {
				font-size: 18px;
			}

			.product-container input {
				font-size: 16px;
				width: 60px;
				padding: 5px;
				margin-right: 10px;
				border: none;
				border-radius: 5px;
				text-align: center;
				background-color: #f2f2f2;
				box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
			}

			.product-container .slogan {
				margin-top: 20px;
				font-style: italic;
				font-size: 14px;

			}

			.product-container .product-quantity {
				font-size: 18px;
				font-weight: bold;
				color: grey;
				font-style: italic;
				margin-top: -2px;
			}

			.product-container input {
				font-size: 16px;
				color: #333;
				padding: 5px;
				margin-bottom: 8px;
				border: 1px solid #ccc;
				border-radius: 4px;
				background-color: #fff;
			}

			.product-info-tabs {
				border: 1px solid #006F8E;
				padding: 10px;
				background-color: #f2f2f2;
			}

			.nav-tabs {
				list-style: none;
				display: flex;
				justify-content: space-between;
			}

			#review-tab:hover {
				color: #fff;
				background-color: #95adbe;
			}

			.latest-review {
				background-color: #f2f2f2;
				border-top: 3px solid #006F8E;
				border-right: 3px solid #006F8E;
				border-left: 3px solid #006F8E;
				width: 98%; 
				margin-left: 10px; 
				margin-bottom: 50px;
				color: black;
				font-size: 18px;
				font-family: 'Lora', serif;
			}

			.review {
				padding-left: 30px;
				border-bottom: 3px solid #006F8E;
				padding-bottom: 10px;
			}

			.reviewer-name {
				font-weight: bold;
				padding-left: 30px;
				padding-top: 10px;
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

						<!-- Thanh tìm kiếm -->
						<div class="col-md-6 d-md-flex justify-content-end mb-md-0 mb-3">
							<form action="#" class="searchform order-lg-last" style="margin-right: -420px; margin-top:15px; width: 55%;" method="POST">
								<div class="form-group d-flex" style="width: 106%;">
									<!-- Tìm kiếm bằng văn bản -->
									<input type="text" class="form-control pl-3" placeholder="Nhập từ khóa..." id="spoken-text">

									<!-- Tìm kiếm bằng giọng nói -->
									<button type="button" class="form-control" style="width:fit-content;" id="voice"><span class="fa fa-microphone" id="micro" style="font-size: 18px; margin-top:3px; margin-right: 30px;"></span></button>
								</div>
							</form>
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
						<li class="nav-item"><a href="#" class="nav-link" style="font-size: 14px;">Giới thiệu</a></li>
						<li class="nav-item"><a href="sanpham.php" class="nav-link" style="font-size: 14px;">Sản phẩm</a></li>
						<li class="nav-item"><a href="#" class="nav-link" style="font-size: 14px;">Tin tức</a></li>
						<li class="nav-item"><a href="#" class="nav-link" style="font-size: 14px;">Liên hệ</a></li>
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
						<h1 style="margin-left: 150px;" class="mb-0 bread">Chi tiết sản phẩm</h1>
					</div>
				</div>
			</div>
		</section>
		
		<?php
		// Lấy thông tin sản phẩm từ CSDL
		if (isset($_GET['masp'])) {

			// Hàm base64_decode để giải mã hóa mã sản phẩm
			$product_id = base64_decode($_GET['masp']);

			// Câu truy vấn SQL
			$sql = "SELECT * FROM sanpham WHERE masp = $product_id";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_assoc($result);

			// Lưu thông tin sản phẩm vào session
			$_SESSION['product'] = $row;

			// Hiển thị thông tin sản phẩm trên trang chi tiết sản phẩm
			echo '<section class="ftco-section" id="search-results">';
			echo '<div class="product-container">';
			echo '<img class="product-image" src="Image/' .$row['hinhanh']. '">';
			echo '<div class="product-details">';
			echo '<h2>' .$row['tensp']. '</h2>';

			// Hàm number_format định dạng tiền tệ
			echo '<p class="product-price">Giá: ' .number_format($row['giaban'], 0, ',', '.'). ' VNĐ</p>';
			echo '<p class="product-author">Tác giả: ' .$row['tacgia']. '</p>';

			// Kiểm tra cột số lượng lớn hơn 0
			if ($row['soluong'] > 0) {
				echo '<strong style="color: #ff7a5c; font-size: 20px; font-family: "Lora", serif;">Còn hàng</strong>';

				// Kiểm tra biến SESSION tên đăng nhập có tồn tại không 
				if(isset($_SESSION['tendn'])) {
					echo '<p class="product-quantity" style="width: 50%; font-style: normal; margin-top: 5px; color: rgba(0, 0, 0, 0.7);">Số lượng còn lại: ' . $row['soluong']. '</p>'; ?>

					<!-- Nút thêm vào giỏ hàng và xử lý chức năng thêm vào giỏ hàng-->
					<form id="giohangdetail" action="processcart.php?action=add" method="POST">
						<label style="font-weight: bold; color: rgba(0, 0, 0, 0.7); font-size: 18px; font-family: 'Lora', serif; margin-right: 10px;">Số lượng mua: </label>
						<input type="text" style="width: 15%; height: 10%;" value="1" name="soluong[<?php echo $row['masp'] ?>]"/><br>
						<button id="add-to-cart-button"> Thêm vào giỏ hàng </button>
					</form>

		<?php	
				}
			} else {
				echo '<strong style="color: #ff7a5c; font-size: 20px; font-family: "Lora", serif;">Hết hàng</strong>';
			}

			echo '<div class="slogan">';
			echo '<p>Mua sắm sách công nghệ thông tin - Đồng hành cùng sự phát triển của bạn.</p>';
			echo '</div >';
			echo '</div>';
			echo '</div>';
			echo '</section>';
		}
		?>

		<!-- Đánh giá sản phẩm-->
		<div class="product-info-tabs">
			<ul class="nav nav-tabs" id="myTab" role="tablist" style="border-color: #006F8E;">
				<li class="nav-item">
					<a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false" style="text-transform: uppercase; border-color: #006F8E; color: black; font-size: 18px; font-family: 'Lora', serif;">Đánh giá</a>
				</li>
			</ul>

			<?php 
				// Kiểm tra nếu người dùng đã đăng nhập
				if(isset($_SESSION['matk']) && ($_SESSION['matk'] > 0)) {

					// Lấy tên người dùng từ session
					if(isset($_SESSION['tendn']) && ($_SESSION['tendn'] != "")) {
						$customer_name = $_SESSION['tendn'];
					} else {
						$customer_name = "";
					}
					
					// Kiểm tra nếu người dùng đã gửi đánh giá
					if(isset($_POST['dgsubmit'])) {

						// Lấy thông tin đánh giá từ form
						$product_id = $_POST['productid'];
						$comment = $_POST['binhluan'];   
						$makh = $_SESSION['makh'];

						// Kiểm tra nếu thông tin đánh giá không rỗng
						if(!empty($product_id) && !empty($customer_name) && !empty($comment)) {

							// Kết nối đến CSDL và thực hiện truy vấn thêm đánh giá
							$query = "INSERT INTO danhgia(masp, makh, tendn, binhluan) VALUES ('$product_id', '$makh', '$customer_name', '$comment')";    
							$kq = mysqli_query($con, $query);
							$p->dongketnoi($con);

							// Hiển thị thông báo đánh giá thành công
							echo '<script>alert("Đánh giá thành công.")</script>';
						} else {
							// Hiển thị thông báo lỗi khi đánh giá không hợp lệ
							echo '<script>alert("Bạn cần nhập đầy đủ thông tin.")</script>';
						}
					}

				} else {

					// Yêu cầu đăng nhập nếu không tìm thấy mã tài khoản trong session
					if(!empty($_POST['dgsubmit'])) {
						echo '<script>
							alert("Bạn cần phải đăng nhập.");
							window.location.href="login_kh.php";
						</script>';
					}
				}
			?>   
    	</div>

		<!-- Nội dung đánh giá -->
		<div class="tab-content" id="myTabContent" style="margin-top: 30px; width: 98%; margin-left: 10px; margin-bottom: 50px;">
			<div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">

				<!-- Hiển thị nội dung đánh giá -->
				<form method="post" action="#">
					<input type="hidden" name="productid" value="<?php echo $product_id; ?>">
					<textarea name="binhluan" placeholder="Viết đánh giá của bạn" class="form-control"></textarea>
					<input type="submit" name="dgsubmit" value="Gửi" class="btn btn-primary" style="margin-top: 15px; font-size: 18px; font-family: 'Lora', serif;">
				</form>
			</div>
		</div>

		<?php
			// Gọi hàm trong class của Model
			$p = new clsketnoi();
			$p->ketnoiDB($con);

			// Kiểm tra mã sản phẩm qua biến GET có tồn tại không
			if(isset($_GET['masp'])) {

				// Hàm base64_decode giải mã hóa mã sản phẩm
				$masp = base64_decode($_GET['masp']);

				// Câu truy vấn SQL
				$sql = "SELECT * FROM danhgia WHERE masp = '$masp' ORDER BY ngaydang ASC LIMIT 5";
				$result = mysqli_query($con, $sql);

				// Hiển thị đánh giá mới nhất
				if (mysqli_num_rows($result) > 0) {
					echo "<div class='latest-review'>";
					while ($row = mysqli_fetch_assoc($result)) {

						// // Hàm strtotime() sẽ chuyển đổi một chuỗi thời gian, hàm date() định dạng giá trị thời gian theo một định dạng cụ thể
						echo "<p class='reviewer-name'>" .$row['tendn']. "<i class='bx bxs-time' style='padding-left: 40px; word-spacing: 5px;'>" .date('d/m/Y H:i:s', strtotime($row['ngaydang'])). "</i></p>";
						echo "<p class='review'>" .$row['binhluan']. "</p>";
					}
					echo "</div>";
				}
			}

			// Đóng kết nối cơ sở dữ liệu
			mysqli_close($con);
		?>

		<?php
			// Kết nối file xử lý số lượng của giỏ hàng
			include_once(__DIR__ . "/functioncart.php");

			// Gọi hàm xử lý số lượng của giỏ hàng
			$totalQuantity = getTotalQuantity();

			// Kiểm tra tên đăng nhập có tồn tại không
			if(isset($_SESSION['tendn'])) {
		?>

				<div id="cart-icon">

					<!-- In ra biến xử lý số lượng của giỏ hàng -->
					<span><?php echo $totalQuantity ?></span>
					
					<!-- Nút icon giỏ hàng để lưu sản phẩm khi thêm vào -->
					<a data-fancybox data-type="ajax" data-src="cart.php" href="javascript:;">
						<img width="90" src="Image/cart-icon.png"/>
					</a>
				</div>

		<?php } ?>

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
								<li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Giới thiệu</a></li>
								<li><a href="sanpham.php"><span class="fa fa-chevron-right mr-2"></span>Sản phẩm</a></li>
								<li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Tin tức</a></li>
								<li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Liên hệ</a></li>
							</ul>
						</div>
					</div>

					<div class="col-sm-12 col-md">
						<div class="ftco-footer-widget mb-4 ml-md-4" style="width:100%;">
							<h2 class="ftco-heading-2">ITBOOK</h2>
							<ul class="list-unstyled" style="font-family: 'Poppins', sans-serif; font-size: 18px;">
								<li style="width: 150%;"><i class='bx bx-map'> 12 Nguyễn Văn Bảo phường 4 quận Gò Vấp</i></li>
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

		<!-- Link fancybox của giỏ hàng -->
		<script src="JS/jquery.fancybox.min.js"></script>

		<!-- Link xử lý tìm kiếm -->
		<script src="JS/search.js"></script>

		<!-- Link xử lý giỏ hàng -->
		<script src="JS/cart.js"></script>

		<script>
			// Javascript submenu
			let subMenu = document.getElementById("subMenu");
				function toggleMenu() {
				subMenu.classList.toggle("open-menu");
				}
			
			// Hàm lọc giá tăng dần
			function sortAsc() {
				window.location.href = "sanpham.php?sort=asc";
			}

			// Hàm lọc giá giảm dần
			function sortDesc() {
				window.location.href = "sanpham.php?sort=asc";
			}
		</script>
  	</body>
</html>