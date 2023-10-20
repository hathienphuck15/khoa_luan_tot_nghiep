<?php
   // Kết nối CSDL
   include_once(__DIR__ . "/Model/ketnoi.php");

   // Hàm bắt đầu session
   session_start();

   // Gọi hàm trong class của Model
   $p = new clsketnoi();
   $connect = $p->ketnoiDB($con);
      
   if(isset($_POST['submit'])) {

      // Nhận đầu vào của người dùng và làm sạch để ngăn chặn SQL injection
      $name = mysqli_real_escape_string($con, $_POST['tendn']);
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $pass = mysqli_real_escape_string($con, md5($_POST['password']));
      $cpass = mysqli_real_escape_string($con, md5($_POST['cpassword']));
      $nguoidung = mysqli_real_escape_string($con, $_POST['nguoidung']);
      $hoten = mysqli_real_escape_string($con, $_POST['hoten']);
      $diachi = mysqli_real_escape_string($con, $_POST['diachi']);
      $sdt = mysqli_real_escape_string($con, $_POST['sdt']);
      $khoa = 0;

      // Kiểm tra xem tên đăng nhập đã tồn tại hay chưa
      $select = "SELECT * FROM taikhoan WHERE tendn = '$name'";
      $result = mysqli_query($con, $select);

      if(mysqli_num_rows($result) > 0) {
         $error[] = 'Tên đăng nhập đã tồn tại';
      }

      // Kiểm tra xem mật khẩu đã tồn tại hay chưa
      $select = "SELECT * FROM taikhoan WHERE matkhau = '$pass'";
      $result = mysqli_query($con, $select);

      if(mysqli_num_rows($result) > 0) {
         $error[] = 'Mật khẩu đã tồn tại';
      }

      // Kiểm tra email
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $error[] = 'Email không hợp lệ';
      }

      // Kiểm tra phone
      if(!preg_match('/^[0-9]{10}$/', $sdt)) {
         $error[] = 'Số điện thoại không hợp lệ';
      }

      // Kiểm tra tên đăng nhập
      if(strlen($_POST['tendn']) < 5) {
         $error[] = 'Tên đăng nhập phải có ít nhất 5 ký tự';
      }

      // Kiểm tra mật khẩu
      if(strlen($_POST['password']) < 8) {
         $error[] = 'Mật khẩu phải có ít nhất 8 ký tự';
      }

      // Kiểm tra nhập lại mật khẩu
      if($pass != $cpass) {
         $error[] = 'Mật khẩu và nhập lại mật khẩu không trùng khớp';
      } 
      
      // Kiểm tra mảng lỗi, nếu không có lỗi thì tiến hành đăng ký
      if(empty($error)) {

         // Đưa dữ liệu vào đúng bảng
         if($nguoidung == 'Khách hàng') {
            $insert_tk = "INSERT INTO taikhoan (tendn, matkhau, nguoidung, khoatk) VALUES ('$name', '$pass', '$nguoidung', '$khoa')";
                  
            if(mysqli_query($con, $insert_tk)) {
               $matk = mysqli_insert_id($con);
               $insert_kh = "INSERT INTO khachhang (tenkh, diachi, sodienthoai, email, matk, hinhanh) VALUES ('$hoten', '$diachi', '$sdt', '$email', '$matk', '')";
                     
               if(mysqli_query($con, $insert_kh)) {
                  echo '<script>
                     alert("Đăng ký thành công");
                     window.location.href="login_kh.php";
                  </script>';
                  exit;

               } else {
                  $error[] = 'Có lỗi xảy ra khi đăng ký';
               }

            } else {
               $error[] = 'Có lỗi xảy ra khi đăng ký';
            }

         } elseif ($nguoidung == 'Nhân viên bán hàng' || $nguoidung == 'Nhân viên giao hàng') {
            $insert_tk = "INSERT INTO taikhoan (tendn, matkhau, nguoidung, khoatk) VALUES('$name', '$pass', '$nguoidung', '$khoa')";
               
            if(mysqli_query($con, $insert_tk)){
               $matk = mysqli_insert_id($con);
               $insert_nv = "INSERT INTO nhanvien (tennv, diachi, sodienthoai, email, matk, hinhanh) VALUES ('$hoten', '$diachi', '$sdt', '$email', '$matk', '')";
                  
               if(mysqli_query($con, $insert_nv)){
                  echo '<script>
                     alert("Đăng ký thành công tài khoản nhân viên");
                     window.location.href="login_nvql.php";
                  </script>';
                  exit;

               } else {
                  $error[] = 'Có lỗi xảy ra khi đăng ký';
               }

            } else {
               $error[] = 'Có lỗi xảy ra khi đăng ký';
            }
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

         <!-- Form đăng ký -->
         <form action="#" method="post">
            <h3>Đăng ký</h3>

            <!-- Kiểm tra biến và hiển thị lỗi -->
            <?php
               if(!empty($error)) {
                  foreach($error as $err) {
                     echo '<span class="error-msg">'.$err.'</span>';
                  }
               }
            ?>

            <input type="text" name="tendn" required placeholder="Nhập tên đăng nhập">
            <input type="text" name="hoten" required placeholder="Nhập họ và tên">
            <input type="text" name="diachi" required placeholder="Nhập địa chỉ">
            <input type="email" name="email" required placeholder="Nhập email">
            <input type="phone" name="sdt" required placeholder="Nhập số điện thoại">
            <input type="password" name="password" required placeholder="Nhập mật khẩu">
            <input type="password" name="cpassword" required placeholder="Nhập lại mật khẩu">
            
            <!-- Chọn kiểu người dùng -->
            <select name="nguoidung">
               <option value="Nhân viên bán hàng">Nhân viên bán hàng</option>
               <option value="Nhân viên giao hàng">Nhân viên giao hàng</option>
               <option value="Khách hàng">Khách hàng</option>
            </select>

            <input type="submit" name="submit" value="Đăng ký" class="form-btn">
            <p>Bạn đã có tài khoản<a href="login_kh.php"> Đăng nhập</a></p>
         </form>
      </div>
   </body>
</html>