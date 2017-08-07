  <?php

  $branch = $_POST['branch'];
  $location = $_POST['location'];
  $type = $_POST['type'];
  $rate = $_POST['rate'];
  $status = "Listed";


  include 'dbconnect.php';

  $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "INSERT INTO `tbldelivery_rates` (`delBranchID`, `delLocation`, `delRateType`, `delRate`, `delRateStatus`) VALUES('$branch','$location','$type','$rate','$status')";
  if($sql){
    if (mysqli_query($conn, $sql)) {
      header( "Location: delivery-rates.php?newSuccess" );
    } 
    else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


    mysqli_close($conn);
  }
  ?>