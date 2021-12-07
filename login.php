<?php
include 'config/config.php';

if(empty($_SESSION['username'])) {
    include('layout/out.php');
}if(isset($_SESSION['username'])){
    include('layout/in.php');
	header("Location: index.php");
}if(isset($_SESSION['helper'])){
    include('layout/helper_in.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body class="bg-dark col-12">
<main class="container pt-4 bg-black col-6">
	<div class="row col-12 mt-5">
        <div class="row col-12">
            <h1 class="col-12 text-light text-center mb-5">
                Login
            </h1>
        </div>
	</div>
	<div class="card card-custom gutter-b">
		<div class="card-header">
			<div class="card-title">
				<h5 class="card-label">Login</h5>
			</div>
		</div>
		<!--begin::Form-->
		<form class="form" method="post" action="process/login_function.php">
			<div class="card-body">
				<div class="row">
					<div class="col-xl-2"></div>
					<div class="col-xl-8">
						<!--begin::Input-->
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control form-control-solid form-control-lg" name="username" placeholder="Username">
						</div>
						<!--end::Input-->
						<div>
							<?= (isset($_SESSION['error'])) ? '<div class="text-danger">'. $_SESSION['error'] .'</div>' : '' ?>
							<?php unset($_SESSION['error']); ?>
						</div>
						<!--begin::Input-->
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control form-control-solid form-control-lg" name="password" placeholder="Password">
						</div>
						<!--end::Input-->
						<div>
							<?= (isset($_SESSION['success'])) ? '<div class="text-success" style="text-align:center;">'. $_SESSION['success'] .'</div>' : '' ?>
							<?php unset($_SESSION['success']); ?>
						</div>
					</div>
					<div class="col-xl-3"></div>
				</div>
			</div>
			<!--begin::Actions-->
			<div class="card-footer">
				<div class="row">
					<div class="col-xl-2"></div>
					<div class="col-xl-8">
						<button type="submit" class="btn btn-primary font-weight-bold mr-2" type="submit"name="login" value="login" alt="Login" title="Login">Submit</button>
						<a class="btn btn-clean font-weight-bold" href="index.php">Cancel</a>
					</div>
					<div class="col-xl-3"></div>
				</div>
			</div>
			<!--end::Actions-->
		</form>
		<!--end::Form-->
	</div>
	
</main>
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
