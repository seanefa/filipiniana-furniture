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
  $(document).ready(function(){
   $('#myModal').on('shown.bs.modal',function(){
    $('#percent').change(function(){
      var p = $('#percent').val();
      if((p>0) && (p<101)){
        var e = "";
        $("#pError").html(e);
        $('#percent').css('border-color','gray');
        $('#saveBtn').prop('disabled',false);
      }
      else{
        var e = "Invalid input";
        $("#pError").html(e);
        $('#percent').css('border-color','red');
        $('#saveBtn').prop('disabled',true);
      }
    });
  });
 });


  $(document).ready(function(){
   $('#myModal').on('shown.bs.modal',function(){
    $('#discountName').change(function() {
      var val = $("#discountName").val();
      $.ajax({
        type: 'post',
        url: 'discount-check.php',
        data: {
          id: val, 
        },
        success: function (response) {
          if(response==1){
            var e = "Already Exist";
            $("#nameError").html(e);
            $('#discountName').css('border-color','red');
            $('#saveBtn').prop('disabled',true);
          }
          else{
            var e = "";
            $("#nameError").html(e);
            $('#discountName').css('border-color','grey');
            $('#saveBtn').prop('disabled',false);
          }
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

<style>
#tags{
  float:left;
  border: 1px solid #98A6AD;
  padding: 3px 5px;
}
#tags > span{
  cursor:pointer;
  display:block;
  float:left;
  color:#fff;
  background:#3383FF;
  padding:2px;
  padding-right:25px;
  margin:2px;
  font-size: 12pt;
}
#tags > span:hover{
  opacity:0.7;
}
#tags > span:after{
 position:absolute;
 content:"×";
 border-left:1px solid;
 padding:2px 2px;
 margin-left:5px;
 font-size:12pt;
}
#tags > input{
  background-color: #ffffff;
  border: 0px;
  border-radius: 0px;
  box-shadow: none;
  color: #565656;
  height: 38px;
  max-width: 100%;
  padding: 7px 12px;
  transition: all 300ms linear 0s;
  width:auto;
  font-size:12pt;
}
</style>
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="discount-forms.php" data-remote="discount-forms.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active" >
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-cut"></i>&nbsp;<span id="archiveTitle" style="display: none;">Archived</span>&nbsp;<?php echo $titlePage?></a>
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
                              <th>Name</th>
                              <th>Percentage</th>
                              <th class="removeSort">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                            $sql = "SELECT * FROM tbldiscounts";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result))
                            {
                              if($row['discountStatus']=="Active"){
                                echo('<tr>
                                  <td>' . $row['discountName'] . '</td>
                                  <td>' . $row['discountPercentage'] . '</td>'); ?>
                                  <td>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" href="discount-forms.php" data-remote="discount-forms.php?id=<?php echo $row['discountID']?> #update" data-target="#myModal"><i class='ti-pencil-alt'></i> Update</button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" href="discount-forms.php" data-remote="discount-forms.php?id=<?php echo $row['discountID']?> #delete" data-target="#myModal"><i class='ti-close'></i> Deactivate</button>
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
                                    <th>Name</th>
                                    <th>Percentage</th>
                                    <th class="removeSort">Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $sql = "SELECT * FROM tbldiscounts";
                                  $result = mysqli_query($conn, $sql);
                                  while ($row = mysqli_fetch_assoc($result))
                                  {
                                    if($row['discountStatus']=="Archived"){
                                      echo('<tr><td>'.$row['discountName'].'</td>
                                      <td>'.$row['discountPercentage'].'</td>'); ?>
                                      <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" href="reactivate-form.php" data-remote="reactivate-form.php?rName=Discounts&amp;id=<?php echo $row['discountID']?> #reactivate" data-target="#myModal"><i class="ti-reload"></i> Reactivate</button> 
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
          <div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;">
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