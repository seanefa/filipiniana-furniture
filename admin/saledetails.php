<?php
include "menu.php";
include "dbconnect.php";
include 'dbconnect.php';

if (isset($_GET['newSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
  echo 'document.getElementById("toastNewSuccess").click();';
  echo '});';
  echo '</script>';
}
else if (isset($_GET['updateSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
  echo 'document.getElementById("toastUpdateSuccess").click();';
  echo '});';
  echo '</script>';
}
else if (isset($_GET['deactivateSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
  echo 'document.getElementById("toastDeactivateSuccess").click();';
  echo '});';
  echo '</script>';
}
else if (isset($_GET['reactivateSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
  echo 'document.getElementById("toastReactivateSuccess").click();';
  echo '});';
  echo '</script>';
}
else if (isset($_GET['actionFailed']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
  echo 'document.getElementById("toastFailed").click();';
  echo '});';
  echo '</script>';
}

?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <title>Maintenance | Promos</title>
  <script>
    $(document).ready(function(){
      $('.search').on('keyup',function(){
        var searchTerm = $(this).val().toLowerCase();
        $('#tblSaleDetails tbody tr').each(function(){
          var lineStr = $(this).text().toLowerCase();
          if(lineStr.indexOf(searchTerm) === -1){
            $(this).hide();
          }else{
            $(this).show();
          }
        });
      });
    });
  </script>
</head>
<body>
    <!-- Toast Notification -->
<button class="tst1" id="toastNewSuccess" style="display: none;"></button>
<button class="tst2" id="toastUpdateSuccess" style="display: none;"></button>
<button class="tst3" id="toastDeactivateSuccess" style="display: none;"></button>
<button class="tst4" id="toastReactivateSuccess" style="display: none;"></button>
<button class="tst5" id="toastFailed" style="display: none;"></button>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i class="ti-layout-grid2"></i>&nbsp;Promos</a>
                </li>
                <li role="presentation" class>
                  <a role="tab" data-toggle="modal" data-target="#newPromoModal" aria-expanded="false"><i class="ti-plus"></i>New</a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- PromoS -->
              <div role="tabpanel" class="tab-pane fade active in" id=frameworks>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-12">
                        <input type="text" class="search form-control navbar-form navbar-right" placeholder="Search..." size="40" style="margin-top: -50px; margin-right: 5px;">
                        </div>
                    </div>                    
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table" id="tblSaleDetails">
                          <thead>
                            <tr>
                              <th style="text-align: center;">Start Date</th>
                              <th style="text-align: center;">End Date</th>
                              <th style="text-align: center;">Rate</th>
                              <th style="text-align: center;">Remarks</th>
                              <th style="text-align: center;">Actions</th>
                            </tr>
                          </thead>
                          <tbody style="text-align: center;">
                            <tr>
                              <?php
                              $sql = "SELECT * FROM tblprodsonsale;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['PromoStatus']=="Listed"){
                                  echo('<tr><td>'.$row['PromoPrice'].'</td>
                                  <td>'.$row['PromoDescription'].'</td>'); ?>
                                  <td>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updatePromoModal">Update</button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePromoModal">Delete</button>
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
                 <!-- New Promo Modal -->
                 <div class="modal fade" tabindex="-1" role="dialog" id="newPromoModal" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="modalProduct">New Promo</h3>
                      </div>
                      <div class="modal-body">
                        <div class="descriptions">
                          <form action="add-Promo.php" method = "post">
                            <div class="form-body">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="control-label">Start Date</label>
                                    <input type="date" id="firstName" class="form-control" name="name" required/> </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">End Date</label>
                                      <input type="date" id="firstName" class="form-control" name="carving" required/> 
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Rate</label>
                                      <input type="number" id="firstName" class="form-control" name="name" required/> </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="control-label">Remarks</label>
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
                    <!-- Update Promo Modal -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="updatePromoModal" aria-hidden="true" style="display: none;">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 class="modal-title" id="modalProduct">Update Promo</h3>
                          </div>
                          <div class="modal-body">
                            <div class="descriptions">
                              <?php
                              $rsql = "SELECT * FROM tblframeworks WHERE frameworkID = $jsID";
                              $rresult = mysqli_query($conn,$rsql);
                              $rrow = mysqli_fetch_assoc($rresult);
                              ?>
                              <form action="update-Promo.php" method="post">
                               <div class="form-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Start Date</label>
                                      <input type="date" id="firstName" class="form-control" name="name" required/> </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="control-label">End Date</label>
                                        <input type="date" id="firstName" class="form-control" name="carving" required/> 
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="control-label">Rate</label>
                                        <input type="number" id="firstName" class="form-control" name="name" required/> </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label class="control-label">Remarks</label>
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
                      <!-- Delete Promo Modal -->
                      <div class="modal fade" tabindex="-1" role="dialog" id="deletePromoModal" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h3 class="modal-title">Delete Promo</h3>
                            </div>
                            <div class="modal-body">
                              <h4>Are you sure you want to delete this promo?</h4>
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