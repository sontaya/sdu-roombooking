<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backoffice extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model('Booking_model');
		$this->load->model('Room_model');
		// $this->load->library('encryption');

        if(! $this->session->userdata('auth')['uid'])
        {
          $allowed = array();
          if(! in_array($this->router->fetch_method(), $allowed))
          {
            redirect('user/login');
          }
		}

		$this->set_active_menu('500');


	}

	function index(){
		redirect('backoffice/booking_manage');
	}

	function form_admin($id = null){
		$data['title'] = "จองโดยเจ้าหน้าที่ (Online Admin)";

		$data['cssSrc'] = array();

		$data['jsSrc'] = array(
			'assets/js/backoffice-form-admin.js',
			'assets/vendors/jquery-validation/dist/jquery.validate.min.js'
		);

		if($id != null){

			$conditions = array(
				'id'=> $id
			);
			$data['booking'] = $this->Booking_model->list(array('conditions'=>  $conditions))[0];
			$data['form_mode'] = "update";

		}else{
			$data['form_mode'] = "insert";
		}

		$room_master_conditions = array(
			'active' => 'Y',
			'room_in' => $this->session->userdata('auth')['manage_room']
		);
		$data['room_info'] = $this->Room_model->list(array('conditions'=> $room_master_conditions));

		$this->data = $data;
		$this->content = 'backoffice/form_admin';
		$this->render();

		// header('Content-Type: application/json');
    	// echo json_encode($booking);
	}

	public function form_admin_store(){

		if($this->input->post('form_mode') == "insert"){

			if($this->input->post('booking_status') == "approved"){
				$approved_by = $this->global_data['user_id'];
				$approved_date = $this->global_data['timestamp'];
			}else{
				$approved_by = null;
				$approved_date = null;
			}

			$data = array(

				'user_id' => $this->input->post('user_id'),
				'booking_email' => $this->input->post('booking_email'),
				'booking_phone' => $this->input->post('booking_phone'),
				'room_id' => $this->input->post('room_id'),
				'participant' => $this->input->post('participant'),
				'usage_category' => $this->input->post('usage_category'),
				'usage_software' => $this->input->post('usage_software'),
				'objective' => $this->input->post('objective'),
				'booking_date_start' => $this->input->post('booking_date_start'),
				'booking_date_end' => $this->input->post('booking_date_end'),
				'booking_status' => $this->input->post('booking_status'),
				'require_staff' => $this->input->post('require_staff'),
				'approved_by' => $this->global_data['user_id'],
				'approved_date' => $this->global_data['timestamp'],
				'created_at' => $this->global_data['timestamp'],
				'created_by' =>  $this->session->userdata('auth')['displayname'],
				'created_by_ip' => $this->global_data['client_ip']
			);

			$res = $this->Booking_model->save($data);
			if($res != false){
				redirect('backoffice/booking_manage');
		  	}

		}
		if($this->input->post('form_mode') == "update"){

			//-- Log before update by admin
			$this->Booking_model->log($this->input->post('form_id'));

			$data = array(
				'user_id' => $this->input->post('user_id'),
				'booking_email' => $this->input->post('booking_email'),
				'booking_phone' => $this->input->post('booking_phone'),
				'room_id' => $this->input->post('room_id'),
				'participant' => $this->input->post('participant'),
				'usage_category' => $this->input->post('usage_category'),
				'usage_software' => $this->input->post('usage_software'),
				'objective' => $this->input->post('objective'),
				'booking_date_start' => $this->input->post('booking_date_start'),
				'booking_date_end' => $this->input->post('booking_date_end'),
				'require_staff' => $this->input->post('require_staff'),
				'booking_status' => $this->input->post('booking_status'),
				'modified_at' => $this->global_data['timestamp'],
				'modified_by' =>  $this->session->userdata('auth')['displayname'],
				'modified_by_ip' => $this->global_data['client_ip']
			);

			$res = $this->Booking_model->update($this->input->post('form_id'),$data);
			if($res != false){
				redirect('backoffice/booking_manage');
		  	}
		}

	}

	function booking_manage(){
		//
		$data['title'] = "รายการจองห้อง (Online Admin)";

		$data['jsSrc'] = array(
			'assets/js/backoffice-init.js',
			'assets/js/backoffice-booking-manage.js'
		);

		if($this->input->post('md_search') == '1'){

			$search_date_start = $this->input->post('start');
			$search_date_end = $this->input->post('end');

			$criterias = array(
				'user_role' => $this->session->userdata('auth')['role'],
				'room_id' => $this->input->post('bm_search_room'),
				'room_in' => $this->session->userdata('auth')['manage_room'],
				'booking_status' => $this->input->post('bm_search_status'),
				'booking_date_start' => $search_date_start,
				'booking_date_end' => $search_date_end
			);


		}else{

			$next7day = strtotime("+7 day");
			$search_date_start = date("d/m/Y");
			$search_date_end = date("d/m/Y",$next7day);

			$criterias = array(
				'user_role' => $this->session->userdata('auth')['role'],
				'room_in' => $this->session->userdata('auth')['manage_room'],
				'room_id' => $this->input->post('bm_search_room'),
				'booking_status' => "",
				'booking_date_start' => $search_date_start,
				'booking_date_end' => $search_date_end
			);

		}

		$room_master_conditions = array(
			'active_in' => array('Y','C'),
			'room_in' => $this->session->userdata('auth')['manage_room']
		);
		$data['room_info'] = $this->Room_model->list(array('conditions'=> $room_master_conditions));

		$data['criterias'] = $criterias;
		$data['booking_lists'] = $this->Booking_model->list(array('conditions'=> $criterias));
		$this->data = $data;
		$this->content = 'backoffice/manage_booking';
		$this->render();

		// 	header('Content-Type: application/json');
    	// echo json_encode($data);

	}

	function booking_calendar($room_id = null){

		if($room_id == null){
			$room_id = $this->global_data['default_room'];
		}

		$data['title'] = "มุมมองปฏิทิน (Online Admin)";
		$data['cssSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.3'
		);

		$data['jsSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js',
			'assets/js/backoffice-init.js',
			'assets/js/backoffice-booking-calendar.js'
		);

		//--Begin:: รายละเอียดห้อง
			$room_conditions = array(
				'id' => $room_id
			);
			$data['room'] = $this->Room_model->list(array('conditions'=> $room_conditions ));

		//--End:: รายละเอียดห้อง


		//--Begin:: เงื่อนไขในการเลือกห้อง

			$room_master_conditions1 = array(
				'active_in' => array('Y','C'),
				'room_type' => '1',
				'room_in' => $this->session->userdata('auth')['manage_room']
			);
			$data['room_info1'] = $this->Room_model->list(array('conditions'=> $room_master_conditions1));

			$room_master_conditions2 = array(
				'active_in' => array('Y','C'),
				'room_type' => '2',
				'room_in' => $this->session->userdata('auth')['manage_room']
			);
			$data['room_info2'] = $this->Room_model->list(array('conditions'=> $room_master_conditions2));

		//--End:: เงื่อนไขในการเลือกห้อง


		$this->data = $data;

		$this->content = 'backoffice/manage_booking_calendar';
		$this->render();

		// header('Content-Type: application/json');
    	// echo json_encode($data);
	}

	function get_booking_request(){

		if($_POST){
			$data['params'] = $_POST["query"];

			$lists = $this->Booking_model->list(array('conditions'=>  $_POST["query"]));


			$data['meta'] = array(
				'page' => 1,
				'pages' => 1,
				'perpage' => -1,
				'total' => count($lists),
				'sort' => 'asc',
				'field' => 'id'
			);
			$data['data'] = $lists;
		}else{

			$lists = $this->Booking_model->list();
			$data['meta'] = array(
				'page' => 1,
				'pages' => 1,
				'perpage' => -1,
				'total' => count($lists),
				'sort' => 'asc',
				'field' => 'id'
			);
			$data['data'] = $lists;
		}

		header('Content-Type: application/json');
    	echo json_encode($data);
	}

	function booking_approve(){

		$target_id = $this->input->post('id');
		$data = array(
			'booking_status' => $this->input->post('status'),
			'booking_status_reason' => $this->input->post('status_reason'),
			'approved_by' => $this->global_data['user_id'],
			'approved_date' => $this->global_data['timestamp']
		);

		$res = $this->Booking_model->update($target_id, $data);

		header('Content-Type: application/json');
    	echo json_encode($res);
	}

	function booking_delete(){

		$target_id = $this->input->post('id');

		$res = $this->Booking_model->delete($target_id);

		header('Content-Type: application/json');
    	echo json_encode($res);
	}

	function get_booking_info($id){

		$conditions = array(
			'id' => $id
		);
		$res = $this->Booking_model->list(array('conditions'=>$conditions));

		header('Content-Type: application/json');
    	echo json_encode($res);

	}

	function booking_cancel(){

		$target_id = $this->input->post('id');

		//-- Log
		$this->Booking_model->log($target_id);

		$data = array(
			'booking_status' => $this->input->post('status'),
			'booking_status_reason' => $this->input->post('status_reason'),
			'approved_by' => $this->global_data['user_id'],
			'approved_date' => $this->global_data['timestamp']
		);

		$res = $this->Booking_model->update($target_id, $data);

		header('Content-Type: application/json');
    	echo json_encode($res);
	}



}
