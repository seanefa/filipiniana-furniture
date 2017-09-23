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
                       $dp = 1;
                       while($row = mysqli_fetch_assoc($result)){
                        $dp = $row['downpaymentPercentage'];
                       }
                      ?>
                      <input type="text" id="ln" class="form-control" name="dp" value="<?php echo $dp;?>" required disabled/>
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