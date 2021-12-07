<?php
require_once('config/config.php');
require_once('config/bootstrap.php');
require_once('layouts.php');

$pageTitle = 'notice';
$pageName = 'notice';

$username = $_SESSION['admin'];

if(isset($_SESSION['admin'])){
    include('layout/admin_in.php');
}
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
}
echo $bootstrapCSS; echo $jQueryJS;echo $jQueryFormJS;echo $sweetAlert; echo $bootstrapJS; echo $fontAwsomeIcons;

?>


<div class="container mt-4 mb-5">
    <div class="col-12 mt-5 d-flex justify-content-center">
        <h1 class="text-light text-center mb-5">
            Notice
        </h1>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                    New Notice
                    </h3>
                </div>
                <!--begin::Form-->
                <form class="form" id="form" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control form-control-lg"  placeholder="Title" name="title"/>
                        </div>
                        <div class="form-group">
                            <label>Contant</label>
                            <textarea type="text" class="form-control form-control-lg"  placeholder="Contant" name="contant"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control form-control-lg"  placeholder="Date" name="date"/>
                        </div>
                        <div class="form-group">
                            <label>Show</label>
                            <label class="checkbox">
                                <input type="checkbox" name="show" value="1" checked/>
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" name="box1" id="box1" value="1" checked/>
                                    <span></span>
                                </label>
                            </label>
                        </div>


                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2" name="add_notice" value="Add">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 mt-7 d-flex justify-content-center"></div>
</div>
    

<script>
$('#form').ajaxForm( {
    url: 'process/notice_functions.php',
    type: 'POST',
    success: function(result){
        swal({
            icon: "success",
            title: "Success",
            text: "Product added updated successfully",
            timer: 1500,
            buttons: false,
        }).then(function(){
            window.location.assign('admin_notice.php');
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