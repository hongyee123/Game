<?php
require_once('config/config.php');

$pageTitle = 'help';
$pageName = 'report';

if(!isset($_SESSION['username']) && !isset($_SESSION['helper_id'])){
    header("Location: index.php");
}
if(isset($_SESSION['username'])){
    include('layout/in.php');
    $username = $_SESSION['username'];
}if(isset($_SESSION['helper_id'])){
    include('layout/helper_in.php');
    $username = $_SESSION['helper_id'];
}

if(isset($_GET['pid'])) {
    $id = $_GET['pid'];
} else {
    header('location: index.php');
}

$query = "  SELECT * FROM order_detail WHERE ord_user_id = '$username' AND order_detail.id = '$id'";
$result = mysqli_query($conn, $query);
if($result){
    if(mysqli_num_rows ($result)>0){
    $row = mysqli_fetch_assoc($result);

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
                    Order ID : <?= $row['id'] ?>
                    </h3>
                </div>
                <!--begin::Form-->
                <div class="card-body">
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">Game Type</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">Price</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">Quantity</th>
                                        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="font-weight-boldest">
                                        <td class="pl-0 pt-7"><?= $row['ord_type'] ?></td>
                                        <td class="text-right pt-7">RM<?= $row['ord_price'] ?></td>
                                        <td class="text-right pt-7"><?= $row['ord_quantity'] ?></td>
                                        <td class="text-danger pr-0 pt-7 text-right">RM<?= $row['ord_quantity']*$row['ord_price'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Reason</label>
                        <select class="form-control  form-control-lg" id="select">
                            <option disabled selected selected value="">Please Select a Reason</option>
                            <option value="Undone">Undone</option>
                            <option value="Rank Drop">Rank Drop</option>
                            <option value="Item / Credit of game account missing">Item / Credit of game account missing</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Contant</label>
                        <textarea type="text" class="form-control form-control-lg"  placeholder="Contant" name="description" id="description"></textarea>
                    </div>
                    <label>Evidence (Please Upload Your Evidence in PDF format)</label>
                    <div class="form-group">
                        <input type="file" name="file" id="file" require/>
                    </div>
                </div>
                <input type="text" value="<?php echo $id ?>" id="id" hidden>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2 btn-report" name="report" value="Report">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-7 d-flex justify-content-center"></div>
</div>
<?php
    }else{
        echo "ERROR1";
    }
}else{
    echo "ERROR2";
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
file='';


$('#file').change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            file = e.target.result;
        }

        reader.readAsDataURL(this.files[0]);
    }
});


$(document).ready(function() {
    $('.btn-report').on('click', function() {
        var id = document.getElementById("id").value;
        var helper_id = $(this).data('helper_id');
        var select = document.getElementById("select").value;
        var description = document.getElementById("description").value;
        var url = 'process/make_report.php';
        $.post({
            url: url,
            data: {
                id : id,
                select :select,
                description :description,
                file : file,

            },
            success: function (result) {
                if(result.status == 0) {
                    swal({
                        icon: "success",
                        title: "Success",
                        text: result.msg,
                        timer: 2500,
                        buttons: false,
                    });
                    if(result.cart_num == 0)
                        window.location.assign('<?= $_SERVER['PHP_SELF'] ?>');
                }
                if(result.status == 2) {
                    swal({
                        icon: "warning",
                        title: "Fail",
                        text: result.msg,
                        timer: 2500,
                        buttons: false,
                    });
                }
            }
        });
    });
});
</script>
