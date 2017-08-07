<?php
session_start();
include "dbconnect--.php";
$un = $_POST['username'];
$pw = $_POST['password'];
$flag = 0;
$sql = "SELECT * FROM tbluser WHERE userName='$un' AND userPassword = '$pw' AND userStatus='active'";
$result=$conn->query($sql);
  while($row=$result->fetch_assoc())
  {
  	$id=$row['userType'];
  	if($un==$row['userName'])
  	{
  		if($pw==$row['userPassword'])
  		{
  			$flag = 1;
  			$_SESSION['userID'] = $row["userID"];
  		}
  		else
  		{
  			$flag = 0;
  		}
  	}
  }
  if($flag==1)
  {
    switch($id)
    {
      case "admin":
        header("Location: startup.php");
        break;
      case "customer":
        header("Location: access.php");
        break;
      default:
        echo("error.html");
    }
  }
  else
  {
?>
    <script type="text/javascript">
      alert("Error, unidentified user.");
    </script>
<?php
  }
  $conn->close();
?>