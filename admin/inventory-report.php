<?php
include "titleHeader.php";
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
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

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
$(document).ready(function(){
    $('#frequency').change(function(){
      var value = $("#frequency").val();
      $.ajax({
        type: 'post',
        url: 'reports-drop.php',
        data: {
          id: value,
        },
        success: function (response) {
          $( '#range' ).html(response);
        }
      });

    });//end change

    $("#gen").on('click',function(){
      //alert("BOO YAH LALALALALALAL HAPPINESS!!!");
      var value = $("#frequency").val();
      if(value==1){
        var date = $("#dateRep").val();
        $.ajax({
        type: 'post',
        url: 'reports-out.php',
        data: {
          id: value, d: date,
        },
        success: function (response) {
          $( '#reportsOut' ).html(response);
        }
      });
      }

      if(value==2){
        var m = $("#month").val();
        var y = $("#year").val();
        $.ajax({
        type: 'post',
        url: 'reports-out.php',
        data: {
          id: value, m: m, y:y,
        },
        success: function (response) {
          $( '#reportsOut' ).html(response);
        }
      });
      }

      if(value==3){
        var y = $("#year").val();
        alert(y);
        $.ajax({
        type: 'post',
        url: 'reports-out.php',
        data: {
          id: value, y : y,
        },
        success: function (response) {
          $( '#reportsOut' ).html(response);
        }
      });
      }

    });
  });
  </script>
</head>
<body>
  <!-- Preloader -->
<!--div class="preloader">
<div class="cssload-speeding-wheel"></div>
</div-->
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
              <li role="presentation" class="active" >
                <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-bar-chart"></i>&nbsp;<?php echo $titlePage?></a>
              </li>
            </ul>
          </h3>

          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
              <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                  <div class="row"> <!--LABELS-->
                    <div class="col-md-3">
                      <label class="control-label">FREQUENCY</label>
                    </div>
                    <div class="col-md-3">
                      <label class="control-label" id="lblrange">DATE</label>
                    </div>
                    <div class="col-md-4">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <select id="frequency" style="height:40px;" class="form-control" data-placeholder="Choose Category" tabindex="1" name="frequency"> 
                        <option value="1">Daily</option>
                        <option value="2">Monthly</option>
                        <option value="3">Annually</option>
                      </select>
                    </div>
                    <div id="range">
                    <div class="col-md-3">
                      <input type="date" id="dateRep" name ="dateRep" class="form-control" required/>
                    </div>
                  </div>
                    <div class="col-md-3">
                      <button type="button" id="gen" class="btn btn-success waves-effect text-left"><i class="fa fa-check"></i>&nbsp;Generate</button>
                    </div>
                  </div>
                  <br>
                  <div class="row" id="reportsOut">
                    <div class="table-responsive"> 
                      <table class="table color-bordered-table muted-bordered-table display" id="reportsTable">
                        <thead>
                          <tr>
                            <th style="text-align: left;">Material ID</th>
                            <th style="text-align: left;">Starting Quantity</th>
                            <th style="text-align: left;">Used(Till Now)</th>
                            <th style="text-align: left;">Available</th>
                            <th style="text-align: left;">Status</th>
                          </tr>
                        </thead>
                        <tbody style="text-align: left;">

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

</body>
</html>