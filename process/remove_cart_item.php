<?php
require_once('../config/config.php');

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
    $_SERVER['REQUEST_METHOD'] == "POST") {

    header('Content-Type: application/json');
    $output = array();

    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }
    if(isset($_SESSION['helper_id'])){
        $username = $_SESSION['helper_id'];
    }

            $cart_id = $_POST['cart_id'];

            $query = "SELECT product_detail.id AS product_id, 
                            cart_quantity, quantity FROM cart LEFT JOIN product_detail ON cart.cart_product = product_detail.id WHERE cart.id = '$cart_id' AND cart_username = '$username'";
            $result = mysqli_query($conn, $query);
            if($result) {
                $obj = mysqli_fetch_object($result);

                $cart_quantity = $obj->cart_quantity;
                $product_quantity = $obj->quantity;
                $product_id = $obj->product_id;

                
                $result_quantity = $cart_quantity + $product_quantity;
                $query = "UPDATE product_detail SET quantity = '$result_quantity' WHERE id = '$product_id'";
                $result = mysqli_query($conn, $query);
            }
            $query = "DELETE FROM cart WHERE id = '$cart_id' AND cart_username = '$username'";
            $result = mysqli_query($conn, $query);

            if($result) {
                $output['status'] = 0;
                $output['msg'] = 'Item Remove Success';

                $query = "SELECT * FROM cart WHERE cart_username = '$username'";
                $result = mysqli_query($conn, $query);
                $num_row = mysqli_num_rows($result);
                $output['cart_num'] = $num_row;

            } else {
                $output['status'] = 1;
                $output['msg'] = 'Some thing error (DB connect error)';
            }
    mysqli_close($conn);
    echo json_encode($output);
} else {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
}
