<?php include("header.php"); ?>

<?php include("leftpanel.php"); ?>

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
						<a href="<?php echo $site_url; ?>department-shipment-add/<?php echo $_GET['id'] ?>" class="btn btn-warning mb-5">Edit Shipment</a>
						<a href="<?php echo $site_url; ?>_private_content_shipment/l_<?php echo $_GET['id']?>.pdf" download="l_<?php echo $_GET['id']?>" class="btn btn-purple mb-5">Download Invoice</a>
					</div>
                    <div class="clearfix">
                    	<iframe src="<?php echo $site_url; ?>_private_content_shipment/l_<?php echo $_GET['id']?>.pdf" width="1000" height="800"></iframe>
                   	</div>
                </div>
                
            </div>
            
        </div>

    </section>

</div>


<?php include("footer.php"); ?>
