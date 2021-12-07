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

$query = "SELECT 
    cart.id AS cart_id,
    product_detail.id AS product_id,
    username,
    type,
    price,
    cart_quantity,
    quantity 
    FROM cart LEFT JOIN product_detail ON cart.cart_product = product_detail.id WHERE cart_username = '$username'";

$result = mysqli_query($conn, $query);

if($result) {
    echo $bootstrapCSS; echo $jQueryJS;echo $jQueryFormJS;echo $sweetAlert; echo $bootstrapJS; echo $fontAwsomeIcons;

    $num_row = mysqli_num_rows($result);
    ?>
    
    <main>
    <div class="container mt-5">
        <div class="row col-12 mt-5">
            <div class="row col-12">
                <h1 class="col-12 text-light text-center mb-5">
                    Place Order
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card border-0 mb-2">
                    <div class="card-header bg-white">Product List</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-light">
                                <div class="row">
                                    <div class="col-2">Item</div>
                                    <div class="col-6">Helper</div>
                                    <div class="col-2">Price</div>
                                    <div class="col-2 text-right">Quantity</div>
                                </div>
                            </li>
                            <?php
                            $total_price = 0;
                            for($i = 0; $i < $num_row; $i++) {
                                $row = mysqli_fetch_assoc($result);
                                $total_price += $row['price'] * $row['cart_quantity'];
                            ?>
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <?= $row['type'] ?>
                                            </div>
                                            <input id="product_id" class="product_id" type="hidden" value="<?= $row['product_id'] ?>">
                                            <div class="col-9"><?= $row['username'] ?></div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        RM <?= number_format($row['price'], 2) ?>
                                    </div>
                                    <div class="col-1"><?= $row['cart_quantity'] ?></div>
                                </div>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card border-0">
                    <div class="card-body">
                        <form action="checkout.php" method="post">
                            <div class="d-flex justify-content-between my-2">
                                <div class="small text-muted">Subtotal (<?= $num_row ?> items)</div>
                                <div>RM <?= number_format(floatval($total_price), 2) ?></div>
                            </div>
                            <!-- <div class="d-flex justify-content-between my-2">
                                <input id="promo_code" class="form-control" type="text" placeholder="Enter Promo Code">
                            </div> -->
                            <div class="d-flex justify-content-between my-2">
                                <div class="small text-muted">Total</div>
                                <div style="color: #ff9326;"><p id="total"><?= number_format(floatval($total_price), 2, '.', '') ?></p></div>
                                <div class="small text-muted">Discount Total</div>
                                <div class="text-success">
                                    <p id="discount_total" name="discount_total">0</p>
                                </div>
                            </div>
                            <div class="my-2">
                                <input  id="btn_placeOrder" class="btn btn-warning btn-block" style="background-color: #ff9326;" type="button" value="Place Order">
                            </div>
                        </form>
                    </div>
                </div>
                <a href="view_cart.php" class="btn-link"><i class="fas fa-arrow-left my-2"></i> Back</a>
            </div>
        </div>
    </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('#btn_placeOrder').on('click', function() {
            discount_total = $('#discount_total').text();
            $.ajax({
                url: 'process/place_order.php',
                type: 'POST',
                data: {
                    'username' : '<?php echo $username; ?>',
                    
                    'ord_discount' : discount_total,
                },
                success: function(data) {
                    swal({
                        icon: "success",
                        title: "Success",
                        text: "Order Placed Successfully",
                        timer: 2500,
                        buttons: false,
                    }).then(function(){
                        window.location.assign('latest_order.php');
                    });
                },
                error: function(){
                    swal({
                        icon: "error",
                        title: "An error occurred.",
                        text: "Credits no enough - Please Top-up " ,
                        timer: 2500,
                        buttons: false,
                });
                }
            });

        });

        // $('#promo_code').on('change', function(){
        //     $.ajax({
        //         url: 'functions/checkVoucher.php',
        //         type: 'GET',
        //         data: { 'promo_code' : this.value },
        //         success: function(data){
        //             var parsedData = JSON.parse(data);
        //             var promo_total = 0;

        //             if(parsedData.voucherExists == "1"){
        //                 $('#promo_code').attr('class', 'form-control is-valid');
        //                 var product_ids =[];

        //                 $('.product_id').each(function(value){
        //                     var quantity = $(this).parents('.row').find('.col-1').html();
        //                     quantity = parseInt(quantity);
        //                     product_ids.push([$(this).val(), quantity]);
        //                 });
        //                 console.log(product_ids);
                        
        //                 for($i = 0; $i <product_ids.length; $i++){
        //                     if(product_ids[$i][0] == parsedData.promo_prdt){
        //                         promo_total += parseInt(parsedData.promo_discount) * product_ids[$i][1];
        //                     }
        //                 }
                        
        //                 $('#discount_total').html(promo_total);
        //                 total_value = parseFloat($('#total').html()) - promo_total;
        //                 if(total_value < 0){
        //                     total_value = 0;
        //                 }
        //                 $('#total').html(total_value);

        //             }else{
        //                 $('#promo_code').attr('class', 'form-control is-invalid');
        //             }

        //         },
        //         error: function(){

        //         }
        //     });
        // });
    </script>
    <!-- <script src="js/top-nav-user.js"></script> -->
    <?php
    do_html_end();
}

