<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
//session_start();
$arrayPrice = array();
$prod = array();

$jsID = "";

if(isset($_POST['id'])){
  $jsID = $_POST['id']; 
}

if(isset($_GET['id'])){
  $jsID = $_GET['id']; 
}


$_SESSION['varname'] = $jsID;
include 'dbconnect.php';
?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <title>Maintenance | Packages</title>

  <script>
  $(document).ready(function(){
    $('.search').on('keyup',function(){
      var searchTerm = $(this).val().toLowerCase();
      $('#tblPackages tbody tr').each(function(){
        var lineStr = $(this).text().toLowerCase();
        if(lineStr.indexOf(searchTerm) === -1){
          $(this).hide();
        }else{
          $(this).show();
        }
      });
    });
  });
  $(function(){

  $('#username').keyup(function(){
    var user = $(this).val();
    var flag = true;
    $.post('pack-check.php',{username : user}, function(data){
     
     if(data == 'Already Exist!'){
       
          $('#addFab').prop('disabled',true);
      $('#message').html(data);
      $('#username').css('border-color','red');
     }
     else if(data == 'Symbols not allowed'){
       
          $('#addFab').prop('disabled',true);
      $('#message').html(data);
      $('#username').css('border-color','red');
     }
     else if(data == 'No white Space'){
  

          $('#addFab').prop('disabled',true);
      $('#message').html(data);
      $('#username').css('border-color','red');
     }
     else if(data == ''){
      error = 0;
          $('#message').html('');
          $('#addFab').prop('disabled',true);
      $('#username').css('border-color','black');
     }

     
     else if(data == 'Good!'){
      error = 0;
       $('#message').html('');
     $('#addFab').prop('disabled',false);
      $('#username').css('border-color','limegreen');
     }
      
    
    });
    });

  });
   $(document).ready(function(){
   $('#thisPrice').keyup(function(event) {

    $('#suggestPrice').attr('checked',false);
  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40) return;

  // format number
  $(this).val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    ;
  });
  });
});
   function deleteRow(row){
        var result = confirm("Remove Product?");
        if(result){
              var i=row.parentNode.parentNode.rowIndex;
              document.getElementById('selectedProduct').deleteRow(i);
              }
   }
  </script>
</head>
<body class ="fix-header fix-sidebar">
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <div class="tab-content">

              <!-- NEW PACKAGE -->
              <div role="tabpanel" class="tab-pane fade active in" id="newpackage">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <form  action="add-Package.php" method="post">
                    <div class="panel-body">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                            <?php

                                $a = '';
                                if(isset($_POST['check'])){
                                    if(!empty($_POST['check'])) {

//Counting number of checked checkboxes 
                                      $checked_count = count($_POST['check']);
//Loop to store and display values of individual checked checkbox
                                      foreach($_POST['check'] as $selected) {
                                        //echo '<tr><input type="hidden" name="pr[]" value="'. $selected .'">';
                                        $sql = "SELECT * FROM tblproduct WHERE productID='$selected'";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result))
                                        {
                                          $a = str_replace( ',', '', $row['productPrice']);
                                          array_push($arrayPrice, $a);


                                          }
                                        }

                                      }
                                      else{
                                        echo "<b>Please Select Atleast One Option.</b>";
                                      }
                                    }
                            ?>

                              <label class="control-label">Name</label><span id="x" style="color:red">*</span>
                              <input type="text" id="username" class="form-control" placeholder="Christmas Package" name="pName" required/> <span id="message"></span>
                            </div>
                          </div><!--/span-->
                          <div class="col-md-6">
                            <div class="form-group">

                            <script type="text/javascript">
                              
                              $(document).ready(function(){
                              $('#suggestPrice').change(function(){
                                //
                                if($(this).prop('checked')){
                                  $(this).val(function(index, value) {
                                    return value
                                    .replace(/\D/g, "")
                                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                                    ;
                                  });
                                $('#thisPrice').val($('#suggestPrice').val());
                                }
                                else{
                                  $('#thisPrice').val(0);
                                }
                              });



                            });

                            </script>

                              <label class="control-label">Price</label><span id="x" style="color:red">*</span>
                              <input id="thisPrice" class="form-control" name="pPrice" style="text-align:right;" required/><input type="checkbox" id="suggestPrice" value="<?php echo array_sum($arrayPrice); ?>"/><label class="control-label">Suggested Price: <small>&#8369;</small><?php echo number_format(array_sum($arrayPrice),2); ?></label> 
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <h4><label class="control-label">&nbsp;&nbsp;Inclusions</label></h4>
                            <table class="table color-bordered-table muted-bordered-table" id="selectedProduct">
                              <thead>
                                <th>Product Category</th>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Product Price</th>
                                <th style="text-align: center;">Actions</th>
                              </thead>
                              <tbody>

                                  <?php
                                  include "dbconnect.php";

                                  

                                  if(isset($_POST['check'])){
                                    if(!empty($_POST['check'])) {

//Counting number of checked checkboxes 
                                      $checked_count = count($_POST['check']);
//Loop to store and display values of individual checked checkbox
                                      foreach($_POST['check'] as $selected) {
                                        echo '<tr><input type="hidden" name="pr[]" value="'. $selected .'">';
                                        $sql = "SELECT * FROM tblproduct a, tblfurn_category b WHERE a.prodCatID = b.categoryID and  a.productID='$selected'";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result))
                                        {
                                          echo ('
                                            <td>'.$row['categoryName'].'</td>
                                            <td>'.$row['productName'].'</td>
                                            <td>'.$row['productDescription'].'</td>
                                            <td>&#8369; '.number_format($row['productPrice'],2).'</td>
                                            
                                            <td style="text-align: center;"><button type="button" class="btn btn-danger" onclick="deleteRow(this)">Remove</button>
                                            </td></tr>');
                                          }
                                        }

                                      }
                                      else{
                                        echo "<b>Please Select Atleast One Option.</b>";
                                      }
                                    }

                                    ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success waves-effect text-left" id="addFab" disabled=""><i class="fa fa-check"></i> Save</button>
                          <a href="packages.php"><button type="button" class="btn btn-default">Cancel</button></a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.modal -->
            </div>
          </div>  
        </div>
      </div>
      <!-- /.container-fluid -->
      <!--footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer-->
    </div>
    <!-- /#page-wrapper -->

    <!-- View Package Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="viewPackageModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="view">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Package Information</h3>
          </div>
          <?php
          $sql = "SELECT * FROM tblpackages WHERE packageID = $jsID";
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($result);
          ?>
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Name</label>
                      <input type="text" id="firstName" class="form-control" placeholder="Fabulous Package" name="pName" value="<?php echo $row['packageDescription'];?>" disabled/> 
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Price</label>
                      <input id="firstName" class="form-control" placeholder="0.00" name="pPrice" value="<?php echo $row['packagePrice'];?>" disabled/> 
                    </div>
                  </div>
                </div>
              </div>

                <div class="form-body">
                  <div class="row">
                    <div class="form-group">
                      <table class="table color-bordered-table muted-bordered-table" id="tblCategories">
                        <thead>
                          <th style="text-align: center;">Furniture Type</th>
                          <th style="text-align: center;">Product Name</th>
                          <th style="text-align: center;">Product Price</th>
                        </thead>
                        <tbody style="text-align: center;">
                          <tr>
                            <?php
                            $sql = "SELECT * from tblpackages a inner join tblpackage_inclusions b on a.packageID = b.package_incID inner join tblproduct c on c.productID = b.product_incID inner join tblfurn_type d on d.typeID = c.prodTypeID WHERE a.packageID = '$jsID'";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result))
                            {
                              if($row['package_incStatus'] == 'Listed'){
                              echo ('<td>'.$row['typeName'].'</td>
                                <td>'.$row['productName'].'</td>
                                <td><small>&#8369;</small>'.$row['productPrice'].'</td>
                                ');?>
                              <?php echo ('</tr>');
                            }
                            }
                            ?>
                          </tr>
                        </tbody>
                      </table>
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

      <!-- View Order Management Package Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="viewPackageModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="viewOMPackage">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <?php
          $sql = "SELECT * FROM tblpackages WHERE packageID = $jsID";
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($result);
          ?>

          <div class="modal-body">
        <div class="descriptions">
                            <div class="">
                                <h2 class="m-b-0 m-t-0" style="text-align: center;"><?php echo $row['packageDescription'];?></h2>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center;">
                                        <h4>Price</h4>
                                        <h2 class="text-success" style="font-weight: bold;">&#8369;<?php echo $row['packagePrice'];?></h2>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <h3 class="box-title">PACKAGE INCLUSION</h3>
                    <div class="form-group">
                      <table class="table color-bordered-table muted-bordered-table" id="tblCategories">
                        <thead>
                          <th style="text-align: center;">Furniture Type</th>
                          <th style="text-align: center;">Product Name</th>
                          <th style="text-align: center;">Product Price</th>
                        </thead>
                        <tbody style="text-align: center;">
                          <tr>
                            <?php
                            $sql = "SELECT * from tblpackages a inner join tblpackage_inclusions b on a.packageID = b.package_incID inner join tblproduct c on c.productID = b.product_incID inner join tblfurn_type d on d.typeID = c.prodTypeID WHERE a.packageID = '$jsID'";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result))
                            {
                              if($row['package_incStatus'] == 'Listed'){
                              echo ('<td>'.$row['typeName'].'</td>
                                <td>'.$row['productName'].'</td>
                                <td><small>&#8369;</small>'.$row['productPrice'].'</td>
                                ');?>
                              <?php echo ('</tr>');
                            }
                            }
                            ?>
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
      <!-- /.modal -->


      <!-- Update Package Modal -->
      <div class="modal fade" tabindex="-1" role="dialog" id="updatePackageModal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" id="update">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 class="modal-title" id="modalProduct">Update Package</h3>
            </div>
            <form enctype="multipart/form-data" role="form" action="package-update.php" method="post">
              <div class="modal-body">
              
                <div class="descriptions">
                  <?php
                  $sql = "SELECT * FROM tblpackages WHERE packageID = $jsID";
                  $result = mysqli_query($conn,$sql);
                  $row = mysqli_fetch_assoc($result);
                  ?>

                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="hidden" name="id" value=<?php echo $row['packageID']?>>
                          <label class="control-label">Name</label><span id="x" style="color:red">*</span>
                          <input type="text" id="editname" class="form-control" placeholder="Fabulous Package" name="pName" value="<?php echo $row['packageDescription'];?>" required/><span id="message"></span> 
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Price</label><span id="x" style="color:red">*</span>
                          <input id="remText" class="form-control" placeholder="0.00" name="pPrice" value="<?php echo number_format($row['packagePrice'],2);?>" required/> 
                        </div>
                      </div>
                    </div>
                    <script>
                      $(function(){
                      $("#tempRemove").show();
                      $("#tblAdd").hide();
                      $("#showAdd").show();
                      $("#backAdd").hide();
                    });
                    </script>

                    <div id="showAdd">
                    <button type="button" style="margin-right:50px" class="btn btn-success waves-effect text-left pull-right" >Add Inclusion</button>
                    <h4><label class="control-label">&nbsp;&nbsp;Inclusions</label></h4>
                  </div>

                  <div  id="backAdd">
                    <button type="button" style="margin-right:50px" class="btn btn-danger waves-effect text-left pull-right" >Back</button>
                    <h4><label class="control-label">&nbsp;&nbsp;List of Products</label></h4>
                  </div>
                  
                    <div class="row">
                      <div class="form-group">
                        <div id="tempRemove">
                        <br>
                        <table class="table color-bordered-table muted-bordered-table" id="tblRemove">
                          <thead>
                                <th>Product Category</th>
                                <th>Product Name</th>
                                <th style="text-align: right;">Product Price</th>
                            <th style="text-align: center;">Actions</th>
                          </thead>
                          <tbody id="deleteTable">
                            
                              <?php
                              include "dbconnect.php";
                              $sql = "SELECT * from tblpackages a inner join tblpackage_inclusions b on a.packageID = b.package_incID inner join tblproduct c on c.productID = b.product_incID inner join tblfurn_category d on d.categoryID = c.prodCatID WHERE a.packageID = '$jsID'";
                              $result = mysqli_query($conn, $sql);
                              $countThis = 0;
                              while ($row = mysqli_fetch_assoc($result))
                              {

                                if($row['package_incStatus'] == "Listed"){
                                  $countThis++;
                                ?>
                                  <tr id="trowID<?php echo $row['package_inclusionID']; ?>"><input id="checkThis<?php echo $row['package_inclusionID']; ?>" type="checkbox" name="" value="<?php echo $row['package_inclusionID']; ?>" checked="" style="opacity:0; position:absolute; left:9999px;"/>
                                  <td><?php echo $row['categoryName'] ?></td>
                                  <td><?php echo $row['productName'] ?></<?php echo $row['categoryName'] ?>td>
                                  <td style="text-align: right;">&#8369;<?php echo number_format($row['productPrice'],2); ?></td>
                                  
                                  <td style="text-align: center;">
                                  <input onclick="deleteRow('<?php echo $row['package_inclusionID'] ?>','<?php echo $row['categoryName'] ?>','<?php echo $row['productName'] ?>','<?php echo $row['productPrice'] ?>')" id="hideThis" type="button" class="btn btn-danger waves-effect text-left" value="Remove"/>
                                  </td>
                                 </tr>

                                 <?php
                                }
                                }
                                ?>
                            </tbody>
                          </table>
                          </div>
                        </div>
                      </div>
                      <div id="tblAdd">
                      <table class="table color-bordered-table muted-bordered-table" id="tblAddInside">
                          <thead>
                                <th>Product Category</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                            <th style="text-align: center;">Actions</th>
                          </thead>
                          <tbody id="insertTable">
                            
                              <?php
                              include "dbconnect.php";
                              $sql = "SELECT * from tblproduct a, tblfurn_category b where a.prodCatID = b.categoryID and a.productID NOT IN (SELECT productID from tblproduct a, tblpackage_inclusions b, tblpackages c WHERE c.packageID = '$jsID' and b.package_incStatus = 'Listed' and c.packageID = b.package_incID AND a.productID = b.product_incID)";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {

                                if($row['prodStat'] != "Archived"){
                                echo ('

                                  ');?>
                                <tr id="addrowID<?php echo $row['productID'] ?>">
                                  <input id="checkThisAgain<?php echo $row['productID'] ?>" type="checkbox" name="" value='<?php echo $row['productID'] ?>' checked="" style="opacity:0; position:absolute; left:9999px;"/>
                                  <td><?php echo $row['categoryName'] ?></td>
                                  <td id="incName"><?php echo $row['productName'] ?></td>
                                  <td id="incPrice">&#8369; <?php echo number_format($row['productPrice'],2); ?></td>
                                  <td style="text-align: center;">
                                  <input onclick="insRow('<?php echo $row['productID'] ?>','<?php echo $row['categoryName'] ?>','<?php echo $row['productName'] ?>','<?php echo $row['productPrice'] ?>')" type="button" class="btn btn-success waves-effect text-left" value="Add"></input>
                                  </td>
                                  </tr>
                                  <?php
                                }
                                }
                                ?>
                            </tbody>
                          </table>
                          </div>
                    </div>

                  </div>

                </div>
                <div class="modal-footer">
                  <button id="updateBtn" type="submit" class="btn btn-success waves-effect text-left" disabled=""><i class="fa fa-check"></i> Save</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                </div>

              </div>
            </form>
          </div>
        </div>
        <!-- /.modal -->

        <!-- Delete Package Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="deletePackageModal" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content" id="delete">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">Deactivate Package</h3>
              </div>
              <div class="modal-body">
                <h4>Are you sure you want to deactivate this package?</h4>
              </div>
              <div class="modal-footer">
                <a href="delete-package.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
                <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </body> 
      </html>