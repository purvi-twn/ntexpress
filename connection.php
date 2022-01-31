<?php ob_start(); session_start();
$server="localhost";
$user="ntexpressUser";
$pwd="6lPPgQDWhNUE";
$db="ntexpressDB";

date_default_timezone_set("Asia/Kolkata");

$site_url='https://ntexpress.sa/billing/';
$front_url='https://ntexpress.sa/billing/';

$dlink=new mysqli($server,$user,$pwd,$db);
if($dlink->connect_errno > 0)
{
	echo $dlink->connect_errno;
	//die('Could not connect: ' . mysql_error());
}
@$dlink->set_charset("utf8");?>