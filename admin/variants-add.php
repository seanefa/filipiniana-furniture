<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$material = $_POST['material'];
//$remarks = $_POST['remarks'];
$status = "Active";
$desc1 = $_POST['attrib'];
$desc2 = $_POST['attrib1'];
$desc3 = $_POST['attrib2'];
$unit1 = $_POST['unid0'];
$unit2 = $_POST['unid1'];
$unit3 = $_POST['unid2'];
$flag = 0;

if( !empty($desc1) && empty($desc2) && empty($desc3)){
        foreach($desc1 as $a){
            $b = $a .' '. $unit1;
	        $sql = "INSERT INTO `tblmat_var` (`materialID`, `mat_varDescription`, `mat_varStatus`) VALUES ('$material', '$b','Active')";
	        mysqli_query($conn,$sql);
	        $flag++;
        }
}

if( empty($desc1) && !empty($desc2) && empty($desc3)){
        foreach($desc2 as $a){
            $b = $a .' '. $unit2;
	        $sql = "INSERT INTO `tblmat_var` (`materialID`, `mat_varDescription`, `mat_varStatus`) VALUES ('$material', '$b','Active')";
	        mysqli_query($conn,$sql);
	        $flag++;
        }
}

if( empty($desc1) && empty($desc2) && !empty($desc3)){
        foreach($desc3 as $a){
            $b = $a .' '. $unit3;
	        $sql = "INSERT INTO `tblmat_var` (`materialID`, `mat_varDescription`, `mat_varStatus`) VALUES ('$material', '$b','Active')";
	        mysqli_query($conn,$sql);
	        $flag++;
        }
}

if( !empty($desc1) && !empty($desc2) && empty($desc3)){
        foreach($desc1 as $a){
            $b = $a .' '. $unit1;
            foreach($desc2 as $z){
                $twovar = $b .' / '. $z;
                $twovarun = $twovar .' '. $unit2;
	            $sql = "INSERT INTO `tblmat_var` (`materialID`, `mat_varDescription`, `mat_varStatus`) VALUES ('$material', '$twovarun','Active')";
	            mysqli_query($conn,$sql);
	            $flag++;
            }
        }
}

if( !empty($desc1) && empty($desc2) && !empty($desc3)){
        foreach($desc1 as $a){
            $b = $a .' '. $unit1;
            foreach($desc3 as $z){
                $twovar = $b .' / '. $z;
                $twovarun = $twovar .' '. $unit3;
	            $sql = "INSERT INTO `tblmat_var` (`materialID`, `mat_varDescription`, `mat_varStatus`) VALUES ('$material', '$twovarun','Active')";
	            mysqli_query($conn,$sql);
	            $flag++;
            }
        }
}

if( empty($desc1) && !empty($desc2) && !empty($desc3)){
        foreach($desc2 as $a){
            $b = $a .' '. $unit2;
            foreach($desc3 as $z){
                $twovar = $b .' / '. $z;
                $twovarun = $twovar .' '. $unit3;
	            $sql = "INSERT INTO `tblmat_var` (`materialID`, `mat_varDescription`, `mat_varStatus`) VALUES ('$material', '$twovarun','Active')";
	            mysqli_query($conn,$sql);
	            $flag++;
            }
        }
}

if( !empty($desc1) && !empty($desc2) && !empty($desc3)){
        foreach($desc1 as $a){
            $b = $a .' '. $unit1;
            foreach($desc2 as $z){
                $twovar = $b .' / '. $z;
                $twovarun = $twovar .' '. $unit2;
                foreach($desc3 as $y){
                    $threevar = $twovarun .' / '. $y;
                    $threevarun = $threevar .' '. $unit3;
                    $sql = "INSERT INTO `tblmat_var` (`materialID`, `mat_varDescription`, `mat_varStatus`) VALUES ('$material', '$threevarun','Active')";
	                mysqli_query($conn,$sql);
	                $flag++;
                }
            }
        }
}


if ($flag>0) {
	// Logs start here
	$sID = $last_id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new material variant ".$material.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Material Variants', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: material-variants.php?newSuccess" );
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
mysqli_close($conn);
?>