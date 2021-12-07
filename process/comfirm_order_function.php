<?php
require_once('../config/config.php');


if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST") {
    header('Content-Type: application/json');
    $output = array();
    
	$detail_id = $_POST['detail_id'];
	$helper = $_POST['helper'];
	$new_credits = 0;
	
	$sql = "SELECT ord_price,ord_discount FROM order_detail WHERE id = '$detail_id'";
	$result = mysqli_query($conn, $sql);
	if($result){
		$num_row = mysqli_num_rows($result);
		for ($i=0; $i < $num_row; $i++) { 
			
			$order = mysqli_fetch_assoc($result);
			$ord_price = $order['ord_price'];
			$ord_discount = $order['ord_discount'];

			$total = $ord_price - $ord_discount;

			$sql = "SELECT * FROM user WHERE username = 'helper'";
			$result = mysqli_query($conn, $sql);
			if($result){
				$helper_ = mysqli_fetch_assoc($result);

				$credits = $helper_['credits'];
				$new_credits = ($credits + $total)/100*80;
				$sql = "UPDATE order_detail SET ord_status = ('4') WHERE id = '$detail_id'";
				$result = mysqli_query($conn, $sql);
				$sql2 = "INSERT INTO `transaction_history`(`order_id`, `username`, `amount`, `date`, `status`) VALUES ('$detail_id','$helper','$new_credits',now(),'3')";
				$result2 = mysqli_query($conn, $sql2);
				$sql3 = "UPDATE user SET credits = '$new_credits' WHERE username = '$helper'";
				$result3 = mysqli_query($conn, $sql3);

				if($result) {
					$output['status'] = 0;
				}else{
					$output['status'] = 2;
					$output['msg'] = 'Product do not exist';
				}
				mysqli_close($conn);
				echo json_encode($output);
			
				$query = "DELETE";
			}
		}
	}
}
?>