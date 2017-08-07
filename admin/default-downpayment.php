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
                    <p>**Note: The downpayment is taken as percentage.</p>
                  </div>
                <div class="row">
                  <div class="col-md-3">
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
                  <div class="col-md-3">
                    <button type="button" class="btn btn-success" data-toggle="modal" href="form.php" data-remote="form.php?id=<?php echo $row['packageID']?> #update" data-target="#myModal"><span class='glyphicon glyphicon-edit'></span> Update</button>
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
</html>t