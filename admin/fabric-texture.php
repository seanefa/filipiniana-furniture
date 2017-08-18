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
<!--Range slider CSS -->
<link href="plugins/bower_components/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet">
<link href="plugins/bower_components/ion-rangeslider/css/ion.rangeSlider.skinModern.css" rel="stylesheet">
<!-- Range slider  -->
<script src="plugins/bower_components/ion-rangeslider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<script src="plugins/bower_components/ion-rangeslider/js/ion-rangeSlider/ion.rangeSlider-init.js"></script>

<script>
$(document).on('focus','.modal',function () {
  $("#range_01").ionRangeSlider();

  $("#range_02").ionRangeSlider({
      min: 1,
      max: 5,
      from: 1
  });
  $("#range_03").ionRangeSlider({
      type: "double",
      grid: true,
      min: 0,
      max: 1000,
      from: 200,
      to: 800,
      prefix: "$"
  });
  $("#range_04").ionRangeSlider({
      type: "double",
      grid: true,
      min: -1000,
      max: 1000,
      from: -500,
      to: 500
  });
  $("#range_16").ionRangeSlider({
      grid: true,
      min: 18,
      max: 70,
      from: 30,
      prefix: "Age ",
      max_postfix: "+"
  });
  $("#range_18").ionRangeSlider({
      type: "double",
      min: 100,
      max: 200,
      from: 145,
      to: 155,
      prefix: "Weight: ",
      postfix: " million pounds",
      decorate_both: false
  });
  $("#range_22").ionRangeSlider({
      type: "double",
      min: 1000,
      max: 2000,
      from: 1200,
      to: 1800,
      hide_min_max: true,
      hide_from_to: true,
      grid: true
  });
  });
</script>

  <script>

  $(document).ready(function(){ //update form validation
    $('#myModal').on('shown.bs.modal',function(){
      $("#editname").on('keyup',function(){
        var name = document.getElementById("editname");
        if (name.value != name.defaultValue){ 
          $('#updateBtn').prop('disabled',true);
        }
        else{
          $('#updateBtn').prop('disabled',false);
        }
      });
     /* $("#editrating").on('keyup',function(){
        var rating = document.getElementById("editrating");
        if (rating.value == rating.defaultValue){ 
          $('#updateBtn').prop('disabled',true);
        }
        else{
          $('#updateBtn').prop('disabled',false);
        }
      });*/
      $("#remText").on('keyup',function(){
        var rem = document.getElementById("remText");
        if (rem.value != rem.defaultValue){ 
          $('#updateBtn').prop('disabled',true);
        }
        else{
          $('#updateBtn').prop('disabled',false);
        }
      });
    });
  });

  $(document).ready(function(){
    $('#myModal').on('shown.bs.modal',function(){
      $('#editrating').on('keyup',function() {
        var rating = document.getElementById("editrating");
        if (rating.value == rating.defaultValue){ 
          $('#updateBtn').prop('disabled',true);
        }
        else{
          $('#updateBtn').prop('disabled',false);
        }

        var mat = $("#editrating").val();
        if(isNaN(mat)){
          var e = "Please input a valid number.";
          $("#error").html(e);
          $('#editrating').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else if(mat<0){
          var e = "Please input a valid number.";
          $("#error").html(e);
          $('#editrating').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else if(mat>5){
          var e = "Input a number not greater than 5";
          $("#error").html(e);
          $('#editrating').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else{
          var e = "";
          $("#error").html(e);
          $('#editrating').css('border-color','gray');
          $('#saveBtn').prop('disabled',false);
        }
      });
    });
  });

  $(document).ready(function(){
    $('#myModal').on('shown.bs.modal',function(){
      $('#rating').on('keyup',function() {
        var mat = $("#rating").val();
        if(isNaN(mat)){
          var e = "Please input a valid number.";
          $("#error").html(e);
          $('#rating').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else if(mat<0){
          var e = "Please input a valid number.";
          $("#error").html(e);
          $('#rating').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else if(mat>5){
          var e = "Input a number not greater than 5";
          $("#error").html(e);
          $('#rating').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else{
          var e = "";
          $("#error").html(e);
          $('#rating').css('border-color','gray');
          $('#saveBtn').prop('disabled',false);
        }
      });
    });
  });

  $(document).ready(function(){
// Unit Name
$('body').on('keyup','#fabricTextureName',function(){
  var user = $(this).val();
  var flag = true;
  $.post('fab-text-check.php',{fabricTextureName : user}, function(data){ 
    $('#fabricTextureNameValidate').html(data);
    if(data != "Data Already Exist!"){
      if(data == "Symbols not allowed"){
        flag = true;
      }
      else{
        if(data == "White Space not allowed"){
          flag = true;
        }
        else{
          flag = false;
        }
      }
    }
    else if(data == "Data Already Exist!" && data == "" && data == "White Space not allowed" && data == "Symbols not allowed"){
      flag = true;
    }

    if(flag){
      $('#saveBtn').prop('disabled',true);
      $('#fabricTextureName').css('border-color','red');
    }
    else if(!flag){
      $('#saveBtn').prop('disabled', false);
      $('#fabricTextureName').css('border-color','limegreen');
    }
  });
});

});

  $(document).ready(function(){
    var temprem;
    var tempname;
    var error = 0;
    var flag = true;




    $('body').on('keyup','#editname',function(){
      var user = $(this).val();

      tempname = $('#editname').val();
      temprem = $('#rem').val();
      $.post('fab-text-Ucheck.php',{username : user}, function(data){

        if(data == 'unchanged'){
          error = 0;
          $('#message').html('');
          $('#updateBtn').prop('disabled',false);
          $('#editname').css('border-color','black');
        }
        else if(data == 'Already Exist!'){
          error++;
          $('#updateBtn').prop('disabled',true);
          $('#message').html(data);
          $('#editname').css('border-color','red');
        }
        else if(data == 'Symbols not allowed'){
          error++;
          $('#updateBtn').prop('disabled',true);
          $('#message').html(data);
          $('#editname').css('border-color','red');
        }
        else if(data == 'No white Space'){
          error++;

          $('#updateBtn').prop('disabled',true);
          $('#message').html(data);
          $('#editname').css('border-color','red');
        }
        else if(data == ''){
          error = 0;
          $('#message').html('');
          $('#updateBtn').prop('disabled',true);
          $('#editname').css('border-color','black');
        }


        else if(data == 'Good!'){
          error = 0;
          $('#message').html('');
          $('#updateBtn').prop('disabled',false);
          $('#editname').css('border-color','limegreen');
        }


      });



});
$('body').on('change','#select',function(){
  if($(this).val() == '--'){


    $('#updateBtn').prop('disabled',true);

  }
  else{
    if(error == 0){
      $('#updateBtn').prop('disabled',false);
    }
    else{
      $('#updateBtn').prop('disabled',true);
    }
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

/* $(document).ready(function(){
$("#archiveTable").hide();
$("#backArch").hide();
$("#showArch").click(function(){
$("#tblFabricTexture").hide();
$("#archiveTable").show();
$("#temptitle").text("");
$("#temptitle").text("Archived");
$("#tempbtn").hide();
$("#showArch").hide();
$("#backArch").show();
});
$("#backArch").click(function(){
$("#tblFabricTexture").show();
$("#archiveTable").hide();
$("#temptitle").text("");
$("#temptitle").text("Fabric Texture");
$("#tempbtn").show();
$("#showArch").show();
$("#backArch").hide();
});
}); */

</script>
</head>
<body>
  <!-- Preloader -->
<!--div class="preloader">
<div class="cssload-speeding-wheel"></div>
</div==>
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
              <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="fab-text-form.php" data-remote="fab-text-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
              <li role="presentation" class="active" >
                <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-brush-alt"></i>&nbsp;<?php echo $titlePage?></a>
              </li>
            </ul>
          </h3>

          <div class="tab-content">
            <!-- FABRIC TYPE -->
            <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
              <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">      
                  <div class="row">
                    <div class="table-responsive"> 
                      <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblFabricTexture">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th style="text-align:center">Description</th>
                            <th style="text-align:right">Rating</th>
                            <th class="removeSort" style="text-align:center">Actions</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          $sql = "SELECT * FROM tblfabric_texture;";
                          $result = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($result))
                          {
                            if($row['textureStatus']=="Listed"){
                              echo('<tr>
                                <td>'.$row['textureName'].'</td>
                                <td style="text-align:center">'.$row['textureDescription'].'</td>
                                <td style="text-align:right">'.$row['textureRating'].'</td>
                                '); ?>
                                <td style="text-align:center">
                                  <!-- UPDATE -->
                                  <button type="button" class="btn btn-success" data-toggle="modal" href="fab-text-form.php" data-remote="fab-text-form.php?id=<?php echo $row['textureID'];?> #update" data-target="#myModal"><span class='glyphicon glyphicon-edit'></span> Update</button>
                                  <!-- DELETE -->
                                  <button type="button" class="btn btn-danger" data-toggle="modal" href="fab-text-form.php" data-remote="fab-text-form.php?id=<?php echo $row['textureID'];?> #delete" data-target="#myModal"><span class='glyphicon glyphicon-trash'></span> Deactivate</button>
                                </td>
                                <?php echo ('</tr>'); }}?>

                                <script type="text/javascript">
                                function confirmDelete(id) {
                                  if (confirm("Are you sure you want to delete")) {
                                    window.location.href="delete-fab.php?id="+id+"";
                                  }
                                }
                                function edit(id) {
                                  window.location.href="update-fab.php?id="+id+"";
                                }
                                </script>
                              </tbody>
                            </table>

                            <p style="margin:100px;">Note: 'Rating' refers to how smooth or rough a texture is</p>
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
    </html>