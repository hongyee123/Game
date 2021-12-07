<base href="../">
<?php
$pageTitle = 'recieve';
$pageName = 'accept_order';

require_once('../config/verify.php');

?>
<div class="container">
    <div class="row mt-5  text-center">
        <div class="row col-12">
            <h1 class="col-12 text-light text-center mb-5">
                Accept Order
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
                $query = "SELECT DISTINCT ord_type FROM order_detail";
                $result = mysqli_query($conn, $query);
                if($result) {
                    $num_row = mysqli_num_rows($result);
                    for($i = 0; $i < $num_row; $i++) {
                        $row = mysqli_fetch_assoc($result);
            ?>
        <div class="col-3 text-center active">
            <a class="white" href="helper/helper_accept_order.php?type=<?= $row['ord_type'] ?>">
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
                        <th class="col-2">Game</th>
                        <th class="col-2">User</th>
                        <th class="col-2">Quantity</th>
                        <th class="col-4"></th>
                    </tr>
            </thead>
            <?php
                $page_num = @$_GET['page'];
                if($page_num == 0 || $page_num == 1) {
                    $out_set = 0;
                } else {
                    $out_set = ($page_num * 5) - 5;
                }

                $query = "SELECT order_detail.id AS detail_id,
                                order_detail.ord_type AS type,
                                order_detail.ord_status AS status,
                                order_detail.ord_quantity AS quantity,
                                orders.ord_user_id AS user
                                FROM orders LEFT JOIN order_detail ON orders.id = order_detail.id WHERE ord_helper_id = '$username'AND ord_status = '1'";

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
                <tr id="order-<?= $row['detail_id'] ?>">
                    <th scope="row"><?= $row['detail_id']?></th>
                    <td><?= $row['type']?></td>
                    <td><?= $row['user']?></td>
                    <td><?= $row['quantity']?></td>
                    <td>
                        <a href="user_information.php?pid=<?= $row['user']; ?>"><button class="btn btn-primary">User Information </button></a>
                        <input class="btn btn-success btn-comfirm" type="button" value="Comfirm" data-detail_id="<?= $row['detail_id'] ?>">
                        <input class="btn btn-danger btn-cancel" type="button" value="Cancel" data-detail_id="<?= $row['detail_id'] ?>" data-user="<?= $row['user'] ?>">
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
    $('.btn-comfirm').on('click', function() {
        var detail_id = $(this).data('detail_id');
        $.ajax({
            url: 'process/helper_accept_order_function.php',
            type: 'POST',
            data: {
                detail_id : detail_id,
            },
            success: function(data) {
                var order_card = $('#order-'+ detail_id).remove();
                console.log(order_card);
                swal({
                    icon: "success",
                    title: "Success",
                    text: "Order Accepted",
                    timer: 2500,
                    buttons: false,
                }).then(function(){
                    location.reload();
                })
            },
            error: function(){
                swal({
                    icon: "error",
                    title: "An error occurred.",
                    text: "apa lan" ,
                    timer: 2500,
                    buttons: false,
            });
            }
        });
    });


    $('.btn-cancel').on('click', function() {
        var detail_id = $(this).data('detail_id');
        var user = $(this).data('user');
        swal({
            icon: "warning",
            title: "Comfirm Detele",
            text: "Are you sure you want to delete?",
            buttons: true,
            dangerMode: true,
        })
        .then((confirmDelete) => {
            if(confirmDelete){
                //comfirmed delete
                $.ajax({
                    url: 'process/helper_cancel_order_function.php',
                    type: 'POST',
                    data: {
                        detail_id : detail_id,
                        user : user,
                    },success: function(){
                        var order_card = $('#order-'+ detail_id).remove();
                        console.log(order_card);
                        swal("Deleted Succesfully!", {
                            icon: "success",
                        }).then(function(){
                            $(".container-fluid").load(document.URL + " .container-fluid");
				            location.reload();
                        });
                    }
                });
            }else{
                // cancel
            }
        });
    });
    </script>