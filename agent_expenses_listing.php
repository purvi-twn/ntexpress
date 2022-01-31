<?php include("header.php"); ?>

<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

        <h1> Expenses Listing </h1>

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
               
                <div class="table-responsive">
                   
                    <table id="example" class="table table-bordered table-hover">
                       
                        <thead>
                           
                            <tr>
                                <th>Sr. No.</th>
                                <th>Expense Date</th>
                                <th>Expense Type</th>
                                <th>Employee Name</th>
                                <th>Expense Amount</th>
                                <th>Remark</th>
                                <th>Action</th>                                
                            </tr>
                            
                        </thead>
                        
                        <tbody>
                           <?php
							  $no=1;
							  $row=select_query("*","expenses", array("added_by="=>$_SESSION['ntexpress_retroagent']), "id desc");
							  if($row->num_rows)
							  {
								  while($b=$row->fetch_array())
								  {
									
									  $agent=fetch_query("name","agent",array("id="=>$b['aid']));
									  $state=fetch_query("name","location",array("location_id="=>$b['state']));
									  $city=fetch_query("name","location",array("location_id="=>$b['city']));	
									  $agent_name=$agent['name'];
								?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                 <td><?php echo date('d-m-Y',strtotime($b['expense_for_month'])); ?></td>
                                <td><?php echo $b['exp_type']; ?></td>
                                <td><?php  if($b['aid']=="0") echo "-"; else echo $agent['name']; ?></td>
                                <td><?php echo $b['exp_amount']; ?></td>
                                <td><?php echo $b['remark']; ?></td>
                                <td><a href="<?php echo $site_url; ?>expenses-add/<?php echo $b['id'] ?>"><i class="far fa-edit"></i></a> 
                                <a href="#" onclick="return confirm_dialog('<?php echo $b['id'] ?>')"><i class="fas fa-trash-alt"></i></a></td>
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
		window.location="<?php echo $site_url; ?>case/expenses/"+val;
	}
	else
		return false;
}

</script>