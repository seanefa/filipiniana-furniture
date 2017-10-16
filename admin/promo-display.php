<?php
include "dbconnect.php";
$id = $_POST['id'];
$rsql = "SELECT * FROM tblpromos WHERE promoID = $id";
$rresult = mysqli_query($conn,$rsql);
$row = mysqli_fetch_assoc($rresult);

$rid = $row['tblproductID'];

$ssql = "SELECT * FROM tblproduct WHERE productID = '$rid'";
$sresult = mysqli_query($conn,$ssql);
$srow = mysqli_fetch_assoc($sresult);


echo '
<div style="border:1px solid">
<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="white-box text-center"> 
    <img src="plugins/promos/'.$row['promoImage'].'" height="250px" width="580px" alt="Unavailable" class="img-responsive"> 
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h3 class="box-title" style="text-align: center; margin-top:-20px;">Free Product</h3>
    <img class="col-md-6 col-md-offset-3" src="plugins/images/'.$srow['prodMainPic'].'" height="200px" width="135px" alt="Unavailable" class="img-responsive" style="margin-top:-8px;">
    </div>
        <h4 style="text-align: center; margin-top:12px;">'.$srow['productName'].'</h4>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center;">
        <h3 class="box-title">Description</h3>
        <h4>'. $row['promoDescription'].'</h4>
    </div>
</div>

</div>
</div>';
?>

