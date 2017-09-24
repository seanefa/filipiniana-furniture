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
  <script>

  function deleteRow(row){
    var result = confirm("Remove Material?");
    if(result){
      var i=row.parentNode.parentNode.rowIndex;
      document.getElementById('selectedMaterials').deleteRow(i);
    }
  }

  function deleteExisting(row){
    var result = confirm("Remove Material?");
    if(result){
      $('#trowID'+row).hide();
      $('#exist'+row).attr('name','deleted[]');
    }
  }

  $('body').on('change','.fileUpload',function(){
    filePreview(this);
  });

  function filePreview(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#uploadForm + img').remove();
        $('#uploadForm').after('<img src="'+e.target.result+'" width="450" height="300"/>');
            //$('#uploadForm + embed').remove();
            //$('#uploadForm').after('<embed src="'+e.target.result+'" width="450" height="300">');
          }
          reader.readAsDataURL(input.files[0]);
        }
      }


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
      $('body').on('keyup','#remText',function(event) {

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

        $('body').on('keyup','#username',function(){
          var user = $(this).val();
          var flag = true;
          $.post('prod-check.php',{username : user}, function(data){


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
          $.post('prod-Ucheck.php',{username : user}, function(data){


            if(data != "Already Exist!" && data !="unchanged"){
              flag = false;
              error = 0;
              $('#message').html("");
              $('#updateBtn').prop('disabled', false);
              $('#editname').css('border-color','limegreen');

            }
            if(data == "unchanged"){
              error = 0;
              $('#message').html("");
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
  $('#updateBtn').prop('disabled',false);


});
$('body').on('keyup','#remText',function(){
  var tem = $(this).val();
  flag = false;
  if(!flag){
    $('#updateBtn').prop('disabled',false);
  }
});

});

/*
$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  //var $tb = $("#tb_row"), $tb_copy = $tb.children('tr').first().clone();
  //alert(tb);
  $('#addBtn').click(function() {
      var val = $("#mat").val();
    });
});
});
*/

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $('#quan').on('keyup',function(){
    var mat = $("#quan").val();
    if(isNaN(mat)){
      var e = "Please input a valid number.";
      $("#error").html(e);
      $('#quan').css('border-color','red');
      $('#addBtn').prop('disabled',true);
    }
    else if(mat==""){
      var e = "";
      $("#error").html(e);
      $('#quan').css('border-color','grey');
      $('#addBtn').prop('disabled',true);
    }
    else{
      $('#quan').css('border-color','grey');
      $('#addBtn').prop('disabled',false);
    }
  });

  $('#cat').change(function() {
    var value = $("#cat").val();
    var drop = 1;
    $.ajax({
      type: 'post',
      url: 'load-drop-downs.php',
      data: {
        id: value, type : drop,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#type' ).html(response);    
       $("#type").removeAttr('disabled');
     }
   });
  });

  $('#type').change(function() {
    var value = $("#type").val();
    var drop = 2;
    $.ajax({
      type: 'post',
      url: 'load-drop-downs.php',
      data: {
        id: value, type : drop,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#products' ).html(response);
       $("#products").removeAttr('disabled');
     }
   });
  });

  $('#mat').change(function(){
    var value = $("#mat").val();
    var drop = 3;
    $.ajax({
      type: 'post',
      url: 'load-drop-downs.php',
      data: {
        id: value, type : drop,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#var' ).html(response);
       $("#var").removeAttr('disabled');
     }
   });
  });

  $('#products').change(function(){
    var value = $("#products").val();
    var drop = 4;
    $.ajax({
      type: 'post',
      url: 'load-drop-downs.php',
      data: {
        id: value, type : drop,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#phasetab' ).html(response);
       $("#var").removeAttr('disabled');
     }
   });
  });
});
});


$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $('#addBtn').click(function() {
    var mat = $("#mat").val();
    var desc = $("#var").val();
    var quan = $("input[name='quan']").val();
    var unit = $("#unit").val();
    var error = 0;
    if(isNaN(quan)){
      var e = "Please input a valid number.";
      $("#error").html(e);
      $('#quan').css('border-color','red');
      $('#addBtn').prop('disabled',true);
      error = 1;
    }
    else if(quan==""){
      var e = "";
      $("#error").html(e);
      $('#quan').css('border-color','grey');
      $('#addBtn').prop('disabled',true);
      error = 1;
    }
    else{
      $('#quan').css('border-color','grey');
      $('#addBtn').prop('disabled',false);
      error = 0;
    }

    if(desc==""){
      var e = "Please select a material";
      $("#errorMat").html(e);
      $('#var').css('border-color','grey');
      $('#addBtn').prop('disabled',true);
      error = 1;
    }
    else{
      var e = "";
      $("#errorMat").html(e);
      $('#var').css('border-color','grey');
      $('#addBtn').prop('disabled',false);
      error = 0;
    }

    if(error==0){
    $("#hide").hide();
    $.ajax({
      type: 'post',
      url: 'prod-info-material.php',
      data: {
        mat: mat, desc : desc, quan : quan, un : unit,
      },
      success: function (response) {
       $( '#tblMat' ).append(response);
     }
   });
  }
  });


});
});

/*
$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $('#saveBtn').click(function() {
    var mat = $("#mat").val();
    var desc = $("#var").val();
    var prod = $("#products").val();
    var quan = $("input[name='quan']").val();
    var unit = $("#unit").val();
    var error = 0;
    if(isNaN(quan)){
      var e = "Please input a valid number.";
      $("#error").html(e);
      $('#quan').css('border-color','red');
      $('#addBtn').prop('disabled',true);
      error = 1;
    }
    else if(quan==""){
      var e = "";
      $("#error").html(e);
      $('#quan').css('border-color','grey');
      $('#addBtn').prop('disabled',true);
      error = 1;
    }
    else{
      $('#quan').css('border-color','grey');
      $('#addBtn').prop('disabled',false);
      error = 0;
    }

    if(desc==""){
      var e = "Please select a material";
      $("#errorMat").html(e);
      $('#addBtn').prop('disabled',true);
      error = 1;
    }
    else{
      var e = "";
      $("#errorMat").html(e);
      error = 0;
    }

    if(prod==""){
      var e = "Please select a furniture";
      $("#errorProd").html(e);
      error = 1;
    }
    else{
      var e = "";
      $("#errorProd").html(e);
      error = 0;
    }

    if(error==0){
      $('#saveBtn').prop('disabled',false);
      //$('#myForm').attr('action','prod-info-add.php');
   }
   else{
      $('#saveBtn').prop('disabled',true);
   }
  });


});
});*/

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  var value = $("#phase").val();
  var prod = $("input[name='prodID']").val();
  $.ajax({
    type: 'post',
    url: 'display-info-material.php',
    data: {
      id: value, pr : prod,
    },
    success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#tblMatView' ).append(response);
     }
   });

  $('#phase').change(function() {
    var value = $("#phase").val();
    var prod = $("input[name='prodID']").val();
    $.ajax({
      type: 'post',
      url: 'display-info-material.php',
      data: {
        id: value, pr : prod,
      },
      success: function (response) {
        $( '#tblMatView' ).empty();
       // We get the element having id of display_info and put the response inside it
       $( '#tblMatView' ).append(response);
     }
   });
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="prod-form.php" data-remote="prod-info-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active" >
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-info"></i>&nbsp;<span id="archiveTitle" style="display: none;">Archived</span>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="pull-right" style="margin-right: 20px; margin-top: -10px;">
              <a href="javascript:void(0)" title="Archives" class="masterTooltip"><input type="checkbox" class="js-switch" id="archiveSwitch" data-color="#f96262" style="display: none;" data-switchery="true"></a>
            </div>
            <div class="tab-content">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in" id="job">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive" id="mainTable">
                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblProducts">
                          <thead>
                            <tr>
                              <th>Furniture Name</th>
                              <th>Furniture Type</th>
                              <th class="removeSort">Materials</th>
                              <th class="removeSort">Action</th>
                            </tr>
                          </thead>
                          <tbody style="text-align: left;">

                            <?php
                            include "dbconnect.php";
                            $sql = "SELECT * FROM tblprod_info a, tblproduct b, tblfurn_type c WHERE a.prodInfoProduct = b.productID and b.prodTypeID = c.typeID;";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result))
                            {
                              if($row['prodStat']!="Archived" && $row['prodInfoStatus']=="Active"){

                                echo('<td>'. $row['productName'].'</td>
                                  <td>'.$row['typeName'] .'</td>
                                  ');?>
                                  <td><button type="button" class="btn btn-info" data-toggle="modal" href="prod-info-form.php" data-remote="prod-info-form.php?id=<?php echo $row['productID']?> #view1" data-target="#myModal"><i class='fa fa-info-circle'></i> View Materials</button></td>
                                  <td>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" href="prod-info-form.php" data-remote="prod-info-form.php?id=<?php echo $row['prodInfoID']?> #update" data-target="#myModal"><i class='ti-pencil-alt'></i> Update</button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" href="prod-info-form.php" data-remote="prod-info-form.php?id=<?php echo $row['prodInfoID']?> #delete" data-target="#myModal"><i class='ti-close'></i> Deactivate</button>
                                  </td>
                                  <?php echo ('</tr>');
                                }
                              }
                              ?>
                              
                              <script type="text/javascript">
                              function confirmDelete(id) {
                                window.location.href="delete-job.php?id="+id+"";
                              }
                              function edit(id){
                                window.location.href="update-job.php?id="+id+"";
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
                                <th>Furniture Name</th>
                                <th>Furniture Type</th>
                                <th class="removeSort">Materials</th>
                                <th class="removeSort">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              include "dbconnect.php";
                              $sql = "SELECT * FROM tblprod_info a, tblproduct b, tblfurn_type c WHERE a.prodInfoProduct = b.productID and b.prodTypeID = c.typeID;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['prodInfoStatus']=="Archived"){

                                  echo('<td>'. $row['productName'].'</td>
                                    <td>'.$row['typeName'] .'</td>
                                    ');?>
                                    <td><button type="button" class="btn btn-info" data-toggle="modal" href="prod-info-form.php" data-remote="prod-info-form.php?id=<?php echo $row['productID']?> #view1" data-target="#myModal"><i class='fa fa-info-circle'></i> View Materials</button></td>
                                    <td>
                                     <button type="button" class="btn btn-danger" data-toggle="modal" href="reactivate-form.php" data-remote="reactivate-form.php?rName=Production+Information&amp;id=<?php echo $row['prodInfoID']?> #reactivate" data-target="#myModal"><i class="ti-reload"></i> Reactivate</button> 
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
<!-- New Framework Modal
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
  <div class="modal-dialog modal-lg">
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