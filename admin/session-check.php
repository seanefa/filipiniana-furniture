<?php
session_start();
if(empty($_SESSION["userID"]) || $_SESSION['userType']!='admin')
{
	echo "<script>
	window.location.href='/user/userhome.php';
	alert('You have no access here');
	</script>";
}
// else if($_SESSION['userType']!='admin'){
// 	echo "<script>
// 	window.location.href='/user/userhome.php';
// 	alert('You have no access here');
// 	</script>";

// }
?>