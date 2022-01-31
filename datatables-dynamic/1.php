<?php include("../connection.php");
include("../query.php");

$from_date=''; $to_date='';
		if($_POST['from_date']!='');
			$from_date=date('Y-m-d',strtotime('01-08-2020'));
		if($_POST['to_date']!='');
			$to_date=date('Y-m-d',strtotime('08-08-2020'));
			
		
		$startTime=''; $endTime ='';

		
		$source_state='1318';
		$source_city='5380';
		
		$sel_qry="SELECT * FROM `shipment` WHERE 1 ";
		if($source_state!='' && $source_state!=0)
		{
			$sel_qry.=" and source_state='1318'";
		}
		if($source_city!='' && $source_city!=0)
		{
			$sel_qry.=" and source_city='5380'";
		}
		if($from_date!='' && $to_date!='' && $from_date!='1970-01-01' && $to_date!='1970-01-01')
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
			$k=0;
			for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) 
			{
  				$thisDate = date( 'd-m-Y', $i );
				$invoice_date = date( 'Y-m-d', $i );
				$row_array=array();
				$row_array['sr_no']=$no;
				$row_array['date']=$thisDate;
			
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
				$sel_qry=mysqli_query($dlink,"SELECT * FROM location WHERE 1 and location_id=".$City[$j]);
				$city_name=mysqli_fetch_assoc($sel_qry);
				$total_ship_charge=0;
				if($R['Total_Ship_Charge']=="")
					$total_ship_charge=0;
				else
					$total_ship_charge=$R['Total_Ship_Charge'];
				
				$citynamekey='City_'.$city_name['name'];
				$row_array[$citynamekey]=$total_ship_charge;
				//$city_array_chk.="[City_".$city_name['name']."]=>".$total_ship_charge.",";
				
				//$data['data'][$k][] = array( 'City_'.$city_name['name']=>$total_ship_charge, );
				$total_amount=$total_amount+$R['Total_Ship_Charge'];
			}
			
				
				//$data['data'][]=array('sr_no'=>$no,'date'=>$thisDate,);
				$data['data'][]=$row_array;
				$k++;
				$no++;
			}
			/*$data['data'][] = array(
					
					"sr_no"=>' ',
					"date"=>' <b>Total</b>',
					"cash"=>$total_cash,
					"fc"=>$total_fc,
					"total"=>$total_amount,
				);*/
			
		
		
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
			$sel_qry=mysqli_query($dlink,"SELECT * FROM location WHERE 1 and location_id=".$City[$j]);
			$city_name=mysqli_fetch_assoc($sel_qry);
			$data['columns'][] = array(
			"data"=>"City_".$city_name['name'],
            "name"=>$city_name['name']
			);
		}
		
		print_r($data);
		//echo json_encode($data);
		
	?>