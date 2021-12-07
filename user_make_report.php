<?php
require_once('config/config.php');

$pageTitle = 'help';
$pageName = 'report';

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

if(isset($_GET['pid'])) {
    $id = $_GET['pid'];
} else {
    header('location: index.php');
}

$query = "  SELECT order_detail.id AS detail_id,
            order_detail.ord_type AS type,
            order_detail.ord_status AS status,
            order_detail.ord_quantity AS quantity,
            order_detail.ord_price AS price,
            orders.ord_user_id AS user
            FROM orders LEFT JOIN order_detail ON orders.id = order_detail.id WHERE ord_user_id = '$username' AND order_detail.id = '$id'";
$result = mysqli_query($conn, $query);
if($result){
    if(mysqli_num_rows ($result)>0){
    $row = mysqli_fetch_assoc($result);

?>
<div class="container mt-4 mb-5">
    <div class="col-12 mt-5 d-flex justify-content-center">
        <h1 class="text-light text-center mb-5">
            Report
        </h1>
    </div>
    
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                    Order ID : <?= $row['detail_id'] ?>
                    </h3>
                </div>
                <!--begin::Form-->
                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="pl-0 font-weight-bold text-muted text-uppercase">Game Type</th>
                                            <th class="text-right font-weight-bold text-muted text-uppercase">Price</th>
                                            <th class="text-right font-weight-bold text-muted text-uppercase">Quantity</th>
                                            <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="font-weight-boldest">
                                            <td class="pl-0 pt-7"><?= $row['type'] ?></td>
                                            <td class="text-right pt-7">RM<?= $row['price'] ?></td>
                                            <td class="text-right pt-7"><?= $row['quantity'] ?></td>
                                            <td class="text-danger pr-0 pt-7 text-right">RM<?= $row['quantity']*$row['price'] ?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Reason</label>
                            <select class="form-control  form-control-lg" id="exampleSelect1">
                                <option disabled selected selected>Please Select a Reason</option>
                                <option>Undone</option>
                                <option>Rank Drop</option>
                                <option>Item / Credit of game account missing</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Contant</label>
                            <textarea type="text" class="form-control form-control-lg"  placeholder="Contant" name="contant"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2" name="add_notice" value="Add">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-7 d-flex justify-content-center"></div>
</div>
<?php
    }else{
        echo "ERROR";
    }
}else{
    echo "ERROR";
}

?>
