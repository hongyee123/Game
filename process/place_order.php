<?php
require_once('../config/config.php');

// if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
// $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
// $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['username'])) {
    header('Content-Type: application/json');
    $output = array();
    
    $username = $_POST['username'];
    $ord_discount = $_POST['ord_discount'];

        $order_id = mysqli_insert_id($conn);

        $query = "SELECT 
        cart.id AS cart_id,
        product_detail.id AS product_id,
        type,
        price,
        cart_quantity,
        quantity,
        product_detail.username AS seller_id
        FROM cart LEFT JOIN product_detail ON cart.cart_product = product_detail.id WHERE cart_username = '$username'";
        $cart_result = mysqli_query($conn, $query);
        if($cart_result) {
            $cart_num_row = mysqli_num_rows($cart_result);
            for ($i=0; $i < $cart_num_row; $i++) { 
                $cart = mysqli_fetch_assoc($cart_result);
                $cart_id = $cart['cart_id'];
                $product_id = $cart['product_id'];
                $product_name = $cart['type'];
                $product_quantity = $cart['cart_quantity'];
                $product_price = $cart['price'] * $product_quantity;
                $seller_id = $cart['seller_id'];

                $query = "SELECT credits FROM user WHERE username = '$username'";
                $result = mysqli_query($conn, $query);
                $num_row = mysqli_num_rows($result);
                if($num_row > 0) {
                    $user = mysqli_fetch_object($result);
                }
                if($user->credits >= $product_price){
                    echo "$user->credits";
                    echo "$product_price";
                    $query = "INSERT INTO order_detail
                        (ord_product_id, ord_helper_id, ord_type, ord_quantity, ord_price, ord_discount, ord_status) 
                        VALUES 
                        ('$product_id', '$seller_id', '$product_name', '$product_quantity', '$product_price', '$ord_discount', '1')";

                    $detail_result = mysqli_query($conn, $query);
                    if(!$detail_result) {
                        echo "<script>alert('error occurs')</script>";
                        break;
                    }
                    // remove item form cart
                    $query = "DELETE FROM cart WHERE id = $cart_id";
                    $remove_cart_result = mysqli_query($conn, $query);
                    if($remove_cart_result) {
                        $query = "SELECT * FROM user WHERE username = '$username'";
                        $result = mysqli_query($conn, $query);
                        $num_row = mysqli_num_rows($result);
                        if($num_row > 0) {
                            $user = mysqli_fetch_object($result);
                        }
                        $current_credits = $user->credits - $product_price;
                        $query = "UPDATE `user` SET `credits`= '$current_credits' WHERE username = '$username'";
                        $query2 = "INSERT INTO transaction_history(username, amount,date,status) VALUES ('$username', '$product_price', NOW(),'2')";
                        $query3 = "INSERT INTO orders(id,ord_user_id) VALUES ('$order_id','$username')";
    
                        $update_credits = mysqli_query($conn, $query);
                        $update_transac_history = mysqli_query($conn, $query2);
                        $order_result = mysqli_query($conn, $query3);
                    }else{
                        echo "<script>alert('error occurs')</script>";
                        break;
                    }
                }else if ($user->credits < $product_price){
                    echo "<script>alert('error occurs')</script>";
                }
            }
        }
        $query = "DELETE";
// }

?>