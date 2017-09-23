  <?php
  include "session-check.php";
  include 'dbconnect.php';

  $location = $_POST['location'];
  $address = $_POST['address'];
  $remarks = $_POST['remarks'];
  $status = "Listed";

  $remarks = mysqli_real_escape_string($conn,$remarks);

  $sql = "INSERT INTO `tblbranches` (`branchLocation`, `branchAddress`, `branchRemarks`, `branchStatus`) VALUES ('$location', '$address', '$remarks', '$status')";
  if($sql){
    if (mysqli_query($conn, $sql)) {
      header( "Location: branches.php?newSuccess" );
    } 
    else {
      header( "Location: branches.php?actionFailed" );
    }


    mysqli_close($conn);
  }
  ?>