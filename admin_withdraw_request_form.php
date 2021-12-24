<?php
require_once('config/config.php');

$pageTitle = 'user';
$pageName = 'request';

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

<div class="container mt-4 mb-5">
    <div class="col-12 mt-5 d-flex justify-content-center">
        <h1 class="text-light text-center mb-5">
            WIthdraw Request
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
                <!--begin::Form-->
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
                        <label class="font-weight-bold">Evidence</label>
                        <div class="form-group">
                            <div class="image-input image-input-empty image-input-outline mr-6 mb-2" id="kt_image_1" style="background-image: url(assets/media/svg/icons/Files/Cloud-upload.svg)">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="evidence" accept=".png, .jpg, .jpeg" id="evidence">
                                    <input type="hidden" name="profile_avatar_remove">
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-original-title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-original-title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-footer">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <button class="btn btn-primary mr-2 btn_done" name="done" >Done</button>
                        <button class="btn btn-secondary">Cancel</button>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-7 d-flex justify-content-center"></div>
</div>
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

var evidence = null;

$('#evidence').change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            evidence = e.target.result;
        }

        reader.readAsDataURL(this.files[0]);
    }
});

$('.btn_done').on('click', function() {
    var id = "<?= $id ?>";
    var admin = "<?= $username ?>";
    var done_withdraw = "done_withdraw";
    swal({
        icon: "warning",
        title: "Comfirm Done",
        text: "Do you Comfirm Done Transfer Money?",
        buttons: true,
        dangerMode: false,
    })
    .then((confirm) => {
        if(confirm){
            //comfirmed delete
            $.ajax({
                url: 'process/withdraw_function.php',
                type: 'POST',
                data: {
                    id : id,
                    admin : admin,
                    evidence : evidence,
                    done_withdraw : done_withdraw,
                },success: function(data){
                    if(data.status == 0) {
                        swal({
                            icon: "success",
                            title: "Success",
                            text: data.msg,
                            timer: 1100,
                            buttons: false,
                        }).then(function(){
                        window.location.assign('admin_withdraw_request.php');
                        });
                    } else if(data.status == 2) {
                        swal({
                            icon: "warning",
                            title: "Fail",
                            text: data.msg,
                            timer: 1100,
                            buttons: false,
                        })
                    }
                }
            });
        }else{
            // cancel
        }
    });
});


var avatar1 = new KTImageInput('kt_image_1');
    avatar1.on('cancel', function(imageInput) {
        swal({
            title: 'Evidence Upload Successful',
            type: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Awesome!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    avatar1.on('change', function(imageInput) {
        swal({
            title: 'Evidence Upload Successful',
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
</script>
