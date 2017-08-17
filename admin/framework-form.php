<?php
session_start();
if(isset($GET['id'])){
  $jsID = $_GET['id']; 
}
$jsID=$_GET['id'];

$_SESSION['varname'] = $jsID;
include 'dbconnect.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>
<!-- New Framework Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="newFrameworkModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="new">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">New Framework</h3>
      </div>
      <form enctype="multipart/form-data" action="add-Framework.php" method="post" role="form">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">
              <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
                  <select class="form-control" tabindex="1" id="type" name="type" id="type" required>
                    <option value="" selected disabled>Choose Furniture Type</option>
                    <?php
                    $sql = "SELECT * FROM tblfurn_type order by typeName;";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                      if($row['typeStatus']=='Listed'){
                        echo('<option value='.$row['typeID'].'>'.$row['typeName'].'</option>');
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
                    <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                    <input type="text" id="frameName" class="form-control" name="name" required/><span id="frameNameValidate"></span> </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Material</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" tabindex="1" name="material" required>
                        <option value="" selected disabled>Choose Frame Material</option>
                        <?php
                        include "dbconnect.php";
                        $sql = "SELECT * FROM tblframe_material order by materialName;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['materialStatus']=='Listed'){
                            echo('<option value='.$row['materialID'].'>'.$row['materialName'].'</option>');
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Design</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" tabindex="1" name="design" required>
                        <option value="" selected disabled>Choose Frame Design</option>
                        <?php
                        include "dbconnect.php";
                        $sql = "SELECT * FROM tblframe_design order by designName;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['designStatus']=='Listed'){
                            echo('<option value='.$row['designID'].'>'.$row['designName'].'</option>');
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <label class="box-title">Remarks</label>
                <div class="row">
                  <div class="col-md-12 ">
                    <div class="form-group">
                      <textarea class="form-control" rows="4" name="remarks"> </textarea>
                    </div>
                  </div>
                </div>
                <!--/row-->
                <div class="row">
                  <div id="toUpload" class="col-md-12">
                    <h3 class="box-title m-t-20">Upload Image<span id="x" style="color:red"> * </span></h3>
                    <div class="product-img"><br>
                      <!--<button id="openCanvas" class="btn-success" type="button">Make your own</button> -->
                      <input type="file" name="image" class="dropify" required>
                    </div>
                  </div>
                  
                  <!--div id="toCustomize" class="col-md-12" style="display: none">
                    <h3 class="box-title m-t-20">Make your own<span id="x" style="color:red"> * </span></h3>
                    <div class="product-img"><br>
                    <div  id="anotherDesign" style="display: none">
                       <button type="button" class='btn btn-primary' id="newDesign">New Design</button>
                       </div>
                      <button id="closeCanvas" class="btn-success" type="button">Upload Image</button>
                      <Input value="Save Design" id="saveDesign" class="btn-success" type="button"/>
                      <div class="literCanvas"></div>
                      <img src='' style="display: none,width:160px;height:160px;" id="savedImage">
                      
                      
                    </div>
                  </div-->
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success waves-effect text-left" id="saveBtn" disabled=""><i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
          </div>								  
        </form>
      </div>
    </div>
  </div>
  <!-- /.modal -->
  <!-- View Framework Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="viewFrameworkModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="view">
        <?php 

        $tsql = "SELECT * FROM tblframeworks WHERE frameworkID = $jsID;";
        $tresult = mysqli_query($conn,$tsql);
        $trow = mysqli_fetch_assoc($tresult);

        ?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <div class="descriptions">
            <div class="">
              <h2 class="m-b-0 m-t-0" style="text-align: center;"><?php echo $trow['frameworkName'];?></h2>
              <hr>
              <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-6">
                  <div class="white-box text-center"> <img src="plugins/images/<?php echo $trow['frameworkPic']?>" alt="Unavailable" class="img-responsive"> </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">



                  <h4 class="box-title m-t-40">Remarks</h4>
                  <p><?php echo $trow['frameworkRemarks'];?></p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">

                  <h3 class="box-title">General Info</h3>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <?php
                          include "dbconnect.php";
                          $sql = "SELECT * FROM tblframe_design;";
                          $result = mysqli_query($conn, $sql);
                          $row = mysqli_fetch_assoc($result);
                          ?>
                          <td width="390">Design</td>
                          <td> <?php echo $row['designName'];?> </td>
                        </tr>
                        <tr>
                          <?php
                          include "dbconnect.php";
                          $sql = "SELECT * FROM tblframe_material;";
                          $result = mysqli_query($conn, $sql);
                          $row = mysqli_fetch_assoc($result);
                          ?>
                          <td>Material</td>
                          <td> <?php echo $row['materialName'];?> </td>
                        </tr>
                                                  <!--tr>
                                                      <td>Style</td>
                                                      <td> Contemporary &amp; Modern </td>
                                                  </tr>
                                                  <tr>
                                                      <td>Wheels Included</td>
                                                      <td> Yes </td>
                                                  </tr>
                                                  <tr>
                                                      <td>Upholstery Included</td>
                                                      <td> Yes </td>
                                                  </tr>
                                                  <tr>
                                                      <td>Upholstery Type</td>
                                                      <td> Cushion </td>
                                                  </tr>
                                                  <tr>
                                                      <td>Head Support</td>
                                                      <td> No </td>
                                                  </tr>
                                                  <tr>
                                                      <td>Suitable For</td>
                                                      <td> Study &amp; Home Office </td>
                                                  </tr>
                                                  <tr>
                                                      <td>Adjustable Height</td>
                                                      <td> Yes </td>
                                                  </tr>
                                                  <tr>
                                                      <td>Model Number</td>
                                                      <td> F01020701-00HT744A06 </td>
                                                  </tr>
                                                  <tr>
                                                      <td>Armrest Included</td>
                                                      <td> Yes </td>
                                                  </tr>
                                                  <tr>
                                                      <td>Care Instructions</td>
                                                      <td> Handle With Care, Keep In Dry Place, Do Not Apply Any Chemical For Cleaning. </td>
                                                  </tr>
                                                  <tr>
                                                      <td>Finish Type</td>
                                                      <td> Matte </td>
                                                    </tr-->
                                                  </tbody>
                                                </table>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- /.modal -->
                              <!-- Update Framework Modal -->
                              <div class="modal fade" tabindex="-1" role="dialog" id="updateFrameworkModal" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content" id="update">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                      <h3 class="modal-title" id="modalProduct">Update Framework</h3>
                                    </div>
                                    <form enctype="multipart/form-data" role="form" action="framework-update.php" method="post" role="form">
                                      <div class="modal-body">
                                        <div class="descriptions">
                                          <?php
                                          $rsql = "SELECT * FROM tblframeworks WHERE frameworkID = $jsID";
                                          $rresult = mysqli_query($conn,$rsql);
                                          $rrow = mysqli_fetch_assoc($rresult);
                                          ?>

                                          <div class="form-body">
                                            
											  <div class="row">
											  <div class="col-md-12">
												<div class="form-group">
												  <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
												  <select class="form-control" tabindex="1" id="type" name="type" id="type" required>
													<option value="" selected disabled>Choose Furniture Type</option>
													<?php
													$sql = "SELECT * FROM tblfurn_type order by typeName;";
													$result = mysqli_query($conn, $sql);
													while ($row = mysqli_fetch_assoc($result))
													{
													  if($row['typeStatus']=='Listed'){
														echo('<option value='.$row['typeID'].'>'.$row['typeName'].'</option>');
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
                                                  <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                                                  <input type="text" id="editname" class="form-control" name="name" value="<?php echo $trow['frameworkName']; $_SESSION['tempname'] = $trow['frameworkName'];?>" required/><span id="message"></span> </div>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label class="control-label">Material</label>
                                                    <select id="select" class="form-control" tabindex="1" name="material">
                                                    <option value="" disabled>Choose Frame Material</option>
                                                      <?php
                                                      include "dbconnect.php";
                                                      $sql = "SELECT * FROM tblframe_material order by materialName;";
                                                      $result = mysqli_query($conn, $sql);
                                                      while ($row = mysqli_fetch_assoc($result))
                                                      {
                                                        if($row['materialStatus']=='Listed'){
                                                          echo('<option value='.$row['materialID'].'>'.$row['materialName'].'</option>');
                                                        }
                                                      }
                                                      ?>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label class="control-label">Design</label>
                                                    <select id="select" class="form-control" data-placeholder="Choose Frame Design" tabindex="1" name="design"> 
                                                      <option value="" disabled>Choose Frame Pattern</option>
                                                      <?php
                                                      include "dbconnect.php";
                                                      $sql = "SELECT * FROM tblframe_design order by designName;";
                                                      $result = mysqli_query($conn, $sql);
                                                      while ($row = mysqli_fetch_assoc($result))
                                                      {
                                                          if($row['designStatus']=='Listed'){
                                                            if ($trow["framedesignID"] == $row['designID'])
                                                            {
                                                              echo('<option value="'.$row['designID'].'" selected="selected">'.$row['designName'].'</option>');
                                                            }
                                                            else
                                                            {
                                                              echo('<option value='.$row['designID'].'>'.$row['designName'].'</option>');
                                                            }

                                                          }
                                                        }
                                                        ?>
                                                      </select>
                                                    </div>
                                                  </div>
                                                </div>
                                                <label class="box-title">Remarks</label>
                                                <div class="row">
                                                  <div class="col-md-12 ">
                                                    <div class="form-group">
                                                      <textarea id="remText" class="form-control" rows="4" name="remarks"><?php echo $trow['frameworkRemarks'];?></textarea>
                                                    </div>
                                                  </div>
                                                </div>
                                                <!--/row-->
                                                <div class="row">
                                                  <div class="col-md-12">
                                                    <h3 class="box-title m-t-20">Upload Image</h3>
                                                    <div class="product-img"><br>
                                                      <input type="file" name="image" class="dropify" data-default-file="plugins/images/<?php echo $trow['frameworkPic']?>">
                                                      <input type="hidden" name="exist_image" value="<?php echo $trow['frameworkPic']?>">
                                                    </div>
                                                  </div>
                                                </div>


                                              </div> 

                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-success waves-effect text-left" id="updateBtn" disabled=""><i class="fa fa-check"></i> Save</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                  <!-- /.modal -->

                                  <!-- Delete Framework Modal -->
                                  <div class="modal fade" tabindex="-1" role="dialog" id="deleteFrameworkModal" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                      <div class="modal-content" id="delete">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                          <h3 class="modal-title">Deactivate Framework</h3>
                                        </div>
                                        <div class="modal-body">
                                          <h4>Are you sure you want to deactivate this Framework?</h4>
                                        </div>
                                        <div class="modal-footer">
                                          <a href="delete-framework.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
                                          <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>