<?php
require_once('config/config.php');
require_once('config/bootstrap.php');
require_once('layouts.php');

$pageTitle = 'orders';
$pageName = 'start_order';

if(!isset($_SESSION['username']) && !isset($_SESSION['helper_id'])){
    header("Location: index.php");
}
if(isset($_SESSION['username'])){
    include('layout/in.php');
    $username = $_SESSION['username'];
}if(isset($_SESSION['helper_id'])){
    include('layout/helper_in.php');
    $username = $_SESSION['helper_id'];
}


?>

<div class="container mt-5">
    <div class="row col-12  mb-5">
        <h1 class="col-12 text-light text-center mb-5">
            Favourite
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <?php
                
                $query = "SELECT * FROM favourite WHERE favourite_user = '$username'";

                $result = mysqli_query($conn, $query);

                if(!$result) 
                    die('Fetch Error');
                else {
                    $num_row = mysqli_num_rows($result);
                    
                    if($num_row > 0) {
                        for($i = 0; $i < $num_row; $i++) {
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            
                            <div class="mb-5 col-6">
                                <div class="card card-custom wave wave-animate wave-primary mb-4 mb-lg-0 ">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-column">
                                                <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h2 mb-3"><?= $row['favourite_helper'];?></a>
                                                <div class="col-12">
                                                    <a href="helper/helper_information.php?pid=<?= $row['favourite_helper']; ?>" class="btn btn-primary mt-3">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                ?>
                <div class="col-12 text-center">Add Your Favourite Helper Now!</div>
                <div class="col-3 text-center"></div>
                    <div class="col-6 card card-custom mb-lg-0 text-center align-items-center mt-5">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                    Add Your Favourite Helper Now!
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>