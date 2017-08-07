<?php
  include "ui-dbconnect.php";

  $un = $_POST['uname'];
  $pw = $_POST['pword'];
  
  $flag = 0;

  $sql = "SELECT * FROM tbluser WHERE userName='$un' AND userPassword = '$pw' AND userStatus='Active'";
  $result = mysqli_query($conn,$sql);
  
  while($row = mysqli_fetch_assoc($result))
  {
    $id=$row['userType'];
    
    if($un==$row['userName'])
    {
      if($pw==$row['userPassword'])
      {
        $flag = 1;
      }
    }
    else
    {
      $flag = 0;
    }
  }

  if($flag==1)
  {
    switch($id)
    {
      case "Admin"||"admin":
        header("Location: localhost:8000");
        break;
      case "Customer"||"customer":
        header("Location: ui-home-access.php");
        break;
      default:
        echo("Error");
    }
  }
  else
  {
    echo ("<script>Unable to comply, error detected</script>");
  }
?>