<?php
include "dbconnect.php";
$id = $_POST['id'];

$sql = "SELECT * FROM tblorders WHERE orderID = '$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$delAdd = $row['shippingAddress'];

echo '<div class="col-md-6">
<div class="form-group">
<b>Delivery Location</b><span id="x" style="color:red"> *</span>
<select class="form-control" data-placeholder="Select Location" tabindex="1" name="location" id="location">
<option value="">Select Location</option>';

$delsql = "SELECT * FROM tbldelivery_rates ORDER BY delLocation;";
$delresult = mysqli_query($conn,$delsql);
while($delrow = mysqli_fetch_assoc($delresult)){
  echo('<option value="'.$delrow['delRate'].'">'.$delrow['delLocation'].'</option>');
}

echo '</select>
</div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <b>Delivery Rate</b>
    <input type="text" id="delRate" class="form-control" style="text-align:right;" name="delRate" value="" readonly>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label class="control-label">Delivery Address</label><span id="x" style="color:red"> *</span>
      <textarea name="delAdd" class="form-control" id="delAdd">'.$delAdd.'</textarea>
      <br>
    </div>
  </div>
</div>';
?>