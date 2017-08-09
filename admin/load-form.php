<?php
include "dbconnect.php";

$id = $_POST["id"];
$recID = $_POST["record"];

if($recID=="material"){  
$selectdata = "SELECT * FROM tblmat_type WHERE matTypeID = '$id';"; 
$query = mysqli_query($conn,$selectdata);
$row = mysqli_fetch_assoc($query);
$typeID = $row['matTypeMeasure'];
$typeName = explode(",", $typeID);
echo '<div class="row">
              <div class="col-md-5">
                  <div class="form-group">
                    <label class="control-label">Name</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Measurement</label><span id="x" style="color:red"> *</span>
                  </div>
                </div>
                
                <div class="col-md-3">
                    <label class="control-label">Unit</label><span id="x" style="color:red">
                    <select class="form-control"  data-placeholder="Select Material Category" tabindex="1" name="unit">';
                      $sql = "SELECT * FROM tblunitofmeasure;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['unStatus']!='Archived'){
                          echo('<option value='.$row['unID'].'>'.$row['unUnit'].'</option>');
                        }
                      }
                    echo '</select> 
                </div>
              </div>';

foreach($typeName as $a){
        echo '<div class="row">
              <div class="col-md-5">
                  <div class="form-group">
                    <input type="text" id="username" class="form-control" name="na" required style="border:0px;" value="'.$a.'"/> 
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" id="username" class="form-control" name="measure[]" required style="text-align:right;"/><span id="message"></span> 
                  </div>
                </div>
              </div>';

}
}

if($recID==0){ //new
	//$selectdata = "SELECT * FROM tblmaterials WHERE materialID = '$id'";
  $selectdata = "SELECT * FROM tblmaterials a, tblmat_attribs b, tblattributes c WHERE b.matID = a.materialID AND b.attribID = c.attributeID AND a.materialID = '$id';"; 

$query = mysqli_query($conn,$selectdata);

while($row = mysqli_fetch_array($query))
{
 /*$id1=$row['attributeID'];
 $selectdata1 = "SELECT * FROM tblattribute_measure a,  tblunit_cat c WHERE a.attributeID='$id1' AND a.uncategoryID=c.uncategoryID;"; 
 $query1 = mysqli_query($conn,$selectdata1);
 $row1 = mysqli_fetch_assoc($query1);
 
 $id1=$row['attributeID'];
 $selectdata1 = "SELECT * FROM tblattribute_measure a, tblunitofmeasurement_category b WHERE a.attributeID='$id1' AND a.uncategoryID=b.uncategoryID;";
 $query1 = mysqli_query($conn,$selectdata1);
 $row1 = mysqli_fetch_assoc($query1);
	
 if($row1['uncategoryID']==0){
 */
	$id1=$row['attributeID'];
 $selectdata1 = "SELECT * FROM tblattribute_measure a, tblunitofmeasurement_category b WHERE a.attributeID='$id1' AND a.uncategoryID=b.uncategoryID;";
 $query1 = mysqli_query($conn,$selectdata1);
while($row1=mysqli_fetch_assoc($query1)){
	if($row1['uncategoryID']==0){
	 echo '<div class="col-md-6">
        <div class="row">
        <label class="box-title">'. $row['attributeName'] .'</label><span id="x" style="color:red"> *</span>
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="text" id="attribb" class="form-control" name="desc[]" required>
                    <input type="hidden" class="form-control" name="label[]" value="'.$row['attributeName'].'"/>
                  </div>
                </div>
                </div>
              </div>';
    }
	else{
		
			echo '<div class="col-md-12">
        <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
				  <label class="box-title">'. $row1['uncategoryName'] .'</label><span id="x" style="color:red"> *</span>
                    <input type="number" id="attribb" class="form-control" name="desc[]" required>
                    <input type="hidden" class="form-control" name="label[]" value="'.$row['attributeName'].'"/><br><select class="form-control" tabindex="1" required>';
		$units=$row1['uncategoryID'];
		$sql1="SELECT * FROM tblunit_cat a, tblunitofmeasure b WHERE a.uncategoryID='$units' AND a.unitID=b.unID;";
		$result1 = mysqli_query($conn, $sql1);
		while($row2 = mysqli_fetch_assoc($result1)){
			echo (
					'<option value='.$row2[unUnit].'>'.$row2[unUnit].'  ('.$row2[unType].')</option>'
					);
		}
					echo '</select>
                  </div>
                </div>
                </div>
              </div>';
		
	
	}
}
 
 	}
	
	/*
	else{
		while($row1){
			if($row1['uncategoryStatus']=="Active"){
				echo '<div class="col-md-6">
        <div class="row">
        <label class="box-title">'. $row['attributeName'] .'</label><span id="x" style="color:red"> *</span>
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="text" id="attribb" class="form-control" name="desc[]" required>
					<select>
					
					<option></option>
					</select>
                    <input type="hidden" class="form-control" name="label[]" value="'.$row['attributeName'].'"/>
                  </div>
                </div>
                </div>
              </div>';
			}
			
		}
		
	}
	*/
   }


else{ //update

$selectdata = "SELECT * FROM tblmaterials a, tblmat_attribs b, tblattributes c WHERE b.matID = a.materialID AND b.attribID = c.attributeID AND a.materialID = '$id';"; 

$query = mysqli_query($conn,$selectdata);

$sql = "SELECT * FROM tblvariant_desc a, tblmat_var b WHERE b.variantID = a.varMatvarID AND a.varMatvarID = '$recID'";
$res = mysqli_query($conn,$sql);
$labels = "";

while($row = mysqli_fetch_array($res)){
  $labels = $labels . $row['varVariantDesc'] . ",";
}

$cnt = 0;
$labelsArr = explode(",",$labels);

while($row = mysqli_fetch_array($query))
{
 echo '<div class="col-md-6">
        <div class="row">
          <label class="box-title">'. $row['attributeName'] .'</label><span id="x" style="color:red"> *</span>
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="text" id="attribb" class="form-control" name="desc[]" value="'.$labelsArr[$cnt].'"/>
                    <input type="hidden" class="form-control" name="label[]" value="'.$row['attributeName'].'"/>
                  </div>
                </div>
              </div>
                </div>';
              $cnt++;
            }
         }

?>