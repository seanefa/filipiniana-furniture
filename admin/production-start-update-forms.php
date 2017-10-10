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

$first = "no";
if(isset($_GET['first'])){
  echo $_GET['first'];
  $first = $_GET['first'];
}

$pack = "0";
if(isset($_GET['pack'])){
  echo $_GET['pack'];
  $pack = $_GET['pack'];
}

$jsID = $_GET['id']; 
$oID = $_GET['oID'];
$pr = $_GET['smth'];


$_SESSION['varname'] = $jsID;



$date = new DateTime();
$dateToday = date_format($date, "Y-m-d");

$estDate = date('Y-m-d', strtotime("+2 days"));

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
          <?php
          $prodDesign = "";
          $prodID = "";
          $prodName = "";
          $productionPhase = "";
          if($pack==1){
            $sql = "SELECT * FROM tblproduction_phase a, tblpackage_orderreq b, tblproduct c,tblphases d WHERE d.phaseID = a.prodPhase and a.prodHistID = '$pID' and b.por_prID = c.productID and a.prodPhase = '$phase' and b.por_ID = '$orderReq';";
            $res = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($res);
            $prodDesign = $row['prodDesign'];
            $prodID = $row['productID'];
            $prodName = $row['productName'];
            $productionPhase = $row['phaseName'];
          }
          else{
            $sql = "SELECT * FROM tblproduction_phase a, tblorder_request b, tblproduct c,tblphases d WHERE d.phaseID = a.prodPhase and a.prodHistID = '$pID' and b.orderProductID = c.productID and a.prodPhase = '$phase' and b.order_requestID = '$orderReq' and b.orderProductID = c.productID;";
            $res = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($res);
            $prodDesign = $row['prodDesign'];
            $prodID = $row['productID'];
            $prodName = $row['productName'];
            $productionPhase = $row['phaseName'];
          }
          ?>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Start Production Phase : <b><?php echo $productionPhase?></b></h3>
        </div>
        <form action="prod-phase-save.php" method = "post">
          <input type="hidden" name="type" value="0">
          <input type="hidden" name="first" value="<?php echo $first?>">
          <input type="hidden" name="orderID" value="<?php echo $jsID?>">
          <input type="hidden" name="phaseID" value="<?php echo $pID?>">
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
                                          <input type='number' class='col-lg-4' maxlength='5' size='5' id='matquan' style='text-align:right;' name='matquan[]' value='". $row['p_matQuantity'] ."'/>
                                          </td>";
                                          echo '<td><input id="removeBtn" type="button" onclick="deleteRow(this)" class="btn btn-danger" value="X"/></td></tr>';
                                          $ctr++;
                              //<input type='hidden' class='form-control' name='quan[]' value='". $row['p_matQuantity']  ."'/>
                                        }
                                      }
                                      if($ctr==0){
                                        echo "<tr><td colspan='4' style='text-align:center'>No available data yet.</td></tr>";
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
                      <div class="col-md-6">
                        <div class="col-md-12">
                          <label class="control-label">Date Started: </label>
                          <input type="date" id="dateStart" name ="dateStart" class="form-control" value="<?php echo $dateToday?>" required/> 
                        </div>
                        <p id="startError" style="color:red"></p>
                      </div> 
                      <div class="col-md-6">
                        <div class="col-md-12">
                          <label class="control-label">Estimated Date Finish</label>
                          <input type="date" id="estDate" name ="estDate" class="form-control" value="<?php echo $estDate?>" required/> 
                        </div>
                        <p id="estError" style="color:red"></p>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-12">
                          <label class="control-label">Handler</label>
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
                        <p id="hError" style="color:red"></p>
                      </div> 
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-12">
                          <label class="control-label">Remarks: </label>
                          <textarea rows="4" id="remarks" name ="remarks" class="form-control"> </textarea>
                        </div>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect text-left" id="saveBtn" disabled><i class="fa fa-check"></i> Save</button>
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
              <input type="hidden" name="pack" value="<?php echo $pack?>">
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
                          <div class="col-md-6">
                            <div class="col-md-12">
                              <label class="control-label">Date Started: </label>
                              <input type="date" id="dateStart" name ="dateStart" class="form-control" value="<?php echo $dateToday?>"/> 
                            </div>
                          </div> 
                          <div class="col-md-6">
                            <div class="col-md-12">
                              <label class="control-label">Estimated Date Finish</label>
                              <input type="date" id="estDate" name ="estDate" class="form-control" value="<?php echo $estDate?>"/> 
                            </div>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-12">
                              <label class="control-label">Handler</label>
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
                            <div class="col-md-12">
                              <label class="control-label">Remarks: </label>
                              <textarea rows="4" id="Uremarks" name ="remarks" class="form-control"> </textarea>
                            </div>
                          </div> 
                        </div>
                      </div>

                      <div id="finish">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-12">
                              <label class="control-label">Date Finished: </label>
                              <input type="date" id="dateFinish" name="dateFinish" class="form-control"/> 
                            </div>
                          </div> 
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-12">
                              <label class="control-label">Remarks: </label>
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
                $productionID = $pID;
                if($pack==0){
                  $sql = "SELECT * from tblorder_request a, tblproduct b, tblproduction c WHERE a.orderProductID = b.productID and a.orderRequestStatus!='Archived' and c.productionID = '$productionID' and a.order_requestID = c.productionOrderReq";
                  $res = mysqli_query($conn,$sql);
                  $row = mysqli_fetch_assoc($res);
                }
                else{
                  $sql = "SELECT * from tblorder_request a, tblproduct b, tblproduction c, tblpackage_orderreq d WHERE a.orderProductID = b.productID and a.orderRequestStatus!='Archived' and c.productionID = '$productionID' and d.por_ID = c.productionPackReq";
                  $res = mysqli_query($conn,$sql);
                  $row = mysqli_fetch_assoc($res);
                }
                ?>
                <div class="modal-body">
                  <div class="descriptions">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <h3 style="text-align: center;">Furniture Name:<br><?php echo $row['productName']?></h3>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="table-responsive">
                          <table class="table table-bordered table-hover" id="tblProducts">
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

                              if($pack==1){

                                $pSQL = "SELECT * FROM tblproduction_phase a, tblproduction b, tblpackage_orderreq c, tblphases d 
                                WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID 
                                and b.productionPackReq = c.por_ID and b.productionID = '$productionID'";
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

                              }
                              else{
                                $pSQL = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and b.productionID = '$productionID'";
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