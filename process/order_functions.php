<?php
require_once('../config/config.php');


//  1   accept order
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['accept']))) {
    header('Content-Type: application/json');
    $output = array();
    
	$detail_id = $_POST['detail_id'];
	//reset order number
	$sql = "UPDATE order_detail SET ord_status = ('2') WHERE id = '$detail_id'";
	$result = mysqli_query($conn, $sql);

	if($result) {
		$output['status'] = 0;
    }else{
		$output['status'] = 2;
        $output['msg'] = 'Product do not exist';
	}
	mysqli_close($conn);
    echo json_encode($output);
}


//==================================================================================================================

//  2   cancel order
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['cancel']))) {
    header('Content-Type: application/json');
    $output = array();
    
	$user = $_POST['user'];
	$detail_id = $_POST['detail_id'];

	$sql = "SELECT ord_quantity, ord_price, ord_discount FROM order_detail WHERE id = '$detail_id'";
	$result = mysqli_query($conn, $sql);
	if($result){
		$num_row = mysqli_num_rows($result);
		for ($i=0; $i < $num_row; $i++) { 
			$order = mysqli_fetch_assoc($result);
			$ord_quantity = $order['ord_quantity'];
			$ord_price = $order['ord_price'];
			$ord_discount = $order['ord_discount'];

			$total = ($ord_quantity * $ord_price) - $ord_discount;

			$sql = "SELECT credits FROM user WHERE username = '$user'";
			$result = mysqli_query($conn, $sql);
			if($result){
				$num_row = mysqli_num_rows($result);
				for ($i=0; $i < $num_row; $i++) { 
					$user_R = mysqli_fetch_assoc($result);

					$credits = $user_R['credits'];
					$refund = $credits + $total;

					$sql = "UPDATE order_detail SET ord_status = ('5') WHERE id = '$detail_id'";
					$result = mysqli_query($conn, $sql);
					$sql2 = "UPDATE user SET credits = '$refund' WHERE username = '$user'";
					$result2 = mysqli_query($conn, $sql2);

					if($result2) {
						$output['status'] = 0;
					}else{
						$output['status'] = 2;
						$output['msg'] = 'Product do not exist';
					}
					mysqli_close($conn);
					echo json_encode($output);
				}
			}
		}
	}
}










//==================================================================================================================

//  3   Done Order
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['done']))) {
    header('Content-Type: application/json');
    $output = array();
    
	$detail_id = $_POST['detail_id'];
	//reset order number
	$sql = "UPDATE order_detail SET ord_status = ('3') WHERE id = '$detail_id'";
	$result = mysqli_query($conn, $sql);


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



//==================================================================================================================

//  4   User Comfirm Order
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['comfirm']))) {
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