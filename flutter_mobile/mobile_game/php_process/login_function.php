<?php
include 'config.php';

header("Access-Control-Allow-Origin: *");

// $username = $_POST['username'];
// $password = $_POST['password'];
// $password2 = md5($password);

$username = $_POST['username'];
$password = $_POST['password'];
$password2 = md5($password);

$queryResult = $conn->query("SELECT * FROM user WHERE username='".$username."' and password='".$password2.  "'");

$result=array();

while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}

echo json_encode($result);
?>