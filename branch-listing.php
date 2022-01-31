<?php include("header.php"); ?>

<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

        <h1> Branches </h1>

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
								<h3> Active Branches </h3>
							</div>
							<div class="col-6 text-right">
								<button class="btn btn-danger" onclick="location.href='<?php echo $site_url; ?>branch-add'"> <i class="fa fa-plus"></i> Add Branch</button>
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
                                <th>#</th>
                                <th>Branch</th>
                                <th>Address</th>
                                <th>Conatct</th>
                                <th>Action</th>                               
                            </tr>
                            
                        </thead>
                        
                        <tbody>
                           <?php
							  $no=1;
							  $row=select_query("*","branches", "", "id desc");
							  if($row->num_rows)
							  {
								  while($b=$row->fetch_array())
								  {

								?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $b['bname']; ?></td>
                                <td><?php echo $b['address']; ?></td>
                                <td><?php echo $b['mobile']; ?></td>
                               
                                <td><a href="<?php echo $site_url; ?>branch-add/<?php echo $b['id'] ?>"><i class="far fa-edit"></i></a> <a href="#" onclick="return confirm_dialog('<?php echo $b['id'] ?>')"><i class="fas fa-trash-alt"></i></a></td>
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
		window.location="<?php echo $site_url; ?>case/branch/"+val;
	}
	else
		return false;
}

</script>