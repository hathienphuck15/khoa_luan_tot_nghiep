<?php
    // Hàm bắt đầu session
    session_start();

    // Kết nối CSDL và hàm xử lý giỏ hàng
    include_once(__DIR__ . "/Model/ketnoi.php");
    include_once(__DIR__ . "/functioncart.php");

    // Gọi hàm trong class của Model
    $p = new clsketnoi();
    $connect = $p->ketnoiDB($con);

    // Kiểm tra biến GET hành động có tồn tại không
    if(isset($_GET['action'])){
        switch ($_GET['action']) {

            // Trường hợp thêm
            case "add":
                $result = update_cart($con, true);
                $totalQuantity = getTotalQuantity();
                
                $result['total_quantity'] = $totalQuantity;
                echo json_encode($result);
            break;

            // Trường hợp cập nhật
            case "update":
                $result = update_cart($con);
                $totalQuantity = getTotalQuantity();

                $result['total_quantity'] = $totalQuantity;
                echo json_encode($result);
            break;

            // Trường hợp xóa
            case "delete":
                if (isset($_POST['masp'])) {
                    unset($_SESSION["cart"][$_POST['masp']]);
                }

                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Xóa sản phẩm thành công.',
                    'total_quantity' => getTotalQuantity()
                ));
            break;

        default:
        break;
        }
    }
    
    // Hàm cập nhật sản phẩm trong giỏ hàng
    function update_cart($con, $add = false) {

        // Lặp qua tất cả phần tử trong mảng POST. Biến mã sản phẩm là khóa của phần tử đó, biến số lượng là giá trị của phần tử đó.
        foreach ($_POST['soluong'] as $masp => $soluong) {

            // Kiểm tra số lượng bằng rỗng
            if ($soluong === '') {
                return array(
                    'status' => 1,
                    'message' => "Vui lòng nhập số lượng mua."
                );
            }
        }
                
        $changeQuantity = false;

        // Lặp qua tất cả phần tử trong mảng POST. Biến mã sản phẩm là khóa của phần tử đó, biến số lượng là giá trị của phần tử đó.
        foreach ($_POST['soluong'] as $masp => $soluong) {
            
            // Kiểm tra biến số lượng bằng hàm ctype_digit không cho nhập số âm hay ký tự đặc biệt
            if (!ctype_digit($soluong) || $soluong == 0) {
                return array(
                    'status' => 1,
                    'message' => "Không nhập số lượng bằng 0, số âm, kí tự đặc biệt."
                );
        
            } else {

                // Kiểm tra biến SESSION cart và biến mã sản phẩm có tồn tại không
                if (!isset($_SESSION["cart"][$masp])) {
                    $_SESSION["cart"][$masp] = 0;
                }

                // Kiểm tra biến add
                if ($add) {

                    // Nếu biến add là true thì sẽ cộng thêm số lượng nhập
                    $_SESSION["cart"][$masp] += $soluong;
                } else {

                    // Nếu biến add là false thì số lượng giữ nguyên
                    $_SESSION["cart"][$masp] = $soluong;
                }
                
                //Kiểm tra số lượng sản phẩm tồn kho
                $addProduct = mysqli_query($con, "SELECT `soluong` FROM `sanpham` WHERE `masp` = " . $masp);
                $addProduct = mysqli_fetch_assoc($addProduct);

                // Kiểm tra số lượng nhập vào 
                if ($_SESSION["cart"][$masp] > $addProduct['soluong']) {
                    $_SESSION["cart"][$masp] = $addProduct['soluong'];
    
                    // Nếu số lượng thêm vào lớn hơn số lượng tồn kho thì sẽ thông báo
                    if ($add) {
                        return array(
                            'status' => 0,
                            'message' => "Số lượng sản phẩm chỉ còn: " .$addProduct['soluong']. " sản phẩm. Vui lòng kiểm tra lại giỏ hàng."
                        );

                    } else {
                        $changeQuantity = true;
                    }
                }
                
                // Nếu số lượng thêm vào nhỏ hơn hoặc bằng số lượng tồn kho thì sẽ thông báo
                if($add){
                    return array(
                        'status' => 1,
                        'message' => "Thêm giỏ hàng thành công."
                    );
                }
    
            }
        }

        // Nếu cập nhật lại số lượng quá số lượng tồn kho thì sẽ thông báo
        if ($changeQuantity) {
            return array(
                'status' => 1,
                'message' => "Số lượng sản phẩm trong giỏ hàng đã thay đổi do số lượng tồn kho không đủ. Vui lòng kiểm tra lại giỏ hàng."
            );

        // Nếu cập nhật lại số lượng bằng hoặc nhỏ hơn số lượng tồn kho thì sẽ thông báo
        }else{
            return array(
                'status' => 1,
                'message' => "Cập nhật giỏ hàng thành công."
            );
        }
    }
?>