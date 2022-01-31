<?php include("header.php"); ?>

<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

        <h1> Change Password </h1>

    </section>


    <section class="content">

        <div class="box">

            <div class="box-body">
            
            	<?php

					if(isset($_SESSION['suc']))

					{ echo session_succ(); }?>

					<div class="alert alert-success" id="error_message" style="display:none;"></div>

					<?php

					if(isset($_SESSION['unsuc']))

					{ echo session(); }?>

					<div class="alert alert-danger" id="error_message" style="display:none;"></div>

                <div class="row">
                
                    <div class="col-lg-12">

                        <!--<form novalidate>-->
                        <form method="post" action="" name="bg" id="bg" enctype="multipart/form-data">


                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">
                                        <h5>Old Password <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="oldpass" id="oldpass" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>New Password<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="newpass" id="newpass" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Re-type New Password<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="repass" id="repass" class="form-control">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="text-xs-right bt-1 pt-10">
                                <button type="submit" class="btn btn-danger" id="Edit" name="Edit">Save Changes</button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>


<?php include("footer.php"); ?>

<script>
$(document).ready(function()
{ 
	$("#Edit").click(function()
	{ 
		
		if($("#oldpass").val()=="")
		{
			$("#oldpass").attr("placeholder", "Please Enter Old Password.");
			$("#oldpass").addClass("error_textbox");
			$("#oldpass").focus();
			return false;
		}
		if($("#newpass").val()=="")
		{
			$("#newpass").attr("placeholder", "Please Enter New Password.");
			$("#newpass").addClass("error_textbox");
			$("#newpass").focus();
			return false;
		}
		
		if($("#repass").val()=="")
		{
			$("#repass").attr("placeholder", "Please Enter Confirm Password.");
			$("#repass").addClass("error_textbox");
			$("#repass").focus();
			return false;
		}
		if($("#newpass").val()!= $("#repass").val())
		{
			$("#repass").val('');
			$("#repass").attr("placeholder", "New Password and Confirm Password Not Match.");
			$("#repass").addClass("error_textbox");
			$("#repass").focus();
			return false;
		}
	});

});
</script>

<?php
	if(isset($_POST['newpass'])!='')
	{
		//echo "sad";
		//exit;
		$rows=fetch_query("password","myadmin",array("id="=>"1"));
		$pwd = $rows['password'];
		if($pwd!=$_POST['oldpass'])
		{
			$_SESSION['unsuc']='Invalid Old Password';
			header("location:".$site_url."change-password");
			exit;
		}
		else
		{
			$arr=array("password"=>$_POST['newpass']);
			$update = update_query($arr,"id=1","myadmin");
			if($update)
			{
				$_SESSION['suc']='Password successfully changed.';
			}
			else
			{
				$_SESSION['unsuc']='Password not updated successfully.';
			}
		}
		//header("location:".$site_url."change-password");
		//exit; 
		?>
		<script>window.location="<?php echo $site_url?>change-password";</script><?php
		exit;
	}

?>