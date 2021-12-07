<?php
// show product detail
require_once('config/config.php');
require_once('config/bootstrap.php');
require_once('layouts.php');

if(isset($_GET['pid'])) {
    $id = $_GET['pid'];
}else{
    header("Location: index.php");
}

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

$query = "SELECT * FROM product_detail WHERE id = $id";
$result = mysqli_query($conn, $query);

if(!$result) 
    die('Fetch Error!');
else {
    $num_row = mysqli_num_rows($result);
    if($num_row > 0) {
        $product = mysqli_fetch_object($result);
    }
}

?>


<html lang="en">
<head>
    
</head>
<body>
<div class="container">
    <div class="row">
        <div class="row col-12 mt-5">
            <div class="row col-12">
                <h1 class="col-12 text-light text-center mb-5">
                    Order Detail
                </h1>
            </div>
        </div>
        <div class="col-xl-8">
            <!--begin::Stats Widget 1-->
            <div class="card card-custom bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-4.svg)">
                <!--begin::Body-->
                <div class="card-body">
                    <h2 class="mb-4"><?= $product->type ?></h2>
                    <div class="font-weight-bold text-success">
                        <?php 
                            if($product->quantity >0){
                                echo 'Available :<b style="font-size: 2rem;">';
                                echo ($product->quantity);
                                echo '</b> left';
                            }else{
                                echo 'Unvailable';
                            }
                        ?>
                    </div>
                    <a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5 ">RM: <b><?= number_format(floatval($product->price), 2) ?></b> per game</a>
                    <div class="row mt-1">
                    <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="col-3">
                            <div class="font-weight-bold font-size-sm">Quantity</div>
                        </div>
                        <div class="col-9">
                            <div class="mb-2">
                                <button id="minus-btn" class="btn btn-sm btn-danger" disabled>
                                    <i class="fas fa-minus" style="padding-left: 0.30rem;"></i>
                                </button>
                                <input id="quantity" type="text" step="1" min="<?= ($product->quantity == 0) ? '0' : '1' ?>" value="<?= ($product->quantity == 0) ? '0' : '1' ?>" 
                                    max="<?= $product->quantity ?>" style="width:20px;" class="border-0 text-center">
                                <button class="btn btn-sm btn-danger" id="add-btn" <?= ($product->quantity == 0) ? 'disabled' : '' ?>>
                                    <i class="fas fa-plus" style="padding-left: 0.30rem;"></i>
                                </button>
                                <span id="outStock" class="text-danger" style="font-size: 10px;"><?= ($product->quantity == 0) ? 'Out of stock' : '' ?></span>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-block btn-danger text-white mt-3" id="btn-cart" <?= ($product->quantity == 0) ? 'disabled' : '' ?>>Add To Cart</button>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 1-->
        </div>
        <div class="col-xl-4">
            <!--begin::Stats Widget 6-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="helper/helper_information.php?pid=<?= $product->username ?>" class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary"><?= $product->username ?></a>
                        <span class="font-weight-bold text-muted font-size-lg">Ask Everything You Wish</span>
                    </div>
                    <img src="assets/media/svg/avatars/029-boy-11.svg" alt="" class="align-self-end h-100px">
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 6-->
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Stats Widget 1-->
            <div class="card card-custom bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-2.svg)">
                <!--begin::Body-->
                <div class="card-body">
                    <h3><b>Description</b></h3>
                    <p class="font-weight-bold font-size-sm"><?= $product->description ?></p>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 1-->
        </div>
    </div>
</div>
</body>
</html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$(document).ready(function() {
    $("#btn-cart").click(function() {
        var id = $('input[name="id"]').val();
        var quantity = $('input#quantity').val();

        $.post({
            url: 'process/add_cart.php',
            data: {
                id: id,
                quantity: quantity,
            },
            success: function (result) {
                console.log(result);
                if(result.status == 1) {
                    swal({
                        title: "Something Wrong!",
                        text: "To add cart, You need to login first!",
                        icon: "info",
                        buttons: true,
                    }).then((bool) => {
                        window.location.assign('login.php');
                        window.location.assign('login.php?request_url='+ window.location.href);
                    });
                }else if(result.status == 0){
                    $('#crt_qty').html(''+result.cart_quantity);
                    $('#quantity_left').html('quantity left '+ result.quantity_left);
                    $('#quantity').attr('max', result.quantity_left);
                    $('#quantity').val(1);
                    $('#minus-btn').prop('disabled', true);
                    swal({
                        icon: "success",
                        title: "Success",
                        text: result.msg,
                        timer: 1100,
                        buttons: false,
                    });
                    if(result.quantity_left == 0) {
                        $('#outStock').html('Out of stock');
                        $('#btn-cart').prop('disabled', true);
                        $('#minus-btn').prop('disabled', true);
                        $('#add-btn').prop('disabled', true);
                        $('#quantity').val(0);
                    }
                }else if(result.status == 2){
                    swal({
                        icon: "warning",
                        title: "Success",
                        text: result.msg,
                        timer: 1100,
                        buttons: false,
                    });
                }
            }
        });
    });

    $('#add-btn').click(function() {
        var quantity =  parseInt($('#quantity').val());
        var max = parseInt($('#quantity').attr('max'));
        if(quantity < max) {
            quantity++;
            $('#quantity').val(quantity);

            if(quantity == max)
                $(this).prop('disabled', true);
        }

        if($('#minus-btn').prop('disabled'))
            $('#minus-btn').prop('disabled', false);
    });

    $('#minus-btn').click(function() {
        var quantity =  parseInt($('#quantity').val());
        var max = parseInt($('#quantity').attr('max'));

        if(quantity > 1) {
            quantity--;
            $('#quantity').val(quantity);
        }

        if(quantity <= 1)
            $(this).prop('disabled', true);
        
        if($('#add-btn').prop('disabled'))
            $('#add-btn').prop('disabled', false);
    });

});
</script>

