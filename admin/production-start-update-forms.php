<?php
include "menu.php";
include 'dbconnect.php';
session_start();


if(isset($_GET['id'])){
 $jsID = $_GET['id']; 
}

if(isset($_GET['pID'])){
$pID = $_GET['pID'];
}

if(isset($_GET['oID'])){
$oID = $_GET['oID'];
}

$jsID = $_GET['id']; 
$oID = $_GET['oID'];
$pr = $_GET['smth'];


$_SESSION['varname'] = $jsID;

?>
<!DOCTYPE>
<html>
<head>
</head>
<body>

<div class="modal fade" tabindex="-1" role="dialog" id="newProductionTrackingModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="startproduction">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">Start Production</h3>
      </div>
      <form action="start-prod-phase.php" method = "post">
        <input type="hidden" name="orderID" value="<?php echo $jsID?>">
        <input type="hidden" name="phaseID" value="<?php echo $pID?>">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">
               <div class="row">
              <div class="col-md-12">
              <label class="control-label">Date Started: </label>
                <div class="col-md-10 pull-right">
                  <input type="date" id="dateStart" name ="dateStart" class="form-control" required/> 
                </div>
              </div> 
                </div>
                <br>
                <div class="row">
              <div class="col-md-12">
              <label class="control-label">Handler: </label>
                <div class="col-md-10 pull-right">
                  <select class="form-control" data-placeholder="Select Employee Handler" tabindex="1" name="handler" id="handler">
                      <option value="">Select Employee Handler</option>
                      <?php
                      include "dbconnect.php";
                      $sql = "SELECT * FROM tblemployee order by empFirstName;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['empStatus']!='Archived'){
                          echo('<option value='.$row['empID'].'>'.$row['empFirstName'].' '.$row['empMidName'].' '.$row['empLastName'].'</option>');
                        }
                      }
                      ?>
                    </select>
                </div>
              </div> 
                </div>
                <br>
                <div class="row">
              <div class="col-md-12">
              <label class="control-label">Remarks: </label>
                <div class="col-md-10 pull-right">
                  <textarea rows="4" id="remarks" name ="remarks" class="form-control"> </textarea>
                </div>
              </div> 
                </div>
            </div>
          </div>
        </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success waves-effect text-left" id="addFab"><i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
          </div>                
        </form>
      </div>
    </div>

  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="newProductionTrackingModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="updateproduction">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">Update Production</h3>
      </div>
      <form action="" method = "post">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">
               <div class="row">
              <div class="col-md-12">
              <label class="control-label">Date Finished: </label>
                <div class="col-md-9 pull-right">
                  <input type="date" id="" name ="" class="form-control" required /> 
                </div>
              </div> 
                </div>
                <br>
                <div class="row">
              <div class="col-md-12">
              <label class="control-label">Remarks: </label>
                <div class="col-md-10 pull-right">
                  <textarea rows="4" id="" name ="" class="form-control"> </textarea>
                </div>
              </div> 
                </div>
            </div>
          </div>
        </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success waves-effect text-left" id="addFab" disabled=""><i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
          </div>                
        </form>
      </div>
    </div>

  </div>


</body>
</html>