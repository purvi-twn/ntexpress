<?php include("header.php"); ?>

<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

        <h1> Role Listing </h1>

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
                        <h3> Roles </h3>
                    </div>
                    <div class="col-6 text-right">
                        <button class="btn btn-danger" onclick="location.href='<?php echo $site_url; ?>staff-add'"> <i class="fa fa-plus"></i> Add</button>
                    </div>
                </div>
                </div>
               
                <div class="table-responsive">
                   
                    <table id="example" class="table table-bordered table-hover">
                       
                        <thead>
                           
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>ID</th>
                                <th>Branch</th>
                                <th>Department</th>
                                <th>Nationality</th>
                                <th>Mobile</th>
                               
                                <!-- <th>Department Title</th>
                                <th>Description</th> -->
                                <th>Action</th>                                
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
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $b['fname'] ." ".  $b['mname'] ." ". $b['lname']; ?></td>
                                <td><?php echo ($b['staff_id']); ?></td>
                                <td><?php echo  $branch_nm['bname']; ?></td>
                                <td><?php echo  $dept_nm['new_dept']; ?></td>
                                <td><?php echo ($b['nationality']); ?></td>
                                <td><?php echo ($b['mobile']); ?></td>
                                
                                <td><a href="<?php echo $site_url; ?>staff-add/<?php echo $b['id'] ?>"><i class="far fa-edit"></i></a> <a href="#" onclick="return confirm_dialog('<?php echo $b['id'] ?>')"><i class="fas fa-trash-alt"></i></a></td>
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

</script>
