<?php include("header.php"); 

$setting=fetch_query("*","myadmin",array("id="=>"1"));	
?>

<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

        <h1> Edit Profile </h1>

    </section>

    <section class="content pb-10">

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
                                    	<input type="hidden" class="form-control" name="existing" id="existing" value="<?php echo $setting['logo'];?>">
                                        <h5>Logo<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="comp_logo" id="comp_logo" class="form-control" onblur="Checkfiles()">
                                            <div id="errmsg" style="color:#F00;"></div>
                                        </div>
                                    </div>
                                    <?php if($setting['logo']!=""){?>
                                    <div class="form-group">                            
                                        <label class="col-md-2 control-label"></label>
                                        <div class="col-sm-4">
                                            <img src="<?php echo $site_url; ?>upimages/<?php echo $setting['logo'];?>" width=100/>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="form-group">
                                        <h5>Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $setting['name'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Email <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $setting['email'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Mobile<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="mobile_1" id="mobile_1" onkeypress="return isNumberKey(event);" class="form-control" value="<?php echo $setting['mobile_1'];?>" minlength="10" maxlength="10">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Address <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="address" rows="5" id="address" class="form-control"><?php echo stripslashes(strip_tags($setting['address'])); ?></textarea>
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

<script language="javascript">
function Checkfiles()
{
	var formData = new FormData();
    var file = document.getElementById("comp_logo").files[0];
    formData.append("Filedata", file);
    var t = file.type.split('/').pop().toLowerCase();
    if (t != "jpeg" && t != "JPEG" && t != "jpg" && t != "JPG" && t != "png" && t != "gif" && t != "GIF") {
        alert('Upload Gif or Jpg or Png images only.');
        document.getElementById("comp_logo").value = '';
        return false;
    }
    /*if (file.size > 1024000) {
        alert('Max Upload size is 1MB only');
        document.getElementById("img").value = '';
        return false;
    }*/
    return true;

}

$(document).ready(function()
{ 
	$("#Edit").click(function()
	{ 
		if($("#comp_logo").val()=="" && $("#existing").val()=="")
		{
			$("#errmsg").text("Please Select Logo");
			$("#errmsg").addClass("error_textbox");
			$("#comp_logo").focus();
			return false;
		}
		if($("#comp_logo").val()!="")
		{
			var fup = document.getElementById('comp_logo');
			var fileName = fup.value;
			var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
			if(ext == "jpg" || ext == "png" || ext == "JPG" || ext == "PNG" || ext == "jpeg" || ext == "gif")
			{
				
			} 
			else
			{
				$("#errmsg").text("Please Select JPG or PNG File");
				$("#errmsg").addClass("error_textbox");
				return false;
			}
		}
		if($("#name").val()=="")
		{
			$("#name").attr("placeholder", "Please Enter Name.");
			$("#name").addClass("error_textbox");
			$("#name").focus();
			return false;
		}
		if($("#email").val()=="")
		{
			$("#email").attr("placeholder", "Please Enter Email.");
			$("#email").addClass("error_textbox");
			$("#email").focus();
			return false;
		}
		if($("#email").val()!="")
		{
			var ch= validateEmail($("#email").val());
			if(!ch)
			{
				$("#email").val('');
				$("#email").attr("placeholder", "Please Enter Valid Email.");
          		$("#email").addClass("error_textbox");
				$("#email").focus();
				return false;
			}
		}
		if($("#mobile_1").val()=="")
		{
			$("#mobile_1").attr("placeholder", "Please Enter Mobile no.");
			$("#mobile_1").addClass("error_textbox");
			$("#mobile_1").focus();
			return false;
		}
	});

});
		
</script>


<?php



if(isset($_POST['name'])!='')
{
	if(@$_FILES['comp_logo']['name']!="")
	{
		$row_select = fetch_query("logo","myadmin",array("id="=>"1"));
		$unlink_image = $row_select['logo'];
		@unlink("upimages/".$unlink_image);
	
		if (($_FILES["comp_logo"]["type"] == "image/gif") || ($_FILES["comp_logo"]["type"] == "image/jpeg") || ($_FILES["comp_logo"]["type"] == "image/jpg") || ($_FILES["comp_logo"]["type"] == "image/pjpeg") || ($_FILES["comp_logo"]["type"] == "image/x-png") || ($_FILES["comp_logo"]["type"] == "image/png"))
		{
			$uploadedfile = $_FILES["comp_logo"]["tmp_name"];
			$image11= rand().$_FILES['comp_logo']['name'];
			$image1 = str_replace(' ', '_', $image11);
			move_uploaded_file($uploadedfile, "upimages/".$image1);
		}
		$image=$image1;
	}
	
	else if(isset($_POST['existing']))
	{ 
		$image = $_POST['existing'];
	}
	
	
	$arr=array("name"=>addslashes($_POST['name']),"email"=>$_POST['email'],"address"=>addslashes(nl2br($_POST['address'])),"mobile_1"=>$_POST['mobile_1'],"logo"=>$image);
	$upd=update_query($arr, "id=1", "myadmin");
	if($upd)
		$_SESSION['suc']='Profile has been updated successfully';
	else
		$_SESSION['unsuc']='Profile has not been updated successfully';?>
	<script>window.location="<?php echo $site_url?>edit-profile";</script><?php
	exit;

}

?>