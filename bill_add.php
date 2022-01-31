<?php include("header.php"); 

if(@$_REQUEST['id']!='')
{
    $id = $_REQUEST['id'];
    $rows = fetch_query("*","bill",array("id="=>$id));
    
    $vendor_name = $rows['vendor_name'];
    $bill = $rows['bill'];
    $bill_date = $rows['bill_date'];
    $payment_terms = $rows['payment_terms'];
    $bill_due_date  = $rows['bill_due_date '];
    $payment_method = $rows['payment_method'];
    $receipt = $rows['receipt'];
    $subtotal = $rows['subtotal'];
    $discount = $rows['discount'];
    $rate = $rows['rate'];
    $total = $rows['total'];
    $reference = $rows['reference'];
    $notes = $rows['notes'];
    $item_rate = $rows['item_rate'];
}
else
{
    $vendor_name = '';
    
    $bill_date='';
    $payment_terms='';
    $bill_due_date='';
    $payment_method='';
    $receipt='';
    $subtotal='';
    $discount='';
    $rate='';
    $total='';
    $reference='';
    $notes='';
    $item_rate='';

    $bill="";
    /*$rows = fetch_query("*","bill",""," id desc limit 1");
    if($rows['bill']!='')
        $bill=sprintf("%05d", $rows['bill']+1);
    else
        $bill=100001;*/
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
        width: 100%;
        height: auto;
        background: white;
        border: 1px dotted;
        border-radius: 8px;
        padding: 15px 15px 15px 15px;
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
                        <h3> New Bill </h3>
                    </div>
                    <form method="post" action="" name="bg" id="bg" enctype="multipart/form-data" autocomplete="off" >

                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <h5 class="rbcl" style="color: #D42B2B">Vendor Name<span style="color: #D42B2B">*</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
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
                                                <h5 class="rbcl" style="color: #D42B2B; margin-bottom: 0.5rem;">Bill#<span style="color: #D42B2B">*</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="controls"> 
                                                <input type="text" name="bill" id="bill" class="form-control" value="<?php echo $bill; ?>" style="display:inline-block">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <h5 class="rbcl" style="color: #D42B2B">Bill Date<span style="color: #D42B2B">*</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <!-- id="pname_div" -->
                                            <div class="controls">
                                                <input type="date" name="bill_date" id="bill_date" class="form-control" value="<?php echo $bill_date; ?>" style="display:inline-block">
                                                  <!--  <?php echo $fname; ?> --> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <h5>Payment Terms</h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="controls">
                                                <select name="payment_terms" id="payment_terms" class="form-control">
                                                    <option value="">Select Payment Terms</option>
                                                    <?php 
                                                    $selcon=mysqli_query($dlink,"SELECT * FROM payment_terms_condition");
                                                    while ($bcon=mysqli_fetch_array($selcon)) {
                                                    ?>
                                                    <option <?php if ($bcon['title'] == $payment_terms) {?> selected="selected" <?php }?> value="<?php echo $bcon['title']; ?>"><?php echo $bcon['title']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <div class="row mobile-none">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="controls">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mobile-none">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="controls">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mobile-none">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                    
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="controls">
                                                    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mobile-none">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="controls">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mobile-none">
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
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <h5 class="rbcl" style="color: #D42B2B">Due Date<span style="color: #D42B2B">*</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <!-- id="pname_div" -->
                                            <div class="controls">
                                                <input type="date" name="bill_due_date" id="bill_due_date" class="form-control" value="<?php echo $bill_due_date; ?>" style="display:inline-block">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <h5>Payment Method</h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="controls">
                                                <select name="payment_method" id="payment_method" class="form-control">
                                                    <option value="">Select Payment Method</option>
                                                    <option <?php if($payment_method == 'check'){ ?> selected <?php } ?> value="check">Check</option>
                                                    <option <?php if($payment_method == 'cash'){ ?> selected <?php } ?> value="cash">Cash</option>
                                                    <option  <?php if($payment_method == 'card'){ ?> selected <?php } ?> value="card">Card</option>
                                                    <option <?php if($payment_method == 'bank-transfer'){ ?> selected <?php } ?> value="bank-transfer">Bank Transfer</option>
                                                    <option <?php if($payment_method == 'other'){ ?> selected <?php } ?> value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
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
                                                                <img src="<?php echo $site_url; ?>bill/<?php echo $receipt;?>" width=100/>
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
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                        <div class="form-group check-bill">
                                            <h4>Item Rates Are</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="controls check-bill">
                                            <label><input type="checkbox" name="chkbx" class="chb taxchk" checked="checked" value="tax-inclusive" <?php if($item_rate == 'tax-inclusive'){ ?> checked <?php } ?>/> Tax inclusive</label>
                                                    <label><input type="checkbox" name="chkbx" class="chb taxchk" value="tax-exclusive" <?php if($item_rate == 'tax-exclusive'){ ?> checked <?php } ?>/> Tax Exclusive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                    
                        <div class="table-responsive" id="tableData">
                            <table class="table table-bordered table-hover"  role="grid" colspan="5" colspadding="5">
                                <thead>
                                    <tr style="background: #005cb1; color: white;">
                                        <th>
                                            <input type="checkbox" id="master" onclick="allCheck();"></th>
                                        </th>
                                        <th>SI.No.</th>
                                        <th>ItemDetail</th>
                                        <th>Account Type</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th class="taxHideShow dropdown">Tax% 
                                    
                                         <!-- <i class="fa fa-caret-down" style="float: right;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="taxMenu();">
                                            
                                          </i>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Exempt</a>
                                            <a class="dropdown-item" href="#">Zero Rate (0%)</a>
                                            <a class="dropdown-item" href="#">Standard Rate (15%)</a>
                                          </div> -->

                                            <!--<select name="tax[0]" id="tax0" class="form-control showTax" onchange="get_tax_val(this);"  style="display:none;">
                                                
                                                <option value="Exempt">Exempt</option>
                                                <option value="0">Zero Rate (0%) </option>
                                                <option value="15">Standard Rate (15%)</option>
                                            </select>-->
                                            
                                            <!--<i class="fa fa-caret-down" style="float: right;"></i>-->
                                            <select name="tax[0]" id="tax0" class="form-control" onchange="get_tax_val(this);">
                                                <option value="exempt">Exempt</option>
                                                <option value="0">Zero Rate (0%) </option>
                                                <option value="15">Standard Rate (15%)</option>
                                            </select>
                                            <input type="hidden" name="ratearea" id="ratearea" value="1">
                                        </th>
                                        <th>Amount</th>
                                        <th>
                                            <button style="margin-bottom: 10px;display:none;" class="btn btn-success w-30  " >Delete All Selected</button>
                                            <i class="fas fa-trash-alt newicon  extraaddnew" id="0" onclick="delete_all();"></i>
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody id="compare_div">
                                    <?php
                                    if(@$_REQUEST['id']!='')
                                    {
                                        $row=select_query("*","bill_detail", array("bid="=>$id), "id asc");
                                        if($row->num_rows)
                                        { 
                                            $i=1;
                                            while($b=$row->fetch_array())
                                            { ?>
                                                <tr class="tr_0" id="0">
                                                    <td>
                                                        <input type="checkbox" name="chk_0" id="chk_0" class="default checkBoxClass2 sub_chk" data-id="{{$b->id}}">
                                                    </td>
                                                    <td><?php echo $i; ?></td>
                                                    <td>
                                                        <input type="text" name="type_of_product[0]" id="type_of_product[0]" class="form-control" value="<?php echo $b['name']; ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="ac_type[0]" id="ac_type0" class="form-control" value="<?php echo $b['account']; ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="quantity[0]" id="quantity0" class="form-control" value="<?php echo $b['quantity']; ?>" onkeypress="return isNumberKey(event);" onblur="get_calulation(0)">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="price[0]" id="price0" class="form-control" value="<?php echo $b['price']; ?>" onkeypress="return isNumberKey(event);" onblur="get_calulation(0)">
                                                    </td>
                                                    
                                                    <td class="taxval taxHideShow">
                                                        <?php echo $b['tax']; ?>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="amount[0]" id="amount0" class="form-control" value="<?php echo $b['amount']; ?>" onkeypress="return isNumberKey(event);" readonly="readonly">
                                                    </td>
                                                    <td>
                                                        <i class="fas fa-trash-alt newicon" id="0" onclick="hidetr(this.id);"></i>
                                                        <input type="hidden" id="trremove_0" value="1" name="trremove_0" />
                                                        <input type="hidden" id="total_rows" value="1" name="total_rows" />
                                                    </td>
                                               </tr>
                                            <?php 
                                            $i++;
                                            }
                                        }
                                 
                                    }
                                    else
                                    {
                                        ?>
                                        <tr class="tr_0" id="0">
                                            <td>
                                                <input type="checkbox" name="chk_0" id="chk_0" class="default checkBoxClass2 sub_chk" data-id="0">
                                            </td>
                                            <td>1</td>
                                            <td>
                                                <input type="text" name="type_of_product[0]" id="type_of_product0" class="form-control" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="ac_type[0]" id="ac_type0" class="form-control" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="quantity[0]" id="quantity0" class="form-control" value="" onblur="get_calulation(0)" onkeypress="return isNumberKey(event);">
                                            </td>
                                            <td>
                                                <input type="text" name="price[0]" id="price0" class="form-control" value="" onkeypress="return isNumberKey(event);" onblur="get_calulation(0)">
                                            </td>
                                            
                                            <td class="taxval taxHideShow">
                                                Exempt
                                            </td>
                                            <td>
                                                <input type="text" name="amount[0]" id="amount0" class="form-control" value="" onkeypress="return isNumberKey(event);" readonly="readonly">
                                            </td>
                                            <td>
                                                <i class="fas fa-trash-alt newicon" id="0" onclick="hidetr(this.id);"></i>
                                                <input type="hidden" id="trremove_0" value="1" name="trremove_0" />
                                                <input type="hidden" id="total_rows" value="1" name="total_rows" />
                                            </td>
                                       </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                                
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="row"> 
                                        <div class="col-md-6 col-sm-12 col-lg-6 mt-20 pb-10">
                                            <a class="btn btn-danger add-comp btn-x" style="color: #fff;"><i class="fa fa-plus"></i> Add </a>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
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
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="form-group">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="controls">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="form-group">
                                                <h5>Notes</h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <!-- id="pname_div" -->
                                            <div class="controls">
                                                <textarea name="notes" id="notes" class="form-control"><?php echo $notes; ?></textarea>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                        <div class="row pt-10">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="bt-1"> </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-20">
                                                        <button type="submit" class="btn btn-danger" id="submit" name="submit">Save</button>


                                                        <button type="submit" class="btn btn-danger" id="cancel" name="cancel">Cancle</button>
                                                    </div>
                                                </div>                          
                                            </div>
                                        </div>
                                        </div>
                                
                              <div class="col-md-6 col-sm-12 col-lg-6 x-11">
                                    <div class="grybox" style="margin: 20px 10px;">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-12 col-8 mt-10">
                                                Sub Total
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-4 mt-10">
                                                
                                                <?php
                                                if(@$_REQUEST['id']!='')
                                                {
                                                    ?>
                                                    <input type="hidden" name="total_val" id="total_val" value="<?php echo $subtotal; ?>">
                                                    <span id="spantotal"><?php echo $subtotal; ?></span> 
                                                    
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="hidden" name="total_val" id="total_val" value="">
                                                    <span id="spantotal">0.00</span> 
                                                    <?php
                                                } ?>
                                            </div>
                                            <div class="col-md-8 col-sm-12 col-8 mt-10">
                                                Total Discount
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-4 mt-10">
                                                
                                                <?php
                                                if(@$_REQUEST['id']!='')
                                                {
                                                    ?>
                                                    <input type="hidden" name="discount_val" id="discount_val" value="<?php echo $discount; ?>">
                                                    <span id="spandiscount"><?php echo $discount; ?></span> 
                                                    
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="hidden" name="discount_val" id="discount_val" value="">
                                                    <span id="spandiscount">0.00</span> 
                                                    <?php
                                                } ?>
                                            </div>
                                            <div class="col-md-8 col-sm-12 col-8 mt-10" style="display: none;">
                                                Subtotal
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-4 mt-10" style="display: none;">
                                                
                                                <?php
                                                if(@$_REQUEST['id']!='')
                                                {
                                                    ?>
                                                    <input type="hidden" name="subtotal_val" id="subtotal_val" value="<?php echo $subtotal_val; ?>">
                                                    <span id="subtotal"><?php echo $subtotal_val; ?></span> 
                                                    
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="hidden" name="subtotal_val" id="subtotal_val" value="">
                                                    <span id="subtotal">0.00</span> 
                                                    <?php
                                                } ?>
                                            </div>
                                            <div class="col-md-8 col-sm-12 col-8 mt-10 taxHideShow rateHideShow" style="display:none;">
                                                
                                                <?php
                                                if(@$_REQUEST['id']!='')
                                                {
                                                    ?>
                                                    <input type="hidden" name="vatper_val" id="vatper_val" value="<?php echo $vatper_val; ?>">
                                                    <!-- RATE(<span id="vatper" class="taxval"></span>%) -->
                                                    <span id="vatper" class="taxval"></span>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="hidden" name="vatper_val" id="vatper_val" value="">
                                                    <!-- RATE(<span id="vatper" class="taxval"></span>%) -->
                                                    <span id="vatper" class="taxval"></span>
                                                   
                                                    <?php
                                                } ?>
                                                
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-4 mt-10 taxHideShow rateHideShow" style="display:none;">
                                                
                                                <?php
                                                if(@$_REQUEST['id']!='')
                                                {
                                                    ?>
                                                    <input type="hidden" name="vattotal_val" id="vattotal_val" value="<?php echo $rate; ?>">
                                                    <span id="vattotal"><?php echo $rate; ?></span> 
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="hidden" name="vattotal_val" id="vattotal_val" value="">
                                                    <span id="vattotal">0.00</span> 
                                                    <?php
                                                } ?>
                                                
                                            </div>
                                            <div class="col-md-8 col-sm-12 col-8 mt-10">
                                                <strong>Total</strong>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-4 mt-10">
                                                
                                                <?php
                                                if(@$_REQUEST['id']!='')
                                                {
                                                    ?>
                                                    <input type="hidden" name="finaltotal_val" id="finaltotal_val" value="<?php echo $total; ?>">
                                                    <strong><span id="finaltotal"><?php echo $total; ?></span> </strong>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="hidden" name="finaltotal_val" id="finaltotal_val" value="">
                                                    <strong><span id="finaltotal">0.00</span> </strong>
                                                    <?php
                                                } ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include("footer.php"); ?>

<script type="text/javascript">
//var ci=1;
//var tax =  $('#tax0').val();

$('.add-comp').on("click", function(e){
    var lastid = $('.table').closest('table').find('tr:last td:first').next().text();
    //alert(lastid);
    var ci=lastid++;

    var tax = $('#tax0').val();
    var rateval = $('#ratearea').val();
    var dspval='';
    if(rateval ==1){
        dspval ='block';
    }
    if(rateval ==0){
        dspval ='none';
    }

    var no=parseInt(ci)+parseInt(1);
    $('#total_rows').val(parseInt($('#total_rows').val())+parseInt(1));
    var new_input = '<tr class="tr_'+ci+'" id="'+ci+'">'+
    '<input type="text" name="trdata[]" value="0" class="trdata_'+ci+'"><td><input type="checkbox" name="chk_'+ci+'" id="chk_'+ci+'" class="default checkBoxClass2 sub_chk" data-id="'+ci+'"></td>'+'<td>'+no+'</td><td><input type="text" name="type_of_product['+ci+']" id="type_of_product'+ci+'" class="form-control" value=""></td><td><input type="text" name="ac_type['+ci+']" id="ac_type'+ci+'" class="form-control" value=""></td><td><input type="text" name="quantity['+ci+']" id="quantity'+ci+'" class="form-control" value="" onkeypress="return isNumberKey(event);" onblur="get_calulation('+ci+')"></td><td><input type="text" name="price['+ci+']" id="price'+ci+'" class="form-control" value="" onkeypress="return isNumberKey(event);" onblur="get_calulation('+ci+')"></td><td class="taxval taxHideShow" style="display:'+dspval+';">'+tax+'</td><td><input type="text" name="amount['+ci+']" id="amount'+ci+'" class="form-control" value="" onkeypress="return isNumberKey(event);" readonly="readonly"></td><td><i class="fas fa-trash-alt newicon" id="'+ci+'" onclick="hidetr(this.id);"></i><input type="hidden" id="trremove_'+ci+'" value="1" name="trremove_'+ci+'" /></td></tr>';
    $('#compare_div').append(new_input);
    ci++;
});

function allCheck()
{
    if($('#master').is(':checked',true))  
    {
        $(".sub_chk").prop('checked', true);  
    } else {  
        $(".sub_chk").prop('checked',false);  
    }  
}
function delete_all()
{
    var allVals = [];  
    $(".sub_chk:checked").each(function() 
    {  
        allVals.push($(this).attr('data-id'));
        
        var chng =0;
        $('.tr_'+allVals).hide();
        $('#trremove_'+allVals).val(chng);

        $("#tableData").load(location.href + " #tableData");
       
    });  

    if(allVals.length <=0)  
    {  
        alert("Please select row."); 
    }  
}
function taxMenu()
{
    $('.showTax').show();
}

function hidetr(val)
{
    var chng =0;
    $('.tr_'+val).hide();
    $('#trremove_'+val).val(chng);
    $('#quantity'+val).val(0);
    $('#price'+val).val(0);
    $('#discount'+val).val(0);
    get_calulation(val);
}

function get_calulation(fid)
{
    //alert($('#trremove_'+fid).val());
    var qnty=$('#quantity'+fid).val();
    var price=$('#price'+fid).val();
    var disc=$('#discount'+fid).val();
    /*var tax=$('#tax'+fid).val();*/

    var tax =  $('#tax0').val();
   
    if(qnty>0 && qnty!='' && price!='' && price>0 && $('#trremove_'+fid).val()!=0)
    {
        //alert("in");
        var sub_price=parseFloat(qnty)*parseFloat(price);
        var disc_tot=0;
        if(disc!='' && disc>0)
        {
            disc_tot= parseFloat(parseFloat(sub_price)*parseFloat(disc))/parseInt(100);
            disc_tot=disc_tot.toFixed(2);
        }
        var sub_total=parseFloat(sub_price)-parseFloat(disc_tot);
        var tax_amt=0; /*tax=15;*/
        if(tax>0)
        {
            
            tax_amt=(parseFloat(sub_total)*parseInt(tax))/parseInt(100);
            tax_amt=tax_amt.toFixed(2);
        }
        //alert(tax_amt);
        //alert(sub_price+'--'+disc_tot+'--'+tax_amt);
        //var amt=parseFloat(sub_price)-parseFloat(disc_tot)+parseFloat(tax_amt);
        var amt=parseFloat(sub_total)+parseFloat(tax_amt);
        amt=amt.toFixed(2);
        $('#amount'+fid).val(amt);
        find_sub_total();
    }
    find_sub_total();
}

function find_sub_total()
{
    var fid=$('#total_rows').val();
    var sub_tot=0; var total_package=0; var main_total=0;
    var tot_disc_per=0;
    for(var i=0; i<fid; i++)
    {
        if($('#trremove_'+i).val()!=0)
        {
            var amt=$('#amount'+i).val();
            var qnty=$('#quantity'+i).val();
            var price=$('#price'+i).val();
            var discount=$('#discount'+i).val();
            if(amt!='' && amt>0 && qnty!='' && qnty>0)
            {
                main_total=parseFloat(main_total)+parseFloat(parseFloat(qnty)*parseFloat(price));
                sub_tot=parseFloat(amt)+parseFloat(sub_tot);
                total_package=parseInt(total_package)+parseInt(qnty);
                if(discount!="" && discount>0)
                {
                    tot_disc_per=parseFloat(tot_disc_per)+parseFloat(discount);
                }
            }
        }
        else
        {
            var amt=$('#amount'+i).val();
            var qnty=$('#quantity'+i).val();
            var price=$('#price'+i).val();
            if(amt!='' && amt>0 && qnty!='' && qnty>0)
            {
                main_total=parseFloat(main_total)-parseFloat(parseFloat(qnty)*parseFloat(price));
                sub_tot=parseFloat(amt)-parseFloat(sub_tot);
                total_package=parseInt(total_package)-parseInt(qnty);
            }
        }
    }
    console.log(main_total);
    $('#no_of_package').val(total_package);
    //$('#subtotal').text(sub_tot.toFixed(2));
    $('#total_val').text(main_total.toFixed(2));
    $('#spantotal').text(main_total.toFixed(2));
    
    //var tot_discount=parseFloat(main_total)-parseFloat(sub_tot);
    var sub_tot=""; var tot_discount =0;
    if(tot_disc_per!="" && tot_disc_per>0)
    {
        tot_discount =parseFloat(main_total)*parseFloat(tot_disc_per)/parseFloat(100);
        sub_tot=parseFloat(main_total)-parseFloat(tot_discount);
    }
    else
    {
        tot_discount=0;
        sub_tot=parseFloat(main_total)-parseFloat(tot_discount);
    }
    $('#subtotal').text(sub_tot.toFixed(2));
    
    $('#discount_val').text(tot_discount.toFixed(2));
    $('#spandiscount').text(tot_discount.toFixed(2));
    
    $('#total_val').text(main_total.toFixed(2));
    $('#spantotal').text(main_total.toFixed(2));

    //alert($('#vatper_val').val());
    
    /*if($('#vatper').text()>0 && $('#vatper').text()!='')*/
    if($('#vatper_val').val()>=0 && $('#vatper_val').val()!='')
    {
        var subtot=$('#subtotal').text();
        $('#subtotal_val').val(subtot);
        
        /*var vat=$('#vatper').text();*/
        var vat=$('#vatper_val').val();

        $('#vatper_val').val(vat);

        var tot=parseFloat(parseFloat(subtot)*parseFloat(vat))/parseFloat(100);
        /*alert(tot);
        alert(tot.toFixed(2));*/
        $('#vattotal').text(tot.toFixed(2));
        $('#vattotal_val').val(tot.toFixed(2));

        var tot=parseFloat(tot)+parseFloat(subtot);
        $('#finaltotal').text(tot.toFixed(2));
        $('#finaltotal_val').val(tot.toFixed(2));

        
        $('#total_amount').text(tot.toFixed(2));
        
    }
    else
    {
        var subtot=$('#subtotal').text();
        $('#subtotal_val').val(subtot);

        $('#finaltotal').text(subtot);
        $('#finaltotal_val').val(subtot);
        $('#total_amount').text(subtot);
    }
}

$(document).ready(function(){ 

    $(".chb").change(function()
    {
        $(".chb").prop('checked',false);
        $(this).prop('checked',true);
    });

    $('.taxchk:checkbox').change(function(){
        var txval = $(this).val();
        if(txval == 'tax-exclusive')
        {
            $('#ratearea').val(0);
            //$('.taxHideShow').hide();
            $('.taxHideShow').css('display', 'none');
            
        }
        if(txval == 'tax-inclusive')
        {
            $('#ratearea').val(1);
            //$('.taxHideShow').show();
            $('.taxHideShow').css('display', 'block');
            $('.rateHideShow').css('display', 'none');
        }
    });

    /*** form validation ****/
    $("#submit").click(function()
    { 
        
        if($("#vendor_name").val()=="")
        {
            $("#vendor_name").attr("placeholder", "Please Select Vendor Name.");
            $("#vendor_name").addClass("error_textbox");
            $("#vendor_name").focus();
            return false;
        }
        /*if($("#bill").val()=="")
        {
            $("#bill").attr("placeholder", "Please Enter Bill.");
            $("#bill").addClass("error_textbox");
            $("#bill").focus();
            return false;
        }*/
        if($("#bill_date").val()=="")
        {
            $("#bill_date").attr("placeholder", "Please Enter Bill Date.");
            $("#bill_date").addClass("error_textbox");
            $("#bill_date").focus();
            return false;
        }
        if($("#bill_due_date").val()=="")
        {
            $("#bill_due_date").attr("placeholder", "Please Enter Bill Due Date.");
            $("#bill_due_date").addClass("error_textbox");
            $("#bill_due_date").focus();
            return false;
        }

    });
    /**** form validation ****/
});

function get_tax_val(sel)
{
    $('.taxval').html(sel.value);
    $('#vatper_val').val(sel.value);

    if(sel.value ==0)
    {
        $('#vatper').html('Zero Rate[0%]');
        $('.rateHideShow').css('display', 'block');
    }
    if(sel.value ==15)
    {
        $('#vatper').html('Standard Rate[15%]');
        $('.rateHideShow').css('display', 'block');
    }
    if(sel.value =='Exempt')
    {
        $('.rateHideShow').css('display', 'none');
    }
    
    var totalrow = $('#total_rows').val();

    for(var i=0; i<totalrow; i++)
    {
        get_calulation(i);
    }
    
}

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

        if(@$_FILES['receipt']['name']!="")
        {
            $row_select = fetch_query("logo","myadmin",array("id="=>"1"));
            $unlink_image = $row_select['logo'];
            @unlink("bill/".$unlink_image);
    
            if (($_FILES["receipt"]["type"] == "image/jpeg") || ($_FILES["receipt"]["type"] == "image/jpg") || ($_FILES["receipt"]["type"] == "image/pjpeg") || ($_FILES["receipt"]["type"] == "image/x-png") || ($_FILES["receipt"]["type"] == "image/png"))
            {
                $uploadedfile = $_FILES["receipt"]["tmp_name"];
                $image11= rand().$_FILES['receipt']['name'];
                $image1 = str_replace(' ', '_', $image11);
                move_uploaded_file($uploadedfile, "bill/".$image1);
            }
            $image=$image1;
        }

        $arr=array(
            "vendor_name"=>ucfirst($_POST['vendor_name']),
            "bill"=>$_POST['bill'],
            "bill_date"=>$_POST['bill_date'],
            "payment_terms"=>$_POST['payment_terms'],
            "bill_due_date"=>$_POST['bill_due_date'],
            "payment_method"=>$_POST['payment_method'],
            "receipt"=>$image,
            "notes"=>$_POST['notes'],
            "subtotal"=>$_POST['total_val'],
            "discount"=>$_POST['discount_val'],
            "rate"=>$_POST['vattotal_val'],
            "total"=>$_POST['finaltotal_val'],
            "reference"=>$_POST['reference'],
            "item_rate"=>$_POST['chkbx'],
            "recorddate"=>$dt
        ); 
        $insert = update_query($arr,"id=".$id,"bill");

        if($insert)
        {
            /*$tota_row=$_POST['total_rows'];
            $tax = $_POST['vatper_val'];
            for($i=0;$i<$tota_row;$i++)
            {
                if($_POST['trremove_'.$i] == 1)
                {
                    $arr_=array("name"=>$_POST['type_of_product'][$i],"account"=>$_POST['ac_type'][$i],"quantity"=>$_POST['quantity'][$i],"price"=>$_POST['price'][$i],"tax"=>$tax,"amount"=>$_POST['amount'][$i]);

                    $insert = update_query($arr,"bid=".$id,"bill_detail");
                    
                }
            }*/
        
            $_SESSION['suc']='Bill Detail Update Successfully...';
        }
        else
        {
          $_SESSION['unsuc']='Bill Detail Not Update... Try Again...';
        }
        header("location:".$site_url."bill-listing");
    }
    else
    { 
        $dt=date('Y-m-d H:i:s');

        if(@$_FILES['receipt']['name']!="")
        {
            $row_select = fetch_query("logo","myadmin",array("id="=>"1"));
            $unlink_image = $row_select['logo'];
            @unlink("bill/".$unlink_image);
    
            if (($_FILES["receipt"]["type"] == "image/jpeg") || ($_FILES["receipt"]["type"] == "image/jpg") || ($_FILES["receipt"]["type"] == "image/pjpeg") || ($_FILES["receipt"]["type"] == "image/x-png") || ($_FILES["receipt"]["type"] == "image/png"))
            {
                $uploadedfile = $_FILES["receipt"]["tmp_name"];
                $image11= rand().$_FILES['receipt']['name'];
                $image1 = str_replace(' ', '_', $image11);
                move_uploaded_file($uploadedfile, "bill/".$image1);
            }
            $image=$image1;
        }

        $data = fetch_query("*","bill",""," id desc limit 1");
       // $bill=$_POST['bill'];
        $row=select_query("*","bill", array("bill="=>$data['bill']), "id desc");
        if($row->num_rows > 0)
        { 
            $rows = fetch_query("*","bill",""," id desc limit 1");
            $bill=sprintf("%05d", $rows['bill']+1);
        }

        $arr=array(
            "vendor_name"=>ucfirst($_POST['vendor_name']),
            "bill"=>$_POST['bill'],
            "bill_date"=>$_POST['bill_date'],
            "payment_terms"=>$_POST['payment_terms'],
            "bill_due_date"=>$_POST['bill_due_date'],
            "payment_method"=>$_POST['payment_method'],
            "receipt"=>$image,
            "notes"=>$_POST['notes'],
            "subtotal"=>$_POST['subtotal_val'],
            "discount"=>$_POST['discount_val'],
            "rate"=>$_POST['vattotal_val'],
            "total"=>$_POST['finaltotal_val'],
            "reference"=>$_POST['reference'],
            "item_rate"=>$_POST['chkbx'],
            "recorddate"=>$dt
        ); 

        $insert = insert_query($arr, "bill");
      
        $last_id=$dlink->insert_id;
        if($insert)
        {

            $tota_row=$_POST['total_rows'];
            $tax = $_POST['vatper_val'];
            for($i=0;$i<$tota_row;$i++)
            {
                if($_POST['trremove_'.$i] == 1)
                {
                    $arr_=array("bid"=>$last_id,"name"=>$_POST['type_of_product'][$i],"account"=>$_POST['ac_type'][$i],"quantity"=>$_POST['quantity'][$i],"price"=>$_POST['price'][$i],"tax"=>$tax,"amount"=>$_POST['amount'][$i]);
                    $insert = insert_query($arr_, "bill_detail");
                }
            }
        
            $_SESSION['suc']='Bill Detail Added Successfully...';
        }
        else
        {
          $_SESSION['unsuc']='Bill Detail Not Added... Try Again...';
        }
        header("location:".$site_url."bill-listing");
    }
}
?>