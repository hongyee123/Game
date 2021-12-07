<?php
include_once('../config/bootstrap.php');
require_once('../config/config.php');



if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM product_detail where id ='$id' AND username = '".$_SESSION["helper_id"]."'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $id = $row['id'];
            $type = $row['type'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $available = $row['available'];
            $description = $row['description'];
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <?php echo $bootstrapCSS; echo $jQueryJS;echo $jQueryFormJS;echo $sweetAlert; echo $bootstrapJS; echo $fontAwsomeIcons ?>
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
</head>
    <link rel="stylesheet" href="../layout/navBar.css"/>
    <style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }
    </style>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <main class="col-md-8">
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <div class="card border-dark px-2 py-2" style="border-radius: 0px;">
                            <form action="helper_edit_order_information.php" id="form" method="POST">  
                                <div class="row">
                                <div class="col-md-6">
                                        Type
                                        <select class="form-control form-control-sm border-dark" id="type" name="type">
                                            <option value="Game 1">Game 1</option>
                                            <option value="Game 2">Game 2</option>
                                            <option value="Game 3">Game 3</option>
                                            <option value="Game 4">Game 4</option>
                                        </select>
                                        <input type="hidden" id="type_select" value="<?php echo $type ?>">
                                    </div>
                                    <div class="col-md-6">
                                        Price
                                        <input class="form-control form-control-sm border-dark" type="text" name="price" value="<?php echo $price; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        Quantity
                                        <input class="form-control form-control-sm border-dark" type="text" name="quantity" value="<?php echo $quantity; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        Availablility
                                        <input class="form-control form-control-sm border-dark" type="checkbox" id="available" name="available" value="<?php echo $available; ?>">
                                        <input type="hidden" id="available_chkbox" value="<?php echo $available; ?>">
                                    </div>
                                    <div class="col-md-12">
                                        Description
                                        <textarea class="form-control form-control-sm border-dark" name="description" cols="30" rows="10"><?php echo $description; ?></textarea>
                                    </div>
                                </div>

                                <div class="text-right mt-2">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="submit" class="btn btn-sm btn btn-outline-dark" name="edit_product" value="Edit"/>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
<script>
ClassicEditor
    .create( document.querySelector( 'textarea' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
} );

    $(document).ready(function() {
        var available = document.getElementById('available_chkbox').value;
        if(available == '1'){
            $('#available').attr( "checked", true );
        }

        var type = document.getElementById('type_select').value;
        document.getElementById('type').value = type;
    });

$('#form').ajaxForm( {
    url: '../process/add_product.php',
    type: 'POST',
    success: function(result){
        swal({
            icon: "success",
            title: "Success",
            text: "Product updated successfully",
            timer: 1500,
            buttons: false,
        }).then(function(){
            window.location.assign('helper_view_order_information.php');
        })
    },
    error: function(err){
        swal({
            icon: "error",
            title: "An error occurred.",
            text: "Please try again. Error Code:" + err,
            timer: 1500,
            buttons: false,
        });
    } 
});
</script>
<script src="../js/blockSpecialChar.js"></script>
</html>