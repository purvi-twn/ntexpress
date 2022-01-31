<footer class="main-footer text-center">
    &copy; <?php echo date('Y'); ?> <a href="<?php echo $site_url; ?>">NT Express</a>. All Rights Reserved.
</footer>

</div>



<script src="<?php echo $site_url; ?>assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>

<script src="<?php echo $site_url; ?>assets/vendor_components/popper/dist/popper.min.js"></script>

<script src="<?php echo $site_url; ?>assets/vendor_components/bootstrap/dist/js/bootstrap.js"></script>

<script src="<?php echo $site_url; ?>assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js"></script>

<script src="<?php echo $site_url; ?>assets/vendor_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>

<script src="<?php echo $site_url; ?>assets/vendor_components/raphael/raphael.min.js"></script>

<script src="<?php echo $site_url; ?>assets/vendor_components/morris.js/morris.min.js"></script>

<script src="<?php echo $site_url; ?>assets/vendor_components/chart.js-master/Chart.bundle.js"></script>

<script src="<?php echo $site_url; ?>js/WeatherIcon.js"></script>

<script src="<?php echo $site_url; ?>js/template.js"></script>

<script src="<?php echo $site_url; ?>js/dashboard.js"></script>

<script src="<?php echo $site_url; ?>js/demo.js"></script>

<script src="<?php echo $site_url; ?>js/statistic.js"></script>

<script src="<?php echo $site_url; ?>js/validation.js"></script>

<script src="<?php echo $site_url; ?>js/form-validation.js"></script>

<script src="<?php echo $site_url; ?>assets/vendor_components/datatable/datatables.min.js"></script>

<script src="<?php echo $site_url; ?>js/data-table.js"></script>

<script language="javascript">
function validateEmail(emailField){

        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(emailField) == false) 
        {
			return false;
        }
        return true;
	}

function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31
    && (charCode < 48 || charCode > 57) && charCode != 45 )
        return false;
    return true;
}
</script>

</body>

</html>
