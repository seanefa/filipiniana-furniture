<?php
include "menu.php";
include 'dbconnect.php';
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
<!DOCTYPE>
<html>
<head>
</head>
<body>
  <!-- New On-Hand Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="newOnHandModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="newOnHand">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">New On-Hand Product</h3>
        </div>
        <form action="on-hand.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <input type="hidden" name="func" value="new">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Category</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="cat" id="cat">
                        <option value="0">Choose Category</option>
                        <?php
                        $sql = "SELECT * FROM tblfurn_category ORDER BY categoryName ASC;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['categoryStatus']=='Listed'){
                            echo('<option value='.$row['categoryID'].'>'.$row['categoryName'].'</option>');
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="_category" id="type" disabled>


                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">

                    <div class="form-group">
                      <label class="control-label">Furniture Name</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" tabindex="1" name="prod" id="products" disabled>

                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Quantity</label>
                      <input type="text" id="quan" class="form-control" name="quan" style="text-align:right">
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
  <!-- /.modal -->

  <!-- New On-Promo Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="newOnPromoModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="newOnPromo">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">New On-Promo Product</h3>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Available Promos</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="promo" id="promo">
                        <option value="">Select a Promo</option>
                        <?php
                        include "dbconnect.php";
                        $sql = "SELECT * FROM tblpromos ORDER BY promoName ASC;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['promoStatus']!='Archived'){
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

                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="row" id="checkbox">
                        <div class="col-md-6">
                          <h4><input type="checkbox" id="allProd" name="allProd" checked/>Apply to all Products?</h4>
                        </div>
                      </div>
                      <div id="selection" class="col-md-12">
                        <h4>Select Products</h4>
                        <div class="row">
                          <div class="col-md-6">
                            <label class="radio-inline"><input type="radio" name="from" value="Category"/>Product Category</label>
                            <label class="radio-inline"><input type="radio" name="from" value="Type"/>Product Type</label>
                            <label class="radio-inline"><input type="radio" name="from" value="Name"/>Product Name</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <select class="form-control" multiple="multiple" data-placeholder="Choose a Category" tabindex="1" name="onPromoProd[]" id="onPromoProd">
                                <option>Lalalala</option>
                                <option>Lalalala</option>
                                <option>Lalalala</option>
                                <option>Lalalala</option>
                                <option>Lalalala</option>
                              </select>
                            </div>
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
            <button type="submit" class="btn btn-success waves-effect text-left" id="addFab" disabled=""><i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /.modal -->



  <!-- Add On-Hand Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="addOnHandModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="addOnHand">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Add Quantity</h3>
        </div>
        <form action="on-hand.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <input type="hidden" name="func" value="add">
                <?php
                include "dbconnect.php";
                $sql = "SELECT * FROM tblproduct WHERE productID ='$jsID'";
                $res = mysqli_query($conn,$sql);
                $pRow = mysqli_fetch_assoc($res);
                ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                     <h4><b>Furniture Name:</b> <?php echo $pRow['productName']?></h4>
                     <input type="hidden" name="name" value="<?php echo $pRow['productID']?>"><span id="message"></span>
                   </div>
                 </div>
               </div>

               <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Quantity</label><span id="x" style="color:red"> *</span>
                    <input type="number" id="quan" class="form-control" name="quan" style="text-align:right">
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success waves-effect text-left" id="addBtn"><i class="fa fa-check"></i> Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
<!-- /.modal -->

<!-- Add On-Promo Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addOnPromoModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="addOnPromo">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">Add On-Promo Quantity</h3>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Quantity</label><span id="x" style="color:red"> *</span>
                    <input type="number" id="" class="form-control" name="box">
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success waves-effect text-left" id="addBtn"><i class="fa fa-check"></i> Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
<!-- /.modal -->

<!-- Deduct On-Hand Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="deductOnHandModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="deductOnHand">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">Deduct Quantity</h3>
      </div>
      <form action="on-hand.php" method="post">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">
              <input type="hidden" name="func" value="deduct">
              <?php
              include "dbconnect.php";
              $sql = "SELECT * FROM tblproduct WHERE productID ='$jsID'";
              $res = mysqli_query($conn,$sql);
              $pRow = mysqli_fetch_assoc($res);
              ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                   <h4><b>Furniture Name:</b> <?php echo $pRow['productName']?></h4>
                   <input type="hidden" name="name" value="<?php echo $pRow['productID']?>"><span id="message"></span>
                 </div>
               </div>
             </div>

             <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Quantity</label><span id="x" style="color:red"> *</span>
                  <input type="number" id="quan" class="form-control" name="quan" style="text-align:right">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Remarks</label>
                  <textarea id="remText" class="form-control" placeholder="Pull-Out" name="remarks"></textarea>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect text-left" id="deductBtn"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
      </div>
    </div>
  </form>
</div>
</div>
</div>
<!-- /.modal -->

<!-- Deduct On-Promo Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="deductOnPromoModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="deductOnPromo">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">Deduct On-Promo Quantity</h3>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Quantity(in pcs)</label><span id="x" style="color:red"> *</span>
                    <input type="text" id="remText" class="form-control" name="quantity">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Remarks</label><span id="x" style="color:red"> *</span>
                    <input type="text" id="remText" class="form-control" placeholder="Pull-Out" name="remarks">
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success waves-effect text-left" id="deductBtn"><i class="fa fa-check"></i> Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
<!-- /.modal -->


</body>
</html>