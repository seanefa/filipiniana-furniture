<?php
include "titleHeader.php";
include "menu.php";
include 'dbconnect.php';
?>
<!DOCTYPE html>  
<html lang="en">
<head>
<script>
var dateArray = ["January","February","March","April","May","June","July","August","September","October","November","December"];
var jan = 0;
var feb = 0;
var mar = 0;
var apr = 0;
var may = 0;
var jun = 0;
var jul = 0;
var aug = 0;
var sep = 0;
var oct = 0;
var nov = 0;
var dec = 0;

$(document).ready(function(){
    $('#frequency').change(function(){
      var value = $("#frequency").val();
      $.ajax({
        type: 'post',
        url: 'reports-drop.php',
        data: {
          id: value,
        },
        success: function (response) {
          $( '#range' ).html(response);
        }
      });
    });//end change

    $("#gen").on('click',function(){
      //alert("BOO YAH LALALALALALAL HAPPINESS!!!");
      var value = $("#frequency").val();
      if(value==1){
        var date = $("#dateRep").val();
        $.ajax({
        type: 'post',
        url: 'order-output.php',
        data: {
          id: value, d: date,
        },
        success: function (response) {
          $( '#reportsOut' ).html(response);
        }
      });
      }

      if(value==2){
        var m = $("#month").val();
        var y = $("#year").val();


        $.ajax({
        type: 'post',
        url: 'order-output.php',
        data: {
          id: value, m: m, y:y,
        },
        success: function (response) {
          $( '#reportsOut' ).html(response);
           
        }
      });
      }

      if(value==3){
        var y = $("#year").val();
        $.ajax({
        type: 'post',
        url: 'order-output.php',
        data: {
          id: value, y : y,
        },
        success: function (response) {
          $( '#reportsOut' ).html(response);
           jan = $('#01').val();
           feb = $('#02').val();
           mar = $('#03').val();
           apr = $('#04').val();
           may = $('#05').val();
           jun = $('#06').val();
           jul = $('#07').val();
           aug = $('#08').val();
           sep = $('#09').val();
           oct = $('#10').val();
           nov = $('#11').val();
           dec = $('#12').val();

          myChart = new Chart(ctx, {
          type: 'bar',
          data: {
          labels: dateArray,
          datasets: [{
          label: 'Order Report',
          data: [jun,feb,mar,apr,may,jun,jul,aug,sep,oct,nov,dec],
          backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 99, 132, 0.2)'
          ],
          borderColor: [
              'rgba(255,99,132,1)',
              'rgba(255,99,132,1)',
              'rgba(255,99,132,1)',
              'rgba(255,99,132,1)',
              'rgba(255,99,132,1)',
              'rgba(255,99,132,1)',
              'rgba(255,99,132,1)',
              'rgba(255,99,132,1)',
              'rgba(255,99,132,1)',
              'rgba(255,99,132,1)',
              'rgba(255,99,132,1)',
              'rgba(255,99,132,1)'
          ],
          borderWidth: 1
              }]
          },
          options: {
          responsive: true
            }
        });
        }
      });
      }
    });
  });
  </script>
  <script src="plugins/bower_components/Chart.js/Chart.js"></script>
  <script src="plugins/bower_components/Chart.js/Chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js" ></script>
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
              <li role="presentation" class="active" >
                <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-bar-chart"></i>&nbsp;<?php echo $titlePage?></a>
              </li>
            </ul>
          </h3>

          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
              <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                  <div class="row"> <!--LABELS-->
                    <div class="col-md-3">
                      <label class="control-label">FREQUENCY</label>
                    </div>
                    <div class="col-md-3">
                      <label class="control-label" id="lblrange">DATE</label>
                    </div>
                    <div class="col-md-4">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <select id="frequency" style="height:40px;" class="form-control" data-placeholder="Choose Category" tabindex="1" name="frequency"> 
                        <option value="1">Daily</option>
                        <option value="2">Monthly</option>
                        <option value="3">Annually</option>
                      </select>
                    </div>
                    <div id="range">
                    <div class="col-md-3">
                      <input type="date" id="dateRep" name ="dateRep" class="form-control" required/>
                      

                    </div>
                  </div>
                    <div class="col-md-3">
                      <button type="button" id="gen" class="btn btn-success waves-effect text-left"><i class="fa fa-check"></i>&nbsp;Generate</button>
                    </div>
                    <br><br>
                      <div class="sttabs tabs-style-flip" style="margin-top: 40px;">
                    <nav>
                      <ul>
                        <li><h3><a href="#myChart" class="ti-layout"><span> Table View</span></a></h3></li>
                      </ul>
                    </nav>
                    <div class="content-wrap text-center" style="margin-top: -10px;">
                    <section id="myTable">
                        <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="barchart">
                          <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">
                          <div class="row" id="reportsOut">
                            <h2 style="text-align: center;">PLEASE SELECT FREQUENCY AND DATE TO GENERATE REPORT</h2>
                          </div>
                          </div>
                          </div>
                          </div>
                        </div>
                    </section>
                    <section >
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="barchart">
                          <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">
                              <div class="row" id="reportsChart">
                                <div class="col-md-12">
                                <h2>BAR GRAPH</h2>
                                <canvas id="myChart"></canvas>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                    </div>
                    </div>
                    </div>
                  </div>
                  <br>
                </div>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </div>
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

<script type="text/javascript">
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: dateArray,
        datasets: [{
            label: 'Order Report',
            ddata: [jan,feb,mar,apr,may,jun,jul,aug,sep,oct,nov,dec],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
      responsive: true,
      maintainAspectRatio : true
    }
});
</script>
</body>
</html>