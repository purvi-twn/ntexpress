<?php
include 'phpqrcode/qrlib.php';
$text = "INVOICE NO: 00012\nCOMPANY NAME: INDIVIDUAL-1\nGRAND TOTAL: 322";
  
// $path variable store the location where to 
// store image and $file creates directory name
// of the QR code file by using 'uniqid'
// uniqid creates unique id based on microtime
$path = 'qrcode/';
$filename=uniqid().".png"; //store this name in db
$file = $path.$filename;
  
// $ecc stores error correction capability('L')
$ecc = 'L';
$pixel_Size = 10;
$frame_Size = 10;
  
// Generates QR Code and Stores it in directory given
QRcode::png($text, $file, $ecc, $pixel_Size, $frame_size);
  
// Displaying the stored QR code on browser from directory
echo "<center><img src='".$file."'></center>";
//file_put_contents("qrcode.png", QRcode::png($text));
?>