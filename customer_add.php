<?php include("header.php"); 

if(@$_REQUEST['id']!='')
{
	$id = $_REQUEST['id'];
	$rows = fetch_query("*","customers",array("id="=>$id));
	
	
	
	$fname = $rows['name'];
	
	$email = $rows['email'];
	$mno = $rows['mno'];
	
	$address = $rows['address'];
	$pincode = $rows['pincode'];
	$country = $rows['country'];
	$state = $rows['state'];
	$city = $rows['city'];
    $area = $rows['area'];
	$pagetitle='Edit';
	
	$customer_type=$rows['customer_type'];
	$company_name=$rows['company_name'];
	$website=$rows['website'];
	$phone=$rows['phone'];
	$fax=$rows['fax'];
	$taxtype=$rows['taxtype'];
	$taxnumber=$rows['taxnumber'];
    $customerid=$rows['customerid'];
	
	/*$frcvr_name=$rows['rcvr_name'];
	
	$rcvr_email = $rows['rcvr_email'];
	$rcvr_mno = $rows['rcvr_mno'];
	$rcvr_address = $rows['rcvr_address'];
	$rcvr_pincode = $rows['rcvr_pincode'];
	$rcvr_country = $rows['rcvr_country'];
	$rcvr_state = $rows['rcvr_state'];
	$rcvr_city = $rows['rcvr_city'];
	
	$rcvr_address1=$rows['rcvr_address1'];
	$rcvr_fax=$rows['rcvr_fax'];
	$rcvr_landmark=$rows['rcvr_landmark'];
	
	
	$rcvr_iqamano=$rows['rcvr_iqamano'];
	$rcvr_vat_no=$rows['rcvr_vat_no']; */
}
else
{
	
	$name = '';
	$fname = '';
	
	$email = '';
	$mno = '';
	
	$customer_type= '';
	$company_name= '';
	$website= '';
	$phone= '';
	$fax= '';
	$taxtype= '';
	$taxnumber= '';
	
	$address = '';
	$pincode = '';
	$country = '';
	$state = '';
	$city = '';
    $area = '';
	
	$frcvr_name="";
	
	$rcvr_name = "";
	$rcvr_email= "";
	$rcvr_mno = "";
	$rcvr_address = "";
	$rcvr_pincode = "";
	$rcvr_country= "";
	$rcvr_state= "";
	$rcvr_city= "";
	
	$pagetitle="Add";
	
	$rcvr_address1= "";
	$rcvr_fax= "";
	$rcvr_landmark= "";
	$customerid="";
	$rcvr_iqamano=""; 
	$rcvr_vat_no="";
    $rcvr_company="";
}

?>
<style>
.nav-tabs .nav-link.active, .nav-tabs .nav-link.active:focus, .nav-tabs .nav-link.active:hover, .nav-tabs .nav-item.open .nav-link, .nav-tabs .nav-item.open .nav-link:focus, .nav-tabs .nav-item.open .nav-link:hover 
{
	color: #fff;
	border-color: transparent;
	border-bottom-color: transparent;
	border-bottom-color: #1e9ff2;
	background-color: #1e9ff2;
}
#myTab
{
	margin-left:0px !important;
}
.secondtab {
	border: 1px solid #ccc;
	padding: 10px;
}
</style>


<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

        <!--<h1> Customers <?php echo $pagetitle; ?> </h1>-->

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
					<div class="col-12 text-left">
                    		<h3> New Customers </h3>
                       	</div>
                    <div class="col-lg-12">

                        <form method="post" action="" name="bg" id="bg" enctype="multipart/form-data" autocomplete="off" >
							
                            <div class="row">
								<div class="col-lg-3 col-md-3 col-sm-6 col-6">
									<div class="form-group">
                                        <h5>Customer Type</h5>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="demo-radio-button">
                                   			<input name="customer_type" type="radio" id="business" class="with-gap radio-col-maroon" <?php if($customer_type==1) { ?> checked="checked" <?php } 
											if($customer_type=="") { ?> checked="checked" <?php } ?> value="1"> <label for="business">Business</label>
                                    		<input name="customer_type" type="radio" id="individual" class="with-gap radio-col-maroon"  value="2" <?php if($customer_type==2) { ?> checked="checked" <?php } ?>>
                                   			<label for="individual">Individual</label>
                                    	</div>
                                </div>
							</div>
                            <div class="row">
								<div class="col-lg-3 col-md-3 col-sm-6 col-6">
									<div class="form-group">
                                        <h5>Primary Contact</h5>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                            <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $fname; ?>" style="display:inline-block" onblur="name_get()">
                                            <?php /*?>&nbsp;
                                            <input type="text" name="mname" id="mname" class="form-control" value="<?php echo $mname; ?>" style="width:30%;display:inline-block" onblur="name_get()">
                                            &nbsp;
                                            <input type="text" name="lname" id="lname" class="form-control" value="<?php echo $lname; ?>" style="width:30%;display:inline-block" onblur="name_get()"><?php */?>
                                        </div>
                                </div>
							</div>
                            <div class="row">
								<div class="col-lg-3 col-md-3 col-sm-12 col-12">
									<div class="form-group">
                                        
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                            
                                        </div>
                                </div>
							</div>
                            <div class="row">
								<div class="col-lg-3 col-md-3 col-sm-12 col-12">
									<div class="form-group">
                                        <h5>Company Name</h5>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls"> 
                                            <input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo $company_name; ?>" style="display:inline-block">
                                    </div>
                                </div>
							</div>
                            <div class="row">
								<div class="col-lg-3 col-md-3 col-sm-12 col-12">
									<div class="form-group">
                                        
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                            
                                        </div>
                                </div>
							</div>
                            <div class="row">
								<div class="col-lg-3 col-md-3 col-sm-12 col-12">
									<div class="form-group">
                                        <h5 class="rbcl">Customer Name</h5>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls" id="pname_div">
                                           <?php echo $fname; ?> 
                                    </div>
                                </div>
							</div>
                            <div class="row">
								<div class="col-lg-3 col-md-3 col-sm-12 col-12">
									<div class="form-group">
                                        
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                            
                                        </div>
                                </div>
							</div>
                             <div class="row">
								<div class="col-lg-3 col-md-3 col-sm-12 col-12">
									<div class="form-group">
                                        <h5>IQAMA No.</h5>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                        <input type="text" name="customerid" id="customerid" class="form-control" value="<?php echo $customerid; ?>" style="display:inline-block">
                                    </div>
                                </div>
							</div>
                            <div class="row">
								<div class="col-lg-3 col-md-3 col-sm-12 col-12">
									<div class="form-group">
                                        
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                            
                                        </div>
                                </div>
							</div>
                            <div class="row">
								<div class="col-lg-3 col-md-3 col-sm-12 col-12">
									<div class="form-group">
                                        <h5>Email-Id</h5>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                            <input type="text" name="email" id="email" class="form-control" value="<?php echo $email; ?>" style="display:inline-block">
                                    </div>
                                </div>
							</div>
                            <div class="row">
								<div class="col-lg-3 col-md-3 col-sm-12 col-12">
									<div class="form-group">
                                        
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                            
                                        </div>
                                </div>
							</div>
                            <div class="row">
								<div class="col-lg-3 col-md-3 col-sm-12 col-12">
									<div class="form-group">
                                        <h5>Contact Number</h5>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                            <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $phone; ?>" style="width:40%;display:inline-block" onblur="shownumber(this.value)" minlength="10" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                            &nbsp;
                                            <input type="text" name="mno" id="mno" class="form-control" value="<?php echo $mno; ?>" style="width:40%;display:inline-block" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> 
                                            
                                        </div>
                                </div>
							</div>
                            <div class="row">
								<div class="col-lg-3 col-md-3 col-sm-12 col-12">
									<div class="form-group">
                                        
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                            
                                        </div>
                                </div>
							</div>
                            <div class="row">
								<div class="col-lg-3 col-md-3 col-sm-12 col-12">
									<div class="form-group">
                                        <h5>Website</h5>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                            <input type="text" name="website" id="website" class="form-control" value="<?php echo $website; ?>" style="display:inline-block">
                                    </div>
                                </div>
							</div>
                            <!-- Tabs navs -->
                            <div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="my-4">
										<div class="row">
                                    		<!-- Grid column -->
                                           	<div class="col-sm-12 col-xl-8 mb-4 mb-xl-0">
                                          		<!-- Section: Live preview -->
                                                <section>
                                          			<ul class="nav nav-tabs" id="myTab" role="tablist">
                                                        <li class="nav-item waves-effect waves-light">
                                                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">TAX Details</a>
                                                        </li>
                                                        <li class="nav-item waves-effect waves-light" style="padding-left: 10px;">
                                                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Sender</a>
                                                        </li>
                                                        <!--<li class="nav-item waves-effect waves-light" style="padding-left: 10px;">
                                                          <a class="nav-link" id="sender-tab" data-toggle="tab" href="#sender" role="tab" aria-controls="sender" aria-selected="false">Sender</a>
                                                        </li>-->
                                                        <li class="nav-item waves-effect waves-light" style="padding-left: 10px;">
                                                          <a class="nav-link" id="receiver-tab" data-toggle="tab" href="#receiver" role="tab" aria-controls="receiver" aria-selected="false">Receiver</a>
                                                        </li>
                                                    </ul>
                                                   	<div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                        	<div id="tax_business" <?php if($customer_type==2) { ?>style="display:none"<?php }?>>
                                                                <div class="row mt-10 mb-10">
                                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                                                        <div class="form-group">
                                                                            <h5>Tax Treatment<span class="text-danger">*</span></h5>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                        <div class="controls">
                                                                            <select name="taxtype" id="taxtype" class="form-control" onchange="display_taxnofiled(this.value)">
                                                                                <option <?php if($taxtype=='Non-Vat') { ?> selected <?php } ?> value="Non-Vat">Non Vat Registered</option>
                                                                                <option <?php if($taxtype=='Vat') { ?> selected <?php } ?> value="Vat">Vat Registered</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php /*?><div class="row mt-5 mb-10"id="hidevat" style="display: block;">
                                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                                                        <div class="form-group">
                                                                            <h5>Tax Registration No.</h5>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                        <div class="controls">
                                                                            <input type="text" name="taxnumber" id="taxnumber1" class="form-control" value="<?php echo $taxnumber; ?>" minlength="15" maxlength="15" />
                                                                        </div>
                                                                    </div>
                                                                </div><?php */?>
                                                                <div class="row mt-5 mb-10" id="vat" <?php if($customer_type==2 && $taxtype=='Non-Vat') { ?>style="display:none"<?php } 
																if($pagetitle=="Add") {?> style="display:none"<?php } ?>>
                                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                                                        <div class="form-group">
                                                                            <h5>Tax Registration No.<span class="text-danger">*</span></h5>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                        <div class="controls">
                                                                            <input onblur="checkwidth(this.value)" type="text" name="taxnumber" id="taxnumber1" class="form-control" value="<?php echo $taxnumber; ?>"  minlength="15" maxlength="15"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <div id="tax_individual" <?php if($customer_type==1) { ?>style="display:none"<?php } if($pagetitle=='Add'){ ?> style="display:none" <?php }?>>
                                                            	 <div class="row mt-10 mb-10">
                                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                                                    	No need to add tax details for Individual
                                                                    </div>
                                                                 </div>
                                                            </div>
                                                     	</div>
                                                       
                                                        
                                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                        	
                                                            <div class="row mt-10 mb-10">
                                                            
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <h3>Sender Address</h3>
                                                                    </div>
                                                                </div>
                                                                
                                                               
                                                            </div>
                                                            
                                                            <div class="row mt-10 mb-10">
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <h5>Person Name<span class="text-danger">*</span></h5>
                                                                        <div class="controls">
                                                                            <input type="text" name="pname" id="pname" value="<?php echo $fname; ?>" class="form-control" />
                                                                        </div>
                                                                    </div>
																	
                                                                    <div class="form-group">
                                                                        <h5>Phone<span class="text-danger">*</span></h5>
                                                                        <div class="controls">
                                                                            <input type="text" name="phonetwo" id="phonetwo" value="<?php echo $phone; ?>" class="form-control" onkeypress="return isNumberKey(event);" maxlength="12">
                                                                        </div>
                                                                    </div>
																	<div class="form-group">
                                                                        <h5>Address <span class="text-danger">*</span></h5>
                                                                        <div class="controls">
                                                                            <textarea name="address" rows="1" id="address" class="form-control"><?php echo stripslashes($address); ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <h5>Country / Region</h5>
                                                                        <div class="controls">
                                                                            <select name="country" id="country" class="form-control" onchange="get_state(this.value)">
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
                                                                    </div>

                                                                    
																	<div class="form-group">
                                                                        <h5>Provience</h5>
                                                                        <div class="controls">
                                                                            <select name="state" id="state" class="form-control" onchange="get_city(this.value)">
                                                                                <option value="">Select Provience</option>
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
                                                                    <div class="form-group">
                                                                        <h5>City </h5>
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

                                                                   <?php /*?> <div class="form-group">
                                                                        <h5>Area</h5>
                                                                        <div class="controls">
                                                                             <input type="text" name="area" id="area" value="<?php echo $area; ?>" class="form-control">
                                                                        </div>
                                                                    </div><?php */?>

                                                                    <div class="form-group">
                                                                        <h5>Zip Code</h5>
                                                                        <div class="controls">
                                                                             <input type="text" name="pincode" id="pincode" value="<?php echo $pincode; ?>" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    

                                                                    <div class="form-group">
                                                                        <h5>Fax</h5>
                                                                        <div class="controls">
                                                                            <input type="text" name="fax" id="fax" value="<?php echo $fax; ?>" class="form-control" onkeypress="return isNumberKey(event);" maxlength="12">
                                                                        </div>
                                                                    </div>
                                                                
                                                                </div>


                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                    
																</div>
                                                            </div>
                                                            
                                                        </div>
<div class="tab-pane fade" id="receiver" role="tabpanel" aria-labelledby="receiver-tab">
    <div class="row mt-10 mb-10">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="form-group">
                <h3>Receiver Address</h3>
                
            </div>
        </div>
    </div>
    <style>
        .card-header .title {
            font-size: 17px;
            color: #000;
        }
        .card-header .accicon {
          float: right;
          font-size: 20px;  
          width: 2em;
        }
        .card-header{
          cursor: pointer;
        }
        .card{
          border: 1px solid #ddd;
        }
        .card-body{
          border: 1px solid #ddd;
        }
        .card-header:not(.collapsed) .rotate-icon {
          transform: rotate(180deg);
        }
        .card-header
        {
            background-color: #a8ddff !important;
        }
        </style>
    <div class="row mt-10 mb-10">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12" id="compare_div">
            <div class="accordion" id="accordionExample">
                
                    <!--<div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6"><strong>1.</strong></div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6"><i class="fas fa-trash-alt newicon" style="float:right" id="0" onclick="hidetr(this.id);"></i></div>
                    </div>-->
                    <?php 
                        if(@$_REQUEST['id']!='')
                        {
                            $row=select_query("*","customers_receiver", array("cid="=>$id));
                            $i=1;
                            if($row->num_rows)
                            {
                                while($b=$row->fetch_array())
                                { ?>
                                    <input type="hidden" name="rcvr_id[<?php echo $i;?>]" id="rcvr_id" value="<?php echo $b['id']; ?>">

                                    <input type="hidden" id="cont_val_<?php echo $i;?>" value="<?php echo $b['rcvr_mno']; ?>" name="cont_val[<?php echo $i;?>]" />

                                    <div id="divtr_0_<?php echo $i;?>">
                                        <div class="card">
                                            <div class="card-header" data-toggle="collapse" data-target="#collapse0" aria-expanded="true">     
                                                <span class="title" id="titlename_u_<?php echo $i;?>"> #<?php echo $i; ?> <?php echo $b['rcvr_name']; ?> </span>
                                                <span class="accicon">
                                                <i class="fas fa-trash-alt newicon" id="<?php echo $b['id'];?>" onclick="hidetr_up(this.id);"></i>
                                                <i class="fas fa-angle-down rotate-icon"></i>
                                                </span>
                                            </div>
                                            <div id="collapse0" class="collapse show" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="secondtab">
                                                        <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                               <h5>Person Name<span class="text-danger">*</span></h5>
                                                                <div class="controls">
                                                                     <input type="text" name="frcvr_name_0[<?php echo $i;?>]"
                                                                     data-nid="<?php echo $i;?>" id="frcvr_name0" class="form-control" value="<?php echo $b['rcvr_name']; ?>" style="display:inline-block" onblur="up_rvcr_name_get(this.value,this)">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>IQAMA No.</h5>
                                                                <div class="controls">
                                                                    <input type="text" name="rcvr_iqamano_0[<?php echo $i;?>]" id="rcvr_iqamano0" value="<?php echo $b['rcvr_iqamano']; ?>" class="form-control" onkeypress="return isNumberKey(event);">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>VAT No.</h5>
                                                                <div class="controls">
                                                                    <input type="text" name="rcvr_vat_no_0[<?php echo $i;?>]" rows="1" id="rcvr_vat_no0" class="form-control" value="<?php echo $b['rcvr_vat_no']; ?>" onkeypress="return isNumberKey(event);" maxlength="15"  />                             </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Contact Number<span class="text-danger">*</span></h5>
                                                                <div class="controls">
                                                                    <input type="text" name="rcvr_mno_0[<?php echo $i;?>]" id="rcvr_mno0" value="<?php echo $b['rcvr_mno']; ?>" class="form-control" onkeypress="return isNumberKey(event);" maxlength="12" onblur="chkContact(this.value);">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Address <span class="text-danger">*</span></h5>
                                                                <div class="controls">
                                                                    <textarea placeholder="Street 1" style="height: 25px;" name="rcvr_address_0[<?php echo $i;?>]" rows="1" id="rcvr_address0" class="form-control"><?php echo stripslashes($b['rcvr_address']); ?> 
                                                                    </textarea>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>&nbsp; </h5>
                                                                <div class="controls">
                                                                    
                                                                    <textarea placeholder="Street 2" style="height: 25px;" name="rcvr_address1_0[<?php echo $i;?>]" rows="1" id="rcvr_address10" class="form-control"><?php echo stripslashes($b['rcvr_address1']); ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Country</h5>
                                                                <div class="controls">
                                                                    <select name="rcvr_country_0[<?php echo $i;?>]" id="rcvr_country0" class="form-control" onchange="get_rcvr_state(this.value),'0'">
                                                                        <option value="">Select Country</option>
                                                                        <?php $country='184';
                                                                        $selcon=mysqli_query($dlink,"SELECT * FROM location where location_type='0' and location_id='184' and parent_id='0' and is_visible='0' order by name");
                                                                        while ($bcon=mysqli_fetch_array($selcon)) {
                                                                            ?>
                                                                        <option <?php if ($bcon['location_id'] == $b['rcvr_country']) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option>
                                                                        <?php
                                                                        }?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Provience</h5>
                                                                <div class="controls">
                                                                    <select name="rcvr_state_0[<?php echo $i;?>]" id="rcvr_state0" class="form-control" onchange="get_rcvr_city(this.value,'0')">
                                                                        <option value="">Select Provience</option>
                                                                        <?php
                                                                        $selsta=mysqli_query($dlink,"SELECT * FROM location where location_type='1' and parent_id='".$country."' and is_visible='0' order by name");
                                                                        while($s=mysqli_fetch_array($selsta)) {
                                                                        ?>
                                                                        <option <?php if ($s['location_id'] == $b['rcvr_state']) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option>
                                                                       <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>City </h5>
                                                                <div class="controls">
                                                                   <select name="rcvr_city_0[<?php echo $i;?>]" id="rcvr_city0" class="form-control">
                                                                        <option value="">Select City</option>
                                                                        <?php
                                                                        $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$b['rcvr_state']."' and is_visible='0' order by name");
                                                                        while($s1=mysqli_fetch_array($selcit)) {
                                                                        ?>
                                                                        <option <?php if ($s1['location_id'] == $b['rcvr_city']) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <?php /*?><div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Landmark</h5>
                                                                <div class="controls">
                                                                    <input type="text" name="rcvr_landmark_0[<?php echo $i;?>]" id="rcvr_landmark0" value="<?php echo $b['rcvr_landmark']; ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div><?php */?>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Email Address</h5>
                                                                <div class="controls">
                                                                    <input type="email" name="rcvr_email_0[<?php echo $i;?>]" id="rcvr_email0" value="<?php echo $b['rcvr_email']; ?>" class="form-control">
                                                                </div>
                                                                <p id="userexist" style="color:#F00;"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Zipcode</h5>
                                                                <div class="controls">
                                                                    <input type="text" name="rcvr_pincode_0[<?php echo $i;?>]" id="rcvr_pincode0" value="<?php echo $b['rcvr_pincode']; ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Fax</h5>
                                                                <div class="controls">
                                                                    <input type="text" name="rcvr_fax_0[<?php echo $i;?>]" id="rcvr_fax0" value="<?php echo $b['rcvr_fax']; ?>" class="form-control">
                                                                    <input type="hidden" id="trremove_up_0<?php echo $i;?>" value="1" name="trremove_0[<?php echo $i;?>]" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Company Name</h5>
                                                                <div class="controls">
                                                                    <input type="text" name="rcvr_company_0[<?php echo $i;?>]" id="rcvr_company0" value="<?php echo $b['rcvr_company']; ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                   </div>
                                                    </div>
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                                <?php $i++; }

                            }
                            ?>
                            <input type="hidden" id="update_rows" value="<?php echo $row->num_rows; ?>" name="update_rows" />
                            <?php
                        }
                        else
                        { ?>
                            <div id="divtr0">
                                <div class="card">
                                    <div class="card-header" data-toggle="collapse" data-target="#collapse0" aria-expanded="true">     
                                        <span class="title" id="titlename_i_1"> #1 </span>
                                        <span class="accicon">
                                        <i class="fas fa-trash-alt newicon" id="0" onclick="hidetr(this.id);"></i>
                                        <i class="fas fa-angle-down rotate-icon"></i>
                                        </span>
                                    </div>
                                    <div id="collapse0" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="secondtab">
                                                <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                       <h5>Person Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                             <input type="text" name="frcvr_name[0]" id="frcvr_name0" data-nid="1"class="form-control" value="<?php echo $frcvr_name; ?>" style="display:inline-block" onblur="in_rvcr_name_get(this.value,this)">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>IQAMA No.</h5>
                                                        <div class="controls">
                                                            <input type="text" name="rcvr_iqamano[0]" id="rcvr_iqamano0" value="<?php echo $rcvr_iqamano; ?>" class="form-control" onkeypress="return isNumberKey(event);">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>VAT No.</h5>
                                                        <div class="controls">
                                                            <input type="text" name="rcvr_vat_no[0]" rows="1" id="rcvr_vat_no0" class="form-control" value="<?php echo $rcvr_vat_no; ?>" onkeypress="return isNumberKey(event);" maxlength="15"  />                             </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Contact Number<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="rcvr_mno[0]" id="rcvr_mno0" value="<?php echo $rcvr_mno; ?>" class="form-control" onkeypress="return isNumberKey(event);" maxlength="12" onblur="chkContact(this.value);">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Address <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <textarea placeholder="Street 1" style="height: 25px;" name="rcvr_address[0]" rows="1" id="rcvr_address0" class="form-control"><?php echo stripslashes($rcvr_address); ?></textarea>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>&nbsp; </h5>
                                                        <div class="controls">
                                                            
                                                            <textarea placeholder="Street 2" style="height: 25px;" name="rcvr_address1[0]" rows="1" id="rcvr_address10" class="form-control"><?php echo stripslashes($rcvr_address1); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Country</h5>
                                                        <div class="controls">
                                                            <select name="rcvr_country[0]" id="rcvr_country0" class="form-control" onchange="get_rcvr_state(this.value),'0'">
                                                                <option value="">Select Country</option>
                                                                <?php $country='184';
                                                                $selcon=mysqli_query($dlink,"SELECT * FROM location where location_type='0' and location_id='184' and parent_id='0' and is_visible='0' order by name");
                                                                while ($bcon=mysqli_fetch_array($selcon)) {
                                                                    ?>
                                                                <option <?php if ($bcon['location_id'] == $rcvr_country) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option>
                                                                <?php
                                                                }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Provience</h5>
                                                        <div class="controls">
                                                            <select name="rcvr_state[0]" id="rcvr_state0" class="form-control" onchange="get_rcvr_city(this.value,'0')">
                                                                <option value="">Select Provience</option>
                                                                <?php
                                                                $selsta=mysqli_query($dlink,"SELECT * FROM location where location_type='1' and parent_id='".$country."' and is_visible='0' order by name");
                                                                while($s=mysqli_fetch_array($selsta)) {
                                                                ?>
                                                                <option <?php if ($s['location_id'] == $rcvr_state) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option>
                                                               <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>City </h5>
                                                        <div class="controls">
                                                           <select name="rcvr_city[0]" id="rcvr_city0" class="form-control">
                                                                <option value="">Select City</option>
                                                                <?php
                                                                $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$state."' and is_visible='0' order by name");
                                                                while($s1=mysqli_fetch_array($selcit)) {
                                                                ?>
                                                                <option <?php if ($s1['location_id'] == $rcvr_city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                        </select>
                                                        </div>
                                                    </div>
                                                 </div>
                                            </div>
                                            <div class="row">
                                                <?php /*?><div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Landmark</h5>
                                                        <div class="controls">
                                                            <input type="text" name="rcvr_landmark[0]" id="rcvr_landmark0" value="<?php echo $rcvr_landmark; ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div><?php */?>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Email Address</h5>
                                                        <div class="controls">
                                                            <input type="email" name="rcvr_email[0]" id="rcvr_email0" value="<?php echo $rcvr_email; ?>" class="form-control">
                                                        </div>
                                                        <p id="userexist" style="color:#F00;"></p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Zipcode</h5>
                                                        <div class="controls">
                                                            <input type="text" name="rcvr_pincode[0]" id="rcvr_pincode0" value="<?php echo $rcvr_pincode; ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Fax</h5>
                                                        <div class="controls">
                                                            <input type="text" name="rcvr_fax[0]" id="rcvr_fax0" value="<?php echo $rcvr_fax; ?>" class="form-control">
                                                            <input type="hidden" id="trremove_0" value="1" name="trremove[0]" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Company Name</h5>
                                                        <div class="controls">
                                                            <input type="text" name="rcvr_company[0]" id="rcvr_company0" value="<?php echo $rcvr_company; ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>
                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </div>
                        <?php }
                    ?>
                    
                
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 col-sm-12 col-lg-6 mt-20">
                <a class="btn btn-danger add-comp btn-x" style="color: #fff;"><i class="fa fa-plus"></i> Add Another Receiver</a>
            </div>
        </div>
        
        <input type="hidden" id="total_rows" value="1" name="total_rows" />
    </div>

</div>
                                                        
                                                    </div>
                                          		</section>
                                                <!-- Section: Live preview -->
                                          
                                              </div>
                                      		</div>
                                    	</div>
                                    
                                    
                                    
                                </div>
                            </div>
                            <!-- Tabs content -->
                            
                            
                            
                            
                            
                            
                            <?php /*?><div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
                                        <h5>Full Name<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <h5>Email</h5>
                                        <div class="controls">
                                            <input type="email" name="email" id="email" value="<?php echo $email; ?>" class="form-control" onchange="check_email_ifexist(this.value)">
                                        </div>
										<p id="userexist" style="color:#F00;"></p>
                                    </div>
                                </div>
							</div><?php 
                                <div class="row">
                                	<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<h5>Mobile Number<span class="text-danger">*</span></h5>
	                                        <div class="controls">
                                            	<input type="text" name="mno" id="mno" value="<?php echo $mno; ?>" class="form-control" onkeypress="return isNumberKey(event);" maxlength="12">
                                        	</div>
										</div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <h5>Address <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea name="address" rows="1" id="address" class="form-control"><?php echo stripslashes($address); ?></textarea>
                                            </div>
                                        </div>
                                	</div>
								</div>
                            	<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
	                                        <h5>Zipcode</h5>
	                                        <div class="controls">
    	                                        <input type="text" name="pincode" id="pincode" value="<?php echo $pincode; ?>" class="form-control">
        	                                </div>
	                                    </div>
	                                </div>
                               	 	<div class="col-lg-6 col-md-6 col-sm-12 col-12">
	                                    <div class="form-group">
	                                        <h5>Country </h5>
	                                        <div class="controls">
    	                                        <select name="country" id="country" class="form-control" onchange="get_state(this.value)">
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
										</div>
									</div>
								</div>
                                <div class="row">
                                	<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
	                                        <h5>State </h5>
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
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
                                        	<h5>City </h5>
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
                                
                                
                                <div class="bt-1 pt-10"></div>
                                
                                <div class="row">
                                	<div class="col-lg-12 col-md-12 col-sm-12 col-12"><h1>Recevier's Details</h1></div>
                                </div>
                                
                                <div class="row">	
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
                                        	<h5>Full Name<span class="text-danger">*</span></h5>
                                        	<div class="controls">
                                            	<input type="text" name="rcvr_name" id="rcvr_name" class="form-control" value="<?php echo $rcvr_name; ?>">
                                        	</div>
                                    	</div>
                                	</div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <h5>Email</h5>
                                            <div class="controls">
                                                <input type="email" name="rcvr_email" id="rcvr_email" value="<?php echo $rcvr_email; ?>" class="form-control">
                                            </div>
                                            <p id="userexist" style="color:#F00;"></p>
                                        </div>
                                    </div>
                              	</div>
                                <div class="row">
                               		<div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    	<div class="form-group">
                                        	<h5>Mobile Number<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            	<input type="text" name="rcvr_mno" id="rcvr_mno" value="<?php echo $rcvr_mno; ?>" class="form-control" onkeypress="return isNumberKey(event);" maxlength="12">
                                           	</div>
                                       	</div>
                                	</div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    	<div class="form-group">
                                        	<h5>Address <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            	<textarea name="rcvr_address" rows="1" id="rcvr_address" class="form-control"><?php echo stripslashes($rcvr_address); ?></textarea>
                                           	</div>
                                      	</div>
                                   	</div>
                           		</div>
                                <div class="row">
                                	<div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    	<div class="form-group">
                                        	<h5>Zipcode</h5>
                                            <div class="controls">
                                            	<input type="text" name="rcvr_pincode" id="rcvr_pincode" value="<?php echo $rcvr_pincode; ?>" class="form-control">
                                           	</div>
                                    	</div>
                                   	</div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    	<div class="form-group">
                                        	<h5>Country </h5>
                                            <div class="controls">
                                            	<select name="rcvr_country" id="rcvr_country" class="form-control" onchange="get_rcvr_state(this.value)">
                                                	<option value="">Select Country</option>
                                                   	<?php $country='184';
                                                    $selcon=mysqli_query($dlink,"SELECT * FROM location where location_type='0' and location_id='184' and parent_id='0' and is_visible='0' order by name");
                                                    while ($bcon=mysqli_fetch_array($selcon)) {
                                                    	?>
                                                    <option <?php if ($bcon['location_id'] == $rcvr_country) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option>
                                                    <?php
                                                    }?>
                                               	</select>
                                         	</div>
                                      	</div>
                                   	</div>
                              	</div>
                                <div class="row">
                                	<div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    	<div class="form-group">
                                        	<h5>State </h5>
                                            <div class="controls">
                                            	<select name="rcvr_state" id="rcvr_state" class="form-control" onchange="get_rcvr_city(this.value)">
                                                        <option value="">Select State</option>
                                                        <?php
                                                        $selsta=mysqli_query($dlink,"SELECT * FROM location where location_type='1' and parent_id='".$country."' and is_visible='0' order by name");
                                                        while($s=mysqli_fetch_array($selsta)) {
                                                        ?>
                                                        <option <?php if ($s['location_id'] == $rcvr_state) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option>
                                                       <?php
                                                        }
                                                        ?>
                                                    </select>
                                           	</div>
                                       	</div>
                                  	</div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <h5>City </h5>
                                            <div class="controls">
                                                <select name="rcvr_city" id="rcvr_city" class="form-control">
                                                            <option value="">Select City</option>
                                                            <?php
                                                            $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$state."' and is_visible='0' order by name");
                                                            while($s1=mysqli_fetch_array($selcit)) {
                                                            ?>
                                                            <option <?php if ($s1['location_id'] == $rcvr_city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                              		</div>
                               	</div>*/?>
                                
                                
                                <div class="bt-1 pt-10"> </div>
								<div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <button type="submit" class="btn btn-danger" id="submit" name="submit">Submit</button>
                                    </div>

                                    <?php 
                                        if(@$_REQUEST['id']!='')
                                        {
                                            ?>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <a href="<?php echo $site_url; ?>new-shipment/<?php echo $id; ?>" class="btn btn-danger" id="invoice_btn" name="invoice_btn">Invoice</a>
                                            </div>
                                            <?php 
                                        }
                                    ?>
                                    
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
    $('input[name="customer_type"]').change(function(){
        if($('#business').prop('checked')){
            $('#tax_business').show();
			$('#tax_individual').hide();
        }else{
            $('#tax_business').hide();
			$('#tax_individual').show();
        }
    });
});

$( document ).ready(function() {
    
    var row_total = $('#update_rows').val();
    for (var i = 1; i <= row_total; i++) 
    {
        var cntno = $('#cont_val_'+i).val();
        myarray.push(cntno);
    }
});

function chkContact(val)
{
    //console.log($.inArray(val, myarray));
    if ($.inArray(val, myarray) >= 0) 
    {
        alert('Already exist!');
    }
}

var ci=1;
var myarray=[];
$('.add-comp').on("click", function(e){

    var pst_id = ci-1;
    var cnt = $('#rcvr_mno'+pst_id).val();
    myarray.push(cnt);

    var no=parseInt(ci)+parseInt(1);
    $('#total_rows').val(parseInt($('#total_rows').val())+parseInt(1));
    var ci_new=parseInt(ci)+parseInt(1);
    var new_input = '<div id="divtr'+ci+'"><div class="card"><div class="card-header" data-toggle="collapse" data-target="#collapse'+ci+'" aria-expanded="true"> <span class="title" id="titlename_i_'+ci+'"> #'+ci+' </span><span class="accicon"><i class="fas fa-trash-alt newicon" id="'+ci+'" onclick="hidetr(this.id);"></i><i class="fas fa-angle-down rotate-icon"></i></span></div><div id="collapse'+ci+'" class="collapse show" data-parent="#accordionExample"><div class="card-body"><div class="secondtab"><div class="row"><div class="col-lg-4 col-md-4 col-sm-12 col-12"><div class="form-group"><h5>Person Name<span class="text-danger">*</span></h5><div class="controls"><input type="text" name="frcvr_name['+ci+']" id="frcvr_name'+ci+'" data-nid="'+ci+'" class="form-control" value="" style="display:inline-block" onblur="in_rvcr_name_get(this.value,this)"></div></div></div><div class="col-lg-4 col-md-4 col-sm-12 col-12"><div class="form-group"><h5>IQAMA No.</h5><div class="controls"><input type="text" name="rcvr_iqamano['+ci+']" id="rcvr_iqamano'+ci+'" value="" class="form-control" onkeypress="return isNumberKey(event);"></div></div></div><div class="col-lg-4 col-md-4 col-sm-12 col-12"><div class="form-group"><h5>VAT No.</h5><div class="controls"><input type="text" name="rcvr_vat_no['+ci+']" rows="1" id="rcvr_vat_no" class="form-control" value="" onkeypress="return isNumberKey(event);" maxlength="15"  /></div></div></div></div><div class="row"><div class="col-lg-4 col-md-4 col-sm-12 col-12"><div class="form-group"><h5>Contact Number<span class="text-danger">*</span></h5><div class="controls"><input type="text" name="rcvr_mno['+ci+']" id="rcvr_mno'+ci+'" value="" class="form-control" onkeypress="return isNumberKey(event);" maxlength="12" onblur="chkContact(this.value);"></div></div></div><div class="col-lg-4 col-md-4 col-sm-12 col-12"><div class="form-group"><h5>Address <span class="text-danger">*</span></h5><div class="controls"><textarea placeholder="Street 1" style="height: 25px;" name="rcvr_address['+ci+']" rows="1" id="rcvr_address'+ci+'" class="form-control"></textarea></div></div></div><div class="col-lg-4 col-md-4 col-sm-12 col-12"><div class="form-group"><h5>&nbsp; </h5><div class="controls"><textarea placeholder="Street 2" style="height: 25px;" name="rcvr_address1['+ci+']" rows="1" id="rcvr_address1'+ci+'" class="form-control"></textarea></div></div></div></div><div class="row"><div class="col-lg-4 col-md-4 col-sm-12 col-12"><div class="form-group"><h5>Country</h5><div class="controls"><select name="rcvr_country['+ci+']" id="rcvr_country'+ci+'" class="form-control" onchange="get_rcvr_state(this.value,'+ci+')"><option value="">Select Country</option><?php $country='184';$selcon=mysqli_query($dlink,"SELECT * FROM location where location_type='0' and location_id='184' and parent_id='0' and is_visible='0' order by name");while ($bcon=mysqli_fetch_array($selcon)) { ?><option <?php if ($bcon['location_id'] == $rcvr_country) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option><?php
}?></select></div></div></div><div class="col-lg-4 col-md-4 col-sm-12 col-12"><div class="form-group"><h5>Provience</h5><div class="controls"><select name="rcvr_state['+ci+']" id="rcvr_state'+ci+'" class="form-control" onchange="get_rcvr_city(this.value,'+ci+')"><option value="">Select Provience</option><?php $selsta=mysqli_query($dlink,"SELECT * FROM location where location_type='1' and parent_id='".$country."' and is_visible='0' order by name");while($s=mysqli_fetch_array($selsta)) { ?> <option <?php if ($s['location_id'] == $rcvr_state) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option> <?php } ?> </select> </div> </div> </div> <div class="col-lg-4 col-md-4 col-sm-12 col-12"> <div class="form-group"> <h5>City </h5> <div class="controls">  <select name="rcvr_city['+ci+']" id="rcvr_city'+ci+'" class="form-control"> <option value="">Select City</option> <?php $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$state."' and is_visible='0' order by name"); while($s1=mysqli_fetch_array($selcit)) { ?> <option <?php if ($s1['location_id'] == $rcvr_city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option> <?php } ?> </select> </div> </div> </div> </div><div class="col-lg-4 col-md-4 col-sm-12 col-12"> <div class="form-group"> <h5>Email Address</h5> <div class="controls"> <input type="email" name="rcvr_email['+ci+']" id="rcvr_email'+ci+'" value="" class="form-control"> </div> <p id="userexist" style="color:#F00;"></p> </div> </div> <div class="col-lg-4 col-md-4 col-sm-12 col-12"> <div class="form-group"> <h5>Zipcode</h5> <div class="controls"><input type="text" name="rcvr_pincode['+ci+']" id="rcvr_pincode'+ci+'" value="" class="form-control"> </div>  </div> </div></div><div class="row"> <div class="col-lg-4 col-md-4 col-sm-12 col-12"> <div class="form-group"><h5>Fax</h5> <div class="controls"> <input type="text" name="rcvr_fax['+ci+']" id="rcvr_fax'+ci+'" value="" class="form-control"><input type="hidden" id="trremove_'+ci+'" value="1" name="trremove['+ci+']" /></div></div></div><div class="col-lg-4 col-md-4 col-sm-12 col-12"> <div class="form-group"><h5>Company Name</h5> <div class="controls"> <input type="text" name="rcvr_company['+ci+']" id="rcvr_company'+ci+'" value="" class="form-control"></div></div></div></div></div></div></div></div></div>';
    $('#compare_div').append(new_input);
    ci++;
});

function hidetr(val)
{
	if(confirm("Are you sure you want to delete this row?"))
	{
		var chng =0;
		$('#divtr'+val).hide();
		$('#trremove_'+val).val(chng);
		
		$('#frcvr_name'+val).val("");
		$('#rcvr_iqamano'+val).val("");
		$('#rcvr_vat_no'+val).val("");
		
		$('#rcvr_mno'+val).val("");
		$('#rcvr_address'+val).val("");
		$('#rcvr_address1'+val).val("");
		$('#rcvr_country'+val).val("");
		$('#rcvr_state'+val).val("");
		
		$('#rcvr_city'+val).val("");
		
		$('#rcvr_email'+val).val("");
		$('#rcvr_pincode'+val).val("");
		$('#rcvr_fax'+val).val("");
        $('#rcvr_company'+val).val("");
	}
	else
		return false;
	
}

function hidetr_up(val)
{
    if(confirm("Are you sure you want to delete this row?"))
    {
        var delid =val;

        $.ajax({
            type: "POST",
            url: "<?php echo $site_url; ?>admin_ajax.php",
            data:{delid:delid,action:'delete_cust_rvcr'},
            success: function(data)
            {  
                $("#accordionExample").load(' #accordionExample');
            }
        });
    }
    else
        return false;
    
}
</script>
<script>
function checkwidth(fval)
{
	var str=fval.length;
	if(str<15 || str>15)
	{
		alert("Enter 15 Digit VAT Number only");
		return false;
	}
}
function shownumber(pval)
{
	$('#phonetwo').val(pval);
}
$(document).ready(function(){
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
function name_get()
{ 
	$('#pname').val($('#fname').val());
	$('#pname_div').text($('#fname').val());
}
function up_rvcr_name_get(val,id)
{ 
    var id = $(id).attr("data-nid");
    var title_val = val;
    $('#titlename_u_'+id).text('#'+id+ ' ' +title_val);
    
}
function in_rvcr_name_get(val,id)
{ 
   var id = $(id).attr("data-nid");
    var title_val = val;
    $('#titlename_i_'+id).text('#'+id+ ' ' +title_val);
    
}
$(document).ready(function(){ 
	$("#submit").click(function()
	{ 
		
		if($("#fname").val()=="")
		{
			$("#fname").attr("placeholder", "Please Enter First Name.");
			$("#fname").addClass("error_textbox");
			$("#fname").focus();
			return false;
		}
		/*if($("#mname").val()=="")
		{
			$("#mname").attr("placeholder", "Please Enter Middle Name.");
			$("#mname").addClass("error_textbox");
			$("#mname").focus();
			return false;
		}*/

		/*if($("#lname").val()=="")
		{
			$("#lname").attr("placeholder", "Please Enter Last Name.");
			$("#lname").addClass("error_textbox");
			$("#lname").focus();
			return false;
		}*/
	/*	if($("#email").val()=="")
		{
			$("#email").attr("placeholder", "Please Enter Email.");
			$("#email").addClass("error_textbox");
			$("#email").focus();
			return false;
		} */
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
		/*if($("#phone").val()!="")
        {
            
            var str1=$("#phone").val();
            var filter1=/[1-9]{1}[0-9]{9}/;
            if(filter1.test(str1))
            { }
            else 
            {
                $("#phone").val("");
                $("#phone").attr("placeholder", "Please Enter 10 Digit");
                $("#phone").addClass("error_textbox");
                $("#phone").focus();
                return false;
            }
        }*/
		
		if($("#address").val()=="")
		{
			$("#address").attr("placeholder", "Please Enter Address.");
			$("#address").addClass("error_textbox");
			$("#address").focus();
			return false;
		}
		if($('#business').prop('checked'))
		{
            if($('#taxtype').val()!='Non-Vat')
			{
				if($("#taxnumber1").val()=="")
				{
					$("#taxnumber1").attr("placeholder", "Please Enter Taxnumber.");
					$("#taxnumber1").addClass("error_textbox");
					$("#taxnumber1").focus();
					return false;
				}
			}
        }
		else{
		
		}
        
	/*	if($("#pincode").val()=="")
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
		*/
		
		if($("#frcvr_name").val()=="")
		{
			$("#frcvr_name").attr("placeholder", "Please Enter Receiver's First Name.");
			$("#frcvr_name").addClass("error_textbox");
			$("#frcvr_name").focus();
			return false;
		}
		/*if($("#mrcvr_name").val()=="")
		{
			$("#mrcvr_name").attr("placeholder", "Please Enter Receiver's Middle Name.");
			$("#mrcvr_name").addClass("error_textbox");
			$("#mrcvr_name").focus();
			return false;
		}
		if($("#lrcvr_name").val()=="")
		{
			$("#lrcvr_name").attr("placeholder", "Please Enter Receiver's Last Name.");
			$("#lrcvr_name").addClass("error_textbox");
			$("#lrcvr_name").focus();
			return false;
		}*/
		/*if($("#rcvr_email").val()=="")
		{
			$("#rcvr_email").attr("placeholder", "Please Enter Receiver's Email.");
			$("#rcvr_email").addClass("error_textbox");
			$("#rcvr_email").focus();
			return false;
		}*/
		/*if($("#rcvr_email").val()!="")
		{
			var ch= validateEmail($("#rcvr_email").val());
			if(!ch)
			{
				$("#rcvr_email").val('');
				$("#rcvr_email").attr("placeholder", "Please Enter Valid Receiver's Email.");
          		$("#rcvr_email").addClass("error_textbox");
				$("#rcvr_email").focus();
				return false;
			}
		}*/
		if($("#rcvr_mno").val()=="")
		{
			$("#rcvr_mno").attr("placeholder", "Please Enter Receiver's Mobile No.");
			$("#rcvr_mno").addClass("error_textbox");
			$("#rcvr_mno").focus();
			return false;
		}
		
		if($("#rcvr_address").val()=="")
		{
			$("#rcvr_address").attr("placeholder", "Please Enter Receiver's Address.");
			$("#rcvr_address").addClass("error_textbox");
			$("#rcvr_address").focus();
			return false;
		}
	/*	if($("#rcvr_pincode").val()=="")
		{
			$("#rcvr_pincode").attr("placeholder", "Please Enter  Receiver's Pincode.");
			$("#rcvr_pincode").addClass("error_textbox");
			$("#rcvr_pincode").focus();
			return false;
		}
		if($("#rcvr_country").val()=="")
		{
			$("#rcvr_country").attr("placeholder", "Please Select Receiver's Country.");
			$("#rcvr_country").addClass("error_textbox");
			$("#rcvr_country").focus();
			return false;
		}
		if($("#rcvr_state").val()=="")
		{
			$("#rcvr_state").attr("placeholder", "Please Select Receiver's State");
			$("#rcvr_state").addClass("error_textbox");
			$("#rcvr_state").focus();
			return false;
		}
		if($("#rcvr_city").val()=="")
		{
			$("#rcvr_city").attr("placeholder", "Please Select Receiver's City.");
			$("#rcvr_city").addClass("error_textbox");
			$("#rcvr_city").focus();
			return false;
		} */
		
	});
});

function get_rcvr_state(val,fid)
{
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{country:val,action:'get_state'},
	 success: function(data)
	 {	
	 	if(data.trim()=='Not Found')
		{
			$("#rcvr_state"+fid).html('<option value="">Select</option>');  
		}
		else if(data.trim()=='blank')
		{
			$("#rcvr_state"+fid).html('<option value="">Select</option>');  
		}
		else
		{
			$("#rcvr_state"+fid).html(data); 
		}
	  }
	});
}
function get_rcvr_city(val,fid)
{
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{state:val,action:'get_city'},
	 success: function(data)
	 {	
	 	if(data.trim()=='Not Found')
		{
			$("#rcvr_city"+fid).html('<option value="">Select</option>');  
		}
		else if(data.trim()=='blank')
		{
			$("#rcvr_city"+fid).html('<option value="">Select</option>');  
		}
		else
		{
			$("#rcvr_city"+fid).html(data); 
		}
	  }
	});
}


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
	 data:{email:val,action:'check_customer_email_exist'},
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
  if(@$_REQUEST['id']!='')
  {
	                
	  $name=$_POST['fname'];
	  $rcv_name=$_POST['frcvr_name'];
	  /*$arr=array("customer_type"=>$_POST['customer_type'],"name"=>ucfirst($name),"company_name"=>$_POST['company_name'],"phone"=>$_POST['phone'],"website"=>$_POST['website'],"taxtype"=>$_POST['taxtype'],"taxnumber"=>$_POST['taxnumber'],"fax"=>$_POST['fax'],"email"=>$_POST['email'],"mno"=>$_POST['mno'],"address"=>addslashes($_POST['address']),"pincode"=>$_POST['pincode'],"country"=>$_POST['country'],"state"=>$_POST['state'],"city"=>$_POST['city'],"rcvr_name"=>ucfirst($rcv_name),"rcvr_email"=>$_POST['rcvr_email'],"rcvr_mno"=>$_POST['rcvr_mno'],"rcvr_address"=>addslashes($_POST['rcvr_address']),"rcvr_address1"=>addslashes($_POST['rcvr_address1']),"rcvr_pincode"=>$_POST['rcvr_pincode'],"rcvr_country"=>$_POST['rcvr_country'],"rcvr_state"=>$_POST['rcvr_state'],"rcvr_city"=>$_POST['rcvr_city'],"rcvr_fax"=>$_POST['rcvr_fax'],"rcvr_landmark"=>$_POST['rcvr_landmark'],"customerid"=>$_POST['customerid'],"rcvr_vat_no"=>$_POST['rcvr_vat_no'],"rcvr_iqamano"=>$_POST['rcvr_iqamano']);*/   
      
	  $taxnumber='';
	 $taxtype='';
	 if($_POST['customer_type']==2)
	 {
	  	$taxtype='Non-Vat';
	  	$taxnumber='';
	 }
	 else
	 {
		
		if($_POST['taxtype']=='Non-Vat'){
	  		$taxtype='Non-Vat';
			$taxnumber='';
		}
	  	else if($_POST['taxtype']=='Vat')
		{
			$taxtype='Vat';
			$taxnumber=$_POST['taxnumber'];
		}
	 }
		
	  	
	  $arr=array("customer_type"=>$_POST['customer_type'],"name"=>ucfirst($name),"company_name"=>$_POST['company_name'],"phone"=>$_POST['phone'],"website"=>$_POST['website'],"taxtype"=>$taxtype,"taxnumber"=>$taxnumber,"fax"=>$_POST['fax'],"email"=>$_POST['email'],"mno"=>$_POST['mno'],"address"=>addslashes($_POST['address']),"pincode"=>$_POST['pincode'],"country"=>$_POST['country'],"state"=>$_POST['state'],"city"=>$_POST['city'],"customerid"=>$_POST['customerid']); 

	    $insert = update_query($arr,"id=".$id,"customers");

	    if($insert)
	    {
            $total_update_row=$_POST['update_rows']; // 3

            $totalinsertrow=$_POST['total_rows']; // 2
            $total_insert_row = $totalinsertrow-1; // 1

            $total_rvcr_row = $total_update_row + $total_insert_row; 

            for($i=1;$i<=$total_update_row;$i++)
            {
                if($_POST['trremove_0'][$i][0] == 1)
                {
                    $rcv_name='';$rid='';
                    $rcv_name=$_POST['frcvr_name_0'][$i];
                    $rid=$_POST['rcvr_id'][$i];

                    $arr_=array("rcvr_name"=>ucfirst($rcv_name),"rcvr_company"=>$_POST['rcvr_company_0'][$i],"rcvr_email"=>$_POST['rcvr_email_0'][$i],"rcvr_mno"=>$_POST['rcvr_mno_0'][$i],"rcvr_address"=>addslashes($_POST['rcvr_address_0'][$i]),"rcvr_address1"=>addslashes($_POST['rcvr_address1_0'][$i]),"rcvr_pincode"=>$_POST['rcvr_pincode_0'][$i],"rcvr_country"=>$_POST['rcvr_country_0'][$i],"rcvr_state"=>$_POST['rcvr_state_0'][$i],"rcvr_city"=>$_POST['rcvr_city_0'][$i],"rcvr_fax"=>$_POST['rcvr_fax_0'][$i],"rcvr_vat_no"=>$_POST['rcvr_vat_no_0'][$i],"rcvr_iqamano"=>$_POST['rcvr_iqamano_0'][$i]);


                    $insert = update_query($arr_,"id=".$rid,"customers_receiver");
                    /*echo"<pre>"; print_r($arr_);
                    exit;*/
                }
            }

            if($totalinsertrow != 1)
            {
                for ($j=1; $j<=$total_insert_row; $j++) 
                { 
                    if($_POST['trremove'][$j] == 1)
                    {
                        $rcv_name="";
                        $rcv_name=$_POST['frcvr_name'][$j];
                        $arr_=array("cid"=>$id,"rcvr_name"=>ucfirst($rcv_name),"rcvr_company"=>$_POST['rcvr_company'][$j],"rcvr_email"=>$_POST['rcvr_email'][$j],"rcvr_mno"=>$_POST['rcvr_mno'][$j],"rcvr_address"=>addslashes($_POST['rcvr_address'][$j]),"rcvr_address1"=>addslashes($_POST['rcvr_address1'][$j]),"rcvr_pincode"=>$_POST['rcvr_pincode'][$j],"rcvr_country"=>$_POST['rcvr_country'][$j],"rcvr_state"=>$_POST['rcvr_state'][$j],"rcvr_city"=>$_POST['rcvr_city'][$j],"rcvr_fax"=>$_POST['rcvr_fax'][$j],"rcvr_vat_no"=>$_POST['rcvr_vat_no'][$j],"rcvr_iqamano"=>$_POST['rcvr_iqamano'][$j]);
                        $insert = insert_query($arr_, "customers_receiver");
                    }
                }
            }
		    $_SESSION['suc']='Customer Detail Updated Successfully...';
	    }
	    else
	    {
		    $_SESSION['unsuc']='Customer Detail Not Updated... Try Again...';
	    }
	    header("location:".$site_url."customer-listing");
	    exit;
    }
    else
    { 
	  $dt=date('Y-m-d H:i:s');
	  
	  $name=$_POST['fname'];
	 // $rcv_name=$_POST['frcvr_name'];
	  
	  /*$arr=array("customer_type"=>$_POST['customer_type'],"name"=>ucfirst($name),"company_name"=>$_POST['company_name'],"phone"=>$_POST['phone'],"website"=>$_POST['website'],"taxtype"=>$_POST['taxtype'],"taxnumber"=>$_POST['taxnumber'],"fax"=>$_POST['fax'],"email"=>$_POST['email'],"mno"=>$_POST['mno'],"address"=>addslashes($_POST['address']),"pincode"=>$_POST['pincode'],"country"=>$_POST['country'],"state"=>$_POST['state'],"city"=>$_POST['city'],"rcvr_name"=>ucfirst($rcv_name),"rcvr_email"=>$_POST['rcvr_email'],"rcvr_mno"=>$_POST['rcvr_mno'],"rcvr_address"=>addslashes($_POST['rcvr_address']),"rcvr_address1"=>addslashes($_POST['rcvr_address1']),"rcvr_pincode"=>$_POST['rcvr_pincode'],"rcvr_country"=>$_POST['rcvr_country'],"rcvr_state"=>$_POST['rcvr_state'],"rcvr_city"=>$_POST['rcvr_city'],"rcvr_fax"=>$_POST['rcvr_fax'],"rcvr_landmark"=>$_POST['rcvr_landmark'],"customerid"=>$_POST['customerid'],"rcvr_vat_no"=>$_POST['rcvr_vat_no'],"rcvr_iqamano"=>$_POST['rcvr_iqamano']);  */ 
	 $taxnumber='';
	 $taxtype='';
	 if($_POST['customer_type']==2)
	 {
	  	$taxtype='Non-Vat';
	  	$taxnumber='';
	 }
	 else
	 {
		
		if($_POST['taxtype']=='Non-Vat'){
	  		$taxtype='Non-Vat';
			$taxnumber='';
		}
	  	else if($_POST['taxtype']=='Vat')
		{
			$taxtype='Vat';
			$taxnumber=$_POST['taxnumber'];
		}
	 }
	  $arr=array("customer_type"=>$_POST['customer_type'],"name"=>ucfirst($name),"company_name"=>$_POST['company_name'],"phone"=>$_POST['phone'],"website"=>$_POST['website'],"taxtype"=>$taxtype,"taxnumber"=>$taxnumber,"fax"=>$_POST['fax'],"email"=>$_POST['email'],"mno"=>$_POST['mno'],"address"=>addslashes($_POST['address']),"pincode"=>$_POST['pincode'],"country"=>$_POST['country'],"state"=>$_POST['state'],"city"=>$_POST['city'],"customerid"=>$_POST['customerid']);  
	  $insert = insert_query($arr, "customers");
	  
	  $last_id=$dlink->insert_id;
	  if($insert)
	  {
		  $tota_row=$_POST['total_rows'];
		  for($i=0;$i<$tota_row;$i++)
		  {
				if($_POST['trremove'][$i] == 1)
				{
					$rcv_name="";
					$rcv_name=$_POST['frcvr_name'][$i];
					$arr_=array("cid"=>$last_id,"rcvr_name"=>ucfirst($rcv_name),"rcvr_company"=>$_POST['rcvr_company'][$i],"rcvr_email"=>$_POST['rcvr_email'][$i],"rcvr_mno"=>$_POST['rcvr_mno'][$i],"rcvr_address"=>addslashes($_POST['rcvr_address'][$i]),"rcvr_address1"=>addslashes($_POST['rcvr_address1'][$i]),"rcvr_pincode"=>$_POST['rcvr_pincode'][$i],"rcvr_country"=>$_POST['rcvr_country'][$i],"rcvr_state"=>$_POST['rcvr_state'][$i],"rcvr_city"=>$_POST['rcvr_city'][$i],"rcvr_fax"=>$_POST['rcvr_fax'][$i],"rcvr_vat_no"=>$_POST['rcvr_vat_no'][$i],"rcvr_iqamano"=>$_POST['rcvr_iqamano'][$i]);
					$insert = insert_query($arr_, "customers_receiver");
				}
		  }
		  $_SESSION['suc']='Customer Detail Added Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Customer Detail Not Added... Try Again...';
	  }
	  header("location:".$site_url."customer-listing");
	  exit;
  }
}
?>