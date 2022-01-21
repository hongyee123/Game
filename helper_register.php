<?php 
require_once('config/config.php');

$pageTitle = 'join';
$pageName = 'join_us';

if(empty($_SESSION['username'])) {
    header("Location: index.php");
}if(isset($_SESSION['username'])){
    include('layout/in.php');
}if(isset($_SESSION['helper'])){
    include('layout/helper_in.php');
}

$helper_id = ($_SESSION['username']);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Levelling Helper System</title>
</head>
<body style="background-color:black">
    <div>
	<img src="background/back2.jpg" style="width: 100%;position: absolute;z-index: -999;">
	</div>
    <main class="container" >
        <div class="row col-12 mt-5">
            <div class="row col-12">
                <h1 class="col-12 text-light text-center mb-5">
                    Join Us <span class="text-danger">Now</span>
                </h1>
            </div>
        </div>
        <?php
        $query = "SELECT * from helper WHERE helper_id ='$helper_id'";
        $result = mysqli_query($conn, $query);
        if(!$result) 
                    die('Fetch Error');
                else {
                    $num_row = mysqli_num_rows($result);
                    if($num_row > 0) {
                        for($i = 0; $i < $num_row; $i++) {
                            $row = mysqli_fetch_assoc($result);
                            if($row['status'] == 1){
                                ?>
                                <div class="row">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-8">
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3 class="card-label">
                                                        Request Send Successful
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                Please wait for 2-3 Working days for the verification. Thankyou!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }elseif($row['status'] == 2){
                                ?>
                                <div class="row">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-8">
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3 class="card-label">
                                                        Verify Successful !!!
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                Please relogin
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }elseif($row['status'] == 3){
                                ?>
                                <div class="row">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-8">
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3 class="card-label">
                                                        Verify Rejected
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                Reason:
                                                Try again next time
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }else{
                        ?>
                        <div class="login-box">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-8">
                                        <div class="form-group">
                                            <label class="text-light font-weight-bold">Name on IC</label>
                                            <input type="text" class="form-control form-control-solid form-control-lg" placeholder="Name" id="name" required>
                                        </div>



                                        
                                        <label class="text-light font-weight-bold">Photo & IC Photo</label>
                                        <div class="form-group">
                                            <div class="image-input image-input-empty image-input-outline mr-6 mb-2" id="kt_image_1" style="background-image: url(assets/media/users/blank.png)">
                                                <div class="image-input-wrapper"></div>
                                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="photo" accept=".png, .jpg, .jpeg" id="photo">
                                                    <input type="hidden" name="profile_avatar_remove">
                                                </label>
                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-original-title="Cancel avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-original-title="Remove avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                            <div class="image-input image-input-empty image-input-outline mb-2" id="kt_image_2" style="background-image: url(images/ic/ic.jpeg)">
                                                <div class="image-input-wrapper" style="width: 15rem;"></div>
                                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="ic_pic" accept=".png, .jpg, .jpeg" id="ic_pic">
                                                    <input type="hidden" name="profile_avatar_remove">
                                                </label>
                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-original-title="Cancel avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-original-title="Remove avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                            <span class="form-text text-white">Personal Photo</span>
                                        </div>
                                        





                                        <div class="form-group">
                                            <label class="text-light font-weight-bold">IC/Passport</label>
                                            <input type="text" class="form-control form-control-solid form-control-lg" placeholder="IC" id="ic" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-light font-weight-bold">Address 1</label>
                                            <input type="text" class="form-control form-control-solid form-control-lg" placeholder="Address" id="address1" required>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label class="text-light font-weight-bold">Address 2</label>
                                            <input type="text" class="form-control form-control-solid form-control-lg" placeholder="Address" id="address2" required>
                                        </div> -->
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label class="text-light font-weight-bold">Postcode</label>
                                                <input type="text" class="form-control form-control-solid form-control-lg" placeholder="Postcode" id="postcode" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="text-light font-weight-bold">State</label>
                                                <input type="text" class="form-control form-control-solid form-control-lg" placeholder="State" id="state" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label class="text-light font-weight-bold">Bank Name</label>
                                                <select class="form-control form-control-lg" id="bank_name">
                                                    <option disabled selected value="">Bank Name</option>
                                                    <option value="Maybank">Maybank</option>
                                                    <option value="RHB">RHB</option>
                                                    <option value="CIMB">CIMB</option>
                                                    <option value="Alliance">Alliance</option>
                                                    <option value="Hong Leong">Hong Leong</option>
                                                    <option value="AmBank">AmBank</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="text-light font-weight-bold">Bank Account</label>
                                                <input type="text" class="form-control form-control-solid form-control-lg" placeholder="Bank Account" id="bank_account" required>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="checkbox-inline mt-4">
                                                <label class="checkbox checkbox-lg checkbox-danger">
                                                        <input type="checkbox" name="box1" id="box1" value="1" checked/>
                                                        <span></span>
                                                    <label class="text-light font-weight-bold">Rm 100 for Deposit</label>
                                                </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label class="checkbox checkbox-lg checkbox-danger">
                                                        <input type="checkbox" name="box2" id="box2" value="2" checked/>
                                                        <span></span>
                                                    <label class="text-light font-weight-bold">I have read and agree / agreed with the terms and conditions</label>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3"></div>
                                </div>
                            </div>
                            <!--begin::Actions-->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-8">
                                        <button class="btn btn-danger font-weight-bold mr-2 btn_submit">Submit</button>
                                        <a class="btn btn-light font-weight-bold" href="index.php">Cancel</a>
                                    </div>
                                    <div class="col-xl-3"></div>
                                </div>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <?php
                    }
                }
        ?>
    </main>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

var photo = null;
var ic_pic = null;

$('#photo').change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            photo = e.target.result;
        }

        reader.readAsDataURL(this.files[0]);
    }
});

$('#ic_pic').change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            ic_pic = e.target.result;
        }

        reader.readAsDataURL(this.files[0]);
    }
});



$(document).ready(function() {
    $('.btn_submit').on('click', function() {
        var name = document.getElementById("name").value;
        var ic = document.getElementById("ic").value;
        var address1 = document.getElementById("address1").value;
        var postcode = document.getElementById("postcode").value;
        var state = document.getElementById("state").value;
        var bank_name = document.getElementById("bank_name").value;
        var bank_account = document.getElementById("bank_account").value;
        var url = 'process/helper_register_function.php';

        var box1_bool = $('#box1:checked').length == 1;
        var box2_bool = $('#box2:checked').length == 1;
        console.log(box1_bool && box2_bool);

        var box1_bool = $('#box1:checked').length == 1;
        var box2_bool = $('#box2:checked').length == 1;

        if(box1_bool && box2_bool){
            $.post({
            url: url,
            data: {
                ic: ic,
                name: name,
                address1: address1,
                // address2: address2,
                postcode: postcode,
                state: state,
                bank_name: bank_name,
                bank_account: bank_account,
                photo: photo,
                ic_pic: ic_pic,
            },
            success: function (result) {
                if(result.status == 0) {
                    swal({
                        icon: "success",
                        title: "Success",
                        text: result.msg,
                        timer: 1100,
                        buttons: false,
                    }).then(function(){
                    window.location.assign('helper_register.php');
                });
                }
                if(result.status == 2) {
                    swal({
                        icon: "warning",
                        text: result.msg,
                        timer: 1100,
                        buttons: false,
                    });
                }
                if(result.status == 3) {
                    swal({
                        icon: "error",
                        title: "An error occurred.",
                        text: "Credits no enough - Please Top-up " ,
                        timer: 2500,
                        buttons: false,
                    });
                }
            }
                
        });
        }else if(box1_bool){
            swal({
                icon: "warning",
                title: "Warning",
                text: 'Please read the term and condition',
                timer: 1100,
                buttons: false,
            });
        }else if(box2_bool){
            swal({
                icon: "warning",
                title: "Warning",
                text: 'You have to pay 100 as deposit',
                timer: 2500,
                buttons: false,
            });
        }else{
            swal({
                icon: "warning",
                title: "Warning",
                text: 'You have to pay 100 as deposit',
                timer: 2500,
                buttons: false,
            });
        }
    });
});


var avatar1 = new KTImageInput('kt_image_1');
avatar1.on('cancel', function(imageInput) {
    swal({
        title: 'Image successfully changed !',
        type: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Awesome!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

avatar1.on('change', function(imageInput) {
    swal({
        title: 'Image successfully changed !',
        type: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Awesome!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

avatar1.on('remove', function(imageInput) {
    swal({
        title: 'Image successfully removed !',
        type: 'error',
        buttonsStyling: false,
        confirmButtonText: 'Got it!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});



var avatar2 = new KTImageInput('kt_image_2');
avatar2.on('cancel', function(imageInput) {
    swal({
        title: 'Image successfully changed !',
        type: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Awesome!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

avatar2.on('change', function(imageInput) {
    swal({
        title: 'Image successfully changed !',
        type: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Awesome!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

avatar2.on('remove', function(imageInput) {
    swal({
        title: 'Image successfully removed !',
        type: 'error',
        buttonsStyling: false,
        confirmButtonText: 'Got it!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});


    

</script>