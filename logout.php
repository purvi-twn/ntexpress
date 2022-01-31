<?php 

session_start();

if(@$_SESSION['ntexpress_retroadm']!='')
{
	session_unset($_SESSION['ntexpress_retroadm']);
	session_destroy();
	header("location:".$site_url."index");
	exit;
}
else if(@$_SESSION['ntexpress_retroagent']!='')
{
	session_unset($_SESSION['ntexpress_retroagent']);
	//session_destroy();
	session_unset($_SESSION['ntexpress_retrostaff']);
	session_unset($_SESSION['ntexpress_retrodept_branch']);
	session_unset($_SESSION['ntexpress_retrobranch']);
	session_destroy();
	header("location:".$site_url."staff-login");
	exit;
}
else if(@$_SESSION['ntexpress_retroaccountant']!='')
{  
	session_unset($_SESSION['ntexpress_retroaccountant']);
	session_destroy();
	header("location:".$site_url."accountant-login");
	exit;
}

?>