<?php
include "titleHeader.php";
include "menu.php";
include "dbconnect.php";
include 'toastr-buttons.php';

if (!empty($_SESSION['createSuccess'])) {
  echo  '<script>
          $(document).ready(function () {
            $("#toastNewSuccess").click();
          });
        </script>';
  unset($_SESSION['createSuccess']);
}
if (!empty($_SESSION['updateSuccess'])) {
  echo  '<script>
          $(document).ready(function () {
            $("#toastUpdateSuccess").click();
          });
        </script>';
  unset($_SESSION['updateSuccess']);
}
if (!empty($_SESSION['deactivateSuccess'])) {
  echo  '<script>
          $(document).ready(function () {
            $("#toastDeactivateSuccess").click();
          });
        </script>';
  unset($_SESSION['deactivateSuccess']);
}
if (!empty($_SESSION['reactivateSuccess'])) {
  echo  '<script>
          $(document).ready(function () {
            $("#toastReactivateSuccess").click();
          });
        </script>';
  unset($_SESSION['reactivateSuccess']);
}
if (!empty($_SESSION['actionFailed'])) {
  echo  '<script>
          $(document).ready(function () {
            $("#toastFailed").click();
          });
        </script>';
  unset($_SESSION['actionFailed']);
}

?>
<!DOCTYPE html>  
<html lang="en">
<head>
</head>
<body>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
              <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#newAccountModal" href="" data-remote="" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i class="ti-user"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- ACCOUNTS -->
              <div role="tabpanel" class="tab-pane fade active in" id=frameworks>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">                  
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblAccounts">
                          <thead>
                            <tr>
                              <th style="text-align: center;">Username</th>
                              <th style="text-align: center;">Password</th>
                              <th style="text-align: center;">Actions</th>
                            </tr>
                          </thead>
                          <tbody style="text-align: center;">
                            
                              <?php
                              $sql = "SELECT * FROM tblpenalty;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['penStatus']=="Listed"){
                                  echo('<tr><td>'.$row['penaltyName'].'</td>
                                  <td>'.$row['penaltyRemarks'].'</td>'); ?>
                                  <td>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateAccountModal">Update</button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAccountModal">Delete</button>
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
                 <!-- New Account Modal -->
                 <div class="modal fade" tabindex="-1" role="dialog" id="newAccountModal" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="modalProduct">New Account</h3>
                      </div>
                      <form action="add-account.php" method = "post">
                        <div class="modal-body">
                          <div class="descriptions">
                            <div class="form-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="control-label">Username</label>
                                    <input type="text" id="firstName" class="form-control" name="username" required/> </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="control-label">Password</label>
                                      <input type="text" id="firstName" class="form-control" name="pass" required/> 
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                          <button type="submit" class="btn btn-success waves-effect text-left"><i class="fa fa-check"></i> Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- /.modal -->
                  <!-- Update Account Modal -->
                  <div class="modal fade" tabindex="-1" role="dialog" id="updateAccountModal" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h3 class="modal-title" id="modalProduct">Update Account</h3>
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
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="control-label">Username</label>
                                    <input type="text" id="firstName" class="form-control" name="name" required/> </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="control-label">Password</label>
                                      <input type="text" id="firstName" class="form-control" name="carving" required/> 
                                    </div>
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
                  <!-- Delete Account Modal -->
                  <div class="modal fade" tabindex="-1" role="dialog" id="deleteAccountModal" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h3 class="modal-title">Delete Account</h3>
                        </div>
                        <div class="modal-body">
                          <h4>Are you sure you want to delete this account?</h4>
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
        <footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer>
      </div>
    </div>
  </body>
  </html>