<?php 
require_once('config/config.php');
require_once('config/bootstrap.php');
echo $bootstrapCSS; echo $jQueryJS;echo $jQueryFormJS;echo $sweetAlert; echo $bootstrapJS; echo $fontAwsomeIcons;

$pageTitle = 'join';
$pageName = 'join_us';

if(empty($_SESSION['username'])) {
    header("Location: index.php");
}if(isset($_SESSION['username'])){
    include('layout/in.php');
}if(isset($_SESSION['helper'])){
    include('layout/helper_in.php');
}

$helper_id = ($_SESSION['username']);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Levelling Helper System</title>
</head>
<body style="background-color:black">
    <div>
	<img src="background/back2.jpg" style="width: 100%;position: absolute;z-index: -999;">
	</div>
    <main class="container" >
        <div class="row col-12 mt-5">
            <div class="row col-12">
                <h1 class="col-12 text-light text-center mb-5">
                    Join Us <span class="text-danger">Now</span>
                </h1>
            </div>
        </div>
        <?php
        $query = "SELECT * from helper WHERE helper_id ='$helper_id'";
        $result = mysqli_query($conn, $query);

        if(!$result) 
                    die('Fetch Error');
                else {
                    $num_row = mysqli_num_rows($result);
                    if($num_row > 0) {
                        for($i = 0; $i < $num_row; $i++) {
                            $row = mysqli_fetch_assoc($result);
                            if($row['status'] == 1){
                                ?>
                                <div class="row">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-8">
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3 class="card-label">
                                                        Request Send Successful
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                Please wait for 2-3 Working days for the verification. Thankyou!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }elseif($row['status'] == 2){
                                ?>
                                <div class="row">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-8">
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3 class="card-label">
                                                        Relogin
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                relogin
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }elseif($row['status'] == 3){
                                ?>
                                <div class="row">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-8">
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3 class="card-label">
                                                        Rejected
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            Rejected
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="login-box">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-2"></div>
                                            <div class="col-xl-8">
                                                <div class="form-group">
                                                    <label class="text-light font-weight-bold">Name on IC</label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg" placeholder="Name" id="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="text-light font-weight-bold">IC/Passport</label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg" placeholder="IC" id="ic" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="text-light font-weight-bold">Address</label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg" placeholder="Address" id="address" required>
                                                </div>
                                                <div>
                                                    <div class="checkbox-inline mt-4">
                                                        <label class="checkbox checkbox-lg checkbox-danger">
                                                                <input type="checkbox" name="box1" id="box1" value="1" checked/>
                                                                <span></span>
                                                            <label class="text-light font-weight-bold">Rm 100 for Deposit</label>
                                                        </label>
                                                    </div>
                                                    <div class="checkbox-inline">
                                                        <label class="checkbox checkbox-lg checkbox-danger">
                                                                <input type="checkbox" name="box2" id="box2" value="2" checked/>
                                                                <span></span>
                                                            <label class="text-light font-weight-bold">I have read and agree / agreed with the terms and conditions</label>
                                                        </label>
                                                    </div>
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
                                                <button class="btn btn-danger font-weight-bold mr-2 btn_submit">Submit</button>
                                                <a class="btn btn-light font-weight-bold" href="index.php">Cancel</a>
                                            </div>
                                            <div class="col-xl-3"></div>
                                        </div>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <?php
                            }
                        }
                    }
                }
        ?>
    </main>
</body>
</html>
