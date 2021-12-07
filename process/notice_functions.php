<?php
require_once('../config/config.php');


//add Product
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_notice'])){
    $username = $_SESSION['admin'];
    $title = $_POST['title'];
    $contant = $_POST['contant'];
    $date = $_POST['date'];
    if(($_POST['show'] != null)){
        $available = '1';
    }else{
        $available = '0';
    }

    $sql ="INSERT INTO `notice`(`title`, `contant`, `status`, `date`, `create_by`) 
                                VALUES ('$title','$contant','$available','$date','$username')";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
}

//edit Product
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['edit_notice'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $contant = $_POST['contant'];
    $date = $_POST['date'];
    if(($_POST['status'] != null) || ($_POST['status']) == '1'){
        $status = '1';
    }else{
        $status = '0';
    }

	$sql = "UPDATE notice SET title = '$title', contant = '$contant', status = '$status', date = '$date' WHERE notice_id = '$id'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
}

//delete Notice
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['deleteNotice'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM notice where notice_id='$id'";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
}

function removeApostrophe($string) {
    $string = str_replace('\'', '', $string); // Replaces all apostrophe撇号.
    return $string;
}
?>