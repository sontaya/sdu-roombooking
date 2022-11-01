<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Hybridexport extends MY_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('Pdf');

		$this->load->model('Hybridbooking_model');
    }




    function pdf_room_tag(){
		if (ENVIRONMENT == "production") {
			$source_path = $_SERVER['DOCUMENT_ROOT'];
		} else {
			$source_path = $_SERVER['DOCUMENT_ROOT'];
		}

		$export_target = $this->session->userdata('export_target');
		$criterias = array(
			'export_target' => $export_target
		);
		$responses = $this->Hybridbooking_model->list(array('conditions'=> $criterias));

		// $this->session->set_userdata('export_target',null);



		$pdf = new Pdf('', '', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('Roombooking Hybrid tag');

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

		foreach ($responses as $res) {

			if ($res["usage_category"] == '1'){
				$objective_desc =  'วิชา'. $res["subject_name"]. ' ('.$res["subject_id"].')';
			}else{
				$objective_desc =  $res["objective"];
			}

			$pdf->AddPage('L');
			$pdf->SetFont('thsarabun', '', 36);
			$html_pg = '<br /><br /><br />';
			$html_pg .= '<span style="text-align:center; font-weight:bold;">'.$res["room_shortname"].'</span><br />';
			$html_pg .= '<span style="text-align:center; font-weight:bold; font-size:40px;">'. $objective_desc .'</span><br />';
			$html_pg .= '<span style="text-align:center; font-weight:bold;">'.$res["teacher_fullname"].'</span><br />';
			$html_pg .= '<span style="text-align:center; font-weight:bold;">เวลา '. get_time_fromdatetime($res["booking_date_start"],1,true) .' - '. get_time_fromdatetime($res["booking_date_end"],1,true) .' น.</span>';

			$pdf->writeHTML($html_pg, true, 0, true, 0);
		}





		$pdf->Output('room_tag.pdf', 'I');
	}



	public function prepare_export(){
		$targets = $this->input->post('objects');
		$this->session->set_userdata('export_target',$targets);
	}

	public function xlsx(){


		$export_target = $this->session->userdata('export_target');
		$criterias = array(
			'export_target' => $export_target
		);
		$responses = $this->Hybridbooking_model->list(array('conditions'=> $criterias));

		$this->session->set_userdata('export_target',null);

		// header('Content-Type: application/json');
		// echo json_encode($responses);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();


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

		$filename = 'hb-report-'.time();

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
