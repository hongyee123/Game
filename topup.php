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
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta https-equiv="X-UA-Compatible" content="ie=edge">
	<!-- css -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title></title>
</head>
<body>
	<main class="container py-5">
		<div class="row col-12">
            <h1 class="col-12 text-light text-center mb-5">
                Top-up
            </h1>
        </div>
		<div class="jumbotron bg-white shadow">
			<div class="container">
				<div class="h3 text-center mb-5">Amount to Topup</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="input-group mb-3 col-md-4">
						<div class="input-group-prepend">
							<span class="input-group-text border-0 bg-transparent">RM</span>
						</div>
						<input type="number" name="" class="form-control border-dark text-right border-top-0 border-left-0 border-right-0 bg-light rounded-0" step="5" value="0"  id="amount_topup">
					</div>
					<div class="col-md-5 text-center">
						<button class="btn btn-dark rounded-pill amount" data-amount="20">RM 20</button>
						<button class="btn btn-dark rounded-pill amount" data-amount="50">RM 50</button>
						<button class="btn btn-dark rounded-pill amount" data-amount="100">RM 100</button>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col text-center">
						<div id="paypal-button"></div>
					</div>
				</div>
			</div>
		</div>
		
	</main>
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
	<script type="text/javascript">
		var amount_topup = '';
		
		$(".amount").click(function() {
			var amount = $(this).attr('data-amount');
			$('#amount_topup').val(amount+ ".00");
		});

		paypal.Button.render({
	        env: 'sandbox', // Or 'production'

            client: {
                sandbox:    'AWBkHA31N5EeAHZ1OAGGT6R_FUVgR_KcKQo-MOy6AknfMi1VFe1W32ceBcE2P0ECUjoBga4M-xXBm7Uf'
            },

	        commit: true, // Show a 'Pay Now' button
						
            payment: function(data, actions) {
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: $('#amount_topup').val(), currency: 'MYR' }
                                
                            }
                        ]
                    }
                });
            },

            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function(payment) {
                    amount_topup = $('#amount_topup').val();
					$.ajax({
						type: 'POST',
						url: "process/handle_add_amount.php",
						data: {
							amount_topup: JSON.stringify(amount_topup)
						},
						success: function(data) {
							alert(data);
						},
						error: function(XMLhttpsRequest) {
							alert(XMLhttpsRequest.status);
						}
					});
                    window.alert('Payment Complete!');
					window.location.replace("index.php");

	                // The payment is complete!
	                // You can now show a confirmation message to the customer
                });
            }

        }, '#paypal-button');
		
	</script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="assets/js/pages/widgets.js"></script>
</body>
</html>