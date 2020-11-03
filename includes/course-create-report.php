<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Streann University');
$pdf->SetTitle('Report');
$pdf->SetSubject('Report for Level');
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
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

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

$usuarios = get_users( array( 'blog_id' => $GLOBALS['blog_id'], 'role' => 'subscriber', 'role__not_in' => 'administrator', 'orderby' => 'ID', 'order' => 'DESC' ));
foreach ( $usuarios as $user ) {
    $courses = get_user_meta($user->ID, 'course_approved', true);
    if ((is_array($courses)) && (in_array($course_level, $courses))) {
        $contador = $contador + 1;
    }
}

$html .= '<h1 style="">Aprobados ' . $nivel . '</h1>';
$html .= '<h3>Cantidad: ' . $contador . '</h3>';
$pdf->writeHTML($html, true, false, true, false, '');


$tbl .= '<table cellspacing="3" cellpadding="3" border="1">
    <tr style="color: white;">
        <th style="background-color: black; font-size: 1.3em;">Nombre</th>
        <th style="background-color: black; font-size: 1.3em;">Empresa</th>
        <th style="background-color: black; font-size: 1.3em;">Email</th>
    </tr>';



foreach ( $usuarios as $user ) {
    $courses = get_user_meta($user->ID, 'course_approved', true);
    if ((is_array($courses)) && (in_array($course_level, $courses))) {
        $tbl .= '<tr>
        <td>'. get_user_meta($user->ID, 'first_name', true) .' ' . get_user_meta($user->ID, 'last_name', true) . '</td>
        <td>'. get_user_meta($user->ID, "business", true) .'</td>
        <td>'. esc_html( $user->user_email ) .'</td>
    </tr>';
    }
}
$tbl .= '</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');

// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+
