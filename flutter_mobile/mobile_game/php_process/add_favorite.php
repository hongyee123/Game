<?php
include 'config.php';

header("Access-Control-Allow-Origin: *");

$username = $_POST['username'];
$helper = $_POST['helper'];

// $username = '1';
// $helper = '111';

$sql = "SELECT * FROM `favourite` WHERE favourite_user = '$username' AND favourite_helper='$helper'";
$result = mysqli_query($conn, $sql);

if($result){
    $row = mysqli_fetch_assoc($result);
    $total_row = mysqli_num_rows($result);
    // echo $total_row;
    if($total_row<1){
        $sql = "INSERT INTO `favourite`(`favourite_user`, `favourite_helper`) VALUES ('$username','$helper')";
        $result = mysqli_query($conn, $sql);
        $output['status'] = 0;
    }elseif($total_row=1){
        $sql = "DELETE FROM `favourite` WHERE favourite_user = '$username' AND favourite_helper='$helper'";
        $result = mysqli_query($conn, $sql);
        $output['status'] = 2;
    }else{
        $output['status'] = 1;
    }
}
echo json_encode($output);

?>