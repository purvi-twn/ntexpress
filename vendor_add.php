<?php include("header.php"); 

if(@$_REQUEST['id']!='')
{
    $id = $_REQUEST['id'];
    $rows = fetch_query("*","vendor",array("id="=>$id));
    
    $name = $rows['name'];
    $company_name = $rows['company_name'];
    $vendor_name = $rows['vendor_name'];
    $email = $rows['email'];
    $phonecode = $rows['phonecode'];
    $phone = $rows['phone'];
    $mno = $rows['mno'];
    $website = $rows['website'];
    $taxtreatment = $rows['taxtreatment'];
    $tax_treatment_name = $rows['tax_treatment_name'];
    $taxnumber = $rows['taxnumber'];
    $source_country = $rows['source_country'];
    $currency = $rows['currency'];
    $opn_balance = $rows['opn_balance'];
    $payment_terms = $rows['payment_terms'];
    $bill_country = $rows['bill_country'];
    $bil_state = $rows['bil_state'];
    $bill_city = $rows['bill_city'];
    $address = $rows['address'];
    $pincode = $rows['pincode'];
    $phonetwo = $rows['phonetwo'];
    $fax = $rows['fax'];
}
else
{
    
    $name = '';
    
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
                            <h3> New Vendor </h3>
                        </div>
                    <div class="col-lg-12">

                        <form method="post" action="" name="bg" id="bg" enctype="multipart/form-data" autocomplete="off" >
                            
                            
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                                    <div class="form-group">
                                        <h5>Primary Contact</h5>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                        <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $name; ?>" style="display:inline-block" onblur="name_get()">
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
                                        <h5>Company Name</h5>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls"> 
                                        <input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo $company_name; ?>" style="display:inline-block">
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
                                        <h5 class="rbcl" style="color: #D42B2B">Vendor Display Name<span style="color: #D42B2B">*</span></h5>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <!-- id="pname_div" -->
                                    <div class="controls">
                                        <input type="text" name="vendor_name" id="vendor_name" class="form-control" value="<?php echo $vendor_name; ?>" style="display:inline-block">
                                          <!--  <?php echo $fname; ?> --> 
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
                                        <h5>Vendor Email</h5>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                        <input type="text" name="email" id="email" class="form-control" value="<?php echo $email; ?>" style="display:inline-block">
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
                                        <h5>Contact Number</h5>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                        <select name="phonecode" id="phonecode" class="form-control" onchange="get_state(this.value)">
                                               
                                                <?php $country='184';
                                                $selcon=mysqli_query($dlink,"SELECT * FROM country");
                                                while ($bcon=mysqli_fetch_array($selcon)) {
                                                ?>
                                                <option <?php if($phonecode==$bcon['phonecode']) { ?> selected <?php } ?> value="<?php echo $bcon['phonecode']; ?>"><?php echo $bcon['name'] ." +".$bcon['phonecode']; ?></option>
                                                <?php
                                                }
                                                ?>
                                        </select>
                                            <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $phone; ?>" style="width:40%;display:inline-block" onblur="shownumber(this.value)" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                            &nbsp;
                                            <input type="text" name="mno" id="mno" class="form-control" value="<?php echo $mno; ?>" style="width:40%;display:inline-block" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                            
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
                                        <h5>Website</h5>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                            <input type="text" name="website" id="website" class="form-control" value="<?php echo $website; ?>" style="display:inline-block">
                                    </div>
                                </div>
                            </div>
                            <!-- Tabs navs -->
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="my-4">
      <div class="row">
        <!-- Grid column -->
          <div class="col-sm-12 col-xl-8 mb-4 mb-xl-0">
                    <!-- Section: Live preview -->
                    <section>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item waves-effect waves-light">
                              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">TAX Details</a>
                            </li>
                            <li class="nav-item waves-effect waves-light" style="padding-left: 10px;">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Address</a>
                            </li>
                            <li class="nav-item waves-effect waves-light" style="padding-left: 10px;">
                              <a class="nav-link" id="receiver-tab" data-toggle="tab" href="#receiver" role="tab" aria-controls="receiver" aria-selected="false">Contact Person</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                
                                <div class="row mt-10 mb-10">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                        <div class="form-group">
                                            <h5 class="rbcl" style="color: #D42B2B">Tax Treatment<span style="color: #D42B2B">*</span></h5>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="controls">
                                            <select name="taxtreatment" id="taxtreatment" class="form-control">
                                                <option <?php if($taxtreatment=='Non-Vat') { ?> selected <?php } ?> value="Non-Vat">Non Vat Registered</option>
                                                <option <?php if($taxtreatment=='Vat') { ?> selected <?php } ?> value="Vat">Vat Registered</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="controls">
                                            <textarea name="tax_treatment_name" id="tax_treatment_name" placeholder="Non Vat Register, Vat Register"><?php echo $tax_treatment_name; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-5 mb-10" id="vat">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                        <div class="form-group">
                                            <h5 class="rbcl" style="color: #D42B2B">Tax Registration Number(TRN)<span class="text-danger">*</span></h5>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="controls">
                                            <input onblur="checkwidth(this.value)" type="text" name="taxnumber" id="taxnumber1" class="form-control" value="<?php echo $taxnumber; ?>"  minlength="15" maxlength="15"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5 mb-10" id="vat">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                        <div class="form-group">
                                            <h5 class="rbcl" style="color: #D42B2B">Source Of Supply<span class="text-danger">*</span></h5>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <select name="source_country" id="source_country" class="form-control" onchange="get_state(this.value)">
                                                    <option value="">Select Country</option>
                                                    <?php $country='184';
                                                    $selcon=mysqli_query($dlink,"SELECT * FROM location where location_type='0'  and parent_id='0' and is_visible='0' order by name");
                                                    while ($bcon=mysqli_fetch_array($selcon)) {
                                                    ?>
                                                    <option <?php if ($bcon['location_id'] == $source_country) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5 mb-10" id="vat">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                        <div class="form-group">
                                            <h5>Currency</h5>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <select name="currency" id="currency" class="form-control" onchange="get_state(this.value)">
                                                    <option  value="">Select Currency</option>
                                                    <?php 
                                                    $selcon=mysqli_query($dlink,"SELECT * FROM currency");
                                                    while ($bcon=mysqli_fetch_array($selcon)) {
                                                    ?>
                                                    <option <?php if ($bcon['code'] == $currency) {?> selected="selected" <?php }?> value="<?php echo $bcon['code']; ?>"><?php echo $bcon['symbol']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5 mb-10" id="vat">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                        <div class="form-group">
                                            <h5>Opening Balance</h5>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <input type="text" name="opn_balance" id="opn_balance" value="<?php echo $opn_balance; ?>" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5 mb-10" id="vat">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                        <div class="form-group">
                                            <h5>Payment Terms</h5>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
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
                           
                            </div>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row mt-10 mb-10">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <h3>Billing Address</h3>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-10 mb-10">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <h5>Country / Region</h5>
                                            <div class="controls">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <select name="bill_country" id="bill_country" class="form-control" onchange="get_state(this.value)">
                                                            <option value="">Select Country</option>
                                                            <?php $country='184';
                                                            $selcon=mysqli_query($dlink,"SELECT * FROM location where location_type='0'  order by name");
                                                            while ($bcon=mysqli_fetch_array($selcon)) {
                                                            ?>
                                                            <option <?php if ($bcon['location_id'] == $bill_country) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>State / Provience</h5>
                                            <div class="controls">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <!-- <select name="bil_state" id="bill_state" class="form-control" onchange="get_city(this.value)">
                                                            <option value="">Select Provience</option>
                                                            <?php
                                                            $selsta=mysqli_query($dlink,"SELECT * FROM location where location_type='1' and parent_id='".$bill_country."' and is_visible='0' order by name");
                                                            while($s=mysqli_fetch_array($selsta)) {
                                                            ?>
                                                            <option <?php if ($s['location_id'] == $bil_state) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option>
                                                           <?php
                                                            }
                                                            ?>
                                                        </select> -->

                                                        <input type="text" name="bill_state" id="bill_state" value="<?php echo $bill_state; ?>" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>City</h5>
                                            <div class="controls">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <!-- <select name="bill_city" id="bill_city" class="form-control">
                                                            <option value="">Select City</option>
                                                            <?php
                                                            $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$bil_state."' and is_visible='0' order by name");
                                                            while($s1=mysqli_fetch_array($selcit)) {
                                                            ?>
                                                            <option <?php if ($s1['location_id'] == $bill_city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select> -->
                                                        <input type="text" name="bill_city" id="bill_city" value="<?php echo $bill_city; ?>" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>Address</h5>
                                            <div class="controls">
                                                <textarea name="address" rows="1" id="address" class="form-control"><?php echo stripslashes($address); ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <h5>Zip Code</h5>
                                            <div class="controls">
                                                 <input type="text" name="pincode" id="pincode" value="<?php echo $pincode; ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>Phone</h5>
                                            <div class="controls">
                                                <input type="text" name="phonetwo" id="phonetwo" value="<?php echo $phonetwo; ?>" class="form-control" onkeypress="return isNumberKey(event);" maxlength="12">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>Fax</h5>
                                            <div class="controls">
                                                <input type="text" name="fax" id="fax" value="<?php echo $fax; ?>" class="form-control" onkeypress="return isNumberKey(event);" maxlength="12">
                                            </div>
                                        </div>
                                       
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        
                                    </div>
                                </div>
                                
                            </div>
<div class="tab-pane fade" id="receiver" role="tabpanel" aria-labelledby="receiver-tab">
    <div class="row mt-10 mb-10">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="form-group">
                <h3>Receiver Address</h3>
                
            </div>
        </div>
    </div>
    <style>
        .card-header .title {
            font-size: 17px;
            color: #000;
        }
        .card-header .accicon {
          float: right;
          font-size: 20px;  
          width: 2em;
        }
        .card-header{
          cursor: pointer;
        }
        .card{
          border: 1px solid #ddd;
        }
        .card-body{
          border: 1px solid #ddd;
        }
        .card-header:not(.collapsed) .rotate-icon {
          transform: rotate(180deg);
        }
        .card-header
        {
            background-color: #a8ddff !important;
        }
        </style>
    <div class="row mt-10 mb-10">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12" id="compare_div">
            <div class="accordion" id="accordionExample">
            
                    <?php 
                        if(@$_REQUEST['id']!='')
                        {
                            $row=select_query("*","vendor_detail", array("vid="=>$id));
                            $i=1;
                            if($row->num_rows)
                            {
                                while($b=$row->fetch_array())
                                { ?>
                                    <input type="hidden" name="rcvr_id[<?php echo $i;?>]" id="rcvr_id" value="<?php echo $b['id']; ?>">

                                    <input type="hidden" id="cont_val_<?php echo $i;?>" value="<?php echo $b['rcvr_mno']; ?>" name="cont_val[<?php echo $i;?>]" />

                                    <div id="divtr_0_<?php echo $i;?>">
                                        <div class="card">
                                            <div class="card-header" data-toggle="collapse" data-target="#collapse0" aria-expanded="true">     
                                                <span class="title" id="titlename_u_<?php echo $i;?>"> #<?php echo $i; ?> <?php echo $b['rcvr_name']; ?> </span>
                                                <span class="accicon">
                                                <i class="fas fa-trash-alt newicon" id="<?php echo $b['id'];?>" onclick="hidetr_up(this.id);"></i>
                                                <i class="fas fa-angle-down rotate-icon"></i>
                                                </span>
                                            </div>
                                            <div id="collapse0" class="collapse show" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="secondtab">
                                                        <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                               <h5>First Name</h5>
                                                                <div class="controls">
                                                                     <input type="text" name="f_name_0[<?php echo $i;?>]"
                                                                     data-nid="<?php echo $i;?>" id="frcvr_name0" class="form-control" value="<?php echo $b['fname']; ?>" style="display:inline-block" onblur="up_rvcr_name_get(this.value,this)">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Last Name</h5>
                                                                <div class="controls">
                                                                    <input type="text" name="l_name_0[<?php echo $i;?>]" id="rcvr_iqamano0" value="<?php echo $b['lname']; ?>" class="form-control" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Designation</h5>
                                                                <div class="controls">
                                                                    <input type="text" name="designation_0[<?php echo $i;?>]" rows="1" id="rcvr_vat_no0" class="form-control" value="<?php echo $b['designation']; ?>" />                             </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Mobile</h5>
                                                                <div class="controls">
                                                                    <input type="text" name="rcvr_mno_0[<?php echo $i;?>]" id="rcvr_mno0" value="<?php echo $b['mobile']; ?>" class="form-control" onkeypress="return isNumberKey(event);" maxlength="12" onblur="chkContact(this.value);">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Address <span class="text-danger">*</span></h5>
                                                                <div class="controls">
                                                                    <textarea placeholder="Street 1" style="height: 25px;" name="rcvr_address_0[<?php echo $i;?>]" rows="1" id="rcvr_address0" class="form-control"><?php echo stripslashes($b['rcvr_address']); ?> 
                                                                    </textarea>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                        <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>&nbsp; </h5>
                                                                <div class="controls">
                                                                    
                                                                    <textarea placeholder="Street 2" style="height: 25px;" name="rcvr_address1_0[<?php echo $i;?>]" rows="1" id="rcvr_address10" class="form-control"><?php echo stripslashes($b['rcvr_address1']); ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <!-- <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Country</h5>
                                                                <div class="controls">
                                                                    <select name="rcvr_country_0[<?php echo $i;?>]" id="rcvr_country0" class="form-control" onchange="get_rcvr_state(this.value),'0'">
                                                                        <option value="">Select Country</option>
                                                                        <?php $country='184';
                                                                        $selcon=mysqli_query($dlink,"SELECT * FROM location where location_type='0' and location_id='184' and parent_id='0' and is_visible='0' order by name");
                                                                        while ($bcon=mysqli_fetch_array($selcon)) {
                                                                            ?>
                                                                        <option <?php if ($bcon['location_id'] == $b['rcvr_country']) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option>
                                                                        <?php
                                                                        }?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Provience</h5>
                                                                <div class="controls">
                                                                    <select name="rcvr_state_0[<?php echo $i;?>]" id="rcvr_state0" class="form-control" onchange="get_rcvr_city(this.value,'0')">
                                                                        <option value="">Select Provience</option>
                                                                        <?php
                                                                        $selsta=mysqli_query($dlink,"SELECT * FROM location where location_type='1' and parent_id='".$country."' and is_visible='0' order by name");
                                                                        while($s=mysqli_fetch_array($selsta)) {
                                                                        ?>
                                                                        <option <?php if ($s['location_id'] == $b['rcvr_state']) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option>
                                                                       <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>City </h5>
                                                                <div class="controls">
                                                                   <select name="rcvr_city_0[<?php echo $i;?>]" id="rcvr_city0" class="form-control">
                                                                        <option value="">Select City</option>
                                                                        <?php
                                                                        $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$b['rcvr_state']."' and is_visible='0' order by name");
                                                                        while($s1=mysqli_fetch_array($selcit)) {
                                                                        ?>
                                                                        <option <?php if ($s1['location_id'] == $b['rcvr_city']) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="row">
                                                        <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Landmark</h5>
                                                                <div class="controls">
                                                                    <input type="text" name="rcvr_landmark_0[<?php echo $i;?>]" id="rcvr_landmark0" value="<?php echo $b['rcvr_landmark']; ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Email Address</h5>
                                                                <div class="controls">
                                                                    <input type="email" name="rcvr_email_0[<?php echo $i;?>]" id="rcvr_email0" value="<?php echo $b['email']; ?>" class="form-control">
                                                                </div>
                                                                <p id="userexist" style="color:#F00;"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Department</h5>
                                                                <div class="controls">
                                                                    <input type="text" name="department_0[<?php echo $i;?>]" id="rcvr_pincode0" value="<?php echo $b['department']; ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   <!--  <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <h5>Fax</h5>
                                                                <div class="controls">
                                                                    <input type="text" name="rcvr_fax_0[<?php echo $i;?>]" id="rcvr_fax0" value="<?php echo $b['rcvr_fax']; ?>" class="form-control">
                                                                    <input type="hidden" id="trremove_up_0<?php echo $i;?>" value="1" name="trremove_0[<?php echo $i;?>]" />
                                                                </div>
                                                            </div>
                                                       </div>
                                                   </div> -->
                                                    </div>
                                                </div>
                                           </div>
                                        </div>
                                    </div>

                                    
                                <?php $i++; }

                            }
                            ?>
                            <input type="hidden" id="update_rows" value="<?php echo $row->num_rows; ?>" name="update_rows" />
                            <?php
                        }
                        else
                        { ?>
                            <div id="divtr0">
                                <div class="card">
                                    <div class="card-header" data-toggle="collapse" data-target="#collapse0" aria-expanded="true">     
                                        <span class="title" id="titlename_i_1"> #1 </span>
                                        <span class="accicon">
                                        <i class="fas fa-trash-alt newicon" id="0" onclick="hidetr(this.id);"></i>
                                        <i class="fas fa-angle-down rotate-icon"></i>
                                        </span>
                                    </div>
                                    <div id="collapse0" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="secondtab">
                                                <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                       <h5>First Name</h5>
                                                        <div class="controls">
                                                             <input type="text" name="f_name[0]" id="frcvr_name0" data-nid="1"class="form-control" value="<?php echo $fname; ?>" style="display:inline-block" onblur="in_rvcr_name_get(this.value,this)">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Last Name</h5>
                                                        <div class="controls">
                                                            <input type="text" name="l_name[0]" id="rcvr_iqamano0" value="<?php echo $lname; ?>" class="form-control" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Designation</h5>
                                                        <div class="controls">
                                                            <input type="text" name="designation[0]" rows="1" id="rcvr_vat_no0" class="form-control" value="<?php echo $designation; ?>" />                             </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Mobile</h5>
                                                        <div class="controls">
                                                            <input type="text" name="rcvr_mno[0]" id="rcvr_mno0" value="<?php echo $mobile; ?>" class="form-control" onkeypress="return isNumberKey(event);" maxlength="12" onblur="chkContact(this.value);">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Address <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <textarea placeholder="Street 1" style="height: 25px;" name="rcvr_address[0]" rows="1" id="rcvr_address0" class="form-control"><?php echo stripslashes($rcvr_address); ?></textarea>
                                                           
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>&nbsp; </h5>
                                                        <div class="controls">
                                                            
                                                            <textarea placeholder="Street 2" style="height: 25px;" name="rcvr_address1[0]" rows="1" id="rcvr_address10" class="form-control"><?php echo stripslashes($rcvr_address1); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                           <!--  <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Country</h5>
                                                        <div class="controls">
                                                            <select name="rcvr_country[0]" id="rcvr_country0" class="form-control" onchange="get_rcvr_state(this.value),'0'">
                                                                <option value="">Select Country</option>
                                                                <?php $country='184';
                                                                $selcon=mysqli_query($dlink,"SELECT * FROM location where location_type='0' and location_id='184' and parent_id='0' and is_visible='0' order by name");
                                                                while ($bcon=mysqli_fetch_array($selcon)) {
                                                                    ?>
                                                                <option <?php if ($bcon['location_id'] == $rcvr_country) {?> selected="selected" <?php }?> value="<?php echo $bcon['location_id']; ?>"><?php echo $bcon['name']; ?></option>
                                                                <?php
                                                                }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Provience</h5>
                                                        <div class="controls">
                                                            <select name="rcvr_state[0]" id="rcvr_state0" class="form-control" onchange="get_rcvr_city(this.value,'0')">
                                                                <option value="">Select Provience</option>
                                                                <?php
                                                                $selsta=mysqli_query($dlink,"SELECT * FROM location where location_type='1' and parent_id='".$country."' and is_visible='0' order by name");
                                                                while($s=mysqli_fetch_array($selsta)) {
                                                                ?>
                                                                <option <?php if ($s['location_id'] == $rcvr_state) {?> selected="selected" <?php }?> value="<?php echo $s['location_id']; ?>" ><?php echo $s['name']; ?></option>
                                                               <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>City </h5>
                                                        <div class="controls">
                                                           <select name="rcvr_city[0]" id="rcvr_city0" class="form-control">
                                                                <option value="">Select City</option>
                                                                <?php
                                                                $selcit=mysqli_query($dlink,"SELECT * FROM location where location_type='2' and parent_id='".$state."' and is_visible='0' order by name");
                                                                while($s1=mysqli_fetch_array($selcit)) {
                                                                ?>
                                                                <option <?php if ($s1['location_id'] == $rcvr_city) {?> selected="selected" <?php }?> value="<?php echo $s1['location_id']; ?>" ><?php echo $s1['name']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                        </select>
                                                        </div>
                                                    </div>
                                                 </div>
                                            </div> -->
                                            <div class="row">
                                                <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Landmark</h5>
                                                        <div class="controls">
                                                            <input type="text" name="rcvr_landmark[0]" id="rcvr_landmark0" value="<?php echo $rcvr_landmark; ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Email Address</h5>
                                                        <div class="controls">
                                                            <input type="email" name="rcvr_email[0]" id="rcvr_email0" value="<?php echo $email; ?>" class="form-control">
                                                        </div>
                                                        <p id="userexist" style="color:#F00;"></p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Department</h5>
                                                        <div class="controls">
                                                            <input type="text" name="department[0]" id="rcvr_pincode0" value="<?php echo $department; ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <h5>Fax</h5>
                                                        <div class="controls">
                                                            <input type="text" name="rcvr_fax[0]" id="rcvr_fax0" value="<?php echo $rcvr_fax; ?>" class="form-control">
                                                            <input type="hidden" id="trremove_0" value="1" name="trremove[0]" />
                                                        </div>
                                                    </div>
                                               </div>
                                           </div> -->
                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </div>
                        <?php }
                    ?>
                    
                
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 col-sm-12 col-lg-6 mt-20">
                <a class="btn btn-danger add-comp btn-x" style="color: #fff;"><i class="fa fa-plus"></i> Add Another Receiver</a>
            </div>
        </div>
        
        <input type="hidden" id="total_rows" value="1" name="total_rows" />
    </div>

</div>
                                                        
                                                    </div>
                                                </section>
                                                <!-- Section: Live preview -->
                                          
                                              </div>
                                            </div>
                                        </div>
                                    
                                    
                                    
                                </div>
                            </div>
                            <!-- Tabs content -->
                           
                                <div class="bt-1 pt-10"> </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <button type="submit" class="btn btn-danger" id="submit" name="submit">Submit</button>
                                    </div>

                                    <?php 
                                        if(@$_REQUEST['id']!='')
                                        {
                                            ?>
                                            <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <a href="<?php echo $site_url; ?>new-shipment/<?php echo $id; ?>" class="btn btn-danger" id="invoice_btn" name="invoice_btn">Invoice</a>
                                            </div> -->
                                            <?php 
                                        }
                                    ?>
                                    
                                </div>
                                
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?php include("footer.php"); ?>
<script>

$( document ).ready(function() {
    
    var row_total = $('#update_rows').val();
    for (var i = 1; i <= row_total; i++) 
    {
        var cntno = $('#cont_val_'+i).val();
        myarray.push(cntno);
    }
});

function chkContact(val)
{
    //console.log($.inArray(val, myarray));
    if ($.inArray(val, myarray) >= 0) 
    {
        alert('Already exist!');
    }
}

var ci=1;
var myarray=[];
$('.add-comp').on("click", function(e){

    var pst_id = ci-1;
    var cnt = $('#rcvr_mno'+pst_id).val();
    myarray.push(cnt);

    var no=parseInt(ci)+parseInt(1);
    $('#total_rows').val(parseInt($('#total_rows').val())+parseInt(1));
    var ci_new=parseInt(ci)+parseInt(1);
    var new_input = '<div id="divtr'+ci+'"><div class="card"><div class="card-header" data-toggle="collapse" data-target="#collapse'+ci+'" aria-expanded="true"> <span class="title" id="titlename_i_'+ci+'"> #'+ci+' </span><span class="accicon"><i class="fas fa-trash-alt newicon" id="'+ci+'" onclick="hidetr(this.id);"></i><i class="fas fa-angle-down rotate-icon"></i></span></div><div id="collapse'+ci+'" class="collapse show" data-parent="#accordionExample"><div class="card-body"><div class="secondtab"><div class="row"><div class="col-lg-4 col-md-4 col-sm-12 col-12"><div class="form-group"><h5>First Name</h5><div class="controls"><input type="text" name="f_name['+ci+']" id="frcvr_name'+ci+'" data-nid="'+ci+'" class="form-control" value="" style="display:inline-block" onblur="in_rvcr_name_get(this.value,this)"></div></div></div><div class="col-lg-4 col-md-4 col-sm-12 col-12"><div class="form-group"><h5>Last Name</h5><div class="controls"><input type="text" name="l_name['+ci+']" id="rcvr_iqamano'+ci+'" value="" class="form-control" ></div></div></div><div class="col-lg-4 col-md-4 col-sm-12 col-12"><div class="form-group"><h5>Designation</h5><div class="controls"><input type="text" name="designation['+ci+']" rows="1" id="rcvr_vat_no" class="form-control" value=""/></div></div></div></div><div class="row"><div class="col-lg-4 col-md-4 col-sm-12 col-12"><div class="form-group"><h5>Mobile</h5><div class="controls"><input type="text" name="rcvr_mno['+ci+']" id="rcvr_mno'+ci+'" value="" class="form-control" onkeypress="return isNumberKey(event);" maxlength="12" onblur="chkContact(this.value);"></div></div></div><div class="col-lg-4 col-md-4 col-sm-12 col-12"><div class="col-lg-4 col-md-4 col-sm-12 col-12"> <div class="form-group"> <h5>Email Address</h5> <div class="controls"> <input type="email" name="rcvr_email['+ci+']" id="rcvr_email'+ci+'" value="" class="form-control"> </div> <p id="userexist" style="color:#F00;"></p> </div> </div> <div class="col-lg-4 col-md-4 col-sm-12 col-12"> <div class="form-group"> <h5>Department</h5> <div class="controls"><input type="text" name="department['+ci+']" id="rcvr_pincode'+ci+'" value="" class="form-control"> </div>  </div> </div></div><div class="row"> <div class="col-lg-4 col-md-4 col-sm-12 col-12"><input type="hidden" id="trremove_'+ci+'" value="1" name="trremove['+ci+']" /></div></div></div></div></div></div></div></div></div>';
    $('#compare_div').append(new_input);
    ci++;
});

function hidetr(val)
{
    if(confirm("Are you sure you want to delete this row?"))
    {
        var chng =0;
        $('#divtr'+val).hide();
        $('#trremove_'+val).val(chng);
        
        $('#frcvr_name'+val).val("");
        $('#rcvr_iqamano'+val).val("");
        $('#rcvr_vat_no'+val).val("");
        
        $('#rcvr_mno'+val).val("");
        $('#rcvr_address'+val).val("");
        $('#rcvr_address1'+val).val("");
        $('#rcvr_country'+val).val("");
        $('#rcvr_state'+val).val("");
        
        $('#rcvr_city'+val).val("");
        $('#rcvr_landmark'+val).val("");
        $('#rcvr_email'+val).val("");
        $('#rcvr_pincode'+val).val("");
        $('#rcvr_fax'+val).val("");
    }
    else
        return false;
    
}

function hidetr_up(val)
{
    if(confirm("Are you sure you want to delete this row?"))
    {
        var delid =val;

        $.ajax({
            type: "POST",
            url: "<?php echo $site_url; ?>admin_ajax.php",
            data:{delid:delid,action:'delete_cust_rvcr'},
            success: function(data)
            {  
                $("#accordionExample").load(' #accordionExample');
            }
        });
    }
    else
        return false;
    
}
</script>
<script>
function checkwidth(fval)
{
    var str=fval.length;
    if(str<15 || str>15)
    {
        alert("Enter 15 Digit VAT Number only");
        return false;
    }
}
function shownumber(pval)
{
    $('#phonetwo').val(pval);
}
$(document).ready(function(){
    /*$('#taxtype').on('change', function() {
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
    });*/
});
function name_get()
{ 
    $('#pname').val($('#fname').val());
    $('#pname_div').text($('#fname').val());
    
}

function up_rvcr_name_get(val,id)
{ 
    var id = $(id).attr("data-nid");
    var title_val = val;
    $('#titlename_u_'+id).text('#'+id+ ' ' +title_val);
    
}
function in_rvcr_name_get(val,id)
{ 
   var id = $(id).attr("data-nid");
    var title_val = val;
    $('#titlename_i_'+id).text('#'+id+ ' ' +title_val);
    
}

$(document).ready(function(){ 
    $("#submit").click(function()
    { 
        
        if($("#vendor_name").val()=="")
        {
            $("#vendor_name").attr("placeholder", "Please Enter Vendor Name.");
            $("#vendor_name").addClass("error_textbox");
            $("#vendor_name").focus();
            return false;
        }
   
    });
});

function get_rcvr_state(val,fid)
{
    $.ajax({
     type: "POST",
     url: "<?php echo $site_url; ?>admin_ajax.php",
     data:{country:val,action:'get_state'},
     success: function(data)
     {  
        if(data.trim()=='Not Found')
        {
            $("#rcvr_state"+fid).html('<option value="">Select</option>');  
        }
        else if(data.trim()=='blank')
        {
            $("#rcvr_state"+fid).html('<option value="">Select</option>');  
        }
        else
        {
            $("#rcvr_state"+fid).html(data); 
        }
      }
    });
}
function get_rcvr_city(val,fid)
{
    $.ajax({
     type: "POST",
     url: "<?php echo $site_url; ?>admin_ajax.php",
     data:{state:val,action:'get_city'},
     success: function(data)
     {  
        if(data.trim()=='Not Found')
        {
            $("#rcvr_city"+fid).html('<option value="">Select</option>');  
        }
        else if(data.trim()=='blank')
        {
            $("#rcvr_city"+fid).html('<option value="">Select</option>');  
        }
        else
        {
            $("#rcvr_city"+fid).html(data); 
        }
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
            $("#bill_city").html('<option value="">Select</option>');  
        }
        else if(data.trim()=='blank')
        {
            $("#bill_city").html('<option value="">Select</option>');  
        }
        else
        {
            $("#bill_city").html(data); 
        }
      }
    });
}
function check_email_ifexist(val)
{
    $.ajax({
     type: "POST",
     url: "<?php echo $site_url; ?>admin_ajax.php",
     data:{email:val,action:'check_customer_email_exist'},
     success: function(data)
     {  
        if(data.trim()=='Not Found')
        { }
        else if(data.trim()=='blank')
        {
            $("#userexist").html('Email Id Can Not Be Blank.'); 
        }
        else
        {
            $("#userexist").html(data); 
            $("#email").val(''); 
            
        }
      }
    });
}

</script>
<?php 

if(isset($_POST['submit'])!='')
{
  if(@$_GET['id']!='')
  {
                    
      $name=$_POST['fname'];
       
      $arr=array(
        "name"=>ucfirst($name),
        "company_name"=>$_POST['company_name'],
        "vendor_name"=>$_POST['vendor_name'],
        "email"=>$_POST['email'],
        "phonecode"=>$_POST['phonecode'],
        "phone"=>$_POST['phone'],
        "mno"=>$_POST['mno'],
        "website"=>$_POST['website'],
        "taxtreatment"=>$_POST['taxtreatment'],
        "tax_treatment_name"=>$_POST['tax_treatment_name'],
        "taxnumber"=>$_POST['taxnumber'],
        "source_country"=>$_POST['source_country'],
        "currency"=>$_POST['currency'],
        "opn_balance"=>$_POST['opn_balance'],
        "payment_terms"=>$_POST['payment_terms'],
        "bill_country"=>$_POST['bill_country'],
        "bil_state"=>$_POST['bil_state'],
        "bill_city"=>$_POST['bill_city'],
        "address"=>addslashes($_POST['address']),
        "pincode"=>$_POST['pincode'],
        "phonetwo"=>$_POST['phonetwo'],
        "fax"=>$_POST['fax'],
        "recorddate"=>$dt
    ); 

      $insert = update_query($arr,"id=".$id,"vendor"); 

        if($insert)
        {
            $total_update_row=$_POST['update_rows']; // 3

            $totalinsertrow=$_POST['total_rows']; // 2
            $total_insert_row = $totalinsertrow-1; // 1

            $total_rvcr_row = $total_update_row + $total_insert_row; 

            for($i=1;$i<=$total_update_row;$i++)
            {
                if($_POST['trremove_0'][$i][0] == 1)
                {
                    $rcv_name='';$rid='';
                    $rcv_name=$_POST['f_name_0'][$i];
                    $rid=$_POST['rcvr_id'][$i];

                    $arr_=array("fname"=>ucfirst($rcv_name),"lname"=>$_POST['l_name_0'][$i],"mobile"=>$_POST['rcvr_mno_0'][$i],"designation"=>$_POST['designation_0'][$i],"email"=>$_POST['rcvr_email_0'][$i],"department"=>$_POST['department_0'][$i]);
                    //echo"<pre>"; print_r($arr_);

                    $insert = update_query($arr_,"vid=".$rid,"vendor_detail");
                }
            }

            if($totalinsertrow != 1)
            {
                for ($j=1; $j<=$total_insert_row; $j++) 
                { 
                    if($_POST['trremove'][$j] == 1)
                    {
                        $rcv_name="";
                        $rcv_name=$_POST['f_name'][$j];
                        $arr_=array("vid"=>$id,"fname"=>ucfirst($rcv_name),"lname"=>$_POST['l_name'][$j],"designation"=>$_POST['designation'][$j],"mobile"=>$_POST['rcvr_mno'][$j],"email"=>$_POST['rcvr_email'][$j],"department"=>$_POST['department'][$j]);
                        $insert = insert_query($arr_, "vendor_detail");
                    }
                }
            }
            $_SESSION['suc']='Vendor Detail Updated Successfully...';
        }
        else
        {
            $_SESSION['unsuc']='Vendor Detail Not Updated... Try Again...';
        }
        header("location:".$site_url."vendor-listing");
        exit;
    }
    else
    { 
      $dt=date('Y-m-d H:i:s');
      
      $name=$_POST['fname'];

     
      $arr=array(
        "name"=>ucfirst($name),
        "company_name"=>$_POST['company_name'],
        "vendor_name"=>$_POST['vendor_name'],
        "email"=>$_POST['email'],
        "phonecode"=>$_POST['phonecode'],
        "phone"=>$_POST['phone'],
        "mno"=>$_POST['mno'],
        "website"=>$_POST['website'],
        "taxtreatment"=>$_POST['taxtreatment'],
        "tax_treatment_name"=>$_POST['tax_treatment_name'],
        "taxnumber"=>$_POST['taxnumber'],
        "source_country"=>$_POST['source_country'],
        "currency"=>$_POST['currency'],
        "opn_balance"=>$_POST['opn_balance'],
        "payment_terms"=>$_POST['payment_terms'],
        "bill_country"=>$_POST['bill_country'],
        "bil_state"=>$_POST['bil_state'],
        "bill_city"=>$_POST['bill_city'],
        "address"=>addslashes($_POST['address']),
        "pincode"=>$_POST['pincode'],
        "phonetwo"=>$_POST['phonetwo'],
        "fax"=>$_POST['fax'],
        "recorddate"=>$dt
    ); 

      $insert = insert_query($arr, "vendor");
      
      $last_id=$dlink->insert_id;
      if($insert)
      {
          $tota_row=$_POST['total_rows'];
          for($i=0;$i<$tota_row;$i++)
          {
                if($_POST['trremove'][$i] == 1)
                {
                    $rcv_name="";
                    $rcv_name=$_POST['f_name'][$i];
                    $arr_=array("vid"=>$last_id,"fname"=>ucfirst($rcv_name),"lname"=>$_POST['l_name'][$i],"designation"=>$_POST['designation'][$i],"mobile"=>$_POST['rcvr_mno'][$i],"email"=>$_POST['rcvr_email'][$i],"department"=>$_POST['department'][$i]);
                    $insert = insert_query($arr_, "vendor_detail");
                }
          }
          $_SESSION['suc']='Vendor Detail Added Successfully...';
      }
      else
      {
          $_SESSION['unsuc']='Vendor Detail Not Added... Try Again...';
      }
 
      header("location:".$site_url."vendor-listing");
 
  }
}
?>