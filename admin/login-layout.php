<?php
  $bg = array('bg-01.jpg', 'bg-03.jpg', 'bg-04.jpg', 'bg-05.jpg', 'bg-06.jpg', 'bg-07.jpg', 'bg-08.jpg', 'bg-09.jpg', 'bg-10.jpg'); // array of filenames

  $i = rand(0, count($bg)-1); // generate random number size of the array
  $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Filipiniana Furniture</title>
    <link rel="icon" type="image/x-icon" sizes="16x16" href="../admin/images/favicon.ico">

    <!-- Styles -->
    <link href="css/login.css" rel="stylesheet">
</head>
<body style="background: url(../admin/plugins/login-bg/<?php echo $selectedBg; ?>); background-repeat: no-repeat;background-size: 100% 100vh; position: relative; background-attachment:fixed; ">
    <div id="app" >
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                        <img src="../admin/plugins/images/filipiniana-furniture-logo.png">
                    <img src="../admin/plugins/images/filipiniana-furniture-v2-text-dark.png">
                </div>
				
				 <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                            <!--li><a href="login.php"><h4>Login</h4></a></li>
                            <li><a href="register.php"><h4>Register</h4></a></li-->        
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</body>
</html>
