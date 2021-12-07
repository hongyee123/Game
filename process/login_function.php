<?php
include '../config/config.php';


if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);

    if($stmt = $conn->prepare("SELECT username, email, credits FROM user WHERE username=? AND password=?")){
        $stmt->bind_param("ss",$username,$password);
        $stmt->execute();
        $stmt->bind_result($username,$email,$credits);
        if($stmt->fetch()){

            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['credits'] = $credits;

            unset($_SESSION['error']);
            unset($_SESSION['success']);


            header("location: ../index.php");

        }else{
            echo $stmt->fetch();
            $_SESSION['error'] = "Your username or password is invalid";
            unset($_SESSION['success']);
            header("location: ../login.php");
        }
        $stmt->close();
    }

    $helper_id = $_POST['username'];

    if(isset($_SESSION['username'])){
        if($stmt = $conn->prepare("SELECT helper_id, status FROM helper WHERE helper_id='$helper_id' AND status = '2'")){
            $stmt->execute();
            $stmt->bind_result($helper_id, $status);
            if($stmt->fetch()){
                unset($_SESSION['username']);
                $_SESSION['helper_id'] = $helper_id;
                header("location: ../index.php");
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>