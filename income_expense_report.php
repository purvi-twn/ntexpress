<?php include("header.php"); ?>

<?php include("leftpanel.php"); 

$userdetail=''; $type='';

$adm=fetch_query("*", "`myadmin`", array("id="=>1)); 
if($_SESSION['ntexpress_retroadm']!='')
{
    $userdetail1=fetch_query("*", "`myadmin`", array("username="=>$_SESSION['ntexpress_retroadm'])); 
    $userdetail=$userdetail1['username'];
    $type='admin';
}
else if($_SESSION['ntexpress_retroaccountant']!='')
{
    $userdetail1=fetch_query("*", "`agent`", array("id="=>$_SESSION['ntexpress_retroaccountant'],"deptid="=>3)); 
    $type="agent";
    $userdetail=$userdetail1['name'];
}
else
{
    $userdetail1=fetch_query("*", "department", array("id="=>$_SESSION['ntexpress_retroagent'])); 
    $type="department";
    /*$userdetail=$userdetail1['fname'] .' '.$userdetail1['mname'].' '.$userdetail1['lname'] ;*/
    $userdetail=$userdetail1['fname']; 
}

?>
<style type="text/css">
    .ads_Checkbox,#master {
    position: unset !important;
    left: unset !important;
    opacity: unset !important;
}
.table > thead > tr > th:first-child, .table > tbody > tr > td:first-child {
    display: none;
}
</style>

<div class="content-wrapper">

    <section class="content-header">

        <h1> Income-Expense Report </h1>

    </section>

    <section class="content pb-10">

        <div class="box">
                       
            <div class="box-body skin-purple-light ">
            <?php

				if(isset($_SESSION['suc']))

				{ echo session_succ(); }?>

				<div class="alert alert-success" id="error_message" style="display:none;"></div>

				<?php

				if(isset($_SESSION['unsuc']))

				{ echo session(); }?>
				<div class="alert alert-danger" id="error_message" style="display:none;"></div>
               	<form method="post" action="" name="bg" id="bg">
                <div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    	<div class="form-group">
                        	<h5>Search By<span class="text-danger">*</span></h5>
                            <div class="demo-radio-button">
                            	<input name="search_by" type="radio" id="radio_outgoing" class="with-gap radio-col-maroon radiosearch" checked="checked" onchange="display_other_filter()" value="Outgoin">
                                <label for="radio_outgoing">Outgoing Report</label>
                                <input name="search_by" type="radio" id="radio_shipment" class="with-gap radio-col-maroon radiosearch" onchange="display_other_filter()" value="Shipment">
                                <label for="radio_shipment">Shipment Report</label>
                                <input name="search_by" type="radio" id="radio_expense" class="with-gap radio-col-maroon radiosearch" onchange="display_other_filter()" value="Expense">
                                <label for="radio_expense">Expense Report</label>
                                <!-- <input name="search_by" type="radio" id="radio_salesman" class="with-gap radio-col-maroon radiosearch" onchange="display_other_filter()" value="Salesman">
                                <label for="radio_salesman">Summary of Salesman Report</label> -->
                                <input name="search_by" type="radio" id="radio_business" class="with-gap radio-col-maroon radiosearch" onchange="display_other_filter()" value="Business">
                                <label for="radio_business">Total Business (Region Wise) Report</label>
                                <input name="search_by" type="radio" id="radio_delivery" class="with-gap radio-col-maroon radiosearch" onchange="display_other_filter()" value="Delivery">
                                <label for="radio_delivery">Delivery</label>
                                <input name="search_by" type="radio" id="radio_branch" class="with-gap radio-col-maroon radiosearch" onchange="display_other_filter()" value="Branch">
                                <label for="radio_branch">Branch</label>
                                <input name="search_by" type="radio" id="radio_employee" class="with-gap radio-col-maroon radiosearch" onchange="display_other_filter()" value="Employee">
                                <label for="radio_employee">Employee</label>
                                <input name="search_by" type="radio" id="radio_salesman" class="with-gap radio-col-maroon radiosearch" onchange="display_other_filter()" value="Salesman">
                                <label for="radio_salesman">Salesman</label>

                                <input name="search_by" type="radio" id="radio_self" class="with-gap radio-col-maroon radiosearch" onchange="display_other_filter()" value="Self">
                                <label for="radio_self">Self</label>

                           	</div>  
                       	</div>
                    </div>
                </div>
                <!--<div class="content">-->
                	<div class="row">
                    	<div class="col-md-12 alert alert-danger" id="error_div_search" style="display:none">Select Today's Report or Enter Date</div>
                        <div class="col-md-2">
                            <div class="demo-radio-button">
                                <input name="radio_today" type="checkbox" id="radio_today" class="with-gap radio-col-maroon radiosearch" onchange="select_today_report()" value="today">
                                <label for="radio_today">Today's Report</label> 
                            </div>
                        </div>
                    </div>
                    <div class="row" id="date_div">
                    	<div class="col-md-12 alert alert-danger" id="error_div_search" style="display:none">Select atleast least one field for search</div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="date1">From Date :</label>
                                <input type="date" class="form-control" id="from_date" name="from_date"> 
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="date2">To Date :</label>
                                <input type="date" class="form-control" id="to_date" name="to_date"> 
                            </div>
                        </div>
                    </div>
                    <div class="row" id="div_location">
                        <div class="col-lg-2 col-md-2 col-sm-6 col-12" style="display:none">
                            <div class="form-group">
                                <h5>Country</h5>
                                <div class="controls">
                                        <select name="source_country" id="source_country" class="form-control" onchange="get_state(this.value,'source_state')">
                                            <option value="">Select Contry</option>
                                            <?php $source_country='184';
                                            $selcon=mysqli_query($dlink,"SELECT * FROM location where location_id='184' and location_type='0' and parent_id='0' and is_visible='0' order by name");
                                            while ($bcon=mysqli_fetch_array($selcon)) {
                                            ?>
                                            <option <?php if ($bcon['location_id'] == $source_country) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                            <div class="form-group">
                                <h5>Source State</h5>
                                <div class="controls">
                                    <select name="source_state" id="source_state" class="form-control" onchange="get_city(this.value,'source_city')">
                                        <option value="">Select State</option> <?php
                                        $selsta=mysqli_query($dlink,"SELECT * FROM location where  location_type='1' and parent_id='184' and is_visible='0' order by name");
                                        while($s=mysqli_fetch_array($selsta)) { ?>
                                            <option <?php if ($s['location_id'] == $source_state) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option> <?php
                                        }?>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                            <div class="form-group">
                                <h5>Source City</h5>
                                <div class="controls"> 
                                    <select name="source_city" id="source_city" class="form-control" onchange="save_city(this.value)">
                                        <option value="">Select City</option> <?php
                                        $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$source_state."' and is_visible='0' order by name");
                                        while($s1=mysqli_fetch_array($selcit)) { ?>
                                        <option <?php if ($s1['location_id'] == $source_city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option><?php
                                        }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-12" style="display:none">
                            <div class="form-group">
                                <h5>Country</h5>
                                <div class="controls">
                                    <select name="destination_country" id="destination_country" class="form-control" onchange="get_state(this.value,'destination_state')">
                                        <option value="">Select Country</option>
                                        <?php $destination_country='184';
                                        $selcon=mysqli_query($dlink,"SELECT * FROM location where location_id='184' and location_type='0' and parent_id='0' and is_visible='0' order by name");
                                        while ($bcon=mysqli_fetch_array($selcon)) { ?>
                                        <option <?php if ($bcon['location_id'] == $destination_country) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                            <div class="form-group">
                                <h5>Destination State</h5>
                                <div class="controls">
                                    <select name="destination_state" id="destination_state" class="form-control" onchange="get_city(this.value,'destination_city')">
                                        <option value="">Select State</option> <?php
                                        $selsta=mysqli_query($dlink,"SELECT * FROM location where  location_type='1' and parent_id='184' and is_visible='0' order by name");
                                        while($s=mysqli_fetch_array($selsta)) { ?>
                                        <option <?php if ($s['location_id'] == $destination_state) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option> <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                            <div class="form-group">
                                <h5>Destination City</h5>
                                <div class="controls">
                                    <select name="destination_city" id="destination_city" class="form-control" onchange="save_city(this.value)">
                                        <option value="">Select City</option> <?php
                                        $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$destination_state."' and is_visible='0' order by name");
                                        while($s1=mysqli_fetch_array($selcit)) { ?>
                                        <option <?php if ($s1['location_id'] == $destination_city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option> <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    
                    <div class="row" id="div_agent" style="display:none">
                    	<div class="col-lg-2 col-md-2 col-sm-6 col-12">
                            <div class="form-group">
                                <h5>Shipper</h5>
                                <div class="controls">
                                    <select name="agent" id="agent" class="form-control">
                                        <option value="">Select Agent</option>  <?php
                                        $agent=mysqli_query($dlink,"SELECT * FROM agent WHERE 1");
                                        while($dp=mysqli_fetch_assoc($agent))
                                        { ?>
                                        <option <?php if($dp['id']==$sender_agentid){ ?> selected <?php } ?> value="<?php echo $dp['id']; ?>"><?php echo $dp['name']."-".$dp['agent_no']; ?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="row" id="div_agent_sales" style="display:none">
                        <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                            <div class="form-group">
                                <h5>Employee</h5>
                                <div class="controls">
                                    <select name="employee" id="employee" class="form-control">
                                        <option value="">Select Employee</option>  <?php
                                        $agent=mysqli_query($dlink,"SELECT * FROM department WHERE 1");
                                        while($dp=mysqli_fetch_assoc($agent))
                                        { ?>
                                        <option  value="<?php echo $dp['fname']; ?>"><?php echo $dp['fname']." ".$dp['mname']; ?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row" id="div_desti_salesman" style="display:none">
                        <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                            <div class="form-group">
                                <h5>Salesman</h5>
                                <div class="controls">
                                    <select name="desti_salesman" id="desti_salesman" class="form-control" >
	                                	<option value=""></option>
	                                    <?php
	                                    	$agent=mysqli_query($dlink,"SELECT * FROM  department WHERE 1");
	                                        while($dp=mysqli_fetch_assoc($agent))
	                                        {
	                                        	?>
	                                            <option value="<?php echo $dp['id']; ?>"><?php echo $dp['fname']." ".$dp['mname']."-".$dp['staff_id']; ?></option><?php } ?>
	                                	</select>
                                </div>
                            </div>
                        </div>
                    </div> 
                    
                     <div class="row" id="div_desti_location">
                        <div class="col-lg-2 col-md-2 col-sm-6 col-12" style="display:none">
                            <div class="form-group">
                                <h5>Country</h5>
                                <div class="controls">
                                    <select name="destination_country" id="destination_country" class="form-control" onchange="get_state(this.value,'destination_state')">
                                        <option value="">Select Country</option>
                                        <?php $destination_country='184';
                                        $selcon=mysqli_query($dlink,"SELECT * FROM location where location_id='184' and location_type='0' and parent_id='0' and is_visible='0' order by name");
                                        while ($bcon=mysqli_fetch_array($selcon)) { ?>
                                        <option <?php if ($bcon['location_id'] == $destination_country) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-12" id="stateHideShow" style="display:none;">
                            <div class="form-group">
                                <h5>Destination State</h5>
                                <div class="controls">
                                    <select name="delivery_destination_state" id="delivery_destination_state" class="form-control" onchange="get_city(this.value,'delivery_destination_city')">
                                        <option value="">Select State</option> <?php
                                        $selsta=mysqli_query($dlink,"SELECT * FROM location where  location_type='1' and parent_id='184' and is_visible='0' order by name");
                                        while($s=mysqli_fetch_array($selsta)) { ?>
                                        <option <?php if ($s['location_id'] == $destination_state) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option> <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-12" id="hideCity" style="display:none;">
                            <div class="form-group">
                                <h5>Destination City 22</h5>
                                <div class="controls">
                                    <select name="delivery_destination_city" id="delivery_destination_city" class="form-control" onchange="save_city(this.value)">
                                        <option value="">Select City</option> <?php
                                        $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$destination_state."' and is_visible='0' order by name");
                                        while($s1=mysqli_fetch_array($selcit)) { ?>
                                        <option <?php if ($s1['location_id'] == $destination_city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option> <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-2 col-md-2 col-sm-6 col-12" id="showCity" style="display: none;">
                            <div class="form-group">
                                <h5>Destination City </h5>
                                <div class="controls">
                                    <select name="delivery_destination_city" id="delivery_destination_city" class="form-control">
                                        <option value="">Select City</option> <?php
                                        $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2'  and is_visible='0' order by name");
                                        while($s1=mysqli_fetch_array($selcit)) { ?>
                                        <option <?php if ($s1['location_id'] == $destination_city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option> <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="row" id="div_source_branch" style="display:none">
                    	<div class="col-lg-2 col-md-2 col-sm-6 col-12" >
                            <div class="form-group">
                                <h5>Branch</h5>
                                <div class="controls">
                                        <select name="source_branch" id="source_branch" class="form-control">
                                            <option value="">Select Branch</option>
                                            <?php
                                            $selcon=mysqli_query($dlink,"SELECT * FROM branches order by bname");
                                            while ($bcon=mysqli_fetch_array($selcon)) {
                                            ?>
                                            <option value="<?php echo $bcon['id']; ?>"><?php echo $bcon['bname']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="text-xs-right bt-1 pt-10 pb-10">
                    	<button type="button" class="btn btn-danger" id="submit" name="submit">Search</button>
                   	</div>
                    
               <!-- </div>-->
                </form>
                
                <div class="table-responsive" id="dtable_hide">

                    <input type="button" id="save_value" name="save_value" value="Print All" class="btn btn-danger" onclick='checkAll()'/>

                  	<table id="demotable" class="table table-condensed dataTable table-hover">
                        <thead><tr></tr></thead>
                    </table>
                    <span class="addlink"></span>
                </div>
            </div>
        </div>
    </section>
</div>


<?php include("footer.php"); ?>

<script language="javascript">

 $('#save_value').click(function(){

    var oTable = $('#demotable').dataTable({
        stateSave: true,
        destroy: true,
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }, 
    ]
    });

    var allPages = oTable.fnGetNodes();
    $("#master").prop('checked', true); 

    if($('#master').is(':checked',true))  
    {
        $(".ads_Checkbox", allPages).prop('checked', true);  
    } else {  
        $(".ads_Checkbox", allPages).prop('checked',false);  
    } 

    var val = [];
    $("input[name='selector']:checked").each(function(i){
        val[i] = $(this).val();
    });

    $.each( val, function( key, value ) {
       // window.open("https://thewpbrain.com/ntexpress/_private_content_shipment/l_"+value+".pdf",'_blank');
        var url = window.URL || window.webkitURL;
        link = "https://thewpbrain.com/ntexpress/_private_content_shipment/l_"+value+".pdf";
        var a = $("<a />");
        a.attr("download", link);
        a.attr("href", link);
        $(".addlink").append(a);
        a[0].click();
    });
    $(".addlink").remove(a);
});
$(function(){
    //$('#save_value').click(function(){
        
       /* var val = [];
        $("input[name='selector']:checked").each(function(i){
            val[i] = $(this).val();
        });

        $.each( val, function( key, value ) {
           // window.open("https://thewpbrain.com/ntexpress/_private_content_shipment/l_"+value+".pdf",'_blank');
            var url = window.URL || window.webkitURL;
            link = "https://thewpbrain.com/ntexpress/_private_content_shipment/l_"+value+".pdf";
            var a = $("<a />");
            a.attr("download", link);
            a.attr("href", link);
            $(".addlink").append(a);
            a[0].click();
        });
        $(".addlink").remove(a);*/
        

    //});
});
function select_today_report()
{
	if($("#radio_today").is(":checked"))
	{
		$('#date_div').hide();
	}
	else
	{
		$('#date_div').show();
	}
	
}
function display_other_filter()
{
	/*$('#from_date').val("");
	$('#to_date').val("");
	$('#source_state').val("");
	$('#source_city').val("");
	$('#destination_state').val("");
	$('#destination_city').val("");*/
	if($("#radio_expense").is(":checked"))
	{
		$('#div_location').hide();
	}
	else
	{
		$('#div_location').show();
	}
	
	/*if($("#radio_salesman").is(":checked"))
	{
		$('#div_location').hide();
		$('#div_agent').show();
		$('#div_desti_location').hide();
        $('#div_agent_sales').show();
		$('#div_source_branch').hide();
		$('#div_agent_sales').hide();
		$('#div_desti_salesman').hide();
	}
	else
	{
		$('#div_location').show();
		$('#div_agent').hide();
		$('#div_desti_location').hide();
		$('#div_source_branch').hide();
		$('#div_agent_sales').hide();
		$('#div_desti_salesman').hide();
	}*/
	
	if($("#radio_outgoing").is(":checked"))
	{
		$('#div_location').show();
		$('#div_agent').hide();
		$('#div_desti_location').show();
		$('#div_source_branch').hide();
		$('#div_agent_sales').hide();
		$('#div_desti_salesman').hide();
	}
	if($("#radio_business").is(":checked"))
	{
		$('#div_location').hide();
		$('#div_agent').hide();
		$('#div_desti_location').hide();
		$('#div_source_branch').hide();
		$('#div_agent_sales').hide();
		$('#div_desti_salesman').hide();
	}
	
	if($("#radio_delivery").is(":checked"))
	{
		$('#div_location').hide();
		$('#div_desti_location').show();
		$('#div_agent').hide();
        $('#stateHideShow').show();
        $('#showCity').show();
        $('#hideCity').hide();
		$('#div_source_branch').hide();
		$('#div_agent_sales').hide();
		$('#div_desti_salesman').hide();

	}
	if($("#radio_branch").is(":checked"))
	{
		$('#div_location').hide();
		$('#div_desti_location').hide();
		$('#div_agent').hide();
		$('#div_source_branch').show();
		$('#div_agent_sales').hide();
		$('#div_desti_salesman').hide();
		
	}
	if($("#radio_employee").is(":checked"))
	{
		$('#div_location').hide();
		$('#div_desti_location').hide();
		$('#div_agent').hide();
		$('#div_source_branch').hide();
		$('#div_agent_sales').show();
		$('#div_desti_salesman').hide();
	}
	if($("#radio_salesman").is(":checked"))
	{
		$('#div_location').hide();
		$('#div_desti_location').hide();
		$('#div_agent').hide();
		$('#div_source_branch').hide();
		$('#div_agent_sales').hide();
		$('#div_desti_salesman').show();
	}
    if($("#radio_self").is(":checked"))
    {
        $('#div_location').hide();
        $('#div_desti_location').hide();
        $('#div_agent').hide();
        $('#div_source_branch').hide();
        $('#div_agent_sales').hide();
        $('#div_desti_salesman').hide();
    }
	
}
$(document).ready(function()
{ 
	$("#submit").click(function()
	{ 
		var errr=0; agent='';
		
		if($("#radio_today").is(":checked"))
		{
			//if($("#source_state").val()=="" && $("#source_city").val()=="" && $("#destination_state").val()=="" && $("#destination_city").val()=="")
			//errr=1;
			errr=0;
		}
		else
		{
			if($("#from_date").val()=="" && $("#to_date").val()!="")
			{
				$("#from_date").attr("placeholder", "Please Select From Date.");
				$("#from_date").addClass("error_textbox");
				$("#from_date").focus();
				//errr=1;
				return false;
			}
			if($("#to_date").val()=="" && $("#from_date").val()!="")
			{
				$("#to_date").attr("placeholder", "Please Select To Date.");
				$("#to_date").addClass("error_textbox");
				$("#to_date").focus();
				//errr=1;
				return false;
			}
			
			var agent=$('#agent').val();
			if($("#radio_salesman").is(":checked"))
			{
				if($("#agent").val()=="" && $("#to_date").val()=="" && $("#from_date").val()=="")
				errr=1;
			}
			else if($("#radio_delivery").is(":checked"))
			{
				if($("#delivery_destination_state").val()=="" && $("#delivery_destination_city").val()=="")
				errr=1;
				
			}
			else if($("#radio_branch").is(":checked"))
			{
				if($("#source_branch").val()=="")
				errr=1;
				
			}
			else
			{
				if($("#source_state").val()=="" && $("#source_city").val()=="" && $("#destination_state").val()=="" && $("#destination_city").val()=="" && $("#to_date").val()=="" && $("#from_date").val()=="")
				errr=1;
			}
		}
		
		if(errr==0)
		{
			
			$('#error_div_search').hide();
			var report_type=""; var table_title='';
			var source_city='';
			if($("#source_city").val()!='')
				source_city=$("#source_city").val()+'<br>';
			if($("#radio_outgoing").is(":checked"))
			{
				report_type='Outgoin'; 
				table_title='<h3>Track Sheet</h3><br/>';
				table_title+='From: '+$("#source_city option:selected").text();
				table_title+='To: '+$("#destination_city option:selected").text();
				table_title=table_title+'<br/>';
				if($("#from_date").val()!='')
					table_title=table_title+' From Date: '+$("#from_date").val();
				if($("#from_date").val()!='')
					table_title=table_title+' To Date: '+$("#to_date").val();
				
			}
			else if($("#radio_shipment").is(":checked"))
			{
				report_type='Shipment';
			}
			else if($("#radio_expense").is(":checked"))
			{
				report_type='Expense';
			}
			else if($("#radio_salesman").is(":checked"))
			{
				report_type='Salesman';
			}
			else if($("#radio_business").is(":checked"))
			{
				
				report_type='Business';
				
			}
			else if($("#radio_delivery").is(":checked"))
			{
				report_type='Delivery';
			}
			else if($("#radio_branch").is(":checked"))
			{
				report_type='Branch';
			}
			else if($("#radio_employee").is(":checked"))
			{
				report_type='Employee';
			}
            else if($("#radio_self").is(":checked"))
            {
                report_type='Self';
            }
			
			var from_date='';
			var to_date='';
			
			if($("#radio_today").is(":checked"))
			{
				from_date='<?php echo date('m/d/Y')?>';
				to_date='<?php echo date('m/d/Y')?>';
			}
			else
			{
				from_date=$('#from_date').val();
				to_date=$('#to_date').val();
			}
			var source_state=$('#source_state').val();
			var source_city=$('#source_city').val();
			
			var destination_state=$('#destination_state').val();
			var destination_city=$('#destination_city').val();

            var area=$('#area').val();
            var dest_area=$('#dest_area').val();

            //var agent=$('#agent').val();

            //alert(agent);
			
			//alert(destination_city+'dsfdsfsd'+destination_state);
			
			
			if(report_type=='Outgoin')
			{
				if(destination_state=="" && destination_city=="")
				{
					report_type='Outgoing';
					var data,
					tableName= '#demotable',
					columns,
					str,
					jqxhr = $.ajax('admin_ajax.php?action=get_report&report='+report_type+'&from_date='+from_date+'&to_date='+to_date+'&source_state='+source_state+'&source_city='+source_city)
							.done(function () {
								data = JSON.parse(jqxhr.responseText);
	
					// Iterate each column and print table headers for Datatables
					
							// Debug? console.log(data.columns[0]);
					$(tableName).append('<caption style="caption-side: top">'+table_title+'</caption>');
					console.log($.fn.dataTable.isDataTable("#demotable")); // Returns true
					console.log($.fn.dataTable.isDataTable(tableName)); 
					if($.fn.dataTable.isDataTable("#demotable"))
					{
						
						$('#demotable').DataTable().clear().destroy();
						$('#dtable_hide').html(' ');
						$('#dtable_hide').html('<table id="demotable" class="table table-condensed dataTable table-hover"><thead><tr></tr></thead></table>');
						$.each(data.columns, function (k, colObj) 
							{ 
								str = '<th>' + colObj.name + '</th>';
								$(str).appendTo(tableName+'>thead>tr');
							});
							data.columns[0].render = function (data, type, row) 
							{
								return '<h4>' + data + '</h4>';
							}
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					else
					{
						$.each(data.columns, function (k, colObj) {
						str = '<th>' + colObj.name + '</th>';
						
							$(str).appendTo(tableName+'>thead>tr');
						});
						
						data.columns[0].render = function (data, type, row) {
							return '<h4>' + data + '</h4>';
						}
						
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					
					})
					.fail(function (jqXHR, exception) {
									var msg = '';
									if (jqXHR.status === 0) {
										msg = 'Not connect.\n Verify Network.';
									} else if (jqXHR.status == 404) {
										msg = 'Requested page not found. [404]';
									} else if (jqXHR.status == 500) {
										msg = 'Internal Server Error [500].';
									} else if (exception === 'parsererror') {
										msg = 'Requested JSON parse failed.';
									} else if (exception === 'timeout') {
										msg = 'Time out error.';
									} else if (exception === 'abort') {
										msg = 'Ajax request aborted.';
									} else {
										msg = 'Uncaught Error.\n' + jqXHR.responseText;
									}
						console.log(msg);
					});
					
				}
				else 
				{
					report_type='Outgoing';
					var data='',
					tableName= '#demotable',
					columns='',
					str,
					jqxhr = $.ajax('admin_ajax.php?action=get_report&report='+report_type+'&from_date='+from_date+'&to_date='+to_date+'&source_state='+source_state+'&source_city='+source_city+'&destination_state='+destination_state+'&destination_city='+destination_city)
					.done(function () {
						data = JSON.parse(jqxhr.responseText);
						console.log('dattaaaa'+data);
						// Iterate each column and print table headers for Datatables
						
						// Debug? console.log(data.columns[0]);
						$(tableName).append('<caption style="caption-side: top">'+table_title+'</caption>');
						console.log($.fn.dataTable.isDataTable("#demotable")); // Returns true
						console.log($.fn.dataTable.isDataTable(tableName)); 
						if($.fn.dataTable.isDataTable("#demotable"))
						{
							$('#demotable').DataTable().clear().destroy();
							$('#dtable_hide').html(' ');
							$('#dtable_hide').html('<table id="demotable" class="table table-condensed dataTable table-hover"><thead><tr></tr></thead></table>');
							$.each(data.columns, function (k, colObj) 
							{ 
								str = '<th>' + colObj.name + '</th>';
								$(str).appendTo(tableName+'>thead>tr');
							});
							data.columns[0].render = function (data, type, row) 
							{
								return '<h4>' + data + '</h4>';
							}
							$(tableName).dataTable({
								"data": data.data,
								"columns": data.columns,
								"order": [],
								dom: 'Bfrtip',
								buttons: [
									'copy', 'csv', 'excel', 'pdf', 'print'
								],
								"fnInitComplete": function () {
									console.log('Datatable rendering complete');
								}
							});
						}
						else
						{
							$.each(data.columns, function (k, colObj) 
							{ 
								str = '<th>' + colObj.name + '</th>';
								$(str).appendTo(tableName+'>thead>tr');
							});
							data.columns[0].render = function (data, type, row) 
							{
								return '<h4>' + data + '</h4>';
							}
							$(tableName).dataTable({
								"data": data.data,
								"columns": data.columns,
								"order": [],
								dom: 'Bfrtip',
								buttons: [
									'copy', 'csv', 'excel', 'pdf', 'print'
								],
								"fnInitComplete": function () {
									console.log('Datatable rendering complete');
								}
							});
						}
					})
					.fail(function (jqXHR, exception) 
					{
						var msg = '';
						if (jqXHR.status === 0) 
						{
							msg = 'Not connect.\n Verify Network.';
						} else if (jqXHR.status == 404) {
							msg = 'Requested page not found. [404]';
						} else if (jqXHR.status == 500) {
							msg = 'Internal Server Error [500].';
						} else if (exception === 'parsererror') {
							msg = 'Requested JSON parse failed.';
						} else if (exception === 'timeout') {
							msg = 'Time out error.';
						} else if (exception === 'abort') {
							msg = 'Ajax request aborted.';
						} else {
							msg = 'Uncaught Error.\n' + jqXHR.responseText;
						}
						console.log(msg);
					});
				}
			}
			else if(report_type=='Shipment')
			{
				
				if(destination_state=="" && destination_city=="")
				{
					report_type='Shipment to All';
					var data,
					tableName= '#demotable',
					columns,
					str,
					jqxhr = $.ajax('admin_ajax.php?action=get_report&report='+report_type+'&from_date='+from_date+'&to_date='+to_date+'&source_state='+source_state+'&source_city='+source_city)
							.done(function () {
								data = JSON.parse(jqxhr.responseText);
					$(tableName).append('<caption style="caption-side: top">'+table_title+'</caption>');
					console.log($.fn.dataTable.isDataTable("#demotable")); // Returns true
					console.log($.fn.dataTable.isDataTable(tableName)); 
					if($.fn.dataTable.isDataTable("#demotable"))
					{
						
						$('#demotable').DataTable().clear().destroy();
						$('#dtable_hide').html(' ');
						$('#dtable_hide').html('<table id="demotable" class="table table-condensed dataTable table-hover"><thead><tr></tr></thead></table>');
						$.each(data.columns, function (k, colObj) 
							{ 
								str = '<th>' + colObj.name + '</th>';
								$(str).appendTo(tableName+'>thead>tr');
							});
							data.columns[0].render = function (data, type, row) 
							{
								return '<h4>' + data + '</h4>';
							}
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					else
					{
						$.each(data.columns, function (k, colObj) {
						str = '<th>' + colObj.name + '</th>';
						
							$(str).appendTo(tableName+'>thead>tr');
						});
						
						data.columns[0].render = function (data, type, row) {
							return '<h4>' + data + '</h4>';
						}
						
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					
					})
					.fail(function (jqXHR, exception) {
									var msg = '';
									if (jqXHR.status === 0) {
										msg = 'Not connect.\n Verify Network.';
									} else if (jqXHR.status == 404) {
										msg = 'Requested page not found. [404]';
									} else if (jqXHR.status == 500) {
										msg = 'Internal Server Error [500].';
									} else if (exception === 'parsererror') {
										msg = 'Requested JSON parse failed.';
									} else if (exception === 'timeout') {
										msg = 'Time out error.';
									} else if (exception === 'abort') {
										msg = 'Ajax request aborted.';
									} else {
										msg = 'Uncaught Error.\n' + jqXHR.responseText;
									}
						console.log(msg);
					});
					
					
					/*var data,
					tableName= '#demotable',
					columns,
					str,
					jqxhr = $.ajax('admin_ajax.php?action=get_report&report='+report_type+'&from_date='+from_date+'&to_date='+to_date+'&source_state='+source_state+'&source_city='+source_city)
							.done(function () {
								data = JSON.parse(jqxhr.responseText);
					$(tableName).append('<caption style="caption-side: top">'+table_title+'</caption>');
					console.log($.fn.dataTable.isDataTable("#demotable")); // Returns true
					console.log($.fn.dataTable.isDataTable(tableName)); 
					if($.fn.dataTable.isDataTable("#demotable"))
					{
						$('#demotable').DataTable().clear().destroy();
						$('#dtable_hide').html(' ');
						$('#dtable_hide').html('<table id="demotable" class="table table-condensed dataTable table-hover"><thead><tr></tr></thead></table>');
						$.each(data.columns, function (k, colObj) 
							{ 
								str = '<th>' + colObj.name + '</th>';
								$(str).appendTo(tableName+'>thead>tr');
							});
							data.columns[0].render = function (data, type, row) 
							{
								return '<h4>' + data + '</h4>';
							}
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					else
					{
						$.each(data.columns, function (k, colObj) {
						str = '<th>' + colObj.name + '</th>';
						
							$(str).appendTo(tableName+'>thead>tr');
						});
						
						data.columns[0].render = function (data, type, row) {
							return '<h4>' + data + '</h4>';
						}
						
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					
					})
					.fail(function (jqXHR, exception) {
									var msg = '';
									if (jqXHR.status === 0) {
										msg = 'Not connect.\n Verify Network.';
									} else if (jqXHR.status == 404) {
										msg = 'Requested page not found. [404]';
									} else if (jqXHR.status == 500) {
										msg = 'Internal Server Error [500].';
									} else if (exception === 'parsererror') {
										msg = 'Requested JSON parse failed.';
									} else if (exception === 'timeout') {
										msg = 'Time out error.';
									} else if (exception === 'abort') {
										msg = 'Ajax request aborted.';
									} else {
										msg = 'Uncaught Error.\n' + jqXHR.responseText;
									}
						console.log(msg);
					});*/
				}
				else 
				{
					
					report_type='Shipment';
					
					var data,
					tableName= '#demotable',
					columns,
					str,
					jqxhr = $.ajax('admin_ajax.php?action=get_report&report='+report_type+'&from_date='+from_date+'&to_date='+to_date+'&source_state='+source_state+'&source_city='+source_city+'&destination_state='+destination_state+'&destination_city='+destination_city)
							.done(function () {
								data = JSON.parse(jqxhr.responseText);
					$(tableName).append('<caption style="caption-side: top">'+table_title+'</caption>');
					console.log($.fn.dataTable.isDataTable("#demotable")); // Returns true
					console.log($.fn.dataTable.isDataTable(tableName)); 
					if($.fn.dataTable.isDataTable("#demotable"))
					{
						
						$('#demotable').DataTable().clear().destroy();
						$('#dtable_hide').html(' ');
						$('#dtable_hide').html('<table id="demotable" class="table table-condensed dataTable table-hover"><thead><tr></tr></thead></table>');
						$.each(data.columns, function (k, colObj) 
							{ 
								str = '<th>' + colObj.name + '</th>';
								$(str).appendTo(tableName+'>thead>tr');
							});
							data.columns[0].render = function (data, type, row) 
							{
								return '<h4>' + data + '</h4>';
							}
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					else
					{
						$.each(data.columns, function (k, colObj) {
						str = '<th>' + colObj.name + '</th>';
						
							$(str).appendTo(tableName+'>thead>tr');
						});
						
						data.columns[0].render = function (data, type, row) {
							return '<h4>' + data + '</h4>';
						}
						
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					
					})
					.fail(function (jqXHR, exception) {
									var msg = '';
									if (jqXHR.status === 0) {
										msg = 'Not connect.\n Verify Network.';
									} else if (jqXHR.status == 404) {
										msg = 'Requested page not found. [404]';
									} else if (jqXHR.status == 500) {
										msg = 'Internal Server Error [500].';
									} else if (exception === 'parsererror') {
										msg = 'Requested JSON parse failed.';
									} else if (exception === 'timeout') {
										msg = 'Time out error.';
									} else if (exception === 'abort') {
										msg = 'Ajax request aborted.';
									} else {
										msg = 'Uncaught Error.\n' + jqXHR.responseText;
									}
						console.log(msg);
					});
					
					/*$.ajax({
					type: "POST",
					url: '<?php //echo $site_url; ?>admin_ajax.php?action=get_report',
					data:{action:'get_report',report:report_type,source_state:source_state,source_city:source_city,destination_state:destination_state,destination_city:destination_city},
					 success: function(data)
					 {
						 alert(data);
					 }
					});*/
					
					/*var data,
					tableName= '#demotable',
					columns,
					str,
					jqxhr = $.ajax('admin_ajax.php?action=get_report&report='+report_type+'&from_date='+from_date+'&to_date='+to_date+'&source_state='+source_state+'&source_city='+source_city)
							.done(function () {
								data = JSON.parse(jqxhr.responseText); 
					$(tableName).append('<caption style="caption-side: top">'+table_title+'</caption>');
					console.log($.fn.dataTable.isDataTable("#demotable")); // Returns true
					console.log($.fn.dataTable.isDataTable(tableName)); 
					if($.fn.dataTable.isDataTable("#demotable"))
					{
						$('#demotable').DataTable().clear().destroy();
						$('#dtable_hide').html(' ');
						$('#dtable_hide').html('<table id="demotable" class="table table-condensed dataTable table-hover"><thead><tr></tr></thead></table>');
						$.each(data.columns, function (k, colObj) 
							{ 
								str = '<th>' + colObj.name + '</th>';
								$(str).appendTo(tableName+'>thead>tr');
							});
							data.columns[0].render = function (data, type, row) 
							{
								return '<h4>' + data + '</h4>';
							}
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					else
					{
						$.each(data.columns, function (k, colObj) {
						str = '<th>' + colObj.name + '</th>';
						
							$(str).appendTo(tableName+'>thead>tr');
						});
						
						data.columns[0].render = function (data, type, row) {
							return '<h4>' + data + '</h4>';
						}
						
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					
					})
					.fail(function (jqXHR, exception) {
									var msg = '';
									if (jqXHR.status === 0) {
										msg = 'Not connect.\n Verify Network.';
									} else if (jqXHR.status == 404) {
										msg = 'Requested page not found. [404]';
									} else if (jqXHR.status == 500) {
										msg = 'Internal Server Error [500].';
									} else if (exception === 'parsererror') {
										msg = 'Requested JSON parse failed.';
									} else if (exception === 'timeout') {
										msg = 'Time out error.';
									} else if (exception === 'abort') {
										msg = 'Ajax request aborted.';
									} else {
										msg = 'Uncaught Error.\n' + jqXHR.responseText;
									}
						console.log(msg);
					});*/
				}
			}
			else if(report_type=='Expense')
			{
				var table_title='Expense in all Region';
				report_type='Expense';
				var data,
				tableName= '#demotable',
				columns,
				str,
				jqxhr = $.ajax('admin_ajax.php?action=get_report&report='+report_type+'&from_date='+from_date+'&to_date='+to_date)
				.done(function () {
					data = JSON.parse(jqxhr.responseText); 
					$(tableName).append('<caption style="caption-side: top">'+table_title+'</caption>');
					console.log($.fn.dataTable.isDataTable("#demotable")); // Returns true
					console.log($.fn.dataTable.isDataTable(tableName)); 
					if($.fn.dataTable.isDataTable("#demotable"))
					{
						
						$('#demotable').DataTable().clear().destroy();
						$('#dtable_hide').html(' ');
						$('#dtable_hide').html('<table id="demotable" class="table table-condensed dataTable table-hover"><thead><tr></tr></thead></table>');
						$.each(data.columns, function (k, colObj) 
							{
								str = '<th>' + colObj.name + '</th>';
								$(str).appendTo(tableName+'>thead>tr');
							});
							data.columns[0].render = function (data, type, row) 
							{
								return '<h4>' + data + '</h4>';
							}
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					else
					{
						$.each(data.columns, function (k, colObj) {
						str = '<th>' + colObj.name + '</th>';
						
							$(str).appendTo(tableName+'>thead>tr');
						});
						
						data.columns[0].render = function (data, type, row) {
							return '<h4>' + data + '</h4>';
						}
						
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					
					})
					.fail(function (jqXHR, exception) {
									var msg = '';
									if (jqXHR.status === 0) {
										msg = 'Not connect.\n Verify Network.';
									} else if (jqXHR.status == 404) {
										msg = 'Requested page not found. [404]';
									} else if (jqXHR.status == 500) {
										msg = 'Internal Server Error [500].';
									} else if (exception === 'parsererror') {
										msg = 'Requested JSON parse failed.';
									} else if (exception === 'timeout') {
										msg = 'Time out error.';
									} else if (exception === 'abort') {
										msg = 'Ajax request aborted.';
									} else {
										msg = 'Uncaught Error.\n' + jqXHR.responseText;
									}
						console.log(msg);
					});
					
			}
			else if(report_type=='Salesman')
			{
				var agent=$('#desti_salesman').val();
				
				var table_title='Summary of Salesman Daily Business Report - From: '+from_date+' To: '+to_date;
				report_type='Salesman';
				var data,
				tableName= '#demotable',
				columns,
				str,
				jqxhr = $.ajax('admin_ajax.php?action=get_report&report='+report_type+'&from_date='+from_date+'&to_date='+to_date+'&agentid='+agent)
				.done(function () {
					data = JSON.parse(jqxhr.responseText); 
					$(tableName).append('<caption style="caption-side: top">'+table_title+'</caption>');
					console.log($.fn.dataTable.isDataTable("#demotable")); // Returns true
					console.log($.fn.dataTable.isDataTable(tableName)); 
					if($.fn.dataTable.isDataTable("#demotable"))
					{
						
						$('#demotable').DataTable().clear().destroy();
						$('#dtable_hide').html(' ');
						$('#dtable_hide').html('<table id="demotable" class="table table-condensed dataTable table-hover"><thead><tr></tr></thead></table>');
						$.each(data.columns, function (k, colObj) 
							{ 
								str = '<th>' + colObj.name + '</th>';
								$(str).appendTo(tableName+'>thead>tr');
							});
							data.columns[0].render = function (data, type, row) 
							{
								return '<h4>' + data + '</h4>';
							}
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					else
					{
						$.each(data.columns, function (k, colObj) {
						str = '<th>' + colObj.name + '</th>';
						
							$(str).appendTo(tableName+'>thead>tr');
						});
						
						data.columns[0].render = function (data, type, row) {
							return '<h4>' + data + '</h4>';
						}
						
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					
					})
					.fail(function (jqXHR, exception) {
									var msg = '';
									if (jqXHR.status === 0) {
										msg = 'Not connect.\n Verify Network.';
									} else if (jqXHR.status == 404) {
										msg = 'Requested page not found. [404]';
									} else if (jqXHR.status == 500) {
										msg = 'Internal Server Error [500].';
									} else if (exception === 'parsererror') {
										msg = 'Requested JSON parse failed.';
									} else if (exception === 'timeout') {
										msg = 'Time out error.';
									} else if (exception === 'abort') {
										msg = 'Ajax request aborted.';
									} else {
										msg = 'Uncaught Error.\n' + jqXHR.responseText;
									}
						console.log(msg);
					});
					
			}
			else if(report_type=='Business')
			{
				 
				var table_title='All region business report - From: '+from_date+' To: '+to_date;
				report_type='Business';
				var data,
				tableName= '#demotable',
				columns,
				str,
				jqxhr = $.ajax('admin_ajax.php?action=get_report&report='+report_type+'&from_date='+from_date+'&to_date='+to_date)
				.done(function () {
					data = JSON.parse(jqxhr.responseText); 
					$(tableName).append('<caption style="caption-side: top">'+table_title+'</caption>');
					console.log($.fn.dataTable.isDataTable("#demotable")); // Returns true
					console.log($.fn.dataTable.isDataTable(tableName)); 
					if($.fn.dataTable.isDataTable("#demotable"))
					{
						
						$('#demotable').DataTable().clear().destroy();
						$('#dtable_hide').html(' ');
						$('#dtable_hide').html('<table id="demotable" class="table table-condensed dataTable table-hover"><thead><tr></tr></thead></table>');
						$.each(data.columns, function (k, colObj) 
							{ 
								str = '<th>' + colObj.name + '</th>';
								$(str).appendTo(tableName+'>thead>tr');
							});
							data.columns[0].render = function (data, type, row) 
							{
								return '<h4>' + data + '</h4>';
							}
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					else
					{
						$.each(data.columns, function (k, colObj) {
						str = '<th>' + colObj.name + '</th>';
						
							$(str).appendTo(tableName+'>thead>tr');
						});
						
						data.columns[0].render = function (data, type, row) {
							return '<h4>' + data + '</h4>';
						}
						
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					
					})
					.fail(function (jqXHR, exception) {
									var msg = '';
									if (jqXHR.status === 0) {
										msg = 'Not connect.\n Verify Network.';
									} else if (jqXHR.status == 404) {
										msg = 'Requested page not found. [404]';
									} else if (jqXHR.status == 500) {
										msg = 'Internal Server Error [500].';
									} else if (exception === 'parsererror') {
										msg = 'Requested JSON parse failed.';
									} else if (exception === 'timeout') {
										msg = 'Time out error.';
									} else if (exception === 'abort') {
										msg = 'Ajax request aborted.';
									} else {
										msg = 'Uncaught Error.\n' + jqXHR.responseText;
									}
						console.log(msg);
					});
					
			}
			else if(report_type=='Delivery')
			{
                
				var destination_state=$('#delivery_destination_state').val();
				var destination_city=$('#delivery_destination_city').val();
				
				var table_title='Delivery Note - From: '+from_date+' To: '+to_date;
				report_type='Delivery';
				var data,
				tableName= '#demotable',
				columns,
				str,
				jqxhr = $.ajax('admin_ajax.php?action=get_report&report='+report_type+'&from_date='+from_date+'&to_date='+to_date+'&destination_state='+destination_state+'&destination_city='+destination_city)
				.done(function () {
					data = JSON.parse(jqxhr.responseText); 
					$(tableName).append('<caption style="caption-side: top">'+table_title+'</caption>');
					console.log($.fn.dataTable.isDataTable("#demotable")); // Returns true
					console.log($.fn.dataTable.isDataTable(tableName)); 
					if($.fn.dataTable.isDataTable("#demotable"))
					{
						
						$('#demotable').DataTable().clear().destroy();
						$('#dtable_hide').html(' ');
						$('#dtable_hide').html('<table id="demotable" class="table table-condensed dataTable table-hover"><thead><tr></tr></thead></table>');
						$.each(data.columns, function (k, colObj) 
							{ 
								str = '<th>' + colObj.name + '</th>';
								$(str).appendTo(tableName+'>thead>tr');
							});
							data.columns[0].render = function (data, type, row) 
							{
								return '<h4>' + data + '</h4>';
							}
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					else
					{
						$.each(data.columns, function (k, colObj) {
						str = '<th>' + colObj.name + '</th>';
						
							$(str).appendTo(tableName+'>thead>tr');
						});
						
						data.columns[0].render = function (data, type, row) {
							return '<h4>' + data + '</h4>';
						}
						
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					
					})
					.fail(function (jqXHR, exception) {
									var msg = '';
									if (jqXHR.status === 0) {
										msg = 'Not connect.\n Verify Network.';
									} else if (jqXHR.status == 404) {
										msg = 'Requested page not found. [404]';
									} else if (jqXHR.status == 500) {
										msg = 'Internal Server Error [500].';
									} else if (exception === 'parsererror') {
										msg = 'Requested JSON parse failed.';
									} else if (exception === 'timeout') {
										msg = 'Time out error.';
									} else if (exception === 'abort') {
										msg = 'Ajax request aborted.';
									} else {
										msg = 'Uncaught Error.\n' + jqXHR.responseText;
									}
						console.log(msg);
					});
					
			}
			else if(report_type=='Branch')
			{
				var destination_state=$("#source_branch option:selected").text();
				var branch=$('#source_branch').val();
				var table_title='Branch - '+destination_state+', Head Office';
				report_type='Branch';
				var data,
				tableName= '#demotable',
				columns,
				str,
				jqxhr = $.ajax('admin_ajax.php?action=get_report&report='+report_type+'&from_date='+from_date+'&to_date='+to_date+'&source_branch='+branch)
				.done(function () {
					data = JSON.parse(jqxhr.responseText); 
					$(tableName).append('<caption style="caption-side: top">'+table_title+'</caption>');
					console.log($.fn.dataTable.isDataTable("#demotable")); // Returns true
					console.log($.fn.dataTable.isDataTable(tableName)); 
					if($.fn.dataTable.isDataTable("#demotable"))
					{
						
						$('#demotable').DataTable().clear().destroy();
						$('#dtable_hide').html(' ');
						$('#dtable_hide').html('<table id="demotable" class="table table-condensed dataTable table-hover"><thead><tr></tr></thead></table>');
						$.each(data.columns, function (k, colObj) 
							{ 
								str = '<th>' + colObj.name + '</th>';
								$(str).appendTo(tableName+'>thead>tr');
							});
							data.columns[0].render = function (data, type, row) 
							{
								return '<h4>' + data + '</h4>';
							}
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					else
					{
						$.each(data.columns, function (k, colObj) {
						str = '<th>' + colObj.name + '</th>';
						
							$(str).appendTo(tableName+'>thead>tr');
						});
						
						data.columns[0].render = function (data, type, row) {
							return '<h4>' + data + '</h4>';
						}
						
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					
					})
					.fail(function (jqXHR, exception) {
									var msg = '';
									if (jqXHR.status === 0) {
										msg = 'Not connect.\n Verify Network.';
									} else if (jqXHR.status == 404) {
										msg = 'Requested page not found. [404]';
									} else if (jqXHR.status == 500) {
										msg = 'Internal Server Error [500].';
									} else if (exception === 'parsererror') {
										msg = 'Requested JSON parse failed.';
									} else if (exception === 'timeout') {
										msg = 'Time out error.';
									} else if (exception === 'abort') {
										msg = 'Ajax request aborted.';
									} else {
										msg = 'Uncaught Error.\n' + jqXHR.responseText;
									}
						console.log(msg);
					});
					
			}
			else if(report_type=='Employee')
			{
				var destination_state=$("#employee option:selected").text();
				var branch=$('#employee').val();
				var table_title='Employee - '+destination_state;
				report_type='Employee';
				var data,
				tableName= '#demotable',
				columns,
				str,
				jqxhr = $.ajax('admin_ajax.php?action=get_report&report='+report_type+'&from_date='+from_date+'&to_date='+to_date+'&source_branch='+branch)
				.done(function () {
					data = JSON.parse(jqxhr.responseText); 
					$(tableName).append('<caption style="caption-side: top">'+table_title+'</caption>');
					console.log($.fn.dataTable.isDataTable("#demotable")); // Returns true
					console.log($.fn.dataTable.isDataTable(tableName)); 
					if($.fn.dataTable.isDataTable("#demotable"))
					{
						
						$('#demotable').DataTable().clear().destroy();
						$('#dtable_hide').html(' ');
						$('#dtable_hide').html('<table id="demotable" class="table table-condensed dataTable table-hover"><thead><tr></tr></thead></table>');
						$.each(data.columns, function (k, colObj) 
							{ 
								str = '<th>' + colObj.name + '</th>';
								$(str).appendTo(tableName+'>thead>tr');
							});
							data.columns[0].render = function (data, type, row) 
							{
								return '<h4>' + data + '</h4>';
							}
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					else
					{
						$.each(data.columns, function (k, colObj) {
						str = '<th>' + colObj.name + '</th>';
						
							$(str).appendTo(tableName+'>thead>tr');
						});
						
						data.columns[0].render = function (data, type, row) {
							return '<h4>' + data + '</h4>';
						}
						
						$(tableName).dataTable({
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							console.log('Datatable rendering complete');
							}
						});
					}
					
					})
					.fail(function (jqXHR, exception) {
									var msg = '';
									if (jqXHR.status === 0) {
										msg = 'Not connect.\n Verify Network.';
									} else if (jqXHR.status == 404) {
										msg = 'Requested page not found. [404]';
									} else if (jqXHR.status == 500) {
										msg = 'Internal Server Error [500].';
									} else if (exception === 'parsererror') {
										msg = 'Requested JSON parse failed.';
									} else if (exception === 'timeout') {
										msg = 'Time out error.';
									} else if (exception === 'abort') {
										msg = 'Ajax request aborted.';
									} else {
										msg = 'Uncaught Error.\n' + jqXHR.responseText;
									}
						console.log(msg);
					});
					
			}
            else if(report_type=='Self')
            {
                var table_title='Summary of Self Report - From: '+from_date+' To: '+to_date;
                var agent ="<?php echo $userdetail; ?>";
                var lgn_type ="<?php echo $type; ?>";

                alert(agent);

                report_type='Self';
                var data,
                tableName= '#demotable',
                columns,
                str,
                jqxhr = $.ajax('admin_ajax.php?action=get_report&report='+report_type+'&from_date='+from_date+'&to_date='+to_date+'&agentid='+agent+'&type='+lgn_type)
                .done(function () {
                    data = JSON.parse(jqxhr.responseText); 
                    $(tableName).append('<caption style="caption-side: top">'+table_title+'</caption>');
                    console.log($.fn.dataTable.isDataTable("#demotable")); // Returns true
                    console.log($.fn.dataTable.isDataTable(tableName)); 
                    if($.fn.dataTable.isDataTable("#demotable"))
                    {
                        
                        $('#demotable').DataTable().clear().destroy();
                        $('#dtable_hide').html(' ');
                        $('#dtable_hide').html('<table id="demotable" class="table table-condensed dataTable table-hover"><thead><tr></tr></thead></table>');
                        $.each(data.columns, function (k, colObj) 
                            { 
                                str = '<th>' + colObj.name + '</th>';
                                $(str).appendTo(tableName+'>thead>tr');
                            });
                            data.columns[0].render = function (data, type, row) 
                            {
                                return '<h4>' + data + '</h4>';
                            }
                        $(tableName).dataTable({
                        "data": data.data,
                        "columns": data.columns,
                        "order": [],
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        "fnInitComplete": function () {
                            // Event handler to be fired when rendering is complete (Turn off Loading gif for example)
                            console.log('Datatable rendering complete');
                            }
                        });
                    }
                    else
                    {
                        $.each(data.columns, function (k, colObj) {
                        str = '<th>' + colObj.name + '</th>';
                        
                            $(str).appendTo(tableName+'>thead>tr');
                        });
                        
                        data.columns[0].render = function (data, type, row) {
                            return '<h4>' + data + '</h4>';
                        }
                        
                        $(tableName).dataTable({
                        "data": data.data,
                        "columns": data.columns,
                        "order": [],
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        "fnInitComplete": function () {
                            // Event handler to be fired when rendering is complete (Turn off Loading gif for example)
                            console.log('Datatable rendering complete');
                            }
                        });
                    }
                    
                    })
                    .fail(function (jqXHR, exception) {
                                    var msg = '';
                                    if (jqXHR.status === 0) {
                                        msg = 'Not connect.\n Verify Network.';
                                    } else if (jqXHR.status == 404) {
                                        msg = 'Requested page not found. [404]';
                                    } else if (jqXHR.status == 500) {
                                        msg = 'Internal Server Error [500].';
                                    } else if (exception === 'parsererror') {
                                        msg = 'Requested JSON parse failed.';
                                    } else if (exception === 'timeout') {
                                        msg = 'Time out error.';
                                    } else if (exception === 'abort') {
                                        msg = 'Ajax request aborted.';
                                    } else {
                                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                                    }
                        console.log(msg);
                    });
                    
            }
			
		}
		else
		{
			$('#error_div_search').show();
			return false;
		}
	});
	
});


function get_state(val,fld)
{
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{country:val,action:'get_state'},
	 success: function(data)
	 {	
	 	if(data.trim()=='Not Found')
		{
			$("#"+fld).html('<option value="">Select</option>');  
		}
		else if(data.trim()=='blank')
		{
			$("#"+fld).html('<option value="">Select</option>');  
		}
		else
		{
			$("#"+fld).html(data); 
		}
	  }
	});
}
function get_city(val,fld)
{ 
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{state:val,action:'get_city'},
	 success: function(data)
	 {	
	 	if(data.trim()=='Not Found')
		{
			$("#"+fld).html('<option value="">Select</option>');  
		}
		else if(data.trim()=='blank')
		{
			$("#"+fld).html('<option value="">Select</option>');  
		}
		else
		{
			$("#"+fld).html(data); 
		}
	  }
	});
}
function save_city(fld)
{
	$('#cstm_city').val(fld);
}


</script>