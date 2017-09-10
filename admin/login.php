<?php 
include 'login-layout.php'
?>
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4 style="text-align: center;">Login</h4></div>
                <div class="panel-body">
                     <form class="form-horizontal form-material" id="loginform" action="loginVerify.php" method="POST">
                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="" required autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--section id="wrapper" class="login-register">
      <div class="login-box">
        <div class="white-box">
          <form class="form-horizontal form-material" id="loginform" action="loginVerify.php" method="POST" style="border:solid 3px steelblue; padding: 5%; border-radius: 25px;">
            <h3 class="box-title m-b-20">Sign In</h3>
            <div class="form-group ">
              <div class="col-xs-12">
                <input class="form-control" type="text" name="username" required="" placeholder="Username">
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                <input class="form-control" type="password" name="password" required="" placeholder="Password">
              </div>
            </div>
            <div class="form-group">
            </div>
            <div class="form-group text-center m-t-20">
              <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
              </div>
            </div>
          </form>
          <form class="form-horizontal" id="recoverform" action="index.html">
            <div class="form-group ">
              <div class="col-xs-12">
                <h3>Recover Password</h3>
                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
              </div>
            </div>
            <div class="form-group ">
              <div class="col-xs-12">
                <input class="form-control" type="text" required="" placeholder="Email">
              </div>
            </div>
            <div class="form-group text-center m-t-20">
              <div class="col-xs-12">
                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section-->
  </body>
  </html>