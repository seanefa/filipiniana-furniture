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


$(document).ready(function(){

  $('body').on('keyup','#cpass',function(){
    if($('#pass').val() != $('#cpass').val()){

      $('#message').html('Password do not Match');
      $('#addFab').prop('disabled','true');

    }
    else{
      $('#message').html('');
      $('#addFab').prop('disabled','');
    }


  });


});
$(document).ready(function(){

  $('body').on('keyup','#ecpass',function(){
    if($('#epass').val() != $('#ecpass').val()){

      $('#emessage').html('Password do not Match');
      $('#updateBtn').prop('disabled','true');

    }
    else{
      $('#emessage').html('');
      $('#updateBtn').prop('disabled','');
    }


  });


});

</script>
</head>
<body>
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
              <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#myModal" href="users-form.php" data-remote="users-form.php #new" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active" >
                <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="icon-people"></i>&nbsp;<span id="archiveTitle" style="display: none;">Archived</span>&nbsp;<?php echo $titlePage?></a>
              </li>
            </ul>
          </h3>
          <div class="pull-right" style="margin-right: 20px; margin-top: -10px;">
            <a href="javascript:void(0)" title="Archives" class="masterTooltip"><input type="checkbox" class="js-switch" id="archiveSwitch" data-color="#f96262" style="display: none;" data-switchery="true"></a>
          </div>
            <div class="tab-content">
              <!-- PACKAGES -->
              <div role="tabpanel" class="tab-pane fade active in" id=frameworks>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive" id="mainTable">
                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblUsers">
                          <thead>
                            <tr>
                              <th>Employee Name</th>
                              <th>User Type</th>
                              <th>Username</th>
                              <th>Date Created</th>
                              <th class="removeSort">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                              <?php
                              $sql = "SELECT * FROM tblemployee a join tbluser b on a.empID = b.userEmpID order by empLastName";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['userStatus']=="Active" && $row['userType']=="admin"){
                                  echo('<tr><td>'.$row['empLastName'].', '.$row['empMidName'].' '.$row['empFirstName'].'</td>');
                                  //$job = jName($row['empID']);
                                  echo ('<td>'.$row['userType'].'</td>
                                  <td>'.$row['userName'].'</td>
                                  <td>'.$row['dateCreated'].'</td>'); ?>
                                  <td>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" href="users-form.php" data-remote="users-form.php?id=<?php echo $row['userID'];?> #update" data-target="#myModal" ><i class="ti-pencil-alt"></i>  Update</button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" href="users-form.php" data-remote="users-form.php?id=<?php echo $row['userID'];?> #delete" data-target="#myModal" ><i class="ti-close"></i>  Deactivate</button>
                                  </td>
                                  <?php echo('</tr>');} }
                                  /* function jName($id){
                                    include "dbconnect.php";
                                    $sql = "SELECT * from tbljobs WHERE jobID = '$id'";
                                    $result = mysqli_query($conn,$sql);
                                    $cat = "";
                                    while($row = mysqli_fetch_assoc($result)){
                                      $cat = $row['jobName'];
                                    } 
                                    return $cat;
                                  } */
                                  ?>

                             </tbody>
                           </table>
                         </div>
                       </div>

                       <div id="archiveTable">
                          <div class="table-responsive"> 
                            <table class="table color-bordered-table muted-bordered-table dataTable display">
                              <thead>
                                <tr>
                              <th>Employee Name</th>
                              <th>User Type</th>
                              <th>Username</th>
                              <th>Date Created</th>
                              <th class="removeSort">Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php
                              $sql = "SELECT * FROM tblemployee a join tbluser b on a.empID = b.userEmpID order by empLastName";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['userStatus']=="Archived"){
                                  echo('<tr><td>'.$row['empLastName'].', '.$row['empMidName'].' '.$row['empFirstName'].'</td>');
                                  //$job = jName($row['empID']);
                                  echo ('<td>'.$row['userType'].'</td>
                                  <td>'.$row['userName'].'</td>
                                  <td>'.$row['dateCreated'].'</td>'); ?>
                                  <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" href="reactivate-form.php" data-remote="reactivate-form.php?rName=Users&amp;id=<?php echo $row['userID']?> #reactivate" data-target="#myModal"><i class="ti-reload"></i> Reactivate</button>
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
