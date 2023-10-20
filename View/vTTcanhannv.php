<?php
	// Kết nối đến CSDL
	include_once(__DIR__ . "/../Model/ketnoi.php");

	// Gọi hàm trong class của Model
	$p = new clsketnoi();
	$connect = $p->ketnoiDB($con);

	// Truy vấn CSDL để lấy thông tin nhân viên
	if(isset($_SESSION['manv'])) {
		$manv = $_SESSION['manv'];

		// Lấy thông tin nhân viên từ CSDL
		$query = "SELECT * FROM nhanvien WHERE manv = '$manv'";
		$result = mysqli_query($con, $query);
	}

	// Kiểm tra kết quả trả về từ CSDL
	if ($result && mysqli_num_rows($result) > 0) {

		// Lấy thông tin nhân viên từ CSDL
		$row = mysqli_fetch_assoc($result);

	} else {

		// Xử lý lỗi khi không tìm thấy nhân viên
		echo '<script>alert("Không tìm thấy thông tin nhân viên.")</script>';
	}

	// Kiểm tra nếu người dùng đã bấm nút cập nhật
	if (isset($_POST['update_info'])) {

		// Lấy thông tin từ form
		$tennv = $_POST['tennv'];
		$diachi = $_POST['diachi'];
		$sodienthoai = $_POST['sodienthoai'];
		$email = $_POST['email'];
		$hinhanh = $_POST['hinhanh'];
		$manv = $_SESSION['manv'];

		// Cập nhật thông tin nhân viên vào CSDL
		$query = "UPDATE nhanvien SET tennv = '$tennv', diachi = '$diachi', sodienthoai = '$sodienthoai', email = '$email', hinhanh = '$hinhanh' WHERE manv = '$manv'";
		$result = mysqli_query($con, $query);

		// Kiểm tra kết quả cập nhật và hiển thị thông báo nếu thành công hoặc thất bại
		if ($result) {

			// Lấy lại thông tin nhân viên từ CSDL sau khi cập nhật thành công
			$query = "SELECT * FROM nhanvien WHERE manv = '$manv'";
			$result = mysqli_query($con, $query);

			if ($result && mysqli_num_rows($result) > 0) {

				// Lấy thông tin nhân viên từ CSDL
				$row = mysqli_fetch_assoc($result);
				echo '<script type="text/javascript">';
				echo 'alert("Cập nhật thông tin thành công.");';
				echo '</script>';

			} else {
				echo '<script type="text/javascript">';
				echo 'alert("Cập nhật thông tin thất bại.");';
				echo '</script>';
			}
		}
	}

	// Đóng kết nối CSDL
	mysqli_close($con);
?>

<h1 style="margin-top: 15px; text-align: center; margin-left: 30px; font-size: 30px;">Cập nhật thông tin cá nhân</h1>

<div class="info-container" style="margin-left: 435px;">
	<h2>Thông tin tài khoản</h2>

	<!-- Form cập nhật thông tin, onsubmit="return validateForm()" gọi hàm của Javascript nếu đúng nó sẽ gửi thông cập nhật còn sai nó sẽ hiển thị lỗi đã thiết lập trong hàm -->
	<form method="post" onsubmit="return validateForm()">
		<label for="tennv">Tên nhân viên:</label>
		<input type="text" id="tennv" name="tennv" value="<?php echo $row['tennv']; ?>" required>

		<label for="diachi">Địa chỉ:</label>
		<input type="text" id="diachi" name="diachi" value="<?php echo $row['diachi']; ?>" required>

		<label for="sodienthoai">Số điện thoại:</label>
		<input type="text" id="sodienthoai" name="sodienthoai" value="<?php echo $row['sodienthoai']; ?>" required>

		<label for="email">Email:</label>
		<input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>

		<label for="hinhanh">Hình ảnh:</label>
		<input type="file" id="hinhanh" name="hinhanh" value="<?php echo $row['hinhanh']; ?>" required>

		<input type="submit" name="update_info" value="Cập nhật">
		<input type="reset" value="Reset">
	</form>
</div>

<script>
	// Hàm kiểm tra các trường của Form
	function validateForm() {

		// Khai báo biến để lấy giá trị của trường nhập với id
		var email = document.getElementById("email").value;
		var sodienthoai = document.getElementById("sodienthoai").value;
		var hinhanh = document.getElementById("hinhanh").value;

		// Kiểm tra email
		// Khai báo biến cho bằng biểu thức đệ quy để kiểm tra
		var emailRegex = /\S+@\S+\.\S+/;

		if (!emailRegex.test(email)) {
			alert("Email không đúng định dạng!");

			// Ngăn chặn Form gửi đi nếu sai 
			event.preventDefault();
		}

		// Kiểm tra số điện thoại
		// Khai báo biến cho bằng biểu thức đệ quy để kiểm tra
		var sodienthoaiRegex = /^0[0-9]{9}$/;

		if (!sodienthoaiRegex.test(sodienthoai)) {
			alert("Số điện thoại không đúng định dạng!");

			// Ngăn chặn Form gửi đi nếu sai 
			event.preventDefault();
		}

		// Kiểm tra định dạng hình ảnh
		// Khai báo biến cho bằng biểu thức đệ quy để kiểm tra
		var hinhanhRegex = /\.(jpeg|jpg|png)$/;

		if (!hinhanhRegex.test(hinhanh)) {
			alert("Chỉ cho upload hình ảnh có định dạng JPEG, PNG, JPG!");

			// Ngăn chặn Form gửi đi nếu sai 
			event.preventDefault();
		}

		// Quay về true sau khi cập nhật lại
    	return true;
  	}
</script>