<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dpbackoffice extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model('Dpbooking_model');
		$this->load->model('Dproom_model');
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
		redirect('dpbackoffice/booking_manage');
	}

	function form_admin($id = null){
		$data['title'] = "Booking by Admin";

		$data['cssSrc'] = array();

		$data['jsSrc'] = array(
			'assets/js/dp-booking-init.js',
			'assets/js/dp-backoffice-form-admin.js',
			'assets/vendors/jquery-validation/dist/jquery.validate.min.js'
		);

		if($id != null){

			$conditions = array(
				'id'=> $id
			);
			$data['booking'] = $this->Dpbooking_model->list(array('conditions'=>  $conditions))[0];
			$data['form_mode'] = "update";

		}else{
			$data['form_mode'] = "insert";
		}

		$this->data = $data;
		$this->content = 'dpbackoffice/form_admin';
		$this->render_dp();

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
				'internal_phone' => $this->input->post('internal_phone'),
				'room_id' => $this->input->post('room_id'),
				'usage_scale' => $this->input->post('usage_scale'),
				'usage_format' => $this->input->post('usage_format'),
				'event_option1' => $this->input->post('event_option1'),
				'event_option2' => $this->input->post('event_option2'),
				'event_option3' => $this->input->post('event_option3'),
				'event_option4' => $this->input->post('event_option4'),
				'event_option5' => $this->input->post('event_option5'),
				'event_option6' => $this->input->post('event_option6'),
				'event_option7' => $this->input->post('event_option7'),
				'event_option8' => $this->input->post('event_option8'),
				'event_option8_ext' => $this->input->post('event_option8_ext'),
				'snack' => $this->input->post('snack'),
				'booking_date_start' => $this->input->post('booking_date_start'),
				'booking_date_end' => $this->input->post('booking_date_end'),
				'booking_status' => $this->input->post('booking_status'),
				'approved_by' => $this->global_data['user_id'],
				'approved_date' => $this->global_data['timestamp'],
				'created_at' => $this->global_data['timestamp'],
				'created_by' =>  $this->session->userdata('auth')['displayname'],
				'created_by_ip' => $this->global_data['client_ip']
			);

			$res = $this->Dpbooking_model->save($data);
			if($res != false){
				redirect('dpbackoffice/booking_manage');
		  	}

		}
		if($this->input->post('form_mode') == "update"){

			$data = array(
				'user_id' => $this->input->post('user_id'),
				'booking_email' => $this->input->post('booking_email'),
				'booking_phone' => $this->input->post('booking_phone'),
				'internal_phone' => $this->input->post('internal_phone'),
				'room_id' => $this->input->post('room_id'),
				'usage_format' => $this->input->post('usage_format'),
				'usage_scale' => $this->input->post('usage_scale'),
				'event_option1' => $this->input->post('event_option1'),
				'event_option2' => $this->input->post('event_option2'),
				'event_option3' => $this->input->post('event_option3'),
				'event_option4' => $this->input->post('event_option4'),
				'event_option5' => $this->input->post('event_option5'),
				'event_option6' => $this->input->post('event_option6'),
				'event_option7' => $this->input->post('event_option7'),
				'event_option8' => $this->input->post('event_option8'),
				'event_option8_ext' => $this->input->post('event_option8_ext'),
				'snack' => $this->input->post('snack'),
				'booking_date_start' => $this->input->post('booking_date_start'),
				'booking_date_end' => $this->input->post('booking_date_end'),
				'booking_status' => $this->input->post('booking_status'),
				'modified_at' => $this->global_data['timestamp'],
				'modified_by' =>  $this->session->userdata('auth')['displayname'],
				'modified_by_ip' => $this->global_data['client_ip']
			);

			$res = $this->Dpbooking_model->update($this->input->post('form_id'),$data);
			if($res != false){
				redirect('dpbackoffice/booking_manage');
		  	}
		}

	}

	function booking_manage(){
		//
		$data['title'] = "Booking Manage";

		$data['jsSrc'] = array(
			'assets/js/dp-backoffice-init.js',
			'assets/js/dp-backoffice-booking-manage.js'
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
				'room_id' => "",
				'booking_status' => "",
				'booking_date_start' => $search_date_start,
				'booking_date_end' => $search_date_end
			);

		}

		$room_master_conditions = array(
			'active' => 'Y',
			'room_in' => $this->session->userdata('auth')['manage_room']
		);
		$data['room_info'] = $this->Dproom_model->list(array('conditions'=> $room_master_conditions));

		$data['criterias'] = $criterias;
		$data['booking_lists'] = $this->Dpbooking_model->list(array('conditions'=> $criterias));
		$this->data = $data;
		$this->content = 'dpbackoffice/manage_booking';
		$this->render_dp();

		// 	header('Content-Type: application/json');
    	// echo json_encode($data);

	}

	function booking_calendar($room_id = null){

		if($room_id == null){
			$room_id = $this->global_data['default_room'];
		}

		$data['title'] = "calendar view";
		$data['cssSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.3'
		);

		$data['jsSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js',
			'assets/js/dp-backoffice-init.js',
			'assets/js/dp-backoffice-booking-calendar.js'
		);

		//--Begin:: รายละเอียดห้อง
			$room_conditions = array(
				'id' => $room_id
			);
			$data['room'] = $this->Dproom_model->list(array('conditions'=> $room_conditions ));

		//--End:: รายละเอียดห้อง


		//--Begin:: เงื่อนไขในการเลือกห้อง

			$room_master_conditions1 = array(
				'active' => 'Y',
				'room_in' => $this->session->userdata('auth')['manage_room']
			);
			$data['room_info1'] = $this->Dproom_model->list(array('conditions'=> $room_master_conditions1));


		//--End:: เงื่อนไขในการเลือกห้อง


		$this->data = $data;

		$this->content = 'dpbackoffice/manage_booking_calendar';
		$this->render_dp();

		// header('Content-Type: application/json');
    	// echo json_encode($data);
	}

	function get_booking_request(){

		if($_POST){
			$data['params'] = $_POST["query"];

			$lists = $this->Dpbooking_model->list(array('conditions'=>  $_POST["query"]));


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

			$lists = $this->Dpbooking_model->list();
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

		$res = $this->Dpbooking_model->update($target_id, $data);

		header('Content-Type: application/json');
    	echo json_encode($res);
	}

	function booking_delete(){

		$target_id = $this->input->post('id');

		$res = $this->Dpbooking_model->delete($target_id);

		header('Content-Type: application/json');
    	echo json_encode($res);
	}

	function get_booking_info($id){

		$conditions = array(
			'id' => $id
		);
		$res = $this->Dpbooking_model->list(array('conditions'=>$conditions));

		header('Content-Type: application/json');
    	echo json_encode($res);

	}

	function debug(){
		// $conditions = array(
		// 	'active' => 'Y',
		// 	'room_in' => $this->session->userdata('auth')['manage_room']
		// );
		// $room_info = $this->Dproom_model->list(array('conditions'=> $conditions));

		$rooms = $this->session->userdata('auth')['manage_room'];
		echo $rooms[0];
	}


}
