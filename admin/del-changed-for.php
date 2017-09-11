<?php
include "dbconnect.php";
$id = $_POST['id'];
$orderID = $_POST['oID'];

$sql = "SELECT * FROM tblorders WHERE orderID = '$orderID'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$delAdd = $row['shippingAddress'];
$relDate = $row['dateOfRelease'];
$date = date_create($relDate);
$relDate = date_format($date,"F d, Y");


echo '<div class="row"><h4><b>Estimated Release Date: </b> '.$relDate.'</h4></div><br>';
if($id==2){

  echo '<div class="row">
                              <div class="col-md-6 col-md-offset-3" style="text-align: center;">
                                <div class="form-group">
                                  <h4><b>For: </b>
                                    <label class="radio-inline"><input type="radio" id="pick" name="relType" value="Pick-up" /> Pick-up</label>
                                    <label class="radio-inline"><input type="radio" id="del" name="relType" value="Delivery" checked/> Delivery</label></h4></div>
                                  </div>
                                </div>';
  echo '
  <div class="col-md-6" style="margin-top:"-10px;">
  <div class="row">
  <div class="form-group">
  <label class="control-label">Delivery Location</label><span id="x" style="color:red"> *</span>
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
  </div>
  <div class="col-md-5 pull-right">
  <div class="row">
  <div class="form-group">
  <label class="control-label">Delivery Rate</label>
  <input type="text" id="delRate" class="form-control" style="text-align:right;" name="delRate" value="">
  </div>
  </div>
  </div>
  <div class="row">
  <div class="col-md-12">
  <div class="form-group">
  <label class="control-label">Delivery Address</label><span id="x" style="color:red"> *</span>
  <textarea name="delAdd" class="form-control" id="delAdd">'.$delAdd.'</textarea>
  <br>
  </div>
  </div>
  </div>';
  echo'
  <div class="row">
  <div class="col-md-12">
  <div class="form-group">
  <label class="control-label" style="color: white;">Delivery Man</label><span id="x" style="color:red"> *</span>
  <select class="form-control" data-placeholder="Select Delivery Man" tabindex="1" name="emp">';
  $sql = "SELECT * FROM tblemployee ORDER BY empFirstName";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result))
  {
    if($row['empStatus']=='Active'){
      echo('<option value='.$row['empID'].'>'.$row['empFirstName'].' '.$row['empMidName'].' '.$row['empLastName'].'</option>');
    }
  }
  echo '</select>
  </div>
  </div>
  </div>';
$date = new DateTime();
$date = date_format($date, "Y-m-d");
echo '<div class="row">
      <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" style="color: white;">Release Date</label><span id="x" style="color:red"> *</span>
            <input type="date" id="delDate" class="form-control" name="delDate" value="'. $date.'"/> 
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
          <div class="form-group">
            <label class="control-label" style="color: white;">Remarks</label>
            <textarea name="remarks" class="form-control"></textarea>
            <br>
        </div>
      </div>
    </div>';
}
else{ //if pick up
$date = new DateTime();
$date = date_format($date, "Y-m-d");
echo '<div class="row">
                              <div class="col-md-6 col-md-offset-3" style="text-align: center;">
                                <div class="form-group">
                                  <h4><b>For: </b>
                                    <label class="radio-inline"><input type="radio" id="pick" name="relType" value="Pick-up" checked/> Pick-up</label>
                                    <label class="radio-inline"><input type="radio" id="del" name="relType" value="Delivery" /> Delivery</label></h4></div>
                                  </div>
                                </div>';
echo '<div class="row">
      <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" style="color: white;">Release Date</label><span id="x" style="color:red"> *</span>
            <input type="date" id="delDate" class="form-control" name="delDate" value="'. $date.'"/> 
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
          <div class="form-group">
            <label class="control-label" style="color: white;">Remarks</label>
            <textarea name="remarks" class="form-control"></textarea>
            <br>
        </div>
      </div>
    </div>';

}
?>