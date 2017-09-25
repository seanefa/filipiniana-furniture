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
<!--Range slider CSS -->
<link href="plugins/bower_components/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet">
<link href="plugins/bower_components/ion-rangeslider/css/ion.rangeSlider.skinModern.css" rel="stylesheet">
<!-- Range slider  -->
<script src="plugins/bower_components/ion-rangeslider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<script src="plugins/bower_components/ion-rangeslider/js/ion-rangeSlider/ion.rangeSlider-init.js"></script>

<script>

$(document).on('focus','.modal',function () {
  var rating = 0;
  $("#range_01").ionRangeSlider();

  $("#range_02").ionRangeSlider({
      min: 1,
      max: 5,
      from: 1
  });

  $('#range_02').on('change',function(){
    rating = $('#range_02').val();
    $('#valueRating').val(rating);
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
  //GET RATING
// You could now get your value like






  //
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
          checkall(2,1,'update');
        }
        else if(mat<0){
          var e = "Please input a valid number.";
          $("#error").html(e);
          $('#editrating').css('border-color','red');
          checkall(2,1,'update');
        }
        else if(mat>5){
          var e = "Input a number not greater than 5";
          $("#error").html(e);
          $('#editrating').css('border-color','red');
          checkall(2,1,'update');
        }
        else{
          var e = "";
          $("#error").html(e);
          $('#editrating').css('border-color','gray');
          checkall(2,0,'update');
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
          $('#saveBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
          
        }
        else if(mat<0){
          var e = "Please input a valid number.";
          $("#error").html(e);
          $('#rating').css('border-color','red');
          $('#saveBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
          
        }
        else if(mat>5){
          var e = "Input a number not greater than 5";
          $("#error").html(e);
          $('#rating').css('border-color','red');
          $('#saveBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
          
        }
        else{
          var e = "";
          $("#error").html(e);
          $('#rating').css('border-color','gray');
          $('#saveBtn').prop('disabled',false);$('#notif').html('');
          
        }
      });
    });
  });

  $(document).ready(function(){
// Unit Name
var userkey = '';
$('body').on('keyup','#fabricTextureName',function(){
  var user = $(this).val();
  var flag = true;
  userkey = $(this).val();
      userkey = userkey.slice(userkey.length -1 , userkey.length);
  if(userkey == '\\'){
      $('#fabricTextureNameValidate').html('Symbols not allowed');
        $('#saveBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
      $('#fabricTextureName').css('border-color','red');
      }else{
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
      $('#saveBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
      $('#fabricTextureName').css('border-color','red');
    }
    else if(!flag){
      $('#saveBtn').prop('disabled', false);$('#notif').html('');
      $('#fabricTextureName').css('border-color','limegreen');
    }
  });
}
});

});
var c1 = 0;
  var c2 = 0;

  function checkall(id,error,type){

   if(id == 1){
      if(error != 0){
        c1 = 1;
      }else if(error == 0){
        c1 = 0;
      }
   }
   if(id == 2){
      if(error != 0){
        c2 = 1;
      }else if(error == 0){
        c2 = 0;
      }
   }

   if(c1 == 0 && c2 == 0){
    if(type == 'new'){
    $('#saveBtn').prop('disabled',false);
    $('#notif').html('');
      }else if(type=='update'){
        $('#updateBtn').prop('disabled',false);
        $('#notif').html('');
      }


   }else{

   if(type == 'new'){
    $('#saveBtn').prop('disabled',true);
    $('#notif').html('Some Fields have Errors');
      }else if(type=='update'){
        $('#updateBtn').prop('disabled',true);
    $('#notif').html('Some Fields have Errors');
      }

   }

  }



  $(document).ready(function(){
    var temprem;
    var tempname;
    var error = 0;
    var flag = true;
    var userkey = "";




    $('body').on('keyup','#editname',function(){
      var user = $(this).val();

      tempname = $('#editname').val();
      temprem = $('#rem').val();


      userkey = $('#editname').val();
      userkey = userkey.slice(userkey.length -1 , userkey.length);

      if(userkey == '\\'){
        $('#message').html('Symbols not allowed');
          //$('#updateBtn').prop('disabled',false);
          $('#editname').css('border-color','red');
      }else{
      $.post('fab-text-Ucheck.php',{username : user}, function(data){

        if(data == 'unchanged'){
          error = 0;
          $('#message').html('');
          //$('#updateBtn').prop('disabled',false);
          $('#editname').css('border-color','black');
        }
        else if(data == 'Already Exist!'){
          error++;
          //$('#updateBtn').prop('disabled',true);
          $('#message').html(data);
          $('#editname').css('border-color','red');
        }
        else if(data == 'Symbols not allowed'){
          error++;
          //$('#updateBtn').prop('disabled',true);
          $('#message').html(data);
          $('#editname').css('border-color','red');
        }
        else if(data == 'No white Space'){
          error++;

          //$('#updateBtn').prop('disabled',true);
          $('#message').html(data);
          $('#editname').css('border-color','red');
        }
        else if(data == ''){
          error = 0;
          $('#message').html('');
          //$('#updateBtn').prop('disabled',true);
          $('#editname').css('border-color','black');
        }


        else if(data == 'Good!'){
          error = 0;
          $('#message').html('');
         // $('#updateBtn').prop('disabled',false);
          $('#editname').css('border-color','limegreen');
        }

        if(error == 0){

          checkall(1,0,'update');

        }else if(error != 0){

          checkall(1,1,'update');

        }


      });

}

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

$(document).ready(function(){
  $("#archiveTable").hide();
  $('#archiveSwitch').change(function(){
    if($(this).prop("checked")) {
      $('#archiveTable').show();
      $('#archiveTitle').css({'display' : ''});
      $("#tempbtn").hide();
      $('#mainTable').hide();
    } else {
      $('#archiveTable').hide();
      $('#archiveTitle').css({'display' : 'none'});
      $('#mainTable').show();
      $("#tempbtn").show();
    }
  });

  // Tooltip only Text
  $('.masterTooltip').hover(function(){
          // Hover over code
          var title = $(this).attr('title');
          $(this).data('tipText', title).removeAttr('title');
          $('<p class="tooltipsy"></p>')
          .text(title)
          .appendTo('body')
          .fadeIn('slow');
  }, function() {
          // Hover out code
          $(this).attr('title', $(this).data('tipText'));
          $('.tooltipsy').remove();
  }).mousemove(function(e) {
          var mousex = e.pageX + -100; //Get X coordinates
          var mousey = e.pageY + -15; //Get Y coordinates
          $('.tooltipsy')
          .css({ top: mousey, left: mousex })
  });
});

</script>
</head>
<body>
<!-- Preloader -->
<!--div class="preloader">
<div class="cssload-speeding-wheel"></div>
</div-->  
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="panel panel-info">
          <h3>
            <ul class="nav customtab2 nav-tabs" role="tablist">
              <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="fab-text-form.php" data-remote="fab-text-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
              <li role="presentation" class="active" >
                <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-brush-alt"></i>&nbsp;<span id="archiveTitle" style="display: none;">Archived</span>&nbsp;<?php echo $titlePage?></a>
              </li>
            </ul>
          </h3>
          <div class="pull-right" style="margin-right: 20px; margin-top: -10px;">
            <a href="javascript:void(0)" title="Archives" class="masterTooltip"><input type="checkbox" class="js-switch" id="archiveSwitch" data-color="#f96262" style="display: none;" data-switchery="true"></a>
          </div>
          <div class="tab-content">
            <!-- FABRIC TYPE -->
            <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
              <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">      
                  <div class="row">
                    <div class="table-responsive" id="mainTable"> 
                      <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblFabricTexture">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Rating <span class="mytooltip tooltip-effect-3">
                    <span class="tooltip-item">?</span>
                      <span class="tooltip-content clearfix">
                      <span class="tooltip-text">'Rating' refers to how smooth or rough a texture is</span>
                    </span>
                   </span>
                          </th>
                            <th class="removeSort">Actions</th>
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
                                <td>'.$row['textureDescription'].'</td>
                                <td>'.$row['textureRating'].'</td>
                                '); ?>
                                <td>
                                  <!-- UPDATE -->
                                  <button type="button" class="btn btn-success" data-toggle="modal" href="fab-text-form.php" data-remote="fab-text-form.php?id=<?php echo $row['textureID'];?> #update" data-target="#myModal"><i class='ti-pencil-alt'></i> Update</button>
                                  <!-- DELETE -->
                                  <button type="button" class="btn btn-danger" data-toggle="modal" href="fab-text-form.php" data-remote="fab-text-form.php?id=<?php echo $row['textureID'];?> #delete" data-target="#myModal"><i class='ti-close'></i> Deactivate</button>
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
                          </div>
                        </div>
                        <div id="archiveTable">
                          <div class="table-responsive"> 
                            <table class="table color-bordered-table muted-bordered-table dataTable display">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Description</th>
                                  <th>Rating</th>
                                  <th class="removeSort">Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $sql = "SELECT * FROM tblfabric_texture;";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                  if($row['textureStatus']=="Archived"){
                                    echo('<tr>
                                      <td>'.$row['textureName'].'</td>
                                      <td>'.$row['textureDescription'].'</td>
                                      <td>'.$row['textureRating'].'</td>
                                      '); ?>
                                      <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" href="reactivate-form.php" data-remote="reactivate-form.php?rName=Fabric+Texture&amp;id=<?php echo $row['textureID']?> #reactivate" data-target="#myModal"><i class="ti-reload"></i> Reactivate</button> 
                                      </td>
                                      <?php echo ('</tr>'); }}?>
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