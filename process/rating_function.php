<?php
require_once('../config/config.php');

// if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
// $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
// $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['post'])){
    header('Content-Type: application/json');
    $output = array();

    $id = $_POST['id'];

    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }
    if(isset($_SESSION['helper_id'])){
        $username = $_SESSION['helper_id'];
    }
    if($_POST['rate'] == 5 ) {
        $rate = '5';
    }elseif($_POST['rate'] == 4){
        $rate = '4';
    }elseif($_POST['rate'] == 3){
        $rate = '3';
    }elseif($_POST['rate'] == 2){
        $rate = '2';
    }elseif($_POST['rate'] == 1){
        $rate = '1';
    }

    $comment = $_POST['comment'];

    if($comment == null ) {
        $output['status'] = 2;
        $output['msg'] = 'Please Enter Comment';
    }else{
        $sql = "UPDATE `order_detail` SET ord_rate = '$rate', ord_comment = '$comment', rate_time =(now()) WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $output['status'] = 1;
            $output['msg'] = 'Your Rate was Submitted';
        }
    }
    echo json_encode($output);
// }

?>