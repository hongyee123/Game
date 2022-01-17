<?php
require_once('config/config.php');

$pageTitle = 'report';
$pageName = 'report';

$username = $_SESSION['admin'];

if(isset($_SESSION['admin'])){
    include('layout/admin_in.php');
}
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
}


if(isset($_GET['rid'])){
    $id = $_GET['rid'];
    $sql = "SELECT * FROM report LEFT JOIN order_detail ON report.ord_id = order_detail.id WHERE ord_id ='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $user = $row['ord_user_id'];
    $price = $row['ord_price'];
}

?>

<div class="container mt-4 mb-5">
    <div class="col-12 mt-5 d-flex justify-content-center">
        <h1 class="text-light text-center mb-5">
            Report
        </h1>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                    Report request from : <b><?= $row['ord_user_id']; ?></b>
                    </h3>
                </div>
                <!--begin::Form-->
                <form class="form" id="form" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label class="font-weight-bold">Reporter</label>
                                <input type="text" class="form-control form-control-lg" value="<?= $row['ord_user_id']; ?>" disabled/>
                            </div>
                            <div class="form-group col-6">
                                <label class="font-weight-bold">Person Accused</label>
                                <input type="text" class="form-control form-control-lg" value="<?= $row['ord_helper_id']; ?>" disabled/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label class="font-weight-bold">Order ID</label>
                                <input type="text" class="form-control form-control-lg" value="<?= $row['ord_id']; ?>" disabled/>
                            </div>
                            <div class="form-group col-8">
                                <label class="font-weight-bold">Report Reason</label>
                                <input type="text" class="form-control form-control-lg" value="<?= $row['reason']; ?>" disabled/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">Description</label>
                            <textarea type="text" class="form-control form-control-lg" disabled><?= $row['description']; ?></textarea>
                        </div>
                        <label class="font-weight-bold">Evidence</label>
                        <div class="form-group">
                            <div class="symbol symbol-50 symbol-lg-120">
                                <a href="<?= $row['evidence']; ?>" class="btn btn-light-primary font-weight-bold mr-2" target="_blank">View PDF</a>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-footer">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <button class="btn btn-primary mr-2 btn_approve" name="approve" >Approve</button>
                    <button class="btn btn-danger mr-2 btn_reject" name="reject" >Reject</button>
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

$('.btn_approve').on('click', function() {
    var id = "<?= $id ?>";
    var admin = "<?= $username ?>";
    var user = "<?= $row['ord_user_id'] ?>";
    var price = "<?= $row['ord_price'] ?>";
    var approve ='approve';

    swal({
        icon: "warning",
        title: "Comfirm Approve",
        text: "Do you Comfirm Approve the Report?",
        buttons: true,
        dangerMode: false,
    })
    .then((confirm) => {
        if(confirm){
            //comfirmed delete
            $.ajax({
                url: 'process/report_function.php',
                type: 'POST',
                data: {
                    id : id,
                    admin : admin,
                    user : user,
                    price : price,
                    approve : approve,
                },success: function(data){
                    if(data.status == 0) {
                        swal({
                            icon: "success",
                            title: "Success",
                            text: data.msg,
                            timer: 1100,
                            buttons: false,
                        }).then(function(){
                        window.location.assign('admin_report.php');
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
$('.btn_reject').on('click', function() {
    var id = "<?= $id ?>";
    var admin = "<?= $username ?>";
    var reject ='reject';
    swal({
        icon: "warning",
        title: "Comfirm Reject",
        text: "Do you Comfirm Reject the Report?",
        buttons: true,
        dangerMode: false,
    })
    .then((confirm) => {
        if(confirm){
            //comfirmed delete
            $.ajax({
                url: 'process/report_function.php',
                type: 'POST',
                data: {
                    id : id,
                    admin : admin,
                    reject : reject,
                },success: function(data){
                    if(data.status == 0) {
                        swal({
                            icon: "success",
                            title: "Success",
                            text: data.msg,
                            timer: 1100,
                            buttons: false,
                        }).then(function(){
                        window.location.assign('admin_report.php');
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
</script>
