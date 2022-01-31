<?php include("header.php"); ?>
<?php include("leftpanel.php"); 
$ccity=$userdetail['city'];
global $dlink; 
$dt=date('Y-m-d'); 
$mnt=date('m'); 
$yr=date('Y'); 

// Start Box 1 & 2
$total_sale=0;
$sel_total_sale=$dlink->query("select sum(finaltotal_val) as sale_amount from shipment where Date(invoice_date) = Date('".$dt."')");
$sel_total_sale=$sel_total_sale->fetch_array();
if($sel_total_sale['sale_amount']!="")
	$total_sale=number_format($sel_total_sale['sale_amount'],2,'.', '');

$total_sale_month=0;
$sel_total_sale_month=$dlink->query("select sum(finaltotal_val) as sale_amount from shipment where Month(invoice_date) = '".$mnt."' and Year(invoice_date) = '".$yr."' ");
$sel_total_sale_month=$sel_total_sale_month->fetch_array();
if($sel_total_sale_month['sale_amount']!="")
	$total_sale_month=number_format($sel_total_sale_month['sale_amount'],2,'.', '');
// End Box 1 & 2

// Start Box 3 & 4
$total_invoice=0;
$sel_total_invoice=$dlink->query("select count(id) as total_invoice from shipment where Date(invoice_date) = Date('".$dt."')");
$sel_total_invoice=$sel_total_invoice->fetch_array();
if($sel_total_invoice['total_invoice']!="")
	$total_invoice=$sel_total_invoice['total_invoice'];

$total_invoice_month=0;
$sel_total_invoice_month=$dlink->query("select count(id) as total_invoice from shipment where Month(invoice_date) = '".$mnt."' and Year(invoice_date) = '".$yr."' ");
$sel_total_invoice_month=$sel_total_invoice_month->fetch_array();
if($sel_total_invoice_month['total_invoice']!="")
	$total_invoice_month=$sel_total_invoice_month['total_invoice'];
// End Box 3 & 4

// Start Box 5 & 6
$total_expense=0;
$sel_total_expense=$dlink->query("select sum(exp_amount) as exp_amount from expenses where Month(expense_for_month)='".$mnt."' and Year(expense_for_month) = '".$yr."'");
$sel_total_expense=$sel_total_expense->fetch_array();
if($sel_total_expense['exp_amount']!="")
	$total_expense=$sel_total_expense['exp_amount']; 

$daily_expense=0;
$sel_daily_expense=$dlink->query("select sum(exp_amount) as exp_amount from expenses where Date(expense_for_month)='".$dt."'");
$sel_daily_expense=$sel_daily_expense->fetch_array();
if($sel_daily_expense['exp_amount']!="")
	$daily_expense=$sel_daily_expense['exp_amount'];
// End Box 5 & 6
	
// Start Box 7 & 8
$daily_zakath=0;
$daily_zakath=($total_sale-$daily_expense)*2;

$toal_zakath=0;
$toal_zakath=($total_sale_month-$total_expense)*2;


// End Box 7 & 8
$total_income=0;
$sel_total_income=$dlink->query("select sum(total_amount) as income_amount from shipment where Month(invoice_date)='".$mnt."' and Year(invoice_date) = '".$yr."' ");
$sel_total_income=$sel_total_income->fetch_array();
if($sel_total_income['income_amount']!="")
	$total_income=$sel_total_income['income_amount'];

$daily_income=0;
$sel_daily_income=$dlink->query("select sum(total_amount) as income_amount from shipment where Date(invoice_date)='".$dt."' and Year(invoice_date) = '".$yr."'");
$sel_daily_income=$sel_daily_income->fetch_array();
if($sel_daily_income['income_amount']!="")
	$daily_income=$sel_daily_income['income_amount'];


$daily_profit=0;
$daily_profit=$daily_income-$daily_expense-$daily_zakath;

$total_profit=0;
$total_profit=$total_income-$total_expense-$toal_zakath;


$biggest_ship=0; $big_scity=''; $big_dcity='';
$sel_biggest_ship=$dlink->query("select * from shipment where total_amount!='NaN' and invoice_date='$dt'");
if($sel_biggest_ship->num_rows>0)
{
	$sel_city=$sel_biggest_ship->fetch_array();
	
	$sel_biggest_ship_all=$dlink->query("select max(total_amount) as max_amount,source_city,destination_city from shipment where total_amount!='NaN' and invoice_date='$dt'");
	$sel_biggest_ship_all=$sel_biggest_ship_all->fetch_array();
	$biggest_ship=$sel_biggest_ship_all['max_amount'];
	$sel_scity=fetch_query("name","location",array("location_id="=>$sel_city['source_city']));
	$sel_dcity=fetch_query("name","location",array("location_id="=>$sel_city['destination_city']));
	$big_scity=$sel_scity['name']; 
	$big_dcity=$sel_dcity['name'];
}

?>
<style>
	.bg-green{
		width: 100%;
	    background: #ecfdee;
	    height: auto;
	    border-radius: 20px;
		margin-bottom: 30px;
	}

	.bg-blue{
		width: 100%;
	    background: #e2f6fa;
	    height: auto;
	    border-radius: 20px;
		margin-bottom: 30px;
	}
	.box-desh{
		/*width: 100%;
	    background: bisque;
	    height: 128px;
	    padding: 10px 10px 10px 10px;
	    border-radius: 8px;
	    border: 1px solid grey;*/
		padding: 10px 10px 10px 10px;
	    text-align: center;
	}
	.box-green-p{
		padding: 15px 15px 15px 15px;
	}
	.fa-1 i{font-size: 25px; color: #262626; border: 1px solid #d4d4d4; padding: 12px;  border-radius: 6px;}
	.lable-dash{
		text-align: center;
		padding: 9px; 
		color: #262626;
	}
	.border-dash{
		    border-right: 1px solid #d4d4d4;
	}
	.box-ship-1{
		margin-bottom: 30px;
	    background: #d2ddf5;
	    height: 130px;
	    border-radius: 15px;
	    width: 100%;
	}
	.box-ship-1{
		padding: 19px 15px 15px 15px;
	}
	.fa-purple{
		padding: 20px 11px 15px 8px;
	    font-size: 20px;
	    color: #262626;
	}

	.box-ship-2{
		margin-bottom: 30px;
	    background: #f5f4cc;
	    height: 130px;
	    border-radius: 15px;
	    width: 100%;
		padding: 19px 15px 15px 15px;
	}

	.box-ship-4{
		margin-bottom: 30px;
	    background: #ffeee0;
	    height: 130px;
	    border-radius: 15px;
	    width: 100%;
		padding: 19px 15px 15px 15px;
	}

	.box-ship-5{
		margin-bottom: 30px;
	    background: #ccf5ef;
	    height: 130px;
	    border-radius: 15px;
	    width: 100%;
		padding: 19px 15px 15px 15px;
	}

	.progress {
	  width: 90px;
	  height: 90px;
	  background: none;
	  position: relative;
	}

	.progress::after {
	  content: "";
	  width: 100%;
	  height: 100%;
	  border-radius: 50%;
	  border: 6px solid #eee;
	  position: absolute;
	  top: 0;
	  left: 0;
	}

	.progress>span {
	  width: 50%;
	  height: 100%;
	  overflow: hidden;
	  position: absolute;
	  top: 0;
	  z-index: 1;
	}

	.progress .progress-left {
	  left: 0;
	}

	.progress .progress-bar {
	  width: 100%;
	  height: 100%;
	  background: none;
	  border-width: 6px;
	  border-style: solid;
	  position: absolute;
	  top: 0;
	}

	.progress .progress-left .progress-bar {
	  left: 100%;
	  border-top-right-radius: 80px;
	  border-bottom-right-radius: 80px;
	  border-left: 0;
	  -webkit-transform-origin: center left;
	  transform-origin: center left;
	}

	.progress .progress-right {
	  right: 0;
	}

	.progress .progress-right .progress-bar {
	  left: -100%;
	  border-top-left-radius: 80px;
	  border-bottom-left-radius: 80px;
	  border-right: 0;
	  -webkit-transform-origin: center right;
	  transform-origin: center right;
	}

	.progress .progress-value {
	  position: absolute;
	  top: 0;
	  left: 0;
	}
	.border-primary {
	    border-color: #262626 !important;
	}
	.small{
		top: -2px;
	}
	.box-ship-3 {
	    background: black;
	    border-radius: 15px;
	    height: auto;
	    padding: 40px 15px 57px 15px;
	}
	.black-box {
	    background: white;
	    border-radius: 100%;
	    width: 50px;
	    font-size: 24px;
	    text-align: center;
	    color: black;
	    height: 50px;
	    margin-left: 20px;
	    padding: 5px;
	}
	.fonts-black{
		margin-bottom: 30px;
	}
	.bg-grey-ship{
		background: #f3f6fa;
	    padding: 15px 15px 1px 15px;
	    border-radius: 15px;
		margin-bottom: 15px;
	}
	.bg-green-ship{
		background: #ccf5ef;
	    padding: 15px 15px 1px 15px;
	    border-radius: 15px;
		margin-bottom: 15px;
	}
	.sales-chart{
		background: #f3f6fa;
	    width: 100%;
	    height: auto;
		border-radius: 15px;
		padding: 15px;
		margin-bottom: 10px;
	}
	@media screen and (max-width: 400px){
		.box-ship-1 {
			height: auto;
		}
		.fonts-ship{
			text-align: center;
		}
		.fa-purple {
			text-align: center;
		}
		.box-ship-4 {
			height: auto;
		}
		.box-ship-2 {
			height: auto;
		}
		.box-ship-3 {
			height: auto;
		}
		.box-ship-5 {
			height: auto;
		}
	}
	@media screen and (min-width: 401px) and (max-width: 767px){
		.box-ship-1 {
			height: auto;
		}
		.fonts-ship{
			text-align: center;
		}
		.fa-purple {
			text-align: center;
		}
		.box-ship-4 {
			height: auto;
		}
		.box-ship-2 {
			height: auto;
		}
		.box-ship-3 {
			height: auto;
		}
		.box-ship-5 {
			height: auto;
		}
	}
	@media screen and (min-width: 768px) and (max-width: 992px){
			.box-ship-1 {
			height: auto;
		}
		.fonts-ship{
			text-align: center;
		}
		.fa-purple {
			text-align: center;
		}
		.box-ship-4 {
			height: auto;
		}
		.box-ship-2 {
			height: auto;
		}
		.box-ship-3 {
			height: auto;
		}
		.box-ship-5 {
			height: auto;
		}
		.fonts-black {
			margin-bottom: 30px;
			margin-top: 55px;
			margin-left: -30px;
		}
		.resp-dis{
			display: none;
		}
		.res-paid{
			display: contents;
		}
		.ipad-left{
			margin-left: 57px;
		}
	}
</style>

<div class="content-wrapper">

    <section class="content-header">

        <h1>Dashboard</h1>

    </section>

    <!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="bg-green box-green-p">
					<div class="row"> 
						<div class="col-lg-3 col-md-3 col-sm-12 border-dash">
							<div class="box-desh fa-1">
								<i class="fas fa-chart-line"></i>
							</div>
							<div class="lable-dash">
								<label style="margin-bottom: 0px;"> Today Sales </label>
								<h3 style="margin: 0px; color: #262626;">SAR <?php echo $total_sale;?></h3>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-3 col-sm-12 border-dash">
							<div class="box-desh fa-1">
								<i class="fas fa-chart-bar"></i>
							</div>
							<div class="lable-dash">
								<label style="margin-bottom: 0px;"> This Month Sales </label>
								<h3 style="margin: 0px; color: #262626;">SAR <?php echo $total_sale_month;?></h3>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-3 col-sm-12 border-dash">
							<div class="box-desh fa-1">
								<i class="fas fa-file-invoice"></i>
							</div>
							<div class="lable-dash">
								<label style="margin-bottom: 0px;"> Today Invoices </label>
								<h3 style="margin: 0px; color: #262626;"><?php echo $total_invoice;?></h3>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-3 col-sm-12">
							<div class="box-desh fa-1">
								<i class="fas fa-layer-group"></i>
							</div>
							<div class="lable-dash">
								<label style="margin-bottom: 0px;"> This Month Invoices </label>
								<h3 style="margin: 0px; color: #262626;"><?php echo $total_invoice_month;?></h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="bg-blue box-green-p">
					<div class="row"> 
						<div class="col-lg-3 col-md-3 col-sm-12 border-dash">
							<div class="box-desh fa-1">
								<i class="fas fa-dollar-sign"></i>
							</div>
							<div class="lable-dash">
								<label style="margin-bottom: 0px;"> Today Expense </label>
								<h3 style="margin: 0px; color: #262626;">SAR <?php echo $daily_expense;?></h3>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-3 col-sm-12 border-dash">
							<div class="box-desh fa-1">
								<i class="fas fa-dollar-sign"></i>
							</div>
							<div class="lable-dash">
								<label style="margin-bottom: 0px;"> This Month Expense </label>
								<h3 style="margin: 0px; color: #262626;">SAR <?php echo $total_expense;?></h3>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-3 col-sm-12 border-dash">
							<div class="box-desh fa-1">
								<i class="fas fa-donate"></i>
							</div>
							<div class="lable-dash">
								<label style="margin-bottom: 0px;"> Today Zakat </label>
								<h3 style="margin: 0px; color: #262626;"><?php echo $daily_zakath;?></h3>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-3 col-sm-12">
							<div class="box-desh fa-1">
								<i class="fas fa-copy"></i>
							</div>
							<div class="lable-dash">
								<label style="margin-bottom: 0px;"> This Month Zakat </label>
								<h3 style="margin: 0px; color: #262626;"><?php echo $toal_zakath;?></h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-12 col-12">
						<div class="ship-box">
							<div class="row"> 
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="box-ship-1">
										<div class="row"> 
											<div class="col-lg-2 col-md-2 col-sm-12">
												<div class="fa-purple">
													<i class="fas fa-bus"></i>
												</div>
											</div>
											
											<div class="col-lg-5 col-md-5 col-sm-12">
												<div class="fonts-ship">
													<h5 style="color: #262626;">Shipments</h5>
													<p style="font-size: 9px;">Total Today Shipments</p>
													<h4 style="color: #262626;">100</h4>
												</div>
											</div>
											
											<div class="col-lg-5 col-md-5 col-sm-12 res-paid">
												<div class="progress mx-auto" data-value='80'>
													  <span class="progress-left">
															<span class="progress-bar border-primary"></span>
													  </span>
													  <span class="progress-right">
															<span class="progress-bar border-primary"></span>
													  </span>
													  <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
														<div class="h4 font-weight-bold">80<sup class="small">%</sup></div>
													  </div>
												</div>
											</div>
										</div>
									</div>		

								<div class="box-ship-4">
										<div class="row"> 
											<div class="col-lg-2 col-md-2 col-sm-12">
												<div class="fa-purple">
													<i class="fas fa-undo-alt"></i>
												</div>
											</div>
											
											<div class="col-lg-5 col-md-5 col-sm-12">
												<div class="fonts-ship">
													<h5 style="color: #262626;">Return</h5>
													<p style="font-size: 9px;">Shipments Returned Today</p>
													<h4 style="color: #262626;">10</h4>
												</div>
											</div>
											
											<div class="col-lg-5 col-md-5 col-sm-12 res-paid">
												<div class="progress mx-auto" data-value='80'>
													  <span class="progress-left">
															<span class="progress-bar border-primary"></span>
													  </span>
													  <span class="progress-right">
															<span class="progress-bar border-primary"></span>
													  </span>
													  <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
														<div class="h4 font-weight-bold">80<sup class="small">%</sup></div>
													  </div>
												</div>
											</div>
										</div>
									</div>							
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="box-ship-2">
										<div class="row"> 
											<div class="col-lg-2 col-md-2 col-sm-12">
												<div class="fa-purple">
													<i class="fas fa-truck"></i>
												</div>
											</div>
											
											<div class="col-lg-5 col-md-5 col-sm-12">
												<div class="fonts-ship">
													<h5 style="color: #262626;">Delivery</h5>
													<p style="font-size: 9px;">Shipments Delivery Today</p>
													<h5 style="color: #262626;">70</h5>
												</div>
											</div>
											
											<div class="col-lg-5 col-md-5 col-sm-12 res-paid">
												<div class="progress mx-auto" data-value='80'>
													  <span class="progress-left">
															<span class="progress-bar border-primary"></span>
													  </span>
													  <span class="progress-right">
															<span class="progress-bar border-primary"></span>
													  </span>
													  <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
														<div class="h4 font-weight-bold">80<sup class="small">%</sup></div>
													  </div>
												</div>
											</div>
										</div>
									</div>	

									<div class="box-ship-5">
										<div class="row"> 
											<div class="col-lg-2 col-md-2 col-sm-12">
												<div class="fa-purple">
													<i class="fa fa-spinner"></i>
												</div>
											</div>
											
											<div class="col-lg-5 col-md-5 col-sm-12">
												<div class="fonts-ship">
													<h5 style="color: #262626;">Process</h5>
													<p style="font-size: 9px;">Today Shipment in process</p>
													<h5 style="color: #262626;">30</h5>
												</div>
											</div>
											
											<div class="col-lg-5 col-md-5 col-sm-12 res-paid">
												<div class="progress mx-auto" data-value='80'>
													  <span class="progress-left">
															<span class="progress-bar border-primary"></span>
													  </span>
													  <span class="progress-right">
															<span class="progress-bar border-primary"></span>
													  </span>
													  <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
														<div class="h4 font-weight-bold">80<sup class="small">%</sup></div>
													  </div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>	
						</div>
						
						<div class="">
							<h4 style="color: #262626;">Total Unpaid Invoices</h4>
							<div class="bg-grey-ship">
								<div class="row">
								<div class="col-sm-12 col-md-4 col-lg-4">
									<h6 style="color: #262626; margin-bottom: 0px;">Invoice Amount</h6>
									<h3 style="color: #262626; margin-top: 0px;">SAR3,297.00</h3>
								</div>
								
								<div class="col-sm-12 col-md-5 col-lg-5 resp-dis">

								</div>
								
								<div class="col-sm-12 col-md-3 col-lg-3 ipad-left">
									<h6 style="color: #262626; margin-bottom: 0px;">Delivery Amount</h6>
									<h3 style="color: #262626; margin-top: 0px;">SAR1,297.00</h3>
								</div>
								</div>
							</div>
						</div>
					</div>
				
					
					
						<div class="col-lg-4 col-md-4 col-sm-12">
							<div class="box-ship-3">
								<h4 style="color: white; margin-bottom: 25px;">VAT Collections</h4>
								<div class="row"> 
									<div class="col-lg-3 col-md-3 col-sm-12">
										<div class="black-box">
											<i class="fas fa-file-excel"></i>
										</div>
									</div>
									
									<div class="col-lg-8 col-md-8 col-sm-12">
										<div class="fonts-black">
											<h6 style="color: #1ecb75;margin-bottom: 2px;"> Total Input VAT </h6>
											<h4 style="color: white"> SAR3,297.00 </h4>
										</div>
									</div>
								</div>
								
								<div class="row"> 
									<div class="col-lg-3 col-md-3 col-sm-12">
										<div class="black-box">
											<i class="fas fa-file"></i>
										</div>
									</div>
									
									<div class="col-lg-8 col-md-8 col-sm-12">
										<div class="fonts-black">
											<h6 style="color: #1ecb75;margin-bottom: 2px;"> Total Output VAT </h6>
											<h4 style="color: white"> SAR1,297.00 </h4>
										</div>
									</div>
								</div>
								
								<div class="row"> 
									<div class="col-lg-3 col-md-3 col-sm-12">
										<div class="black-box">
											<i class="fas fa-file-alt"></i>
										</div>
									</div>
									
									<div class="col-lg-8 col-md-8 col-sm-12">
										<div class="fonts-black">
											<h6 style="color: #1ecb75;margin-bottom: 2px;"> This Month Input VAT </h6>
											<h4 style="color: white"> SAR1,297.00 </h4>
										</div>
									</div>
								</div>
								
								<div class="row"> 
									<div class="col-lg-3 col-md-3 col-sm-12">
										<div class="black-box">
											<i class="fas fa-file-alt"></i>
										</div>
									</div>
									
									<div class="col-lg-8 col-md-8 col-sm-12">
										<div class="fonts-black">
											<h6 style="color: #1ecb75;margin-bottom: 2px;"> This Month Output VAT </h6>
											<h4 style="color: white"> SAR1,297.00 </h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<div class="col-sm-12 col-md-6 col-lg-6">
						<h4 style="color: #262626;">Sales and expense</h4>
						<div class="sales-chart">
							<img src="images/1.jpg" style="width: 90%;">
						</div>
						<div class="bg-green-ship">
								<div class="row">
								<div class="col-sm-12 col-md-4 col-lg-4">
									<h6 style="color: #262626; margin-bottom: 0px;">Total Revenue</h6>
									<h3 style="color: #262626; margin-top: 0px;">SAR3,297.00</h3>
								</div>
								
								<div class="col-sm-12 col-md-4 col-lg-4 resp-dis">

								</div>
								
								<div class="col-sm-12 col-md-4 col-lg-4 ipad-left">
									<h6 style="color: #262626; margin-bottom: 0px;">Total Profit</h6>
									<h3 style="color: #262626; margin-top: 0px;">SAR3,297.00</h3>
								</div>
								</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6 col-lg-6">
						<h4 style="color: #262626;">Branch Sales</h4>
						<div class="sales-chart">
							<img src="images/2.jpg" style="width: 90%;">
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12">
					<h4 style="color: #262626;">Graphical Representation of Sales, Income and Profit</h4>
					<div class="sales-chart">
							<img src="images/3.jpg" style="width: 90%;">
						</div>
				</div>
			</div>
		
	</section>
	
	
	
    <section class="content">

        <div class="row">
        	<?php
			if(@$_SESSION['ntexpress_retroadm']!='')
			{ ?>
            <?php /*?><div class="col-lg-3 col-md-3 col-sm-6 col-12">

                <div class="box box-body bg-info topbox-four">

                    <i class="fas fa-coins"></i>

                    <div class="">

                        <h1> <?php echo $daily_expense?> </h1>

                        <h3> Today's Expenses </h3>

                    </div>

                </div>

            </div>


            <div class="col-lg-3 col-md-3 col-sm-6 col-12">

                <div class="box box-body bg-danger topbox-four">

                    <i class="fas fa-hand-holding-usd"></i>

                    <div class="">

                        <h1> <?php echo $daily_income?> </h1>

                        <h3> Today's Income </h3>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-12">

                <div class="box box-body bg-primary topbox-four">

                    <i class="fas fa-chart-line"></i>

                    <div class="">

                        <h1> <?php echo $daily_profit?> </h1>

                        <h3> Today's Profit </h3>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-12">

                <div class="box box-body topbox-four bg-success">

                    <i class="fas fa-donate"></i>

                    <div class="">

                        <h1> <?php echo $daily_zakath?> </h1>

                        <h3> Today's Zakath </h3>

                    </div>

                </div>

            </div>
            <!-- daily -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-12">

                <div class="box box-body bg-warning topbox-four">

                    <i class="fas fa-coins"></i>

                    <div class="">

                        <h1> <?php echo $total_expense?> </h1>

                        <h3> Total Expenses </h3>

                    </div>

                </div>

            </div>

			
            <div class="col-lg-3 col-md-3 col-sm-6 col-12">

                <div class="box box-body bg-success topbox-four">

                    <i class="fas fa-hand-holding-usd"></i>

                    <div class="">

                        <h1> <?php echo $total_income?> </h1>

                        <h3> Total Income </h3>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-12">

                <div class="box box-body bg-info topbox-four">

                    <i class="fas fa-chart-line"></i>

                    <div class="">

                        <h1> <?php echo $total_profit?> </h1>

                        <h3> Total Profit </h3>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-12">

                <div class="box box-body topbox-four bg-dark">

                    <i class="fas fa-donate"></i>

                    <div class="">

                        <h1> <?php echo $toal_zakath?> </h1>

                        <h3> Total Zakath </h3>

                    </div>

                </div>

            </div><?php */?>

            <?php /*?><div class="col-lg-6 col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Monthly Sales</h4>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <!--<canvas id="chart_8" style="height:450px"></canvas>-->
                            <div id="chartContainer" style="height: 450px; width: 100%;"></div>
                        </div>
                    </div>

                </div>

            </div>
			<!-- end for daily -->
            <div class="col-lg-6 col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Region Wise Income</h4>
                    </div>
                    <div class="box-body">
                        <p class="m-t-30">Lorem ipsum dolor sit amet, ectetur adipiscing elit. viverra tellus. ipsumdolorsitda amet, ectetur adipiscing elit. Ectetur adipiscing elit. viverra tellus.ipsum dolor sit.</p>
                        <p>Lorem ipsum dolor sit amet, ectetur adipiscing elit. viverra tellus.</p>
                        <div class="chart">
                            <div id="morris-area-chart" style="height:365px;"></div>
                           <!-- <div id="area-chart" style="height:365px;"></div>-->
                        </div>
                    </div>

                </div>

            </div><?php */?>

            <div class="col-lg-8 col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Order Status</h4>
                    </div>
                    <div class="box-body pt-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Order date</th>
                                        <th>Amount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Consignment Number</th>
                                    </tr>
                                </thead>
                                 <tbody>
                                 <?php $total_amount=0;
								   $total_cash=0;
								   $total_fc=0;
									  $no=1;
									  $row=select_query("*","shipment","", "id desc limit 8");
									  if($row->num_rows)
									  {
										  while($b=$row->fetch_array())
										  { 
										  	$sstate=fetch_query("name","location",array("location_id="=>$b['source_state']));
									  		$scity=fetch_query("name","location",array("location_id="=>$b['source_city']));
									  
									  
									  		$dstate=fetch_query("name","location",array("location_id="=>$b['destination_state']));
									  		$dcity=fetch_query("name","location",array("location_id="=>$b['destination_city']));
										  	?>
                               				<tr>
                                                <td><a href="javascript:void(0)" class="btn-link"> #<?php echo $b['invoice_number']; ?></a></td>
                                                <td><?php echo $sstate['name']; ?> - <?php echo $scity['name']; ?></td>
                                                <td><?php echo $dstate['name']; ?> - <?php echo $dcity['name']; ?></td>
                                                <td><span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo date('d-m-Y',strtotime($b['invoice_date'])); ?></span></td>
                                                <td><?php echo $b['total_amount']; ?></td>
                                                <td class="text-center">
                                                <?php
													if($b['payment_fc']!='0.00' && $b['total_amount']==$b['payment_cash'] )
													{
														?><div class="label label-table label-danger">Full Amt. Pending</div><?php
													}
													else
													{ 
														if($b['payment_fc']!='0.00')
														{ ?>
															<div class="label label-table label-warning">Unpaid-<?php echo $b['payment_fc']?></div> <?php
														}
														else if($b['payment_fc']=='0.00')
														{
															?><div class="label label-table label-success">Paid</div><?php
														}
														
													}
													?>
                                                	<!--<div class="label label-table label-warning">Unpaid</div>
                                                   	<div class="label label-table label-danger">Refunded</div>
                                                    <div class="label label-table label-success">Paid</div>--> 
                                                </td>
                                                <td class="text-center"><?php echo $b['consignment_no']; ?></td>
                                            </tr> 
                                    <?php }
									  }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!--<div class="col-lg-4 col-12">
                <div class="box bg-img box-inverse" style="background-image: url(images/4.jpg);" data-overlay="5">
                    <div class="box-body">
                        <div class="p-5">
                            <input type="hidden" name="hcity" id="hcity" value="<?php echo $ccity?>" />
                            <h3 class="white">
                                <span class="font-size-30" id="spancity"><?php echo $ccity?></span>
                            </h3>
                            <p class="weather-day-date mb-30">
                                <span class="mr-5"><?php echo date('l');?></span> <?php echo date('M d, Y')?>
                            </p>
                            <div class="mb-35 weather-icon">
                                <!--<canvas class="mr-40 text-top" id="icon1" width="90" height="90"></canvas>-->
                                <!--<div class="inline-block">
                                    
                                    <span class="font-size-50" id="spantemp">29°
                                        <span class="font-size-40">C</span>
                                    </span>
                                    <p class="text-left" id="spanweather">DAY RAIN</p>
                                </div>
                            </div>
                            <div class="row no-space">-->
                                <!--<div class="col-2">
                                    <div>
                                        <div class="mb-10">TUE</div>
                                        <i class="wi-day-sunny font-size-30 mb-10"></i>
                                        <div>24°
                                            <span class="font-size-12">C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <div class="mb-10">WED</div>
                                        <i class="wi-day-cloudy font-size-30 mb-10"></i>
                                        <div>21°
                                            <span class="font-size-12">C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <div class="mb-10">THU</div>
                                        <i class="wi-day-sunny font-size-30 mb-10"></i>
                                        <div>25°
                                            <span class="font-size-12">C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <div class="mb-10">FRI</div>
                                        <i class="wi-day-cloudy-gusts font-size-30 mb-10"></i>
                                        <div>20°
                                            <span class="font-size-12">C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <div class="mb-10">SAT</div>
                                        <i class="wi-day-lightning font-size-30 mb-10"></i>
                                        <div>18°
                                            <span class="font-size-12">C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <div class="mb-10">SUN</div>
                                        <i class="wi-day-storm-showers font-size-30 mb-10"></i>
                                        <div>14°
                                            <span class="font-size-12">C</span>
                                        </div>
                                    </div>
                                </div>-->
                                
                          <!--  </div>
                        </div>
                    </div>-->
                    <!-- /.box-body -->
              <!--  </div>-->
                <!-- /.box -->
            <div class="col-lg-4 col-12">
                <div class="box-group">
                    <div class="box">
                        <div class="vertical-align h-160">
                            <div class="vertical-align-middle font-size-30 text-center w-p100">
                                <span class="mr-10"><i class="fas fa-chart-line"></i></span>
                                <span class="countnm"><?php echo $biggest_ship?></span>
                                <div class="font-size-16 mt-3 text-fade"><?php if($big_scity!='' && $big_dcity!='') { ?> From: <?php echo $big_scity?> - To: <?php echo $big_dcity; } else { ?>No Shipment <?php }?></div>
                            </div>
                        </div>
                    </div>
                    <div class="box bg-primary">
                        <div class="vertical-align text-center p-30 h-160">
                            <div class="vertical-align-middle font-size-25">
                                <p>Today's Biggest</p>
                                <p>Shipping Amount</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <?php
			} 
			else if(@$_SESSION['ntexpress_retroagent']!='')
			{
			
				echo '	<div class="col-lg-12 col-12"><h3>Welcome '.$userdetail['fname'] .'</h3></div>';
				?>
			<br>
			<br>
			<br>
				<div class="col-lg-12 col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Order Status</h4>
                    </div>
                    <div class="box-body pt-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Branch</th>
                                    <th>Sales Person</th>
                                    <th>Invoice No.</th>
                                    <th>Cons. No.</th>
                                    <th>City</th>
                                    <th>Province</th>                                 
                                    <th>No of packages</th> 
                                    <th>Delivery date</th> 
                                    <th>Amount</th>
                                    <th>Balance</th> 
                                    <th>Status</th>
                                    <th></th>  
                                </thead>
                                <tbody>
                            <?php 
                                $total_amount=0; $total_cash=0; $total_fc=0; $no=1;

                                $row=select_query("*","shipment", array("sales_person="=>$_SESSION['ntexpress_retrostaff']), "id desc limit 10");
                                if($row->num_rows)
                                {
                                    while($b=$row->fetch_array())
                                    {
                                        $scity=fetch_query("name","location",array("location_id="=>$b['source_city']));

                                        $sstate=fetch_query("name","location",array("location_id="=>$b['source_state']));

                                        $dept_nm=fetch_query("bname","branches",array("id="=>$b['branch']));
										$no_pack=fetch_query("SUM(no_of_package) as total_qnty","shipment_detail",array("oid="=>$b['id']));
                            ?>
                           
                                        <tr>
                                            <!-- <td></td> -->
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($b['invoice_date'])); ?></td>
                                            <td><?php echo $dept_nm['bname'];?></td>
                                            <td><?php echo $b['sales_person'];?></td>
                                            <td><?php echo $b['invoice_number'];?></td>
                                            <td><?php echo $b['consignment_no'];?></td>
                                            <td><?php echo $scity['name'];?></td>
                                            <td><?php echo $sstate['name'];?></td>
                                            <td><?php echo $no_pack['total_qnty'];?></td>
                                            <td><?php if($b['delivery_date']!='1970-01-01 05:30:00') echo $b['delivery_date'];?></td>
                                            <td><?php echo $b['payment_cash'];?></td>
                                            <td><?php echo $b['payment_fc'];?></td>
                                            <td><select name="status<?php echo $b['id']?>" id="status<?php echo $b['id']?>" class="form-control" onchange="change_status('<?php echo $b['id']?>',this.value)">
                                                <option <?php if ('1' == $status) {?> selected="selected" <?php }?> value="1" >Pending</option>
                                                <option <?php if ('2' == $status) {?> selected="selected" <?php }?> value="2" >In Process</option>
                                                <option <?php if ('3' == $status) {?> selected="selected" <?php }?> value="3" >Delivered</option>
                                                <option <?php if ('4' == $status) {?> selected="selected" <?php }?> value="4" >Reject</option>
                                                <option <?php if ('5' == $status) {?> selected="selected" <?php }?> value="5" >Return</option>
											</select> </td>
                                            <td>
                                            <a style="width:57px" href="<?php echo $site_url?>_private_content_shipment/l_<?php echo $b['id']?>.pdf" target="_blank"  class="btn btn-info btn-xs mb-5">Invoice</a><br />
                                               <?php /*?> <a style="width:57px" href="<?php echo $site_url?>_private_content_shipment/l_<?php echo $b['id']?>.pdf" target="_blank"  class="btn btn-warning btn-xs mb-5">Lables</a><?php */?>				
                                            <a style="width: 80px;color: white;" onclick="sendemail('<?php echo $b['id']?>')" class="btn btn-info btn-xs mb-5">Send Email</a><br />   
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
            </div>

            <!--<div class="col-lg-4 col-12">
                <div class="box bg-img box-inverse" style="background-image: url(images/4.jpg);" data-overlay="5">
                    <div class="box-body">
                        <div class="p-5">
                            <input type="hidden" name="hcity" id="hcity" value="<?php echo $ccity?>" />
                            <h3 class="white">
                                <span class="font-size-30" id="spancity"><?php echo $ccity?></span>
                            </h3>
                            <p class="weather-day-date mb-30">
                                <span class="mr-5"><?php echo date('l');?></span> <?php echo date('M d, Y')?>
                            </p>
                            <div class="mb-35 weather-icon">
                                <!--<canvas class="mr-40 text-top" id="icon1" width="90" height="90"></canvas>-->
                                <!--<div class="inline-block">
                                    
                                    <span class="font-size-50" id="spantemp">29°
                                        <span class="font-size-40">C</span>
                                    </span>
                                    <p class="text-left" id="spanweather">DAY RAIN</p>
                                </div>
                            </div>
                            <div class="row no-space">-->
                                <!--<div class="col-2">
                                    <div>
                                        <div class="mb-10">TUE</div>
                                        <i class="wi-day-sunny font-size-30 mb-10"></i>
                                        <div>24°
                                            <span class="font-size-12">C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <div class="mb-10">WED</div>
                                        <i class="wi-day-cloudy font-size-30 mb-10"></i>
                                        <div>21°
                                            <span class="font-size-12">C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <div class="mb-10">THU</div>
                                        <i class="wi-day-sunny font-size-30 mb-10"></i>
                                        <div>25°
                                            <span class="font-size-12">C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <div class="mb-10">FRI</div>
                                        <i class="wi-day-cloudy-gusts font-size-30 mb-10"></i>
                                        <div>20°
                                            <span class="font-size-12">C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <div class="mb-10">SAT</div>
                                        <i class="wi-day-lightning font-size-30 mb-10"></i>
                                        <div>18°
                                            <span class="font-size-12">C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <div class="mb-10">SUN</div>
                                        <i class="wi-day-storm-showers font-size-30 mb-10"></i>
                                        <div>14°
                                            <span class="font-size-12">C</span>
                                        </div>
                                    </div>
                                </div>-->
                                
                          <!--  </div>
                        </div>
                    </div>-->
                    <!-- /.box-body -->
              <!--  </div>-->
                <!-- /.box -->
            <div class="col-lg-12 col-12">
                <div class="box-group">
                    <div class="box">
                        <div class="vertical-align h-160">
                            <div class="vertical-align-middle font-size-30 text-center w-p100">
                                <span class="mr-10"><i class="fas fa-chart-line"></i></span>
                                <span class="countnm"><?php echo $biggest_ship?></span>
                                <div class="font-size-16 mt-3 text-fade"><?php if($big_scity!='' && $big_dcity!='') { ?> From: <?php echo $big_scity?> - To: <?php echo $big_dcity; } else { ?>No Shipment <?php }?></div>
                            </div>
                        </div>
                    </div>
                    <div class="box bg-primary">
                        <div class="vertical-align text-center p-30 h-160">
                            <div class="vertical-align-middle font-size-25">
                                <p>Today's Biggest</p>
                                <p>Shipping Amount</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
				
			<?php }
			else if(@$_SESSION['ntexpress_retroaccountant']!='')
			{
				echo 'Welcome '.$userdetail['name'];
				
			}
			?>

        </div>

    </section>

</div>


<?php include("footer.php"); ?>
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
</script>
<script>
$( document ).ready(function() {
   
	var ccity=$('#hcity').val();
	 console.log( "ready!"+ccity);
	$.ajax({
		url: 'http://api.weatherstack.com/current',
		data: {
			access_key: '732e36d1ff42419d498037d3f372818f',
			query: '"'+ccity+'"'
		},
		dataType: 'json',
		success: function(apiResponse) { //alert(apiResponse);
			console.log('Current temperature in '+apiResponse.location.name+' is '+apiResponse.current.temperature+'℃'+weather_descriptions);
			//$('#spancity').text(apiResponse.location.name);
			$('#spantemp').text(apiResponse.current.temperature+'℃');
			$('#spanweather').text(apiResponse.current.weather_descriptions);
			
			
		}
	});
	
	
	/*var ccity=$('#hcity').val();
	//alert(ccity);
	$.ajax({
		url: 'http://api.weatherstack.com/historical?historical_date_start=2020-08-15&historical_date_end=2020-08-17',
		data: {
			access_key: '732e36d1ff42419d498037d3f372818f',
			query: '"'+ccity+'"'
		},
		dataType: 'json',
		success: function(apiResponse) { //alert(apiResponse);
			console.log('Current temperature in '+apiResponse.location.name+' is '+apiResponse.current.temperature+'℃'+weather_descriptions);
			//$('#spancity').text(apiResponse.location.name);
			//$('#spantemp').text(apiResponse.current.temperature+'℃');
			//$('#spanweather').text(apiResponse.current.weather_descriptions);
			
			
		}
	});*/
	
	
    
	
	
});
</script>

<?php 
$months=array(); $month_number=array(); $year_number=array();
for ($i = 1; $i <= 5; $i++)
{
	if($i==1)
	{
		$months[] = date("M-Y");
		$month_number[]=date('m');
		$year_number[]=date('Y');
	}
	$months[] = date("M-Y", strtotime( date( 'Y-m-01' )." -$i months"));	
	$month_number[]=date('m', strtotime( date( 'Y-m-01' )." -$i months"));
	$year_number[]=date('Y', strtotime( date( 'Y-m-01' )." -$i months"));
}
//print_r($months);

//income
$first_income=0; $second_income=0; $third_income=0; $forth_income=0; $fifth_income=0; $sixth_income=0;
$sel_first_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$month_number[0]' and YEAR(`invoice_date`)='$year_number[0]'");
$sel_first_income=$sel_first_income->fetch_array();
if($sel_first_income['income_amount']!="")
	$first_income=$sel_first_income['income_amount'];
	
$sel_second_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$month_number[1]' and YEAR(`invoice_date`)='$year_number[1]'");
$sel_second_income=$sel_second_income->fetch_array();
if($sel_second_income['income_amount']!="")
	$second_income=$sel_second_income['income_amount'];

$sel_third_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$month_number[2]' and YEAR(`invoice_date`)='$year_number[2]'");
$sel_third_income=$sel_third_income->fetch_array();
if($sel_third_income['income_amount']!="")
	$third_income=$sel_third_income['income_amount'];
	
$sel_forth_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$month_number[3]' and YEAR(`invoice_date`)='$year_number[3]'");
$sel_forth_income=$sel_forth_income->fetch_array();
if($sel_forth_income['income_amount']!="")
	$forth_income=$sel_forth_income['income_amount'];

$sel_fifth_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$month_number[4]' and YEAR(`invoice_date`)='$year_number[4]'");
$sel_fifth_income=$sel_fifth_income->fetch_array();
if($sel_fifth_income['income_amount']!="")
	$fifth_income=$sel_fifth_income['income_amount'];

$sel_sixth_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$month_number[5]' and YEAR(`invoice_date`)='$year_number[5]'");
$sel_sixth_income=$sel_sixth_income->fetch_array();
if($sel_sixth_income['income_amount']!="")
	$sixth_income=$sel_sixth_income['income_amount'];
	

//expenses
$first_expense=0; $second_expense=0; $third_expense=0; $forth_expense=0; $fifth_expense=0; $sixth_expense=0;
$sel_first_expense=$dlink->query("select sum(exp_amount) as expense_amount from expenses where exp_amount!='NaN' and MONTH(expense_for_month)='$month_number[0]' and YEAR(expense_for_month)='$year_number[0]'");
$sel_first_expense=$sel_first_expense->fetch_array();
if($sel_first_expense['expense_amount']!="")
	 $first_expense=$sel_first_expense['expense_amount'];
	
$sel_second_expense=$dlink->query("select sum(exp_amount) as expense_amount from expenses where exp_amount!='NaN' and MONTH(expense_for_month)='$month_number[1]' and YEAR(expense_for_month)='$year_number[1]'");
$sel_second_expense=$sel_second_expense->fetch_array();
if($sel_second_expense['expense_amount']!="")
	 $second_expense=$sel_second_expense['expense_amount'];

$sel_third_expense=$dlink->query("select sum(exp_amount) as expense_amount from expenses where exp_amount!='NaN' and MONTH(expense_for_month)='$month_number[2]' and YEAR(expense_for_month)='$year_number[2]'");
$sel_third_expense=$sel_third_expense->fetch_array();
if($sel_third_expense['expense_amount']!="")
	 $third_expense=$sel_third_expense['expense_amount'];
	
$sel_forth_expense=$dlink->query("select sum(exp_amount) as expense_amount from expenses where exp_amount!='NaN' and MONTH(expense_for_month)='$month_number[3]' and YEAR(expense_for_month)='$year_number[3]'");
$sel_forth_expense=$sel_forth_expense->fetch_array();
if($sel_forth_expense['expense_amount']!="")
	 $forth_expense=$sel_forth_expense['expense_amount'];

$sel_fifth_expense=$dlink->query("select sum(exp_amount) as expense_amount from expenses where exp_amount!='NaN' and MONTH(expense_for_month)='$month_number[4]' and YEAR(expense_for_month)='$year_number[4]'");
$sel_fifth_expense=$sel_fifth_expense->fetch_array();
if($sel_fifth_expense['expense_amount']!="")
	 $fifth_expense=$sel_fifth_expense['expense_amount'];

$sel_sixth_expense=$dlink->query("select sum(exp_amount) as expense_amount from expenses where exp_amount!='NaN' and MONTH(expense_for_month)='$month_number[5]' and YEAR(expense_for_month)='$year_number[5]'");
$sel_sixth_expense=$sel_sixth_expense->fetch_array();
if($sel_sixth_expense['expense_amount']!="")
	 $sixth_expense=$sel_sixth_expense['expense_amount'];

//zakath

$first_zakath=0;
$first_zakath=(($first_income-$first_expense)*2.5)/100;

$second_zakath=0;
$second_zakath=(($second_income-$second_expense)*2.5)/100;

$third_zakath=0;
$third_zakath=(($third_income-$third_expense)*2.5)/100;

$forth_zakath=0;
$forth_zakath=(($forth_income-$forth_expense)*2.5)/100;

$fifth_zakath=0;
$fifth_zakath=(($fifth_income-$fifth_expense)*2.5)/100;

$sixth_zakath=0;
$sixth_zakath=(($sixth_income-$sixth_expense)*2.5)/100;


$first_profit=0;
$first_profit=$first_income-$first_expense-$first_zakath;

$second_profit=0;
$second_profit=$second_income-$second_expense-$second_zakath;

$third_profit=0;
$third_profit=$third_income-$third_expense-$third_zakath;

$forth_profit=0;
$forth_profit=$forth_income-$forth_expense-$forth_zakath;

$fifth_profit=0;
$fifth_profit=$fifth_income-$fifth_expense-$fifth_zakath;

$sixth_profit=0;
$sixth_profit=$sixth_income-$sixth_expense-$sixth_zakath;
//print_r($months);
?>

<script>
window.onload = function () {
//Better to construct options first and then pass it as a parameter
var options = {
	animationEnabled: true,
	title:{
		text: "Monthly Report"   
	},
	axisY:{
		title:"Amount in Rs."
	},
	toolTip: {
		shared: true,
		reversed: true
	},
	data: [{
		type: "stackedColumn",
		name: "Income",
		showInLegend: "true",
		yValueFormatString: "#,##0 rupees",
		dataPoints: [
			{ y: <?php echo $first_income?>, label: "<?php echo $months[0]?>" },
			{ y: <?php echo $second_income?>, label: "<?php echo $months[1]?>" },
			{ y: <?php echo $third_income?>, label: "<?php echo $months[2]?>" },
			{ y: <?php echo $forth_income?>, label: "<?php echo $months[3]?>" },
			{ y: <?php echo $fifth_income?>, label: "<?php echo $months[4]?>" },
			{ y: <?php echo $sixth_income?>, label: "<?php echo $months[5]?>" }
		]
	},
	{
		type: "stackedColumn",
		name: "Expenses",
		showInLegend: "true",
		yValueFormatString: "#,##0 rupees",
		dataPoints: [
			{ y: <?php echo $first_expense?> , label: "<?php echo $months[0]?>" },
			{ y: <?php echo $second_expense?>, label: "<?php echo $months[1]?>" },
			{ y: <?php echo $third_expense?>, label: "<?php echo $months[2]?>" },
			{ y: <?php echo $forth_expense?>, label: "<?php echo $months[3]?>" },
			{ y: <?php echo $fifth_expense?>, label: "<?php echo $months[4]?>" },
			{ y: <?php echo $sixth_expense?>, label: "<?php echo $months[5]?>" }
		]
	},
	{
		type: "stackedColumn",
		name: "Zakath",
		showInLegend: "true",
		yValueFormatString: "#,##0 rupees",
		dataPoints: [
			{ y: <?php echo $first_zakath?> , label: "<?php echo $months[0]?>" },
			{ y: <?php echo $second_zakath?>, label: "<?php echo $months[1]?>" },
			{ y: <?php echo $third_zakath?>, label: "<?php echo $months[2]?>" },
			{ y: <?php echo $forth_zakath?>, label: "<?php echo $months[3]?>" },
			{ y: <?php echo $fifth_zakath?>, label: "<?php echo $months[4]?>" },
			{ y: <?php echo $sixth_zakath?>, label: "<?php echo $months[5]?>" }
		]
	},
	{
		type: "stackedColumn",
		name: "Profit",
		showInLegend: "true",
		yValueFormatString: "#,##0 rupees",
		dataPoints: [
			{ y: <?php echo $first_profit?> , label: "<?php echo $months[0]?>" },
			{ y: <?php echo $second_profit?>, label: "<?php echo $months[1]?>" },
			{ y: <?php echo $third_profit?>, label: "<?php echo $months[2]?>" },
			{ y: <?php echo $forth_profit?>, label: "<?php echo $months[3]?>" },
			{ y: <?php echo $fifth_profit?>, label: "<?php echo $months[4]?>" },
			{ y: <?php echo $sixth_profit?>, label: "<?php echo $months[5]?>" }
		]
	}]
};

$("#chartContainer").CanvasJSChart(options);
}
</script>
<script type="text/javascript" src="<?php echo $site_url; ?>js/jquery.canvasjs.min.js"></script>

<!--region wise chart-->
<?php
$cmonths=array(); $cmonth_number=array(); $cyear_number=array();
for ($i = 5; $i >= 1; $i--)
{
	/*if($i==1)
	{
		$cmonths[] = date("M-Y");
		$cmonth_number[]=date('m');
		$cyear_number[]=date('Y');
	}*/
	$cmonths[] = date("M-Y", strtotime( date( 'Y-m-01' )." -$i months"));	
	$cmonth_number[]=date('m', strtotime( date( 'Y-m-01' )." -$i months"));
	$cyear_number[]=date('Y', strtotime( date( 'Y-m-01' )." -$i months"));
}
for ($i = 1; $i <= 6; $i++)
{
	if($i==1)
	{
		$cmonths[] = date("M-Y");
		$cmonth_number[]=date('m');
		$cyear_number[]=date('Y');
	}
	$cmonths[] = date("M-Y", strtotime( date( 'Y-m-01' )." +$i months"));	
	$cmonth_number[]=date('m', strtotime( date( 'Y-m-01' )." +$i months"));
	$cyear_number[]=date('Y', strtotime( date( 'Y-m-01' )." +$i months"));
}




//print_r($cmonths);

//income
$cfirst_income=0; $csecond_income=0; $cthird_income=0; $cforth_income=0; $cfifth_income=0; $csixth_income=0;
$cseven_income=0; $ceight_income=0; $cnine_income=0; $cten_income=0; $celeven_income=0; $ctwelve_income=0;

$sel_first_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$cmonth_number[0]' and YEAR(`invoice_date`)='$cyear_number[0]'");
$sel_first_income=$sel_first_income->fetch_array();
if($sel_first_income['income_amount']!="")
	$cfirst_income=$sel_first_income['income_amount'];
	
$sel_second_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$cmonth_number[1]' and YEAR(`invoice_date`)='$cyear_number[1]'");
$sel_second_income=$sel_second_income->fetch_array();
if($sel_second_income['income_amount']!="")
	$csecond_income=$sel_second_income['income_amount'];

$sel_third_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$cmonth_number[2]' and YEAR(`invoice_date`)='$cyear_number[2]'");
$sel_third_income=$sel_third_income->fetch_array();
if($sel_third_income['income_amount']!="")
	$cthird_income=$sel_third_income['income_amount'];
	
$sel_forth_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$cmonth_number[3]' and YEAR(`invoice_date`)='$cyear_number[3]'");
$sel_forth_income=$sel_forth_income->fetch_array();
if($sel_forth_income['income_amount']!="")
	$cforth_income=$sel_forth_income['income_amount'];

$sel_fifth_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$cmonth_number[4]' and YEAR(`invoice_date`)='$cyear_number[4]'");
$sel_fifth_income=$sel_fifth_income->fetch_array();
if($sel_fifth_income['income_amount']!="")
	$cfifth_income=$sel_fifth_income['income_amount'];

$sel_sixth_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$cmonth_number[5]' and YEAR(`invoice_date`)='$cyear_number[5]'");
$sel_sixth_income=$sel_sixth_income->fetch_array();
if($sel_sixth_income['income_amount']!="")
	$csixth_income=$sel_sixth_income['income_amount'];
	




$sel_seven_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$cmonth_number[6]' and YEAR(`invoice_date`)='$cyear_number[6]'");
$sel_seven_income=$sel_seven_income->fetch_array();
if($sel_seven_income['income_amount']!="")
	$cseven_income=$sel_seven_income['income_amount'];
	
$sel_eight_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$cmonth_number[7]' and YEAR(`invoice_date`)='$cyear_number[7]'");
$sel_eight_income=$sel_eight_income->fetch_array();
if($sel_eight_income['income_amount']!="")
	$ceight_income=$sel_eight_income['income_amount'];

$sel_nine_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$cmonth_number[8]' and YEAR(`invoice_date`)='$cyear_number[8]'");
$sel_nine_income=$sel_nine_income->fetch_array();
if($sel_nine_income['income_amount']!="")
	$cnine_income=$sel_nine_income['income_amount'];
	
$sel_ten_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$cmonth_number[9]' and YEAR(`invoice_date`)='$cyear_number[9]'");
$sel_ten_income=$sel_ten_income->fetch_array();
if($sel_ten_income['income_amount']!="")
	$cten_income=$sel_ten_income['income_amount'];

$sel_eleven_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$cmonth_number[10]' and YEAR(`invoice_date`)='$cyear_number[10]'");
$sel_eleven_income=$sel_eleven_income->fetch_array();
if($sel_eleven_income['income_amount']!="")
	$celeven_income=$sel_eleven_income['income_amount'];

$sel_twelve_income=$dlink->query("select sum(total_amount) as income_amount from shipment where total_amount!='NaN' and MONTH(`invoice_date`)='$cmonth_number[11]' and YEAR(`invoice_date`)='$cyear_number[11]'");
$sel_twelve_income=$sel_twelve_income->fetch_array();
if($sel_twelve_income['income_amount']!="")
	$ctwelve_income=$sel_twelve_income['income_amount'];

?>
<script type="text/javascript">
$(function() {
	$("#morris-area-chart").CanvasJSChart({
		title: {
			text: "Monthly Income"
		},
		axisY: {
			title: "Income in Rs.",
			includeZero: false
		},
		axisX: {
			interval: 1
		},
		data: [
		{
			type: "line", //try changing to column, area
			toolTipContent: "{label}: {y} Rs",
			dataPoints: [
				{ label: "<?php echo $cmonths[0]?>",  y: <?php echo $cfirst_income?> },
				{ label: "<?php echo $cmonths[1]?>",  y: <?php echo $csecond_income?> },
				{ label: "<?php echo $cmonths[2]?>",y: <?php echo $cthird_income?> },
				{ label: "<?php echo $cmonths[3]?>",y: <?php echo $cforth_income?> },
				{ label: "<?php echo $cmonths[4]?>",  y: <?php echo $cfifth_income?> },
				{ label: "<?php echo $cmonths[5]?>", y: <?php echo $csixth_income?> },
				{ label: "<?php echo $cmonths[6]?>", y: <?php echo $cseven_income?> },
				{ label: "<?php echo $cmonths[7]?>",  y: <?php echo $ceight_income?> },
				{ label: "<?php echo $cmonths[8]?>",  y: <?php echo $cnine_income?> },
				{ label: "<?php echo $cmonths[9]?>",  y: <?php echo $cten_income?> },
				{ label: "<?php echo $cmonths[10]?>",  y: <?php echo $celeven_income?> },
				{ label: "<?php echo $cmonths[11]?>",  y: <?php echo $ctwelve_income?> }
			]
		}
		],
		
	});
});

$(function() {

  $(".progress").each(function() {

    var value = $(this).attr('data-value');
    var left = $(this).find('.progress-left .progress-bar');
    var right = $(this).find('.progress-right .progress-bar');

    if (value > 0) {
      if (value <= 50) {
        right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
      } else {
        right.css('transform', 'rotate(180deg)')
        left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
      }
    }

  })

  function percentageToDegrees(percentage) {

    return percentage / 100 * 360

  }

});

</script><script type="text/javascript" src="<?php echo $site_url; ?>js/canvasjs.min.js"></script>