<?php include("header.php"); 

if(@$_REQUEST['id']!='')
{
	$id = $_REQUEST['id'];
	//$rows = fetch_query("*","agent",array("id="=>$id));
	$rows = fetch_query("*","dept_branch",array("id="=>$id));
	$dept_branch = $rows['dept_branch'];
	$new_dept = $rows['new_dept'];
	$dept_head = $rows['dept_head'];

	// $deptid = $rows['deptid'];
	// $name = $rows['name'];
	// $email = $rows['email'];
	// $mno = $rows['mno'];
	// $password = $rows['password'];
	// $address = $rows['address'];
	// $pincode = $rows['pincode'];
	// $country = $rows['country'];
	// $state = $rows['state'];
	// $city = $rows['city'];
	// $salary = $rows['salary'];
	$pagetitle='Edit';
	$agent_no=$rows['agent_no'];
}
else
{
	$dept_branch='';
	$new_dept='';
	$dept_head='';
	// $deptid = '';
	// $name = '';
	// $email = '';
	// $mno = '';
	// $password = '';
	// $address = '';
	// $pincode = '';
	// $country = '';
	// $state = '';
	// $city = '';
	// $salary = '';
	$pagetitle="Add";
	$agent_no="";
}

?>

<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

       <!-- <h1> Representative <?php echo $pagetitle; ?> </h1>-->

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
								<div class="col-md-12 pl-0">
                                <h3>Add Department</h3>
                                <hr />
                            </div>
							
						<div class="form-group">
                        	<div class="row">
                        		<div class="col-md-2">
                                    <h5 style="color: #D42B2B">Select Branch <span style="color: #D42B2B">*</span></h5>
								</div>
                                <div class="col-md-3 controls">
                                    <select name="dept_branch" id="dept_branch" class="form-control">
                                        <option value="">Select Branch</option>
                                            <?php
											$dept=mysqli_query($dlink,"SELECT * FROM branches WHERE 1");
											while($dp=mysqli_fetch_assoc($dept))
											{
											?>
											<option <?php if($dp['id']==$dept_branch){ ?> selected <?php } ?> value="<?php echo $dp['id']; ?>"><?php echo $dp['bname']; ?></option>
											<?php } ?>
                                    </select>
                                </div>
                            </div>
						</div>
						
						<div class="form-group">
							<div class="row">
                                <div class="col-md-2">
                                    <h5>New Department</h5>
								</div>
                                <div class="col-md-3 controls">
                                    <input type="text" name="new_dept" id="new_dept" value="<?php echo $new_dept; ?>" class="form-control">
								</div>
									<p id="userexist" style="color:#F00;"></p>
                            </div>
                        </div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-2">
                                    <h5>Department Head</h5>
								</div>
                                <div class="col-md-3 controls">
                                    <input type="text" name="dept_head" id="dept_head" value="<?php echo $dept_head; ?>" class="form-control">
                                </div>
										<p id="userexist" style="color:#F00;"></p>
                            </div>
                        </div>

                    
					
						<div class="text-xs-right pt-10">
                            <button type="submit" class="btn btn-danger" id="submit" name="submit" style="width: 147px;">Save</button>   
                        </div>
					</div>
                            <!-- <div class="row">

                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Department <span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <select name="deptid" id="deptid" class="form-control">
                                                <option value="">Select Department</option>
                                                <?php
												$dept=mysqli_query($dlink,"SELECT id,title FROM department WHERE 1");
												while($dp=mysqli_fetch_assoc($dept))
												{
												?>
												<option <?php if($dp['id']==$deptid){ ?> selected <?php } ?> value="<?php echo $dp['id']; ?>"><?php echo $dp['title']; ?></option>
												<?php } ?>
                                            </select>

                                        </div>

                                    </div>

                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Representative No. <span class="text-danger">*</span></h5>

                                        <div class="controls"> 
                                            
											<input type="text" name="agent_no" id="agent_no" class="form-control" value="<?php echo $agent_no; ?>">
                                        </div>

                                    </div>

                                </div>
                               

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Name<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>">
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Email<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="email" name="email" id="email" value="<?php echo $email; ?>" class="form-control" onchange="check_email_ifexist(this.value)">
                                        </div>
										<p id="userexist" style="color:#F00;"></p>
                                    </div>

                                </div>

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

                                        <h5>Password<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="text" name="password" id="password" value="<?php echo $password; ?>" class="form-control">
                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <h5>Zipcode<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="text" name="pincode" id="pincode" value="<?php echo $pincode; ?>" class="form-control">
                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Address <span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <textarea name="address" rows="5" id="address" class="form-control"><?php echo stripslashes($address); ?></textarea>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

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

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Salary<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="text" name="salary" id="salary" value="<?php echo $salary; ?>" class="form-control" onkeypress="return isNumberKey(event);">
                                        </div>

                                    </div>

                                </div>
                               

                                </div>

                            </div>
 							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="form-group">
                                <h5>Is Head?<span class="text-danger">*</span></h5>
                                   <div class="demo-radio-button">
                                   <input type="checkbox" name="is_head" value="1" id="md_checkbox_37" class="filled-in chk-col-maroon">
                                   <label for="md_checkbox_37">Yes</label>
                                    
                                 </div>  
                                </div>

                            </div> -->
                            

                        </form>

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
		if($("#dept_branch").val()=="")
		{
			$("#dept_branch").attr("placeholder", "Please Select Department Branch.");
			$("#dept_branch").addClass("error_textbox");
			$("#dept_branch").focus();
			return false;
		} 
		/*if($("#deptid").val()=="")
		{
			$("#deptid").attr("placeholder", "Please Select Department.");
			$("#deptid").addClass("error_textbox");
			$("#deptid").focus();
			return false;
		} 
		if($("#agent_no").val()=="")
		{
			$("#agent_no").attr("placeholder", "Please Enter Representative Number.");
			$("#agent_no").addClass("error_textbox");
			$("#agent_no").focus();
			return false;
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
		if($("#mno").val()=="")
		{
			$("#mno").attr("placeholder", "Please Enter Mobile No.");
			$("#mno").addClass("error_textbox");
			$("#mno").focus();
			return false;
		}
		if($("#password").val()=="")
		{
			$("#password").attr("placeholder", "Please Enter Password.");
			$("#password").addClass("error_textbox");
			$("#password").focus();
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
		if($("#country").val()=="")
		{
			$("#country").attr("placeholder", "Please Select Country.");
			$("#country").addClass("error_textbox");
			$("#country").focus();
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
		if($("#salary").val()=="")
		{
			$("#salary").attr("placeholder", "Please Enter Salary.");
			$("#salary").addClass("error_textbox");
			$("#salary").focus();
			return false;
		}*/
	});
});

// function get_state(val)
// {
// 	$.ajax({
// 	 type: "POST",
// 	 url: "<?php echo $site_url; ?>admin_ajax.php",
// 	 data:{country:val,action:'get_state'},
// 	 success: function(data)
// 	 {	
// 	 	if(data.trim()=='Not Found')
// 		{
// 			$("#state").html('<option value="">Select</option>');  
// 		}
// 		else if(data.trim()=='blank')
// 		{
// 			$("#state").html('<option value="">Select</option>');  
// 		}
// 		else
// 		{
// 			$("#state").html(data); 
// 		}
// 	  }
// 	});
// }
// function get_city(val)
// {
// 	$.ajax({
// 	 type: "POST",
// 	 url: "<?php echo $site_url; ?>admin_ajax.php",
// 	 data:{state:val,action:'get_city'},
// 	 success: function(data)
// 	 {	
// 	 	if(data.trim()=='Not Found')
// 		{
// 			$("#city").html('<option value="">Select</option>');  
// 		}
// 		else if(data.trim()=='blank')
// 		{
// 			$("#city").html('<option value="">Select</option>');  
// 		}
// 		else
// 		{
// 			$("#city").html(data); 
// 		}
// 	  }
// 	});
// }

// function check_email_ifexist(val)
// {
// 	$.ajax({
// 	 type: "POST",
// 	 url: "<?php echo $site_url; ?>admin_ajax.php",
// 	 data:{email:val,action:'check_email_exist'},
// 	 success: function(data)
// 	 {	
// 	 	if(data.trim()=='Not Found')
// 		{ }
// 		else if(data.trim()=='blank')
// 		{
// 			$("#userexist").html('Email Id Can Not Be Blank.'); 
// 		}
// 		else
// 		{
// 			$("#userexist").html(data); 
// 			$("#email").val(''); 
			
// 		}
// 	  }
// 	});
// }

</script>
<?php 

if(isset($_POST['submit'])!='')
{
  if(@$_GET['id']!='')
  {
	  
	  // $arr=array("agent_no"=>$_POST['agent_no'],"deptid"=>$_POST['deptid'],"name"=>ucfirst($_POST['name']),"email"=>$_POST['email'],"mno"=>$_POST['mno'],"password"=>$_POST['password'],"address"=>addslashes($_POST['address']),"pincode"=>$_POST['pincode'],"country"=>$_POST['country'],"state"=>$_POST['state'],"city"=>$_POST['city'],"salary"=>$_POST['salary'],"is_head"=>$_POST['is_head']);  
	   $arr=array("dept_branch"=>$_POST['dept_branch'],"new_dept"=>$_POST['new_dept'],"dept_head"=>$_POST['dept_head']); 
	  //$insert = update_query($arr,"id=".$id,"agent");
	   $insert = update_query($arr,"id=".$id,"dept_branch");
	   
	  if($insert)
	  {
		  $_SESSION['suc']='Department Detail Updated Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Department Detail Not Updated... Try Again...';
	  }
	  header("location:".$site_url."department-listing");
	  exit;
  }
  else
  { 
  	
	  $dt=date('Y-m-d H:i:s');
	  /*$arr=array("agent_no"=>$_POST['agent_no'],"deptid"=>$_POST['deptid'],"name"=>ucfirst($_POST['name']),"email"=>$_POST['email'],"mno"=>$_POST['mno'],"password"=>$_POST['password'],"address"=>addslashes($_POST['address']),"pincode"=>$_POST['pincode'],"country"=>$_POST['country'],"state"=>$_POST['state'],"city"=>$_POST['city'],"salary"=>$_POST['salary'],"recorddate"=>$dt,"is_head"=>$_POST['is_head']); 
	  $insert = insert_query($arr, "agent");
	  if($insert)
	  {
		  $_SESSION['suc']='Representative Detail Added Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Representative Detail Not Added... Try Again...';
	  }
	  header("location:".$site_url."agent-listing");
	  exit;*/

	  $arr=array("dept_branch"=>$_POST['dept_branch'],"new_dept"=>$_POST['new_dept'],"dept_head"=>$_POST['dept_head'],"recorddate"=>$dt); 
	  $insert = insert_query($arr, "dept_branch");
	  if($insert)
	  {
		  $_SESSION['suc']='Department Detail Added Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Department Detail Not Added... Try Again...';
	  }
	  header("location:".$site_url."department-listing");
	  exit;
  }
}
?>