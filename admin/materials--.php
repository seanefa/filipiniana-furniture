<?php
include "titleHeader.php";
include "menu.php";
include "dbconnect.php";
//session_start();
/*if(isset($GET['id'])){
$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];
$_SESSION['varname'] = $jsID;*/
include 'dbconnect.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
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

  $('body').on('keyup','#username',function(){
    var user = $(this).val();
    var flag = true;
    $.post('frame-mat-check.php',{username : user}, function(data){
     
      
      if(data != "Already Exist!"){
          flag = false;
          $('#message').html("");

      }
      else if(data == "Already Exist!"){
        $('#message').html(data);
        flag = true;
      }
      if(flag){
      $('#addFab').prop('disabled',true);

      $('#username').css('border-color','red');
    }
    else if(!flag){
      $('#addFab').prop('disabled', false);

      $('#username').css('border-color','limegreen');
    }
    });

    

  });
      

});
    $(document).ready(function(){
var temprem;
var tempname;
var error = 0;
  $('body').on('keyup','#editname',function(){
    var user = $(this).val();
    
      tempname = $('#editname').val();
      temprem = $('#rem').val();
    $.post('frame-mat-Ucheck.php',{username : user}, function(data){
     
      
      if(data != "Already Exist!" && data !="unchanged"){
          flag = false;
          error =0;
        $('#message').html("");
        $('#updateBtn').prop('disabled', false);
      $('#editname').css('border-color','limegreen');

      }
      if(data == "unchanged"){
        error = 0;
        $('#message').html("");
        $('#updateBtn').prop('disabled', true);
      $('#editname').css('border-color','black')
      }
            else if(data == "Already Exist!"){
        flag = true;
        error++;
        $('#message').html(data);
         $('#updateBtn').prop('disabled',true);

      $('#editname').css('border-color','red');
      }

    });

    

  });
         $('body').on('change','#rem',function(){
          if(error == 0){
          $('#updateBtn').prop('disabled',false);
        }

      });
        $('body').on('keyup','#remText',function(){
        var tem = $(this).val();
        if(error == 0){
        flag = false;
        if(!flag){
          $('#updateBtn').prop('disabled',false);
        }
        }
      });

});
  /*  $(document).ready(function(){
      $("#archiveTable").hide();
      $("#backArch").hide();
    $("#showArch").click(function(){
        $("#tblFrameworkMaterial").hide();
        $("#archiveTable").show();
        $("#temptitle").text("");
        $("#temptitle").text("Archived");
        $("#tempbtn").hide();
        $("#showArch").hide();
        $("#backArch").show();
    });
    $("#backArch").click(function(){
      $("#tblFrameworkMaterial").show();
        $("#archiveTable").hide();
        $("#temptitle").text("");
        $("#temptitle").text("Frame Material");
        $("#tempbtn").show();
        $("#showArch").show();
        $("#backArch").hide();
    });
}); */
  </script>
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="frame-mat-form.php" data-remote="frame-mat-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-hummer"></i>&nbsp;Frameworks</a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- FRAMEWORKS -->
              <div role="tabpanel" class="tab-pane fade active in" id=frameworks>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">                 
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblFrameworkMaterial">
                          <thead>
                            <tr>
                              <th style="text-align: left;">Name</th>
                              <th style="text-align: left;">Remarks</th>
                              <th style="text-align: left;">Actions</th>
                            </tr>
                          </thead>
                          <tbody style="text-align: left;">
                            
                              <?php
                              $sql = "SELECT * FROM tblframe_material;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['materialStatus']=="Listed"){
                                  echo('<tr><td>'.$row['materialName'].'</td>
                                  <td>'.$row['materialRemarks'].'</td>'); ?>
                                  <td>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" href="frame-mat-form.php" data-remote="frame-mat-form.php?id=<?php echo $row['materialID']?> #update" data-target="#myModal">Update</button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" href="frame-mat-form.php" data-remote="frame-mat-form.php?id=<?php echo $row['materialID']?> #delete" data-target="#myModal">Deactivate</button>
                                  </td>
                                  <?php echo('</tr>');} }
                                  ?>
                                
                                <script>
                                  function confirmDelete(id) {
                                    window.location.href="delete-frame.php?id="+id+"";
                                  }
                                  function edit(id) {
                                    window.location.href="update-framework.php?id="+id+"";
                                  }
                                </script>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.modal -->
                </div>
              </div>
            </div>  
          </div>


      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="fabric-forms.php" data-remote="fabric-forms.php #addFab" data-target="#myModal" role="tab" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="icon-layers"></i>&nbsp;Fabrics</a>
                </li>
              </ul>
            </h3>

            <div class="tab-content">
              <!-- FABRIC -->
              <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">                   
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblFabrics">
                          <thead>
                            <tr>
                              <th style="text-align: left;">Name</th>
                              <th style="text-align: left;">Type</th>
                              <th style="text-align: left;">Pattern</th>
                              <th style="text-align: left;">Color</th>
                              <th style="text-align: left;">Remarks</th>
                              <th style="text-align: left;">Actions</th>
                            </tr>
                          </thead>
                          <tbody style="text-align: left;">
                            
                              <?php
                              $sql = "SELECT * FROM tblfabrics;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                $colorDb = $row['fabricColor'];
                                $colorArray = explode(',',$colorDb);
                                $colorCtr = count($colorArray);
                                $id = $row['fabricID'];
                                if($row['fabricStatus']=="Listed"){
                                  echo '<tr><td>'.$row['fabricName'].'</td>';
                                  $type = ftype($row['fabricTypeID']) ;
                                  $pattern = fpattern($row['fabricPatternID']) ;
                                  echo '<td>'. $type .'</td>';
                                  echo '<td>'. $pattern .'</td>';
                                  echo ('<td>');
                                    while($colorCtr != 0){ 
                                      echo'<input type="img" style="background-color:'.$colorArray[$colorCtr-1].'; width:75pt" disabled/>'; 
                                      $colorCtr--;
                                    }
                                      echo('</td>');
                                  echo '<td>'. $row['fabricRemarks'] .'</td>';
                                  ; ?>
                                  <td>
                                    <button type="button" class="btn btn-warning" href="fabric-forms.php" data-remote="fabric-forms.php?id=<?php echo $row['fabricID'];?> #viewFab" data-toggle="modal" data-target="#myModal">View</button>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" href='fabric-forms.php' data-remote="fabric-forms.php?id=<?php echo $row['fabricID'];?> #updateFab" data-target="#myModal">Update</button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" href="fabric-forms.php" data-remote="fabric-forms.php?id=<?php echo $row['fabricID'];?> #delFab" data-target="#myModal" data-toggle="modal">Deactivate</button>
                                  </td>
                                  <?php echo ('</tr>'); }}
                                  function ftype($id){
                                    include "dbconnect.php";
                                    $type = "";
                                    $sql = "SELECT * from tblfabric_type WHERE f_typeID = '$id'";
                                    $result = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                      $type = "" . $row['f_typeName'];
                                    }
                                    return $type;
                                  }
                                  function fpattern($id){
                                    include "dbconnect.php";
                                    $pattern = "";
                                    $sql = "SELECT f_patternName from tblfabric_pattern WHERE f_patternID = '$id'";
                                    $result = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                      $pattern = "" . $row['f_patternName'];
                                    }
                                    return $pattern;
                                  }
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
        <footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer>
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