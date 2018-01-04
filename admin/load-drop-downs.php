<?php
include "dbconnect.php";

$id = $_POST["id"];
$type = $_POST["type"];	

if($type==1){
  $ctr = 0;
  $sql = "SELECT * FROM tblfurn_type WHERE typeCategoryID = '$id' ORDER BY typeName ASC";
  $res = mysqli_query($conn,$sql);
      echo('<option value="">Select A Type</option>');
  while($row = mysqli_fetch_assoc($res)){
    if($row['typeStatus']=='Listed'){
      echo('<option value='.$row['typeID'].'>'.$row['typeName'].'</option>');
    }
    $ctr++;
  }
  if($ctr==0){
      echo('<option value="0" disabled>Nothing to show</option>');
  }
}
else if($type==2){
  $ctr = 0;
  $sql = "SELECT * FROM tblproduct WHERE prodTypeID = '$id' ORDER BY productName ASC";
  $res = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($res)){

    if($row['prodStat']!='Archived'){
      echo('<option value='.$row['productID'].'>'.$row['productName'].'</option>');
    }
    $ctr++;
  }
  if($ctr==0){
      echo('<option value="0" disabled>Nothing to show</option>');
  }
}
else if($type==3){
  $ctr = 0;
//$sql = "SELECT * FROM tblmaterials b,    tblmat_var a WHERE mat_varID = '$id'";
 $sql = "SELECT * FROM tblmat_var a, tblmaterials b, tblmat_type c WHERE c.matTypeID = b.materialType and a.materialID = b.materialID and b.materialType = '$id'";
 $result = mysqli_query($conn, $sql);
 while ($row = mysqli_fetch_assoc($result))
 {
  if($row['mat_varStatus']=='Active'){
    echo('<option value='.$row['mat_varID'].'>'.$row['mat_varDescription']. '/ ' . $row['materialName']. '</option>');
    $ctr++;
  }
}
if($ctr==0){    
  echo('<option value=0 disabled>Nothing to show.</option>');
}
}
else if($type==4){
  $sql = "SELECT * FROM tbldesign_phase a, tblphases b, tblproduct c WHERE a.p_design = c.prodDesign and b.phaseID = a.d_phase and d_phaseStatus != 'Archived' and c.productID = '$id'";
  $result = mysqli_query($conn, $sql);
  $ctr=0;
  $pID = "";
  $break=0;
  echo '<ul class="nav nav-tabs">';
  while ($row = mysqli_fetch_assoc($result))
  {
    echo '<li><a href="#tab'.$row['phaseID'].'" data-toggle="tab" disable>'.$row['phaseName'].'</a></li>';
    $ctr++;
    $pID = $pID . $row['phaseID'] . "," ;
  }
  echo '</ul>';
  echo '<div class="tab-content">';

  $pID = substr(trim($pID), 0, -1);
  $phases = explode(",", $pID);

  foreach($phases as $a){
    echo '<div class="tab-pane active" id="tab'.$a.'">
    <p>'.$a. ',  PID:'. $pID.'</p>
    </div>';
  }
  echo '</div>';

  echo '<div class="row">
  <div role="tabpanel" class="tab-pane fade active in" id="job">
  <div class="panel-wrapper collapse in" aria-expanded="true">
  <div class="panel-body">
  <div class="row">
  <div class="table-responsive">
  <label class="control-label">Materials Needed</label><span id="x" style="color:red"> *</span>
  <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="selectedMaterials">
  <thead>
  <tr>
  <th style="text-align: left;">Material</th>
  <th style="text-align: left;">Description</th>
  <th style="text-align: left;">Quantity</th>
  <th style="text-align: left;">Action</th>                          
  </thead>
  <tbody  id="tblMat" style="text-align: left;">

  </tbody>
  </table>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>';
}

else if($type==5){
echo "<option value=''>Choose a material name / brand</option>";
//$sql = "SELECT * FROM tblmaterials b,    tblmat_var a WHERE mat_varID = '$id'";
 $sql = "SELECT * FROM tblmaterials WHERE materialType = '$id'";
 $result = mysqli_query($conn, $sql);
 while ($row = mysqli_fetch_assoc($result))
 {
  if($row['materialStatus']=='Listed'){
    echo('<option value='.$row['materialID'].'>'.$row['materialName'].'</option>');
  }
}
}

else if($type==6){
echo "<option value=''>Choose a material variant</option>";
//$sql = "SELECT * FROM tblmaterials b,    tblmat_var a WHERE mat_varID = '$id'";
 $sql = "SELECT * FROM tblmat_var WHERE materialID = '$id'";
 $result = mysqli_query($conn, $sql);
 while ($row = mysqli_fetch_assoc($result))
 {
  if($row['mat_varStatus']=='Active'){
    echo('<option value='.$row['mat_varID'].'>'.$row['mat_varDescription'].'</option>');
  }
}
}
else if($type==7){
echo "<option value=''>Select Framework</option>";
 $sql = "SELECT * FROM tblframeworks WHERE frameworkFurnType = '$id' order by frameworkName;";
 $result = mysqli_query($conn, $sql);
 while ($row = mysqli_fetch_assoc($result))
 {
   if($row['frameworkStatus']=='Listed'){
     echo('<option value='.$row['frameworkID'].'>'.$row['frameworkName'].'</option>');
   }
 }
}

function desc($iid){
  include "dbconnect.php";
  $sql = "SELECT * FROM tblvariant_desc a, tblmat_var b WHERE b.variantID = a.varMatvarID AND a.varMatvarID = '$iid'";
  $result = mysqli_query($conn,$sql);
  $desc = "";
  while($row = mysqli_fetch_assoc($result)){
    $desc = $desc . $row['varVariantDesc'] . "-";
  }
  $temp = substr(trim($desc), 0, -1);
  return $temp;
}
/*
if($recID==0){ //new
	//$selectdata = "SELECT * FROM tblmaterials WHERE materialID = '$id'";
  $selectdata = "SELECT * FROM tblmaterials a, tblmat_attribs b, tblattributes c WHERE b.matID = a.materialID AND b.attribID = c.attributeID AND a.materialID = '$id';"; 

$query = mysqli_query($conn,$selectdata);

while($row = mysqli_fetch_array($query))
{
 echo '<label class="box-title">'. $row['attributeName'] .'</label><span id="x" style="color:red"> *</span>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="desc[]"/>
                    <input type="hidden" class="form-control" name="label[]" value="'.$row['attributeName'].'"/>
                  </div>
                </div>
              </div>';
            }
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
 echo '<label class="box-title">'. $row['attributeName'] .'</label><span id="x" style="color:red"> *</span>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="desc[]" value="'.$labelsArr[$cnt].'"/>
                    <input type="hidden" class="form-control" name="label[]" value="'.$row['attributeName'].'"/>
                  </div>
                </div>
              </div>';
              $cnt++;
            }
          }*/

          ?>