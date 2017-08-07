<?php
include "dbconnect.php";

$id = $_POST['id'];
$prod = $_POST['pr'];

$sql = "SELECT * FROM tblprod_info pi, tblprod_materials a, tblmaterials b, tblmat_var c, tblmat_type d, tblunitofmeasure e WHERE pi.prodInfoID = a.p_prodInfoID AND a.p_matMaterialID = b.materialID and a.p_matDescID = c.variantID and pi.prodInfoProduct = '$prod' and a.p_matUnit = e.unID and b.materialType = d.matTypeID and pi.prodInfoPhase = '$id'";
$res = mysqli_query($conn,$sql);
$count = mysqli_num_rows($res);
if($count>0){

while($row = mysqli_fetch_assoc($res)){
$descName = desc($row['variantID']);
echo '<tr>
		<td>'.$row['matTypeName'].'</td>
		<td>'.$descName.'-'.$row['materialName'].'</td>
		<td>'.$row['p_matQuantity'].'</td>
		<td>'.$row['unUnit'].'</td>
		</tr>';
}
}
else{
	echo "<tr colspan='2'><td><p>No available data as of the moment</p><td><tr>";
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

?>