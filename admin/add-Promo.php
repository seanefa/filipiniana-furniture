<?php

include 'dbconnect.php';

$name = $_POST['name'];
$desc = $_POST['desc'];
$pic = "";
$start = $_POST['start'];
$end = $_POST['end'];
$status = "Active";

if ($_FILES["image"]["error"] > 0)
{
 echo "Error: NO CHOSEN FILE";
 echo"INSERT TO DATABASE FAILED";
}
else
{
 move_uploaded_file($_FILES["image"]["tmp_name"],"plugins/images/promo" . $_FILES["image"]["name"]);
 echo "SAVED" ;
 $pic = $_FILES["image"]["name"];
}

$sql = "INSERT INTO `tblpromos` (`promoName`, `promoDescription`, `promoStartDate`, `promoImage`, `promoEnd`, `promoStatus`) VALUES('$name','$desc','$start','$pic','$end','$status')";
mysqli_query($conn,$sql);
//echo $sql . "<br>";

$promoID = mysqli_insert_id($conn);

$condition = $_POST['cat'];
$promo = $_POST['p_cat'];


if($condition=="Amount"){
	$con_rate = $_POST['con_rate'];
	$con_sql = "INSERT INTO tblpromo_condition(conPromoID,conCategory,conData) VALUES ('$promoID','$condition','$con_rate')";
	mysqli_query($conn,$con_sql);
	echo $con_sql . "<br>";
}
else if($condition=="Pieces"){
	$con_quan = $_POST['con_quan'];
	$con_sql = "INSERT INTO `tblpromo_condition`(`conPromoID`, `conCategory`,`conData`) VALUES ('$promoID','$condition','$con_quan')";
	mysqli_query($conn,$con_sql);
	echo $con_sql . "<br>";
}
else if($condition=="Others"){
	$con_desc = $_POST['con_desc'];
	$con_sql = "INSERT INTO tblpromo_condition(conPromoID,conCategory,conData) VALUES ('$promoID','$condition','$con_desc')";
	mysqli_query($conn,$con_sql);
	echo $con_sql . "<br>";
}

if($promo=="Amount"){
	$r_type = $_POST['type'];
	$rate = $_POST['pro_rate'];
	$data = $r_type . "," . $rate;
	$pro_sql = "INSERT INTO tblpromo_promotion(proPromoID,proCategory,proData) VALUES ('$promoID','$promo','$data')";
	mysqli_query($conn,$pro_sql);
	echo $pro_sql . "<br>";

}
else if($promo=="Pieces"){
	$data = $_POST['pro_quan'];
	$pro_sql = "INSERT INTO tblpromo_promotion(proPromoID,proCategory,proData) VALUES ('$promoID','$promo','$data')";
	mysqli_query($conn,$pro_sql);
	echo $pro_sql . "<br>";
}
else if($promo=="Others"){
	$data = $_POST['pro_desc'];
	$pro_sql = "INSERT INTO tblpromo_promotion(proPromoID,proCategory,proData) VALUES ('$promoID','$promo','$data')";
	mysqli_query($conn,$pro_sql);
	echo $pro_sql . "<br>";
}



header( "Location: promo.php?newSuccess" );

mysqli_close($conn);


?>