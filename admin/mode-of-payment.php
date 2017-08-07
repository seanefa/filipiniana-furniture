<?php
include "titleHeader.php";
include "menu.php";  
//session_start();
 /* if(isset($GET['id'])){
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#myModal" href="modeofpayment-form.php" data-remote="modeofpayment-form.php #new" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i class="ti-layout-list-thumb"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in" id="modeofpayment">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblCategories">
                          <thead>
                            <tr>
                              <th style="text-align: center;">Description</th>
                              <th style="text-align: center;">Actions</th>
                            </tr>
                          </thead>
                          <tbody style="text-align: center;">
                            
                              <?php
                              include "dbconnect.php";
                              $sql = "SELECT * FROM tblmodeofpayment;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['modeofpaymentStatus']=="Listed"){
                                  echo('<td>'.$row['modeofpaymentDesc'].'</td>
                                    ');?>
                                    <td>
                                      <!-- UPDATE -->
                                      <button type="button" class="btn btn-success" data-toggle="modal" href="modeofpayment-form.php" data-remote="modeofpayment-form.php?id=<?php echo $row['modeofpaymentID']?> #update" data-target="#myModal">Update</button>
                                      <!-- DELETE -->
                                      <button type="button" class="btn btn-danger" data-toggle="modal" href="modeofpayment-form.php" data-remote="modeofpayment-form.php?id=<?php echo $row['modeofpaymentID']?> #delete" data-target="#myModal">Deactivate</button>
                                    </td>
                                    <?php echo ('</tr>');
                                  }
                                }
                              ?>
                            
                            <script type="text/javascript">
                              function confirmDelete(id) {
                               window.location.href="delete-modeofpayment.php?id="+id+"";
                             }
                             function edit(id){
                              window.location.href="update-modeofpayment.php?id="+id+"";
                            }
                          </script>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New Framework Mo
            <!-- /.modal -->
          </div>
        </div>  
      </div>
    </div>
    <!-- /.container-fluid -->
    <!--footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer-->
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