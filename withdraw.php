<?php
require_once('config/config.php');

$pageTitle = 'credits';
$pageName = 'topup';

if(isset($_SESSION['username'])){
    include('layout/in.php');
}if(isset($_SESSION['helper_id'])){
    include('layout/helper_in.php');
}
?>

<!DOCTYPE html>
<html>

<body>
	<main class="container py-5">
		<div class="row col-12">
            <h1 class="col-12 text-light text-center mb-5">
                Withdraw
            </h1>
        </div>
		<div class="jumbotron bg-white shadow col-12">
            <div class="col-8 m-auto">
                <div class="container">
                    <div class="h3 text-center">Amount to Withdraw</div>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-lg font-size-h2 text-right font-weight-bold amount_withdraw" value="0" step="5"  id="amount_withdraw" name="amount_withdraw" min="0"/>
                        </div>
                    <div class="row">
                        <div class="col-4 py-3 mr-0 mt-0">
                            <button class="btn btn-outline-dark font-weight-bold font-size-h2 col-12 py-4 amount" data-amount="5">5</button>
                        </div>
                        <div class="col-4 py-3">
                            <button class="btn btn-outline-dark font-weight-bold font-size-h2 col-12 py-4 amount" data-amount="10">10</button>
                        </div>
                        <div class="col-4 py-3">
                            <button class="btn btn-outline-dark font-weight-bold font-size-h2 col-12 py-4 amount" data-amount="20">20</button>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-sm-4 py-3">
                            <button class="btn btn-outline-dark font-weight-bold font-size-h2 col-12 py-4  amount" data-amount="50">50</button>
                        </div>
                        <div class="col-sm-4 py-3">
                            <button class="btn btn-outline-dark font-weight-bold font-size-h2 col-12 py-4 amount" data-amount="80">80</button>
                        </div>
                        <div class="col-sm-4 py-3">
                            <button class="btn btn-outline-dark font-weight-bold font-size-h2 col-sm-12 py-4 amount" data-amount="100">100</button>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-5 py-3 m-auto">
                            <button type="button" class="btn btn-primary font-weight-bold font-size-h3 col-12 rounded-pill btn_withdraw">Withdraw</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $(".amount").click(function() {
            var amount = $(this).attr('data-amount');
            $('#amount_withdraw').val(amount);
        });

        $('.btn_withdraw').on('click', function() {
            var amount_withdraw = $('#amount_withdraw').val();
            $.ajax({
                url: 'process/withdraw_function.php',
                type: 'POST',
                data: {
                    'username' : '<?php echo $username; ?>',
                    amount_withdraw : amount_withdraw,
                },
                success: function(data) {
                    if(data.status == 0) {
                        swal({
                            icon: "success",
                            title: "Success",
                            text: data.msg,
                            timer: 1100,
                            buttons: false,
                        }).then(function(){
                        window.location.assign('withdraw.php');
                        });
                    }
                    if(data.status == 2) {
                        swal({
                            icon: "warning",
                            title: "Withdraw Fail",
                            text: data.msg,
                            timer: 2500,
                            buttons: false,
                        }).then(function(){
                        window.location.assign('withdraw.php');
                        });
                    }
                }
            });
        });
    })


</script>
</body>
</html>