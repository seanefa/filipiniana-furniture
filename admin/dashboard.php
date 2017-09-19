<?php
include "titleHeader.php";
include "menu.php";
include 'dbconnect.php';
?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <script>
  </script>
</head>
<body>
  <div id="page-wrapper">
    <div class="container-fluid">
        <div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
      <div class="row">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active" >
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="fa fa-bell"></i>&nbsp;Notifications</a>
                </li>
              </ul>
            </h3>

            <div class="tab-content">
              <!-- FABRIC TYPE -->
              <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">      
                    <div class="row">
                      <div class="table-responsive"> 
                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblFabricTexture">
                          <thead>
                            <tr>
                              <th>New Registrations</th>
                              <th>Payments</th>
                              <th>Inquiries</th>
                              <th>Messages</th>
                              <th>Orders</th>
                            </tr>
                          </thead>
                          <tbody>
                          
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
            <div class="row">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <!--button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="fab-text-form.php" data-remote="fab-text-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button-->
                <li role="presentation" class="active" >
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="fa fa-clock-o"></i>&nbsp;Order History</a>
                </li>
              </ul>
            </h3>

            <div class="tab-content">
              <!-- FABRIC TYPE -->
              <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                <!-- brochure -->
                          <ul class="nav customtab2">
                              <li class style="border-top:1px solid darkgray;">
                                  <p class="text-success">
                                      <span class="badge" style="background-color:forestgreen;">4</span> Mr. Publico, Doc ordered 2 pieces of Yellow Seat. Mar. 11, 2017
                                      <br>
                                  </p>
                              </li>
                              <li class style="border-top:1px solid darkgray;">
                                  <p class="text-warning">
                                      <span class="badge" style="background-color:red;">3</span> Mr. Dela Cruz, John cancelled his order request. Mar. 6, 2017
                                      <br>
                                  </p>
                              </li>
                              <li class style="border-top:1px solid darkgray;">
                                  <p class="text-success">
                                      <span class="badge" style="background-color:forestgreen;">2</span> Ms. Garcia, Jocelyn ordered 3 Brown Couch. Feb. 25, 2017
                                      <br>
                                  </p>
                              </li>
                              <li class style="border-top:1px solid darkgray;">
                                  <p class="text-muted">
                                      <span class="badge" style="background-color:darkgray;">1</span> Mr. Cruz, Juan order is still pending. Feb. 23, 2017
                                      <br>
                                  </p>
                              </li>
                          </ul>

                        </div>
                      </div>
                    </div>
                    <!-- /.modal -->
                  </div>
                </div>  
            </div>
              </div>
              <div class="col-lg-3 col-sm-3 col-xs-12" style="margin-top: -20px;">

     <div class="panel panel-info">
            <div class="tab-content">
              <!-- FABRIC TYPE -->
              <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
            <h3 class="box-title">Todays Weather</h3>
                      <div id="flatWeather"></div>
                        </div>
                      </div>
                    </div>
                    <!-- /.modal -->
                  </div>
                </div>  

        <div class="row">
          <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top: -35px;">
     <div class="panel panel-info">
            <div class="tab-content">
              <!-- FABRIC TYPE -->
              <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                      <div class="analytics-info">
            <h3 class="box-title">Total Website Visit</h3>
            <ul class="list-inline two-part">
              <li>
                <div id="sparklinedash"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas></div>
              </li>
              <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">8659</span></li>
            </ul>
          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.modal -->
                  </div>
                </div>
        </div>
        </div>

        <div class="row">
          <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top: -35px;">
     <div class="panel panel-info">
            <div class="tab-content">
              <!-- FABRIC TYPE -->
              <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                      <div class="analytics-info">
            <h3 class="box-title">Unique Visitor</h3>
            <ul class="list-inline two-part">
              <li>
                <div id="sparklinedash4"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas></div>
              </li>
              <li class="text-right"><i class="ti-arrow-up text-danger"></i> <span class="counter text-danger">6011</span></li>
            </ul>
          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.modal -->
                  </div>
                </div>  
        </div>
        </div>

<div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top: -35px;">
     <div class="panel panel-info">
            <div class="tab-content">
              <!-- FABRIC TYPE -->
              <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
            <h3 class="box-title">Site Traffic</h3>
            <div class="stats-row">
              <div class="stat-item">
                <h6>Overall Growth</h6>
                <b>80.40%</b></div>
              <div class="stat-item">
                <h6>Montly</h6>
                <b>15.40%</b></div>
              <div class="stat-item">
                <h6>Day</h6>
                <b>5.50%</b></div>
            </div>
            <div id="sparkline9"><canvas width="628" height="50" style="display: inline-block; width: 628px; height: 50px; vertical-align: top;"></canvas></div>
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

        <script>  
          $(document).ready(function() {
            //ex.2 simple view, city name only, yahoo weather
            var example2 = $("#flatWeather").flatWeatherPlugin({
              location: "Manila",
              country: "Philippines",
              api: "yahoo",
              view : "simple"
            });
          });
        </script>
      </body>
      </html>