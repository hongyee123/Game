<?php
include 'config.php';

header("Access-Control-Allow-Origin: *");

$username = $_POST['username'];
$type = $_POST['type'];

$queryResult = $conn->query("SELECT * FROM order_detail WHERE ord_helper_id='$username' AND ord_type='$type'");


$result=array();

while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}

echo json_encode($result);
?>