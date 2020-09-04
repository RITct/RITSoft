<?php 
if(isset($_GET['action']) && isset($_GET['type'])){

    $type = $_GET['type'];
    $action = $_GET['action'];
    switch ($action ) {
        case 'template-mark':

        if (strtolower(  trim($type  , ' ')) == 'excel') {
            ExportReports('excel');
        }
        break;

        default:
        # code...
        break;
    }


}




function ExportReports($parameter1) {
    include_once('PHPExcel/IOFactory.php');



    $objPHPExcel = new PHPExcel;

    $objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');

    $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");


    $currencyFormat = '#,#0.## \€;[Red]-#,#0.## \€';

    $numberFormat = '#,#0.##;[Red]-#,#0.##';



    $objSheet = $objPHPExcel->getActiveSheet();

    $objSheet->setTitle(' SESSIONAL MARK ');



    $objSheet->getStyle('A1:Y1')->getFont()->setBold(true)->setSize(12);

    $objSheet->getCell('A1')->setValue('rollno');
    $objSheet->getCell('B1')->setValue('Name                               ');
    $objSheet->getCell('C1')->setValue('Mark'); 


    $objSheet->getColumnDimension('A')->setAutoSize(true);
    $objSheet->getColumnDimension('B')->setAutoSize(true);
    $objSheet->getColumnDimension('C')->setAutoSize(true); 


//Setting the header type
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="sessional_mark_template.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter->save('php://output');
    exit;

}

?>