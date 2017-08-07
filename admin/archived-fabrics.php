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
              <!-- FABRIC -->
              <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">                  
                    <div class="row">
                      <div class="table-responsive">
                            <div id="archiveTable">
                              <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblFabrics">
                          <thead>
                            <tr>
                              <th style="text-align: left;">Name</th>
                              <th style="text-align: left;">Type</th>
                              <th style="text-align: left;">Pattern</th>
                              <th style="text-align: left;">Color</th>
                              <th style="text-align: left;">Remarks</th>
                              <th style="text-align: left;">Actions</th>
                            </tr>
                          </thead>
                          <tbody style="text-align: left;">
                            
                              <?php

                              function ftype($id){
                                    include "dbconnect.php";
                                    $type = "";
                                    $sql = "SELECT * from tblfabric_type WHERE f_typeID = '$id'";
                                    $result = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                      $type = "" . $row['f_typeName'];
                                    }
                                    return $type;
                                  }
                                  function fpattern($id){
                                    include "dbconnect.php";
                                    $pattern = "";
                                    $sql = "SELECT f_patternName from tblfabric_pattern WHERE f_patternID = '$id'";
                                    $result = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                      $pattern = "" . $row['f_patternName'];
                                    }
                                    return $pattern;
                                  }

                              $sql = "SELECT * FROM tblfabrics;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                $id = $row['fabricID'];
                                if($row['fabricStatus']!="Listed"){
                                  echo '<tr><td>'.$row['fabricName'].'</td>';
                                  $type = ftype($row['fabricTypeID']) ;
                                  $pattern = fpattern($row['fabricPatternID']) ;
                                  echo '<td>'. $type .'</td>';
                                  echo '<td>'. $pattern .'</td>';
                                  echo '<td>'. $row['fabricColor'] .'</td>';
                                  echo '<td>'. $row['fabricRemarks'] .'</td>';
                                  ; ?>
                                  <td>
                                  <button type="button" class="btn btn-danger" data-toggle="modal" href="react-form.php" data-remote="react-form.php?rName=Fabric&amp;id=<?php echo $row['fabricID']?> #react" data-target="#myModal">Reactivate</button> 
                                  </td>
                                  <?php echo ('</tr>'); }}
                                  ?>
                              
                              </tbody>
                            </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer>
        </div>
      </div>

      <div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- Modal content-->
            <div class="modal-content clearable-content">
              <div class="modal-body">

              </div>
            </div>
          </div>
        </div>
      </div>

      <!--<a data-toggle="modal" href="form.php" data-remote="form.php #form1" data-target="#myModal">Page 1 Modal Content</a>-->

      <script>
        $(document).on('hidden.bs.modal', function (e) {
          var target = $(e.target);
          target.removeData('bs.modal')
          .find(".clearable-content").html('');
        });
      </script>
    </body>
    </html>