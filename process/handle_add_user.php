<?php
require_once 'config/config.php';
require_once 'config/test_input.php';

$valid = "is-valid";
$invalid = "is-invalid";

$username = $password = $contact = $email = $p = $c = "";//init variable

$valid_username = $valid_password = $valid_contact = $valid_email = "";//init variable for validation

if (isset($_POST['add_user'])) {
	$ok2add = true;

	$username = test_input($_POST['username']);
	$password = test_input($_POST['password']);
	$contact = test_input($_POST['contact']);
	$email = test_input($_POST['email']);

	$valid_username = $valid_password = $valid_contact = $valid_email = $valid;
	// check username
	$c = test_input($_POST['username']);
	$username = md5($c);
	$sql = "SELECT username FROM user WHERE username = '$username';";
	$result   = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) != 0){//validation employee id
		$valid_username = $invalid;
		$ok2add = false;
	}else{
		$valid_username = $valid;
	}
	
	// check password
	$password = test_input($_POST['password']);
	$password2 = test_input($_POST['password2']);
	if($password == $password2){
		$p = $password;
		$password = md5($p);
		$valid_password = $valid;
	}else{
		$valid_password = $invalid;
		$ok2add = false;
	}

	if ($ok2add == true) {
		$sql = "INSERT INTO user(`username`, `password`, `contact`, `email`, `status`) VALUES ('$username','$password','$contact','$email','1');";
		echo $sql;
		$sql2 ="SELECT * FROM `user`";
		echo $sql2;
		//$sql .= "INSERT INTO wallet(username) VALUES ('$username');";
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
		echo "<script>
		alert('Register Sucessful ! !');
		window.location.assign('login.php')
		</script>";
	}
}
?>