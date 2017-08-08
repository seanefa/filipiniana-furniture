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
<!DOCTYPE>
<html>
<head>
</head>
<body>
  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="addFab">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">New Fabric</h3>
        </div>
        <form enctype="multipart/form-data" action="add-Fabrics.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                      <input placeholder="Gold Rani" type="text" id="username" class="form-control" name="name" required/><span id="fabricNameValidate"></span> 
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" tabindex="1" name="type" required>
                      <option value="" selected disabled>Select Fabric Type</option>
                        <?php
                        $sql = "SELECT * FROM tblfabric_type order by f_typeName;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['f_typeStatus']=='Listed'){
                            echo('<option value='.$row['f_typeID'].'>'.$row['f_typeName'].'</option>');
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Pattern</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" tabindex="1" name="pattern" required>
                      <option value="" selected disabled>Select Fabric Pattern</option>
                      <?php
                      $sql = "SELECT * FROM tblfabric_pattern order by f_patternName;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['f_patternStatus']=='Listed'){
                          echo('<option value='.$row['f_patternID'].'>'.$row['f_patternName'].'</option>');
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Color</label><span id="x" style="color:red"> *</span>
                    <input type="color" id="colorPick" class="form-control" name="color[]" required/>
                    <div id="addHere"></div>
                    <input type="hidden" id="delPicker" class="btn btn-default" value="-"/>
                    <button type="button" id="addPicker" class="btn btn-default"><i class="ti-plus"></i></button> 
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
                      <div class="col-md-12">
                      <h3 class="box-title m-t-20">Upload Image</h3>
                      <div class="product-img"><br>
                      <input type="file" name="image" class="dropify">
                      </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success waves-effect text-left"  id="addBtn" disabled=""><i class="fa fa-check"></i> Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Update Fabric Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="updateFab">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Update Fabric</h3>
          </div>
          <form enctype="multipart/form-data" action="fabrics-update.php" method="post" role="form">
            <div class="modal-body">
              <div class="descriptions">
                <?php
                $tsql = "SELECT * FROM tblfabrics WHERE fabricID = '$jsID'";
                $tresult = mysqli_query($conn,$tsql);
                $trow = mysqli_fetch_assoc($tresult);
                ?>
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Name</label><span id="x" style="color:red">*</span>
                        <input placeholder="Gold Rani" type="text" id="editname" class="form-control" name="name" value="<?php echo $trow['fabricName']; $_SESSION['tempname'] = $trow['fabricName'];?>" required/> <span id="message"></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Type</label><span id="x" style="color:red">*</span>
                        <select id="select" class="form-control" tabindex="1" name="type" required="">
                      <option value="" disabled>Select Fabric Type</option>
                          <?php
                          $sql = "SELECT * FROM tblfabric_type;";
                          $result = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($result))
                          {
                            if($row['f_typeStatus']=='Listed'){
                              echo('<option value='.$row['f_typeID'].'>'.$row['f_typeName'].'</option>');
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Pattern</label><span id="x" style="color:red">*</span>
                      <select id="select" class="form-control" tabindex="1" name="pattern" required>

                      <option value="" disabled>Select Fabric Pattern</option>
                        <?php
                        $colorArray = explode(",",$trow['fabricColor']);
                        $colorCtr = count($colorArray);
                        $sql = "SELECT * FROM tblfabric_pattern;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['f_patternStatus']=='Listed'){
                            echo('<option value='.$row['f_patternID'].'>'.$row['f_patternName'].'</option>');
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Color</label><span id="x" style="color:red">*</span>
                      <div id="colorPick">
                      <?php
                      while($colorCtr !=0){
                      echo '<input type="color" id="thisColor'.$colorCtr.'" class="form-control" placeholder="Golden Yellow" name="colors[]" value="'.$colorArray[$colorCtr-1].'" required/>';
                      $colorCtr--;
                      }
                      ?>
                      </div>
                      <div id="addHere"></div>
                      <input type="hidden" id="delPicker" class="btn btn-default" value="-"/><button type="button" id="addPicker" class="btn btn-default"><i class="ti-plus"></i></button>

                </div>

                    </div>
                  </div>
                  </div>
                  <label class="box-title">Remarks</label>
                  <div class="row">
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <textarea id="remText" class="form-control" rows="4" name="Remarks"><?php echo $trow['fabricRemarks']?></textarea>
                      </div>
                    </div>
                  </div>
                  <!--/row-->
                  <div class="row">
                  <div class="col-md-12">
                    <h3 class="box-title m-t-20">Upload Image</h3>
                    <input type="file" name="image" class="dropify" data-default-file="plugins/images/<?php echo $trow['fabricPic']?>">
                    </div>
                  </div>
                  </div>
                </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect text-left" id="updateBtn" disabled=""><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
              </div>
              </div>
           
          </div>
        </div>

      </div>
      </div>

      <!-- Delete Fabric Modal -->
      <div class="modal fade" tabindex="-1" role="dialog" id="deleteFabricModal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" >
          <div class="modal-content" id="delFab">
            <form action="delete-fabric.php" method="post" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">Deactivate Fabric</h3>
                <!--<?php// echo "<p>".$jsID; ?>-->
              </div>
              <div class="modal-body">
                <h4>Are you sure you want to deactivate this Fabric?</h4>
              </div>
              <div class="modal-footer">
                <a href="delete-fabric.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>

                <script>
                  function deleteConfirm(id){
                    if(confirm("Delete?")){

                      window.location.href="delete-fabric.php?id="+id+"";
                    }
                  }     
                </script>
                <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- View Fabric Modal -->
      <div class="modal fade" tabindex="-1" role="dialog" id="viewFabricModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="viewFab">
         <?php

              $tsql = "SELECT * FROM tblfabrics WHERE fabricID = '$jsID';";
              $tresult = mysqli_query($conn,$tsql);
              $trow = mysqli_fetch_assoc($tresult);
              $type = $trow['fabricTypeID'];
              $pattern = $trow['fabricPatternID'];

              $asql = "SELECT * FROM tblfabric_type WHERE f_typeID = '$type';";
              $aresult = mysqli_query($conn,$asql);
              $arow = mysqli_fetch_assoc($aresult);

              $bsql = "SELECT * FROM tblfabric_pattern WHERE f_patternID = '$pattern';";
              $bresult = mysqli_query($conn,$bsql);
              $brow = mysqli_fetch_assoc($bresult);

              ?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <div class="descriptions">
            <div class="">
              <h2 class="m-b-0 m-t-0" style="text-align: center;"><?php echo $trow['fabricName'];?></h2>
              <hr>
              <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-6">
                  <div class="white-box text-center"> <img src="plugins/images/<?php echo $trow['fabricPic']?>" alt="Unavailable"> </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">



                  <h4 class="box-title m-t-40">Remarks</h4>
                  <p><?php echo $trow['fabricRemarks'];?></p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
<?php
                      $colorArray = explode(",",$trow['fabricColor']);
                        $colorCtr = count($colorArray);
              ?>
                  <h3 class="box-title">General Info</h3>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td width="390">Type</td>
                          <td> <?php echo $arow['f_typeName'];?> </td>
                        </tr>
                        <tr>
                          <td>Pattern</td>
                          <td> <?php echo $brow['f_patternName'];?> </td>
                        </tr>
                        <tr>
                          <td>Color</td>
                          <td> <?php while($colorCtr != 0){ 
                                      echo'<input type="img" style="background-color:'.$colorArray[$colorCtr-1].'; width:75pt" />'; 
                                      $colorCtr--;
                                    }?> </td>
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
                                      <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
    </body>
    </html>