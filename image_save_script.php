<?php   
define('UPLOAD_DIR', '_private_content_shipment_barcode/');   
$img = $_POST['imgBase64'];   
$img = str_replace('data:image/png;base64,', '', $img);   
$img = str_replace(' ', '+', $img);   
$data = base64_decode($img);   
$fname=uniqid() . '.png';
$file = UPLOAD_DIR .$fname ;   
$success = file_put_contents($file, $data); 
print $success ? $file : 'Unable to save the file.';   
?>