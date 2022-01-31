<?php include("header.php"); ?>

<?php include("leftpanel.php"); ?>
<style type="text/css">
    [type="checkbox"]:checked, [type="checkbox"]:not(:checked) {
        position: unset;
        left: unset;
        opacity: unset;
    }
</style>

<div class="content-wrapper">

    <section class="content-header">

        <h1> All Expenses </h1>

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
								<h3> All Expenses</h3>
							</div>
							<div class="col-6 text-right">
								<button class="btn btn-danger" onclick="location.href='<?php echo $site_url; ?>record-expense-add'"> <i class="fa fa-plus"></i> New </button>
							</div>
                       	</div>
				</div>
						
                
               <!-- <div>
                    <a href="<?php echo $site_url; ?>branch-add">Add Branch</a>
                </div>-->
                <div class="table-responsive">
                   
                    <table id="example" class="table table-bordered table-hover">
                       
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="master" onclick="allCheck();">
                                </th>
                                <th>Date</th>
                                <th>Expense Type</th>
                                <th>Vendor</th>
                                <th>Paid Through</th>
                                <th>Amount</th>
                                <th>Action <i class="fas fa-trash-alt newicon  extraaddnew" id="0" onclick="delete_all();"></i></th>                                
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                                $no=1;
                                $row=select_query("*","record_expense", "", "id desc");
                                if($row->num_rows)
                                {
                                    while($b=$row->fetch_array())
                                    {
                                        $data = fetch_query("*","expense_type",array("id="=>$b['expense_type']));
                            ?>      
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="chk_<?php echo $b['id']; ?>" id="chk_<?php echo $b['id']; ?>" class="default checkBoxClass2 sub_chk" data-id="<?php echo $b['id']; ?>">
                                            </td>
                                            <td><?php echo $b['date']; ?></td>
                                            <td><?php echo $data['expense_type']; ?></td>
                                            
                                            <td><?php echo $b['vendor_name']; ?></td>
                                            <td><?php echo $b['paid_through']; ?></td>
                                            
                                            <td><?php echo $b['amount']; ?></td>
                                            <td>
                                                <a href="<?php echo $site_url; ?>record-expense-add/<?php echo $b['id'] ?>"><i class="far fa-edit"></i></a>
                                                <a href="#" onclick="return confirm_dialog('<?php echo $b['id'] ?>')"><i class="fas fa-trash-alt"></i>
                                                </a>
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
function allCheck()
{
    if($('#master').is(':checked',true))  
    {
        $(".sub_chk").prop('checked', true);  
    } else {  
        $(".sub_chk").prop('checked',false);  
    }  
}
function delete_all()
{
    var allVals = [];  
    $(".sub_chk:checked").each(function() 
    {  
        allVals.push($(this).attr('data-id'));
    });  

    if(allVals.length <=0)  
    {  
        alert("Please select row."); 
    } 
    else
    {
        $.ajax({
            type: "POST",
            url: "<?php echo $site_url; ?>admin_ajax.php",
            data:{allVals:allVals,action:'allrecordexpense'},
            success: function(data)
            {  
                if(data=='success')
                {
                    $(".alert-success").css("display", "block");
                    $(".alert-success").append("Record Expense Deleted Successfully...");
                    location.reload();
                }
                else
                {
                    $(".alert-danger").css("display", "block");
                    $(".alert-danger").append("Something Wrong... Try Again...");
                }
            }
        });
    }
}
function confirm_dialog(val)
{
	if(confirm("Are you sure you want to delete this record?"))
	{
		window.location="<?php echo $site_url; ?>case/recordexpense/"+val;
	}
	else
		return false;
}

</script>