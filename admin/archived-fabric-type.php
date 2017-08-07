<?php
include "titleHeader.php";
include "menu.php";
// session_start();
/*if(isset($GET['id'])){
$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];
$_SESSION['varname'] = $jsID;*/
include 'dbconnect.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
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
              <!-- FABRIC TYPE -->
              <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">                   
                    <div class="row">
                      <div class="table-responsive">
                            <div id="archiveTable">
                            <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblFabricType">
                          <thead>
                            <tr>
                              <th style="text-align: left;">Name</th>
                              <th style="text-align: left;">Weaves</th>
                              <th style="text-align: left;">Texture</th>
                              <th style="text-align: left;">Actions</th>
                            </tr>
                          </thead>
                          <tbody style="text-align: left;">
                            
                              <?php

                              function textureName($id){
                                    include "dbconnect.php";
                                    $pattern = "";
                                    $sql = "SELECT textureName from tblfabric_texture WHERE textureID = $id";
                                    $result = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                      $name = $row['textureName'];
                                    }
                                    return $name;
                                  }

                                  
                              $sql = "SELECT * FROM tblfabric_type;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['f_typeStatus']!="Listed"){
                                  echo('<tr>
                                    <td>'.$row['f_typeName'].'</td>
                                    <td>'.$row['f_typeWeaves'].'</td>');
                                  $name = textureName($row['f_typeTextureID']);
                                  echo'<td>'.$name.'</td>'; ?>
                                  <td>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" href="react-form.php" data-remote="react-form.php?rName=Fabric+Type&amp;id=<?php echo $row['f_typeID']?> #react" data-target="#myModal">Reactivate</button> 
                                  </td>
                                  <?php echo ('</tr>'); }}
                                  ?>
                                
                                <script type="text/javascript">
                                  function confirmDelete(id) {
                                    if (confirm("Are you sure you want to delete")) {
                                      window.location.href="delete-fabric.php?id="+id+"";
                                    }
                                  }
                                  function edit(id) {
                                    window.location.href="update-fabric.php?id="+id+"";
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
          <!-- /.container-fluid -->
          <footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer>
        </div>
        <!-- /#page-wrapper -->
      </div>

      <div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
        <div class="modal-dialog">
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