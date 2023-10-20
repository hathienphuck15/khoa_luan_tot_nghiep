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

    // Kiểm tra biến POST resetmk có tồn tại không
    if(isset($_POST['resetmk'])) {

      // Khai báo biến
      $email = $_SESSION['email'];

      // Nhận đầu vào của người dùng và làm sạch để ngăn chặn SQL injection
      $password = mysqli_real_escape_string($con, md5($_POST['password']));

      // Kiểm tra mật khẩu mới có ít nhất 8 ký tự dùng strlen đếm số ký tự trong một chuỗi
      if(strlen($_POST['password']) < 8) {
        echo '<script>
          alert("Mật khẩu phải có ít nhất 8 ký tự.");
          window.location.href="resetpassword.php";
        </script>';
        exit();
      }

      // Câu truy vấn SQL
      $oldpass = "SELECT matkhau FROM taikhoan tk JOIN khachhang kh ON kh.matk = tk.matk WHERE email = '$email'";
      $result = mysqli_query($con, $oldpass);

      // Lấy một hàng dữ liệu từ kết quả truy vấn
      $row = mysqli_fetch_assoc($result);

      // Khai báo biến cho bằng với cột mật khẩu thuộc bảng tài khoản trong CSDL
      $currentpass = $row['matkhau'];

      // Kiểm tra mật khẩu mới khác mật khẩu hiện tại
      if($password == $currentpass) {
        echo '<script>
          alert("Mật khẩu mới phải khác mật khẩu hiện tại.");
          window.location.href="resetpassword.php";
        </script>';
        exit();
      }

      // Câu truy vấn SQL
      $datmk = "UPDATE taikhoan tk JOIN khachhang kh ON kh.matk = tk.matk SET matkhau = '$password' WHERE email = '$email'";
      $result = mysqli_query($con, $datmk);

      // Hủy biến SESSION
      unset($_SESSION['otp']);
      unset($_SESSION['email']);
      
      // Thông báo
      echo '<script>
        alert("Đổi mật khẩu thành công.");
        window.location.href="login_kh.php";
      </script>';
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

      <!-- Form reset mật khẩu -->
      <form method="POST">
        <h3>Đặt lại mật khẩu</h3>
        <input type="password" name="password" required placeholder="Nhập mật khẩu mới">
        <input type="submit" name="resetmk" value="Đặt lại" class="form-btn">
      </form>
    </div>
  </body>
</html>