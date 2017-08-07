<?php
include "titleHeader.php";
include "menu.php";
include "dbconnect.php";
//session_start();
/*if(isset($GET['id'])){
   $jsID = $_GET['id']; 
 }
 $jsID=$_GET['id'];
 $_SESSION['varname'] = $jsID;*/
 include 'dbconnect.php';
 $conn = mysqli_connect($servername, $username, $password, $dbname);
 if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>  
<html lang="en">
<head>
</head>
<body class ="fix-header fix-sidebar">
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
              <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#newUserModal" href="" data-remote="" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i class="icon-people"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- PACKAGES -->
              <div role="tabpanel" class="tab-pane fade active in" id=frameworks>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">                  
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblUsers">
                          <thead>
                            <tr>
                              <th style="text-align: center;">Username</th>
                              <th style="text-align: center;">First Name</th>
                              <th style="text-align: center;">Middle Name</th>
                              <th style="text-align: center;">Last Name</th>
                              <th style="text-align: center;">Actions</th>
                            </tr>
                          </thead>
                          <tbody style="text-align: center;">
                            
                              <?php
                              $sql = "SELECT * FROM tbluser;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['userStatus']=="Listed"){
                                  echo('<tr><td>'.$row['userName'].'</td>
                                  <td>'.$row['userName'].'</td>
                                   <td>'.$row['Name'].'</td>
                                    <td>'.$row['userName'].'</td>
                                     <td>'.$row['userName'].'</td>
                                     '); ?>
                                  <td>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateUserModal">Update</button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal">Delete</button>
                                  </td>
                                  <?php echo('</tr>');} }
                                  ?>
                                
                                <script>
                                  function confirmDelete(id) {
                                   window.location.href="delete-frame.php?id="+id+"";
                                 }
                                 function edit(id) {
                                   window.location.href="update-framework.php?id="+id+"";
                                 }
                               </script>
                             </tbody>
                           </table>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
                 <!-- New User Modal -->
                 <div class="modal fade" tabindex="-1" role="dialog" id="newUserModal" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="modalProduct">New User</h3>
                      </div>
                      <form action="add-User.php" method = "post">
                        <div class="modal-body">
                          <div class="descriptions">
                            <div class="form-body">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="control-label">Username</label>
                                    <input type="text" id="uName" class="form-control" name="name" required/> </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">First Name</label>
                                      <input type="text" id="fName" class="form-control" name="carving" required/> 
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Middle Name</label>
                                      <input type="text" id="mName" class="form-control" name="name" required/> </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                        <input type="text" id="lName" class="form-control" name="carving" required/> 
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="control-label">Password</label>
                                        <input type="text" id="passW" class="form-control" name="name" required/> </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-success waves-effect text-left" ><i class="fa fa-check"></i> Save</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                  </div>
                                </div>
                              </div> 
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- /.modal -->
                      <!-- Update User Modal -->
                      <div class="modal fade" tabindex="-1" role="dialog" id="updateUserModal" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h3 class="modal-title" id="modalProduct">Update User</h3>
                            </div>
                            <div class="modal-body">
                              <div class="descriptions">
                                <?php
                                $rsql = "SELECT * FROM tblframeworks WHERE frameworkID = $jsID";
                                $rresult = mysqli_query($conn,$rsql);
                                $rrow = mysqli_fetch_assoc($rresult);
                                ?>
                                <form action="update-package.php" method="post">
                                 <div class="form-body">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="control-label">Username</label>
                                        <input type="text" id="firstName" class="form-control" name="name" required/> </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label class="control-label">First Name</label>
                                          <input type="text" id="firstName" class="form-control" name="carving" required/> 
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label class="control-label">Middle Name</label>
                                          <input type="text" id="firstName" class="form-control" name="name" required/> </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" id="firstName" class="form-control" name="carving" required/> 
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="text" id="firstName" class="form-control" name="name" required/> </div>
                                          </div>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success waves-effect text-left" data-dismiss="modal"><i class="fa fa-check"></i> Save</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /.modal -->
                          <!-- Delete User Modal -->
                          <div class="modal fade" tabindex="-1" role="dialog" id="deleteUserModal" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h3 class="modal-title">Delete User</h3>
                                </div>
                                <div class="modal-body">
                                  <h4>Are you sure you want to delete this user?</h4>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger waves-effect text-left" onclick="javascript:confirmDelete(<?php echo $row['frameworkID']; ?>)">Confirm</button>
                                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /.modal -->
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>
                <!--footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer-->
              </div>
            </div>
          </body>
          </html>