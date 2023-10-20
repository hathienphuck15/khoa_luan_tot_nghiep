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
		<section class="hero-wrap hero-wrap-2" style="background-image: url('Image/bg_5.jpg');" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>

			<div class="container">
				<div class="row no-gutters slider-text align-items-center justify-content-center">
					<div class="col-md-9 ftco-animate mb-0 text-center">
						<h1 class="mb-0 bread">Giới thiệu</h1>
					</div>
				</div>
			</div>
		</section>

        <!-- Giới thiệu -->
		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-10">
	                    <div class="heading-section text-center ftco-animate pb-4">
                            <span class="subheading">Chào mừng</span>
                            <h2> Đến với website ITBOOK</h2>
	                    </div>

	                    <p>Trước tiên chúng tôi xin cảm ơn vì bạn đã ghé qua website của chúng tôi. ITBOOK là một Website cung cấp các loại sách công nghệ thông tin tốt nhất hiện nay. Với đa dạng cá thể loại khác nhau phù hợp với nhiều độ tuổi, nhiều chuyên nghành với mức giá sinh viên giúp các bạn dễ dàng sở hữu những quyển sách yêu thích của riêng mình.</p>
                        
                        <blockquote class="blockquote my-5">
                            <span class="fa fa-quote-left"></span>
                            <h3>Những cuốn sách hay giống như những người bạn tốt luôn ở bên bạn!</h3>
                        </blockquote>
	                </div>
                </div>
			</div>
		</section>

        <!-- Mục đích -->
		<section class="ftco-section ftco-no-pt">
			<div class="container">
				<div class="row">
					<div class="col-md-6 img img-3 d-flex justify-content-center align-items-center" style="background-image: url(Image/about-1.jpg);"></div>
					
                    <div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
	                    <div class="heading-section">
                            <span class="subheading" style="font-size:25px;">Mục đích </span>
                            <h2 class="mb-4">Lập nên website này!</h2>

	                        <p style="text-align: justify;">
                                Sau áp lực do ảnh hưởng kéo dài của dịch bệnh Covid-19, ngày càng nhiều doanh nghiệp nhận thức rõ tầm quan trọng của việc áp dụng công nghệ thông tin vào dịch vụ mua sắm đã mang lại cho họ lợi nhuận cao từ việc bán hàng online. Bên cạnh đó, nhu cầu đọc sách của con người rất phổ biến và có xu hướng phát triển mạnh đặc biệt về lĩnh vực công nghệ thông tin. Công nghệ càng phát triển thì con người càng muốn nghiên cứu để khám phá theo nhiểu kiểu khác nhau bằng việc tìm kiếm và đọc những cuốn sách có giá trị để bổ sung kiến thức hay đơn giản hơn là giải trí.
                                Hình thức mua bán sách trực tiếp ngày nay khó khăn do dịch bệnh mọi người ngại tiếp xúc ở nơi đông người và có một số trường hợp không có thời gian đến để lựa chọn và mua những cuốn sách hay bổ ích. Nhận thấy điều đó, nhóm chúng em đã xây dựng nên ITBOOK - Website bán sách trực tuyến phục vụ cho những khách hàng có nhu cầu mua sách online mà không phải tốn thời gian di chuyển đến trực tiếp cửa hàng.
                                ITBOOK là website thương mại điện tử được xây dựng dựa trên tiêu chí thân thiện với người dủng, hỗ trợ tốt cho nhân viên, người quản lý trong công việc cập nhật thông tin sản phẩm, nhà cung cấp, hóa đơn, khách hàng và giới thiệu đầy đủ thông tin về sản phẩm trong lĩnh vực công nghệ thông tin để khách hàng dễ dàng tìm kiếm, mua hàng, xem chi tiết sản phẩm. Bên cạnh đó còn hỗ trợ thêm thanh toán online với nhiều hình thức giúp khách hàng dễ dàng lựa chọn khi thanh toán.
                                Đặc biệt website ITBOOK khác với các trang website bán hàng online khác ở chỗ có tích hợp thêm tính năng tìm kiếm sản phẩm bằng giọng nói thay vì phải nhập văn bản bằng tay, tương tác với hệ thống mất thời gian, thậm chí sai sót. Với tìm kiếm bằng giọng nói thì nó sẽ nhanh chóng, đơn giản, thuận tiện và vô cùng dễ dàng. Ngoài ra, công nghệ nhận dạng giọng nói được xem là công cụ hỗ trợ tuyệt vời dành cho người khiếm thị. Người khiếm thị có thể tận hưởng những tiến bộ của công nghệ như người bình thường mà không có khoảng cách xảy ra do khiếm khuyết giác quan.
                                Trong tương lai, nhóm em sẽ phát triển thêm hệ thống chatbot kết hợp nhận diện giọng nói và nhận diện khuôn mặt trong việc hỗ trợ, giải quyết vấn đề cho khách hàng khi mua sắm trên website ITBOOK.
                            </p>
	                    </div>
					</div>
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
		</script>
    </body>
</html>