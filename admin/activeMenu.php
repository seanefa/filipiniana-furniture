<?php 
	if(basename($_SERVER['SCRIPT_NAME']) == 'notifications.php' || 'order-history.php' || 'fabric-texture.php'){
		echo 'active'; 
	}
	else{ 
		echo ''; 
	} 
?>