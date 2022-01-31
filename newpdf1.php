<?php include('connection.php');
include ("query.php");
//include("header.php"); 
include 'phpqrcode/qrlib.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$delivery_date=$delivery_date." ".$delivery_time;
$pickup_date=$pickup_date." ".$pickup_time;

$row=select_query("*","shipment", array("id="=>$_GET['iid']), "id asc");

if($row->num_rows)
{
	while($bc=$row->fetch_array())
    {	  
		$last_id=$bc['id'];


	 	//generate pdf
		$adm=fetch_query("*", "`myadmin`", array("id="=>1));
		$logo=$adm['logo'];
		$mobile=$adm['mobile_1'];
		$address=$adm['address']; 
		
		//$adm=fetch_query("*", "`myadmin`", array("id="=>$_POST['sender_id']));
		//$city=fetch_query("*", "`location`", array("location_id="=>$_POST['source_city']));
		$vat=fetch_query("*", "`customers`", array("name="=>$bc['sender_name']));
		//$dcity=fetch_query("*", "`location`", array("location_id="=>$_POST['destination_city']));
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
					$tax_invoice_type='<span class="titlecls" style="font-weight:bold;font-size:20px !important">SIMPLIFIED TAX INVOICE</span>';
				}
				
			}
			else
			{
				if($shipment['sender_taxtype']=="Vat"){
					$tax_invoice_type='<span class="titlecls">TAX INVOICE</span>';
				}
				else{
					$tax_invoice_type='<span class="titlecls" style="font-weight:bold;font-size:20px !important">SIMPLIFIED TAX INVOICE</span>';
				}
			}
			$html.='<div class="col-md-6" align="right" style="padding-left:70px;width:20%;display:inline-block;margin-botton:1%;padding-top:50px">'.$tax_invoice_type.'Consignment No.: '.$qrget['consignment_no'].'</div>
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
					<tr><td style="width:25%;font-weight:bold"><img src="Invoice_Png_Files/Invoice-Date.jpg" width="160"></td><td style="width:80%;font-weight:bold;font-size:15px !important" align="right">'.$shipment['invoice_date'].'</td></tr>
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
							<td><img src="Invoice_Png_Files/values_of_goods.jpg" width="90" style="margin-bottom:2px"> 
							<br>
							<img src="Invoice_Png_Files/delivery_cost.jpg" width="90" style="margin-bottom:7px"> 
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
						<th><img src="Invoice_Png_Files/SL-NUMBER.jpg" width="35"></th>
						<th><img src="Invoice_Png_Files/itemdescri.png" width="100"></th>
						<th><img src="Invoice_Png_Files/Qty.jpg" width="20"></th>
						<th><img src="Invoice_Png_Files/Unit.jpg" width="20"></th>
						<th><img src="Invoice_Png_Files/Discount-1.jpg" width="45"></th>
						<th><img src="Invoice_Png_Files/VAT-15%.jpg" width="40"></th>
						<th><img src="Invoice_Png_Files/Amount.jpg" width="40"></th>
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
				
							$disnt+=((float)$uprice * (float)$b['discount'])/100;
							$txx=((float)$uprice * (float)$b['tax'])/100;
				
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
						<td><img src="Invoice_Png_Files/Total-(-Excluding-VAT-).jpg" width="200" height="20">  </td>
						<td style="text-align:center;">'.($shipment['subtotal_val']+$disnt).'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/Discount.jpg" width="50">  </td>
						<td style="text-align:center;">'.$disnt.'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/Total-(-Excluding-VAT-).jpg" width="200" height="20">  </td>
						<td style="text-align:center;">'.($shipment['subtotal_val']).'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/Total-VAT.jpg" width="55" >(15 %)</td>
						<td style="text-align:center;">'.$shipment['vattotal_val'].'</td>
					</tr>
					<tr style="background-color:#cccccc">
						<td><img src="Invoice_Png_Files/Total-Amount-Due.jpg" width="100" height="22"> </td>';
						if($mode_of_payment=='Cash' || $mode_of_payment=='Bank Transfer')
							$html.='<td style="text-align:center;">0</td>';
						else
							$html.='<td style="text-align:center;">'.$shipment['finaltotal_val'].'</td>';
					$html.='</tr>
					</table></div>
	<div class="row" style="margin-top:20%;margin-left:14px">
		<img src="Invoice_Png_Files/terms-and-conditions.jpg" style="height:155px;width:740px">
	</div>
	<div style="margin-top:30px;">
		<img src="Invoice_Png_Files/Signature-_.jpg" width="120"  style="float:left;"> 
		<img src="Invoice_Png_Files/Signature-_.jpg" width="120" style="float:right;margin-right:10px">
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
	/*
	<img src="Invoice_Png_Files/Signature _.png" width="120"  style="float:left"> 
	<img src="Invoice_Png_Files/Signature _.png" width="120" style="float:right"> 
	echo $html;
	exit;	*/
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
		file_put_contents('_private_content_shipment/==l_new.pdf', $output);
	}
}
?>
