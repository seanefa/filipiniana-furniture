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
$oID = $_GET['oID'];
$pr = $_GET['smth'];


$_SESSION['varname'] = $jsID;
$conn = mysqli_connect($servername, $username, $password, $dbname);

?>
<!DOCTYPE>
<html>
<head>
</head>
<body>

<div class="modal fade" tabindex="-1" role="dialog" id="newProductionTrackingModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="viewPO">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form action="" method = "post">
        <div class="modal-body">
          <div class="descriptions">
            <div class="tab-content">
                    <!-- CATEGORY -->
                    <div role="tabpanel" class="tab-pane fade active in" id="type">
                      <div class="panel-wrapper collapse in" aria-expanded="true">
                                                <div class="row">
                            <div class="col-md-6">
                            <label class="control-label pull-left">Supplier<br>Name: </label>
                              <div class="col-md-8 pull-right">
                                <input type="text">
                              </div>
                            </div>

                            <div class="col-md-6">
                            <label class="control-label pull-left">Contact<br>Number: </label>
                              <div class="col-md-8 pull-right">
                                <input type="text">
                              </div>
                            </div> 
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-md-6">
                            <label class="control-label pull-left">Address: </label>
                              <div class="col-md-8 pull-right">
                                <input type="text">
                              </div>
                            </div>

                            <div class="col-md-6">
                            <label class="control-label pull-left">Date: </label>
                              <div class="col-md-8 pull-right">
                                <input type="date">
                              </div>
                            </div> 
                            </div>
                            <br> 

                          <div class="row">
                            <div class="table-responsive">
                              <table class="table color-bordered-table muted-bordered-table display nowrap" id="myTable">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Item Description</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Unit Cost</th>
                                    <th>Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                    </tbody>
                                    </table>
                                  </div>
                                </div>
                                <br>
                          
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                     <label class="control-label pull-left">Remarks</label>
                     <div class="row">
                      <div class="col-md-12">
                     <textarea rows="4" cols="60" class="pull-left"></textarea>
                   </div>
                   </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group pull-right">
                     <label class="control-label">GRAND TOTAL:</label>
                     <div class="row">
                      <div class="col-md-12">
                     <input type="text" disabled>
                   </div>
                   </div>
                    </div>
                  </div>
                </div>
                            </div>
                          </div>
                  <!-- New Framework Mo
                  <!-- /.modal -->
                </div>
          </div>
        </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success waves-effect text-left" id="addFab"><i class="fa fa-check"></i> Print</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
          </div>                
        </form>
      </div>
    </div>

  </div>


</body>
</html>