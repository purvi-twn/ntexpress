<?php include("header.php"); ?>

<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

        <h1> Vendor </h1>

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
								<h3> Active Vendor </h3>
							</div>
							<div class="col-6 text-right">
								<button class="btn btn-danger" onclick="location.href='<?php echo $site_url; ?>vendor-add'"> <i class="fa fa-plus"></i> New </button>
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
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>Email</th>
                                <th>Conatct</th>
                                <th>Country</th>
                                <th>Action</th>                                
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                                $no=1;
                                $row=select_query("*","vendor", "", "id desc");
                                if($row->num_rows)
                                {
                                    while($b=$row->fetch_array())
                                    {

                                        $country=fetch_query("name","location",array("location_id="=>$b['source_country']));
                            ?>      
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $b['name']; ?></td>
                                            <td><?php echo $b['company_name']; ?></td>
                                            <td><?php echo $b['email']; ?></td>
                                            <td>
                                                <?php 
                                                if($b['phone'] !='')
                                                {
                                                    echo $b['phone'];
                                                }
                                                else{
                                                    echo $b['mno'];
                                                } 
                                                ?>
                                            </td>
                                            <td><?php echo $country['name']; ?></td>
                                            <td>
                                                <a href="<?php echo $site_url; ?>vendor-add/<?php echo $b['id'] ?>"><i class="far fa-edit"></i></a> 
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
function confirm_dialog(val)
{
	if(confirm("Are you sure you want to delete this record?"))
	{
		window.location="<?php echo $site_url; ?>case/vendor/"+val;
	}
	else
		return false;
}

</script>