<?php include("connection.php");
include("query.php");

		
		## Total number of records without filtering
		
	
		$from_date=''; $to_date='';
		if($_POST['from_date']!='');
			$from_date=date('Y-m-d',strtotime($_POST['from_date']));
		if($_POST['to_date']!='');
			$to_date=date('Y-m-d',strtotime($_POST['to_date']));
		
		$source_state=$_POST['source_state'];
		$source_city=$_POST['source_city'];
		
		//$destination_state=$_POST['destination_state'];
		//$destination_city=$_POST['destination_city'];
		
		$qry="SELECT * FROM `shipment` WHERE 1 ";
		
		if($source_state!='' && $source_state!=0)
			$qry.=" and source_state='$source_state'";
		if($source_city!='' && $source_city!=0)
			$qry.=" and source_city='$source_city'";
		if($from_date!='' && $to_date!='' && $from_date!='1970-01-01' && $to_date!='1970-01-01')
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
			while($R=mysqli_fetch_assoc($empRecords))
			{
				$data['data'][] = array(
					
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
			
		}
		$data['columns'][] = array(
			"data"=>"sr_no",
            "name"=>"sr_no"
		);
		$data['columns'][] = array(
			"data"=>"date",
            "name"=>"date"
		);
		$data['columns'][] = array(
			"data"=>"cash",
            "name"=>"cash"
		);
		$data['columns'][] = array(
			"data"=>"fc",
            "name"=>"fc"
		);
		$data['columns'][] = array(
			"data"=>"total",
            "name"=>"total"
		);
		//$data[] = array("sr_no"=>$qry.'---'); 
	
		## Response
	
		
		echo json_encode($data);
		?>