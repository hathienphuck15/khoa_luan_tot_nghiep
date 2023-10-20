<?php
  // Kết nối CSDL
  include_once(__DIR__ . "/Model/ketnoi.php");

  // Hàm bắt đầu session
  session_start();

  // Gọi hàm trong class của Model
  $p = new clsketnoi();
  $connect = $p->ketnoiDB($con);

  // Kiểm tra biến SESSION otp, email có tồn tại không
  if(!isset($_SESSION['otp']) || !isset($_SESSION['email'])) {
    echo '<script>
      alert("Bạn chưa nhập email.");
      window.location.href="doimkotp.php";
    </script>';

  } else {

    // Kiểm tra biến POST dmkotp có tồn tại không
    if(isset($_POST['dmkotp'])) {

      // Nhận đầu vào của người dùng và làm sạch để ngăn chặn SQL injection
      $otp = mysqli_real_escape_string($con, $_POST['otp']);

      // Xét điều kiện biến nhập otp bằng biến SESSION otp
      if($otp == $_SESSION['otp']) {
        header("Location: resetpassword.php");
      } else {
        echo '<script>alert("Mã OTP không đúng.")</script>';
      }
    }
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
    <link rel="stylesheet" href="CSS/form.css">
  </head>

  <body>
    <div class="form-container">

      <!-- Form nhập mã OTP -->
      <form method="POST">
        <h3>Mã OTP</h3>
        <input type="text" name="otp" required placeholder="Nhập mã OTP">
        <input type="submit" name="dmkotp" value="Xác minh" class="form-btn">
      </form>
    </div>
  </body>
</html>






