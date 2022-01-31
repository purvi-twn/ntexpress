<?php include("header.php"); 

if(@$_REQUEST['id']!='')
{
	$id = $_REQUEST['id'];
	$rows = fetch_query("*","expenses",array("id="=>$id));

	$exp_type = $rows['exp_type'];
	$aid = $rows['aid'];
	$exp_amount = $rows['exp_amount'];
	$remark = $rows['remark'];
	$expense_for_month = $rows['expense_for_month'];
	$added_by=$rows['added_by'];
	$pagetitle='Edit';
}
else
{
	
	$exp_type = '';
	$aid = '';
	$exp_amount = '';
	$remark = '';
	$expense_for_month = '';
	$pagetitle="Add";
	$added_by='';
}
$deptid='0';
if(@$_SESSION['ntexpress_retroagent']!='')
{
	
	$userdetail=fetch_query("*", "agent", array("id="=>$_SESSION['ntexpress_retroagent'])); 
	$deptid=$userdetail['deptid'];
}

?>

<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

        <h1> Expenses <?php echo $pagetitle; ?> </h1>

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
								<div class="col-lg-6 col-md-6 col-sm-6 col-12">
									<div class="form-group">
										<h5>Expense Date <span class="text-danger">*</span></h5>
										<div class="controls">
                                        	<input type="date" name="exp_date" id="exp_date" class="form-control" value="<?php echo $expense_for_month?>">
										</div>
									</div>
								</div>
                                </div>
                                <div class="row">
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group">
                                		<h5>Expenses Type<span class="text-danger">*</span></h5>
                                   		<div class="demo-radio-button">
                                   			<input name="exp_type" type="radio" id="radio_46_misc" class="with-gap radio-col-maroon" <?php if($exp_type=='Misc') {?> checked="checked" <?php } if($exp_type==""){ ?> checked="checked" <?php }?> onchange="display_exp_type_div()" value="Misc">
                                   			<label for="radio_46_misc">Misc. Expense</label>
                                    		<input name="exp_type" type="radio" id="radio_46_salary" class="with-gap radio-col-maroon" <?php if($exp_type=='Salary') {?> checked="checked" <?php }?> onchange="display_exp_type_div()" value="Salary">
                                   			<label for="radio_46_salary">Salary</label>
                                    	</div>  
                                	</div>
								</div>
                                </div>
                                <div class="row" id="agent_div" style="display:none">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<h5>Representative <span class="text-danger">*</span></h5>
										<div class="controls">
                                        	<select name="agentid" id="agentid" class="form-control" onchange="display_salary(this.value)">
                                                <option value="">Select Representative</option>
                                                <?php
												$agent=mysqli_query($dlink,"SELECT id,title FROM agent WHERE 1 and deptid='".$deptid."'");
												while($dp=mysqli_fetch_assoc($agent))
												{
												?>
												<option <?php if($dp['id']==$$aid){ ?> selected <?php } ?> value="<?php echo $dp['id']; ?>"><?php echo $dp['name']; ?></option>
												<?php } ?>
                                            </select>
										</div>
									</div>
								</div>
                                </div>
								<div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Expenses Amount<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="text" name="exp_amount" id="exp_amount" class="form-control" value="<?php echo $exp_amount; ?>" onkeypress="return isNumberKey(event);">
                                        </div>

                                    </div>

                                </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Remark</h5>

                                        <div class="controls">
                                            <input type="text" name="exp_remark" id="exp_remark" class="form-control" value="<?php echo $remark; ?>">
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
function display_exp_type_div()
{
	
	if($("#radio_46_misc").is(":checked"))
	{
		//alert('misc');
		$("#agent_div").hide();	
	}
	else
	{
		//alert('salary');	
		$("#agent_div").show();	
	}



}
$(document).ready(function(){ 
	$("#submit").click(function()
	{ 
		
		if($("#exp_date").val()=="")
		{
			$("#exp_date").attr("placeholder", "Please Select Expenses Date.");
			$("#exp_date").addClass("error_textbox");
			$("#exp_date").focus();
			return false;
		}
		
		if($("#radio_46_misc").is(":checked"))
		{
			if($("#exp_amount").val()=="")
			{
				$("#exp_amount").attr("placeholder", "Please Enter Expense Amount.");
				$("#exp_amount").addClass("error_textbox");
				$("#exp_amount").focus();
				return false;
			}
		}
		else
		{
			if($("#agentid").val()=="")
			{
				$("#agentid").attr("placeholder", "Please Select Agent.");
				$("#agentid").addClass("error_textbox");
				$("#agentid").focus();
				return false;
			}
			if($("#exp_amount").val()=="")
			{
				$("#exp_amount").attr("placeholder", "Please Enter Salary Amount.");
				$("#exp_amount").addClass("error_textbox");
				$("#exp_amount").focus();
				return false;
			}
		}
		
	});
});
function display_agent(val)
{
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{deptid:val,action:'get_agent'},
	 success: function(data)
	 {	
	 	if(data.trim()=='Not Found')
		{
			$("#agentid").html('<option value="">Select</option>');  
		}
		else if(data.trim()=='blank')
		{
			$("#agentid").html('<option value="">Select</option>');  
		}
		else
		{
			$("#agentid").html(data); 
		}
	  }
	});
}
function display_salary(val)
{
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{agentid:val,action:'get_agent_salary'},
	 success: function(data)
	 {	
	 	if(data.trim()=='Not Found')
		{
			$("#exp_amount").val('0');  
		}
		else if(data.trim()=='blank')
		{
			$("#exp_amount").val('0');  
		}
		else
		{
			$("#exp_amount").val(data); 
		}
	  }
	});
}

</script>
<?php 

if(isset($_POST['submit'])!='')
{
  if(@$_GET['id']!='')
  {
	  $userdetail=fetch_query("*", "agent", array("id="=>$_SESSION['ntexpress_retroagent'])); 
	  $deptid=$userdetail['deptid'];
	  $arr=array("added_by"=>$_SESSION['ntexpress_retroagent'],"deptid"=>$deptid,"exp_type"=>$_POST['exp_type'],"aid"=>$_POST['agentid'],"exp_amount"=>$_POST['exp_amount'],"remark"=>$_POST['exp_remark'],"expense_for_month"=>date('Y-m-d',strtotime($_POST['exp_date'])));   
	  $insert = update_query($arr,"id=".$id,"expenses");
	  if($insert)
	  {
		  $_SESSION['suc']='Expenses Detail Updated Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Expenses Detail Not Updated... Try Again...';
	  }
	  header("location:".$site_url."expenses-list");
	  exit;
  }
  else
  { 
	  $dt=date('Y-m-d H:i:s');
	  $userdetail=fetch_query("*", "agent", array("id="=>$_SESSION['ntexpress_retroagent'])); 
		$deptid=$userdetail['deptid'];
	  $arr=array("added_by"=>$_SESSION['ntexpress_retroagent'],"deptid"=>$deptid,"exp_type"=>$_POST['exp_type'],"aid"=>$_POST['agentid'],"exp_amount"=>$_POST['exp_amount'],"remark"=>$_POST['exp_remark'],"expense_for_month"=>date('Y-m-d',strtotime($_POST['exp_date'])),"added_on"=>$dt);  
	  $insert = insert_query($arr, "expenses");
	  if($insert)
	  {
		  $_SESSION['suc']='Expenses Detail Added Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Expenses Detail Not Added... Try Again...';
	  }
	  header("location:".$site_url."expenses-list");
	  exit;
  }
}
?>