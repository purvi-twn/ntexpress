<?php include("header.php"); 
include 'phpqrcode/qrlib.php';
//require('pdf/fpdf.php');

if(@$_REQUEST['id']!='')
{
	$id = $_REQUEST['id'];

	// sender detail 
	$query = fetch_query("*","customers",array("id="=>$id));

	$sname = $query['name'];
	$mno = $query['mno'];
	$email = $query['email'];
	$state = $query['state'];
	$city = $query['city'];
	$address = $query['address'];

	$invoice_number="";
	$rows = fetch_query("*","shipment",""," id desc limit 1");
	if($rows['invoice_number']!='')
		$invoice_number=sprintf("%06d", $rows['invoice_number']+1);
	else
		$invoice_number=100001;

	$consignment_no=date('His');

	$staff_person="";$dept_person="";$branch_person="";
	if(isset($_SESSION['ntexpress_retrostaff']))
	{	
		$staff_person=$_SESSION['ntexpress_retrostaff'];
	}
	elseif(isset($_SESSION['ntexpress_retroadm']))
	{
		$staff_person=$_SESSION['ntexpress_retroadm'];
	}
	if(isset($_SESSION['ntexpress_retrodept_branch']))
	{	
		$dept_person=$_SESSION['ntexpress_retrodept_branch'];
	}
	if(isset($_SESSION['ntexpress_retrobranch']))
	{	
		$branch_person=$_SESSION['ntexpress_retrobranch'];
	}


	// end sender details


	$rows = fetch_query("*","shipment",array("id="=>$id));

	$source_country = $rows['source_country'];
	$source_state = $rows['source_state'];
	$source_address = $rows['source_address'];
	$source_city = $rows['source_city'];
	$destination_country = $rows['destination_country'];
	$destination_state = $rows['destination_state'];
	$destination_city = $rows['destination_city'];
	$destination_address = $rows['destination_address'];
	$no_of_package = $rows['no_of_package'];
	$amount = $rows['amount'];
	$total_amount = $rows['total_amount'];
	$tax_percentage = $rows['tax_percentage'];
	$payment_type = $rows['payment_type'];
	$pagetitle='Edit';
	$total_cash = $rows['payment_cash'];
	$total_fc = $rows['payment_fc'];
	//$shipment_no=$rows['shipment_no'];
	$comment=$rows['comment'];
	
	$sender_deptid=$rows['sender_deptid']; 
	$sender_agentid=$rows['sender_agentid']; 
	$desti_deptid=$rows['desti_deptid']; 
	$desti_agentid=$rows['desti_agentid'];  
	
	$sender_name=$rows['sender_name'];  
	$sender_mobile=$rows['sender_mobile']; 
	$desti_name=$rows['desti_name']; 
	$desti_mobile=$rows['desti_mobile']; 
	$sender_email=$rows['sender_email']; 
	$source_address=$rows['source_address']; 
	$desti_email=$rows['desti_email']; 
	$destination_address=$rows['destination_address'];
	$mode=$rows['mode'];
	$type_of_product=$rows['type_of_product'];
	$delivery_date=date('Y-m-d',strtotime($rows['delivery_date'])); 
	$delivery_time=date('H:i:s',strtotime($rows['delivery_date']));
	$pickup_date=date('Y-m-d',strtotime($rows['pickup_date']));
	$pickup_time=date('H:i:s',strtotime($rows['pickup_date'])); 
	$status=$rows['status']; 
	$barcode_image=$rows['barcode_image'];

	
	//NEW 28-1-21
	$sender_id=$rows['sender_id'];
	$sender_landmark=$rows['sender_landmark'];
	
	$desti_id=$rows['desti_id'];
	$desti_landmark=$rows['desti_landmark'];
	//NEw

	$subtotal_val=$rows['subtotal_val'];
	$vatper_val=$rows['vatper_val'];
	$vattotal_val=$rows['vattotal_val'];
	$finaltotal_val=$rows['finaltotal_val'];
	
	
	$desti_salesman=$rows['desti_salesman'];
	$mode_of_payment=$rows['mode_of_payment'];
	$special_delivery=$rows['special_delivery'];
	$value_of_good=$rows['value_of_good'];
	$delivery_cost=$rows['delivery_cost'];
	
	
}
else   
{
	//$rows = fetch_query("*","shipment",""," id desc limit 1");
	//$invoice_number=sprintf("%05d", $rows['invoice_number']+1);
	
	/*$sel_biggest_ship=$dlink->query("select * from shipment where total_amount!='NaN' and invoice_date='$dt'");
	if($sel_biggest_ship->num_rows>0)
	{
		$invoice_number=sprintf("%06d", $rows['invoice_number']+1);
	}
	else
	{
		//$invoice_number=sprintf("%06d", 1);
		$invoice_number=100001;
	}*/
	$invoice_number="";
	$rows = fetch_query("*","shipment",""," id desc limit 1");
	if($rows['invoice_number']!='')
		$invoice_number=sprintf("%06d", $rows['invoice_number']+1);
	else
		$invoice_number=100001;
	
	
	//$invoice_number="";
	$tax_percentage = '';
	$total_amount = '';
	$payment_type = '';
	$source_city = '';
	$destination_country = '';
	$destination_state = '';
	$destination_city = '';
	$source_state = '';
	$source_country = '';
	$no_of_package = '';
	$source_address = '';
	$amount = '';
	$destination_address ='';
	$pagetitle="Add";
	$total_cach = "";
	$total_fc = "";
	$total_amount="";
	//$shipment_no="";
	$comment="";
	$sender_deptid="";
	$sender_agentid="";
	$desti_deptid="";
	$desti_agentid="";
	$sender_name="";
	$sender_mobile="";
	$desti_name="";
	$desti_mobile="";
	$sender_email="";
	$source_address="";
	$desti_email="";
	$destination_address="";
	$mode="";
	$type_of_product="";
	$delivery_date=""; 
	$delivery_time="";
	$pickup_date="";
	$pickup_time=""; 
	$status=1;
	$barcode_image="";
	$consignment_no=date('His');
	
	//NEW 28-1-21
	$sender_id="";
	$sender_landmark="";
	
	$desti_id="";
	$desti_landmark="";
	//NEw

	//new 30-11-21
	$staff_person="";$dept_person="";$branch_person="";
	if(isset($_SESSION['ntexpress_retrostaff']))
	{	
		$staff_person=$_SESSION['ntexpress_retrostaff'];
	}
	elseif(isset($_SESSION['ntexpress_retroadm']))
	{
		$staff_person=$_SESSION['ntexpress_retroadm'];
	}
	if(isset($_SESSION['ntexpress_retrodept_branch']))
	{	
		$dept_person=$_SESSION['ntexpress_retrodept_branch'];
	}
	if(isset($_SESSION['ntexpress_retrobranch']))
	{	
		$branch_person=$_SESSION['ntexpress_retrobranch'];
	}
	//end new 30-11-21
	
	$desti_salesman="";
	$mode_of_payment="";
	$special_delivery="";
	$value_of_good="";
	$delivery_cost="";
	
}

?>

<?php include("leftpanel.php"); ?>

<style type="text/css">
	.fas.newicon {
	    color: red;
	}
    .grybox {
        padding: 30px;
        background-color: #F2F2F2;
        border-radius: 10px;
        margin: 0px 0px;
    }
    .rdlb {
        color: #D42B2B;
    }
    .grybox lable{ display: inline-block; }
    .grybox input{ display: inline-block; }
	.secondbox
	{
		padding: 15px;
		border-radius: 10px;
	}
	.mb-133
	{
		margin-bottom:22px
	}
	
	#country-list {
		float: left;
		list-style: none;
		margin-top: 0px;
		padding: 0;
		width: 95%;
 		position: absolute;
		border:1px solid #ccc;
		cursor: pointer;
	}
	.form-group li {
		line-height: 1.45;
	}
	#country-list li {
		padding: 10px;
		background: #ffffff;
		border-bottom: #bbb9b9 1px solid;
	}
	#country-list {
		list-style: none;
		z-index:99;
	}
	.fade:not(.show) {
	    display: none;
	}
	a.active.show{
		color: white;
		background: #1e9ff2;
		border-radius: 6px;
	}

</style>
<?php 
		$rows = $dlink->query("select id from shipment order by id desc limit 1");
		$vrows= $rows->fetch_array();
		//$invoice_number=sprintf("%04d", $vrows['id']+1);
		//$invoice_number='';
		?>
<div class="content-wrapper">

    <section class="content-header">

        <!--<h1> Customers Listing </h1>-->

    </section>

    <section class="content pb-10">
       <h3> All Invoice</h3>

	   <!-- Tabs navs -->
       <style>
		   .nav-tabs .nav-link.active, .nav-tabs .nav-link.active:focus, .nav-tabs .nav-link.active:hover, .nav-tabs .nav-item.open .nav-link, .nav-tabs .nav-item.open .nav-link:focus, .nav-tabs .nav-item.open .nav-link:hover {
				color: #fff;
				border-color: transparent;
				border-bottom-color: transparent;
				border-bottom-color: #1e9ff2;
				background-color: #1e9ff2;
			}
			.nav-tabs
			{
				border-bottom:none;
			}
			.nav-item
			{
				background-color: #1e9ff2;
				border-color: #1e9ff2;
				border-radius: 0px;
				color: #fff;
			}
			.nav-link
			{
				width: 150px;
				text-align: center;
			}
			.nav-tabs .nav-link {
				position: relative;
				color: #fff !important; 
				padding: 0.5rem 1.25rem;
				-webkit-transition: 0.5s;
				transition: 0.5s;
				border:none;
			}
			#myTab {
				margin-left: 36%;
				margin-top: 0px;
			}
			.secondtab
			{
				border: 1px solid #ccc;
	    		padding: 10px;
			}
			
			table {
				border-collapse: inherit !important;
			}
			.box-receiver
			{
				 padding-right:0px;
				 padding-left:10px;
			}
			.box-sender-1{
				padding-right:15px;
				padding-left:0px;
			}
			.font-1{
				color: black;
			}
			.font-1:hover{
				color: black;
			}
			.btn-invoice{
				position: relative;
				/* color: #fff !important; */
				padding: 23px 10px;
				-webkit-transition: 0.5s;
				transition: 0.5s;
				border-radius: 9px;
				font-size: 16px;
			}
			.btn-invoice a:hover{
				color: black;
				
			}
			.nav-link-1{
				position: relative;
				color: black;
				padding: 0.5rem 1.25rem;
				-webkit-transition: 0.5s;
				transition: 0.5s;
				border: none;
			}
			.nav-1 > li > a:hover {
				color: #fdfdfd;
				background: #1e9ff2;
				border-radius: 6px;
			}
			.nav-1 > li > a:active{
				color: white !important;
				background: #1e9ff2 !important;
				border-radius: 6px !important;
			}   
			/*.active{
				color: white;
				background: #1e9ff2;
				border-radius: 6px;
			}*/
			.nav > li > a:focus{
				color: white;
				background: #1e9ff2;
				border-radius: 6px;
			}
			.bg-green-1{
				height: 65px;
				background: #d2f5e3;
				border-radius: 5px;
			}
			.nav-1{
				display: -ms-flexbox;
				display: flex;
				-ms-flex-wrap: wrap;
				flex-wrap: wrap;
				padding-left: 0;
				margin-bottom: 0;
				list-style: none;
			}
			.active_manu{
				color: white;
				background: #1e9ff2;
				border-radius: 6px;
			}
			.demo-radio-button{
				display: inline-flex;
			}
			@media screen and (max-width: 400px){
				.table-responsive-1 {
					display: block;
					width: 100%;
					overflow-x: auto;
					-webkit-overflow-scrolling: touch;
					-ms-overflow-style: -ms-autohiding-scrollbar;
				}
				.btn-x{
					color: #fff;
					margin-left: 90px;
				}
				#myTab {
					margin-left: 4% !important;
					margin-top: 0px !important;
				}
				.nav-tabs .nav-item + .nav-item {
					margin-left: 4px;
				}
				.form-control{
					    width: auto;
				}
				.box-sender-1 {
					padding-right: 0px;
					padding-left: 0px;
				}
				.box-receiver {
					padding-right: 0px;
					padding-left: 0px;
				}
				.nav-tabs .nav-item {
					margin-bottom: 7px;
				}
				.btn-invoice{
					font-size: 12px;
				}
				.demo-radio-button {
					display: block;
				}
				
			}
			@media screen and (min-width: 401px) and (max-width: 767px){
				.table-responsive-1 {
					display: block;
					width: 100%;
					overflow-x: auto;
					-webkit-overflow-scrolling: touch;
					-ms-overflow-style: -ms-autohiding-scrollbar;
				}
				.x-11{
					
					margin-top: 4px;
					margin-left: -1%;
				}
				.btn-x{
					color: #fff;
					margin-left: 95px;
				}
				#myTab {
					margin-left: 9% !important;
					margin-top: 0px !important;
				}
				.form-control{
					    width: auto;
				}
				.box-sender-1 {
					padding-right: 0px;
					padding-left: 0px;
				}
				.box-receiver {
					padding-right: 0px;
					padding-left: 0px;
				}
				.btn-invoice{
					font-size: 12px;
				}
				.demo-radio-button {
					display: block;
				}
				
			}
			@media screen and (min-width: 768px) and (max-width: 992px){
				.table-responsive-1 {
					display: block;
					width: 100%;
					overflow-x: auto;
					-webkit-overflow-scrolling: touch;
					-ms-overflow-style: -ms-autohiding-scrollbar;
				}
				.btn-x{
					color: #fff;
					margin-left: 240px;
				}
				.x-11{
					margin-top: 0px;
					margin-left: 23%;
				}
				#myTab {
					margin-left: 27% !important;
					margin-top: 6px !important;
				}
				/*.form-control{
					    width: 100px;
				}*/
				.sp-3{
					margin-left: 35px;
				}
				.sp-4{
					margin-right: 15px;
				}
				.demo-radio-button {
					display: block;
				}
			}
			
			@media screen and (min-width: 1000px) and (max-width: 1100px){
				.btn-x{
					color: #fff;
					margin-left: 261PX;
				}
				.x-11{
					margin-top: 0px;
					margin-left: 23%;
				}
				#myTab {
					margin-left: 30% !important;
					margin-top: 6px !important;
				}
				.demo-radio-button {
					display: block;
				}
			}
		
			.box-sender-1 > h3
			{
				color:#000000 !important;
			}
			.box-receiver > h3
			{
				color:#000000 !important;
			}
	   </style>
       <section>
       		<?php

				if(isset($_SESSION['suc']))

				{ echo session_succ(); }?>

				<div class="alert alert-success" id="error_message" style="display:none;"></div>

				<?php

				if(isset($_SESSION['unsuc']))

				{ echo session(); }?>
				<div class="alert alert-danger" id="error_message" style="display:none;"></div>
                 <form method="post" action="" name="bg" id="bg" enctype="multipart/form-data" autocomplete="off">
           			<div class="tab-content" id="myTabContent">
           				<div class="tab-pane fade active show"  id="home" role="tabpanel" aria-labelledby="home-tab"> 
        		   
                   <div class="grybox mb-20">
                       <div class="row mb-20 sp-4">
                            <div class="col-sm-12 col-md-1">
                                <label><span >Date</span></label>
                            </div>
                            <div class="col-sm-12 col-md-2 sp-3">
                            	<?php date_default_timezone_set("Asia/Riyadh");
								echo date('Y-m-d H:i:s');
								?>
                               <input type="date" name="invoice_date" id="invoice_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-sm-12 col-md-1">
                                <label><span >Invoice#</span></label>
                            </div>
                            <div class="col-sm-12 col-md-2 sp-3">
                                <input type="text" name="invoice_number" id="invoice_number" class="form-control" value="<?php echo $invoice_number; ?>" readonly="readonly">
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <label><span >Consignment Number*</span></label>
                            </div>
                            <div class="col-sm-12 col-md-2 sp-3">
                                <input type="text" name="consignment_no" id="consignment_no" class="form-control" value="<?php echo $consignment_no; ?>" readonly="readonly">
                            </div>
                        </div>
                        <div class="row mb-20 sp-4">
                            <div class="col-sm-12 col-md-1">
                                <label><span >Branch</span></label>
                            </div>
                            <div class="col-sm-12 col-md-2 sp-3">
							<?php
							if(@$_SESSION['ntexpress_retrostaff']!="")
							{ 
								$dept=mysqli_query($dlink,"SELECT * FROM branches where id='".$branch_person."'");
								$dp=mysqli_fetch_assoc($dept);
								echo '<label><span>'.$dp['bname'].'</span></label>';
							?><input type="hidden"  name="branch" id="branch" value="<?php echo $branch_person?>" /><?php
							}
							else
							{ 
								?>
                                <select name="branch" id="branch" class="form-control" onchange="display_dept(this.value,'dept_dept')">
                                        <option value="">Select Branch</option>
                                        <option value="6" selected="selected">Admin Branch</option>
                                        <?php
                                        $dept=mysqli_query($dlink,"SELECT * FROM branches");
                                        while($dp=mysqli_fetch_assoc($dept))
                                        {
                                        ?>
                                        <option <?php if($dp['id']==$branch_person){ ?> selected <?php } ?> value="<?php echo $dp['id']; ?>"><?php echo $dp['bname']; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php
							}
							?>
                            </div>
                            <div class="col-sm-12 col-md-1">
                                <label><span >Department </span></label>
                            </div>
                            <div class="col-sm-12 col-md-2 sp-3">
                            <?php
							if(@$_SESSION['ntexpress_retrostaff']!="")
							{ 
								$dept=mysqli_query($dlink,"SELECT * FROM dept_branch where id='".$dept_person."'");
								$dp=mysqli_fetch_assoc($dept);
								echo '<label><span>'.$dp['new_dept'].'</span></label>';
							?><input type="hidden"  name="dept_dept" id="dept_dept" value="<?php echo $dept_person?>" /><?php
							}
							else
							{ ?>
                                <select name="dept_dept" id="dept_dept" class="form-control">
									<option value="">Select Department</option>
                                    <option value="0" selected="selected">Admin Department</option>
									<?php
									$dept=mysqli_query($dlink,"SELECT * FROM dept_branch");
									while($dp=mysqli_fetch_assoc($dept))
									{ ?>
										<option <?php if($dp['id']==$dept_person){ ?> selected <?php } ?> value="<?php echo $dp['id']; ?>"><?php echo $dp['new_dept']; ?></option>
										<?php 
									} ?>
								</select><?php
							}?>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <label><span >Sales Person</span></label>
                            </div>
                            <div class="col-sm-12 col-md-2 sp-3">
                            <?php
							if(@$_SESSION['ntexpress_retrostaff']!="")
							{ 
								echo '<label><span>'.$staff_person.'</span></label>';
							?><input type="hidden"  name="sales_person" id="sales_person" value="<?php echo $staff_person?>" /><?php
							}
							else
							{ ?>
                                <!-- <input class="form-control" type="text" name="sales_person" value="<?php echo $staff_person; ?>"> -->

                                <select name="sales_person" id="sales_person" class="form-control">
									<option value="">Select Sales Person</option>
                                    <option selected="selected" value="<?php echo $staff_person; ?>"><?php echo $staff_person; ?></option>
									<?php
									$dept=mysqli_query($dlink,"SELECT * FROM department");
									while($dp=mysqli_fetch_assoc($dept))
									{ ?>
										<option  value="<?php echo $dp['fname'] ." ". $dp['mname']." ". $dp['lname']; ?>"><?php echo $dp['fname'] ." ". $dp['mname']." ". $dp['lname']; ?></option>
										<?php 
									} ?>
								</select>
                            <?php
							}?>
                            </div>
                        </div>
                   </div>

                   <section>
						<ul class="nav nav-1 nav-tabs bg-green-1" id="myTabnew" role="tablist">
                        	<li class="btn-invoice waves-effect waves-light">
                            	<a class="font-1 nav-link-1 active show" id="homenew-tab" data-toggle="tab" href="#homenew" role="tab" aria-controls="homenew" aria-selected="true">Existing Customer</a>
                           	</li>
                            <li class="btn-invoice waves-effect waves-light" style="padding-left: 10px;">
                            	<a class="font-1 nav-link-1" id="profilenew-tab" data-toggle="tab" href="#profilenew" role="tab" aria-controls="profilenew" aria-selected="false">New Customer</a>
                          	</li>
                        </ul>
				   		<div class="row mt-10 secondbox tab-pane fade active show" id="homenew" role="tabpanel" aria-labelledby="homenew-tab">
	                        <div class="col-md-6 box-sender-1">
	                            <div class="grybox mb-20">
	                                <div class="col-sm-12 col-md-12 pl-0">
	                                    <h3>Sender Details</h3>
	                                    
	                                </div>
	                                <hr />
	                                <div class="row mb-133">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Customer Name</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls"><input type="hidden" id="sender_id" name="sender_id" value="" />
	                                        <input type="text" name="sender_name" id="sender_name" class="form-control" value="<?php echo $sname; ?>" autocomplete="off">
	                                       	<div id="suggesstion-box-sender"></div>
	                                    </div>
	                                </div>
	                                <div class="row mt-20">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Company Name</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls">
	                                        <input type="text" name="company_name" id="company_name" class="form-control" value="" autocomplete="off">
	                                    </div>
	                                </div>
	                                <div class="row mt-20">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Mobile</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <input type="text" name="sender_mobile" id="sender_mobile" class="form-control" value="<?php echo $mno; ?>" onkeypress="return isNumberKey(event);" autocomplete="off" maxlength="10" onblur="mobilewidth(this.value)">								  <div id="suggesstion-box-sender-mobile"></div> 
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Email</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls"> 
	                                        <input type="email" name="sender_email" id="sender_email" class="form-control" value="<?php echo $email; ?>" >
	                                    </div>
	                                </div>
	                                <div class="row mt-20">
	                                    
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span style="color: #D42B2B">Provience</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <select name="source_state" id="source_state" class="form-control " onchange="get_city(this.value,'source_city')">
	                                        	<option value="">Select Province</option>
	                                            <?php
	                                            $selsta=mysqli_query($dlink,"SELECT * FROM location where  location_type='1' and parent_id='184' and is_visible='0' order by name");
	                                            while($s=mysqli_fetch_array($selsta)) {
	                                            ?>
	                                            <option <?php if ($s['location_id'] == $state) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option>
	                                            <?php
	                                            }
	                                            ?>
	                                        </select>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span style="color: #D42B2B">City</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                       <select name="source_city" id="source_city" class="form-control source_city_cls cstmCity" onchange="save_city(this.value)">
	                                       <option value="">Select City</option>
	                                       <?php
	                                       if($city!='')
	                                       {
	                                       	$selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and is_visible='0' and parent_id='".$state."' and is_visible='0' order by name");
	                                        while($s1=mysqli_fetch_array($selcit)) {
	                                        ?>
	                                        <option <?php if ($s1['location_id'] == $city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
	                                        <?php
	                                        }
	                                       }
	                                       else
	                                       {
	                                       	$selcit=mysqli_query($dlink,"select s.name as state_name, c.* from  location s LEFT JOIN location c ON s.location_id=c.parent_id where s.parent_id='184'and c.location_type='2' and c.is_visible='0' order by c.name");	while($s1=mysqli_fetch_array($selcit)) 
	                                         {
	                                          ?>
	                                          <option value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
	                                          <?php
	                                          }
	                                      	}
	                                        ?>
	                                        </select>
	                                    </div>
	                                </div>

	                                <!-- <div class="row mt-20">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span style="color: #D42B2B">Area</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls">
	                                        <input type="text" name="area" id="area" class="form-control" value="" >
	                                    </div>
	                                </div> -->

	                                <div class="row mt-20">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Source Address</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls">
	                                        <textarea name="source_address" id="source_address" class="form-control" style="height: 35px;"><?php echo $address; ?></textarea>
	                                    </div>
	                                </div>
	                                <!--<div class="row mt-35">
	                                    &nbsp;
	                                </div>-->
                                    <div class="row mt-10 mb-10">
                                        <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>IQAMA No.</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls">
	                                    	<input type="text" name="customerid" id="customerid" class="form-control" value="" onkeypress="return isNumberKey(event);" autocomplete="off" maxlength="10" >
	                                    </div>
                                        
                                    </div>
                                    <div class="row mt-20 e_tax_business">
                                    	<div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label><span>Tax Treatment</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                            <div class="controls">
                                                <select name="taxtype" id="taxtype" class="form-control">
                                                    <option value="Non-Vat">Non Vat Registered</option>
                                                    <option  value="Vat">Vat Registered</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
									<div class="row mt-20 e_tax_business" id="vat">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Tax Registration No.</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls">
	                                    	<input type="text" name="taxnumber" id="taxnumber1" class="form-control" value="" minlength="15" maxlength="15" >
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                            
	                        <div class="col-md-6 box-receiver">
	                            <div class="grybox">
	                                <div class="col-sm-12 col-md-12 pl-0">
	                                    <h3 style="float: left;width: 87%;">Receiver Details</h3>
	                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="newRvcrVal" style="font-size: 30px;padding: 0px 6px 0px 6px;">+</button>
	                                </div>
	                                <hr/>
	                                <div class="row mt-20">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Receiver Name*</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls" id="destidrop">
	                                       <?php 
		                                        if(@$_REQUEST['id']!='')
												{
													?>
													<select name="desti_name_drop" id="desti_name_drop" class="form-control" onchange="getReceiverAllinfo(this)">
														<option value="">-Select Receiver-</option>
														<?php 	
														$query ="SELECT * FROM customers_receiver WHERE cid='".$_REQUEST["id"]."' ORDER BY rcvr_name";
														$result = mysqli_query($dlink,$query);
									
														while($records = mysqli_fetch_assoc($result))
														{
															?>
															<option value="<?php echo $records['id']; ?>"><?php echo $records['rcvr_name']; ?></option>
															<?php 
														}
														?> 
													</select>
													
												<?php }	
												else
												{
												?>
													<select name="desti_name_drop" id="desti_name_drop" class="form-control">
			                                        	<option value="">-Select Receiver-</option>
			                                        </select>
												<?php
												}
											?>
	                                        
	                                    </div>
	                                     <input type="hidden" name="desti_name" id="desti_name" value="" />
	                                </div>
	                                <div class="row mt-20">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Company Name</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls">
	                                        <input type="text" name="desti_company" id="desti_company" class="form-control" value="" autocomplete="off">
	                                    </div>
	                                </div>
	                                <div class="row mt-20">
	                                    <?php /*?><div class="col-md-3 controls">
	                                        <label><span>Customer Name</span></label>
	                                    </div>
	                                    <div class="col-md-3 controls">
	                                        <input class="form-control" type="text" name="" readonly="readonly">
	                                    </div><?php */?>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Salesman</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls">
	                                        <select name="desti_salesman" id="desti_salesman" class="form-control" >
	                                        	<option value=""></option>
	                                            <?php
	                                            $agent=mysqli_query($dlink,"SELECT * FROM  department WHERE 1");
	                                            while($dp=mysqli_fetch_assoc($agent))
	                                            {
	                                            	?>
	                                                <option <?php if($dp['id']==$desti_salesman){ ?> selected <?php } ?> value="<?php echo $dp['id']; ?>"><?php echo $dp['fname']." ".$dp['mname']."-".$dp['staff_id']; ?></option><?php } ?>
	                                        </select>
	                                    </div>
                                   </div>
                                   <div class="row mt-20">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Mobile</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <input type="text" name="desti_mobile" id="desti_mobile" class="form-control" value="<?php echo $desti_mobile; ?>" onkeypress="return isNumberKey(event);" maxlength="10" onblur="mobilewidth(this.value)">
	                                    </div>
                                        <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Email</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls"> 
	                                        <input type="email" name="desti_email" id="desti_email" class="form-control" value="<?php echo $desti_email; ?>" >
	                                    </div>
	                               </div>
	                               <div class="row mt-20">
	                                    
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span style="color: #D42B2B">Provience</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <select name="destination_state" id="destination_state" class="form-control" onchange="get_rcvr_city(this.value,'destination_city')">
	                                                            <option value="">Select Province</option>
	                                                            <?php
	                                                            $selsta=mysqli_query($dlink,"SELECT * FROM location where  location_type='1' and parent_id='184' and is_visible='0' order by name");
	                                                            while($s=mysqli_fetch_array($selsta)) {
	                                                            ?>
	                                                            <option <?php if ($s['location_id'] == $destination_state) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option>
	                                                           <?php
	                                                            }
	                                                            ?>
	                                                        </select>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span style="color: #D42B2B">City</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <select name="destination_city" id="destination_city" class="form-control destination_city_cls" onchange="save_rcvr_city(this.value)">
	                                                            <option value="">Select City</option>
	                                                            <?php
	                                                            if($destination_city!='')
	                                                            {
	                                                                $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$destination_state."' and is_visible='0' order by name");
	                                                                while($s1=mysqli_fetch_array($selcit)) {
	                                                                ?>
	                                                                <option <?php if ($s1['location_id'] == $destination_city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
	                                                                <?php
	                                                                }
	                                                            }
	                                                            else
	                                                            {
	                                                                $selcit=mysqli_query($dlink,"select s.name as state_name, c.* from  location s LEFT JOIN location c ON s.location_id=c.parent_id where s.parent_id='184'and c.location_type='2' and c.is_visible='0' order by c.name");
	                                                                while($s1=mysqli_fetch_array($selcit)) {
	                                                                ?>
	                                                                <option value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
	                                                                <?php
	                                                                }
	                                                            }
	                                                            
	                                                            ?>
	                                                        </select>
	                                    </div>
	                                </div>
                                    <div class="row mt-20">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                            <label><span>Reciver Address</span></label>
	                                   	</div>
	                                    <div class="col-md-9 controls">
	                                    	<textarea name="destination_address" id="destination_address" style="height: 35px;" class="form-control"><?php echo $destination_address ?></textarea>
	                                    </div>
	                              	</div>
	                                <div class="row mt-20">
	                                    
	                                    <!-- <div class="col-sm-12 col-md-3 controls">
	                                        <label><span style="color: #D42B2B">Area</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                       <input type="text" name="desti_landmark" id="desti_landmark" class="form-control" value="<?php echo $desti_landmark; ?>" autocomplete="off">
	                                       <div id="suggesstion-box-sender"></div>
	                                    </div> -->
	                                    <!--<div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Email</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls"> 
	                                        <input type="email" name="desti_email" id="desti_email" class="form-control" value="<?php echo $desti_email; ?>" >
	                                    </div>-->
	                                    
	                                </div>
	                                <div class="row">
	                                    
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>IQAMA No.</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                       <input type="text" name="desti_iqamano" id="desti_iqamano" class="form-control" value="<?php echo $rcvr_iqamano; ?>" onkeypress="return isNumberKey(event);" autocomplete="off" maxlength="10" >
	                                      
	                                    </div><div class="col-sm-12 col-md-3 controls">
	                                        <label><span>VAT No.</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls"> 
	                                        <input type="text" name="desti_vat_no" id="desti_vat_no" class="form-control" value="<?php echo $rcvr_vat_no; ?>" minlength="15" maxlength="15">
	                                    </div>
	                                    
	                                </div>

	                                
	                            </div>
	                            <!-- Modal -->
	                            <div class="modal fade" id="myModal" role="dialog">
								    <div class="modal-dialog">
								      	<!-- Modal content-->
								      	<div class="modal-content">
								        	<div class="modal-header">
									          	<button type="button" class="close" data-dismiss="modal">&times;</button>
									          	<h4 class="modal-title">Add Receiver</h4>
									        </div>
									        <div class="modal-body">
									          	<!-- <form action="" method="post"> -->
									          		<span style="padding-right: 10px;">Customer Name</span>
									          		<span id="sendername" style="padding-right: 10px;"></span>
									          		<!-- <input type="text" name="sendername" id="sendername" class="form-control" value="" autocomplete="off"> -->

									          		<span style="padding-right: 10px;">Contact Number</span>
									          		<span id="senderno" style="padding-right: 10px;"></span>
									          		<!-- <input type="text" name="senderno"  class="form-control" value="" autocomplete="off"> -->

									          		<input type="hidden" name="cid" id="cid" class="form-control" value="" autocomplete="off">

									          		<div class="row mt-20">
										                <div class="col-sm-12 col-md-3 controls">
										                	<span style="color: #D42B2B">Receiver Name</span>
										                </div>
										                <div class="col-sm-12 col-md-9 controls" id="destidrop">
										                    <input type="text" name="rcvr_name" id="rcvr_name" data-nid="1" class="form-control" value="" style="display:inline-block">
										                </div>
										                <!--<input type="hidden" name="desti_name" id="desti_name" value="" />-->
										            </div>
										            <div class="row mt-20">
					                                    <div class="col-sm-12 col-md-3 controls">
					                                        <label><span>Company Name</span></label>
					                                    </div>
					                                    <div class="col-sm-12 col-md-9 controls">
					                                        <input type="text" name="rvcr_company" id="rvcr_company" class="form-control" value="" autocomplete="off">
					                                    </div>
					                                </div>

									               	<div class="row mt-20">
									                   
									                    <div class="col-sm-12 col-md-3 controls">
									                        <span style="color: #D42B2B">Contact Number</span>
									                    </div>
									                    <div class="col-sm-12 col-md-3 controls">
									                        <input type="text" name="rcvr_mno" id="rcvr_mno" value="" class="form-control" onkeypress="return isNumberKey(event);" maxlength="12">
									                    </div>
									                    <div class="col-sm-12 col-md-2 controls">
									                        <label><span>Contact Number 2</span></label>
									                    </div>
									                    <div class="col-sm-12 col-md-4 controls">
									                        <input type="text" name="rcvr_mno2" id="rcvr_mno2" value="" class="form-control" onkeypress="return isNumberKey(event);" maxlength="12">
									                    </div>
									               	</div>

									               	<div class="row mt-20">
									               		<div class="col-sm-12 col-md-3 controls">
									                        <label><span>Email</span></label>
									                    </div>
									                    <div class="col-sm-12 col-md-3 controls"> 
									                        <input type="email" name="rcvr_email" id="rcvr_email" value="" class="form-control" >
									                    </div>

									                    <!-- <div class="col-sm-12 col-md-3 controls">
									                        <label><span style="color: #D42B2B">Area</span></label>
									                    </div>
									                    <div class="col-sm-12 col-md-3 controls">
									                       <input type="text" name="rcvr_landmark" id="rcvr_landmark" value="" class="form-control">
									                       <div id="suggesstion-box-sender"></div>
									                    </div> -->

									                </div>

									               	<div class="row mt-20">
									                    <div class="col-sm-12 col-md-3 controls">
									                        <label><span>Address</span></label>
									                    </div>
									                    <div class="col-md-9 controls">
									                        <textarea name="rcvr_address" id="rcvr_address" style="height: 35px;" class="form-control"></textarea>
									                    </div>
									                </div>
										                            
									                <div class="row mt-20">
									                    
									                    <div class="col-sm-12 col-md-3 controls">
									                        <label><span style="color: #D42B2B">Provience</span></label>
									                    </div>
									                    <div class="col-sm-12 col-md-3 controls">
									                        <select name="rcvr_state" id="rcvr_state" class="form-control" onchange="get_rcvr_city1(this.value,'destination_city')">
									                            <option value="">Select Province</option>
									                            <?php
									                            $selsta=mysqli_query($dlink,"SELECT * FROM location where  location_type='1' and parent_id='184' and is_visible='0' order by name");
									                            while($s=mysqli_fetch_array($selsta)) {
									                            ?>
									                            <option value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option>
									                           <?php
									                            }
									                            ?>
									                        </select>
									                    </div>
									                    <div class="col-sm-12 col-md-3 controls">
									                        <label><span style="color: #D42B2B">City</span></label>
									                    </div>
									                    <div class="col-sm-12 col-md-3 controls">
									                        <select name="rcvr_city" id="rcvr_city" class="form-control destination_city_cls1">
									                            <option value="">Select City</option>
									                            <?php
									                            $selcit=mysqli_query($dlink,"select s.name as state_name, c.* from  location s LEFT JOIN location c ON s.location_id=c.parent_id where s.parent_id='184'and c.location_type='2' and c.is_visible='0' order by c.name");
									                                while($s1=mysqli_fetch_array($selcit)) {
									                                ?>
									                                <option value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
									                                <?php
									                                }
									                            
									                            ?>
									                        </select>
									                    </div>
									                </div>

									                <div class="row mt-20">
									                	<div class="col-sm-12 col-md-3 controls">
									                        <label><span>VAT No.</span></label>
									                    </div>
									                    <div class="col-sm-12 col-md-3 controls"> 
									                        <input type="text" name="rcvr_vat_no" rows="1" id="rcvr_vat_no" class="form-control" value="" onkeypress="return isNumberKey(event);" maxlength="15">
									                    </div>
									                    <div class="col-sm-12 col-md-3 controls">
									                        <label><span>IQAMA No.</span></label>
									                    </div>
									                    <div class="col-sm-12 col-md-3 controls">
									                       <input type="text" name="rcvr_iqamano" id="rcvr_iqamano" value="" class="form-control" onkeypress="return isNumberKey(event);" maxlength="10">
									                    </div>
									                </div>

									                <button type="button" class="btn btn-danger" id="submitRvcr" name="submitRvcr">Submit</button>

									          	<!-- </form> -->
									        </div>
									        <div class="modal-footer">
									          	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									        </div>
								      	</div>
								    </div>
							  	</div>
	                        </div>	
	                    </div>

	                    <div class="row mt-10 secondbox tab-pane fade" id="profilenew"  role="tabpanel" aria-labelledby="profilenew-tab">
	                        <div class="col-md-6 box-sender-1">
	                            <div class="grybox mb-20">
	                                <div class="col-sm-12 col-md-12 pl-0">
	                                    <h3>Sender Details</h3>
	                                    <hr />
	                                </div>

		                            <div class="row mb-133">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Customer Type</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls">
	                                    	<div class="demo-radio-button">
		                                        <input name="customer_type" type="radio" id="business" class="with-gap radio-col-maroon  chktype" value="1" checked onclick="cstmrtype(this.value)">
		                                        <label for="business">Business</label>
		                                        <input name="customer_type" type="radio" id="individual" class="with-gap radio-col-maroon chktype"  value="2" onclick="cstmrtype(this.value)">
		                                        <label for="individual">Individual</label>
		                                    </div>
	                                    </div>
	                                </div>
	                               
		                            <div class="row mb-133">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Customer Name</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls"><input type="hidden" id="sender_id" name="sender_id" value="" />
	                                        <input type="text" name="sender_name" id="sender_name" class="form-control" value="<?php echo $sname; ?>" autocomplete="off">
	                                        <!-- <div id="suggesstion-box-sender"></div> -->
	                                    </div>
	                                </div>

	                                <div class="row mt-20">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Company Name</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls">
	                                        <input type="text" name="company_name" id="company_name" class="form-control" value="" autocomplete="off">
	                                    </div>
	                                </div>
	                                <div class="row mt-20">
	                                    <?php /*?><div class="col-md-3 controls">
	                                        <label><span>Customer Name</span></label>
	                                    </div>
	                                    <div class="col-md-3 controls">
	                                        <input class="form-control" type="text" name="" readonly="readonly">
	                                    </div><?php */?>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Mobile</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <input type="text" name="sender_mobile" id="sender_mobile" class="form-control" value="<?php echo $mno; ?>" onkeypress="return isNumberKey(event);" autocomplete="off" maxlength="10" onblur="mobilewidth(this.value)">								  <div id="suggesstion-box-sender-mobile"></div> 
	                                    </div>
	                                    <div class="col-sm-12 col-md-2 controls">
	                                        <label><span>Email</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-4 controls"> 
	                                        <input type="email" name="sender_email" id="sender_email" class="form-control" value="<?php echo $email; ?>" >
	                                    </div>
	                                </div>
                                    <div class="row mt-20">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Source Address</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls">
	                                        <textarea name="source_address" id="source_address" class="form-control" style="height: 35px;"><?php echo $address; ?></textarea>
	                                    </div>
	                                </div>
									<div class="row mt-20">
	                                	<div class="col-sm-12 col-md-3 controls">
                                    		<label><span>Country / Region</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-3 controls">
                                        	<select name="source_country" id="source_country" class="form-control" onchange="get_state(this.value)">
                                                <option value="">Select Country</option>
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
                                        <div class="col-sm-12 col-md-2 controls">
	                                        <label><span style="color: #D42B2B">Provience</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-4 controls">
	                                        <select name="source_state" id="source_state" class="form-control cstmSourceState" onchange="get_city(this.value,'source_city')">
	                                            <option value="">Select Province</option>
	                                            <?php
	                                            $selsta=mysqli_query($dlink,"SELECT * FROM location where  location_type='1' and parent_id='184' and is_visible='0' order by name");
	                                            while($s=mysqli_fetch_array($selsta)) {
	                                            ?>
	                                            <option <?php if ($s['location_id'] == $state) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option>
	                                            <?php
	                                            }
	                                            ?>
	                                        </select>
	                                        <input type="hidden" name="cust_source_state" id="cust_source_state" value="">
	                                    </div>
                                    </div>
                                   	<div class="row mt-20">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span style="color: #D42B2B">City</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                       <select name="source_city" id="source_city" class="form-control source_city_cls cstmSourceCity" onchange="save_city(this.value)">
	                                       <option value="">Select City</option>
	                                       <?php
	                                       if($city!='')
	                                       {
	                                        $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and is_visible='0' and parent_id='".$state."' and is_visible='0' order by name");
	                                        while($s1=mysqli_fetch_array($selcit)) {
	                                        ?>
	                                        <option <?php if ($s1['location_id'] == $city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
	                                        <?php
	                                        }
	                                       }
	                                       else
	                                       {
	                                        $selcit=mysqli_query($dlink,"select s.name as state_name, c.* from  location s LEFT JOIN location c ON s.location_id=c.parent_id where s.parent_id='184'and c.location_type='2' and c.is_visible='0' order by c.name");	while($s1=mysqli_fetch_array($selcit)) 
	                                         {
	                                          ?>
	                                          <option value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
	                                          <?php
	                                          }
	                                        }
	                                        ?>
	                                        </select>
	                                        <input type="hidden" name="cust_source_city" id="cust_source_city" value="">
	                                    </div>
                                        <!-- <div class="col-sm-12 col-md-2 controls">
	                                        <label><span style="color: #D42B2B">Area</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-4 controls">
	                                    	<input type="text" name="area" id="area" class="form-control" value="" >
	                                    </div> -->
	                                </div>
	                                

	                                <div class="row mt-20">
	                                    
	                                </div>

	                                <div class="row mt-10 mb-10">
                                        <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>IQAMA No.</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls">
	                                    	<input type="text" name="customerid" id="customerid" class="form-control" value="" onkeypress="return isNumberKey(event);" autocomplete="off" maxlength="10" >
	                                    </div>
                                        
                                    </div>
									
                                    <div class="row mt-20 tax_business">
                                    	<div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label><span>Tax Treatment</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                            <div class="controls">
                                                <select name="taxtype" id="taxtype" class="form-control">
                                                    <option value="Non-Vat">Non Vat Registered</option>
                                                    <option  value="Vat">Vat Registered</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
	                                <div class="row mt-20 tax_business tax_no_hide" id="vat">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Tax Registration No.</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls">
	                                    	<input type="text" name="taxnumber" id="taxnumber1" class="form-control" value="" minlength="15" maxlength="15" >
	                                    </div>
	                                </div>

	                                <div class="row mt-35">
	                                    &nbsp;
	                                </div>
	                            </div>
	                        </div>
	                            
	                        <div class="col-md-6 box-receiver">
	                            <div class="grybox">
	                                <div class="col-sm-12 col-md-12 pl-0">
	                                    <h3>Receiver Details</h3>
	                                    <hr />
	                                </div>
	                                
	                                <div class="row mt-20">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Receiver Name*</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls" id="destidrop">
	                                       <input type="text" name="desti_name" id="desti_name" class="form-control" value="<?php echo $desti_name; ?>" autocomplete="off">
	                                        <div id="suggesstion-box"></div>
										</div>
	                                     
	                                </div>
	                                <div class="row mt-20">
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Company Name</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls">
	                                        <input type="text" name="desti_company" id="desti_company" class="form-control" value="" autocomplete="off">
	                                    </div>
	                                </div>
	                                <div class="row mt-20">
	                                    <?php /*?><div class="col-md-3 controls">
	                                        <label><span>Customer Name</span></label>
	                                    </div>
	                                    <div class="col-md-3 controls">
	                                        <input class="form-control" type="text" name="" readonly="readonly">
	                                    </div><?php */?>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Salesman</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls">
	                                        <select name="desti_salesman" id="desti_salesman" class="form-control" >
	                                        	<option value=""></option>
	                                            <?php
	                                            $agent=mysqli_query($dlink,"SELECT * FROM  department WHERE 1");
	                                            while($dp=mysqli_fetch_assoc($agent))
	                                            {
	                                            	?>
	                                                <option <?php if($dp['id']==$desti_salesman){ ?> selected <?php } ?> value="<?php echo $dp['id']; ?>"><?php echo $dp['fname']." ".$dp['mname']."-".$dp['staff_id']; ?></option><?php } ?>
	                                        </select>
	                                    </div>
	                                    
	                               </div>
                                   
                                   <div class="row mt-20">
                                   <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>Mobile</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <input type="text" name="desti_mobile" id="desti_mobile" class="form-control" value="<?php echo $desti_mobile; ?>" onkeypress="return isNumberKey(event);" maxlength="10" onblur="mobilewidth(this.value)">
	                                    </div>
                                        <div class="col-sm-12 col-md-2 controls">
	                                        <label><span>Email</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-4 controls"> 
	                                        <input type="email" name="desti_email" id="desti_email" class="form-control" value="<?php echo $desti_email; ?>" >
	                                    </div>
                                   </div>     
	                               <div class="row mt-20">
	                                    	<div class="col-sm-12 col-md-3 controls">
	                                            <label><span>Reciver Address</span></label>
	                                        </div>
	                                        <div class="col-md-9 controls">
	                                            <textarea name="destination_address" id="destination_address" style="height: 35px;" class="form-control"><?php echo $destination_address ?></textarea>
	                                        </div>
	                               </div>
	                                    
	                            	<div class="row mt-20">
	                               
	                                	<div class="col-sm-12 col-md-3 controls">
                                        <label><span>Country / Region</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-3 controls">
                                            <select name="destination_country" id="destination_country" class="form-control" onchange="get_state(this.value)">
                                                <option value="">Select Country</option>
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
                                        <div class="col-sm-12 col-md-2 controls">
	                                        <label><span style="color: #D42B2B">Provience</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-4 controls">
	                                        <select name="destination_state" id="destination_state" class="form-control cstmRcvrState" onchange="get_rcvr_city(this.value,'destination_city')">
                                                <option value="">Select Province</option>
                                                <?php
                                                $selsta=mysqli_query($dlink,"SELECT * FROM location where  location_type='1' and parent_id='184' and is_visible='0' order by name");
                                                while($s=mysqli_fetch_array($selsta)) {
                                                ?>
                                                <option <?php if ($s['location_id'] == $destination_state) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option>
                                               <?php
                                                }
                                                ?>
                                            </select>
                                            <input type="hidden" name="cust_rvcr_state" id="cust_rvcr_state" value="">
	                                    </div>
                                   
                                   </div>
	                               
	                                <div class="row mt-20">
	                                    
	                                    
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span style="color: #D42B2B">City</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <select name="destination_city" id="destination_city" class="form-control rcvr_city_cls destination_city_cls" onchange="save_rcvr_city(this.value)">
                                                <option value="">Select City</option>
                                                <?php
                                                if($destination_city!='')
                                                {
                                                    $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$destination_state."' and is_visible='0' order by name");
                                                    while($s1=mysqli_fetch_array($selcit)) {
                                                    ?>
                                                    <option <?php if ($s1['location_id'] == $destination_city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
                                                    <?php
                                                    }
                                                }
                                                else
                                                {
                                                    $selcit=mysqli_query($dlink,"select s.name as state_name, c.* from  location s LEFT JOIN location c ON s.location_id=c.parent_id where s.parent_id='184'and c.location_type='2' and c.is_visible='0' order by c.name");
                                                    while($s1=mysqli_fetch_array($selcit)) {
                                                    ?>
                                                    <option value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
                                                    <?php
                                                    }
                                                }
                                                
                                                ?>
                                            </select>
	                                    </div>
                                        <!-- <div class="col-sm-12 col-md-2 controls">
	                                        <label><span style="color: #D42B2B">Area</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-4 controls">
	                                       <input type="text" name="desti_landmark" id="desti_landmark" class="form-control" value="<?php echo $desti_landmark; ?>" autocomplete="off">
	                                       <div id="suggesstion-box-sender"></div>
	                                    </div> -->
	                                </div>
	                                
                                    <div class="row mt-20">
                                    	<div class="col-sm-12 col-md-3 controls">
	                                        <label><span>IQAMA No.</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls">
	                                       <input type="text" name="desti_iqamano" id="desti_iqamano" class="form-control" value="<?php echo $rcvr_iqamano; ?>" onkeypress="return isNumberKey(event);" autocomplete="off" maxlength="10" >
	                                       
	                                    </div>
                                    </div>
	                                <div class="row mt-20">
	                                    
	                                    <div class="col-sm-12 col-md-3 controls">
	                                        <label><span>VAT No.</span></label>
	                                    </div>
	                                    <div class="col-sm-12 col-md-9 controls"> 
	                                        <input type="text" name="desti_vat_no" id="desti_vat_no" class="form-control" value="<?php echo $rcvr_vat_no; ?>" minlength="15" maxlength="15" >
	                                    </div>
	                                    
	                                </div>
	                                
	                            </div>
	                        </div>	
	                    </div>

	                   
	                </section>
              	</div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                
                    <div class="secondtab">
					<div class="table-responsive-1">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <h5>Package Details</h5>
                                    <hr />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        	<table class="col-lg-12 col-md-12 col-sm-12 col-12" colspan="5" colspadding="5">
                            	<thead>
                                	<tr>
                                    	<td>SI.No.</td>
                                        <td>Item/Product Detail</td>
                                        <td>Quantity</td>
                                        <td>Price</td>
                                        <td>Discount%</td>
                                        <td>Tax%</td>
                                        <td>Amount</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody id="compare_div">
                                	<?php
                                	if(@$_REQUEST['id']!='')
									{
										$row=select_query("*","shipment_detail", array("oid="=>$id), "id asc");
									  	if($row->num_rows)
									  	{ 
									  		$i=1;
										  	while($b=$row->fetch_array())
										  	{ ?>
			                                	<tr class="tr_0">
			                                    	<td><?php echo $i; ?></td>
			                                        <td>
			                                        <select name="type_of_product[0]" id="type_of_product[0]" class="form-control">
			                                            	<option value="">-- Select One --</option>
			                                            	<option <?php if ('Document' == $b['type_of_product']) {?> selected="selected" <?php }?> value="Document">Document</option>
			                                              	<option <?php if ('Rolls' == $b['type_of_product']) {?> selected="selected" <?php }?>  value="Rolls">Rolls</option>
			                                              	<option <?php if ('Kees' == $b['type_of_product']) {?> selected="selected" <?php }?> value="Kees">Kees</option>
														  	<option <?php if ('Cartoon' == $b['type_of_product']) {?> selected="selected" <?php }?> value="Cartoon">Cartoon</option>
                                                          	<option <?php if ('Box' == $b['type_of_product']) {?> selected="selected" <?php }?> value="Box">Box</option>

                                                          	<option <?php if ('Bags' == $b['type_of_product']) {?> selected="selected" <?php }?> value="Bags">Bags</option>
			                                              	
			                            			</select>
			                                       	</td>
			                                        <td><input type="text" name="quantity[0]" id="quantity0" class="form-control" value="<?php echo $b['no_of_package']; ?>" onkeypress="return isNumberKey(event);" onblur="get_calulation(0)"></td>
			                                        <td><input type="text" name="price[0]" id="price0" class="form-control" value="<?php echo $b['price']; ?>" onkeypress="return isNumberKey(event);" onblur="get_calulation(0)"></td>
			                                        <td><input type="text" name="discount[0]" id="discount0" class="form-control" value="<?php echo $b['discount']; ?>" onkeypress="return isNumberKey(event);" onblur="get_calulation(0)"></td>
			                                        <td>
			                                        	<select name="tax[0]" id="tax0" class="form-control" onchange="get_calulation(0)">
			                                            	<option <?php if ('15'== $b['tax']) {?> selected="selected" <?php }?>value="0">15%</option>
			                                            </select>
			                                       	</td>
			                                        <td><input type="text" name="amount[0]" id="amount0" class="form-control" value="<?php echo $b['total_amount']; ?>" onkeypress="return isNumberKey(event);" readonly="readonly"></td>
			                                        <td><i class="fas fa-trash-alt newicon" id="0" onclick="hidetr(this.id);"></i>
			                                        <input type="hidden" id="trremove_0" value="1" name="trremove_0" />
			                                        <input type="hidden" id="total_rows" value="1" name="total_rows" />
			                                        </td>
			                                   </tr>
			                                <?php 
			                                $i++;
			                            	}
			                            }
		                         
									}
									else
									{
										?>
	                                	<tr class="tr_0">
	                                    	<td>1</td>
	                                        <td>
	                                        	<select name="type_of_product[0]" id="type_of_product[0]" class="form-control">
	                                            	<option value="">-- Select One --</option>
	                                            	<option <?php if ('Document' == $type_of_product) {?> selected="selected" <?php }?> value="Document">Document</option>
	                                              <option <?php if ('Rolls' == $type_of_product) {?> selected="selected" <?php }?>  value="Rolls">Rolls</option>
	                                              <option <?php if ('Kees' == $type_of_product) {?> selected="selected" <?php }?> value="Kees">Kees</option>
	                                               <option <?php if ('Cartoon' == $b['type_of_product']) {?> selected="selected" <?php }?> value="Cartoon">Cartoon</option>
                                                    <option <?php if ('Box' == $b['type_of_product']) {?> selected="selected" <?php }?> value="Box">Box</option>

                                                    <option <?php if ('Bags' == $b['type_of_product']) {?> selected="selected" <?php }?> value="Bags">Bags</option>

                                                </select>
	                                       	</td>
	                                        <td><input type="text" name="quantity[0]" id="quantity0" class="form-control" value="" onkeypress="return isNumberKey(event);" onblur="get_calulation(0)"></td>
	                                        <td><input type="text" name="price[0]" id="price0" class="form-control" value="" onkeypress="return isNumberKey(event);" onblur="get_calulation(0)"></td>
	                                        <td><input type="text" name="discount[0]" id="discount0" class="form-control" value="" onkeypress="return isNumberKey(event);" onblur="get_calulation(0)"></td>
	                                        <td>
	                                        	<select name="tax[0]" id="tax0" class="form-control" onchange="get_calulation(0)">
	                                            	<option value="0">15%</option>
	                                            </select>
	                                       	</td>
	                                        <td><input type="text" name="amount[0]" id="amount0" class="form-control" value="" onkeypress="return isNumberKey(event);" readonly="readonly"></td>
	                                        <td><i class="fas fa-trash-alt newicon" id="0" onclick="hidetr(this.id);"></i>
	                                        <input type="hidden" id="trremove_0" value="1" name="trremove_0" />
	                                        <input type="hidden" id="total_rows" value="1" name="total_rows" />
	                                        </td>
	                                   </tr>
	                                <?php } ?>
                                </tbody>
                            </table>
                           </div> 
                       	</div>
                        
                        
                  	</div>  
                    <div class="row">
                    	<div class="col-md-6 col-sm-12 col-lg-6 mt-20">
                        	<a class="btn btn-danger add-comp btn-x" style="color: #fff;"><i class="fa fa-plus"></i> Add Another Item</a>
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6 x-11" style="padding-right:5px;padding-left:10px">
                        	<div class="grybox" style="margin: 20px 10px;">
                            	<div class="row">
                                    <div class="col-md-8 col-sm-12 col-8 mt-10">
                                    	Total
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-4 mt-10">
                                    	
                                    	<?php
	                                	if(@$_REQUEST['id']!='')
										{
											?>
											<input type="hidden" name="total_val" id="total_val" value="<?php echo $total_val; ?>">
											<span id="spantotal"><?php echo $total_val; ?></span> SAR
											
											<?php
										}
										else{
											?>
											<input type="hidden" name="total_val" id="total_val" value="">
                                    		<span id="spantotal">0.00</span> SAR
                                    		<?php
                                    	} ?>
                                    </div>
                                    <div class="col-md-8 col-sm-12 col-8 mt-10">
                                    	Total Discount
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-4 mt-10">
                                    	
                                    	<?php
	                                	if(@$_REQUEST['id']!='')
										{
											?>
											<input type="hidden" name="discount_val" id="discount_val" value="<?php echo $subtotal_val; ?>">
											<span id="spandiscount"><?php echo $subtotal_val; ?></span> SAR
											
											<?php
										}
										else{
											?>
											<input type="hidden" name="discount_val" id="discount_val" value="">
                                    		<span id="spandiscount">0.00</span> SAR
                                    		<?php
                                    	} ?>
                                    </div>
                                    <div class="col-md-8 col-sm-12 col-8 mt-10">
                                    	Subtotal
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-4 mt-10">
                                    	
                                    	<?php
	                                	if(@$_REQUEST['id']!='')
										{
											?>
											<input type="hidden" name="subtotal_val" id="subtotal_val" value="<?php echo $subtotal_val; ?>">
											<span id="subtotal"><?php echo $subtotal_val; ?></span> SAR
											
											<?php
										}
										else{
											?>
											<input type="hidden" name="subtotal_val" id="subtotal_val" value="">
                                    		<span id="subtotal">0.00</span> SAR
                                    		<?php
                                    	} ?>
                                    </div>
                                    <div class="col-md-8 col-sm-12 col-8 mt-10">
                                    	
                                    	<?php
	                                	if(@$_REQUEST['id']!='')
										{
											?>
											<input type="hidden" name="vatper_val" id="vatper_val" value="<?php echo $vatper_val; ?>">
											VAT RATE(<span id="vatper">15</span>%)
											<?php
										}
										else{
											?>
											<input type="hidden" name="vatper_val" id="vatper_val" value="">
                                    		VAT RATE(<span id="vatper">15</span>%)
                                    		<?php
                                    	} ?>
                                    	
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-4 mt-10">
                                    	
                                    	<?php
	                                	if(@$_REQUEST['id']!='')
										{
											?>
											<input type="hidden" name="vattotal_val" id="vattotal_val" value="<?php echo $vattotal_val; ?>">
											<span id="vattotal"><?php echo $vattotal_val; ?></span> SAR
											<?php
										}
										else{
											?>
											<input type="hidden" name="vattotal_val" id="vattotal_val" value="">
                                    		<span id="vattotal">0.00</span> SAR
                                    		<?php
                                    	} ?>
                                    	
                                    </div>
                                    <div class="col-md-8 col-sm-12 col-8 mt-10">
                                    	<strong>Subtotal</strong>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-4 mt-10">
                                    	
                                    	<?php
	                                	if(@$_REQUEST['id']!='')
										{
											?>
											<input type="hidden" name="finaltotal_val" id="finaltotal_val" value="<?php echo $finaltotal_val; ?>">
											<strong><span id="finaltotal"><?php echo $finaltotal_val; ?></span> SAR</strong>
											<?php
										}
										else{
											?>
											<input type="hidden" name="finaltotal_val" id="finaltotal_val" value="">
                                    		<strong><span id="finaltotal">0.00</span> SAR</strong>
                                    		<?php
                                    	} ?>
                                    	
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>       
                    
                    <div class="row">
                    	<div class="col-md-12 col-sm-12 col-12">
                        	<div class="grybox">
                            	<div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <h5>Other Details</h5>
                                            <hr />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                        <label for="business">Total No. of Packages</label>
                                    </div>
                                    <?php
                                    $total_pack='';
                                	if(@$_REQUEST['id']!='')
									{
										$row=select_query("*","shipment_detail", array("oid="=>$id), "id asc");
									  	if($row->num_rows)
									  	{ 
									  		
										  	while($b=$row->fetch_array())
										  	{ 
										  		$total_pack+=$b['no_of_package'];
										  	}
										}
									}
									
									?>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                    	<input type="text" name="no_of_package" id="no_of_package" class="form-control" value="<?php echo $total_pack; ?>">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12 ">
                                        <label for="business" style="color: #D42B2B">Mode of Payment</label>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                    	 <select name="mode_of_payment" id="mode_of_payment" class="form-control" onchange="save_mode_of_payment(this.value)">
                                         	<option value="">Select</option>
                                            <option value="Cash">Cash</option>
                                            <option value="COD">COD</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                         </select>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                        <label for="business">Mode of Transport</label>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                    	<select name="mode" id="mode" class="form-control">
                                       		<option value="">Type of Mode</option>
                                            <option <?php if ('Air' == $mode) {?> selected="selected" <?php }?> value="Air" >Air</option>
                                            <option <?php if ('Sea' == $mode) {?> selected="selected" <?php }?> value="Sea" >Sea</option>
                                            <option <?php if ('Land' == $mode) {?> selected="selected" <?php }?> value="Land" selected>Land</option>
										</select>
                                    </div>

                                        
                                </div>
                                <div class="row mt-20">
                                	<div class="col-lg-2 col-md-2 col-sm-12 col-12 ">
                                        <label for="business">Pickup Date</label>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                    	<input type="date" name="pickup_date" id="pickup_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" >
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12 ">
                                        <label for="business">Pickup Time</label>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                    	<?php
										$pickup=explode(":",date('h:i a',strtotime($pickup_time)));
										?>
                                        <div class="controls">
                                           <select name="phour" id="phour" class="form-control" style="display: inline-block;
width: 32%;"> 
                                           		<option value="">Hr</option>
                                                <?php for($pt=1;$pt<=12;$pt++)
												{ ?>
                                                	<option <?php if($pickup[0]==$pt) {?> selected="selected" <?php }?> value="<?php echo $pt?>"><?php echo $pt?></option> <?php
												}?>
                                           </select>
                                        	<select name="pminute" id="pminute" class="form-control" style="display: inline-block;
width: 32%;"> 
                                           		<option value="">Min</option>
                                                <?php for($pt=0;$pt<=59;$pt++)
												{ ?>
                                                	<option <?php if($pickup[1]==$pt) {?> selected="selected" <?php }?> value="<?php echo $pt?>"><?php echo $pt?></option> <?php
												}?>
                                           </select> 
                                            <select name="ptime" id="ptime" class="form-control" style="display: inline-block;
width: 32%;"> 
                                           		<option <?php if($pickup[2]=='am') {?> selected="selected" <?php }?> value="AM">AM</option>
                                                <option <?php if($pickup[2]=='pm') {?> selected="selected" <?php }?> value="PM">PM</option>
                                           </select>
                                           <!--<input type="time" name="pickup_time" id="pickup_time" value="<?php echo $pickup_time; ?>" class="form-control" >-->
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                        <label for="business">Special Delivery</label>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-12">
                                    	 <select name="special_delivery" id="special_delivery" class="form-control">
                                         	<option value="">Select</option>
                                            <option value="Office Delivery">Office Delivery</option>
                                            <option value="Door to Door">Door to Door</option>
                                         </select>
                                    </div>
                             	</div>
                                <div class="row mt-20" style="display:none">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 ">
                                            <label for="business">Expected Delivery Date</label>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <input type="date" name="delivery_date" id="delivery_date" value="<?php echo $delivery_date; ?>" class="form-control" >
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 ">
                                            <label for="business">Expected Delivery Time</label>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <?php
                                            $expected=explode(":",date('h:i a',strtotime($delivery_time)));
                                            ?>
                                                <select name="ehour" id="ehour" class="form-control" style="display: inline-block;
    width: 32%;"> 
                                                    <option value="">Hr</option>
                                                    <?php for($pt=1;$pt<=12;$pt++)
                                                    { ?>
                                                        <option <?php if($expected[0]==$pt) {?> selected="selected" <?php }?> value="<?php echo $pt?>"><?php echo $pt?></option> <?php
                                                    }?>
                                               </select>
                                             
                                               <select name="eminute" id="eminute" class="form-control" style="display: inline-block;
    width: 32%;"> 
                                                    <option value="">Min</option>
                                                    <?php for($pt=0;$pt<=59;$pt++)
                                                    { ?>
                                                        <option <?php if($expected[0]==$pt) {?> selected="selected" <?php }?> value="<?php echo $pt?>"><?php echo $pt?></option> <?php
                                                    }?>
                                               </select> 
                                                <select name="etime" id="etime" class="form-control" style="display: inline-block;
    width: 32%;"> 
                                                    <option <?php if($expected[2]=='am') {?> selected="selected" <?php }?> value="AM">AM</option>
                                                    <option <?php if($expected[2]=='am') {?> selected="selected" <?php }?> value="PM">PM</option>
                                               </select>
                                        </div>
                                        
                                </div>
                                <?php 
                                	$dspVal='';
									if(@$_SESSION['ntexpress_retroadm']!='')
									{ 
										$dspVal ="flex";
									}
									else
									{
										$dspVal ="none";
									}
								?>
                                <div class="row mt-20" style="display:<?php echo $dspVal;?>">
                                	<div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                        <label for="business">Receivable</label>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                    	 <input type="text" name="total_case" id="total_case" value="<?php echo $total_cash; ?>" class="form-control" onblur="calculate_FC()" >
                                    	 <span style="color: red" id="err_total_case"></span>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12 ">
                                        <label for="business">Balance</label>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                    	 <input type="text" name="total_fc" id="total_fc" value="<?php echo $total_fc; ?>" class="form-control">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                        <label for="business">Status</label>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                    	<select name="status" id="status" class="form-control">
                                                <option <?php if ('1' == $status) {?> selected="selected" <?php }?> value="1" >Pending</option>
                                                <option <?php if ('2' == $status) {?> selected="selected" <?php }?> value="2" >In Process</option>
                                                <option <?php if ('3' == $status) {?> selected="selected" <?php }?> value="3" >Delivered</option>
                                                <option <?php if ('4' == $status) {?> selected="selected" <?php }?> value="4" >Reject</option>
											</select> 
                                    </div>
                                        
                                </div>
                                <div class="row mt-20">
                                	<div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                        <label for="business">Value of Goods</label>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-12">
                                    	 <input type="text" name="value_of_good" id="value_of_good" value="<?php echo $value_of_good; ?>" class="form-control">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                        <label for="business">Delivery Cost</label>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                    	<input type="text" name="delivery_cost" id="delivery_cost" value="<?php echo $delivery_cost; ?>" class="form-control">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                        <label for="business">Comment</label>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                    	<input type="text" name="comment" id="comment" value="<?php echo $comment; ?>" class="form-control">
                                    	
                                    </div>
                                </div>
                                
                                <div class="text-xs-right bt-1 pt-10">
                                	<input type="hidden" name="tax_percentage" id="tax_percentage" value="0" />
                                    <input type="hidden" name="total_amount" id="total_amount" value="0" />
                                    <input type="hidden" name="barcode_image" id="barcode_image" value="<?php echo $barcode_image?>" />
                                    <button type="submit" class="btn btn-danger" id="submit" name="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>     
                    <!-- <input type="hidden" name="cstm_city" value="" id="cstm_city">
	                <input type="hidden" name="cstm_state" value="" id="cstm_state">
                       
                    <input type="hidden" name="desti_cstm_city" value="" id="desti_cstm_city">
	                <input type="hidden" name="desti_cstm_state" value="" id="desti_cstm_state">  -->  
	                <input type="hidden" name="cstm_city" value="<?php echo $source_city?>" id="cstm_city">
	                <input type="hidden" name="cstm_state" value="<?php echo $source_state;?>" id="cstm_state">
                       
                    <input type="hidden" name="desti_cstm_city" value="<?php echo $destination_city; ?>" id="desti_cstm_city">
	                <input type="hidden" name="desti_cstm_state" value="<?php echo $destination_state; ?>" id="desti_cstm_state"> 
	                <input type="hidden" name="newRvcr" id="newRvcr" value="0">  <input type="hidden" name="tabname" id="tabname" value="existing" />
                    </form>
                </div>
           		<div class="row mt-10">
               	<div class="col-lg-12 col-md-12 col-sm-12 col-12">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
              
                    <li class="nav-item waves-effect waves-light">
                        <a style="display:none" class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Previous</a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Next</a>
                        
                    </li>
               </ul>
               </div>
               </div>
			  
          	</div>
           
      </section>

    </section>
</div>
 
<textarea style="display:none" name="hometabdiv" id="hometabdiv"></textarea>
<textarea style="display:none" name="profiletabdiv" id="profiletabdiv"></textarea>
<style>
.display_class
{
	display:none;
}
</style>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo $site_url;?>js/html2canvas.min.js"></script>
<script type="text/javascript" src="<?php echo $site_url;?>js/canvas2image.js"></script>
<?php include("footer.php"); ?>
<script>

function cstmrtype(val)
{
	if(val == 1)
	{
		$('.tax_business').show();
	}
	else{
		$('.tax_business').hide();
	}
}

$(document).ready(function(){ 

	$("#submitRvcr").click(function()
	{ 
		var err=0;
		if($("#cid").val()=="")
		{
			err++;
			//$("#cid").attr("placeholder", "Please Enter Receiver Name.");
			//$("#cid").addClass("error_textbox");
			//$("#cid").focus();
			alert("Please Select Customer Name");
			return false;
		}
		if($("#rcvr_name").val()=="")
		{
			err++;
			$("#rcvr_name").attr("placeholder", "Please Enter Receiver Name.");
			$("#rcvr_name").addClass("error_textbox");
			$("#rcvr_name").focus();
			return false;
		}
		if($('#rcvr_mno').val()=="")
		{
			err++;
			$("#rcvr_mno").attr("placeholder", "Please Enter Contact Number.");
			$("#rcvr_mno").addClass("error_textbox");
			$("#rcvr_mno").focus();
			return false;
		}
		/*if($("#rcvr_landmark").val()=="")
		{
			err++;
			$("#rcvr_landmark").attr("placeholder", "Please Enter Area.");
			$("#rcvr_landmark").addClass("error_textbox");
			$("#rcvr_landmark").focus();
			return false;
		}*/
		if($("#rcvr_state").val()=="")
		{
			err++;
			$("#rcvr_state").attr("placeholder", "Please Select Provience.");
			$("#rcvr_state").addClass("error_textbox");
			$("#rcvr_state").focus();
			return false;
		}   

		if($("#rcvr_city").val()=="")
		{
			err++;
			$("#rcvr_city").attr("placeholder", "Please Select City.");
			$("#rcvr_city").addClass("error_textbox");
			$("#rcvr_city").focus();
			return false;
		}
		
		if($("#rcvr_iqamano").val()!="")
        {
			var r_iqm=$("#rcvr_iqamano").val();
			var str=r_iqm.length;
		    if(str<10 || str>10)
		    {
		    	err++;
		    	alert("Enter 10 Digit IQAMA Number Only");
				$("#rcvr_iqamano").attr("placeholder", "Enter 10 Digit IQAMA Number Only.");
				$("#rcvr_iqamano").addClass("error_textbox");
				$("#rcvr_iqamano").focus();
	            return false;
		    }
		}

		if($("#rcvr_vat_no").val()!="")
        {
		    var r_tax=$("#rcvr_vat_no").val();
			var str=r_tax.length;
		    if(str<15 || str>15)
		    {
		    	err++;
		    	alert("Enter 15 Digit VAT Number only");
				$("#rcvr_vat_no").attr("placeholder", "Enter 15 Digit VAT Number only.");
				$("#rcvr_vat_no").addClass("error_textbox");
				$("#rcvr_vat_no").focus();
	            return false;
		    }
		}

        if($("#rcvr_email").val()!="")
        {
            var str=$("#rcvr_email").val();
            var filter=/^.+@.+\..{2,3}$/;
            if(filter.test(str))
            { }
            else 
            {
                err++;
				$("#rcvr_email").attr("placeholder", "Please Enter Valid Email.");
				$("#rcvr_email").addClass("error_textbox");
				$("#rcvr_email").focus();
                return false;
            }
        }
		//alert(err);
		if(err == 0)
		{
			$('#myModal').modal('hide');
			$('#newRvcr').val(1);
		}
		
	});
});
function get_rcvr_city1(val,fld)
{
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{state:val,action:'get_city'},
	 success: function(data)
	 {	
	 	if(data.trim()=='Not Found')
		{
			$(".destination_city_cls1").html('<option value="">Select</option>');  
		}
		else if(data.trim()=='blank')
		{
			$(".destination_city_cls1").html('<option value="">Select</option>');  
		}
		else
		{
			$(".destination_city_cls1").html(data); 
		}
	  }
	});
	//$('#desti_cstm_state').val(val);
}
$('#submit').click(function(e){ 
	
});
</script>
<script type="text/javascript">
function checkwidth(fval)
{
    var str=fval.length;
    if(str<15 || str>15)
    {
        alert("Enter 15 Digit VAT Number only");
        return false;
    }
}
function mobilewidth(fval)
{
	var str=fval.length;
    if(str<10 || str>10)
    {
        alert("Enter 10 Digit Mobile Number Only");
        return false;
    }
}
function emailchk(fval)
{
	var str=fval;
	var filter=/^.+@.+\..{2,3}$/;
	if(filter.test(str))
	{ }
	else 
	{
		alert("Please Enter Valid Email-Id");
		return false;
	}
}
function iqamawidth(fval)
{
	var str=fval.length;
    if(str<10 || str>10)
    {
        alert("Enter 10 Digit IQAMA Number Only");
        return false;
    }
}
$(document).ready(function(){
	$('.cstmSourceCity').on('change', function() {
		
		var city_nm = $(':selected',this).val();
		$('#cust_source_city').val(city_nm);
	});
	$('.cstmSourceState').on('change', function() {
		
		var state_nm = $(':selected',this).val();
		$('#cust_source_state').val(state_nm);
	});
	$('.cstmRcvrState').on('change', function() {
		
		var state_nm = $(':selected',this).val();
		$('#cust_rvcr_state').val(state_nm);
	});

	
    $('#taxtype').on('change', function() {
      if ( this.value == 'Vat')
      {
        $("#vat").show();
        $("#hidevat").hide();
        
      }
      else
      {
        $("#hidevat").show();
        $("#vat").hide();
      }
    });
});
$(function(){
    /*var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    $('#pickup_date').attr('min', maxDate);
    $('#delivery_date').attr('min', maxDate);*/
    
});
</script>
<script>
$( document ).ready(function() {
    var homenew=$('#homenew').html();
	$('#hometabdiv').val(homenew);
	var profilenew=$('#profilenew').html();
	$('#profiletabdiv').val(profilenew);
	$('#profilenew').html(' ');
	
});
$('#profilenew-tab').on("click", function(e){
	$('#homenew').html(" ");
	
	$('#profilenew').html($('#profiletabdiv').val());
	//alert($('#tabname').val());
	$('#tabname').val('new');
	
});
$('#homenew-tab').on("click", function(e){
	$('#profilenew').html(" ");
	
	$('#homenew').html($('#hometabdiv').val());
	//alert($('#tabname').val());
	$('#tabname').val('existing');
});

/***** kkk 27-1-2022*****/
/*$('#profile-tab').on("click", function(e){
	$('#home-tab').show();
	$(this).hide();
});
$('#home-tab').on("click", function(e){
	$('#profile-tab').show();
	$(this).hide();
});*/
</script>

<script>
//package add more
var ci=1;
$('.add-comp').on("click", function(e){
	var no=parseInt(ci)+parseInt(1);
	$('#total_rows').val(parseInt($('#total_rows').val())+parseInt(1));
	var new_input = '<tr class="tr_'+ci+'">'+
	'<input type="text" name="trdata[]" value="0" class="trdata_'+ci+'">'+'<td>'+no+'</td><td><select name="type_of_product['+ci+']" id="type_of_product'+ci+'" class="form-control"><option value="">-- Select One --</option><option value="Document">Document</option><option value="Rolls">Rolls</option><option value="Kees">Kees</option><option value="Cartoon">Cartoon</option><option value="Box">Box</option><optionvalue="Bags">Bags</option></select></td><td><input type="text" name="quantity['+ci+']" id="quantity'+ci+'" class="form-control" value="" onkeypress="return isNumberKey(event);" onblur="get_calulation('+ci+')"></td><td><input type="text" name="price['+ci+']" id="price'+ci+'" class="form-control" value="" onkeypress="return isNumberKey(event);" onblur="get_calulation('+ci+')"></td><td><input type="text" name="discount['+ci+']" id="discount'+ci+'" class="form-control" value="" onkeypress="return isNumberKey(event);" onblur="get_calulation('+ci+')"></td><td><select name="tax['+ci+']" id="tax'+ci+'" class="form-control" onchange="get_calulation('+ci+')"><option value="0">15%</option></select></td><td><input type="text" name="amount['+ci+']" id="amount'+ci+'" class="form-control" value="" onkeypress="return isNumberKey(event);" readonly="readonly"></td><td><i class="fas fa-trash-alt newicon" id="'+ci+'" onclick="hidetr(this.id);"></i><input type="hidden" id="trremove_'+ci+'" value="1" name="trremove_'+ci+'" /></td></tr>';
	$('#compare_div').append(new_input);
	ci++;
});
//end for package add more
function hidetr(val)
{
	var chng =0;
	$('.tr_'+val).hide();
	$('#trremove_'+val).val(chng);
	$('#quantity'+val).val(0);
	$('#price'+val).val(0);
	$('#discount'+val).val(0);
	get_calulation(val);
}
function find_sub_total()
{
	var fid=$('#total_rows').val();
	var sub_tot=0; var total_package=0; var main_total=0;
	var tot_disc_per=0;
	for(var i=0; i<fid; i++)
	{
		if($('#trremove_'+i).val()!=0)
		{
			var amt=$('#amount'+i).val();
			var qnty=$('#quantity'+i).val();
			var price=$('#price'+i).val();
			var discount=$('#discount'+i).val();
			if(amt!='' && amt>0 && qnty!='' && qnty>0)
			{
				main_total=parseFloat(main_total)+parseFloat(parseFloat(qnty)*parseFloat(price));
				sub_tot=parseFloat(amt)+parseFloat(sub_tot);
				total_package=parseInt(total_package)+parseInt(qnty);
				if(discount!="" && discount>0)
				{
					tot_disc_per=parseFloat(tot_disc_per)+parseFloat(discount);
				}
			}
		}
		else
		{
			var amt=$('#amount'+i).val();
			var qnty=$('#quantity'+i).val();
			var price=$('#price'+i).val();
			if(amt!='' && amt>0 && qnty!='' && qnty>0)
			{
				main_total=parseFloat(main_total)-parseFloat(parseFloat(qnty)*parseFloat(price));
				sub_tot=parseFloat(amt)-parseFloat(sub_tot);
				total_package=parseInt(total_package)-parseInt(qnty);
			}
		}
	}
	console.log(main_total);
	$('#no_of_package').val(total_package);
	//$('#subtotal').text(sub_tot.toFixed(2));
	$('#total_val').text(main_total.toFixed(2));
	$('#spantotal').text(main_total.toFixed(2));
	
	//var tot_discount=parseFloat(main_total)-parseFloat(sub_tot);
	var sub_tot=""; var tot_discount =0;
	if(tot_disc_per!="" && tot_disc_per>0)
	{
		tot_discount =parseFloat(main_total)*parseFloat(tot_disc_per)/parseFloat(100);
		sub_tot=parseFloat(main_total)-parseFloat(tot_discount);
	}
	else
	{
		tot_discount=0;
		sub_tot=parseFloat(main_total)-parseFloat(tot_discount);
	}
	$('#subtotal').text(sub_tot.toFixed(2));
	
	$('#discount_val').text(tot_discount.toFixed(2));
	$('#spandiscount').text(tot_discount.toFixed(2));
	
	$('#total_val').text(main_total.toFixed(2));
	$('#spantotal').text(main_total.toFixed(2));
	
	if($('#vatper').text()>0 && $('#vatper').text()!='')
	{
		var subtot=$('#subtotal').text();
		$('#subtotal_val').val(subtot);
		
		var vat=$('#vatper').text();
		$('#vatper_val').val(vat);

		var tot=parseFloat(parseFloat(subtot)*parseFloat(vat))/parseFloat(100);
		$('#vattotal').text(tot.toFixed(2));
		$('#vattotal_val').val(tot.toFixed(2));

		var tot=parseFloat(tot)+parseFloat(subtot);
		$('#finaltotal').text(tot.toFixed(2));
		$('#finaltotal_val').val(tot.toFixed(2));

		
		$('#total_amount').text(tot.toFixed(2));
		$('#total_fc').val(tot.toFixed(2));
	}
	else
	{
		var subtot=$('#subtotal').text();
		$('#subtotal_val').val(subtot);

		$('#finaltotal').text(subtot);
		$('#finaltotal_val').val(subtot);
		$('#total_amount').text(subtot);
		$('#total_fc').val(subtot);
	}
}
function get_calulation(fid)
{
	var qnty=$('#quantity'+fid).val();
	var price=$('#price'+fid).val();
	var disc=$('#discount'+fid).val();
	var tax=$('#tax'+fid).val();
	
	if(qnty>0 && qnty!='' && price!='' && price>0 && $('#trremove_'+fid).val()!=0)
	{
		var sub_price=parseFloat(qnty)*parseFloat(price);
		var disc_tot=0;
		if(disc!='' && disc>0)
		{
			disc_tot= parseFloat(parseFloat(sub_price)*parseFloat(disc))/parseInt(100);
			disc_tot=disc_tot.toFixed(2);
		}
		var sub_total=parseFloat(sub_price)-parseFloat(disc_tot);
		var tax_amt=0; tax=15;
		//if(tax>0)
		//{
			
			tax_amt=(parseFloat(sub_total)*parseInt(tax))/parseInt(100);
			tax_amt=tax_amt.toFixed(2);
		//}
		//alert(tax_amt);
		//alert(sub_price+'--'+disc_tot+'--'+tax_amt);
		//var amt=parseFloat(sub_price)-parseFloat(disc_tot)+parseFloat(tax_amt);
		var amt=parseFloat(sub_total)+parseFloat(tax_amt);
		amt=amt.toFixed(2);
		$('#amount'+fid).val(amt);
		find_sub_total();
	}
}

function submit_new_customer()
{
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data : $('#frmnewcusto').serialize() + "&action=save_new_customer",
	 success: function(data)
	 {	
	 	if(data.trim()=='Something Wrong... Try Again...')
		{
			alert(data);
		}
		else if(data.trim()=='Customer Email-Id Already Exist...')
		{
			alert(data);
		}
		else
		{
			var cid=data.split('~~');
			$("#divcusto").html(cid[0]);
			$("#sender_name").val($('#name').val());
			$('#myModal').modal('toggle'); 
			selectSender($('#name').val(),cid[1]);
		}
	  }
	});
}
function submit_new_customer()
{
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data : $('#frmnewcusto').serialize() + "&action=save_new_customer",
	 success: function(data)
	 {	
	 	
	 	if(data.trim()=='Something Wrong... Try Again...')
		{
			alert(data);
		}
		else if(data.trim()=='Customer Email-Id Already Exist...')
		{
			alert(data);
		}
		else
		{
			alert("Customer added successfully");
			var cid=data.split('~~');
			$("#divcusto").html(cid[0]);
			$("#sender_name").val($('#name').val());
			$('#myModal').modal('toggle'); 
			selectSender($('#name').val(),cid[1]);

		}
	  }
	});
}
</script>
<script type="text/javascript">
var mouse_is_inside = false;

$(document).ready(function()
{
    $('#suggesstion-box-sender').hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });

    $("body").mouseup(function(){ 
        if(! mouse_is_inside) $('#suggesstion-box-sender').hide();
    });
	
	
	$('#suggesstion-box').hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });

    $("body").mouseup(function(){ 
        if(! mouse_is_inside) $('#suggesstion-box').hide();
    });
});
$(document).ready(function(){
	//$("#sender_name").keyup(function(){
	$(document).on('keyup','#sender_name',function( e ) { 
		$.ajax({
		type: "POST",
		url: "<?php echo $site_url; ?>admin_ajax.php",
		data:'keyword_sender='+$(this).val(),
		beforeSend: function(){
			$("#sender_name").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box-sender").show();
			$("#suggesstion-box-sender").html(data);
			$("#sender_name").css("background","#FFF");
		}
		});
	});
	
	//$("#sender_mobile").keyup(function(){ 
	$(document).on('keyup','#sender_mobile',function( e ) {
		$.ajax({
		type: "POST",
		url: "<?php echo $site_url; ?>admin_ajax.php",
		data:'keyword_mobile_sender='+$(this).val(),
		beforeSend: function(){
			$("#sender_mobile").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box-sender-mobile").show();
			$("#suggesstion-box-sender-mobile").html(data);
			$("#sender_mobile").css("background","#FFF");
		}
		});
	});
	 
	
	//$("#desti_name").keyup(function(){
	$(document).on('keyup','#desti_name',function( e ) {
		var sender_id=$('#sender_id').val();
		$.ajax({
		type: "POST",
		url: "<?php echo $site_url; ?>admin_ajax.php",
		data:'keyword_receiver='+$(this).val()+"&sender_id="+sender_id,
		beforeSend: function(){
			$("#desti_name").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#desti_name").css("background","#FFF");
		}
		});
	});
});
//To select country name
function selectCountry(val,cid) {
	$("#desti_name").val(val);
	$("#suggesstion-box").hide();
	$.ajax({
		type: "POST",
		url: "<?php echo $site_url; ?>admin_ajax.php",
		data:'action=get_customer_other_info&cid='+cid,
		beforeSend: function(){
			$("#desti_name").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			var abc=data.split("~~");
			$("#desti_email").val(abc[0]);
			$("#destination_address").val(abc[2]);
			$("#desti_mobile").val(abc[1]);
		}
		});
}
function selectReceiverCountry(val,cid) {
	$("#desti_name").val(val);
	$("#suggesstion-box").hide();
	$.ajax({
		type: "POST",
		url: "<?php echo $site_url; ?>admin_ajax.php",
		data:'action=get_customer_other_info_for_receiver&cid='+cid,
		beforeSend: function(){
			$("#desti_name").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			var abc=data.split("~~");
			$("#desti_email").val(abc[1]);
			$("#destination_address").val(abc[3]);
			$("#desti_mobile").val(abc[2]);
			
			$("#destination_state").val(abc[5]);
			$("#destination_city").val(abc[6]);
			//$("#desti_landmark").val(abc[7]);
			
			$("#desti_iqamano").val(abc[8]);
			$("#desti_vat_no").val(abc[9]);
			
			$("#desti_cstm_city").val(abc[6]);
			$("#desti_cstm_state").val(abc[5]);
			$("#desti_company").val(abc[10]);
			
		}
	});
}
function getReceiverAllinfo(field)
{
	var selectedText = field.options[field.selectedIndex].innerHTML;
    var selectedValue = field.value;
	$("#desti_name").val(selectedText);
	
	$.ajax({
		type: "POST",
		url: "<?php echo $site_url; ?>admin_ajax.php",
		data:'action=get_customer_other_info_for_receiver&cid='+selectedValue,
		beforeSend: function(){
			$("#desti_name").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			var abc=data.split("~~");
			$("#desti_email").val(abc[1]);
			$("#destination_address").val(abc[3]);
			$("#desti_mobile").val(abc[2]);
			
			$("#destination_state").val(abc[5]);
			$("#destination_city").val(abc[6]);
			//$("#desti_landmark").val(abc[7]);
			
			$("#desti_iqamano").val(abc[8]);
			$("#desti_vat_no").val(abc[9]);
			
			$("#desti_cstm_city").val(abc[6]);
			$("#desti_cstm_state").val(abc[5]);
			$("#desti_company").val(abc[10]);
			
		}
		});
}
function callReceiver(cid) {
	$.ajax({
		type: "POST",
		url: "<?php echo $site_url; ?>admin_ajax.php",
		data:'action=get_customers_receiver&cid='+cid,
		beforeSend: function(){
			$("#desti_name").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$('#destidrop').html(data);
		}
	});
}
function selectSender(val,cid) {
	$("#sender_name").val(val);
	if(cid=='new')
	{
		$("#suggesstion-box-sender").hide();
		$('#add_cust').trigger('click');
	}
	else
	{
	$("#suggesstion-box-sender").hide();
	$.ajax({
		type: "POST",
		url: "<?php echo $site_url; ?>admin_ajax.php",
		data:'action=get_customer_other_info&cid='+cid,
		beforeSend: function(){
			$("#sender_name").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){ //alert(data);
			var abc=data.split("~~");
			$('#sender_id').val(cid);
			$('#cid').val(cid);
			$("#sendername").text(abc[13]);
			$("#senderno").text(abc[1]);
			$("#sender_email").val(abc[0]);
			$("#source_address").val(abc[2]);
			$("#sender_mobile").val(abc[1]);
			
			//$("#source_country").val(abc[3]);
			$("#source_state").val(abc[4]);
			$("#source_city").val(abc[5]);
			//$("#area").val(abc[19]);
			$("#company_name").val(abc[20]);
			
			/*$("#desti_name").val(abc[6]);
			$("#desti_email").val(abc[7]);
			$("#destination_address").val(abc[9]);
			$("#desti_mobile").val(abc[8]);
			
			$("#destination_state").val(abc[11]);
			$("#destination_country").val(abc[10]);
			$("#destination_city").val(abc[12]);*/
			
			//if(abc[14]!='' && abc[14]=='Vat'){
			$('#tax_percentage').val("15");
			$("#vatper").text("15");
			//}
			/*else{
				$('#tax_percentage').val("0");
				$("#vatper").text("0");
			}*/ 
			/*$("#desti_vat_no").val(abc[15]);
			$("#desti_iqamano").val(abc[16]);*/
			
			$("#customerid").val(abc[17]);
			$("#taxnumber1").val(abc[18]);
			
			$("#cstm_city").val(abc[5]);
			$("#cstm_state").val(abc[4]);
			
			if(abc[14] == 'Non-Vat')
			{
				$('.e_tax_business').hide();
			}
			else{
				$('.e_tax_business').show();
				$("#taxtype").val(abc[14]);
			}
			callReceiver(cid);
		}
		});
	}
}
function selectSenderMobile(val,cid) {
	$("#sender_mobile").val(val);
	if(cid=='new')
	{
		$("#suggesstion-box-sender-mobile").hide();
		$('#add_cust').trigger('click');
	}
	else
	{
	$("#suggesstion-box-sender-mobile").hide();
	$.ajax({
		type: "POST",
		url: "<?php echo $site_url; ?>admin_ajax.php",
		data:'action=get_customer_other_info&cid='+cid,
		beforeSend: function(){
			$("#sender_mobile").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){ //alert(data);
			var abc=data.split("~~");
			$('#sender_id').val(cid);
			$('#cid').val(cid);
			$("#sendername").text(abc[13]);
			$("#senderno").text(abc[1]);
			$("#sender_email").val(abc[0]);
			$("#source_address").val(abc[2]);
			$("#sender_name").val(abc[13]);
			
			$("#source_country").val(abc[3]);
			$("#source_state").val(abc[4]);
			$("#source_city").val(abc[5]);
			//$("#area").val(abc[20]);
			$("#company_name").val(abc[20]);
			
			
			/*$("#desti_name").val(abc[6]);
			$("#desti_email").val(abc[7]);
			$("#destination_address").val(abc[9]);
			$("#desti_mobile").val(abc[8]);
			
			$("#destination_state").val(abc[11]);
			$("#destination_country").val(abc[10]);
			$("#destination_city").val(abc[12]);
			
			$("#desti_vat_no").val(abc[15]);
			$("#desti_iqamano").val(abc[16]);*/
			$('#tax_percentage').val("15");
			$("#vatper").text("15");
			
			$("#customerid").val(abc[17]);
			$("#taxnumber1").val(abc[18]);
			
			$("#cstm_city").val(abc[5]);
			$("#cstm_state").val(abc[4]);
			if(abc[14] == 'Non-Vat')
			{
				$('.e_tax_business').hide();
			}
			else{
				$('.e_tax_business').show();
				$("#taxtype").val(abc[14]);
			}
		}
		});
	}
}
$( document ).ready(function() {
   <?php 
   if(@$_GET['id']=='')
  { ?>	
   $( ".toCanvas" ).click();
    console.log( "ready!" ); <?php
  }?>
});
var test = $(".testimg").get(0);
// to canvas
$('.toCanvas').click(function(e) 
{    
	html2canvas(test).then(function(canvas) 
	{
    	var imgsrc = canvas.toDataURL("image/png"); 
       	console.log(imgsrc); 
        $("#newimg").attr('src', imgsrc); 
        // $("#img").show(); 
        var dataURL = canvas.toDataURL(); 
        $.ajax({ 
        	type: "POST", 
            url: "<?php echo $site_url; ?>image_save_script.php", 
            data: { imgBase64: dataURL  } 
      	}).done(function(o) 
		{ 
			//alert(o);
			var filename=o.split("/");
			$('#barcode_image').val(filename[1]);
        	console.log('saved'); 
        }); 
	});
	//$("#qrbox").hide();
});

</script>

<script>
function display_dept(val,fld)
{
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{brandhid:val,action:'get_dept'},
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
function display_agent(val,fld)
{

	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{deptid:val,action:'get_agent'},
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
$(document).ready(function(){ 
	/*** old submit validation code kkkk 27-1-2022 ***/
	/**** change button name #submit to #submit11****/
	$("#submit11").click(function()
	{ 
		var err=0;
		if($("#invoice_number").val()=="")
		{
			err++;
			$("#invoice_number").attr("placeholder", "Please Enter Invoice Number.");
			$("#invoice_number").addClass("error_textbox");
			alert("Please Enter Invoice Number.");
			$("#invoice_number").focus();
			return false;
		}
		if($('#invoice_date').val()=="")
		{
			err++;
			$("#invoice_date").attr("placeholder", "Please Select Invoice Date.");
			$("#invoice_date").addClass("error_textbox");
			alert("Please Select Invoice Date.");
			$("#invoice_date").focus();
			return false;
		}
		if($("#sender_deptid").val()=="")
		{
			err++;
			$("#sender_deptid").attr("placeholder", "Please Select Sender Department.");
			$("#sender_deptid").addClass("error_textbox");
			alert("Please Select Sender Department.");
			$("#sender_deptid").focus();
			return false;
		}
		if($("#sender_agentid").val()=="")
		{
			err++;
			$("#sender_agentid").attr("placeholder", "Please Select Sender Agent.");
			$("#sender_agentid").addClass("error_textbox");
			alert("Please Select Sender Agent.");
			$("#sender_agentid").focus();
			return false;
		}   
		/*if($("#desti_deptid").val()=="")
		{
			err++;
			$("#desti_deptid").attr("placeholder", "Please Select Destination Deptarment.");
			$("#desti_deptid").addClass("error_textbox");
			alert("Please Select Destination Deptarment.");
			$("#desti_deptid").focus();
			return false;
		}
		if($("#desti_agentid").val()=="")
		{
			err++;
			$("#desti_agentid").attr("placeholder", "Please Select Destination Agent.");
			$("#desti_agentid").addClass("error_textbox");
			alert("Please Select Destination Agent.");
			$("#desti_agentid").focus();
			return false;
		}*/

		if($("#customerid").val()!="")
        {
			var s_iqm=$("#customerid").val();
			var str=s_iqm.length;
		    if(str<10 || str>10)
		    {
		    	err++;
		    	alert("Enter 10 Digit IQAMA Number Only");
				$("#customerid").attr("placeholder", "Enter 10 Digit IQAMA Number Only.");
				$("#customerid").addClass("error_textbox");
				$("#customerid").focus();
	            return false;
		    }
		}

		if($("#taxnumber1").val()!="")
        {
		    var s_tax=$("#taxnumber1").val();
			var str=s_tax.length;
		    if(str<15 || str>15)
		    {
		    	err++;
		    	alert("Enter 15 Digit VAT Number only");
				$("#taxnumber1").attr("placeholder", "Enter 15 Digit VAT Number only.");
				$("#taxnumber1").addClass("error_textbox");
				$("#taxnumber1").focus();
	            return false;
		    }
		}
		if($('#tabname').val()=='new')
		{
			if($('#business').prop('checked'))
			{
				if($('#taxtype').val()!='Non-Vat')
				{
					if($("#taxnumber1").val()=="")
					{
						err++;
						alert("Enter 15 Digit VAT Number only");
						$("#taxnumber1").attr("placeholder", "Enter 15 Digit VAT Number only.");
						$("#taxnumber1").addClass("error_textbox");
						$("#taxnumber1").focus();
						return false;
					}
				}
			}
		}
		if($("#desti_iqamano").val()!="")
        {
		    var r_iqm=$("#desti_iqamano").val();
			var str=r_iqm.length;
		    if(str<10 || str>10)
		    {
		    	err++;
		    	alert("Enter 10 Digit IQAMA Number Only");
				$("#desti_iqamano").attr("placeholder", "Enter 10 Digit IQAMA Number Only.");
				$("#desti_iqamano").addClass("error_textbox");
				$("#desti_iqamano").focus();
	            return false;
		    }
		}

		if($("#desti_vat_no").val()!="")
        {
		    var r_tax=$("#desti_vat_no").val();
			var str=r_tax.length;
		    if(str<15 || str>15)
		    {
		    	err++;
		    	alert("Enter 15 Digit VAT Number only");
				$("#desti_vat_no").attr("placeholder", "Enter 15 Digit VAT Number only.");
				$("#desti_vat_no").addClass("error_textbox");
				$("#desti_vat_no").focus();
	            return false;
		    }
		}
		if($("#sender_email").val()!="")
        {
          
            var str=$("#sender_email").val();
            var filter=/^.+@.+\..{2,3}$/;
            if(filter.test(str))
            { }
            else 
            {
                err++;
				$("#sender_email").attr("placeholder", "Please Enter Valid Email.");
				$("#sender_email").addClass("error_textbox");
				alert("Please Enter Valid Email.");
				$("#sender_email").focus();
                return false;
            }
        }
		if($("#source_state").val()=="")
		{
			err++;
			$("#source_state").attr("placeholder", "Please Select Source State.");
			$("#source_state").addClass("error_textbox");
			alert("Please Select Source State.");
			$("#source_state").focus();
			return false;
		}
		
		if($("#source_city").val()=="")
		{
			err++;
			$("#source_city").attr("placeholder", "Please Select Source City");
			$("#source_city").addClass("error_textbox");
			$("#source_city").focus();
			alert("Please Select Source City.");
			return false;
		} 
		if($("#destination_state").val()=="")
		{
			err++;
			$("#destination_state").attr("placeholder", "Please Select Destination State.");
			$("#destination_state").addClass("error_textbox");
			$("#destination_state").focus();
			alert("Please Select Destination State.");
			return false;
		}
		if($("#destination_city").val()=="")
		{
			err++;
			$("#destination_city").attr("placeholder", "Please Select Destination City");
			$("#destination_city").addClass("error_textbox");
			alert("Please Select Destination City.");
			$("#destination_city").focus();
			return false;
		}    
		/*if($("#area").val()=="")
		{
			err++;
			$("#area").attr("placeholder", "Please Enter Source Area");
			$("#area").addClass("error_textbox");
			alert("Please Enter Source Area");
			$("#area").focus();
			return false;
		}    
		if($("#desti_landmark").val()=="")
		{
			err++;
			$("#desti_landmark").attr("placeholder", "Please Select Destination Area");
			$("#desti_landmark").addClass("error_textbox");
			alert("Please Select Destination Area.");
			$("#desti_landmark").focus();
			return false;
		}  */
		if($("#desti_email").val()!="")
        {
            var str=$("#desti_email").val();
            var filter=/^.+@.+\..{2,3}$/;
            if(filter.test(str))
            { }
            else 
            {
                err++;
				$("#desti_email").attr("placeholder", "Please Enter Valid Email.");
				$("#desti_email").addClass("error_textbox");
				$("#desti_email").focus();
				alert("Please Enter Valid Email.");
                return false;
            }
        }
		   
		if($("#sender_name").val()=="")
		{
			err++;
			$("#sender_name").attr("placeholder", "Please Enter Sender Name.");
			$("#sender_name").addClass("error_textbox");
			$("#sender_name").focus();
			alert("Please Enter Sender Name.");
			return false;
		}
		if($("#sender_mobile").val()=="")
		{
			err++;
			$("#sender_mobile").attr("placeholder", "Please Enter Sender Mobile.");
			$("#sender_mobile").addClass("error_textbox");
			alert("Please Enter Sender Mobile.");
			$("#sender_mobile").focus();
			return false;
		}
		if($("#desti_name").val()=="")
		{
			err++;
			$("#desti_name").attr("placeholder", "Please Enter Receiver Name.");
			$("#desti_name").addClass("error_textbox");
			alert("Please Enter Receiver Name.");
			$("#desti_name").focus();
			return false;
		}
		if($("#desti_mobile").val()=="")
		{
			err++;
			$("#desti_mobile").attr("placeholder", "Please Enter Receiver Mobile.");
			$("#desti_mobile").addClass("error_textbox");
			$("#desti_mobile").focus();
			alert("Please Enter Receiver Mobile.");
			return false;
		}
		/*if($("#sender_email").val()=="")
		{
			err++;
			$("#sender_email").attr("placeholder", "Please Enter Sender Email.");
			$("#sender_email").addClass("error_textbox");
			$("#sender_email").focus();
			return false;
		}*/
		if($("#source_address").val()=="")
		{
			err++;
			$("#source_address").attr("placeholder", "Please Enter Sender Address.");
			$("#source_address").addClass("error_textbox");
			$("#source_address").focus();
			alert("Please Enter Sender Address.");
			return false;
		}
		
		if($("#destination_address").val()=="")
		{
			err++;
			$("#destination_address").attr("placeholder", "Please Enter Receiver Address.");
			$("#destination_address").addClass("error_textbox");
			$("#destination_address").focus();
			alert("Please Enter Receiver Address.");
			return false;
		}
		/*if($("#desti_email").val()=="")
		{
			err++;
			$("#desti_email").attr("placeholder", "Please Enter Receiver Email.");
			$("#desti_email").addClass("error_textbox");
			$("#desti_email").focus();
			return false;
		}
		if($("#no_of_package").val()=="")
		{
			$("#no_of_package").attr("placeholder", "Please Enter Number of Package.");
			$("#no_of_package").addClass("error_textbox");
			$("#no_of_package").focus();
			return false;
		}
		if($("#amount").val()=="")
		{
			$("#amount").attr("placeholder", "Please Enter Amount.");
			$("#amount").addClass("error_textbox");
			$("#amount").focus();
			return false;
		}
		if($("#tax_percentage").val()=="")
		{
			$("#tax_percentage").attr("placeholder", "Please Select Tax Percentage.");
			$("#tax_percentage").addClass("error_textbox");
			$("#tax_percentage").focus();
			return false;
		}
		if($("#total_case").val()=="")
		{
			$("#total_case").attr("placeholder", "Please Enter Total Cash Amount.");
			$("#total_case").addClass("error_textbox");
			$("#total_case").focus();
			return false;
		}*/  
		if($("#mode_of_payment").val()=="")
		{
			err++;
			$("#mode_of_payment").attr("placeholder", "Please Select Payment Mode.");
			$("#mode_of_payment").addClass("error_textbox");
			alert("Please Select Payment Mode.");
			$("#mode_of_payment").focus();
			return false;
		}
		if(err<=0)
		{
			$("#submit").html("Processing..");
			$('#submit').unbind('click');
			//$("#submit").prop("disabled", true);
			//$('#bg').submit();
		}
	});

	/**** new code 27-1-2022****/
	$("#submit").click(function()
	{
		var err=0;
		if($("#mode_of_payment").val()=="")
		{
			err++;
			$("#mode_of_payment").attr("placeholder", "Please Select Payment Mode.");
			$("#mode_of_payment").addClass("error_textbox");
			alert("Please Select Payment Mode.");
			$("#mode_of_payment").focus();
			return false;
		}
		if(err<=0)
		{
			$("#submit").html("Processing..");
			$('#submit').unbind('click');
		}
	});
	$("#profile-tab").click(function()
	{ 
		var err=0;
		if($("#invoice_number").val()=="")
		{
			err++;
			$("#invoice_number").attr("placeholder", "Please Enter Invoice Number.");
			$("#invoice_number").addClass("error_textbox");
			alert("Please Enter Invoice Number.");
			$("#invoice_number").focus();
			return false;
		}
		if($('#invoice_date').val()=="")
		{
			err++;
			$("#invoice_date").attr("placeholder", "Please Select Invoice Date.");
			$("#invoice_date").addClass("error_textbox");
			alert("Please Select Invoice Date.");
			$("#invoice_date").focus();
			return false;
		}
		if($("#sender_deptid").val()=="")
		{
			err++;
			$("#sender_deptid").attr("placeholder", "Please Select Sender Department.");
			$("#sender_deptid").addClass("error_textbox");
			alert("Please Select Sender Department.");
			$("#sender_deptid").focus();
			return false;
		}
		if($("#sender_agentid").val()=="")
		{
			err++;
			$("#sender_agentid").attr("placeholder", "Please Select Sender Agent.");
			$("#sender_agentid").addClass("error_textbox");
			alert("Please Select Sender Agent.");
			$("#sender_agentid").focus();
			return false;
		}   
		/*if($("#desti_deptid").val()=="")
		{
			err++;
			$("#desti_deptid").attr("placeholder", "Please Select Destination Deptarment.");
			$("#desti_deptid").addClass("error_textbox");
			alert("Please Select Destination Deptarment.");
			$("#desti_deptid").focus();
			return false;
		}
		if($("#desti_agentid").val()=="")
		{
			err++;
			$("#desti_agentid").attr("placeholder", "Please Select Destination Agent.");
			$("#desti_agentid").addClass("error_textbox");
			alert("Please Select Destination Agent.");
			$("#desti_agentid").focus();
			return false;
		}*/

		if($("#customerid").val()!="")
        {
			var s_iqm=$("#customerid").val();
			var str=s_iqm.length;
		    if(str<10 || str>10)
		    {
		    	err++;
		    	alert("Enter 10 Digit IQAMA Number Only");
				$("#customerid").attr("placeholder", "Enter 10 Digit IQAMA Number Only.");
				$("#customerid").addClass("error_textbox");
				$("#customerid").focus();
	            return false;
		    }
		}

		if($("#taxnumber1").val()!="")
        {
		    var s_tax=$("#taxnumber1").val();
			var str=s_tax.length;
		    if(str<15 || str>15)
		    {
		    	err++;
		    	alert("Enter 15 Digit VAT Number only");
				$("#taxnumber1").attr("placeholder", "Enter 15 Digit VAT Number only.");
				$("#taxnumber1").addClass("error_textbox");
				$("#taxnumber1").focus();
	            return false;
		    }
		}
		if($('#tabname').val()=='new')
		{
			if($('#business').prop('checked'))
			{
				if($('#taxtype').val()!='Non-Vat')
				{
					if($("#taxnumber1").val()=="")
					{
						err++;
						alert("Enter 15 Digit VAT Number only");
						$("#taxnumber1").attr("placeholder", "Enter 15 Digit VAT Number only.");
						$("#taxnumber1").addClass("error_textbox");
						$("#taxnumber1").focus();
						return false;
					}
				}
			}
		}
		if($("#desti_iqamano").val()!="")
        {
		    var r_iqm=$("#desti_iqamano").val();
			var str=r_iqm.length;
		    if(str<10 || str>10)
		    {
		    	err++;
		    	alert("Enter 10 Digit IQAMA Number Only");
				$("#desti_iqamano").attr("placeholder", "Enter 10 Digit IQAMA Number Only.");
				$("#desti_iqamano").addClass("error_textbox");
				$("#desti_iqamano").focus();
	            return false;
		    }
		}

		if($("#desti_vat_no").val()!="")
        {
		    var r_tax=$("#desti_vat_no").val();
			var str=r_tax.length;
		    if(str<15 || str>15)
		    {
		    	err++;
		    	alert("Enter 15 Digit VAT Number only");
				$("#desti_vat_no").attr("placeholder", "Enter 15 Digit VAT Number only.");
				$("#desti_vat_no").addClass("error_textbox");
				$("#desti_vat_no").focus();
	            return false;
		    }
		}
		if($("#sender_email").val()!="")
        {
          
            var str=$("#sender_email").val();
            var filter=/^.+@.+\..{2,3}$/;
            if(filter.test(str))
            { }
            else 
            {
                err++;
				$("#sender_email").attr("placeholder", "Please Enter Valid Email.");
				$("#sender_email").addClass("error_textbox");
				alert("Please Enter Valid Email.");
				$("#sender_email").focus();
                return false;
            }
        }
		if($("#source_state").val()=="")
		{
			err++;
			$("#source_state").attr("placeholder", "Please Select Source State.");
			$("#source_state").addClass("error_textbox");
			alert("Please Select Source State.");
			$("#source_state").focus();
			return false;
		}
		
		if($("#source_city").val()=="")
		{
			err++;
			$("#source_city").attr("placeholder", "Please Select Source City");
			$("#source_city").addClass("error_textbox");
			$("#source_city").focus();
			alert("Please Select Source City.");
			return false;
		} 
		if($("#destination_state").val()=="")
		{
			err++;
			$("#destination_state").attr("placeholder", "Please Select Destination State.");
			$("#destination_state").addClass("error_textbox");
			$("#destination_state").focus();
			alert("Please Select Destination State.");
			return false;
		}
		if($("#destination_city").val()=="")
		{
			err++;
			$("#destination_city").attr("placeholder", "Please Select Destination City");
			$("#destination_city").addClass("error_textbox");
			alert("Please Select Destination City.");
			$("#destination_city").focus();
			return false;
		}    
		/*if($("#area").val()=="")
		{
			err++;
			$("#area").attr("placeholder", "Please Enter Source Area");
			$("#area").addClass("error_textbox");
			alert("Please Enter Source Area");
			$("#area").focus();
			return false;
		}    
		if($("#desti_landmark").val()=="")
		{
			err++;
			$("#desti_landmark").attr("placeholder", "Please Select Destination Area");
			$("#desti_landmark").addClass("error_textbox");
			alert("Please Select Destination Area.");
			$("#desti_landmark").focus();
			return false;
		}  */
		if($("#desti_email").val()!="")
        {
            var str=$("#desti_email").val();
            var filter=/^.+@.+\..{2,3}$/;
            if(filter.test(str))
            { }
            else 
            {
                err++;
				$("#desti_email").attr("placeholder", "Please Enter Valid Email.");
				$("#desti_email").addClass("error_textbox");
				$("#desti_email").focus();
				alert("Please Enter Valid Email.");
                return false;
            }
        }
		   
		if($("#sender_name").val()=="")
		{
			err++;
			$("#sender_name").attr("placeholder", "Please Enter Sender Name.");
			$("#sender_name").addClass("error_textbox");
			$("#sender_name").focus();
			alert("Please Enter Sender Name.");
			return false;
		}
		if($("#sender_mobile").val()=="")
		{
			err++;
			$("#sender_mobile").attr("placeholder", "Please Enter Sender Mobile.");
			$("#sender_mobile").addClass("error_textbox");
			alert("Please Enter Sender Mobile.");
			$("#sender_mobile").focus();
			return false;
		}
		if($("#desti_name").val()=="")
		{
			err++;
			$("#desti_name").attr("placeholder", "Please Enter Receiver Name.");
			$("#desti_name").addClass("error_textbox");
			alert("Please Enter Receiver Name.");
			$("#desti_name").focus();
			return false;
		}
		if($("#desti_mobile").val()=="")
		{
			err++;
			$("#desti_mobile").attr("placeholder", "Please Enter Receiver Mobile.");
			$("#desti_mobile").addClass("error_textbox");
			$("#desti_mobile").focus();
			alert("Please Enter Receiver Mobile.");
			return false;
		}
		/*if($("#sender_email").val()=="")
		{
			err++;
			$("#sender_email").attr("placeholder", "Please Enter Sender Email.");
			$("#sender_email").addClass("error_textbox");
			$("#sender_email").focus();
			return false;
		}*/
		if($("#source_address").val()=="")
		{
			err++;
			$("#source_address").attr("placeholder", "Please Enter Sender Address.");
			$("#source_address").addClass("error_textbox");
			$("#source_address").focus();
			alert("Please Enter Sender Address.");
			return false;
		}
		
		if($("#destination_address").val()=="")
		{
			err++;
			$("#destination_address").attr("placeholder", "Please Enter Receiver Address.");
			$("#destination_address").addClass("error_textbox");
			$("#destination_address").focus();
			alert("Please Enter Receiver Address.");
			return false;
		}
		/*if($("#desti_email").val()=="")
		{
			err++;
			$("#desti_email").attr("placeholder", "Please Enter Receiver Email.");
			$("#desti_email").addClass("error_textbox");
			$("#desti_email").focus();
			return false;
		}
		if($("#no_of_package").val()=="")
		{
			$("#no_of_package").attr("placeholder", "Please Enter Number of Package.");
			$("#no_of_package").addClass("error_textbox");
			$("#no_of_package").focus();
			return false;
		}
		if($("#amount").val()=="")
		{
			$("#amount").attr("placeholder", "Please Enter Amount.");
			$("#amount").addClass("error_textbox");
			$("#amount").focus();
			return false;
		}
		if($("#tax_percentage").val()=="")
		{
			$("#tax_percentage").attr("placeholder", "Please Select Tax Percentage.");
			$("#tax_percentage").addClass("error_textbox");
			$("#tax_percentage").focus();
			return false;
		}
		if($("#total_case").val()=="")
		{
			$("#total_case").attr("placeholder", "Please Enter Total Cash Amount.");
			$("#total_case").addClass("error_textbox");
			$("#total_case").focus();
			return false;
		}*/  
		/*if($("#mode_of_payment").val()=="")
		{
			err++;
			$("#mode_of_payment").attr("placeholder", "Please Select Payment Mode.");
			$("#mode_of_payment").addClass("error_textbox");
			alert("Please Select Payment Mode.");
			$("#mode_of_payment").focus();
			return false;
		}*/
		if(err<=0)
		{
			$('#home-tab').show();
			$(this).hide();
			//$("#submit").html("Processing..");
			//$('#submit').unbind('click');
			//$("#submit").prop("disabled", true);
			//$('#bg').submit();
		}
	});

	$("#home-tab").click(function()
	{
		var err=0;
		if($("#mode_of_payment").val()=="")
		{
			err++;
			$("#mode_of_payment").attr("placeholder", "Please Select Payment Mode.");
			$("#mode_of_payment").addClass("error_textbox");
			alert("Please Select Payment Mode.");
			$("#mode_of_payment").focus();
			return false;
		}
		if(err<=0)
		{
			$('#profile-tab').show();
			$(this).hide();
			//$("#submit").html("Processing..");
			//$('#submit').unbind('click');
			//$("#submit").prop("disabled", true);
			//$('#bg').submit();
		}
	});


});
function calculate_FC()
{ 
	var total_amt=$('#finaltotal').text();
	var total_case=$('#total_case').val(); 


	var total_fc=$('#total_fc').val();

	console.log(parseFloat(total_case) +'=='+ parseFloat(total_amt));
	
	if(parseFloat(total_case) == parseFloat(total_amt) || parseFloat(total_case) === parseFloat(0))
	{	
		total_fc=parseFloat(total_amt)-parseFloat(total_case);
		total_fc=total_fc.toFixed(2);
		$('#total_fc').val(total_fc);
		$("#err_total_case").html("");
	}
	else if(parseFloat(total_case) < parseFloat(total_amt))
	{
		$("#err_total_case").html("You have to pay either full amount or 0 ");
	}
}
	
function calculate_total_amount(fld)
{
	var amt=$('#amount').val();
	var tot = (parseFloat(fld)*parseFloat(amt))/parseFloat(100);
	var tot_amt=parseFloat(amt)+parseFloat(tot);
	tot_amt=tot_amt.toFixed(2);
	$('#total_amount').val(tot_amt);
	
	
}
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
			$(".source_city_cls").html('<option value="">Select</option>');  
		}
		else if(data.trim()=='blank')
		{
			$("#"+fld).html('<option value="">Select</option>');
			$(".source_city_cls").html('<option value="">Select</option>');  
			
		}
		else
		{
			$("#"+fld).html(data); 
			$(".source_city_cls").html(data);  
		}
	  }
	});
	$('#cstm_state').val(val);
}
function get_rcvr_city(val,fld)
{
	/*$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{state:val,action:'get_city'},
	 success: function(data)
	 {	
	 	if(data.trim()=='Not Found')
		{
			$("#destination_city").html('<option value="">Select</option>');  
			$(".rcvr_city_cls").html('<option value="">Select</option>'); 
		}
		else if(data.trim()=='blank')
		{
			$("#destination_city").html('<option value="">Select</option>');  
			$(".rcvr_city_cls").html('<option value="">Select</option>'); 
		}
		else
		{
			$("#destination_city").html(data); 
			$(".rcvr_city_cls").html(data);  
		}
	  }
	});*/
	
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{state:val,action:'get_city'},
	 success: function(data)
	 {	
	 	if(data.trim()=='Not Found')
		{
			$(".destination_city_cls").html('<option value="">Select</option>');  
		}
		else if(data.trim()=='blank')
		{
			$(".destination_city_cls").html('<option value="">Select</option>');  
		}
		else
		{
			$(".destination_city_cls").html(data); 
		}
	  }
	});
	$('#desti_cstm_state').val(val);
}
function save_city(fld)
{
	$('#cstm_city').val(fld);
}
function save_rcvr_city(fld)
{
	$('#desti_cstm_city').val(fld);
}
function save_mode_of_payment(fld)
{
	if(fld=='COD')
	{
		$('#total_case').val('0.00');
		$('#total_fc').val($('#finaltotal').text());
	}
	else
	{
		$('#total_fc').val('0.00');
		$('#total_case').val($('#finaltotal').text());
	}
}
/*function get_state(val)
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
}*/

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
<script language="javascript">
function confirm_dialog(val)
{
	if(confirm("Are you sure you want to delete this record?"))
	{
		window.location="<?php echo $site_url; ?>case/customers/"+val;
	}
	else
		return false;
}
</script><?php 
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
if(isset($_POST['submit'])!='')
{
  if(@$_GET['id']!='')
  {
	   
	  //date_default_timezone_set('Asia/Riyadh');
	  $delivery_date=date('Y-m-d',strtotime($_POST['delivery_date'])); 
	 // $delivery_time=date('H:i:s',strtotime($_POST['delivery_time']));
	  $delivery_time=date('H:i:s',strtotime($_POST['phour'].":".$_POST['pminute']." ".$_POST['ptime']));
	  $pickup_date=date('Y-m-d',strtotime($_POST['pickup_date']));
	 // $pickup_time=date('H:i:s',strtotime($_POST['pickup_time'])); 
	  $pickup_time=date('H:i:s',strtotime($_POST['ehour'].":".$_POST['eminute']." ".$_POST['etime'])); 
	  
	  $delivery_date=$delivery_date." ".$delivery_time;
	  $pickup_date=$pickup_date." ".$pickup_time;
	  
	  $arr=array("consignment_no"=>$_POST['consignment_no'],"invoice_number"=>$_POST['invoice_number'],"invoice_date"=>date('Y-m-d',strtotime($_POST['invoice_date'])),"source_country"=>$_POST['source_country'],"source_state"=>$_POST['source_state'],"source_city"=>$_POST['source_city'],/*"area"=>$_POST['area'],*/"destination_country"=>$_POST['destination_country'],"destination_state"=>$_POST['destination_state'],"destination_city"=>$_POST['destination_city'],"no_of_package"=>$_POST['no_of_package'],"amount"=>$_POST['amount'],"tax_percentage"=>$_POST['tax_percentage'],"total_amount"=>$_POST['total_amount'],"payment_cash"=>$_POST['total_case'],"payment_fc"=>$_POST['total_fc'],"destination_address"=>$_POST['destination_address'],"source_address"=>$_POST['source_address'],"comment"=>$_POST['comment'],"sender_deptid"=>$_POST['sender_deptid'],"sender_agentid"=>$_POST['sender_agentid'],"desti_deptid"=>$_POST['desti_deptid'],"desti_agentid"=>$_POST['desti_agentid'],"sender_name"=>$_POST['sender_name'],"sender_mobile"=>$_POST['sender_mobile'],"desti_name"=>$_POST['desti_name'],"desti_mobile"=>$_POST['desti_mobile'],"sender_email"=>$_POST['sender_email'],"desti_email"=>$_POST['desti_email'],"type_of_product"=>$_POST['type_of_product'],"mode"=>$_POST['mode'],"delivery_date"=>$delivery_date,"pickup_date"=>$pickup_date,"status"=>$_POST['status'],"sender_id"=>$_POST['sender_id'],"sender_landmark"=>$_POST['sender_landmark'],"desti_id"=>$_POST['desti_id'],/*"desti_landmark"=>$_POST['desti_landmark'],*/"sales_person"=>$_POST['sales_person'],"department"=>$_POST['dept_dept'],"branch"=>$_POST['branch']);   
	  
		/*$insert = update_query($arr,"id=".$id,"shipment");

		$last_id=$dlink->insert_id;
	  
		$tota_row=$_POST['total_rows'];
		for($i=0;$i<$tota_row;$i++)
		{
			$arr_=array("oid"=>$last_id,"type_of_product"=>$_POST['type_of_product'][$i],"no_of_package"=>$_POST['quantity'][$i],"price"=>$_POST['price'][$i],"discount"=>$_POST['discount'][$i],"tax"=>$_POST['tax'][$i],"total_amount"=>$_POST['amount'][$i]);
			$insert = update_query($arr_, "shipment_detail");
		
		}*/

	  if($insert)
	  {
		  $_SESSION['suc']='Shipment Detail Updated Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Shipment Detail Not Updated... Try Again...';
	  }
	  header("location:".$site_url."shipment-preview/".$last_id);
	  exit;
  }
  else
  {  
  		date_default_timezone_set("Asia/Riyadh");

	  $dt=date('Y-m-d H:i:s');
	  $delivery_date=date('Y-m-d',strtotime($_POST['delivery_date'])); 
	  $delivery_time=date('H:i:s',strtotime($_POST['delivery_time']));
	  $pickup_date=date('Y-m-d',strtotime($_POST['pickup_date']));
	  $pickup_time=date('H:i:s',strtotime($_POST['pickup_time'])); 
	  
	  $delivery_date=$delivery_date." ".$delivery_time;
	  $pickup_date=$pickup_date." ".$pickup_time;

	
	  $invoice_number=$_POST['invoice_number'];
	  $row=select_query("*","shipment", array("invoice_number="=>$invoice_number), "id desc");
	  if($row->num_rows > 0)
	  { 
	  	$rows = fetch_query("*","shipment",""," id desc limit 1");
		$invoice_number=sprintf("%05d", $rows['invoice_number']+1);
	  }
	  
	  $s_name=fetch_query("*", "`customers`", array("name="=>$_POST['sender_name']));
	  $customer_type=fetch_query("customer_type", "`customers`", array("id="=>$_POST['sender_id']));
	  $sender_customer_type=$customer_type['customer_type'];
	  
	  $time=date('H:i:s');
	  
	  $cash=0; $cod=0;
	  if($_POST['mode_of_payment']=='Cash' || $_POST['mode_of_payment']=='Bank Transfer')
	  {
	 	 $cash=$_POST['finaltotal_val'];
	  }
	  else
	  	$cod=$_POST['finaltotal_val'];
	  
	  /*$arr=array("consignment_no"=>$_POST['consignment_no'],"invoice_number"=>$invoice_number,"invoice_date"=>date('Y-m-d',strtotime($_POST['invoice_date']))." ".$time,"source_country"=>$_POST['source_country'],"source_state"=>$_POST['cstm_state'],"source_city"=>$_POST['cstm_city'],"area"=>$_POST['area'],"destination_country"=>$_POST['destination_country'],"destination_state"=>$_POST['desti_cstm_state'],"destination_city"=>$_POST['desti_cstm_city'],"tax_percentage"=>$_POST['tax_percentage'],"total_amount"=>$_POST['total_amount'],"payment_cash"=>$_POST['total_case'],"payment_fc"=>$_POST['total_fc'],"destination_address"=>$_POST['destination_address'],"source_address"=>$_POST['source_address'],"comment"=>$_POST['comment'],"sender_deptid"=>$_POST['sender_deptid'],"sender_agentid"=>$s_name['id'],"desti_deptid"=>$_POST['desti_deptid'],"desti_agentid"=>$_POST['desti_agentid'],"sender_name"=>$_POST['sender_name'],"sender_mobile"=>$_POST['sender_mobile'],"desti_name"=>$_POST['desti_name'],"desti_mobile"=>$_POST['desti_mobile'],"sender_email"=>$_POST['sender_email'],"sender_vat"=>$_POST['taxnumber'],"sender_taxtype"=>$_POST['taxtype'],"sender_iqamano"=>$_POST['customerid'],"sender_type"=>$_POST['customer_type'],"desti_email"=>$_POST['desti_email'],"mode"=>$_POST['mode'],"delivery_date"=>$delivery_date,"pickup_date"=>$pickup_date,"status"=>$_POST['status'],"added_on"=>$dt,"barcode_image"=>$_POST['barcode_image'],"sender_id"=>$_POST['sender_id'],"sender_landmark"=>$_POST['sender_landmark'],"desti_id"=>$_POST['desti_id'],"desti_landmark"=>$_POST['desti_landmark'],"sales_person"=>$_POST['sales_person'],"department"=>$_POST['dept_dept'],"branch"=>$_POST['branch'],"subtotal_val"=>$_POST['subtotal_val'],"vatper_val"=>$_POST['vatper_val'],"vattotal_val"=>$_POST['vattotal_val'],"finaltotal_val"=>$_POST['finaltotal_val'],"desti_salesman"=>$_POST['desti_salesman'],"mode_of_payment"=>$_POST['mode_of_payment'],"special_delivery"=>$_POST['special_delivery'],"value_of_good"=>$_POST['value_of_good'],"delivery_cost"=>$_POST['delivery_cost'],"desti_vat_no"=>$_POST['desti_vat_no'],"desti_iqamano"=>$_POST['desti_iqamano'],"source_country"=>$_POST['source_country'],"destination_country"=>$_POST['destination_country']);*/
	  /*$arr=array("consignment_no"=>$_POST['consignment_no'],"invoice_number"=>$invoice_number,"invoice_date"=>date('Y-m-d',strtotime($_POST['invoice_date']))." ".$time,"source_country"=>$_POST['source_country'],"source_state"=>$_POST['cstm_state'],"source_city"=>$_POST['cstm_city'],"area"=>$_POST['area'],"destination_country"=>$_POST['destination_country'],"destination_state"=>$_POST['desti_cstm_state'],"destination_city"=>$_POST['desti_cstm_city'],"tax_percentage"=>$_POST['tax_percentage'],"total_amount"=>$_POST['total_amount'],"payment_cash"=>$cash,"payment_fc"=>$cod,"destination_address"=>$_POST['destination_address'],"source_address"=>$_POST['source_address'],"comment"=>$_POST['comment'],"sender_deptid"=>$_POST['sender_deptid'],"sender_agentid"=>$s_name['id'],"desti_deptid"=>$_POST['desti_deptid'],"desti_agentid"=>$_POST['desti_agentid'],"sender_name"=>$_POST['sender_name'],"sender_mobile"=>$_POST['sender_mobile'],"desti_name"=>$_POST['desti_name'],"desti_mobile"=>$_POST['desti_mobile'],"sender_email"=>$_POST['sender_email'],"sender_vat"=>$_POST['taxnumber'],"sender_taxtype"=>$_POST['taxtype'],"sender_iqamano"=>$_POST['customerid'],"sender_type"=>$_POST['customer_type'],"desti_email"=>$_POST['desti_email'],"mode"=>$_POST['mode'],"delivery_date"=>$delivery_date,"pickup_date"=>$pickup_date,"status"=>$_POST['status'],"added_on"=>$dt,"barcode_image"=>$_POST['barcode_image'],"sender_id"=>$_POST['sender_id'],"sender_landmark"=>$_POST['sender_landmark'],"desti_id"=>$_POST['desti_id'],"desti_landmark"=>$_POST['desti_landmark'],"sales_person"=>$_POST['sales_person'],"department"=>$_POST['dept_dept'],"branch"=>$_POST['branch'],"subtotal_val"=>$_POST['subtotal_val'],"vatper_val"=>$_POST['vatper_val'],"vattotal_val"=>$_POST['vattotal_val'],"finaltotal_val"=>$_POST['finaltotal_val'],"desti_salesman"=>$_POST['desti_salesman'],"mode_of_payment"=>$_POST['mode_of_payment'],"special_delivery"=>$_POST['special_delivery'],"value_of_good"=>$_POST['value_of_good'],"delivery_cost"=>$_POST['delivery_cost'],"desti_vat_no"=>$_POST['desti_vat_no'],"desti_iqamano"=>$_POST['desti_iqamano'],"source_country"=>$_POST['source_country'],"destination_country"=>$_POST['destination_country']);*/
	  
	  $arr=array("consignment_no"=>$_POST['consignment_no'],"invoice_date"=>date('Y-m-d',strtotime($_POST['invoice_date']))." ".$time,"source_country"=>$_POST['source_country'],"source_state"=>$_POST['cstm_state'],"source_city"=>$_POST['cstm_city'],/*"area"=>$_POST['area'],*/"destination_country"=>$_POST['destination_country'],"destination_state"=>$_POST['desti_cstm_state'],"destination_city"=>$_POST['desti_cstm_city'],"tax_percentage"=>$_POST['tax_percentage'],"total_amount"=>$_POST['total_amount'],"payment_cash"=>$cash,"payment_fc"=>$cod,"destination_address"=>$_POST['destination_address'],"source_address"=>$_POST['source_address'],"comment"=>$_POST['comment'],"sender_deptid"=>$_POST['sender_deptid'],"sender_agentid"=>$s_name['id'],"desti_deptid"=>$_POST['desti_deptid'],"desti_agentid"=>$_POST['desti_agentid'],"sender_name"=>$_POST['sender_name'],"sender_company"=>$_POST['company_name'],"sender_mobile"=>$_POST['sender_mobile'],"desti_name"=>$_POST['desti_name'],"desti_company"=>$_POST['desti_company'],"desti_mobile"=>$_POST['desti_mobile'],"sender_email"=>$_POST['sender_email'],"sender_vat"=>$_POST['taxnumber'],"sender_taxtype"=>$_POST['taxtype'],"sender_iqamano"=>$_POST['customerid'],"sender_type"=>$_POST['customer_type'],"desti_email"=>$_POST['desti_email'],"mode"=>$_POST['mode'],"delivery_date"=>$delivery_date,"pickup_date"=>$pickup_date,"status"=>$_POST['status'],"added_on"=>$dt,"barcode_image"=>$_POST['barcode_image'],"sender_id"=>$_POST['sender_id'],"sender_landmark"=>$_POST['sender_landmark'],"desti_id"=>$_POST['desti_id'],/*"desti_landmark"=>$_POST['desti_landmark'],*/"sales_person"=>$_POST['sales_person'],"department"=>$_POST['dept_dept'],"branch"=>$_POST['branch'],"subtotal_val"=>$_POST['subtotal_val'],"vatper_val"=>$_POST['vatper_val'],"vattotal_val"=>$_POST['vattotal_val'],"finaltotal_val"=>$_POST['finaltotal_val'],"desti_salesman"=>$_POST['desti_salesman'],"mode_of_payment"=>$_POST['mode_of_payment'],"special_delivery"=>$_POST['special_delivery'],"value_of_good"=>$_POST['value_of_good'],"delivery_cost"=>$_POST['delivery_cost'],"desti_vat_no"=>$_POST['desti_vat_no'],"desti_iqamano"=>$_POST['desti_iqamano'],"source_country"=>$_POST['source_country'],"destination_country"=>$_POST['destination_country']);
	  $insert = insert_query($arr, "shipment");
	  $last_id=$dlink->insert_id;
	  
	 	$invoice_number_new=$last_id+100000;
	  $arr_=array("invoice_number"=>$invoice_number_new);
	  $insert = update_query($arr_,"id=".$last_id,"shipment");
	 
	  $tota_row=$_POST['total_rows'];
	  for($i=0;$i<$tota_row;$i++)
	  {
	  	if($_POST['trremove_'.$i] == 1)
	  	{
			$arr_=array("oid"=>$last_id,"type_of_product"=>$_POST['type_of_product'][$i],"no_of_package"=>$_POST['quantity'][$i],"price"=>$_POST['price'][$i],"discount"=>$_POST['discount'][$i],"tax"=>$_POST['tax'][$i],"total_amount"=>$_POST['amount'][$i]);
			$insert = insert_query($arr_, "shipment_detail");
		}
	
	  }


	if($_POST['tabname']=='new')
	{
	  $arr1=array("customer_type"=>$_POST['customer_type'],"name"=>ucfirst($_POST['sender_name']),"company_name"=>$_POST['company_name'],"phone"=>$_POST['sender_mobile'],"taxtype"=>$_POST['taxtype'],"taxnumber"=>$_POST['taxnumber'],"email"=>$_POST['sender_email'],"address"=>addslashes($_POST['source_address']),"country"=>$_POST['source_country'],"state"=>$_POST['cstm_state'],"city"=>$_POST['cstm_city'],"customerid"=>$_POST['customerid']/*,"area"=>$_POST['area']*/);  
	  $insert= insert_query($arr1, "customers");
	  $last_id1=$dlink->insert_id;

	  $arr_1=array("cid"=>$last_id1,"rcvr_name"=>ucfirst($_POST['desti_name']),"rcvr_company"=>$_POST['desti_company'],"rcvr_email"=>$_POST['desti_email'],"rcvr_mno"=>$_POST['desti_mobile'],"rcvr_address"=>addslashes($_POST['destination_address']),"rcvr_country"=>$_POST['destination_country'],"rcvr_state"=>$_POST['desti_cstm_state'],"rcvr_city"=>$_POST['desti_cstm_city'],/*"rcvr_landmark"=>$_POST['desti_landmark'],*/"rcvr_vat_no"=>$_POST['desti_vat_no'],"rcvr_iqamano"=>$_POST['desti_iqamano']);
		$insert = insert_query($arr_1, "customers_receiver");
	}

	

	if($_POST['newRvcr'] == 1)
	{
		if($_POST['cid']!='')
		{
			$arr_2=array("cid"=>$_POST['cid'],"rcvr_name"=>ucfirst($_POST['rcvr_name']),"rcvr_company"=>$_POST['rvcr_company'],"rcvr_email"=>$_POST['rcvr_email'],"rcvr_mno"=>$_POST['rcvr_mno'],"rcvr_mno2"=>$_POST['rcvr_mno2'],"rcvr_address"=>addslashes($_POST['rcvr_address']),"rcvr_country"=>184,"rcvr_state"=>$_POST['rcvr_state'],"rcvr_city"=>$_POST['rcvr_city'],"rcvr_landmark"=>$_POST['rcvr_landmark'],"rcvr_vat_no"=>$_POST['rcvr_vat_no'],"rcvr_iqamano"=>$_POST['rcvr_iqamano']);
			$insert = insert_query($arr_2, "customers_receiver");
		}
	}
		//generate pdf
		$adm=fetch_query("*", "`myadmin`", array("id="=>1));
		$logo=$adm['logo'];
		$mobile=$adm['mobile_1'];
		$address=$adm['address']; 
		
		$adm=fetch_query("*", "`myadmin`", array("id="=>$_POST['sender_id']));

		$city=fetch_query("*", "`location`", array("location_id="=>$_POST['source_city']));

		$vat=fetch_query("*", "`customers`", array("name="=>$_POST['sender_name']));

		$dcity=fetch_query("*", "`location`", array("location_id="=>$_POST['destination_city']));

		$rvcr_city=fetch_query("*", "`location`", array("location_id="=>$_POST['rcvr_city']));

		$salesman_name='';
		$salName=fetch_query("*","department",array("id="=>$_POST['desti_salesman']));
		$salesman_name=$salName['fname']." ".$salName['mname'];


		$shipment=fetch_query("*", "`shipment`", array("id="=>$last_id));

		$row=select_query("*","shipment_detail", array("oid="=>$last_id), "id desc");
	  	if($row->num_rows)
	  	{ 
		  	while($b=$row->fetch_array())
		  	{

				$uprice=$b['price']*$b['no_of_package'];
				$utax=($uprice * $b['tax'])/100;
				$totaltaxamt+=$uprice+$utax;
				
				$disnt+=($uprice * $b['discount'])/100;
				$txx=($uprice * $b['tax'])/100;

				$totalAmt=$totaltaxamt -$disnt;

				$finalamt=$totalAmt+($totalAmt *$b['tax'])/100;
			}
		}

		$text = "INVOICE NO: ".$shipment['invoice_number']."\nCOMPANY NAME: NATIONAL EXPRESS TRANSPORT COMPANY\nTRN: 310365617400003\nGRAND TOTAL: ".$shipment['finaltotal_val']."";

		$path = 'qrcode/';

		$filename=uniqid().".png";
		$file = $path.$filename;

		$ecc = 'L';
		$pixel_Size = 10;
		$frame_Size = 10;

		QRcode::png($text, $file, $ecc, $pixel_Size, $frame_size);

		$arr=array("qrcode"=>$filename);

		$insert = update_query($arr,"id=".$last_id,"shipment");

		$qrget=fetch_query("*", "`shipment`", array("id="=>$last_id));


		$mode_of_payment=$qrget['mode_of_payment'];
		$cash='Invoice_Png_Files/checkbox.jpg';
		$cod='Invoice_Png_Files/checkbox.jpg';
		$bank='Invoice_Png_Files/checkbox.jpg';
		if($mode_of_payment=='Cash')
			$cash='Invoice_Png_Files/checkbox_checked.jpg';
		else if($mode_of_payment=='COD')
			$cod='Invoice_Png_Files/checkbox_checked.jpg';
		else if($mode_of_payment=='Bank Transfer')
			$bank='Invoice_Png_Files/checkbox_checked.jpg';
	
		$special_delivery=$qrget['special_delivery'];
		
		$officedoor='Invoice_Png_Files/officedelivery.jpg';
		
		if($special_delivery=='Office Delivery')
			$officedoor='Invoice_Png_Files/office_checked.jpg';
		else if($special_delivery=='Door to Door')
			$officedoor='Invoice_Png_Files/door_checked.jpg';
		/*echo "fgvkf";
		echo"<pre>";print_r($shipment); exit;*/
	

		/*$result = mysql_query("SELECT name FROM location WHERE location_id='".$_POST['source_city']."' LIMIT 1");
		$row = mysql_fetch_assoc($result);*/
		$sender_vat=$_POST['taxnumber']; 
		$sender_iqama='';
		
		$rcv_vat=''; 
		$rcv_iqama='';
		$sender_iqama=$_POST['customerid'];
		$rcv_iqama=$_POST['desti_iqamano'];
		if($mode_of_payment=='Cash')
		{	
			$sender_vat=$_POST['taxnumber'];
			$rcv_vat=" ";
		}
		else if($mode_of_payment=='COD')
  		{
			$rcv_vat=$_POST['desti_vat_no'];
			$sender_vat=$_POST['taxnumber'];
		}
		$disnt=0;
		$html = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<style>
		.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th
		{
			border-top:none !important;
		}
		.table
		{
			margin-bottom:0px !important;
		}
		@page{
        	margin-top: 10px;
			
		}
		
		body {
			font-size:9px !important;
			font-family:"Open Sans", sans-serif;
			  font-style: normal;
			  font-weight: normal;
			  src: url("https://fonts.googleapis.com/css2?family=Open+Sans&display=swap");
		  }
		  .titlecls
		  {
			  font-size:9px !important;
			  font-weight:bold !important;
			  margin-bottom:0px !important;
		   }
		  h6
		  {
			  font-size:10px !important;
			  font-weight:900 !important;
			  margin-bottom:0px !important;
			  margin-top:0px !important;
		  }
		   div {page-break-inside: always !important;}
			table {
				page-break-inside:avoid;
				position:relative;
			}
			@media print {
			   table {
					page-break-inside:avoid;
					position:relative;
				}
			}
			footer {
				position: fixed; 
                bottom: -20px; 
                left: 0px; 
                right: 0px;
                height: 15px; 
				text-align: center;
                
            }
			#header { position: fixed; left: 0px; top: -180px; right: 0px; height: 5px; background-color: #ffffff; text-align: center; }
			.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th
			{
				padding: 5px 8px !important;
			}
		</style>
		<html>
		  <head>
		  </head>
		
		<body style="font-family:Arial">
		<div id="header">
     <h1>&nbsp;</h1>
   </div>
		  <div class="row" >
        	<div class="col-md-6" style="padding:5px;width:30%;display:inline-block;margin-botton:1%">';

        	/*if($_POST['taxtype'] !='')
			{
				if($_POST['taxtype']=="Vat"){
					$html.='<div><span class="titlecls">TAX INVOICE</span></div>';
				}
				else{
					$html.='<div><span class="titlecls">SIMPLIFIED TAX INVOICE</span></div>';
				}
				
			}
			else
			{
				if($shipment['sender_taxtype']=="Vat"){
					$html.='<div><span class="titlecls">TAX INVOICE</span></div>';
				}
				else{
					$html.='<div><span class="titlecls">SIMPLIFIED TAX INVOICE</span></div>';
				}
			}*/
        		
				$html.='<div style="font-size:12px !important;">NATIONAL EXPRESS TRANSPORT COMPANY</div>
				<div style="font-size:11px !important;">Ibn Al-Ameed Road, Al-Sulay</div>
				<div style="font-size:11px !important;">P.O Box : 24117, Al-Riyadh 14273, KSA</div>
				<div style="font-weight: bold;font-size:11px !important;">CR No: 1010352157</div>';
				//if($vat['taxtype']=="Vat"){
					$html.='<div style="font-weight: bold;font-size:11px !important;">VAT No. : 310365617400003</div>';
				//}
			$html.='</div>';
			$tax_invoice_type='';
			/*if($shipment['sender_taxtype'] !='')
			{
				if($shipment['sender_taxtype']=="Vat"){
					$tax_invoice_type='<span class="titlecls" style="font-weight:bold;font-size:12px !important;width:80%;">TAX INVOICE</span>';
				}
				else{
				
					$tax_invoice_type='<span class="titlecls" style="font-weight:bold;font-size:12px !important;width:80%;">SIMPLIFIED TAX INVOICE</span>';
				//}
				
			}
			else
			{
				if($shipment['sender_taxtype']=="Vat"){
					$tax_invoice_type='<span class="titlecls" style="font-weight:bold;font-size:12px !important;width:80%;">TAX INVOICE</span>';
				}
				else{
					$tax_invoice_type='<span class="titlecls" style="font-weight:bold;font-size:12px !important;width:80%;">SIMPLIFIED TAX INVOICE</span>';
				}
			}*/
			if($sender_customer_type==1)
				$tax_invoice_type='<div class="titlecls" style="font-weight:bold;font-size:14px !important;width:80%;margin-right:30px !important"><strong>TAX INVOICE</strong></div>';
			if($sender_customer_type==2)
				$tax_invoice_type='<div class="titlecls" style="font-weight:bold;font-size:14px !important;width:80%;">SIMPLIFIED TAX INVOICE</div>';
			$html.='<div class="col-md-6" align="right" style="width:25%;display:inline-block;margin-botton:1%;padding-top:50px;font-weight:bold !important;font-size:14px !important">'.$tax_invoice_type.'<strong>Consignment No.: '.$qrget['consignment_no'].'</strong></div>
			<div class="col-md-6" align="right"  style="padding:0px;width:30%;display:inline-block;margin-botton:1%;float:right">';
			if($shipment['sender_taxtype'] !='')
			{
				if($shipment['sender_taxtype']=="Vat"){
					$html.='<img src="Invoice_Png_Files/TAX-INVOICE-ARABIC.jpg" width="210" style="float:right">';
				}
				else{
					$html.='<img src="Invoice_Png_Files/simplified-arabic.jpg" width="210" style="float:right">';
				}
			}
			else
			{

				if($shipment['sender_taxtype']=="Vat"){
					$html.='<img src="Invoice_Png_Files/TAX-INVOICE-ARABIC.jpg" width="210" style="float:right">';
				}
				else{
					$html.='<img src="Invoice_Png_Files/simplified-arabic.jpg" width="210" style="float:right">';
				}
			}
			
			$html.='</div>
			</div>
		 
		<div class="row">
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px;background-color:#f4f3f2;width:44%;display:inline-block;">
				<table style="width:100%;">
					<tr><td style="width:25%;font-weight:bold"><img src="Invoice_Png_Files/Invoice-Number.jpg" width="160"></td><td style="width:80%;font-weight:bold;font-weight:bold;font-size:15px !important" align="right">'.$shipment['invoice_number'].'</td></tr>
				</table>
			</div>
			
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px;background-color:#f4f3f2;width:44%;display:inline-block;float:right">
				<table style="width:100%">
					<tr><td style="width:25%;font-weight:bold"><img src="Invoice_Png_Files/Invoice-Date.jpg" width="160"></td><td style="width:80%;font-weight:bold;font-size:15px !important" align="right">'.$_POST['invoice_date']." ".$time.'</td></tr>
				</table>
			</div>
		</div>
		<div class="row" style="margin-top:2px">
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px;background-color:#3c3d3a;width:44%;display:inline-block;color:#ffffff">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Files/payment_method.jpg" width="320" height="20"></td></tr>
				</table>
			</div>
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px;background-color:#3c3d3a;width:44%;display:inline-block;float:right;color:#ffffff">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Files/Special_Delivery.jpg" width="320" height="20"></td></tr>
				</table>
			</div>
		</div>
		
		<div class="row" style="margin-top:2px">
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important">
				<table class="table"> 
					<tbody>
						<tr>
							<td style="color:#6c6c6c;font-size:12px !important">Cash</td>
							<td><img src="'.$cash.'" width="20"> </td>
							<td style="text-align:right;"><img src="Invoice_Png_Files/cash.jpg" width="75"></td>
							
						</tr>
						<tr>
							<td style="color:#6c6c6c;font-size:12px !important">COD</td>
							<td><img src="'.$cod.'" width="20" ></td>
							<td style="text-align:right;"><img src="Invoice_Png_Files/cod.jpg" width="75"></td>
							
						</tr>
						<tr>
							<td style="color:#6c6c6c;font-size:12px !important">Bank Transfer</td>
							<td><img src="'.$bank.'" width="20" > </td>
							<td style="text-align:right;"><img src="Invoice_Png_Files/web.jpg" width="75"></td>
							
						</tr>
						
					</tbody>
				</table>
			</div>
			<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:2px !important;float:right">
				<table class="table"> 
					<tbody>
						<tr>
							<td rowspan="2"><img src="qrcode/'.$qrget['qrcode'].'" width="70" style="vergicle-align=middle"></td>
							<td colspan="2"><img src="'.$officedoor.'" width="190"> 
							</td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/values_of_goods.jpg" width="70"> 
							<br>
							<img src="Invoice_Png_Files/delivery_cost.jpg" width="70"> 
							</td>
							<td style="float:right;">'.$qrget['value_of_good'].'<br>'.$qrget['delivery_cost'].'</td>
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="row" style="margin-top:2px">
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px;background-color:#3c3d3a;width:44%;display:inline-block;color:#ffffff">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Files/Sender’s Details.jpg" width="320" height="20"></td></tr>
				</table>
			</div>
			
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px; background-color:#3c3d3a; width:44%; display:inline-block; float:right; color:#ffffff">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Files/Receiver’s Details.jpg" width="320" height="20"></td></tr>
				</table>
			</div>
		</div>
		
		<div class="row" style="margin-top:2px">
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important">
				<table class="table"> 
					
						<tr>
							<td><img src="Invoice_Png_Files/name.png" width="140"></td>
							<td style="color:#6c6c6c;font-size:12px !important">'.$shipment['sender_name'].'
							</td>
						</tr>
						<tr>
							<td style="color:#6c6c6c;font-size:12px !important"><img src="Invoice_Png_Files/company_name.jpg" width="140"></td>
							<td style="color:#6c6c6c;font-size:12px !important" align="right">'.$shipment['sender_company'].'
							</td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/address.png" width="140"></td>
							<td style="color:#6c6c6c;font-size:12px !important">'.$shipment['source_address'].'</td>
						</tr>';
						/*<tr>
							<td style="color:#6c6c6c;font-size:12px !important">&nbsp;Area</td>
							<td style="color:#6c6c6c;font-size:12px !important">'.$shipment['area'].'</td>
						</tr>*/
						$html.='<tr>
							<td><img src="Invoice_Png_Files/cont-no.png" width="140"></td>
							<td style="color:#6c6c6c;font-size:12px !important">'.$shipment['sender_mobile'].'</td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/city.png" width="140"></td>
							<td style="color:#6c6c6c;font-size:12px !important">'.$city['name'].'</td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/country.png" width="140"></td>
							<td style="text-align:left;color:#6c6c6c;font-size:12px !important">Saudi Arabia</td>
						</tr>';
						$html.='<tr>
								<td><img src="Invoice_Png_Files/vat.no.png" width="140"></td>
								<td style="color:#6c6c6c;font-size:12px !important">'.$sender_vat.'</td>
							</tr>';
						$html.='<tr>
								<td style="color:#6c6c6c;font-size:12px !important">&nbsp;IQAMA No.</td>
								<td style="color:#6c6c6c;font-size:12px !important">'.$sender_iqama.'</td>
							</tr>';
						$html.='
					
				</table>
			</div>
			<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;float:right;color:#000000;padding-right:0px !important;padding-left:2px !important;float:right">
				<table  class="table " style="width:100%;background-color:#f4f3f2;color:#000000;">
					<tr>
						<td><img src="Invoice_Png_Files/name.png" width="140"></td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important">'.$shipment['desti_name'].'</td>
					</tr>
					<tr>
						<td style="color:#6c6c6c;font-size:12px !important"><img src="Invoice_Png_Files/company_name.jpg" width="140"></td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important" align="right">'.$shipment['desti_company'].'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/address.png" width="140"></td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important">'.$shipment['destination_address'].'</td>
					</tr>';
					/*<tr>
						<td style="color:#6c6c6c;font-size:12px !important">&nbsp;Area</td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important">'.$shipment['desti_landmark'].'</td>
					</tr>*/
					$html.='<tr>
						<td><img src="Invoice_Png_Files/cont-no.png" width="140"></td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important">'.$shipment['desti_mobile'].'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/city.png" width="140"></td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important">'.$dcity['name'].'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/country.png" width="140"></td>
						<td style="float:right;verticle-align:middel;color:#6c6c6c;font-size:12px !important">Saudi Arabia</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/vat.no.png" width="140"></td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important">'.$rcv_vat.'</td>
					</tr>
					<tr>
						<td style="color:#6c6c6c;font-size:12px !important">&nbsp;IQAMA No.</td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important">'.$rcv_iqama.'</td>
					</tr>
					
				</table>
			</div>
			<style>
			thead tr th{ background-color: #3c3d3a; font-size: 14px; text-align:center;color:#ffffff }
			table tr td{ font-size: 14px; }
			.tblcls_product > thead > tr > th
			{
				vertical-align:middle !important;
			}
			.tblcls_product > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th
			{
				padding:1px 8px !important;
			}
			hr
			{
				margin-top: 5px !important;
				margin-bottom: 5px !important;
			}
		</style>
		<div class="row" style="margin-top:2px">
			<div class="col-md-12" style="border:1px solid gray;width:96%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important;margin-left:15px">
				<table class="table table-bordered tblcls_product" align="center">
		 		<thead>
					<tr>
						<th><img src="Invoice_Png_Files/SL-NUMBER.jpg" width="45"></th>
						<th><img src="Invoice_Png_Files/itemdescri.png" width="110"></th>
						<th><img src="Invoice_Png_Files/Qty.jpg" width="20"></th>
						<th><img src="Invoice_Png_Files/Unit.jpg" width="25"></th>
						<th><img src="Invoice_Png_Files/Discount-1.jpg" width="50"></th>
						<th><img src="Invoice_Png_Files/VAT-15%.jpg" width="45"></th>
						<th><img src="Invoice_Png_Files/Amount.jpg" width="45"></th>
					</tr>
				</thead>
				<tbody>';
					$final_vat=0;
					$row=select_query("*","shipment_detail", array("oid="=>$last_id), "id desc");
					if($row->num_rows)
					{ 
						$i=1;
						while($b=$row->fetch_array())
						{
							
							$html.='<tr>
								<td style="font-size:12px !important;">'.$i.'</td>
								<td style="font-size:12px !important;">'.$b['type_of_product'].'</td>
								
								<td style="text-align:center;font-size:12px !important;">'.$b['no_of_package'].'</td>
								<td style="text-align:center;font-size:12px !important;">'.$b['price'].'</td>
								<td style="text-align:center;font-size:12px !important;">';
								if($b['discount']==""){
									$html.='-';
								}
								else{
				
									$html.=''.$b['discount'].'%';
								}
								$html.='</td>
								<td style="text-align:center;font-size:12px !important;">15%</td>
								<td style="text-align:center;font-size:12px !important;">'.$b['total_amount'].'</td>
							</tr>';
				
							$totalexvat+=$b['price']*$b['no_of_package'];
				
							$uprice=$b['price']*$b['no_of_package'];
							$utax=($uprice * $b['tax'])/100;
							$totaltaxamt+=$uprice+$utax;
				
				
							$totalvat=$b['tax'];
				
							$disnt+=($uprice * $b['discount'])/100;
							$txx=($uprice * $b['tax'])/100;
				
							$totalAmt=$totaltaxamt -$disnt;
				
							$finalamt=$totalAmt+($totalAmt *$b['tax'])/100;
							//$totalAmt=$totaltaxamt + $totalexvat;
							if($b['tax']!=0)
								$final_vat=$b['tax'];
							$i++;
						}
					}
		
				$html.='</tbody>
				</table></div></div>
	<div class="row" style="margin-top:1px">
			<div class="col-md-6" style="background-color:#fff;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important">
				<table class="table">
					<tbody style="background-color:#ffffff;color:#ffffff">
						<tr>
							<th colspan="2">&nbsp;</th>
						</tr>
					<tr>
						<td style="background-color:#ffffff;color:#ffffff">Sender’s Name : '.$_POST['sender_name'].'</td>
						<td style="background-color:#ffffff;color:#ffffff">Receiver’s Name : '.$_POST['desti_name'].'</td>
					</tr>
					<tr>
						<td style="background-color:#ffffff;color:#ffffff">'.$shipment['id'].'</td>
						<td style="background-color:#ffffff;color:#ffffff">'.$vat['id'].'</td>
					</tr>
					<tr style="background-color:#ffffff;border:0px;color:#ffffff">
						<td rowspan="3" style="border:0px;">&nbsp;</td>
						<td rowspan="3" style="border:0px;">&nbsp;</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:44.5%;display:inline-block;float:right;color:#000000;padding-right:0px !important;padding-left:2px !important;float:right;margin-right:15px">
				<table class=" " style="width:100%;background-color:#f4f3f2;color:#000000;line-height:30px;">
					<tr>
						<td><img src="Invoice_Png_Files/Total-(-Excluding-VAT-).jpg" width="200" height="25">  </td>
						<td style="text-align:center;font-size:12px !important;">'.($shipment['subtotal_val']+$disnt).'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/Discount.jpg" width="50">  </td>
						<td style="text-align:center;font-size:12px !important;">'.$disnt.'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/Total-(-Excluding-VAT-).jpg" width="200" height="25">  </td>
						<td style="text-align:center;font-size:12px !important;">'.($shipment['subtotal_val']).'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/Total-VAT.jpg" width="55" >(15 %)</td>
						<td style="text-align:center;font-size:12px !important;">'.$shipment['vattotal_val'].'</td>
					</tr>
					<tr style="background-color:#cccccc">
						<td><img src="Invoice_Png_Files/Total-Amount-Due.jpg" width="100" height="25"> </td>';
						if($mode_of_payment=='Cash' || $mode_of_payment=='Bank Transfer')
							$html.='<td style="text-align:center;font-size:12px !important;">0</td>';
						else
							$html.='<td style="text-align:center;font-size:12px !important;">'.$shipment['finaltotal_val'].'</td>';
					$html.='</tr>
					
				</table>
	
	</div>

	<div class="row" style="margin-top:15%;margin-left:14px">
	<img src="Invoice_Png_Files/terms-and-conditions.jpg" style="height:165px;width:740px">
	</div>
	<div style="margin-top:30px;">
		<img src="Invoice_Png_Files/Signature-_.jpg" width="140"  style="float:left;padding: 10px 20px 40px 20px;border: 1px solid #000;"> 
		<img src="Invoice_Png_Files/Signature-_.jpg" width="140" style="float:right;margin-right:10px;padding: 10px 20px 40px 20px;border: 1px solid #000;">
	</div>		
	<footer>
	<div class="row">
				<hr>
				<div class="row">
					<div class="col-md-2" style="display:inline-block;color:#000000;width:18%;text-align:center">www.ntexpress.sa 
					</div>
					<div class="col-md-2" style="display:inline-block;color:#000000;width:20%;text-align:center">info@ntexpress.sa
					</div>
					<div class="col-md-2" style="display:inline-block;color:#000000;width:24%;text-align:center">920019908 | 011 2700300
					</div>
					<div class="col-md-2" style="display:inline-block;color:#000000;width:18%;text-align:center">'.$shipment['sales_person'].'
					</div>
					
				</div>
		</div>
	</footer>
	 </body>
		</html>';
	// reference the Dompdf namespace
	$dompdf = new Dompdf();
	$dompdf->loadHtml($html);
	$dompdf->setPaper('A4', 'portrait');
	// Render the HTML as PDF
	$dompdf->render();
	ob_end_clean();
	// Output the generated PDF to Browser
	//$dompdf->stream($filename,array("Attachment"=>0));


	$output = $dompdf->output();
	file_put_contents('_private_content_shipment/l_'.$invoice_number.'.pdf', $output);
	  
	//end for generate pdf
		
	if($insert)
	{
		$_SESSION['suc']='Shipment Detail Added Successfully...';
	}
	else
	{
		$_SESSION['unsuc']='Shipment Detail Not Added... Try Again...';
	}
	header("location:".$site_url."shipment-preview/".$invoice_number);
	exit;
  }
}
?>