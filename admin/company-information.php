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
<script>
$(document).ready(function(){
            // Basic
            $('.dropify').dropify();
            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez'
                    , replace: 'Glissez-déposez un fichier ou cliquez pour remplacer'
                    , remove: 'Supprimer'
                    , error: 'Désolé, le fichier trop volumineux'
                }
            });
            // Used events
            var drEvent = $('#input-file-events').dropify();
            drEvent.on('dropify.beforeClear', function (event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });
            drEvent.on('dropify.afterClear', function (event, element) {
                alert('File deleted');
            });
            drEvent.on('dropify.errors', function (event, element) {
                console.log('Has Errors');
            });
            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function (e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                }
                else {
                    drDestroy.init();
                }
            })
        });
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
                <li role="presentation" class="active">
                  <a role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i class="ti-info"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <?php
              $sql = "SELECT * FROM tblcompany_info";
              $result = mysqli_query($conn,$sql);
              $row = mysqli_fetch_assoc($result);
              ?>
              <div role="tabpanel" class="tab-pane fade active in" id="default-downpayment">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                <form enctype="multipart/form-data" action="company-info-update.php" method="post">
                <div class="form-body">
                <div class="row" style="margin-top: -10px;">
                      <div class="col-md-6 col-md-offset-3" >
                      <label class="control-label">Company Logo</label>
                      <div class="product-img">
                      <input type="file" name="image" class="dropify" data-default-file="plugins/logo/<?php echo $row['comp_logo']?>">
                      <input type="hidden" id="select" name="exist_image" value="<?php echo $row['comp_logo']?>">
                      </div>
                      </div>
                    </div>
                    <br>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                     <label class="control-label">Company Name</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="username" class="form-control" name="name" value="<?php echo $row['comp_name'];?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Address:</label><span id="x" style="color:red"> *</span>
                      <textarea type="text" id="jobName" class="form-control" name="address" required><?php echo $row['comp_address'];?></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                     <label class="control-label">Number</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="username" class="form-control" style="text-align:right" data-mask="+63 (999) 999-9999" name="number" value="<?php echo $row['comp_num'];?>" required><span id="message"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                <label class="control-label">E-Mail</label><span id="x" style="color:red"> *</span>
                      <input type="email" id="jobName" class="form-control" name="email" value="<?php echo $row['comp_email'];?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                <label class="control-label">E-Mail Password</label><span id="x" style="color:red"> *</span>
                      <input type="password" id="epass" class="form-control" name="epass" value="<?php echo $row['comp_emailPassword'];?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                <label class="control-label">About</label><span id="x" style="color:red"> *</span>
                      <textarea type="text" id="jobName" class="form-control" name="about" required><?php echo $row['comp_about'];?></textarea>
                    </div>
                  </div>
                </div>
              </div>
                <div class="row pull-right">
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-success"><i class="ti-check"></i> Update</button>
                  </div>
                </div>
              </form>
                </div>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </div>
    <!--footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer-->
  </div>
</div>
</body>
</html>