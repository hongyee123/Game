<?php
require_once('../config/config.php');

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST") {
    header('Content-Type: application/json');
    $output = array();
    
	$select = $_POST['select'];
    $description = $_POST['description'];
    $id = $_POST['id'];
	$file = $_POST['file'];


	if($file!=null){
		if($select!=null && $description!=null){

			$file_name_save = 'evidence/'.$_POST['id'] .'/evidence.pdf';
			$file_name = '../evidence/'.$_POST['id'] .'/evidence.pdf';
					
			$target_dir = '../evidence/'.$_POST['id'];
			if (!file_exists($target_dir))
				mkdir($target_dir);
		
			save_file($_POST['file'], $file_name);

			$sql = "INSERT INTO report(ord_id, reason, description,evidence,status,report_time) VALUES ('$id','$select','$description','$file_name_save','1',now())";
			$result = mysqli_query($conn, $sql);
			$sql = "UPDATE `order_detail` SET `ord_status`='10' WHERE id='$id'";
			$result = mysqli_query($conn, $sql);
	
	
	
			if($result) {
				$output['status'] = 0;
				$output['msg'] = 'Report Submitted, Please wait for 3-5 Working days';
			}else{
				$output['status'] = 2;
				$output['msg'] = 'There is something wrong';
			}
		}else{
			$output['status'] = 2;
			$output['msg'] = 'Please Fill In all Information';
		}
	}else{
		$output['status'] = 2;
		$output['msg'] = 'Please Upload Your Evidence';
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