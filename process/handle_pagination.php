<?php 
include("config.php");
//for pagination
$page = @$_GET['page'];
                        
if($page == 0 || $page == 1){
    $page1 = 0; 
}
else {
    $page1 = ($page * 9) - 9;   
}
?>