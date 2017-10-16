<?php
include "titleHeader.php";
include "menu.php";
include 'dbconnect.php';
include 'toastr-buttons.php';

if(isset($GET['id'])){
    $jsID = $_GET['id']; 
  }
  $jsID=$_GET['id'];
  $_SESSION['varname'] = $jsID;


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

  $(document).on('focus','.modal',function(){
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

  
  $(document).ready(function(){
    var userkey = '';
     $('body').on('keyup','#username',function(){
    var user = $(this).val();
    var flag = true;

    userkey = $(this).val();
      userkey = userkey.slice(userkey.length -1 , userkey.length);
    if(userkey == '\\'){
        $('#addFab').prop('disabled',true);$('#notif').html('Some Fields have Error');
        $('#message').html('Symbols not allowed');
      $('#username').css('border-color','red');
      }else{
    $.post('promo-check.php',{username : user}, function(data){
     
      $('#message').html(data);
      if(data != "Already Exist!"){

        //checking of white space
        //pag yung data na sinend is "no white space" meaning may white space.flag true meaning may error.
        //sa required fields lng siguro to kailangan. basta yung may validation lagyan rin nito.
        //dito narin yung symbols lol.
      if(data == "Symbols not allowed"){
        flag = true;
      }
      else{
        if(data == "No white Space"){
          flag = true;
        }
        else{
          flag = false;
        }
      }
      }
      else if(data == "Already Exist!" && data == "" && data == "No white Space" && data == "Symbols not allowed"){
        flag = true;
      }
      //

      if(flag){
      $('#addFab').prop('disabled',true);$('#notif').html('Some Fields have Error');

      $('#username').css('border-color','red');
    }
    else if(!flag){
      $('#addFab').prop('disabled', false);$('#notif').html('');
      $('#username').css('border-color','limegreen');
    }
    
    });
}
 
  });

});

      $(document).ready(function(){
var temprem;
var tempname;
var error = 0;
var flag = true;
var userkey = '';
 



  $('body').on('keyup','#editname',function(){
    var user = $(this).val();
    
      tempname = $('#editname').val();
      temprem = $('#rem').val();
      userkey = $('#editname').val();
      userkey = userkey.slice(userkey.length -1 , userkey.length);

      if(userkey == '\\'){
        $('#updateBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
      $('#message').html('Symbols not allowed');
      $('#editname').css('border-color','red');
      }else{
    $.post('promo-Ucheck.php',{username : user}, function(data){
     
     if(data == 'unchanged'){
      error = 0;
       $('#message').html('');
          $('#updateBtn').prop('disabled',false);$('#notif').html('');
      $('#editname').css('border-color','black');
     }
     else if(data == 'Already Exist!'){
       error++;
          $('#updateBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
      $('#message').html(data);
      $('#editname').css('border-color','red');
     }
     else if(data == 'Symbols not allowed'){
       error++;
          $('#updateBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
      $('#message').html(data);
      $('#editname').css('border-color','red');
     }
     else if(data == 'No white Space'){
       error++;

          $('#updateBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
      $('#message').html(data);
      $('#editname').css('border-color','red');
     }
     else if(data == ''){
      error = 0;
          $('#message').html('');
          $('#updateBtn').prop('disabled',true);$('#notif').html('');
      $('#editname').css('border-color','black');
     }

     
     else if(data == 'Good!'){
      error = 0;
       $('#message').html('');
     $('#updateBtn').prop('disabled',false);$('#notif').html('');
      $('#editname').css('border-color','limegreen');
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
    var loadDate = new Date().toISOString().slice(0, 10);
    var flag = true;
    $('#myModal').on('shown.bs.modal',function(){
      $('#startDate').val(loadDate);
      $('#endDate').val(loadDate);

      $('body').on('change','#startDate',function(){

        var endDate = new Date(document.getElementById('endDate').value);
        var startDate = new Date(document.getElementById('startDate').value);
        var starttempDate = new Date();  
        var temp = endDate.getDate()+1;
        if(startDate < loadDate){
          alert('Start date must not be yesterday.');
          
          $('#startDate').val(loadDate = new Date().toISOString().slice(0, 10));
        }
        if(flag){
          if(startDate.getDate() > endDate.getDate()){
            flag = false;
            starttempDate.setDate(startDate.getDate()+1);
            $('#endDate').val(starttempDate.toISOString().slice(0, 10));

          }
        }
        else if(!flag){
         if(startDate > endDate.toISOString().slice(0, 10)){
          flag = true;
          var xtempDate = new Date();
          var temp = startDate.getDate()+1;
          xtempDate.setDate(temp);
          alert('End Date must not be earlier than Start Date');
          $('#endDate').val(xtempDate.toISOString().slice(0, 10));
        }
      }
    });

$('body').on('change','#endDate',function(){

  var endDate = new Date(document.getElementById('endDate').value);
  var startDate = new Date(document.getElementById('startDate').value);
  var starttempDate = new Date();  
  var temp = startDate.getDate()+1;

  if(flag){

   if(startDate > endDate){
    alert('End Date must not be earlier than Start Date');
  }
  flag = false;
  starttempDate.setDate(temp);
  $('#endDate').val(starttempDate.toISOString().slice(0, 10));

}
else if(!flag){
 if(startDate > endDate){
  flag = true;
  var xtempDate = new Date();
  var temp = startDate.getDate()+1;
  xtempDate.setDate(temp);
  alert('End Date must not be earlier than Start Date');
  $('#endDate').val(xtempDate.toISOString().slice(0, 10));
}
}
});
});
});



$('body').on('keyup','#thisPrice',function(event) {

  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40) return;

  // format number
  $(this).val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    ;
  });
});
$('body').on('keyup','#editPrice',function(event) {

  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40) return;

  // format number
  $(this).val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    ;
  });
});


$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $('#cat').ready(function() {
    var value = $("#cat").val();
    var recID = $("#recID").val();
    $.ajax({
      type: 'post',
      url: 'load-form.php',
      data: {
        id: value, record: recID,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#form' ).html(response);
     }
   });
  });

  $('#cat').on('change',function() {
    var value = this.value;
    var recID = $("#recID").val();
    $.ajax({
      type: 'post',
      url: 'load-form.php',
      data: {
        id: value,record: recID,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#form' ).html(response);
     }
   });
  });
});
});

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
   $('#amt').hide();
   $('#piece').hide();
   $('#other').hide();

   $("input[name='cat']").ready(function(){
    var val = $("input[name='cat']:checked").val();
    if(val=="Amount"){
      $('#amt').show();
      $('#piece').hide();
      $('#other').hide();
    }
    else if(val=="Pieces"){
      $('#piece').show();
      $('#amt').hide();
      $('#other').hide();  
    }
    else if(val=="Others"){
      $('#other').show();
      $('#amt').hide();
      $('#piece').hide(); 
    }
  });

   $("input[name='cat']").on('change',function(){
    var val = $("input[name='cat']:checked").val();
    if(val=="Amount"){
      $('#amt').show();
      $('#piece').hide();
      $('#other').hide();
    }
    else if(val=="Pieces"){
      $('#piece').show();
      $('#amt').hide();
      $('#other').hide();  
    }
    else if(val=="Others"){
      $('#other').show();
      $('#amt').hide();
      $('#piece').hide(); 
    }
  });

 });
});

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
   $('#rate').hide();
   $('#quan').hide();
   $('#odd').hide();

   $("input[name='p_cat']").ready(function(){
    var val = $("input[name='p_cat']:checked").val();
    if(val=="Amount"){
      $('#rate').show();
      $('#quan').hide();
      $('#odd').hide();
    }
    else if(val=="Pieces"){
      $('#rate').hide();
      $('#quan').show();
      $('#odd').hide();  
    }
    else if(val=="Others"){
      $('#rate').hide();
      $('#quan').hide();
      $('#odd').show(); 
    }
  });

   $("input[name='p_cat']").on('change',function(){
    var val = $("input[name='p_cat']:checked").val();
    if(val=="Amount"){
      $('#rate').show();
      $('#quan').hide();
      $('#odd').hide();
    }
    else if(val=="Pieces"){
      $('#rate').hide();
      $('#quan').show();
      $('#odd').hide();  
    }
    else if(val=="Others"){
      $('#rate').hide();
      $('#quan').hide();
      $('#odd').show(); 
    }
  });

 });
});

$(document).ready(function(){

 $('#myModal').on('shown.bs.modal',function(){

  var start = $('#tempdate').val();
  var end = $('#tempend').val();

  $('#startDate').val(start);
  $('#endDate').val(end);

});
});

/*
$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){

   $("input[name='type']").on('change',function(){
    var val = $("input[name='type']:checked").val();
    if(val=="Percentage"){

    $('#promoRate').html("%");
    }
    else if(val=="Fixed"){

    $('#promoRate').html("<small>&#8369;</small>");
  }
  });
   

 });
});*/


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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#myModal" href="promo-form.php" data-remote="promo-form.php #new" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active" >
                <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="fa fa-tag"></i>&nbsp;<span id="archiveTitle" style="display: none;">Archived</span>&nbsp;<?php echo $titlePage?></a>
              </li>
            </ul>
          </h3>
          <div class="pull-right" style="margin-right: 20px; margin-top: -10px;">
            <a href="javascript:void(0)" title="Archives" class="masterTooltip"><input type="checkbox" class="js-switch" id="archiveSwitch" data-color="#f96262" style="display: none;" data-switchery="true"></a>
          </div>
            <div class="tab-content">
              <!-- Promos -->
              <div role="tabpanel" class="tab-pane fade active in" id=frameworks>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">                 
                    <div class="row">
                      <div class="table-responsive" id="mainTable">
                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblPromos">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th class="limitDataWidth">Description</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th class="removeSort">Actions</th>
                            </tr>
                          </thead>
                          <tbody>


                            <?php
                            $sql = "SELECT * FROM tblpromos;";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result))
                            {
                              if($row['promoStatus']=="Active"){
                                ?>
                                  <?php
                                  $date = date_create($row['promoStartDate']);
                                  $date = date_format($date,"F d, Y");

                                  $edate = date_create($row['promoEnd']);
                                  $edate = date_format($edate,"F d, Y");

                                  echo ('
                                    <td>'.$row['promoName'].'</td>
                                    <td>'.$row['promoDescription'].'</td>
                                    <td>'.$date.'</td>
                                    <td>'.$edate.'</td>
                                    <td>
                                    <!-- VIEW -->
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal" href="promo-form.php" data-remote="promo-form.php?id='. $row['promoID'].' #view"><i class="fa fa-info-circle"></i> View</button>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="promo-form.php" data-remote="promo-form.php?id='. $row['promoID'].' #update"><i class="ti-pencil-alt"></i> Update</button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" href="promo-form.php" data-remote="promo-form.php?id='. $row['promoID'].' #delete"><i class="ti-close"></i> Deactivate</button>
                                    </td>
                                    
                                    </tr>');} }
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


                        <div id="archiveTable">
                          <div class="table-responsive"> 
                            <table class="table color-bordered-table muted-bordered-table dataTable display">
                              <thead>
                                <tr>
                              <th>Name</th>
                              <th>Description</th>
                              <th>Start Date</th>
                              <th class="removeSort">Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                 <?php
                            $sql = "SELECT * FROM tblpromos;";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result))
                            {
                              if($row['promoStatus']!="Active"){
                                ?>
                                  <?php
                                  $date = date_create($row['promoStartDate']);
                                  $date = date_format($date,"F d, Y");
                                  echo ('
                                    <td>'.$row['promoName'].'</td>
                                    <td>'.$row['promoDescription'].'</td>
                                    <td>'.$date.'</td>
                                    <td>
                                      <button type="button" class="btn btn-danger" data-toggle="modal" href="reactivate-form.php" data-remote="reactivate-form.php?rName=Promos&amp;id='. $row['promoID'].' #reactivate" data-target="#myModal"><i class="ti-reload"></i> Reactivate</button> 
                                    </td>
                                    </tr>');} }
                                    ?>
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
            </div>
            <!--footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer-->
          </div>
        </div>
        <div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
          <div class="modal-dialog modal-md">
            <div class="modal-content clearable-content">
              <div class="modal-body">

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