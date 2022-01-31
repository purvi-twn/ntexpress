<?php include('connection.php');
include ("query.php");
$adm=fetch_query("*", "`myadmin`", array("id="=>1));
$logo=$adm['logo'];
$mobile=$adm['mobile_1'];
$address=$adm['address'];
$html = "<link type='text/css' href='/absolute/path/to/pdf.css' rel='stylesheet' />
 <style>
.rndbrd{
	border-radius: 0px 0px 100px 100px;
	border:1px solid black;
	}
</style>
 <table width='100%' style='border-collapse: collapse;'>
        <tr>
            <td colspan='3'><img src='upimages/".$logo."'></td>
        </tr>
		<tr>
            <td colspan='3'>".$address." <hr style='color:#892502'></td>
        </tr>
        <tr>
            <td colspan='2'>&nbsp;</td>
            <td style='margin-top: 15px;display: block;'><span style='border: 1px solid black;border-radius: 15px;padding: 10px;'>Date / ".date('d-F-Y')."</span></td>
        </tr>
        <tr style='margin-top:10px;'>
            <td style='margin-top: 30px;display: inline-block;'><span class='rndbrd'>Date / ".date('d-F-Y')."</span></td>
            <td >sonarika@gmail.com</td>
			<td style='margin-top: 30px;display: inline-block;'><span style='border: 1px solid black;border-radius: 15px;padding: 10px;'>Date / ".date('d-F-Y')."</span></td>
        </tr>
        
        </table>";
$filename = "newpdffile";

// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;


// instantiate and use the dompdf class
$dompdf = new Dompdf();




$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
//$customPaper = array(0,0,5334,297);
//$dompdf->setPaper($customPaper,'portrait');
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($filename,array("Attachment"=>0));

?>
