<base href="../">
<?php
$pageTitle = 'recieve';
$pageName = 'latest_order';


require_once('../config/verify.php');

?>
<div class="container">
    <div class="row col-12 mt-5">
        <div class="row col-12">
            <h1 class="col-12 text-light text-center mb-5">
                Latest Order Status
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
                $query = "SELECT DISTINCT ord_type FROM order_detail WHERE ord_user_id = '$username'";
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
    </div>
    <div class="row col-12 mt-5">
        <table class="table table-light rounded">
            <thead class="thead-dark">
                    <tr>
                        <th class="col-1">#</th>
                        <th class="col-3">Game</th>
                        <th class="col-3">User</th>
                        <th class="col-2">Quantity</th>
                        <th class="col-3"></th>
                    </tr>
            </thead>
            <?php
                $page_num = @$_GET['page'];
                if($page_num == 0 || $page_num == 1) {
                    $out_set = 0;
                } else {
                    $out_set = ($page_num * 5) - 5;
                }

                $query = "SELECT * FROM order_detail WHERE ord_helper_id = '$username'";

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
                <tr id="order-<?= $row['id'] ?>">
                    <th scope="row"><?= $row['id']?></th>
                    <td><?= $row['ord_type']?></td>
                    <td><?= $row['ord_user_id']?></td>
                    <td><?= $row['ord_quantity']?></td>
                    <td>
                    <?php
                        if($row['ord_status'] == 1){
                            ?>
                                <span class="label label-inline label-light-primary font-weight-bold">
                                    Haven't accept
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
                                    Waiting for user to comfirm
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
                                    User Report This order
                                </span>
                            <?php
                        }
                        elseif($row['ord_status'] == 11){
                            ?>
                                <span class="label label-inline label-light-danger font-weight-bold">
                                    User Report Success
                                </span>
                            <?php
                        }elseif($row['ord_status'] == 12){
                            ?>
                                <span class="label label-inline label-light-danger font-weight-bold">
                                    User Report Fail
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