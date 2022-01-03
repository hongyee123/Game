<?php
require_once('../config/config.php');


//  1   accept order
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['approve']))) {
    header('Content-Type: application/json');
    $output = array();
    
	$id = $_POST['id'];
    $admin = $_POST['admin'];

	//reset order number
	$sql = "UPDATE order_detail SET ord_status = ('10') WHERE id = '$id'";
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

?>