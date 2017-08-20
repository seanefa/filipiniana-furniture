<?php
session_start();
if(!isset($_SESSION["userID"]))
{
  echo "<script>
      window.location.href='/user/userhome.php';
      alert('You have no access here');
      </script>";
}
?>