<?php
include '../config/config.php';
include '../config/test_input.php';
// if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
// $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
// $_SERVER['REQUEST_METHOD'] == "POST") {
    header('Content-Type: application/json');
    $output = array();

    $helper_id = $_SESSION['username'];

        $ic = $_POST['ic'];
        $name = $_POST['name'];
        $address1 = $_POST['address1'];
        $postcode = $_POST['postcode'];
        $state = $_POST['state'];
        $photo = $_POST['photo'];
        $ic_pic = $_POST['ic_pic'];
        $bank_name = $_POST['bank_name'];
        $bank_account = $_POST['bank_account'];
    
        $query = "SELECT credits FROM user WHERE username = '$helper_id'";
        $result = mysqli_query($conn, $query);
        $num_row = mysqli_num_rows($result);
        if($num_row > 0) {
            $user = mysqli_fetch_object($result);
        }
        if($user->credits >= 100){
            $credits_after = $user->credits - 100;
            $query = "UPDATE user SET credits = '$credits_after'WHERE username = '$helper_id'";
            if(!empty($_POST['ic']) && !empty($_POST['name']) && !empty($_POST['address1'])){
                $s = " SELECT * FROM helper";
                $result = mysqli_query($conn,$s);
    
                if(($_POST['photo'])==null&&$_POST['ic_pic']!=null){
                    $output['status'] = 2;
                    $output['msg'] = 'Please Upload Your Photo';
                    echo json_encode($output);
                    exit();
                }
                else if(($_POST['ic_pic'])==null&&$_POST['photo']!=null){
                    $output['status'] = 2;
                    $output['msg'] = 'Please Upload Your IC Photo';
                    echo json_encode($output);
                    exit();
                }
                
                else if ($_POST['photo']!=null || $_POST['ic_pic']!=null) {
                    $photo_file_name = './../images/'.$_POST['ic'] .'/photo.png';
                    $ic_file_name = './../images/'.$_POST['ic'] .'/ic.png';
                
                    $target_dir = '../images/'.$_POST['ic'];
                    if (!file_exists($target_dir))
                        mkdir($target_dir);
                
                    save_file($_POST['photo'], $photo_file_name);
                    save_file($_POST['ic_pic'], $ic_file_name);

                    $reg = "INSERT INTO helper (`helper_id`,`name`, `ic`,bank_name,bank_acc,`address1`,`postcode`,`state`,`photo`,`ic_pic`,`status`) VALUES ('$helper_id','$name','$ic','$bank_name','$bank_account','$address1','$postcode','$state','$photo_file_name','$ic_file_name','1');";
                    // $reg = "INSERT INTO helper (`helper_id`,`name`, `ic`,`address1`, `address2`,`postcode`,`state`,`status`) VALUES ('$helper_id','$name','$ic','$address1','$address2','$postcode','$state','1');";
                    $done = mysqli_query($conn,$reg);
                    if($done){
                        $output['status'] = 0;
                        $output['msg'] = 'Done';
                    }
                }
                else{
                    $output['status'] = 2;
                    $output['msg'] = 'Please Upload Your Photo!!!!!!';
                    echo json_encode($output);
                    exit();
                }
            }else{
                $output['status'] = 2;
                $output['msg'] = 'Fill in all information';
            }
    
            $detail_result = mysqli_query($conn, $query);
            if(!$detail_result) {
                $output['status'] = 2;
                $output['msg'] = 'Fail';
            }
        }else{
            $output['status'] = 3;
        }
    echo json_encode($output);

// }
                // base64 data   file path
function save_file($data            ,$file_path)
{
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);

    $data = base64_decode($data);

    file_put_contents($file_path, $data);
}

?>