<?php
include "dbconnect.php";

$id = $_POST["id"];
$recID = $_POST["record"];
$i = $_POST["arnum"];

if($recID==1){ 
 $id1=$id;
 $selectdata1 = "SELECT * FROM tblattribute_measure a, tblunitofmeasurement_category b WHERE a.attributeID='$id1' AND a.uncategoryID=b.uncategoryID;";
 $query1 = mysqli_query($conn,$selectdata1);
    $x = 0;
    while($row1=mysqli_fetch_assoc($query1)){
    $units[]='';
    $placeholder[]='';
	if($row1['uncategoryID']==0){
	    array_push($placeholder,$row1['uncategoryName']);
    }
	else{
        array_push($placeholder,$row1['uncategoryName']);
        array_push($units,$row1['uncategoryID']);
        $x = $x + 1;
		
	}
    }
    
    if($x!=0){
        foreach($placeholder as $b){
           echo (''.$b.' ');
        }
        echo('<br><br><select class="form-control" tabindex="1" name="unid'.$i.'" id="unid'.$i.'">');
		$sql1="SELECT * FROM tblunit_cat a, tblunitofmeasure b WHERE a.unitID=b.unID ";
        foreach ($units as $a){
            $sql2= $sql1 . "AND a.uncategoryID='$a'";
        }
        $sql3 = $sql2 . ";";
        $result1 = mysqli_query($conn, $sql3);
		while($row2 = mysqli_fetch_assoc($result1)){
			echo (
					'<option value='.$row2[unUnit].'>'.$row2[unUnit].'  ('.$row2[unType].')</option>'
					);
		}
					echo '</select><br>';
    }
    else {
        echo (''.$placeholder[1].' <input type="text" value="" class="form-control hide" name="unid'.$i.'" id="unid'.$i.'"/>');
    }
    
}