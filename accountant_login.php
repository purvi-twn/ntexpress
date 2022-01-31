<?php include('connection.php');
include ("query.php"); 
$adm=fetch_query("*", "`myadmin`", array("id="=>1));
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
	<link rel="stylesheet" href="<?php echo $site_url ?>assets/vendor_components/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo $site_url ?>css/bootstrap-extend.css">
	<link rel="stylesheet" href="<?php echo $site_url ?>assets/vendor_components/font-awesome/css/all.css">
	<link rel="stylesheet" href="<?php echo $site_url ?>assets/vendor_components/font-awesome/css/font-awesome-animation.css">
	<link rel="stylesheet" href="<?php echo $site_url ?>assets/vendor_components/Ionicons/css/ionicons.css">
	<link rel="stylesheet" href="<?php echo $site_url ?>assets/vendor_components/glyphicons/glyphicon.css">
	<link rel="stylesheet" href="<?php echo $site_url ?>assets/vendor_components/animate/animate.css">
	<link rel="stylesheet" href="<?php echo $site_url ?>css/master_style.css">
	<link rel="stylesheet" href="<?php echo $site_url ?>assets/vendor_components/morris.js/morris.css">
	<link rel="stylesheet" href="<?php echo $site_url ?>assets/vendor_components/weather-icons/weather-icons.css">
</head>
<body class="hold-transition bg-img" style="background-image: url(images/login-bg.jpg)" data-overlay="4" cz-shortcut-listen="true">
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-lg-5 col-md-8 col-12">
                <div class="content-top-agile">
                    <?php $img='';
					if($adm['logo']!='')
					{
						$img='upimages/'.$adm['logo'];
					}
					else
					{
						$img='images/logo.png';
					}?>
                    <a href="#"> <img src="<?php echo $img?>" alt="<?php echo $adm['name']?>"> </a>
                </div>
                <div class="bg-white content-bottom">
                    <form action="" method="post" id="login_form_admin" name="login_form_admin" >
                        <h3> LOGIN </h3>
                        <?php
										if(isset($_SESSION['suc']))

										{ echo session_succ(); }?>

										<div class="alert alert-success" id="error_message" style="display:none;"></div>

										<?php

										if(isset($_SESSION['unsuc']))

										{ echo session(); }?>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger border-danger"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" autocomplete="off" placeholder="Username" name="username" id="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger border-danger"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" autocomplete="off" placeholder="Password" name="password" id="password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="checkbox">
                                    <input type="checkbox" id="basic_checkbox_1">
                                    <label for="basic_checkbox_1">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit"  id="login_btn" class="btn btn-danger btn-block margin-top-10">LOGIN</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo $site_url ?>assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>
    <script src="<?php echo $site_url ?>js/jquery.min.js"></script>
    <script src="<?php echo $site_url ?>assets/vendor_components/popper/dist/popper.min.js"></script>
    <script src="<?php echo $site_url ?>assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script language="javascript">
		$(document).ready(function(){
			$("#login_btn").click(function()
			{
				$("#username").removeClass("error_textbox");
				$("#password").removeClass("error_textbox");
				if($("#username").val()=="")
				{
					$("#username").attr("placeholder", "Please Enter Your Username");
					$("#username").addClass("error_textbox");
					$("#username").focus();
					return false;
				}
				if($("#password").val()=="")
				{
					$("#password").attr("placeholder", "Please Enter Your Password");
					$("#password").addClass("error_textbox");
					$("#password").focus();
					return false;
				}
			});
		});
	</script>
<?php 
if(isset($_POST['username'])!='')
{
	$sel=$dlink->query("select email,id from agent where email='".$_POST['username']."' and password='".$_POST['password']."' and deptid=3");
	if($sel->num_rows>=1)
	{
		$res=$sel->fetch_array();
		$_SESSION['ntexpress_retroaccountant']=$res['id'];
		?>
        <script>window.location="<?php echo $site_url?>dashboard";</script><?php
		exit;
	}
	else
	{
		$_SESSION['unsuc']="Username or Password is wrong...Try Again";?>
		<script>window.location="<?php echo $site_url?>accountant-login";</script><?php
		exit;
	}
}

?>
</body>
</html>