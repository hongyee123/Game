<?php 
include 'config/config.php';
include 'config/test_input.php';
$filterCategory = "";

if(isset($_GET['c'])){
    $filterCategory = " AND type = '".$_GET['c']."'";
}
$keyword = "";
if (isset($_GET['k'])) {
    $keyword = "AND username LIKE '%".$_GET['k']."%'";
    
}
if(isset($_SESSION['helper_id'])){
    $username = $_SESSION['helper_id'];
    $ex = "AND username <> '$username'";
}
if(isset($_SESSION['username'])){
    $ex = "";
}

$order =  "";
if(isset($_GET['p'])){
    if(($_GET['p'])==1){
        $order = "ORDER BY price ASC";
    }
    if(($_GET['p'])==2){
        $order = "ORDER BY price DESC";
    }
}else{
    $order =  "";
}
?>
<div class="row">
	<?php 
    $sql = "SELECT * FROM product_detail WHERE available = '1'". $keyword."  ". $filterCategory."  ". $ex."  ". $order.";";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result)) {
		while ($row = mysqli_fetch_assoc($result)) {
	?>
	<div class="mb-5 col-3">
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
    } else if($keyword != ""){
    ?>
    <div class="row col-12 d-flex justify-content-center">
        <div class="alert alert-custom alert-notice alert-light-dark fade show mb-5" role="alert">
            <div class="alert-icon">
                <i class="flaticon-warning"></i>
            </div>
            <div class="alert-text"><h5><?php echo "No result for <b>' ".$_GET['k']." '</b>"; ?></h5></div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="ki ki-close"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
    
    <?php
    }else if($filterCategory == ""){
    ?>
    <div class="col">
        <h4 class="text-center">
            NO Item yet
        </h4>
    </div>
    <?php
    }
    ?>
</div>
