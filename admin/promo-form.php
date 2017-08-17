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
                    <input type="text" id="username" class="form-control" name="name"/><span id="message"></span>
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
              <div class="panel panel-info" style="margin-top: -20px;">
                <div class="tab-content thumbnail">
                  <!-- CATEGORY -->
                  <div role="tabpanel" class="tab-pane fade active in" id="job">
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                      <div class="panel-body">
                        <h2 style="margin-top: -20px;">CONDITION:</h2>

                        <div class="row">
                          <div class="col-md-12">
                            <label class="control-label" style="font-size:18px;">Category: </label>
                            <span style="font-size: 15px;">
                              <label class="radio-inline" style="margin-left: 10px"><input type="radio" name="cat" value="Amount" checked> Amount</label>
                              <label class="radio-inline"><input type="radio" id="cat" name="cat" value="Pieces">Quantity</label>
                              <!--<label class="radio-inline"><input type="radio" name="cat" value="Others"> Others</label>-->
                            </span> 
                          </div>            
                        </div>
                        <hr>

                        <div class="row" id="amt">
                          <div class="col-md-12">
                            <label class="control-label" style="margin-top: 10px;" style="font-size:18px;">Base Amount:</label><span id="x" style="color:red"> *</span> 
                            <div class="col-md-9 pull-right">
                              <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon"><small>Php</small></div>
                                  <input class="form-control" step="1.00" id="thisPrice" name="con_rate" placeholder="0.00" style="text-align: right;"/> 
                                </div>
                              </div>
                            </div>
                          </div> 
                        </div>

                        <div class="row" id="piece">
                          <div class="col-md-12">
                            <label class="control-label" style="margin-top: 10px;" style="font-size:18px;">No. of Pieces:</label><span id="x" style="color:red"> *</span> 
                            <div class="col-md-9 pull-right">
                              <div class="form-group">
                                <div class="input-group">
                                  <input class="form-control" name="con_quan" style="text-align: right;"/> 
                                </div>
                              </div>
                            </div>
                          </div> 
                        </div>

                        <!--<div class="row" id="piece">
                          <div class="col-md-6">
                            <label class="control-label" style="font-size:18px;">No. of Pieces: </label><span id="x" style="color:red"> *</span>
                          </div> 
                          <div class="col-md-6">
                            <input type="number" id="" name ="" class="form-control" placeholder="Quantity" style="text-align:right;" required />
                          </div>
                          <div class="col-md-9">
                            <label class="control-label" style="font-size:18px;">Product Name: </label><span id="x" style="color:red"> *</span>
                            <select class="form-control" data-placeholder="" tabindex="1" name=>
                              <?php
                              $sql = "SELECT * FROM tblproduct";
                              $res = mysqli_query($conn,$sql);
                              while($row = mysqli_fetch_assoc($res)){

                                if($row['prodStat']!='Archived'){
                                  echo('<option value='.$row['productID'].'>'.$row['productName'].'</option>');
                                }
                              }
                              ?>
                            </select>
                          </div>             
                        </div>-->

                        <div class="row" id="other">
                          <div class="col-md-12">
                            <label class="control-label" style="font-size:18px;">Description: </label><span id="x" style="color:red"> *</span>
                            <textarea class="form-control" rows="4" name="con_desc"> </textarea>
                          </div>
                        </div>            
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <div class="panel panel-info" style="margin-top: -10px;">
                <div class="tab-content thumbnail">
                  <!-- CATEGORY -->
                  <div role="tabpanel" class="tab-pane fade active in" id="job">
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                      <div class="panel-body">
                        <h2 style="margin-top: -20px;">PROMO:</h2>

                        <div class="row">
                          <div class="col-md-12">
                            <label class="control-label" style="font-size:18px;">Category: </label>
                            <span style="font-size: 15px;">
                              <label class="radio-inline" style="margin-left: 10px"><input type="radio" name="p_cat" value="Amount" checked> Amount</label>
                              <label class="radio-inline"><input type="radio" name="p_cat" value="Pieces">Quantity</label>
                              <label class="radio-inline"><input type="radio" name="p_cat" value="Others"> Others</label>
                            </span> 
                          </div>            
                        </div>
                        <hr>

                        <div id="rate">
                          <div class="row">
                            <div class="col-md-12">
                              <label class="control-label" style="font-size:18px;">Rate Type: </label><span id="x" style="color:red"> *</span>
                              <span style="font-size: 15px;">
                                <label class="radion-inline"><input type="radio" type="radio" id="rateP" name="type" value="Percentage" style="margin-left: 30px;"> Percentage</label>
                                <label class="radion-inline"><input type="radio" id="rateP" name="type" value="Amount" style="margin-left: 30px;"> Fixed Amount</label>
                              </span> 
                            </div>   
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-md-12">
                              <label class="control-label" style="margin-top: 10px; font-size:18px;">Rate: </label><span id="x" style="color:red"> *</span>
                              <div class="col-md-10 pull-right">
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-addon"><small>Php</small></div>
                                    <input class="form-control" step="1.00" id="thisPrice" name="pro_rate" placeholder="0.00" style="text-align: right;"/> 
                                  </div>
                                </div>
                              </div>
                            </div> 
                          </div>
                        </div> 


                        <div class="row" id="quan">
                          <div class="col-md-12">
                            <label class="control-label" style="margin-top: 10px;" style="font-size:18px;">No. of Pieces:</label><span id="x" style="color:red"> *</span> 
                            <div class="col-md-9 pull-right">
                              <div class="form-group">
                                <div class="input-group">
                                  <input class="form-control" name="pro_quan" style="text-align: right;"/> 
                                </div>
                              </div>
                            </div>
                          </div> 
                        </div>

                        <!--<div class="row" id="quan">
                          <div class="col-md-3">
                            <label class="control-label" style="font-size:18px;">Quantity: </label><span id="x" style="color:red"> *</span>
                            <input type="number" id="" name ="" class="form-control" placeholder="Quantity" style="text-align:right;" required />
                          </div> 
                          <div class="col-md-9">
                            <label class="control-label" style="font-size:18px;">Variations: </label><span id="x" style="color:red"> *</span>
                            <select class="form-control" data-placeholder="" tabindex="1" name=>
                              <option>1</option>
                            </select>
                          </div>             
                        </div>-->

                        <div class="row" id="odd">
                          <div class="col-md-12">
                            <label class="control-label" style="font-size:18px;">Description: </label><span id="x" style="color:red"> *</span>
                            <textarea class="form-control" rows="4" name="pro_desc"> </textarea>
                          </div>
                        </div> 

                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <h3 class="box-title">Promo Image</h3>
                  <div class="product-img"><br>
                    <input type="file" name="image" class="dropify">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" style="font-size:18px;">Start Date</label><span id="x" style="color:red"> *</span>
                    <input type="date" id="startDate" class="form-control" name="start"/> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label" style="font-size:18px;">End</label><span id="x" style="color:red"> *</span>
                      <input type="date" id="endDate" class="form-control" name="end"/> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
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

              $rsql = "SELECT * FROM tblpromos a, tblpromo_condition b, tblpromo_promotion c WHERE a.promoID = b.conPromoID and a.promoID = c.proPromoID and promoID = $jsID";
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
                      <input type="text" id="editname" class="form-control" name="name" value="<?php echo $row['promoName']?>"/> <span id="message"></span>
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
                <div class="panel panel-info" style="margin-top: -20px;">
                  <div class="tab-content thumbnail">
                    <!-- CATEGORY -->
                    <div role="tabpanel" class="tab-pane fade active in" id="job">
                      <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                          <h2 style="margin-top: -20px;">CONDITION:</h2>

                          <div class="row">
                            <div class="col-md-12">
                              <label class="control-label" style="font-size:18px;">Category: </label>
                              <span style="font-size: 15px;">
                                <label class="radio-inline" style="margin-left: 10px"><input type="radio" name="cat" value="Amount" 
                                  <?php 
                                  if($row['conCategory']=="Amount"){
                                    echo "checked";
                                  }?>
                                  > Amount</label>
                                  <label class="radio-inline"><input type="radio" id="cat" name="cat" value="Pieces"
                                    <?php 
                                    if($row['conCategory']=="Pieces"){
                                      echo "checked";
                                    }?>> Pieces</label>
                                    <label class="radio-inline"><input type="radio" name="cat" value="Others"
                                      <?php 
                                      if($row['conCategory']=="Others"){
                                        echo "checked";
                                      }
                                      
                                      ?>> Others</label>
                                    </span> 
                                  </div>            
                                </div>
                                <hr>

                                <div class="row" id="amt">
                                  <div class="col-md-12">
                                    <label class="control-label" style="margin-top: 10px;" style="font-size:18px;">Base Amount:</label><span id="x" style="color:red"> *</span> 
                                    <div class="col-md-9 pull-right">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <div class="input-group-addon"><small>Php</small></div>
                                          <input class="form-control" step="1.00" id="thisPrice" name="con_rate" placeholder="0.00" style="text-align: right;" value="<?php echo $row['conData']?>" /> 
                                        </div>
                                      </div>
                                    </div>
                                  </div> 
                                </div>


                                <div class="row" id="piece">
                                  <div class="col-md-12">
                                    <label class="control-label" style="margin-top: 10px;" style="font-size:18px;">No. of Pieces:</label><span id="x" style="color:red"> *</span> 
                                    <div class="col-md-9 pull-right">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <input class="form-control" name="con_quan" style="text-align: right;" value="<?php echo $row['conData']?>"/> 
                                        </div>
                                      </div>
                                    </div>
                                  </div> 
                                </div>

                            <!--<div class="row" id="piece">
                              <div class="col-md-3">
                                <label class="control-label" style="font-size:18px;">Quantity: </label><span id="x" style="color:red"> *</span>
                                <input type="number" id="" name ="" class="form-control" placeholder="Quantity" style="text-align:right;" required />
                              </div> 
                              <div class="col-md-9">
                                <label class="control-label" style="font-size:18px;">Variations: </label><span id="x" style="color:red"> *</span>
                                <select class="form-control" data-placeholder="" tabindex="1" name=>
                                  <option>1</option>
                                </select>
                              </div>             
                            </div>-->

                            <div class="row" id="other">
                              <div class="col-md-12">
                                <label class="control-label" style="font-size:18px;">Description: </label><span id="x" style="color:red"> *</span>
                                <textarea id="remText" class="form-control" rows="4" name=""><?php echo $row['conData']?></textarea>
                              </div>
                            </div>            
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="panel panel-info" style="margin-top: -10px;">
                    <div class="tab-content thumbnail">
                      <!-- CATEGORY -->
                      <div role="tabpanel" class="tab-pane fade active in" id="job">
                        <div class="panel-wrapper collapse in" aria-expanded="true">
                          <div class="panel-body">
                            <h2 style="margin-top: -20px;">PROMO:</h2>

                            <div class="row" disabled>
                              <div class="col-md-12">
                                <label class="control-label" style="font-size:18px;">Category: </label>
                                <span style="font-size: 15px;">
                                  <label class="radio-inline" style="margin-left: 10px"><input type="radio" name="p_cat" value="Amount" 
                                    <?php 
                                    if($row['proCategory']=="Amount"){
                                      echo "checked";
                                    }?>> Amount</label>
                                    <label class="radio-inline"><input type="radio" name="p_cat" value="Pieces"
                                      <?php 
                                      if($row['proCategory']=="Pieces"){
                                        echo "checked";
                                      }?>
                                      > Pieces</label>
                                      <label class="radio-inline"><input type="radio" name="p_cat" value="Others"<?php 
                                      if($row['proCategory']=="Others"){
                                        echo "checked";
                                      }?>
                                      > Others</label>
                                    </span> 
                                  </div>            
                                </div>
                                <hr>

                                <div id="rate">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <label class="control-label" style="font-size:18px;">Rate Type: </label><span id="x" style="color:red"> *</span>
                                      <span style="font-size: 15px;">
                                        <label class="radion-inline"><input type="radio" type="radio" id="rateP" name="type" value="Percentage" style="margin-left: 30px;"> Percentage</label>
                                        <label class="radion-inline"><input type="radio" id="" name="type" value="Fixed" style="margin-left: 30px;"> Fixed Amount</label>
                                      </span> 
                                    </div>   
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <label class="control-label" style="margin-top: 10px; font-size:18px;">Rate: </label><span id="x" style="color:red"> *</span>
                                      <div class="col-md-10 pull-right">
                                        <div class="form-group">
                                          <div class="input-group">
                                            <div class="input-group-addon"><small>Php</small></div>
                                            <input class="form-control" step="1.00" id="thisPrice" name="p_rate" placeholder="0.00" style="text-align: right;" value="<?php echo $row['proData']?>"/> 
                                          </div>
                                        </div>
                                      </div>
                                    </div> 
                                  </div>
                                </div> 

                                <div class="row" id="quan">
                                  <div class="col-md-12">
                                    <label class="control-label" style="margin-top: 10px;" style="font-size:18px;">No. of Pieces:</label><span id="x" style="color:red"> *</span> 
                                    <div class="col-md-9 pull-right">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <input class="form-control" name="pro_quan" style="text-align: right;" value="<?php echo $row['proData']?>"/> 
                                        </div>
                                      </div>
                                    </div>
                                  </div> 
                                </div>

                              <!--<div class="row" id="quan">
                                <div class="col-md-4">
                                  <label class="control-label" style="font-size:18px;">Quantity: </label><span id="x" style="color:red"> *</span>
                                  <input type="number" id="" name ="" class="form-control" placeholder="Quantity" style="text-align:right;" required />
                                </div> 
                                <div class="col-md-8">
                                  <label class="control-label" style="font-size:18px;">Variations: </label><span id="x" style="color:red"> *</span>
                                  <select class="form-control" data-placeholder="" tabindex="1" name=>
                                    <option>1</option>
                                  </select>
                                </div>             
                              </div>-->

                              <div class="row" id="odd">
                                <div class="col-md-12">
                                  <label class="control-label" style="font-size:18px;">Description: </label><span id="x" style="color:red"> *</span>
                                  <textarea class="form-control" rows="4" name="pro_desc"><?php echo $row['proData']?></textarea>
                                </div>
                              </div> 

                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <h3 class="box-title m-t-20">Promo Image</h3>
                        <div class="product-img"><br>
                    		<input type="file" name="image" class="dropify" data-default-file="plugins/images/<?php echo $row['promoImage']?>">
                    		<input type="hidden" name="exist_image" value="<?php echo $row['promoImage']?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label" style="font-size:18px;">Start Date</label><span id="x" style="color:red"> *</span>
                          <input type="date" id="startDate" class="form-control" name="start" value="<?php echo $row['promoStartDate']?>"/> </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label" style="font-size:18px;">End</label><span id="x" style="color:red"> *</span>
                            <input type="date" id="endDate" class="form-control" name="end" value="<?php echo $row['promoEnd']?>"/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
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
                $rsql = "SELECT * FROM tblpromos a, tblpromo_condition b, tblpromo_promotion c WHERE a.promoID = b.conPromoID and a.promoID = c.proPromoID and promoID = $jsID";
                $rresult = mysqli_query($conn,$rsql);
                $row = mysqli_fetch_assoc($rresult);
                ?>
              <div class="modal-body">
        <div class="descriptions">
                            <div class="">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="white-box text-center"> <img src="plugins/images/<?php echo $row['promoImage']?>" alt="Unavailable" class="img-responsive"> </div>
                                    </div>
                                    <hr>
                                <h2 class="m-b-0 m-t-0" style="text-align: center;"><?php echo $row['promoName'];?></h2>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center;">
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
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <h3 class="box-title" style="text-align: center;">CONDITION</h3>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td width="390">Condition Category</td>
                                                        <td> <?php echo $row['conCategory'];?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="390">Condition</td>
                                                        <td> <?php echo $row['conData'];?> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <h3 class="box-title" style="text-align: center;">PROMO</h3>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td width="390">Promo Category</td>
                                                        <td> <?php echo $row['proCategory'];?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="390">Promo</td>
                                                        <td> <?php echo $row['proData'];?> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

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