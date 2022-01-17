<?php
require_once('../config/config.php');
include '../config/test_input.php';

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
                if($row['credits'] >= $amount_withdraw){
                    $total_withdraw = $row['credits'] - $amount_withdraw;
                    $sql = "UPDATE `user` SET `credits`= '$total_withdraw' WHERE username = '$username'";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        $sql = "INSERT INTO `transaction_history`(`username`, `amount`, `request_date`, `status`) VALUES ('$username',$amount_withdraw,now(),'4')";
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



if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['done_withdraw']))) {
    header('Content-Type: application/json');
    $output = array();

    $id = $_POST['id'];
    $admin = $_POST['admin'];
	$evidence = $_POST['evidence'];


    if($evidence!=null){
        $evidenve_file_name = '../images/evidence_transaction/'.$_POST['id'] .'/evidence.png';
        $target_dir = '../images/evidence_transaction/'.$_POST['id'];
        if (!file_exists($target_dir))
            mkdir($target_dir);
    
        save_file($_POST['evidence'], $evidenve_file_name);
        $sql = "UPDATE `transaction_history` SET transaction_date=now(), status='5', evidence = '$evidenve_file_name', admin ='$admin' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $output['status'] = 0;
            $output['msg'] = 'Success';
        }
    }else{
        $output['status'] = 2;
        $output['msg'] = 'Please insert Evidence !';
    }
	mysqli_close($conn);
    echo json_encode($output);
}




function save_file($data            ,$file_path)
            {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
            
                $data = base64_decode($data);
            
                file_put_contents($file_path, $data);
            }
?>