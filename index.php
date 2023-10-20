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
		<link rel="stylesheet" href="CSS/quanly.css">
		<link rel="stylesheet" href="CSS/locsp.css">

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
							<h4 style="margin-top: 10px;"><?php echo $_SESSION['tendn']; ?></h4>
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
		<section class="hero-wrap" style="background-image: url('Image/bg_1.jpg');" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>

			<div class="container">
				<div class="row no-gutters slider-text align-items-center">
					<div class="col-md-8 ftco-animate d-flex align-items-end">
						<div class="text w-100">
							<h1 class="mb-4">Thiên đường dành cho những bạn yêu công nghệ thông tin</h1>
							<p class="mb-4">ITBOOK nơi tổng hợp tất cả các loại sách về công nghệ thông tin mới nhất hiện nay.</p>
							<p><a href="sanpham.php" class="btn btn-primary py-3 px-4">Xem tất cả sách</a></p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Danh mục -->
		<section class="ftco-section ftco-no-pt mt-5 mt-md-0">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-3 d-flex align-items-stretch ftco-animate">
    					<div class="services-2 text-center">
    						<div class="icon-wrap">
	    						<div class="icon d-flex align-items-center justify-content-center">
	    							<span class="flaticon-fantasy"></span>
	    						</div>
    						</div>
    						<h2><a href="#">Ngôn ngữ lập trình</a></h2>
    					</div>
    				</div>

					<div class="col-md-3 d-flex align-items-stretch ftco-animate">
						<div class="services-2 text-center">
							<div class="icon-wrap">
								<div class="icon d-flex align-items-center justify-content-center">
									<span class="flaticon-heart"></span>
								</div>
							</div>
							<h2><a href="#">Mạng máy tính</a></h2>
						</div>
					</div>

    				<div class="col-md-3 d-flex align-items-stretch ftco-animate">
    					<div class="services-2 text-center">
    						<div class="icon-wrap">
	    						<div class="icon d-flex align-items-center justify-content-center">
	    							<span class="flaticon-model"></span>
	    						</div>
    						</div>
    						<h2><a href="#">Tin học văn phòng</a></h2>
    					</div>
    				</div>

					<div class="col-md-3 d-flex align-items-stretch ftco-animate">
						<div class="services-2 text-center">
							<div class="icon-wrap">
								<div class="icon d-flex align-items-center justify-content-center">
									<span class="flaticon-history"></span>
								</div>
							</div>
							<h2><a href="#">UI/UX</a></h2>
						</div>
					</div>
    			</div>
    		</div>
    	</section>

		<!-- Sản phẩm nổi bật -->
		<section class="ftco-section ftco-no-pt">
			<div class="container-fluid px-md-4">
				<div class="row justify-content-center pb-5 mb-3">
					<div class="col-md-7 heading-section text-center ftco-animate">
						<h2>Sản phẩm nổi bật</h2>
					</div>
				</div>

    			<div class="row" id="search-results">

					<?php
						// Kiểm tra biến GET sort và lưu trữ thông tin về kết quả lọc vào biến session
						if (isset($_GET['sort'])) {
							$_SESSION['sort'] = $_GET['sort'];
						}

						// Kiểm tra biến SESSION sort có tồn tại không
						if (isset($_SESSION['sort'])) {
							// Khai báo biến
							$sort = $_SESSION['sort'];

							// Câu truy vấn SQL
							$index = "SELECT * FROM sanpham ORDER BY giaban $sort LIMIT 6 OFFSET 0";
						} else {
							$index = "SELECT * FROM sanpham LIMIT 6 OFFSET 0";
						}
						
						$result = mysqli_query($con, $index);

						// Xuất sản phẩm theo vòng lặp
						while ($row = mysqli_fetch_array($result)) {
					?>

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

					<?php } ?>
    			</div>
    		</div>
    	</section>

		<!-- Đánh giá của khách hàng -->
		<section class="ftco-section testimony-section ftco-no-pb">
    		<div class="img img-bg border" style="background-image: url(Image/bg_4.jpg);"></div>
    		<div class="overlay"></div>

      		<div class="container">
        		<div class="row justify-content-center mb-5">
					<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
						<span class="subheading">Đánh giá</span>
						<h2 class="mb-3">Từ những khách hàng đã mua sách tại ITBook</h2>
					</div>
        		</div>
			</div>

        	<div class="row ftco-animate" style="width: 90%; margin-left: 75px;">
          		<div class="col-md-12">
            		<div class="carousel-testimony owl-carousel ftco-owl">
              			<div class="item">
                			<div class="testimony-wrap py-4">
                				<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                  
								<div class="text">
                    				<p class="mb-4">ITBook có giao diện dễ sử dụng và tìm kiếm sách trên trang web này rất tiện lợi. Tôi cũng thích tính năng đánh giá sản phẩm của người dùng, giúp tôi quyết định chọn sách nào để đọc.</p>
                    				<div class="d-flex align-items-center">
                    					<div class="user-img" style="background-image: url(Image/person_1.jpg)"></div>
                    	
										<div class="pl-3">
											<p class="name">Thanh Tân</p>
											<span class="position">Khách hàng</span>
										</div>
	                  				</div>
                  				</div>
                			</div>
              			</div>

						<div class="item">
							<div class="testimony-wrap py-4">
								<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
											
								<div class="text">
									<p class="mb-4">ITBook là một nơi tuyệt vời để tìm kiếm những cuốn sách mới nhất và thông tin về công nghệ thông tin. Tôi đánh giá cao trang web này vì sự đa dạng của các cuốn sách và tính năng tìm kiếm thông minh giúp tôi dễ dàng tìm thấy những gì tôi cần.</p>
									<div class="d-flex align-items-center">
										<div class="user-img" style="background-image: url(Image/person_2.jpg)"></div>
										<div class="pl-3">
											<p class="name">Thiên Phúc</p>
											<span class="position">Khách hàng</span>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="testimony-wrap py-4">
								<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>

								<div class="text">
									<p class="mb-4">ITBook là một trang web bán sách công nghệ thông tin đáng tin cậy. Tôi đã mua một số cuốn sách trên trang web này và được hỗ trợ tận tình bởi đội ngũ nhân viên hỗ trợ khách hàng. Sản phẩm được giao hàng đúng thời gian và tình trạng sách hoàn toàn mới.</p>
									<div class="d-flex align-items-center">
										<div class="user-img" style="background-image: url(Image/person_3.jpg)"></div>
										<div class="pl-3">
											<p class="name">Thành Trí</p>
											<span class="position">Khách hàng</span>
										</div>
									</div>
								</div>
							</div>
						</div>
          			</div>
        		</div>
      		</div>
    	</section>	

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

  		<!-- Loader -->
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
			//Javascript submenu
			let subMenu = document.getElementById("subMenu");
				function toggleMenu() {
					subMenu.classList.toggle("open-menu");
				}
			
			// Hàm xem chi tiết sản phẩm
			function viewDetail(productId) {
				const encodedProductId = btoa(productId);
				window.location.href = `detail.php?masp=${encodedProductId}`;
			}

			// Hàm lọc giá tăng dần
			function sortAsc() {
				window.location.href = window.location.pathname + '?sort=asc';
			}

			// Hàm lọc giá giảm dần
			function sortDesc() {
				window.location.href = window.location.pathname + '?sort=desc';
			}
		</script>
  	</body>
</html>