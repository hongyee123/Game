<?php
require_once('../config/config.php');

header('Content-Type: application/json');
$output = array();

$username = $_SESSION['username'];



//Change Password
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && ($_POST['type']) == 'information'){
    $type = $_POST['type'] ;
    $facebook_link = $_POST['facebook_link'];
    $photo = $_POST['photo'];
    $photo_file_name = '../images/profile_pic/'.$_SESSION['username'] .'/photo.png';
    $target_dir = '../images/profile_pic/'.$_SESSION['username'];
    $photo_file = 'images/profile_pic/'.$_SESSION['username'] .'/photo.png';

    if( $photo!= null ){
        if (!file_exists($target_dir)){
            mkdir($target_dir);
        }
        save_file($_POST['photo'], $photo_file_name);
    
        
        $sql = "UPDATE user SET facebook = '$facebook_link', profile_pic = '$photo_file'  WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if($result){
            
            $output['status'] = 0;
            $output['msg'] = 'Update Success';
        }
    }
    else if($photo == null || $facebook_link != null){
        $sql = "UPDATE user SET facebook = '$facebook_link', profile_pic = '$photo_file'  WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $output['status'] = 0;
            $output['msg'] = 'Update Success';
        }
    }
    else if($photo != null || $facebook_link == null){
        if (!file_exists($target_dir)){
            mkdir($target_dir);
        }
        save_file($_POST['photo'], $photo_file_name);
        $output['status'] = 0;
        $output['msg'] = 'Update Success';
    }else{
        $output['status'] = 0;
        $output['msg'] = 'fail';
    }
}



//Change Password
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && ($_POST['type']) == 'password'){
    $type = $_POST['type'] ;
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $verify_password = $_POST['verify_password'];
    $query ="SELECT password FROM user WHERE username = '$username'";
	$result = mysqli_query($conn, $query);
    if($result){
        $row =mysqli_fetch_assoc($result);
        if($current_password != null || $new_password != null || $verify_password != null){
            if($new_password == $verify_password){
                if($row['password'] == md5($current_password)){
                    if($current_password != $new_password){
                        $final_password = md5($new_password);
                        $sql = "UPDATE user SET password = '$final_password' WHERE username = '$username'";
                        $result2 = mysqli_query($conn, $sql);
                        if($result2){
                            $output['status'] = 0;
                            $output['msg'] = 'Update Success';
                        }
                    }else{
                        $output['status'] = 2;
                        $output['msg'] = "New password can't same with current pssword";
                    }
                }else{
                    $output['status'] = 2;
                    $output['msg'] = 'Password Wrong';
                }
            }else{
                $output['status'] = 2;
                $output['msg'] = 'Two password entered not same';
            }
        }else{
            $output['status'] = 2;
            $output['msg'] = 'Please fill up all blank';
        }
    }
}

mysqli_close($conn);
echo json_encode($output);







function save_file($data            ,$file_path)
            {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
            
                $data = base64_decode($data);
            
                file_put_contents($file_path, $data);
            }
?>




