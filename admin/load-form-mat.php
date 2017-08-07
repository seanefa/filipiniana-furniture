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

?>