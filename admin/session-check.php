<?php
$type = 0;
$type = $_SESSION['userType'];
if($type=="customer"){
	echo "<script>
			alert('Sorry you have no access here');
			</script>";
}
?>