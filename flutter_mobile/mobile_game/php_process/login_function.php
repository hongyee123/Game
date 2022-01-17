<?php
include 'config.php';

header("Access-Control-Allow-Origin: *");

$username = $_POST['username'];
$password = $_POST['password'];
// $password = md5($_POST['password']);

// $username = '1';
// $password = '1';

$queryResult = $conn->query("SELECT * FROM user WHERE username='".$username."' and password='".$password.  "'");

// $queryResult = $conn->query("SELECT * FROM user WHERE username='$username' and password='$password'");


$result=array();

while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}

echo json_encode($result);
?>