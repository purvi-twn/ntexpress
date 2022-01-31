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

 $html = '<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<style>
		@import url("https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic&family=Noto+Sans:wght@700&display=swap");
		.arrabic{ font-family: "Noto Sans Arabic", sans-serif; }
		.txt{ font-family: "Noto Sans", sans-serif; }
		body{ font-family: "Noto Sans", sans-serif;}
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
		</style>
		</head>
		
		<body style="font-family:Arial">
		  <div class="row" >
        	<div class="col-md-6" style="padding:0px;width:44%;display:inline-block;margin-botton:1%">
				<div><span class="titlecls txt">TAX INVOICE</span></div>
				<div><h6>NATIONAL EXPRESS TRANSPORT COMPANY</h6></div>
				<div>Ibn Al-Ameed Road, Al-Sulay</div>
				<div>P.O Box : 24117, Al-Riyadh 14273, KSA</div>
				<div style="font-weight: bold;">CR No: 1010352157</div>
				<div style="font-weight: bold;">VAT No. : 1234567890</div>
			</div>
			<div class="col-md-6 arrabic" align="right">
				 تهم الاغتيال لجماعة الإخوان المسلمين
			</div>
			</div>
		 
		<div class="row">
			<div class="col-md-5" style="border:1px solid gray;padding: 10px;background-color:#f4f3f2;width:44%;display:inline-block;">
				<table style="width:100%;">
					<tr><td style="width:25%;font-weight:bold">Invoice No</td><td style="width:80%;font-weight:bold" align="right">123456</td></tr>
				</table>
			</div>
			<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;padding: 10px;background-color:#f4f3f2;width:44%;display:inline-block;float:right">
				<table style="width:100%">
					<tr><td style="width:25%;font-weight:bold">Invoice Date</td><td style="width:80%;font-weight:bold" align="right">'.date('d-F-Y').'</td></tr>
				</table>
			</div>
		</div>
		<div class="row" style="margin-top:1%">
			<div class="col-md-5" style="border:1px solid gray;padding: 10px;background-color:#000000;width:44%;display:inline-block;color:#ffffff">
				<table style="width:100%;background-color:#000000;color:#ffffff">
					<tr><td style="width:40%;font-weight:bold">Payment Method</td><td style="width:45%;font-weight:bold" align="right"></td></tr>
				</table>
			</div>
			<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;padding: 10px;background-color:#000000;width:44%;display:inline-block;float:right;color:#ffffff">
				<table style="width:100%;background-color:#000000;color:#ffffff">
					<tr><td style="width:40%;font-weight:bold">Special Delivery</td><td style="width:45%;font-weight:bold" align="right"></td></tr>
				</table>
			</div>
		</div>
		
		<div class="row" style="margin-top:1%">
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important">
				<table class="table"> 
					<tbody>
						<tr>
							<td>Cash</td>
							<td> <input type="checkbox"> </td>
							<td style="text-align:center;"></td>
							
						</tr>
						<tr>
							<td>COD</td>
							<td><input type="checkbox"> </td>
							<td style="text-align:center;"></td>
							
						</tr>
						<tr>
							<td>Bank Transfer</td>
							<td><input type="checkbox"> </td>
							<td style="text-align:center;"></td>
							
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
							<td>Cash</td>
							<td> <input type="checkbox"> </td>
							<td style="text-align:center;"></td>
							
						</tr>
						<tr>
							<td>COD</td>
							<td><input type="checkbox"> </td>
							<td style="text-align:center;"></td>
							
						</tr>
						<tr>
							<td>Bank Transfer</td>
							<td><input type="checkbox"> </td>
							<td style="text-align:center;"></td>
							
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td style="text-align:center;">&nbsp;</td>
							
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="row" style="margin-top:1%">
			<div class="col-md-5" style="border:1px solid gray;padding: 10px;background-color:#000000;width:44%;display:inline-block;color:#ffffff">
				<table style="width:100%;background-color:#000000;color:#ffffff">
					<tr><td style="width:40%;font-weight:bold">Sender’s Details</td><td style="width:45%;font-weight:bold" align="right"></td></tr>
				</table>
			</div>
			<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;padding: 10px;background-color:#000000;width:44%;display:inline-block;float:right;color:#ffffff">
				<table style="width:100%;background-color:#000000;color:#ffffff">
					<tr><td style="width:40%;font-weight:bold">Receiver’s Details</td><td style="width:45%;font-weight:bold" align="right"></td></tr>
				</table>
			</div>
		</div>
		
		<div class="row" style="margin-top:1%">
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important">
				<table class="table"> 
					<tbody>
						<tr>
							<td>Sender’s Name</td>
							<td style="text-align:center;"></td>
						</tr>
						<tr>
							<td>Address</td>
							<td style="text-align:center;"></td>
						</tr>
						<tr>
							<td>Contact No</td>
							<td style="text-align:center;"></td>
						</tr>
						<tr>
							<td>City</td>
							<td style="text-align:center;"></td>
						</tr>
						<tr>
							<td>Country</td>
							<td style="text-align:center;"></td>
						</tr>
						<tr>
							<td>VAT No.</td>
							<td style="text-align:center;"></td>
						</tr>
						<tr style="background-color:#ffffff">
							<td style="background-color:#ffffff">Signature </td>
							<td style="text-align:center;background-color:#ffffff"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;float:right;color:#000000;padding-right:0px !important;padding-left:2px !important;float:right">
				<table class="table" style="width:100%;background-color:#f4f3f2;color:#000000;">
					<tr>
						<td>Receiver’s Details</td>
						<td style="text-align:center;"></td>
					</tr>
					<tr>
						<td>Receiver’s Name/</td>
						<td style="text-align:center;"></td>
					</tr>
					<tr>
						<td>Address</td>
						<td style="text-align:center;"></td>
					</tr>
					<tr>
						<td>Contact No.</td>
						<td style="text-align:center;"></td>
					</tr>
					<tr>
						<td>City</td>
						<td style="text-align:center;"></td>
					</tr>
					<tr>
						<td>Country</td>
						<td style="text-align:center;"></td>
					</tr>
					<tr style="background-color:#ffffff">
						<td style="background-color:#ffffff">Signature </td>
						<td style="text-align:center;background-color:#ffffff"></td>
					</tr>
				</table>
			</div>
		</div>
		
		
		
		<style>
			thead tr th{ background-color: #000; font-size: 14px; text-align:center;color:#ffffff }
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
			<th>VAT 15%</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>1</td>
			<td>SA-TNG-68801</td>
			<td style="text-align:center;">15.00</td>
			<td style="text-align:center;">5</td>
			<td style="text-align:center;">15%</td>
			<td style="text-align:center;">21.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>SA-TNG-68801</td>
			<td style="text-align:center;">15.00</td>
			<td style="text-align:center;">5</td>
			<td style="text-align:center;">15%</td>
			<td style="text-align:center;">21.00</td>
		</tr>
	</tbody>
	</table></div></div>
	<div class="row" style="margin-top:1%">
			<div class="col-md-6" style="border:1px solid gray;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important">
				<table class="table">
					<thead>
						<tr>
							<th colspan="2">Received in Good Condition</th>
						</tr>
					</thead>
					<tbody style="background-color:#f4f3f2">
					<tr>
						<td>Sender’s Name</td>
						<td>Receiver’s Name</td>
					</tr>
					<tr>
						<td>ID No</td>
						<td>ID No</td>
					</tr>
					<tr style="background-color:#ffffff;border:0px;">
						<td rowspan="3" style="border:0px;">Signature</td>
						<td rowspan="3" style="border:0px;">Signature</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;float:right;color:#000000;padding-right:0px !important;padding-left:2px !important;float:right">
				<table class="table " style="width:100%;background-color:#f4f3f2;color:#000000;">
					<tr>
						<td>Total (Excluding VAT)  </td>
						<td style="text-align:center;"> 0.00</td>
					</tr>
					<tr>
						<td>Discount</td>
						<td style="text-align:center;">0.00</td>
					</tr>
					<tr>
						<td>Total Taxable Amount (Excluding VAT)</td>
						<td style="text-align:center;">0.00</td>
					</tr>
					<tr>
						<td>Total VAT</td>
						<td style="text-align:center;">0.00</td>
					</tr>
					<tr style="background-color:#cccccc">
						<td>Total Amount Due</td>
						<td style="text-align:center;">0.00</td>
					</tr>
					
				</table>
	
	</div>
	
	<div class="row" style="margin-top:12%">
			<div class="col-md-12" style="border:1px solid gray;padding: 10px;background-color:#000000;width:93%;display:inline-block;color:#ffffff;margin-left:16px" align="center">
				<table style="width:100%;background-color:#000000;color:#ffffff">
					<tr><td style="width:40%;font-weight:bold">Transportation Terms & Conditions</td><td style="width:45%;font-weight:bold" align="right">Transportation Terms & Conditions</td></tr>
				</table>
			</div>
			<div class="row" style="background-color:#ffffff;color:#000000;margin-left:3px">
					<div class="col-md-5" style="width:43.5%;display:inline-block;color:#000000;padding-left:15px !important;">
					1. It is forbidden to ship cash, gold and medicines. <br>
					2. The Transport is not responsible for any damage or damage to any broken goods, traffic accidents, fire on the road, during loading, or natural disasters.<br>
					3. Maximum compensation for the loss of any consignment, the value of the consignment, or a maximum of (100) one hundred riyals, unless otherwise agreed upon.<br>
					4. The Transport is not responsible for the content of any policy.<br>
					5. The Transport is not responsible for any policy that the owner has not received after Twenty One(21) days have passed.<br>
					6. Receiving and Signing the policy copy as acceptance of all the Transport conditions.<br>
					7. The right to suspend any consignments that it becomes clear to the Transport that they violate the conditions of the Transport.<br>
					8. The agreed period of transport is five days, and the sender has no tight to complain before that period. <br>
					</div>
					<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
					<div class="col-md-5" style="width:43%;display:inline-block;float:right;color:#000000;padding-right:10px !important;float:right">
						1. It is forbidden to ship cash, gold and medicines. <br>
						2. The Transport is not responsible for any damage or damage to any broken goods, traffic accidents, fire on the road, during loading, or natural disasters.<br>
						3. Maximum compensation for the loss of any consignment, the value of the consignment, or a maximum of (100) one hundred riyals, unless otherwise agreed upon.<br>
						4. The Transport is not responsible for the content of any policy.<br>
						5. The Transport is not responsible for any policy that the owner has not received after Twenty One(21) days have passed.<br>
						6. Receiving and Signing the policy copy as acceptance of all the Transport conditions.<br>
						7. The right to suspend any consignments that it becomes clear to the Transport that they violate the conditions of the Transport.<br>
						8. The agreed period of transport is five days, and the sender has no tight to complain before that period. <br>
					</div>
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

