<?php
require_once('../../config/config.php');


if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST") {
    header('Content-Type: application/json');
    $output = array();
    
	$username = $_SESSION['admin'];
	$helper_id = $_POST['helper_id'];
	//reset order number
	$sql = "UPDATE helper SET status = ('2'),admin_id = '$username' WHERE helper_id = '$helper_id'";
	$result = mysqli_query($conn, $sql);
	$sql2 = "UPDATE user SET role = ('2') WHERE username = '$helper_id'";
	$result2 = mysqli_query($conn, $sql2);
	



	if($result) {
		$output['status'] = 0;
		$output['msg'] = 'Verify Successful';
    }else{
		$output['status'] = 2;
        $output['msg'] = 'Product do not exist';
	}
	mysqli_close($conn);
    echo json_encode($output);


    $query = "DELETE";
}

?>