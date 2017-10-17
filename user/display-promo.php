<?php
include "userconnect.php";

$array = $_POST['id'];

foreach ($array as $promo) {
	# code...

$sql = "SELECT * FROM tblprodsonpromo where prodPromoID = '$promo' and onPromoStatus ='Active'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);

$promoID = $row['promoDescID'];

$prsql = "SELECT * FROM tblpromos where promoID = '$promoID' and promoStatus = 'Active'";
$prres = mysqli_query($conn,$prsql);
$prrow = mysqli_fetch_assoc($prres);

$prodID = $prrow['tblproductID'];

if(mysqli_num_rows($res) != 0){
	$sql1 = "SELECT * FROM tblproduct where productID = '$prodID'";
$res1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_assoc($res1);
	echo '<tr id="'.$row1['productID'].'"><td class="text-center"><img src="../admin/plugins/images/'.$row1['prodMainPic'].'" style="height: 100px; width: 105px;" alt="Product" title="'.$row1['productName'].'" class="img-thumbnail"></td><td class="text-left">'.$row1['productName'].'</td><td><span style="color: green;">FREE:</span>  '.$prrow['promoDescription'].'</td><td style="text-align: right;"><span style="color: green;">FREE(1)</span></td></div><td style="text-align: right;"><span style="color: green;">FREE</span> <input type="hidden" name="cart[]" value='.$row1['productID'].'Promo/><input type="hidden" name="prices[]" value="0"/><input type="hidden" name="quant[]" value="1"/></td></tr>

		';
	
	}else{
		echo 'oke';
	}
}


?>