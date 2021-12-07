<?php 
$conn = mysqli_connect('localhost', 'root', '', 'game');
if (mysqli_connect_errno()) {
	die("Connection failed: " . mysqli_connect_error());
}
session_start();
?>