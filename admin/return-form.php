<?php
include "menu.php";
include 'dbconnect.php';
session_start();
if(isset($_GET['id'])){
  $jsID = $_GET['id']; 
}
if(isset($_GET['smth'])){
  $pr = $_GET['smth'];
}
if(isset($_GET['oID'])){
  $oID = $_GET['oID'];
}
$jsID = $_GET['id'];
?>
<!DOCTYPE>
<html>
<head>
</head>
<body>
  <!-- New -->
  <div class="modal fade" tabindex="-1" role="dialog" id="updateModeofPaymentModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="update">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Update Return Information</h3>
        </div>
        <form action="update-return.php" method="post">
          <input type="hidden" name="recID" value="<?php echo $jsID?>">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <?php
                include "dbconnect.php";
                $sql = "SELECT * FROM tblorder_return WHERE returnID = '$jsID'";
                $res = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($res);
                $reason = $row['returnReason'];
                $assessment = $row['returnAssessment'];
                $date = $row['estDateReleased'];
                $remarks = $row['returnRemarks'];
                // $date = date_create($row['estDateReleased']);
                // $date = date_format($date,"mm-dd-yyyy");
                ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <h5 class="control-label" style="text-align: left;">Reason</h5>
                      <textarea name="reasons" class="form-control" rows="4"><?php echo $reason?></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <h4><b>   Assessment  </b>
                        <?php
                        if($assessment=="Replace"){
                          echo '<label class="radio-inline"><input type="radio" id="replace" name="assessment" value="Replace" checked/>  Replace</label>';
                          echo '<label class="radio-inline"><input type="radio" id="repair" name="assessment" value="Repair"/>   Repair</label>';
                        }
                        else{
                          echo '<label class="radio-inline"><input type="radio" id="replace" name="assessment" value="Replace"/>  Replace</label>';
                          echo '<label class="radio-inline"><input type="radio" id="repair" name="assessment" value="Repair" checked/>   Repair</label>';
                        }
                        ?>
                      </h4>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <h5 class="control-label" style="text-align: left;">Estimated Release Date:</h5>
                        <input type="date" id="estDate" class="form-control" name="estDate" value="<?php echo $date?>"/>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <h5 class="control-label" style="text-align: left;">Remarks</h5>
                        <textarea name="remarks" class="form-control" rows="4"><?php echo $remarks?></textarea>
                      </div>
                    </div>
                  </div>


              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success waves-effect text-left"><i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>

      </form>
    </div>
  </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="updateModeofPaymentModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="delRec">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Issue Delivery Receipt</h3>
          </div>
          <form action="issue-del-rep.php" method="post">
            <input type="hidden" name="recID" value="<?php echo $jsID?>">
            <div class="modal-body">
              <div class="descriptions">
                <div class="form-body">
                  <?php
                  include "dbconnect.php";
                  $sql = "SELECT * FROM tbldelivery WHERE deliveryID = '$jsID'";
                  $res = mysqli_query($conn,$sql);
                  $row = mysqli_fetch_assoc($res);
                  $add = $row['deliveryAddress'];
                  $rem = $row['deliveryRemarks'];
                  $emp = $row['deliveryEmpAssigned'];
                  ?>

                  <div class="row">
                    <div class="col-md-12">
                      <h4 style="text-align:center"> You can no longer edit the delivery information once you issue a delivery receipt and the delivery will proceed with the information available.</h4>
                      <h4 style="text-align:center"> Do you wish to continue?</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success waves-effect text-left"><i class="fa fa-check"></i> Continue</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
          </div>

        </form>
      </div>
    </div>

  </body>
  </html>