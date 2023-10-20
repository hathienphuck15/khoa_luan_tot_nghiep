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
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>ITBOOK</title>

		<!-- Link CSS -->
		<link rel="stylesheet" href="CSS/quanly.css">

		<!-- Link Boxicons -->
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	</head>

	<body>
		<?php
			// Kiểm tra tên đăng nhập có tồn tại không
			if(isset($_SESSION['user_name'])) {
				if($_SESSION['nguoidung'] == 'Quản lý') {

					// Khai báo biến
					$tendnql = $_SESSION['user_name'];

					// Lấy cột hình ảnh từ CSDL thuộc bảng khách hàng
					$query = "SELECT * FROM taikhoan tk JOIN quanly ql ON tk.matk = ql.matk WHERE tendn = '$tendnql'";
					$result = mysqli_query($con, $query);
					$row = mysqli_fetch_assoc($result);
		?>

		<!-- Sidebar người dùng quản lý -->
		<div class="sidebar">
			<div class="logo-ct">
				<i class='bx bxs-book' ></i>
				<span class="logo_name">ITBOOK</span>
			</div>

			<ul class="nav-links">
				<li style="margin-bottom: 25px; margin-left:-4px;">
					<a href="quanly.php">
						<i class='bx bx-home'></i>
						<span class="link_name">Trang chủ</span>
					</a>
				</li>

				<li style="margin-left:-4px;">
					<div class="icon-link" >
						<a href="#">
							<i class='bx bx-collection' ></i>
							<span class="link_name">Quản lý</span>
						</a>

						<i class='bx bxs-chevron-down arrow'></i>
					</div>

					<ul class="menucon">
						<li><a class="link_name">Quản lý</a></li>
						<li style="margin-top: 5px;"><a href="quanly.php?tkhoan">Tài khoản</a></li>
						<li style="margin-top: 5px;"><a href="quanly.php?nvien">Nhân viên</a></li>
						<li style="margin-top: 5px;"><a href="quanly.php?spham">Sản phẩm</a></li>
						<li style="margin-top: 5px;"><a href="quanly.php?dmuc">Danh mục</a></li>
						<li style="margin-top: 5px;"><a href="quanly.php?nccap">Nhà cung cấp</a></li>
						<li style="margin-top: 5px;"><a href="quanly.php?dhang">Đơn hàng</a></li>
						<li style="margin-top: 5px; margin-bottom: -5px;"><a href="quanly.php?khang">Khách hàng</a></li>
					</ul>
				</li>
			</ul>

			<p style="margin-top: -170px; color: #fff; text-align: center; margin-right: 10px;">
				Nhóm 660 <br>
				Hà Thiên Phúc - 19437521 <br>
				Nguyễn Thanh Tân - 19454801
			</p>
		</div>

		<!-- Menu người dùng quản lý-->
		<section class="home-section">
			<nav class="hero">
				<div class="home-content">
					<i class='bx bx-menu'></i>
					<i class='bx bxs-book' ></i>
					<span class="text">ITBOOK</span>
				</div>

				<ul style="margin-bottom: -5px;">
					<li>
						<i class='bx bx-home'></i>
						<a href="quanly.php">Trang chủ</a>
					</li>
				</ul>

				<!-- Thông tin cá nhân -->
				<?php
					// Kiểm tra tên đăng nhập có tồn tại không
					if(isset($_SESSION['user_name'])) {
									
						// Kiểm tra xem cột hình ảnh có giá trị hay không nếu rỗng thì xuất file hình chandung.jpg và ngược lại 
						$hinhanh = ($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg';
				?>

				<img src="Image/<?php echo $hinhanh; ?>" class="user" onclick="toggleMenu()">

				<div class="submenudoc" id="subMenu" style="z-index: 1; height: 220px;">
					<div class="submenu">
						<div class="ttcn">

							<img src="Image/<?php echo $hinhanh; ?>">

					<?php } ?>

							<!-- Xuất biến SESSION tên đăng nhập -->
							<h3><?php echo $_SESSION['user_name']; ?></h3>
						</div>

						<hr>

						<a href="View/vTTchungnvql.php" class="submenulink">
							<i class='bx bx-user'></i>
							<p>Thông tin cá nhân</p>
							<span> > </span>
						</a>

						<a href="logout_nvql.php" class="submenulink">
							<i class='bx bx-log-out'></i>
							<p>Đăng xuất</p>
							<span> > </span>
						</a>
					</div>
				</div>
			</nav>

			<div class="ncc" style="background-color: #E4E9F7;">

				<?php
					// Kết nối file xử lý chức năng quản lý nhà cung cấp
                    if(isset($_REQUEST["nccap"])) {
                        include_once ("View/vNhacc.php");
                    }

					// Kết nối file xử lý chức năng quản lý danh mục
					if(isset($_REQUEST["dmuc"])) {
                        include_once ("View/vDmuc.php");
                    }

					// Kết nối file xử lý chức năng quản lý sản phẩm
					if(isset($_REQUEST["spham"])) {
                        include_once ("View/vSpham.php");
                    }
                        
					// Kết nối file xử lý chức năng quản lý tài khoản	
					if(isset($_REQUEST["tkhoan"])) {
                        include_once ("View/vTkhoan.php");
                    }

					// Kết nối file xử lý chức năng quản lý nhân viên
					if(isset($_REQUEST["nvien"])) {
                        include_once ("View/vNvien.php");
                    }

					// Kết nối file xử lý chức năng quản lý khách hàng
					if(isset($_REQUEST["khang"])) {
                        include_once ("View/vKhang.php");
                    }

					// Kết nối file xử lý chức năng quản lý đơn hàng
					if(isset($_REQUEST["dhang"])) {
                        include_once ("View/vDhang.php");
                    }

					// Kết nối file xử lý chức năng xem đơn hàng
					if(isset($_REQUEST["xemdhang"])) {
                        include_once ("View/vXemDhang.php");
                    }

					// Kiểm tra biến REQUEST không tồn tại
                    if(!isset($_REQUEST["nccap"])&& !isset($_REQUEST["dmuc"]) && !isset($_REQUEST["spham"]) && !isset($_REQUEST["tkhoan"]) && !isset($_REQUEST["nvien"]) && !isset($_REQUEST["khang"]) && !isset($_REQUEST["dhang"]) && !isset($_REQUEST["xemdhang"])) {
						echo '<b style="font-size: 30px; margin-left: 35%; ">TRANG DÀNH CHO QUẢN LÝ</b>';
                    }
                ?>
			</div>

			<!-- Trang chủ người dùng quản lý -->
			<div class="hidden-element">
				<div class="container">
					<div class="card bg-primary text-white ">

						<!-- Tổng cộng số lượng tài khoản -->
						<div class="card-body">Tài khoản

							<?php
								// Lấy thông tin bảng tài khoản
								$query_tk = "SELECT * FROM taikhoan";
								$result_tk = mysqli_query($con, $query_tk);
				
								// Kiểm tra biến result_tk có tồn tại không
								if ($result_tk) {

									// Hàm mysqli_num_rows sử dụng đếm số hàng kết quả trả về từ kết quả truy vấn
									$tong_tk = mysqli_num_rows($result_tk);
									
									// Kiểm tra biến tong_tk > 0
									if ($tong_tk > 0) {

										// In ra biến lưu kết quả truy vấn
										echo '<h4 class="mb-0">' .$tong_tk. '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có tài khoản</h4>';
									}
								} 
							?>
						</div>

						<!-- Xem chi tiết -->
						<div class="card-footer d-flex align-items-center justify-content-between">
							<a class="small text-white" href="quanly.php?tkhoan">Xem chi tiết</a>
							<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
						</div>
					</div>

					<div class="card bg-success text-white">

						<!-- Tổng cộng số lượng nhân viên -->
						<div class="card-body">Nhân viên

							<?php
								// Lấy thông tin bảng nhân viên
								$query_nv = "SELECT * FROM nhanvien";
								$result_nv = mysqli_query($con, $query_nv);
								
								// Kiểm tra biến result_nv có tồn tại không
								if ($result_nv) {

									// Hàm mysqli_num_rows sử dụng đếm số hàng kết quả trả về từ kết quả truy vấn
									$tong_nv = mysqli_num_rows($result_nv);
									
									// Kiểm tra biến tong_nv > 0
									if ($tong_nv > 0) {

										// In ra biến lưu kết quả truy vấn
										echo '<h4 class="mb-0">' .$tong_nv. '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có nhân viên</h4>';
									}
								} 
							?>
						</div>

						<!-- Xem chi tiết -->
						<div class="card-footer d-flex align-items-center justify-content-between">
							<a class="small text-white" href="quanly.php?nvien">Xem chi tiết</a>
							<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
						</div>
					</div>

					<div class="card bg-sp text-white">

						<!-- Tổng cộng số lượng sản phẩm -->
						<div class="card-body">Sản phẩm

							<?php
								// Lấy thông tin bảng sản phẩm
								$query_sp = "SELECT * FROM sanpham";
								$result_sp = mysqli_query($con, $query_sp);
								
								// Kiểm tra biến result_sp có tồn tại không
								if ($result_sp) {

									// Hàm mysqli_num_rows sử dụng đếm số hàng kết quả trả về từ kết quả truy vấn
									$tong_sp = mysqli_num_rows($result_sp);
									
									// Kiểm tra biến tong_sp > 0
									if ($tong_sp > 0) {

										// In ra biến lưu kết quả truy vấn
										echo '<h4 class="mb-0">' .$tong_sp. '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có nhân viên</h4>';
									}
								} 
							?>
						</div>

						<!-- Xem chi tiết -->
						<div class="card-footer d-flex align-items-center justify-content-between">
							<a class="small text-white" href="quanly.php?spham">Xem chi tiết</a>
							<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
						</div>
					</div>

					<div class="card bg-dm text-white">

						<!-- Tổng cộng số lượng danh mục -->
						<div class="card-body">Danh mục

							<?php
								// Lấy thông tin bảng loại sản phẩm
								$query_dm = "SELECT * FROM loaisanpham";
								$result_dm = mysqli_query($con, $query_dm);
								
								// Kiểm tra biến result_dm có tồn tại không
								if ($result_dm) {

									// Hàm mysqli_num_rows sử dụng đếm số hàng kết quả trả về từ kết quả truy vấn
									$tong_dm = mysqli_num_rows($result_dm);
									
									// Kiểm tra biến tong_dm > 0
									if ($tong_dm > 0) {

										// In ra biến lưu kết quả truy vấn
										echo '<h4 class="mb-0">' .$tong_dm. '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có nhân viên</h4>';
									}
								} 
							?>
						</div>
						
						<!-- Xem chi tiết -->
						<div class="card-footer d-flex align-items-center justify-content-between">
							<a class="small text-white" href="quanly.php?dmuc">Xem chi tiết</a>
							<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
						</div>
					</div>

					<div class="card bg-ncc text-white">

						<!-- Tổng cộng số lượng nhà cung cấp -->
						<div class="card-body">Nhà cung cấp

							<?php
								// Lấy thông tin bảng nhà cung cấp
								$query_ncc = "SELECT * FROM nhacungcap";
								$result_ncc = mysqli_query($con, $query_ncc);
								
								// Kiểm tra biến result_ncc có tồn tại không
								if ($result_ncc) {

									// Hàm mysqli_num_rows sử dụng đếm số hàng kết quả trả về từ kết quả truy vấn
									$tong_ncc = mysqli_num_rows($result_ncc);
									
									// Kiểm tra biến tong_ncc > 0
									if ($tong_ncc > 0) {

										// In ra biến lưu kết quả truy vấn
										echo '<h4 class="mb-0">' .$tong_ncc. '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có nhân viên</h4>';
									}
								} 
							?>
						</div>
						
						<!-- Xem chi tiết -->
						<div class="card-footer d-flex align-items-center justify-content-between">
							<a class="small text-white" href="quanly.php?nccap">Xem chi tiết</a>
							<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
						</div>
					</div>
				
					<div class="card bg-danger text-white">

						<!-- Tổng cộng số lượng đơn hàng -->
						<div class="card-body">Đơn hàng

							<?php
								// Lấy thông tin bảng hóa đơn
								$query_hd = "SELECT * FROM hoadon";
								$result_hd = mysqli_query($con, $query_hd);
								
								// Kiểm tra biến result_hd có tồn tại không
								if ($result_hd) {

									// Hàm mysqli_num_rows sử dụng đếm số hàng kết quả trả về từ kết quả truy vấn
									$tong_hd = mysqli_num_rows($result_hd);
									
									// Kiểm tra biến tong_hd > 0
									if ($tong_hd > 0) {

										// In ra biến lưu kết quả truy vấn
										echo '<h4 class="mb-0">' .$tong_hd. '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có đơn hàng</h4>';
									}
								} 
							?>
						</div>
						
						<!-- Xem chi tiết -->
						<div class="card-footer d-flex align-items-center justify-content-between">
							<a class="small text-white" href="quanly.php?dhang">Xem chi tiết</a>
							<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
						</div>
					</div>
					
					<div class="card bg-warning text-white">

						<!-- Tổng cộng số lượng khách hàng -->
						<div class="card-body">Khách hàng

							<?php
								// Lấy thông tin bảng khách hàng
								$query_kh = "SELECT * FROM khachhang";
								$result_kh = mysqli_query($con, $query_kh);
								
								// Kiểm tra biến result_kh có tồn tại không
								if ($result_kh) {

									// Hàm mysqli_num_rows sử dụng đếm số hàng kết quả trả về từ kết quả truy vấn
									$tong_kh = mysqli_num_rows($result_kh);
									
									// Kiểm tra biến tong_kh > 0
									if ($tong_kh > 0) {

										// In ra biến lưu kết quả truy vấn
										echo '<h4 class="mb-0">' .$tong_kh. '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có khách hàng</h4>';
									}
								} 
							?>
						</div>
						
						<!-- Xem chi tiết -->
						<div class="card-footer d-flex align-items-center justify-content-between">
							<a class="small text-white" href="quanly.php?khang">Xem chi tiết</a>
							<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php 
				} elseif($_SESSION['nguoidung'] == 'Nhân viên bán hàng') {

					// Khai báo biến
					$tendnnv = $_SESSION['user_name'];

					// Lấy cột hình ảnh từ CSDL thuộc bảng nhân viên
					$query = "SELECT * FROM taikhoan tk JOIN nhanvien nv ON tk.matk = nv.matk WHERE tendn = '$tendnnv'";
					$result = mysqli_query($con, $query);
					$row = mysqli_fetch_assoc($result);
		?>

					<!-- Sidebar người dùng nhân viên bán hàng -->
					<div class="sidebar">
						<div class="logo-ct">
							<i class='bx bxs-book' ></i>
							<span class="logo_name">ITBOOK</span>
						</div>

						<ul class="nav-links">
							<li style="margin-bottom: 25px; margin-left:-4px;">
								<a href="quanly.php">
									<i class='bx bx-home'></i>
									<span class="link_name">Trang chủ</span>
								</a>
							</li>

							<li style="margin-left:-4px;">
								<div class="icon-link" >
									<a href="#">
										<i class='bx bx-collection' ></i>
										<span class="link_name">Quản lý</span>
									</a>

									<i class='bx bxs-chevron-down arrow'></i>
								</div>

								<ul class="menucon">
									<li><a class="link_name">Quản lý</a></li>
									<li style="margin-top: 5px;"><a href="quanly.php?dhang">Đơn hàng</a></li>
									<li style="margin-top: 5px; margin-bottom: -5px;"><a href="quanly.php?khang">Khách hàng</a></li>
								</ul>
							</li>
						</ul>

						<p style="margin-top: -170px; color: #fff; text-align: center; margin-right: 10px;">
							Nhóm 660 <br>
							Hà Thiên Phúc - 19437521 <br>
							Nguyễn Thanh Tân - 19454801
						</p>
					</div>

					<!-- Menu người dùng nhân viên bán hàng -->
					<section class="home-section">
						<nav class="hero">
							<div class="home-content">
								<i class='bx bx-menu'></i>
								<i class='bx bxs-book' ></i>
								<span class="text">ITBOOK</span>
							</div>

							<ul style="margin-bottom: -5px;">
								<li>
									<i class='bx bx-home'></i>
									<a href="quanly.php">Trang chủ</a>
								</li>
							</ul>

							<!-- Thông tin cá nhân -->
							<?php
								// Kiểm tra tên đăng nhập có tồn tại không
								if(isset($_SESSION['user_name'])) {
									
									// Kiểm tra xem cột hình ảnh có giá trị hay không nếu rỗng thì xuất file hình chandung.jpg và ngược lại 
									$hinhanh = ($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg';
							?>

							<img src="Image/<?php echo $hinhanh; ?>" class="user" onclick="toggleMenu()">

							<div class="submenudoc" id="subMenu" style="z-index: 1; height: 220px;">
								<div class="submenu">
									<div class="ttcn">

										<img src="Image/<?php echo $hinhanh; ?>">

								<?php } ?>
										
										<!-- Xuất biến SESSION tên đăng nhập -->
										<h3><?php echo $_SESSION['user_name']; ?></h3>
									</div>

									<hr>

									<a href="View/vTTchungnvql.php" class="submenulink">
										<i class='bx bx-user'></i>
										<p>Thông tin cá nhân</p>
										<span> > </span>
									</a>

									<a href="logout_nvql.php" class="submenulink">
										<i class='bx bx-log-out'></i>
										<p>Đăng xuất</p>
										<span> > </span>
									</a>
								</div>
							</div>
						</nav>

						<div class="ncc" style="background-color: #E4E9F7;">

							<?php
								// Kết nối file xử lý chức năng quản lý khách hàng
								if(isset($_REQUEST["khang"])) {
									include_once ("View/vKhang.php");
								}

								// Kết nối file xử lý chức năng quản lý đơn hàng
								if(isset($_REQUEST["dhang"])) {
									include_once ("View/vDhang.php");
								}

								// Kết nối file xử lý chức năng xem đơn hàng
								if(isset($_REQUEST["xemdhang"])) {
									include_once ("View/vXemDhang.php");
								}

								// Kiểm tra biến REQUEST có tồn tại không
								if(!isset($_REQUEST["khang"]) && !isset($_REQUEST["dhang"]) && !isset($_REQUEST["xemdhang"])) {
									echo '<b style="font-size: 30px; margin-left: 29%; ">TRANG DÀNH CHO NHÂN VIÊN BÁN HÀNG</b>';
								}
							?>
						</div>

						<!-- Trang chủ người dùng nhân viên bán hàng -->
						<div class="hidden-element">
							<div class="container">
								<div class="card bg-warning text-white" style="width: 60%; margin-left: 280px;">

									<!-- Tổng cộng số lượng khách hàng -->
									<div class="card-body">Khách hàng

										<?php
											// Lấy thông tin bảng khách hàng
											$query_kh = "SELECT * FROM khachhang";
											$result_kh = mysqli_query($con, $query_kh);
											
											// Kiểm tra biến result_kh có tồn tại không
											if ($result_kh) {

												// Hàm mysqli_num_rows sử dụng đếm số hàng kết quả trả về từ kết quả truy vấn
												$tong_kh = mysqli_num_rows($result_kh);
												
												// Kiểm tra biến tong_kh > 0
												if ($tong_kh > 0) {

													// In ra biến lưu kết quả truy vấn
													echo '<h4 class="mb-0">' .$tong_kh. '</h4>';
												} else {
													echo '<h4 class="mb-0">Không có khách hàng</h4>';
												}
											} 
										?>
									</div>
									
									<!-- Xem chi tiết -->
									<div class="card-footer d-flex align-items-center justify-content-between">
										<a class="small text-white" href="quanly.php?khang">Xem chi tiết</a>
										<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
									</div>
								</div>

								<div class="card bg-danger text-white" style="width: 60%;">

									<!-- Tổng cộng số lượng đơn hàng -->
									<div class="card-body">Đơn hàng

										<?php
											// Lấy thông tin bảng hóa đơn
											$query_hd = "SELECT * FROM hoadon";
											$result_hd = mysqli_query($con, $query_hd);
											
											// Kiểm tra biến result_hd có tồn tại không
											if ($result_hd) {

												// Hàm mysqli_num_rows sử dụng đếm số hàng kết quả trả về từ kết quả truy vấn
												$tong_hd = mysqli_num_rows($result_hd);
												
												// Kiểm tra biến tong_hd > 0
												if ($tong_hd > 0) {

													// In ra biến lưu kết quả truy vấn
													echo '<h4 class="mb-0">' .$tong_hd. '</h4>';
												} else {
													echo '<h4 class="mb-0">Không có đơn hàng</h4>';
												}
											} 
										?>
									</div>
									
									<!-- Xem chi tiết -->
									<div class="card-footer d-flex align-items-center justify-content-between">
										<a class="small text-white" href="quanly.php?dhang">Xem chi tiết</a>
										<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
									</div>
								</div>
							</div>
						</div>
					</section>

		<?php
				} elseif($_SESSION['nguoidung'] == 'Nhân viên giao hàng') {

					// Khai báo biến
					$tendnnv = $_SESSION['user_name'];

					// Lấy cột hình ảnh từ CSDL thuộc bảng nhân viên
					$query = "SELECT * FROM taikhoan tk JOIN nhanvien nv ON tk.matk = nv.matk WHERE tendn = '$tendnnv'";
					$result = mysqli_query($con, $query);
					$row = mysqli_fetch_assoc($result);
		?>

					<!-- Sidebar người dùng nhân viên giao hàng -->
					<div class="sidebar">
						<div class="logo-ct">
							<i class='bx bxs-book' ></i>
							<span class="logo_name">ITBOOK</span>
						</div>

						<ul class="nav-links">
							<li style="margin-bottom: 25px; margin-left:-4px;">
								<a href="quanly.php">
									<i class='bx bx-home'></i>
									<span class="link_name">Trang chủ</span>
								</a>
							</li>

							<li style="margin-left:-4px;">
								<div class="icon-link" >
									<a href="quanly.php?dhangnvgh">
										<i class='bx bx-collection' ></i>
										<span class="link_name">Đơn hàng</span>
									</a>
								</div>
							</li>
						</ul>

						<p style="margin-top: -170px; color: #fff; text-align: center; margin-right: 10px;">
							Nhóm 660 <br>
							Hà Thiên Phúc - 19437521 <br>
							Nguyễn Thanh Tân - 19454801
						</p>
					</div>

					<!-- Menu người dùng nhân viên giao hàng -->
					<section class="home-section">
						<nav class="hero">
							<div class="home-content">
								<i class='bx bx-menu'></i>
								<i class='bx bxs-book' ></i>
								<span class="text">ITBOOK</span>
							</div>

							<ul style="margin-bottom: -5px;">
								<li>
									<i class='bx bx-home'></i>
									<a href="quanly.php">Trang chủ</a>
								</li>
							</ul>

							<!-- Thông tin cá nhân -->
							<?php
								// Kiểm tra tên đăng nhập có tồn tại không
								if(isset($_SESSION['user_name'])) {
									
									// Kiểm tra xem cột hình ảnh có giá trị hay không nếu rỗng thì xuất file hình chandung.jpg và ngược lại 
									$hinhanh = ($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg';
							?>

							<img src="Image/<?php echo $hinhanh; ?>" class="user" onclick="toggleMenu()">

							<div class="submenudoc" id="subMenu" style="z-index: 1; height: 220px;">
								<div class="submenu">
									<div class="ttcn">
										
										<img src="Image/<?php echo $hinhanh; ?>">

								<?php } ?>
										
										<!-- Xuất biến SESSION tên đăng nhập -->
										<h3><?php echo $_SESSION['user_name']; ?></h3>
									</div>

									<hr>

									<a href="View/vTTchungnvql.php" class="submenulink">
										<i class='bx bx-user'></i>
										<p>Thông tin cá nhân</p>
										<span> > </span>
									</a>

									<a href="logout_nvql.php" class="submenulink">
										<i class='bx bx-log-out'></i>
										<p>Đăng xuất</p>
										<span> > </span>
									</a>
								</div>
							</div>
						</nav>

						<div class="ncc" style="background-color: #E4E9F7;">

							<?php
								// Kết nối file xử lý chức năng giao hàng
								if(isset($_REQUEST["dhangnvgh"])) {
									include_once ("View/vDhangnvgh.php");
								}

								// Kết nối file xử lý chức năng xem đơn hàng
								if(isset($_REQUEST["xemdhang"])) {
									include_once ("View/vXemDhang.php");
								}

								// Kiểm tra biến REQUEST có tồn tại không
								if(!isset($_REQUEST["dhangnvgh"]) && !isset($_REQUEST["xemdhang"])) {
									echo '<b style="font-size: 30px; margin-left: 28%; ">TRANG DÀNH CHO NHÂN VIÊN GIAO HÀNG</b>';
								}
							?>
						</div>

						<!-- Trang chủ người dùng nhân viên giao hàng -->
						<div class="hidden-element">
							<div class="container">

								<div class="card bg-danger text-white" style="width: 30%; margin-left: 510px;">

									<!-- Tổng cộng số lượng đơn hàng -->
									<div class="card-body">Đơn hàng

										<?php
											// Lấy thông tin bảng hóa đơn
											$query_hd = "SELECT * FROM hoadon";
											$result_hd = mysqli_query($con, $query_hd);
											
											// Kiểm tra biến result_hd có tồn tại không
											if ($result_hd) {

												// Hàm mysqli_num_rows sử dụng đếm số hàng kết quả trả về từ kết quả truy vấn
												$tong_hd = mysqli_num_rows($result_hd);
												
												// Kiểm tra biến tong_hd > 0
												if ($tong_hd > 0) {

													// In ra biến lưu kết quả truy vấn
													echo '<h4 class="mb-0">' .$tong_hd. '</h4>';
												} else {
													echo '<h4 class="mb-0">Không có đơn hàng</h4>';
												}
											} 
										?>
									</div>
									
									<!-- Xem chi tiết -->
									<div class="card-footer d-flex align-items-center justify-content-between">
										<a class="small text-white" href="quanly.php?dhangnvgh">Xem chi tiết</a>
										<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
									</div>
								</div>
							</div>
						</div>
					</section>
		<?php
				}

			} else {
				echo '<script>
                    alert("Bạn vui lòng đăng nhập");
                    window.location.href="login_nvql.php";
                </script>';
			}
		?>
		
		<!-- Javascript menu, sidebar -->
		<script>
			let arrow = document.querySelectorAll(".arrow");
			for (var i = 0; i < arrow.length; i++) {
				arrow[i].addEventListener("click", (e)=>{
				let arrowParent = e.target.parentElement.parentElement;
					arrowParent.classList.toggle("showMenu");
				});
			}

			let sidebar = document.querySelector(".sidebar");
			let sidebarBtn = document.querySelector(".bx-menu");
				console.log(sidebarBtn);
			sidebarBtn.addEventListener("click", ()=>{
				sidebar.classList.toggle("close");
			});

			let subMenu = document.getElementById("subMenu");
			function toggleMenu(){
				subMenu.classList.toggle("open-menu");
			}
		</script>
	</body>
</html>