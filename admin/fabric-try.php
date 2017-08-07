<?php
include "menu.php";
include "dbconnect.php";
session_start();
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
  <title>Maintenance | Frameworks</title>
</head>
<body class ="fix-header fix-sidebar">
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i class="ti-layout-grid2"></i>&nbsp;Frameworks</a>
                </li>
                <li role="presentation" class>
                  <a role="tab" data-toggle="modal" href="framework-form.php" data-remote="framework-form.php #new" data-target="#myModal" aria-expanded="false"><i class="ti-plus"></i>New</a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- FRAMEWORKS -->
              <div role="tabpanel" class="tab-pane fade active in" id=frameworks>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-12">
                        <form class="navbar-form navbar-right" role="search">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term" size="40" style="margin-top: -50px;">
                            <div class="input-group-btn">
                              <button class="btn btn-default" type="submit" style="margin-top: -63px;"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>                    
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table">
                          <thead>
                            <tr>
                              <th style="text-align: center;">Name</th>
                              <th style="text-align: center;">Carving</th>
                              <th style="text-align: center;">Remarks</th>
                              <th style="text-align: center;">Actions</th>
                            </tr>
                          </thead>
                          <tbody style="text-align: center;">
                            <tr>
                              <?php
                              $sql = "SELECT * FROM tblframeworks;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['frameworkStatus']=="Listed"){
                                  echo('<tr><td>'.$row['frameworkName'].'</td>
                                    <td>'.$row['frameworkCarving'].'</td>
                                    <td>'.$row['frameworkRemarks'].'</td>'); ?>
                                    <td>
                                      <button type="button" class="btn btn-info" data-toggle="modal" href="framework-form.php" data-remote="framework-form.php #view" data-target="#myModal">View</button>
                                      <!-- UPDATE -->
                                      <button type="button" class="btn btn-success" data-toggle="modal" href="framework-form.php" data-remote="framework-form.php #update" data-target="#myModal">Update</button>
                                      <!-- DELETE -->
                                      <button type="button" class="btn btn-danger" data-toggle="modal" href="framework-form.php" data-remote="framework-form.php #delete" data-target="#myModal">Delete</button>
                                    </td>
                                    <?php echo('</tr>');} }
                                    ?>
                                  </tr>
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