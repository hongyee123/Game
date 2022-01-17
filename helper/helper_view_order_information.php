<base href="../">
<?php

$pageTitle = 'recieve';
$pageName = 'insert_order';

require_once('../config/verify.php');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <title></title>
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<style>
.btn-circle.btn-xl {
    width: 70px;
    height: 70px;
    padding: 10px 16px;
    border-radius: 35px;
    font-size: 24px;
    line-height: 1.33;
}

.btn-circle {
    width: 30px;
    height: 30px;
    padding: 6px 0px;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
}
.btn i{
    padding-right: 0rem !important;
    padding-bottom: .35rem !important;
}
</style>

<body id="product" style="background-color: #000;">
    <div>
        <main class="col-md-10  mt-12" style="margin: auto;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="background-color: #000;border:0px">
                        <div class="row px-3">
                            <?php
                                $sql = "SELECT * FROM product_detail WHERE username = '".$_SESSION["helper_id"]."'";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <div class="col-xl-4" id="game-<?= $row['id'] ?>">
                                <!--begin::Stats Widget 1-->
                                <div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-4.svg)">
                                    <!--begin::Body-->
                                    <div class="col-12" style="text-align:right;position:absolute;padding-right: 1rem;padding-top: 0.5rem;">
                                        <a href="helper/helper_edit_order_information.php?id=<?php echo $row['id']; ?>" class="btn btn-sm">
                                            <img src="icon/draw.png" alt="delete" width="15rem" height="auto">
                                        </a>
                                        <a onclick="deleteProduct(this.name, '<?php echo $row['id']; ?>');" type="button" name="deleteProduct" value="Delete">
                                            <img src="icon/delete.png" alt="delete" width="15rem" height="auto">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5"><?php echo $row['type']; ?></a>
                                        <div class="font-weight-bold text-success mt-9 mb-5">
                                            <?php 
                                                if($row['available']>0){
                                                    echo '<p class="text-success mb-0">Available</p>';
                                                }else{
                                                    echo '<p class="text-danger mb-0">Unvailable</p>';
                                                }
                                            ?>
                                        </div>
                                        <p class="text-dark-75 font-weight-bolder font-size-h5 m-0">
                                            Price(per game): <?php echo $row['price']; ?> 
                                        </p>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Stats Widget 1-->
                            </div>
                            <?php
                                    }
                                }else{
                            ?> 
                                <div class="col-md-12">
                                    <p class="text-center my-4" style="font-size: 35px">No Product</p>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="text-align: center;">
                <button type="button" class="btn btn-default btn-circle btn-xl">
                    <a href="helper/helper_insert_order.php">
                        <i class="fa fa-plus fa-sm"></i>
                    </a>
                </button>
            </div>
        </main>
    </div>
    

</body>
</html>

<script>
function deleteProduct(value, id){
    swal({
            icon: "warning",
            title: "Comfirm Detele",
            text: "Are you sure you want to delete?",
            buttons: true,
            dangerMode: true,
        })
    .then((confirmDelete) => {
            if(confirmDelete){
                //comfirmed delete
                $.ajax({
                    url: 'process/add_product.php',
                    type: 'POST',
                    data: {
                        deleteProduct: value,
                        id: id,
                    },success: function(){
                        var game_card = $('#game-'+ id).remove();
                        console.log(game_card);
                        swal("Deleted Succesfully!", {
                            icon: "success",
                        }).then(function(){
                            $(".container-fluid").load(document.URL + " .container-fluid");
                        });
                    }
                });
            }else{
                // cancel
            }
        }
    );
}
</script>
