<?php
require_once('../config/config.php');


//add Product
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_product'])){
    $username = $_SESSION['helper_id'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    if(($_POST['available'] != null) || ($_POST['available']) == '1'){
        $available = '1';
    }else{
        $available = '0';
    }
    $description_noClean = $_POST['description'];
    $description = removeApostrophe($description_noClean);

	// $sql = "INSERT INTO product_detail(prdt_code, prdt_name, prdt_oriPrice, prdt_sellPrice, prdt_type , prdt_quantity, prdt_image,available, description, prdt_seller) 
    // VALUES ('$prdt_code','$prdt_name','$prdt_oriPrice','$prdt_sellPrice','$prdt_type', '$prdt_quantity','$prdt_image','$available','$description','$prdt_seller')";
    $sql ="INSERT INTO `product_detail`(`username`, `type`, `price`, `quantity`, `available`, `description`) 
                VALUES ('$username','$type','$price','$quantity','$available','$description')";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
    echo "Done";
}

//edit Product
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['edit_product'])){
    $id = $_POST['id'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    if(($_POST['available'] != null) || ($_POST['available']) == '1'){
        $available = '1';
    }else{
        $available = '0';
    }
    $description_noClean = $_POST['description'];
    $description = removeApostrophe($description_noClean);

	$sql = "UPDATE product_detail SET type = '$type', price = '$price', quantity = '$quantity', available = '$available', description = '$description' WHERE id = '$id'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
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
?>