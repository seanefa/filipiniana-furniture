<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
//session_start();
/*if(isset($GET['id'])){
$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];
$_SESSION['varname'] = $jsID;*/
include 'dbconnect.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <title>Reports</title>
</head>
<body>
  <!-- Preloader -->
  <div class="preloader">
    <div class="cssload-speeding-wheel"></div>
  </div>
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
                <li role="presentation" class="active">
                  <a id="temptitle" href="#packages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i id="ti" class="ti-package"></i>&nbsp;Reports</a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!--PACKAGES-->
              <div role="tabpanel" class="tab-pane fade active in" id="packages">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <select class="form-control" data-placeholder="Choose a Report" tabindex="1" name="type">
                            <option value="Sales Reports">Sales Report</option>
                            </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="control-label">From: <input type="date" class="form-control" name="from"></label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="control-label">To: <input type="date" class="form-control" name="from"></label>
                            </div>
                          </div>
                          <div class="col-md-6 pull-right" style="margin-top:20px">
                            <div class="form-group">
                              <input type="submit"  class="btn btn-success" value="Generate">
                            </div>
                        </div>
                        </div>                         
                          
                    </div>
                  </div>
                </div>
                <div>
                  <a href="receipt.php">View Report</a>
                </div>
                
</div>
</div>
</div>
</div>
<!-- /.modal -->
</div>
</div>  
<!-- /.container-fluid -->
<footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer>
</div>
<!-- /#page-wrapper -->
</div>
</body> 
</html>