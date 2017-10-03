<?php
include "dbconnect.php"; 
$mat = $_POST["mat"];
$name = $_POST["name"];	
$variant = $_POST["variant"];	
$quan = $_POST["quan"];
$sql1 = "SELECT * FROM tblmat_type WHERE matTypeID = '$mat';";
$result1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_array($result1);
$matType = $row1['matTypeName'];
$sql2 = "SELECT * FROM tblmaterials WHERE materialID = '$name';";
$result2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($result2);
$matName = $row2['materialName'];
$sql3 = "SELECT * FROM tblmat_var WHERE mat_varID = '$variant';";
$result3 = mysqli_query($conn,$sql3);
$row3 = mysqli_fetch_array($result3);
$matVar = $row3['mat_varDescription'];
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
echo "<tr id='trowID' class='materialNeed'>
      <td>
      <p>". $matType ."</p>
      <input type='hidden' class='form-control' id='mattype' name='mattype[]' value='". $matType ."'/>
      </td>
      <td>
      <p >". $matName ."</p>
      <input type='hidden' class='form-control' id='matname' name='matname[]' value='". $matName ."' />
      </td>
      <td>
      <p >". $matVar ."</p>
      <input type='hidden' class='form-control' id='matvar' name='matvar[]' value='". $matVar ."' />
      <input type='hidden' class='form-control' id='matvar' name='matvarid[]' value='". $variant ."' />
      <input type='hidden' class='form-control' id='matdesc' name='matdesc[]' value='". $matName ." - ". $matVar ."' />
      </td>
      <td>
      <input type='text' class='col-lg-4' maxlength='5' size='5' id='matquan' style='text-align:right;' name='matquan[]' value='". $quan ."'/>
      </td>";
      echo '<td><input id="removeBtn" type="button" onclick="deleteRow(this)" class="btn btn-danger" value="X"/></td></tr>'
?>