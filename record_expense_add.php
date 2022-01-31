<?php include("header.php"); 

if(@$_REQUEST['id']!='')
{
    $id = $_REQUEST['id'];
    $rows = fetch_query("*","record_expense",array("id="=>$id));
    
    $date = $rows['date'];
    $expense_type = $rows['expense_type'];
    $amount = $rows['amount'];
    $vendor_name = $rows['vendor_name'];
    $taxtype  = $rows['taxtype '];
    $taxnumber = $rows['taxnumber'];
    $receipt = $rows['receipt'];
    $place_supply = $rows['place_supply'];
    $tax = $rows['tax'];
    $reference = $rows['reference'];
    $notes = $rows['notes'];
    $paid_through=$rows['paid_through'];
}
else
{
	$date=date('Y-m-d');
    $expense_type = '';
    $amount='';
    $paid_through='';
    $vendor_name='';
    $taxtype='';
    $taxnumber='';
    $place_supply='';
    $receipt='';
    $tax='';
    $reference='';
    $notes='';
}

?>
<style>
    .nav-tabs .nav-link.active, .nav-tabs .nav-link.active:focus, .nav-tabs .nav-link.active:hover, .nav-tabs .nav-item.open .nav-link, .nav-tabs .nav-item.open .nav-link:focus, .nav-tabs .nav-item.open .nav-link:hover 
    {
        color: #fff;
        border-color: transparent;
        border-bottom-color: transparent;
        border-bottom-color: #1e9ff2;
        background-color: #1e9ff2;
    }
    #myTab
    {
        margin-left:0px !important;
    }
    .secondtab {
        border: 1px solid #ccc;
        padding: 10px;
    }
    [type="checkbox"]:checked, [type="checkbox"]:not(:checked) {
        position: unset;
        left: unset;
        opacity: unset;
    }
	.box-bill{
		width: 80%;
		height: 250px;
		background: white;
		border: 1px dotted;
		border-radius: 8px;
		padding: 60px 15px 60px 15px;
	}
	.bill-btn{
		text-align: center;
	}
	.check-bill{
		padding-top: 30px;
	}
	.grybox {
		padding: 30px;
		background-color: #F2F2F2;
		border-radius: 10px;
		margin: 0px 0px;
	}
	.form-group h5{
		margin-top: 10px;
	}
	.dropdown-menu.show{
		position: absolute;
	    transform: translate3d(54px, 5px, 0px);
	    top: 20px;
	    left: 0px;
	    will-change: transform;
	}
	img {
	    max-width: initial;
	}
	
	
	@media screen and (max-width: 400px){
	.mobile-none{
		display: none;
	}
	}
	@media screen and (min-width: 401px) and (max-width: 767px){
		.mobile-none{
		display: none;
	}
	}
	@media screen and (min-width: 768px) and (max-width: 992px){}
	
</style>


<?php include("leftpanel.php"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <!--<h1> Customers <?php echo $pagetitle; ?> </h1>-->
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
                    <div class="col-12 text-left">
                        <h3> New Record Expense </h3>
                    </div>
                </div>

                <form method="post" action="" name="bg" id="bg" enctype="multipart/form-data" autocomplete="off" >

					<div class="col-md-12 col-lg-12 col-sm-12">
						<div class="row">
							<div class="col-md-6 col-lg-6 col-sm-12">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="form-group">
											<h5 class="rbcl" style="color: #D42B2B">Date<span style="color: #D42B2B">*</span></h5>
										</div>
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="controls">
											<input type="date" name="date" id="date" class="form-control" value="<?php echo $date; ?>" >
											
										</div>
									</div>
								</div>
									
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<h5 class="rbcl" style="color: #D42B2B; margin-bottom: 0.5rem;">Expense Type<span style="color: #D42B2B">*</span></h5>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="controls"> 
											<select name="expense_type" id="expense_type" class="form-control">
											<option></option>
											<?php
                                            $getData=mysqli_query($dlink,"SELECT * FROM expense_type where sub_expense=0  order by expense_type");
                                            while($s1=mysqli_fetch_array($getData)) {
                                            ?>
                                                <option <?php if($expense_type == $s1['id']) echo "selected";?> value="<?php echo $s1['id']; ?>" ><?php echo $s1['expense_type']; ?></option>
                                            <?php
                                            }
                                        	?>
											</select>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<h5 class="rbcl" style="color: #D42B2B">Amount<span style="color: #D42B2B">*</span></h5>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<!-- id="pname_div" -->
										<div class="controls">
											<input type="text" name="amount" id="amount" class="form-control" value="<?php echo $amount; ?>" style="display:inline-block">
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<h5 class="rbcl" style="color: #D42B2B; margin-bottom: 0.5rem;">Paid Through<span style="color: #D42B2B">*</span></h5>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="controls"> 
											<select name="paid_through" id="paid_through" class="form-control">
												<option>Select Account</option>
												<option <?php if($paid_through == 'Cash') echo "selected";?> value="Cash">Cash</option>
												<option <?php if($paid_through == 'COD') echo "selected";?> value="COD">COD</option>
												<option <?php if($paid_through == 'Bank Transfer') echo "selected";?> value="Bank Transfer">Bank Transfer</option>
											</select>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<h5>Vendor</h5>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="controls">

											<select name="vendor_name" id="vendor_name" class="form-control">
												<option value="">Select Vendor Name</option>
												<?php 
												$selcon=mysqli_query($dlink,"SELECT * FROM vendor");
													while ($bcon=mysqli_fetch_array($selcon)) {
													?>
												<option <?php if ($bcon['name'] == $vendor_name) {?> selected="selected" <?php }?> value="<?php echo $bcon['name']; ?>"><?php echo $bcon['name']; ?></option>
													<?php
													}
													?>
											</select>
										</div>
									</div>
								</div>

								<div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <h5 class="rbcl" style="color: #D42B2B; margin-bottom: 0.5rem;">Tax Treatment<span style="color: #D42B2B">*</span></h5>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="controls">
                                            <select name="taxtype" id="taxtype" class="form-control">
                                                <option <?php if($taxtype=='Non-Vat') { ?> selected <?php } ?> value="Non-Vat">Non Vat Registered</option>
                                                <option <?php if($taxtype=='Vat') { ?> selected <?php } ?> value="Vat">Vat Registered</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="vat" style="display:none;">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <h5 class="rbcl" style="color: #D42B2B; margin-bottom: 0.5rem;">Tax Registration No.<span class="text-danger">*</span></h5>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="controls">
                                            <input onblur="checkwidth(this.value)" type="text" name="taxnumber" id="taxnumber" class="form-control" value="<?php echo $taxnumber; ?>"  minlength="15" maxlength="15"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <h5 class="rbcl" style="color: #D42B2B; margin-bottom: 0.5rem;">Place Of Supply<span style="color: #D42B2B">*</span></h5>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="controls">
                                            <select name="place_supply" id="place_supply" class="form-control">
                                                <option <?php if($paid_through == 'State') echo "selected";?> value="State">State</option>
                                                <option <?php if($paid_through == 'City') echo "selected";?> value="City">City</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
							</div>

							<div class="col-md-2 col-lg-2 col-sm-12"></div>

							<div class="col-md-4 col-lg-4 col-sm-12">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="form-group">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="controls">
										</div>
									</div>
								</div>
								
								<div class="row">
                                	<div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    	<div class="controls">
											<div class="box-bill">                                
												<p style="text-align: center; margin-bottom: 0px;">Drag & drop to upload</p>
												<p style="text-align: center; font-size: smaller;">(Maximun file size allowed in 5mb)</p>
												<div class="bill-btn">
													<!--<button class="btn btn-danger">Attach Receipt</button>-->
													<div class="controls">
				                                        <input type="file" name="receipt" id="receipt" class="form-control" value="<?php echo $receipt; ?>" style="display:inline-block" onblur="Checkfiles()">
				                                    </div>
                                    				<?php if($receipt!=""){?>
				                                    <div class="form-group">                            
				                                        <label class="col-md-2 control-label"></label>
				                                        <div class="col-sm-4">
				                                            <img src="<?php echo $site_url; ?>record_expense/<?php echo $receipt;?>" width=100/>
				                                        </div>
				                                    </div>
                                    				<?php } ?>
												</div>
											</div>
                                		</div>
                            		</div>
								</div>
							</div>
						</div>
						
                	</div>

                	<div class="bt-1"> </div>
			
					<div class="col-sm-12 col-md-6 col-lg-6 pt-10">
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<h5>Tax</h5>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="controls"> 
											<select name="tax" id="tax" class="form-control">
												<option <?php if($tax == 'Tax1') echo "selected";?> value="Tax1">Tax1</option>
												<option <?php if($tax == 'Tax2') echo "selected";?> value="Tax2">Tax2</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<h5>Reference#</h5>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="controls"> 
											<input type="text" name="reference" id="reference" class="form-control" value="<?php echo $reference; ?>" style="display:inline-block">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="controls">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-12 col-md-8 col-lg-8">
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12">

								<div class="row">
									<div class="col-lg-4 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<h5>Notes</h5>
										</div>
									</div>
									<div class="col-lg-8 col-md-6 col-sm-12 col-12">
										<!-- id="pname_div" -->
										<div class="controls">
											<textarea name="notes" id="notes" class="form-control"><?php echo $notes; ?></textarea>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row pt-10">
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-20">
									<button type="submit" class="btn btn-danger" id="submit" name="submit">Save</button>

								</div>
							</div>							
						</div>
					</div>
				</form>
				
			</div>
		</div>
    </section>
</div>
<?php include("footer.php"); ?>

<script type="text/javascript">

$(document).ready(function(){ 

	$('#taxtype').on('change', function() {
      if ( this.value == 'Vat')
      {
        $("#vat").show();
        $("#hidevat").hide();
        
      }
      else
      {
        $("#hidevat").show();
        $("#vat").hide();
      }
    });
    /*** form validation ****/
    $("#submit").click(function()
    { 
        if($("#Date").val()=="")
        {
            $("#Date").attr("placeholder", "Please Enter Date.");
            $("#Date").addClass("error_textbox");
            $("#Date").focus();
            return false;
        }

        if($("#expense_type").val()=="")
        {
            $("#expense_type").attr("placeholder", "Please Select Expense Type.");
            $("#expense_type").addClass("error_textbox");
            $("#expense_type").focus();
            return false;
        }

        if($("#amount").val()=="")
        {
            $("#amount").attr("placeholder", "Please Enter Amount.");
            $("#amount").addClass("error_textbox");
            $("#amount").focus();
            return false;
        }

        if($("#paid_through").val()=="")
        {
            $("#paid_through").attr("placeholder", "Please Select Paid Through.");
            $("#paid_through").addClass("error_textbox");
            $("#paid_through").focus();
            return false;
        }

        if($("#taxtype").val()=="")
        {
            $("#taxtype").attr("placeholder", "Please Select Tax Type.");
            $("#taxtype").addClass("error_textbox");
            $("#taxtype").focus();
            return false;
        }

        if($("#place_supply").val()=="")
        {
            $("#place_supply").attr("placeholder", "Please Select Place of Supply.");
            $("#place_supply").addClass("error_textbox");
            $("#place_supply").focus();
            return false;
        }

        var vatVal = $('#taxtype').val();
        if(vatVal == 'Vat')
        {
        	if($("#taxnumber").val()=="")
	        {
	            $("#taxnumber").attr("placeholder", "Please Enter Taxnumber.");
	            $("#taxnumber").addClass("error_textbox");
	            $("#taxnumber").focus();
	            return false;
	        }
        }
    });
    /**** form validation ****/
});


function Checkfiles()
{
    var formData = new FormData();
    var file = document.getElementById("receipt").files[0];
    formData.append("Billdata", file);
    var t = file.type.split('/').pop().toLowerCase();
    if (t != "jpeg" && t != "JPEG" && t != "jpg" && t != "JPG" && t != "png" && t != "pdf") {
        alert('Upload Pdf or Jpg or Png images only.');
        document.getElementById("receipt").value = '';
        return false;
    }
    return true;
}
</script>

<?php 
if(isset($_POST['submit'])!='')
{
    if(@$_GET['id']!='')
    {
        $dt=date('Y-m-d H:i:s');

        $row_select = fetch_query("receipt","record_expense",array("id="=>$_GET['id']));

        if(@$_FILES['receipt']['name']!="")
		{
			
			$unlink_image = $row_select['receipt'];
			@unlink("record_expense/".$unlink_image);
		
			if (($_FILES["receipt"]["type"] == "image/gif") || ($_FILES["receipt"]["type"] == "image/jpeg") || ($_FILES["receipt"]["type"] == "image/jpg") || ($_FILES["receipt"]["type"] == "image/pjpeg") || ($_FILES["receipt"]["type"] == "image/x-png") || ($_FILES["receipt"]["type"] == "image/png"))
			{
				$uploadedfile = $_FILES["receipt"]["tmp_name"];
				$image11= rand().$_FILES['receipt']['name'];
				$image1 = str_replace(' ', '_', $image11);
				move_uploaded_file($uploadedfile, "record_expense/".$image1);
			}
			$image=$image1;
		}
		else{
			$image=$row_select['receipt'];
		}


        $arr=array(
            "date"=>$_POST['date'],
            "expense_type"=>$_POST['expense_type'],
            "amount"=>$_POST['amount'],
            "paid_through"=>$_POST['paid_through'],
            "vendor_name"=>$_POST['vendor_name'],
            "taxtype"=>$_POST['taxtype'],
            "taxnumber"=>$_POST['taxnumber'],
            "place_supply"=>$_POST['place_supply'],
            "receipt"=>$image,
            "tax"=>$_POST['tax'],
            "reference"=>$_POST['reference'],
            "notes"=>$_POST['notes'],
            "recorddate"=>$dt
        ); 
        
        $insert = update_query($arr,"id=".$id,"record_expense");

        if($insert)
        {
            $_SESSION['suc']='Record Expense Detail Update Successfully...';
        }
        else
        {
          $_SESSION['unsuc']='Record Expense Detail Not Update... Try Again...';
        }
        header("location:".$site_url."record-expense-listing");
    }
    else
    { 
    
        $dt=date('Y-m-d H:i:s');

        if(@$_FILES['receipt']['name']!="")
        {
            $row_select = fetch_query("logo","myadmin",array("id="=>"1"));
            $unlink_image = $row_select['logo'];
            @unlink("record_expense/".$unlink_image);
    
            if (($_FILES["receipt"]["type"] == "image/jpeg") || ($_FILES["receipt"]["type"] == "image/jpg") || ($_FILES["receipt"]["type"] == "image/pjpeg") || ($_FILES["receipt"]["type"] == "image/x-png") || ($_FILES["receipt"]["type"] == "image/png"))
            {
                $uploadedfile = $_FILES["receipt"]["tmp_name"];
                $image11= rand().$_FILES['receipt']['name'];
                $image1 = str_replace(' ', '_', $image11);
                move_uploaded_file($uploadedfile, "record_expense/".$image1);
            }
            $image=$image1;
        }

        $arr=array(
            "date"=>$_POST['date'],
            "expense_type"=>$_POST['expense_type'],
            "amount"=>$_POST['amount'],
            "paid_through"=>$_POST['paid_through'],
            "vendor_name"=>$_POST['vendor_name'],
            "taxtype"=>$_POST['taxtype'],
            "taxnumber"=>$_POST['taxnumber'],
            "place_supply"=>$_POST['place_supply'],
            "receipt"=>$image,
            "tax"=>$_POST['tax'],
            "reference"=>$_POST['reference'],
            "notes"=>$_POST['notes'],
            "recorddate"=>$dt
        ); 

        $insert = insert_query($arr, "record_expense");
      
        $last_id=$dlink->insert_id;
        if($insert)
        {
            $_SESSION['suc']='Record Expense Detail Added Successfully...';
        }
        else
        {
          	$_SESSION['unsuc']='Record Expense Detail Not Added... Try Again...';
        }
        header("location:".$site_url."record-expense-listing");
    }
}
?>