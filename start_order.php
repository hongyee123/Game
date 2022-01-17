<?php
require_once('config/config.php');
require_once('config/bootstrap.php');
require_once('layouts.php');

$pageTitle = 'orders';
$pageName = 'start_order';

if(!isset($_SESSION['username']) && !isset($_SESSION['helper_id'])){
    header("Location: index.php");
}
if(isset($_SESSION['username'])){
    include('layout/in.php');
    $username = $_SESSION['username'];
    $ex = "";
}if(isset($_SESSION['helper_id'])){
    include('layout/helper_in.php');
    $username = $_SESSION['helper_id'];
    $ex = "WHERE username != '$username'";
}


?>
<body onload="filter()">
    <div class="container mt-5">
        <div class="row col-12">
            <h1 class="col-12 text-light text-center mb-5">
                Start Order
            </h1>
        </div>

        <div class="row pr-3 pl-3 mb-5">
            <div class="col-2">
                <select name="position" class="bg-white form-control form-control-lg" onchange="filter()" id="fp" style="width: 100%;" placeholder="Type">
                <option value="">All</option>
                <?php
                $sql = "SELECT DISTINCT type FROM product_detail ORDER BY type";
                $result = mysqli_query($conn,$sql);
                if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?= $row['type']?>"><?= $row['type']?></option>
                        <?php
                    }
                }
                ?>
                </select>
            </div>
           
            <div class="col-8">
                <input type="search" id="search" name="search" placeholder="Search" class="form-control border-0 form-control-lg" oninput="filter()">
            </div>
            <div class="col-2">
                <select name="position" class="bg-white form-control form-control-lg" onchange="filter()" id="pr" style="width: 100%;">
                    <option value="" disable hidden>Pricing</option>
                    <option value="1">Low to High</option>
                    <option value="2">High to Low</option>
                </select>
            </div>
        </div>
        <div class="col-12 pl-0 pr-0">
            <div id="view" class="container-fluid"></div>
        </div>
    </div>
</body>


<script>
function filter(){
    var category = document.getElementById('fp').value;
    var keyword = document.getElementById("search").value;
    var price = document.getElementById('pr').value;
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("view").innerHTML = this.responseText;
        }
    };
        //0 0 0 
    if (category == "" && keyword == "" && price == ""){
        xhttp.open("GET", "start_order_card.php", true);
        xhttp.send();
        return;
        // 0 0 1
    }else if(category == "" && keyword == "" && price != ""){
        xhttp.open("GET", "start_order_card.php?p="+price, true);
        xhttp.send();
        return;
        // 0 1 0
    }else if(category != "" && keyword == "" && price != ""){
        xhttp.open("GET", "start_order_card.php?c="+category+"&p="+price, true);
        xhttp.send();
        return;
        //1 0 0
    }else if(category != "" && keyword == "" && price == ""){
        xhttp.open("GET", "start_order_card.php?k="+keyword+"&c="+category, true);
        xhttp.send();
        return;
        //0 1 1
    }else if(category == "" && keyword != "" && price != ""){
        xhttp.open("GET", "start_order_card.php?p="+price+"&k="+keyword, true);
        xhttp.send();
        return;
        //1 1 0
    }else if(category != "" && keyword != "" && price == ""){
        xhttp.open("GET", "start_order_card.php?c="+category+"&k="+keyword, true);
        xhttp.send();
        return;
        //1 0 1
    }else if(category != "" && keyword == "" && price != ""){
        xhttp.open("GET", "start_order_card.php?p="+price+"&c="+category, true);
        xhttp.send();
        return;
    }else if(category == "" && keyword != "" && price == ""){
        xhttp.open("GET", "start_order_card.php?k="+keyword, true);
        xhttp.send();
        return;
    }else{
        xhttp.open("GET", "start_order_card.php?p="+price+"&k="+keyword+"&c="+category, true);
        xhttp.send();
        return;
    }
}
</script>