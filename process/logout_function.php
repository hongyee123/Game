<?php 
session_start();
if (isset($_POST['logout'])) {
    if (isset($_SESSION['username'])) {
        session_destroy();
        header('location: ../index.php');
    }
    if (isset($_SESSION['helper_id'])) {
        session_destroy();
        header('location: ../index.php');
    }
    if (isset($_SESSION['admin'])) {
        session_destroy();
        header('location: ../admin_login.php');
    }
}
?>