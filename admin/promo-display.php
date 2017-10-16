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
<div style="border:2px solid">
<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="white-box text-center"> 
    <img src="plugins/promos/'.$row['promoImage'].'" height="300px" width="580px" alt="Unavailable" class="img-responsive"> 
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center;">
        <h4 class="box-title">Free Product</h4>
        
        <p>
    <img src="plugins/images/'.$srow['prodMainPic'].'" height="112px" width="120px" alt="Unavailable" class="img-responsive">'.$srow['productName'].'</p>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center;">
        <h4 class="box-title">Description</h4>
        <p>'. $row['promoDescription'].'</p>
    </div>
</div>

</div>
</div>';
?>

