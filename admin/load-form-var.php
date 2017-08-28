<?php
include "dbconnect.php";

$id = $_POST["id"];
$recID = $_POST["record"];
$i = $_POST["arnum"];

if($recID==1){ 
 $id1=$id;
 $selectdata1 = "SELECT * FROM tblattribute_measure a, tblunitofmeasurement_category b WHERE a.attributeID='$id1' AND a.uncategoryID=b.uncategoryID;";
 $query1 = mysqli_query($conn,$selectdata1);
    while($row1=mysqli_fetch_assoc($query1)){
	if($row1['uncategoryID']==0){
	 echo '<input type="text" id="attribb" class="form-control" name="desc['.$i.']" required><input type="number" id="attribb" class="form-control hide" name="uncID['.$i.']" value="'.$row1['uncategoryID'].'"><br>';
    }
	else{
		
			echo '<input type="number" id="attribb" class="form-control" name="uvalue['.$i.']" placeholder="'.$row1['uncategoryName'].'" required><input type="number" id="attribb" class="form-control hide" name="uncID['.$i.']" value="'.$row1['uncategoryID'].'"><br><select class="form-control" tabindex="1" name="unid['.$i.']" id="unid" required>';
		$units=$row1['uncategoryID'];
		$sql1="SELECT * FROM tblunit_cat a, tblunitofmeasure b WHERE a.uncategoryID='$units' AND a.unitID=b.unID;";
		$result1 = mysqli_query($conn, $sql1);
		while($row2 = mysqli_fetch_assoc($result1)){
			echo (
					'<option value='.$row2[unID].'>'.$row2[unUnit].'  ('.$row2[unType].')</option>'
					);
		}
					echo '</select><br>';
		
	
	}
    }
}