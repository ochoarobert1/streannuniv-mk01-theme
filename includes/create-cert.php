<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Streann University');
$pdf->SetTitle('Certificate');
$pdf->SetSubject('Certificate for Level');
$pdf->SetKeywords('streann');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------


// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage('L', 'A4');

$date = date("Y/m/d");

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = '<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><h1 style="text-align: center; font-size: 30pt; font-weight: lighter; line-height: 10pt; margin: 0;">CERTIFICATE</h1>
<h2 style="font-size: 15pt; text-align: center; line-height: 0; margin: 0;  font-weight: lighter;">OF COMPLETION HAS PRESENTED TO</h2>
<p style="text-align: center; font-size: 30pt; line-height: 20pt;">'. $nombre .'</p><h4 style="text-align: center; font-size: 15pt; font-weight: lighter; line-height: 10pt;">FOR COMPLETION OF THE</h4><h2 style="text-align: center; font-weight: bolder; font-size: 15pt; line-height: 20pt;">Streann Center Advance Digital Media Platform <br/>Configure and Maintain</h2><h2 style="text-align: center; font-weight: bolder; font-size: 30pt; line-height: 25pt;">' . $nivel . '</h2>
<p style="text-align: center; font-size: 20pt; line-height: 30pt;">       ' . date("d/m/Y") . '</p>

';

$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = get_template_directory_uri() . '/images/certificate-details.jpg';
$pdf->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();



$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();


//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
