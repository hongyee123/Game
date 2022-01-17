<?php
include 'config/config.php';

$pageTitle = 'home';
$pageName = 'main';

if(isset($_SESSION['username'])){
    include('layout/in.php');
	$username = $_SESSION['username'];
}elseif(isset($_SESSION['helper_id'])){
    include('layout/helper_in.php');
	$username = $_SESSION['helper_id'];
}else{
	include('layout/out.php');
}
?>
<!DOCTYPE html>
<html>
<body style="background-color: #000;">
	<div>
		<img src="background/back.jpg" style="width: 100% !important ;position: absolute;">
	</div>
	<div class="container mt-30">
		<div class="col-xl-12" style="color: #fff;margin: AUTO;TEXT-ALIGN: center;">
			<h1 style="font-size: 4rem;">
			<b>
			MAKE IT EASIER
			<?php 
			// echo $_SESSION['helper_id'];
			?>
			</b>
			</h1>
		</div>
	
		<div class="col-xl-12" style="text-shadow: 5px 5px 20px #fff;text-align: center;font-size: 1.5rem;padding-top: 5rem;color: #fff;font-family: 'Bebas Neue Pro', Helvetica, Arial, sans-serif;">
			Let find the best for you in <span style="color: #ec1c1c">Game Levelling Helper System</span> .<br>
			We GOT the Best Coaches and Helper !! at Game Levelling Helper System
		</div>
		<br>
		<br>
		<br>
		<br>
		<?php
		if(isset($_SESSION['username'])||isset($_SESSION['helper_id'])){
		?>
		<div class="col-xl-12" style="text-align: center;">
			<div class="col-xl-4" style="margin: auto;">
				<a href="start_order.php" style="color: #fff; font-size: 1.5rem;background:#ec1c1c;padding: 15px 60px;border-radius: 11px;"><b>Start Order Now</b></a>
			</div>
		</div>
		<?php
		}else{
		?>
		<div class="col-xl-12" style="text-align: center;">
			<div class="col-xl-3" style="margin: auto;">
				<a href="register.php" style="color: #fff; font-size: 1.5rem;background:#ec1c1c;padding: 15px 60px;border-radius: 11px;"><b>SIGN UP</b></a>
			</div>
		</div>
		<?php
		}
		?>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<div class="row">
			<?php
			$sql = "SELECT * FROM notice WHERE status ='1'";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_assoc($result)){
			?>
			<div class="col-xl-4" id="notice-<?= $row['notice_id'] ?>">
				<!--begin::Stats Widget 1-->
				<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-4.svg)">
					<!--begin::Body-->
					<div class="card-body">
						<a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5"><?php echo $row['title']; ?></a>
						<div class="font-weight-bold text-success mt-9 mb-5">
							<p class="text-success mb-0"><?php echo $row['date']; ?> </p>
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
			}
			?>
		</div>
	</div>
	<?php
	include('layout/footer.php');
	?>
</body>
</html>