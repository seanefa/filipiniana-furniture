<?php
include "menu.php";  
include "titleHeader.php";
//session_start();
/* if(isset($GET['id'])){
$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];
$_SESSION['varname'] = $jsID;*/
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

?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <script>
  </script>
</head>
<body>
  <!-- Toast Notification -->
  <button class="tst1" id="toastNewSuccess" style="display: none;"></button>
  <button class="tst2" id="toastUpdateSuccess" style="display: none;"></button>
  <button class="tst3" id="toastDeactivateSuccess" style="display: none;"></button>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <a id="tempbtn" class="btn btn-lg btn-info pull-right" href="receive-deliveries.php" aria-expanded="false" style="margin-right: 20px; color:white"><span class="btn-label"><i class="ti-plus"></i></span>Receive Deliveries</a>
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-dropbox"></i></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="type">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="myTable">
                          <thead>
                            <tr>
                              <th>Material</th>
                              <th>Variant Description</th>
                              <th>Quantity</th>
                              <th>Status</th>
                              <th class="removeSort">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><button type="button" class="btn btn-warning" data-toggle="modal" href="raw-materials-management-form.php" data-remote="raw-materials-management-form.php?id=<?php echo $row['variantID']?> #restock" data-target="#myModal">Restock</button>

                              <button type="button" class="btn btn-danger" data-toggle="modal" href="raw-materials-management-form.php" data-remote="raw-materials-management-form.php?id=<?php echo $row['variantID']?> #deduct" data-target="#myModal">Deduct</button>
                            </td>
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

  <script type="text/javascript">
  $('#ViewPOButton').click(function(e) {
    e.preventDefault(); e.stopPropagation();
    window.location.href = $(e.currentTarget).data().href;
  });
  </script>

</script>
</body>
</html>