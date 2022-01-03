<?php
include 'config.php';

header("Access-Control-Allow-Origin: *");

// $username = $_POST['username'];
// $id = $_POST['id'];
// $quantity = $_POST['quantity'];

$username = 1;
$id = 31;
$quantity = 2;


$sql = "SELECT * FROM cart WHERE cart_username = '$username'";
$result = mysqli_query($conn, $sql);

if($result){
    $row = mysqli_fetch_assoc($result);
    $total = mysqli_num_rows($result);
    $total_add = $row['cart_quantity'] + $quantity;

    $sql = "SELECT quantity FROM product_detail WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if($result){
        $row_quantity = mysqli_fetch_assoc($result);
        if($row_quantity['quantity']>=$total_add){
            if($total>=0){
                $query = "UPDATE `cart` SET `cart_quantity`='$total_add' WHERE cart_username = '$username'";
                $result2 = mysqli_query($conn, $query);
                $output['status'] = 0;
            }else{
                $query = "INSERT INTO cart(cart_username, cart_product, cart_quantity) VALUES ('$username', '$id', '$quantity')";
                $output['status'] = 0;
                $result2 = mysqli_query($conn, $query);
            }
        }else{
            $output['status'] = 1;
        }
    }
}
echo json_encode($output);

?>