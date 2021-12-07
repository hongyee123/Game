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


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM notice where notice_id ='$id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $id = $row['notice_id'];
            $title = $row['title'];
            $contant = $row['contant'];
            $status = $row['status'];
            $date = $row['date'];
        }
    }
}
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
                            <input type="text" class="form-control form-control-lg" name="title" value="<?php echo $title; ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Contant</label>
                            <textarea type="text" class="form-control form-control-lg" name="contant"><?php echo $contant; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control form-control-lg" name="date" value="<?php echo $date; ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Show</label>
                            <label class="checkbox">
                                
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" name="status" value="1" <?php if($status == 1){ echo"checked";}?>/>
                                    <span></span>
                                </label>
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <button type="submit" class="btn btn-primary mr-2" name="edit_notice" value="Edit">Submit</button>
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
            text: "Notice updated successfully",
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
<script src="js/blockSpecialChar.js"></script>
</html>