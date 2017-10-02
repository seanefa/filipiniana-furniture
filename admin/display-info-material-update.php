<?php
include "dbconnect.php";

$id = $_POST['id'];
$prod = $_POST['pr'];
$ctr = 0;
$sql = "SELECT * FROM tblprod_materials a, tblprod_info b, tblmaterials c, tblmat_var d, tblmat_type e WHERE a.p_prodInfoID = b.prodInfoID and a.p_matDescID = d.mat_varID and d.materialID = c.materialID and e.matTypeID = c.materialType and b.prodInfoProduct = '$prod' and b.prodInfoPhase = '$id'";
$res = mysqli_query($conn,$sql);
$count = mysqli_num_rows($res);
while($row = mysqli_fetch_assoc($res)){
	echo '<tr>
	<td>'.$row['matTypeName'].'</td>
	<td>'.$row['mat_varDescription'].'/ '.$row['materialName'].'</td>
	<td>'.$row['p_matQuantity'].'</td>
	</tr>';
	$ctr++;
}
if($ctr==0){
	echo "<tr><td colspan='3' style='text-align:center'><p>No available data as of the moment</p></td></tr>";
}


?>