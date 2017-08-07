<?php

include 'dbconnect.php';

$id = $_POST['recID'];
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

$sql = "UPDATE `tblpromos` SET `promoName`='$name', `promoDescription`='$desc', `promoStartDate`='$start', `promoEnd`='$end', `promoImage`='$pic' WHERE `promoID`='$id';";
//mysqli_query($conn,$sql);
echo $sql . "<br>";

//$promoID = mysqli_insert_id($conn);

$condition = $_POST['cat'];
$promo = $_POST['p_cat'];


if($condition=="Amount"){
	$data = $_POST['con_rate'];
	$con_sql = "UPDATE `tblpromo_condition` SET `conCategory`='$condition', `conData`='$data' WHERE `conditionID`='$id';";
	//mysqli_query($conn,$con_sql);
	echo $con_sql . "<br>";
}
else if($condition=="Pieces"){
	$data = $_POST['con_quan'];
	$con_sql = "UPDATE `tblpromo_condition` SET `conCategory`='$condition', `conData`='$ata' WHERE `conditionID`='$id';";
	//mysqli_query($conn,$con_sql);
	echo $con_sql . "<br>";
}
else if($condition=="Others"){
	$data = $_POST['con_desc'];
	$con_sql = "UPDATE `tblpromo_condition` SET `conCategory`='$condition', `conData`='$ata' WHERE `conditionID`='$id';";
	//mysqli_query($conn,$con_sql);
	echo $con_sql . "<br>";
}

if($promo=="Amount"){
	$r_type = $_POST['type'];
	$rate = $_POST['pro_rate'];
	$data = $r_type . "," . $rate;
	$pro_sql = "UPDATE `tblpromo_promotion` SET `proCategory`='$promo', `proData`='$data' WHERE `proPromoID`='$id';";
	//mysqli_query($conn,$pro_sql);
	echo $pro_sql . "<br>";

}
else if($promo=="Pieces"){
	$data = $_POST['pro_quan'];
	$pro_sql = "UPDATE `tblpromo_promotion` SET `proCategory`='$promo', `proData`='$data' WHERE `proPromoID`='$id';";
	//mysqli_query($conn,$pro_sql);
	echo $pro_sql . "<br>";
}
else if($promo=="Others"){
	$data = $_POST['pro_desc'];
	$pro_sql = "UPDATE `tblpromo_promotion` SET `proCategory`='$promo', `proData`='$data' WHERE `proPromoID`='$id';";
	//mysqli_query($conn,$pro_sql);
	echo $pro_sql . "<br>";
}



//header( "Location: promo.php?newSuccess" );

mysqli_close($conn);


?>