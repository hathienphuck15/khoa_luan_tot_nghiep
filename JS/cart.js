// Thêm vào giỏ hàng trang sản phẩm
$(".giohang").click(function (event) {
    event.preventDefault();

    // Nhận giá trị số lượng
    var soluong = $(this).find('input[name^="soluong"]').val();

    // Nhận trạng thái của sản phẩm hết hàng hay còn hàng để xử lý
    var isAvailable = $(this).data('available');

    // Kiểm tra xem sản phẩm còn hàng không và số lượng lớn hơn 0
    if (isAvailable == 1 && soluong > 0) {
        $.ajax({
            type: "POST",
            url: 'processcart.php?action=add',
            data: $(this).serializeArray(),
            success: function (response) {

                // Hàm JSON.parse() chuyển đổi chuỗi JSON thành một đối tượng JavaScript
                response = JSON.parse(response);

                // Thêm không thành công
                if (response.status == 0) {
                    alert(response.message);
                
                // Thêm thành công
                } else {
                    $('#cart-icon span').html(response.total_quantity);
                    alert(response.message);
                }

                // Phương thức trigger('click') sử dụng để kích hoạt sự kiện "click"
                $('#cart-icon a img').trigger('click');
            }
        });

    // Trường hợp hết hàng không cho thêm sẽ thông báo
    } else {
        alert("Sản phẩm đã hết hàng.");
    }
});

// Hàm cập nhật số lượng trong giỏ hàng
function updateQuantity(quantity) {

    // Kiểm tra trường hợp số lượng nhập không bỏ trống
    if (quantity != "") {
        $.ajax({
            type: "POST",
            url: 'processcart.php?action=update',
            data: $('#cart-form').serializeArray(),
            success: function (response) {

                // Hàm JSON.parse() chuyển đổi chuỗi JSON thành một đối tượng JavaScript
                response = JSON.parse(response);

                // Cập nhật không thành công
                if (response.status == 0) {
                    alert(response.message);

                // Cập nhật không thành công
                } else {
                    alert(response.message);
                    $('#cart-icon span').html(response.total_quantity);
                    $.get('cart.php', function (cartContentHTML) {
                        $('#ajax-cart').html(cartContentHTML);
                    });
                }
            }
        });

    // Kiểm tra trường hợp số lượng bỏ trống thì thông báo
    }else if(quantity == "") {
        alert("Vui lòng nhập số lượng mua");
        return;
    }
}

// Hàm xóa sản phẩm trong giỏ hàng theo mã sản phẩm
function deleteCart(productID) {
    $.ajax({
        type: "POST",
        url: 'processcart.php?action=delete',
        data: {
            "masp": productID
        },
        success: function (response) {

            // Hàm JSON.parse() chuyển đổi chuỗi JSON thành một đối tượng JavaScript
            response = JSON.parse(response);

            //Xóa không thành công
            if (response.status == 0) {
                alert(response.message);

            //Xóa thành công
            } else {
                alert(response.message);
                $('#cart-icon span').html(response.total_quantity);
                $.get('cart.php', function (cartContentHTML) {
                    $('#ajax-cart').html(cartContentHTML);
                });
            }
        }
    });
}

// Thêm sản phẩm vào giỏ hàng trang chi tiết
// Kiểm tra số lượng nhập
$("#giohangdetail").validate({
    rules: {
        "soluong[<?php echo isset($row['masp']) ? $row['masp'] : 0 ?>]": {
            required: true,
            remote: {
                url: "checkquality.php",
                type: "POST"
            }
        }
    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: 'processcart.php?action=add',
            data: $(form).serializeArray(),
            success: function (response) {

                // Hàm JSON.parse() chuyển đổi chuỗi JSON thành một đối tượng JavaScript
                response = JSON.parse(response);

                // Thêm không thành công
                if (response.status == 0) {
                    alert(response.message);

                // Thêm thành công
                } else {
                    $('#cart-icon span').html(response.total_quantity);
                    alert(response.message);
                }

                // Phương thức trigger('click') sử dụng để kích hoạt sự kiện "click" 
                $('#cart-icon a img').trigger('click');
            }
        });
    }
});









