<?php
    // Kết nối CSDL
    include_once(__DIR__ . "/Model/ketnoi.php");

    // Gọi hàm trong class của Model
    $p = new clsketnoi();
    $connect = $p->ketnoiDB($con);

    // Truy vấn CSDL để lấy thông tin mật khẩu
	if(isset($_SESSION['matk'])) {
		$matk = $_SESSION['matk'];

		// Lấy thông tin mật khẩu từ CSDL
		$query = "SELECT * FROM taikhoan WHERE matk = '$matk'";
		$result = mysqli_query($con, $query);
	}

    // Kiểm tra kết quả trả về từ CSDL
	if ($result && mysqli_num_rows($result) > 0) {

		// Lấy thông tin mật khẩu từ CSDL
		$row = mysqli_fetch_assoc($result);

	} else {

		// Xử lý lỗi khi không tìm thấy mật khẩu
		echo '<script>alert("Không tìm thấy thông tin mật khẩu.")</script>';
	}

    // Kiểm tra nếu người dùng đã bấm nút cập nhật
	if (isset($_POST['changepass'])) {

		// Lấy thông tin từ form
		$matkhaucu = isset($_POST['matkhaucu']);
		$matkhau = md5($_POST['matkhau']);
		$matkhaunl = md5($_POST['matkhaunl']);
		$matk = $_SESSION['matk'];

		// Kiểm tra mật khẩu mới khác mật khẩu cũ
		if($matkhau == $row['matkhau']) {
			echo '<script type="text/javascript">';
			echo 'alert("Mật khẩu mới phải khác mật khẩu cũ.");';
			echo '</script>';

		} else {

			// Cập nhật thông tin mật khẩu vào CSDL
			$query = "UPDATE taikhoan SET matkhau = '$matkhau' WHERE matk = '$matk'";
			$result = mysqli_query($con, $query);

			// Kiểm tra kết quả cập nhật và hiển thị thông báo nếu thành công hoặc thất bại
			if ($result) {

				// Lấy lại thông tin mật khẩu từ CSDL sau khi cập nhật thành công
				$query = "SELECT * FROM taikhoan WHERE matk = '$matk'";
				$result = mysqli_query($con, $query);

				if ($result && mysqli_num_rows($result) > 0) {

					// Lấy thông tin mật khẩu từ CSDL
					$row = mysqli_fetch_assoc($result);
					echo '<script type="text/javascript">';
					echo 'alert("Đổi mật khẩu thành công.");';
					echo '</script>';

				} else {
					echo '<script type="text/javascript">';
					echo 'alert("Đổi mật khẩu thất bại.");';
					echo '</script>';
				}
			}
		}
	}
?>

<h1 style="margin-top: -5px; text-align: center; margin-left: -300px;">Đổi mật khẩu</h1>

<div class="info-container" style="margin-left: -10px;">
	<h2>Thông tin mật khẩu</h2>

	<!-- Form cập nhật thông tin, onsubmit="return validateForm()" gọi hàm của Javascript nếu đúng nó sẽ gửi thông cập nhật còn sai nó sẽ hiển thị lỗi đã thiết lập trong hàm -->
	<form method="post" onsubmit="return validateForm()">
		<label for="matkhaucu">Mật khẩu cũ:</label>
		<input type="password" id="matkhaucu" name="matkhaucu" value="<?php echo $row['matkhau']; ?>" required disabled>

		<label for="matkhau">Mật khẩu mới:</label>
		<input type="password" id="matkhau" name="matkhau" required>

		<label for="matkhaunl">Nhập lại mật khẩu mới:</label>
		<input type="password" id="matkhaunl" name="matkhaunl" required>

		<input type="submit" name="changepass" value="Cập nhật">
		<input type="reset" value="Reset">
	</form>
</div>

<script>
	function validateForm() {
		// Lấy giá trị của các trường
		var matkhau = document.getElementById("matkhau").value;
		var matkhaunl = document.getElementById("matkhaunl").value;

		// Kiểm tra mật khẩu mới ít nhất 8 ký tự
		if (matkhau.length < 8) {
			alert("Mật khẩu mới phải ít nhất 8 ký tự.");
			
			// Ngăn chặn Form gửi đi nếu sai 
			event.preventDefault();
		}

		// Kiểm tra mật khẩu mới với nhập lại mật khẩu mới phải trùng khớp
		if (matkhau != matkhaunl) {
			alert("Mật khẩu mới và nhập lại mật khẩu mới không trùng khớp.");

			// Ngăn chặn Form gửi đi nếu sai 
			event.preventDefault();
		}

		// Nếu các điều kiện đều đúng thì submit form
		return true;
	}
</script>