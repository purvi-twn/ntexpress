<?php include("header.php"); 

if(@$_REQUEST['id']!='')
{
	$id = $_REQUEST['id'];
	$rows = fetch_query("*","department",array("id="=>$id));
	$fname = $rows['fname'];
	$mname = $rows['mname'];
	$lname = $rows['lname'];
	$staff_id = $rows['staff_id'];
	$passport = $rows['passport'];
	$address = $rows['address'];
	$city = $rows['city'];
	$provience = $rows['provience'];
	$zip = $rows['zip'];
	$mobile = $rows['mobile'];
	$t_address = $rows['t_address'];
	$t_city = $rows['t_city'];
	$t_provience = $rows['t_provience'];
	$t_zip = $rows['t_zip'];
	$t_mobile = $rows['t_mobile'];
	$dept_branch = $rows['dept_branch'];
	$branch = $rows['branch'];
	$j_date = $rows['j_date'];
	$emp = $rows['emp'];
	$nationality = $rows['nationality'];
	$age = $rows['age'];
	$gender = $rows['gender'];
	$salary = $rows['salary'];
	$username = $rows['username'];
	$password = $rows['password'];
	$upload = $rows['upload'];
	$role = $rows['role'];

	$pagepagetitle='Edit';
}
else
{
	$upload="";
	$fname = "";
	$mname = "";
	$lname = "";
	$staff_id = "";
	$salary = "";
	$gender = "";
	$age = "";
	$nationality = "";
	$emp = "";
	$j_date = "";
	$branch = "";
	$dept_branch = "";
	$t_mobile = "";
	$t_zip = "";
	$t_provience = "";
	$t_city = "";
	$t_address = "";
	$mobile = "";
	$zip = "";
	$provience = "";
	$city = "";
	$address = "";
	$passport = "";
	$role = "";
	$pagetitle="Add";
}

?>

<?php include("leftpanel.php"); ?>


<style type="text/css">
	.form-group .box-1{
		border: 4px solid black;
		width: 129px;
		height: 113px;
		border-radius: 10px;
	}
	.form-group .box-1 img{
		width: 119px;
		height: 103px;
		margin-left: 1px;
		margin-top: 1px;
		border-radius: 10px;
		margin-bottom: 8px;
	}
	.rdlb-1 a{
        color: #D42B2B;
		margin-left: 17px;
	}
	#upload_link{
		text-decoration:underline;
	}
	#upload{
		display:none
	}
	.gry-box {
	    background-color: #EFEFEF;
	    padding: 20px;
	    border-radius: 10px;
	}
	
	@media screen and (max-width: 400px){
		.sp-1{
			margin-bottom: 15px;
		}
		.gry-box {
		  margin-top: 15px;
		}
	}
	
	@media screen and (min-width: 401px) and (max-width: 767px){
		.sp-1{
			margin-bottom: 15px;
		}
		.gry-box {
		  margin-top: 15px;
		}
	}
	
	@media screen and (min-width: 768px) and (max-width: 992px){
		.gry-box {
		  margin-top: 15px;
		}
		.sp-2{
			margin-right: 30px;
		}
	}
	
	@media screen and (min-width: 1000px) and (max-width: 1100px){
		
		.gry-box {
		  margin-top: 15px;
		}
	}
</style>


<div class="content-wrapper">

    <section class="content-header">

        <!--<h1> Department <?php echo $pagetitle; ?>  </h1>-->

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
                        <form method="post" action="" name="bg" id="bg" enctype="multipart/form-data" autocomplete="off">
							<div class="col-sm-12 col-md-12 col-lg-12 pl-0">
                                <h3>Add Staff </h3>
                                <hr />
                            </div>
							
						<div class="col-sm-12 col-md-12 col-lg-12">
							<div class="row mt-10">		
								<div class="col-sm-12 col-md-9 col-lg-9 pl-0">
									<div class="form-group">
										<div class="row">
											<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
												<h5 style="color: #D42B2B">Name </h5>
											</div>

											<div class="col-sm-12 col-md-3 col-lg-3 controls sp-1">
												<input type="text" name="fname" id="fname" placeholder="First Name" class="form-control" value="<?php echo $fname; ?>">
											</div>

											<div class="col-sm-12 col-md-3 col-lg-3 controls sp-1">
												<input type="text" name="mname" id="mname" placeholder="Middel Name" class="form-control" value="<?php echo $mname; ?>">
											</div>

											<div class="col-sm-12 col-md-3 col-lg-3 controls sp-1">
												<input type="text" name="lname" id="lname" placeholder="Last Name" class="form-control" value="<?php echo $lname; ?>">
											</div>
										</div>
											
									</div>
											<div class="form-group">
												<div class="row">
												<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
													<h5 style="color: #D42B2B">ID </h5>
												</div>
													<div class="col-sm-12 col-md-4 col-lg-4 controls">
														<input type="text" name="staff_id" id="staff_id" placeholder="ID" class="form-control" value="<?php echo $staff_id; ?>">
													</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
														<h5 style="color: #D42B2B">Passport No </h5>
														
													</div>
													<div class="col-sm-12 col-md-4 col-lg-4 controls">
														<input type="text" name="passport" id="passport" placeholder="ID" class="form-control" value="<?php echo $passport; ?>">
													</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
														<h5 style="color: #D42B2B">Address </h5>
														
													</div>
													<div class="col-sm-12 col-md-5 col-lg-5 controls">
														<textarea name="address" rows="4" id="address" placeholder="Street1" class="form-control"><?php echo stripslashes($address); ?></textarea>
													</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
															
													</div>

													<div class="col-sm-12 col-md-2 col-lg-2 controls sp-1">
														
														<select name="provience" id="provience" class="form-control" onchange="get_rcvr_city1(this.value)">
													        <option value="">Select State</option>
													        <?php
													        $selsta=mysqli_query($dlink,"SELECT * FROM location where location_type='1' and is_visible='0' order by name");
													        while($s=mysqli_fetch_array($selsta)) {
													        ?>
													        <option <?php if ($s['location_id'] == $provience) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option>
													       <?php
													        }
													        ?>
													    </select>
													</div>

													<div class="col-sm-12 col-md-2 col-lg-2 controls sp-1">
														

														<select name="city" id="city" class="form-control">
													        <option value="">Select City</option>
													        <?php
													        $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$t_provience."' and is_visible='0' order by name");
													        while($s1=mysqli_fetch_array($selcit)) {
													        ?>
													        <option <?php if ($s1['location_id'] == $city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
													        <?php
													        }
													        ?>
														</select>
													</div>
													

													<div class="col-sm-12 col-md-2 col-lg-2 controls sp-1">
														<input type="text" name="zip" id="zip" value="<?php echo $zip; ?>" class="form-control" placeholder="Zip/Postal">
													</div>

													<div class="col-sm-12 col-md-2 col-lg-2 controls sp-1">
														<input type="text" name="mobile" id="mobile" value="<?php echo $mobile; ?>" class="form-control" placeholder="Mobile"  maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
													</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
														<h5 style="color: #D42B2B">Temporary Address </h5>
													   
													</div>
													<div class="col-sm-12 col-md-5 col-lg-5 controls">
														<textarea name="t_address" rows="4" id="t_address" placeholder="Street1" class="form-control"><?php echo stripslashes($t_address); ?></textarea>
													</div>

												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
															
													</div>

													<div class="col-sm-12 col-md-2 col-lg-2 controls sp-1">
														
														<select name="t_provience" id="t_provience" class="form-control" onchange="get_rcvr_city(this.value)">
													        <option value="">Select State</option>
													        <?php
													        $selsta=mysqli_query($dlink,"SELECT * FROM location where location_type='1' and is_visible='0' order by name");
													        while($s=mysqli_fetch_array($selsta)) {
													        ?>
													        <option <?php if ($s['location_id'] == $t_provience) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option>
													       <?php
													        }
													        ?>
													    </select>
													</div>

													<div class="col-sm-12 col-md-2 col-lg-2 controls sp-1">
														

														<select name="t_city" id="t_city" class="form-control">
													        <option value="">Select City</option>
													        <?php
													        $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$t_provience."' and is_visible='0' order by name");
													        while($s1=mysqli_fetch_array($selcit)) {
													        ?>
													        <option <?php if ($s1['location_id'] == $t_city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
													        <?php
													        }
													        ?>
														</select>
													</div>

													<div class="col-sm-12 col-md-2 col-lg-2 controls sp-1">
														<input type="text" name="t_zip" id="t_zip" value="<?php echo $t_zip; ?>" class="form-control" placeholder="Zip/Postal">
													</div>

													<div class="col-sm-12 col-md-2 col-lg-2 controls sp-1">
														<input type="text" name="t_mobile" id="t_mobile" value="<?php echo $t_mobile; ?>" class="form-control" placeholder="Mobile"  maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
													</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
														<h5 style="color: #D42B2B">Select Department </h5>
														
													</div>
														<div class="col-sm-12 col-md-4 col-lg-4 controls">
															<select name="dept_branch" id="dept_branch" class="form-control">
																<option value="">Select Department</option>
																<?php
																$dept=mysqli_query($dlink,"SELECT * FROM dept_branch");
																while($dp=mysqli_fetch_assoc($dept))
																{
																?>
																<option <?php if($dp['id']==$dept_branch){ ?> selected <?php } ?> value="<?php echo $dp['id']; ?>"><?php echo $dp['new_dept']; ?></option>
																<?php } ?>
															</select>
														</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
														<h5 style="color: #D42B2B">Select Branch </h5>
														
													</div>
														<div class="col-sm-12 col-md-4 col-lg-4 controls">
															<select name="branch" id="branch" class="form-control">
																<option value="">Select Branch</option>
																<?php
																$dept=mysqli_query($dlink,"SELECT * FROM branches");
																while($dp=mysqli_fetch_assoc($dept))
																{
																?>
																<option <?php if($dp['id']==$branch){ ?> selected <?php } ?> value="<?php echo $dp['id']; ?>"><?php echo $dp['bname']; ?></option>
																<?php } ?>
															</select>
														</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
														<h5 style="color: #D42B2B">Joining Date </h5>
														
													</div>
													<div class="col-sm-12 col-md-4 col-lg-4 controls">
														<input type="date" name="j_date" id="j_date" value="<?php echo $j_date; ?>" class="form-control" >
													</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
														<h5 style="color: #D42B2B">Type of Employment </h5>
														
													</div>
													<div class="col-sm-12 col-md-4 col-lg-4 controls">
														<input type="text" name="emp" id="emp" placeholder="Type of Employment" value="<?php echo $emp; ?>" class="form-control" >
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
														<h5 style="color: #D42B2B">Role </h5>
														
													</div>
													<div class="col-sm-12 col-md-4 col-lg-4 controls">
														<input type="text" name="role" id="role" placeholder="Role" value="<?php echo $role; ?>" class="form-control" >
													</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
														<h5 style="color: #D42B2B">Nationality </h5>
														
													</div>
													<div class="col-sm-12 col-md-4 col-lg-4 controls">
														<!-- <input type="text" name="nationality" placeholder="Nationality" id="nationality" value="<?php echo $nationality; ?>" class="form-control" > -->

														<select name="nationality" id="nationality" class="form-control">
																<option value="">Select Nationality</option>
																<?php
																$dept=mysqli_query($dlink,"SELECT * FROM location where is_visible='0'");
																while($dp=mysqli_fetch_assoc($dept))
																{

																?>
																<option <?php if ($dp['name'] == $nationality) {?> selected="selected" <?php }?> value="<?php echo $dp['name']; ?>"><?php echo $dp['name']; ?></option>
																<?php } ?>
															</select>
													</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
														<h5 style="color: #D42B2B">Age </h5>
														
													</div>
													<div class="col-sm-12 col-md-4 col-lg-4 controls">
														<input type="text" name="age" id="age" placeholder="Age" value="<?php echo $age; ?>" class="form-control" >
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
														<h5 style="color: #D42B2B">Gender </h5>
														
													</div>
														<div class="col-sm-12 col-md-4 col-lg-4 controls">
															<select name="gender" id="gender" class="form-control">
																
																<option  value="">Select Gender</option>
																<option <?php if ($gender == 'Male') {?> selected="selected" <?php }?> value="Male">Male</option>
																<option <?php if ($gender == 'Female') {?> selected="selected" <?php }?> value="Female">Female</option>
															</select>
														</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2 sp-2">
														<h5 style="color: #D42B2B">Salary </h5>
														
													</div>
													<div class="col-sm-12 col-md-4 col-lg-4 controls">
														<input type="text" name="salary" id="salary" placeholder="0" value="<?php echo $salary; ?>" class="form-control" >
													</div>
												</div>
											</div>
								</div>
									
								<div class="col-md-3 pl-0">
									<div class="form-group">
										<div class="row">
											<div class="col-sm-12 col-md-3 col-lg-3 controls">
												<div class="box-1 rdlb-1">

													<?php 
														if($upload!=""){
															?><img src="<?php echo $site_url; ?>upimages/<?php echo $upload;?>" width=100/ id="blah"><?php
														}
														else{
															?><img src="../upimages/11.png" alt="" id="blah"><?php
														}
													?>
													
													<input id="upload" type="file" name="upload" onblur="Checkfiles()" onchange="readURL(this);"/>
													<a href="" id="upload_link">Upload Image</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>	
						</div>
					</div>
				</div>

                            <!-- <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">
                                       
                                        <h5>Department Title <span class="text-danger">*</span></h5>
                                        
                                        <div class="controls">
                                            <input type="text" name="title" id="title" class="form-control" value="<?php echo $title; ?>">
                                        </div>
                                        
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">
                                       
                                        <h5>Description <span class="text-danger">*</span></h5>
                                        
                                        <div class="controls">
                                            <textarea name="detail" rows="5" id="detail" class="form-control"><?php echo stripslashes($detail); ?></textarea>
                                        </div>
                                        
                                    </div>

                                </div>

                            </div> -->
                            <div class="gry-box">
	                            <div class="col-md-9 pl-0">
									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<h5 style="color: #D42B2B">User Name </h5>
												
											</div>
											<div class="col-md-4 controls">
												<input type="text" name="uname" id="uname" placeholder="User Name" class="form-control" value="<?php echo $username; ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-9 pl-0">
									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<h5 style="color: #D42B2B">Password </h5>
												
											</div>
											<div class="col-md-4 controls">
												<input type="text" name="password" id="password" placeholder="Password" class="form-control" value="<?php echo $password; ?>">
											</div>
										</div>
									</div>
								</div>
							</div>

                            <div class="text-xs-right pt-10">
                                <button type="submit" class="btn btn-danger" id="submit" name="submit" style="width: 147px;">Save</button>
                            </div>

                        </form>
			</div>
		</div>
	</section>
</div>


<?php include("footer.php"); ?>

<script>
function get_rcvr_city(val)
{
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{state:val,action:'get_city'},
	 success: function(data)
	 {	
	 	if(data.trim()=='Not Found')
		{
			$("#t_city").html('<option value="">Select</option>');  
		}
		else if(data.trim()=='blank')
		{
			$("#t_city").html('<option value="">Select</option>');  
		}
		else
		{
			$("#t_city").html(data); 
		}
	  }
	});
}
function get_rcvr_city1(val)
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


function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

function Checkfiles()
{
	var formData = new FormData();
    var file = document.getElementById("upload").files[0];
    formData.append("Filedata", file);
    var t = file.type.split('/').pop().toLowerCase();
    if (t != "jpeg" && t != "JPEG" && t != "jpg" && t != "JPG" && t != "png" && t != "gif" && t != "GIF") {
        alert('Upload Gif or Jpg or Png images only.');
        document.getElementById("upload").value = '';
        return false;
    }
    /*if (file.size > 1024000) {
        alert('Max Upload size is 1MB only');
        document.getElementById("img").value = '';
        return false;
    }*/
    return true;

}
$(document).ready(function(){ 
	$("#submit").click(function()
	{ 
		/*if($("#fname").val()=="")
		{
			$("#fname").attr("placeholder", "Please Enter First Name.");
			$("#fname").addClass("error_textbox");
			$("#fname").focus();
			return false;
		}*/
		/*if($("#mname").val()=="")
		{
			$("#mname").attr("placeholder", "Please Enter Middel Name.");
			$("#mname").addClass("error_textbox");
			$("#mname").focus();
			return false;
		}
		if($("#lname").val()=="")
		{
			$("#lname").attr("placeholder", "Please Enter Last Name.");
			$("#lname").addClass("error_textbox");
			$("#lname").focus();
			return false;
		}*/

		/*if($("#staff_id").val()=="")
		{
			$("#staff_id").attr("placeholder", "Please Enter Last Name.");
			$("#staff_id").addClass("error_textbox");
			$("#staff_id").focus();
			return false;
		}

		if($("#passport").val()=="")
		{
			$("#passport").attr("placeholder", "Please Enter Passport Number.");
			$("#passport").addClass("error_textbox");
			$("#passport").focus();
			return false;
		}
		if($("#address").val()=="")
		{
			$("#address").attr("placeholder", "Please Enter Address.");
			$("#address").addClass("error_textbox");
			$("#address").focus();
			return false;
		}
		if($("#city").val()=="")
		{
			$("#city").attr("placeholder", "Please Enter City.");
			$("#city").addClass("error_textbox");
			$("#city").focus();
			return false;
		}
		if($("#provience").val()=="")
		{
			$("#provience").attr("placeholder", "Please Enter Provience.");
			$("#provience").addClass("error_textbox");
			$("#provience").focus();
			return false;
		}
		if($("#zip").val()=="")
		{
			$("#zip").attr("placeholder", "Please Enter Zip.");
			$("#zip").addClass("error_textbox");
			$("#zip").focus();
			return false;
		}
		if($("#mobile").val()=="")
		{
			$("#mobile").attr("placeholder", "Please Enter Mobile.");
			$("#mobile").addClass("error_textbox");
			$("#mobile").focus();
			return false;
		}
		if($("#t_address").val()=="")
		{
			$("#t_address").attr("placeholder", "Please Enter Address.");
			$("#t_address").addClass("error_textbox");
			$("#t_address").focus();
			return false;
		}
		if($("#t_city").val()=="")
		{
			$("#t_city").attr("placeholder", "Please Enter City.");
			$("#t_city").addClass("error_textbox");
			$("#t_city").focus();
			return false;
		}
		if($("#t_provience").val()=="")
		{
			$("#t_provience").attr("placeholder", "Please Enter Provience.");
			$("#t_provience").addClass("error_textbox");
			$("#t_provience").focus();
			return false;
		}
		if($("#t_zip").val()=="")
		{
			$("#t_zip").attr("placeholder", "Please Enter Zip.");
			$("#t_zip").addClass("error_textbox");
			$("#t_zip").focus();
			return false;
		}
		if($("#t_mobile").val()=="")
		{
			$("#t_mobile").attr("placeholder", "Please Enter Mobile.");
			$("#t_mobile").addClass("error_textbox");
			$("#t_mobile").focus();
			return false;
		}
		if($("#dept_branch").val()=="")
		{
			$("#dept_branch").attr("placeholder", "Please Enter Department.");
			$("#dept_branch").addClass("error_textbox");
			$("#dept_branch").focus();
			return false;
		}
		if($("#branch").val()=="")
		{
			$("#branch").attr("placeholder", "Please Enter Branch.");
			$("#branch").addClass("error_textbox");
			$("#branch").focus();
			return false;
		}
		if($("#j_date").val()=="")
		{
			$("#j_date").attr("placeholder", "Please Enter Joining Date.");
			$("#j_date").addClass("error_textbox");
			$("#j_date").focus();
			return false;
		}
		if($("#emp").val()=="")
		{
			$("#emp").attr("placeholder", "Please Enter Employee Email.");
			$("#emp").addClass("error_textbox");
			$("#emp").focus();
			return false;
		}
		if($("#role").val()=="")
		{
			$("#role").attr("placeholder", "Please Enter Role");
			$("#role").addClass("error_textbox");
			$("#role").focus();
			return false;
		}
		if($("#nationality").val()=="")
		{
			$("#nationality").attr("placeholder", "Please Enter Nationality.");
			$("#nationality").addClass("error_textbox");
			$("#nationality").focus();
			return false;
		}
		if($("#age").val()=="")
		{
			$("#age").attr("placeholder", "Please Enter Age.");
			$("#age").addClass("error_textbox");
			$("#age").focus();
			return false;
		}
		if($("#gender").val()=="")
		{
			$("#gender").attr("placeholder", "Please Enter Gender.");
			$("#gender").addClass("error_textbox");
			$("#gender").focus();
			return false;
		}
		if($("#salary").val()=="")
		{
			$("#salary").attr("placeholder", "Please Enter Salary.");
			$("#salary").addClass("error_textbox");
			$("#salary").focus();
			return false;
		}*/
		/*if($("#upload").val()=="")
		{
			$("#upload").attr("placeholder", "Please Enter Upload.");
			$("#upload").addClass("error_textbox");
			$("#upload").focus();
			return false;
		}*/

		/*if($("#uname").val()=="")
		{
			$("#uname").attr("placeholder", "Please Enter User Name.");
			$("#uname").addClass("error_textbox");
			$("#uname").focus();
			return false;
		}
		if($("#password").val()=="")
		{
			$("#password").attr("placeholder", "Please Enter Password.");
			$("#password").addClass("error_textbox");
			$("#password").focus();
			return false;
		}*/

		// if($("#title").val()=="")
		// {
		// 	$("#title").attr("placeholder", "Please Enter Title.");
		// 	$("#title").addClass("error_textbox");
		// 	$("#title").focus();
		// 	return false;
		// }
		// if($("#detail").val()=="")
		// {
		// 	$("#detail").attr("placeholder", "Please Enter Detail.");
		// 	$("#detail").addClass("error_textbox");
		// 	$("#detail").focus();
		// 	return false;
		// }
	
	});
});

$(function(){
$("#upload_link").on('click', function(e){
    e.preventDefault();
    $("#upload:hidden").trigger('click');
});
});
</script>

<?php 

if(isset($_POST['submit'])!='')
{
  if(@$_GET['id']!='')
  {
	 if(@$_FILES['upload']['name']!="")
	{
		$row_select = fetch_query("upload","department",array("id="=>$_GET['id']));
		$unlink_image = $row_select['logo'];
		@unlink("upimages/".$unlink_image);
	
		if (($_FILES["upload"]["type"] == "image/gif") || ($_FILES["upload"]["type"] == "image/jpeg") || ($_FILES["upload"]["type"] == "image/jpg") || ($_FILES["upload"]["type"] == "image/pjpeg") || ($_FILES["upload"]["type"] == "image/x-png") || ($_FILES["upload"]["type"] == "image/png"))
		{
			$uploadedfile = $_FILES["upload"]["tmp_name"];
			$image11= rand().$_FILES['upload']['name'];
			$image1 = str_replace(' ', '_', $image11);
			move_uploaded_file($uploadedfile, "upimages/".$image1);
		}
		$image=$image1;
	}
	  $arr=array("fname"=>ucfirst($_POST['fname']),"mname"=>ucfirst($_POST['mname']),"lname"=>ucfirst($_POST['lname']),"staff_id"=>($_POST['staff_id']),
	  	"passport"=>($_POST['passport']),
	  	"address"=>($_POST['address']),
	  	"city"=>($_POST['city']),
	  	"provience"=>($_POST['provience']),
	  	"zip"=>($_POST['zip']),
	  	"mobile"=>($_POST['mobile']),
	  	"t_address"=>($_POST['t_address']),
	  	"t_city"=>($_POST['t_city']),
	  	"t_provience"=>($_POST['t_provience']),
	  	"t_zip"=>($_POST['t_zip']),
	  	"t_mobile"=>($_POST['t_mobile']),
	  	"dept_branch"=>($_POST['dept_branch']),
	  	"branch"=>($_POST['branch']),
	  	"j_date"=>($_POST['j_date']),
	  	"emp"=>($_POST['emp']),
	  	"nationality"=>($_POST['nationality']),
	  	"age"=>($_POST['age']),
	  	"gender"=>($_POST['gender']),
	  	"salary"=>($_POST['salary']),
	  	"username"=>($_POST['uname']),
	  	"password"=>($_POST['password']),
	  	"upload"=>$image,
	  	"role"=>($_POST['role']),
	  );   
	  $insert = update_query($arr,"id=".$id,"department");
	  if($insert)
	  {
		  $_SESSION['suc']='Staff Detail Updated Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Staff Detail Not Updated... Try Again...';
	  }
	  header("location:".$site_url."staff-listing");
	  exit;
  }
  else
  { 
  	if(@$_FILES['upload']['name']!="")
	{
		/*$row_select = fetch_query("logo","myadmin",array("id="=>"1"));
		$unlink_image = $row_select['logo'];
		@unlink("upimages/".$unlink_image);*/
	
		if (($_FILES["upload"]["type"] == "image/gif") || ($_FILES["upload"]["type"] == "image/jpeg") || ($_FILES["upload"]["type"] == "image/jpg") || ($_FILES["upload"]["type"] == "image/pjpeg") || ($_FILES["upload"]["type"] == "image/x-png") || ($_FILES["upload"]["type"] == "image/png"))
		{
			$uploadedfile = $_FILES["upload"]["tmp_name"];
			$image11= rand().$_FILES['upload']['name'];
			$image1 = str_replace(' ', '_', $image11);
			move_uploaded_file($uploadedfile, "upimages/".$image1);
		}
		$image=$image1;
	}
	
	else if(isset($_POST['existing']))
	{ 
		$image = $_POST['existing'];
	}
	  $dt=date('Y-m-d H:i:s');
	  $arr=array(
	  	"fname"=>ucfirst($_POST['fname']),
	  	"mname"=>ucfirst($_POST['mname']),
	  	"lname"=>ucfirst($_POST['lname']),
	  	"staff_id"=>$_POST['staff_id'],
	  	"passport"=>($_POST['passport']),
	  	"address"=>($_POST['address']),
	  	"city"=>($_POST['city']),
	  	"provience"=>($_POST['provience']),
	  	"zip"=>($_POST['zip']),
	  	"mobile"=>($_POST['mobile']),
	  	"t_address"=>($_POST['t_address']),
	  	"t_city"=>($_POST['t_city']),
	  	"t_provience"=>($_POST['t_provience']),
	  	"t_zip"=>($_POST['t_zip']),
	  	"t_mobile"=>($_POST['t_mobile']),
	  	"dept_branch"=>($_POST['dept_branch']),
	  	"branch"=>($_POST['branch']),
	  	"j_date"=>($_POST['j_date']),
	  	"emp"=>($_POST['emp']),
	  	"nationality"=>($_POST['nationality']),
	  	"age"=>($_POST['age']),
	  	"gender"=>($_POST['gender']),
	  	"salary"=>($_POST['salary']),
	  	"username"=>($_POST['uname']),
	  	"password"=>($_POST['password']),
	  	"upload"=>$image,
	  	"role"=>($_POST['role']),
	  	"recorddate"=>$dt); 
	  $insert = insert_query($arr, "department");
	  if($insert)
	  {
		  $_SESSION['suc']='Staff Detail Added Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Staff Detail Not Added... Try Again...';
	  }
	  header("location:".$site_url."staff-listing");
	  exit;
  }
}
?>