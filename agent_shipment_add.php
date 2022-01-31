<?php include("header.php"); 
require('pdf/fpdf.php');
if(@$_REQUEST['id']!='')
{
	
	$userdetail=fetch_query("*", "agent", array("id="=>$_SESSION['ntexpress_retroagent'])); 
	$deptid=$userdetail['deptid'];
	
	
	$id = $_REQUEST['id'];
	$rows = fetch_query("*","shipment",array("id="=>$id));
	$invoice_number = $rows['invoice_number'];
	$source_country = $rows['source_country'];
	$source_state =$userdetail['state'];
	//$source_address = $rows['source_address'];
	$source_city = $userdetail['city'];
	$destination_country = $rows['destination_country'];
	$destination_state = $rows['destination_state'];
	$destination_city = $rows['destination_city'];
	//$destination_address = $rows['destination_address'];
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
	
	$sender_deptid=$deptid; 
	$sender_agentid=$userdetail['id']; 
	
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
	$consignment_no=$rows['consignment_no'];
	
	
}
else   
{
	$rows = fetch_query("*","shipment","","order by id desc limit 1");
	$invoice_number=sprintf("%04d", $rows['id']+1);
	$invoice_number='';
	$userdetail=fetch_query("*", "agent", array("id="=>$_SESSION['ntexpress_retroagent'])); 
	$deptid=$userdetail['deptid'];
	
	$tax_percentage = '';
	$total_amount = '';
	$payment_type = '';
	$source_city = $userdetail['city'];
	$destination_country = '';
	$destination_state = '';
	$destination_city = '';
	$source_state = $userdetail['state'];
	$source_country = $userdetail['country'];
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
	$sender_deptid=$deptid;
	$sender_agentid=$userdetail['id'];
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
	$consignment_no=date('ymdH').rand(10,99);
}

?>
<style>

#country-list {
    float: left;
	list-style: none;
	margin-top: 0px;
	padding: 0;
	width: 93%;
	position: absolute;
	border-radius: 20px;
	cursor: pointer;
}
.form-group li {
    line-height: 1.45;
}
#country-list li {
    padding: 10px;
    background: #f0f0f0;
    border-bottom: #bbb9b9 1px solid;
}
#country-list {
    list-style: none;
	z-index:99;
}
</style>
<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

        <h1> Shipment <?php echo $pagetitle; ?> <?php 
		$rows = $dlink->query("select id from shipment order by id desc limit 1");
		$vrows= $rows->fetch_array();
		//$invoice_number=sprintf("%04d", $vrows['id']+1);
		
		?> </h1>

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
                            <div class="col-lg-9 col-md-9 col-sm-9 col-12"> </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-12" style="float:right">
                                <!--create barcode-->
								Barcode: 
								<?php 
                                if(@$_GET['id']=='')
                                {
                                require "barcode/vendor/autoload.php";
                                $Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
                                $barcode = $Bar->getBarcode('NTE'.date('YmdHis').rand(10,99), $Bar::TYPE_CODE_128);
                                ?> 
                                <div id="qrbox" class="testimg" style="font-size:0;position:relative;width:150px;height:30px;">
                                    <?php echo $barcode ?>
                                </div>
                                <h2 class="toCanvas" id="toCanvas" style="display:none"> <a href="javascript:void(0);" class="btn btn-danger"> To Canvas </a></h2>
                                <h2 class="toPic" style="display:none"><a href="javascript:void(0);" class="btn btn-danger"> To Image </a></h2>
                                <h5><button style="display:none" id="save" class="btn btn-danger">Save And Download</button></h5>
                                
                                <div id="img" style="display:none;"> 
                                    <img src="" id="newimg" class="top" /> 
                                </div><?php
                                }
								else
								{
									?>
									<div> 
                                    	<img src="<?php echo $site_url?>_private_content_shipment_barcode/<?php echo $barcode_image?>" class="top" /> 
                                	</div>
									<?php
								}
								?>
                                <!--end for create barcode-->
                                </div>
                             </div>
                            <div class="row">

                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Date<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="text" name="invoice_date" id="invoice_date" class="form-control" value="<?php echo date('d-m-Y') ?>" readonly="readonly">
                                        </div>

                                    </div>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Invoice Number<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="text" name="invoice_number" id="invoice_number" class="form-control" value="<?php echo $invoice_number; ?>">
                                        </div>

                                    </div>

                                </div>
                                  
                                 <?php /*?><div class="col-lg-3 col-md-3 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Shipment Number<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="text" name="shipment_no" id="shipment_no" class="form-control" value="<?php echo $shipment_no; ?>">
                                        </div>

                                    </div>

                                </div><?php */?>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">

                                    <div class="form-group">

                                        <h5>Consignment Number<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="text" name="consignment_no" id="consignment_no" class="form-control" value="<?php echo $consignment_no; ?>">
                                        </div>

                                    </div>

                                </div>
                                 
                              </div>
                              <div class="row"> 
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
    
                                        <div class="form-group">
    
                                            <h2>Shipper Details</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
    
                                        <div class="form-group">
    
                                            <h2>Receiver Details</h2>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row"> 
                                     <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <h5>Deptartment<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select disabled="disabled" name="sender_deptid" id="sender_deptid" class="form-control" onchange="display_agent(this.value,'sender_agentid')">
                                                    <option value="">Select Department</option>
                                                        <?php
                                                        $dept=mysqli_query($dlink,"SELECT * FROM department WHERE 1");
                                                        while($dp=mysqli_fetch_assoc($dept))
                                                        {
                                                        ?>
                                                        <option <?php if($dp['id']==$sender_deptid){ ?> selected <?php } ?> value="<?php echo $dp['id']; ?>"><?php echo $dp['title']; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                         <div class="form-group">
        									<h5>Representative <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            	<select disabled="disabled" name="sender_agentid" id="sender_agentid" class="form-control" onchange="display_salary(this.value)">
                                                	<option value="">Select Representative</option>
                                                    <?php
                                                    $agent=mysqli_query($dlink,"SELECT * FROM agent WHERE 1 and deptid='".$sender_deptid."'");
                                                        while($dp=mysqli_fetch_assoc($agent))
                                                        {
                                                        ?>
                                                        <option <?php if($dp['id']==$sender_agentid){ ?> selected <?php } ?> value="<?php echo $dp['id']; ?>"><?php echo $dp['name']; ?></option>
                                                        <?php } ?>
                                                </select>
                                          	</div>
        								 </div>
                                     </div>
                                     <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <h5>Deptartment<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="desti_deptid" id="desti_deptid" class="form-control" onchange="display_agent(this.value,'desti_agentid')">
                                                    <option value="">Select Department</option>
                                                        <?php
                                                        $dept=mysqli_query($dlink,"SELECT * FROM department WHERE 1");
                                                        while($dp=mysqli_fetch_assoc($dept))
                                                        {
                                                        ?>
                                                        <option <?php if($dp['id']==$desti_deptid){ ?> selected <?php } ?> value="<?php echo $dp['id']; ?>"><?php echo $dp['title']; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                     	</div>
                                     </div>
                                     <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group"> 
        									<h5>Representative <?php //echo $sender_agentid?><span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                   <select name="desti_agentid" id="desti_agentid" class="form-control" onchange="display_salary(this.value)">
                                                        <option value="">Select Representative</option>
                                                        <?php
                                                        $agent=mysqli_query($dlink,"SELECT * FROM agent WHERE 1 and deptid='".$sender_deptid."'");
                                                        while($dp=mysqli_fetch_assoc($agent))
                                                        {
                                                        ?>
                                                        <option <?php if($dp['id']==$desti_agentid){ ?> selected <?php } ?> value="<?php echo $dp['id']; ?>"><?php echo $dp['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
        								</div>
                                     </div>
                                </div>
                                <div class="row">
                                	<div class="col-lg-2 col-md-2 col-sm-6 col-12" style="display:none">
										<div class="form-group">
											<h5>Country<span class="text-danger">*</span></h5>
	                                        <div class="controls">
                                            <select disabled="disabled" name="source_country" id="source_country" class="form-control" onchange="get_state(this.value,'source_state')">
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
                                	<div class="col-lg-3 col-md-3 col-sm-6 col-12">
										<div class="form-group">
											<h5>Province<span class="text-danger">*</span></h5>
	                                        <div class="controls">
                                                <select disabled="disabled" name="source_state" id="source_state" class="form-control" onchange="get_city(this.value,'source_city')">
                                                    <option value="">Select Province</option>
                                                    <?php
													$agent=mysqli_fetch_array(mysqli_query($dlink,"SELECT * FROM agent WHERE 1 and id='".$sender_agentid."'"));
                                                    $selsta=mysqli_query($dlink,"SELECT * FROM location where  location_type='1' and parent_id='184' and is_visible='0' and location_id='".$agent['state']."' order by name");
                                                    while($s=mysqli_fetch_array($selsta)) {
                                                    ?>
                                                    <option <?php if ($s['location_id'] == $source_state) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option>
                                                   <?php
                                                    }
                                                    ?>
                                                </select>
                                        	</div>
										</div>
	                                </div>
                                	<div class="col-lg-3 col-md-3 col-sm-6 col-12">
										<div class="form-group">
	                                        <h5>City<span class="text-danger">*</span></h5>
	                                        <div class="controls"> 
                                            <select disabled="disabled" name="source_city" id="source_city" class="form-control">
                                                <option value="">Select City</option>
                                                <?php
												$selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$source_state."' and is_visible='0' order by name");
												while($s1=mysqli_fetch_array($selcit)) {
												?>
												<option <?php if ($s1['location_id'] == $source_city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
												<?php
												}
												?>
                                            </select>
                                        	</div>
										</div>
									</div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-12" style="display:none">
										<div class="form-group">
 	                                        <h5>Country<span class="text-danger">*</span></h5>
											<div class="controls">
                                                <select name="destination_country" id="destination_country" class="form-control" onchange="get_state(this.value,'destination_state')">
                                                    <option value="">Select Country</option>
                                                    <?php $destination_country='184';
                                                    $selcon=mysqli_query($dlink,"SELECT * FROM location where location_id='184' and location_type='0' and parent_id='0' and is_visible='0' order by name");
                                                    while ($bcon=mysqli_fetch_array($selcon)) {
                                                    ?>
                                                    <option <?php if ($bcon['location_id'] == $destination_country) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                        	</div>
										</div>
									</div>
                                	<div class="col-lg-3 col-md-3 col-sm-6 col-12">
										<div class="form-group">
	                                        <h5>Province<span class="text-danger">*</span></h5>
	                                        <div class="controls">
    	                                        <select name="destination_state" id="destination_state" class="form-control" onchange="get_city(this.value,'destination_city')">
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
										</div>
									</div>
                                	<div class="col-lg-3 col-md-3 col-sm-6 col-12">
										<div class="form-group">
											<h5>City<span class="text-danger">*</span></h5>
											<div class="controls">
                                                <select name="destination_city" id="destination_city" class="form-control">
                                                    <option value="">Select City</option>
                                                    <?php
                                                    $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$destination_state."' and is_visible='0' order by name");
                                                    while($s1=mysqli_fetch_array($selcit)) {
                                                    ?>
                                                    <option <?php if ($s1['location_id'] == $destination_city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                            	</select>
                                        	</div>
										</div>
									</div>
                                </div>
                                <div class="row"> 
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
    									<div class="form-group">
      										<h5>Sender Name<span class="text-danger">*</span></h5>
    										<div class="controls">
                                                <input type="text" name="sender_name" id="sender_name" class="form-control" value="<?php echo $sender_name; ?>" autocomplete="off">
                                                <div id="suggesstion-box-sender"></div>
                                            </div>
    									</div>
    								</div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
    									<div class="form-group">
      										<h5>Sender Mobile<span class="text-danger">*</span></h5>
    										<div class="controls">
                                                <input type="text" name="sender_mobile" id="sender_mobile" class="form-control" value="<?php echo $sender_mobile; ?>" onkeypress="return isNumberKey(event);">
                                            </div>
    									</div>
    								</div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
    									<div class="form-group">
      										<h5>Receiver Name<span class="text-danger">*</span></h5>
    										<div class="controls">
                                                <input type="text" name="desti_name" id="desti_name" class="form-control" value="<?php echo $desti_name; ?>" autocomplete="off">
                                                <div id="suggesstion-box"></div>
                                            </div>
    									</div>
    								</div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
    									<div class="form-group">
      										<h5>Receiver Mobile<span class="text-danger">*</span></h5>
    										<div class="controls">
                                                <input type="text" name="desti_mobile" id="desti_mobile" class="form-control" value="<?php echo $desti_mobile; ?>" onkeypress="return isNumberKey(event);">
                                            </div>
    									</div>
    								</div>
                                </div>
                                <div class="row">
                                	<div class="col-lg-3 col-md-3 col-sm-6 col-12">
    									<div class="form-group">
      										<h5>Sender Email<span class="text-danger">*</span></h5>
    										<div class="controls">
                                                <input type="email" name="sender_email" id="sender_email" class="form-control" value="<?php echo $sender_email; ?>">
                                            </div>
    									</div>
    								</div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
    									<div class="form-group">
      										<h5>Sender Address<span class="text-danger">*</span></h5>
											<div class="controls"> 
                                            	<textarea name="source_address" id="source_address" class="form-control" style="height: 35px;"><?php echo $source_address ?></textarea>
                                        	</div>
    									</div>
    								</div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
    									<div class="form-group">
      										<h5>Receiver Email<span class="text-danger">*</span></h5>
    										<div class="controls">
                                                <input type="email" name="desti_email" id="desti_email" class="form-control" value="<?php echo $desti_email; ?>">
                                            </div>
    									</div>
    								</div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
    									<div class="form-group">
      										<h5>Receiver Address<span class="text-danger">*</span></h5>
											<div class="controls"> 
                                            	<textarea name="destination_address" id="destination_address" style="height: 35px;" class="form-control"><?php echo $destination_address ?></textarea>
                                       	 	</div>
    									</div>
    								</div>
                                </div>
                                
                               
                                
                             <div class="row">
                             	<div class="col-lg-6 col-md-6 col-sm-6 col-12">

                                    <div class="form-group">

                                        <h2>Package Details</h2>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="row">

                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">

                                    <div class="form-group">
  
                                        <h5>Number of Package<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="text" name="no_of_package" id="no_of_package" class="form-control" value="<?php echo $no_of_package; ?>">
                                        </div>

                                    </div>

                                </div>

                                 <div class="col-lg-4 col-md-4 col-sm-6 col-12">

                                    <div class="form-group">

                                        <h5>Amount<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="text" name="amount" id="amount" value="<?php echo $amount; ?>" class="form-control" onkeypress="return isNumberKey(event);">
                                        </div>

                                    </div>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">

                                    <div class="form-group">

                                        <h5>Tax<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <select name="tax_percentage" id="tax_percentage" class="form-control" onchange="calculate_total_amount(this.value)">
                                                <option value="">Select Tax Percentage</option>
                                                <?php
												$tax=mysqli_query($dlink,"SELECT * FROM tax_percentage where 1 order by id desc");
												while($tx=mysqli_fetch_array($tax)) {
												?>
												<option <?php if ($tx['percentage'] == $tax_percentage) {?> selected="selected" <?php }?> value="<?php echo $tx['percentage']; ?>" ><?php echo $tx['percentage']; ?>%</option>
												<?php
												}
												?>
                                            </select>
                                        </div>

                                    </div>
                                 </div>
                                 
                             </div>
							<div class="row">
                            
                            	<div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                 <div class="form-group">

                                        <h5>Total Amount<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                            <input type="text" name="total_amount" id="total_amount" value="<?php echo $total_amount; ?>" class="form-control" readonly="readonly">
                                        </div>

                                    </div>
                                 </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                 <div class="form-group">

                                        <h5>Cash<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                           <input type="text" name="total_case" id="total_case" value="<?php echo $total_cash; ?>" class="form-control" onkeyup="calculate_FC()">
                                        </div>

                                    </div>
                                 </div>
                                 <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                 <div class="form-group">

                                        <h5>FC<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                           <input type="text" name="total_fc" id="total_fc" value="<?php echo $total_fc; ?>" class="form-control" value="0">
                                        </div>

                                    </div>
                                 </div>
                            
                            </div> 
                            <div class="row">
                            	<div class="col-lg-2 col-md-3 col-sm-3 col-12">
                                 <div class="form-group">

                                        <h5>Product</h5>

                                        <div class="controls"> 
                                         <select name="type_of_product" id="type_of_product" class="form-control">
                                            	<option value="">-- Select One --</option>
                                            	<option <?php if ('Document' == $type_of_product) {?> selected="selected" <?php }?> value="Document">Document</option>
                                              <option <?php if ('Electronics' == $type_of_product) {?> selected="selected" <?php }?>  value="Electronics">Electronics</option>
                                              <option <?php if ('Fabrics' == $type_of_product) {?> selected="selected" <?php }?> value="Fabrics">Fabrics</option>
                                              <option <?php if ('Construction Material' == $type_of_product) {?> selected="selected" <?php }?> value="Construction Material">Construction Material</option>
                                              <option <?php if ('Hazardous' == $type_of_product) {?> selected="selected" <?php }?> value="Hazardous">Hazardous</option>
                                              <option <?php if ('Hazardous and perishable' == $type_of_product) {?> selected="selected" <?php }?> value="Hazardous and perishable">Hazardous and perishable</option>
                                              <option <?php if ('Non Hazardous' == $type_of_product) {?> selected="selected" <?php }?> value="Non Hazardous">Non Hazardous</option>
                                              <option <?php if ('Non Perishable' == $type_of_product) {?> selected="selected" <?php }?> value="Non Perishable">Non Perishable</option>
                                              <option <?php if ('Other' == $type_of_product) {?> selected="selected" <?php }?> value="Other">Other</option>
                            			</select>
                                        </div>

                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-3 col-sm-3 col-12">
                                 <div class="form-group">

                                        <h5>Mode</h5>

                                        <div class="controls"> 
                                           
                                           <select name="mode" id="mode" class="form-control">
                                                <option value="">Type of Mode</option>
                                                <option <?php if ('Air' == $mode) {?> selected="selected" <?php }?> value="Air" >Air</option>
                                                <option <?php if ('Sea' == $mode) {?> selected="selected" <?php }?> value="Sea" >Sea</option>
                                                <option <?php if ('Land' == $mode) {?> selected="selected" <?php }?> value="Land" >Land</option>
												
                                            </select>
                                        </div>

                                    </div>
                                 </div>  
                                 <div class="col-lg-2 col-md-3 col-sm-6 col-12">
                                 <div class="form-group">

                                        <h5>Pickup Date<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                           <input type="date" name="pickup_date" id="pickup_date" value="<?php echo $pickup_date; ?>" class="form-control" >
											 
                                        </div>

                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-3 col-sm-6 col-12">
                                 <div class="form-group">

                                        <h5>Pickup Time<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                           <!--<input type="time" name="pickup_time" id="pickup_time" value="<?php echo $pickup_time; ?>" class="form-control" >-->
                                            <?php
                                            $pickup=explode(":",date('h:i a',strtotime($pickup_time)));
                                            ?>
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
                                        </div>

                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-3 col-sm-6 col-12">
                                 <div class="form-group">

                                        <h5>Expected Delivery Date<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                           <input type="date" name="delivery_date" id="delivery_date" value="<?php echo $delivery_date; ?>" class="form-control" >
                                        </div>

                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-3 col-sm-6 col-12">
                                 <div class="form-group">

                                        <h5>Expected Delivery Time<span class="text-danger">*</span></h5>

                                        <div class="controls">
                                           <!--<input type="time" name="delivery_time" id="delivery_time" value="<?php echo $delivery_time; ?>" class="form-control" >-->
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
                                 </div> 
                                 
                            	<div class="col-lg-10 col-md-10 col-sm-10 col-12">
                                 <div class="form-group">

                                        <h5>Comment</h5>

                                        <div class="controls">
                                           <input type="text" name="comment" id="comment" value="<?php echo $comment; ?>" class="form-control">
                                        </div>

                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-2 col-sm-2 col-12">
                                 <div class="form-group">

                                        <h5>Status</h5>

                                        <div class="controls"> 
                                           
                                           <select name="status" id="status" class="form-control">
                                                <option <?php if ('1' == $status) {?> selected="selected" <?php }?> value="1" >Pending</option>
                                                <option <?php if ('2' == $status) {?> selected="selected" <?php }?> value="2" >In Process</option>
                                                <option <?php if ('3' == $status) {?> selected="selected" <?php }?> value="3" >Delivered</option>
                                                <option <?php if ('4' == $status) {?> selected="selected" <?php }?> value="4" >Reject</option>
											</select>
                                        </div>

                                    </div>
                                 </div>  
                            
                            </div>
                           <div class="text-xs-right bt-1 pt-10">
                               	<input type="hidden" name="barcode_image" id="barcode_image" value="<?php echo $barcode_image?>" />
                                <button type="submit" class="btn btn-danger" id="submit" name="submit" value="submit">Submit</button>
                                
                            </div>

                        </form>
                        
	
                    </div>

                </div>

            </div>

        </div>

    </section>

</div> 

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo $site_url;?>js/html2canvas.min.js"></script>
<script type="text/javascript" src="<?php echo $site_url;?>js/canvas2image.js"></script>
<?php include("footer.php"); ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#sender_name").keyup(function(){
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
	
	
	$("#desti_name").keyup(function(){
		$.ajax({
		type: "POST",
		url: "<?php echo $site_url; ?>admin_ajax.php",
		data:'keyword='+$(this).val(),
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
function selectSender(val,cid) {
	$("#sender_name").val(val);
	$("#suggesstion-box-sender").hide();
	$.ajax({
		type: "POST",
		url: "<?php echo $site_url; ?>admin_ajax.php",
		data:'action=get_customer_other_info&cid='+cid,
		beforeSend: function(){
			$("#sender_name").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			var abc=data.split("~~");
			$("#sender_email").val(abc[0]);
			$("#source_address").val(abc[2]);
			$("#sender_mobile").val(abc[1]);
			
			$("#source_country").val(abc[3]);
			$("#source_state").val(abc[4]);
			$("#source_city").val(abc[5]);
			
			$("#desti_name").val(abc[6]);
			$("#desti_email").val(abc[7]);
			$("#destination_address").val(abc[9]);
			$("#desti_mobile").val(abc[8]);
			
			$("#destination_state").val(abc[11]);
			$("#destination_country").val(abc[10]);
			$("#destination_city").val(abc[12]);
			
		}
		});
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
	$("#submit").click(function()
	{ 
		if($("#invoice_number").val()=="")
		{
			$("#invoice_number").attr("placeholder", "Please Enter Invoice Number.");
			$("#invoice_number").addClass("error_textbox");
			$("#invoice_number").focus();
			return false;
		}
		/*if($("#shipment_no").val()=="")
		{
			$("#shipment_no").attr("placeholder", "Please Enter Shipment Number.");
			$("#shipment_no").addClass("error_textbox");
			$("#shipment_no").focus();
			return false;
		}*/
		
		if($("#sender_deptid").val()=="")
		{
			$("#sender_deptid").attr("placeholder", "Please Select Sender Department.");
			$("#sender_deptid").addClass("error_textbox");
			$("#sender_deptid").focus();
			return false;
		}
		if($("#sender_agentid").val()=="")
		{
			$("#sender_agentid").attr("placeholder", "Please Select Sender Representative.");
			$("#sender_agentid").addClass("error_textbox");
			$("#sender_agentid").focus();
			return false;
		}   
		if($("#desti_deptid").val()=="")
		{
			$("#desti_deptid").attr("placeholder", "Please Select Destination Deptarment.");
			$("#desti_deptid").addClass("error_textbox");
			$("#desti_deptid").focus();
			return false;
		}
		if($("#desti_agentid").val()=="")
		{
			$("#desti_agentid").attr("placeholder", "Please Select Destination Representative.");
			$("#desti_agentid").addClass("error_textbox");
			$("#desti_agentid").focus();
			return false;
		}
		if($("#source_state").val()=="")
		{
			$("#source_state").attr("placeholder", "Please Select Source Province.");
			$("#source_state").addClass("error_textbox");
			$("#source_state").focus();
			return false;
		}
		
		if($("#source_city").val()=="")
		{
			$("#source_city").attr("placeholder", "Please Select Source City");
			$("#source_city").addClass("error_textbox");
			$("#source_city").focus();
			return false;
		} 
		if($("#destination_state").val()=="")
		{
			$("#destination_state").attr("placeholder", "Please Select Destination Province.");
			$("#destination_state").addClass("error_textbox");
			$("#destination_state").focus();
			return false;
		}
		if($("#destination_city").val()=="")
		{
			$("#destination_city").attr("placeholder", "Please Select Destination City");
			$("#destination_city").addClass("error_textbox");
			$("#destination_city").focus();
			return false;
		}        
		if($("#sender_name").val()=="")
		{
			$("#sender_name").attr("placeholder", "Please Enter Sender Name.");
			$("#sender_name").addClass("error_textbox");
			$("#sender_name").focus();
			return false;
		}
		if($("#sender_mobile").val()=="")
		{
			$("#sender_mobile").attr("placeholder", "Please Enter Sender Mobile.");
			$("#sender_mobile").addClass("error_textbox");
			$("#sender_mobile").focus();
			return false;
		}
		if($("#desti_name").val()=="")
		{
			$("#desti_name").attr("placeholder", "Please Enter Receiver Name.");
			$("#desti_name").addClass("error_textbox");
			$("#desti_name").focus();
			return false;
		}
		if($("#desti_mobile").val()=="")
		{
			$("#desti_mobile").attr("placeholder", "Please Enter Receiver Mobile.");
			$("#desti_mobile").addClass("error_textbox");
			$("#desti_mobile").focus();
			return false;
		}
		if($("#sender_email").val()=="")
		{
			$("#sender_email").attr("placeholder", "Please Enter Sender Email.");
			$("#sender_email").addClass("error_textbox");
			$("#sender_email").focus();
			return false;
		}
		if($("#source_address").val()=="")
		{
			$("#source_address").attr("placeholder", "Please Enter Sender Address.");
			$("#source_address").addClass("error_textbox");
			$("#source_address").focus();
			return false;
		}
		
		if($("#destination_address").val()=="")
		{
			$("#destination_address").attr("placeholder", "Please Enter Receiver Address.");
			$("#destination_address").addClass("error_textbox");
			$("#destination_address").focus();
			return false;
		}
		if($("#desti_email").val()=="")
		{
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
		}   
		if($("#delivery_date").val()=="")
		{
			$("#delivery_date").attr("placeholder", "Please Select Expected Delivery Date.");
			$("#delivery_date").addClass("error_textbox");
			$("#delivery_date").focus();
			return false;
		}  
		if($("#delivery_time").val()=="")
		{
			$("#delivery_time").attr("placeholder", "Please Enter Expected Delivery Time.");
			$("#delivery_time").addClass("error_textbox");
			$("#delivery_time").focus();
			return false;
		}
		if($("#pickup_date").val()=="")
		{
			$("#pickup_date").attr("placeholder", "Please Select Pickup Date.");
			$("#pickup_date").addClass("error_textbox");
			$("#pickup_date").focus();
			return false;
		}
		if($("#pickup_time").val()=="")
		{
			$("#pickup_time").attr("placeholder", "Please Enter Pickup Time.");
			$("#pickup_time").addClass("error_textbox");
			$("#pickup_time").focus();
			return false;
		}
	});
});
function calculate_FC()
{ 
	var total_amt=$('#total_amount').val();
	var total_case=$('#total_case').val();  
	var total_fc=$('#total_fc').val();
	
	total_fc=parseFloat(total_amt)-parseFloat(total_case);
	total_fc=total_fc.toFixed(2);
	$('#total_fc').val(total_fc);
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
  if(@$_GET['id']!='')
  {
	  $userdetail=fetch_query("*", "agent", array("id="=>$_SESSION['ntexpress_retroagent'])); 
	  $deptid=$userdetail['deptid'];
	  
	  
	  $delivery_date=date('Y-m-d',strtotime($_POST['delivery_date'])); 
	  //$delivery_time=date('H:i:s',strtotime($_POST['delivery_time']));
	   $delivery_time=date('H:i:s',strtotime($_POST['phour'].":".$_POST['pminute']." ".$_POST['ptime']));
	  $pickup_date=date('Y-m-d',strtotime($_POST['pickup_date']));
	  //$pickup_time=date('H:i:s',strtotime($_POST['pickup_time'])); 
	   $pickup_time=date('H:i:s',strtotime($_POST['ehour'].":".$_POST['eminute']." ".$_POST['etime']));
	   
	  $delivery_date=$delivery_date." ".$delivery_time;
	  $pickup_date=$pickup_date." ".$pickup_time;
	  
	  $arr=array("aid"=>$userdetail['id'],"consignment_no"=>$_POST['consignment_no'],"invoice_number"=>$_POST['invoice_number'],"invoice_date"=>date('Y-m-d',strtotime($_POST['invoice_date'])),"source_country"=>$userdetail['country'],"source_state"=>$userdetail['state'],"source_city"=>$userdetail['city'],"destination_country"=>$_POST['destination_country'],"destination_state"=>$_POST['destination_state'],"destination_city"=>$_POST['destination_city'],"no_of_package"=>$_POST['no_of_package'],"amount"=>$_POST['amount'],"tax_percentage"=>$_POST['tax_percentage'],"total_amount"=>$_POST['total_amount'],"payment_cash"=>$_POST['total_case'],"payment_fc"=>$_POST['total_fc'],"destination_address"=>$_POST['destination_address'],"source_address"=>$_POST['source_address'],"comment"=>$_POST['comment'],"sender_deptid"=>$deptid,"sender_agentid"=>$userdetail['id'],"desti_deptid"=>$_POST['desti_deptid'],"desti_agentid"=>$_POST['desti_agentid'],"sender_name"=>$_POST['sender_name'],"sender_mobile"=>$_POST['sender_mobile'],"desti_name"=>$_POST['desti_name'],"desti_mobile"=>$_POST['desti_mobile'],"sender_email"=>$_POST['sender_email'],"desti_email"=>$_POST['desti_email'],"type_of_product"=>$_POST['type_of_product'],"mode"=>$_POST['mode'],"delivery_date"=>$delivery_date,"pickup_date"=>$pickup_date,"status"=>$_POST['status']);   
	  
	  //pdf coding for invoice//
	  
	  	class PDF extends FPDF
	  	{
			function WordWrap(&$text, $maxwidth)
			{
				
				$text = trim($text);
				if ($text==='')
					return 0;
				$space = $this->GetStringWidth(' ');
				$lines = explode("\n", $text);
				$text = '';
				$count = 0;
			
				foreach ($lines as $line)
				{
					$words = preg_split('/ +/', $line);
					$width = 0;
			
					foreach ($words as $word)
					{
						$wordwidth = $this->GetStringWidth($word);
						if ($wordwidth > $maxwidth)
						{
							// Word is too long, we cut it
							for($i=0; $i<strlen($word); $i++)
							{
								$wordwidth = $this->GetStringWidth(substr($word, $i, 1));
								if($width + $wordwidth <= $maxwidth)
								{
									$width += $wordwidth;
									$text .= substr($word, $i, 1);
								}
								else
								{
									$width = $wordwidth;
									$text = rtrim($text)."\n".substr($word, $i, 1);
									$count++;
								}
							}
						}
						elseif($width + $wordwidth <= $maxwidth)
						{
							$width += $wordwidth + $space;
							$text .= $word.' ';
						}
						else
						{
							$width = $wordwidth + $space;
							$text = rtrim($text)."\n".$word.' ';
							$count++;
						}
					}
					$text = rtrim($text)."\n";
					$count++;
				}
				$text = rtrim($text);
				return $count;
			}
			function Bill_text($bid)
			{ 
				$adm=fetch_query("*", "`myadmin`", array("id="=>1));
				
				$mobile=$adm['mobile_1'];
				$address=$adm['address'];
				$logo=$adm['logo'];
				$fill=false;
				$this->Rect(5,5,200,287);
				$this->Image('upimages/'.$logo,10,9,50,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetTextColor(0,0,0); 
				$this->SetFont('Arial','',8);
				$this->Ln();
				$this->SetFont('Arial','B',17);
				$this->SetXY($x+30,$y+2);
				global $dlink;
				$adm=fetch_query("*", "`myadmin`", array("id="=>1));
				$shipment=fetch_query("*", "`shipment`", array("id="=>$bid));
				
				
				$this->SetXY($x+133,9);
				$this->SetFont('Arial','',10);
				$this->MultiCell(35,5,'Consignment No.: ',0,'L');
				$this->SetXY($x+162,9);
				$this->SetFont('Arial','',10);
				$this->MultiCell(40,5,$shipment['consignment_no'],0,'L');
				
				$this->SetXY($x+133,$y+5);
				$this->SetFont('Arial','',10);
				$this->MultiCell(35,5,'Invoice No.: ',0,'L');
				$this->SetXY($x+162,$y+5);
				$this->SetFont('Arial','',10);
				$this->MultiCell(40,5,'#'.$shipment['invoice_number'],0,'L');
				
				
				$this->SetXY($x+133,$y+10);
				$this->SetFont('Arial','',10);
				$this->MultiCell(35,5,'Invoice Date: ',0,'L');
				$this->SetXY($x+162,$y+10);
				$this->SetFont('Arial','',10);
				$this->MultiCell(50,5,date('d-m-Y',strtotime($shipment['invoice_date'])),0,'L');
				$this->Image('_private_content_shipment_barcode/'.$shipment['barcode_image'],$x+135,27,55,20);
				
				$this->SetTextColor(0,0,0);
				$this->SetFont('Arial','',7);
				$this->SetXY(10,$y+15);
				$this->MultiCell(100,5,$address,0,'L');
				$this->SetXY(10,$y+25);
				$this->MultiCell(73,5,'Mob. No.:'.$mobile,0,'L');
				
				$this->SetXY($x+30,$y+32);
				
				$this->Ln(10);
				
				$this->Rect(8,50,194,30);
				$this->SetFont('Arial','B',11);
				$this->SetX(10);
				$this->Cell(25,5,'Shipper Address',0,'L');
				$this->Rect(105,50,0,30);
				$this->SetX(108);
				
				$this->Cell(25,5,'Receiver Address',0,'L');
				$y=$this->GetY();
				$this->SetFont('Arial','',11);
				$this->SetXY(10,$y+5);
				$this->Cell(90,5,$shipment['sender_name'],0,'L');
				$this->SetX(108);
				$this->Cell(90,5,$shipment['desti_name'],0,'L');
				$y=$this->GetY();
				$this->SetXY(10,$y+5);
				$this->SetFont('Arial','',11);
				$this->Cell(90,5,$shipment['source_address'],0,'L');
				$this->SetX(108);
				$this->Cell(90,5,$shipment['destination_address'],0,'L');
				$this->SetFont('Arial','',11);
				$y=$this->GetY();
				$this->SetXY(10,$y+5);
				$this->Cell(90,5,$shipment['sender_mobile'],0,'L');
				$this->SetX(108);
				$this->Cell(90,5,$shipment['desti_mobile'],0,'L');
				$this->SetXY(10,$y+5);
				$this->SetFont('Arial','',11);
				
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetFont('Arial','',11);
				$this->SetXY($x,$y);
				
				$this->SetXY(10,$y+5);
				$this->SetFont('Arial','',11);
	
				$this->Cell(90,5,$shipment['sender_email'],0,'L');
				$this->SetX(108);
				$this->Cell(90,5,$shipment['desti_email'],0,'L');
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetFont('Arial','B',11);
				$this->SetXY($x,$y);
				$this->Rect(8,85,194,135);
				
				$ostate=fetch_query("*","location", array("location_id="=>$shipment['source_state']),"");
				$ocity=fetch_query("*","location", array("location_id="=>$shipment['source_city']),"");
				
				$dstate=fetch_query("*","location", array("location_id="=>$shipment['destination_state']),"");
				$dcity=fetch_query("*","location", array("location_id="=>$shipment['destination_city']),"");
				
				if($shipment['status']=='1')
				{
					$status='Pending';
				}
				if($shipment['payment_fc']=='0.00')
				{
					$paymode='Cash';
					$totalfc='0.00';
				}
				else
				{
					$paymode='FC';
					$totalfc=$shipment['payment_fc'];
				}
				
				
				//1
				$this->SetXY(9,87);
				$this->SetFont('Arial','B',11);
				$this->Cell(64,5,'Origin : ',0,'L');
				$this->SetXY(74,87);
				$this->Cell(64,5,'Package : ',0,'L');
				$this->SetXY(139,87);
				$this->Cell(64,5,'Status : ',0,'L');
				
				$this->SetXY(9,92);
				$this->SetFont('Arial','',10);
				$this->Cell(64,5,$ostate['name'].'/'.$ocity['name'],0,'L');
				$this->SetXY(74,92);
				$this->Cell(64,5,$shipment['no_of_package'],0,'L');
				$this->SetXY(139,92);
				$this->Cell(64,5,$status,0,'L');
				
				//2
				$this->SetXY(9,105);
				$this->SetFont('Arial','B',11);
				$this->Cell(64,5,'Destination : ',0,'L');
				$this->SetXY(74,105);
				$this->Cell(64,5,'Carrier : ',0,'L');
				$this->SetXY(139,105);
				$this->Cell(64,5,'Weight : ',0,'L');
				
				$this->SetXY(9,110);
				$this->SetFont('Arial','',10);
				$this->Cell(64,5,$dstate['name'].'/'.$dcity['name'],0,'L');
				$this->SetXY(74,110);
				$this->Cell(64,5,'NTEXPRESS',0,'L');
				$this->SetXY(139,110);
				$this->Cell(64,5,$shipment['weight'],0,'L');
				
				//3
				$this->SetXY(9,123);
				$this->SetFont('Arial','B',11);
				$this->Cell(64,5,'Shipment Mode : ',0,'L');
				$this->SetXY(74,123);
				$this->Cell(64,5,'Product : ',0,'L');
				$this->SetXY(139,123);
				$this->Cell(64,5,'Payment Mode : ',0,'L');
				
				$this->SetXY(9,128);
				$this->SetFont('Arial','',10);
				$this->Cell(64,5,$shipment['mode'],0,'L');
				$this->SetXY(74,128);
				$this->Cell(64,5,$shipment['type_of_product'],0,'L');
				$this->SetXY(139,128);
				$this->Cell(64,5,$paymode,0,'L');
				
				//4
				$this->SetXY(9,141);
				$this->SetFont('Arial','B',11);
				$this->Cell(64,5,'Total Freight : ',0,'L');
				$this->SetXY(74,141);
				$this->Cell(64,5,'Expected Delivery Date : ',0,'L');
				$this->SetXY(139,141);
				$this->Cell(64,5,'Departure Time : ',0,'L');
				
				$this->SetXY(9,146);
				$this->SetFont('Arial','',10);
				$this->Cell(64,5,$totalfc,0,'L');
				$this->SetXY(74,146); 
				$this->Cell(64,5,date('M d, Y',strtotime($shipment['delivery_date'])),0,'L');
				$this->SetXY(139,146);
				$this->Cell(64,5,date('h:i a',strtotime($shipment['delivery_date'])),0,'L');
				
				//5
				$this->SetXY(9,159);
				$this->SetFont('Arial','B',11);
				$this->Cell(64,5,'Pick-up Date : ',0,'L');
				$this->SetXY(74,159);
				$this->Cell(64,5,'Pick-up Time : ',0,'L');
				$this->SetXY(139,159);
				$this->Cell(64,5,'',0,'L');
				
				$this->SetXY(9,164);
				$this->SetFont('Arial','',10);
				$this->Cell(64,5,date('M d, Y',strtotime($shipment['pickup_date'])),0,'L');
				$this->SetXY(74,164);
				$this->Cell(64,5,date('h:i a',strtotime($shipment['pickup_date'])),0,'L');
				$this->SetXY(139,164);
				$this->Cell(64,5,'',0,'L');
				
				//6
				$this->SetXY(9,177);
				$this->SetFont('Arial','B',11);
				$this->Cell(64,5,'Comments : ',0,'L');
				
				
				$this->SetXY(9,182);
				$this->SetFont('Arial','',10);
				$this->MultiCell(192,5,$shipment['comment'],0,'J');
			} 
			function Label_text($bid)
			{
				$adm=fetch_query("*", "`myadmin`", array("id="=>1));
				$shipment=fetch_query("*", "`shipment`", array("id="=>$bid));
				
				$mobile=$adm['mobile_1'];
				$address=$adm['address'];
				$logo=$adm['logo'];
				$fill=false;
				//Accounts  Copy
				$new_y=$this->GetY()+30;
				$this->Rect(5,$new_y,45,45);
				$this->Image('upimages/'.$logo,9,$new_y+13,38,15);
				$x=$this->GetX();
				$y=$this->GetY();
				
				$this->Rect(50,$new_y,50,45);
				
				
				$this->SetXY(52,$new_y+5);
				$this->SetFont('Arial','',8);
				$this->MultiCell(50,5,'Consignment No.:',0,'C');
				$this->SetXY(52,$new_y+8);
				$this->MultiCell(50,5,$shipment['consignment_no'],0,'C');
				
				
				$this->Image('_private_content_shipment_barcode/'.$shipment['barcode_image'],53,$new_y+13,45,15);
				$this->SetXY(70,$new_y+28);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$shipment['invoice_number'],0,'C');
				$this->SetFont('Arial','B',8);
				$this->SetXY(63,$new_y+32);
				$this->Cell(18,7,'Accounts Copy',0,'C');
				
				$this->Rect(100,$new_y,35,15);
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Pickup Date:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y);
				$this->Cell(20,17,date('F d, Y',strtotime($shipment['pickup_date'])),0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Pickup Time:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y);
				$this->Cell(20,17,date('H:i a',strtotime($shipment['pickup_date'])),0,'L');
				
				$this->Rect(170,$new_y,35,15);
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Delivery Date:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y);
				$this->Cell(20,17,date('F d, Y',strtotime($shipment['delivery_date'])),0,'L');
				
				//-----------
				$new_y=$new_y+15;
				$source_city=fetch_query("*", "location", array("location_id="=>$shipment['source_city']));
				$destination_city=fetch_query("*", "location", array("location_id="=>$shipment['destination_city']));
				$this->Rect(100,$new_y,35,15);
				$x=$this->GetX();
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Origin:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y);
				$this->Cell(20,17,$source_city['name'],0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Destination:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y);
				$this->Cell(20,17,$destination_city['name'],0,'L');
				
				
				$this->Rect(170,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Courier:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y);
				$this->Cell(20,17,'',0,'L');
				
				//-----------
				$new_y=$new_y+15;
				$this->Rect(100,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Carrier:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y+4); 
				$this->Cell(20,7,'NTEXPRESS',0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Carrier Ref. No.:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y+4);
				$this->Cell(20,7,'',0,'L');
				
				$this->Rect(170,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Departure Time:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y+4);
				$this->Cell(20,7,'',0,'L');
				
				///---------
				$new_y=$new_y+15;
				$this->Rect(5,$new_y,30,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Shipper',0,'L');
				
				$source_agent=fetch_query("*", "agent", array("id="=>$shipment['sender_agentid']));
				$this->Rect(35,$new_y,40,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(38,$new_y+1);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$source_agent['name'],0,'L');
				
				///---------
				$this->Rect(75,$new_y,25,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Consignee',0,'L');
				
				$desti_agent=fetch_query("*", "agent", array("id="=>$shipment['desti_agentid']));
				$this->Rect(100,$new_y,40,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(101,$new_y+1);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$desti_agent['name'],0,'L');
				
				$this->Rect(140,$new_y,65,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(141,$new_y+1);
				$this->SetFont('Arial','',8);
				$status=$shipment['status'];
				if($status==1)
					$status='Pending';
				else if($status==2)
					$status='In Process';
				else if($status==3)
					$status='Delivered';
				else if($status==4)
					$status='Reject';
				$this->Cell(18,7,"Status: ".$status,0,'L');
				
				
				//-----
				$new_y=$new_y+8;
				$this->Rect(5,$new_y,70,25);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$source_city['name'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,5,$shipment['source_address'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->Cell(18,5,$shipment['sender_mobile'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->Cell(18,5,$shipment['sender_email'],0,'L');
				
				$this->Rect(75,$new_y,65,25);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$destination_city['name'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,5,$shipment['destination_address'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->Cell(18,5,$shipment['desti_mobile'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->Cell(18,5,$shipment['desti_email'],0,'L');
				
				$this->Rect(140,$new_y,65,46);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(141,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Comment:',0,'L');
				$y=$this->GetY();
				$this->SetXY(141,$y+5);
				$this->SetFont('Arial','',8);
				//$this->Cell(18,5,$shipment['comment'],0,'L');
				$this->MultiCell(65,5,$shipment['comment'],0,'L');
				
				///---------
				$new_y=$new_y+25;
				$y=$this->GetY();
				$this->Rect(5,$new_y,40,14);
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Type of Shipment:',0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$shipment['type_of_product'],0,'L');
				
				$y=$this->GetY();
				$this->Rect(45,$new_y,30,14);
				$this->SetXY(46,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Packages:',0,'L');
				$y=$this->GetY();
				$this->SetXY(45,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,'',0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(75,$new_y,35,14);
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Product:',0,'L');
				$y=$this->GetY();
				$this->SetXY(75,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,'',0,'L');
				
				$y=$this->GetY();
				$this->Rect(110,$new_y,30,14);
				$this->SetXY(111,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Weight:',0,'L');
				$y=$this->GetY();
				$this->SetXY(111,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$shipment['weight'],0,'L');
				
				
				///---------
				$new_y=$new_y+14;
				$y=$this->GetY();
				$this->Rect(5,$new_y,40,7);
				$this->SetXY(6,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Total Freight:',0,'L');
				$this->SetXY(25,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['total_amount'],0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(45,$new_y,30,7);
				$this->SetXY(46,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Quantity: ',0,'L');
				$this->SetXY(59,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['no_of_package'],0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(75,$new_y,35,7);
				$this->SetXY(76,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Payment Mode:',0,'L');
				$this->SetXY(97,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,'Cash',0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(110,$new_y,30,7);
				$this->SetXY(111,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Mode:',0,'L');
				$this->SetXY(121,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['mode'],0,'L');
				
				
				//Consignee Copy
				
				$mobile=$adm['mobile_1'];
				$address=$adm['address'];
				$logo=$adm['logo'];
				$fill=false;
				
				$new_y=$this->GetY()+30;
				$this->Rect(5,$new_y,45,45);
				$this->Image('upimages/'.$logo,9,$new_y+13,38,15);
				$x=$this->GetX();
				$y=$this->GetY();
				
				$this->Rect(50,$new_y,50,45);
				$this->SetXY(52,$new_y+5);
				$this->SetFont('Arial','',8);
				$this->MultiCell(50,5,'Consignment No.:',0,'C');
				$this->SetXY(52,$new_y+8);
				$this->MultiCell(50,5,$shipment['consignment_no'],0,'C');
				
				
				$this->Image('_private_content_shipment_barcode/'.$shipment['barcode_image'],53,$new_y+13,45,15);
				$this->SetXY(70,$new_y+28);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$shipment['invoice_number'],0,'C');
				$this->SetFont('Arial','B',8);
				$this->SetXY(63,$new_y+32);
				$this->Cell(18,7,'Accounts Copy',0,'C');
				
				
				
				$this->Rect(100,$new_y,35,15);
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Pickup Date:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y);
				$this->Cell(20,17,date('F d, Y',strtotime($shipment['pickup_date'])),0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Pickup Time:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y);
				$this->Cell(20,17,date('H:i a',strtotime($shipment['pickup_date'])),0,'L');
				
				$this->Rect(170,$new_y,35,15);
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Delivery Date:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y);
				$this->Cell(20,17,date('F d, Y',strtotime($shipment['delivery_date'])),0,'L');
				
				//-----------
				$new_y=$new_y+15;
				$source_city=fetch_query("*", "location", array("location_id="=>$shipment['source_city']));
				$destination_city=fetch_query("*", "location", array("location_id="=>$shipment['destination_city']));
				$this->Rect(100,$new_y,35,15);
				$x=$this->GetX();
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Origin:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y);
				$this->Cell(20,17,$source_city['name'],0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Destination:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y);
				$this->Cell(20,17,$destination_city['name'],0,'L');
				
				
				$this->Rect(170,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Courier:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y);
				$this->Cell(20,17,'',0,'L');
				
				//-----------
				$new_y=$new_y+15;
				$this->Rect(100,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Carrier:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y+4); 
				$this->Cell(20,7,'NTEXPRESS',0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Carrier Ref. No.:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y+4);
				$this->Cell(20,7,'',0,'L');
				
				$this->Rect(170,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Departure Time:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y+4);
				$this->Cell(20,7,'',0,'L');
				
				///---------
				$new_y=$new_y+15;
				$this->Rect(5,$new_y,30,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Shipper',0,'L');
				
				$source_agent=fetch_query("*", "agent", array("id="=>$shipment['sender_agentid']));
				$this->Rect(35,$new_y,40,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(38,$new_y+1);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$source_agent['name'],0,'L');
				
				///---------
				$this->Rect(75,$new_y,25,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Consignee',0,'L');
				
				$desti_agent=fetch_query("*", "agent", array("id="=>$shipment['desti_agentid']));
				$this->Rect(100,$new_y,40,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(101,$new_y+1);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$desti_agent['name'],0,'L');
				
				$this->Rect(140,$new_y,65,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(141,$new_y+1);
				$this->SetFont('Arial','',8);
				$status=$shipment['status'];
				if($status==1)
					$status='Pending';
				else if($status==2)
					$status='In Process';
				else if($status==3)
					$status='Delivered';
				else if($status==4)
					$status='Reject';
				$this->Cell(18,7,"Status: ".$status,0,'L');
				
				
				//-----
				$new_y=$new_y+8;
				$this->Rect(5,$new_y,70,25);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$source_city['name'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,5,$shipment['source_address'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->Cell(18,5,$shipment['sender_mobile'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->Cell(18,5,$shipment['sender_email'],0,'L');
				
				$this->Rect(75,$new_y,65,25);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$destination_city['name'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,5,$shipment['destination_address'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->Cell(18,5,$shipment['desti_mobile'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->Cell(18,5,$shipment['desti_email'],0,'L');
				
				$this->Rect(140,$new_y,65,46);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(141,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Comment:',0,'L');
				$y=$this->GetY();
				$this->SetXY(141,$y+5);
				$this->SetFont('Arial','',8);
				$this->MultiCell(65,5,$shipment['comment'],0,'L');
				
				///---------
				$new_y=$new_y+25;
				$y=$this->GetY();
				$this->Rect(5,$new_y,40,14);
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Type of Shipment:',0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$shipment['type_of_product'],0,'L');
				
				$y=$this->GetY();
				$this->Rect(45,$new_y,30,14);
				$this->SetXY(46,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Packages:',0,'L');
				$y=$this->GetY();
				$this->SetXY(45,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,'',0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(75,$new_y,35,14);
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Product:',0,'L');
				$y=$this->GetY();
				$this->SetXY(75,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,'',0,'L');
				
				$y=$this->GetY();
				$this->Rect(110,$new_y,30,14);
				$this->SetXY(111,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Weight:',0,'L');
				$y=$this->GetY();
				$this->SetXY(111,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$shipment['weight'],0,'L');
				
				
				///---------
				$new_y=$new_y+14;
				$y=$this->GetY();
				$this->Rect(5,$new_y,40,7);
				$this->SetXY(6,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Total Freight:',0,'L');
				$this->SetXY(25,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['total_amount'],0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(45,$new_y,30,7);
				$this->SetXY(46,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Quantity: ',0,'L');
				$this->SetXY(59,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['no_of_package'],0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(75,$new_y,35,7);
				$this->SetXY(76,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Payment Mode:',0,'L');
				$this->SetXY(97,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,'Cash',0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(110,$new_y,30,7);
				$this->SetXY(111,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Mode:',0,'L');
				$this->SetXY(121,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['mode'],0,'L');
				
				
				
				//Shippers   Copy
				$this->addPage();
				$new_y=$this->GetY()+30;
				$this->Rect(5,$new_y,45,45);
				$this->Image('upimages/'.$logo,9,$new_y+13,38,15);
				$x=$this->GetX();
				$y=$this->GetY();
				
				$this->Rect(50,$new_y,50,45);
				$this->SetXY(52,$new_y+5);
				$this->SetFont('Arial','',8);
				$this->MultiCell(50,5,'Consignment No.:',0,'C');
				$this->SetXY(52,$new_y+8);
				$this->MultiCell(50,5,$shipment['consignment_no'],0,'C');
				
				
				$this->Image('_private_content_shipment_barcode/'.$shipment['barcode_image'],53,$new_y+13,45,15);
				$this->SetXY(70,$new_y+28);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$shipment['invoice_number'],0,'C');
				$this->SetFont('Arial','B',8);
				$this->SetXY(63,$new_y+32);
				$this->Cell(18,7,'Accounts Copy',0,'C');
				
				$this->Rect(100,$new_y,35,15);
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Pickup Date:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y);
				$this->Cell(20,17,date('F d, Y',strtotime($shipment['pickup_date'])),0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Pickup Time:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y);
				$this->Cell(20,17,date('H:i a',strtotime($shipment['pickup_date'])),0,'L');
				
				$this->Rect(170,$new_y,35,15);
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Delivery Date:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y);
				$this->Cell(20,17,date('F d, Y',strtotime($shipment['delivery_date'])),0,'L');
				
				//-----------
				$new_y=$new_y+15;
				$source_city=fetch_query("*", "location", array("location_id="=>$shipment['source_city']));
				$destination_city=fetch_query("*", "location", array("location_id="=>$shipment['destination_city']));
				$this->Rect(100,$new_y,35,15);
				$x=$this->GetX();
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Origin:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y);
				$this->Cell(20,17,$source_city['name'],0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Destination:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y);
				$this->Cell(20,17,$destination_city['name'],0,'L');
				
				
				$this->Rect(170,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Courier:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y);
				$this->Cell(20,17,'',0,'L');
				
				//-----------
				$new_y=$new_y+15;
				$this->Rect(100,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Carrier:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y+4); 
				$this->Cell(20,7,'NTEXPRESS',0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Carrier Ref. No.:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y+4);
				$this->Cell(20,7,'',0,'L');
				
				$this->Rect(170,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Departure Time:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y+4);
				$this->Cell(20,7,'',0,'L');
				
				///---------
				$new_y=$new_y+15;
				$this->Rect(5,$new_y,30,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Shipper',0,'L');
				
				$source_agent=fetch_query("*", "agent", array("id="=>$shipment['sender_agentid']));
				$this->Rect(35,$new_y,40,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(38,$new_y+1);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$source_agent['name'],0,'L');
				
				///---------
				$this->Rect(75,$new_y,25,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Consignee',0,'L');
				
				$desti_agent=fetch_query("*", "agent", array("id="=>$shipment['desti_agentid']));
				$this->Rect(100,$new_y,40,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(101,$new_y+1);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$desti_agent['name'],0,'L');
				
				$this->Rect(140,$new_y,65,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(141,$new_y+1);
				$this->SetFont('Arial','',8);
				$status=$shipment['status'];
				if($status==1)
					$status='Pending';
				else if($status==2)
					$status='In Process';
				else if($status==3)
					$status='Delivered';
				else if($status==4)
					$status='Reject';
				$this->Cell(18,7,"Status: ".$status,0,'L');
				
				
				//-----
				$new_y=$new_y+8;
				$this->Rect(5,$new_y,70,25);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$source_city['name'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,5,$shipment['source_address'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->Cell(18,5,$shipment['sender_mobile'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->Cell(18,5,$shipment['sender_email'],0,'L');
				
				$this->Rect(75,$new_y,65,25);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$destination_city['name'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,5,$shipment['destination_address'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->Cell(18,5,$shipment['desti_mobile'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->Cell(18,5,$shipment['desti_email'],0,'L');
				
				$this->Rect(140,$new_y,65,46);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(141,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Comment:',0,'L');
				$y=$this->GetY();
				$this->SetXY(141,$y+5);
				$this->SetFont('Arial','',8);
				$this->MultiCell(65,5,$shipment['comment'],0,'L');
				
				///---------
				$new_y=$new_y+25;
				$y=$this->GetY();
				$this->Rect(5,$new_y,40,14);
				$this->SetXY(6,$new_y+1);

				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Type of Shipment:',0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$shipment['type_of_product'],0,'L');
				
				$y=$this->GetY();
				$this->Rect(45,$new_y,30,14);
				$this->SetXY(46,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Packages:',0,'L');
				$y=$this->GetY();
				$this->SetXY(45,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,'',0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(75,$new_y,35,14);
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Product:',0,'L');
				$y=$this->GetY();
				$this->SetXY(75,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,'',0,'L');
				
				$y=$this->GetY();
				$this->Rect(110,$new_y,30,14);
				$this->SetXY(111,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Weight:',0,'L');
				$y=$this->GetY();
				$this->SetXY(111,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$shipment['weight'],0,'L');
				
				
				///---------
				$new_y=$new_y+14;
				$y=$this->GetY();
				$this->Rect(5,$new_y,40,7);
				$this->SetXY(6,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Total Freight:',0,'L');
				$this->SetXY(25,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['total_amount'],0,'L');
				

				
				$y=$this->GetY();
				$this->Rect(45,$new_y,30,7);
				$this->SetXY(46,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Quantity: ',0,'L');
				$this->SetXY(59,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['no_of_package'],0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(75,$new_y,35,7);
				$this->SetXY(76,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Payment Mode:',0,'L');
				$this->SetXY(97,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,'Cash',0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(110,$new_y,30,7);
				$this->SetXY(111,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Mode:',0,'L');
				$this->SetXY(121,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['mode'],0,'L');
				
			}
		}
		$last_id=$id;
		$pdf = new PDF('P','mm',array(210,297));
		
		$pdf->AddPage();
		$pdf->AliasNbPages();
		$pdf->SetTitle('quote_no_111');
		$pdf->SetMargins(1.5, 1.5);
		$pdf->Bill_text($last_id);
		$content = $pdf->Output('_private_content_shipment/s_'.$last_id.'.pdf','F');
		//$pdf->Output();
		//end for pdf invoice
		
		//start for label
		$lpdf = new PDF('P','mm',array(210,297));
		
		$lpdf->AddPage();
		$lpdf->AliasNbPages();
		$lpdf->SetTitle('i_'.$last_id);
		$lpdf->SetMargins(1.5, 1.5);
		$lpdf->Label_text($last_id);
		$content = $lpdf->Output('_private_content_shipment/l_'.$last_id.'.pdf','F');
		//$lpdf->Output();
	  //end for pdf label
		
	   	$insert = update_query($arr,"id=".$id,"shipment");
	  if($insert)
	  {
		  $_SESSION['suc']='Shipment Detail Updated Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Shipment Detail Not Updated... Try Again...';
	  }
	  //header("location:".$site_url."shipment-list/".$last_id);
	  header("location:".$site_url."shipment-invoice-preview/".$last_id);
	  exit;
  }
  else
  {  
  
  	  $userdetail=fetch_query("*", "agent", array("id="=>$_SESSION['ntexpress_retroagent'])); 
	  $deptid=$userdetail['deptid'];
  
	  $dt=date('Y-m-d H:i:s');
	  $delivery_date=date('Y-m-d',strtotime($_POST['delivery_date'])); 
	 // $delivery_time=date('H:i:s',strtotime($_POST['delivery_time']));
	 $delivery_time=date('H:i:s',strtotime($_POST['phour'].":".$_POST['pminute']." ".$_POST['ptime']));
	  $pickup_date=date('Y-m-d',strtotime($_POST['pickup_date']));
	 // $pickup_time=date('H:i:s',strtotime($_POST['pickup_time'])); 
	  $pickup_time=date('H:i:s',strtotime($_POST['ehour'].":".$_POST['eminute']." ".$_POST['etime']));
	  
	  $delivery_date=$delivery_date." ".$delivery_time;
	  $pickup_date=$pickup_date." ".$pickup_time;
	  $arr=array("aid"=>$userdetail['id'],"consignment_no"=>$_POST['consignment_no'],"invoice_number"=>$_POST['invoice_number'],"invoice_date"=>date('Y-m-d',strtotime($_POST['invoice_date'])),"source_country"=>$userdetail['country'],"source_state"=>$userdetail['state'],"source_city"=>$userdetail['city'],"destination_country"=>$_POST['destination_country'],"destination_state"=>$_POST['destination_state'],"destination_city"=>$_POST['destination_city'],"no_of_package"=>$_POST['no_of_package'],"amount"=>$_POST['amount'],"tax_percentage"=>$_POST['tax_percentage'],"total_amount"=>$_POST['total_amount'],"payment_cash"=>$_POST['total_case'],"payment_fc"=>$_POST['total_fc'],"destination_address"=>$_POST['destination_address'],"source_address"=>$_POST['source_address'],"comment"=>$_POST['comment'],"sender_deptid"=>$deptid,"sender_agentid"=>$userdetail['id'],"desti_deptid"=>$_POST['desti_deptid'],"desti_agentid"=>$_POST['desti_agentid'],"sender_name"=>$_POST['sender_name'],"sender_mobile"=>$_POST['sender_mobile'],"desti_name"=>$_POST['desti_name'],"desti_mobile"=>$_POST['desti_mobile'],"sender_email"=>$_POST['sender_email'],"desti_email"=>$_POST['desti_email'],"type_of_product"=>$_POST['type_of_product'],"mode"=>$_POST['mode'],"delivery_date"=>$delivery_date,"pickup_date"=>$pickup_date,"status"=>$_POST['status'],"added_on"=>$dt,"barcode_image"=>$_POST['barcode_image']);   
	  $insert = insert_query($arr, "shipment");
	  $last_id=$dlink->insert_id;
	  
	  //pdf coding for invoice//
	  
	class PDF extends FPDF
	{
		
		function WordWrap(&$text, $maxwidth)
		{
			
			$text = trim($text);
			if ($text==='')
				return 0;
			$space = $this->GetStringWidth(' ');
			$lines = explode("\n", $text);
			$text = '';
			$count = 0;
		
			foreach ($lines as $line)
			{
				$words = preg_split('/ +/', $line);
				$width = 0;
		
				foreach ($words as $word)
				{
					$wordwidth = $this->GetStringWidth($word);
					if ($wordwidth > $maxwidth)
					{
						// Word is too long, we cut it
						for($i=0; $i<strlen($word); $i++)
						{
							$wordwidth = $this->GetStringWidth(substr($word, $i, 1));
							if($width + $wordwidth <= $maxwidth)
							{
								$width += $wordwidth;
								$text .= substr($word, $i, 1);
							}
							else
							{
								$width = $wordwidth;
								$text = rtrim($text)."\n".substr($word, $i, 1);
								$count++;
							}
						}
					}
					elseif($width + $wordwidth <= $maxwidth)
					{
						$width += $wordwidth + $space;
						$text .= $word.' ';
					}
					else
					{
						$width = $wordwidth + $space;
						$text = rtrim($text)."\n".$word.' ';
						$count++;
					}
				}
				$text = rtrim($text)."\n";
				$count++;
			}
			$text = rtrim($text);
			return $count;
		}
		
		
		function Bill_text($bid)
		{ 
			
			$adm=fetch_query("*", "`myadmin`", array("id="=>1));
			
			$mobile=$adm['mobile_1'];
			$address=$adm['address'];
			$logo=$adm['logo'];
			$fill=false;
			$this->Rect(5,5,200,287);
          	$this->Image('upimages/'.$logo,10,9,50,15);
			$x=$this->GetX();
			$y=$this->GetY();
			$this->SetTextColor(0,0,0); 
			$this->SetFont('Arial','',8);
			$this->Ln();
			$this->SetFont('Arial','B',17);
			$this->SetXY($x+30,$y+2);
			global $dlink;
			$adm=fetch_query("*", "`myadmin`", array("id="=>1));
			$shipment=fetch_query("*", "`shipment`", array("id="=>$bid));
			
			$this->SetXY($x+133,9);
			$this->SetFont('Arial','',10);
			$this->MultiCell(35,5,'Consignment No.: ',0,'L');
			$this->SetXY($x+162,9);
			$this->SetFont('Arial','',10);
			$this->MultiCell(40,5,$shipment['consignment_no'],0,'L');
				
			$this->SetXY($x+133,$y+5);
			$this->SetFont('Arial','',10);
			$this->MultiCell(35,5,'Invoice No.: ',0,'L');
			$this->SetXY($x+162,$y+5);
			$this->SetFont('Arial','',10);
			$this->MultiCell(40,5,'#'.$shipment['invoice_number'],0,'L');
				
			$this->SetXY($x+133,$y+10);
			$this->SetFont('Arial','',10);
			$this->MultiCell(35,5,'Invoice Date: ',0,'L');
			$this->SetXY($x+162,$y+10);
			$this->SetFont('Arial','',10);
			$this->MultiCell(50,5,date('d-m-Y',strtotime($shipment['invoice_date'])),0,'L');
			$this->Image('_private_content_shipment_barcode/'.$shipment['barcode_image'],$x+135,27,55,20);
			
			
			$this->SetTextColor(0,0,0);
			$this->SetFont('Arial','',7);
			$this->SetXY(10,$y+15);
			$this->MultiCell(100,5,$address,0,'L');
			$this->SetXY(10,$y+25);
			$this->MultiCell(73,5,'Mob. No.:'.$mobile,0,'L');
			
			$this->SetXY($x+30,$y+32);
			
			$this->Ln(10);
			
			$this->Rect(8,50,194,30);
			$this->SetFont('Arial','B',11);
			$this->SetX(10);
			$this->Cell(25,5,'Shipper Address',0,'L');
			$this->Rect(105,50,0,30);
			$this->SetX(108);
			
			$this->Cell(25,5,'Receiver Address',0,'L');
			$y=$this->GetY();
			$this->SetFont('Arial','',11);
			$this->SetXY(10,$y+5);
			$this->Cell(90,5,$shipment['sender_name'],0,'L');
			$this->SetX(108);
			$this->Cell(90,5,$shipment['desti_name'],0,'L');
			$y=$this->GetY();
			$this->SetXY(10,$y+5);
			$this->SetFont('Arial','',11);
			$this->Cell(90,5,$shipment['source_address'],0,'L');
			$this->SetX(108);
			$this->Cell(90,5,$shipment['destination_address'],0,'L');
			$this->SetFont('Arial','',11);
			$y=$this->GetY();
			$this->SetXY(10,$y+5);
			$this->Cell(90,5,$shipment['sender_mobile'],0,'L');
			$this->SetX(108);
			$this->Cell(90,5,$shipment['desti_mobile'],0,'L');
			$this->SetXY(10,$y+5);
			$this->SetFont('Arial','',11);
			
			$x=$this->GetX();
			$y=$this->GetY();
			$this->SetFont('Arial','',11);
			$this->SetXY($x,$y);
			
			$this->SetXY(10,$y+5);
			$this->SetFont('Arial','',11);

			$this->Cell(90,5,$shipment['sender_email'],0,'L');
			$this->SetX(108);
			$this->Cell(90,5,$shipment['desti_email'],0,'L');
			$x=$this->GetX();
			$y=$this->GetY();
			$this->SetFont('Arial','B',11);
			$this->SetXY($x,$y);
			$this->Rect(8,85,194,135);
			
			$ostate=fetch_query("*","location", array("location_id="=>$shipment['source_state']),"");
			$ocity=fetch_query("*","location", array("location_id="=>$shipment['source_city']),"");
			
			$dstate=fetch_query("*","location", array("location_id="=>$shipment['destination_state']),"");
			$dcity=fetch_query("*","location", array("location_id="=>$shipment['destination_city']),"");
			
			if($shipment['status']=='1')
			{
				$status='Pending';
			}
			if($shipment['payment_fc']=='0.00')
			{
				$paymode='Cash';
				$totalfc='0.00';
			}
			else
			{
				$paymode='FC';
				$totalfc=$shipment['payment_fc'];
			}
			$this->SetXY(9,87);
			$this->SetFont('Arial','B',11);
			$this->Cell(64,5,'Origin : ',0,'L');
			$this->SetXY(74,87);
			$this->Cell(64,5,'Package : ',0,'L');
			$this->SetXY(139,87);
			$this->Cell(64,5,'Status : ',0,'L');
			
			$this->SetXY(9,92);
			$this->SetFont('Arial','',10);
			$this->Cell(64,5,$ostate['name'].'/'.$ocity['name'],0,'L');
			$this->SetXY(74,92);
			$this->Cell(64,5,$shipment['no_of_package'],0,'L');
			$this->SetXY(139,92);
			$this->Cell(64,5,$status,0,'L');
			
			//2
			$this->SetXY(9,105);
			$this->SetFont('Arial','B',11);
			$this->Cell(64,5,'Destination : ',0,'L');
			$this->SetXY(74,105);
			$this->Cell(64,5,'Carrier : ',0,'L');
			$this->SetXY(139,105);
			$this->Cell(64,5,'Weight : ',0,'L');
			
			$this->SetXY(9,110);
			$this->SetFont('Arial','',10);
			$this->Cell(64,5,$dstate['name'].'/'.$dcity['name'],0,'L');
			$this->SetXY(74,110);
			$this->Cell(64,5,'NTEXPRESS',0,'L');
			$this->SetXY(139,110);
			$this->Cell(64,5,$shipment['weight'],0,'L');
			
			//3
			$this->SetXY(9,123);
			$this->SetFont('Arial','B',11);
			$this->Cell(64,5,'Shipment Mode : ',0,'L');
			$this->SetXY(74,123);
			$this->Cell(64,5,'Product : ',0,'L');
			$this->SetXY(139,123);
			$this->Cell(64,5,'Payment Mode : ',0,'L');
			
			$this->SetXY(9,128);
			$this->SetFont('Arial','',10);
			$this->Cell(64,5,$shipment['mode'],0,'L');
			$this->SetXY(74,128);
			$this->Cell(64,5,$shipment['type_of_product'],0,'L');
			$this->SetXY(139,128);
			$this->Cell(64,5,$paymode,0,'L');
			
			//4
			$this->SetXY(9,141);
			$this->SetFont('Arial','B',11);
			$this->Cell(64,5,'Total Freight : ',0,'L');
			$this->SetXY(74,141);
			$this->Cell(64,5,'Expected Delivery Date : ',0,'L');
			$this->SetXY(139,141);
			$this->Cell(64,5,'Departure Time : ',0,'L');
			
			$this->SetXY(9,146);
			$this->SetFont('Arial','',10);
			$this->Cell(64,5,$totalfc,0,'L');
			$this->SetXY(74,146); 
			$this->Cell(64,5,date('M d, Y',strtotime($shipment['delivery_date'])),0,'L');
			$this->SetXY(139,146);
			$this->Cell(64,5,date('h:i a',strtotime($shipment['delivery_date'])),0,'L');
			
			//5
			$this->SetXY(9,159);
			$this->SetFont('Arial','B',11);
			$this->Cell(64,5,'Pick-up Date : ',0,'L');
			$this->SetXY(74,159);
			$this->Cell(64,5,'Pick-up Time : ',0,'L');
			$this->SetXY(139,159);
			$this->Cell(64,5,'',0,'L');
			
			$this->SetXY(9,164);
			$this->SetFont('Arial','',10);
			$this->Cell(64,5,date('M d, Y',strtotime($shipment['pickup_date'])),0,'L');
			$this->SetXY(74,164);
			$this->Cell(64,5,date('h:i a',strtotime($shipment['pickup_date'])),0,'L');
			$this->SetXY(139,164);
			$this->Cell(64,5,'',0,'L');
			
			//6
			$this->SetXY(9,177);
			$this->SetFont('Arial','B',11);
			$this->Cell(64,5,'Comments : ',0,'L');
			
			$this->SetXY(9,182);
			$this->SetFont('Arial','',10);
			$this->MultiCell(192,5,$shipment['comment'],0,'J');
		} 
		function Label_text($bid)
		{
				$adm=fetch_query("*", "`myadmin`", array("id="=>1));
				$shipment=fetch_query("*", "`shipment`", array("id="=>$bid));
				
				$mobile=$adm['mobile_1'];
				$address=$adm['address'];
				$logo=$adm['logo'];
				$fill=false;
				
				
				//Accounts  Copy
				$new_y=$this->GetY()+30;
				$this->Rect(5,$new_y,45,45);
				$this->Image('upimages/'.$logo,9,$new_y+13,38,15);
				$x=$this->GetX();
				$y=$this->GetY();
				
				$this->Rect(50,$new_y,50,45);
				
				$this->SetXY(52,$new_y+7);
				$this->SetFont('Arial','',8);
				$this->MultiCell(50,5,'Consignment No.: '.$shipment['consignment_no'],0,'L');
				
				$this->Image('_private_content_shipment_barcode/'.$shipment['barcode_image'],53,$new_y+13,45,15);
				$this->SetXY(70,$new_y+28);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$shipment['invoice_number'],0,'C');
				$this->SetFont('Arial','B',8);
				$this->SetXY(63,$new_y+32);
				$this->Cell(18,7,'Accounts Copy',0,'C');
				
				$this->Rect(100,$new_y,35,15);
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Pickup Date:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y);
				$this->Cell(20,17,date('F d, Y',strtotime($shipment['pickup_date'])),0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Pickup Time:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y);
				$this->Cell(20,17,date('H:i a',strtotime($shipment['pickup_date'])),0,'L');
				
				$this->Rect(170,$new_y,35,15);
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Delivery Date:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y);
				$this->Cell(20,17,date('F d, Y',strtotime($shipment['delivery_date'])),0,'L');
				
				//-----------
				$new_y=$new_y+15;
				$source_city=fetch_query("*", "location", array("location_id="=>$shipment['source_city']));
				$destination_city=fetch_query("*", "location", array("location_id="=>$shipment['destination_city']));
				$this->Rect(100,$new_y,35,15);
				$x=$this->GetX();
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Origin:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y);
				$this->Cell(20,17,$source_city['name'],0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Destination:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y);
				$this->Cell(20,17,$destination_city['name'],0,'L');
				
				
				$this->Rect(170,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Courier:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y);
				$this->Cell(20,17,'',0,'L');
				
				//-----------
				$new_y=$new_y+15;
				$this->Rect(100,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Carrier:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y+4); 
				$this->Cell(20,7,'NTEXPRESS',0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Carrier Ref. No.:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y+4);
				$this->Cell(20,7,'',0,'L');
				
				$this->Rect(170,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Departure Time:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y+4);
				$this->Cell(20,7,'',0,'L');
				
				///---------
				$new_y=$new_y+15;
				$this->Rect(5,$new_y,30,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Shipper',0,'L');
				
				$source_agent=fetch_query("*", "agent", array("id="=>$shipment['sender_agentid']));
				$this->Rect(35,$new_y,40,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(38,$new_y+1);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$source_agent['name'],0,'L');
				
				///---------
				$this->Rect(75,$new_y,25,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Consignee',0,'L');
				
				$desti_agent=fetch_query("*", "agent", array("id="=>$shipment['desti_agentid']));
				$this->Rect(100,$new_y,40,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(101,$new_y+1);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$desti_agent['name'],0,'L');
				
				$this->Rect(140,$new_y,65,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(141,$new_y+1);
				$this->SetFont('Arial','',8);
				$status=$shipment['status'];
				if($status==1)
					$status='Pending';
				else if($status==2)
					$status='In Process';
				else if($status==3)
					$status='Delivered';
				else if($status==4)
					$status='Reject';
				$this->Cell(18,7,"Status: ".$status,0,'L');
				
				
				//-----
				$new_y=$new_y+8;
				$this->Rect(5,$new_y,70,25);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$source_city['name'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,5,$shipment['source_address'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->Cell(18,5,$shipment['sender_mobile'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->Cell(18,5,$shipment['sender_email'],0,'L');
				
				$this->Rect(75,$new_y,65,25);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$destination_city['name'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,5,$shipment['destination_address'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->Cell(18,5,$shipment['desti_mobile'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->Cell(18,5,$shipment['desti_email'],0,'L');
				
				$this->Rect(140,$new_y,65,46);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(141,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Comment:',0,'L');
				$y=$this->GetY();
				$this->SetXY(141,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,5,$shipment['comment'],0,'L');
				
				///---------
				$new_y=$new_y+25;
				$y=$this->GetY();
				$this->Rect(5,$new_y,40,14);
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Type of Shipment:',0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$shipment['type_of_product'],0,'L');
				
				$y=$this->GetY();
				$this->Rect(45,$new_y,30,14);
				$this->SetXY(46,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Packages:',0,'L');
				$y=$this->GetY();
				$this->SetXY(45,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,'',0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(75,$new_y,35,14);
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Product:',0,'L');
				$y=$this->GetY();
				$this->SetXY(75,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,'',0,'L');
				
				$y=$this->GetY();
				$this->Rect(110,$new_y,30,14);
				$this->SetXY(111,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Weight:',0,'L');
				$y=$this->GetY();
				$this->SetXY(111,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$shipment['weight'],0,'L');
				
				
				///---------
				$new_y=$new_y+14;
				$y=$this->GetY();
				$this->Rect(5,$new_y,40,7);
				$this->SetXY(6,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Total Freight:',0,'L');
				$this->SetXY(25,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['total_amount'],0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(45,$new_y,30,7);
				$this->SetXY(46,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Quantity: ',0,'L');
				$this->SetXY(59,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['no_of_package'],0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(75,$new_y,35,7);
				$this->SetXY(76,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Payment Mode:',0,'L');
				$this->SetXY(97,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,'Cash',0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(110,$new_y,30,7);
				$this->SetXY(111,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Mode:',0,'L');
				$this->SetXY(121,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['mode'],0,'L');
				
				
				//Consignee Copy
				
				$mobile=$adm['mobile_1'];
				$address=$adm['address'];
				$logo=$adm['logo'];
				$fill=false;
				
				$new_y=$this->GetY()+30;
				$this->Rect(5,$new_y,45,45);
				$this->Image('upimages/'.$logo,9,$new_y+13,38,15);
				$x=$this->GetX();
				$y=$this->GetY();
				
				$this->Rect(50,$new_y,50,45);
				$this->Image('_private_content_shipment_barcode/'.$shipment['barcode_image'],53,$new_y+13,45,15);
				$this->SetXY(70,$new_y+28);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$shipment['invoice_number'],0,'C');
				$this->SetFont('Arial','B',8);
				$this->SetXY(63,$new_y+32);
				$this->Cell(18,7,'Consignee Copy',0,'C');
				
				$this->Rect(100,$new_y,35,15);
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Pickup Date:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y);
				$this->Cell(20,17,date('F d, Y',strtotime($shipment['pickup_date'])),0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Pickup Time:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y);
				$this->Cell(20,17,date('H:i a',strtotime($shipment['pickup_date'])),0,'L');
				
				$this->Rect(170,$new_y,35,15);
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Delivery Date:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y);
				$this->Cell(20,17,date('F d, Y',strtotime($shipment['delivery_date'])),0,'L');
				
				//-----------
				$new_y=$new_y+15;
				$source_city=fetch_query("*", "location", array("location_id="=>$shipment['source_city']));
				$destination_city=fetch_query("*", "location", array("location_id="=>$shipment['destination_city']));
				$this->Rect(100,$new_y,35,15);
				$x=$this->GetX();
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Origin:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y);
				$this->Cell(20,17,$source_city['name'],0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Destination:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y);
				$this->Cell(20,17,$destination_city['name'],0,'L');
				
				
				$this->Rect(170,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Courier:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y);
				$this->Cell(20,17,'',0,'L');
				
				//-----------
				$new_y=$new_y+15;
				$this->Rect(100,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Carrier:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y+4); 
				$this->Cell(20,7,'NTEXPRESS',0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Carrier Ref. No.:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y+4);
				$this->Cell(20,7,'',0,'L');
				
				$this->Rect(170,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Departure Time:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y+4);
				$this->Cell(20,7,'',0,'L');
				
				///---------
				$new_y=$new_y+15;
				$this->Rect(5,$new_y,30,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Shipper',0,'L');
				
				$source_agent=fetch_query("*", "agent", array("id="=>$shipment['sender_agentid']));
				$this->Rect(35,$new_y,40,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(38,$new_y+1);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$source_agent['name'],0,'L');
				
				///---------
				$this->Rect(75,$new_y,25,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Consignee',0,'L');
				
				$desti_agent=fetch_query("*", "agent", array("id="=>$shipment['desti_agentid']));
				$this->Rect(100,$new_y,40,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(101,$new_y+1);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$desti_agent['name'],0,'L');
				
				$this->Rect(140,$new_y,65,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(141,$new_y+1);
				$this->SetFont('Arial','',8);
				$status=$shipment['status'];
				if($status==1)
					$status='Pending';
				else if($status==2)
					$status='In Process';
				else if($status==3)
					$status='Delivered';
				else if($status==4)
					$status='Reject';
				$this->Cell(18,7,"Status: ".$status,0,'L');
				
				
				//-----
				$new_y=$new_y+8;
				$this->Rect(5,$new_y,70,25);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$source_city['name'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,5,$shipment['source_address'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->Cell(18,5,$shipment['sender_mobile'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->Cell(18,5,$shipment['sender_email'],0,'L');
				
				$this->Rect(75,$new_y,65,25);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$destination_city['name'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,5,$shipment['destination_address'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->Cell(18,5,$shipment['desti_mobile'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->Cell(18,5,$shipment['desti_email'],0,'L');
				
				$this->Rect(140,$new_y,65,46);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(141,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Comment:',0,'L');
				$y=$this->GetY();
				$this->SetXY(141,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,5,$shipment['comment'],0,'L');
				
				///---------
				$new_y=$new_y+25;
				$y=$this->GetY();
				$this->Rect(5,$new_y,40,14);
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Type of Shipment:',0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$shipment['type_of_product'],0,'L');
				
				$y=$this->GetY();
				$this->Rect(45,$new_y,30,14);
				$this->SetXY(46,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Packages:',0,'L');
				$y=$this->GetY();
				$this->SetXY(45,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,'',0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(75,$new_y,35,14);
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Product:',0,'L');
				$y=$this->GetY();
				$this->SetXY(75,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,'',0,'L');
				
				$y=$this->GetY();
				$this->Rect(110,$new_y,30,14);
				$this->SetXY(111,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Weight:',0,'L');
				$y=$this->GetY();
				$this->SetXY(111,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$shipment['weight'],0,'L');
				
				
				///---------
				$new_y=$new_y+14;
				$y=$this->GetY();
				$this->Rect(5,$new_y,40,7);
				$this->SetXY(6,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Total Freight:',0,'L');
				$this->SetXY(25,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['total_amount'],0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(45,$new_y,30,7);
				$this->SetXY(46,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Quantity: ',0,'L');
				$this->SetXY(59,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['no_of_package'],0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(75,$new_y,35,7);
				$this->SetXY(76,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Payment Mode:',0,'L');
				$this->SetXY(97,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,'Cash',0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(110,$new_y,30,7);
				$this->SetXY(111,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Mode:',0,'L');
				$this->SetXY(121,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['mode'],0,'L');
				
				
				
				//Shippers   Copy
				$this->addPage();
				$new_y=$this->GetY()+30;
				$this->Rect(5,$new_y,45,45);
				$this->Image('upimages/'.$logo,9,$new_y+13,38,15);
				$x=$this->GetX();
				$y=$this->GetY();
				
				$this->Rect(50,$new_y,50,45);
				$this->Image('_private_content_shipment_barcode/'.$shipment['barcode_image'],53,$new_y+13,45,15);
				$this->SetXY(70,$new_y+28);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$shipment['invoice_number'],0,'C');
				$this->SetFont('Arial','B',8);
				$this->SetXY(63,$new_y+32);
				$this->Cell(18,7,'Shippers Copy',0,'C');
				
				$this->Rect(100,$new_y,35,15);
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Pickup Date:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y);
				$this->Cell(20,17,date('F d, Y',strtotime($shipment['pickup_date'])),0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Pickup Time:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y);
				$this->Cell(20,17,date('H:i a',strtotime($shipment['pickup_date'])),0,'L');
				
				$this->Rect(170,$new_y,35,15);
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Delivery Date:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y);
				$this->Cell(20,17,date('F d, Y',strtotime($shipment['delivery_date'])),0,'L');
				
				//-----------
				$new_y=$new_y+15;
				$source_city=fetch_query("*", "location", array("location_id="=>$shipment['source_city']));
				$destination_city=fetch_query("*", "location", array("location_id="=>$shipment['destination_city']));
				$this->Rect(100,$new_y,35,15);
				$x=$this->GetX();
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Origin:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y);
				$this->Cell(20,17,$source_city['name'],0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Destination:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y);
				$this->Cell(20,17,$destination_city['name'],0,'L');
				
				
				$this->Rect(170,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Courier:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y);
				$this->Cell(20,17,'',0,'L');
				
				//-----------
				$new_y=$new_y+15;
				$this->Rect(100,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(101,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Carrier:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(101,$new_y+4); 
				$this->Cell(20,7,'NTEXPRESS',0,'L');
				
				$this->Rect(135,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(136,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Carrier Ref. No.:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(136,$new_y+4);
				$this->Cell(20,7,'',0,'L');
				
				$this->Rect(170,$new_y,35,15);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(171,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(20,7,'Departure Time:',0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(171,$new_y+4);
				$this->Cell(20,7,'',0,'L');
				
				///---------
				$new_y=$new_y+15;
				$this->Rect(5,$new_y,30,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Shipper',0,'L');
				
				$source_agent=fetch_query("*", "agent", array("id="=>$shipment['sender_agentid']));
				$this->Rect(35,$new_y,40,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(38,$new_y+1);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$source_agent['name'],0,'L');
				
				///---------
				$this->Rect(75,$new_y,25,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Consignee',0,'L');
				
				$desti_agent=fetch_query("*", "agent", array("id="=>$shipment['desti_agentid']));
				$this->Rect(100,$new_y,40,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(101,$new_y+1);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$desti_agent['name'],0,'L');
				
				$this->Rect(140,$new_y,65,8);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(141,$new_y+1);
				$this->SetFont('Arial','',8);
				$status=$shipment['status'];
				if($status==1)
					$status='Pending';
				else if($status==2)
					$status='In Process';
				else if($status==3)
					$status='Delivered';
				else if($status==4)
					$status='Reject';
				$this->Cell(18,7,"Status: ".$status,0,'L');
				
				
				//-----
				$new_y=$new_y+8;
				$this->Rect(5,$new_y,70,25);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$source_city['name'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,5,$shipment['source_address'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->Cell(18,5,$shipment['sender_mobile'],0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->Cell(18,5,$shipment['sender_email'],0,'L');
				
				$this->Rect(75,$new_y,65,25);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,$destination_city['name'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,5,$shipment['destination_address'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->Cell(18,5,$shipment['desti_mobile'],0,'L');
				$y=$this->GetY();
				$this->SetXY(76,$y+5);
				$this->Cell(18,5,$shipment['desti_email'],0,'L');
				
				$this->Rect(140,$new_y,65,46);
				$x=$this->GetX();
				$y=$this->GetY();
				$this->SetXY(141,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Comment:',0,'L');
				$y=$this->GetY();
				$this->SetXY(141,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,5,$shipment['comment'],0,'L');
				
				///---------
				$new_y=$new_y+25;
				$y=$this->GetY();
				$this->Rect(5,$new_y,40,14);
				$this->SetXY(6,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Type of Shipment:',0,'L');
				$y=$this->GetY();
				$this->SetXY(6,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$shipment['type_of_product'],0,'L');
				
				$y=$this->GetY();
				$this->Rect(45,$new_y,30,14);
				$this->SetXY(46,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Packages:',0,'L');
				$y=$this->GetY();
				$this->SetXY(45,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,'',0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(75,$new_y,35,14);
				$this->SetXY(76,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Product:',0,'L');
				$y=$this->GetY();
				$this->SetXY(75,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,'',0,'L');
				
				$y=$this->GetY();
				$this->Rect(110,$new_y,30,14);
				$this->SetXY(111,$new_y+1);
				$this->SetFont('Arial','B',8);
				$this->Cell(18,7,'Weight:',0,'L');
				$y=$this->GetY();
				$this->SetXY(111,$y+5);
				$this->SetFont('Arial','',8);
				$this->Cell(18,7,$shipment['weight'],0,'L');
				
				
				///---------
				$new_y=$new_y+14;
				$y=$this->GetY();
				$this->Rect(5,$new_y,40,7);
				$this->SetXY(6,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Total Freight:',0,'L');
				$this->SetXY(25,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['total_amount'],0,'L');
				

				
				$y=$this->GetY();
				$this->Rect(45,$new_y,30,7);
				$this->SetXY(46,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Quantity: ',0,'L');
				$this->SetXY(59,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['no_of_package'],0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(75,$new_y,35,7);
				$this->SetXY(76,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Payment Mode:',0,'L');
				$this->SetXY(97,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,'Cash',0,'L');
				
				
				$y=$this->GetY();
				$this->Rect(110,$new_y,30,7);
				$this->SetXY(111,$new_y);
				$this->SetFont('Arial','B',8);
				$this->Cell(9,7,'Mode:',0,'L');
				$this->SetXY(121,$new_y);
				$this->SetFont('Arial','',8);
				$this->Cell(9,7,$shipment['mode'],0,'L');
		}
		
	}
	$pdf = new PDF('P','mm',array(210,297));
	
	$pdf->AddPage();
	//$pdf->isFinished = true;
	$pdf->AliasNbPages();
	$pdf->SetTitle('quote_no_111');
	$pdf->SetMargins(1.5, 1.5);
	$pdf->Bill_text($last_id);
	
	$content = $pdf->Output('_private_content_shipment/s_'.$last_id.'.pdf','F');
	//end pdf
	$pdf->Output();
	//exit;
	
	//end for pdf invoice
	
	//start for label
	$lpdf = new PDF('P','mm',array(210,297));
	$lpdf->AddPage();
	$lpdf->AliasNbPages();
	$lpdf->SetTitle('i_'.$last_id);
	$lpdf->SetMargins(1.5, 1.5);
	$lpdf->Label_text($last_id);
	$content = $lpdf->Output('_private_content_shipment/l_'.$last_id.'.pdf','F');
	  
	 
	  
	  if($insert)
	  {
		  $_SESSION['suc']='Shipment Detail Added Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Shipment Detail Not Added... Try Again...';
	  }
	  header("location:".$site_url."shipment-invoice-preview/".$last_id);
	  //header("location:".$site_url."shipment-list/".$last_id);
	  //header("location:".$site_url."shipment-list");
	  exit;
  }
}
?>