<?php include("header.php"); 

if(@$_REQUEST['id']!='')
{
	$id = $_REQUEST['id'];
	$rows = fetch_query("*","branches",array("id="=>$id));
	$bname = $rows['bname'];
	$address = $rows['address'];
	$address1 = $rows['address1'];
	$city = $rows['city'];
	$provience = $rows['provience'];
	$zip = $rows['zip'];
	$mobile = $rows['mobile'];
	$fax = $rows['fax'];
	$website = $rows['website'];
	
}
else
{
	$bname = '';
	$address = '';
	$address1 = '';
	$city = '';
	$provience = '';
	$zip = '';
	$mobile = '';
	$fax = '';
	$website = '';
	$pagetitle="Add";
}

?>

<?php include("leftpanel.php"); ?>
<style>
@media screen and (max-width: 400px){
	.sp-1{
			margin-bottom: 15px;
		}
}
@media screen and (min-width: 401px) and (max-width: 767px){
	.sp-1{
			margin-bottom: 15px;
		}
}
@media screen and (min-width: 768px) and (max-width: 992px){
	.sp-1{
			margin-bottom: 15px;
		}
}
</style>
<div class="content-wrapper">

    <section class="content-header">

        <!--<h1> Branches <?php echo $pagetitle; ?> </h1>-->

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
							<div class="col-sm-12 col-md-12 pl-0">
                                <h3>Add Branches</h3>
                                <hr />
                            </div>
                            <div class="form-group">
								<div class="row">
									<div class="col-sm-12 col-md-2 controls">
                                        <h5 style="color: #D42B2B">Branch Name<span style="color: #D42B2B">*</span></h5>
									</div>
                                    <div class="col-sm-12 col-md-3 controls">
                                        <input type="bname" name="bname" id="bname" value="<?php echo $bname; ?>" class="form-control" placeholder="Branch Name">
                                    </div>
										<p id="userexist" style="color:#F00;"></p>
                                 </div>
                            </div>

                            <div class="form-group">
								<div class="row">
									<div class="col-sm-12 col-md-2 controls">
										<h5>Company Address</h5>
									</div>
                                    <div class="col-sm-12 col-md-4 controls">
                                        <textarea name="address" rows="3" id="address" class="form-control" placeholder="Street1"><?php echo stripslashes($address); ?></textarea>
                                    </div>
								</div><br>
								<div class="row">
									<div class="col-sm-12 col-md-2 controls">
										
									</div>
                                    <div class="col-sm-12 col-md-4 controls">
                                        <textarea name="address1" rows="3" id="address1" class="form-control" placeholder="Street2"><?php echo stripslashes($address1); ?></textarea>
                                    </div>
								</div>
                            </div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-sm-12 col-md-2 controls">
										
									</div>
                                   
									<div class="col-sm-12 col-md-2 controls sp-1">
                                       
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

                                    <div class="col-sm-12 col-md-2 controls sp-1">
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
									<div class="col-sm-12 col-md-2 controls sp-1">
                                         <input type="text" name="zip" id="zip" value="<?php echo $zip; ?>" class="form-control" placeholder="Zip/Postal Code">
                                    </div>
								</div><br>
								<div class="row">
									<div class="col-sm-12 col-md-2 controls">
										
									</div>
                                    <div class="col-sm-12 col-md-2 controls sp-1">
                                        <input type="text" name="mobile" id="mobile" value="<?php echo $mobile; ?>" class="form-control" placeholder="Mobile" minlength="10" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                    </div>
									<div class="col-sm-12 col-md-2 controls sp-1">
                                        <input type="text" name="fax" id="fax" value="<?php echo $fax; ?>" class="form-control" placeholder="Fax">
									</div>
									<div class="col-sm-12 col-md-2 controls sp-1">
                                         <input type="text" name="website" id="website" value="<?php echo $website; ?>" class="form-control" placeholder="Website">
                                    </div>
								</div><br>
							</div>
								
								<div class="row">
									<div class="col-sm-12 col-md-2 controls">
										<h5>Primary Contact</h5>
									</div>
                                    <div class="col-sm-12 col-md-4 controls">
									 <input type="text" name="primary" id="primary" value="<?php echo $website; ?>" class="form-control" placeholder="Primary Contact">
                                       <!-- <select class="form-control">
                                            <option value="">0</option>
                                            <option value="">1</option>
                                            <option value="">2</option>
                                        </select>-->
                                    </div>
                                </div>
								
								
                            <div class="text-xs-right pt-10">
                               
                                <button type="submit" class="btn btn-danger" id="submit" name="submit" style="width: 147px;">Save</button>
                                
                            </div>
								
                    </div>

                                    <!--<div class="controls">
                                        <input type="text" name="provience" id="provience" value="<?php echo $provience; ?>" class="form-control" placeholder="Provience">
                                    </div>

                                    <div class="controls">
                                        <input type="text" name="zip" id="zip" value="<?php echo $zip; ?>" class="form-control" placeholder="Zip/Postal Code">
                                    </div>

                                    <div class="controls">
                                        <input type="text" name="mobile" id="mobile" value="<?php echo $mobile; ?>" class="form-control" placeholder="Mobile">
                                    </div>

                                    <div class="controls">
                                        <input type="text" name="fax" id="fax" value="<?php echo $fax; ?>" class="form-control" placeholder="Fax">
                                    </div>

                                    <div class="controls">
                                        <input type="text" name="website" id="website" value="<?php echo $website; ?>" class="form-control" placeholder="Website">
                                    </div>-->

                </div>
            </div>


                        </form>

        </div>
</div>
    </section>


<?php include("footer.php"); ?>

<script>
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
$(document).ready(function(){ 
	$("#submit").click(function()
	{ 

		if($("#bname").val()=="")
		{
			$("#bname").attr("placeholder", "Please Enter Branch Name.");
			$("#bname").addClass("error_textbox");
			$("#bname").focus();
			return false;
		}

	});
});


</script>
<?php 

if(isset($_POST['submit'])!='')
{
	
  if(@$_GET['id']!='')
  {
	  
	  $arr=array("bname"=>ucfirst($_POST['bname']),"address"=>addslashes($_POST['address']),"address1"=>addslashes($_POST['address1']),"city"=>$_POST['city'],"provience"=>$_POST['provience'],"zip"=>$_POST['zip'],"mobile"=>$_POST['mobile'],"fax"=>$_POST['fax'],"website"=>$_POST['website']);   
	  $insert = update_query($arr,"id=".$id,"branches");
	  if($insert)
	  {
		  $_SESSION['suc']='Branches Detail Updated Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Branches Detail Not Updated... Try Again...';
	  }
	  header("location:".$site_url."branch-listing");
	  exit;
  }
  else
  { 
	  $dt=date('Y-m-d H:i:s');
	  $arr=array("bname"=>ucfirst($_POST['bname']),"address"=>addslashes($_POST['address']),"address1"=>addslashes($_POST['address1']),"city"=>$_POST['city'],"provience"=>$_POST['provience'],"zip"=>$_POST['zip'],"mobile"=>$_POST['mobile'],"fax"=>$_POST['fax'],"website"=>$_POST['website'],"recorddate"=>$dt); 
	  $insert = insert_query($arr, "branches");
	  if($insert)
	  {
		  $_SESSION['suc']='Branches Detail Added Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Branches Detail Not Added... Try Again...';
	  }
	  header("location:".$site_url."branch-listing");
	  exit;
  }
}
?>