<?php
include 'config.php';

header("Access-Control-Allow-Origin: *");

$username = $_POST['username'];

$queryResult = $conn->query("SELECT type,price,cart_quantity,username FROM cart LEFT JOIN product_detail on cart.cart_product = product_detail.id WHERE cart_username='$username'");


$result=array();

while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}

echo json_encode($result);
?>