<?php
include "dbconnect.php";

$mat = $_POST["mat"];
$desc = $_POST["desc"];	
$quan = $_POST["quan"];
$unit = $_POST["un"];

$un = "SELECT * FROM tblunitofmeasure WHERE unID = '$unit'";
$res = mysqli_query($conn,$un);
$un = mysqli_fetch_assoc($res);
$unitOf = $un['unUnit'];

$sql1 = "SELECT * FROM tblmat_type WHERE matTypeID = '$mat'";
$result1 = mysqli_query($conn,$sql1);
$row = mysqli_fetch_array($result1);
$matName = $row['matTypeName'];

//$sql1 = "SELECT * FROM tblmat_var WHERE variantID = '$desc'";
$sql2 = "SELECT * FROM tblmat_var a, tblmaterials b WHERE a.mat_varID = b.materialID and a.variantID = '$desc'";
$result2 = mysqli_query($conn,$sql2);
$rrow = mysqli_fetch_array($result2);
  $desc = desc($rrow['variantID']);
  $descName =  $desc. '-' . $rrow['materialName']. '-' . $row['matTypeName'];

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

//<input type='hidden' class='form-control' name='quan[]' value='". $quan ."'/>
echo "<tr id='trowID'>
      <td>
      <p>". $matName ."</p>
      <input type='hidden' class='form-control' id='mate' name='mate[]' value='". $mat ."'/></td>
      <td>
      <p >". $descName ."</p>
      <input type='hidden' class='form-control' id='var' name='mat_var[]' value='". $desc ."' /></td>
      <td><input type='text' class='col-lg-4' maxlength='5' size='5' id='quan' style='text-align:right;' name='quan[]' value='". $quan ."'/>
      </td>
      <td>".$unitOf."<input type='hidden' class='form-control' id='quan' style='text-align:right;' name='unit[]' value='". $unit ."'/>
      </td>";
      echo '<td><input id="removeBtn" type="button" onclick="deleteRow(this)" class="btn btn-danger" value="X"/></td></tr>'

?>