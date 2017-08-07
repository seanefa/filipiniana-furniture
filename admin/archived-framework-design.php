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
              <!-- FRAMEWORKS -->
              <div role="tabpanel" class="tab-pane fade active in" id=frameworks>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">                
                    <div class="row">
                      <div class="table-responsive">
                              <div id="archiveTable">
                                <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblFrameDesign">
                          <thead>
                            <tr>
                              <th style="text-align: left;">Name</th>
                              <th style="text-align: left;">Carving</th>
                              <th style="text-align: left;">Description</th>
                              <th style="text-align: left;">Actions</th>
                            </tr>
                          </thead>
                          <tbody style="text-align: left;">
                            
                              <?php
                              $sql = "SELECT * FROM tblframe_design;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['designStatus']!="Listed"){
                                  echo('<tr><td>'.$row['designName'].'</td>
                                    <td>'.$row['designCarving'].'</td>
                                    <td>'.$row['designDescription'].'</td>'); ?>
                                    <td>
                                      <!-- UPDATE -->
                                      <button type="button" class="btn btn-danger" data-toggle="modal" href="react-form.php" data-remote="react-form.php?rName=Frame+Design&amp;id=<?php echo $row['designID']?> #react" data-target="#myModal">Reactivate</button> 
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

      <script>
        $(document).on('hidden.bs.modal', function (e) {
          var target = $(e.target);
          target.removeData('bs.modal')
          .find(".clearable-content").html('');
        });
      </script>
    </body>
    </html>