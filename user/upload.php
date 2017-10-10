<?php


$allowedExtensions = array("jpeg", "jpg", "bmp", "png");
$sizeLimit = 10 * 1024 * 1024;
$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
$result = $uploader->handleUpload('user/uploads/'); //folder for uploaded files
echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);


?>