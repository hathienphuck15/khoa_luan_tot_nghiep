<?php
    // Thông báo phản hồi mà nhận được ở định dạng HTML với mã hóa ký tự của "UTF-8" cho phép hiển thị ký tự từ một loạt ngôn ngữ và tập lệnh
    header('Content-type: text/html; charset=utf-8');

    // Hàm bắt đầu session	
    session_start();

    // Kết nối CSDL
    include_once(__DIR__ . "/Model/ketnoi.php");

    // Gọi hàm trong class của Model
    $p = new clsketnoi();
    $connect = $p->ketnoiDB($con);

    // Kiểm tra biến POST submit có tồn tại không
    if (isset($_POST['submit'])) {

        // Lấy thông tin khách hàng từ form thanh toán
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $total = $_POST['total'];
        $paymentMethod = $_POST['payment_method'];

        // Lấy thông tin khách hàng từ session
        if (isset($_SESSION['makh'])) {
            $user_id = $_SESSION['makh'];

            // Lấy thông tin khách hàng từ CSDL
            $query = "SELECT * FROM khachhang WHERE makh = $user_id";
            $result = mysqli_query($con, $query);
            $user = mysqli_fetch_array($result);
        }

        // Lấy ngẫu nhiên 1 nhân viên từ bảng nhanvien
        $query = "SELECT manv FROM nhanvien ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($con, $query);
        $nv = mysqli_fetch_array($result);
        $manv = $nv['manv'];

        // Tạo đối tượng hoá đơn mới
        $invoice = new stdClass();
        $invoice->makh = $user_id;
        $invoice->manv = $manv;
        $invoice->tenkhnew = $name;
        $invoice->emailnew = $user['email'];
        $invoice->diachinew = $address;
        $invoice->sodienthoainew = $phone;
        $invoice->tongtien = $total;
        $invoice->phuongthuctt = $paymentMethod;

        // Lấy thời gian và ngày, tháng, năm thời điểm hiện tại
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $invoice->ngaylap = date('Y-m-d H:i:s', time());
        
        $invoice->tinhtrangtt = 'Đã thanh toán';
        $invoice->trangthai = 0;

        // Thêm hoá đơn vào CSDL
        $query = "INSERT INTO hoadon (makh, manv, tenkhnew, emailnew, diachinew, sodienthoainew, tongtien, phuongthuctt, ngaylap, tinhtrangtt, trangthai) VALUES ('$invoice->makh', '$invoice->manv', '$invoice->tenkhnew', '$invoice->emailnew', '$invoice->diachinew', '$invoice->sodienthoainew', '$invoice->tongtien', '$invoice->phuongthuctt', '$invoice->ngaylap', '$invoice->tinhtrangtt', '$invoice->trangthai')";
 
        if (mysqli_query($con, $query)) {

            // Lấy id hoá đơn mới được tạo
            $invoice_id = mysqli_insert_id($con);

            // Thêm thông tin sản phẩm vào bảng chitietdonhang
            foreach ($_SESSION["cart"] as $product_id => $quantity) {
                $product = mysqli_query($con, "SELECT * FROM `sanpham` WHERE `masp` = '$product_id'");
                $row = mysqli_fetch_assoc($product);
                
                $product_price = $row['giaban'];
                $query = "INSERT INTO chitiethoadon (mahd, masp, soluongban, giaban) VALUES ('$invoice_id', '$product_id', '$quantity', '$product_price')";
                mysqli_query($con, $query);
        
                // Cập nhật số lượng sản phẩm trong CSDL
                $quantity_sold = $row['soluong'] - $quantity;
                $query = "UPDATE sanpham SET soluong = $quantity_sold WHERE masp = '$product_id'";
                mysqli_query($con, $query);
            }
        } 
    }

    // Hàm được xác định với hai tham số url là URL mà yêu cầu POST sẽ được gửi và dữ liệu là tải trọng JSON sẽ đưa vào yêu cầu
    function execPostRequest($url, $data) {

        // Khai báo biến và gọi hàm curl_init khởi tạo phiên cURL mới và thiết lập tùy chọn cho phiên cURL trước khi gửi yêu cầu mạng
        $ch = curl_init();

        // Hàm curl_setopt yêu cầu gửi để sử dụng curlopt_url và đặt yêu cầu bằng curlopt_httpheader. Các tiêu đề đặt trong trường hợp này là "loại nội dung" và "độ dài nội dung"
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );

        // Tắt xác thực SSL cho tên miền của máy chủ. Tham số thứ hai (0) là tắt kiểm tra chứng chỉ SSL cho tên miền
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        // Tắt xác thực SSL cho chứng chỉ của máy chủ. Tham số thứ hai (0) là tắt kiểm tra chứng chỉ SSL
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // Yêu cầu cURL trả về false nếu gặp lỗi HTTP. Tham số thứ hai (1) là kích hoạt tính năng
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);

        // Yêu cầu cURL trả về nội dung phản hồi thay vì in ra. Tham số thứ hai (1) là kích hoạt tính năng
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Thiết lập phương thức yêu cầu là POST. Tham số thứ hai (1)  là kích hoạt tính năng
        curl_setopt($ch, CURLOPT_POST, 1);
            
        // Gắn dữ liệu yêu cầu vào phần thân yêu cầu POST. Tham số thứ hai ($data) là dữ liệu POST gắn vào yêu cầu
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // Chạy POST
        $result = curl_exec($ch);

        // Kiểm tra có bị lỗi khi chạy POST
        if (curl_errno($ch)) { 
            print curl_error($ch); 
        }

        // Đóng kết nối
        curl_close($ch);

        // Trả về biến result  
        return $result;
    }

    // Lấy dữ liệu từ mẫu thanh toán
    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

    // Tạo yêu cầu thanh toán
    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

    // Mã đơn hàng tạo dựa trên thời gian hiện tại của hệ thống, chuyển thành chuỗi bằng hàm time() và nối thêm chuỗi rỗng để tạo thành chuỗi duy nhất
    $order_id = time() ."";

    // Thông tin đơn hàng
    $orderInfo = "Thanh toán qua ATM";

    // Số tiền thanh toán lấy từ biến $_POST['total'] được submit từ form trước đó và ép kiểu về chuỗi bằng hàm strval()
    $amount = strval($_POST['total']);

    // Đường dẫn URL sẽ chuyển hướng đến khi thanh toán thành công
    $redirectUrl = "http://localhost/KLTN_ITBOOK_660/camon.php";

    // Đường dẫn URL nhận thông báo trả về từ cổng thanh toán để xử lý kết quả thanh toán
    $ipnUrl = "http://localhost/KLTN_ITBOOK_660/camon.php";

    // Dữ liệu bổ sung nếu có
    $extraData = "";

    // Mã yêu cầu thanh toán tạo dựa trên thời gian hiện tại của hệ thống, chuyển thành chuỗi bằng hàm time() và nối thêm chuỗi rỗng để tạo thành chuỗi duy nhất
    $requestId = time() ."";

    // Loại yêu cầu thanh toán
    $requestType = "payWithATM";

    // Thời điểm hiện tại của hệ thống định dạng theo chuẩn "YmdHis"
    // Chuỗi gồm năm (4 chữ số), tháng (2 chữ số), ngày (2 chữ số), giờ (2 chữ số), phút (2 chữ số) và giây (2 chữ số)
    // Lấy ra bằng hàm format() của đối tượng DateTime() kết hợp với đối số định dạng chuỗi
    $now = (new DateTime())->format('YmdHis');

    // Biến rawHash là chuỗi tạo ra ghép thông tin đơn hàng
    // Mã hóa dưới dạng chuỗi theo quy tắc nhất định. Chuỗi này sẽ mã hóa bằng phương thức hash_hmac() để tạo ra chữ ký
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $order_id . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;

    // Biến signature là chuỗi chữ ký tạo ra bằng phương thức hash_hmac() dựa trên chuỗi rawHash
    // Thuật toán mã hóa là sha256 và khóa bí mật là secretKey. Chuỗi này sẽ đính kèm vào yêu cầu thanh toán để xác thực người gửi yêu cầu
    $signature = hash_hmac("sha256",$rawHash, $secretKey);

    // Khai báo biến cho mảng
    $data = array (
        'partnerCode' => $partnerCode,
        'partnerName' => "ITBOOK",
        "storeId" => "ITBOOK",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $order_id,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature
    );

    // Kết quả trả về từ việc gửi yêu cầu thanh toán tới cổng thanh toán qua hàm execPostRequest()
    $result1 = execPostRequest($endpoint, json_encode($data));

    // Hiển thị dữ liệu của đơn hàng dưới dạng chuỗi JSON lên màn hình
    echo json_encode($data);

    // Chứa kết quả trả về từ cổng thanh toán sau khi thực hiện xử lý yêu cầu thanh toán. Hàm json_decode() chuyển đổi chuỗi JSON trả về thành kiểu dữ liệu
    $jsonResult = json_decode($result1, true);

    // Chuyển hướng đến đường dẫn được chỉ định bởi $jsonResult['payUrl']
    header('Location: ' . $jsonResult['payUrl']);
?>
