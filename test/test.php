<div class="row mb-10">
    <div class="col-2 pr-3 pl-3">
        <div class="card card-custom">
            <a class="nav-link text-body" href="<?= $_SERVER['PHP_SELF'] ?>">
                <div class="d-flex align-items-center">
                    <div class="d-flex flex-column card-title">
                        All
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php
    $query = "SELECT DISTINCT type FROM product_detail";
    
    
    $result = mysqli_query($conn, $query);
    if($result) {
        $num_row = mysqli_num_rows($result);
        for($i = 0; $i < $num_row; $i++) {
            $row = mysqli_fetch_assoc($result);
    ?>
        <div class="col-2 pr-3 pl-1">
            <div class="card card-custom">
                <a class="nav-link text-body" href="?type=<?= $row['type'] ?>">
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column card-title">
                            <?= strtoupper($row['type']) ?>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php
        }
    }
    ?>
</div>