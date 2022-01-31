<?php include("header.php"); 

if(@$_SESSION['ntexpress_retroagent']!='')
{
	$id = $_SESSION['ntexpress_retroagent'];
	$rows = fetch_query("*","department",array("id="=>$id));
	
	$fname = $rows['fname'];
	$lname = $rows['lname'];
	$mname = $rows['mname'];
//	$email = $rows['email'];
	$mno = $rows['mobile'];
	
	$address = $rows['address'];
	$pincode = $rows['zip'];
	//$country = $rows['country'];
	$state = $rows['provience'];
	$city = $rows['city'];
	
	$pagetitle='Edit';
}


?>

<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

        <h1> Representative <?php echo $pagetitle; ?> </h1>

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

                        <form method="post" action="" name="bg" id="bg" enctype="multipart/form-data">

                            <div class="row">

                                

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Name<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $fname; ?>" style="width:30%;display:inline-block" >
                                            &nbsp;
                                            <input type="text" name="mname" id="mname" class="form-control" value="<?php echo $mname; ?>" style="width:30%;display:inline-block" >
                                            &nbsp;
                                            <input type="text" name="lname" id="lname" class="form-control" value="<?php echo $lname; ?>" style="width:30%;display:inline-block">
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <?php /*?><div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Email<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="email" name="email" id="email" value="<?php echo $email; ?>" class="form-control" onchange="check_email_ifexist(this.value)">
                                        </div>
										<p id="userexist" style="color:#F00;"></p>
                                    </div>

                                </div>
							</div><?php */?>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Mobile Number<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="text" name="mno" id="mno" value="<?php echo $mno; ?>" class="form-control" onkeypress="return isNumberKey(event);">
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Address <span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <textarea name="address" rows="5" id="address" class="form-control"><?php echo stripslashes($address); ?></textarea>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row" style="display:none">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Country <span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <select name="country" id="country" class="form-control" onchange="get_state(this.value)">
                                                <option value="">Select Contry</option>
                                                <?php $country='184';
												$selcon=mysqli_query($dlink,"SELECT * FROM location where location_type='0' and location_id='184' and parent_id='0' and is_visible='0' order by name");
												while ($bcon=mysqli_fetch_array($selcon)) {
												?>
												<option <?php if ($bcon['location_id'] == $country) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option>
												<?php
												}
												?>
                                            </select>

                                        </div>

                                    </div>

                                </div>
							</div>
                             <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>State <span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <select name="state" id="state" class="form-control" onchange="get_city(this.value)">
                                                <option value="">Select State</option>
                                                <?php
												$selsta=mysqli_query($dlink,"SELECT * FROM location where location_type='1' and parent_id='".$country."' and is_visible='0' order by name");
												while($s=mysqli_fetch_array($selsta)) {
												?>
												<option <?php if ($s['location_id'] == $state) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option>
											   <?php
												}
												?>
                                            </select>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>City <span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <select name="city" id="city" class="form-control">
                                                <option value="">Select City</option>
                                                <?php
												$selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$state."' and is_visible='0' order by name");
												while($s1=mysqli_fetch_array($selcit)) {
												?>
												<option <?php if ($s1['location_id'] == $city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
												<?php
												}
												?>
                                            </select>

                                        </div>

                                    </div>

                                </div>

                                
                               

                                </div>

                            </div>
 							
                            <div class="text-xs-right bt-1 pt-10">
                               
                                <button type="submit" class="btn btn-danger" id="submit" name="submit">Submit</button>
                                
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
$(document).ready(function(){ 
	$("#submit").click(function()
	{ 
		
		if($("#fname").val()=="")
		{
			$("#fname").attr("placeholder", "Please Enter Name.");
			$("#fname").addClass("error_textbox");
			$("#fname").focus();
			return false;
		}
		
		if($("#mno").val()=="")
		{
			$("#mno").attr("placeholder", "Please Enter Mobile No.");
			$("#mno").addClass("error_textbox");
			$("#mno").focus();
			return false;
		}
		
		if($("#address").val()=="")
		{
			$("#address").attr("placeholder", "Please Enter Address.");
			$("#address").addClass("error_textbox");
			$("#address").focus();
			return false;
		}
		if($("#pincode").val()=="")
		{
			$("#pincode").attr("placeholder", "Please Enter Pincode.");
			$("#pincode").addClass("error_textbox");
			$("#pincode").focus();
			return false;
		}
		
		if($("#state").val()=="")
		{
			$("#state").attr("placeholder", "Please Select State");
			$("#state").addClass("error_textbox");
			$("#state").focus();
			return false;
		}
		if($("#city").val()=="")
		{
			$("#city").attr("placeholder", "Please Select City.");
			$("#city").addClass("error_textbox");
			$("#city").focus();
			return false;
		}
		
	});
});

function get_state(val)
{
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{country:val,action:'get_state'},
	 success: function(data)
	 {	
	 	if(data.trim()=='Not Found')
		{
			$("#state").html('<option value="">Select</option>');  
		}
		else if(data.trim()=='blank')
		{
			$("#state").html('<option value="">Select</option>');  
		}
		else
		{
			$("#state").html(data); 
		}
	  }
	});
}
function get_city(val)
{
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{state:val,action:'get_city'},
	 success: function(data)
	 {	
	 	if(data.trim()=='Not Found')
		{
			$("#city").html('<option value="">Select</option>');  
		}
		else if(data.trim()=='blank')
		{
			$("#city").html('<option value="">Select</option>');  
		}
		else
		{
			$("#city").html(data); 
		}
	  }
	});
}

function check_email_ifexist(val)
{
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{email:val,action:'check_email_exist'},
	 success: function(data)
	 {	
	 	if(data.trim()=='Not Found')
		{ }
		else if(data.trim()=='blank')
		{
			$("#userexist").html('Email Id Can Not Be Blank.'); 
		}
		else
		{
			$("#userexist").html(data); 
			$("#email").val(''); 
			
		}
	  }
	});
}

</script>
<?php 

if(isset($_POST['submit'])!='')
{
  
	  
	  $arr=array("fname"=>ucfirst($_POST['fname']),"lname"=>ucfirst($_POST['lname']),"mname"=>ucfirst($_POST['mname']),"mobile"=>$_POST['mno'],"address"=>addslashes($_POST['address']),"zip"=>$_POST['pincode'],"provience"=>$_POST['state'],"city"=>$_POST['city']);   
	  $insert = update_query($arr,"id=".$_SESSION['ntexpress_retroagent'],"department");
	  if($insert)
	  {
		  $_SESSION['suc']='Profile  Updated Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Profile Not Updated... Try Again...';
	  }
	  header("location:".$site_url."agent-edit-profile");
	  exit;
  
  
}
?>