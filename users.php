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
 if (!$conn)
 {
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
              <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#myModal" href="users-form.php" data-remote="users-form.php #new" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
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
                              <th>Employee Name</th>
                              <th>Job</th>
                              <th>Username</th>
                              <th>Date Created</th>
                              <th class="removeSort">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                              <?php
                              $sql = "SELECT * FROM tblemployee a inner join tbluser b on a.empID = b.userID order by a.empID desc";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['userStatus']=="active" && $row['userType']=="admin"){
                                  echo('<tr><td>'.$row['empLastName'].', '.$row['empMidName'].' '.$row['empFirstName'].'</td>');
                                  $job = jName($row['empJobID']);
                                  echo ('<td>'.$job.'</td>
                                  <td>'.$row['userName'].'</td>
                                  <td>'.$row['dateCreated'].'</td>'); ?>
                                  <td>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" href="users-form.php" data-remote="users-form.php?id=<?php echo $row['userID'];?> #update" data-target="#myModal" ><span class='glyphicon glyphicon-edit'></span> Update</button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" href="users-form.php" data-remote="users-form.php?id=<?php echo $row['userID'];?> #delete" data-target="#myModal" ><span class='glyphicon glyphicon-trash'></span> Deactivate</button>
                                  </td>
                                  <?php echo('</tr>');} }
                                  function jName($id){
                                    include "dbconnect.php";
                                    $sql = "SELECT * from tbljobs WHERE jobID = '$id'";
                                    $result = mysqli_query($conn,$sql);
                                    $cat = "";
                                    while($row = mysqli_fetch_assoc($result)){
                                      $cat = $row['jobName'];
                                    }
                                    return $cat;
                                  }
                                  ?>

                             </tbody>
                           </table>
                         </div>
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

            <div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content clearable-content">
          <div class="modal-body">

          </div>
        </div>
      </div>
    </div>

    <script>
      $(document).on('hidden.bs.modal', function (e) {
        var target = $(e.target);
        target.removeData('bs.modal')
        .find(".clearable-content").html('');
      });
    </script>

          </body>
          </html>
