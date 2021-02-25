<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Booking_model');
		$this->load->model('User_model');
		$this->load->model('Room_model');
		// $this->load->library('encryption');

        if(! $this->session->userdata('auth')['uid'])
        {
          $allowed = array('view_json','check_free_room');
          if(! in_array($this->router->fetch_method(), $allowed))
          {
            redirect('backoffice');
          }
		}

		$this->set_active_menu('300');

	}



	function index(){
		$data['title'] = "SDU Online learning";
		// $data['subheader_title'] = "ยินดีต้อนรับ ".$this->session->userdata('displayname');
		// $data['subheader_desc'] = "";
		// $data['active_tab'] = 'dashboard';

		$this->data = $data;
		$this->content = 'booking/index';
		$this->render();
	}

	function view($room_id = "01"){
		$data['title'] = "Booking view";

		$data['cssSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.3'
		);

		$data['jsSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js',
			'assets/js/booking-view.js'
		);

		$room_conditions = array(
			'id' => $room_id
		);
		$data['room'] = $this->Room_model->list(array('conditions'=> $room_conditions ));

		$this->data = $data;
		$this->content = 'booking/view';
		$this->render();
	}

	function form($id = null){
		$data['title'] = "Booking form";

		$data['cssSrc'] = array();

		$data['jsSrc'] = array(
			'assets/js/booking-form.js',
			'assets/vendors/jquery-validation/dist/jquery.validate.min.js'
		);

		if($id != null){

			$conditions = array(
				'id'=> $id
			);
			$data['booking'] = $this->Booking_model->list(array('conditions'=>  $conditions))[0];
			$data['form_mode'] = "update";

		}else{

			$data['default_contact'] = $this->User_model->list(array('conditions'=>array('user_id'=>$this->global_data['user_id'])))[0];
			$data['form_mode'] = "insert";
		}

		$this->data = $data;
		$this->content = 'booking/form';
		$this->render();

		// header('Content-Type: application/json');
    	// echo json_encode($booking);
	}


	public function form_store(){

		// $bds = explode('/', $this->input->post('booking_date_start'));
		// $booking_date_start_db = $bds[2]."-".$bds[0]."-".$bds[1];

		// $bde = explode('/', $this->input->post('booking_date_start'));
		// $booking_date_start_db = $bde[2]."-".$bde[0]."-".$bde[1];

		if($this->input->post('form_mode') == "insert"){
			$data = array(

				'user_id' => $this->global_data['user_id'],
				'booking_email' => $this->input->post('booking_email'),
				'booking_phone' => $this->input->post('booking_phone'),
				'internal_phone' => $this->input->post('internal_phone'),
				'room_id' => $this->input->post('room_id'),
				'participant' => $this->input->post('participant'),
				'usage_category' => $this->input->post('usage_category'),
				'objective' => $this->input->post('objective'),
				'booking_date_start' => $this->input->post('booking_date_start'),
				'booking_date_end' => $this->input->post('booking_date_end'),
				'require_staff' => $this->input->post('require_staff'),
				'booking_status' => 'pending',
				'created_at' => $this->global_data['timestamp'],
				'created_by' =>  $this->session->userdata('auth')['displayname'],
				'created_by_ip' => $this->global_data['client_ip']
			);

			$res = $this->Booking_model->save($data);
			if($res != false){
				redirect('booking/list');
			}

		}
		if($this->input->post('form_mode') == "update"){

			$data = array(
				'user_id' => $this->input->post('user_id'),
				'booking_email' => $this->input->post('booking_email'),
				'booking_phone' => $this->input->post('booking_phone'),
				'internal_phone' => $this->input->post('internal_phone'),
				'room_id' => $this->input->post('room_id'),
				'participant' => $this->input->post('participant'),
				'usage_category' => $this->input->post('usage_category'),
				'objective' => $this->input->post('objective'),
				'booking_date_start' => $this->input->post('booking_date_start'),
				'booking_date_end' => $this->input->post('booking_date_end'),
				'require_staff' => $this->input->post('require_staff'),
				'booking_status' => 'pending',
				'modified_at' => $this->global_data['timestamp'],
				'modified_by' =>  $this->session->userdata('auth')['displayname'],
				'modified_by_ip' => $this->global_data['client_ip']
			);

			$res = $this->Booking_model->update($this->input->post('form_id'),$data);
			if($res != false){
				redirect('booking/list');
		  	}
		}

	}


	public function list(){
		$data['title'] = "Booking list";

		$data['cssSrc'] = array();

		$data['jsSrc'] = array(
			'assets/js/booking-list.js'
		);

		if($this->input->post('md_search') == '1'){

			$search_date_start = $this->input->post('start');
			$search_date_end = $this->input->post('end');

			$criterias = array(

				'room_id' => $this->input->post('bm_search_room'),
				'booking_status' => $this->input->post('bm_search_status'),
				'booking_date_start' => $search_date_start,
				'booking_date_end' => $search_date_end
			);


		}else{

			$next14day = strtotime("+14 day");
			$search_date_start = date("d/m/Y");
			$search_date_end = date("d/m/Y",$next14day);

			$criterias = array(
				'room_id' => "",
				'booking_status' => "",
				'booking_date_start' => $search_date_start,
				'booking_date_end' => $search_date_end
			);

		}


		$conditions = array(
			'user_id'=>$this->global_data['user_id']
		);
		$data['room_info'] = $this->Room_model->list(array());

		// $data['rooms'] = $this->db->get('room_master')->result_array();
		$booking_lists = $this->Booking_model->list(array('conditions'=> $criterias));
		$data['booking_lists'] = $booking_lists;
		$data['criterias'] = $criterias;

		// print_r($booking_lists);
		$this->data = $data;
		$this->content = 'booking/list';
		$this->render();
	}

	public function check_free_room(){
			$room_id = $this->input->post('room_id');
			$free_date_start = $this->input->post('free_date_start');
			$free_date_end = $this->input->post('free_date_end');

			$conditions = array(
				'room_id'=> $room_id,
				'free_date_start' => $free_date_start,
				'free_date_end' => $free_date_end
			);
			$booking_lists = $this->Booking_model->check_freeroom_list(array('conditions'=> $conditions));

			header('Content-Type: application/json');
			echo json_encode($booking_lists);
	}

	public function event_update(){


		// if($this->input->post('action') == "drag"){}

		$conditions = array(
			'id'=>$this->input->post('id')
		);
		$booking = $this->Booking_model->list(array('conditions'=>  $conditions));
		if($booking[0]["booking_status"] == "pending"){

			$data = array(
				'booking_date_start' => $this->input->post('booking_date_start'),
				'booking_date_end' => $this->input->post('booking_date_end'),
				'modified_at' => $this->global_data['timestamp'],
				'modified_by' =>  $this->session->userdata('auth')['displayname'],
				'modified_by_ip' => $this->global_data['client_ip']
			);

			$event_update_result = $this->Booking_model->update($this->input->post('id'),$data);

		}else{
			$event_update_result = null;
		}

		$results = array(
			'data'=> $booking[0],
			'event_update_status' => $event_update_result
		);

		header('Content-Type: application/json');
		echo json_encode($results);

	}

	public function view_all_approved_json(){


		$conditions = array(
			'room_id'=> $this->input->post('room_id'),
			'booking_status' => 'approved'
		);

		$booking_lists = $this->Booking_model->list(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> $booking["booking_org"]."-".$booking["objective"],
					"start"=> $datestart->format(DateTime::ATOM),
					"end"=> $dateend->format(DateTime::ATOM)
				);
				array_push($events,$obj);
			}

			header('Content-Type: application/json');
			echo json_encode($events);
		}

	}

	public function view_all_pending_json(){

		$conditions = array(
			'room_id'=> $this->input->post('room_id'),
			'booking_status' => 'pending'
		);
		$booking_lists = $this->Booking_model->list(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> $booking["booking_org"]."-".$booking["objective"],
					"start"=> $datestart->format(DateTime::ATOM),
					"end"=> $dateend->format(DateTime::ATOM)
				);
				array_push($events,$obj);
			}

			header('Content-Type: application/json');
			echo json_encode($events);
		}

	}

	public function view_approved_json(){


		// $events = DateTime::createFromFormat('Y-m-d\TH:i:sO', '2020-07-03\T09:30:00');
		// $events = date('Y-m-d\TH:i:sO');

		$conditions = array(
			'room_id'=> $this->input->post('room_id'),
			'booking_status' => 'approved',
			'user_id' => $this->session->userdata('auth')['hrcode']
		);
		// $data['rooms'] = $this->db->get('room_master')->result_array();
		$booking_lists = $this->Booking_model->list(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> $booking["booking_org"]."-".$booking["objective"],
					"start"=> $datestart->format(DateTime::ATOM),
					"end"=> $dateend->format(DateTime::ATOM)
				);
				array_push($events,$obj);
			}

			header('Content-Type: application/json');
			echo json_encode($events);
		}




		// $events = array(
		// 	array(
		// 		"title"=> "Event 1",
		// 		"start"=> "2020-07-05T09:00:00",
		// 		"end"=> "2020-07-05T18:00:00"
		// 	),
		// 	array(
		// 		"title"=> "Event 2",
		// 		"start"=> "2020-06-05T09:00:00",
		// 		"end"=> "2020-06-05T18:00:00"
		// 	),
		// 	array(
		// 		"title"=> "ทดสอบการจองตารางห้อง",
		// 		"start"=> "2020-07-03T09:00:00",
		// 		"end"=> "2020-07-04T16:00:00"
		// 	),
		// );

		// $events = date(DateTime::ISO8601);

		// $objects = get_room_bytype(2);



	}

	public function view_pending_json(){

		$conditions = array(
			'room_id'=> $this->input->post('room_id'),
			'booking_status' => 'pending',
			'user_id' => $this->session->userdata('auth')['hrcode']
		);
		$booking_lists = $this->Booking_model->list(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> $booking["booking_org"]."-".$booking["objective"],
					"start"=> $datestart->format(DateTime::ATOM),
					"end"=> $dateend->format(DateTime::ATOM)
				);
				array_push($events,$obj);
			}

			header('Content-Type: application/json');
			echo json_encode($events);
		}

	}

	public function view_other_approved_json(){


		// $events = DateTime::createFromFormat('Y-m-d\TH:i:sO', '2020-07-03\T09:30:00');
		// $events = date('Y-m-d\TH:i:sO');

		$conditions = array(
			'room_id'=> $this->input->post('room_id'),
			'booking_status' => 'approved',
			'not_user_id' => $this->session->userdata('auth')['hrcode']
		);
		// print_r($conditions);
		// $data['rooms'] = $this->db->get('room_master')->result_array();
		$booking_lists = $this->Booking_model->list(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> $booking["booking_org"]."-".$booking["objective"],
					"start"=> $datestart->format(DateTime::ATOM),
					"end"=> $dateend->format(DateTime::ATOM)
				);
				array_push($events,$obj);
			}

			header('Content-Type: application/json');
			echo json_encode($events);
		}

	}



}
