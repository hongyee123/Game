<?php 
include 'process/handle_add_user.php';

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
	<title>Levelling Helper System</title>
</head>
<body>
    
    <div>
	<img src="background/back2.jpg" style="width: 100%;position: absolute;z-index: -999;">
	</div>
    <main class="container" >
        <div class="row col-12 mt-5">
            <div class="row col-12">
                <h1 class="col-12 text-light text-center mb-5">
                    Register <span class="text-danger">Now</span>
                </h1>
            </div>
        </div>
        <div class="login-box">
            <form class="form" method="post" action="process/register_function.php">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label class="text-light font-weight-bold">Name</label>
                                <input type="text" class="form-control form-control-solid form-control-lg" placeholder="Username" name="username"  value="<?= $username; ?>" required>
                            </div>
                            <div>
                                <?= (isset($_SESSION['register_error'])) ? '<div class="text-danger" style="padding-left: 20px;">'. $_SESSION['register_error'] .'</div>' : '' ?>
                                <?php unset($_SESSION['register_error']); ?>
                            </div>
                            <div class="form-group">
                                <label class="text-light font-weight-bold">Password</label>
                                <input type="password" class="form-control form-control-solid form-control-lg" placeholder="Password" name="password"  value="<?= $password; ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="text-light font-weight-bold">Comfirm Password</label>
                                <input type="password" class="form-control form-control-solid form-control-lg" placeholder="Comfirm Password" name="password2" required>
                            </div>
                            <div class="form-group">
                                <label class="text-light font-weight-bold">Contact Number</label>
                                <input type="tel" class="form-control form-control-solid form-control-lg" pattern="[0-9]{10}" placeholder="Contact Number" name="contact"  value="<?= $contact; ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="text-light font-weight-bold">Email</label>
                                <input type="email" class="form-control form-control-solid form-control-lg" placeholder="E-mail" id="email" name="email"  value="<?= $email; ?>" required>
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
                            <button type="submit" class="btn btn-primary font-weight-bold mr-2" name="add_user" value="Submit">Submit</button>
                            <a class="btn btn-clean font-weight-bold" href="index.php">Cancel</a>
                        </div>
                        <div class="col-xl-3"></div>
                    </div>
                </div>
                <!--end::Actions-->
            </form>
        </div>
    </main>
<script type="text/javascript">
		$("#image").change(function() {
			readURL(this);
		});
	</script>
</body>
</html>