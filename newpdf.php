<?php include('connection.php');
include ("query.php");
$adm=fetch_query("*", "`myadmin`", array("id="=>1));
$logo=$adm['logo'];
$mobile=$adm['mobile_1'];
$address=$adm['address']; 

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

/*$dompdf->loadHtml($html, 'UTF-8');
$dompdf->set_option('defaultMediaType', 'all');
$dompdf->set_option('isFontSubsettingEnabled', true);*/



/*<div style="font-size: 35px;font-weight: bold;">اتورة   ضريبية</div>
				<div style="font-size: 14px;font-weight: bold;">شركة   الوطني   السريع   للنقليات</div>
				<div>طريق ابن العميد ، السلي</div> 
				<div> المملكة العربية السعودية14273:الرياض   24117:صندوق بريد</div>
				<div style="font-weight: bold;">1010352157 : رقم السجل التجاري</div>
				<div style="font-weight: bold;">1234567890 : رقم ضريبة القيمة المضافة </div>
				
				body {
			font-size:12px !important;
			font-style: normal;
			font-weight: normal;
			src: url("https://fonts.googleapis.com/css2?family=Open+Sans&display=swap");
			
		  }                                                                                                                                                                                                                                             
				*/                                                                                                                                                                                                                                           
				

 $html = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<style type="text/css">
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
			margin-bottom:10px
		}
		
		body {
			font-size:12px !important;
			font-family:"Open Sans", sans-serif;
			  font-style: normal;
			  font-weight: normal;
			  src: url("https://fonts.googleapis.com/css2?family=Open+Sans&display=swap");
		  }
		  .titlecls
		  {
			  font-size:20px !important;
			  font-weight:bold !important;
			  margin-bottom:0px !important;
		   }
		  h6
		  {
			  font-size:12px !important;
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
			
		</style>
		<html>
		  <head>
		  </head>
		
		<body style="font-family:Arial">
		  <div class="row" >
        	<div class="col-md-6" style="padding:0px;width:30%;display:inline-block;margin-botton:1%">';
        	$html.='<div><span class="titlecls">TAX INVOICE</span></div>';
			$html.='<div><h6>NATIONAL EXPRESS TRANSPORT COMPANY</h6></div>
				<div>Ibn Al-Ameed Road, Al-Sulay</div>
				<div>P.O Box : 24117, Al-Riyadh 14273, KSA</div>
				<div style="font-weight: bold;">CR No: 1010352157</div>';
				$html.='<div style="font-weight: bold;">VAT No. : </div>';
			$html.='</div>
			<div class="col-md-6" align="right" style="padding-left:70px;width:20%;display:inline-block;margin-botton:1%;padding-top:50px">Consignment No.: 124425</div>
			<div class="col-md-6" align="right" style="padding:0px;width:30%;display:inline-block;margin-botton:1%;float:right">
				<img src="Invoice_Png_Files/TAX INVOICE ARABIC.png" width="200" height="150" style="float:right">
			</div>
			</div>
		 
		<div class="row">
			<div class="col-md-5" style="border:1px solid gray;padding: 10px;background-color:#f4f3f2;width:44%;display:inline-block;">
				<table style="width:100%;">
					<tr><td style="width:25%;font-weight:bold"><img src="Invoice_Png_Files/Invoice Number.png" width="120" height="20"></td><td style="width:80%;font-weight:bold" align="right"></td></tr>
				</table>
			</div>
			<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;padding: 10px;background-color:#f4f3f2;width:44%;display:inline-block;float:right">
				<table style="width:100%">
					<tr><td style="width:25%;font-weight:bold"><img src="Invoice_Png_Files/Invoice Date.png" width="120" height="20"></td><td style="width:80%;font-weight:bold" align="right"></td></tr>
				</table>
			</div>
		</div>
		<div class="row" style="margin-top:2px">
			<div class="col-md-5" style="border:1px solid gray;padding:5px 10px;background-color:#3c3d3a;width:44%;display:inline-block;">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Files/payment_method.png" width="330" height="30"></td></tr>
				</table>
			</div>
			<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;padding:5px 10px;background-color:#3c3d3a;width:44%;display:inline-block;float:right;">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Files/Special_Delivery.png" width="330" height="30"></td></tr>
				</table>
			</div>
		</div>
		
		<div class="row" style="margin-top:1%">
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important">
				<table class="table"> 
					<tbody>
						<tr>
							<td>Cash</td>
							<td> <img src="Invoice_Png_Files/checkbox.png" width="100" height="10"> </td>
							<td style="text-align:right;"><img src="Invoice_Png_Files/cash.png" width="70"></td>
							
						</tr>
						<tr>
							<td>COD</td>
							<td><input type="checkbox"> </td>
							<td style="text-align:right;"><img src="Invoice_Png_Files/cod.png" width="70""></td>
							
						</tr>
						<tr>
							<td>Bank Transfer</td>
							<td><input type="checkbox"> </td>
							<td style="text-align:right;"><img src="Invoice_Png_Files/web.png" width="70"></td>
							
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td style="text-align:center;">&nbsp;</td>
							
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:2px !important;float:right">
				<table class="table"> 
					<tbody>
						<tr>
							<td rowspan="2"><img src="qrcode/61a867b1cebaf.png" width="90" style="vergicle-align=middle"></td>
							<td colspan="2"><img src="Invoice_Png_Files/officedelivery.png" width="220" height="50"> 
							</td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/values_of_goods.png" width="90">
							<br><br>
							<img src="Invoice_Png_Files/delivery_cost.png" width="90" >
							</td>
							<td style="text-align:center;"></td>
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="row" style="margin-top:1%">
			<div class="col-md-5" style="border:1px solid gray;padding:5px 10px;background-color:#3c3d3a;width:44%;display:inline-block;color:#ffffff">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Files/Sender’s Details.png" width="330" height="30"></td></tr>
				</table>
			</div>
			<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;padding:5px 10px;background-color:#3c3d3a;width:44%;display:inline-block;float:right;color:#ffffff">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Files/Receiver’s Details.png" width="330" height="30"></td></tr>
				</table>
			</div>
		</div>
		
		<div class="row" style="margin-top:1%">
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important">
				<table class="table"> 
					
						<tr>
							<td>Sender’s Name</td>
							<td style="text-align:center;"></td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/Address _.png" width="100"></td>
							<td style="text-align:center;"></td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/Contact No_.png" width="100" ></td>
							<td style="text-align:center;"></td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/City _.png" width="70" ></td>
							<td style="text-align:center;"></td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/Country _.png" width="100" ></td>
							<td style="text-align:center;">Saudi Arabia</td>
						</tr>';
						
							$html.='<tr>
								<td><img src="Invoice_Png_Files/VAT No. _.png" width="100"></td>
								<td style="text-align:center;"></td>
							</tr>';
					
						
						$html.='<tr style="background-color:#ffffff;">
							<td style="background-color:#ffffff"><img src="Invoice_Png_Files/Signature _.png" width="120" height="15"> </td>
							<td style="text-align:center;background-color:#ffffff"></td>
						</tr>
						
					
				</table>
			</div>
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;float:right;color:#000000;padding-right:0px !important;padding-left:2px !important;float:right">
				<table class="table " style="width:100%;background-color:#f4f3f2;color:#000000;">
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
						<td style="text-align:center;">'.($shipment['subtotal_val']-$disnt).'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/Total VAT.png" width="80" height="18">'.$final_vat.' %</td>
						<td style="text-align:center;">'.$shipment['vattotal_val'].'</td>
					</tr>
					<tr style="background-color:#cccccc">
						<td><img src="Invoice_Png_Files/Total Amount Due.png" width="100" height="22"> </td>
						<td style="text-align:center;">'.$shipment['finaltotal_val'].'</td>
					</tr>
					
				</table>
	
	</div>
		</div>
		<style>
			thead tr th{ background-color: #3c3d3a; font-size: 14px; text-align:center;color:#ffffff }
			table tr td{ font-size: 14px; }
		</style>
		
		
		<style>
			thead tr th{ background-color: #3c3d3a; font-size: 14px; text-align:center;color:#ffffff }
			table tr td{ font-size: 14px; }
		</style>
		<div class="row" style="margin-top:1%">
			<div class="col-md-12" style="border:1px solid gray;width:100%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important">
				<table class="table table-bordered">
		 
	<thead>
		<tr>
			<th>SL NO</th>
			<th>Item & DESCRIPTION</th>
			<th>UNIT</th>
			<th>QTY</th>
			<th>DISCOUNT</th>
			<th>VAT 15%</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>';

	
	  		
			$html.='<tr>
				<td></td>
				<td></td>
				<td style="text-align:center;"></td>
				<td style="text-align:center;"></td>
				<td style="text-align:center;">%</td>
				<td style="text-align:center;">%</td>
				<td style="text-align:center;"></td>
			</tr>';
			

			
		
	$html.='</tbody>
	</table></div></div>
	<div class="row" style="margin-top:1%">
			<div class="col-md-6" style="border:1px solid gray;width:46%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important">
				<table class="table">
					<thead>
						<tr>
							<th colspan="2">Received in Good Condition</th>
						</tr>
					</thead>
					<tbody style="background-color:#f4f3f2">
					<tr>
						<td>Sender’s Name:</td>
						<td>Receiver’s Name:</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/ID No. _.png" width="70">:</td>
						<td><img src="Invoice_Png_Files/ID No. _.png" width="70">:</td>
					</tr>
					<tr style="background-color:#ffffff;border:0px;">
						<td rowspan="2" style="border:0px;"><img src="Invoice_Png_Files/Signature _.png" width="80" height="20"></td>
						<td rowspan="2" style="border:0px;"><img src="Invoice_Png_Files/Signature _.png" width="80" height="20"></td>
					</tr>
					<tr></tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;float:right;color:#000000;padding-right:0px !important;padding-left:2px !important;float:right;vertical-align:top">
				<table class="table " style="width:100%;background-color:#f4f3f2;color:#000000;vertical-align:top">
					<tr>
						<td><img src="Invoice_Png_Files/Total ( Excluding VAT ).png" width="200" height="20"> </td>
						<td style="text-align:center;"></td>
					</tr>
					
					<tr>
						<td><img src="Invoice_Png_Files/Total Taxable Amount (Excluding VAT).png" width="200" height="20"></td>
						<td style="text-align:center;"></td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/Total VAT.png" width="100" height="20"></td>
						<td style="text-align:center;">%</td>
					</tr>
					<tr style="background-color:#cccccc">
						<td><img src="Invoice_Png_Files/Total Amount Due.png" width="100" height="20"> </td>
						<td style="text-align:center;"></td>
					</tr>
					
				</table>
	
	</div>
	
	<div class="row" style="margin-top:5%;margin-left:2px">
	<img src="Invoice_Png_Files/terms and conditions.png" height="260">
	</div>	
			
				<hr>
				<div class="row">
					<div class="col-md-2" style="display:inline-block;color:#000000;width:16%">
					</div>
					<div class="col-md-2" style="display:inline-block;color:#000000;width:16%">www.ntexpress.sa 
					</div>
					<div class="col-md-2" style="display:inline-block;color:#000000;width:16%">info@ntexpress.sa
					</div>
					<div class="col-md-3" style="display:inline-block;color:#000000;width:24%">920019908 | 011 2700300
					</div>
					<div class="col-md-1" style="display:inline-block;color:#000000;width:8%">
					</div>
				</div>
		</div>
		
	 </body>
		</html>';  
$dompdf->loadHtml($html,'UTF-8');

// (Optional) Setup the paper size and orientation
//$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
//$dompdf->set_option('defaultMediaType', 'all');
//$dompdf->set_option('isFontSubsettingEnabled', true);
	
$dompdf->render();
ob_end_clean();
// Output the generated PDF to Browser
  //  $dompdf->stream();
$filename = "newpdffile";
$dompdf->stream($filename,array("Attachment"=>0));

