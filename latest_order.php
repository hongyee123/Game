<?php
require_once('config/config.php');

$pageTitle = 'orders';
$pageName = 'latest_order';

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
<div class="container">
    <div class="row col-12 mt-5">
        <div class="row col-12">
            <h1 class="col-12 text-light text-center mb-5">
                Latest Order
            </h1>
        </div>
        <div class="col-3 text-center">
            <a class="white" href="<?= $_SERVER['PHP_SELF'] ?>">
                <button type="button" class="btn btn-secondary col-12">
                    All
                </button>
            </a>
        </div>
            <?php
                $query = "SELECT DISTINCT ord_type FROM order_detail WHERE ord_status='1' AND ord_user_id = '$username'";
                $result = mysqli_query($conn, $query);
                if($result) {
                    $num_row = mysqli_num_rows($result);
                    for($i = 0; $i < $num_row; $i++) {
                        $row = mysqli_fetch_assoc($result);
            ?>
        <div class="col-3 text-center active">
            <a class="white" href="?type=<?= $row['ord_type'] ?>">
                <button type="button" class="btn btn-secondary col-12">
                    <?= strtoupper($row['ord_type']) ?>
                </button>
            </a>
        </div>
    <?php
            }
        }
    ?>
    <div class="row col-12 mt-5">
            <table class="table table-light rounded">
                <thead class="thead-dark">
                        <tr>
                            <th scope="col-1">#</th>
                            <th scope="col-3">Game</th>
                            <th scope="col-3">Helper</th>
                            <th scope="col-1">Quantity</th>
                            <th scope="col-2">Price</th>
                            <th scope="col-2">Status</th>
                        </tr>
                </thead>
                <?php
                    $page_num = @$_GET['page'];
                    if($page_num == 0 || $page_num == 1) {
                        $out_set = 0;
                    } else {
                        $out_set = ($page_num * 5) - 5;
                    }

                    $query = "SELECT * FROM order_detail WHERE ord_user_id = '$username'";

                    if(isset($_GET['type'])) {
                        $category = $_GET['type'];
                        $query .= " AND ord_type = '$category'";
                        
                    }
                    $result = mysqli_query($conn, $query);

                    if(!$result) 
                        die('Fetch Error');
                    else {
                        $num_row = mysqli_num_rows($result);
                        if($num_row > 0) {
                            for($i = 0; $i < $num_row; $i++) {
                                $row = mysqli_fetch_assoc($result);
                                ?>
                <tbody>
                    <tr>
                        <th scope="row"><?= $row['id']?></th>
                        <td><?= $row['ord_type']?></td>
                        <td><?= $row['ord_helper_id']?></td>
                        <td><?= $row['ord_quantity']?></td>
                        <td><?= $row['ord_price']?></td>
                        <td>
                        <?php
                        if($row['ord_status'] == 1){
                            ?>
                                <span class="label label-inline label-light-primary font-weight-bold">
                                    Pending
                                </span>
                            <?php
                        }elseif($row['ord_status'] == 2){
                            ?>
                                <span class="label label-inline label-light-warning font-weight-bold">
                                    ING
                                </span>
                            <?php
                        }elseif($row['ord_status'] == 3){
                            ?>
                                <span class="label label-inline label-light-dark font-weight-bold">
                                    Helper done this order
                                </span>
                            <?php
                        }elseif($row['ord_status'] == 4){
                            ?>
                                <span class="label label-inline label-light-success font-weight-bold">
                                    Done
                                </span>
                            <?php
                        }elseif($row['ord_status'] == 5){
                            ?>
                                <span class="label label-inline label-light-danger font-weight-bold">
                                    Cancelled
                                </span>
                            <?php
                        }elseif($row['ord_status'] == 10){
                            ?>
                                <span class="label label-inline label-light-danger font-weight-bold">
                                    Waiting Admin To verify the report
                                </span>
                            <?php
                        }elseif($row['ord_status'] == 11){
                            ?>
                                <span class="label label-inline label-light-success font-weight-bold">
                                    Reported Successfully, Credits Refunded
                                </span>
                            <?php
                        }elseif($row['ord_status'] == 12){
                            ?>
                                <span class="label label-inline label-light-danger font-weight-bold">
                                    Report Fail
                                </span>
                            <?php
                        }else{
                            ?>
                                <span class="label label-inline label-light-danger font-weight-bold">
                                    GG
                                </span>
                            <?php
                        }
                        ?>
                            </span>
                        </td>
                    </tr>
                <?php
                        }
                    } else {
                ?>
                    <div class="col-12 text-center">Not have product yet!</div>
                <?php
                    }
                }
                ?>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>