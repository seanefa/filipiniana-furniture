<?php
include "titleHeader.php";
include "menu.php";
include 'dbconnect.php';

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
else if (isset($_GET['actionFailed']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
  echo 'document.getElementById("toastFailed").click();';
  echo '});';
  echo '</script>';
}

?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <script>

  $(document).ready(function(){
    // Company Name
    $('body').on('keyup','#companyName',function(){
      var user = $(this).val();
      var flag = true;
      if(user == '\\'){
        $('#saveBtn').prop('disabled',true);
          $('#companyName').css('border-color','red');
          $('#companyNameValidate').html('Symbols not Allowed');
      }else{
      $.post('supplier-check.php',{companyName : user}, function(data){ 
        $('#companyNameValidate').html(data);
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
          $('#companyName').css('border-color','red');
        }
        else if(!flag){
          $('#saveBtn').prop('disabled', false);
          $('#companyName').css('border-color','limegreen');
        }
      });
    }
    });


    // Company Address
    $('body').on('keyup','#companyAddress',function(){
      var user = $(this).val();
      var flag = true;
      if(user == '\\'){
        $('#companyAddressValidate').html('Sybols not allowed');
        $('#saveBtn').prop('disabled',true);
          $('#companyAddress').css('border-color','red');
      }else{
      $.post('supplier-check.php',{companyAddress : user}, function(data){ 
        $('#companyAddressValidate').html(data);
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
          $('#companyAddress').css('border-color','red');
        }
        else if(!flag){
          $('#saveBtn').prop('disabled', false);
          $('#companyAddress').css('border-color','limegreen');
        }
      });
    }
    });

    // Telephone Number
    $('body').on('keyup','#telNumber',function(){
      var user = $(this).val();
      var flag = true;
      if(user == '\\'){
        $('#telNumberValidate').html('Symbols not Allowed');
         $('#saveBtn').prop('disabled',true);
          $('#telNumber').css('border-color','red');
      }else{
      $.post('supplier-check.php',{telNumber : user}, function(data){ 
        $('#telNumberValidate').html(data);
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
      else if(data == "Data Already Exist!"){
        flag = true;
      }

        if(flag){
          $('#saveBtn').prop('disabled',true);
          $('#telNumber').css('border-color','red');
        }
        else if(!flag){
          $('#saveBtn').prop('disabled', false);
          $('#telNumber').css('border-color','limegreen');
        }
      });
    }
    });

    // Contact Person
    $('body').on('keyup','#contactPerson',function(){
      var user = $(this).val();
      var flag = true;
      if(user == '\\'){
         $('#saveBtn').prop('disabled',true);
          $('#contactPerson').css('border-color','red');
          $('#contactPersonValidate').html('Symbols not allowed');
      }else{
      $.post('supplier-check.php',{contactPerson : user}, function(data){ 
        $('#contactPersonValidate').html(data);
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
          $('#contactPerson').css('border-color','red');
        }
        else if(!flag){
          $('#saveBtn').prop('disabled', false);
          $('#contactPerson').css('border-color','limegreen');
        }
      });
    }
    });

    // Position
    $('body').on('keyup','#position',function(){
      var user = $(this).val();
      var flag = true;
      if(user == '\\'){
        $('#positionValidate').html('Symbols not allowed');
        $('#saveBtn').prop('disabled',true);
          $('#position').css('border-color','red');
      }else{
      $.post('supplier-check.php',{position : user}, function(data){ 
        $('#positionValidate').html(data);
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
          $('#position').css('border-color','red');
        }
        else if(!flag){
          $('#saveBtn').prop('disabled', false);
          $('#position').css('border-color','limegreen');
        }
      });
    }
    });

  });

var temprem;
var tempname;
var error = 0;
var flag = true;

    var userkey = '';

  function updateValidate(id){
    var user = $('#edit'+id).val();

      tempname = $('#edit'+id).val();
      temprem = $('#rem').val();
      
    userkey = $('#edit'+id).val();
      userkey = userkey.slice(userkey.length -1 , userkey.length);

      if(userkey == '\\'){
        $('#updateBtn').prop('disabled',true);
      $('#message'+id).html('Symbols not Allowed');
      $('#edit'+id).css('border-color','red');
      }else{
    $.post('supplier-ucheck.php',{username : user}, function(data){
     
     if(data == 'unchanged'){
      error = 0;
       $('#message'+id).html('');
          $('#updateBtn').prop('disabled',false);
      $('#edit'+id).css('border-color','black');
     }
     else if(data == 'Already Exist!'){
       error++;
          $('#updateBtn').prop('disabled',true);
      $('#message'+id).html(data);
      $('#edit'+id).css('border-color','red');
     }
     else if(data == 'Symbols not allowed'){
       error++;
          $('#updateBtn').prop('disabled',true);
      $('#message'+id).html(data);
      $('#edit'+id).css('border-color','red');
     }
     else if(data == 'No white Space'){
       error++;

          $('#updateBtn').prop('disabled',true);
      $('#message'+id).html(data);
      $('#edit'+id).css('border-color','red');
     }
     else if(data == ''){
      error = 0;
          $('#message'+id).html('');
          $('#updateBtn').prop('disabled',true);
      $('#edit'+id).css('border-color','black');
     }

     
     else if(data == 'Good!'){
      error = 0;
       $('#message'+id).html('');
     $('#updateBtn').prop('disabled',false);
      $('#edit'+id).css('border-color','limegreen');
     }


    });
  }

  }

     $(document).ready(function(){

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
 $('#myModal').on('shown.bs.modal',function(){
    $("#telNumber").select2({
      tags: true
    });
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

function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }

$(document).ready(function(){
    $('body').on('keypress','#contactPerson', function(event){
        var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) { 
            event.preventDefault(); 
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
<button class="tst4" id="toastReactivateSuccess" style="display: none;"></button>
<button class="tst5" id="toastFailed" style="display: none;"></button>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="supplier-form.php" data-remote="supplier-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
               <li role="presentation" class="active" >
                <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="fa fa-truck"></i>&nbsp;<span id="archiveTitle" style="display: none;">Archived</span>&nbsp;<?php echo $titlePage?></a>
              </li>
            </ul>
          </h3>
          <div class="pull-right" style="margin-right: 20px; margin-top: -10px;">
            <a href="javascript:void(0)" title="Archives" class="masterTooltip"><input type="checkbox" class="js-switch" id="archiveSwitch" data-color="#f96262" style="display: none;" data-switchery="true"></a>
          </div>
            <div class="tab-content">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in" id="supplier">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive" id="mainTable">
                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblsuppliers">
                          <thead>
                            <tr>
                              <th>Company Name</th>
                              <th>Company Address</th>
                              <th>Contact Number</th>
                              <th>Contact Person</th>
                              <th class="removeSort">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php
                              include "dbconnect.php";
                              $sql = "SELECT * FROM tblsupplier;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['supStatus']=="Listed"){
                                  echo('<td>'.$row['supCompName'].'</td>
                                    <td>'.$row['supCompAdd'].'</td>
                                    <td>'.$row['supCompNum'].'</td>
                                    <td>'.$row['supContactPerson'].',&nbsp;'.$row['supPosition'].'</td>
                                    ');?>
                                    <td>
                                      <!-- UPDATE -->
                                      <button type="button" class="btn btn-success" data-toggle="modal" href="supplier-form.php" data-remote="supplier-form.php?id=<?php echo $row['supplierID']?> #update" data-target="#myModal"><i class='ti-pencil-alt'></i> Update</button>
                                      <!-- DELETE -->
                                      <button type="button" class="btn btn-danger" data-toggle="modal" href="supplier-form.php" data-remote="supplier-form.php?id=<?php echo $row['supplierID']?> #delete" data-target="#myModal"><i class='ti-close'></i> Deactivate</button>
                                    </td>
                                    <?php echo ('</tr>');
                                  }
                                }
                                ?>
                              
                              <script type="text/javascript">
                                function confirmDelete(id) {
                                  window.location.href="delete-supplier.php?id="+id+"";
                                }
                                function edit(id){
                                  window.location.href="update-supplier.php?id="+id+"";
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
                              <th>Company Name</th>
                              <th>Company Address</th>
                              <th>Telephone Number</th>
                              <th>Contact Person</th>
                              <th class="removeSort">Actions</th>
                                </tr>
                              </thead>
                          <tbody>
                              <?php
                              include "dbconnect.php";
                              $sql = "SELECT * FROM tblsupplier;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['supStatus']=="Archived"){
                                  echo('<td>'.$row['supCompName'].'</td>
                                    <td>'.$row['supCompAdd'].'</td>
                                    <td>'.$row['supCompNum'].'</td>
                                    <td>'.$row['supContactPerson'].',&nbsp;'.$row['supPosition'].'</td>
                                    ');?>
                                   <td>
                                         <button type="button" class="btn btn-danger" data-toggle="modal" href="reactivate-form.php" data-remote="reactivate-form.php?rName=Supplier&amp;id=<?php echo $row['supplierID']?> #reactivate" data-target="#myModal"><i class="ti-reload"></i> Reactivate</button> 
                                      </td>
                                    <?php echo ('</tr>');
                                  }
                                }
                                ?>
                            </tbody>
                                  </table>
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
</html>