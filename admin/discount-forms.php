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
<!-- New Framework Material Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="newFrameworkMaterialModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="new">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">New Discount</h3>
      </div>
      <form action="discount-add.php" method = "post" id="varform">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                    <input type="text" id="discountName" class="form-control" name="discount_name" required><span id="discountNameValidate"></span> 
                  </div>
                </div>
				  <div class="col-md-6">
					 <div class="form-group">
                <label class="control-label">Percentage</label><span id="x" style="color:red"> *</span>
                <input type="number" id="discountName" class="form-control" name="discount_percentage" required><span id="discountPercentageValidate"></span> 
				  </div>
					  </div>
              </div>

            </div>
          </div>
        </div>
        <div class="modal-footer"><span id="notif" style="color:red"></span>
          <button type="submit" class="btn btn-success waves-effect text-left" id="saveBtn"><i class="fa fa-check"></i> Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        </div>                
      </form>
    </div>
  </div>
</div>
<!-- /.modal 
  <!-- Update Framework Material Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="updateFrameworkMaterialModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="update">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Update Discount</h3>
        </div>
        <form enctype="multipart/form-data" role="form" action="discount-update.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <?php
              //$tsql = "SELECT * FROM tblmaterials a, tblmat_attribs b, tblattributes c WHERE b.matID = a.materialID AND b.attribID = c.attributeID AND a.materialID = '$jsID';"; 
              $tsql = "SELECT * FROM tbldiscounts WHERE discountID = '$jsID';";
              $tresult = mysqli_query($conn,$tsql);
              $trow = mysqli_fetch_assoc($tresult);
              ?>
				
			<input type="hidden" name="id" value="<?php echo "" . $trow['discountID'];?>">
              <div class="form-body">
				  
                
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                    <input type="text" id="discountName" class="form-control" name="discount_name" value="<?php echo "" . $trow["discountName"];?>" required><span id="discountNameValidate"></span> 
                  </div>
                </div>
				  <div class="col-md-6">
					 <div class="form-group">
                <label class="control-label">Percentage</label><span id="x" style="color:red"> *</span>
                <input type="number" id="discountName" class="form-control" name="discount_percentage" value="<?php echo "" . $trow["discountPercentage"];?>" required><span id="discountPercentageValidate"></span> 
				  </div>
					  </div>
              </div>

                      <input type="hidden" name="intags" id="intags" >

                    </div>

                  </div>
                </div>
                <div class="modal-footer"><span id="notif" style="color:red"></span>
                  <button type="submit" class="btn btn-success waves-effect text-left" id="updateBtn"><i class="fa fa-check"></i> Save</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                </div>

              </div>
            </form>
          </div>
        </div>
        <!-- /.modal -->

        <!-- Delete Framework Material Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="deleteFrameworkMaterialModal" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content" id="delete">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">Deactivate Material</h3>
              </div>
              <div class="modal-body">
                <h4>Are you sure you want to deactivate this Discount?</h4>
              </div>
              <div class="modal-footer">
                <a href="discount-delete.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
                <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>