<?php
	// Hàm bắt đầu session
	session_start();

	// Kết nối CSDL
	include_once(__DIR__ . "/../Model/ketnoi.php");

	// Gọi hàm trong class của Model
	$p = new clsketnoi();
	$connect = $p->ketnoiDB($con);

	// Kiểm tra biến SESSION user_name có tồn tại không
	if(!isset($_SESSION['user_name'])) {
		echo '<script>
            alert("Bạn vui lòng đăng nhập.");
            window.location.href="../login_nvql.php";
        </script>';
        exit;
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>ITBOOK</title>

		<!-- Link CSS -->
		<link rel="stylesheet" href="../CSS/quanly.css">

		<!-- Link Boxicons -->
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

		<style>
			/* CSS cho container chứa thông tin cá nhân */
            .info-container {
                margin: 20px auto;
                max-width: 600px;
                padding: 20px;
                border: 1px solid #ccc;
                margin-left: -13px;
            }

            /* CSS cho tiêu đề h2 */
            .info-container h2 {
                font-size: 28px;
                margin-bottom: 20px;
                text-align: center;
                font-weight: 600;
            }

            /* CSS cho label */
            .info-container label {
                display: block;
                font-weight: 600;
                margin-bottom: 5px;
				font-size: 18px;
            }

            /* CSS cho input */
            .info-container input[type=text], .info-container input[type=email], .info-container input[type=file], .info-container input[type=password] {
                width: 100%;
                padding: 10px;
                margin-bottom: 20px;
                border-radius: 5px;
                border: 1px solid #ccc;
				font-size: 18px;
            }

            /* CSS cho nút cập nhật */
            .info-container input[type=submit] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin-left: 340px;
				font-size: 18px;
            }

            .info-container input[type=submit]:hover {
                background-color: #3e8e41;
            }

            /* CSS cho nút reset */
            .info-container input[type=reset] {
                background-color: #fac564;
                color: black;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
				font-size: 18px;
            }

            .info-container input[type=reset]:hover {
                background-color: transparent;
                border: 2px solid #fac564;
            }
		</style>
	</head>

	<body>
		<?php
			// Kiểm tra tên đăng nhập có tồn tại không
			if(isset($_SESSION['user_name'])) {
				if($_SESSION['nguoidung'] == 'Quản lý') {

					// Khai báo biến
					$tendnql = $_SESSION['user_name'];

					// Lấy cột hình ảnh từ CSDL thuộc bảng quản lý
					$query = "SELECT * FROM taikhoan tk JOIN quanly ql ON tk.matk = ql.matk WHERE tendn = '$tendnql'";
					$result = mysqli_query($con, $query);
					$row = mysqli_fetch_assoc($result);
		?>

		<!-- Sidebar người dùng quản lý -->
		<div class="sidebar" style="background-color: #27ae60;">
			<div class="logo-ct">
				<i class='bx bxs-book' ></i>
				<span class="logo_name">ITBOOK</span>
			</div>

			<ul class="nav-links">
				<li style="margin-bottom: 25px; margin-left:-4px;">
					<a href="../quanly.php">
						<i class='bx bx-home'></i>
						<span class="link_name">Trang chủ</span>
					</a>
				</li>

				<li style="margin-bottom: 25px; margin-left:-4px;">
					<a href="vTTchungnvql.php?ttcn">
                        <i class='bx bx-user'></i>
						<span class="link_name">Thông tin cá nhân</span>
					</a>
				</li>

                <li style="margin-bottom: 25px; margin-left:-4px;">
					<a href="vTTchungnvql.php?dmk">
                        <i class='bx bx-reset'></i>
						<span class="link_name">Đổi mật khẩu</span>
					</a>
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
			<nav class="hero" style="background-color: #27ae60;">
				<div class="home-content">
					<i class='bx bx-menu'></i>
					<i class='bx bxs-book' ></i>
					<span class="text">ITBOOK</span>
				</div>

				<ul style="margin-bottom: -5px;">
					<li>
						<i class='bx bx-home'></i>
						<a href="../quanly.php">Trang chủ</a>
					</li>
				</ul>

				<!-- Thông tin cá nhân -->
				<?php
					// Kiểm tra tên đăng nhập có tồn tại không
					if(isset($_SESSION['user_name'])) {
						
						// Kiểm tra xem cột hình ảnh có giá trị hay không nếu rỗng thì xuất file hình chandung.jpg và ngược lại 
						$hinhanh = ($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg';
				?>

				<img src="../Image/<?php echo $hinhanh; ?>" class="user" onclick="toggleMenu()">

				<div class="submenudoc" id="subMenu" style="z-index: 1; height: 220px;">
					<div class="submenu">
						<div class="ttcn">

							<img src="../Image/<?php echo $hinhanh; ?>">

					<?php }  ?>
							
							<!-- Xuất biến SESSION tên đăng nhập -->
							<h3><?php echo $_SESSION['user_name']; ?></h3>
						</div>

						<hr>

						<a href="vTTchungnvql.php" class="submenulink">
							<i class='bx bx-user'></i>
							<p>Thông tin cá nhân</p>
							<span> > </span>
						</a>

						<a href="../logout_nvql.php" class="submenulink">
							<i class='bx bx-log-out'></i>
							<p>Đăng xuất</p>
							<span> > </span>
						</a>
					</div>
				</div>
			</nav>

			<div class="ncc" style="background-color: #E4E9F7; height: 750px;">

				<?php
					// Kết nối file xử lý chức năng cập nhật thông tin cá nhân quản lý
                    if(isset($_REQUEST["ttcn"])) {
                        include_once ("vTTcanhanql.php");
                    }

					// Kết nối file xử lý chức năng đổi mật khẩu quản lý
					if(isset($_REQUEST["dmk"])) {
                        include_once ("vDmkql.php");
                    }

					// Kiểm tra biến REQUEST không tồn tại
                    if(!isset($_REQUEST["ttcn"]) && !isset($_REQUEST["dmk"])) {
						include_once ("vTTcanhanql.php");
                    }
                ?>
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
					<div class="sidebar" style="background-color: #27ae60;">
						<div class="logo-ct">
							<i class='bx bxs-book' ></i>
							<span class="logo_name">ITBOOK</span>
						</div>

						<ul class="nav-links">
							<li style="margin-bottom: 25px; margin-left:-4px;">
								<a href="../quanly.php">
									<i class='bx bx-home'></i>
									<span class="link_name">Trang chủ</span>
								</a>
							</li>

							<li style="margin-bottom: 25px; margin-left:-4px;">
								<a href="vTTchungnvql.php?ttcnnv">
									<i class='bx bx-user'></i>
									<span class="link_name">Thông tin cá nhân</span>
								</a>
							</li>

							<li style="margin-bottom: 25px; margin-left:-4px;">
								<a href="vTTchungnvql.php?dmknv">
									<i class='bx bx-reset'></i>
									<span class="link_name">Đổi mật khẩu</span>
								</a>
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
						<nav class="hero" style="background-color: #27ae60;">
							<div class="home-content">
								<i class='bx bx-menu'></i>
								<i class='bx bxs-book' ></i>
								<span class="text">ITBOOK</span>
							</div>

							<ul style="margin-bottom: -5px;">
								<li>
									<i class='bx bx-home'></i>
									<a href="../quanly.php">Trang chủ</a>
								</li>
							</ul>

							<!-- Thông tin cá nhân -->
							<?php
								// Kiểm tra tên đăng nhập có tồn tại không
								if(isset($_SESSION['user_name'])) {
									
									// Kiểm tra xem cột hình ảnh có giá trị hay không nếu rỗng thì xuất file hình chandung.jpg và ngược lại 
									$hinhanh = ($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg';
							?>

							<img src="../Image/<?php echo $hinhanh; ?>" class="user" onclick="toggleMenu()">

							<div class="submenudoc" id="subMenu" style="z-index: 1; height: 220px;">
								<div class="submenu">
									<div class="ttcn">
										
										<img src="../Image/<?php echo $hinhanh; ?>">
										
								<?php } ?>

										<!-- Xuất biến SESSION tên đăng nhập -->
										<h3><?php echo $_SESSION['user_name']; ?></h3>
									</div>

									<hr>

									<a href="vTTchungnvql.php" class="submenulink">
										<i class='bx bx-user'></i>
										<p>Thông tin cá nhân</p>
										<span> > </span>
									</a>

									<a href="../logout_nvql.php" class="submenulink">
										<i class='bx bx-log-out'></i>
										<p>Đăng xuất</p>
										<span> > </span>
									</a>
								</div>
							</div>
						</nav>

						<div class="ncc" style="background-color: #E4E9F7; height: 750px;">

							<?php
								// Kết nối file xử lý chức năng cập nhật thông tin cá nhân nhân viên bán hàng
								if(isset($_REQUEST["ttcnnv"])) {
									include_once ("vTTcanhannv.php");
								}

								// Kết nối file xử lý chức năng đổi mật khẩu nhân viên bán hàng
								if(isset($_REQUEST["dmknv"])) {
									include_once ("vDmknv.php");
								}

								// Kiểm tra biến REQUEST không tồn tại
								if(!isset($_REQUEST["ttcnnv"]) && !isset($_REQUEST["dmknv"])) {
									include_once ("vTTcanhannv.php");
								}
							?>
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
					<div class="sidebar" style="background-color: #27ae60;">
						<div class="logo-ct">
							<i class='bx bxs-book' ></i>
							<span class="logo_name">ITBOOK</span>
						</div>

						<ul class="nav-links">
							<li style="margin-bottom: 25px; margin-left:-4px;">
								<a href="../quanly.php">
									<i class='bx bx-home'></i>
									<span class="link_name">Trang chủ</span>
								</a>
							</li>

							<li style="margin-bottom: 25px; margin-left:-4px;">
								<a href="vTTchungnvql.php?ttcnnvgh">
									<i class='bx bx-user'></i>
									<span class="link_name">Thông tin cá nhân</span>
								</a>
							</li>

							<li style="margin-bottom: 25px; margin-left:-4px;">
								<a href="vTTchungnvql.php?dmknvgh">
									<i class='bx bx-reset'></i>
									<span class="link_name">Đổi mật khẩu</span>
								</a>
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
						<nav class="hero" style="background-color: #27ae60;">
							<div class="home-content">
								<i class='bx bx-menu'></i>
								<i class='bx bxs-book' ></i>
								<span class="text">ITBOOK</span>
							</div>

							<ul style="margin-bottom: -5px;">
								<li>
									<i class='bx bx-home'></i>
									<a href="../quanly.php">Trang chủ</a>
								</li>
							</ul>

							<!-- Thông tin cá nhân -->
							<?php
								// Kiểm tra tên đăng nhập có tồn tại không
								if(isset($_SESSION['user_name'])) {
									
									// Kiểm tra xem cột hình ảnh có giá trị hay không nếu rỗng thì xuất file hình chandung.jpg và ngược lại 
									$hinhanh = ($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg';
							?>

							<img src="../Image/<?php echo $hinhanh; ?>" class="user" onclick="toggleMenu()">

							<div class="submenudoc" id="subMenu" style="z-index: 1; height: 220px;">
								<div class="submenu">
									<div class="ttcn">

										<img src="../Image/<?php echo $hinhanh; ?>">

								<?php } ?>
										
										<!-- Xuất biến SESSION tên đăng nhập -->
										<h3><?php echo $_SESSION['user_name']; ?></h3>
									</div>

									<hr>

									<a href="vTTchungnvql.php" class="submenulink">
										<i class='bx bx-user'></i>
										<p>Thông tin cá nhân</p>
										<span> > </span>
									</a>

									<a href="../logout_nvql.php" class="submenulink">
										<i class='bx bx-log-out'></i>
										<p>Đăng xuất</p>
										<span> > </span>
									</a>
								</div>
							</div>
						</nav>

						<div class="ncc" style="background-color: #E4E9F7; height: 750px;">

							<?php
								// Kết nối file xử lý chức năng cập nhật thông tin cá nhân nhân viên giao hàng
								if(isset($_REQUEST["ttcnnvgh"])) {
									include_once ("vTTcanhannv.php");
								}

								// Kết nối file xử lý chức năng đổi mật khẩu nhân viên giao hàng
								if(isset($_REQUEST["dmknvgh"])) {
									include_once ("vDmknv.php");
								}

								// Kiểm tra biến REQUEST không tồn tại
								if(!isset($_REQUEST["ttcnnvgh"]) && !isset($_REQUEST["dmknvgh"])) {
									include_once ("vTTcanhannv.php");
								}
							?>
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