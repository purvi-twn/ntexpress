<?php include("header.php"); ?>

<?php include("leftpanel.php"); ?>

<script href="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script href="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script href="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script href="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script href="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script href="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

<link href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">

<style type="text/css">
        [type="checkbox"]:checked, [type="checkbox"]:not(:checked) {
            position: unset;
            left: unset;
            opacity: unset;
        }
        .multipleSelection {
            width: 300px;
            background-color: #BCC2C1;
        }
  
        .selectBox {
            position: relative;
        }
  
        .selectBox select {
            width: 100%;
            font-weight: bold;
        }
  
        .overSelect {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
        }
  
        #checkBoxes {
            display: none;
            border: 1px #8DF5E4 solid;
        }
  
        #checkBoxes label {
            display: block;
        }
  
        #checkBoxes label:hover {
            background-color: #4F615E;
        }
		.searchbox
		{
			border: 1px solid #eee;
			padding: 10px;
			border-radius: 10px;
		}
		.searchbtn
		{
			background-color: #005cb1;
			border: 0;
			color: #fff;
			width: 100px;
		}
		.form-control
		{
			height: 45px !important;
		}
</style>

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
                		<h3> All Invoice </h3>
                   	</div>
                    <div class="col-6 text-right">
                		
                   	</div>
                </div>
                <div class="searchbox">
                    <div class="row">
                        <div class="col-3 text-left">
                           <button type="button" class="btn btn-danger" id="allinvoice" name="allinvoice" style="width:100%">All Invoice</button>
                        </div>
                        <!-- search by invoice no. -->
                        <div class="col-3 text-left">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Search by Invoice No." name="searchinv" id="searchinv" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))">
                                <button type="submit" name="search_invoice" onclick="search_invoice_btn();" class="searchbtn"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <!-- search by consignment status -->
                        <div class="col-3 text-left">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Search by Consignment Status" name="searchcon" id="searchcon">
                                <button type="submit" name="search_consignment" onclick="search_consignment_btn();" class="searchbtn"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="col-3 text-left">
                            <button type="button" class="btn btn-danger" id="report" name="report" style="width:100%">Generate Report</button>
                        </div>
                    </div>
    
                    <div class="row">&nbsp;</div>
                    <div class="row">
                        <div class="col-3 text-left">
                        <button type="button" class="btn btn-danger" id="mylocation" name="mylocation" style="width:100%">Moving To My Location</button>
                        </div>
                        <div class="col-3 text-left">
                            <?php /*?><div class="multipleSelection">
                                <div class="selectBox"  onclick="showCheckboxes()">
                                    <select>
                                        <option>Select Province</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                      
                                <div id="province_checkBoxes">
                                    <label for="first">
                                        <input type="checkbox" id="all"  value="all" name="selector[]" class="Checkbox"/>
                                        All
                                    </label>
                                    <label for="second">
                                        <input type="checkbox" id="central" value="6182" name="selector[]" class="Checkbox"/>
                                        Central
                                    </label>
                                    <label for="third">
                                        <input type="checkbox" id="eastern" value="6183" name="selector[]" class="Checkbox"/>
                                        Eastern
                                    </label>
                                    <label for="fourth">
                                        <input type="checkbox" id="western" value="6181" name="selector[]" class="Checkbox"/>
                                        Western
                                    </label>
                                </div>
                            </div><?php */?>
                            <select name="country" id="country" class="form-control" onchange="get_state(this.value)" style="display:none">
                                <option value="">Select Country</option>
                                <?php $country='184';
                                $selcon=mysqli_query($dlink,"SELECT * FROM location where location_type='0' and location_id='184' and parent_id='0' and is_visible='0' order by name");
                                while ($bcon=mysqli_fetch_array($selcon)) { ?>
                                    <option <?php if ($bcon['location_id'] == $country) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option><?php
                                }?>
                            </select>
                            <select name="state" id="state" class="form-control" onchange="get_city(this.value)" style="display:inline-block;width:48%">
                                <option value="">Select State</option>
                                <?php
                                $selsta=mysqli_query($dlink,"SELECT * FROM location where location_type='1' and parent_id='".$country."' and is_visible='0' order by name");
                                while($s=mysqli_fetch_array($selsta)) { ?>
                                    <option value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option><?php
                                } ?>
                            </select>
                            &nbsp;&nbsp;
                            <select name="city" id="city" class="form-control" onchange="get_citywisereport(this.value)" style="display:inline-block;width:48%">
                                <option value="">Select City</option> <?php
                                $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$state."' and is_visible='0' order by name");
                                while($s1=mysqli_fetch_array($selcit)) { ?>
                                    <option value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option> <?php
                                } ?>
                            </select>
                        </div>
    
                        <div class="col-3 text-left">
                            <?php /*?><select name="city" id="city" class="form-control" onchange="get_citywisereport(this.value)">
                                <option value="">Select City</option> <?php
                                $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$state."' and is_visible='0' order by name");
                                while($s1=mysqli_fetch_array($selcit)) { ?>
                                    <option value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option> <?php
                                } ?>
                            </select><?php */?>
                            <label style="display:inline-block">Move Forward To</label>
                            <select name="hub" id="hub" class="form-control" onchange="set_hub(this.value)" style="display:inline-block;width:67%">
                               <option value="">Select Hub</option>
                               <option value="6251">Hail</option>
                               <option value="1320">Qasim</option>
                               <option value="6266">Riyadh</option>
                               <option value="6210">Jeddah</option>
                               <option value="6288">Dammam</option>
                               <option value="6217">Madeena</option>
                               <option value="6213">Khamish Musaith</option>
                            </select>
                        </div>
                        <div class="col-3 text-left">
                            <select name="hub" id="hub" class="form-control" onchange="set_status(this.value)" style="width:100%">
                               <option value="">Consignment Status</option>
                               <option value="2">Processing</option>
                               <option value="5">Received</option>
                               <option value="6">Out For Delivery</option>
                               <option value="3">Delivered</option>
                               <option value="7">Return</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="table-responsive mt-15">
                   	
                   	<table id="example" class="table table-bordered table-hover">
                     <!--<table class="table table-bordered table-hover" style="border: 1px solid #eee;">  -->
                        <thead>
                           <tr>
                                 <th><input type="checkbox" name="arriveall" id="arriveall"></th> 
                                <th>No</th>
                                <th>Invoice No.</th>
                                <th>Date</th>
                                <th>Province</th> 
                                <th>City</th>
                                <th>Sales Person</th>
                                <th>Cons. No.</th>
                                <th>No of packages</th> 
                                <th>Tracking</th>
                                <th>Received On</th> 
                                <th>Status</th>
                            </tr>
                            
                        </thead>
                        
                        <tbody id="getData">
                            <?php 
                                $total_amount=0; $total_cash=0; $total_fc=0; $no=1;
								$uid=$userdetail['id'];
								$unm=""; $row='';
								if(@$_SESSION['ntexpress_retrostaff']!="")
								{
									$unm=$_SESSION['ntexpress_retrostaff'];
									$row=select_query("*","shipment", array("sales_person="=>$unm), "id desc");
								}
								else
								{
									//$unm='admin';
									$row=select_query("*","shipment", '', "id desc");
								}
								//$row=select_query("*","shipment", array("sales_person="=>$unm), "id desc");
                                if($row->num_rows)
                                {
                                    while($b=$row->fetch_array())
                                    {
										$tracking=fetch_query("*","shipment_tracking_info",array("iid="=>$b['id']), "id desc limit 1");
										$tracking_city=fetch_query("name","location",array("location_id="=>$tracking['ito']), "location_id desc limit 1");
										$scity=fetch_query("name","location",array("location_id="=>$b['destination_city']));
										$sstate=fetch_query("name","location",array("location_id="=>$b['destination_state']));
										$dept_nm=fetch_query("bname","branches",array("id="=>$b['branch']));
										$no_pack=fetch_query("SUM(no_of_package) as total_qnty","shipment_detail",array("oid="=>$b['id']));
                            			?>
                           				<tr id="tr<?php echo $b['id']?>">
                                            <td><input class="arrive" type="checkbox" name="arriveexport[]" id="chk<?php echo $b['id']?>" value="<?php echo $b['id']?>" /></td> 
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $b['invoice_number'];?></td>
                                            <td><?php echo date('d-m-Y',strtotime($b['invoice_date'])); ?></td>
                                            <td><?php echo $sstate['name'];?></td>
                                            <td><?php echo $scity['name'];?></td>
                                            <td><?php echo $b['sales_person'];?></td>
                                            <td><?php echo $b['consignment_no'];?></td>
                                            <td><?php echo $no_pack['total_qnty'];?></td>
                                            <td><?php echo $tracking_city['name']?></td>
                                            <td><?php if($b['delivery_date']!='1970-01-01 05:30:00') echo $b['delivery_date'];?></td>
                                            <td>
                                                <?php 
													if ($b['status'] == '1') 
														echo 'Pending';
                                                	else if ($b['status'] == '2') 
														echo 'In Process';
													else if ($b['status'] == '3') 
														echo 'Delivered';
                                                	else if ($b['status'] == '4') 
														echo 'Reject';
                                                	else if ($b['status'] == '5') 
														echo 'Received';
													else if ($b['status'] == '6') 
														echo 'Out For Delivery';
													else if ($b['status'] == '7') 
														echo 'Return';
												
												?>
											</td>
                                        </tr><?php
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
$(document).ready(function() {
    $('#example').DataTable( {
        destroy: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv'
        ]
    } );
} );
$(document).ready(function(){
 	  $('input:checkbox').attr('checked',false);
});
function set_hub(loc)
{
	var searchIDs = $(".arrive:checked").map(function(){
        return this.value;
    }).toArray();
	//console.log(searchIDs);
                   
	$.ajax({
		type: "POST",
		url: "<?php echo $site_url; ?>admin_ajax.php",
		data:{chkids:searchIDs,action:'sethub',location:loc},
		success: function(data)
		{  
			//alert(data);
			if(data=='Success')
			{
				alert("Records updated successfully...");
				location.reload();
				
			}
			else
				alert("Problem in updating records...");
			//$('#getData').html(data);
		}
	});
		
}

function set_status(loc)
{
	var searchIDs = $(".arrive:checked").map(function(){
        return this.value;
    }).toArray();
	//console.log(searchIDs);
                   
	$.ajax({
		type: "POST",
		url: "<?php echo $site_url; ?>admin_ajax.php",
		data:{chkids:searchIDs,action:'setstatus',newstatus:loc},
		success: function(data)
		{  
			//alert(data);
			if(data=='Success')
			{
				alert("Records updated successfully...");
				location.reload();
			}
			else
				alert("Problem in updating records...");
			//$('#getData').html(data);
		}
	});
		
}
$('#allinvoice').on('click',function(){
	location.reload();
});
$('#arriveall').on('click',function(){
	if(this.checked)
	{
		$('.arrive').each(function()
		{
			if ($(this).is(":disabled")) {
			}
			else
				this.checked = true;
		});
	}
	else
	{
		$('.arrive').each(function(){
			this.checked = false;
		});
	}
});
function get_state(val)
{
    $.ajax({
     type: "POST",
     url: "<?php echo $site_url; ?>admin_ajax.php",
     data:{country:val,action:'get_state'},
     success: function(data)
     {  
        if(data.trim()=='Not Found')
        {
            $("#state").html('<option value="">Select</option>');  
        }
        else if(data.trim()=='blank')
        {
            $("#state").html('<option value="">Select</option>');  
        }
        else
        {
            $("#state").html(data); 
        }
		
		}
    });
}
function get_city(val)
{
    $.ajax({
     type: "POST",
     url: "<?php echo $site_url; ?>admin_ajax.php",
     data:{state:val,action:'get_city'},
     success: function(data)
     {  
        if(data.trim()=='Not Found')
        {
            $("#city").html('<option value="">Select</option>');  
        }
        else if(data.trim()=='blank')
        {
            $("#city").html('<option value="">Select</option>');  
        }
        else
        {
            $("#city").html(data); 
        }
		$.ajax({
			type: "POST",
			url: "<?php echo $site_url; ?>admin_ajax.php",
			data:{chkids:val,action:'getprovince_tracking'},
			success: function(data)
			{  
				$('#getData').html(data);
			}
		});
		
      }
    });
}
function get_citywisereport(val)
{
	$.ajax({
		type: "POST",
		url: "<?php echo $site_url; ?>admin_ajax.php",
		data:{chkids:val,action:'getcity_tracking'},
		success: function(data)
		{  
			$('#getData').html(data);
		}
	});
}
function confirm_dialog(val)
{
	if(confirm("Are you sure you want to delete this record?"))
	{
		window.location="<?php echo $site_url; ?>case/customers/"+val;
	}
	else
		return false;
}
function search_invoice_btn()
{
    var input_val = $('#searchinv').val(); 
    $.ajax({
        type: "POST",
        url: "<?php echo $site_url; ?>admin_ajax.php",
        data:{input_val:input_val,action:'invoiceid'},
        success: function(data)
        {  
            $('#getData').html(data);
        }
    });
}
function search_consignment_btn()
{
    var input_val = $('#searchcon').val(); 

    $.ajax({
        type: "POST",
        url: "<?php echo $site_url; ?>admin_ajax.php",
        data:{input_val:input_val,action:'consignment'},
        success: function(data)
        {  
            $('#getData').html(data);
        }
    });
}

var show = true;
  
function showCheckboxes() {
    var checkboxes = 
        document.getElementById("checkBoxes");

    if (show) {
        checkboxes.style.display = "block";
        show = false;
    } else {
        checkboxes.style.display = "none";
        show = true;
    }
}

/*$('.Checkbox').change(function() {
    var chkids = $('.Checkbox:checked').map(function() {
        return this.value;
    }).get().join(',');

    $.ajax({
        type: "POST",
        url: "<?php echo $site_url; ?>admin_ajax.php",
        data:{chkids:chkids,action:'province'},
        success: function(data)
        {  
            $('#getData').html(data);
        }
    });
});*/

</script>