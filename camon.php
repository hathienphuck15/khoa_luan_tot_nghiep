<?php
	// Hàm bắt đầu session
	session_start();

	// Kết nối CSDL
	include_once(__DIR__ . "/Model/ketnoi.php");

	// Gọi hàm trong class của Model
	$p = new clsketnoi();
	$connect = $p->ketnoiDB($con);
	
	// Kiểm tra kết nối
	if (!$con) {
		die("Kết nối thất bại: " . mysqli_connect_error());
	}

	// Kiểm tra biến GET partnerCode có tồn tại không
	if(isset($_GET['partnerCode'])) {
		$codeOrder = rand(0,9999);
		$partnerCode = $_GET['partnerCode'];
		$orderId = $_GET['orderId'];
		$amount = $_GET['amount'];
		$orderInfo = $_GET['orderInfo'];
		$orderType = $_GET['orderType'];
		$transId = $_GET['transId'];
		$payType = $_GET['payType'];
		$insert_momo = "INSERT INTO momo(partnerCode, orderId, amount, orderInfo, orderType, transId, payType, codeOrder) VALUE ('".$partnerCode."', '".$orderId."','".$amount."','".$orderInfo."','".$orderType."','".$transId."','".$payType."','".$codeOrder."')";
		$cart_query = mysqli_query($con, $insert_momo);
	}

	if(isset($cart_query)) {
		echo '<script>
				alert("Giao dịch thanh toán MoMo ATM thành công");
				window.location.href="sanpham.php";
			</script>';
	} else {
		echo '<script>
				alert("Giao dịch thanh toán MoMo ATM thất bại");
				window.location.href="sanpham.php";
			</script>';
	}
	
	// Đóng kết nối CSDL
	mysqli_close($con);

	// Hủy SESSION của giỏ hàng
	unset($_SESSION["cart"]);
?>
	


	  