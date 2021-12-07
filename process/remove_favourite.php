<?php
require_once('../config/config.php');



if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
    $_SERVER['REQUEST_METHOD'] == "POST") {

    header('Content-Type: application/json');
    $output = array();





    if(isset($_POST['add'])){
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
        }
        if(isset($_SESSION['helper_id'])){
            $username = $_SESSION['helper_id'];
        }
    
        $favourite_user = $_POST['favourite_user'];
        $favourite_helper = $_POST['favourite_helper'];
    
        $query = "INSERT INTO `favourite`(`favourite_user`, `favourite_helper`) VALUES ('$favourite_user','$favourite_helper')";
        $result = mysqli_query($conn, $query);
        if($result){
            $output['status'] = 0;
            $output['msg'] = 'Add Helper Form Favourite List Success';
            echo json_encode($output);
        }
        mysqli_close($conn);
    }




    if(isset($_POST['remove'])){
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
        }
        if(isset($_SESSION['helper_id'])){
            $username = $_SESSION['helper_id'];
        }
    
        $favourite_user = $_POST['favourite_user'];
        $favourite_helper = $_POST['favourite_helper'];
    
        $query = "DELETE FROM `favourite` WHERE favourite_user = '$favourite_user' AND favourite_helper = '$favourite_helper'";
        $result = mysqli_query($conn, $query);
        if($result){
            $output['status'] = 0;
            $output['msg'] = 'Remove Helper Form Favourite List Success';
            echo json_encode($output);
        }
        mysqli_close($conn);
    }

} else {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
}




