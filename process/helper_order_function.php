<?php
if(isset($_GET['comfirm_id'])){
	$order_id = $_GET['comfirm_id'];
	//reset order number
	$sql = "UPDATE order_detail SET ord_status = ('2') WHERE id = '$order_id'";
	$result = mysqli_query($conn, $sql);

	header("Location: helper_accept_order.php");
}


if(isset($_GET['cancel_id'])&&($_GET['user_id'])){
	$user_id = $_GET['user_id'];
	$order_id = $_GET['cancel_id'];
	
	$sql = "SELECT ord_quantity, ord_price, ord_discount FROM order_detail WHERE id = '$order_id'";
	$result = mysqli_query($conn, $sql);
	if($result){
		$num_row = mysqli_num_rows($result);
		for ($i=0; $i < $num_row; $i++) { 
			$order = mysqli_fetch_assoc($result);
			$ord_quantity = $order['ord_quantity'];
			$ord_price = $order['ord_price'];
			$ord_discount = $order['ord_discount'];

			$total = ($ord_quantity * $ord_price) - $ord_discount;

			$sql = "SELECT credits FROM user WHERE username = '$user_id'";
			$result = mysqli_query($conn, $sql);
			if($result){
				$num_row = mysqli_num_rows($result);
				for ($i=0; $i < $num_row; $i++) { 
					$user = mysqli_fetch_assoc($result);

					$credits = $user['credits'];
					$refund = $credits + $total;

					$sql = "UPDATE order_detail SET ord_status = ('5') WHERE id = '$order_id'";
					$result = mysqli_query($conn, $sql);
					$sql2 = "UPDATE user SET credits = '$refund' WHERE username = '$user_id'";
					$result = mysqli_query($conn, $sql2);

					header("Location: helper_accept_order.php");
				}
			}
		}
	}
}

if(isset($_GET['done_id'])){
	$order_id = $_GET['done_id'];
	//reset order number
	$sql = "UPDATE order_detail SET ord_status = ('4') WHERE id = '$order_id'";
	$result = mysqli_query($conn, $sql);

	header("Location: helper_ing_order.php");
}
?>