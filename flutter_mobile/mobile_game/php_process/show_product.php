<?php
include 'config.php';

header("Access-Control-Allow-Origin: *");

$username = $_POST['username'];

$queryResult = $conn->query("SELECT * FROM product_detail WHERE username!='$username'");


$result=array();

while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}

echo json_encode($result);
?>