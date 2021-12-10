<?php
require_once('config/config.php');
require_once('layouts.php');

if(isset($_GET['pid'])) {
    $id = $_GET['pid'];
    $sql = "SELECT ord_comment FROM order_detail WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if($result){
        while($row = $result->fetch_assoc()) {
            echo $row['ord_comment'];
            if($row['ord_comment'] != null){
                header("Location: fail.php"); 
            }
        }
    }
}else{
    header("Location: index.php");
}

$pageTitle = 'orders';
$pageName = 'done_order';

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


?>
<style>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
.container1{
  position: relative;
  width: 400px;
  background: #111;
  padding: 20px 30px;
  border: 1px solid #444;
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  display: grid;
  height: 50%;
  place-items: center;
  text-align: center;
  background: #000;
  margin:auto;
}
.container .star-widget input{
  display: none;
}
.star-widget label{
  font-size: 40px;
  color: #444;
  padding: 10px;
  float: right;
  transition: all 0.2s ease;
}
input:not(:checked) ~ label:hover,
input:not(:checked) ~ label:hover ~ label{
  color: #fd4;
}
input:checked ~ label{
  color: #fd4;
}
input#rate-5:checked ~ label{
  color: #fe7;
  text-shadow: 0 0 20px #952;
}
#rate-1:checked ~ .hide header:before{
  content: "It Sucks!";
}
#rate-2:checked ~ .hide header:before{
  content: "Acceptable";
}
#rate-3:checked ~ .hide header:before{
  content: "Not Bad !";
}
#rate-4:checked ~ .hide header:before{
  content: "Great ! !";
}
#rate-5:checked ~ .hide header:before{
  content: "Best ever ! ! !";
}
.container .hide{
  display: none;
}
input:checked ~ .hide{
  display: block;
}
.form header{
  width: 100%;
  font-size: 25px;
  color: #fe7;
  font-weight: 500;
  margin: 5px 0 20px 0;
  text-align: center;
  transition: all 0.2s ease;
}
.form .textarea{
  height: 100px;
  width: 100%;
  overflow: hidden;
}
.form .textarea textarea{
  height: 100%;
  width: 100%;
  outline: none;
  color: #eee;
  border: 1px solid #333;
  background: #222;
  padding: 10px;
  font-size: 17px;
  resize: none;
}
.textarea textarea:focus{
  border-color: #444;
}
.form .btn{
  height: 45px;
  width: 100%;
  margin: 15px 0;
}
.form .btn button{
  height: 100%;
  width: 100%;
  border: 1px solid #444;
  outline: none;
  background: #222;
  color: #999;
  font-size: 17px;
  font-weight: 500;
  text-transform: uppercase;
  cursor: pointer;
  transition: all 0.3s ease;
}
.form .btn button:hover{
  background: #1b1b1b;
}
</style>

<div class="container mt-4 mb-5">
    <div class="col-12 mt-5 d-flex justify-content-center">
        <h1 class="text-light text-center mb-5">
            Rating of order ID : <?php echo $id ?>
        </h1>
    </div>
    <div class="container1">
        <div class="star-widget">
            <div>
                <div class="form">
                    <input type="radio" name="rate" id="rate-5" value="5" id="rate">
                    <label for="rate-5" class="fas fa-star"></label>
                    <input type="radio" name="rate" id="rate-4" value="4">
                    <label for="rate-4" class="fas fa-star"></label>
                    <input type="radio" name="rate" id="rate-3" value="3">
                    <label for="rate-3" class="fas fa-star"></label>
                    <input type="radio" name="rate" id="rate-2" value="2">
                    <label for="rate-2" class="fas fa-star"></label>
                    <input type="radio" name="rate" id="rate-1" value="1">
                    <label for="rate-1" class="fas fa-star"></label>
                    <div class="hide">
                        <header></header>
                        <div class="textarea">
                            <textarea cols="30" placeholder="Describe your experience.." name="comment" id="comment"></textarea>
                            <input type="text" class="hidden" value="<?php echo $id ?>" id="id">
                        </div>
                        <button class="btn btn-danger font-weight-bold mr-2 btn_submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$(document).ready(function() {
    $('.btn_submit').on('click', function() {
        var id = document.getElementById("id").value;
        var rate = $('input[name="rate"]:checked').val();
        var comment = document.getElementById("comment").value;
        var url = 'process/rating_function.php';

            $.post({
            url: url,
            data: {
                id:id,
                rate: rate,
                comment: comment,
            },
            success: function (result) {
                if(result.status == 1) {
                    swal({
                        icon: "success",
                        title: "Success",
                        text: result.msg,
                        timer: 1700,
                        buttons: false,
                    }).then(function(){
                    window.location.assign('done_order.php');
                    });
                }if(result.status == 2) {
                    swal({
                        icon: "warning",
                        title: "Submit Fail",
                        text: result.msg,
                        timer: 1700,
                        buttons: false,
                    });
                }
            }
        });
    });
});
</script>