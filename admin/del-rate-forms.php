<?php

include "menu.php";
include "dbconnect.php";
session_start();
if(isset($GET['id'])){
  $jsID = $_GET['id']; 
}
$jsID=$_GET['id'];

$_SESSION['varname'] = $jsID;
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>
<!-- New Delivery Rate Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="newDeliveryRateModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="new">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">New Delivery Rate</h3>
      </div>
      <form action="add-delivery.php" method = "post">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Branch</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="branch">
                      <?php
                      $sql = "SELECT * FROM tblbranches order by branchLocation;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['branchStatus']=='Listed'){
                          echo('<option value='.$row['branchID'].'>'.$row['branchLocation'].'</option>');
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Location</label><span id="x" style="color:red"> *</span>
                    <input type="text" id="username" class="form-control" name="location" required/><span id="message"></span> </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Rate Type</label><span id="x" style="color:red"> *</span>
                      <h2><input type="radio" id="rate" name="type" value="Percentage" required/> Percentage
                        <input type="radio" id="rate" name="type" value="Amount" required/> Amount</h2>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Rate</label><span id="x" style="color:red"> *</span>
                        <input type="number" class="form-control" step="1.00" id="rate" name="rate" placeholder="0.00" style="text-align: right;" required/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success waves-effect text-left"><i class="fa fa-check"></i> Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.modal -->
    <!-- Update Delivery Rate Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="updateDeliveryRateModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="update">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Update Delivery Rate</h3>
          </div>
          <form action="del-rate-update.php" method="post">
            <div class="modal-body">
              <div class="descriptions">
                <?php
                $tsql = "SELECT * FROM tbldelivery_rates WHERE delivery_rateID = $jsID";
                $tresult = mysqli_query($conn,$tsql);
                $trow = mysqli_fetch_assoc($tresult);
                ?>

                <div class="form-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Branch</label><span id="x" style="color:red"> *</span>
                        <select id="select" class="form-control" data-placeholder="Choose a Branch" tabindex="1" name="branch">
                          <?php
                          $sql = "SELECT * FROM tblbranches;";
                          $result = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($result))
                          {
                            if($row['branchStatus']=='Listed'){
                              echo('<option value='.$row['branchID'].'>'.$row['branchLocation'].'</option>');
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Location</label><span id="x" style="color:red"> *</span>
                        <input type="text" id="editname" class="form-control" name="location" value="<?php echo $trow['delLocation']; $_SESSION['tempname'] = $trow['delLocation'];?>" required/><span id="message"></span></div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Rate Type</label><span id="x" style="color:red"> *</span>
                          <h2><input type="radio" id="rate" name="type" value="Percentage" required/> Percentage
                            <input type="radio" id="rate" name="type" value="Amount" required/> Amount</h2>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                          <label class="control-label">Rate</label><span id="x" style="color:red"> *</span>
                          <input type="number" class="form-control" step="1.00" id="rate" name="rate" placeholder="0.00" style="text-align: right;" value="<?php echo $trow['delRate'];?>" required/>
                        </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button id="addFab" type="submit" class="btn btn-success waves-effect text-left" disabled><i class="fa fa-check"></i> Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.modal -->
          <!-- Delete Delivery Rate Modal -->
          <div class="modal fade" tabindex="-1" role="dialog" id="deleteDeliveryRateModal" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content" id="delete">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 class="modal-title">Deactivate Delivery Rate</h3>
                </div>
                <div class="modal-body">
                  <h4>Are you sure you want to deactivate this Delivery Rate?</h4>
                </div>
                <div class="modal-footer">
                  <a href="delete-delivery.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>