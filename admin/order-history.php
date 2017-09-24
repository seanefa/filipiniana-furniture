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

  $('body').on('keyup','#username',function(){
    var user = $(this).val();
    var flag = true;
    $.post('fab-txt-check.php',{username : user}, function(data){
     
      
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
var error=0;
  $('body').on('keyup','#editname',function(){

      var user = $(this).val();
    
      tempname = $('#editname').val();
      temprem = $('#rem').val();

    $.post('fab-text-Ucheck.php',{username : user}, function(data){
   
      
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
        $('#updateBtn').prop('disabled', true);
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
          if(error==0){
          $('#updateBtn').prop('disabled',false);
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
  <div class="preloader">
    <div class="cssload-speeding-wheel"></div>
  </div>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <!--button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="fab-text-form.php" data-remote="fab-text-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button-->
                <li role="presentation" class="active" >
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-time"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>

            <div class="tab-content">
              <!-- FABRIC TYPE -->
              <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">      
                    <section class="cd-horizontal-timeline">
                <div class="timeline">
                  <div class="events-wrapper">
                    <div class="events">
                      <ol>
                        <li><a href="#0" data-date="23/02/2017" class="selected">Feb. 23</a></li>
                        <li><a href="#0" data-date="25/02/2017">Feb. 25</a></li>
                        <li><a href="#0" data-date="06/03/2017">Mar. 6</a></li>
                        <li><a href="#0" data-date="11/03/2017">Mar. 11</a></li>
                        <li><a href="#0" data-date="31/03/2017">Mar. 31</a></li>
                      </ol>

                      <span class="filling-line" aria-hidden="true"></span>
                    </div> <!-- .events -->
                  </div> <!-- .events-wrapper -->
                    
                  <ul class="cd-timeline-navigation">
                    <li><a href="#0" class="prev inactive">Prev</a></li>
                    <li><a href="#0" class="next">Next</a></li>
                  </ul> <!-- .cd-timeline-navigation -->
                </div> <!-- .timeline -->

                <div class="events-content">
                  <ol>
                    <li class="selected" data-date="23/02/2017">
                      <h2> Feb. 23, 2017</h2>
                      <hr class="m-t-40">
                      <p class="m-t-40"> 
                        Mr. Cruz, Juan order is still pending.
                      </p>

                    </li>

                    <li data-date="25/02/2017">
                      <h2> Feb. 25, 2017</h2>
                      <hr class="m-t-40">
                      <p class="m-t-40"> 
                        Ms. Garcia, Jocelyn ordered 3 Brown Couch.
                      </p>
                    </li>

                    <li data-date="06/03/2017">
                      <h2> Mar. 6, 2017</h2>
                      <hr class="m-t-40">
                      <p class="m-t-40"> 
                        Mr. Dela Cruz, John cancelled his order request.
                      </p>
                    </li>

                    <li data-date="11/03/2017">
                      <h2> Mar. 11, 2017</h2>
                      <hr class="m-t-40">
                      <p class="m-t-40"> 
                         Mr. Publico, Doc ordered 2 pieces of Yellow Seat.
                      </p>
                    </li>

                    <li data-date="31/03/2017">
                      <h2> Mar. 31, 2017</h2>
                      <hr class="m-t-40">
                      <p class="m-t-40"> 
                         Ms. Soberano, Liza ordered 5 pieces of White Seat.
                      </p>
                    </li>
                  </ol>
                </div> <!-- .events-content -->
            </section>

                        </div>
                      </div>
                    </div>
                    <!-- /.modal -->
                  </div>
                </div>  
              </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer>
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