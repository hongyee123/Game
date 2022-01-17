<?php
require_once('../config/config.php');
header('Content-Type: application/json');
$output = array();

//add Product
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_product'])){
    if(($_POST['type'])!='' && ($_POST['price'])!='' && ($_POST['quantity'])!='' && ($_POST['description'])!=''){
        $username = $_SESSION['helper_id'];
        $type = $_POST['type'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];
        if(($_POST['available'])=="true"){
            $available = '1';
        }else{
            $available = '0';
        }
        $sql ="INSERT INTO `product_detail`(`username`, `type`, `price`, `quantity`, `available`, `description`) 
                    VALUES ('$username','$type','$price','$quantity','$available','$description')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);

        $output['status'] = 1;
        $output['msg'] = 'Order Inserted';
    }else{
        $output['status'] = 2;
        $output['msg'] = 'Please Enter all Information';
    }
    
}

//edit Product
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['edit_product'])){
    $id = $_POST['id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    if(($_POST['available'])=="true"){
        $available = '1';
    }else{
        $available = '0';
    }
    $description_noClean = $_POST['description'];
    $description = removeApostrophe($description_noClean);

	$sql = "UPDATE product_detail SET price = '$price', quantity = '$quantity', available = '$available', description = '$description' WHERE id = '$id'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
    $output['status'] = 1;
    $output['msg'] = 'Edited Successful';
}

//delete Product
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
    $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['deleteProduct'])){
        $id = $_POST['id'];
        $sql = "DELETE FROM product_detail where id='".$id."'";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }

    function removeApostrophe($string) {
        $string = str_replace('\'', '', $string); // Replaces all apostrophe撇号.
        return  $string;
}

echo json_encode($output);
?>