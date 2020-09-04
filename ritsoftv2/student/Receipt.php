setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->setPrintHeader(false);

$pdf->setPrintFooter(false); 
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$orientation='L';
$format='MAKE-L';
  $pdf->AddPage('L');
// ---------------------------------------------------------

$pdf->SetFont('helvetica', 'B', 14);
$pdf->Write(0, 'RAJIV GANDHI INSTITUTE OF TECHNOLOGY, KOTTAYAM', '', 0, 'C', true, 0, false, false, 0);
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Write(0, 'Sessional Marks', '', 0, 'C', true, 0, false, false, 0);
$pdf->SetFont('helvetica', 'U', 11);

  $pdf->Ln(); 


	  $pdf->Ln(2); 
// set Rotate
$pdf->SetFont('helvetica', '', 10);
// other configs
$pdf->setOpenCell(0);
$pdf->SetCellPadding(0);
$pdf->setCellHeightRatio(1.25);
 $i = 0 ;	
 $limit=2;
 $html = '
<table border="1" >
    <tr>
       <td rowspan="14" align ="center" ><span style = "font-weight:bold">SUBJECT CODE</span></td>
        <td rowspan="2" colspan="5" align ="center"><span style = "font-weight:bold">SUBJECT NAME</span></td>
        <td rowspan="2" colspan="5" align ="center" ><span style = "font-weight:bold">SESSIONAL MARKS</span></td>
     </tr>
    <tr>
       <td colspan="7" align ="center"><span style = "font-weight:bold">Departure</span></td>
        <td colspan="7" align ="center"><span style = "font-weight:bold">Arrival</span></td>
    </tr>
   
    </table>'; 
   
	$pdf->writeHTML($html, true, false, true, false, '');  

 $pdf->Ln();

  $pdf->Ln(5);
  $pdf->Output();



// ---------------------------------------------------------
