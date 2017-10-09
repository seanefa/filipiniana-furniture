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
<script type="text/javascript">

</script>
<body>
        <!-- Update User Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="updateCustomerModal" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" id="update">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="modalProduct">Update Customer</h3>
              </div>
              <form action="user-update.php" method="post" role="form">
                <div class="modal-body">
                  <div class="descriptions">
                    <?php
                    $tsql = "SELECT * FROM tblcustomer WHERE customerID = $jsID";
                    $tresult = mysqli_query($conn,$tsql);
                    $trow = mysqli_fetch_assoc($tresult);
                    ?>
                    <div class="form-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="control-label">Employee Name</label><span id="x" style="color:red"> *</span>
                                <select id="select" class="form-control" tabindex="1" name="job">
                                  <?php
                                  include "dbconnect.php";
                                  $sql = "SELECT * FROM tblcustomer order by customerID;";
                                  $result = mysqli_query($conn, $sql);
                                  while ($row = mysqli_fetch_assoc($result))
                                  {
                                    if($row['customerStatus']=='Active'){
                                      if ($trow["userEmpID"] == $row['empID'])
                                      {
                                        echo('<option value='.$row['empID'].'" selected="selected">'.$row['empID'].'>'.$row['empLastName'].', '.$row['empMidName'].' '.$row['empFirstName'].'</option>');
                                      }
                                      else
                                      {
                                      echo('<option value='.$row['empID'].'>'.$row['empLastName'].', '.$row['empMidName'].' '.$row['empFirstName'].'</option>');
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
                              <label class="control-label">Username</label><span id="x" style="color:red"> *</span>
                              <input type="text" id="first" class="form-control" name="fn" required/><span id="messagefirst"></span></div>
                            </div>
                          </div>
                            <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Password</label><span id="x" style="color:red"> *</span>
                                <input type="password" id="first" class="form-control" name="fn" required/><span id="messagefirst"></span></div>
                              </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Confirm Password</label><span id="x" style="color:red"> *</span>
                                <input type="password" id="first" class="form-control" name="fn" required/><span id="messagefirst"></span></div>
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
              <!-- Delete User Modal -->
              <div class="modal fade" tabindex="-1" role="dialog" id="deleteUserModal" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                  <div class="modal-content" id="delete">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h3 class="modal-title">Deactivate User</h3>
                    </div>
                    <div class="modal-body">
                      <h4>Are you sure you want to deactivate this User?</h4>
                    </div>
                    <div class="modal-footer">
                      <a href="delete-user.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
                      <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
            </body>
            </html>
