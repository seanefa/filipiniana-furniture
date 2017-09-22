<?php 
include "session-check.php";
include 'dbconnect.php';
session_start();
$name = $_POST['name'];
$type = $_POST['type'];
$str = $_POST['attribs'];
$des = $_POST['desc'];
$ucat = $_POST['uncID'];
$valu = $_POST['uvalue'];
$un = $_POST['unid'];
$acntr = $_POST['counter'];
$categorycnt = $_POST['categorycounter'];
$status = "Listed";
$flag = 0;

$name = mysqli_real_escape_string($conn,$name);
$type = mysqli_real_escape_string($conn,$type);
$str = mysqli_real_escape_string($conn,$str);
$des = mysqli_real_escape_string($conn,$des);
$ucat = mysqli_real_escape_string($conn,$ucat);
$valu = mysqli_real_escape_string($conn,$valu);
$un = mysqli_real_escape_string($conn,$un);
$acntr = mysqli_real_escape_string($conn,$acntr);
$categorycnt = mysqli_real_escape_string($conn,$categorycnt);


//$attribs = substr(trim($str), 0, -1);
//ATTRIBUTES SAVING
/*$sql = "SELECT * FROM tblattributes;";$res = mysqli_query($conn,$sql);
$cnt = 0;$temp = "";while($row = mysqli_fetch_assoc($res)){$temp = $temp . $row["attributeName"] . ",";}$cnt = 0;$temp = substr(trim($str), 0, -1);$temp1 = explode(",", $temps);foreach($str as $a){if($a!=$temp1[$ctr]){$cnt++;$sql1 = "INSERT INTO `tblattributes` (`attributeName`, `attributeStatus`) VALUES ('','Active');";echo $sql1;$ctr++;}
    }*/
/*if($cnt>0){$sql1 = "INSERT INTO `tblattributes` (`attributeName`, `attributeStatus`) VALUES ('', 'Active');"}*/
$sql = "INSERT INTO `tblmaterials` (`materialType`, `materialName`, `materialStatus`) VALUES ('$type', '$name','$status')";
mysqli_query($conn,$sql);
$flag++;
$last_id = mysqli_insert_id($conn);
echo $sql . "<br>";
/*$count = count($_POST['attribs']);
for($i=0;$i<$count;$i++){
    $aID = $str[$i];
    if($ucat[$i]=='0'){
        $varDes = $des[$i];
        $cnt = $acntr[$i];
        $sql = "INSERT INTO `tblmat_var` (`materialId`, `attributeID`, `mat_varDescription`,`attribCounter`,`mat_varStatus`) VALUES ('$last_id', '$aID','$varDes','$i','Active')";
        mysqli_query($conn,$sql);
        $flag++;
        echo $sql . "<br>";
    }
    else{
        for($y=0;$y<=$categorycnt;$y++){
            $catID = $ucat[$i][$y];
            $unitValue = $valu[$i][$y];
            $unitID = $un[$i][$y];
            $cnt = $acntr[$i];
            $sql = "INSERT INTO `tblmat_var` (`materialId`, `attributeID`, `uncategoryID`,`unitValue`,`unID`,`attribCounter`,`mat_varStatus`) VALUES ('$last_id', '$aID','$catID','$unitValue','$unitID','$i','Active')";
            mysqli_query($conn,$sql);
            $flag++;
            echo $sql . "<br>";
        }
    }
    
}*/
/*
$varsql="SELECT * FROM tblmat_var WHERE materialID='$last_id';";
$varresults=mysqli_query($conn, $varsql);
$atcounter=0;
while($varrow=mysqli_fetch_assoc($varresults)){
    $atcounter = $atcounter + 1;
}
for($z=0;$z<$atcounter;$z){
    
}*/
if ($flag>0) {
    // Logs start here
    $sID = $last_id; // ID of last input;
    $date = date("Y-m-d");
    $logDesc = "Added new material ".$name.", ID = " .$sID;
    $empID = $_SESSION['userID'];
    $logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Materials', 'New', '$date', '$logDesc', '$empID')";
    mysqli_query($conn,$logSQL);
    // Logs end here
    header( "Location: materials.php?newSuccess" );
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
mysqli_close($conn);
?>