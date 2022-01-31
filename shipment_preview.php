<?php include("header.php"); ?>

<?php include("leftpanel.php");

//checking for duplicate entry for invoice number
/*$qrget=fetch_query("*", "`shipment`", array("id="=>$_GET['id']));
$invoice=$qrget['invoice_number'];
$qrget_duplicate=select_query("*","shipment", array("id!="=>$_GET['id'],"invoice_number="=>$invoice), "id desc");
if($row->num_rows>0)
{
	$rows = fetch_query("*","shipment",""," id desc limit 1");
	$invoice_number=sprintf("%05d", $rows['invoice_number']+1);
	
	$arr=array("invoice_number"=>$invoice_number);
	$insert = update_query($arr,"id=".$_GET['id'],"shipment");

}*/
//end for checking for duplicate entry for invoice number
?>

<div class="content-wrapper">

    <section class="content-header">

        <h1> Shipment Invoice Preview </h1>

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
                   
                    <div class="clearfix">

						<a onclick="sendemail('<?php echo $_GET['id']?>')" class="btn btn-warning mb-5" style="color: #fff;">Send Email</a>
						<a href="<?php echo $site_url; ?>_private_content_shipment/l_<?php echo $_GET['id']?>.pdf" download="l_<?php echo $_GET['id']?>" class="btn btn-purple mb-5">Download Invoice</a>
					</div>
                    <div class="clearfix">
                    	<?php /*?><iframe src="<?php echo $site_url; ?>_private_content_shipment/s_<?php echo $_GET['id']?>.pdf" width="1000" height="800"></iframe><?php */?>
                        <iframe src="<?php echo $site_url; ?>_private_content_shipment/l_<?php echo $_GET['id']?>.pdf" width="1000" height="800"></iframe>
                   	</div>
                </div>
                
            </div>
            
        </div>

    </section>

</div>


<?php include("footer.php"); ?>
<script type="text/javascript">
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
</script>