  <?php

  $location = $_POST['location'];
  $address = $_POST['address'];
  $remarks = $_POST['remarks'];
  $status = "Listed";


  include 'dbconnect.php';

  $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "INSERT INTO `tblbranches` (`branchLocation`, `branchAddress`, `branchRemarks`, `branchStatus`) VALUES ('$location', '$address', '$remarks', '$status')";
  if($sql){
    if (mysqli_query($conn, $sql)) {

      echo '<script type="text/javascript">';
      echo 'alert("RECORD SUCCESFULLY SAVED!")';
      header( "Location: branches.php" );
      echo '</script>';

    } 
    else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


    mysqli_close($conn);
  }
  ?>