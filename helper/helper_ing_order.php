<base href="../">
<?php
$pageTitle = 'recieve';
$pageName = 'ing_order';

require_once('../config/verify.php');

?>
<div class="container">
    
    <div class="row col-12 mt-5">
        <div class="row col-12">
            <h1 class="col-12 text-light text-center mb-5">
                Ing Order
            </h1>
        </div>
        <div class="col-3 text-center">
            <a class="white" href="<?= $_SERVER['PHP_SELF'] ?>">
                <button type="button" class="btn btn-secondary col-12">
                    All
                </button>
            </a>
        </div>
            <?php
                $query = "SELECT DISTINCT ord_type FROM order_detail WHERE ord_helper_id = '$username' AND ord_status = '2'";
                $result = mysqli_query($conn, $query);
                if($result) {
                    $num_row = mysqli_num_rows($result);
                    for($i = 0; $i < $num_row; $i++) {
                        $row = mysqli_fetch_assoc($result);
            ?>
        <div class="col-3 text-center active">
            <a class="white" href="?type=<?= $row['ord_type'] ?>">
                <button type="button" class="btn btn-secondary col-12">
                    <?= strtoupper($row['ord_type']) ?>
                </button>
            </a>
        </div>
    <?php
            }
        }
    ?>
    </div>

    <div class="row col-12 mt-5">
        <table class="table table-light rounded">
            <thead class="thead-dark">
                    <tr>
                        <th class="col-1">#</th>
                        <th class="col-3">Game</th>
                        <th class="col-3">User</th>
                        <th class="col-2">Quantity</th>
                        <th class="col-3"></th>
                    </tr>
            </thead>
            <?php
                $page_num = @$_GET['page'];
                if($page_num == 0 || $page_num == 1) {
                    $out_set = 0;
                } else {
                    $out_set = ($page_num * 5) - 5;
                }

                $query = "SELECT * FROM order_detail WHERE ord_helper_id = '$username' AND ord_status = '2'";

                if(isset($_GET['type'])) {
                    $category = $_GET['type'];
                    $query .= " AND ord_type = '$category'";
                    
                }
                $result = mysqli_query($conn, $query);

                if(!$result) 
                    die('Fetch Error');
                else {
                    $num_row = mysqli_num_rows($result);
                    if($num_row > 0) {
                        for($i = 0; $i < $num_row; $i++) {
                            $row = mysqli_fetch_assoc($result);
                            ?>
            <tbody>
                <tr id="order-<?= $row['id'] ?>">
                    <th scope="row"><?= $row['id']?></th>
                    <td><?= $row['ord_type']?></td>
                    <td><?= $row['ord_user_id']?></td>
                    <td><?= $row['ord_quantity']?></td>
                    <td>
                        <input class="btn btn-success btn-done" type="button" value="Done" data-detail_id="<?= $row['id'] ?>">
                    </td>
                </tr>
                    <?php
                            }
                        } else {
                    ?>
                        <div class="col-12 text-center">Not have product yet!</div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </tbody>
        </table>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('.btn-done').on('click', function() {
        var detail_id = $(this).data('detail_id');
        var user_id = $(this).data('user_id');
        var done = "done";
        swal({
            icon: "warning",
            title: "Comfirm Done Order",
            text: "Are you sure you had done this order?",
            buttons: true,
            dangerMode: false,
            dangerModeText: 'YES',
        })
        .then((confirmDelete) => {
            if(confirmDelete){
                $.ajax({
                    url: 'process/order_functions.php',
                    type: 'POST',
                    data: {
                        detail_id : detail_id,
                        user_id : user_id,
                        done : done,
                    },success: function(){
                        var order_card = $('#order-'+ detail_id).remove();
                        console.log(order_card);
                        swal("Order Done!", {
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
    </script>