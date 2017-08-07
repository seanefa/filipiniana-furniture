<?php
include "dbconnect.php";

if ($_FILES["image"]["error"] > 0)
{
 echo "<font size = '5'><font color=\"#e31919\">Error: NO CHOSEN FILE <br />";
 echo"<p><font size = '5'><font color=\"#e31919\">INSERT TO DATABASE FAILED";
}
else
{
 move_uploaded_file($_FILES["image"]["tmp_name"],"images/" . $_FILES["image"]["name"]);
 echo "<font size = '5'><font color=\"#0CF44A\">SAVED<br>" ;

 $file = "images/" . $_FILES["image"]["name"];
 $sql = "UPDATE tblproduct SET prodMainPic = '$file' WHERE productID = 1";

 if (!mysqli_query($conn,$sql))
 {
  die('Error: ' . mysqli_error($conn));
}
echo "<font size = '5'><font color=\"#0CF44A\">SAVED TO DATABASE";

}

mysqli_close($conn);

?>