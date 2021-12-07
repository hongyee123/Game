<?php
// show product detail
require_once('config/config.php');
require_once('config/bootstrap.php');
require_once('layouts.php');

if(isset($_GET['pid'])) {
    $id = $_GET['pid'];
} else {
    header('location: index.php');
}

$pageTitle = 'orders';
$pageName = 'start_order';

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

$query = "SELECT * FROM user WHERE username = '$id'";
$result = mysqli_query($conn, $query);

if(!$result) 
    die('Fetch Error!');
else {
    $num_row = mysqli_num_rows($result);
    if($num_row > 0) {
        $product = mysqli_fetch_object($result);
    }
}

?>


<html lang="en">
<head>
    
</head>
<body>
<div class="container">
    <div class="row">
        <div class="row col-12 mt-5">
            <div class="row col-12">
                <h1 class="col-12 text-light text-center mb-5">
                    User Information
                </h1>
            </div>
        </div>
        <div class="row">
            
        </div>
    </div>
</div>

<div class="container">
		<!--begin::Profile Overview-->
		<div class="d-flex flex-row">
			<!--begin::Aside-->
			<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px col-3" id="kt_profile_aside">
				<!--begin::Profile Card-->
				<div class="card card-custom">
					<!--begin::Body-->
					<div class="card-body pt-4">
						<!--begin::User-->
						<div class="d-flex align-items-center">
							<div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
								<div class="symbol-label" style="background-image:url('assets/media/users/user.png')"></div>
								<i class="symbol-badge bg-success"></i>
							</div>
							<div>
								<a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
									<?php 
										$sql = "SELECT * FROM user WHERE username = '$id';";
										$result = mysqli_query($conn, $sql);
										if (mysqli_num_rows($result) == 1) {
											while ($row = mysqli_fetch_assoc($result)) {
												echo $row['username'];
											
									?>
								</a>
								<div class="text-muted">
									User
								</div>
							</div>
						</div>
						<!--end::User-->
						<!--begin::Contact-->
						<div class="py-9">
							<div class="d-flex align-items-center justify-content-between mb-2">
								<span class="font-weight-bold mr-2">Email:</span>
								<a href="#" class="text-muted text-hover-primary"><?php echo $row['email']?></a>
							</div>
							<div class="d-flex align-items-center justify-content-between mb-2">
								<span class="font-weight-bold mr-2">Phone:</span>
								<span class="text-muted"><?php echo $row['contact']?></span>
							</div>
							<div class="d-flex align-items-center justify-content-between">
								<span class="font-weight-bold mr-2">Contact:</span>
								
							</div>
							<div class="d-flex align-items-center mt-3">
								<a href="https://<?php echo $row['facebook']?>" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1 mr-2">Facebook</a>
								<a href="https://wa.me/<?php echo $row['contact']?>?text=I'm%20your%20helper%20from%20Game%20Levelling%20System" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Whatsapp</a>
								
							</div>
							
						</div>
						<!--end::Contact-->
					</div>
					<!--end::Body-->
				</div>
				<!--end::Profile Card-->
			</div>
			<!--end::Aside-->
			<!--begin::Content-->
			<div class="flex-row-fluid col-9">
				<!--begin::Advance Table: Widget 7-->
				<div class="card card-custom gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5 ml-4">
						<h1 class="card-title align-items-start flex-column">
							<span class="card-label font-weight-bolder text-dark"><?php echo $row['username'];?>'s orders</span>
						</h1>
						<div class="card-toolbar">
							<ul class="nav nav-pills nav-pills-sm nav-dark-75">
								<li class="nav-item">
									<a class="nav-link py-2 px-4 active" data-toggle="tab" href="#kt_tab_pane_12_1">Order</a>
								</li>
								<li class="nav-item">
									<a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_12_2">Accepted</a>
								</li>
								<li class="nav-item">
									<a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_12_3">Done</a>
								</li>
							</ul>
						</div>
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body">
						<div class="tab-content mt-2" id="myTabTables12">
							<!--begin::Tap pane-->
							<div class="tab-pane fade show active" id="kt_tab_pane_12_1" role="tabpanel" aria-labelledby="kt_tab_pane_12_1">
								<!--begin::Table-->
								<div class="table-responsive">
									<table class="table table-borderless table-vertical-center">
										<thead>
											<tr>
												<th class="p-0 w-50px"></th>
												<th class="p-0 min-w-120px text-muted">Game Type</th>
												<th class="p-0 min-w-90px text-muted">Price</th>
												<th class="p-0 min-w-90px text-muted">Quantity</th>
												<th class="p-0 min-w-100px text-muted">Status</th>
												<th class="p-0 min-w-160px text-muted"></th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query = "SELECT order_detail.id AS detail_id,
											order_detail.ord_type AS type,
											order_detail.ord_status AS status,
											order_detail.ord_quantity AS quantity,
											order_detail.ord_price AS price,
											orders.ord_user_id AS user
											FROM orders LEFT JOIN order_detail ON orders.id = order_detail.id WHERE ord_helper_id = '$username' AND orders.ord_user_id = '$id' AND order_detail.ord_status = '1'";
			
											$result = mysqli_query($conn, $query);
							
											if(!$result) 
												die('Fetch Error');
											else {
												$num_row = mysqli_num_rows($result);
												if($num_row > 0) {
													for($i = 0; $i < $num_row; $i++) {
														$row = mysqli_fetch_assoc($result);
													
											?>
												<tr id="order-<?= $row['detail_id'] ?>">
												<td>
												<div class="flex-shrink-0 mr-7">
													<div class="symbol symbol-50 symbol-lg-60 symbol-light-danger">
														<span class="font-size-h6 symbol-label font-weight-boldest"><?php echo $row['type'];?></span>
													</div>
												</div>
												</td>
												<td class="text-left">
													<span class="text-muted font-weight-bold"><?php echo $row['type'];?></span>
												</td>
												<td class="text">
													<span class="text-muted font-weight-bold"><?php echo $row['price'];?></span>
												</td>
												<td class="text">
													<span class="text-muted font-weight-bold"><?php echo $row['status'];?></span>
												</td>
												<td>
												<?php
													if($row['status'] == 1){
														?>
															<span class="label label-lg label-light-primary label-inline">
																New Order
															</span>
														<?php
													}elseif($row['status'] == 2){
														?>
															<span class="label label-lg label-light-warning label-inline">
																Accepted
															</span>
														<?php
													}elseif($row['status'] == 3){
														?>
															<span class="label label-lg label-light-secondary label-inline">
																Waiting for user to comfirm
															</span>
														<?php
													}elseif($row['status'] == 4){
														?>
															<span class="label label-lg label-light-primary label-inline">
																Done
															</span>
														<?php
													}elseif($row['status'] == 5){
														?>
															<span class="label label-lg label-light-primary label-inline">
																Cancelled
															</span>
														<?php
													}else{
														?>
															<span class="label label-lg label-light-primary label-inline">
																GG
															</span>
														<?php
													}
													?>
												</td>
												<td>
												<?php
													if($row['status'] == 1){
														?>
															<input class="btn btn-success btn-comfirm" type="button" value="Comfirm" data-detail_id="<?= $row['detail_id'] ?>">
                        									<input class="btn btn-danger btn-cancel" type="button" value="Cancel" data-detail_id="<?= $row['detail_id'] ?>" data-user="<?= $row['user'] ?>">
														<?php
													}
													?>
												</td>
											</tr>
											<?php
													}
												} else {
											?>
												<div class="col-12 text-center">Not have product yet!</div>
											<?php
												}
											}
											?>
											
										</tbody>
									</table>
								</div>
								<!--end::Table-->
							</div>
							<!--end::Tap pane-->
							
							<!--begin::Tap pane-->
							<div class="tab-pane fade" id="kt_tab_pane_12_2" role="tabpanel" aria-labelledby="kt_tab_pane_12_2">
								<!--begin::Table-->
								<div class="table-responsive">
								<table class="table table-borderless table-vertical-center">
										<thead>
											<tr>
												<th class="p-0 w-50px"></th>
												<th class="p-0 min-w-120px text-muted">Game Type</th>
												<th class="p-0 min-w-90px text-muted">Price</th>
												<th class="p-0 min-w-90px text-muted">Quantity</th>
												<th class="p-0 min-w-100px text-muted">Status</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query = "SELECT order_detail.id AS detail_id,
											order_detail.ord_type AS type,
											order_detail.ord_status AS status,
											order_detail.ord_quantity AS quantity,
											order_detail.ord_price AS price,
											orders.ord_user_id AS user
											FROM orders LEFT JOIN order_detail ON orders.id = order_detail.id WHERE ord_helper_id = '$username' AND orders.ord_user_id = '$id' AND order_detail.ord_status = '2'";
			
											$result = mysqli_query($conn, $query);
							
											if(!$result) 
												die('Fetch Error');
											else {
												$num_row = mysqli_num_rows($result);
												if($num_row > 0) {
													for($i = 0; $i < $num_row; $i++) {
														$row = mysqli_fetch_assoc($result);
													
											?>
												<tr id="order-<?= $row['detail_id'] ?>">
												<td>
												<div class="flex-shrink-0 mr-7">
													<div class="symbol symbol-50 symbol-lg-60 symbol-light-danger">
														<span class="font-size-h6 symbol-label font-weight-boldest"><?php echo $row['type'];?></span>
													</div>
												</div>
												</td>
												<td class="text-left">
													<span class="text-muted font-weight-bold"><?php echo $row['type'];?></span>
												</td>
												<td class="text">
													<span class="text-muted font-weight-bold"><?php echo $row['price'];?></span>
												</td>
												<td class="text">
													<span class="text-muted font-weight-bold"><?php echo $row['status'];?></span>
												</td>
												<td>
													<input class="btn btn-success btn-done" type="button" value="Comfirm" data-detail_id="<?= $row['detail_id'] ?>">
												</td>
												<?php
													if($row['status'] == 1){
														?>
															<input class="btn btn-success btn-done" type="button" value="Comfirm" data-detail_id="<?= $row['detail_id'] ?>">
														<?php
													}
													?>
											</tr>
											<?php
													}
												} else {
											?>
												<div class="col-12 text-center">Not have product yet!</div>
											<?php
												}
											}
											?>
											
										</tbody>
									</table>
								</div>
								<!--end::Table-->
							</div>
							<!--end::Tap pane-->
							<!--begin::Tap pane-->
							<div class="tab-pane fade" id="kt_tab_pane_12_3" role="tabpanel" aria-labelledby="kt_tab_pane_12_3">
								<!--begin::Table-->
								<div class="table-responsive">
									<table class="table table-borderless table-vertical-center">
										<thead>
											<tr>
												<th class="p-0 w-50px"></th>
												<th class="p-0 min-w-120px text-muted">Game Type</th>
												<th class="p-0 min-w-120px text-muted">Price</th>
												<th class="p-0 min-w-120px text-muted">Quantity</th>
												<th class="p-0 min-w-160px text-muted">Status</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query = "SELECT order_detail.id AS detail_id,
											order_detail.ord_type AS type,
											order_detail.ord_status AS status,
											order_detail.ord_quantity AS quantity,
											order_detail.ord_price AS price,
											orders.ord_user_id AS user
											FROM orders LEFT JOIN order_detail ON orders.id = order_detail.id WHERE ord_helper_id = '$username' AND orders.ord_user_id = '$id' AND order_detail.ord_status = '3'";
			
											$result = mysqli_query($conn, $query);
							
											if(!$result) 
												die('Fetch Error');
											else {
												$num_row = mysqli_num_rows($result);
												if($num_row > 0) {
													for($i = 0; $i < $num_row; $i++) {
														$row = mysqli_fetch_assoc($result);
													
											?>
										
												<tr>
												<td>
												<div class="flex-shrink-0 mr-7">
													<div class="symbol symbol-50 symbol-lg-60 symbol-light-danger">
														<span class="font-size-h6 symbol-label font-weight-boldest"><?php echo $row['type'];?></span>
													</div>
												</div>
												</td>
												<td class="text-left">
													<span class="text-muted font-weight-bold"><?php echo $row['type'];?></span>
												</td>
												<td class="text">
													<span class="text-muted font-weight-bold"><?php echo $row['price'];?></span>
												</td>
												<td class="text">
													<span class="text-muted font-weight-bold"><?php echo $row['quantity'];?></span>
												</td>
												<td>
												<?php
													if($row['status'] == 3){
														?>
															<span class="label label-lg label-light-secondary label-inline text-dark">
																Waiting for user comfirm
															</span>
														<?php
													}
													if($row['status'] == 4){
														?>
															<span class="label label-lg label-light-success label-inline">
																Done
															</span>
														<?php
													}
													?>
												</td>
											</tr>
											<?php
													}
												} else {
											?>
												<div class="col-12 text-center">Not have product yet!</div>
											<?php
												}
											}
											?>
											
										</tbody>
									</table>
								</div>
								<!--end::Table-->
							</div>
							<!--end::Tap pane-->
						</div>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Advance Table Widget 7-->
			</div>
			<!--end::Content-->
		</div>
		<!--end::Profile Overview-->
	</div>
</body>
</html>
<?php
	}
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$('.btn-comfirm').on('click', function() {
	var detail_id = $(this).data('detail_id');
	$.ajax({
		url: 'process/helper_accept_order_function.php',
		type: 'POST',
		data: {
			detail_id : detail_id,
		},
		success: function(data) {
			var order_card = $('#order-'+ detail_id).remove();
			console.log(order_card);
			swal({
				icon: "success",
				title: "Success",
				text: "Order Accepted",
				timer: 2500,
				buttons: false,
			}).then(function(){
				location.reload();
        })
		},
		error: function(){
			swal({
				icon: "error",
				title: "An error occurred.",
				text: "apa lan" ,
				timer: 2500,
				buttons: false,
		});
		}
	});
});


$('.btn-cancel').on('click', function() {
	var detail_id = $(this).data('detail_id');
	var user = $(this).data('user');
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
				url: 'process/helper_cancel_order_function.php',
				type: 'POST',
				data: {
					detail_id : detail_id,
					user : user,
				},success: function(){
					var order_card = $('#order-'+ detail_id).remove();
					console.log(order_card);
					swal("Deleted Succesfully!", {
						icon: "success",
					}).then(function(){
						$(".container-fluid").load(document.URL + " .container-fluid");
					});
				}
			});
		}else{
			// cancel
		}
	});
});

$('.btn-done').on('click', function() {
        var detail_id = $(this).data('detail_id');
        var user_id = $(this).data('user_id');
        swal({
            icon: "warning",
            title: "Comfirm Done Order",
            text: "Are you sure you had done this order?",
            buttons: true,
            dangerMode: false,
            dangerModeText: 'YES',
        })
        .then((confirmDelete) => {
            if(confirmDelete){
                $.ajax({
                    url: 'process/helper_done_order_function.php',
                    type: 'POST',
                    data: {
                        detail_id : detail_id,
                        user_id : user_id,
                    },success: function(){
                        var order_card = $('#order-'+ detail_id).remove();
                        console.log(order_card);
                        swal("Order Done!", {
                            icon: "success",
                        }).then(function(){
                            $(".container-fluid").load(document.URL + " .container-fluid");
							location.reload();
                        });
                    }
                });
            }else{
                // cancel
            }
        });
    });
</script>