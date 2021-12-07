<?php
include ('config/config.php');
include_once('config/bootstrap.php');

if(isset($_SESSION['username'])){
    include('layout/in.php');
}if(isset($_SESSION['helper_id'])){
    include('layout/helper_in.php');
}else{
	header("Location: index.php");
}

$pageTitle = 'recieve_orders';
$pageName = 'done_order';

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
    <link rel="stylesheet" href="layouts/navBar.css"/>
    <link rel="stylesheet" href="layouts/styles.css"/>
    <style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }
    </style>
<body id="add_product">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <main class="col-md-10">
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <div class="card border-dark px-2 py-2" style="border-radius: 0px;">
                            <form id="form" method="POST">  
                                <div class="row">
                                    <div class="col-md-6">
                                        Product Type
                                        <select class="form-control form-control-sm border-dark"name="type" required>
                                            <option value="Game 1">Game 1</option>
                                            <option value="Game 2">Game 2</option>
                                            <option value="Game 3">Game 3</option>
                                            <option value="Game 4">Game 4</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        Price (per game)
                                        <input class="form-control form-control-sm border-dark" type="text" name="price" required>
                                    </div>
                                    <div class="col-md-6">
                                        Quantity
                                        <input class="form-control form-control-sm border-dark" type="text" name="quantity" required>
                                    </div>
                                    <div class="col-md-6">
                                        Availablility
                                        <input class="form-control form-control-sm border-dark" type="checkbox" name="available" value="1" required>
                                    </div>
                                    <div class="col-md-12">
                                        Description
                                        <textarea class="form-control form-control-sm border-dark" name="description" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="text-right mt-2">
                                    <input type="submit" class="btn btn-sm btn btn-outline-dark" name="add_product" value="Add"/>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
</body>
<script src="../js/blockSpecialChar.js"></script>
<script>
ClassicEditor
    .create( document.querySelector( 'textarea' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
} );

$('#form').ajaxForm( {
    url: 'process/add_product.php',
    type: 'POST',
    success: function(result){
        swal({
            icon: "success",
            title: "Success",
            text: "Product added updated successfully",
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
</html>