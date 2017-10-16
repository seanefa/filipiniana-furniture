<?php
include "titleHeader.php";
include "menu.php";  
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
</head>
<body>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 col-lg-5 col-sm-5 col-xs-5">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i class="ti-layout-list-thumb"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in" id="default-downpayment">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php
                       include "dbconnect.php";
                       $sql = "SELECT * FROM tbldownpayment";
                       $result = mysqli_query($conn,$sql);
                       $dp = 0;
                       while($row = mysqli_fetch_assoc($result)){
                        $dp = $row['downpaymentPercentage'];
                       }
                      ?>
                        
                      <input type="text" id="ln" class="form-control" name="dp" style="text-align:right;" value="<?php echo $dp;?> %" required disabled/>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <button type="button" class="btn btn-success" data-toggle="modal" href="default-downpayment-form.php" data-remote="default-downpayment-form.php?id=<?php echo $row['downpaymentID']?> #update" data-target="#myModal"><i class="ti-pencil-alt"></i> Update</button>
                  </div>
                </div>
                  <div class="row">
                    <p style="color: red;">*Note: The downpayment is taken as percentage.</p>
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
          <div class="modal-dialog modal-sm">
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
</html>t