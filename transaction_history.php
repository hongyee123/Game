<?php
require_once('config/config.php');
require_once('layouts.php');

$pageTitle = 'credits';
$pageName = 'history';

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
            Transaction History
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <?php
                $sql = "SELECT * FROM transaction_history WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                $total_row = mysqli_num_rows($result);

                $page_num = @$_GET['page'];
                if($page_num == 0 || $page_num == 1) {
                    $out_set = 0;
                } else {
                    $out_set = ($page_num * 10) - 10;
                }
                $query = "SELECT * FROM transaction_history WHERE username = '$username' ORDER BY date DESC LIMIT $out_set, 10";
                $result = mysqli_query($conn, $query);
                if(!$result) 
                    die('Fetch Error');
                else {
                    $num_row = mysqli_num_rows($result);
                    
                    if($num_row > 0) {
                        for($i = 0; $i < $num_row; $i++) {
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <div class="mb-3 col-12">
                                <div class="card card-custom wave wave-animate wave-<?php if($row['status'] == 1||$row['status'] == 3){echo"success";}elseif($row['status'] == 4){echo"warning";}else{echo"danger";}?> mb-2 mb-lg-0 ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex flex-column ">
                                                <a href="transaction_detail.php?tid=<?=$row['id']?>" class="text-dark text-hover-primary font-weight-bold font-size-h2 d-flex">
                                                    <?php   if($row['status'] == 1){ echo"Topup"; 
                                                            }else if($row['status'] == 2){ echo"Payment"; 
                                                            }else if($row['status'] == 3){ echo"Earn"; 
                                                            }else if($row['status'] == 4){ echo"Withdraw"; 
                                                            }else if($row['status'] == 5){ echo"Withdraw"; 
                                                            } 
                                                    ?>
                                                </a>
                                                <a class="text-dark"><?= $row['date'];?></a>
                                            </div>
                                            <div class="flex-column">
                                                <?php if($row['status'] == 1 || $row['status'] == 3){
                                                    ?>
                                                    <a class="text-success font-weight-bold font-size-h2 mb-3">+<?= $row['amount'];?></a>
                                                    <?php
                                                }elseif($row['status'] == 2){
                                                    ?>
                                                    <a class="text-danger font-weight-bold font-size-h2 mb-3">-<?= $row['amount'];?></a>
                                                    <?php
                                                }
                                                elseif($row['status'] == 4){
                                                    ?>
                                                    <a class="text-danger font-weight-bold font-size-h2 mb-3">-<?= $row['amount'];?></a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                ?>
                <div class="col-12 text-center">No Any Transaction History</div>
                <div class="col-3 text-center"></div>
                    <div class="col-6 card card-custom mb-lg-0 text-center align-items-center mt-5">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                    No Any Transaction History
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
    <div class="d-flex justify-content-between align-items-center flex-wrap col-12 mb-5">
        <div class="d-flex flex-wrap py-2 m-auto">
            <a href="<?= $_SERVER['PHP_SELF'] .'?page=1'?>" class="btn btn-icon btn-light-primary mr-2 my-1"><i class="ki ki-bold-double-arrow-back icon-xs"></i></a>
            <a href="<?= $_SERVER['PHP_SELF'] .'?page='. ($page_num-1) ?>" class="btn btn-icon btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
            <?php
            $page = ceil($total_row / 10);
            for($i = 1;$i <= $page; $i ++)
            $range = 2;

            
            // Added from here...    
            if (($page_num - $range) <= 1){
                $start_x = 1;
                $end_x = 5; 
            }
            else if ($page_num >= ($page - $range)){
                $start_x = $page - 4;
                $end_x = $page;
            }
            else {  
                $start_x = $page_num - $range;
                $end_x = $page_num + $range;
            }
            // Until here
            
            // loop to show links to range of pages around current page
            // for ($i = ($page_num - $range); $i < (($page_num + $range) + 1); $i++) {
            for ($i = $start_x; $i < ($end_x + 1); $i++) {
               // if it's a valid page number...
                if (($i > 0) && ($i <= $page)) {
                  // if we're on current page...
                    if ($i == $page_num) {
                     // 'highlight' it but don't make a link
                    ?>
                    <a href="<?= $_SERVER['PHP_SELF'] .'?page='. $i ?>" class="btn btn-icon border-0 btn-hover-primary text-light mr-2 my-1 <?= ($page_num == $i || ($i == 1 && $page_num == 0)) ? 'active' : '' ?>"><?= $i ?></a>
                    <?php
                  // if not current page...
                    } else {
                    ?>
                    <a href="<?= $_SERVER['PHP_SELF'] .'?page='. $i ?>" class="btn btn-icon border-0 btn-hover-primary text-light mr-2 my-1 <?= ($page_num == $i || ($i == 1 && $page_num == 0)) ? 'active' : '' ?>"><?= $i ?></a>
                    <?php
                    } // end else
                } // end if 
            } // end for
            ?>
            <a href="<?= $_SERVER['PHP_SELF'] .'?page='. ($page_num+1) ?>" class="btn btn-icon btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-next icon-xs"></i></a>
            <a href="<?= $_SERVER['PHP_SELF'] .'?page='. ($page) ?>" class="btn btn-icon btn-light-primary mr-2 my-1"><i class="ki ki-bold-double-arrow-next icon-xs"></i></a>
        </div>
    </div>
</div>