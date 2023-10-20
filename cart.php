<?php 
    // Hàm bắt đầu session
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ITBOOK</title>

        <!-- CSS trang giỏ hàng -->
        <style>
            body {
                font-family: 'Lora', serif;
            }

            * {
                box-sizing: border-box;
            }

            #ajax-cart {
                width: 80%;
                display: inline-block;
            }
        </style>
    </head>

    <body>

        <!-- Nội dung giỏ hàng -->
        <div id="ajax-cart">
            <?php 
                include_once(__DIR__ . "/cartcontent.php");
            ?>        
        </div>
    </body>
</html>