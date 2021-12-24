<?php
require_once('config/config.php');

$pageTitle = 'user';
$pageName = 'done_transaction';

$username = $_SESSION['admin'];

if(isset($_SESSION['admin'])){
    include('layout/admin_in.php');
}
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
}

?>

<div class="container mt-5">
    <div class="row col-12  mb-5">
        <h1 class="col-12 text-light text-center mb-5">
            Done Transaction
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <?php
                $sql = "SELECT * FROM transaction_history WHERE status = '5'";
                $result = mysqli_query($conn, $sql);
                $total_row = mysqli_num_rows($result);

                $page_num = @$_GET['page'];
                if($page_num == 0 || $page_num == 1) {
                    $out_set = 0;
                } else {
                    $out_set = ($page_num * 10) - 10;
                }
                $query = "SELECT * FROM transaction_history WHERE status = '5' ORDER BY transaction_date ASC LIMIT $out_set, 10";
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
                                <div class="card card-custom wave wave-animate wave-success mb-2 mb-lg-0 ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex flex-column ">
                                                <a href="admin_done_transaction_form.php?rid=<?=$row['id']?>" class="text-dark text-hover-primary font-weight-bold font-size-h2 d-flex">
                                                    <?=$row['username']?>
                                                </a>
                                                <a class="text-dark"><?= $row['transaction_date'];?></a>
                                            </div>
                                            <div class="flex-column">
                                                <a class="text-success font-weight-bold font-size-h2 mb-3"><?= $row['amount'];?></a>
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
            <?php 
            if($total_row>=11){
                ?>
                <a href="<?= $_SERVER['PHP_SELF'] .'?page=1'?>" class="btn btn-icon btn-light-primary mr-2 my-1"><i class="ki ki-bold-double-arrow-back icon-xs"></i></a>
                <?php
                if($page_num!=1){
                    ?>
                    <a href="<?= $_SERVER['PHP_SELF'] .'?page='. ($page_num-1) ?>" class="btn btn-icon btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
                    <?php
                }
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
                if($total_row>($page_num*10)){
                    ?>
                    <a href="<?= $_SERVER['PHP_SELF'] .'?page='. ($page_num-1) ?>" class="btn btn-icon btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
                    <?php
                }
                ?><a href="<?= $_SERVER['PHP_SELF'] .'?page='. ($page) ?>" class="btn btn-icon btn-light-primary mr-2 my-1"><i class="ki ki-bold-double-arrow-next icon-xs"></i></a>

                <?php
            }else{

            }
            
            ?>
            
        </div>
    </div>
</div>