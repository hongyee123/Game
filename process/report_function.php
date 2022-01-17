<?php
require_once('../config/config.php');

header('Content-Type: application/json');
$output = array();

//  1   accept order
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['approve']))) {
    
    
	$id = $_POST['id'];
    $admin = $_POST['admin'];
	$user = $_POST['user'];
	$price = $_POST['price'];

	//reset order number
	$sql = "UPDATE order_detail SET ord_status = ('11') WHERE id = '$id'";
	$result = mysqli_query($conn, $sql);
	$sql2 = "UPDATE report SET status = ('2') WHERE ord_id = '$id'";
	$result2 = mysqli_query($conn, $sql2);
	if($result2){
		$query = "SELECT credits FROM user WHERE username = '$user'";
		$result = mysqli_query($conn, $query);
		if($result){
			$row = mysqli_fetch_assoc($result);
			$refund = $row['credits']+$price;

			$sql = "UPDATE user SET credits = '$refund' WHERE username = '$user'";
			$result = mysqli_query($conn, $sql);
			if($result){
				$sql = "INSERT INTO `transaction_history`(`order_id`, `username`, `amount`, `transaction_date`, `status`, `admin`) 
									VALUES ('$id','$user','$price',now(),'6','$admin')";
				$result = mysqli_query($conn, $sql);
			}
		}
	}
	
	

	if($result) {
		$output['status'] = 0;
    }else{
		$output['status'] = 2;
        $output['msg'] = 'gg';
	}
	
}


if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['reject']))) {
    
    
	$id = $_POST['id'];
    $admin = $_POST['admin'];

	//reset order number
	$sql = "UPDATE order_detail SET ord_status = ('12') WHERE id = '$id'";
	$result = mysqli_query($conn, $sql);
	$sql2 = "UPDATE report SET status = ('2') WHERE ord_id = '$id'";
	$result2 = mysqli_query($conn, $sql2);

	if($result) {
		$output['status'] = 0;
    }else{
		$output['status'] = 2;
        $output['msg'] = 'gg';
	}
	
}



mysqli_close($conn);
echo json_encode($output);
?>