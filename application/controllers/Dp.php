<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dp extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Dpbooking_model');
		$this->load->model('User_model');
		$this->load->model('Dproom_model');
		// $this->load->library('encryption');

        // if(! $this->session->userdata('auth')['uid'])
        // {
        //   $allowed = array('view_json','check_free_room');
        //   if(! in_array($this->router->fetch_method(), $allowed))
        //   {
        //     redirect('backoffice');
        //   }
		// }


		if($this->session->userdata('auth')['role'] == "delegate_admin" or $this->session->userdata('auth')['role'] == "admin"){

			if (in_array("dusitplace", $this->session->userdata('auth')['manage_app'])) {
				$this->set_active_menu('500');
			}else{
				$this->set_active_menu('300');
			}


		}else{
			$this->set_active_menu('300');
		}


	}



	function index(){
		$data['title'] = "Dusitplace";
		// $data['subheader_title'] = "ยินดีต้อนรับ ".$this->session->userdata('displayname');
		// $data['subheader_desc'] = "";
		// $data['active_tab'] = 'dashboard';

		$this->data = $data;
		$this->content = 'dpbooking/index';
		$this->render_dp();
	}

	function view($room_id = null){

		if($room_id == null){
			$room_id = $this->global_data['default_dp_room'];
		}

		$data['title'] = "Booking view";

		$data['cssSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.3'
		);

		$data['jsSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js',
			'assets/js/dusitplace/dp-booking-view.js'
		);

		$room_conditions = array(
			'id' => $room_id
		);
		$data['room'] = $this->Dproom_model->list(array('conditions'=> $room_conditions ));

		$this->data = $data;
		$this->content = 'dpbooking/view';
		$this->render_dp();
	}

	function form($id = null){
		$data['title'] = "Booking form";

		$data['cssSrc'] = array();

		$data['jsSrc'] = array(
			'assets/js/dusitplace/dp-booking-init.js',
			'assets/js/dusitplace/dp-booking-form.js',
			'assets/vendors/jquery-validation/dist/jquery.validate.min.js'
		);

		if($id != null){

			$conditions = array(
				'id'=> $id
			);
			$data['booking'] = $this->Dpbooking_model->list(array('conditions'=>  $conditions))[0];
			$data['form_mode'] = "update";

		}else{

			$data['default_contact'] = $this->User_model->list(array('conditions'=>array('user_id'=>$this->global_data['user_id'])))[0];
			$data['form_mode'] = "insert";
		}

		$this->data = $data;
		$this->content = 'dpbooking/form';
		$this->render_dp();

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
				'billing_name' => $this->input->post('billing_name'),
				'billing_faculty' => $this->input->post('billing_faculty'),
				'internal_phone' => $this->input->post('internal_phone'),
				'event_name' => $this->input->post('event_name'),
				'room_id' => $this->input->post('room_id'),
				'usage_scale' => $this->input->post('usage_scale'),
				'usage_person' => $this->input->post('usage_person'),
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
				'require_staff' => $this->input->post('require_staff'),
				'booking_status' => 'pending',
				'created_at' => $this->global_data['timestamp'],
				'created_by' =>  $this->session->userdata('auth')['displayname'],
				'created_by_ip' => $this->global_data['client_ip']
			);

			$res = $this->Dpbooking_model->save($data);
			if($res != false){
				redirect('dp/list');
			}

		}
		if($this->input->post('form_mode') == "update"){

			$data = array(
				'user_id' => $this->input->post('user_id'),
				'booking_email' => $this->input->post('booking_email'),
				'booking_phone' => $this->input->post('booking_phone'),
				'billing_name' => $this->input->post('billing_name'),
				'billing_faculty' => $this->input->post('billing_faculty'),
				'internal_phone' => $this->input->post('internal_phone'),
				'event_name' => $this->input->post('event_name'),
				'room_id' => $this->input->post('room_id'),
				'usage_format' => $this->input->post('usage_format'),
				'usage_scale' => $this->input->post('usage_scale'),
				'usage_person' => $this->input->post('usage_person'),
				'usage_person' => $this->input->post('usage_person'),
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
				'require_staff' => $this->input->post('require_staff'),
				'booking_status' => 'pending',
				'modified_at' => $this->global_data['timestamp'],
				'modified_by' =>  $this->session->userdata('auth')['displayname'],
				'modified_by_ip' => $this->global_data['client_ip']
			);

			$res = $this->Dpbooking_model->update($this->input->post('form_id'),$data);
			if($res != false){
				redirect('dp/list');
		  	}
		}

	}


	public function list(){
		$data['title'] = "Booking list";

		$data['cssSrc'] = array();

		$data['jsSrc'] = array(
			'assets/js/dusitplace/dp-booking-list.js'
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
		$data['room_info'] = $this->Dproom_model->list(array());

		// $data['rooms'] = $this->db->get('room_master')->result_array();
		$booking_lists = $this->Dpbooking_model->list(array('conditions'=> $conditions));
		$data['booking_lists'] = $booking_lists;
		$data['criterias'] = $criterias;

		// print_r($booking_lists);

		// header('Content-Type: application/json');
		// echo json_encode($data);

		$this->data = $data;
		$this->content = 'dpbooking/list';
		$this->render_dp();
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
			$booking_lists = $this->Dpbooking_model->check_freeroom_list(array('conditions'=> $conditions));

			header('Content-Type: application/json');
			echo json_encode($booking_lists);
	}

	public function event_update(){


		// if($this->input->post('action') == "drag"){}

		$conditions = array(
			'id'=>$this->input->post('id')
		);
		$booking = $this->Dpbooking_model->list(array('conditions'=>  $conditions));
		if($booking[0]["booking_status"] == "pending"){

			$data = array(
				'booking_date_start' => $this->input->post('booking_date_start'),
				'booking_date_end' => $this->input->post('booking_date_end'),
				'modified_at' => $this->global_data['timestamp'],
				'modified_by' =>  $this->session->userdata('auth')['displayname'],
				'modified_by_ip' => $this->global_data['client_ip']
			);

			$event_update_result = $this->Dpbooking_model->update($this->input->post('id'),$data);

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

		$booking_lists = $this->Dpbooking_model->list(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> "ผู้จอง:".$booking["name"]." ".$booking["surname"],
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
		$booking_lists = $this->Dpbooking_model->list(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> "ผู้จอง:".$booking["name"]." ".$booking["surname"],
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
		$booking_lists = $this->Dpbooking_model->list(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> "ผู้จอง:".$booking["name"]." ".$booking["surname"],
					"start"=> $datestart->format(DateTime::ATOM),
					"end"=> $dateend->format(DateTime::ATOM)
				);
				array_push($events,$obj);
			}

			header('Content-Type: application/json');
			echo json_encode($events);
		}


	}

	public function view_pending_json(){

		$conditions = array(
			'room_id'=> $this->input->post('room_id'),
			'booking_status' => 'pending',
			'user_id' => $this->session->userdata('auth')['hrcode']
		);
		$booking_lists = $this->Dpbooking_model->list(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> "ผู้จอง:".$booking["name"]." ".$booking["surname"],
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
		$booking_lists = $this->Dpbooking_model->list(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> "ผู้จอง:".$booking["name"]." ".$booking["surname"],
					"start"=> $datestart->format(DateTime::ATOM),
					"end"=> $dateend->format(DateTime::ATOM)
				);
				array_push($events,$obj);
			}

			header('Content-Type: application/json');
			echo json_encode($events);
		}

	}


	function get_booking_info($id){

		$conditions = array(
			'id' => $id
		);
		$res = $this->Dpbooking_model->list(array('conditions'=>$conditions));

		header('Content-Type: application/json');
    	echo json_encode($res);

	}


	public function get_usage_scale($room_id)
	{
	  $query = $this->db->get_where('dp_room_scale', array('room_id'=> $room_id));
	  header('Content-Type: application/json');
	  echo json_encode($query->result());
	}

	public function get_usage_format($room_scale_id)
	{
	  $query = $this->db->get_where('dp_room_scale', array('id'=> $room_scale_id));
	  $results = $query->result_array();
	//   return json_decode($results[0]["room_format"], true);

	 header('Content-Type: application/json');
     echo json_encode(json_decode($results[0]["room_format"], true));

	}


	function home(){
		$this->set_active_menu('100');

		$data['title'] = "Home";
		$this->data = $data;
		$this->content = 'home/index-dp';
		$this->render_dp();
	}

	function room_info(){

		$this->set_active_menu('200');

		$data['title'] = "Room info";
		$this->data = $data;
		$this->content = 'dproom/index';
		$this->render_dp();
	}


}
