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
        <form action="prod-phase-save.php" method = "post">
          <input type="hidden" name="type" value="0">
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
        <form action="prod-phase-save.php" method = "post">
          <input type="hidden" name="type" value="1">
          <input type="hidden" name="orderID" value="<?php echo $jsID?>">
          <input type="hidden" name="phaseID" value="<?php echo $pID?>">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <h4><input type="checkbox" name="finPhase" id="finPhase" value="finish"/>
                      Finish Production Phase?</h4>
                    </div>
                  </div>
                  <hr>
                  <div id="update">
                    <div class="row">
                      <div class="col-md-12">
                        <label class="control-label">Date Started: </label>
                        <div class="col-md-10 pull-right">
                          <input type="date" id="dateStart" name ="dateStart" class="form-control"/> 
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
                          <textarea rows="4" id="Uremarks" name ="remarks" class="form-control"> </textarea>
                        </div>
                      </div> 
                    </div>
                  </div>

                  <div id="finish">
                    <div class="row">
                      <div class="col-md-12">
                        <label class="control-label">Date Finished: </label>
                        <div class="col-md-9 pull-right">
                          <input type="date" id="dateFinish" name="dateFinish" class="form-control"/> 
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
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success waves-effect text-left" id="addFab"><i class="fa fa-check"></i> Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>

            </form></div>  
          </div>
        </div>

      </div>



      <div class="modal fade" tabindex="-1" role="dialog" id="newProductionTrackingModal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content" id="history">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 class="modal-title" id="modalProduct">Production History</h3>
            </div>
            <form action="" method = "post">
              <?php 
              $orderID = $jsID;
              $ordReq = $pID;
              $sql = "SELECT * from tblorder_request a, tblproduct b WHERE a.orderProductID = b.productID and a.orderRequestStatus!='Archived' and a.order_requestID = '$ordReq'";
              $res = mysqli_query($conn,$sql);
              $row = mysqli_fetch_assoc($res);
              ?>
              <div class="modal-body">
                <div class="descriptions">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <h3 class="control-label"><b>Furniture Name:</b> <?php echo $row['productName']?></h3>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="table-responsive">
                        <table class="table display nowrap" id="tblProducts">
                          <thead>
                            <tr>
                              <th style="text-align: left;">Phase Name</th>
                              <th style="text-align: left;">Handler</th>
                              <th style="text-align: left;">Date Start</th>
                              <th style="text-align: left;">Date End</th>
                              <th style="text-align: left;">Status</th>
                              <th style="text-align: left;">Remarks</th>
                            </thead>
                          </table>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>            
              </form>
            </div>
          </div>

        </div>


      </body>
      </html>