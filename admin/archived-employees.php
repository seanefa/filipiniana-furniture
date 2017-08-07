<?php
include "titleHeader.php";
include "menu.php";
include 'dbconnect.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());

  session_start();
  if(isset($GET['id'])){
    $jsID = $_GET['id']; 
  }
  $jsID=$_GET['id'];
  $_SESSION['varname'] = $jsID;
}

if (isset($_GET['reactivateSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
  echo 'document.getElementById("toastReactivateSuccess").click();';
  echo '});';
  echo '</script>';
}

?>
<!DOCTYPE html>  
<html lang="en">
<head>
</head>
<body>
  <!-- Preloader -->
  <div class="preloader">
    <div class="cssload-speeding-wheel"></div>
  </div>
  <!-- Toast Notification -->
  <button class="tst4" id="toastReactivateSuccess" style="display: none;"></button>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-archive"></i>&nbsp;<?php echo $titlePage?></a>
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
                            <div id="archiveTable">
                              <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblEmployees">
                          <thead>
                            <tr>
                              <th style="text-align: left;">First Name</th>
                              <th style="text-align: left;">Middle Name</th>
                              <th style="text-align: left;">Last Name</th>
                              <th style="text-align: left;">Job</th>
                              <th style="text-align: left;">Remarks</th>
                              <th style="text-align: left;">Actions</th>
                            </tr>
                          </thead>
                          <tbody style="text-align: left;">
                            
                              <?php

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
                                  
                              $sql = "SELECT * FROM tblemployee";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['empStatus']!="Active"){
                                  echo('<tr><td>'.$row['empFirstName'].'</td>
                                    <td>'.$row['empMidName'].'</td>
                                    <td>'.$row['empLastName'].'</td>');
                                  $job = jName($row['empJobID']);
                                  echo ('<td>'.$job.'</td>
                                  <td>'.$row['empRemarks'].'</td>'); ?>
                                  <td>
                                    <!-- UPDATE -->
                                      <button type="button" class="btn btn-danger" data-toggle="modal" href="react-form.php" data-remote="react-form.php?rName=Employee&amp;id=<?php echo $row['empID']?> #react" data-target="#myModal">Reactivate</button> 
                                  </td>
                                  <?php echo('</tr>');} }
                                  
                                  ?>
                                
                              </tbody>
                            </table>
                            </div>

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
        <footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer>
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