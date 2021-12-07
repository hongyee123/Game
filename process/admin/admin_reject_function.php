<?php
require_once('../../config/config.php');


if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST") {
    header('Content-Type: application/json');
    $output = array();
    
	$helper_id = $_POST['helper_id'];
	//reset order number
	$sql = "UPDATE user SET status = ('3') WHERE username = '$helper_id'";
	$result = mysqli_query($conn, $sql);


	if($result) {
		$output['status'] = 0;
		$output['msg'] = 'Reject Successful';
    }else{
		$output['status'] = 2;
        $output['msg'] = 'WTF';
	}
	mysqli_close($conn);
    echo json_encode($output);


    $query = "DELETE";
}

?>