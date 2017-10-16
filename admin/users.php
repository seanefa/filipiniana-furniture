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
                              $sql = "SELECT * FROM tblemployee a, tbluser b WHERE a.empID = b.userEmpID order by empLastName";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['userStatus']=="Active" && $row['userType']=="admin")
								{
							  ?>
							  	<tr>
									<td>
										<?php echo "" . $row["empLastName"] . ", " . $row["empFirstName"] . " " . $row["empMidName"];?>
									</td>
									<td><?php echo "" . $row["userType"];?></td>
									<td><?php echo "" . $row["userName"];?></td>
									<td><?php echo "" . $row["dateCreated"];?></td>
                                  <td>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" href="users-form.php" data-remote="users-form.php?id=<?php echo $row['userEmpID'];?> #update" data-target="#myModal" ><i class="ti-pencil-alt"></i>  Update </button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" href="users-form.php" data-remote="users-form.php?id=<?php echo $row['userID'];?> #delete" data-target="#myModal" ><i class="ti-close"></i>  Deactivate</button>
                                  </td>
                                  <?php echo('</tr>');
								}
							  }
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
