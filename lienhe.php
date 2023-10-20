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

            /* CSS form liên hệ */
            .contact-container {
                position: relative;
                width: 100%;
            }

            .contact-container img {
                display: block;
                width: 100%;
                height: auto;
            }

            .contact-container form {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: #f2f2f2;
                padding: 20px;
                border-radius: 5px;
            }

            .contact-container form label {
                display: block;
                margin-bottom: 10px;
            }

            .contact-container form input[type="text"],
            .contact-container form input[type="email"],
            .contact-container form textarea {
                width: 100%;
                padding: 10px;
                margin-bottom: 20px;
                border: none;
                border-radius: 5px;
            }

            .contact-container form input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .contact-container form input[type="submit"]:hover {
                background-color: #3e8e41;
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
		<section class="hero-wrap hero-wrap-2" style="background-image: url('Image/bg_5.jpg');" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>

			<div class="container">
				<div class="row no-gutters slider-text align-items-center justify-content-center">
					<div class="col-md-9 ftco-animate mb-0 text-center">
						<h1 class="mb-0 bread">Liên hệ</h1>
					</div>
				</div>
			</div>
		</section>

        <?php
            // if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // // collect value of input field
            // $name = $_POST['name'];
            // $email = $_POST['email'];
            // $message = $_POST['message'];

            // // get the current date
            // date_default_timezone_set('Asia/Ho_Chi_Minh');
            // $date = date('Y-m-d H:i:s');

            // // get user id from session
            
            // $makh = $_SESSION['makh'];

            //     // Lấy ngẫu nhiên 1 nhân viên từ bảng nhanvien
            //         $query = "SELECT manv FROM nhanvien ORDER BY RAND() LIMIT 1";
            //         $result = mysqli_query($con, $query);
            //         $nv = mysqli_fetch_array($result);
            //         $manv = $nv['manv'];

            // // insert data into database
            // $sql = "INSERT INTO tuvan(makh, manv, tenkh, email, noidung, ngaytv, trangthai) VALUES ('$makh', '$manv', '$name', '$email', '$message', '$date', 'Chưa  tư vấn')";

            // if (mysqli_query($con, $sql)) {
            //     echo '<script>alert("Gửi liên hệ thành công.")</script>';
            // } else {
            //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            // }
            // }
        ?>

        <!-- Thông tin liên hệ -->
        <section class="ftco-section bg-light">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="wrapper px-md-4">
							<div class="row mb-5">
								<div class="col-md-3">
									<div class="dbox w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-map-marker"></span>
                                        </div>

                                        <div class="text">
                                            <p><span>Địa chỉ:</span> 12 Nguyễn Văn Bảo, phường 4, quận Gò Vấp. </p>
                                        </div>
				                    </div>
								</div>

								<div class="col-md-3">
									<div class="dbox w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-phone"></span>
                                        </div>

                                        <div class="text">
                                            <p><span>Điện thoại</span> <a href="tel://1234567920">0835799064</a></p>
                                        </div>
				                    </div>
								</div>

								<div class="col-md-3">
									<div class="dbox w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-paper-plane"></span>
                                        </div>

                                        <div class="text">
                                            <p><span>Email:</span> <a href="mailto:info@yoursite.com">itbook660@gmail.com</a></p>
                                        </div>
				                    </div>
								</div>

								<div class="col-md-3">
									<div class="dbox w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-globe"></span>
                                        </div>

                                        <div class="text">
                                            <p><span>Website</span> <a href="index.php">ITBook.com</a></p>
                                        </div>
				                    </div>
								</div>
							</div>

							<div class="row no-gutters">
								<div class="col-md-7">
									<div class="contact-wrap w-100 p-md-5 p-4">
										<h3 class="mb-4">Liên hệ với chúng tôi</h3>

                                        <!-- Form liên hệ -->
										<form method="POST" id="contactForm" name="contactForm" class="contactForm">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="label" for="name">Họ và Tên</label>
														<input type="text" class="form-control" name="name" id="name" placeholder="Họ và Tên">
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="email">Địa chỉ Email</label>
														<input type="email" class="form-control" name="email" id="email" placeholder="Email">
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label class="label" for="subject">Tiêu đề</label>
														<input type="text" class="form-control" name="subject" id="subject" placeholder="Tiêu đề">
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label class="label" for="#">Nội dung</label>
														<textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Nội dung"></textarea>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<input type="submit" value="Gửi" class="btn btn-primary">
														<div class="submitting"></div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>

                                <!-- Bản đồ -->
								<div class="col-md-5 order-md-first d-flex align-items-stretch">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.857562416985!2d106.68492447463169!3d10.822210558348397!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174deb3ef536f31%3A0x8b7bb8b7c956157b!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2hp4buHcCBUUC5IQ00!5e0!3m2!1svi!2s!4v1684426114440!5m2!1svi!2s" width="800" height="555" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
		</script>
    </body>
</html>