<?php
require_once('../config/config.php');


if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST") {
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

?>