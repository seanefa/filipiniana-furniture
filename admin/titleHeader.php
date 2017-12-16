<?php
	$activePage = basename($_SERVER['PHP_SELF'],".php");
	$removeSymbols = str_replace(array("?",  "-"), " ", $activePage);
	$titlePage = ucwords($removeSymbols);
?>

<!DOCTYPE html>
<html>
	<head>
 		 <title><?php echo $titlePage?></title>
  		 <link rel="icon" type="image/x-icon" sizes="16x16" href="plugins/logo/favicon.ico">
	</head>
</html>