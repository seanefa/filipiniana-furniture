<?php
include "titleHeader.php";
include "menu.php";
//session_start();
/*if(isset($GET['id'])){
$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];
$_SESSION['varname'] = $jsID;*/
include 'dbconnect.php';

?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <title>Queries</title>


  <script>
  $(document).ready(function(){

var value = $("#query").val(); // on load

$.ajax({
  type: 'post',
  url: 'query-result.php',
  data: {
    id: value,
  },
  success: function (response) {
    $('#tblQuery').html(response); 
  }
});

});

  $(document).ready(function(){
  $('#query').change(function() {
    var value = $("#query").val();
    alert(value);
    $.ajax({
      type: 'post',
      url: 'query-result.php',
      data: {
        id: value,
      },
      success: function (response) {
       $( '#tblQuery' ).html(response);
     }
   });
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
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a id="temptitle" href="#packages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i id="ti" class="ti-pencil"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="packages">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-4">
                        <select class="form-control" tabindex="1" id="query" name="query">
                         <option value="1">Most Ordered Furniture</option>
                         <option value="3">Most Loyal Customer</option>
                         <option value="2">Customer Information</option>
                         <option value="4">Customer with Balances</option>
                         <option value="5">List of Cancelled Orders</option>
                       </select>
                     </div>
                      <!--<div class="col-md-2">
                      <h4><label class="control-label">Filter</label></h4>
                        <select class="form-control" tabindex="1" id="filter" name="filter">
                         <option value="All">All</option>
                         <option value="Daily">Daily</option>
                         <option value="Weekly">Weekly</option>
                         <option value="Monthly">Monthly</option>
                         <option value="Yearly">Yearly</option>
                       </select>
                     </div>
                      <div class="col-md-2">
                      <h4><label class="control-label">Filter</label></h4>
                        <select class="form-control" tabindex="1" id="filter" name="filter">
                         <option value="Daily">Daily</option>
                         <option value="Weekly">Weekly</option>
                         <option value="Monthly">Monthly</option>
                         <option value="Yearly">Yearly</option>
                       </select>
                     </div>

                     <div class="col-md-4">

                       <button type="button" class="btn btn-success waves-effect text-left"><i class="fa fa-check"></i> Execute</button>
                     </div>-->

                   </div>
                   <br><br>
                   <div role="tabpanel" class="tab-pane fade active in" id="job">
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                      <div class="panel-body">
                        <div class="row">
                          <div class="table-responsive">
                            <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblQuery">

                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
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