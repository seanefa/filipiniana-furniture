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
<body class ="fix-header fix-sidebar">
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i class="ti-layout-list-thumb"></i>&nbsp;<?php echo $titlePage?></a>
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
                <div class="row">
                      <div class="col-md-3">
                      <h3 class="box-title m-t-20">Logo</h3>
                      <div class="product-img"><br>
                      <input type="file" name="image" class="dropify" data-default-file="plugins/images/<?php echo $row['comp_logo']?>">
                      <input type="hidden" name="exist_image" value="<?php echo $trow['comp_logo']?>">
                      </div>
                      </div>
                    </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                     <label class="control-label">Company Name</label> <span id="x" style="color:red"> *</span>
                      <input type="text" id="username" class="form-control" name="name" value="<?php echo $row['comp_name'];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Address:</label> <span id="x" style="color:red"> *</span>
                      <textarea type="text" id="jobName" class="form-control" name="address" required><?php echo $row['comp_address'];?></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                     <label class="control-label">Number</label> <span id="x" style="color:red"> *</span>
                      <input type="text" id="username" class="form-control" name="number" value="<?php echo $row['comp_num'];?>" required><span id="message"></span>
                    </div>
                  </div>
                </div>
                <label class="control-label"> <span id="x" style="color:red"> *</span>ABOUT</label>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <textarea type="text" id="jobName" class="form-control" name="about" required><?php echo $row['comp_about'];?></textarea>
                    </div>
                  </div>
                </div>
                <label class="control-label"> <span id="x" style="color:red"> *</span>EMAIL</label>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="email" id="jobName" class="form-control" name="email" value="<?php echo $row['comp_email'];?>">
                    </div>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-success pull-right"></span> Update</button>
                  </div>
                </div>
              </forms>
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
</html>t