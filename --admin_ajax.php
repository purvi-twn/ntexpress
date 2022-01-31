<?php include("connection.php");
include("query.php");

include 'phpqrcode/qrlib.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

if($_REQUEST['action']=='get_report')
{
	if($_GET["report"]=='Outgoin')
	{
		$draw = $_POST['draw'];
		$row = $_POST['start'];
		$rowperpage = $_POST['length']; // Rows display per page
		$columnIndex = $_POST['order'][0]['column']; // Column index
		$columnName = 'invoice_date'; // Column name
		$columnSortOrder = 'asc'; // asc or desc
		$searchQuery = "";
		
		
		## Total number of records without filtering
		$sel = mysqli_query($dlink,"select count(*) as allcount from shipment");
		$records = mysqli_fetch_assoc($sel);
		$totalRecords = $records['allcount'];
	
		## Total number of records with filtering
		$sel = mysqli_query($dlink,"select count(*) as allcount from shipment WHERE 1".$searchQuery);
		$records = mysqli_fetch_assoc($sel);
		$totalRecordwithFilter = $records['allcount'];
	
		## Fetch records
		$from_date=''; $to_date='';
		if($_POST['from_date']!='');
			$from_date=date('Y-m-d',strtotime($_GET['from_date']));
		if($_POST['to_date']!='');
			$to_date=date('Y-m-d',strtotime($_GET['to_date']));
		
		$source_state=$_GET['source_state'];
		$source_city=$_POST['source_city'];
		
		$destination_state=$_GET['destination_state'];
		$destination_city=$_GET['destination_city'];


		
		$qry="SELECT * FROM `shipment` WHERE 1 ";
		
		if($source_state!='' && $source_state!=0)
			$qry.=" and source_state='$source_state'";
		if($source_city!='' && $source_city!=0)
			$qry.=" and source_city='$source_city'";
		if($destination_state!='' && $destination_state!=0)
			$qry.=" and destination_state='$destination_state'";
		if($destination_city!='' && $destination_city!=0)
			$qry.=" and destination_city='$destination_city'";
		if($from_date == $to_date)
			$qry.=" and date(invoice_date)='$from_date'";
		elseif($from_date!='' && $to_date!='' && $from_date!='1970-01-01' && $to_date!='1970-01-01')
			$qry.=" and (invoice_date BETWEEN '$from_date' AND '$to_date')";
		
		$qry.=" order by invoice_date asc";
	    //echo $qry;
		
		$empRecords = mysqli_query($dlink, $qry);
		$data = array();
		$no=1;
		/*if(mysqli_num_rows($empRecords)>0)
		{
			$total_cash=0;
			$total_fc=0;
			$total_amount=0;
			while($R=mysqli_fetch_assoc($empRecords))
			{
				$data[] = array(
					
					"sr_no"=>$no,
					"date"=>date('d-M-Y',strtotime($R["invoice_date"])),
					"cash"=>$R['payment_cash'],
					"fc"=>$R['payment_fc'],
					"total"=>$R['total_amount'],
				);
				$total_cash=$total_cash+$R['payment_cash'];
				$total_fc=$total_fc+$R['payment_fc'];
				$total_amount=$total_amount+$R['total_amount'];
				$no++;	
			}
			$data[] = array(
					
					"sr_no"=>' ',
					"date"=>' <b>Total</b>',
					"cash"=>$total_cash,
					"fc"=>$total_fc,
					"total"=>$total_amount,
				);
		}
		//$data[] = array("sr_no"=>$qry.'---'); 
	
		## Response
	
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);
		echo json_encode($response);*/
		if(mysqli_num_rows($empRecords)>0)
		{
			$total_cash=0;
			$total_fc=0;
			$total_amount=0;
			$total_qnty=0;
			while($R=mysqli_fetch_assoc($empRecords))
			{
				$sel_detail = mysqli_query($dlink,"select SUM(no_of_package) as allcount from shipment_detail WHERE 1 and oid=".$R['id']);
				$records_detail = mysqli_fetch_assoc($sel_detail);
				
				$cash=0;
				$cod=0;
				if($R['mode_of_payment']=='Cash')
					//$cash=$R['subtotal_val']; kk 6-1-2022
					$cash=$R['finaltotal_val'];
				if($R['mode_of_payment']=='COD')
					//$cod=$R['subtotal_val']; kk 6-1-2022
					$cod=$R['finaltotal_val'];
						
				$data['data'][] = array(
					
					"sr_no"=>$no,
					"date"=>date('d-M-Y',strtotime($R["invoice_date"])),
					"invoice_number"=>$R['invoice_number'],
					"sales_person"=>ucfirst($R['sales_person']),
					"cash"=>$cash,
					"cod"=>$cod,
					"qnty"=>$records_detail['allcount'],
					"total"=>$R['finaltotal_val'],
					"driver"=>"",
					"vehicle"=>"",
				);
				$total_cash=$total_cash+$cash;
				$total_fc=$total_fc+$cod;
				$total_amount=$total_amount+$R['finaltotal_val'];
				$total_qnty=$total_qnty+$records_detail['allcount'];
				$no++;	
			}
			$data['data'][] = array(
					
					"sr_no"=>' ',
					"date"=>' ',
					"invoice_number"=>' ',
					"sales_person"=>' <b>Total</b>',
					"cash"=>$total_cash,
					"cod"=>$total_fc,
					"qnty"=>$total_qnty,
					"total"=>$total_amount,
					"driver"=>"",
					"vehicle"=>"",
				);
			
		}
		$data['columns'][] = array(
			"data"=>"sr_no",
            "name"=>"SR No"
		);
		$data['columns'][] = array(
			"data"=>"date",
            "name"=>"Date of S/M Received"
		);
		$data['columns'][] = array(
			"data"=>"invoice_number",
            "name"=>"Invoice No."
		);
		$data['columns'][] = array(
			"data"=>"sales_person",
            "name"=>"Sales Person"
		);
		$data['columns'][] = array(
			"data"=>"cash",
            "name"=>"Cash"
		);
		$data['columns'][] = array(
			"data"=>"cod",
            "name"=>"COD"
		);
		$data['columns'][] = array(
			"data"=>"qnty",
            "name"=>"Quantity"
		);
		$data['columns'][] = array(
			"data"=>"total",
            "name"=>"Grand Total"
		);
		$data['columns'][] = array(
			"data"=>"driver",
            "name"=>"Delivery Driver"
		);
		$data['columns'][] = array(
			"data"=>"vehicle",
            "name"=>"Vehicle No."
		);
		echo json_encode($data);
	}
	else if($_GET["report"]=='Delivery')
	{
		$draw = $_POST['draw'];
		$row = $_POST['start'];
		$rowperpage = $_POST['length']; // Rows display per page
		$columnIndex = $_POST['order'][0]['column']; // Column index
		$columnName = 'invoice_date'; // Column name
		$columnSortOrder = 'asc'; // asc or desc
		$searchQuery = "";
		
		
		## Total number of records without filtering
		$sel = mysqli_query($dlink,"select count(*) as allcount from shipment");
		$records = mysqli_fetch_assoc($sel);
		$totalRecords = $records['allcount'];
	
		## Total number of records with filtering
		$sel = mysqli_query($dlink,"select count(*) as allcount from shipment WHERE 1".$searchQuery);
		$records = mysqli_fetch_assoc($sel);
		$totalRecordwithFilter = $records['allcount'];
	
		## Fetch records
		$from_date=''; $to_date='';
		if($_POST['from_date']!='');
			$from_date=date('Y-m-d',strtotime($_GET['from_date']));
		if($_POST['to_date']!='');
			$to_date=date('Y-m-d',strtotime($_GET['to_date']));
		
		$destination_state=$_GET['destination_state'];
		$destination_city=$_GET['destination_city'];
		
		$qry="SELECT * FROM `shipment` WHERE 1 ";
		
		if($destination_state!='' && $destination_state!=0)
			$qry.=" and destination_state='$destination_state'";
		if($destination_city!='' && $destination_city!=0)
			$qry.=" and destination_city='$destination_city'";
		if($from_date == $to_date)
			$qry.=" and date(invoice_date)='$from_date'";
		elseif($from_date!='' && $to_date!='' && $from_date!='1970-01-01' && $to_date!='1970-01-01')
			$qry.=" and (invoice_date BETWEEN '$from_date' AND '$to_date')";
		$qry.=" order by invoice_date asc";
	    //echo $qry;
		
		$empRecords = mysqli_query($dlink, $qry);
		$data = array();
		$no=1;
		
		if(mysqli_num_rows($empRecords)>0)
		{
			$total_cash=0;
			$total_fc=0;
			$total_amount=0;
			$total_qnty=0;
			while($R=mysqli_fetch_assoc($empRecords))
			{
				$dcity=fetch_query("name","location",array("location_id="=>$R['destination_city'],"is_visible="=>0 ));
				
				
				$sel_detail = mysqli_query($dlink,"select SUM(no_of_package) as allcount from shipment_detail WHERE 1 and oid=".$R['id']);
				$records_detail = mysqli_fetch_assoc($sel_detail);
				
				$cash=0;
				$cod=0;
				
				if($R['mode_of_payment']=='Cash')
					//$cash=$R['subtotal_val']; kk 6-1-2022
					$cash=$R['finaltotal_val'];
				if($R['mode_of_payment']=='COD')
					//$cod=$R['subtotal_val']; kk 6-1-2022
					$cod=$R['finaltotal_val'];				
						
				$data['data'][] = array(
					
					"sr_no"=>$no,
					"date"=>date('d-M-Y',strtotime($R["invoice_date"])),
					"time"=>"",
					"invoice_number"=>$R['invoice_number'],
					"destination"=>$dcity['name'],
					"area"=>$R["desti_landmark"],
					"cash"=>$cash,
					"cod"=>$cod,
					"sender_name"=>ucfirst($R["sender_name"]),
					"sender_mobile"=>$R["sender_mobile"],
					"receiver_name"=>ucfirst($R["desti_name"]),
					"receiver_mobile"=>$R["desti_mobile"],
					"qnty"=>$records_detail['allcount'],
					"total"=>$R['finaltotal_val'],
					"idno"=>"",
					"signature"=>"",
				);
				$total_cash=$total_cash+$cash;
				$total_fc=$total_fc+$cod;
				$total_amount=$total_amount+$R['finaltotal_val'];
				$total_qnty=$total_qnty+$records_detail['allcount'];
				$no++;	
			}
			$data['data'][] = array(
					
					"sr_no"=>' ',
					"date"=>' ',
					"time"=>' ',
					"invoice_number"=>' ',
					"destination"=>' ',
					"area"=>' ',
					"cash"=>$total_cash,
					"cod"=>$total_fc,
					"sender_name"=>' ',
					"sender_mobile"=>' ',
					"receiver_name"=>' ',
					"receiver_mobile"=>' <b>Total</b>',
					"qnty"=>$total_qnty,
					"total"=>$total_amount,
					"idno"=>"",
					"signature"=>"",
				);
			
		}
		$data['columns'][] = array(
			"data"=>"sr_no",
            "name"=>"SR No"
		);
		$data['columns'][] = array(
			"data"=>"date",
            "name"=>"Date"
		);
		$data['columns'][] = array(
			"data"=>"time",
            "name"=>"Time"
		);
		$data['columns'][] = array(
			"data"=>"invoice_number",
            "name"=>"Invoice No."
		);
		$data['columns'][] = array(
			"data"=>"destination",
            "name"=>"Destination"
		);
		$data['columns'][] = array(
			"data"=>"area",
            "name"=>"Area"
		);
		$data['columns'][] = array(
			"data"=>"cash",
            "name"=>"Cash"
		);
		$data['columns'][] = array(
			"data"=>"cod",
            "name"=>"COD"
		);
		$data['columns'][] = array(
			"data"=>"sender_name",
            "name"=>"Sender Name"
		);
		$data['columns'][] = array(
			"data"=>"sender_mobile",
            "name"=>"Sender Mobile"
		);
		$data['columns'][] = array(
			"data"=>"receiver_name",
            "name"=>"Receiver Name"
		);
		$data['columns'][] = array(
			"data"=>"receiver_mobile",
            "name"=>"Receiver Mobile"
		);
		$data['columns'][] = array(
			"data"=>"qnty",
            "name"=>"Quantity"
		);
		$data['columns'][] = array(
			"data"=>"total",
            "name"=>"Amount"
		);
		$data['columns'][] = array(
			"data"=>"idno",
            "name"=>"Id No."
		);
		$data['columns'][] = array(
			"data"=>"signature",
            "name"=>"Signature"
		);
		echo json_encode($data);
	}
	else if($_GET["report"]=='Employee')
	{
		$draw = $_POST['draw'];
		$row = $_POST['start'];
		$rowperpage = $_POST['length']; // Rows display per page
		$columnIndex = $_POST['order'][0]['column']; // Column index
		$columnName = 'invoice_date'; // Column name
		$columnSortOrder = 'asc'; // asc or desc
		$searchQuery = "";
		
		
		## Total number of records without filtering
		$sel = mysqli_query($dlink,"select count(*) as allcount from shipment");
		$records = mysqli_fetch_assoc($sel);
		$totalRecords = $records['allcount'];
	
		## Total number of records with filtering
		$sel = mysqli_query($dlink,"select count(*) as allcount from shipment WHERE 1".$searchQuery);
		$records = mysqli_fetch_assoc($sel);
		$totalRecordwithFilter = $records['allcount'];
	
		## Fetch records
		$from_date=''; $to_date='';
		if($_POST['from_date']!='');
			$from_date=date('Y-m-d',strtotime($_GET['from_date']));
		if($_POST['to_date']!='');
			$to_date=date('Y-m-d',strtotime($_GET['to_date']));
		
		$source_branch=$_GET['source_branch'];
		
		
		$qry="SELECT * FROM `shipment` WHERE 1 ";
		
		if($source_branch!=''){
			//	$qry.=" and sales_person='$source_branch'";
			$qry.=" and sales_person LIKE '%".$source_branch."%'";
		}
		if($from_date == $to_date)
			$qry.=" and date(invoice_date)='$from_date'";
		elseif($from_date!='' && $to_date!='' && $from_date!='1970-01-01' && $to_date!='1970-01-01')
			$qry.=" and (invoice_date BETWEEN '$from_date' AND '$to_date')";
		$qry.=" order by invoice_date asc";
	    //echo $qry;
		//exit;
		$empRecords = mysqli_query($dlink, $qry);
		$data = array();
		$no=1;
		
		if(mysqli_num_rows($empRecords)>0)
		{
			$total_cash=0;
			$total_fc=0;
			$total_amount=0;
			$total_qnty=0;
			while($R=mysqli_fetch_assoc($empRecords))
			{
				$dcity=fetch_query("name","location",array("location_id="=>$R['destination_city'],"is_visible="=>0 ));
				
				
				$sel_detail = mysqli_query($dlink,"select SUM(no_of_package) as allcount from shipment_detail WHERE 1 and oid=".$R['id']);
				$records_detail = mysqli_fetch_assoc($sel_detail);
				
				$cash=0;
				$cod=0;
				if($R['mode_of_payment']=='Cash')
					$cash=$R['subtotal_val'];
				if($R['mode_of_payment']=='COD')
					$cod=$R['subtotal_val'];
					
				$data['data'][] = array(
					
					"sr_no"=>$no,
					"date"=>date('d-m-Y',strtotime($R["invoice_date"])),
					"invoice_number"=>$R['invoice_number'],
					"cash"=>$R['payment_cash'],
					"fc"=>$R["payment_fc"],
					"sales_person"=>$R["sales_person"],
					"qnty"=>$records_detail['allcount'],
					"destination"=>$dcity['name'],
					"area"=>$R["desti_landmark"],
					"subtotal"=>$R['subtotal_val'],
					"vat"=>$R['vattotal_val'],
					"total"=>$R['finaltotal_val'],
					"idno"=>"",
					"signature"=>"",
				);
				$total_cash=$total_cash+$cash;
				$total_fc=$total_fc+$cod;
				$total_amount=$total_amount+$R['finaltotal_val'];
				$total_qnty=$total_qnty+$records_detail['allcount'];
				$no++;	
			}
			$data['data'][] = array(
					
					"sr_no"=>' ',
					"date"=>' ',
					"invoice_number"=>' ',
					"cash"=>' ',
					"fc"=>' ',
					"sales_person"=>' ',
					"qnty"=>$total_qnty,
					"destination"=>' ',
					"area"=>' ',
					"subtotal"=>' ',
					"vat"=>' ',
					"total"=>$total_amount,
					"idno"=>"",
					"signature"=>"",
				);
			
		}
		$data['columns'][] = array(
			"data"=>"sr_no",
            "name"=>"SR No"
		);
		$data['columns'][] = array(
			"data"=>"date",
            "name"=>"Date"
		);
		$data['columns'][] = array(
			"data"=>"invoice_number",
            "name"=>"Invoice No."
		);
		$data['columns'][] = array(
			"data"=>"cash",
            "name"=>"Cash"
		);
		$data['columns'][] = array(
			"data"=>"fc",
            "name"=>"COD"
		);
		$data['columns'][] = array(
			"data"=>"sales_person",
            "name"=>"Sales Person"
		);
		$data['columns'][] = array(
			"data"=>"qnty",
            "name"=>"Quantity"
		);
		$data['columns'][] = array(
			"data"=>"destination",
            "name"=>"Destination"
		);
		$data['columns'][] = array(
			"data"=>"area",
		    "name"=>"Area"
		);
		$data['columns'][] = array(
			"data"=>"subtotal",
            "name"=>"Amt. Exculding Tax"
		);
		$data['columns'][] = array(
			"data"=>"vat",
            "name"=>"Vat 15%"
		);
		$data['columns'][] = array(
			"data"=>"total",
            "name"=>"Total Amount"
		);
		$data['columns'][] = array(
			"data"=>"idno",
            "name"=>"Id No."
		);
		$data['columns'][] = array(
			"data"=>"signature",
            "name"=>"Signature"
		);
		echo json_encode($data);
	}
	else if($_GET["report"]=='Branch')
	{
		$draw = $_POST['draw'];
		$row = $_POST['start'];
		$rowperpage = $_POST['length']; // Rows display per page
		$columnIndex = $_POST['order'][0]['column']; // Column index
		$columnName = 'invoice_date'; // Column name
		$columnSortOrder = 'asc'; // asc or desc
		$searchQuery = "";
		
		
		## Total number of records without filtering
		$sel = mysqli_query($dlink,"select count(*) as allcount from shipment");
		$records = mysqli_fetch_assoc($sel);
		$totalRecords = $records['allcount'];
	
		## Total number of records with filtering
		$sel = mysqli_query($dlink,"select count(*) as allcount from shipment WHERE 1".$searchQuery);
		$records = mysqli_fetch_assoc($sel);
		$totalRecordwithFilter = $records['allcount'];
	
		## Fetch records
		$from_date=''; $to_date='';
		if($_POST['from_date']!='');
			$from_date=date('Y-m-d',strtotime($_GET['from_date']));
		if($_POST['to_date']!='');
			$to_date=date('Y-m-d',strtotime($_GET['to_date']));
		
		$source_branch=$_GET['source_branch'];
		
		
		$qry="SELECT * FROM `shipment` WHERE 1 ";
		
		if($source_branch!='' && $source_branch!=0)
			$qry.=" and branch='$source_branch'";
		if($from_date == $to_date)
			$qry.=" and date(invoice_date)='$from_date'";
		elseif($from_date!='' && $to_date!='' && $from_date!='1970-01-01' && $to_date!='1970-01-01')
			$qry.=" and (invoice_date BETWEEN '$from_date' AND '$to_date')";
		$qry.=" order by invoice_date asc";
	    //echo $qry;
		
		$empRecords = mysqli_query($dlink, $qry);
		$data = array();
		$no=1;
		
		if(mysqli_num_rows($empRecords)>0)
		{
			$total_cash=0;
			$total_fc=0;
			$total_amount=0;
			$total_qnty=0;
			while($R=mysqli_fetch_assoc($empRecords))
			{
				$dcity=fetch_query("name","location",array("location_id="=>$R['destination_city'],"is_visible="=>0 ));
				
				
				$sel_detail = mysqli_query($dlink,"select SUM(no_of_package) as allcount from shipment_detail WHERE 1 and oid=".$R['id']);
				$records_detail = mysqli_fetch_assoc($sel_detail);
				
				$cash=0;
				$cod=0;
				if($R['mode_of_payment']=='Cash')
					$cash=$R['subtotal_val'];
				if($R['mode_of_payment']=='COD')
					$cod=$R['subtotal_val'];
					
				$data['data'][] = array(
					"#"=> "<input name='selector' class='ads_Checkbox' type='checkbox' value='".$R['invoice_number']."'>",
					"sr_no"=>$no,
					"date"=>date('d-m-Y',strtotime($R["invoice_date"])),
					"invoice_number"=>$R['invoice_number'],
					"cash"=>$R['payment_cash'],
					"fc"=>ucfirst($R["payment_fc"]),
					"sales_person"=>$R["sales_person"],
					"qnty"=>$records_detail['allcount'],
					"destination"=>$dcity['name'],
					"area"=>$R["desti_landmark"],
					"subtotal"=>$R['subtotal_val'],
					"vat"=>$R['vattotal_val'],
					"total"=>$R['finaltotal_val'],
					"idno"=>"",
					"signature"=>"",
				);
				$total_cash=$total_cash+$cash;
				$total_fc=$total_fc+$cod;
				$total_amount=$total_amount+$R['finaltotal_val'];
				$total_qnty=$total_qnty+$records_detail['allcount'];
				$no++;	
			}
			$data['data'][] = array(
					"#"=> ' ',
					"sr_no"=>' ',
					"date"=>' ',
					"invoice_number"=>' ',
					"cash"=>' ',
					"fc"=>' ',
					"sales_person"=>' ',
					"qnty"=>$total_qnty,
					"destination"=>' ',
					"area"=>' ',
					"subtotal"=>' ',
					"vat"=>' ',
					"total"=>$total_amount,
					"idno"=>"",
					"signature"=>"",
				);
			
		}
		$data['columns'][] = array(
			"data"=>"#",
            "name"=>"<input type='checkbox' name='mainchk' id='master'>"
		);
		$data['columns'][] = array(
			"data"=>"sr_no",
            "name"=>"SR No"
		);
		$data['columns'][] = array(
			"data"=>"date",
            "name"=>"Date"
		);
		$data['columns'][] = array(
			"data"=>"invoice_number",
            "name"=>"Invoice No."
		);
		$data['columns'][] = array(
			"data"=>"cash",
            "name"=>"Cash"
		);
		$data['columns'][] = array(
			"data"=>"fc",
            "name"=>"COD"
		);
		$data['columns'][] = array(
			"data"=>"sales_person",
            "name"=>"Sales Person"
		);
		$data['columns'][] = array(
			"data"=>"qnty",
            "name"=>"Quantity"
		);
		$data['columns'][] = array(
			"data"=>"destination",
            "name"=>"Destination"
		);
		$data['columns'][] = array(
			"data"=>"area",
		    "name"=>"Area"
		);
		$data['columns'][] = array(
			"data"=>"subtotal",
            "name"=>"Amt. Exculding Tax"
		);
		$data['columns'][] = array(
			"data"=>"vat",
            "name"=>"Vat 15%"
		);
		$data['columns'][] = array(
			"data"=>"total",
            "name"=>"Total Amount"
		);
		$data['columns'][] = array(
			"data"=>"idno",
            "name"=>"Id No."
		);
		$data['columns'][] = array(
			"data"=>"signature",
            "name"=>"Signature"
		);
		echo json_encode($data);
	}
	else if($_GET["report"]=='Outgoing to All')
	{
		$from_date=''; $to_date='';
		if($_GET['from_date']!='');
			$from_date=date('Y-m-d',strtotime($_GET['from_date']));
		if($_GET['to_date']!='');
			$to_date=date('Y-m-d',strtotime($_GET['to_date']));
		$startTime=''; $endTime ='';
		$sel_qry="SELECT * FROM `shipment` WHERE 1 ";
		
		$source_state=$_GET['source_state'];
		$source_city=$_POST['source_city'];
		
		$destination_state=$_GET['destination_state'];
		$destination_city=$_GET['destination_city'];
		
		if($source_state!='' && $source_state!=0)
		{
			$sel_qry.=" and source_state='$source_state'";
		}
		if($source_city!='' && $source_city!=0)
		{
			$sel_qry.=" and source_city='$source_city'";
		}
		if($from_date == $to_date)
			$qry.=" and date(invoice_date)='$from_date'";
		elseif($from_date!='' && $to_date!='' && $from_date!='1970-01-01' && $to_date!='1970-01-01')
	    {
			$sel_qry.="and  (invoice_date BETWEEN '$from_date' AND '$to_date')";
			$startTime = strtotime( $from_date );
			$endTime = strtotime( $to_date );
		}
	    $cityRecords = mysqli_query($dlink, $sel_qry);
		$City=array();
		while($CityR=mysqli_fetch_assoc($cityRecords))
		{
			if(in_array($CityR['destination_city'],$City))
			{ }
			else
				$City[]=$CityR['destination_city'];
		}
		$total_cash=0;
		$total_fc=0;
		$total_amount=0;
		//timing loop
		$k=0; $no=1; 
		$city_Total=array();
		for ($i = $startTime; $i <= $endTime; $i = $i + 86400 ) 
		{
  			$thisDate = date( 'd-m-Y', $i );
			$invoice_date = date( 'Y-m-d', $i );
			$row_array=array();
			$row_array['sr_no']=$no;
			$row_array['date']=$thisDate;
			$date_wise_total=0;
			//city loop
			$city_array_chk='';
			for($j=0;$j<count($City);$j++)
			{
				$qry="SELECT SUM(total_amount) as Total_Ship_Charge FROM `shipment` WHERE 1 ";
				if($source_state!='' && $source_state!=0)
					$qry.=" and source_state='$source_state'";
				if($source_city!='' && $source_city!=0)
					$qry.=" and source_city='$source_city'";
				if($from_date!='' && $to_date!='' && $from_date!='1970-01-01' && $to_date!='1970-01-01')
					$qry.=" and invoice_date='".$invoice_date."'";
				$qry.=" and destination_city='".$City[$j]."'  order by invoice_date asc";
				$empRecords = mysqli_query($dlink, $qry);
				$R=mysqli_fetch_assoc($empRecords);
				$sel_qry=mysqli_query($dlink,"SELECT * FROM location WHERE 1 and is_visible=0 and location_id=".$City[$j]);
				$city_name=mysqli_fetch_assoc($sel_qry);
				$total_ship_charge=0;
				if($R['Total_Ship_Charge']=="")
					$total_ship_charge='-';
				else
					$total_ship_charge=$R['Total_Ship_Charge'];
				
				$city_Total[$j]=$city_Total[$j]+$R['Total_Ship_Charge'];
				
				$date_wise_total=$date_wise_total+$R['Total_Ship_Charge'];
				
				$citynamekey='City_'.$city_name['name'];
				$row_array[$citynamekey]=$total_ship_charge;
				$row_array['total']=$date_wise_total;
				
				$total_amount=$total_amount+$R['Total_Ship_Charge'];
			}
			
			$data['data'][]=$row_array;
			//$data['data'][]=array('sr_no'=>$no,'date'=>$thisDate,$city_array_chk);
			$k++;
			$no++;
		}
		
		$total_array=array();
			$total_array['sr_no']=" ";
			$total_array['date']="TOTAL";
			$all_over_total=0;
			for($l=0;$l<count($City);$l++)
			{
				$sel_qry=mysqli_query($dlink,"SELECT * FROM location WHERE 1 and is_visible=0  and location_id=".$City[$l]);
				$city_name=mysqli_fetch_assoc($sel_qry);
				$citynamekey='City_'.$city_name['name'];
				$total_array[$citynamekey]=$city_Total[$l];
				$all_over_total=$all_over_total+$city_Total[$l];
			}
			$total_array['total']=$all_over_total;
			$data['data'][]=$total_array;
		
		$data['columns'][] = array(
			"data"=>"sr_no",
            "name"=>"SR No."
		);
		$data['columns'][] = array(
			"data"=>"date",
            "name"=>"Date"
		);
		
		for($j=0;$j<count($City);$j++)
		{
			$sel_qry=mysqli_query($dlink,"SELECT * FROM location WHERE 1 and is_visible=0  and location_id=".$City[$j]);
			$city_name=mysqli_fetch_assoc($sel_qry);
			$data['columns'][] = array(
			"data"=>"City_".$city_name['name'],
            "name"=>$city_name['name']
			);
		}
		$data['columns'][] = array(
			"data"=>"total",
            "name"=>"Total"
		);
		
		echo json_encode($data);
	}
	else if($_GET["report"]=='Shipment to All')
	{
		$draw = $_GET['draw'];
		$row = $_GET['start'];
		$rowperpage = $_GET['length']; // Rows display per page
		$columnIndex = $_GET['order'][0]['column']; // Column index
		$columnName = 'invoice_date'; // Column name
		$columnSortOrder = 'asc'; // asc or desc
		$searchQuery = "";
		
		
		## Total number of records without filtering
		$sel = mysqli_query($dlink,"select count(*) as allcount from shipment");
		$records = mysqli_fetch_assoc($sel);
		$totalRecords = $records['allcount'];
	
		## Total number of records with filtering
		$sel = mysqli_query($dlink,"select count(*) as allcount from shipment WHERE 1".$searchQuery);
		$records = mysqli_fetch_assoc($sel);
		$totalRecordwithFilter = $records['allcount'];
	
		## Fetch records
		$from_date=''; $to_date='';
		if($_GET['from_date']!='');
			$from_date=date('Y-m-d',strtotime($_GET['from_date']));
		if($_GET['to_date']!='');
			$to_date=date('Y-m-d',strtotime($_GET['to_date']));
		
		$source_state=$_GET['source_state'];
		$source_city=$_GET['source_city'];
		
		$destination_state=$_GET['destination_state'];
		$destination_city=$_GET['destination_city'];
		
		$qry="SELECT * FROM `shipment` WHERE 1 ";
		
		if($source_state!='' && $source_state!=0)
			$qry.=" and source_state='$source_state'";
		if($source_city!='' && $source_city!=0)
			$qry.=" and source_city='$source_city'";
		if($destination_state!='' && $destination_state!=0)
			$qry.=" and destination_state='$destination_state'";
		if($destination_city!='' && $destination_city!=0)
			$qry.=" and destination_city='$destination_city'";
		
		if($from_date == $to_date)
			$qry.=" and date(invoice_date)='$from_date'";
		elseif($from_date!='' && $to_date!='' && $from_date!='1970-01-01' && $to_date!='1970-01-01')
			$qry.=" and (invoice_date BETWEEN '$from_date' AND '$to_date')";
		
		$qry.=" order by invoice_date asc";

		
		
		$empRecords = mysqli_query($dlink, $qry);
		$data = array();
		$no=1;
		
		if(mysqli_num_rows($empRecords)>0)
		{
			$total_cash=0;
			$total_fc=0;
			$total_amount=0;
			$tax_total=0;
			while($R=mysqli_fetch_assoc($empRecords))
			{
				$dcity=fetch_query("name","location",array("location_id="=>$R['destination_city'],"is_visible="=>0));
				if($R['aid']!=0)
				{
					$sagent=fetch_query("name,agent_no","agent",array("id="=>$R['sender_agentid']));
					$aid=$sagent['name'];
				}
				else
					$aid='Admin';
				$tax=$R['total_amount']-$R['amount'];
				$data['data'][] = array(
					
					"sr_no"=>$no,
					"date"=>date('d-M-Y',strtotime($R["invoice_date"])),
					"place_to_deliver"=>$dcity['name'],
					"area"=>$R['desti_landmark'],
					"inv_no"=>$R['invoice_number'],
					"cash"=>$R['payment_cash'],
					"fc"=>$R['payment_fc'],
					"sales_man"=>$aid,
					"remark"=>$R['comment'],
					"tax"=>$tax,
					"total"=>$R['total_amount'],
				);
				$total_cash=$total_cash+$R['payment_cash'];
				$total_fc=$total_fc+$R['payment_fc'];
				$total_amount=$total_amount+$R['total_amount'];
				$tax_total=$tax_total+$tax;
				$no++;	
			}
			$data['data'][] = array(
					
					"sr_no"=>' ',
					"date"=>' ',
					"place_to_deliver"=>' ',
					"area"=>' ',
					"inv_no"=>' <b>Total</b>',
					"cash"=>$total_cash,
					"fc"=>$total_fc,
					"sales_man"=>' ',
					"remark"=>' ',
					"tax"=>$tax_total,
					"total"=>$total_amount,
				);
			
		}
		$data['columns'][] = array(
			"data"=>"sr_no",
            "name"=>"SR No"
		);
		$data['columns'][] = array(
			"data"=>"date",
            "name"=>"Date"
		);
		$data['columns'][] = array(
			"data"=>"place_to_deliver",
            "name"=>"Place To Deliver"
		);
		$data['columns'][] = array(
			"data"=>"area",
            "name"=>"Area"
		);
		$data['columns'][] = array(
			"data"=>"inv_no",
            "name"=>"Inv. No."
		);
		$data['columns'][] = array(
			"data"=>"cash",
            "name"=>"Cash"
		);
		$data['columns'][] = array(
			"data"=>"fc",
            "name"=>"FC"
		);
		$data['columns'][] = array(
			"data"=>"sales_man",
            "name"=>"Sales Man"
		);
		$data['columns'][] = array(
			"data"=>"remark",
            "name"=>"Remark"
		);
		$data['columns'][] = array(
			"data"=>"tax",
            "name"=>"Tax"
		);
		$data['columns'][] = array(
			"data"=>"total",
            "name"=>"Grand Total"
		);
		echo json_encode($data);
	}
	else if($_GET["report"]=='Shipment')
	{
		$draw = $_GET['draw'];
		$row = $_GET['start'];
		$rowperpage = $_GET['length']; // Rows display per page
		$columnIndex = $_GET['order'][0]['column']; // Column index
		$columnName = 'invoice_date'; // Column name
		$columnSortOrder = 'asc'; // asc or desc
		$searchQuery = "";
		
		
		## Total number of records without filtering
		$sel = mysqli_query($dlink,"select count(*) as allcount from shipment");
		$records = mysqli_fetch_assoc($sel);
		$totalRecords = $records['allcount'];
	
		## Total number of records with filtering
		$sel = mysqli_query($dlink,"select count(*) as allcount from shipment WHERE 1".$searchQuery);
		$records = mysqli_fetch_assoc($sel);
		$totalRecordwithFilter = $records['allcount'];
	
		## Fetch records
		$from_date=''; $to_date='';
		if($_GET['from_date']!='');
			$from_date=date('Y-m-d',strtotime($_GET['from_date']));
		if($_GET['to_date']!='');
			$to_date=date('Y-m-d',strtotime($_GET['to_date']));
		
		$source_state=$_GET['source_state'];
		$source_city=$_GET['source_city'];
		
		$destination_state=$_GET['destination_state'];
		$destination_city=$_GET['destination_city'];
		
		$qry="SELECT * FROM `shipment` WHERE 1 ";
		
		if($source_state!='' && $source_state!=0)
			$qry.=" and source_state='$source_state'";
		if($source_city!='' && $source_city!=0)
			$qry.=" and source_city='$source_city'";
		if($destination_state!='' && $destination_state!=0)
			$qry.=" and destination_state='$destination_state'";
		if($destination_city!='' && $destination_city!=0)
			$qry.=" and destination_city='$destination_city'";
		if($from_date == $to_date)
			$qry.=" and date(invoice_date)='$from_date'";
		elseif($from_date!='' && $to_date!='' && $from_date!='1970-01-01' && $to_date!='1970-01-01')
			$qry.=" and (invoice_date BETWEEN '$from_date' AND '$to_date')";
		
		$qry.=" order by invoice_date asc";
	   
		
		$empRecords = mysqli_query($dlink, $qry);
		$data = array();
		$no=1;
		
		if(mysqli_num_rows($empRecords)>0)
		{
			$total_cash=0;
			$total_fc=0;
			$total_amount=0;
			$tax_total=0;
			while($R=mysqli_fetch_assoc($empRecords))
			{
				$dcity=fetch_query("name","location",array("location_id="=>$R['destination_city'],"is_visible="=>0));
				if($R['aid']!=0)
				{
					$sagent=fetch_query("name,agent_no","agent",array("id="=>$R['sender_agentid']));
					$aid=$sagent['name'];
				}
				else
					$aid='Admin';
				$tax=$R['total_amount']-$R['amount'];
				$data['data'][] = array(
					
					"sr_no"=>$no,
					"date"=>date('d-M-Y',strtotime($R["invoice_date"])),
					"place_to_deliver"=>$dcity['name'],
					"area"=>$R['desti_landmark'],
					"inv_no"=>$R['invoice_number'],
					"cash"=>$R['payment_cash'],
					"fc"=>$R['payment_fc'],
					"sales_man"=>$aid,
					"remark"=>$R['comment'],
					"tax"=>$tax,
					"total"=>$R['total_amount'],
				);
				$total_cash=$total_cash+$R['payment_cash'];
				$total_fc=$total_fc+$R['payment_fc'];
				$total_amount=$total_amount+$R['total_amount'];
				$tax_total=$tax_total+$tax;
				$no++;	
			}
			$data['data'][] = array(
					
					"sr_no"=>' ',
					"date"=>' ',
					"place_to_deliver"=>' ',
					"area"=>' ',
					"inv_no"=>' <b>Total</b>',
					"cash"=>$total_cash,
					"fc"=>$total_fc,
					"sales_man"=>' ',
					"remark"=>' ',
					"tax"=>$tax_total,
					"total"=>$total_amount,
				);
			
		}
		$data['columns'][] = array(
			"data"=>"sr_no",
            "name"=>"SR No"
		);
		$data['columns'][] = array(
			"data"=>"date",
            "name"=>"Date"
		);
		$data['columns'][] = array(
			"data"=>"place_to_deliver",
            "name"=>"Place To Deliver"
		);
		$data['columns'][] = array(
			"data"=>"area",
            "name"=>"Area"
		);
		$data['columns'][] = array(
			"data"=>"inv_no",
            "name"=>"Inv. No."
		);
		$data['columns'][] = array(
			"data"=>"cash",
            "name"=>"Cash"
		);
		$data['columns'][] = array(
			"data"=>"fc",
            "name"=>"COD"
		);
		$data['columns'][] = array(
			"data"=>"sales_man",
            "name"=>"Sales Man"
		);
		$data['columns'][] = array(
			"data"=>"remark",
            "name"=>"Remark"
		);
		$data['columns'][] = array(
			"data"=>"tax",
            "name"=>"Tax"
		);
		$data['columns'][] = array(
			"data"=>"total",
            "name"=>"Grand Total"
		);
		echo "<pre>"; print_r($data); exit;
		echo json_encode($data);
	}
	else if($_GET["report"]=='Expense')
	{
		$from_date=''; $to_date='';
		if($_POST['from_date']!='')
			$from_date=date('Y-m-d',strtotime($_GET['from_date']));
		if($_POST['to_date']!='')
			$to_date=date('Y-m-d',strtotime($_GET['to_date']));
		
		
		$qry="select e.*,sum(e.exp_amount) as totalexp,a.city,a.id as agent_id,c.name as cname from agent a LEFT JOIN expenses e ON a.id=e.added_by LEFT JOIN location c ON c.location_id=a.city ";
		if($from_date!='' && $to_date!='' && $from_date!='1970-01-01' && $to_date!='1970-01-01')
			$qry.=" where (e.expense_for_month BETWEEN '$from_date' AND '$to_date')";
		
		$qry.=" and c.is_visible=0 group by a.city";
		
		$empRecords = mysqli_query($dlink, $qry);
		$data = array();
		$no=1;
		
		if(mysqli_num_rows($empRecords)>0)
		{
			$total_cash=0;
			$total_fc=0;
			$total_amount=0;
			$tax_total=0;
			while($R=mysqli_fetch_assoc($empRecords))
			{
				
				$data['data'][] = array(
					
					"sr_no"=>$no,
					"destination"=>$R['cname'],
					"expenses"=>$R['totalexp'],
					
				);
				$total_amount=$total_amount+$R['totalexp'];
				$no++;	
			}
			$data['data'][] = array(
					
					"sr_no"=>' ',
					"destination"=>' <b>Total</b>',
					"expenses"=>$total_amount,
				);
			
		}
		$data['columns'][] = array(
			"data"=>"sr_no",
            "name"=>"SR No"
		);
		$data['columns'][] = array(
			"data"=>"destination",
            "name"=>"Destination"
		);
		$data['columns'][] = array(
			"data"=>"expenses",
            "name"=>"Expenses"
		);
		echo json_encode($data);
	}
	else if($_GET["report"]=='Salesman')
	{
		$from_date=''; $to_date=''; $agent='';
		if($_GET['from_date']!='');
			$from_date=date('Y-m-d',strtotime($_GET['from_date']));
		if($_GET['to_date']!='');
			$to_date=date('Y-m-d',strtotime($_GET['to_date']));
		
		if($_GET['agentid']!='');
			$agent=$_GET['agentid'];
		
		$qry="SELECT * FROM `shipment` WHERE 1 ";
		if($from_date == $to_date)
			$qry.=" and date(invoice_date)='$from_date'";
		elseif($from_date!='' && $to_date!='' && $from_date!='1970-01-01' && $to_date!='1970-01-01')
			$qry.=" and (invoice_date BETWEEN '$from_date' AND '$to_date')";
		if($agent!='')
			$qry.=" and aid='$agent'";
		$qry.=" order by invoice_date asc";
		
		$empRecords = mysqli_query($dlink, $qry);
		$data = array();
		$no=1;
		
		if(mysqli_num_rows($empRecords)>0)
		{
			$total_cash=0;
			$total_fc=0;
			$total_amount=0;
			$tax_total=0;
			while($R=mysqli_fetch_assoc($empRecords))
			{
				$aid='';
				$dcity=fetch_query("name","location",array("location_id="=>$R['destination_city'],"is_visible="=>0 ));
				if($R['aid']!=0)
				{
					$sagent=fetch_query("name,agent_no","agent",array("id="=>$R['sender_agentid']));
					$aid=$sagent['name'];
				}
				else
					$aid='Admin';
				$tax=$R['total_amount']-$R['amount'];
				$data['data'][] = array(
					
					"sr_no"=>$no,
					"date"=>date('d-M-Y',strtotime($R["invoice_date"])),
					"place_to_deliver"=>$dcity['name'],
					"inv_no"=>$R['invoice_number'],
					"cash"=>$R['payment_cash'],
					"fc"=>$R['payment_fc'],
					"sales_man"=>$aid,
					"remark"=>$R['comment'],
					"destination"=>$dcity['name'],
					"area"=>$R['desti_landmark'],
					"tax"=>$tax,
					"total"=>$R['total_amount'],
				);
				$total_cash=$total_cash+$R['payment_cash'];
				$total_fc=$total_fc+$R['payment_fc'];
				$total_amount=$total_amount+$R['total_amount'];
				$tax_total=$tax_total+$tax;
				$no++;	
			}
			$data['data'][] = array(
					
					"sr_no"=>' ',
					"date"=>' ',
					"place_to_deliver"=>' ',
					"inv_no"=>' <b>Total</b>',
					"cash"=>$total_cash,
					"fc"=>$total_fc,
					"sales_man"=>' ',
					"remark"=>' ',
					"destination"=>' ',
					"area"=>' ',
					"tax"=>$tax_total,
					"total"=>$total_amount,
				);
			
		}
		$data['columns'][] = array(
			"data"=>"sr_no",
            "name"=>"SR No"
		);
		$data['columns'][] = array(
			"data"=>"date",
            "name"=>"Date"
		);
		$data['columns'][] = array(
			"data"=>"place_to_deliver",
            "name"=>"Place To Deliver"
		);
		$data['columns'][] = array(
			"data"=>"inv_no",
            "name"=>"Inv. No."
		);
		$data['columns'][] = array(
			"data"=>"cash",
            "name"=>"Cash"
		);
		$data['columns'][] = array(
			"data"=>"fc",
            "name"=>"FC"
		);
		$data['columns'][] = array(
			"data"=>"sales_man",
            "name"=>"Sales Man"
		);
		$data['columns'][] = array(
			"data"=>"remark",
            "name"=>"Remark"
		); 
		$data['columns'][] = array(
			"data"=>"destination",
            "name"=>"Destination"
		);
		$data['columns'][] = array(
			"data"=>"area",
            "name"=>"Area"
		);
		$data['columns'][] = array(
			"data"=>"tax",
            "name"=>"Tax"
		);
		$data['columns'][] = array(
			"data"=>"total",
            "name"=>"Grand Total"
		);
		echo json_encode($data);
	}
	else if($_GET["report"]=='Business')
	{
		$from_date=''; $to_date=''; 
		if($_GET['from_date']!='');
			$from_date=date('Y-m-d',strtotime($_GET['from_date']));
		if($_GET['to_date']!='');
			$to_date=date('Y-m-d',strtotime($_GET['to_date']));
		
		
		$qry="SELECT sum(total_amount) as region_total,source_city,area FROM `shipment` WHERE 1 ";
		if($from_date == $to_date)
			$qry.=" and date(invoice_date)='$from_date'";
		elseif($from_date!='' && $to_date!='' && $from_date!='1970-01-01' && $to_date!='1970-01-01')
			$qry.=" and (invoice_date BETWEEN '$from_date' AND '$to_date')";
		$qry.="  group by source_city order by invoice_date asc";
		
		$empRecords = mysqli_query($dlink, $qry);
		$data = array();
		$no=1;
		
		if(mysqli_num_rows($empRecords)>0)
		{
			$total_cash=0;
			$total_fc=0;
			$total_amount=0;
			$tax_total=0;
			while($R=mysqli_fetch_assoc($empRecords))
			{
				$aid='';
				$dcity=fetch_query("name","location",array("location_id="=>$R['source_city'],"is_visible="=>0 ));
				
				
				$data['data'][] = array(
					
					"sr_no"=>$no,
					"region"=>$dcity['name'],
					"area"=>$R['area'],
					"sales"=>$R['region_total'],
					
				);
				$total_amount=$total_amount+$R['region_total'];
				$no++;	
			}
			$data['data'][] = array(
					
					"sr_no"=>' ',
					"region"=>'Total',
					"area"=>' ',
					"sales"=>$total_amount,
				);
			
		}
		$data['columns'][] = array(
			"data"=>"sr_no",
            "name"=>"SR No"
		);
		$data['columns'][] = array(
			"data"=>"region",
            "name"=>"Region"
		);
		$data['columns'][] = array(
			"data"=>"area",
            "name"=>"Area"
		);
		$data['columns'][] = array(
			"data"=>"sales",
            "name"=>"Sales"
		);
	
		echo json_encode($data);
	}

	/*else if($_GET["report"]=='downloadBranch')
	{
		
		## Total number of records without filtering
		$sel = mysqli_query($dlink,"select count(*) as allcount from shipment");
		$records = mysqli_fetch_assoc($sel);
		$totalRecords = $records['allcount'];
	
		## Total number of records with filtering
		$sel = mysqli_query($dlink,"select count(*) as allcount from shipment WHERE 1".$searchQuery);
		$records = mysqli_fetch_assoc($sel);
		$totalRecordwithFilter = $records['allcount'];
	
		## Fetch records
		$from_date=''; $to_date='';
		if($_POST['from_date']!='');
			$from_date=date('Y-m-d',strtotime($_GET['from_date']));
		if($_POST['to_date']!='');
			$to_date=date('Y-m-d',strtotime($_GET['to_date']));
		
		$source_branch=$_GET['source_branch'];
		
		
		$qry="SELECT * FROM `shipment` WHERE 1 ";
		
		if($source_branch!='' && $source_branch!=0)
			$qry.=" and branch='$source_branch'";
		if($from_date == $to_date)
			$qry.=" and date(invoice_date)='$from_date'";
		elseif($from_date!='' && $to_date!='' && $from_date!='1970-01-01' && $to_date!='1970-01-01')
			$qry.=" and (invoice_date BETWEEN '$from_date' AND '$to_date')";
		$qry.=" order by invoice_date asc";
	    //echo $qry;
		
		$empRecords = mysqli_query($dlink, $qry);
		$data = array();
		$no=1;
		
		if(mysqli_num_rows($empRecords)>0)
		{
			$total_cash=0;
			$total_fc=0;
			$total_amount=0;
			$total_qnty=0;
			while($R=mysqli_fetch_assoc($empRecords))
			{
				$dcity=fetch_query("name","location",array("location_id="=>$R['destination_city'],"is_visible="=>0 ));
				
				
				$sel_detail = mysqli_query($dlink,"select SUM(no_of_package) as allcount from shipment_detail WHERE 1 and oid=".$R['id']);
				$records_detail = mysqli_fetch_assoc($sel_detail);
				
				$cash=0;
				$cod=0;
				if($R['mode_of_payment']=='Cash')
					$cash=$R['subtotal_val'];
				if($R['mode_of_payment']=='COD')
					$cod=$R['subtotal_val'];
					
				https://thewpbrain.com/ntexpress/_private_content_shipment/l_"+value+".pdf
			}
			
		}
		
		
	}*/
}



/*if($_REQUEST['action']=='get_report_old')
{
	if($_POST["report"]=='Outgoin')
	{
		$from_date=date('Y-m-d',strtotime($_POST['from_date']));
		$to_date=date('Y-m-d',strtotime($_POST['to_date']));
		
		$source_state=$_POST['source_state'];
		$source_city=$_POST['source_city'];
		
		$destination_state=$_POST['destination_state'];
		$destination_city=$_POST['destination_city'];
		
		$qry="SELECT * FROM `shipment` WHERE 1 ";
		
		if($source_state!='' && $source_state!=0)
			$qry.=" and source_state='$source_state'";
		if($source_city!='' && $source_city!=0)
			$qry.=" and source_city='$source_city'";
		if($destination_state!='' && $destination_state!=0)
			$qry.=" and destination_state='$destination_state'";
		if($destination_state!='' && $destination_state!=0)
			$qry.=" and destination_city='$destination_city'";
		if($from_date!='' && $to_date!='')
			$qry.=" and (invoice_date BETWEEN '$from_date' AND '$to_date')";
		$qry.=" order by invoice_date asc";
		echo $qry;
		$scid =mysqli_query($dlink,$qry);
		//SELECT * FROM `shipment` WHERE `source_state`='1318' and source_city = '5379' and destination_state='1322' and destination_city = '5386' and (invoice_date BETWEEN '2020-07-01' AND '2020-07-30') order by invoice_date asc 
		$no=1;
		$tbody='<table id="example" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Sr. No.</th>
						<th>Date</th>
						<th>Cash</th>
                        <th>FC</th>
                        <th>Total</th>
                    </tr>
               	</thead>
        <tbody>';
		if(mysqli_num_rows($scid) > 0)
		{
			while($st=mysqli_fetch_array($scid))
			{ 
				$tbody.='<tr>
               			<td>'.$no.'</td>
                        <td>'.date('d-M-Y',strtotime($st["invoice_date"])).'</td>
                        <td>'.$st['payment_cash'].'</td>
						<td>'.$st['payment_fc'].'</td>
						<td>'.$st['total_amount'].'</td>
                       </tr>';
					   $no++;
			}
			echo $tbody.='</tbody></table>';
			exit;
		}
		else
		{ 	echo $tbody.="<tr><td>No, Records Found.</td></tr></tbody></table>";
			exit;
		 }
	}
	else
	{ 
		echo "blank"; 
		exit;
	}
}*/
/*if($_POST["action"]=='save_new_customer') 
{
	$query ="SELECT * FROM customers WHERE email= '".$_POST["email"]."'";
	$result = mysqli_query($dlink,$query);
	if($result->num_rows>0) {
		echo 'Customer Email-Id Already Exist...';
		exit;
	}
	else
	{
		$dt=date('Y-m-d H:i:s');
	  	$arr=array("name"=>ucfirst($_POST['name']),"email"=>$_POST['email'],"mno"=>$_POST['mno'],"address"=>addslashes($_POST['address']),"pincode"=>$_POST['zipcode'],"country"=>$_POST['country'],"state"=>$_POST['state'],"city"=>$_POST['city'],"recorddate"=>$dt,"rcvr_name"=>ucfirst($_POST['rcvr_name']),"rcvr_email"=>$_POST['rcvr_email'],"rcvr_mno"=>$_POST['rcvr_mno'],"rcvr_address"=>addslashes($_POST['rcvr_address']),"rcvr_pincode"=>$_POST['rcvr_pincode'],"rcvr_country"=>$_POST['rcvr_country'],"rcvr_state"=>$_POST['rcvr_state'],"rcvr_city"=>$_POST['rcvr_city']); 
	  	$insert = insert_query($arr, "customers");
		 $last_id=$dlink->insert_id;
		if($insert)
			echo 'Customer added successfully~~'.$last_id;
		else
			echo 'Something Wrong... Try Again...';
	}
	exit;
}*/
if($_POST["action"]=='save_new_customer') 
{
	$query ="SELECT * FROM customers WHERE email= '".$_POST["email"]."' and is_delete=0";
	$result = mysqli_query($dlink,$query);
	if($result->num_rows>0) {
		echo 'Customer Email-Id Already Exist...';
		exit;
	}
	else
	{
		$dt=date('Y-m-d H:i:s');
	  	$arr=array(
	  		"name"=>ucfirst($_POST['name']),
	  		"email"=>$_POST['email'],
	  		"mno"=>$_POST['mno'],
	  		"address"=>addslashes($_POST['address']),
	  		"country"=>$_POST['country'],
	  		"state"=>$_POST['state'],
	  		"city"=>$_POST['city'],
	  		"recorddate"=>$dt
	  	); 
	  	$insert = insert_query($arr, "customers");
		$last_id=$dlink->insert_id;

	    if($insert)
	    {
          
            $rcv_name="";
            $rcv_name=$_POST['rcvr_name'];
            $arr_=array("cid"=>$last_id,"rcvr_name"=>ucfirst($rcv_name),"rcvr_email"=>$_POST['rcvr_email'],"rcvr_mno"=>$_POST['rcvr_mno'],"rcvr_address"=>addslashes($_POST['rcvr_address']),"rcvr_country"=>$_POST['rcvr_country'],"rcvr_state"=>$_POST['rcvr_state'],"rcvr_city"=>$_POST['rcvr_city'],"rcvr_landmark"=>$_POST['rcvr_landmark'],"rcvr_vat_no"=>$_POST['rcvr_vat_no'],"rcvr_iqamano"=>$_POST['rcvr_iqamano']);
            $insert = insert_query($arr_, "customers_receiver");
                
        	echo 'Customer added successfully~~'.$last_id;
      	}
		else
		{
			echo 'Something Wrong... Try Again...';
		}
	}
	exit;
}
if(!empty($_POST["keyword"])) 
{
	$query ="SELECT * FROM customers WHERE name like '%" . $_POST["keyword"] . "%' and is_delete=0 ORDER BY name";
	$result = mysqli_query($dlink,$query);
	if($result->num_rows>0) { ?>
		<ul id="country-list">	<?php
			while($country=$result->fetch_array()) { ?>
				<li onClick="selectCountry('<?php echo $country["name"]; ?>','<?php echo $country["id"]; ?>');"><?php echo $country["name"]; ?></li><?php 
			} ?>
		</ul><?php 
	} 
}  
if(!empty($_POST["keyword_receiver"])) 
{
	$sender_id=$_POST["sender_id"];
	if($sender_id!='')
	{
		$query ="SELECT * FROM customers_receiver WHERE rcvr_name like '%" . $_POST["keyword_receiver"] . "%' ORDER BY rcvr_name";
		$result = mysqli_query($dlink,$query);
		if($result->num_rows>0) { ?>
			<ul id="country-list">	<?php
				while($country=$result->fetch_array()) { ?>
					<li onClick="selectReceiverCountry('<?php echo $country["rcvr_name"]; ?>','<?php echo $country["id"]; ?>');"><?php echo $country["rcvr_name"]; ?></li><?php 
				} ?>
			</ul><?php 
		} 
	}
}
if(!empty($_POST["keyword_sender"])) 
{
	$query ="SELECT * FROM customers WHERE name like '%" . $_POST["keyword_sender"] . "%' and is_delete=0 ORDER BY name";
	$result = mysqli_query($dlink,$query);
	if($result->num_rows>0) { ?>
		<ul id="country-list">	<?php
			while($country=$result->fetch_array()) { ?>
				<li onClick="selectSender('<?php echo $country["name"]; ?>','<?php echo $country["id"]; ?>');"><?php echo str_replace($_POST["keyword_sender"],'<strong>'.$_POST["keyword_sender"].'</strong>',$country["name"]); //$country["name"]; ?></li><?php 
			} ?>
			<?php /*?><li onClick="selectSender('New','new');">Add New Customer</li><?php */?>
			
		</ul><?php 
	} 
}
if(!empty($_POST["keyword_mobile_sender"])) 
{
	$query ="SELECT mno,id FROM customers WHERE mno like '" . $_POST["keyword_mobile_sender"] . "%' UNION SELECT phone as mno,id FROM customers WHERE phone like '" . $_POST["keyword_mobile_sender"] . "%' and is_delete=0";
	$result = mysqli_query($dlink,$query);
	if($result->num_rows>0) { ?>
		<ul id="country-list">	<?php
			while($country=$result->fetch_array()) { ?>
				<li onClick="selectSenderMobile('<?php echo $country["mno"]; ?>','<?php echo $country["id"]; ?>');"><?php echo $country["mno"]; ?></li><?php 
			} ?>
			<?php /*?><li onClick="selectSender('New','new');">Add New Customer</li><?php */?>
			
		</ul><?php 
	} 
}
if($_REQUEST['action']=='get_customer_other_info')
{
	/*echo $_POST["cid"];
	exit;*/
	$query ="SELECT * FROM customers WHERE id='".$_POST["cid"]."' and is_delete=0 ORDER BY name";
	$result = mysqli_query($dlink,$query);
	$records = mysqli_fetch_assoc($result);
	$mno='';
	if($records['mno']!=''){
		$mno =$records['mno'];
	}
	else{
		$mno =$records['phone'];
	}
	echo $details=$records['email']."~~".$mno."~~".$records['address']."~~".$records['country']."~~".$records['state']."~~".$records['city']."~~".$records['rcvr_name']."~~".$records['rcvr_email']."~~".$records['rcvr_mno']."~~".$records['rcvr_address']."~~".$records['rcvr_country']."~~".$records['rcvr_state']."~~".$records['rcvr_city']."~~".$records['name']."~~".$records['taxtype']."~~".$records['rcvr_iqamano']."~~".$records['rcvr_vat_no']."~~".$records['customerid']."~~".$records['taxnumber']."~~".$records['area'];
	exit;
	
}
if($_REQUEST['action']=='get_customers_receiver')
{
	global $dlink;
	$query ="SELECT * FROM customers_receiver WHERE cid='".$_REQUEST["cid"]."' ORDER BY rcvr_name";
	$result = mysqli_query($dlink,$query);
	$new='<select name="desti_name_drop" id="desti_name_drop" class="form-control" onchange="getReceiverAllinfo(this)"><option value="">-Select Receiver-</option>';
	while($records = mysqli_fetch_assoc($result))
	{
		$new.='<option value="'.$records['id'].'">'.$records['rcvr_name'].'</option>';
    }
	echo $new.='</select>';
	exit;
}
if($_REQUEST['action']=='get_customer_other_info_for_receiver')
{
	/*echo $_POST["cid"];
	exit;*/
	$query ="SELECT * FROM customers_receiver WHERE id='".$_POST["cid"]."' ORDER BY rcvr_name";
	$result = mysqli_query($dlink,$query);
	$records = mysqli_fetch_assoc($result);
	
	echo $records['rcvr_name']."~~".$records['rcvr_email']."~~".$records['rcvr_mno']."~~".$records['rcvr_address']."~~".$records['rcvr_country']."~~".$records['rcvr_state']."~~".$records['rcvr_city']."~~".$records['rcvr_landmark']."~~".$records['rcvr_iqamano']."~~".$records['rcvr_vat_no'];
	exit;
}
if($_REQUEST['action']=='change_shipment_status')
{
	$query =mysqli_query($dlink,"update shipment set status='".$_POST['val']."' WHERE id='".$_POST["fid"]."'");
	echo $query;
	exit;
}


if($_REQUEST['action']=='get_state')
{
	if($_POST["country"]!='')
	{
		
		$scid =mysqli_query($dlink,"SELECT * FROM location WHERE location_type='1' and is_visible=0 and parent_id = '".$_POST["country"]."' order by name");
		if(mysqli_num_rows($scid) > 0)
		{
		?>
			<option value="">Select State</option>
		<?php
			while($st=mysqli_fetch_array($scid))
			{ ?>
				<option value="<?php echo $st["location_id"]; ?>"><?php echo $st["name"]; ?></option>
		<?php
			}
		}
		else
		{ echo "Not Found"; }
	}
	else
	{ echo "blank"; }
}

if($_REQUEST['action']=='get_city')
{
	if($_POST["state"]!='')
	{
		$scid =mysqli_query($dlink,"SELECT * FROM location WHERE location_type='2' and is_visible=0  and parent_id = '".$_POST["state"]."' and is_visible='0' order by name");

		if(mysqli_num_rows($scid) > 0)
		{
		?>
			<option value="">Select City</option>
		<?php
			while($st=mysqli_fetch_array($scid))
			{ ?>
				<option value="<?php echo $st["location_id"]; ?>"><?php echo $st["name"]; ?></option>
		<?php
			}
		}
		else
		{ echo "Not Found"; }
	}
	else
	{ echo "blank"; }
}
if($_REQUEST['action']=='check_customer_email_exist')
{
	if($_POST["email"]!='')
	{
		$chkemail =mysqli_query($dlink,"SELECT * FROM customers WHERE email = '".$_POST["email"]."' and is_delete=0");
		if(mysqli_num_rows($chkemail) > 0)
		{ echo "Email Id Already Exist."; }
		else
		{ echo "Not Found"; }
	}
	else
	{ echo "blank"; }
}
if($_REQUEST['action']=='check_email_exist')
{
	if($_POST["email"]!='')
	{
		$chkemail =mysqli_query($dlink,"SELECT * FROM agent WHERE email = '".$_POST["email"]."'");
		if(mysqli_num_rows($chkemail) > 0)
		{ echo "Email Id Already Exist."; }
		else
		{ echo "Not Found"; }
	}
	else
	{ echo "blank"; }
}
if($_REQUEST['action']=='get_dept')
{
	if($_POST["brandhid"]!='')
	{
		$scid =mysqli_query($dlink,"SELECT * FROM dept_branch WHERE dept_branch='".$_POST["brandhid"]."' order by new_dept");

		if(mysqli_num_rows($scid) > 0)
		{
		?>
			<option value="">Select Dept</option>
			<?php
			while($st=mysqli_fetch_array($scid))
			{ ?>
				<option value="<?php echo $st["id"]; ?>"><?php echo '<b>'.$st["new_dept"].'</b>('.$st["dept_head"].")"; ?></option><?php
			}
		}
		else
		{ echo "Not Found"; }
	}
	else
	{ echo "blank"; }
} 
if($_REQUEST['action']=='get_agent')
{
	if($_POST["deptid"]!='')
	{
		$scid =mysqli_query($dlink,"SELECT * FROM agent WHERE is_delete=0 and deptid='".$_POST["deptid"]."' order by name");

		if(mysqli_num_rows($scid) > 0)
		{
		?>
			<option value="">Select Agent</option>
		<?php
			while($st=mysqli_fetch_array($scid))
			{ ?>
				<option value="<?php echo $st["id"]; ?>"><?php echo '<b>'.$st["name"].'</b>('.$st["agent_no"].")"; ?></option>
		<?php
			}
		}
		else
		{ echo "Not Found"; }
	}
	else
	{ echo "blank"; }
} 
if($_REQUEST['action']=='get_agent_salary')
{
	if($_POST["agentid"]!='')
	{
		$scid =mysqli_query($dlink,"SELECT salary FROM agent WHERE is_delete=0 and  id='".$_POST["agentid"]."' order by name");

		if(mysqli_num_rows($scid) > 0)
		{
		
			while($st=mysqli_fetch_array($scid))
			{ 
					echo $st['salary'];
			}
		}
		else
		{ echo "Not Found"; }
	}
	else
	{ echo "blank"; }
	exit;
}
if($_REQUEST['action']=='assign_customer_role')
{
	if($_POST["sid"]!='')
	{
		$scid =mysqli_query($dlink,"SELECT * FROM staff_roles WHERE customer='".$_POST["val"]."'");
		if(mysqli_num_rows($scid) > 0)
		{
			$query =mysqli_query($dlink,"update staff_roles set customer='".$_POST["val"]."' WHERE sid='".$_POST["sid"]."'");
			if($query)
				echo 'Success';
			else
				echo 'Fail';
			exit;
		}
		else
		{
			$query =mysqli_query($dlink,"insert into staff_roles (customer,sid)values('".$_POST["val"]."','".$_POST["sid"]."')");
			if($query)
				echo 'Success';
			else
				echo 'Fail';
			exit;
		}
		
	}
}
if($_REQUEST['action']=='assign_invoice_role')
{
	if($_POST["sid"]!='')
	{
		$scid =mysqli_query($dlink,"SELECT * FROM staff_roles WHERE sid='".$_POST["sid"]."'");
		if(mysqli_num_rows($scid) > 0)
		{
			$query =mysqli_query($dlink,"update staff_roles set invoice=".$_POST["val"]." WHERE sid='".$_POST["sid"]."'");
			if($query)
				echo 'Success';
			else
				echo 'Fail';
			exit;
		}
		else
		{
			
			$query =mysqli_query($dlink,"insert into staff_roles (invoice,sid)values(".$_POST["val"].",'".$_POST["sid"]."')");
			if($query)
				echo 'Success';
			else
				echo 'Fail';
			exit;
		}
		
	}
}
if($_REQUEST['action']=='assign_employee_role')
{
	if($_POST["sid"]!='')
	{
		$scid =mysqli_query($dlink,"SELECT * FROM staff_roles WHERE sid='".$_POST["sid"]."'");
		if(mysqli_num_rows($scid) > 0)
		{
			$query =mysqli_query($dlink,"update staff_roles set employee=".$_POST["val"]." WHERE sid='".$_POST["sid"]."'");
			if($query)
				echo 'Success';
			else
				echo 'Fail';
			exit;
		}
		else
		{
			
			$query =mysqli_query($dlink,"insert into staff_roles (employee,sid)values(".$_POST["val"].",'".$_POST["sid"]."')");
			if($query)
				echo 'Success';
			else
				echo 'Fail';
			exit;
		}
		
	}
}
if($_REQUEST['action']=='assign_report_role')
{
	if($_POST["sid"]!='')
	{
		$scid =mysqli_query($dlink,"SELECT * FROM staff_roles WHERE sid='".$_POST["sid"]."'");
		if(mysqli_num_rows($scid) > 0)
		{
			$query =mysqli_query($dlink,"update staff_roles set report=".$_POST["val"]." WHERE sid='".$_POST["sid"]."'");
			if($query)
				echo 'Success';
			else
				echo 'Fail';
			exit;
		}
		else
		{
			
			$query =mysqli_query($dlink,"insert into staff_roles (report,sid)values(".$_POST["val"].",'".$_POST["sid"]."')");
			if($query)
				echo 'Success';
			else
				echo 'Fail';
			exit;
		}
		
	}
}
if($_REQUEST['action']=='assign_expenses_role')
{
	if($_POST["sid"]!='')
	{
		$scid =mysqli_query($dlink,"SELECT * FROM staff_roles WHERE sid='".$_POST["sid"]."'");
		if(mysqli_num_rows($scid) > 0)
		{
			$query =mysqli_query($dlink,"update staff_roles set expenses=".$_POST["val"]." WHERE sid='".$_POST["sid"]."'");
			if($query)
				echo 'Success';
			else
				echo 'Fail';
			exit;
		}
		else
		{
			
			$query =mysqli_query($dlink,"insert into staff_roles (expenses,sid)values(".$_POST["val"].",'".$_POST["sid"]."')");
			if($query)
				echo 'Success';
			else
				echo 'Fail';
			exit;
		}
		
	}
}
if($_REQUEST['action']=='assign_accounts_role')
{
	if($_POST["sid"]!='')
	{
		$scid =mysqli_query($dlink,"SELECT * FROM staff_roles WHERE sid='".$_POST["sid"]."'");
		if(mysqli_num_rows($scid) > 0)
		{
			$query =mysqli_query($dlink,"update staff_roles set accounts=".$_POST["val"]." WHERE sid='".$_POST["sid"]."'");
			if($query)
				echo 'Success';
			else
				echo 'Fail';
			exit;
		}
		else
		{
			
			$query =mysqli_query($dlink,"insert into staff_roles (accounts,sid)values(".$_POST["val"].",'".$_POST["sid"]."')");
			if($query)
				echo 'Success';
			else
				echo 'Fail';
			exit;
		}
		
	}
}
if($_REQUEST['action']=='assign_shipment_tracking_role')
{
	if($_POST["sid"]!='')
	{
		$scid =mysqli_query($dlink,"SELECT * FROM staff_roles WHERE sid='".$_POST["sid"]."'");
		if(mysqli_num_rows($scid) > 0)
		{
			$query =mysqli_query($dlink,"update staff_roles set shipment_tracking=".$_POST["val"]." WHERE sid='".$_POST["sid"]."'");
			if($query)
				echo 'Success';
			else
				echo 'Fail';
			exit;
		}
		else
		{
			
			$query =mysqli_query($dlink,"insert into staff_roles (shipment_tracking,sid)values(".$_POST["val"].",'".$_POST["sid"]."')");
			if($query)
				echo 'Success';
			else
				echo 'Fail';
			exit;
		}
		
	}
}

if($_REQUEST['action']=='sendemail')
{
	$send_success=0;
	if($_POST["pid"]!='')
	{
		
		$scid =mysqli_query($dlink,"SELECT * FROM  shipment WHERE id='".$_POST["pid"]."'");
		if(mysqli_num_rows($scid) > 0)
		{
			$st=mysqli_fetch_array($scid);
			$invoice_no=$st['invoice_number'];
			$iid=$st['id'];
			
			$sender=$st['sender_email'];
			$sender_name=$st['sender_name'];
			
			$receiver=$st['desti_email'];
			$receiver_name=$st['desti_name'];
			
			if($sender!='')
			{
				$name        = $sender_name;
				$email       = $sender;
				$to          = "$name <$email>";
				/*$fromemail   = 'info@ntexpress.sa';*/
				$fromemail   = 'info@thewpbrain.com';
				$from        = "NTEXPRESS <$fromemail>";
				$subject     = "NTEXPRESS - Invoice-".$invoice_no;
				$mainMessage = "Hi, here is your attachment for invoice number:".$invoice_no;
				$fileatt     = "_private_content_shipment/l_".$iid.".pdf"; //file location
				$fileatttype = "application/pdf";
				$fileattname = "invoice-".$invoice_no.".pdf"; //name that you want to use to send or you can use the same name
				$headers = "From: $from";
				
				// File
				$file = fopen($fileatt, 'rb');
				$data = fread($file, filesize($fileatt));
				fclose($file);
				
				// This attaches the file
				$semi_rand     = md5(time());
				$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
				$headers      .= "\nMIME-Version: 1.0\n" .
				  "Content-Type: multipart/mixed;\n" .
				  " boundary=\"{$mime_boundary}\"";
				  $message = "This is a multi-part message in MIME format.\n\n" .
				  "--{$mime_boundary}\n" .
				  "Content-Type: text/plain; charset=\"iso-8859-1\n" .
				  "Content-Transfer-Encoding: 7bit\n\n" .
				  $mainMessage  . "\n\n";
				
				$data = chunk_split(base64_encode($data));
				$message .= "--{$mime_boundary}\n" .
				  "Content-Type: {$fileatttype};\n" .
				  " name=\"{$fileattname}\"\n" .
				  "Content-Disposition: attachment;\n" .
				  " filename=\"{$fileattname}\"\n" .
				  "Content-Transfer-Encoding: base64\n\n" .
				$data . "\n\n" .
				 "--{$mime_boundary}--\n";
				
				// Send the email
				if(mail($to, $subject, $message, $headers)) {
					$send_success=1;
				}
			}
			if($receiver!='')
			{
				$name        = $receiver_name;
				$email       = $receiver;
				$to          = "$name <$email>";
				/*$fromemail   = 'info@ntexpress.sa';*/
				$fromemail   = 'info@thewpbrain.com';
				$from        = "NTEXPRESS <$fromemail>";
				$subject     = "NTEXPRESS - Invoice-".$invoice_no;
				$mainMessage = "Hi, here is your attachment for invoice number:".$invoice_no;
				$fileatt     = "_private_content_shipment/l_".$iid.".pdf"; //file location
				$fileatttype = "application/pdf";
				$fileattname = "invoice-".$invoice_no.".pdf"; //name that you want to use to send or you can use the same name
				$headers = "From: $from";
				
				// File
				$file = fopen($fileatt, 'rb');
				$data = fread($file, filesize($fileatt));
				fclose($file);
				
				// This attaches the file
				$semi_rand     = md5(time());
				$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
				$headers      .= "\nMIME-Version: 1.0\n" .
				  "Content-Type: multipart/mixed;\n" .
				  " boundary=\"{$mime_boundary}\"";
				  $message = "This is a multi-part message in MIME format.\n\n" .
				  "--{$mime_boundary}\n" .
				  "Content-Type: text/plain; charset=\"iso-8859-1\n" .
				  "Content-Transfer-Encoding: 7bit\n\n" .
				  $mainMessage  . "\n\n";
				
				$data = chunk_split(base64_encode($data));
				$message .= "--{$mime_boundary}\n" .
				  "Content-Type: {$fileatttype};\n" .
				  " name=\"{$fileattname}\"\n" .
				  "Content-Disposition: attachment;\n" .
				  " filename=\"{$fileattname}\"\n" .
				  "Content-Transfer-Encoding: base64\n\n" .
				$data . "\n\n" .
				 "--{$mime_boundary}--\n";
				
				// Send the email
				if(mail($to, $subject, $message, $headers)) {
					$send_success=1;
				}
			}
		}
	}
	if($send_success==1)
		echo 'Email send successfully';
	else
		echo 'Problem in sending email';
}

if($_REQUEST['action']=='delete_cust_rvcr')
{
	$sql = "DELETE FROM customers_receiver WHERE id='".$_POST['delid']."'";

	if ($dlink->query($sql) === TRUE) {
	  echo "success";
	} else {
	  echo "error";
	}
}
if($_REQUEST['action']=='invoice_getprovince_tracking')
{
	
	$total_amount=0; $total_cash=0; $total_fc=0; $no=1;
	$uid=$userdetail['id'];
	$unm=""; $row='';
	
	$data="SELECT * FROM shipment WHERE source_state IN('".$_POST['chkids']."')" ;

	$row=mysqli_query($dlink,$data);

    if($row->num_rows)
    {
        while($b=$row->fetch_array())
        {
			$scity=fetch_query("name","location",array("location_id="=>$b['source_city']));

            $sstate=fetch_query("name","location",array("location_id="=>$b['source_state']));

            $dept_nm=fetch_query("bname","branches",array("id="=>$b['branch']));
			
			$no_pack=fetch_query("SUM(no_of_package) as total_qnty","shipment_detail",array("oid="=>$b['id']));

			$html.='
				<tr>
                    <td>'.$no.'</td>
                    <td>'.date('d-m-Y',strtotime($b['invoice_date'])).'</td>
                    <td>'.$dept_nm['bname'].'</td>
                    <td>'.$b['sales_person'].'</td>
                    <td>'.$b['invoice_number'].'</td>
                    <td>'.$b['consignment_no'].'</td>
                    <td>'.$scity['name'].'</td>
                    <td>'.$sstate['name'].'</td>
                    <td>'.$no_pack['total_qnty'].'</td>
                    <td>';
                    	if($b['delivery_date']!='1970-01-01 05:30:00'){
                    		$html.=''.date('d-m-Y H:m:s',strtotime($b['delivery_date'])).'';
                    	}
                    	else{
                    		$html.='';
                    	}
                    $html.='</td>
                    <td>'.$b['payment_cash'].'</td>
                    <td>'.$b['payment_fc'].'</td>
                    <td>'.$b['mode_of_payment'].' 
                    <i class="fa fa-edit" style="font-size:16px" data-toggle="modal" data-target="#myModal_'.$b['id'].'" data-id="'.$b['id'].'" id="editCompany"></i>

                        <div class="modal fade" id="myModal_'.$b['id'].'" role="dialog">
                            <div class="modal-dialog">
                            
                              
                            <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Mod of Payment</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="'.$b['id'].'">

                                        <input type="hidden" name="finaltotal_val" value="'.$b['finaltotal_val'].'">';

                                        if($b['mode_of_payment']== 'COD')
                                        {
                                        	$html.='<input  type="radio" name="paymentmode" value="COD" id="COD" checked> COD';
                                        }
                                        else
                                        {
                                        	$html.='<input  type="radio" name="paymentmode" value="COD" id="COD" > COD';
                                        }
                                        $html.='<br>';

                                        if($b['mode_of_payment']== 'Cash')
                                        {
                                        	$html.='<input type="radio" name="paymentmode" value="Cash" id="Cash" checked> Cash';
                                        }
                                        else
                                        {
                                        	$html.='<input type="radio" name="paymentmode" value="Cash" id="Cash"> Cash';
                                        }
                                        
                                        $html.='<br>
                                        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-success">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                        </div>
                        
                    </td>
                    <td><select name="status'.$b['id'].'" id="status'.$b['id'].'" class="form-control" onchange="change_status('.$b['id'].',this.value)">';
                        if ($b['status'] == '1') {
		        			$html.='<option selected="selected" value="1" >Pending</option>';
		        		}
		        		else{
		        			$html.='<option value="1" >Pending</option>';
		        		}
		        		if ($b['status'] == '2') {
		        			$html.='<option selected="selected" value="2" >In Process</option>';
		        		}
		        		else{
		        			$html.='<option value="2" >In Process</option>';
		        		}
		        		if ($b['status'] == '3') {
		        			$html.='<option selected="selected" value="3" >Delivered</option>';
		        		}
		        		else{
		        			$html.='<option value="3" >Delivered</option>';
		        		}
		        		if ($b['status'] == '4') {
		        			$html.='<option selected="selected" value="4" >Reject</option>';
		        		}
		        		else{
		        			$html.='<option value="4" >Reject</option>';
		        		}
		        		if ($b['status'] == '5') {
		        			$html.='<option selected="selected" value="5" >Return</option>';
		        		}
		        		else{
		        			$html.='<option value="5" >Return</option>';
		        		}
					$html.='</select> </td>
                    <td>
                    	<a style="width:57px" href="_private_content_shipment/l_'.$b['id'].'.pdf" target="_blank"  class="btn btn-info btn-xs mb-5">Invoice</a><br />
                       
                    <a style="width: 80px;color: white;" onclick="sendemail('.$b['id'].')" class="btn btn-info btn-xs mb-5">Send Email</a><br />   
                    </td>
                </tr>
			';
            $no++;
        }
    }
    echo $html;
}

if($_REQUEST['action']=='invoice_getcity_tracking')
{
	
	$total_amount=0; $total_cash=0; $total_fc=0; $no=1;
	$uid=$userdetail['id'];
	$unm=""; $row='';
	
	$data="SELECT * FROM shipment WHERE source_city IN('".$_POST['chkids']."')" ;

	$row=mysqli_query($dlink,$data);

    if($row->num_rows)
    {
        while($b=$row->fetch_array())
        {
			$scity=fetch_query("name","location",array("location_id="=>$b['source_city']));

            $sstate=fetch_query("name","location",array("location_id="=>$b['source_state']));

            $dept_nm=fetch_query("bname","branches",array("id="=>$b['branch']));
			
			$no_pack=fetch_query("SUM(no_of_package) as total_qnty","shipment_detail",array("oid="=>$b['id']));

			$html.='
				<tr>
                    <td>'.$no.'</td>
                    <td>'.date('d-m-Y',strtotime($b['invoice_date'])).'</td>
                    <td>'.$dept_nm['bname'].'</td>
                    <td>'.$b['sales_person'].'</td>
                    <td>'.$b['invoice_number'].'</td>
                    <td>'.$b['consignment_no'].'</td>
                    <td>'.$scity['name'].'</td>
                    <td>'.$sstate['name'].'</td>
                    <td>'.$no_pack['total_qnty'].'</td>
                    <td>';
                    	if($b['delivery_date']!='1970-01-01 05:30:00'){
                    		$html.=''.date('d-m-Y H:m:s',strtotime($b['delivery_date'])).'';
                    	}
                    	else{
                    		$html.='';
                    	}
                    $html.='</td>
                    <td>'.$b['payment_cash'].'</td>
                    <td>'.$b['payment_fc'].'</td>
                    <td>'.$b['mode_of_payment'].' 
                    	<i class="fa fa-edit" style="font-size:16px" data-toggle="modal" data-target="#myModal_'.$b['id'].'" data-id="'.$b['id'].'" id="editCompany"></i>

                        <div class="modal fade" id="myModal_'.$b['id'].'" role="dialog">
                            <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Mod of Payment</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="'.$b['id'].'">

                                        <input type="hidden" name="finaltotal_val" value="'.$b['finaltotal_val'].'">';

                                        if($b['mode_of_payment']== 'COD')
                                        {
                                        	$html.='<input  type="radio" name="paymentmode" value="COD" id="COD" checked> COD';
                                        }
                                        else
                                        {
                                        	$html.='<input  type="radio" name="paymentmode" value="COD" id="COD" > COD';
                                        }
                                        $html.='<br>';

                                        if($b['mode_of_payment']== 'Cash')
                                        {
                                        	$html.='<input type="radio" name="paymentmode" value="Cash" id="Cash" checked> Cash';
                                        }
                                        else
                                        {
                                        	$html.='<input type="radio" name="paymentmode" value="Cash" id="Cash"> Cash';
                                        }
                                        
                                        $html.='<br>
                                        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-success">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                        </div>
                    </td>
                    <td><select name="status'.$b['id'].'" id="status'.$b['id'].'" class="form-control" onchange="change_status('.$b['id'].',this.value)">';
                        if ($b['status'] == '1') {
		        			$html.='<option selected="selected" value="1" >Pending</option>';
		        		}
		        		else{
		        			$html.='<option value="1" >Pending</option>';
		        		}
		        		if ($b['status'] == '2') {
		        			$html.='<option selected="selected" value="2" >In Process</option>';
		        		}
		        		else{
		        			$html.='<option value="2" >In Process</option>';
		        		}
		        		if ($b['status'] == '3') {
		        			$html.='<option selected="selected" value="3" >Delivered</option>';
		        		}
		        		else{
		        			$html.='<option value="3" >Delivered</option>';
		        		}
		        		if ($b['status'] == '4') {
		        			$html.='<option selected="selected" value="4" >Reject</option>';
		        		}
		        		else{
		        			$html.='<option value="4" >Reject</option>';
		        		}
		        		if ($b['status'] == '5') {
		        			$html.='<option selected="selected" value="5" >Return</option>';
		        		}
		        		else{
		        			$html.='<option value="5" >Return</option>';
		        		}
					$html.='</select> </td>
                    <td>
                    	<a style="width:57px" href="_private_content_shipment/l_'.$b['id'].'.pdf" target="_blank"  class="btn btn-info btn-xs mb-5">Invoice</a><br />
                     
                    <a style="width: 80px;color: white;" onclick="sendemail('.$b['id'].')" class="btn btn-info btn-xs mb-5">Send Email</a><br />   
                    </td>
                </tr>
			';
            $no++;
        }
    }
    echo $html;
}
if($_REQUEST['action']=='paymentmode')
{
	$query = fetch_query("*","shipment",array("id="=>$_POST['invoice_id']));
	echo $query['mode_of_payment'];
	exit;
}
if($_REQUEST['action']=='allrecordexpense')
{
	$allid = $_POST['allVals'];
	foreach ($allid as $key => $value) 
	{
		$delete = delete_query('record_expense',array("id="=>$value));
	}
	if($delete)
	{
		echo "success";
	}
	else
	{
		echo "error";
	}
}

?>