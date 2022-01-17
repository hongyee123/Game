<base href="../">
<?php
$pageTitle = 'recieve';
$pageName = 'insert_order';

require_once('../config/verify.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM product_detail where id ='$id' AND username = '".$_SESSION["helper_id"]."'";
    $result = mysqli_query($conn, $sql);

    $product = mysqli_fetch_array($result);

    

?>

<div class="container mt-4 mb-5">
    <div class="col-12 mt-5 d-flex justify-content-center">
        <h1 class="text-light text-center mb-5">
            Insert Order
        </h1>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                    New Order
                    <input type="text" class="form-control form-control-lg"  value="<?= $product['id']?>" placeholder="id" name="id" id="id" hidden/>
                    </h3>
                </div>
                <!--begin::Form-->
                <form class="form" id="form" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Game Type</label>
                            <input type="text" class="form-control form-control-lg"  value="<?= $product['type']?>" disabled/>
                        </div>
                        <div class="row">
                            <div class="form-group col-5">
                                <label>Quantity</label>
                                <input type="text" class="form-control form-control-lg"  value="<?= $product['quantity']?>" placeholder="Quantity" name="quantity" id="quantity"/>
                            </div>
                            <div class="form-group col-5">
                                <label>Price (RM)</label>
                                <input type="text" class="form-control form-control-lg"  value="<?= $product['price']?>" placeholder="Price" name="price" id="price"/>
                            </div>
                            <div class="form-group col-2 mx-auto">
                                <label class="d-flex justify-content-center">Available</label>
                                <label class="checkbox d-flex justify-content-center">
                                    <label class="checkbox checkbox-lg">
                                        <input type="checkbox" name="available" id="available" value="10" <?php if($product['available']=='1'){echo "checked";}?>/>
                                        <span></span>
                                    </label>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" class="form-control form-control-lg"   placeholder="description" name="description" id="description"><?= $product['description']?></textarea>
                        </div>
                    </div>
                    
                </form>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2 btn-insert" name="add_product" value="Add">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-7 d-flex justify-content-center"></div>
</div>
    
<?php
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$('.btn-insert').on('click', function() {
    var id = document.getElementById('id').value;
    var quantity = document.getElementById('quantity').value;
    var price = document.getElementById('price').value;
    var available = $('#available').is(':checked');
    var description = document.getElementById('description').value;
    var edit_product = "edit_product";

    $.ajax({
        url: 'process/add_product.php',
        type: 'POST',
        data: {
            id:id,
            quantity : quantity,
            price : price,
            available : available,
            description : description,
            edit_product : edit_product,
        },
        success: function(result) {
            if(result.status == 1) {
                swal({
                    icon: "success",
                    title: "Success",
                    text: result.msg,
                    timer: 1700,
                    buttons: false,
                }).then(function(){
                window.location.assign('helper/helper_view_order_information.php');
                });
            } 
            if(result.status == 2) {
                swal({
                    icon: "warning",
                    title: "Fail",
                    text: result.msg,
                    timer: 1700,
                    buttons: false,
                }).then(function(){
                // window.location.assign('done_order.php');
                });
            }
        },
        error: function(){
            swal({
                icon: "error",
                title: "An error occurred.",
                text: "apa lan" ,
                timer: 2500,
                buttons: false,
        });
        }
    });
});
</script>