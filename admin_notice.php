<?php
require_once('config/config.php');
require_once('layouts.php');

$pageTitle = 'notice';
$pageName = 'notice';

$username = $_SESSION['admin'];

if(isset($_SESSION['admin'])){
    include('layout/admin_in.php');
}
if(!isset($_SESSION['admin'])){
    header("Location: index.php");
}

?>


<style>
.btn-circle.btn-xl {
    width: 70px;
    height: 70px;
    padding: 24px 16px;
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




<div class="container mt-4">
    <div class="col-12 mt-5 d-flex justify-content-center">
        <h1 class="text-light text-center mb-5">
            Notice
        </h1>
    </div>
    <div class="row">
        <?php
        $sql = "SELECT * FROM notice";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
        ?>


        <div class="col-xl-4" id="notice-<?= $row['notice_id'] ?>">
            <!--begin::Stats Widget 1-->
            <div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-4.svg)">
                <!--begin::Body-->
                <div class="col-12" style="text-align:right;position:absolute;padding-right: 1rem;padding-top: 0.5rem;">
                    <a href="admin_edit_notice.php?id=<?php echo $row['notice_id']; ?>" class="btn btn-sm">
                        <img src="icon/draw.png" alt="delete" width="15rem" height="auto">
                    </a>
                    <a onclick="deleteNotice(this.name, '<?php echo $row['notice_id']; ?>');" type="button" name="deleteNotice" value="Delete">
                        <img src="icon/delete.png" alt="delete" width="15rem" height="auto">
                    </a>
                </div>
                <div class="card-body">
                    <a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5"><?php echo $row['title']; ?></a>
                    <p class="text-success mb-0"><?php echo $row['date']; ?> </p>
                    <div class="font-weight-bold text-success mt-9 mb-5">
                        <?php 
                            if($row['status'] == 1){
                                echo '<p class="text-success mb-0">Shown</p>';
                            }else{
                                echo '<p class="text-danger mb-0">Hide</p>';
                            }
                        ?>
                    </div>
                    <p class="text-dark-75 font-weight-bolder font-size-h5 m-0">
                        <?php echo $row['contant']; ?> 
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
            <p class="text-center my-4 text-light" style="font-size: 35px">Add Notice Now !</p>
        </div>
        <?php
        }
        ?>
    </div>
    <div class="col-md-12" style="text-align: center;">
        <button type="button" class="btn btn-default btn-circle btn-xl">
            <a href="admin_add_notice.php">
                <i class="fa fa-plus fa-sm"></i>
            </a>
        </button>
    </div>
</div>


<script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function deleteNotice(value, id){
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
                    url: 'process/notice_functions.php',
                    type: 'POST',
                    data: {
                        deleteNotice: value,
                        id: id,
                    },success: function(){
                        var game_card = $('#notice-'+ id).remove();
                        console.log(game_card);
                        swal("Deleted Succesfully!", {
                            icon: "success",
                        }).then(function(){
                            $(".container-fluid").load(document.URL + " .container-fluid");
                            window.location.assign('admin_notice.php');
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