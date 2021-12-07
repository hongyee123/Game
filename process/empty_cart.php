<?php
require_once('../config/config.php');

$username = $_SESSION['username'];


        $query = "SELECT 
                    cart.id AS cart_id,
                    product_detail.id AS product_id,
                    cart_quantity
                    FROM cart LEFT JOIN product_detail ON cart.cart_product = product_detail.id WHERE cart_username = '$username'";

        $info_result = mysqli_query($conn, $query);
        if($info_result) {
            $num_row = mysqli_num_rows($info_result);
            if($num_row > 0) {
                for($i = 0; $i < $num_row; $i++) {
                    $obj = mysqli_fetch_object($info_result);
                    $cart_id = $obj->cart_id;
                    $product_id = $obj->product_id;
                    $crt_qty = intval($obj->cart_quantity);

                    $query = "DELETE FROM cart WHERE id = '$cart_id' AND cart_username = '$username';";
                    mysqli_query($conn, $query);

                    $query = "SELECT quantity FROM product_detail WHERE id = '$product_id'";
                    $result = mysqli_query($conn, $query);
                    $prdt_qty = mysqli_fetch_assoc($result)['quantity'];
                    $product_quantity = intval($prdt_qty) + $crt_qty;

                    $query = "UPDATE product_detail SET quantity = '$product_quantity' WHERE id = '$product_id';";
                    $result = mysqli_query($conn, $query);

                    if(!$result) {
                        print_r( mysqli_error_list($conn));
                        echo '<script>alert("something wrong");</script>';
                        break;
                    }
                }
                header('location: ../view_cart.php');
            }
        }
    