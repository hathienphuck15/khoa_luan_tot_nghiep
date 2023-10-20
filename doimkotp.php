<?php
  // Kết nối CSDL
  include_once(__DIR__ . "/Model/ketnoi.php");

  // Kết nối thư viện PHPMailer
  include_once(__DIR__ . "/mail/src/Exception.php");
  include_once(__DIR__ . "/mail/src/PHPMailer.php");
  include_once(__DIR__ . "/mail/src/SMTP.php");

  // Khai báo thư viện PHPMailer
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  // Hàm bắt đầu session
  session_start();

  // Gọi hàm trong class của Model
  $p = new clsketnoi();
  $connect = $p->ketnoiDB($con);

  // Kiểm tra biến POST submitotp có tồn tại không
  if(isset($_POST['submitotp'])) {

    // Nhận đầu vào của người dùng và làm sạch để ngăn chặn SQL injection
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Kiểm tra định dạng email dùng hàm filter_var
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo '<script>alert("Định dạng email không hợp lệ.")</script>';

    } else {

      // Câu truy vấn SQL
      $doimk = "SELECT * FROM khachhang kh JOIN taikhoan tk ON kh.matk = tk.matk WHERE `email` = '$email'";
      $result = mysqli_query($con, $doimk);

      if (mysqli_num_rows($result) > 0) {

        // Tạo mã OTP bằng cách chạy ngẫu nhiên từ 100000 -> 999999
        $otp = rand(100000, 999999);

        // Khai báo biến
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        // Gọi hàm trong thư viện PHPMailer
        $mail = new PHPMailer(true);
        
        // Thiết lập thông tin SMTP (máy chủ email)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hathienphuc12a8@gmail.com';
        
        // Xóa password sẽ bị lỗi
        $mail->Password = 'wzyyfqzbkzpobvyf';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Đặt địa chỉ email và tên của người gửi
        $mail->setFrom('hathienphuc12a8@gmail.com', 'ITBOOK');

        // Thêm địa chỉ email của người nhận
        $mail->addAddress($email);
        
        // Nội dung email và dùng base64_encode để mã hóa nội dung theo UTF-8 để không bị lỗi phông chữ khi nhận email
        $mail->isHTML(true);
        $mail->Subject = '=?UTF-8?B?'.base64_encode('Mã OTP đặt lại mật khẩu').'?=';
        $mail->Body = 'Mã OTP của bạn là: ' . $otp;
        $mail->CharSet = 'UTF-8';

        // Xét điều kiện hàm gửi mail trong thư viện
        if($mail->send()) {
          header("Location: xacthucotp.php");
        } else {
          echo '<script>alert("Gửi mã OTP thất bại.")</script>';
        }

      } else {
        echo '<script>alert("Email chưa được đăng ký.")</script>';
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

      <!-- Form đổi mật khẩu OTP -->
      <form method="POST">
        <h3>Đổi mật khẩu OTP</h3>
        <input type="email" name="email" required placeholder="Nhập email">
        <input type="submit" name="submitotp" value="Gửi mã OTP" class="form-btn">
      </form>
    </div>
  </body>
</html>