<?php include("header.php"); ?>

<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

        <h1> Shipment Listing </h1>

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
               
                <div class="table-responsive hasmodal">
                   
                    <table id="aaaaaa" class="table table-bordered table-hover">
                       
                        <thead>
                           
                            <tr>
                                <th width="1%">#</th>
                                <th>Date</th>
                                <th>Representative</th>
                                <th>Invoice<br />No.</th>
                                <th>Consignment<br />No.</th>
                               <!-- <th>Source<br />Dept.</th>-->
                                <th>Source<br />City</th>
                                <th>Source<br />State</th>
                               <!-- <th>Desti<br />Dept.</th>-->
                                <th>Desti<br />City</th>
                                <th>Desti<br />State</th>
                                <th>No. of<br />Pack</th>
                                <th>Amt.</th>
                                <th>Tax</th>
                                <th>Total<br />Amt.</th>
                                <th>Cash</th>
                                <th>FC</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>                                
                            </tr>
                            
                        </thead>
                        
                        <tbody>
                           <?php $total_amount=0;
						   $total_cash=0;
						   $total_fc=0;
							  $no=1;
							  $row=select_query("*","shipment",array("aid="=>$_SESSION['ntexpress_retroagent']), "id desc");
							  if($row->num_rows)
							  {
								  while($b=$row->fetch_array())
								  {
									  
									  if($b['aid']!=0)
									  {
										  $sagent=fetch_query("name","agent",array("id="=>$b['sender_agentid']));
										  $aid=$sagent['name'];
									  }
									  else
									  	$aid='Admin';
									  
									  $scountry=fetch_query("name","location",array("location_id="=>$b['source_country']));
									  $sstate=fetch_query("name","location",array("location_id="=>$b['source_state']));
									  $scity=fetch_query("name","location",array("location_id="=>$b['source_city']));
									  
									  $dcountry=fetch_query("name","location",array("location_id="=>$b['destination_country']));
									  $dstate=fetch_query("name","location",array("location_id="=>$b['destination_state']));
									  $dcity=fetch_query("name","location",array("location_id="=>$b['destination_city']));
									  $total_amount=$total_amount+$b['total_amount'];	
									  $total_cash= $total_cash+$b['payment_cash'];
									  $total_fc=$total_fc+$b['payment_fc'];
									  $sdept=fetch_query("title","department",array("id="=>$b['sender_deptid']));
									  $ddept=fetch_query("title","department",array("id="=>$b['desti_deptid']));
									  $dagent=fetch_query("name","agent",array("id="=>$b['desti_agentid']));
									 $status=$b['status'];
								?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($b['invoice_date'])); ?></td>
                                <td><?php echo $aid ?></td>
                                <td><?php echo $b['invoice_number']; ?></td>
                                <td> <?php echo $b['consignment_no']; ?></td>
                                <!--<td> <?php echo $sdept['title']; ?></td>-->
								<td> <?php echo $scity['name']; ?></td>
								<td> <?php echo $sstate['name']; ?></td>
								     
                                <!--<td><?php echo $ddept['title']; ?></td>-->
								<td><?php echo $dcity['name']; ?></td>
								<td><?php echo $dstate['name']; ?></td>
								<td><?php echo $b['no_of_package']; ?></td>
                                <td><?php echo $b['amount']; ?></td>
                                <td><?php echo $b['tax_percentage']; ?></td>
                                <td><?php echo $b['total_amount']; ?></td>
                                <td><?php echo $b['payment_cash']; ?></td>
                                <td><?php echo $b['payment_fc']; ?></td>
                                <td><select name="status<?php echo $b['id']?>" id="status<?php echo $b['id']?>" class="form-control" onchange="change_status('<?php echo $b['id']?>',this.value)">
                                                <option <?php if ('1' == $status) {?> selected="selected" <?php }?> value="1" >Pending</option>
                                                <option <?php if ('2' == $status) {?> selected="selected" <?php }?> value="2" >In Process</option>
                                                <option <?php if ('3' == $status) {?> selected="selected" <?php }?> value="3" >Delivered</option>
                                                <option <?php if ('4' == $status) {?> selected="selected" <?php }?> value="4" >Reject</option>
											</select> </td>
                                <td> <!--onclick="open_invoice_pdf('<?php echo $b['id']?>')"-->
                                	<a style="width:57px" href="<?php echo $site_url?>_private_content_shipment/s_<?php echo $b['id']?>.pdf" target="_blank"  class="btn btn-info btn-xs mb-5">Invoice</a><br />
                                    <a style="width:57px" href="<?php echo $site_url?>_private_content_shipment/l_<?php echo $b['id']?>.pdf" target="_blank"  class="btn btn-warning btn-xs mb-5">Lables</a>
                                </td>
                                <td><a href="<?php echo $site_url; ?>department-shipment-add/<?php echo $b['id'] ?>"><i class="far fa-edit"></i></a>
                                <a data-toggle="modal" data-target="#modal<?php echo $b['id'] ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                                <div class="modal fade" id="modal<?php echo $b['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                      	<div class="row">
											<div class="col-lg-12">
                                            	<div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Date</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <?php echo date('d-m-Y',strtotime($b['invoice_date'])); ?>
                                                    </div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Invoice Number</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <?php echo $b['invoice_number']; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Consignment Number</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <?php echo $b['consignment_no']; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                	<div class="col-lg-12" style="margin-top:20px;">
                                                    	<h4>Shipper Details</h4>
                                                    </div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Deptartment</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $sdept['title']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Representative</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $aid; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">State</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $sstate['name']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">City</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $scity['name']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Sender Name</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $b['sender_name']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Sender Mobile</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $b['sender_mobile']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Sender Email</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $b['sender_email']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Sender Address</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $b['source_address']; ?></div>
                                                </div>
                                                <div class="row">
                                                	<div class="col-lg-12" style="margin-top:20px;">
                                                    	<h4>Receiver Details</h4>
                                                    </div>
                                                </div>
                                                <div class="row">

													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Deptartment</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $ddept['title']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Representative</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $dagent['name']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">State</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $dstate['name']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">City</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $dcity['name']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Receiver Name</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $b['desti_name']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Receiver Mobile</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $b['desti_mobile']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Receiver Email</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $b['desti_email']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Receiver Address</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $b['destination_address']; ?></div>
                                                </div>
                                                <div class="row">
                                                	<div class="col-lg-12" style="margin-top:20px;">
                                                    	<h4>Package Details</h4>
                                                    </div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Number of Package</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $b['no_of_package']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Amount</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $b['amount']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Tax</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $b['tax_percentage']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Total Amount</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $b['total_amount']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Cash</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $b['payment_cash']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">FC</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $b['payment_fc']; ?></div>
                                                </div>
                                                <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">Comment</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php echo $b['comment']; ?></div>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
										
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </tr>
                             
                            <?php $no++; 
								  } 
							  }
							  ?>
                              <tr style="font-size:20px">
                              	<td style="color:#ffffff"><?php echo $no; ?></td>
                                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                <td class="text-right">Total</td>
                                <td><?php echo $total_amount?></td>
                                <td><?php echo $total_cash?></td>
                                <td><?php echo $total_fc?></td>
                                <td></td>
                              </tr>
                              
                            
                        </tbody>
                        
                    </table>
                    
                </div>
                
            </div>
            
        </div>

    </section>

</div>


<?php include("footer.php"); ?><?php
if(@$_GET['id']!='')
{
	?><a target = '_blank' href="<?php echo $site_url; ?>_private_content_shipment/s_<?php echo $_GET['id']?>.pdf" style="display:none"  id="invoicepdfurl"> afsdf sd df</a>
	<script>
		var url="<?php echo $site_url; ?>_private_content_shipment/s_<?php echo $_GET['id']?>.pdf";
		window.open(url, '_blank');
	</script>
	<?php
}?>
<script language="javascript">
$(document).ready(function() {
    $('#aaaaaa').DataTable({ 
		dom: 'Bfrtip',
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		],
		ordering: false
	});
} );

function change_status(fid,val)
{
	$.ajax({
	 type: "POST",
	 url: "<?php echo $site_url; ?>admin_ajax.php",
	 data:{fid:fid,action:'change_shipment_status',val:val},
	 success: function(data)
	 {	
	 	alert('Status changed');
	  }
	});

}
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