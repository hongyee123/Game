<?php

require_once('data_valid_functions.php');
require_once('../config/config.php');

session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$contact = $_POST['contact'];
$email = $_POST['email'];




$s = " SELECT * FROM user WHERE username = '$username'";

$result = mysqli_query($conn,$s);

$num = mysqli_num_rows($result);

unset($_SESSION['error']);
unset($_SESSION['success']);

	if($num == 1){
		$_SESSION['register_error'] = "Username has taken";
		header("location:../register.php");
	}else{


		$sql = "INSERT INTO user(`username`, `password`, `contact`, `email`, `status`) VALUES ('$username',md5('$password'),'$contact','$email','1');";
			$sql .= "INSERT INTO credits(username) VALUES ('$username');";
			if (mysqli_multi_query($conn,$sql)){
				do{// Store first result set
					if ($result=mysqli_store_result($conn)) {// Fetch one and one row
						while ($row=mysqli_fetch_row($result)){
							printf("%s\n",$row[0]);
						}// Free result set
						mysqli_free_result($result);
					}
				}
				while (mysqli_next_result($conn));
			}
			$_SESSION['success'] = "Registration Successful - You may login now !";
			unset($_SESSION['error']);
			header("location: ../login.php");
	}
?>