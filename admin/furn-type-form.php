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
  <div class="modal fade" tabindex="-1" role="dialog" id="newFurnitureTypeModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="new">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">New Furniture Type</h3>
        </div>
        <form action="add-Type.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Category</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="cat">
                        <option value="0">Choose Category</option>
                        <?php
                        $sql = "SELECT * FROM tblfurn_category order by categoryName;";
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
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="username" class="form-control" placeholder="Name" name="ctgName" required><span id="message" required></span>
                    </div>
                  </div>
                </div>

                <label class="box-title">Description</label>
                <div class="row">
                  <div class="col-md-12 ">
                    <div class="form-group">
                      <textarea class="form-control" id="categoryName" name="desc"> </textarea>
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
  <!-- Update Furniture Type Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="updateFurnitureTypeModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="update">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Update Furniture Type</h3>
        </div>
        <form action="furn-type-update.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <?php
              $tsql = "SELECT * FROM tblfurn_type WHERE typeID = $jsID";
              $tresult = mysqli_query($conn,$tsql);
              $trow = mysqli_fetch_assoc($tresult);
              $catID = $trow["typeCategoryID"];
              ?>

              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Category</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="cat" id="select">
                        <option value="--">Choose Category</option>
                        <?php
                        $sql = "SELECT * FROM tblfurn_category;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['categoryStatus']=='Listed'){
                            if ($trow["typeCategoryID"] == $row['categoryID'])
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
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="editname" class="form-control" placeholder="Name" name="name" value="<?php echo $trow['typeName']; $_SESSION['tempname'] = $trow['typeName'];?>" required><span id="message"></span>
                    </div>
                  </div>
                </div>

                <label class="box-title">Description</label>
                <div class="row">
                  <div class="col-md-12 ">
                    <div class="form-group">
                      <textarea class="form-control" id="remText" name="desc"><?php echo $trow['typeDescription'];?></textarea>
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
        </form>
      </div>
    </div>
  </div>
  <!-- /.modal -->
  <!-- Delete Furniture Type Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="deleteFurnitureTypeModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content" id="delete">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title">Deactivate Furniture Type</h3>
        </div>
        <div class="modal-body">
          <h4>Are you sure you want to deactivate this Furniture Type?</h4>
        </div>
        <div class="modal-footer">
          <a href="delete-furn-type.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
          <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>