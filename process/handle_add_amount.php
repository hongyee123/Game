<?php
require_once '../config/config.php';

if(isset($_POST['amount_topup']) ){
    




    if(isset($_SESSION['username'])){{
      $username = $_SESSION['username'];
      $sql = "SELECT credits FROM user where username ='$username'";
      $current_amount = $conn -> query($sql) -> fetch_assoc()['credits'];
      
      $topup_amount = json_decode($_POST['amount_topup'], true);
      $total_amount = $current_amount + $topup_amount;

      $sql = "UPDATE user SET credits = '$total_amount' WHERE username ='$username'";
      $sql1 = "INSERT INTO transaction_history(username, amount,date,status) VALUES ('$username', '$topup_amount', NOW(),'1')";
      mysqli_query($conn, $sql1);
      mysqli_query($conn, $sql);

      $_SESSION['credits'] = $total_amount;


    }}else if(isset($_SESSION['helper_id'])){
      $username = $_SESSION['helper_id'];
      $sql = "SELECT credits FROM user where username ='$username'";
      $current_amount = $conn -> query($sql) -> fetch_assoc()['credits'];
      
      $topup_amount = json_decode($_POST['amount_topup'], true);
      $total_amount = $current_amount + $topup_amount;

      $sql = "UPDATE user SET credits = '$total_amount' WHERE username ='$username'";
      $sql1 = "INSERT INTO transaction_history(username, amount,date,status) VALUES ('$username', '$topup_amount', NOW(),'1')";
      mysqli_query($conn, $sql1);
      mysqli_query($conn, $sql);

      $_SESSION['credits'] = $total_amount;

      header('Location: ../index');
    }



}else{
  echo false;
}
?>