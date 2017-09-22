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
else if (isset($_GET['reactivateSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
  echo 'document.getElementById("toastReactivateSuccess").click();';
  echo '});';
  echo '</script>';
}

?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <script>

  $(document).ready(function(){
    // Material Attribute
    $('body').on('keyup','#attribb',function(){
      var user = $(this).val();
      var flag = true;
      $.post('variants-check.php',{attribb : user}, function(data){ 
        $('#attribbValidate').html(data);
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
      else if(data == "" && data == "White Space not allowed" && data == "Symbols not allowed"){
        flag = true;
      }

        if(flag){
          $('#saveBtn').prop('disabled',true);
         // $('#attribb').css('border-color','red');
        }
        else if(!flag){
          $('#saveBtn').prop('disabled', false);
         // $('#attribb').css('border-color','limegreen');
        }
      });
    });

  });

  $(document).ready(function(){
    // Material Attribute
    $('body').on('keyup','#description',function(){
      var user = $(this).val();
      var flag = true;
      $.post('variants-check.php',{attribb : user}, function(data){ 
       

        if(data == "White Space not allowed"){
          flag = true;
        }
          if(data == "Symbols not allowed"){
        flag = true;
      }
      
      else if(data == "good"){
        flag = false;
      }

        if(flag){
          $('#saveBtn').prop('disabled',true);
          $('#description').css('border-color','red');
           $('#descValid').html(data);
        }
        else if(!flag){
          $('#saveBtn').prop('disabled', false);
          $('#description').css('border-color','limegreen');
           $('#descValid').html("");
        }
      });
    });

  });


 function updateValidate(id){
    var user = $('#attrib'+id).val();

      tempname = $('#attrib'+id).val();
      temprem = $('#rem').val();
      
    userkey = $('#attrib'+id).val();
      userkey = userkey.slice(userkey.length -1 , userkey.length);

      if(userkey == '\\'){
        $('#saveBtn').prop('disabled',true);
      $('#message'+id).html('Symbols not Allowed');
      $('#attrib'+id).css('border-color','red');
      }else{
    $.post('variants-check.php',{username : user}, function(data){
     
     if(data == 'unchanged'){
      error = 0;
       $('#message'+id).html('');
          $('#saveBtn').prop('disabled',false);
      $('#attrib'+id).css('border-color','black');
     }
     else if(data == 'Already Exist!'){
       error++;
          $('#saveBtn').prop('disabled',true);
      $('#message'+id).html(data);
      $('#attrib'+id).css('border-color','red');
     }
     else if(data == 'Symbols not allowed'){
       error++;
          $('#saveBtn').prop('disabled',true);
      $('#message'+id).html(data);
      $('#attrib'+id).css('border-color','red');
     }
     else if(data == 'No white Space'){
       error++;

          $('#saveBtn').prop('disabled',true);
      $('#message'+id).html(data);
      $('#attrib'+id).css('border-color','red');
     }
     else if(data == ''){
      error = 0;
          $('#message'+id).html('');
          $('#saveBtn').prop('disabled',true);
      $('#attrib'+id).css('border-color','black');
     }

     
     else if(data == 'Good!'){
      error = 0;
       $('#message'+id).html('');
     $('#saveBtn').prop('disabled',false);
      $('#attrib'+id).css('border-color','limegreen');
     }


    });
  }

  }

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){

   $('#purpose').on('change', function() {
    if ( this.value == '1')
    //.....................^.......
  {
    $("#business").show();
  }
  else
  {
    $("#business").hide();
  }
});

 });
});

  
      
      
$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $('#attribs').ready(function() {
    var value = $("#attribs").val();
      var arraynum = "0";
  var recID = "1";
    $.ajax({
      type: 'post',
      url: 'load-form-var.php',
      data: {
        id: value, record: recID, arnum: arraynum,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#input_field' ).html(response);
      }
      });
      
      
    });

    $('#attribs').change(function() {
    var value = this.value;
    var arraynum = "0";
  var recID = "1";
    $.ajax({
      type: 'post',
      url: 'load-form-var.php',
      data: {
        id: value,record: recID, arnum: arraynum,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#input_field' ).html(response);
      }
      });
        
    });

});
}); 

      
$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $('#attribs1').ready(function() {
    var value = $("#attribs1").val();
      var arraynum = "1";
  var recID = "1";
    $.ajax({
      type: 'post',
      url: 'load-form-var.php',
      data: {
        id: value, record: recID, arnum: arraynum,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#input_field1' ).html(response);
      }
      });
      
      
    });

    $('#attribs1').change(function() {
    var value = this.value;
    var arraynum = "1";
  var recID = "1";
    $.ajax({
      type: 'post',
      url: 'load-form-var.php',
      data: {
        id: value,record: recID, arnum: arraynum,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#input_field1' ).html(response);
      }
      });
        
    });

});
}); 
      
      
      
$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $('#attribs2').ready(function() {
    var value = $("#attribs2").val();
      var arraynum = "2";
  var recID = "1";
    $.ajax({
      type: 'post',
      url: 'load-form-var.php',
      data: {
        id: value, record: recID, arnum: arraynum,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#input_field2' ).html(response);
      }
      });
      
      
    });

    $('#attribs2').change(function() {
    var value = this.value;
    var arraynum = "2";
  var recID = "1";
    $.ajax({
      type: 'post',
      url: 'load-form-var.php',
      data: {
        id: value,record: recID, arnum: arraynum,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#input_field2' ).html(response);
      }
      });
        
    });

});
}); 
      
      
$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
    $("#attrib0").select2({
      tags: true,
      tokenSeparators: [',']
    });
});
});        

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
    $("#attrib1").select2({
      tags: true,
      tokenSeparators: [',']
    });
});
});
      
$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
    $("#attrib2").select2({
      tags: true,
      tokenSeparators: [',']
    });
});
});   
      
$(document).ready(function(){ 
    $('#myModal').on('shown.bs.modal',function(){
        var $selects = $('select');

        $selects.on('change', function() {

            // enable all options
            $selects.find('option').prop('disabled', false);

            // loop over each select, use its value to 
            // disable the options in the other selects
            $selects.each(function() {
               $selects.not(this)
                       .find('option[value="' + this.value + '"]')
                       .prop('disabled', true); 
            });

        });
    });
});
      
      
$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
    $("#attrib0").on('change',function(){
        if($(this).val()){
            $("#attrib1").prop('disabled',false);
        }
    });
});
});

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
    $("#attrib1").on('change',function(){
        if($(this).val()){
            $("#attrib2").prop('disabled',false);
        }
    });
});
});
      
/*
$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){

  $('#material').on('change', function() {
    var value = this.value;
    alert(value);
    $.ajax({
      type: 'post',
      url: 'load-form.php',
      data: {
        id: value,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#form' ).html(response);
      }
      });
    });
});
});*/

/*$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $('#material').ready(function() {
    var value = $("#material").val();
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

    $('#material').change(function() {
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
  <!-- Toast Notification -->
<button class="tst1" id="toastNewSuccess" style="display: none;"></button>
<button class="tst2" id="toastUpdateSuccess" style="display: none;"></button>
<button class="tst3" id="toastDeactivateSuccess" style="display: none;"></button>
<button class="tst4" id="toastReactivateSuccess" style="display: none;"></button>
  <div id="page-wrapper">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="variants-form.php" data-remote="variants-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active" >
                <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="fa fa-thumb-tack"></i>&nbsp;<span id="archiveTitle" style="display: none;">Archived</span>&nbsp;<?php echo $titlePage?></a>
              </li>
            </ul>
          </h3>
          <div class="pull-right" style="margin-right: 20px; margin-top: -10px;">
            <a href="javascript:void(0)" title="Archives" class="masterTooltip"><input type="checkbox" class="js-switch" id="archiveSwitch" data-color="#f96262" style="display: none;" data-switchery="true"></a>
          </div>
            <div class="tab-content">
              <!-- FRAMEWORKS -->
              <div role="tabpanel" class="tab-pane fade active in" id=frameworks>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">                 
                    <div class="row">
                      <div class="table-responsive" id="mainTable">
                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblFrameworkMaterial">
                          <thead>
                            <tr>
                              <th>Variants</th>
                              <th>Material Brand</th>
                              <th class="removeSort">Action</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                            $sql = "SELECT * FROM tblmaterials b, tblmat_var a WHERE a.materialID = b.materialID";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result))
                            {
                              if($row['mat_varStatus']=="Active"){
                                echo('<tr><td>'.$row['mat_varDescription'].'</td><td>'.$row['materialName'].'</td>'); ?>
                                <td>
                                  <!-- UPDATE -->
                                  <button type="button" class="btn btn-success" data-toggle="modal" href="variants-form.php" data-remote="variants-form.php?id=<?php echo $row['mat_varID']?> #update" data-target="#myModal"><i class='ti-pencil-alt'></i> Update</button>
                                  <!-- DELETE -->
                                  <button type="button" class="btn btn-danger" data-toggle="modal" href="variants-form.php" data-remote="variants-form.php?id=<?php echo $row['mat_varID']?> #delete" data-target="#myModal"><i class='ti-close'></i> Deactivate</button>
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

                        <div id="archiveTable">
                          <div class="table-responsive"> 
                            <table class="table color-bordered-table muted-bordered-table dataTable display">
                              <thead>
                                <tr>
                              <th>Variants</th>
                              <th>Material Brand</th>
                              <th class="removeSort">Action</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                            $sql = "SELECT * FROM tblmaterials b, tblmat_var a WHERE a.materialID = b.materialID";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result))
                            {
                              if($row['mat_varStatus']=="Archived"){
                                echo('<tr><td>'.$row['mat_varDescription'].'</td><td>'.$row['materialName'].'</td>'); ?>
                                <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" href="reactivate-form.php" data-remote="reactivate-form.php?rName=Material+Variants&amp;id=<?php echo $row['mat_varID']?> #reactivate" data-target="#myModal"><i class="ti-reload"></i> Reactivate</button> 
                                </td>
                                <?php echo('</tr>');} }
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