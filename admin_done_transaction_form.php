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


if(isset($_GET['rid'])){
    $id = $_GET['rid'];
    $sql = "SELECT * FROM helper LEFT jOIN transaction_history ON helper.helper_id = transaction_history.username WHERE transaction_history.id ='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
}
?>

<div class="container mt-4 mb-6">
    <div class="col-12 mt-5 d-flex justify-content-center">
        <h1 class="text-light text-center mb-5">
            Transfer Detail
        </h1>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                    Withdraw request from <?= $row['helper_id']; ?>
                    </h3>
                </div>


                <form class="form" id="form" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Helper ID</label>
                            <input type="text" class="form-control form-control-lg" value="<?= $row['helper_id']; ?>" disabled/>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Helper's Name</label>
                            <input type="text" class="form-control form-control-lg" value="<?= $row['name']; ?>" disabled/>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label class="font-weight-bold">Bank Type</label>
                                <input type="text" class="form-control form-control-lg" value="<?= $row['bank_name']; ?>" disabled/>
                            </div>
                            <div class="form-group col-6">
                                <label class="font-weight-bold">Bank Account</label>
                                <input type="text" class="form-control form-control-lg" value="<?= $row['bank_acc']; ?>" disabled/>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-3">
                                <label class="font-weight-bold">Evidence</label>
                                <div class="form-group">
                                    <div class="symbol symbol-50 symbol-lg-120">
                                        <img alt="Pic" src="images/001001010001/photo.png">
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label class="font-weight-bold">Request_date</label>
                                        <input type="text" class="form-control form-control-lg" value="<?= $row['request_date']; ?>" disabled/>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="font-weight-bold">Transaction_date</label>
                                        <input type="text" class="form-control form-control-lg" value="<?= $row['transaction_date']; ?>" disabled/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label class="font-weight-bold">Transaction Done By</label>
                                        <input type="text" class="form-control form-control-lg" value="<?= $row['admin']; ?>" disabled/>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-footer">
                    <button class="btn btn-primary"onclick="history.back()">Back</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-7 mb-6 d-flex justify-content-center"></div>
</div>