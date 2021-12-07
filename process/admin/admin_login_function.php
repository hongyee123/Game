<?php
include '../../config/config.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?")){
        $stmt->bind_param("ss",$username,$password);
        $stmt->execute();
        if($stmt->fetch()){

            $_SESSION['admin'] = $username;

            unset($_SESSION['error']);
            unset($_SESSION['success']);
            echo"Done";
            echo($_SESSION['admin']);

            header("location: ../../admin_home.php");

        }else{
            echo $stmt->fetch();
            $_SESSION['error'] = "Your username or password is invalid";
            unset($_SESSION['success']);
            header("location: ../../admin_login.php");
            echo"GG";
        }
        $stmt->close();
    }
}
?>