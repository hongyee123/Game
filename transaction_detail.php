<?php
require_once('config/config.php');
require_once('config/bootstrap.php');
require_once('layouts.php');

$pageTitle = 'credits';
$pageName = 'history';

if(!isset($_SESSION['username']) && !isset($_SESSION['helper_id'])){
    header("Location: index.php");
}
if(isset($_SESSION['username'])){
    include('layout/in.php');
    $username = $_SESSION['username'];
}if(isset($_SESSION['helper_id'])){
    include('layout/helper_in.php');
    $username = $_SESSION['helper_id'];
}

if(isset($_GET['tid'])) {
    $id = $_GET['tid'];
}else{
    header("Location: index.php");
}
?>

<div class="container mt-5">
    <div class="row col-12  mb-5">
        <h1 class="col-12 text-light text-center mb-5">
            Invoice
        </h1>
    </div>
    <div class="row">
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
            <div class="d-flex flex-column-fluid">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Invoice-->
                    <div class="card card-custom position-relative overflow-hidden">
                        <!--begin::Shape-->
                        <div class="position-absolute opacity-30">
                            <span class="svg-icon svg-icon-10x svg-logo-white">
                                <!--begin::Svg Icon | path:assets/media/svg/shapes/abstract-8.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="176" height="165" viewBox="0 0 176 165" fill="none">
                                    <g clip-path="url(#clip0)">
                                        <path d="M-10.001 135.168C-10.001 151.643 3.87924 165.001 20.9985 165.001C38.1196 165.001 51.998 151.643 51.998 135.168C51.998 118.691 38.1196 105.335 20.9985 105.335C3.87924 105.335 -10.001 118.691 -10.001 135.168Z" fill="#AD84FF"></path>
                                        <path d="M28.749 64.3117C28.749 78.7296 40.8927 90.4163 55.8745 90.4163C70.8563 90.4163 83 78.7296 83 64.3117C83 49.8954 70.8563 38.207 55.8745 38.207C40.8927 38.207 28.749 49.8954 28.749 64.3117Z" fill="#AD84FF"></path>
                                        <path d="M82.9996 120.249C82.9996 144.964 103.819 165 129.501 165C155.181 165 176 144.964 176 120.249C176 95.5342 155.181 75.5 129.501 75.5C103.819 75.5 82.9996 95.5342 82.9996 120.249Z" fill="#AD84FF"></path>
                                        <path d="M98.4976 23.2928C98.4976 43.8887 115.848 60.5856 137.249 60.5856C158.65 60.5856 176 43.8887 176 23.2928C176 2.69692 158.65 -14 137.249 -14C115.848 -14 98.4976 2.69692 98.4976 23.2928Z" fill="#AD84FF"></path>
                                        <path d="M-10.0011 8.37466C-10.0011 20.7322 0.409554 30.7493 13.2503 30.7493C26.0911 30.7493 36.5 20.7322 36.5 8.37466C36.5 -3.98287 26.0911 -14 13.2503 -14C0.409554 -14 -10.0011 -3.98287 -10.0011 8.37466Z" fill="#AD84FF"></path>
                                        <path d="M-2.24881 82.9565C-2.24881 87.0757 1.22081 90.4147 5.50108 90.4147C9.78135 90.4147 13.251 87.0757 13.251 82.9565C13.251 78.839 9.78135 75.5 5.50108 75.5C1.22081 75.5 -2.24881 78.839 -2.24881 82.9565Z" fill="#AD84FF"></path>
                                        <path d="M55.8744 12.1044C55.8744 18.2841 61.0788 23.2926 67.5001 23.2926C73.9196 23.2926 79.124 18.2841 79.124 12.1044C79.124 5.92653 73.9196 0.917969 67.5001 0.917969C61.0788 0.917969 55.8744 5.92653 55.8744 12.1044Z" fill="#AD84FF"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Shape-->
                        <!--begin::Invoice header-->
                        <div class="row justify-content-center py-8 px-8 py-md-36 px-md-0 bg-dark">
                            <div class="col-md-9">
                                <div class="d-flex justify-content-between align-items-md-center flex-column flex-md-row">
                                    <div class="d-flex flex-column px-0 order-2 order-md-1">
                                        <!--begin::Logo-->
                                        <a href="#" class="mb-5">
                                        <span class="d-flex flex-column font-size-h1 font-weight-bold text-white">
                                            <span>Game Levelling Helper System</span>
                                        </span>
                                        </a>
                                        <!--end::Logo-->
                                        <span class="d-flex flex-column font-size-h6 font-weight-bold text-white">
                                            <span>Jalan Hello, 123, Johor Bahru</span>
                                            <span>Johor 81800</span>
                                        </span>
                                    </div>
                                    <h1 class="font-weight-boldest text-white order-1 order-md-2">INVOICE</h1>
                                </div>
                            </div>
                        </div>
                        <!--end::Invoice header-->
                        <?php
                        $query = "SELECT * FROM transaction_history WHERE username = '$username' AND id = '$id'";
                        $result = mysqli_query($conn, $query);
                        if(!$result) 
                            die('Fetch Error');
                        else{
                            if($num_row = 1) {
                                $row = mysqli_fetch_assoc($result);
                            }
                        }

                        ?>
                        <div class="row justify-content-center py-8 px-8 py-md-30 px-md-0">
                            <div class="col-md-9">
                                <!--begin::Invoice body-->
                                <div class="row pb-26">
                                    <div class="col-md-3 border-right-md pr-md-10 py-md-10">
                                        <!--begin::Invoice To-->
                                        <div class="text-dark-50 font-size-lg font-weight-bold mb-3">INVOICE TO.</div>
                                        <div class="font-size-lg font-weight-bold mb-10"><?=$row['username']?></div>
                                        <!--end::Invoice To-->
                                        <!--begin::Invoice No-->
                                        <div class="text-dark-50 font-size-lg font-weight-bold mb-3">INVOICE NO.</div>
                                        <div class="font-size-lg font-weight-bold mb-10">#0000<?=$row['id']?></div>
                                        <!--end::Invoice No-->
                                        <!--begin::Invoice Date-->
                                        <div class="text-dark-50 font-size-lg font-weight-bold mb-3">DATE</div>
                                        <div class="font-size-lg font-weight-bold"><?=$row['date']?></div>
                                        <!--end::Invoice Date-->
                                    </div>
                                    <div class="col-md-9 py-10 pl-md-10">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="pt-1 pb-9 pl-0 pl-md-5 font-weight-bolder text-muted font-size-lg text-uppercase">Description</th>
                                                        <th class="pt-1 pb-9 text-right pr-0 font-weight-bolder text-muted font-size-lg text-uppercase">Rate</th>
                                                        <th class="pt-1 pb-9 text-right pr-0 font-weight-bolder text-muted font-size-lg text-uppercase">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($row['status'] == 1){
                                                        ?>
                                                    <tr class="font-weight-bolder font-size-lg">
                                                        <td class="border-top-0 pl-0 pl-md-5 pt-7 d-flex align-items-center">
                                                        <span class="navi-icon mr-2">
                                                            <i class="fa fa-genderless text-success font-size-h2"></i>
                                                        </span>Topup</td>
                                                        <td class="pr-0 pt-7 font-size-h6 font-weight-boldest text-right"></td>
                                                        <td class="pr-0 pt-7 font-size-h6 font-weight-boldest text-right">RM <?=$row['amount']?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>


                                                    <?php
                                                    if ($row['status'] == 2){
                                                        ?>
                                                    <tr class="font-weight-bolder font-size-lg">
                                                        <td class="border-top-0 pl-0 pl-md-5 pt-7 d-flex align-items-center">
                                                        <span class="navi-icon mr-2">
                                                            <i class="fa fa-genderless text-danger font-size-h2"></i>
                                                        </span>Payment</td>
                                                        <td class="pr-0 pt-7 font-size-h6 font-weight-boldest text-right"></td>
                                                        <td class="pr-0 pt-7 font-size-h6 font-weight-boldest text-right">RM <?=$row['amount']?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>

                                                    

                                                    <?php
                                                    if ($row['status'] == 3){
                                                        ?>
                                                    <tr class="font-weight-bolder font-size-lg">
                                                        <td class="border-top-0 pl-0 pl-md-5 pt-7 d-flex align-items-center">
                                                        <span class="navi-icon mr-2">
                                                            <i class="fa fa-genderless text-success font-size-h2"></i>
                                                        </span>Earn</td>
                                                        <td class="pr-0 pt-7 font-size-h6 font-weight-boldest text-right"></td>
                                                        <td class="pr-0 pt-7 font-size-h6 font-weight-boldest text-right">RM <?=(($row['amount']/80)*100);?></td>
                                                    </tr>
                                                    <tr class="font-weight-bolder border-bottom-0 font-size-lg">
                                                        <td class="border-top-0 pl-0 pl-md-5 py-4 d-flex align-items-center">
                                                        <span class="navi-icon mr-2">
                                                            <i class="fa fa-genderless text-danger font-size-h2"></i>
                                                        </span>Service Tax</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">20%</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">- RM <?=($row['amount']/80)*20;?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>


                                                    <?php
                                                    if ($row['status'] == 4){
                                                        ?>
                                                    <tr class="font-weight-bolder font-size-lg">
                                                        <td class="border-top-0 pl-0 pl-md-5 pt-7 d-flex align-items-center">
                                                        <span class="navi-icon mr-2">
                                                            <i class="fa fa-genderless text-success font-size-h2"></i>
                                                        </span>Withdraw</td>
                                                        <td class="pr-0 pt-7 font-size-h6 font-weight-boldest text-right"></td>
                                                        <td class="pr-0 pt-7 font-size-h6 font-weight-boldest text-right">RM <?=(($row['amount']/80)*100);?></td>
                                                    </tr>
                                                    <tr class="font-weight-bolder border-bottom-0 font-size-lg">
                                                        <td class="border-top-0 pl-0 pl-md-5 py-4 d-flex align-items-center">
                                                        <span class="navi-icon mr-2">
                                                            <i class="fa fa-genderless text-danger font-size-h2"></i>
                                                        </span>Service Tax</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">20%</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">- RM <?=($row['amount']/80)*20;?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Invoice body-->
                                <!--begin::Invoice footer-->
                                <?php
                                if ($row['status'] == 3){
                                ?>
                                <div class="row">
                                    <div class="col-md-12 pt-md-25">
                                        <div class="bg-primary rounded d-flex align-items-center justify-content-between text-white max-w-350px position-relative ml-auto p-7">
                                            <!--begin::Shape-->
                                            <div class="position-absolute opacity-30 top-0 right-0">
                                                <span class="svg-icon svg-icon-2x svg-logo-white svg-icon-flip">
                                                    <!--begin::Svg Icon | path:assets/media/svg/shapes/abstract-8.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="176" height="165" viewBox="0 0 176 165" fill="none">
                                                        <g clip-path="url(#clip0)">
                                                            <path d="M-10.001 135.168C-10.001 151.643 3.87924 165.001 20.9985 165.001C38.1196 165.001 51.998 151.643 51.998 135.168C51.998 118.691 38.1196 105.335 20.9985 105.335C3.87924 105.335 -10.001 118.691 -10.001 135.168Z" fill="#AD84FF"></path>
                                                            <path d="M28.749 64.3117C28.749 78.7296 40.8927 90.4163 55.8745 90.4163C70.8563 90.4163 83 78.7296 83 64.3117C83 49.8954 70.8563 38.207 55.8745 38.207C40.8927 38.207 28.749 49.8954 28.749 64.3117Z" fill="#AD84FF"></path>
                                                            <path d="M82.9996 120.249C82.9996 144.964 103.819 165 129.501 165C155.181 165 176 144.964 176 120.249C176 95.5342 155.181 75.5 129.501 75.5C103.819 75.5 82.9996 95.5342 82.9996 120.249Z" fill="#AD84FF"></path>
                                                            <path d="M98.4976 23.2928C98.4976 43.8887 115.848 60.5856 137.249 60.5856C158.65 60.5856 176 43.8887 176 23.2928C176 2.69692 158.65 -14 137.249 -14C115.848 -14 98.4976 2.69692 98.4976 23.2928Z" fill="#AD84FF"></path>
                                                            <path d="M-10.0011 8.37466C-10.0011 20.7322 0.409554 30.7493 13.2503 30.7493C26.0911 30.7493 36.5 20.7322 36.5 8.37466C36.5 -3.98287 26.0911 -14 13.2503 -14C0.409554 -14 -10.0011 -3.98287 -10.0011 8.37466Z" fill="#AD84FF"></path>
                                                            <path d="M-2.24881 82.9565C-2.24881 87.0757 1.22081 90.4147 5.50108 90.4147C9.78135 90.4147 13.251 87.0757 13.251 82.9565C13.251 78.839 9.78135 75.5 5.50108 75.5C1.22081 75.5 -2.24881 78.839 -2.24881 82.9565Z" fill="#AD84FF"></path>
                                                            <path d="M55.8744 12.1044C55.8744 18.2841 61.0788 23.2926 67.5001 23.2926C73.9196 23.2926 79.124 18.2841 79.124 12.1044C79.124 5.92653 73.9196 0.917969 67.5001 0.917969C61.0788 0.917969 55.8744 5.92653 55.8744 12.1044Z" fill="#AD84FF"></path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Shape-->
                                            <div class="font-weight-boldest font-size-h5">TOTAL AMOUNT</div>
                                            <div class="text-right d-flex flex-column">
                                                <span class="font-weight-boldest font-size-h3 line-height-sm">RM <?=$row['amount'];?></span>
                                                <span class="font-size-sm">Taxes included</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                }else{
                                ?>
                                <div class="row">
                                    <div class="col-md-5 border-top pt-14 pb-10 pb-md-18">
                                        <div class="d-flex flex-column flex-md-row">
                                            <div class="d-flex flex-column">
                                                <div class="font-weight-bold font-size-h6 mb-3">BANK TRANSFER</div>
                                                <div class="d-flex justify-content-between font-size-lg mb-3">
                                                    <span class="font-weight-bold mr-15">Account Name:</span>
                                                    <span class="text-right">User123123</span>
                                                </div>
                                                <div class="d-flex justify-content-between font-size-lg mb-3">
                                                    <span class="font-weight-bold mr-15">Account Number:</span>
                                                    <span class="text-right">12345678901234</span>
                                                </div>
                                                <div class="d-flex justify-content-between font-size-lg">
                                                    <span class="font-weight-bold mr-15">Code:</span>
                                                    <span class="text-right">BARC0032UK</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7 pt-md-25">
                                        <div class="bg-primary rounded d-flex align-items-center justify-content-between text-white max-w-350px position-relative ml-auto p-7">
                                            <!--begin::Shape-->
                                            <div class="position-absolute opacity-30 top-0 right-0">
                                                <span class="svg-icon svg-icon-2x svg-logo-white svg-icon-flip">
                                                    <!--begin::Svg Icon | path:assets/media/svg/shapes/abstract-8.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="176" height="165" viewBox="0 0 176 165" fill="none">
                                                        <g clip-path="url(#clip0)">
                                                            <path d="M-10.001 135.168C-10.001 151.643 3.87924 165.001 20.9985 165.001C38.1196 165.001 51.998 151.643 51.998 135.168C51.998 118.691 38.1196 105.335 20.9985 105.335C3.87924 105.335 -10.001 118.691 -10.001 135.168Z" fill="#AD84FF"></path>
                                                            <path d="M28.749 64.3117C28.749 78.7296 40.8927 90.4163 55.8745 90.4163C70.8563 90.4163 83 78.7296 83 64.3117C83 49.8954 70.8563 38.207 55.8745 38.207C40.8927 38.207 28.749 49.8954 28.749 64.3117Z" fill="#AD84FF"></path>
                                                            <path d="M82.9996 120.249C82.9996 144.964 103.819 165 129.501 165C155.181 165 176 144.964 176 120.249C176 95.5342 155.181 75.5 129.501 75.5C103.819 75.5 82.9996 95.5342 82.9996 120.249Z" fill="#AD84FF"></path>
                                                            <path d="M98.4976 23.2928C98.4976 43.8887 115.848 60.5856 137.249 60.5856C158.65 60.5856 176 43.8887 176 23.2928C176 2.69692 158.65 -14 137.249 -14C115.848 -14 98.4976 2.69692 98.4976 23.2928Z" fill="#AD84FF"></path>
                                                            <path d="M-10.0011 8.37466C-10.0011 20.7322 0.409554 30.7493 13.2503 30.7493C26.0911 30.7493 36.5 20.7322 36.5 8.37466C36.5 -3.98287 26.0911 -14 13.2503 -14C0.409554 -14 -10.0011 -3.98287 -10.0011 8.37466Z" fill="#AD84FF"></path>
                                                            <path d="M-2.24881 82.9565C-2.24881 87.0757 1.22081 90.4147 5.50108 90.4147C9.78135 90.4147 13.251 87.0757 13.251 82.9565C13.251 78.839 9.78135 75.5 5.50108 75.5C1.22081 75.5 -2.24881 78.839 -2.24881 82.9565Z" fill="#AD84FF"></path>
                                                            <path d="M55.8744 12.1044C55.8744 18.2841 61.0788 23.2926 67.5001 23.2926C73.9196 23.2926 79.124 18.2841 79.124 12.1044C79.124 5.92653 73.9196 0.917969 67.5001 0.917969C61.0788 0.917969 55.8744 5.92653 55.8744 12.1044Z" fill="#AD84FF"></path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Shape-->
                                            <div class="font-weight-boldest font-size-h5">TOTAL AMOUNT</div>
                                            <div class="text-right d-flex flex-column">
                                                <span class="font-weight-boldest font-size-h3 line-height-sm">RM <?=$row['amount'];?></span>
                                                <span class="font-size-sm">Taxes included</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!-- begin: Invoice action-->
                        <div class="row justify-content-center border-top py-8 px-8 py-md-28 px-md-0">
                            <div class="col-md-9">
                                <div class="d-flex font-size-sm flex-wrap">
                                    <button type="button" class="btn btn-primary font-weight-bolder py-4 mr-3 mr-sm-14 my-1" onclick="window.print();">Print Invoice</button>
                                    <button type="button" class="btn btn-light-primary font-weight-bolder mr-3 my-1">Download</button>
                                    <button type="button" class="btn btn-warning font-weight-bolder ml-sm-auto my-1">Create Invoice</button>
                                </div>
                            </div>
                        </div>
                        <!-- end: Invoice action-->
                    </div>
                    <!--end::Invoice-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Entry-->
        </div>
    </div>
</div>






        