<?php include('connection.php');
include ("query.php");
error_reporting(); $userdetail=''; $adm='';
if(!$_SESSION['ntexpress_retroadm'] && !$_SESSION['ntexpress_retroagent'] && !$_SESSION['ntexpress_retroaccountant'] && !$_SESSION['ntexpress_retrosales'])
{
	//echo 'dsfdsfdsfsdf'.$_SERVER['HTTP_REFERER'];
	
	//header("location:".$site_url."index");
	header("location:".$site_url);
	exit;
}
else
{
	$adm=fetch_query("*", "`myadmin`", array("id="=>1)); 
	if($_SESSION['ntexpress_retroadm']!='')
	{
		$userdetail=fetch_query("*", "`myadmin`", array("username="=>$_SESSION['ntexpress_retroadm'])); 
	}
	else if($_SESSION['ntexpress_retroaccountant']!='')
	{
		$userdetail=fetch_query("*", "`agent`", array("id="=>$_SESSION['ntexpress_retroaccountant'],"deptid="=>3)); 
	}
	else
	{
		$userdetail=fetch_query("*", "department", array("id="=>$_SESSION['ntexpress_retroagent'])); 
	}
}
$main_roll_staff=array();
if(@$_SESSION['ntexpress_retroagent']!='')
{
	$main_roll_staff=fetch_query("*","staff_roles",array("sid="=>$_SESSION['ntexpress_retroagent']));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.png">
    <title><?php echo $adm['name']?></title>
    <link rel="stylesheet" href="<?php echo $site_url; ?>assets/vendor_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>assets/vendor_components/datatable/datatables.min.css" />
    <link rel="stylesheet" href="<?php echo $site_url; ?>css/bootstrap-extend.css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>assets/vendor_components/font-awesome/css/all.css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>assets/vendor_components/font-awesome/css/font-awesome-animation.css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>assets/vendor_components/Ionicons/css/ionicons.css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>assets/vendor_components/glyphicons/glyphicon.css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>assets/vendor_components/animate/animate.css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>css/master_style.css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>css/skins/_all-skins.css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>assets/vendor_components/morris.js/morris.css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>assets/vendor_components/weather-icons/weather-icons.css">
   
    
</head>

<body class="hold-transition skin-purple-light sidebar-mini">
    
<?php
$url=explode("/",$_SERVER['REQUEST_URI']);
$page2=$url[2];
//$page=explode(".php",$page1);
//$page2=$page[0];
?>

    <div class="wrapper">

        <?php ?><header class="main-header">

            <a href="<?php echo $site_url; ?>dashboard" class="logo">

                <b class="logo-mini"> <span class="light-logo"><img src="<?php echo $site_url; ?>images/logo-small.png" alt="logo"></span> </b>

                <span class="logo-lg"> <img src="<?php echo $site_url; ?>images/logo-black.png" alt="logo" class="light-logo"> </span>

            </a>

            <nav class="navbar navbar-static-top">

                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<i class="fa fa-bars" aria-hidden="true"></i>
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">

                        


                        <!-- User Account-->
                        <li class="dropdown user user-menu">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo $site_url; ?>images/user5-128x128.jpg" class="user-image rounded-circle" alt="User Image">
                            </a>

                            <ul class="dropdown-menu scale-up">

                                <li class="user-header">

                                    <img src="<?php echo $site_url; ?>images/user5-128x128.jpg" class="float-left rounded-circle" alt="User Image">

                                    <p>
                                        <?php echo $userdetail['name']; ?>
                                        <small class="mb-5"><?php echo $userdetail['email']; ?></small>
                                        <!--<a href="#" class="btn btn-danger btn-sm btn-rounded">View Profile</a>-->
                                    </p>

                                </li>

                                <li class="user-body">

                                    <div class="row no-gutters">
										
                                        <div class="col-12 text-left">
                                            <a <?php if(@$_SESSION['ntexpress_retroagent']!='') { ?> href="<?php echo $site_url ?>agent-edit-profile" <?php } else { ?> href="<?php echo $site_url ?>edit-profile" <?php }?>><i class="fa fa-user"></i> Edit Profile</a>
                                        </div>

                                        <div class="col-12 text-left">
                                            <a <?php if(@$_SESSION['ntexpress_retroagent']!='') { ?> href="<?php echo $site_url ?>agent-change-password" <?php } else { ?> href="<?php echo $site_url ?>change-password" <?php }?>><i class="fas fa-lock"></i> Change Password</a>
                                        </div>

                                        <div class="col-12 text-left">
                                            <a href="<?php echo $site_url ?>logout"><i class="fa fa-power-off"></i> Logout</a>
                                        </div>

                                    </div>

                                </li>

                            </ul>

                        </li>

                    </ul>

                </div>

            </nav>

        </header><?php ?>
