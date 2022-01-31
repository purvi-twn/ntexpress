<?php require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();



$html = '<style>
@import url("https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@500&display=swap"); 

 * { 
 font-family: "Noto Sans Arabic", sans-serif; }
 
 </style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <h1>Welcome to ItSolutionStuff.com</h1>
        <table class="table table-bordered">
            <tr>
                <th colspan="2">Information Form</th>
            </tr>
            <tr>
                <th>Name</th>
                <td>۱٤-۱۱-۲٠۲۱</td>
            </tr>
            <tr>
                <th>Email</th>
                <td> ﺗﺎﺭﻳﺦ ﺍﻟﺨﺪﻣﺔ<</td>
            </tr>
            <tr>
                <th>Website URL</th>
                <td>cc</td>
            </tr>
            <tr>
                <th>Say Something</th>
                <td>dd</td>
            </tr>
        </table>';

//$filename = "newpdffile";

// include autoloader


// reference the Dompdf namespace


// instantiate and use the dompdf class


$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
//$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();
ob_end_clean();
// Output the generated PDF to Browser
    //$dompdf->stream();

$dompdf->stream($filename,array("Attachment"=>0));





