<?php include("header.php"); 

if(@$_REQUEST['id']!='')
{
	$id = $_REQUEST['id'];
	$rows = fetch_query("*","payment_terms_condition",array("id="=>$id));
	$title = $rows['title'];
	$detail = $rows['detail'];
}
else
{
	$title = '';
	$detail = '';
	$pagetitle="Add";
}

?>

<?php include("leftpanel.php"); ?>
<style>
@media screen and (max-width: 400px){
	.sp-1{
			margin-bottom: 15px;
		}
}
@media screen and (min-width: 401px) and (max-width: 767px){
	.sp-1{
			margin-bottom: 15px;
		}
}
@media screen and (min-width: 768px) and (max-width: 992px){
	.sp-1{
			margin-bottom: 15px;
		}
}
</style>
<div class="content-wrapper">

    <section class="content-header">

        <!--<h1> Branches <?php echo $pagetitle; ?> </h1>-->

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
                    <div class="col-lg-12">
                        <form method="post" action="" name="bg" id="bg" enctype="multipart/form-data">
							<div class="col-sm-12 col-md-12 pl-0">
                                <h3>Add Payment Terms & Condition</h3>
                                <hr />
                            </div>
                            <div class="form-group">
								<div class="row">
									<div class="col-sm-12 col-md-2 controls">
                                        <h5 style="color: #D42B2B">Title<span style="color: #D42B2B">*</span></h5>
									</div>
                                    <div class="col-sm-12 col-md-3 controls">
                                        <input type="title" name="title" id="title" value="<?php echo $title; ?>" class="form-control" placeholder="Enter Title">
                                    </div>
										<p id="userexist" style="color:#F00;"></p>
                                 </div>
                            </div>

                            <div class="form-group">
								<div class="row">
									<div class="col-sm-12 col-md-2 controls">
										<h5 style="color: #D42B2B">Terms & Condition Detail<span style="color: #D42B2B">*</span></h5>
									</div>
                                    <div class="col-sm-12 col-md-4 controls">
                                        <textarea name="detail" rows="3" id="detail" class="form-control" placeholder="Enter Detail for Terms & Condition"><?php echo stripslashes($detail); ?></textarea>
                                    </div>
								</div><br>
                            </div>
								
                            <div class="text-xs-right pt-10">
                               
                                <button type="submit" class="btn btn-danger" id="submit" name="submit" style="width: 147px;">Save</button>
                                
                            </div>
                    </div>
                </div>
            </div>
        </form>

        </div>
</div>
    </section>


<?php include("footer.php"); ?>

<script>

$(document).ready(function(){ 
	$("#submit").click(function()
	{ 

		if($("#title").val()=="")
		{
			$("#title").attr("placeholder", "Please Enter Title.");
			$("#title").addClass("error_textbox");
			$("#title").focus();
			return false;
		}
		if($("#detail").val()=="")
		{
			$("#detail").attr("placeholder", "Please Enter Detail.");
			$("#detail").addClass("error_textbox");
			$("#detail").focus();
			return false;
		}

	});
});


</script>
<?php 

if(isset($_POST['submit'])!='')
{
	
  if(@$_GET['id']!='')
  {
	  
	  $arr=array("title"=>ucfirst($_POST['title']),"detail"=>addslashes($_POST['detail']));   
	  $insert = update_query($arr,"id=".$id,"payment_terms_condition");
	  if($insert)
	  {
		  $_SESSION['suc']='Payment Terms & Condition Updated Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Payment Terms & Condition Not Updated... Try Again...';
	  }
	  header("location:".$site_url."payment-terms-condition");
	  exit;
  }
  else
  { 
	  $dt=date('Y-m-d H:i:s');
	  $arr=array("title"=>ucfirst($_POST['title']),"detail"=>addslashes($_POST['detail']),"recorddate"=>$dt); 
	  $insert = insert_query($arr, "payment_terms_condition");
	  if($insert)
	  {
		  $_SESSION['suc']='Payment Terms & Condition Added Successfully...';
	  }
	  else
	  {
		  $_SESSION['unsuc']='Payment Terms & Condition Not Added... Try Again...';
	  }
	  header("location:".$site_url."payment-terms-condition");
	  exit;
  }
}
?>