<?php
include 'config.php';

header("Access-Control-Allow-Origin: *");

$queryResult = $conn->query("SELECT * FROM `notice` WHERE status='1'");


$result=array();

while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}

echo json_encode($result);
?>