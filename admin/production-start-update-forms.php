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

$phase = 0;
if(isset($_GET['phase'])){
  $phase = $_GET['phase'];
}

$orderReq = 0;
if(isset($_GET['orderReq'])){
  $orderReq = $_GET['orderReq'];
}

$jsID = $_GET['id']; 
$oID = $_GET['oID'];
$pr = $_GET['smth'];


$_SESSION['varname'] = $jsID;

?>
<!DOCTYPE>
<html>
<head>
  <script>
function deleteRow(row){
  var result = confirm("Remove Product?");
  if(result){
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('selectedMaterials').deleteRow(i);
  }
}
</script>
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
          <?php
          $sql = "SELECT * FROM tblproduction_phase a, tblorder_request b, tblproduct c WHERE a.prodHistID = '$pID' and b.orderProductID = c.productID and a.prodPhase = '$phase' and b.order_requestID = '$orderReq' and b.orderProductID = c.productID;";
          $res = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($res);
          $prodDesign = $row['prodDesign'];
          $prodID = $row['productID'];
          $prodName = $row['productName'];
          ?>
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <h4><input type="checkbox" name="matQuantity" id="matQuantity" value="updateMat"/>
                      Update Materials for Production?</h4>
                    </div>
                  </div>
                  <div id="materials">
                    <div id="row">
                      <div role="tabpanel" class="tab-pane fade active in" id="job">
                        <div class="panel-wrapper collapse in" aria-expanded="true">
                          <div class="panel-body">
                            <h4><b>Materials for <?php echo $prodName?></b></h4>
                            <div class="row">
                              <div class="table-responsive">
                                <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="selectedMaterials">
                                  <thead>
                                    <tr>
                                      <th style="text-align: left;">Type</th>
                                      <th style="text-align: left;">Material</th>
                                      <th style="text-align: left;">Quantity</th>
                                      <th style="text-align: left;">Action</th>                          
                                    </thead>
                                    <tbody  id="tblMat" style="text-align: left;">
                                      <?php
                                      //$sql = "SELECT * FROM tblprod_info a, tblprod_materials b,tblmaterials c, tblmat_var d,tblmat_type e,tblproduct f WHERE a.prodInfoID = b.p_prodInfoID and a.prodInfoPhase = '$phase' and b.p_matStatus != 'Archived' and b.p_matDescID = d.mat_varID and d.materialID = c.materialID and e.matTypeID = c.materialType and f.productID = a.prodInfoProduct and a.prodInfoProduct = '$prodID'";
                                      $sql = "SELECT * FROM tblprod_info a, tblprod_materials b,tblmaterials c, tblmat_var d,tblmat_type e,tblproduct f WHERE a.prodInfoID = b.p_prodInfoID and a.prodInfoPhase = '$phase' and b.p_matStatus != 'Archived' and b.p_matDescID = d.mat_varID and d.materialID = c.materialID and e.matTypeID = c.materialType and f.productID = a.prodInfoProduct and a.prodInfoProduct = '$prodID';";
                                      $ctr = 0;
                                      $res = mysqli_query($conn,$sql);
                                      while($row = mysqli_fetch_assoc($res)){
                                        if($row['p_matStatus']!="Archived"){
                                          //legiiiit
                                          echo "<tr id='trowID' class='materialNeed'>
                                          <td>
                                          <p>". $row['matTypeName'] ."</p>
                                          <input type='hidden' class='form-control' id='mattype' name='mattype[]' value='". $row['matTypeName'] ."'/>
                                          </td>
                                          <td>
                                          <p >". $row['mat_varDescription'].'/'.$row['materialName'] ."</p>
                                          <input type='hidden' class='form-control' id='matvar' name='matvar[]' value='". $row['mat_varDescription'] ."' />
                                          <input type='hidden' class='form-control' id='matvar' name='matvarid[]' value='". $row['mat_varID'] ."' />
                                          </td>
                                          <td>
                                          <input type='text' class='col-lg-4' maxlength='5' size='5' id='matquan' style='text-align:right;' name='matquan[]' value='". $row['p_matQuantity'] ."'/>
                                          </td>";
                                          echo '<td><input id="removeBtn" type="button" onclick="deleteRow(this)" class="btn btn-danger" value="X"/></td></tr>';
                                          $ctr++;
                              //<input type='hidden' class='form-control' name='quan[]' value='". $row['p_matQuantity']  ."'/>
                                        }
                                      }
                                      if($ctr==0){
                                        echo "<tr><td colspan='4' style='text-align:center'>No available data yet.</td></tr>";
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
                                        </tbody>
                                        </table>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        <hr>
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

                                          </form>
                                        </div>  
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
                                                    <table class="table display table-bordered table-hover" id="tblProducts">
                                                      <thead>
                                                        <tr>
                                                          <th style="text-align: left;">Phase Name</th>
                                                          <th style="text-align: left;">Handler</th>
                                                          <th style="text-align: left;">Date Start</th>
                                                          <th style="text-align: left;">Date End</th>
                                                          <th style="text-align: left;">Status</th>
                                                          <th style="text-align: left;">Remarks</th>
                                                        </thead>
                                                        <?php
                                                        include "dbconnect.php";
                                                        $pSQL = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and c.order_requestID = '$ordReq'";
                                                        $pRes = mysqli_query($conn,$pSQL);
                                                        while($pRow = mysqli_fetch_assoc($pRes)){
                                                          $dateStart = "N/A";
                                                          $temp = $pRow['prodDateStart'];
                                                          if($temp!=""){
                                                            $dateStart = date_create($pRow['prodDateStart']);
                                                            $dateStart = date_format($dateStart,"F d, Y");
                                                          }

                                                          $dateEnd = "N/A";
                                                          $temp = $pRow['prodDateEnd'];
                                                          if($temp!=""){
                                                            $dateEnd = date_create($pRow['prodDateEnd']);
                                                            $dateEnd = date_format($dateEnd,"F d, Y");
                                                          }

                                                          $empName = getName($pRow['prodEmp']);

                                                          $remarks = "N/A";
                                                          $temp = $pRow['prodRemarks'];
                                                          if($temp!=""){
                                                            $remarks = $pRow['prodRemarks'];
                                                          }
                                                          echo "<tr>
                                                          <td>".$pRow['phaseName']."</td>
                                                          <td>".$empName."</td>
                                                          <td>".$dateStart."</td>
                                                          <td>".$dateEnd."</td>
                                                          <td>".$pRow['prodStatus']."</td>
                                                          <td>".$remarks."</td>
                                                          </tr>";
                                                        }
                                                        function getName($id){
                                                          include "dbconnect.php";
                                                          $name = "";
                                                          $sql = "SELECT * FROM tblemployee  WHERE empID = '$id';";
                                                          $result = mysqli_query($conn, $sql);
                                                          while ($row = mysqli_fetch_assoc($result))
                                                          {
                                                            $name = $row['empFirstName'].' '.$row['empMidName'].' '.$row['empLastName'];
                                                          }
                                                          return $name;
                                                        }
                                                        ?>
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