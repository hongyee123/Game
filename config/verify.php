<?php
require_once('../config/config.php');

if(isset($_SESSION['username'])){
    include('../layout/in.php');
    $_SESSION['username'] = $username;
}else if(isset($_SESSION['helper_id'])){
    include('../layout/helper_in.php');
    $_SESSION['helper_id'] = $username;
}else{
    header("Location: index.php");
}
?>
