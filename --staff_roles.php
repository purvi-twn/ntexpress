<?php include("header.php"); ?>

<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

        <h1> Staff Listing </h1>

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
                        <h3> Staffs </h3>
                    </div>
                    <?php /*?><div class="col-6 text-right">
                        <button class="btn btn-danger" onclick="location.href='<?php echo $site_url; ?>staff-add'"> <i class="fa fa-plus"></i> Add</button>
                    </div><?php */?>
                </div>
                </div>
               	<style>
				.demo-checkbox label, .demo-radio-button label
				{
					min-width:0px !important
				}
				</style>
                <div class="table-responsive">
                   
                    <table id="example" class="table table-bordered table-hover">
                       
                        <thead>
                           
                            <tr>
                                <th>Sr. No.</th>
                                <th>Name</th>
                                <th>ID</th>
                                <th>Branch</th>
                                <th>Department</th>
                                <th>Customer</th>
                                <th>Create Invoice </th>
                                <th>View Self Invoice</th>
								<th>View All Invoice</th>
                                <th>Employee</th>
                                <th>Report</th>
                                <th>Expenses</th>
                                <th>Accounts</th>
                                <th>Shipment Tracking</th>   
                            </tr>
                        </thead>
                        
                        <tbody>
                        <?php
                          $no=1;
						  $row=select_query("*","department", "", "id desc");
						  if($row->num_rows)
						  {
							  while($b=$row->fetch_array())
							  {

                                $branch_nm=fetch_query("bname","branches",array("id="=>$b['branch']));
								$dept_nm=fetch_query("new_dept","dept_branch",array("id="=>$b['dept_branch']));
								$roll=fetch_query("*","staff_roles",array("sid="=>$b['id']));
							?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $b['fname'] ." ".  $b['mname'] ." ". $b['lname']; ?></td>
                                <td><?php echo ($b['staff_id']); ?></td>
                                <td><?php echo  $branch_nm['bname']; ?></td>
                                <td><?php echo  $dept_nm['new_dept']; ?></td>
                                <td>
                                <div class="form-group">
                                	<div class="demo-radio-button">
                                        <input name="customers<?php echo $b['id']?>" type="checkbox" id="customers<?php echo $b['id']?>" class="with-gap radio-col-maroon radiosearch" onchange="assign_customers_role('<?php echo $b['id']?>')" value="<?php echo $b['id']?>" <?php if($roll['customer']==1) { ?> checked <?php } ?>>
                                       <label style="color:#fff" for="customers<?php echo $b['id']?>">&nbsp;</label>
                                    </div>
                                </div>	
                                </td>
                                <td><div class="form-group">
                                	<div class="demo-radio-button">
                                        <input name="invoices<?php echo $b['id']?>" type="checkbox" id="invoices<?php echo $b['id']?>" class="with-gap radio-col-maroon radiosearch" onchange="assign_invoice_role('<?php echo $b['id']?>')" value="<?php echo $b['id']?>" 
										<?php if($roll['invoice']==1) { ?> checked <?php } ?>>
                                       <label style="color:#fff" for="invoices<?php echo $b['id']?>">&nbsp;</label>
                                    </div>
                                </div></td>
                                <td><div class="form-group">
                                	<div class="demo-radio-button">
                                        <input name="self_invoices<?php echo $b['id']?>" type="checkbox" id="self_invoices<?php echo $b['id']?>" class="with-gap radio-col-maroon radiosearch" onchange="assign_self_invoice_role('<?php echo $b['id']?>')" value="<?php echo $b['id']?>" 
										<?php if($roll['self_invoice']==1) { ?> checked <?php } ?>>
                                       <label style="color:#fff" for="self_invoices<?php echo $b['id']?>">&nbsp;</label>
                                    </div>
                                </div></td>
                                <td><div class="form-group">
                                	<div class="demo-radio-button">
                                        <input name="all_invoices<?php echo $b['id']?>" type="checkbox" id="all_invoices<?php echo $b['id']?>" class="with-gap radio-col-maroon radiosearch" onchange="assign_all_invoice_role('<?php echo $b['id']?>')" value="<?php echo $b['id']?>" 
										<?php if($roll['all_invoice']==1) { ?> checked <?php } ?>>
                                       <label style="color:#fff" for="all_invoices<?php echo $b['id']?>">&nbsp;</label>
                                    </div>
                                </div></td>
                                
                                <td><div class="form-group">
                                	<div class="demo-radio-button">
                                        <input name="employee<?php echo $b['id']?>" type="checkbox" id="employee<?php echo $b['id']?>" class="with-gap radio-col-maroon radiosearch" onchange="assign_employee_role('<?php echo $b['id']?>')" value="<?php echo $b['id']?>" 
										<?php if($roll['employee']==1) { ?> checked <?php } ?>>
                                       <label style="color:#fff" for="employee<?php echo $b['id']?>">&nbsp;</label>
                                    </div>
                                </div></td>
                                <td><div class="form-group">
                                	<div class="demo-radio-button">
                                        <input name="report<?php echo $b['id']?>" type="checkbox" id="report<?php echo $b['id']?>" class="with-gap radio-col-maroon radiosearch" onchange="assign_report_role('<?php echo $b['id']?>')" value="<?php echo $b['id']?>" 
										<?php if($roll['report']==1) { ?> checked <?php } ?>>
                                       <label style="color:#fff" for="report<?php echo $b['id']?>">&nbsp;</label>
                                    </div>
                                </div></td>
                                <td><div class="form-group">
                                	<div class="demo-radio-button">
                                        <input name="expenses<?php echo $b['id']?>" type="checkbox" id="expenses<?php echo $b['id']?>" class="with-gap radio-col-maroon radiosearch" onchange="assign_expenses_role('<?php echo $b['id']?>')" value="<?php echo $b['id']?>" 
										<?php if($roll['expenses']==1) { ?> checked <?php } ?>>
                                       <label style="color:#fff" for="expenses<?php echo $b['id']?>">&nbsp;</label>
                                    </div>
                                </div></td>

                                <td><div class="form-group">
                                	<div class="demo-radio-button">
                                        <input name="accounts<?php echo $b['id']?>" type="checkbox" id="accounts<?php echo $b['id']?>" class="with-gap radio-col-maroon radiosearch" onchange="assign_accounts_role('<?php echo $b['id']?>')" value="<?php echo $b['id']?>" 
										<?php if($roll['accounts']==1) { ?> checked <?php } ?>>
                                       <label style="color:#fff" for="accounts<?php echo $b['id']?>">&nbsp;</label>
                                    </div>
                                </div></td>

                                <td><div class="form-group">
                                	<div class="demo-radio-button">
                                        <input name="shipment_tracking<?php echo $b['id']?>" type="checkbox" id="shipment_tracking<?php echo $b['id']?>" class="with-gap radio-col-maroon radiosearch" onchange="assign_shipment_tracking_role('<?php echo $b['id']?>')" value="<?php echo $b['id']?>" 
										<?php if($roll['shipment_tracking']==1) { ?> checked <?php } ?>>
                                       <label style="color:#fff" for="shipment_tracking<?php echo $b['id']?>">&nbsp;</label>
                                    </div>
                                </div></td>
                                
                            </tr>
                            <?php $no++;
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
function confirm_dialog(val)
{
	if(confirm("Are you sure you want to delete this record?"))
	{
		window.location="<?php echo $site_url; ?>case/department/"+val;
	}
	else
		return false;
}
function assign_customers_role(sid)
{
	if ($('#customers'+sid).not(':checked').length) {
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_customer_role',val:0},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
	else
	{
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_customer_role',val:1},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
}
function assign_invoice_role(sid)
{ 
	if ($('#invoices'+sid).not(':checked').length) {
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_invoice_role',val:0},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
	else
	{
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_invoice_role',val:1},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
}
function assign_all_invoice_role(sid)
{ 
	if ($('#invoices'+sid).not(':checked').length) {
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_all_invoice_role',val:0},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
	else
	{
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_all_invoice_role',val:1},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
}
function assign_self_invoice_role(sid)
{ 
	if ($('#invoices'+sid).not(':checked').length) {
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_self_invoice_role',val:0},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
	else
	{
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_self_invoice_role',val:1},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
}
function assign_employee_role(sid)
{
	if ($('#employee'+sid).not(':checked').length) {
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_employee_role',val:0},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
	else
	{
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_employee_role',val:1},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
}
function assign_report_role(sid)
{
	if ($('#report'+sid).not(':checked').length) {
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_report_role',val:0},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
	else
	{
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_report_role',val:1},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
}
function assign_expenses_role(sid)
{
	if ($('#expenses'+sid).not(':checked').length) {
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_expenses_role',val:0},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
	else
	{
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_expenses_role',val:1},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
}
function assign_accounts_role(sid)
{
	if ($('#accounts'+sid).not(':checked').length) {
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_accounts_role',val:0},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
	else
	{
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_accounts_role',val:1},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
}
function assign_shipment_tracking_role(sid)
{
	if ($('#shipment_tracking'+sid).not(':checked').length) {
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_shipment_tracking_role',val:0},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
	else
	{
		$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{sid:sid,action:'assign_shipment_tracking_role',val:1},
		 success: function(data)
		 {	
			if(data=='Fail')
				alert('Problem in assigning roles');
			return false;
		  }
		});
	}
}
</script>
