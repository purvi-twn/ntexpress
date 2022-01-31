<?php include("header.php"); ?>

<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

        <!--<h1> Customers Listing </h1>-->

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
                    		<h3> Active Customers </h3>
                       	</div>
                        <div class="col-6 text-right">
                    		<button class="btn btn-danger" onclick="location.href='<?php echo $site_url; ?>customer-add'"> <i class="fa fa-plus"></i> New</button>
                            <select id="filterby" name="filterby" class="btn btn-danger">
                            	<option value="">Filter By</option>
                                <option value="">City</option>
                                <option value="">Province</option>
                            </select>
                       	</div>
                    </div>
                <div class="table-responsive">
                   
                   	<table id="example" class="table table-bordered table-hover">
                       
                        <thead>
                           <tr>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>City</th>
                                <th>Province</th>
                                <th>Action</th>                                
                            </tr>
                            
                        </thead>
                        
                        <tbody>
                           <?php
							  $no=1;
							  $row=select_query("*","customers", array("is_delete="=>0), "id desc");
							  if($row->num_rows)
							  {
								  while($b=$row->fetch_array())
								  {
									  $country=fetch_query("name","location",array("location_id="=>$b['country']));
									  $state=fetch_query("name","location",array("location_id="=>$b['state']));
									  $city=fetch_query("name","location",array("location_id="=>$b['city']));	
								?>
                            <tr>
                                <td><input type="checkbox" class="form-control" id="aaa" name="bbb[]"><?php echo $b['name']; ?></td>
                                <td><?php echo $b['company_name']; ?></td>
                                <td><?php echo $b['email']; ?></td>
                                <td><?php echo $b['phone']; ?></td>
                                <td><?php echo $city['name']; ?></td>
                                <td><?php echo $state['name']; ?></td>
                                <td><a href="<?php echo $site_url; ?>customer-add/<?php echo $b['id'] ?>"><i class="far fa-edit newicon"></i></a> 
                                <a href="#" onclick="return confirm_dialog('<?php echo $b['id'] ?>')"><i class="fas fa-trash-alt newicon"></i></a></td>
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
		window.location="<?php echo $site_url; ?>case/customers/"+val;
	}
	else
		return false;
}
</script>