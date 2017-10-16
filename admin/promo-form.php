<?php
include "menu.php";
include "dbconnect.php";
include "packages.php";
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
<!-- New Promo Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="newPromoModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="new">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">New Promo</h3>
      </div>
      <form enctype="multipart/form-data" action="add-Promo.php" method = "post">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                    <input type="text" id="username" class="form-control" name="name" required/><span id="message"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Free Product</label><span id="x" style="color:red"> *</span>
                    <select type="text" id="select" class="form-control" name="product" required>
                    <option value='0' disabled selected>Choose Product</option>
                    <?php
                    include "dbconnect.php";
                    $sql = "SELECT * FROM tblproduct";
                    $result = mysqli_query($conn,$sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '<option id="'.$row['productID'].'" value="'.$row['productID'].'">'.$row['productName'].'</option>';
                    }

                    ?></select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Description</label>
                    <textarea id="desc" class="form-control" name="desc"></textarea>
                  </div>
                </div>
              </div>
              

              

              <div class="row">
                <div class="col-md-12">
                  <h3 class="box-title">Promo Image</h3>
                  <div class="product-img"><br>
                    <input type="file" name="image" class="dropify" required> 
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" style="font-size:18px;">Start Date</label><span id="x" style="color:red"> *</span>
                    <input type="date" id="startDate" class="form-control" name="start" required/> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label" style="font-size:18px;">End</label><span id="x" style="color:red"> *</span>
                      <input type="date" id="endDate" class="form-control" name="end" required/> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer"><span id="notif" style="color:red"></span>
            <button type="submit" class="btn btn-success waves-effect text-left" id="addFab" disabled=""><i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /.modal -->
  <!-- Update Promo Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="updatePromoModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="update">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Update Promo</h3>
        </div>
        <form enctype="multipart/form-data" action="promo-update.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <?php
              include 'dbconnect.php';

              $rsql = "SELECT * FROM tblpromos where promoID = $jsID";
              $rresult = mysqli_query($conn,$rsql);
              if($rresult){ }
              
              $row = mysqli_fetch_assoc($rresult);
              
              ?>

              <div class="form-body">
                <input type="hidden" name="recID" value="<?php echo $jsID?>">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="editname" autocomplete="false" class="form-control" name="name" value="<?php echo $row['promoName'];  $_SESSION['tempname'] = $row['promoName'];?>"  required/> <span id="message"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Free Product</label><span id="x" style="color:red"> *</span>
                    <select type="text" id="select" class="form-control" name="editproduct" required>
                    <option value='0' disabled>Choose Product</option>
                    <?php
                    include "dbconnect.php";
                    $sql = "SELECT * FROM tblproduct";
                    $result = mysqli_query($conn,$sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '<option id="'.$row['productID'].'" value="'.$row['productID'].'">'.$row['productName'].'</option>';
                    }

                    $rsql = "SELECT * FROM tblpromos where promoID = $jsID";
              $rresult = mysqli_query($conn,$rsql);
              if($rresult){ }
              
              $row = mysqli_fetch_assoc($rresult);

                    ?></select>
                  </div>
                </div>
              </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Description</label>
                      <textarea id="remText" class="form-control" name="desc"><?php echo $row['promoDescription']?></textarea>
                    </div>
                  </div>
                </div>
                

                  

                    <div class="row">
                      <div class="col-md-12">
                        <h3 class="box-title m-t-20">Promo Image</h3>
                        <div class="product-img"><br>
                    		<input type="file" name="image" class="dropify" data-default-file="plugins/promos/<?php echo $row['promoImage']?>">
                    		<input type="hidden" name="exist_image" value="<?php echo $row['promoImage'];?>"  required>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label" style="font-size:18px;">Start Date</label><span id="x" style="color:red"> *</span>
                          <input type="date" id="startDate" class="form-control" name="start"/><input type="hidden" id="tempdate" value="<?php echo $row['promoStartDate'];?>" required/></div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label" style="font-size:18px;">End</label><span id="x" style="color:red"> *</span>
                            <input type="date" id="endDate" class="form-control" name="end" required/><input type="hidden" id="tempend" value="<?php echo $row['promoEnd'];?>"/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer"><span id="notif" style="color:red"></span>
                  <button type="submit" class="btn btn-success waves-effect text-left" id="updateBtn"><i class="fa fa-check"></i> Save</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.modal -->
        <!-- Delete Promo Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="deletePromoModal" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content" id="delete">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">Deactivate Promo</h3>
              </div>
              <div class="modal-body">
                <h4>Are you sure you want to deactivate this Promo?</h4>
              </div>
              <div class="modal-footer">
                <a href="delete-promo.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
                <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>

        <!-- View Promo Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="deletePromoModal" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content" id="view">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">View Promo Details</h3>
              </div>
                <?php
                $rsql = "SELECT * FROM tblpromos WHERE promoID = $jsID";
                $rresult = mysqli_query($conn,$rsql);
                $row = mysqli_fetch_assoc($rresult);

                $prid = $row['tblproductID'];

                $psql = "SELECT * FROM tblproduct WHERE productID = '$prid'";
                $presult = mysqli_query($conn,$psql);
                $prow = mysqli_fetch_assoc($presult);
                ?>
              <div class="modal-body">
        <div class="descriptions">
                            <div class="">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="white-box text-center"> <img src="plugins/promos/<?php echo $row['promoImage']?>" alt="Unavailable" class="img-responsive"> </div>
                                    </div>
                                    <hr>
                                <h2 class="m-b-0 m-t-0" style="text-align: center;"><?php echo $row['promoName'];?></h2>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center;">
                                        <h2 class="m-b-0 m-t-0" style="text-align: center;">Free Product</h2>
                                        <p><img height="112px" width="120px" src="plugins/images/<?php echo $prow['prodMainPic'];?>"/>
        <div class="pro-img-overlay"></p>
                                        <p><?php echo $prow['productName'];?></p>
                                        <h4 class="box-title">Description</h4>
                                        <p><?php echo $row['promoDescription'];?></p>
                                        <div class="row">
                                        <div class="col-md-6">
                                        <h4 class="box-title">START DATE</h4>
                                        <p><?php echo $row['promoStartDate'];?></p>
                                        </div>
                                        <div class="col-md-6">
                                        <h4 class="box-title">END DATE</h4>
                                        <p><?php echo $row['promoEnd'];?></p>
                                        </div>
                                        </div>
                                    </div>
                                    <hr>

                                </div>
                            </div>

        </div>
      </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>