<?php include("header.php"); ?>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-pageLoadMore/1.0.0/js/dataTables.pageLoadMore.min.js"></script>
<?php include("leftpanel.php"); ?>

<style>
.inv_st_cty{
    margin-left: 792px;
}
.drop-1{
	display:none;
	width:100%;
	float: right;
	margin-bottom: 5px;

}
.drop-2{
	display:none;
	width:100%;
}
[type="radio"]:checked, [type="radio"]:not(:checked) {
    position: unset;
    left: unset;
    opacity: unset;
}
[type="checkbox"]:checked, [type="checkbox"]:not(:checked) {
    position: unset;
    left: unset;
    opacity: unset;
}
@media screen and (max-width: 400px){
.inv_st_cty{
    margin-left: 171px;
}
.drop-2{
	display:none;
	width:100%;
	margin-right: 6px;
}
.drop-1{
	display:none;
	width:100%;
	float: right;
	margin-bottom: 5px;
	/*margin-right: 6px;*/
}
}
@media screen and (min-width: 401px) and (max-width: 767px){
.inv_st_cty{
    margin-left: 171px;
}
.drop-2{
	display:none;
	width:100%;
	margin-right: -20px;
}
.drop-1{
	display:none;
	width:100%;
	float: right;
	margin-bottom: 5px;
	margin-right: -20px;
}
}
@media screen and (min-width: 768px) and (max-width: 992px){
	.inv_st_cty{
    margin-left: 365px;
}
.drop-2{
	display:none;
	width:100%;
	margin-right: -20px;
}
.drop-1{
	display:none;
	width:100%;
	float: right;
	margin-bottom: 5px;
	margin-right: -20px;
}
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
                        <?php
						$create_invoice=0; $self_invoice=0; $all_invoice=0;
						if(@$_SESSION['ntexpress_retroagent']!='')
						{
                        	$create_invoice=$main_roll_staff['invoice'];
							$self_invoice=$main_roll_staff['self_invoice'];
							$all_invoice=$main_roll_staff['all_invoice'];
						}
						else{
							$create_invoice=1;
							$self_invoice=1; 
							$all_invoice=1;
						}
						//if($create_invoice==1)
						//{
						?>
							<button class="btn btn-danger" onClick="location.href='<?php echo $site_url; ?>new-shipment'"> <i class="fa fa-plus"></i> New</button>
                        	<?php
						//}?>
                        <select id="filterby" name="filterby" class="btn btn-danger" onChange="filterval();">
                            <option value="0">Filter By</option>
                            <option value="province">Province</option>
                            <option value="city">City</option>
                        </select>
                    </div>
                    </div>
                <div class="row">
                    <div class="col-6 text-left"></div>
                    <div class="col-6 text-right inv_st_cty">
                        <select name="country" id="country" class="form-control" onChange="get_state(this.value)" style="display:none">
                            <option value="">Select Country</option>
                            <?php $country='184';
                            $selcon=mysqli_query($dlink,"SELECT * FROM location where location_type='0' and location_id='184' and parent_id='0' and is_visible='0' order by name");
                            while ($bcon=mysqli_fetch_array($selcon)) { ?>
                                <option <?php if ($bcon['location_id'] == $country) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option><?php
                            }?>
                        </select>

                        <div class="col-sm-12 col-md-6">

                            <select name="state" id="state" class="form-control drop-1" onChange="get_city(this.value)">
                                <option value="">Select Province</option>
                                <?php
                                $selsta=mysqli_query($dlink,"SELECT * FROM location where location_type='1' and parent_id='".$country."' and is_visible='0' order by name");
                                while($s=mysqli_fetch_array($selsta)) { ?>
                                    <option value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option><?php
                                } ?>
                            </select>
                        </div>
        
                        <div class="col-sm-12 col-md-6">
                            <select name="city" id="city" class="form-control drop-2" onChange="get_citywisereport(this.value)">
                                <option value="">Select City</option> <?php
                                $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$state."' and is_visible='0' order by name");
                                while($s1=mysqli_fetch_array($selcit)) { ?>
                                    <option value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option> <?php
                                } ?>
                            </select>
                        </div>

                    </div>
                </div>
                <style>
                .dt-more-container {
				   text-align:center;
				   margin:2em 0;
				}
				</style>
                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Extn.</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                </table>
                
                <div class="dt-more-container">
                   <button id="btn-example-load-more" style="display:none">Load More</button>
                </div>
                <script>
				$(document).ready(function (){
				   var table = $('#example').DataTable({
					  dom: 'frt',
					  ajax: 'https://gyrocode.github.io/files/jquery-datatables/arrays.json',
					  drawCallback: function(){
						 // If there is some more data
						 if($('#btn-example-load-more').is(':visible')){
							// Scroll to the "Load more" button
							$('html, body').animate({
							   scrollTop: $('#btn-example-load-more').offset().top
							}, 1000);
						 }
				
						 // Show or hide "Load more" button based on whether there is more data available
						 $('#btn-example-load-more').toggle(this.api().page.hasMore());
					  }      
				   });
				 
				   // Handle click on "Load more" button
				   $('#btn-example-load-more').on('click', function(){  
					  // Load more data
					  table.page.loadMore();
				   });
				});
				</script>
                
               <!--  <input type="button" id="save_value" name="save_value" value="Report" class="btn btn-danger"/> -->
                <?php /*?><div class="table-responsive">
                   
                   	<table id="example" class="table table-bordered table-hover">
                       
                        <thead>
                           <tr>
                                <!-- <th><input type="checkbox" name="mainchk" id="master"></th> -->
                                <th>#</th>
                                <th>Date</th>
                                <th>Branch</th>
                                <th>Sales</th>
                                <th>Invoice</th>
                                <th>Cons.</th>
                                <th>Address</th>
                                <th>Area</th>
                                 <th>City</th>                                
                                <th>Province</th>                                 
                                <th>packages</th> 
                                <th>Delivery</th> 
                                <th>Cash</th>
                                <th>COD</th> 
                                <?php
								if(@$_SESSION['ntexpress_retrostaff']!="")
								{ }
								else
								{ ?>
                                <th>Payment</th> <?php
								}?>
                                <!--<th>Paid</th>-->
                                <th>Status</th>
                                <th>Action</th>  
                            </tr>
                            
                        </thead>
                        
                        <tbody id="getData">
                            <?php 
                                $total_amount=0; $total_cash=0; $total_fc=0; $no=1;
								$uid=$userdetail['id'];
								$unm=""; $row=''; $num_rows=0;
								if(@$_SESSION['ntexpress_retrostaff']!="")
								{
									$unm=$_SESSION['ntexpress_retrostaff'];
									
								//	if($self_invoice==1)
										//$row=select_query("*","shipment", array("sales_person LIKE"=>"%".$unm."%"), "id desc limit 10");
										$row=select_query("*","shipment", array("sales_person LIKE"=>"%".$unm."%"), "id desc");
										$num_rows=$num_rows->num_rows;
								//	if($all_invoice==1)
									//	$row=select_query("*","shipment", '', "id desc");
							     }
								else
								{
									//$unm='admin';
									$row=select_query("*","shipment", '', "id desc limit 10");
									$num_rows=select_query("*","shipment", '', "id desc");
									$num_rows=$num_rows->num_rows;
								} 
								//$row=select_query("*","shipment", array("sales_person="=>$unm), "id desc"); 
                                if($row->num_rows)
                                {
                                    while($b=$row->fetch_array())
                                    {
                                        $scity=fetch_query("name","location",array("location_id="=>$b['source_city']));
										$city=$scity['name'];
										
                                        $sstate=fetch_query("name","location",array("location_id="=>$b['source_state']));

                                        $dept_nm=fetch_query("bname","branches",array("id="=>$b['branch']));
										
										$no_pack=fetch_query("SUM(no_of_package) as total_qnty","shipment_detail",array("oid="=>$b['id']));
                            ?>
                           
                                        <tr>
                                            <!-- <td>
                                                <input name="selector[]" id="ad_Checkbox1" class="ads_Checkbox" type="checkbox" value="<?php echo $b['id']; ?>" />
                                            </td> -->
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($b['invoice_date'])); ?></td>
                                            <td><?php echo $dept_nm['bname'];?></td>
                                            <td><?php echo $b['sales_person'];?></td>
                                            <td><?php echo $b['invoice_number'];?></td>
                                            <td><?php echo $b['consignment_no'];?></td>
                                            <td><?php echo $b['source_address'];?></td>
                                            <td><?php echo $b['area'];?></td>
                                            <td><?php echo $city;?></td>
                                            <td><?php echo $sstate['name'];?></td>
                                            <td><?php echo $no_pack['total_qnty'];?></td>
                                            <td><?php if($b['delivery_date']=='1970-01-01 05:30:00') echo ""; else $b['delivery_date'];?></td>
                                            <td><?php echo $b['payment_cash'];?></td>
                                            <td><?php echo $b['payment_fc'];?></td>
                                            <?php
											
                                            if(@$_SESSION['ntexpress_retrostaff']!="")
											{ }
											else {?>
                                            <td><?php echo $b['mode_of_payment'];?> 
                                                <i class="fa fa-edit" style="font-size:16px" data-toggle="modal" data-target="#myModal_<?php echo $b['id']; ?>" data-id="<?php echo $b['id']; ?>" id="editCompany"></i>

                                                <!-- Start Modal -->
                                                <div class="modal fade" id="myModal_<?php echo $b['id']; ?>" role="dialog">
                                                    <div class="modal-dialog">
                                                    
                                                      <!-- Modal content-->
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                          <h4 class="modal-title">Mod of Payment</h4>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form action="" method="post">
                                                                <input type="hidden" name="id" value="<?php echo $b['id']; ?>">

                                                                <input type="hidden" name="finaltotal_val" value="<?php echo $b['finaltotal_val']; ?>">

                                                                <input  type="radio" name="paymentmode" value="COD" id="COD" <?php if($b['mode_of_payment']== 'COD')  {echo 'checked'; }?>> COD
                                                                <br>
                                                                <input type="radio" name="paymentmode" value="Cash" id="Cash" <?php if($b['mode_of_payment']== 'Cash')  {echo 'checked'; }?>> Cash
                                                                <br>
                                                                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-success">
                                                            </form>
                                                          <p id="pData"></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal -->
                                            </td><?php
											}?>
                                            <!--<td></td>-->
                                            <td><select name="status<?php echo $b['id']?>" id="status<?php echo $b['id']?>" class="form-control" onChange="change_status('<?php echo $b['id']?>',this.value)">
                                                <option <?php if ($b['status'] == '1') {?> selected="selected" <?php }?> value="1" >Pending</option>
                                                <option <?php if ($b['status'] == '2') {?> selected="selected" <?php }?> value="2" >In Process</option>
                                                <option <?php if ($b['status'] == '3') {?> selected="selected" <?php }?> value="3" >Delivered</option>
                                                <option <?php if ($b['status'] == '4') {?> selected="selected" <?php }?> value="4" >Reject</option>
                                                <option <?php if ($b['status'] == '5') {?> selected="selected" <?php }?> value="5" >Return</option>
                                                <option <?php if ($b['status'] == '6') {?> selected="selected" <?php }?> value="6" >Paid</option>
                                            </select> </td>
                                            <td>
                                           <!-- <a style="width:57px" href="generate_invoice.php?iid=<?php echo $b['id']?>" target="_blank"  class="btn btn-info btn-xs mb-5">Create Invoice</a>--> &nbsp;
                                            <a style="width:57px" href="<?php echo $site_url?>_private_content_shipment/l_<?php echo $b['invoice_number']?>.pdf" target="_blank"  class="btn btn-info btn-xs mb-5">Invoice</a><br />
                                               			
                                            <a style="width: 80px;color: white;" onClick="sendemail('<?php echo $b['id']?>')" class="btn btn-info btn-xs mb-5">Send Email</a><br />   
                                            </td>
                                        </tr>
                            <?php 
                                        $no++; 
                                    }
                                }
                            ?>
                        </tbody>
                        
                    </table>
                   
                    
                </div><?php */?>
                <style type="text/css">
					.ads_Checkbox,#master {
					position: unset !important;
					left: unset !important;
					opacity: unset !important;
				}
				
				</style>

                <div class="table-responsive" id="dtable_hide">
                	<table id="demotable" class="table table-condensed dataTable table-hover">
                        <thead><tr></tr></thead>
                        <tbody></tbody>
                    </table>
                    <span class="addlink"></span>
                </div>
                <div class="col-sm-12 col-md-12" align="center" id="loaderdiv">
                	<img src="images/loader.gif" style="text-align:center" />
                </div>
            </div>
            
        </div>


    </section>

</div>
<input type="text" name="rowno" id="rowno" value="1" />
<?php
    /*$unm=""; $row=''; $num_rows=0; $qry=''; $html='';
    if(@$_SESSION['ntexpress_retrostaff']!="")
    {
        $unm=$_SESSION['ntexpress_retrostaff'];
        $qry="select * from shipment where 1 and sales_person LIKE '%".$unm."%' order by id desc limit 10";
    }
    else
    {
        $qry="select * from shipment where 1 order by id desc limit 10";
    }
    $empRecords = mysqli_query($dlink, $qry);
    $data = array();
    $no=$rowno;
    if(mysqli_num_rows($empRecords)>0)
    {
        $total_cash=0;
        $total_fc=0;
        $total_amount=0;
        $total_qnty=0;
        while($b=mysqli_fetch_array($empRecords))
        {
          ?>
               <!-- <div class="modal" id="signModal_<?php echo $b['id']?>" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                            </div>
                            <div class="modal-body">
                                <form action="signupload.php" method="post">

                                    <input type="hidden" name="iid" value="<?php echo $b['id']?>">
                                    <div class="form-group two-div-select">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <label for="">Sender signature</label>
                                                <canvas id="sendersignature_<?php echo $b['id']?>" width="300" height="100" style="border: #e4e8eb;border-style: solid;"></canvas>
                                                <div id="errsendersign"></div>
                                                <input type="hidden" name="sendersignatureurl" id="sendersignatureurl_<?php echo $b['id']?>" value="" />
                                                <input type="button" id="sendersigclear_<?php echo $b['id']?>" value="Clear Signature" class="submit-button border-0"/>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group two-div-select">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <label for="">Receiver signature</label>
                                                <canvas id="receiversignature_<?php echo $b['id']?>" width="300" height="100" style="border: #e4e8eb;border-style: solid;"></canvas>
                                                <div id="errreceiversign"></div>
                                                <input type="hidden" name="receiversignatureurl" id="receiversignatureurl_<?php echo $b['id']?>" value="" />
                                                <input type="button" id="receiversigclear_<?php echo $b['id']?>" value="Clear Signature" class="submit-button border-0"/>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="submit" name="save" value="Submit" class="btn btn-info">
                                </form>
                            </div>
                            
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div> -->
          <?php
        }
    }*/
?>


<?php include("footer.php"); ?>

<script>
function capturesign(val) {
	$('#signModal_'+val).show();
    window.requestAnimFrame = (function(callback) {
        return window.requestAnimationFrame ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame ||
          window.oRequestAnimationFrame ||
          window.msRequestAnimaitonFrame ||
          function(callback) {
            window.setTimeout(callback, 1000 / 60);
          }
    })();
    var canvas = document.getElementById("sendersignature_"+val);
    var ctx = canvas.getContext("2d");
    ctx.strokeStyle = "#222222";
    ctx.lineWidth = 4;

    var drawing = false;
    var mousePos = {
        x: 0,
        y: 0
    };
    var lastPos = mousePos;

    canvas.addEventListener("mousedown", function(e) {
        drawing = true;
        lastPos = getMousePos(canvas, e);
    }, false);

    canvas.addEventListener("mouseup", function(e) {
        drawing = false;
        //alert(canvas.toDataURL());
        document.getElementById("sendersignatureurl_"+val).value = canvas.toDataURL();
    }, false);

    canvas.addEventListener("mousemove", function(e) {
        mousePos = getMousePos(canvas, e);
    }, false);

    // Add touch event support for mobile
    canvas.addEventListener("touchstart", function(e) {

    }, false);

    canvas.addEventListener("touchmove", function(e) {
        var touch = e.touches[0];
        var me = new MouseEvent("mousemove", {
          clientX: touch.clientX,
          clientY: touch.clientY
        });
        canvas.dispatchEvent(me);
    }, false);

    canvas.addEventListener("touchstart", function(e) {
        mousePos = getTouchPos(canvas, e);
        var touch = e.touches[0];
        var me = new MouseEvent("mousedown", {
          clientX: touch.clientX,
          clientY: touch.clientY
        });
        canvas.dispatchEvent(me);
    }, false);

    canvas.addEventListener("touchend", function(e) {
        var me = new MouseEvent("mouseup", {});
        canvas.dispatchEvent(me);
         document.getElementById("sendersignatureurl_"+val).value = canvas.toDataURL();
    }, false);

    function getMousePos(canvasDom, mouseEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: mouseEvent.clientX - rect.left,
            y: mouseEvent.clientY - rect.top
        }
    }

    function getTouchPos(canvasDom, touchEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: touchEvent.touches[0].clientX - rect.left,
            y: touchEvent.touches[0].clientY - rect.top
        }
    }

    function renderCanvas() {
        if (drawing) {
            ctx.moveTo(lastPos.x, lastPos.y);
            ctx.lineTo(mousePos.x, mousePos.y);
            ctx.stroke();
            lastPos = mousePos;
        }

    }

    // Prevent scrolling when touching the canvas
    document.body.addEventListener("touchstart", function(e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);

    document.body.addEventListener("touchend", function(e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);
    document.body.addEventListener("touchmove", function(e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);

    (function drawLoop() {
        requestAnimFrame(drawLoop);
        renderCanvas();
    })();

    function clearCanvas() {
        canvas.width = canvas.width;
    }
 
    // Set up the UI
    var sigText = document.getElementById("sendersignatureurl_"+val);
    var sigImage = document.getElementById("sendersignatureurl_"+val);
    var clearBtn = document.getElementById("sendersigclear_"+val);
    //var submitBtn = document.getElementById("sig-submitBtn");
    clearBtn.addEventListener("click", function(e) {
        clearCanvas();
        //sigText.innerHTML = "Data URL for your signature will go here!";
        sigImage.value='';
    }, false);
    /*submitBtn.addEventListener("click", function(e) {
        var dataUrl = canvas.toDataURL();
        sigText.innerHTML = dataUrl;
        sigImage.setAttribute("src", dataUrl);
    }, false);*/



    var canvas1 = document.getElementById("receiversignature_"+val);
    var ctx1 = canvas1.getContext("2d");
    ctx1.strokeStyle = "#222222";
    ctx1.lineWidth = 4;

    var drawing1 = false;
    var mousePos1 = {
        x: 0,
        y: 0
    };
    var lastPos1 = mousePos1;

    canvas1.addEventListener("mousedown", function(e) {
        drawing1 = true;
        lastPos1 = getMousePos1(canvas1, e);
    }, false);

    canvas1.addEventListener("mouseup", function(e) {
        drawing1 = false;
        //alert(canvas.toDataURL());
        document.getElementById("receiversignatureurl_"+val).value = canvas1.toDataURL();
    }, false);

    canvas1.addEventListener("mousemove", function(e) {
        mousePos1 = getMousePos1(canvas1, e);
    }, false);

    // Add touch event support for mobile
    canvas1.addEventListener("touchstart", function(e) {

    }, false);

    canvas1.addEventListener("touchmove", function(e) {
        var touch = e.touches[0];
        var me = new MouseEvent("mousemove", {
          clientX: touch.clientX,
          clientY: touch.clientY
        });
        canvas1.dispatchEvent(me);
    }, false);

    canvas1.addEventListener("touchstart", function(e) {
        mousePos1 = getTouchPos1(canvas1, e);
        var touch = e.touches[0];
        var me = new MouseEvent("mousedown", {
          clientX: touch.clientX,
          clientY: touch.clientY
        });
        canvas1.dispatchEvent(me);
    }, false);

    canvas1.addEventListener("touchend", function(e) {
        var me = new MouseEvent("mouseup", {});
        canvas1.dispatchEvent(me);
         document.getElementById("receiversignatureurl_"+val).value = canvas1.toDataURL();
    }, false);

    function getMousePos1(canvasDom, mouseEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: mouseEvent.clientX - rect.left,
            y: mouseEvent.clientY - rect.top
        }
    }

    function getTouchPos1(canvasDom, touchEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: touchEvent.touches[0].clientX - rect.left,
            y: touchEvent.touches[0].clientY - rect.top
        }
    }

    function renderCanvas1() {
        if (drawing1) {
            ctx1.moveTo(lastPos1.x, lastPos1.y);
            ctx1.lineTo(mousePos1.x, mousePos1.y);
            ctx1.stroke();
            lastPos1 = mousePos1;
        }
    }

    // Prevent scrolling when touching the canvas
    document.body.addEventListener("touchstart", function(e) {
        if (e.target == canvas1) {
            e.preventDefault();
        }
    }, false);

    document.body.addEventListener("touchend", function(e) {
        if (e.target == canvas1) {
            e.preventDefault();
        }
    }, false);
    document.body.addEventListener("touchmove", function(e) {
        if (e.target == canvas1) {
            e.preventDefault();
        }
    }, false);

    (function drawLoop() {
        requestAnimFrame(drawLoop);
        renderCanvas1();
    })();

    function clearCanvas1() {
        canvas1.width = canvas1.width;
    }
 
    // Set up the UI
    var sigText = document.getElementById("receiversignatureurl_"+val);
    var sigImage = document.getElementById("receiversignatureurl_"+val);
    var clearBtn = document.getElementById("receiversigclear_"+val);
    //var submitBtn = document.getElementById("sig-submitBtn");
    clearBtn.addEventListener("click", function(e) {
        clearCanvas1();
        //sigText.innerHTML = "Data URL for your signature will go here!";
        sigImage.value='';
    }, false);
    /*submitBtn.addEventListener("click", function(e) {
        var dataUrl = canvas.toDataURL();
        sigText.innerHTML = dataUrl;
        sigImage.setAttribute("src", dataUrl);
    }, false);*/

}
</script>
<script language="javascript">

$(document).ready(function() {
	/*var rowno=$('#rowno').val();
	
	var table_title='All Invoices';
	
    var report_type='All Invoices';
	var data,
	tableName= '#demotable',
	columns,
	str,
	jqxhr = $.ajax('admin_ajax.php?action=get_other_invoices&rowno='+rowno)
	.done(function () {
		data = JSON.parse(jqxhr.responseText);
		$(tableName).append('<caption style="caption-side: top">'+table_title+'</caption>');
		console.log($.fn.dataTable.isDataTable("#demotable")); // Returns true
		console.log($.fn.dataTable.isDataTable(tableName)); 
		if($.fn.dataTable.isDataTable("#demotable"))
		{
			
			$('#demotable').DataTable().clear().destroy();
			$('#dtable_hide').html(' ');
			$('#dtable_hide').html('<table id="demotable" class="table table-condensed dataTable table-hover"><thead><tr></tr></thead></table>');
			$.each(data.columns, function (k, colObj) 
			{ 
				str = '<th>' + colObj.name + '</th>';
				$(str).appendTo(tableName+'>thead>tr');
			});
			data.columns[0].render = function (data, type, row) 
			{
				return '<h4>' + data + '</h4>';
			}
			$(tableName).dataTable({
				"data": data.data,
				"columns": data.columns,
				"order": [],
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				],
				"fnInitComplete": function () {
					// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
					$('#loaderdiv').hide();
					console.log('Datatable rendering complete');
				}
			});
		}
		else
					{
						$.each(data.columns, function (k, colObj) {
						str = '<th>' + colObj.name + '</th>';
						
							$(str).appendTo(tableName+'>thead>tr');
						});
						
						data.columns[0].render = function (data, type, row) {
							return '<h4>' + data + '</h4>';
						}
						
						$(tableName).dataTable({
						
						"data": data.data,
						"columns": data.columns,
						"order": [],
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						],
						"fnInitComplete": function () {
							// Event handler to be fired when rendering is complete (Turn off Loading gif for example)
							$('#loaderdiv').hide();
							console.log('Datatable rendering complete');
							}
						});
					}
					
	})
					.fail(function (jqXHR, exception) {
									var msg = '';
									if (jqXHR.status === 0) {
										msg = 'Not connect.\n Verify Network.';
									} else if (jqXHR.status == 404) {
										msg = 'Requested page not found. [404]';
									} else if (jqXHR.status == 500) {
										msg = 'Internal Server Error [500].';
									} else if (exception === 'parsererror') {
										msg = 'Requested JSON parse failed.';
									} else if (exception === 'timeout') {
										msg = 'Time out error.';
									} else if (exception === 'abort') {
										msg = 'Ajax request aborted.';
									} else {
										msg = 'Uncaught Error.\n' + jqXHR.responseText;
									}
						console.log(msg);
					});
	
       */
});


$(document).ready(function () {
    $('#master').on('click', function(e) {
        if($(this).is(':checked',true))  
        {
            $(".ads_Checkbox").prop('checked', true);  
        } else {  
            $(".ads_Checkbox").prop('checked',false);  
        }  
    });
});
$(function(){
    $('#save_value').click(function(){
        var val = [];
        $(':checkbox:checked').each(function(i){
            val[i] = $(this).val();
        });
        alert(val);
        $.ajax({
            type: "POST",
            url: "<?php echo $site_url; ?>admin_ajax.php",
            data:{pid:val,action:'updateInvoice'},
            success: function(data)
            {  
                alert(data);
                return false;
            }
        });
    });
});
function confirm_dialog(val)
{
	if(confirm("Are you sure you want to delete this record?"))
	{
		window.location="<?php echo $site_url; ?>case/customers/"+val;
	}
	else
		return false;
}
function sendemail(pid)
{
	$.ajax({
		 type: "POST",
		 url: "<?php echo $site_url; ?>admin_ajax.php",
		 data:{pid:pid,action:'sendemail'},
		 success: function(data)
		 {	
			alert(data);
			return false;
		  }
		});
}
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
            data:{chkids:val,action:'invoice_getprovince_tracking'},
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
        data:{chkids:val,action:'invoice_getcity_tracking'},
        success: function(data)
        {  
            $('#getData').html(data);
        }
    });
}
function filterval()
{
    $('#filterby').change(function(){
        var fltr_val =  $(':selected',this).val();
        if(fltr_val == 0)
        {
            $('#state').hide();
            $('#city').hide();
        }
        if(fltr_val == 'province')
        {
            $('#state').show();
            $('#city').hide();
        }
        if(fltr_val == 'city')
        {
            $('#state').show();
            $('#city').show();
        }
    });
}
</script>
<?php
include 'phpqrcode/qrlib.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;



if(isset($_POST['submit'])!='')
{
    $payment_cash='';$payment_fc='';
    if($_POST['paymentmode'] == 'COD')
    {
        $payment_cash = "0.00";
        $payment_fc = $_POST['finaltotal_val'];
    }
    elseif($_POST['paymentmode'] == 'Cash')
    {
        $payment_fc = "0.00";
        $payment_cash = $_POST['finaltotal_val'];
    }

    $arr_=array("mode_of_payment"=>$_POST['paymentmode'],"payment_cash"=>$payment_cash,"payment_fc"=>$payment_fc);

    $insert = update_query($arr_,"id=".$_POST['id'],"shipment");
    if($insert)
    {
        $_SESSION['suc']='Shipment Detail Updated Successfully...';
    }
    else
    {
        $_SESSION['unsuc']='Shipment Detail Not Updated... Try Again...';
    }
	$delivery_date=$delivery_date." ".$delivery_time;
	$pickup_date=$pickup_date." ".$pickup_time;
	$row=select_query("*","shipment", array("id="=>$_POST['id']), "id asc");
	if($row->num_rows)
	{
		$bc=$row->fetch_array();
		$last_id=$bc['id'];
	 	//generate pdf
		$adm=fetch_query("*", "`myadmin`", array("id="=>1));
		$logo=$adm['logo'];
		$mobile=$adm['mobile_1'];
		$address=$adm['address']; 
		
		//$adm=fetch_query("*", "`myadmin`", array("id="=>$_POST['sender_id']));
		$city=fetch_query("*", "`location`", array("location_id="=>$bc['source_city']));
		$vat=fetch_query("*", "`customers`", array("name="=>$bc['sender_name']));
		$dcity=fetch_query("*", "`location`", array("location_id="=>$bc['destination_city']));
		$shipment=fetch_query("*", "`shipment`", array("id="=>$last_id));
	
		$customer_type=fetch_query("customer_type", "`customers`", array("id="=>$bc['sender_id']));
	   $sender_customer_type=$customer_type['customer_type'];
		
		
		$row=select_query("*","shipment_detail", array("oid="=>$last_id), "id desc");
	  	if($row->num_rows)
	  	{ 
		  	while($b=$row->fetch_array())
		  	{

				$uprice=$b['price']*$b['no_of_package'];
				$utax=($uprice * $b['tax'])/100;
				$totaltaxamt+=$uprice+$utax;
				
				$disnt+=($uprice * $b['discount'])/100;
				$txx=($uprice * $b['tax'])/100;

				$totalAmt=$totaltaxamt -$disnt;

				$finalamt=$totalAmt+($totalAmt *$b['tax'])/100;
			}
		}

		$text = "INVOICE NO: ".$shipment['invoice_number']."\nCOMPANY NAME: NATIONAL EXPRESS TRANSPORT COMPANY\nGRAND TOTAL: ".$shipment['finaltotal_val']."";

		$path = 'qrcode/';

		$filename=uniqid().".png";
		$file = $path.$filename;

		$ecc = 'L';
		$pixel_Size = 10;
		$frame_Size = 10;

		QRcode::png($text, $file, $ecc, $pixel_Size, $frame_size);

		$arr=array("qrcode"=>$filename);

		$insert = update_query($arr,"id=".$last_id,"shipment");

		$qrget=fetch_query("*", "`shipment`", array("id="=>$last_id));


		$mode_of_payment=$qrget['mode_of_payment'];
		$cash='Invoice_Png_Files/checkbox.jpg';
		$cod='Invoice_Png_Files/checkbox.jpg';
		$bank='Invoice_Png_Files/checkbox.jpg';
		if($mode_of_payment=='Cash')
			$cash='Invoice_Png_Files/checkbox_checked.jpg';
		else if($mode_of_payment=='COD')
			$cod='Invoice_Png_Files/checkbox_checked.jpg';
		else if($mode_of_payment=='Bank Transfer')
			$bank='Invoice_Png_Files/checkbox_checked.jpg';
	
	
		$special_delivery=$qrget['special_delivery'];
		
		$officedoor='Invoice_Png_Files/officedelivery.jpg';
		
		if($special_delivery=='Office Delivery')
			$officedoor='Invoice_Png_Files/office_checked.jpg';
		else if($special_delivery=='Door to Door')
			$officedoor='Invoice_Png_Files/door_checked.jpg';
		
		$sender_vat=$shipment['sender_vat']; 
		$sender_iqama='';
		
		$rcv_vat=''; 
		$rcv_iqama='';
		$sender_iqama=$shipment['sender_iqamano'];
		$rcv_iqama=$shipment['desti_iqamano'];
		if($mode_of_payment=='Cash')
		{	
			$sender_vat=$shipment['sender_vat'];
			$rcv_vat=" ";
		}
		else if($mode_of_payment=='COD')
  		{
			$rcv_vat=$shipment['desti_vat_no'];
			$sender_vat=$shipment['sender_vat'];
		}
		
		$disnt=0;
		$html = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<style>
		.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th
		{
			border-top:none !important;
		}
		.table
		{
			margin-bottom:0px !important;
		}
		@page{
        	margin-top: 10px;
			
		}
		
		body {
			font-size:9px !important;
			font-family:"Open Sans", sans-serif;
			  font-style: normal;
			  font-weight: normal;
			  src: url("https://fonts.googleapis.com/css2?family=Open+Sans&display=swap");
		  }
		  .titlecls
		  {
			  font-size:9px !important;
			  font-weight:bold !important;
			  margin-bottom:0px !important;
		   }
		  h6
		  {
			  font-size:10px !important;
			  font-weight:900 !important;
			  margin-bottom:0px !important;
			  margin-top:0px !important;
		  }
		   div {page-break-inside: always !important;}
			table {
				page-break-inside:avoid;
				position:relative;
			}
			@media print {
			   table {
					page-break-inside:avoid;
					position:relative;
				}
			}
			footer {
				position: fixed; 
                bottom: -20px; 
                left: 0px; 
                right: 0px;
                height: 15px; 
				text-align: center;
                
            }
			#header { position: fixed; left: 0px; top: -180px; right: 0px; height: 5px; background-color: #ffffff; text-align: center; }
			.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th
			{
				padding: 5px 8px !important;
			}
		</style>
		<html>
		  <head>
		  </head>
		
		<body style="font-family:Arial">
		<div id="header">
     <h1>&nbsp;</h1>
   </div>
		  <div class="row" >
        	<div class="col-md-6" style="padding:5px;width:30%;display:inline-block;margin-botton:1%">';

        	/*if($shipment['sender_taxtype'] !='')
			{
				if($shipment['sender_taxtype']=="Vat"){
					$html.='<div><span class="titlecls">TAX INVOICE</span></div>';
				}
				else{
					$html.='<div><span class="titlecls">SIMPLIFIED TAX INVOICE</span></div>';
				}
				
			}
			else
			{
				if($shipment['sender_taxtype']=="Vat"){
					$html.='<div><span class="titlecls">TAX INVOICE</span></div>';
				}
				else{
					$html.='<div><span class="titlecls">SIMPLIFIED TAX INVOICE</span></div>';
				}
			}*/
        		
				$html.='<div style="font-size:12px !important;">NATIONAL EXPRESS TRANSPORT COMPANY</div>
				<div style="font-size:11px !important;">Ibn Al-Ameed Road, Al-Sulay</div>
				<div style="font-size:11px !important;">P.O Box : 24117, Al-Riyadh 14273, KSA</div>
				<div style="font-weight: bold;font-size:11px !important;">CR No: 1010352157</div>';
				//if($vat['taxtype']=="Vat"){
					$html.='<div style="font-weight: bold;font-size:11px !important;">VAT No. : 310365617400003</div>';
				//}
			$html.='</div>';
			$tax_invoice_type='';
			/*if($shipment['sender_taxtype'] !='')
			{
				if($shipment['sender_taxtype']=="Vat"){
					$tax_invoice_type='<span class="titlecls" style="font-weight:bold;font-size:12px !important;width:80%;">TAX INVOICE</span>';
				}
				else{
					$tax_invoice_type='<span class="titlecls" style="font-weight:bold;font-size:12px !important;width:80%;">SIMPLIFIED TAX INVOICE</span>';
				}
				
			}
			else
			{
				if($shipment['sender_taxtype']=="Vat"){
					$tax_invoice_type='<span class="titlecls" style="font-weight:bold;font-size:12px !important;width:80%;">TAX INVOICE</span>';
				}
				else{
					$tax_invoice_type='<span class="titlecls" style="font-weight:bold;font-size:12px !important;width:80%;">SIMPLIFIED TAX INVOICE</span>';
				}
			}*/
			if($sender_customer_type==1)
				$tax_invoice_type='<div class="titlecls" style="font-weight:bold;font-size:14px !important;width:80%;margin-right:30px !important"><strong>TAX INVOICE</strong></div>';
			if($sender_customer_type==2)
				$tax_invoice_type='<div class="titlecls" style="font-weight:bold;font-size:14px !important;width:80%;">SIMPLIFIED TAX INVOICE</div>';
			$html.='<div class="col-md-6" align="right" style="width:25%;display:inline-block;margin-botton:1%;padding-top:50px;font-weight:bold !important;font-size:14px !important">'.$tax_invoice_type.'<strong>Consignment No.: '.$qrget['consignment_no'].'</strong></div>
			<div class="col-md-6" align="right"  style="padding:0px;width:30%;display:inline-block;margin-botton:1%;float:right">';
			if($shipment['sender_taxtype'] !='')
			{
				if($shipment['sender_taxtype']=="Vat"){
					$html.='<img src="Invoice_Png_Files/TAX-INVOICE-ARABIC.jpg" width="210" style="float:right">';
				}
				else{
					$html.='<img src="Invoice_Png_Files/simplified-arabic.jpg" width="210" style="float:right">';
				}
			}
			else
			{

				if($shipment['sender_taxtype']=="Vat"){
					$html.='<img src="Invoice_Png_Files/TAX-INVOICE-ARABIC.jpg" width="210" style="float:right">';
				}
				else{
					$html.='<img src="Invoice_Png_Files/simplified-arabic.jpg" width="210" style="float:right">';
				}
			}
			
			$html.='</div>
			</div>
		 
		<div class="row">
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px;background-color:#f4f3f2;width:44%;display:inline-block;">
				<table style="width:100%;">
					<tr><td style="width:25%;font-weight:bold"><img src="Invoice_Png_Files/Invoice-Number.jpg" width="160"></td><td style="width:80%;font-weight:bold;font-weight:bold;font-size:15px !important" align="right">'.$shipment['invoice_number'].'</td></tr>
				</table>
			</div>
			
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px;background-color:#f4f3f2;width:44%;display:inline-block;float:right">
				<table style="width:100%">
					<tr><td style="width:25%;font-weight:bold"><img src="Invoice_Png_Files/Invoice-Date.jpg" width="160"></td><td style="width:80%;font-weight:bold;font-size:15px !important" align="right">'.$shipment['invoice_date'].'</td></tr>
				</table>
			</div>
		</div>
		<div class="row" style="margin-top:2px">
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px;background-color:#3c3d3a;width:44%;display:inline-block;color:#ffffff">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Filespayment_method.jpg" width="320" height="20"></td></tr>
				</table>
			</div>
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px;background-color:#3c3d3a;width:44%;display:inline-block;float:right;color:#ffffff">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Files/Special_Delivery.jpg" width="320" height="20"></td></tr>
				</table>
			</div>
		</div>
		
		<div class="row" style="margin-top:2px">
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important">
				<table class="table"> 
					<tbody>
						<tr>
							<td style="color:#6c6c6c;font-size:12px !important">Cash</td>
							<td><img src="'.$cash.'" width="20"> </td>
							<td style="text-align:right;"><img src="Invoice_Png_Files/cash.jpg" width="75"></td>
							
						</tr>
						<tr>
							<td style="color:#6c6c6c;font-size:12px !important">COD</td>
							<td><img src="'.$cod.'" width="20" ></td>
							<td style="text-align:right;"><img src="Invoice_Png_Files/cod.jpg" width="75"></td>
							
						</tr>
						<tr>
							<td style="color:#6c6c6c;font-size:12px !important">Bank Transfer</td>
							<td><img src="'.$bank.'" width="20" > </td>
							<td style="text-align:right;"><img src="Invoice_Png_Files/web.jpg" width="75"></td>
							
						</tr>
						
					</tbody>
				</table>
			</div>
			<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:2px !important;float:right">
				<table class="table"> 
					<tbody>
						<tr>
							<td rowspan="2"><img src="qrcode/'.$qrget['qrcode'].'" width="70" style="vergicle-align=middle"></td>
							<td colspan="2"><img src="'.$officedoor.'" width="190"> 
							</td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/values_of_goods.jpg" width="70"> 
							<br>
							<img src="Invoice_Png_Files/delivery_cost.jpg" width="70"> 
							</td>
							<td style="float:right;">'.$qrget['value_of_good'].'<br>'.$qrget['delivery_cost'].'</td>
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="row" style="margin-top:2px">
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px;background-color:#3c3d3a;width:44%;display:inline-block;color:#ffffff">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Files/Sender’s Details.jpg" width="320" height="20"></td></tr>
				</table>
			</div>
			
			<div class="col-md-5" style="border:1px solid gray;padding:3px 10px; background-color:#3c3d3a; width:44%; display:inline-block; float:right; color:#ffffff">
				<table style="width:100%;background-color:#3c3d3a;color:#ffffff">
					<tr><td style="width:100%;font-weight:bold"><img src="Invoice_Png_Files/Receiver’s Details.jpg" width="320" height="20"></td></tr>
				</table>
			</div>
		</div>
		
		<div class="row" style="margin-top:2px">
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important">
				<table class="table"> 
					
						<tr>
							<td><img src="Invoice_Png_Files/name.png" width="140"></td>
							<td style="color:#6c6c6c;font-size:12px !important" align="right">'.$shipment['sender_name'].'
							</td>
						</tr>
						<tr>
							<td style="color:#6c6c6c;font-size:12px !important"><img src="Invoice_Png_Files/company_name.jpg" width="140"></td>
							<td style="color:#6c6c6c;font-size:12px !important" align="right">'.$shipment['sender_company'].'
							</td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/address.png" width="140"></td>
							<td style="color:#6c6c6c;font-size:12px !important" align="right">'.$shipment['source_address'].'</td>
						</tr>
						<tr>
							<td style="color:#6c6c6c;font-size:12px !important">&nbsp;Area</td>
							<td style="color:#6c6c6c;font-size:12px !important" align="right">'.$shipment['area'].'</td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/cont-no.png" width="140"></td>
							<td style="color:#6c6c6c;font-size:12px !important" align="right">'.$shipment['sender_mobile'].'</td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/city.png" width="140"></td>
							<td style="color:#6c6c6c;font-size:12px !important" align="right">'.$city['name'].'</td>
						</tr>
						<tr>
							<td><img src="Invoice_Png_Files/country.png" width="140"></td>
							<td style="color:#6c6c6c;font-size:12px !important" align="right">Saudi Arabia</td>
						</tr>';
						$html.='<tr>
								<td><img src="Invoice_Png_Files/vat.no.png" width="140"></td>
								<td style="color:#6c6c6c;font-size:12px !important" align="right">'.$sender_vat.'</td>
							</tr>';
						$html.='<tr>
								<td style="color:#6c6c6c;font-size:12px !important">&nbsp;IQAMA No.</td>
								<td style="color:#6c6c6c;font-size:12px !important" align="right">'.$sender_iqama.'</td>
							</tr>';
						$html.='
					
				</table>
			</div>
			<div class="col-md-5" style="width:1%;display:inline-block">&nbsp;</div>
			<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:46.5%;display:inline-block;float:right;color:#000000;padding-right:0px !important;padding-left:2px !important;float:right">
				<table  class="table " style="width:100%;background-color:#f4f3f2;color:#000000;">
					<tr>
						<td><img src="Invoice_Png_Files/name.png" width="140">/</td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important">'.$shipment['desti_name'].'</td>
					</tr>
					<tr>
						<td style="color:#6c6c6c;font-size:12px !important"><img src="Invoice_Png_Files/company_name.jpg" width="140"></td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important" align="right">'.$shipment['desti_company'].'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/address.png" width="140"></td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important">'.$shipment['destination_address'].'</td>
					</tr>
					<tr>
						<td style="color:#6c6c6c;font-size:12px !important">&nbsp;Area</td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important">'.$shipment['desti_landmark'].'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/cont-no.png" width="140"></td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important">'.$shipment['desti_mobile'].'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/city.png" width="140"></td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important">'.$dcity['name'].'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/country.png" width="140"></td>
						<td style="float:right;verticle-align:middel;color:#6c6c6c;font-size:12px !important">Saudi Arabia</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/vat.no.png" width="140"></td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important">'.$rcv_vat.'</td>
					</tr>
					<tr>
						<td style="color:#6c6c6c;font-size:12px !important">&nbsp;IQAMA No.</td>
						<td style="text-align:left;color:#6c6c6c;font-size:12px !important">'.$rcv_iqama.'</td>
					</tr>
				</table>
			</div>
		<style>
			thead tr th{ background-color: #3c3d3a; font-size: 14px; text-align:center;color:#ffffff }
			table tr td{ font-size: 14px; }
			.tblcls_product > thead > tr > th
			{
				vertical-align:middle !important;
			}
			.tblcls_product > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th
			{
				padding:1px 8px !important;
			}
			hr
			{
				margin-top: 5px !important;
				margin-bottom: 5px !important;
			}
		</style>
		<div class="row" style="margin-top:2px">
			<div class="col-md-12" style="border:1px solid gray;width:96%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important;margin-left:15px">
				<table class="table table-bordered tblcls_product" align="center">
		 		<thead>
					<tr>
						<th><img src="Invoice_Png_Files/SL-NUMBER.jpg" width="45"></th>
						<th><img src="Invoice_Png_Files/itemdescri.png" width="110"></th>
						<th><img src="Invoice_Png_Files/Qty.jpg" width="20"></th>
						<th><img src="Invoice_Png_Files/Unit.jpg" width="25"></th>
						<th><img src="Invoice_Png_Files/Discount-1.jpg" width="50"></th>
						<th><img src="Invoice_Png_Files/VAT-15%.jpg" width="45"></th>
						<th><img src="Invoice_Png_Files/Amount.jpg" width="45"></th>
					</tr>
				</thead>
				<tbody>';
					$final_vat=0;
					$row=select_query("*","shipment_detail", array("oid="=>$last_id), "id desc");
					if($row->num_rows)
					{ 
						$i=1;
						while($b=$row->fetch_array())
						{
							
							$html.='<tr>
								<td style="font-size:12px !important;">'.$i.'</td>
								<td style="font-size:12px !important;">'.$b['type_of_product'].'</td>
								
								<td style="text-align:center;font-size:12px !important;">'.$b['no_of_package'].'</td>
								<td style="text-align:center;font-size:12px !important;">'.$b['price'].'</td>
								<td style="text-align:center;font-size:12px !important;">';
								if($b['discount']==""){
									$html.='-';
								}
								else{
				
									$html.=''.$b['discount'].'%';
								}
								$html.='</td>
								<td style="text-align:center;font-size:12px !important;">15%</td>
								<td style="text-align:center;font-size:12px !important;">'.$b['total_amount'].'</td>
							</tr>';
				
							$totalexvat+=$b['price']*$b['no_of_package'];
				
							$uprice=$b['price']*$b['no_of_package'];
							$utax=($uprice * $b['tax'])/100;
							$totaltaxamt+=$uprice+$utax;
				
				
							$totalvat=$b['tax'];
				
							$disnt+=($uprice * $b['discount'])/100;
							$txx=($uprice * $b['tax'])/100;
				
							$totalAmt=$totaltaxamt -$disnt;
				
							$finalamt=$totalAmt+($totalAmt *$b['tax'])/100;
							//$totalAmt=$totaltaxamt + $totalexvat;
							if($b['tax']!=0)
								$final_vat=$b['tax'];
							$i++;
						}
					}
		
				$html.='</tbody>
				</table></div></div>
	<div class="row" style="margin-top:1px">
			<div class="col-md-6" style="background-color:#fff;width:46.5%;display:inline-block;color:#000000;padding-right:0px !important;padding-left:0px !important">
				<table class="table">
					<tbody style="background-color:#ffffff;color:#ffffff">
						<tr>
							<th colspan="2">&nbsp;</th>
						</tr>
					<tr>
						<td style="background-color:#ffffff;color:#ffffff">Sender’s Name : '.$shipment['sender_name'].'</td>
						<td style="background-color:#ffffff;color:#ffffff">Receiver’s Name : '.$shipment['desti_name'].'</td>
					</tr>
					<tr>
						<td style="background-color:#ffffff;color:#ffffff">'.$shipment['id'].'</td>
						<td style="background-color:#ffffff;color:#ffffff">'.$vat['id'].'</td>
					</tr>
					<tr style="background-color:#ffffff;border:0px;color:#ffffff">
						<td rowspan="3" style="border:0px;">&nbsp;</td>
						<td rowspan="3" style="border:0px;">&nbsp;</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-5" style="border:1px solid gray;background-color:#f4f3f2;width:44.5%;display:inline-block;float:right;color:#000000;padding-right:0px !important;padding-left:2px !important;float:right;margin-right:15px">
				<table class=" " style="width:100%;background-color:#f4f3f2;color:#000000;line-height:30px;">
					<tr>
						<td><img src="Invoice_Png_Files/Total-(-Excluding-VAT-).jpg" width="200" height="25">  </td>
						<td style="text-align:center;font-size:12px !important;">'.($shipment['subtotal_val']+$disnt).'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/Discount.jpg" width="50">  </td>
						<td style="text-align:center;font-size:12px !important;">'.$disnt.'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/Total-(-Excluding-VAT-).jpg" width="200" height="25">  </td>
						<td style="text-align:center;font-size:12px !important;">'.($shipment['subtotal_val']).'</td>
					</tr>
					<tr>
						<td><img src="Invoice_Png_Files/Total-VAT.jpg" width="55" >(15 %)</td>
						<td style="text-align:center;font-size:12px !important;">'.$shipment['vattotal_val'].'</td>
					</tr>
					<tr style="background-color:#cccccc">
						<td><img src="Invoice_Png_Files/Total-Amount-Due.jpg" width="100" height="25"> </td>';
						if($mode_of_payment=='Cash' || $mode_of_payment=='Bank Transfer')
							$html.='<td style="text-align:center;font-size:12px !important;">0</td>';
						else
							$html.='<td style="text-align:center;font-size:12px !important;">'.$shipment['finaltotal_val'].'</td>';
					$html.='</tr>
					
				</table>
	
	</div>

	<div class="row" style="margin-top:15%;margin-left:14px">
		<img src="Invoice_Png_Files/terms-and-conditions.jpg" style="height:165px;width:740px">
	</div>
	<div class="row" style="margin-top:5px">
                    <div class="col-md-3" style="float:left;width:25%;display:inline-block;" align="left">
                        <div style="border: 1px solid #000;">
						<img src="Invoice_Png_Files/Signature-_.jpg" width="140" height:50px; ><br> 
                        <img src="signupload/'.$shipment['sender_sign'].'" width="50" height:50px;>
						</div>
                    </div>
					<div class="col-md-6" style="float:left;width:50%;display:inline-block;" align="left">&nbsp;</div>
                    <div class="col-md-3" style="float:right;margin-right:10px;width:25%;display:inline-block;" align="right">
                         <div style="border: 1px solid #000;">
						<img src="Invoice_Png_Files/Signature-_.jpg" width="140" height:50px; ><br> 
                        <img src="signupload/'.$shipment['receiver_sign'].'" width="50" height:50px;>
						</div>
                    </div>
                </div> 	
	<footer>
	<div class="row">
				<hr>
				<div class="row">
					<div class="col-md-2" style="display:inline-block;color:#000000;width:18%;text-align:center">www.ntexpress.sa 
					</div>
					<div class="col-md-2" style="display:inline-block;color:#000000;width:20%;text-align:center">info@ntexpress.sa
					</div>
					<div class="col-md-2" style="display:inline-block;color:#000000;width:24%;text-align:center">920019908 | 011 2700300
					</div>
					<div class="col-md-2" style="display:inline-block;color:#000000;width:18%;text-align:center">'.$shipment['sales_person'].'
					</div>
					
				</div>
		</div>
	</footer>
	 </body>
		</html>';
		
	// reference the Dompdf namespace
	$dompdf = new Dompdf();
	$dompdf->loadHtml($html);
	$dompdf->setPaper('A4', 'portrait');
	// Render the HTML as PDF
	$dompdf->render();
	ob_end_clean();
	


		$output = $dompdf->output();
		file_put_contents('_private_content_shipment/l_'.$shipment['invoice_number'].'.pdf', $output);
	
	}
    header("location:".$site_url."invoice");
    exit;
}
?>