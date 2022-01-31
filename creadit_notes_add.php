<?php include("header.php"); 

if(@$_REQUEST['id']!='')
{
    $id = $_REQUEST['id'];
    $rows = fetch_query("*","credit_note",array("id="=>$id));
    
    $customer_name = $rows['customer_name'];
    $branch = $rows['branch'];
    $credit_note = $rows['credit_note'];
    $date = $rows['date'];
    $sales_person = $rows['sales_person'];
    $invoice = $rows['invoice'];
    $reference = $rows['reference'];
    $item_rate = $rows['item_rate'];
    $subtotal = $rows['subtotal'];
    $discount = $rows['discount'];
    $rate = $rows['rate'];
    $total = $rows['total'];
    
}
else
{
    $customer_name = '';
    $branch='';
    //$credit_note='';
    $date='';
    $sales_person='';
    $invoice='';
    $reference='';
    $item_rate='';
    $subtotal='';
    $rate='';
    $total='';
    $discount='';
    

    $credit_note="";
    $rows = fetch_query("*","credit_note",""," id desc limit 1");
    if($rows['credit_note']!='')
        $credit_note=sprintf("%05d", $rows['credit_note']+1);
    else
        $credit_note=100001;
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
                        <h3> Create New Credit Note </h3>
                    </div>
                    <form method="post" action="" name="bg" id="bg" enctype="multipart/form-data" autocomplete="off" >

                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <h5 class="rbcl" style="color: #D42B2B">Customer Name<span style="color: #D42B2B">*</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="controls">
                                                <select name="customer_name" id="customer_name" class="form-control">
                                                    <option value=""></option>
                                                    <?php 
                                                    $selcon=mysqli_query($dlink,"SELECT * FROM customers");
                                                        while ($bcon=mysqli_fetch_array($selcon)) {
                                                        ?>
                                                    <option <?php if ($bcon['name'] == $customer_name) {?> selected="selected" <?php }?> value="<?php echo $bcon['name']; ?>"><?php echo $bcon['name']; ?></option>
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
                                                <h5 class="rbcl" style="margin-bottom: 0.5rem;">Branch</h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="controls"> 
                                                <select name="branch" id="branch" class="form-control">
                                                    <option value=""></option>
                                                    <?php 
                                                    $selcon=mysqli_query($dlink,"SELECT * FROM branches");
                                                        while ($bcon=mysqli_fetch_array($selcon)) {
                                                        ?>
                                                    <option <?php if ($bcon['bname'] == $branch) {?> selected="selected" <?php }?> value="<?php echo $bcon['bname']; ?>"><?php echo $bcon['bname']; ?></option>
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
                                                <h5 class="rbcl" style="color: #D42B2B">Credit Note#<span style="color: #D42B2B">*</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <!-- id="pname_div" -->
                                            <div class="controls">
                                                <input type="text" name="credit_note" id="credit_note" class="form-control" value="<?php echo $credit_note; ?>" style="display:inline-block" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <h5 class="rbcl" style="color: #D42B2B">Date<span style="color: #D42B2B">*</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="controls">
                                               <input type="date" name="date" id="date" class="form-control" value="<?php echo $date; ?>" style="display:inline-block">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-sm-12">
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
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <h5>Sales Person</h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="controls">
                                                <select name="sales_person" id="sales_person" class="form-control">
                                                    <option value=""></option>
                                                    <?php 
                                                    $selcon=mysqli_query($dlink,"SELECT * FROM department");
                                                        while ($bcon=mysqli_fetch_array($selcon)) {
                                                        ?>
                                                    <option <?php if ($bcon['fname'] == $sales_person) {?> selected="selected" <?php }?> value="<?php echo $bcon['fname']; ?>"><?php echo $bcon['fname']; ?></option>
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
                                                <h5 class="rbcl" style="color: #D42B2B">Invoice#<span style="color: #D42B2B">*</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <!-- id="pname_div" -->
                                            <div class="controls">
                                                <select name="invoice" id="invoice" class="form-control">
                                                    <option value=""></option>
                                                    <?php 
                                                    $selcon=mysqli_query($dlink,"SELECT * FROM shipment");
                                                        while ($bcon=mysqli_fetch_array($selcon)) {
                                                        ?>
                                                    <option <?php if ($bcon['invoice_number'] == $invoice) {?> selected="selected" <?php }?> value="<?php echo $bcon['invoice_number']; ?>"><?php echo $bcon['invoice_number']; ?></option>
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
                                                <h5>Reference#</h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="controls">
                                                <input type="text" name="reference" id="reference" class="form-control" value="<?php echo $reference; ?>" style="display:inline-block">
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
                                        <!-- <th>
                                            <input type="checkbox" id="master" onclick="allCheck();">
                                        </th> -->
                                        </th>
                                        <th>SI.No.</th>
                                        <th>Item/Product Detail</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th class="taxHideShow dropdown">Tax 15% 
                                            <!-- <select name="tax[0]" id="tax0" class="form-control" onchange="get_tax_val(this);">
                                                <option value="15">15%</option>
                                            </select> -->
                                            <input type="hidden" name="tax[0]" id="tax0" class="form-control" value="15">
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
                                    <input type="hidden" name="taxval" id="taxval" value="15">
                                    <?php
                                    if(@$_REQUEST['id']!='')
                                    {
                                        $row=select_query("*","credit_note_detail", array("cid="=>$id), "id asc");
                                        if($row->num_rows)
                                        { 
                                            $i=1; $j=0;
                                            while($b=$row->fetch_array())
                                            { ?>
                                                <input type="hidden" name="detail_id[<?php echo $i;?>]" id="detail_id" value="<?php echo $b['id']; ?>">
                                                <tr class="tr_0" id="0">
                                                    <!-- <td>
                                                        <input type="checkbox" name="chk_0" id="chk_0" class="default checkBoxClass2 sub_chk" data-id="{{$b->id}}">
                                                    </td> -->
                                                    <td><?php echo $i; ?></td>
                                                    <td>
                                                        <input type="text" name="type_of_product_0[<?php echo $i;?>]" id="type_of_product[0]" class="form-control" value="<?php echo $b['name']; ?>">
                                                    </td>
                                                    <!-- <td>
                                                        <input type="text" name="ac_type[0]" id="ac_type0" class="form-control" value="<?php echo $b['account']; ?>">
                                                    </td> -->
                                                    <td>
                                                        <input type="text" name="quantity_0[<?php echo $i;?>]" id="quantity<?php echo $j; ?>" class="form-control" value="<?php echo $b['quantity']; ?>" onkeypress="return isNumberKey(event);" onblur="get_calulation(<?php echo $j; ?>)">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="price_0[<?php echo $i;?>]" id="price<?php echo $j; ?>" class="form-control" value="<?php echo $b['price']; ?>" onkeypress="return isNumberKey(event);" onblur="get_calulation(<?php echo $j; ?>)">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="discount_0[<?php echo $i;?>]" id="discount<?php echo $j; ?>" class="form-control" value="<?php echo $b['discount']; ?>" onkeypress="return isNumberKey(event);" onblur="get_calulation(<?php echo $j; ?>)">
                                                    </td>
                                                    
                                                    <td class="taxval taxHideShow">
                                                        <?php echo $b['tax']; ?>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="amount_0[<?php echo $i;?>]" id="amount<?php echo $j; ?>" class="form-control" value="<?php echo $b['amount']; ?>" onkeypress="return isNumberKey(event);" readonly="readonly">
                                                    </td>
                                                    <td>
                                                        <i class="fas fa-trash-alt newicon" id="0" onclick="hidetr(this.id);"></i>
                                                        <input type="hidden" id="trremove_1" value="1" name="trremove_<?php echo $i;?>" />
                                                       
                                                    </td>
                                               </tr>
                                            <?php 
                                            $i++; $j++;
                                            }
                                        }
                                        ?>
                                        <input type="hidden" id="update_rows" value="<?php echo $row->num_rows; ?>" name="update_rows" />
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        
                                        <tr class="tr_0" id="0">
                                            <!-- <td>
                                                <input type="checkbox" name="chk_0" id="chk_0" class="default checkBoxClass2 sub_chk" data-id="0">
                                            </td> -->
                                            <td>1</td>
                                            <td>
                                                <input type="text" name="type_of_product[0]" id="type_of_product0" class="form-control" value="">
                                            </td>
                                            
                                            <td>
                                                <input type="text" name="quantity[0]" id="quantity0" class="form-control" value="" onblur="get_calulation(0)" onkeypress="return isNumberKey(event);">
                                            </td>
                                            <td>
                                                <input type="text" name="price[0]" id="price0" class="form-control" value="" onkeypress="return isNumberKey(event);" onblur="get_calulation(0)">
                                            </td>
                                            <td>
                                                <input type="text" name="discount[0]" id="discount0" class="form-control" value="" onkeypress="return isNumberKey(event);" onblur="get_calulation(0)">
                                            </td>
                                            
                                            <td class="taxval taxHideShow">
                                                15
                                            </td>
                                            <td>
                                                <input type="text" name="amount[0]" id="amount0" class="form-control" value="" onkeypress="return isNumberKey(event);" readonly="readonly">
                                            </td>
                                            <td>
                                                <i class="fas fa-trash-alt newicon" id="0" onclick="hidetr(this.id);"></i>
                                                <input type="hidden" id="trremove_0" value="1" name="trremove_0" />
                                                
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
                                
                                    <input type="hidden" id="total_rows" value="1" name="total_rows" />

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
                                
                                  <div class="col-md-6 col-sm-12 col-lg-6 x-11" style="padding-right:5px;padding-left:10px">
                            <div class="grybox" style="margin: 20px 10px;">
                                <div class="row">
                                    <div class="col-md-8 col-sm-12 col-8 mt-10">
                                        Total
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
                                    <div class="col-md-4 col-sm-12 col-4 mt-10  " style="display: none;">
                                        
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
                                    <div class="col-md-8 col-sm-12 col-8 mt-10  taxHideShow rateHideShow" style="display: block;">
                                        
                                        <?php
                                        if(@$_REQUEST['id']!='')
                                        {
                                            ?>
                                            <input type="hidden" name="vatper_val" id="vatper_val" value="<?php echo $vatper_val; ?>">
                                            VAT RATE(<span id="vatper">15</span>%)
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <input type="hidden" name="vatper_val" id="vatper_val" value="15">
                                            VAT RATE(<span id="vatper">15</span>%)
                                            <?php
                                        } ?>
                                        
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-4 mt-10 taxHideShow rateHideShow" style="display: block;">
                                        
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
var ci=1;
//var tax =  $('#tax0').val();

$('.add-comp').on("click", function(e){
    var lastid = $('.table').closest('table').find('tr:last td:first').text();
    //alert(lastid);
    var ci1=lastid++;

    var tax = $('#tax0').val();
    var rateval = $('#ratearea').val();

    var dspval='';
    if(rateval ==1){
        dspval ='block';
    }
    if(rateval ==0){
        dspval ='none';
    }

    // <td><input type="checkbox" name="chk_'+ci+'" id="chk_'+ci+'" class="default checkBoxClass2 sub_chk" data-id="'+ci+'"></td>
    var no=parseInt(ci1)+parseInt(1);
    $('#total_rows').val(parseInt($('#total_rows').val())+parseInt(1));
    var new_input = '<tr class="tr_'+ci+'" id="'+ci+'">'+
    '<input type="text" name="trdata[]" value="0" class="trdata_'+ci+'">'+'<td>'+no+'</td><td><input type="text" name="type_of_product['+ci+']" id="type_of_product'+ci+'" class="form-control" value=""></td><td><input type="text" name="quantity['+ci+']" id="quantity'+ci+'" class="form-control" value="" onkeypress="return isNumberKey(event);" onblur="get_calulation('+ci+')"></td><td><input type="text" name="price['+ci+']" id="price'+ci+'" class="form-control" value="" onkeypress="return isNumberKey(event);" onblur="get_calulation('+ci+')"></td><td><input type="text" name="discount['+ci+']" id="discount'+ci+'" class="form-control" value="" onkeypress="return isNumberKey(event);" onblur="get_calulation('+ci+')"></td><td class="taxval taxHideShow" style="display:'+dspval+';">'+tax+'</td><td><input type="text" name="amount['+ci+']" id="amount'+ci+'" class="form-control" value="" onkeypress="return isNumberKey(event);" readonly="readonly"></td><td><i class="fas fa-trash-alt newicon" id="'+ci+'" onclick="hidetr(this.id);"></i><input type="hidden" id="trremove_'+ci+'" value="1" name="trremove_'+ci+'" /></td></tr>';
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

/*function find_sub_total()
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
    
    $('#no_of_package').val(total_package);
   
    $('#total_val').val(main_total.toFixed(2));
    $('#spantotal').val(main_total.toFixed(2));
    
   
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
    
    $('#discount_val').val(tot_discount.toFixed(2));
    $('#spandiscount').val(tot_discount.toFixed(2));

    $('#discount_val').text(tot_discount.toFixed(2));
    $('#spandiscount').text(tot_discount.toFixed(2));
    
    $('#total_val').val(main_total.toFixed(2));
    $('#spantotal').val(main_total.toFixed(2));

    $('#total_val').text(main_total.toFixed(2));
    $('#spantotal').text(main_total.toFixed(2));

    var vat=$('#taxval').val();

    
    if(vat!='')
    {
        var subtot=$('#subtotal').text();

        $('#subtotal_val').val(subtot);
        
        
        $('#vatper_val').val(vat);

        var tot=parseFloat(parseFloat(subtot)*parseFloat(vat))/parseFloat(100);
        $('#vattotal').text(tot.toFixed(2));
        $('#vattotal_val').val(tot.toFixed(2));

        var tot=parseFloat(tot)+parseFloat(subtot);
        $('#finaltotal').text(tot.toFixed(2));
        $('#finaltotal_val').val(tot.toFixed(2));

        
        $('#total_amount').text(tot.toFixed(2));
        $('#total_fc').val(tot.toFixed(2));
    }
    else
    {
        var subtot=$('#subtotal').text();
        $('#subtotal_val').val(subtot);

        $('#finaltotal').text(subtot);
        $('#finaltotal_val').val(subtot);
        $('#total_amount').text(subtot);
        $('#total_fc').val(subtot);
    }
}

function get_calulation(fid)
{
    var qnty=$('#quantity'+fid).val();
    var price=$('#price'+fid).val();
    var disc=$('#discount'+fid).val();
    var tax=$('#taxval').val();
    
    if(qnty>0 && qnty!='' && price!='' && price>0 && $('#trremove_'+fid).val()!=0)
    {
        var sub_price=parseFloat(qnty)*parseFloat(price);
        var disc_tot=0;
        if(disc!='' && disc>0)
        {

            disc_tot= parseFloat(parseFloat(sub_price)*parseFloat(disc))/parseInt(100);
            disc_tot=disc_tot.toFixed(2);
        }
        var sub_total=parseFloat(sub_price)-parseFloat(disc_tot);
        var tax_amt=0; 
            tax_amt=(parseFloat(sub_total)*parseInt(tax))/parseInt(100);
            tax_amt=tax_amt.toFixed(2);
       
        var amt=parseFloat(sub_total)+parseFloat(tax_amt);
        amt=amt.toFixed(2);
        $('#amount'+fid).val(amt);
        find_sub_total();
    }
}*/
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

    $('#total_val').val(main_total.toFixed(2));
    $('#spantotal').val(main_total.toFixed(2))
    
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

    $('#discount_val').val(tot_discount.toFixed(2));
    $('#spandiscount').val(tot_discount.toFixed(2));
    
    $('#total_val').text(main_total.toFixed(2));
    $('#spantotal').text(main_total.toFixed(2));

    $('#total_val').val(main_total.toFixed(2));
    $('#spantotal').val(main_total.toFixed(2))
    
    var vat=$('#taxval').val();    
    if(vat!='')
    {
        var subtot=$('#subtotal').text();
        $('#subtotal_val').val(subtot);
        
        //var vat=$('#vatper').text();
        $('#vatper_val').val(vat);

        var tot=parseFloat(parseFloat(subtot)*parseFloat(vat))/parseFloat(100);
        $('#vattotal').text(tot.toFixed(2));
        $('#vattotal_val').val(tot.toFixed(2));

        var tot=parseFloat(tot)+parseFloat(subtot);
        $('#finaltotal').text(tot.toFixed(2));
        $('#finaltotal_val').val(tot.toFixed(2));

        
        $('#total_amount').text(tot.toFixed(2));
        $('#total_fc').val(tot.toFixed(2));
    }
    else
    {
        var subtot=$('#subtotal').text();
        $('#subtotal_val').val(subtot);

        $('#finaltotal').text(subtot);
        $('#finaltotal_val').val(subtot);
        $('#total_amount').text(subtot);
        $('#total_fc').val(subtot);
    }
}
function get_calulation(fid)
{
    var qnty=$('#quantity'+fid).val();
    var price=$('#price'+fid).val();
    var disc=$('#discount'+fid).val();
    var tax=$('#taxval').val();
    
    if(qnty>0 && qnty!='' && price!='' && price>0 && $('#trremove_'+fid).val()!=0)
    {
        var sub_price=parseFloat(qnty)*parseFloat(price);
        var disc_tot=0;
        if(disc!='' && disc>0)
        {
            disc_tot= parseFloat(parseFloat(sub_price)*parseFloat(disc))/parseInt(100);
            disc_tot=disc_tot.toFixed(2);
        }
        var sub_total=parseFloat(sub_price)-parseFloat(disc_tot);
        var tax_amt=0; /*tax=15;*/
        //if(tax>0)
        //{
            
            tax_amt=(parseFloat(sub_total)*parseInt(tax))/parseInt(100);
            tax_amt=tax_amt.toFixed(2);
        //}
        //alert(tax_amt);
        //alert(sub_price+'--'+disc_tot+'--'+tax_amt);
        //var amt=parseFloat(sub_price)-parseFloat(disc_tot)+parseFloat(tax_amt);
        var amt=parseFloat(sub_total)+parseFloat(tax_amt);
        amt=amt.toFixed(2);
        $('#amount'+fid).val(amt);
        find_sub_total();
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
            $('#taxval').val(0);
            
            $('.taxHideShow').css('display', 'none');
            $('.rateHideShow').css('display', 'none');
            
        }
        if(txval == 'tax-inclusive')
        {
            $('#ratearea').val(1);
            //$('.taxHideShow').show();
            $('#taxval').val(15);
            $('.taxHideShow').css('display', 'block');
            $('.rateHideShow').css('display', 'block');
        }
        var totalrow = $('#total_rows').val();

        for(var i=0; i<totalrow; i++)
        {
            get_calulation(i);
        }
    });

    /*** form validation ****/
    $("#submit").click(function()
    { 
        
        if($("#customer_name").val()=="")
        {
            $("#customer_name").attr("placeholder", "Please Select Customer Name.");
            $("#customer_name").addClass("error_textbox");
            $("#customer_name").focus();
            return false;
        }
        if($("#date").val()=="")
        {
            $("#date").attr("placeholder", "Please Enter Date.");
            $("#date").addClass("error_textbox");
            $("#date").focus();
            return false;
        }
        if($("#invoice").val()=="")
        {
            $("#invoice").attr("placeholder", "Please Select Invoice");
            $("#invoice").addClass("error_textbox");
            $("#invoice").focus();
            return false;
        }

    });
    /**** form validation ****/
});

function get_tax_val(sel)
{
    $('.taxval').html(15);
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

</script>

<?php 
if(isset($_POST['submit'])!='')
{
    if(@$_GET['id']!='')
    {
        $dt=date('Y-m-d H:i:s');

        $arr=array(
            "customer_name"=>ucfirst($_POST['customer_name']),
            "branch"=>$_POST['branch'],
            "credit_note"=>$credit_note,
            "date"=>$_POST['date'],
            "sales_person"=>$_POST['sales_person'],
            "invoice"=>$_POST['invoice'],
            "reference"=>$_POST['reference'],
            "item_rate"=>$_POST['chkbx'],

            "subtotal"=>$_POST['total_val'],
            "discount"=>$_POST['discount_val'],
            "rate"=>$_POST['vattotal_val'],
            "total"=>$_POST['finaltotal_val'],
            "recorddate"=>$dt
        ); 
        $insert = update_query($arr,"id=".$id,"credit_note");

        if($insert)
        {
          
            $total_update_row=$_POST['update_rows']; 
            $totalinsertrow=$_POST['total_rows']; 
            $total_insert_row = $totalinsertrow-1;
            $total_rvcr_row = $total_update_row + $total_insert_row; 

            $tax = $_POST['taxval'];
           
            for($i=1;$i<=$total_update_row;$i++)
            {
                if($_POST['trremove_'.$i] == 1)
                {
                    $did=$_POST['detail_id'][$i];
                    $arr_=array(
                        "cid"=>$id,
                        "name"=>$_POST['type_of_product_0'][$i],
                        "quantity"=>$_POST['quantity_0'][$i],
                        "price"=>$_POST['price_0'][$i],
                        "discount"=>$_POST['discount_0'][$i],
                        "tax"=>$tax,
                        "amount"=>$_POST['amount_0'][$i]);
                    $insert = update_query($arr_,"id=".$did,"credit_note_detail");
                }
            }
            
            if($totalinsertrow != 1)
            {
                for ($j=1; $j<=$total_insert_row; $j++) 
                { 
                    if($_POST['trremove_'.$j] == 1)
                    {
                        $arr_=array(
                            "cid"=>$id,
                            "name"=>$_POST['type_of_product'][$j],
                            "quantity"=>$_POST['quantity'][$j],
                            "price"=>$_POST['price'][$j],
                            "discount"=>$_POST['discount'][$j],
                            "tax"=>$tax,
                            "amount"=>$_POST['amount'][$j]);
                        $insert = insert_query($arr_, "credit_note_detail");
                    }
                }
            }
        
            $_SESSION['suc']='Credit Note Update Successfully...';
        }
        else
        {
          $_SESSION['unsuc']='Credit Note Not Update... Try Again...';
        }
        header("location:".$site_url."creadit-notes-listing");
    }
    else
    { 
        $dt=date('Y-m-d H:i:s');

        $data = fetch_query("*","credit_note",""," id desc limit 1");
       // $bill=$_POST['bill'];
        $row=select_query("*","credit_note", array("credit_note="=>$data['credit_note']), "id desc");
        if($row->num_rows > 0)
        { 
            $rows = fetch_query("*","credit_note",""," id desc limit 1");
            $credit_note=sprintf("%05d", $rows['credit_note']+1);
        }

        $arr=array(
            "customer_name"=>ucfirst($_POST['customer_name']),
            "branch"=>$_POST['branch'],
            "credit_note"=>$credit_note,
            "date"=>$_POST['date'],
            "sales_person"=>$_POST['sales_person'],
            "invoice"=>$_POST['invoice'],
            "reference"=>$_POST['reference'],
            "item_rate"=>$_POST['chkbx'],

            "subtotal"=>$_POST['total_val'],
            "discount"=>$_POST['discount_val'],
            "rate"=>$_POST['vattotal_val'],
            "total"=>$_POST['finaltotal_val'],

            "recorddate"=>$dt
        ); 

        $insert = insert_query($arr, "credit_note");
      
        $last_id=$dlink->insert_id;
        if($insert)
        {
            $tota_row=$_POST['total_rows'];
            $tax = $_POST['taxval'];
            for($i=0;$i<$tota_row;$i++)
            {
                if($_POST['trremove_'.$i] == 1)
                {
                    $arr_=array(
                        "cid"=>$last_id,
                        "name"=>$_POST['type_of_product'][$i],
                        "quantity"=>$_POST['quantity'][$i],
                        "price"=>$_POST['price'][$i],
                        "discount"=>$_POST['discount'][$i],
                        "tax"=>$tax,
                        "amount"=>$_POST['amount'][$i]);
                    $insert = insert_query($arr_, "credit_note_detail");
                }
            }
        
            $_SESSION['suc']='Credit Note Detail Added Successfully...';
        }
        else
        {
          $_SESSION['unsuc']='Credit Note Detail Not Added... Try Again...';
        }
        header("location:".$site_url."creadit-notes-listing");
    }
}
?>