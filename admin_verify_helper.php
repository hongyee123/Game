<?php
require_once('config/config.php');
require_once('config/bootstrap.php');
require_once('layouts.php');

$pageTitle = 'user';
$pageName = 'verify';

$username = $_SESSION['admin'];

if(isset($_SESSION['admin'])){
    include('layout/admin_in.php');
}
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
}


echo $bootstrapCSS; echo $jQueryJS;echo $jQueryFormJS;echo $sweetAlert; echo $bootstrapJS; echo $fontAwsomeIcons;
?>
<html>
<main style="background-color: #000;">
    <div class="container mt-4">
        <div class="row col-12 mt-5">
            <div class="row col-12">
                <h1 class="col-12 text-light text-center mb-5">
                    Verify Helper
                </h1>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <?php
                    $page_num = @$_GET['page'];
                    if($page_num == 0 || $page_num == 1) {
                        $out_set = 0;
                    } else {
                        $out_set = ($page_num * 5) - 5;
                    }
                    $query = "SELECT user.status AS user_status
							FROM helper left join user on helper.helper_id = user.username WHERE .helper.status = '1'LIMIT $out_set, 5";
                    $result = mysqli_query($conn, $query);
                    if($result) {
                        $sub_total = 0;
                        $total = mysqli_num_rows($result);
                        if($total > 0) {
                            $query ="SELECT user.status AS user_status, 
											user.email AS email,
											user.contact AS contact,
											helper.helper_id AS helper_id,
											helper.name AS name,
											helper.ic AS ic,
											helper.address1 AS address
											FROM helper left join user on helper.helper_id = user.username WHERE .helper.status = '1'LIMIT $out_set, 5";
                            $result = mysqli_query($conn, $query);
                            if($result) {
                                $count = $num_row = mysqli_num_rows($result);
                                if($num_row > 0) {
                                    for($i = 0; $i < $num_row; $i++) {
                                        $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="card card-custom gutter-b" id="helper-<?= $row['helper_id'] ?>">
						<div class="card-body">
							<!--begin::Top-->
							<div class="d-flex">
								<div class="flex-shrink-0 mr-7">
									<div class="symbol symbol-50 symbol-lg-120">
										<img alt="Pic" src="images/<?= $row['ic']?>/photo.png">
									</div>
								</div>
								<!--begin: Info-->
								<div class="flex-grow-1">
									<!--begin::Title-->
									<div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
										<!--begin::User-->
										<div class="mr-3">
											<!--begin::Name-->
											<a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3"><?= $row['helper_id'] ?>
											</a>
											<!--end::Name-->
											<!--begin::Contacts-->
											<div class="d-flex flex-wrap my-2">
												<a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
													<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
														<!--begin::Svg Icon | path:../assets/media/svg/icons/Communication/Mail-notification.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24"></rect>
																<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000"></path>
																<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"></circle>
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
													<?= $row['email'] ?>
												</a>
											</div>
											<div>
												<a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
													<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
														<!--begin::Svg Icon | path:../assets/media/svg/icons/General/Lock.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<mask fill="white">
																	<use xlink:href="#path-1"></use>
																</mask>
																<g></g>
																<path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"></path>
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
													User
												</a>
											</div>
											<!--end::Contacts-->
										</div>
										<!--begin::User-->
										<!--begin::Actions-->
										<div class="my-lg-0 my-1">
											<a href="#" class="btn btn-primary font-weight-bolder text-uppercase btn-hire" data-helper_id="<?= $row['helper_id'] ?>" >Hire</a>
											<a href="#" class="btn btn-danger font-weight-bolder text-uppercase btn-reject" data-helper_id="<?= $row['helper_id'] ?>" >Reject</a>
										</div>
										<!--end::Actions-->
									</div>
									
									<!--end::Title-->
								</div>
								<!--end::Info-->
							</div>
							<!--end::Top-->
							<!--begin::Separator-->
							<div class="separator separator-solid my-7"></div>
							<!--end::Separator-->
							<!--begin::Bottom-->
							<div class="d-flex align-items-center flex-wrap">
								<div class="flex-shrink-0 mr-7">
									<div class="symbol symbol-50 symbol-lg-120" >
										<img alt="Pic" src="images/<?= $row['ic']?>/ic.png" style="max-width: 200px!important;">
									</div>
								</div>
								<div class="flex-grow-1">
									<!--begin::Title-->
									<div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
										<!--begin::User-->
										<div class="mr-3">
											<!--begin::Name-->
											<a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3"><?= $row['name'] ?>
											</a>
											<!--end::Name-->
											<!--begin::Contacts-->
											<div class="d-flex flex-wrap my-2">
												<a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
												<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
													<!--begin::Svg Icon | path:../assets/media/svg/icons/Communication/Mail-notification.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24"></rect>
															<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000"></path>
															<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"></circle>
														</g>
													</svg>
													<!--end::Svg Icon-->
												</span><?= $row['ic'] ?></a>
											</div>
											<div class="d-flex flex-wrap my-2">
											<a href="#" class="text-muted text-hover-primary font-weight-bold">
												<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24"></rect>
															<path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000"></path>
														</g>
													</svg>
												</span><?= $row['address'] ?></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <?php
                    }
                }
            }
        } else {
        ?>
        <div class="card border-0">
            <div class="card-body text-center">
                <div class="text-center">No User Requsest</div>
            </div>
        </div>
        <?php
            }
        }
        ?>
        <nav>
            <div class="justify-content-start"></div>
            <ul class="pagination justify-content-end">
                <?php
                $page = ceil($total / 5);
                for($i = 1;$i <= $page; $i ++){
                ?>
                    <li class="page-item <?= ($page_num == $i || ($i == 1 && $page_num == 0)) ? 'active' : '' ?>"><a class="page-link border-0" href="<?= $_SERVER['PHP_SELF'] .'?page='. $i ?>"><?= $i ?></a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </div>
</main>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-hire').on('click', function() {
            var helper_id = $(this).data('helper_id');
            var url = 'process/admin/admin_verify_function.php';
            $.post({
                url: url,
                data: {
                    helper_id: helper_id,
                },
                success: function (result) {
                    if(result.status == 0) {
                        var card = $('#helper-'+ helper_id).remove();
                        console.log(card);
                        swal({
                            icon: "success",
                            title: "Success",
                            text: result.msg,
                            timer: 1100,
                            buttons: false,
                        });
                        if(result.cart_num == 0)
                            window.location.assign('<?= $_SERVER['PHP_SELF'] ?>');
                    }
					if(result.status == 2) {
                        swal({
                            icon: "warning",
                            title: "Success",
                            text: result.msg,
                            timer: 1100,
                            buttons: false,
                        });
                    }
                }
            });
        });

		$('.btn-reject').on('click', function() {
            var helper_id = $(this).data('helper_id');
            swal({
            icon: "warning",
            title: "Comfirm Reject",
            text: "Are you sure reject?",
            buttons: true,
            dangerMode: false,
            dangerModeText: 'YES',
			})
			.then((confirmDelete) => {
				if(confirmDelete){
					$.ajax({
						url: 'process/admin/admin_reject_function.php',
						type: 'POST',
						data: {
							helper_id : helper_id,
						},success: function(){
							var card = $('#helper-'+ helper_id).remove();
							console.log(card);
							swal("Rejected", {
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
    });
</script>