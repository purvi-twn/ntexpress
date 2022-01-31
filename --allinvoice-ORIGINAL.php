<?php include("header.php"); ?>

<?php include("leftpanel.php"); ?>

<style>
.inv_st_cty{
    margin-left: 792px;
}
.drop-1{
	display:none;
	width:100%;
	float: right;
	margin-bottom: 5px;

}
.drop-2{
	display:none;
	width:100%;
}
[type="radio"]:checked, [type="radio"]:not(:checked) {
    position: unset;
    left: unset;
    opacity: unset;
}
[type="checkbox"]:checked, [type="checkbox"]:not(:checked) {
    position: unset;
    left: unset;
    opacity: unset;
}
@media screen and (max-width: 400px){
.inv_st_cty{
    margin-left: 171px;
}
.drop-2{
	display:none;
	width:100%;
	margin-right: 6px;
}
.drop-1{
	display:none;
	width:100%;
	float: right;
	margin-bottom: 5px;
	/*margin-right: 6px;*/
}
}
@media screen and (min-width: 401px) and (max-width: 767px){
.inv_st_cty{
    margin-left: 171px;
}
.drop-2{
	display:none;
	width:100%;
	margin-right: -20px;
}
.drop-1{
	display:none;
	width:100%;
	float: right;
	margin-bottom: 5px;
	margin-right: -20px;
}
}
@media screen and (min-width: 768px) and (max-width: 992px){
	.inv_st_cty{
    margin-left: 365px;
}
.drop-2{
	display:none;
	width:100%;
	margin-right: -20px;
}
.drop-1{
	display:none;
	width:100%;
	float: right;
	margin-bottom: 5px;
	margin-right: -20px;
}
}
</style>
<div class="content-wrapper">

    <section class="content-header">

        <!--<h1> Customers Listing </h1>-->

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
                    	<div class="col-6 text-left">
                    		<h3> All Invoice </h3>
                       	</div>
                        <div class="col-6 text-right">
                        <?php
						$create_invoice=0; $self_invoice=0; $all_invoice=0;
						if(@$_SESSION['ntexpress_retroagent']!='')
						{
                        	$create_invoice=$main_roll_staff['invoice'];
							$self_invoice=$main_roll_staff['self_invoice'];
							$all_invoice=$main_roll_staff['all_invoice'];
						}
						else{
							$create_invoice=1;
							$self_invoice=1; 
							$all_invoice=1;
						}
						//if($create_invoice==1)
						//{
						?>
							<button class="btn btn-danger" onClick="location.href='<?php echo $site_url; ?>new-shipment'"> <i class="fa fa-plus"></i> New</button>
                        	<?php
						//}?>
                        <select id="filterby" name="filterby" class="btn btn-danger" onChange="filterval();">
                            <option value="0">Filter By</option>
                            <option value="province">Province</option>
                            <option value="city">City</option>
                        </select>
                    </div>
                    </div>
                <div class="row">
                    <div class="col-6 text-left"></div>
                    <div class="col-6 text-right inv_st_cty">
                        <select name="country" id="country" class="form-control" onChange="get_state(this.value)" style="display:none">
                            <option value="">Select Country</option>
                            <?php $country='184';
                            $selcon=mysqli_query($dlink,"SELECT * FROM location where location_type='0' and location_id='184' and parent_id='0' and is_visible='0' order by name");
                            while ($bcon=mysqli_fetch_array($selcon)) { ?>
                                <option <?php if ($bcon['location_id'] == $country) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option><?php
                            }?>
                        </select>

                        <div class="col-sm-12 col-md-6">

                            <select name="state" id="state" class="form-control drop-1" onChange="get_city(this.value)">
                                <option value="">Select Province</option>
                                <?php
                                $selsta=mysqli_query($dlink,"SELECT * FROM location where location_type='1' and parent_id='".$country."' and is_visible='0' order by name");
                                while($s=mysqli_fetch_array($selsta)) { ?>
                                    <option value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option><?php
                                } ?>
                            </select>
                        </div>
        
                        <div class="col-sm-12 col-md-6">
                            <select name="city" id="city" class="form-control drop-2" onChange="get_citywisereport(this.value)">
                                <option value="">Select City</option> <?php
                                $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$state."' and is_visible='0' order by name");
                                while($s1=mysqli_fetch_array($selcit)) { ?>
                                    <option value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option> <?php
                                } ?>
                            </select>
                        </div>

                    </div>
                </div>
               <!--  <input type="button" id="save_value" name="save_value" value="Report" class="btn btn-danger"/> -->
                <div class="table-responsive">
                   
                   	<table id="example" class="table table-bordered table-hover">
                       
                        <thead>
                           <tr>
                                <!-- <th><input type="checkbox" name="mainchk" id="master"></th> -->
                                <th>#</th>
                                <th>Date</th>
                                <th>Branch</th>
                                <th>Sales</th>
                                <th>Invoice</th>
                                <th>Cons.</th>
                                <th>Address</th>
                                <th>Area</th>
                                 <th>City</th>                                
                                <th>Province</th>                                 
                                <th>packages</th> 
                                <th>Delivery</th> 
                                <th>Cash</th>
                                <th>COD</th> 
                                <?php
								if(@$_SESSION['ntexpress_retrostaff']!="")
								{ }
								else
								{ ?>
                                <th>Payment</th> <?php
								}?>
                                <!--<th>Paid</th>-->
                                <th>Status</th>
                                <th>Action</th>  
                            </tr>
                            
                        </thead>
                        
                        <tbody id="getData">
                            <?php 
                                $total_amount=0; $total_cash=0; $total_fc=0; $no=1;
								$uid=$userdetail['id'];
								$unm=""; $row='';
								if(@$_SESSION['ntexpress_retrostaff']!="")
								{
									$unm=$_SESSION['ntexpress_retrostaff'];
									
								//	if($self_invoice==1)
										$row=select_query("*","shipment", array("sales_person="=>$unm), "id desc");
								//	if($all_invoice==1)
									//	$row=select_query("*","shipment", '', "id desc");
							     }
								else
								{
									//$unm='admin';
									$row=select_query("*","shipment", '', "id desc");
								}
								//$row=select_query("*","shipment", array("sales_person="=>$unm), "id desc");
                                if($row->num_rows)
                                {
                                    while($b=$row->fetch_array())
                                    {
                                        $scity=fetch_query("name","location",array("location_id="=>$b['source_city']));
										$city=$scity['name'];
										
                                        $sstate=fetch_query("name","location",array("location_id="=>$b['source_state']));

                                        $dept_nm=fetch_query("bname","branches",array("id="=>$b['branch']));
										
										$no_pack=fetch_query("SUM(no_of_package) as total_qnty","shipment_detail",array("oid="=>$b['id']));
                            ?>
                           
                                        <tr>
                                            <!-- <td>
                                                <input name="selector[]" id="ad_Checkbox1" class="ads_Checkbox" type="checkbox" value="<?php echo $b['id']; ?>" />
                                            </td> -->
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($b['invoice_date'])); ?></td>
                                            <td><?php echo $dept_nm['bname'];?></td>
                                            <td><?php echo $b['sales_person'];?></td>
                                            <td><?php echo $b['invoice_number'];?></td>
                                            <td><?php echo $b['consignment_no'];?></td>
                                            <td><?php echo $b['source_address'];?></td>
                                            <td><?php echo $b['area'];?></td>
                                            <td><?php echo $city;?></td>
                                            <td><?php echo $sstate['name'];?></td>
                                            <td><?php echo $no_pack['total_qnty'];?></td>
                                            <td><?php if($b['delivery_date']=='1970-01-01 05:30:00') echo ""; else $b['delivery_date'];?></td>
                                            <td><?php echo $b['payment_cash'];?></td>
                                            <td><?php echo $b['payment_fc'];?></td>
                                            <?php
											
                                            if(@$_SESSION['ntexpress_retrostaff']!="")
											{ }
											else {?>
                                            <td><?php echo $b['mode_of_payment'];?> 
                                                <i class="fa fa-edit" style="font-size:16px" data-toggle="modal" data-target="#myModal_<?php echo $b['id']; ?>" data-id="<?php echo $b['id']; ?>" id="editCompany"></i>

                                                <!-- Start Modal -->
                                                <div class="modal fade" id="myModal_<?php echo $b['id']; ?>" role="dialog">
                                                    <div class="modal-dialog">
                                                    
                                                      <!-- Modal content-->
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                          <h4 class="modal-title">Mod of Payment</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="post">
                                                                <input type="hidden" name="id" value="<?php echo $b['id']; ?>">

                                                                <input type="hidden" name="finaltotal_val" value="<?php echo $b['finaltotal_val']; ?>">

                                                                <input  type="radio" name="paymentmode" value="COD" id="COD" <?php if($b['mode_of_payment']== 'COD')  {echo 'checked'; }?>> COD
                                                                <br>
                                                                <input type="radio" name="paymentmode" value="Cash" id="Cash" <?php if($b['mode_of_payment']== 'Cash')  {echo 'checked'; }?>> Cash
                                                                <br>
                                                                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-success">
                                                            </form>
                                                          <p id="pData"></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal -->
                                            </td><?php
											}?>
                                            <!--<td></td>-->
                                            <td><select name="status<?php echo $b['id']?>" id="status<?php echo $b['id']?>" class="form-control" onChange="change_status('<?php echo $b['id']?>',this.value)">
                                                <option <?php if ($b['status'] == '1') {?> selected="selected" <?php }?> value="1" >Pending</option>
                                                <option <?php if ($b['status'] == '2') {?> selected="selected" <?php }?> value="2" >In Process</option>
                                                <option <?php if ($b['status'] == '3') {?> selected="selected" <?php }?> value="3" >Delivered</option>
                                                <option <?php if ($b['status'] == '4') {?> selected="selected" <?php }?> value="4" >Reject</option>
                                                <option <?php if ($b['status'] == '5') {?> selected="selected" <?php }?> value="5" >Return</option>
                                                <option <?php if ($b['status'] == '6') {?> selected="selected" <?php }?> value="6" >Paid</option>
                                            </select> </td>
                                            <td>
                                            <a style="width:57px" href="generate_invoice.php?iid=<?php echo $b['id']?>" target="_blank"  class="btn btn-info btn-xs mb-5">Create Invoice</a> &nbsp;
                                            <a style="width:57px" href="<?php echo $site_url?>_private_content_shipment/l_<?php echo $b['invoice_number']?>.pdf" target="_blank"  class="btn btn-info btn-xs mb-5">Invoice</a><br />
                                               <?php /*?> <a style="width:57px" href="<?php echo $site_url?>_private_content_shipment/l_<?php echo $b['id']?>.pdf" target="_blank"  class="btn btn-warning btn-xs mb-5">Lables</a><?php */?>				
                                            <a style="width: 80px;color: white;" onClick="sendemail('<?php echo $b['id']?>')" class="btn btn-info btn-xs mb-5">Send Email</a><br />   
                                            </td>
                                        </tr>
                            <?php 
                                        $no++; 
                                    }
                                }
                            ?>
                        </tbody>
                        
                    </table>
                    
                </div>
                
            </div>
            
        </div>

    </section>

</div>




<?php include("footer.php"); ?>
<script language="javascript">
$(document).ready(function () {
    $('#master').on('click', function(e) {
        if($(this).is(':checked',true))  
        {
            $(".ads_Checkbox").prop('checked', true);  
        } else {  
            $(".ads_Checkbox").prop('checked',false);  
        }  
    });
});
$(function(){
    $('#save_value').click(function(){
        var val = [];
        $(':checkbox:checked').each(function(i){
            val[i] = $(this).val();
        });
        alert(val);
        $.ajax({
            type: "POST",
            url: "<?php echo $site_url; ?>admin_ajax.php",
            data:{pid:val,action:'updateInvoice'},
            success: function(data)
            {  
                alert(data);
                return false;
            }
        });
    });
});
function confirm_dialog(val)
{
	if(confirm("Are you sure you want to delete this record?"))
	{
		window.location="<?php echo $site_url; ?>case/customers/"+val;
	}
	else
		return false;
}
function sendemail(pid)
{
	$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{pid:pid,action:'sendemail'},
		 success: function(data)
		 {	
			alert(data);
			return false;
		  }
		});
}
function change_status(fid,val)
{
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{fid:fid,action:'change_shipment_status',val:val},
	 success: function(data)
	 {	
	 	alert('Status changed');
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
        $.ajax({
            type: "POST",
            url: "<?php echo $site_url; ?>admin_ajax.php",
            data:{chkids:val,action:'invoice_getprovince_tracking'},
            success: function(data)
            {  
                $('#getData').html(data);
            }
        });
        
      }
    });
}
function get_citywisereport(val)
{
    $.ajax({
        type: "POST",
        url: "<?php echo $site_url; ?>admin_ajax.php",
        data:{chkids:val,action:'invoice_getcity_tracking'},
        success: function(data)
        {  
            $('#getData').html(data);
        }
    });
}
function filterval()
{
    $('#filterby').change(function(){
        var fltr_val =  $(':selected',this).val();
        if(fltr_val == 0)
        {
            $('#state').hide();
            $('#city').hide();
        }
        if(fltr_val == 'province')
        {
            $('#state').show();
            $('#city').hide();
        }
        if(fltr_val == 'city')
        {
            $('#state').show();
            $('#city').show();
        }
    });
}
</script>
<?php
include 'phpqrcode/qrlib.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;



if(isset($_POST['submit'])!='')
{
    $payment_cash='';$payment_fc='';
    if($_POST['paymentmode'] == 'COD')
    {
        $payment_cash = "0.00";
        $payment_fc = $_POST['finaltotal_val'];
    }
    elseif($_POST['paymentmode'] == 'Cash')
    {
        $payment_fc = "0.00";
        $payment_cash = $_POST['finaltotal_val'];
    }

    $arr_=array("mode_of_payment"=>$_POST['paymentmode'],"payment_cash"=>$payment_cash,"payment_fc"=>$payment_fc);

    $insert = update_query($arr_,"id=".$_POST['id'],"shipment");
    if($insert)
    {
        $_SESSION['suc']='Shipment Detail Updated Successfully...';
    }
    else
    {
        $_SESSION['unsuc']='Shipment Detail Not Updated... Try Again...';
    }
	$delivery_date=$delivery_date." ".$delivery_time;
	$pickup_date=$pickup_date." ".$pickup_time;
	$row=select_query("*","shipment", array("id="=>$_POST['id']), "id asc");
	if($row->num_rows)
	{
		$bc=$row->fetch_array();
		$last_id=$bc['id'];
	 	//generate pdf
		$adm=fetch_query("*", "`myadmin`", array("id="=>1));
		$logo=$adm['logo'];
		$mobile=$adm['mobile_1'];
		$address=$adm['address']; 
		
		//$adm=fetch_query("*", "`myadmin`", array("id="=>$_POST['sender_id']));
		$city=fetch_query("*", "`location`", array("location_id="=>$bc['source_city']));
		$vat=fetch_query("*", "`customers`", array("name="=>$bc['sender_name']));
		$dcity=fetch_query("*", "`location`", array("location_id="=>$bc['destination_city']));
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

		$text = "INVOICE NO: ".$shipment['invoice_number']."\nCOMPANY NAME: NATIONAL EXPRESS TRANSPORT COMPANY\nGRAND TOTAL: ".$shipment['finaltotal_val']."";

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
		$cash='Invoice_Png_Files/checkbox.png';
		$cod='Invoice_Png_Files/checkbox.png';
		$bank='Invoice_Png_Files/checkbox.png';
		if($mode_of_payment=='Cash')
			$cash='Invoice_Png_Files/checkbox_checked.gif';
		else if($mode_of_payment=='COD')
			$cod='Invoice_Png_Files/checkbox_checked.gif';
		else if($mode_of_payment=='Bank Transfer')
			$bank='Invoice_Png_Files/checkbox_checked.gif';
	
	
		$special_delivery=$qrget['special_delivery'];
		
		$officedoor='Invoice_Png_Files/officedelivery.png';
		
		if($special_delivery=='Office Delivery')
			$officedoor='Invoice_Png_Files/office_checked.gif';
		else if($special_delivery=='Door to Door')
			$officedoor='Invoice_Png_Files/door_checked.gif';
		
		$sender_vat=$shipment['sender_vat']; 
		$sender_iqama='';
		
		$rcv_vat=''; 
		$rcv_iqama='';
		$sender_iqama=$shipment['sender_iqamano'];
		$rcv_iqama=$shipment['desti_iqamano'];
		if($mode_of_payment=='Cash')
		{	
			$sender_vat=$shipment['sender_vat'];
			$rcv_vat=" ";
		}
		else if($mode_of_payment=='COD')
  		{
			$rcv_vat=$shipment['desti_vat_no'];
			$sender_vat=$shipment['sender_vat'];
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

        	/*if($shipment['sender_taxtype'] !='')
			{
				if($shipment['sender_taxtype']=="Vat"){
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
        		
				$html.='<div><h6>NATIONAL EXPRESS TRANSPORT COMPANY</h6></div>
				<div>Ibn Al-Ameed Road, Al-Sulay</div>
				<div>P.O Box : 24117, Al-Riyadh 14273, KSA</div>
				<div style="font-weight: bold;">CR No: 1010352157</div>';
				//if($vat['taxtype']=="Vat"){
					$html.='<div style="font-weight: bold;">VAT No. : 310365617400003</div>';
				//}
			$html.='</div>';
			$tax_invoice_type='';
			if($shipment['sender_taxtype'] !='')
			{
				if($shipment['sender_taxtype']=="Vat"){
					$tax_invoice_type='<span class="titlecls">TAX INVOICE</span>';
				}
				else{
					$tax_invoice_type='<span class="titlecls">SIMPLIFIED TAX INVOICE</span>';
				}
				
			}
			else
			{
				if($shipment['sender_taxtype']=="Vat"){
					$tax_invoice_type='<span class="titlecls">TAX INVOICE</span>';
				}
				else{
					$tax_invoice_type='<span class="titlecls">SIMPLIFIED TAX INVOICE</span>';
				}
			}
			$html.='<div class="col-md-6" align="right" style="padding-left:70px;width:20%;display:inline-block;margin-botton:1%;padding-top:50px">'.$tax_invoice_type.'Consignment No.: '.$qrget['consignment_no'].'</div>
			<div class="col-md-6" align="right"  style="padding:0px;width:30%;display:inline-block;margin-botton:1%;float:right">';
			if($shipment['sender_taxtype'] !='')
			{
				if($shipment['sender_taxtype']=="Vat"){
					$html.='<img src="Invoice_Png_Files/TAX INVOICE ARABIC.png" width="210" style="float:right">';
				}
				else{
					$html.='<img src="Invoice_Png_Files/simplified arabic.png" width="210" style="float:right">';
				}
			}
			else
			{

				if($shipment['sender_taxtype']=="Vat"){
					$html.='<img src="Invoice_Png_Files/TAX INVOICE ARABIC.png" width="210" style="float:right">';
				}
				else{
					$html.='<img src="Invoice_Png_Files/simplified arabic.png" width="210" style="float:right">';
				}
			}
			
			$html.='</div>
			</div>
		 
		<div class="row">
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px;background-color:#f4f3f2;width:44%;display:inline-block;">
				<table style="width:100%;">
					<tr><td style="width:25%;font-weight:bold"><img src="Invoice_Png_Files/Invoice Number.png" width="160"></td><td style="width:80%;font-weight:bold;font-weight:bold;font-size:15px !important" align="right">'.$shipment['invoice_number'].'</td></tr>
				</table>
			</div>
			
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px;background-color:#f4f3f2;width:44%;display:inline-block;float:right">
				<table style="width:100%">
					<tr><td style="width:25%;font-weight:bold"><img src="Invoice_Png_Files/Invoice Date.png" width="160"></td><td style="width:80%;font-weight:bold;font-size:15px !important" align="right">'.$shipment['invoice_date'].'</td></tr>
				</table>
			</div>
		</div>
		<div class="row" style="margin-top:2px">
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px;background-color:#3c3d3a;width:44%;display:inline-block;color:#ffffff">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Files/payment_method.png" width="320" height="20"></td></tr>
				</table>
			</div>
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px;background-color:#3c3d3a;width:44%;display:inline-block;float:right;color:#ffffff">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Files/Special_Delivery.png" width="320" height="20"></td></tr>
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
							<td style="text-align:right;"><img src="Invoice_Png_Files/cash.png" width="75"></td>
							
						</tr>
						<tr>
							<td style="color:#6c6c6c;font-size:12px !important">COD</td>
							<td><img src="'.$cod.'" width="20" ></td>
							<td style="text-align:right;"><img src="Invoice_Png_Files/cod.png" width="75"></td>
							
						</tr>
						<tr>
							<td style="color:#6c6c6c;font-size:12px !important">Bank Transfer</td>
							<td><img src="'.$bank.'" width="20" > </td>
							<td style="text-align:right;"><img src="Invoice_Png_Files/web.png" width="75"></td>
							
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="2" >&nbsp;</td>
							
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:2px !important;float:right">
				<table class="table"> 
					<tbody>
						<tr>
							<td rowspan="2"><img src="qrcode/'.$qrget['qrcode'].'" width="75" style="vergicle-align=middle"></td>
							<td colspan="2"><img src="'.$officedoor.'" width="210"> 
							</td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/values_of_goods.png" width="90" style="margin-bottom:2px"> 
							<br>
							<img src="Invoice_Png_Files/delivery_cost.png" width="90" style="margin-bottom:7px"> 
							</td>
							<td style="float:right;">'.$qrget['value_of_good'].'<br><br>'.$qrget['delivery_cost'].'</td>
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="row" style="margin-top:2px">
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px;background-color:#3c3d3a;width:44%;display:inline-block;color:#ffffff">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Files/Sender’s Details.png" width="320" height="20"></td></tr>
				</table>
			</div>
			
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px; background-color:#3c3d3a; width:44%; display:inline-block; float:right; color:#ffffff">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Files/Receiver’s Details.png" width="320" height="20"></td></tr>
				</table>
			</div>
		</div>
		
		<div class="row" style="margin-top:2px">
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important">
				<table class="table"> 
					
						<tr>
							<td><img src="Invoice_Png_Files/name.png" width="120"></td>
							<td style="color:#6c6c6c;font-size:10px !important" align="right">'.$shipment['sender_name'].'
							</td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/address.png" width="120"></td>
							<td style="color:#6c6c6c;font-size:10px !important" align="right">'.$shipment['source_address'].'</td>
						</tr>
						<tr>
							<td style="color:#6c6c6c;font-size:10px !important">&nbsp;Area</td>
							<td style="color:#6c6c6c;font-size:10px !important" align="right">'.$shipment['area'].'</td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/cont-no.png" width="120"></td>
							<td style="color:#6c6c6c;font-size:10px !important" align="right">'.$shipment['sender_mobile'].'</td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/city.png" width="120"></td>
							<td style="color:#6c6c6c;font-size:10px !important" align="right">'.$city['name'].'</td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/country.png" width="120"></td>
							<td style="color:#6c6c6c;font-size:10px !important" align="right">Saudi Arabia</td>
						</tr>';
						$html.='<tr>
								<td><img src="Invoice_Png_Files/vat.no.png" width="120"></td>
								<td style="color:#6c6c6c;font-size:10px !important" align="right">'.$sender_vat.'</td>
							</tr>';
						$html.='<tr>
								<td style="color:#6c6c6c;font-size:10px !important">&nbsp;IQAMA No.</td>
								<td style="color:#6c6c6c;font-size:10px !important" align="right">'.$sender_iqama.'</td>
							</tr>';
						$html.='
					
				</table>
			</div>
			<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;float:right;color:#000000;padding-right:0px !important;padding-left:2px !important;float:right">
				<table  class="table " style="width:100%;background-color:#f4f3f2;color:#000000;">
					<tr>
						<td><img src="Invoice_Png_Files/name.png" width="120">/</td>
						<td style="text-align:left;color:#6c6c6c;font-size:10px !important">'.$shipment['desti_name'].'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/address.png" width="120"></td>
						<td style="text-align:left;color:#6c6c6c;font-size:10px !important">'.$shipment['destination_address'].'</td>
					</tr>
					<tr>
						<td style="color:#6c6c6c;font-size:10px !important">&nbsp;Area</td>
						<td style="text-align:left;color:#6c6c6c;font-size:10px !important">'.$shipment['desti_landmark'].'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/cont-no.png" width="120"></td>
						<td style="text-align:left;color:#6c6c6c;font-size:10px !important">'.$shipment['desti_mobile'].'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/city.png" width="120"></td>
						<td style="text-align:left;color:#6c6c6c;font-size:10px !important">'.$dcity['name'].'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/country.png" width="120"></td>
						<td style="float:right;verticle-align:middel;color:#6c6c6c;font-size:10px !important">Saudi Arabia</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/vat.no.png" width="120"></td>
						<td style="text-align:left;color:#6c6c6c;font-size:10px !important">'.$rcv_vat.'</td>
					</tr>
					<tr>
						<td style="color:#6c6c6c;font-size:10px !important">&nbsp;IQAMA No.</td>
						<td style="text-align:left;color:#6c6c6c;font-size:10px !important">'.$rcv_iqama.'</td>
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
						<th><img src="Invoice_Png_Files/SL NUMBER.png" width="35"></th>
						<th><img src="Invoice_Png_Files/itemdescri.png" width="100"></th>
						<th><img src="Invoice_Png_Files/Qty.png" width="20"></th>
						<th><img src="Invoice_Png_Files/Unit.png" width="20"></th>
						<th><img src="Invoice_Png_Files/Discount-1.png" width="45"></th>
						<th><img src="Invoice_Png_Files/VAT 15%.png" width="40"></th>
						<th><img src="Invoice_Png_Files/Amount.png" width="40"></th>
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
								<td>'.$i.'</td>
								<td>'.$b['type_of_product'].'</td>
								
								<td style="text-align:center;">'.$b['no_of_package'].'</td>
								<td style="text-align:center;">'.$b['price'].'</td>
								<td style="text-align:center;">';
								if($b['discount']==""){
									$html.='-';
								}
								else{
				
									$html.=''.$b['discount'].'%';
								}
								$html.='</td>
								<td style="text-align:center;">15%</td>
								<td style="text-align:center;">'.$b['total_amount'].'</td>
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
						<td style="background-color:#ffffff;color:#ffffff">Sender’s Name : '.$shipment['sender_name'].'</td>
						<td style="background-color:#ffffff;color:#ffffff">Receiver’s Name : '.$shipment['desti_name'].'</td>
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
						<td><img src="Invoice_Png_Files/Total ( Excluding VAT ).png" width="200" height="20">  </td>
						<td style="text-align:center;">'.($shipment['subtotal_val']+$disnt).'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/Discount.png" width="50">  </td>
						<td style="text-align:center;">'.$disnt.'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/Total ( Excluding VAT ).png" width="200" height="20">  </td>
						<td style="text-align:center;">'.($shipment['subtotal_val']).'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/Total VAT.png" width="55" >(15 %)</td>
						<td style="text-align:center;">'.$shipment['vattotal_val'].'</td>
					</tr>
					<tr style="background-color:#cccccc">
						<td><img src="Invoice_Png_Files/Total Amount Due.png" width="100" height="22"> </td>';
						if($mode_of_payment=='Cash' || $mode_of_payment=='Bank Transfer')
							$html.='<td style="text-align:center;">0</td>';
						else
							$html.='<td style="text-align:center;">'.$shipment['finaltotal_val'].'</td>
					</tr>
					
				</table>
	
	</div>

	<div class="row" style="margin-top:11%;margin-left:14px">
	<img src="Invoice_Png_Files/terms and conditions.png" style="height:155px;width:740px">
	</div>
	<div style="margin-top:30px;">
		<img src="Invoice_Png_Files/Signature _.png" width="120"  style="float:left;"> 
		<img src="Invoice_Png_Files/Signature _.png" width="120" style="float:right;margin-right:10px">
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
	


		$output = $dompdf->output();
		file_put_contents('_private_content_shipment/l_'.$shipment['invoice_number'].'.pdf', $output);
	
	}
    header("location:".$site_url."invoice");
    exit;
}
?>
