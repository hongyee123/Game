<?php
require_once('../config/config.php');

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && $_SERVER['REQUEST_METHOD'] == "POST") {
    header('Content-Type: application/json');
    $output = array();

    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
    
    
        $query = "SELECT id, quantity FROM product_detail WHERE id = $id ";
        $result = mysqli_query($conn, $query);
        if($result) {
            $num_row = mysqli_num_rows($result);
            if($num_row == 1) {
                $product = mysqli_fetch_object($result);
                if($product->quantity == 0) {
                    $output['status'] = 2;
                    $output['msg'] = 'What are you doing --! (The Product Out of sales)';
                } else {
                    $quantity_left = $product->quantity - $quantity;
                    // add to cart
                    $query = "INSERT INTO cart(cart_username, cart_product, cart_quantity) VALUES ('$username', '$id', '$quantity')";
                    $result = mysqli_query($conn, $query);
                    // munis product quantity
                    if($result) {
                        $query = "UPDATE product_detail SET quantity = '$quantity_left'  WHERE id = '$id'";
                        $result = mysqli_query($conn, $query);
                        if($result) {
                            $query = "SELECT SUM(cart_quantity) AS cart_total FROM cart WHERE cart_username = '$username'";
                            $crt_qty_result = mysqli_query($conn, $query);
                            if($crt_qty_result) {
                                $output["cart_quantity"] = mysqli_fetch_assoc($crt_qty_result)['cart_total'];
                            }
                            $output["status"] = 0;
                            $output["msg"] = 'Added To Cart';
                            $output["quantity_left"] = $quantity_left;
                        }
                        $conn->close();
                    }
                }
            }
        } else {
            $output['status'] = 2;
            $output['msg'] = 'Product do not exist';
        }
        
    }elseif(isset($_SESSION['helper_id'])){
        $username = $_SESSION['helper_id'];
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
    
    
        $query = "SELECT id, quantity FROM product_detail WHERE id = $id ";
        $result = mysqli_query($conn, $query);
        if($result) {
            $num_row = mysqli_num_rows($result);
            if($num_row == 1) {
                $product = mysqli_fetch_object($result);
                if($product->quantity == 0) {
                    $output['status'] = 2;
                    $output['msg'] = 'What are you doing --! (The Product Out of sales)';
                } else {
                    $quantity_left = $product->quantity - $quantity;
                    // add to cart
                    $query = "INSERT INTO cart(cart_username, cart_product, cart_quantity) VALUES ('$username', '$id', '$quantity')";
                    $result = mysqli_query($conn, $query);
                    // munis product quantity
                    if($result) {
                        $query = "UPDATE product_detail SET quantity = '$quantity_left'  WHERE id = '$id'";
                        $result = mysqli_query($conn, $query);
                        if($result) {
                            $query = "SELECT SUM(cart_quantity) AS cart_total FROM cart WHERE cart_username = '$username'";
                            $crt_qty_result = mysqli_query($conn, $query);
                            if($crt_qty_result) {
                                $output["cart_quantity"] = mysqli_fetch_assoc($crt_qty_result)['cart_total'];
                            }
                            $output["status"] = 0;
                            $output["msg"] = 'Added To Cart';
                            $output["quantity_left"] = $quantity_left;
                        }
                        $conn->close();
                    }
                }
            }
        } else {
            $output['status'] = 2;
            $output['msg'] = 'Product do not exist';
        }
        
    }else {
        $output['status'] = 2;
        $output['msg'] = 'Please Login';
    }
    echo json_encode($output);
}