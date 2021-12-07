<?php
require_once('../config/config.php');


if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST") {
    header('Content-Type: application/json');
    $output = array();

    $username = $_POST['username'];
	$amount_withdraw = $_POST['amount_withdraw'];
    
	//reset order number
	$sql = "SELECT credits FROM user WHERE username = '$username'";
	$result = mysqli_query($conn, $sql);
    if($result){
        $row = mysqli_fetch_array($result);
        echo "1";
        echo "</br>";
        echo $row['credits'];
        echo "</br>";
        echo $amount_withdraw;
        
        if($row['credits'] > $amount_withdraw){
            echo "2";
    
        }




    }else{
		$output['status'] = 2;
        $output['msg'] = 'Product do not exist';
	}
	mysqli_close($conn);
    // echo json_encode($output);


    $query = "DELETE";
}

?>