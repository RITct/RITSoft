<?php

/**
 * @Author: indran
 * @Date:   2018-10-21 19:57:24
 * @Last Modified by:   indran
 * @Last Modified time: 2018-10-21 20:09:03
 */
?>
<?php
$baseHtml = '';
if (isset($_POST['html'])) {
	// var_dump($_POST['html']);

	$baseHtml = $_POST['html'];

}

$html="<html>";
$html.="<table border='1' cellspacing='0' align=center cellspacing='0' width='100%'>";
$html.= $baseHtml;
$html.="</table>";

$filename = "Staff_advisor_excel_" . date('Ymd') . ".xls";

header("Content-type:application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename\"");
//                                header("Content-Disposition:attachment;filename:download.xls");
echo $html;

?>