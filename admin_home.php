<?php
require_once('config/config.php');
require_once('layouts.php');

$pageTitle = 'home';
$pageName = 'main';

$username = $_SESSION['admin'];

if(isset($_SESSION['admin'])){
    include('layout/admin_in.php');
}
if(!isset($_SESSION['admin'])){
    header("Location: index.php");
}
?>
<html>

<style>
    
	.b-skills{
		border-top: 1px solid #f9f9f9;
		text-align: center;
	}
	
	.b-skills:last-child { margin-bottom: -30px; }
	
	.b-skills h2 { margin-bottom: 50px; font-weight: 900; text-transform: uppercase;}
	
	.skill-item{
		position: relative;
		max-width: 150px;
		width: 100%;
		margin-bottom: 6rem;
		color: #555;
	}
	
	.chart-container{
		position: relative;
		width: 100%;
		height: 0;
		padding-top: 100%;
		margin-bottom: 27px;
	}
	
	.skill-item .chart,
	.skill-item .chart canvas{
		position: absolute;
		top: 0;
		left: 0;
		width: 100% !important;
		height: 100% !important;
	}
	
	.skill-item .chart:before{
		content: "";
		width: 0;
		height: 100%;
	}
	
	.skill-item .chart:before,
	.skill-item .percent{
		display: inline-block;
		vertical-align: middle;
	}
	
	.skill-item .percent{
		position: relative;
		line-height: 1;
		font-size: 40px;
		font-weight: 900;
		z-index: 2;
	}
	
	.skill-item  .percent:after{
		content: attr(data-after);
		font-size: 20px;
	}

	p{
		font-weight: 900;
	}
	
		
</style>
	
<main style="background-color: #000;">
    <div class="container mt-4">
        <div class="row col-12 mt-5">
            <div class="row col-12">
                <h1 class="col-12 text-light text-center mb-5">
                    Dashboard
                </h1>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-12">
				<!--begin::Mixed Widget 16-->
				<div class="card card-custom card-stretch gutter-b px-3">
					<!--begin::Header-->
					<div class="card-header border-0 pt-4">
						<div class="card-title">
							<div class="card-label">
								<div class="font-weight-bolder">Sales Stats</div>
								<?php
								$sql="select count('id') from order_detail";
								$result=mysqli_query($conn,$sql);
								$row=mysqli_fetch_array($result);
								
								?>
								<div class="font-size-sm text-muted mt-2"><?php echo "$row[0]";?></div>
							</div>
						</div>
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<?php
					$sql="SELECT * FROM target WHERE id = '1'";
					$result=mysqli_query($conn,$sql);
					$target = mysqli_fetch_assoc($result);
					if($result){
					?>
					<div class="card-body d-flex flex-column">
						<!--begin::Chart-->
						<div class="flex-grow-1">
						<section id="s-team" class="section">
							<div class="b-skills">
								<div class="container">
									<div class="row">
										<div class="col-3 ">
											<div class="skill-item center-block mx-auto">
												<div class="chart-container">
													<?php
													foreach($conn->query('SELECT SUM(amount) FROM transaction_history WHERE status = 1') as $row) {
														$percent_topup  = $row['SUM(amount)']/$target['user_topup']*100;
													?>
													<div class="chart" data-percent="<?php echo $percent_topup?>" data-bar-color="#a97ffd">
														<span class="percent" data-after="%"><?php echo $percent_topup?></span>
													</div>
													<?php
													}
													?>
												</div>
												<p>Top-up</p>
											</div>
										</div>
										<div class="col-3 ">
											<div class="skill-item center-block mx-auto">
												<div class="chart-container">
													<?php
													foreach($conn->query('SELECT SUM(amount) FROM transaction_history WHERE status = 2') as $row) {
														$profit = $row['SUM(amount)']/100*20;
														$percent_profit  = $profit/$target['profit']*100;
													?>
													<div class="chart" data-percent="<?php echo $percent_profit?>" data-bar-color="#f64e60">
														<span class="percent" data-after="%"><?php echo $percent_profit?></span>
													</div>
													<?php
													}
													?>
												</div>
												<p>Top-up</p>
											</div>
										</div>
										<div class="col-3 ">
											<div class="skill-item center-block mx-auto">
												<div class="chart-container">
													<?php
													foreach($conn->query('SELECT SUM(amount) FROM transaction_history WHERE status = 3') as $row) {
														$percent_helper_earn  = $row['SUM(amount)']/$target['helper_earn']*100;
													?>
													<div class="chart" data-percent="<?php echo $percent_helper_earn?>" data-bar-color="#51d4ce">
														<span class="percent" data-after="%"><?php echo $percent_helper_earn?></span>
													</div>
													<?php
													}
													?>
												</div>
												<p>Helper Earn</p>
											</div>
										</div>
										<div class="col-3 ">
											<div class="skill-item center-block mx-auto">
												<div class="chart-container">
													<?php
													foreach($conn->query('SELECT SUM(amount) FROM transaction_history WHERE status = 2') as $row) {
														$all_time_sales  = $row['SUM(amount)']/$target['all_time_sales']*100;
													?>
													<div class="chart" data-percent="<?php echo $all_time_sales?>" data-bar-color="#aed6ff">
														<span class="percent" data-after="%"><?php echo $all_time_sales?></span>
													</div>
													<?php
													}
													?>
												</div>
												<p>All Time Sales</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
						</div>

						<?php
						}
						?>
						<!--end::Chart-->
						<!--begin::Items-->
						<div class="mt-10 mb-5">
							<div class="row row-paddingless mb-10">
								<!--begin::Item-->
								<div class="col">
									<div class="d-flex align-items-center mr-2">
										<!--begin::Symbol-->
										<div class="symbol symbol-45 symbol-light-info mr-4 flex-shrink-0">
											<div class="symbol-label">
												<span class="svg-icon svg-icon-lg svg-icon-info">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
															<path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000" />
														</g>
													</svg>
													<!--end::Svg Icon-->
												</span>
											</div>
										</div>
										<!--end::Symbol-->
										<!--begin::Title-->
										<div>
											<?php
											foreach($conn->query('SELECT SUM(amount) FROM transaction_history WHERE status = 1') as $row) {
												
												?>
												<div class="font-size-h4 text-dark-75 font-weight-bolder">$ <?php echo $row['SUM(amount)']; ?></div>
												<?php
												}
											?>
											
											<div class="font-size-sm text-muted font-weight-bold mt-1">Total User top-up Amount</div>
										</div>
										<!--end::Title-->
									</div>
								</div>
								<!--end::Item-->
								<!--begin::Item-->
								<div class="col">
									<div class="d-flex align-items-center mr-2">
										<!--begin::Symbol-->
										<div class="symbol symbol-45 symbol-light-danger mr-4 flex-shrink-0">
											<div class="symbol-label">
												<span class="svg-icon svg-icon-lg svg-icon-danger">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
															<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
														</g>
													</svg>
													<!--end::Svg Icon-->
												</span>
											</div>
										</div>
										<!--end::Symbol-->
										<!--begin::Title-->
										<div>
											<?php
											foreach($conn->query('SELECT SUM(amount) FROM transaction_history WHERE status = 2') as $row) {
												$profit = $row['SUM(amount)']/100*20;
												?>
												<div class="font-size-h4 text-dark-75 font-weight-bolder">$ <?php echo $profit; ?></div>
												<?php
												}
											?>
											
											<div class="font-size-sm text-muted font-weight-bold mt-1">Profit</div>
										</div>
										<!--end::Title-->
									</div>
								</div>
								<!--end::Item-->
							</div>
							<div class="row row-paddingless">
								<!--begin::Item-->
								<div class="col">
									<div class="d-flex align-items-center mr-2">
										<!--begin::Symbol-->
										<div class="symbol symbol-45 symbol-light-success mr-4 flex-shrink-0">
											<div class="symbol-label">
												<span class="svg-icon svg-icon-lg svg-icon-success">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
															<path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000" />
														</g>
													</svg>
													<!--end::Svg Icon-->
												</span>
											</div>
										</div>
										<!--end::Symbol-->
										<!--begin::Title-->
										<div>
											<?php
											foreach($conn->query('SELECT SUM(amount) FROM transaction_history WHERE status = 3') as $row) {
												?>
												<div class="font-size-h4 text-dark-75 font-weight-bolder">$ <?php echo $row['SUM(amount)']; ?></div>
												<?php
												}
											?>
											
											<div class="font-size-sm text-muted font-weight-bold mt-1">Helper Earn</div>
										</div>
										<!--end::Title-->
									</div>
								</div>
								<!--end::Item-->
								<!--begin::Item-->
								<div class="col">
									<div class="d-flex align-items-center mr-2">
										<!--begin::Symbol-->
										<div class="symbol symbol-45 symbol-light-primary mr-4 flex-shrink-0">
											<div class="symbol-label">
												<span class="svg-icon svg-icon-lg svg-icon-primary">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Barcode-read.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16" />
															<path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero" />
														</g>
													</svg>
													<!--end::Svg Icon-->
												</span>
											</div>
										</div>
										<!--end::Symbol-->
										<!--begin::Title-->
										<div>
											<?php
											foreach($conn->query('SELECT SUM(amount) FROM transaction_history WHERE status = 2') as $row) {
												?>
												<div class="font-size-h4 text-dark-75 font-weight-bolder">$ <?php echo $row['SUM(amount)']; ?></div>
												<?php
												}
											?>
											
											<div class="font-size-sm text-muted font-weight-bold mt-1">All Time Sales</div>
										</div>
										<!--end::Title-->
									</div>
								</div>
								<!--end::Item-->
							</div>
						</div>
						<!--end::Items-->
					</div>
					<!--end::Body-->
				</div>
				<!--end::Mixed Widget 16-->
			</div>
			
		</div>
		<div class="row">
			<div class="col-xl-4">
				<!--begin::Stats Widget 1-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-4.svg)">
					<!--begin::Body-->
					<div class="card-body">
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">Meeting Schedule</a>
						<div class="font-weight-bold text-success mt-9 mb-5">3:30PM - 4:20PM</div>
						<p class="text-dark-75 font-weight-bolder font-size-h5 m-0">Craft a headline that is informative
						<br>and will capture readers</p>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 1-->
			</div>
			<div class="col-xl-4">
				<!--begin::Stats Widget 2-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-2.svg)">
					<!--begin::Body-->
					<div class="card-body">
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">Announcement</a>
						<div class="font-weight-bold text-success mt-9 mb-5">03 May 2020</div>
						<p class="text-dark-75 font-weight-bolder font-size-h5 m-0">Great blog posts don’t just happen
						<br>Even the best bloggers need it</p>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 2-->
			</div>
			<div class="col-xl-4">
				<!--begin::Stats Widget 3-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-1.svg)">
					<!--begin::body-->
					<div class="card-body">
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">New Release</a>
						<div class="font-weight-bold text-success mt-9 mb-5">ReactJS</div>
						<p class="text-dark-75 font-weight-bolder font-size-h5 m-0">AirWays - A Front-end solution for
						<br>airlines build with ReactJS</p>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Stats Widget 3-->
			</div>
		</div>
		<div class="row">
			<div class="col-xl-4">
				<!--begin::Mixed Widget 10-->
				<div class="card card-custom card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body d-flex flex-column">
						<div class="flex-grow-1 pb-5">
							<!--begin::Info-->
							<div class="d-flex align-items-center pr-2 mb-6">
								<span class="text-muted font-weight-bold font-size-lg flex-grow-1">7 Hours Ago</span>
								<div class="symbol symbol-50">
									<span class="symbol-label bg-light-light">
										<img src="assets/media/svg/misc/006-plurk.svg" class="h-50 align-self-center" alt="">
									</span>
								</div>
							</div>
							<!--end::Info-->
							<!--begin::Link-->
							<a href="#" class="text-dark font-weight-bolder text-hover-primary font-size-h4">PitStop - Multiple Email
							<br>Generator</a>
							<!--end::Link-->
							<!--begin::Desc-->
							<p class="text-dark-50 font-weight-normal font-size-lg mt-6">Pitstop creates quick email campaigns.
							<br>We help to strengthen your brand
							<br>for your every purpose.</p>
							<!--end::Desc-->
						</div>
						<!--begin::Team-->
						<div class="d-flex align-items-center">
							<!--begin::Pic-->
							<a href="#" class="symbol symbol-45 symbol-light mr-3">
								<div class="symbol-label">
									<img src="assets/media/svg/avatars/001-boy.svg" class="h-75 align-self-end" alt="">
								</div>
							</a>
							<!--end::Pic-->
							<!--begin::Pic-->
							<a href="#" class="symbol symbol-45 symbol-light mr-3">
								<div class="symbol-label">
									<img src="assets/media/svg/avatars/028-girl-16.svg" class="h-75 align-self-end" alt="">
								</div>
							</a>
							<!--end::Pic-->
							<!--begin::Pic-->
							<a href="#" class="symbol symbol-45 symbol-light">
								<div class="symbol-label">
									<img src="assets/media/svg/avatars/024-boy-9.svg" class="h-75 align-self-end" alt="">
								</div>
							</a>
							<!--end::Pic-->
						</div>
						<!--end::Team-->
					</div>
					<!--end::Body-->
				</div>
				<!--end::Mixed Widget 10-->
			</div>
			<div class="col-xl-4">
				<!--begin::Mixed Widget 11-->
				<div class="card card-custom card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body d-flex flex-column">
						<div class="flex-grow-1 pb-5">
							<!--begin::Info-->
							<div class="d-flex align-items-center pr-2 mb-6">
								<span class="text-muted font-weight-bold font-size-lg flex-grow-1">2 Days Ago</span>
								<div class="symbol symbol-50">
									<span class="symbol-label bg-light-light">
										<img src="assets/media/svg/misc/015-telegram.svg" class="h-50 align-self-center" alt="">
									</span>
								</div>
							</div>
							<!--end::Info-->
							<a href="#" class="text-dark font-weight-bolder text-hover-primary font-size-h4">Craft - ReactJS Admin
							<br>Theme</a>
							<!--begin::Desc-->
							<p class="text-dark-50 font-weight-normal font-size-lg mt-6">Craft uses the latest and greatest frameworks
							<br>with ReactJS for complete modernization and
							<br>future proofing your business operations
							<br>and sales opportunities</p>
							<!--end::Desc-->
						</div>
						<!--begin::Team-->
						<div class="d-flex align-items-center">
							<!--begin::Pic-->
							<a href="#" class="symbol symbol-45 symbol-light mr-3">
								<div class="symbol-label">
									<img src="assets/media/svg/avatars/001-boy.svg" class="h-75 align-self-end" alt="">
								</div>
							</a>
							<!--end::Pic-->
							<!--begin::Pic-->
							<a href="#" class="symbol symbol-45 symbol-light mr-3">
								<div class="symbol-label">
									<img src="assets/media/svg/avatars/028-girl-16.svg" class="h-75 align-self-end" alt="">
								</div>
							</a>
							<!--end::Pic-->
							<!--begin: Pic-->
							<a href="#" class="symbol symbol-45 symbol-light mr-3">
								<div class="symbol-label">
									<img src="assets/media/svg/avatars/024-boy-9.svg" class="h-75 align-self-end" alt="">
								</div>
							</a>
							<!--end::Pic-->
							<!--begin::Pic-->
							<a href="#" class="symbol symbol-45 symbol-light">
								<div class="symbol-label">
									<img src="assets/media/svg/avatars/005-girl-2.svg" class="h-75 align-self-end" alt="">
								</div>
							</a>
							<!--end::Pic-->
						</div>
						<!--end::Team-->
					</div>
					<!--end::Body-->
				</div>
				<!--end::Mixed Widget 11-->
			</div>
			<div class="col-xl-4">
				<!--begin::Mixed Widget 12-->
				<div class="card card-custom card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body d-flex flex-column">
						<div class="flex-grow-1 pb-5">
							<!--begin::Info-->
							<div class="d-flex align-items-center pr-2 mb-6">
								<span class="text-muted font-weight-bold font-size-lg flex-grow-1">5 Weeks Ago</span>
								<div class="symbol symbol-50">
									<span class="symbol-label bg-light-light">
										<img src="assets/media/svg/misc/003-puzzle.svg" class="h-50 align-self-center" alt="">
									</span>
								</div>
							</div>
							<!--end::Info-->
							<a href="#" class="text-dark font-weight-bolder text-hover-primary font-size-h4">KT.com - High Quality
							<br>Templates</a>
							<!--begin::Desc-->
							<p class="text-dark-50 font-weight-normal font-size-lg mt-6">Easy to use, incredibly flexible and secure
							<br>with in-depth documentation that outlines
							<br>everything for you</p>
							<!--end::Desc-->
						</div>
						<!--begin::Team-->
						<div class="d-flex align-items-center">
							<!--begin::Pic-->
							<a href="#" class="symbol symbol-45 symbol-light mr-3">
								<div class="symbol-label">
									<img src="assets/media/svg/avatars/001-boy.svg" class="h-75 align-self-end" alt="">
								</div>
							</a>
							<!--end::Pic-->
							<!--begin::Pic-->
							<a href="#" class="symbol symbol-45 symbol-light mr-3">
								<div class="symbol-label">
									<img src="assets/media/svg/avatars/028-girl-16.svg" class="h-75 align-self-end" alt="">
								</div>
							</a>
							<!--end::Pic-->
							<!--begin::Pic-->
							<a href="#" class="symbol symbol-45 symbol-light">
								<div class="symbol-label">
									<img src="assets/media/svg/avatars/024-boy-9.svg" class="h-75 align-self-end" alt="">
								</div>
							</a>
							<!--end::Pic-->
						</div>
						<!--end::Team-->
					</div>
					<!--end::Body-->
				</div>
				<!--end::Mixed Widget 12-->
			</div>
		</div>
		
		
		
</main>
</html>



<script src="assets/plugins/chart/jquery.appear.min.js"></script>
<script src="assets/plugins/chart/jquery.easypiechart.min.js"></script> 
<script>
    'use strict';

var $window = $(window);

function run()
{
	var fName = arguments[0],
		aArgs = Array.prototype.slice.call(arguments, 1);
	try {
		fName.apply(window, aArgs);
	}catch(err) {
	}
};
function _chart ()
{
	$('.b-skills').appear(function() {
		setTimeout(function() {
			$('.chart').easyPieChart({
				easing: 'easeOutElastic',
				delay: 3000,
				barColor: '#369670',
				trackColor: '#fff',
				scaleColor: false,
				lineWidth: 21,
				trackWidth: 21,
				size: 250,
				lineCap: 'round',
				onStep: function(from, to, percent) {
					this.el.children[0].innerHTML = Math.round(percent);
				}
			});
		}, 150);
	});
};

$(document).ready(function() {
	run(_chart);
});
</script>