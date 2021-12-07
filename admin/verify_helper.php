<?php
include '../config/config.php';
echo $bootstrapCSS; echo $jQueryJS;echo $jQueryFormJS;echo $sweetAlert; echo $bootstrapJS; echo $fontAwsomeIcons;
?>
	<meta charset="utf-8">
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="canonical" href="https://keenthemes.com/metronic">
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="../assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css">
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="../assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css">
    <link href="../assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style.bundle.css" rel="stylesheet" type="text/css">
    
    <link rel="shortcut icon" href="../assets/media/logos/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- css -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/586e3dfa1f.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../assets/media/logos/favicon.ico">
	<title>Levelling Helper System</title>
	<body id="product" style="background-color: #000;">
		<div>
		<div class="container">
			<?php

			$page_num = @$_GET['page'];
				if($page_num == 0 || $page_num == 1) {
					$out_set = 0;
				} else {
					$out_set = ($page_num * 5) - 5;
				}
			
			$sql = "SELECT * FROM helper left join user on helper.helper_id = user.username WHERE helper.status = '1'";
			$result = mysqli_query($conn, $sql);
			if($result) {
				$total = mysqli_num_rows($result);
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
									<div class="symbol symbol-50 symbol-lg-120 symbol-light-danger">
										<span class="font-size-h3 symbol-label font-weight-boldest">Helper</span>
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
												</span><?= $row['email'] ?></a>
											</div>
											<!--end::Contacts-->
										</div>
										<!--begin::User-->
										<!--begin::Actions-->
										<div class="my-lg-0 my-1">
											<a href="#" class="btn btn-sm btn-primary font-weight-bolder text-uppercase">Hire</a>
											<a href="#" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">Ask</a>
										</div>
										<!--end::Actions-->
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
										</span>User</a>
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
									<div class="symbol symbol-50 symbol-lg-120 symbol-light-primary">
										<span class="font-size-h3 symbol-label font-weight-boldest" style="height:120px;width:240px;">IC</span>
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
		
			?>
			<nav>
            <div class="justify-content-start"></div>
            <ul class="pagination justify-content-end">
                <?php
                $page = ceil($total / 5);
                for($i = 1;$i <= $page; $i ++){
                ?>
                    <li class="page-item <?= ($page_num == 1 || ($page_num == 0)) ? 'active' : '' ?>"><a class="page-link border-0" href="<?= $_SERVER['PHP_SELF'] .'?page='. $i ?>"><?= $i ?></a></li>
                <?php
                }
                ?>
            </ul>
        </nav>  
		<div>
	</div> 
</body>