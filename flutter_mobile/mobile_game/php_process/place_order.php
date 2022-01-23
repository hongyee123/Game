<?php
include 'config.php';

header("Access-Control-Allow-Origin: *");

$username = $_POST['username'];
$ord_discount = 0;

// $username = '1';
// $helper = '111';


$sql = "SELECT id FROM order_detail";
$check_row = mysqli_query($conn, $sql);
$num_row = mysqli_num_rows($check_row);
$order_id = ($num_row+1);

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

    $query = "SELECT credits FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $sql = "SELECT SUM(price * cart_quantity) AS total FROM product_detail LEFT JOIN cart ON product_detail.id = cart.cart_product WHERE cart_username = '$username'";
    $result_credits = mysqli_query($conn, $sql);
    $row_credits = mysqli_fetch_assoc($result);
    
    $credits_after = $row['credits'] - $row_credits['total'];
    if($row['credits']>=$row_credits['total']){
        for ($i=0; $i < $cart_num_row; $i++) { 
            $cart = mysqli_fetch_assoc($cart_result);
            $cart_id = $cart['cart_id'];
            $product_id = $cart['product_id'];
            $product_name = $cart['type'];
            $product_quantity = $cart['cart_quantity'];
            $total_quntity = $cart['quantity'];
            $product_price = $cart['price'] * $cart['cart_quantity'];
            $seller_id = $cart['seller_id'];

            

                $query1 = "INSERT INTO order_detail
                        (id, ord_product_id, ord_user_id, ord_helper_id, ord_type, ord_quantity, ord_price, ord_discount, ord_status) 
                        VALUES 
                        ('$order_id','$product_id', '$username',  '$seller_id', '$product_name', '$product_quantity', '$product_price', '$ord_discount', '1')";
                $query2 = "DELETE FROM cart WHERE id = $cart_id";
                $query3 = "INSERT INTO transaction_history(username,order_id, amount,transaction_date,status) VALUES ('$username','$order_id', '$product_price', NOW(),'2')";
                $result1 = mysqli_query($conn, $query1);
                $result2 = mysqli_query($conn, $query2);
                $result3 = mysqli_query($conn, $query3);
                $order_id ++;
                if($result1 && $result2 && $result3){
                    continue;
                    // $output['status'] = 0;
                    // $output['msg'] = 'Order Placed Successfully';
                }else{
                    break;
                    // $output['status'] = 2;
                    // $output['msg'] = 'Error';
                }
            
        }
        $query4 = "UPDATE `user` SET `credits`= '$credits_after' WHERE username = '$username'";
        $result4 = mysqli_query($conn, $query4);
    }else{
        $output['status'] = 2;
    }
    mysqli_close($conn);

    $output['status'] = 0;
    echo json_encode($output);
}


?>