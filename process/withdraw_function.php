<?php
require_once('../config/config.php');


if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['withdraw']))) {
    header('Content-Type: application/json');
    $output = array();

    $username = $_POST['username'];
	$amount_withdraw = $_POST['amount_withdraw'];

    if((is_int($amount_withdraw))==false){
        if($amount_withdraw!=0){
            $sql = "SELECT credits FROM user WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            if($result){
                $row = mysqli_fetch_array($result);
                if($row['credits'] > $amount_withdraw){
                    $total_withdraw = $row['credits'] - $amount_withdraw;
                    $sql = "UPDATE `user` SET `credits`= '$total_withdraw' WHERE username = '$username'";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        $sql = "INSERT INTO `transaction_history`(`username`, `amount`, `date`, `status`) VALUES ('$username',$amount_withdraw,now(),'4')";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            $output['status'] = 0;
                            $output['msg'] = 'Withdraw Request Sent';
                        }
                    }
                }else{
                    $output['status'] = 2;
                    $output['msg'] = 'Credits no enough';
                }
            }else{
                $output['status'] = 2;
                $output['msg'] = 'Error';
            }
        }else{
            $output['status'] = 2;
            $output['msg'] = 'Must fill in amount !';
        }
    }else{
        $output['status'] = 2;
        $output['msg'] = 'Please Enter Integer number !';
    }




    
    


	
	mysqli_close($conn);
    echo json_encode($output);

}

?>