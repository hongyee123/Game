<?php
include 'config.php';

header("Access-Control-Allow-Origin: *");

$username = $_POST['username'];
$helper = $_POST['helper'];

// $username = '1';
// $helper = '111';

if($result){
    $row = mysqli_fetch_assoc($result);
    $total_row = mysqli_num_rows($result);
    // echo $total_row;
    if($total_row<1){
        $sql = "";
        $result = mysqli_query($conn, $sql);
        $output['status'] = 0;
    }
}
echo json_encode($output);

?>