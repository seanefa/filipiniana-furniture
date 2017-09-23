<?php
include "titleHeader.php";
include "menu.php";  
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
<script>
  
$(document).ready(function(){
  $("#archiveTable").hide();
  $('#archiveSwitch').change(function(){
    if($(this).prop("checked")) {
      $('#archiveTable').show();
      $('#archiveTitle').css({'display' : ''});
      $("#tempbtn").hide();
      $('#mainTable').hide();
    } else {
      $('#archiveTable').hide();
      $('#archiveTitle').css({'display' : 'none'});
      $('#mainTable').show();
      $("#tempbtn").show();
    }
  });

  // Tooltip only Text
  $('.masterTooltip').hover(function(){
          // Hover over code
          var title = $(this).attr('title');
          $(this).data('tipText', title).removeAttr('title');
          $('<p class="tooltipsy"></p>')
          .text(title)
          .appendTo('body')
          .fadeIn('slow');
  }, function() {
          // Hover out code
          $(this).attr('title', $(this).data('tipText'));
          $('.tooltipsy').remove();
  }).mousemove(function(e) {
          var mousex = e.pageX + -100; //Get X coordinates
          var mousey = e.pageY + -15; //Get Y coordinates
          $('.tooltipsy')
          .css({ top: mousey, left: mousex })
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#myModal" href="modeofpayment-form.php" data-remote="modeofpayment-form.php #new" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active" >
                <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-wallet"></i>&nbsp;<span id="archiveTitle" style="display: none;">Archived</span>&nbsp;<?php echo $titlePage?></a>
              </li>
            </ul>
          </h3>
          <div class="pull-right" style="margin-right: 20px; margin-top: -10px;">
            <a href="javascript:void(0)" title="Archives" class="masterTooltip"><input type="checkbox" class="js-switch" id="archiveSwitch" data-color="#f96262" style="display: none;" data-switchery="true"></a>
          </div>
            <div class="tab-content">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in" id="modeofpayment">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive" id="mainTable">
                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblCategories">
                          <thead>
                            <tr>
                              <th>Description</th>
                              <th class="removeSort">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                              <?php
                              include "dbconnect.php";
                              $sql = "SELECT * FROM tblmodeofpayment;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['modeofpaymentStatus']=="Active"){
                                  echo('<td>'.$row['modeofpaymentDesc'].'</td>
                                    ');?>
                                    <td>
                                      <!-- UPDATE -->
                                      <button type="button" class="btn btn-success" data-toggle="modal" href="modeofpayment-form.php" data-remote="modeofpayment-form.php?id=<?php echo $row['modeofpaymentID']?> #update" data-target="#myModal"><i class="ti-pencil-alt"></i> Update</button>
                                      <!-- DELETE -->
                                      <button type="button" class="btn btn-danger" data-toggle="modal" href="modeofpayment-form.php" data-remote="modeofpayment-form.php?id=<?php echo $row['modeofpaymentID']?> #delete" data-target="#myModal"><i class="ti-close"></i> Deactivate</button>
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

                  <div id="archiveTable">
                          <div class="table-responsive"> 
                            <table class="table color-bordered-table muted-bordered-table dataTable display">
                              <thead>
                                <tr>
                              <th>Description</th>
                              <th class="removeSort">Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                               <?php
                              include "dbconnect.php";
                              $sql = "SELECT * FROM tblmodeofpayment;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['modeofpaymentStatus']=="Archived"){
                                  echo('<td>'.$row['modeofpaymentDesc'].'</td>
                                    ');?>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" href="reactivate-form.php" data-remote="reactivate-form.php?rName=Mode+Of+Payment&amp;id=<?php echo $row['modeofpaymentID']?> #reactivate" data-target="#myModal"><i class="ti-reload"></i> Reactivate</button>
                                    </td>
                                    <?php echo ('</tr>');
                                  }
                                }
                              ?>
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