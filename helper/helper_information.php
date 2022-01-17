<base href="../">
<?php

$pageTitle = 'orders';
$pageName = 'start_order';

require_once('../config/verify.php');

if(isset($_GET['pid'])) {
    $id = $_GET['pid'];
} else {
    header('location: ../index.php');
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
                    Helper Detail Information
                </h1>
            </div>
        </div>
    </div>
	<div class="card card-custom gutter-b">
		<div class="card-body">
			<!--begin::Details-->
			<div class="d-flex mb-9">
				<!--begin: Pic-->
				<div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
					<div class="symbol symbol-50 symbol-lg-120">
						<img src="assets/media/svg/avatars/001-boy.svg" alt="image">
					</div>
					
				</div>
				<!--end::Pic-->
				<!--begin::Info-->
				<div class="flex-grow-1">
					<!--begin::Title-->
					<div class="d-flex justify-content-between flex-wrap mt-1">
						<div class="d-flex mr-3">
							<a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3"><?php 
									$sql = "SELECT * FROM user left join helper ON helper.helper_id = user.username WHERE username = '$id';";
									$result = mysqli_query($conn, $sql);
									if (mysqli_num_rows($result) == 1) {
										while ($row = mysqli_fetch_assoc($result)) {
											echo $row['username'];
										
								?></a>
							<a href="#">
								<i class="flaticon2-correct text-success font-size-h5"></i>
							</a>
						</div>
						<div class="my-lg-0 my-3">
							<?php
							$sql = "SELECT * FROM favourite WHERE favourite_user = '$username'";
							$result = mysqli_query($conn, $sql);
							if (mysqli_num_rows($result) >= 1) {
								$rows = mysqli_fetch_assoc($result);
								?>
									<button id="remove" class="btn btn-sm btn-light-warning font-weight-bolder text-uppercase remove-btn" data-favorite_helper="<?= $rows['favourite_helper'] ?>" >Remove from favorite</button>
									<button id="add" class="btn btn-sm btn-light-danger font-weight-bolder text-uppercase add-btn" data-favorite_helper="<?= $rows['favourite_helper'] ?>" style="display: none;">add to favorite</button>
								<?php
							}else{
								?>
									<button id="remove" class="btn btn-sm btn-light-warning font-weight-bolder text-uppercase remove-btn" data-favorite_helper="<?= $rows['favourite_helper'] ?>" style="display: none;" >Remove from favorite</button>
									<button id="add" class="btn btn-sm btn-light-danger font-weight-bolder text-uppercase add-btn" data-favorite_helper="<?= $rows['favourite_helper'] ?>" >add to favorite</button>
								<?php
									
							}
							?>
							
						</div>
					</div>
					<!--end::Title-->
					<!--begin::Content-->
					<div class="d-flex flex-wrap justify-content-between mt-1">
						<div class="d-flex flex-column flex-grow-1 pr-8">
							<div class="d-flex flex-wrap mb-4">
								<a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
								<i class="flaticon2-new-email mr-2 font-size-lg"></i><?php echo $row['email']?></a>
								<a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
								<i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>Game Levelling Helper</a>
								<a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
								<i class="flaticon2-placeholder mr-2 font-size-lg"></i>Melbourne</a>
							</div>
							<span class="font-weight-bold text-dark-50">I distinguish three main text objectives could be merely to inform people.</span>
							<span class="font-weight-bold text-dark-50">A second could be persuade people.You want people to bay objective</span>
						</div>
						<div class="d-flex align-items-center w-25 flex-fill float-right mt-lg-12 mt-8">
							<span class="font-weight-bold text-dark-75">Rating</span>
							<div class="progress progress-xs mx-3 w-100">

							<?php
							$sql = "SELECT SUM(ord_rate) FROM order_detail WHERE ord_helper_id = '$id'";
							$result = mysqli_query($conn, $sql);
							if (mysqli_num_rows($result) >= 1) {
								$rate = mysqli_fetch_assoc($result);
								$sql = "SELECT ord_rate FROM order_detail WHERE ord_helper_id = '$id' AND ord_rate != '0'";
								$result = mysqli_query($conn, $sql);
									for ($x = 1; $x <= mysqli_num_rows($result); $x++) {
									}
									$result_rate = ((($rate['SUM(ord_rate)'])*20)/($x-1));
								?>

								<?php
								if(($result_rate) < 30){
									?>
									<div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $result_rate;?>%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									<?php
								}elseif($result_rate < 70){
									?>
									<div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $result_rate;?>%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									<?php
								}elseif($result_rate >= 70){
									?>
									<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $result_rate;?>%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									<?php
								}
								?>
							</div>
							<span class="font-weight-bolder text-dark"><?php echo round($result_rate);?>%</span>
							<?php
								}
							?>
						</div>
					</div>
					<!--end::Content-->
				</div>
				<!--end::Info-->
			</div>
			<!--end::Details-->
			<div class="separator separator-solid"></div>
			<!--begin::Items-->
			<div class="d-flex align-items-center flex-wrap mt-8">
				<!--begin::Item-->
				<div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
					<span class="mr-4">
						<i class="flaticon-piggy-bank display-4 text-muted font-weight-bold"></i>
					</span>
					<div class="d-flex flex-column text-dark-75">
						<span class="font-weight-bolder font-size-sm">Earnings</span>
						<span class="font-weight-bolder font-size-h5">
						<span class="text-dark-50 font-weight-bold">$</span>249,500</span>
					</div>
				</div>
				<!--end::Item-->
				<!--begin::Item-->
				<div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
					<span class="mr-4">
						<i class="flaticon-confetti display-4 text-muted font-weight-bold"></i>
					</span>
					<div class="d-flex flex-column text-dark-75">
						<span class="font-weight-bolder font-size-sm">Expenses</span>
						<span class="font-weight-bolder font-size-h5">
						<span class="text-dark-50 font-weight-bold">$</span>164,700</span>
					</div>
				</div>
				<!--end::Item-->
				<!--begin::Item-->
				<div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
					<span class="mr-4">
						<i class="flaticon-pie-chart display-4 text-muted font-weight-bold"></i>
					</span>
					<div class="d-flex flex-column text-dark-75">
						<span class="font-weight-bolder font-size-sm">Net</span>
						<span class="font-weight-bolder font-size-h5">
						<span class="text-dark-50 font-weight-bold">$</span>782,300</span>
					</div>
				</div>
				<!--end::Item-->
				<!--begin::Item-->
				<div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
					<span class="mr-4">
						<i class="flaticon-file-2 display-4 text-muted font-weight-bold"></i>
					</span>
					<div class="d-flex flex-column flex-lg-fill">
						<span class="text-dark-75 font-weight-bolder font-size-sm">73 Tasks</span>
						<a href="#" class="text-primary font-weight-bolder">View</a>
					</div>
				</div>
				<!--end::Item-->
				<!--begin::Item-->
				<div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
					<span class="mr-4">
						<i class="flaticon-chat-1 display-4 text-muted font-weight-bold"></i>
					</span>
					<div class="d-flex flex-column">
						<span class="text-dark-75 font-weight-bolder font-size-sm">648 Comments</span>
						<a href="#" class="text-primary font-weight-bolder">View</a>
					</div>
				</div>
				<!--end::Item-->
			</div>
			<!--begin::Items-->
		</div>
	</div>
	<div class="row">
        <div class="row col-12 mt-5">
            <div class="row col-12">
                <h2 class="col-12 text-light mb-3">
                    Product
                </h2>
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-12">
            <div class="row">
                <?php
                
                $query = "SELECT id, username, type, price FROM product_detail WHERE username = '$id'";

                $result = mysqli_query($conn, $query);

                if(!$result) 
                    die('Fetch Error');
                else {
                    $num_row = mysqli_num_rows($result);
                    
                    if($num_row > 0) {
                        for($i = 0; $i < $num_row; $i++) {
                            $row = mysqli_fetch_assoc($result);
                ?>
                <div class="mb-4 col-6">
					<div class="card card-custom wave wave-animate wave-primary mb-4 mb-lg-0 ">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div class="d-flex flex-column">
									<a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h2 mb-3"><?= $row['type']; ?></a>
									<a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h6"><?= $row['username']; ?></a>
									<a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h6 mb-3">RM<?= number_format(floatval($row['price']), 2) ?><small> per game</small></a>
									<div class="col-12">
										<a href="detail.php?pid=<?= $row['id']; ?>" class="btn btn-primary mt-3">View</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                <?php
                        }
                    }else{
                ?>
                <div class="col-12 text-center">This player haven't insert order</div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
	<?php
		}
	}
	?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	 $(document).ready(function() {
        $('.add-btn').on('click', function() {
			var favourite_user = <?php echo json_encode($username); ?>;
            var favourite_helper = <?php echo json_encode($id); ?>;
            var url = 'process/remove_favourite.php';
            $.post({
                url: url,
                data: {
					favourite_user: favourite_user,
                    favourite_helper: favourite_helper,
					add:true,
                },
                success: function (result) {
					if(result.status == 0) {
						$('#add').toggle();
						$('#remove').toggle();
						swal({
							icon: "success",
							title: "Success",
							text: result.msg,
							timer: 1100,
							buttons: false,
						})
					}
                }
            });
        });
    });


    $(document).ready(function() {
        $('.remove-btn').on('click', function() {
			var favourite_user = <?php echo json_encode($username); ?>;
            var favourite_helper = <?php echo json_encode($id); ?>;
            var url = 'process/remove_favourite.php';
            $.post({
                url: url,
                data: {
					favourite_user: favourite_user,
                    favourite_helper: favourite_helper,
					remove:true,
                },
                success: function (result) {
					if(result.status == 0) {
						$('#remove').toggle();
						$('#add').toggle();
						swal({
							icon: "success",
							title: "Success",
							text: result.msg,
							timer: 1100,
							buttons: false,
						})
					}
                }
            });
        });
    });
</script>