<?php
include "menu.php";  
include "titleHeader.php";
include 'dbconnect.php';
include 'toastr-buttons.php';

if (!empty($_SESSION['createSuccess'])) {
  echo  '<script>
          $(document).ready(function () {
            $("#toastNewSuccess").click();
          });
        </script>';
  unset($_SESSION['createSuccess']);
}
if (!empty($_SESSION['updateSuccess'])) {
  echo  '<script>
          $(document).ready(function () {
            $("#toastUpdateSuccess").click();
          });
        </script>';
  unset($_SESSION['updateSuccess']);
}
if (!empty($_SESSION['deactivateSuccess'])) {
  echo  '<script>
          $(document).ready(function () {
            $("#toastDeactivateSuccess").click();
          });
        </script>';
  unset($_SESSION['deactivateSuccess']);
}
if (!empty($_SESSION['reactivateSuccess'])) {
  echo  '<script>
          $(document).ready(function () {
            $("#toastReactivateSuccess").click();
          });
        </script>';
  unset($_SESSION['reactivateSuccess']);
}
if (!empty($_SESSION['actionFailed'])) {
  echo  '<script>
          $(document).ready(function () {
            $("#toastFailed").click();
          });
        </script>';
  unset($_SESSION['actionFailed']);
}

?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <script>
  </script>
</head>
<body>
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
                                
                              <th class="removeSort">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql1 = "SELECT * FROM tblmat_inventory b, tblmat_var a, tblmaterials c WHERE b.matVariantID = a.mat_varID AND a.materialID = c.materialID";
                            $result1 = mysqli_query($conn, $sql1);
                            while ($row1 = mysqli_fetch_assoc($result1))
                            {
                              if($row1['mat_varStatus']=="Active"){
                                echo('<tr><td>'.$row1['materialName'].'</td><td>'.$row1['mat_varDescription'].'</td>  <td>'.$row1['matVarQuantity'].'</td>');
                              
                            ?>
                            <td><!-- <button type="button" class="btn btn-warning" data-toggle="modal" href="raw-materials-management-form.php" data-remote="raw-materials-management-form.php?id=<?php echo $row1['mat_varID']?> #restock" data-target="#myModal">Restock</button> -->

                              <button type="button" class="btn btn-danger" data-toggle="modal" href="raw-materials-management-form.php" data-remote="raw-materials-management-form.php?id=<?php echo $row1['mat_varID']?> #deduct" data-target="#myModal">Deduct</button>
                            </td>
                              <?php echo('</tr>'); }}
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