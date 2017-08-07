<?php
include "titleHeader.php";
include "menu.php";
include 'dbconnect.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());

  session_start();
  if(isset($GET['id'])){
    $jsID = $_GET['id']; 
  }
  $jsID=$_GET['id'];
  $_SESSION['varname'] = $jsID;
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
    $.post('delivery-check.php',{username : user}, function(data){
     
      $('#message').html(data);
      if(data != "Already Exist!"){

        //checking of white space
        //pag yung data na sinend is "no white space" meaning may white space.flag true meaning may error.
        //sa required fields lng siguro to kailangan. basta yung may validation lagyan rin nito.
        //dito narin yung symbols lol.
      if(data == "Symbols not allowed" ){
        flag = true;
      }
      else{
        if(data == "No white Space" ){
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
var flag = true;
 



  $('body').on('keyup','#editname',function(){
    var user = $(this).val();
    
      tempname = $('#editname').val();
      temprem = $('#rem').val();
    $.post('delivery_Ucheck.php',{username : user}, function(data){
     
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
        $("#tblDeliveryRates").hide();
        $("#archiveTable").show();
        $("#temptitle").text("");
        $("#temptitle").text("Archived");
        $("#tempbtn").hide();
        $("#showArch").hide();
        $("#backArch").show();
    $("#backArch").click(function(){
      $("#tblDeliveryRates").show();
        $("#archiveTable").hide();
        $("#temptitle").text("");
        $("#temptitle").text("Delivery Rates");
        $("#tempbtn").show();
        $("#showArch").show();
        $("#backArch").hide();
    });
});
}); */

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
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#myModal" href="del-rate-forms.php" data-remote="del-rate-forms.php #new" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="fa fa-send"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- DELIVERY RATES -->
              <div role="tabpanel" class="tab-pane fade active in" id=frameworks>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">                  
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblDeliveryRates">
                          <thead>
                            <tr>
                              <th>Branch(From:)</th>
                              <th>Location(To:)</th>
                              <th>Rate Type</th>
                              <th>Rate</th>
                              <th class="removeSort">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                              <?php
                              $sql = "SELECT * FROM tbldelivery_rates;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['delRateStatus']=="Listed"){
                                  $branch = bName($row['delBranchID']);
                                  echo('<tr><td>'.$branch.'</td>
                                    <td>'.$row['delLocation'].'</td>
                                    <td>'.$row['delRateType'].'</td>
                                    <td><small>&#8369;</small>'.$row['delRate'].'</td>'); 
                                    ?>
                                    <td>
                                      <!-- UPDATE -->
                                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="del-rate-forms.php" data-remote="del-rate-forms.php?id=<?php echo $row['delivery_rateID'];?> #update"><span class='glyphicon glyphicon-edit'></span> Update</button>
                                      <!-- DELETE -->
                                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" href="del-rate-forms.php" data-remote="del-rate-forms.php?id=<?php echo $row['delivery_rateID'];?> #delete"><span class='glyphicon glyphicon-trash'></span> Deactivate</button>
                                    </td>
                                    <?php echo('</tr>');} }
                                    function bName($id){
                                      include "dbconnect.php";
                                      $sql = "SELECT * from tblbranches WHERE branchID = '$id'";
                                      $result = mysqli_query($conn,$sql);
                                      $br = "";
                                      while($row = mysqli_fetch_assoc($result)){
                                        $br = $row['branchLocation'];
                                      }
                                      return $br;
                                    }
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