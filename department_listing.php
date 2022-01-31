<?php include("header.php"); ?>

<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

        <h1> Department Listing </h1>

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
                        <h3> Department </h3>
                    </div>
                    <div class="col-6 text-right">
                        <button class="btn btn-danger" onclick="location.href='<?php echo $site_url; ?>department-add'"> <i class="fa fa-plus"></i> New</button>
                    </div>
                </div>
               
                <div class="table-responsive">
                   
                    <table id="example" class="table table-bordered table-hover">
                       
                        <thead>
                           
                            <tr>
                                <th>#</th>
                                <!-- <th>Department</th>
                                <th>Representative No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>Address</th>
                                <th>Zipcode</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Salary</th> -->
                                <th>Department</th>
                                <th>Branch</th>
                                <th>Head</th>
                                <th>Action</th>                                
                            </tr>
                            
                        </thead>
                        
                        <tbody>
                           <?php
							  $no=1;
							  //$row=select_query("*","agent", "", "id desc");
                               $row=select_query("*","dept_branch", "", "id desc");
							  if($row->num_rows)
							  {
								  while($b=$row->fetch_array())
								  {
									  $dept=fetch_query("title","department",array("id="=>$b['deptid']));
									  $country=fetch_query("name","location",array("location_id="=>$b['country']));
									  $state=fetch_query("name","location",array("location_id="=>$b['state']));
									  $city=fetch_query("name","location",array("location_id="=>$b['city']));	

                                      $dept_nm=fetch_query("bname","branches",array("id="=>$b['dept_branch']));

								?>
                            <!-- <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $dept['title']; ?></td>
                                 <td><?php echo $b['agent_no']; ?></td>
                                <td><?php echo $b['name']; ?></td>
                                <td><?php echo $b['email']; ?></td>
                                <td><?php echo $b['mno']; ?></td>
                                <td><?php echo $b['address']; ?></td>
                                <td><?php echo $b['pincode']; ?></td>
                                <td><?php echo $country['name']; ?></td>
                                <td><?php echo $state['name']; ?></td>
                                <td><?php echo $city['name']; ?></td>
                                <td><?php echo $b['salary']; ?></td>
                                <td><a href="<?php echo $site_url; ?>agent-add/<?php echo $b['id'] ?>"><i class="far fa-edit"></i></a> <a href="#" onclick="return confirm_dialog('<?php echo $b['id'] ?>')"><i class="fas fa-trash-alt"></i></a></td>
                            </tr> -->

                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $dept_nm['bname']; ?></td>
                                <td><?php echo $b['new_dept']; ?></td>
                                <td><?php echo $b['dept_head']; ?></td>

                                <td><a href="<?php echo $site_url; ?>department-add/<?php echo $b['id'] ?>"><i class="far fa-edit"></i></a> <a href="#" onclick="return confirm_dialog('<?php echo $b['id'] ?>')"><i class="fas fa-trash-alt"></i></a></td>
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
		window.location="<?php echo $site_url; ?>case/agent/"+val;
	}
	else
		return false;
}

</script>