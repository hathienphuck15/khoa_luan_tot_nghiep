<?php
    // Hàm xử lý số lượng trong giỏ hàng
    function getTotalQuantity() {

        // Khai báo biến
        $totalQuantity = 0;

        // Kiểm tra biến SESSION cart có bị trống không
        if (!empty($_SESSION['cart'])) {

            // Lặp qua tất cả phần tử trong mảng SESSION. Biến mã sản phẩm là khóa của phần tử đó, biến số lượng là giá trị của phần tử đó.
            foreach ($_SESSION['cart'] as $masp => $soluong) {

                // Dùng toán tử cộng thêm số lượng nhập vào biến
                $totalQuantity += $soluong;
            }
        }
        return $totalQuantity;
    }
?>