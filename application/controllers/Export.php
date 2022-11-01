<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Export extends MY_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('Pdf');

		$this->load->model('Booking_model');
    }


    function id($stdcode){


        if(ENVIRONMENT == "production"){
            $source_path = $_SERVER['DOCUMENT_ROOT']."ceremony/";
        }else{
            $source_path = $_SERVER['DOCUMENT_ROOT'];
        }

        $conditions = array(
            'STD_CODE' => $this->session->userdata('auth_session')['std_code']
        );


        $client_ip = get_client_ip();
        $log_data = array(
            'ACTION_TYPE' => "พิมพ์บัตรซ้อมย่อย",
            'MESSAGE' => json_encode($conditions),
            'CREATED_BY' => $this->session->userdata('auth_session')['std_code'],
            'CREATED_BY_IP' => $client_ip
        );
        $log_result = $this->Ceremonylog_model->save($log_data);


        $practice_result = $this->Practice_model->get_practice_info(array('conditions'=>$conditions))[0];

        if($practice_result['STD_CODE']<>null){

                $pdf = new Pdf('', '', 'A4', true, 'UTF-8', false);
                $pdf->SetTitle('บัตรซ้อมย่อย');

                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);

                $pdf->AddPage();

                $pdf->SetFont('helvetica', '', 10);

                // define barcode style
                $style = array(
                        'position' => '',
                        'align' => 'C',
                        'stretch' => false,
                        'fitwidth' => true,
                        'cellfitalign' => '',
                        'border' => false,
                        'hpadding' => 'auto',
                        'vpadding' => 'auto',
                        'fgcolor' => array(0,0,0),
                        'bgcolor' => false, //array(255,255,255),
                        'text' => true,
                        'font' => 'helvetica',
                        'fontsize' => 8,
                        'stretchtext' => 4
                );

                // PRINT VARIOUS 1D BARCODES

                // CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
                $pdf->SetXY(140, 3);
                $pdf->write1DBarcode($practice_result['STD_CODE'] , 'C39', '', '', '', 16, 0.4, $style, 'N');

                $pdf->Ln();

                $pdf->Ln();

                $pdf->SetFont('thsarabun', '', 16);
                $pdf->SetDisplayMode('real', 'default');
                // $pdf->SetXY(10, 20);
                $pdf->Image($source_path.'assets/images/sdu.jpg', 10, 20, 23, 30, 'JPG', '', '', false, 300, '', false, false, 0, false, false, false);

                // $pdf->SetXY(170, 20);
                $pdf->Image($source_path.'assets/images/photo-frame.jpg', 170, 20, 30, 40, 'JPG', '', '', false, 300, '', false, false, 0, false, false, false);

                $pdf->SetXY(35,28);
                $pdf->SetFont('thsarabun', '', 24);
                $pdf->Cell(0, 0, 'บัตรซ้อมย่อย', 0, 1, 'L', 0, '', 0);

                $pdf->SetXY(35,35);
                $pdf->Cell(0, 0, 'มหาวิทยาลัยสวนดุสิต', 0, 1, 'L', 0, '', 0);

                $pdf->SetFont('thsarabun', '', 16);

                $pdf->SetXY(172,60);
                $pdf->Cell(0, 0, $practice_result['STD_CODE'], 0, 1, 'L', 0, '', 0);


                $pdf->SetXY(10,53);

                $html  = '<br /><br /><span stroke="0" fill="true"><b>ชื่อ – สกุล</b> '.$practice_result['PREFIX_NAME_TH'].' '.$practice_result['FIRST_NAME_TH'].'   '.$practice_result['LAST_NAME_TH'].' </span><br />';
                $html .= '<span stroke="0" fill="true"><b>สาขาวิชา</b> '.$practice_result['DEGREENAMETH'].' </span><br />';

                if($practice_result['PRE_REMARK']=='รายงานตัวไม่ชำระเงิน'){
                        $html .= '<span stroke="0" fill="true"><b>วันซ้อมย่อย</b> - </span><br />';
                        $html .= '<span stroke="0" fill="true"><b>เวลา</b>  - </span> <b>สถานที่</b> - </span> <br />';
                        $html .= '<span stroke="0" fill="true"><b>ห้องซ้อม</b> - </span><br />';
                        $html .= '<span stroke="0" fill="true"><b>หมายเหตุ</b>'.$practice_result['PRE_REMARK'].' </span><br />';
                }else{
                        $html .= '<span stroke="0" fill="true"><b>วันซ้อมย่อย</b> '.$practice_result['PRE_DATE'].'</span><br />';
                        $html .= '<span stroke="0" fill="true"><b>เวลา</b> '.$practice_result['PRE_CALL'].' </span> <b>สถานที่:</b>'.$practice_result['CALL_PLACE'].' </span> <br />';
                        $html .= '<span stroke="0" fill="true"><b>ห้องซ้อม</b> '.$practice_result['PRE_CALL_PLACE'].'</span><br />';
                        $html .= '<span stroke="0" fill="true"><b>หมายเหตุ</b>'.$practice_result['PRE_REMARK'].' </span><br />';
                }

                $html .= '<span stroke="0" fill="true">&nbsp;&nbsp;&nbsp;&nbsp;กรุณาอ่านข้อปฏิบัติด้านล่าง หากมีข้อสงสัยเกี่ยวกับกำหนดการฯ กรุณาติดต่อ โทร. 02-2445190-1 กองพัฒนานักศึกษา อาคาร 2 ชั้น 3 </span><br /><br />';
                $html .= '<span stroke="0" fill="true"><b><u>ข้อต้องปฏิบัติ </b></u></span><br />';
                $html .= '<span stroke="0" fill="true">&nbsp;1.&nbsp;บัณฑิตต้องมาซ้อมย่อย ตามวัน-เวลา และสถานที่ ที่ระบุไว้ในบัตรซ้อมย่อยเท่านั้น  </span><br />';
                $html .= '<span stroke="0" fill="true">&nbsp;2.&nbsp;การแต่งกายในวันซ้อมย่อย  </span><br />';
                $html .= '<span stroke="0" fill="true">  &nbsp;&nbsp;&nbsp;&nbsp;   <b> บัณฑิตชาย </b> ให้สวมเสื้อเชิ้ต นุ่งกางเกงผ้าทรงสุภาพ (ห้ามนุ่งยีนส์เด็ดขาด) สวมรองเท้าคัตชูหนังเท่านั้น </span><br />';
                $html .= '<span stroke="0" fill="true">  &nbsp;&nbsp;&nbsp;&nbsp;   <b> บัณฑิตหญิง </b> สวมเสื้อสุภาพมีปก นุ่งกระโปรงไม่รัดรูปยาวคลุมเข่าเล็กน้อย สวมรองเท้าคัตชู คู่ที่จะใส่วันรับจริง </span><br />';
                $html .= '<span stroke="0" fill="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; (ห้ามสวมเสื้อแขนกุดหรือสายเดี่ยวเด็ดขาด) </span><br />';
                $html .= '<span stroke="0" fill="true">&nbsp;3.&nbsp;<b>ติดรูปในบัตรฝึกซ้อมย่อยให้เรียบร้อยก่อนการฝึกซ้อม</b> </span><br />';
                $html .= '<span stroke="0" fill="true">&nbsp;4.&nbsp;ให้นำบัตรนี้ มาแสดงในวันซ้อมย่อย  และวันซ้อมใหญ่ด้วย </span><br />';
                $html .= '<span stroke="0" fill="true">&nbsp;5.&nbsp;บัณฑิตต้องให้ความเคารพ และปฏิบัติตามอาจารย์ผู้ฝึกซ้อมอย่างเคร่งครัด  </span><br />';
                $html .= '<span stroke="0" fill="true">&nbsp;6.&nbsp;บัณฑิตต้องผ่านการซ้อมย่อยแล้ว จึงจะสามารถเข้าซ้อมใหญ่ และเข้ารับพระราชทานปริญญาบัตรได้ </span><br />';
                $html .= '<span stroke="0" fill="true">&nbsp;7.&nbsp;<u>ในวันซ้อมใหญ่สวมครุย</u> ให้บัณฑิตเตรียมรูปถ่ายสวมครุย 1 รูปมาด้วย (เขียน ชื่อ – สกุล และลำดับการเข้ารับ</span><br />';
                $html .= '<span stroke="0" fill="true">&nbsp;&nbsp;&nbsp; ด้านหลังรูป) เพื่อทำบัตรประจำตัวบัณฑิต</span><br />';
                $html .= '<span stroke="0" fill="true">&nbsp;8.&nbsp;ตรวจสอบ วันซ้อมใหญ่ และวันรับจริงรายบุคคล วันที่ 15 สิงหาคม 2565 เป็นต้นไป ทาง www.dusit.ac.th </span><br />';
                $html .= '<span stroke="0" fill="true">&nbsp;9.&nbsp;บัณฑิต ที่มีการแต่งตั้งยศ หลังจากสำเร็จการศึกษา ให้นำคำสั่งแต่งตั้งยศ มายื่นหน้าห้องฝึกซ้อมย่อย Hall ชั้น 2 </span><br />';
                $html .= '<span stroke="0" fill="true">10.&nbsp;บัณฑิตที่เป็น ข้าราชการในพระองค์ฯ  ให้แจ้ง ชื่อ – สกุล ตำแหน่ง ในวันซ้อมย่อย หน้าห้องฝึกซ้อมย่อย Hall ชั้น 2</span><br />';
                $html .= '<span stroke="0" fill="true">11.&nbsp;บัณฑิตต้องสวมหน้ากากอนามัยหรือหน้ากากผ้าตลอดระยะเวลาของการฝึกซ้อม</span><br />';
                $html .= '<span stroke="0" fill="true" style="color:red;">12.&nbsp;<b>บัณฑิตต้องแสดงหลักฐานผลการตรวจ ATK (Antigen test kit) จากสถานพยาบาล หรือจากการตรวจด้วยตนเอง ภายในระยะเวลา 24 ชั่วโมงก่อนการเข้ารับการฝึกซ้อมย่อย โดยหากตรวจด้วยตนเอง ให้เขียน ชื่อ วันที่ เวลาตรวจ ลงในเครื่องตรวจ และเขียนชื่อ-นามสกุล รหัสนักศึกษาลงในกระดาษ แล้ววางทั้งคู่ไว้ด้วยกัน จากนั้นถ่ายรูปและพิมพ์ภาพผลการตรวจที่ยืนยันว่าไม่มีเชื้อไวรัสโคโรนา 2019 (COVID-19)มาแสดงต่อเจ้าหน้าที่ ณ หน้าห้องฝึกซ้อมย่อย</b></span><br />';

                $pdf->writeHTML($html, true, 0, true, 0);



                $pdf->Output('practice.pdf', 'I');
        }else{
                echo "<center> ไม่พบข้อมูล </center>";
        }
    }


    function room_tag(){
		if (ENVIRONMENT == "production") {
			$source_path = $_SERVER['DOCUMENT_ROOT'];
		} else {
			$source_path = $_SERVER['DOCUMENT_ROOT'];
		}

		// $conditions = array(
			//     'STD_CODE' =>  $this->session->userdata('auth_session')['std_code']
		// );


		// $client_ip = get_client_ip();
		// $log_data = array(
			//     'ACTION_TYPE' => "พิมพ์กำหนดการซ้อมใหญ่",
			//     'MESSAGE' => json_encode($conditions),
			//     'CREATED_BY' => $this->session->userdata('auth_session')['std_code'],
			//     'CREATED_BY_IP' => $client_ip
		// );
		// $log_result = $this->Ceremonylog_model->save($log_data);



		$pdf = new Pdf('', '', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('กำหนดการรับพระราชทานปริญญาบัตร ประจำปี 2560 - 2562');

		$pdf->setPrintHeader(false);
		// $pdf->setPrintFooter(false);

		// Set footer
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

		// set auto page breaks
		$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

		// กำหนดแบ่่งหน้าอัตโนมัติ
		$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

		$pdf->AddPage('L');
		$pdf->SetFont('helvetica', '', 10);

		// define barcode style
		$style = array(
			'position' => '',
			'align' => 'C',
			'stretch' => false,
			'fitwidth' => true,
			'cellfitalign' => '',
			'border' => false,
			'hpadding' => 'auto',
			'vpadding' => 'auto',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255),
			'text' => true,
			'font' => 'helvetica',
			'fontsize' => 8,
			'stretchtext' => 4
		);

		// PRINT VARIOUS 1D BARCODES



		$pdf->Ln();



		$pdf->SetDisplayMode('real', 'default');

		$html_pg = '<br /><br /><br /><h1 style="text-align:center;font-size: 36px;">Hall2 ศูนย์วิทยาศาสตร์</h1>';
		$pdf->SetFont('thsarabun', '', 36);
		$html_pg .= '<h3 style="text-align:center;">การเรียนการสอน รายวิชา 2500120 คุณค่าของความสุข A1 C1 D1</h3>';
		$html_pg .= '<h3 style="text-align:center;">รวีวรรณ เฮี้ยนชาศรี</h3>';

		$pdf->writeHTML($html_pg, true, 0, true, 0);


		$pdf->Output('room_tag.pdf', 'I');
	}



	public function prepare_xlsx(){
		$targets = $this->input->post('objects');
		$this->session->set_userdata('export_target',$targets);
	}

	public function xlsx(){


		$export_target = $this->session->userdata('export_target');
		$criterias = array(
			'export_target' => $export_target
		);
		$responses = $this->Booking_model->list(array('conditions'=> $criterias));

		$this->session->set_userdata('export_target',null);
		// header('Content-Type: application/json');
		// echo json_encode($responses);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();


		// $sheet->getStyle('A:A')
		//       ->getNumberFormat()
		//       ->applyFromArray(['formatCode' => PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_GENERAL]);

		$sheet->getStyle('A:A')
			  ->getNumberFormat()
			  ->setFormatCode('#');

		$sheet->getStyle('L:L')
				->getNumberFormat()
				->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DATETIME);

		$sheet->getStyle('M:M')
				->getNumberFormat()
				->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DATETIME);

		$sheet->getStyle('N:N')
				->getNumberFormat()
				->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DATETIME);

		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);
		$sheet->getColumnDimension('G')->setAutoSize(true);
		$sheet->getColumnDimension('H')->setAutoSize(true);
		$sheet->getColumnDimension('I')->setAutoSize(true);
		$sheet->getColumnDimension('J')->setAutoSize(true);
		$sheet->getColumnDimension('K')->setAutoSize(true);
		$sheet->getColumnDimension('L')->setAutoSize(true);
		$sheet->getColumnDimension('M')->setAutoSize(true);
		$sheet->getColumnDimension('N')->setAutoSize(true);
		$sheet->getColumnDimension('O')->setAutoSize(true);



		// $sheet->getColumnDimension('A')->setWidth(20);


		$sheet->setTitle('รายการจองห้อง');

		$rowCaption = [
						  'ชื่อย่อ', 'ชื่อห้อง','ตำแหน่งที่ตั้ง','ข้อมูลผู้จอง','เบอร์โทรศัพท์มือถือ','เบอร์โทรศัพท์ภายใน'
						  ,'ลักษณะการใช้งาน', 'ซอฟต์แวร์ที่ใช้งาน','วัตถุประสงค์การใช้งาน'
						  ,'จำนวนผู้เข้าร่วม', 'เจ้าหน้าที่ประจำห้อง'
						  ,'วันที่เริ่มต้น','วันที่สิ้นสุด','วันที่ทำรายการ'
						  ,'สถานะ'
						];

		$sheet->fromArray($rowCaption, NULL, 'A1');

		$rowCount = 2;
		foreach ($responses as $res) {

		  $sheet->setCellVAlue('A'.$rowCount, $res['room_tag']);
		  $sheet->setCellVAlue('B'.$rowCount, $res['room_name']);
		  $sheet->setCellVAlue('C'.$rowCount, $res['room_shortname']);
		  $sheet->setCellVAlue('D'.$rowCount, $res['name'].' '.$res['surname']);
		  $sheet->setCellVAlue('E'.$rowCount, $res['booking_phone']);
		  $sheet->setCellVAlue('F'.$rowCount, $res['internal_phone']);
		  $sheet->setCellVAlue('G'.$rowCount, $res['usage_category_desc']);
		  $sheet->setCellVAlue('H'.$rowCount, $res['usage_software_desc']);
		  $sheet->setCellVAlue('I'.$rowCount, $res['objective']);
		  $sheet->setCellVAlue('J'.$rowCount, $res['participant']);
		  $sheet->setCellVAlue('K'.$rowCount, $res['require_staff']);

		  $excelDateValueColL = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($res['booking_date_start'] );
		  $sheet->setCellVAlue('L'.$rowCount, $excelDateValueColL);

		  $excelDateValueColM = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($res['booking_date_end'] );
		  $sheet->setCellVAlue('M'.$rowCount, $excelDateValueColM);

		  $excelDateValueColN = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($res['created_at'] );
		  $sheet->setCellVAlue('N'.$rowCount, $excelDateValueColN);

		//   $sheet->setCellVAlue('M'.$rowCount, $res['booking_date_end']);
		//   $sheet->setCellVAlue('N'.$rowCount, $res['created_at']);
		  $sheet->setCellVAlue('O'.$rowCount, $res['booking_status_desc']);

		  $rowCount++;
		}

		$writer = new Xlsx($spreadsheet);

		$filename = 'ol-report-'.time();

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output'); // download file

	}

	public function xlsx_debug(){

		$export_target = $this->session->userdata('export_target');
		$criterias = array(
			'export_target' => $export_target
		);
		$results = $this->Booking_model->list(array('conditions'=> $criterias));

			header('Content-Type: application/json');
    		echo json_encode($results);

	}




}
