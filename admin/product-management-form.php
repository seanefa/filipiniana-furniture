<?php
include "menu.php";
include 'dbconnect.php';
session_start();
if(isset($GET['id'])){
  $jsID = $_GET['id']; 
}
$jsID=$_GET['id'];
$_SESSION['varname'] = $jsID;

?>
<!DOCTYPE>
<html>
<head>
</head>
<body>
  <!-- Deduct On-Hand Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="deductOnHandModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="deductOnHand">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Pull-Out Furniture</h3>
        </div>
        <form action="on-hand.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <input type="hidden" name="func" value="deduct">
                <?php
                include "dbconnect.php";
                $sql = "SELECT * FROM tblproduct a, tblonhand b WHERE a.productID = b.ohProdID and a.productID ='$jsID'";
                $res = mysqli_query($conn,$sql);
                $pRow = mysqli_fetch_assoc($res);
                $count = $pRow['ohQuantity'];
                ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <h3 style="text-align: center;">Furniture Name:<br><?php echo $pRow['productName']?></h3>
                      <input type="hidden" name="name" value="<?php echo $pRow['productID']?>"><span id="message"></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">For</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="reason" id="reason">
                        <option value="1">Order</option>
                        <option value="2">Repair</option>
                        <option value="3">Other</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div id="tblorders">
                  <div class="row">
                    <div class="col-md-12">
                     <table class="table product-overview" id="ordertbl">
                      <thead>
                        <tr>
                          <th style="text-align: center">-</th>
                          <th>Order ID</th>
                          <th style="text-align: left">Customer Name</th>
                          <th style="text-align: right;">Quantity</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $ctr = 0;
                        $sql = "SELECT * FROM tblorders a, tblorder_request b, tblcustomer c WHERE a.orderID = b.tblOrdersID and b.orderProductID = '$jsID' and b.orderRequestStatus = 'Active' and a.custOrderID = c.customerID";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['orderStatus']!="Finished"){
                            $quan = getFin($row['order_requestID']);
                          $orderID = str_pad($row['orderID'], 6, '0', STR_PAD_LEFT); //format ng display ID
                          echo('<tr>
                            <td style="text-align: center"><input class="chBox" type="radio"  value='.$row['order_requestID'].' name="check" /></td>
                            <td style="text-align: left;">'. $orderID .'</td>
                            <td style="text-align: left;">'.$row['customerLastName'].', '.$row['customerFirstName'].' '.$row['customerMiddleName'].'</td>
                            <td style="text-align: right;">'.$quan.'</td>
                            </tr>');
                          $ctr++;
                        } 
                      }
                      if($ctr==0){
                        echo "<tr><td colspan='4' style='text-align:center'>Nothing to show.</td></tr>";
                      }
                      function getFin($id){
                        include "dbconnect.php";
                        $sql1 = "SELECT * FROM tblorder_requestcnt WHERE orreq_ID = $id";
                        $res = mysqli_query($conn,$sql1);
                        $row = mysqli_fetch_assoc($res);
                        $orid = $row['orreq_quantity'];

                        $prfin = $row['orreq_prodFinish'];
                        $ret = $row['orreq_returned'];
                        $rel = $row['orreq_released'];

                        $total = $prfin + $ret + $rel;
                        $quan = $orid - $total;
                        return $quan;
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div id="warning">  
              <?php
              $date = new DateTime();
              $dateToday = date_format($date, "Y-m-d");

              $estDate = date('Y-m-d', strtotime("+25 days"));
              ?>
              <input type="hidden" id="dateToday" value="<?php echo $dateToday?>">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Estimated Finish Date</label><span id="x" style="color:red"> *</span>
                  <input type="date" id="estDate" class="form-control" name="pidate" value="<?php echo $estDate?>" required/> 
                  <h5 style="color:green">The system will take pulled-out furniture for repair as a new management order.</h5>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Quantity</label><span id="x" style="color:red"> *</span>
                  <input type="number" id="quan" class="form-control" name="quan" style="text-align:right" value="<?php echo $count;?>">
                  <input type="hidden" id="quanOrig" style="text-align:right" value="<?php echo $count;?>">
                  <p id="quanError" style="color:red"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Remarks</label>
                  <textarea id="remText" class="form-control" name="remarks"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect text-left" id="saveBtn"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
      </div>
    </div>
  </form>
</div>
</div>
</div>

<!-- New On-Promo Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="newOnPromoModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="newOnPromo">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">New Products on Promo</h3>
      </div>
      <form action="products-promo-add.php" method="post">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Available Promos</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="promoedit" id="promo">
                      <option value="a">Select a Promo</option>
                      <?php
                      include "dbconnect.php";
                      $sql = "SELECT * FROM tblpromos ORDER BY promoName ASC;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['promoStatus']=='Active'){
                          echo('<option value='.$row['promoID'].'>'.$row['promoName'].'</option>');
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group" id="promoDesc">
                    <h3 style="text-align:center">[Select a Promo]</h3>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <div id="checkbox">
                    <h4 style="text-align: center;">
                      <input type="checkbox" id="allProd" name="allProd" value="all" checked/> Apply to all Products?
                    </h4>
                  </div>
                </div>
                <div class="row">
                  <div id="selection">
                    <h4 style="text-align: center;">Select Products</h4>
                    <div class="col-md-6 col-md-offset-3">
                      <select class="form-control" multiple="multiple" data-placeholder="Choose a Category" tabindex="1" name="onPromoProd[]" id="onPromoProd" style="width: 100%;">
                        <?php
                        //$sql = "SELECT * FROM tblproduct a, tblprodsonpromo b WHERE a.prodStat !='For customization' and b.onPromoStatus != 'Active' and a.productID != b.prodPromoID ORDER BY productName ASC;";
                        $sql = "SELECT * from tblproduct where prodStat != 'Archived' and prodStat !='For customization' and productID NOT IN (SELECT productID from tblproduct a, tblprodsonpromo b WHERE a.productID = b.prodPromoID and b.onPromoStatus = 'Active') ORDER BY productName ASC;";
                        $res = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($res)){
                            if($row['prodStat']!='Archived'){
                              echo('<option value='.$row['productID'].'>'.$row['productName'].''.$exist.'</option>');
                            }
                        }
                        // function ifExist($id){
                        //   include "dbconnect.php";
                        //   $sql = "SELECT * FROM tblprodsonpromo WHERE prodPromoID = $id and onPromoStatus = Active";
                        //   // $res = mysqli_query($conn,$sql);
                        //   // $row = mysqli_num_rows($res);
                        //   if(mysqli_query($conn,$sql)){
                        //     return 0l
                        //   }
                        //   else{
                        //     return 1;
                            
                        //   }
                        // }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success waves-effect text-left" id="saveBtn"><i class="fa fa-check"></i> Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Update Promo modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="updateOnPromoModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="updateOnPromo">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">Update Products on Promo</h3>
      </div>
      <form action="products-promo-update.php" method="post">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">
              <?php

              include "dbconnect.php";
              $sql = "SELECT * FROM tblpromos where promoID = '$jsID';";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);

              ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Available Promos</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" data-placeholder="Choose a Category" value='<?php echo $row['promoID'];?>' tabindex="1" name="promo" id="promoedit" disabled>
                      <option value="a" disabled>Select a Promo</option>
                      <?php
                      include "dbconnect.php";
                      $sql = "SELECT * FROM tblpromos ORDER BY promoName ASC;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['promoStatus']!='Archived'){
                          if($row['promoID'] == $jsID){
                            echo('<option value='.$row['promoID'].' selected="selected">'.$row['promoName'].'</option>');
                          }else{
                            echo('<option value='.$row['promoID'].'>'.$row['promoName'].'</option>');
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group" id="promoDescedit">
                    <h3 style="text-align:center">[Select a Promo]</h3>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="row">
                  <div id="selection">
                    <h4 style="text-align: center;">On promo</h4>
                    <div class="col-md-6 col-md-offset-3">
                      <select class="form-control" multiple="multiple" data-placeholder="Choose a Category" tabindex="1" name="onPromoProd[]" id="onPromoProd" style="width: 100%;">
                        <?php
                        $sql = "SELECT * from tblproduct where prodStat != 'Archived' and prodStat !='For customization' and productID NOT IN (SELECT productID from tblproduct a, tblprodsonpromo b WHERE a.productID = b.prodPromoID and b.onPromoStatus = 'Active') ORDER BY productName ASC;";
                        $res = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($res)){
                          if($row['prodStat']!='Archived'){
                            echo('<option value='.$row['productID'].'>'.$row['productName'].'</option>');
                          }
                        }
                        ?>
                      </select>
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

<!-- Update Promo end -->







<!-- Update Framework Material Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="updateFrameworkMaterialModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="updatePromo">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">Update Production Material</h3>
      </div>
      <form action="prod-info-update.php" method = "post">
        <div class="modal-body">
          <div class="descriptions">
            <?php
            $sql1 = "SELECT * FROM tblprod_info a, tblproduct b, tblfurn_type c, tblfurn_category d WHERE a.prodInfoProduct = b.productID and b.prodTypeID = c.typeID and d.categoryID = b.prodCatID and prodInfoID = '$jsID';";
            $res = mysqli_query($conn,$sql1);
            $srow = mysqli_fetch_assoc($res);
            ?>
            <div class="form-body">
              <input type="hidden" name="recID" value="<?php echo $jsID?>"/>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Category</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="cat" id="cat">

                      <?php
                      $sql = "SELECT * FROM tblfurn_category;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['categoryStatus']=='Listed'){
                          if ($srow["prodCatID"] == $row['categoryID'])
                          {
                            echo('<option value="'.$row['categoryID'].'" selected="selected">'.$row['categoryName'].'</option>');
                          }
                          else
                          {
                            echo('<option value="'.$row['categoryID'].'">'.$row['categoryName'].'</option>');
                          }

                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="_category" id="type">
                      <?php
                      $sql = "SELECT * FROM tblfurn_type;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['typeStatus']=='Listed'){
                          if ($srow["prodTypeID"] == $row['typeID'])
                          {
                            echo('<option value="'.$row['typeID'].'" selected="selected">'.$row['typeName'].'</option>');
                          }
                          else
                          {
                            echo('<option value='.$row['typeID'].'>'.$row['typeName'].'</option>');
                          }

                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <!--<div class="row">
                <div class="col-md-12 ">
                  <div class="form-group">
                    <div id="type">

                    </div>
                  </div>
                </div>
              </div>-->

              <div class="col-md-5">
                <div class="form-group">
                  <label class="control-label">Furniture Name</label><span id="x" style="color:red"> *</span>
                  <select class="form-control" tabindex="1" name="prod" id="products">
                    <?php
                    $sql = "SELECT * FROM tblproduct;";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                      if($row['prodStat']!='Archived'){
                        if ($srow["productID"]==$row['productID'])
                        {
                          echo('<option value="'.$row['productID'].'" selected="selected">'.$row['productName'].'</option>');
                        }
                        else
                        {
                          echo('<option value='.$row['productID'].'>'.$row['productName'] .'</option>');
                        }

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
                  <label class="control-label">Phase</label><span id="x" style="color:red"> *</span>
                  <select class="form-control" tabindex="1" name="phase">
                    <?php
                    include "dbconnect.php";
                    $sql = "SELECT * FROM tblphases;";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                      if($row['phaseStatus']!='Archived'){
                        if ($srow["prodInfoPhase"] == $row['phaseID'])
                        {
                          echo('<option value="'.$row['phaseID']. '" selected="selected">'.$row['phaseName'].'</option>');
                        }
                        else
                        {
                          echo('<option value="'.$row['phaseID'].'">'.$row['phaseName'].'</option>');
                        }
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <h4><label class="control-label">Materials Needed</label></h4>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
                  <select class="form-control" tabindex="1" name="material" id="mat">
                    <?php
                    include "dbconnect.php";
                    $sql = "SELECT * FROM tblmat_type;";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                      if($row['matTypeStatus']=='Listed'){
                        echo('<option value='.$row['matTypeID'].' data-name="'.$row['matTypeName'].'">'.$row['matTypeName'].'</option>');
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label">Material</label><span id="x" style="color:red"> *</span>
                  <select class="form-control" tabindex="1" name="var" id="var" disabled>

                  </select>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label class="control-label">Quantity(in pcs)</label><span id="x" style="color:red"> *</span>
                  <input type="text" class="form-control" name="quan" id="quan" placeholder="500" style="text-align: right" />
                </div>
              </div>

              <div class="col-md-2">
                <label class="control-label">Unit</label><span id="x" style="color:red">
                <select class="form-control"  data-placeholder="Select Material Category" tabindex="1" id="unit">';
                  <?php
                  $sql = "SELECT * FROM tblunitofmeasure;";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result))
                  {
                    if($row['unStatus']!='Archived'){
                      echo('<option value='.$row['unID'].'>'.$row['unUnit'].'</option>');
                    }
                  }
                  ?>
                </select> 
              </div>

              <div class="col-md-1">
                <div class="form-group pull-right">
                  <button id="addBtn" type="button" class="btn btn-success" style="margin-top: 27px;"><i class="ti-plus"></i></button>
                </div>
              </div>

            </div>


            <div class="row">
              <div role="tabpanel" class="tab-pane fade active in" id="job">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="selectedMaterials">
                          <thead>
                            <tr>
                              <th style="text-align: left;">Type</th>
                              <th style="text-align: left;">Material</th>
                              <th style="text-align: left;">Quantity</th>
                              <th style="text-align: left;">Unit</th>
                              <th style="text-align: left;">Action</th>                          
                            </thead>
                            <tbody  id="tblMat" style="text-align: left;">
                              <?php
                              $sql = "SELECT * FROM tblprod_materials a, tblmaterials b, tblmat_var c, tblmat_type d, tblunitofmeasure e WHERE a.p_matMaterialID = b.materialID and a.p_matUnit = e.unID and d.matTypeID = b.materialType and a.p_matDescID = c.variantID and p_prodInfoID = '$jsID'";
                              $res = mysqli_query($conn,$sql);
                              while($row = mysqli_fetch_assoc($res)){
                                if($row['p_matStatus']!="Archived"){
                                  $descName = desc($row['variantID']);

                                  echo "<tr id='trowID".$row['p_matID']."'>
                                  <td>".$row['matTypeName']."</td>
                                  <td><input type='hidden' class='form-control' id='exist".$row['p_matID']."' name='existRec[]' value='". $row['materialID'] ."'/>". $descName.'-'.$row['materialName']."</td>"."
                                  <input type='hidden' class='form-control' name='mat_var[]' value='". $row['variantID'] ."' />
                                  </td>
                                  <td><input type='text' class='col-lg-4' name='quan[]' value='". $row['p_matQuantity'] ."'/>
                                  </td>
                                  <td>".$row['unUnit']."<input type='hidden' class='form-control' id='quan' style='text-align:right;' name='unit[]' value='". $row['unID'] ."'/></td>";
                                  echo '<td><input id="remove" type="button" onclick="deleteExisting('.$row['p_matID'].')" class="btn btn-danger" value="X"/></td></tr>';

                              //<input type='hidden' class='form-control' name='quan[]' value='". $row['p_matQuantity']  ."'/>
                                }}

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

            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success waves-effect text-left"><i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
          </div>                
        </form>
      </div>
    </div>

  </body>
  </html>