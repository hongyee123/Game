<?php
function do_html_head(String $title, String $cssLink = null, String $jsLink = null)
{
    echo <<<_HEAD
    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>$title</title>
            $cssLink
            $jsLink
        </head>
        <body class="bg-light">
    _HEAD;
}

function do_html_end(String $jsLink = "")
{
    echo <<<_HEAD
        </body>
    </html>
    _HEAD;
}

function do_component_topnav($appName)
{
    $appName = "Apple";
?>
<style>

.navbar a , .navbar a:visited
{ 
    color: #ff9326;
}
</style>
    <nav class="navbar navbar-expand-md shadow-sm"style="background-color:#000;">
        <div class="container">
            <a class="navbar-brand" href="." style="color: rgb(255 255 255 / 0.8);">
                <?= $appName ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href=".">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <!-- Toggle -->
                        <a class="nav-link" href="#" role="button" id="product-categry" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Product</a>
                        <!-- Menu -->
                        <div class="dropdown-menu border-0 shadow"  aria-labelledby="product-categry" style="min-width: 250px;">
                            <ul class="nav flex-column pl-3">
                                <li class="nav-item">
                                    <a href="product.php" class="nav-link" style="font-size: .93rem;font-weight: 400;">
                                        All
                                    </a>
                                </li>
                                <?php
                                include_once 'config/config.php';
                                $query = "SELECT DISTINCT type FROM product_detail";
                                $result = mysqli_query($conn, $query);
                                if($result) {
                                    $num_row = mysqli_num_rows($result);
                                    for($i = 0; $i < $num_row; $i ++) {
                                        $row = mysqli_fetch_assoc($result);
                                ?>
                                <li class="nav-item">
                                    <a href="product.php?type=<?= $row['type'] ?>" class="nav-link" style="font-size: .93rem;font-weight: 400;">
                                        <?= strtoupper($row['type']) ?>
                                    </a>
                                </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>-->
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav flex-row">
                    <!-- Authentication Links -->
                    <?php if(isset($_SESSION['username']) && $_SESSION['position'] == 'customer'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="viewCart.php">
                            <i class="fas fa-shopping-cart"></i>
                            <?php
                            include 'config/config.php';
                            $user_id = $_SESSION['user_id'];
                            $query = "SELECT SUM(crt_quantity) AS total_crt FROM cart WHERE crt_user = $user_id";
                            $result = mysqli_query($conn, $query);

                            $cart_count = 0;
                            if($result && mysqli_num_rows($result) > 0) {
                                $cart_count = mysqli_fetch_assoc($result)['total_crt'];
                            ?>            
                            <span id="crt_qty" class="badge badge-danger"><?= $cart_count ?></span>
                            <?php
                            } else {
                            ?>
                            <span id="crt_qty" class="badge badge-danger"></span>
                            <?php
                            }
                            ?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="user_acc">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow"  aria-labelledby="user_acc" style="min-width: 200px;">
                            <h5 class="dropdown-header">Welcome, <?= strtoupper($_SESSION['username']); ?>!</h5>
                            <a class="dropdown-item" href="./account.php">View Orders</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="./functions/logout_function.php" method="POST">
                                <input name="logout" hidden>
                            </form>
                        </div>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
<?php
}

function do_component_product_card(Array $product, string $size="col-6 col-md-4 col-lg-4")
{
?>
    <div class="mb-5 col-3">
        <div class="card card-custom wave wave-animate wave-primary mb-4 mb-lg-0 ">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="d-flex flex-column">
                        <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h2 mb-3"><?= $product['type']; ?></a>
                        <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h6"><?= $product['username']; ?></a>
                        <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h6 mb-3">RM<?= number_format(floatval($product['price']), 2) ?><small> per game</small></a>
                        <div class="col-12">
                            <a href="detail.php?pid=<?= $product['id']; ?>" class="btn btn-primary mt-3">View</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}