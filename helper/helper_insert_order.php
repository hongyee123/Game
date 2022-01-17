<base href="../">
<?php
$pageTitle = 'recieve';
$pageName = 'insert_order';

require_once('../config/verify.php');

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
                    </h3>
                </div>
                <!--begin::Form-->
                <form class="form" id="form" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Game Type</label>
                            <select class="form-control form-control-lg" id="type" name="type">
                                <?php
                                $query = "SELECT DISTINCT name FROM category";
                                $result = mysqli_query($conn, $query);
                                if($result) {
                                    $num_row = mysqli_num_rows($result);
                                    for($i = 0; $i < $num_row; $i++) {
                                        $row = mysqli_fetch_assoc($result);
                                        $name = $row['name'];
                                        $sql = "SELECT type FROM product_detail WHERE username = '$username'AND type ='$name'";
                                        $result2 = mysqli_query($conn, $sql);
                                        $num_rows = mysqli_num_rows($result2);
                                        if($num_rows<1){
                                        ?>
                                            <option value="<?= $name?>"><?= $name?></option>
                                        <?php
                                        }
                                        
                                    }
                                }
                                ?>
                            </select>
                            <input type="hidden" id="type" name="type" value="<?php echo $type ?>">
                        </div>
                        <div class="row">
                            <div class="form-group col-5">
                                <label>Quantity</label>
                                <input type="text" class="form-control form-control-lg"  placeholder="Quantity" name="quantity" id="quantity"/>
                            </div>
                            <div class="form-group col-5">
                                <label>Price</label>
                                <input type="text" class="form-control form-control-lg"  placeholder="Price" name="price" id="price"/>
                            </div>
                            <div class="form-group col-2 mx-auto">
                                <label class="d-flex justify-content-center">Available</label>
                                <label class="checkbox d-flex justify-content-center">
                                    <label class="checkbox checkbox-lg">
                                        <input type="checkbox" name="available" id="available" value="10" checked/>
                                        <span></span>
                                    </label>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" class="form-control form-control-lg"  placeholder="description" name="description" id="description"></textarea>
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
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$('.btn-insert').on('click', function() {
    var type = document.getElementById('type').value;
    var quantity = document.getElementById('quantity').value;
    var price = document.getElementById('price').value;
    var available = $('#available').is(':checked');
    var description = document.getElementById('description').value;
    var add_product = "add_product";

    console.log(type);
    console.log(quantity);
    console.log(price);
    console.log(available);
    console.log(description);
    console.log(description);

    $.ajax({
        url: 'process/add_product.php',
        type: 'POST',
        data: {
            type : type,
            quantity : quantity,
            price : price,
            available : available,
            description : description,
            add_product : add_product,
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