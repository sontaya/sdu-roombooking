<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Space extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Spbooking_model');
		$this->load->model('User_model');
		$this->load->model('Sproom_model');
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
		$data['title'] = "Space";
		// $data['subheader_title'] = "ยินดีต้อนรับ ".$this->session->userdata('displayname');
		// $data['subheader_desc'] = "";
		// $data['active_tab'] = 'dashboard';

		$this->data = $data;
		$this->content = 'space/index';
		$this->render_sp();
	}

	function view($room_id = null){

		if($room_id == null){
			$room_id = $this->global_data['default_sp_room'];
		}

		$data['title'] = "Booking view";

		$data['cssSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.3'
		);

		$data['jsSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js',
			'assets/js/space/sp-booking-view.js'
		);

		$room_conditions = array(
			'id' => $room_id
		);
		$data['room'] = $this->Sproom_model->list(array('conditions'=> $room_conditions ));

		$room_master_conditions1 = array(
			'active' => 'Y',
			'room_in' => $this->session->userdata('auth')['manage_room']
		);
		$data['room_info1'] = $this->Sproom_model->list(array('conditions'=> $room_master_conditions1));


		$this->data = $data;
		$this->content = 'space/view';
		$this->render_sp();
	}

	function view_event(){

		$data['title'] = "Booking view event";

		$data['cssSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.3'
		);

		$data['jsSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js',
			'assets/js/space/sp-booking-view-event.js'
		);


		$this->data = $data;
		$this->content = 'space/view_event';
		$this->render_sp();
	}

	public function list(){
		$data['title'] = "Booking list";

		$data['cssSrc'] = array();

		$data['jsSrc'] = array(
			'assets/js/space/sp-booking-list.js'
		);

		if($this->input->post('md_search') == '1'){

			$search_date_start = $this->input->post('start');
			$search_date_end = $this->input->post('end');

			$criterias = array(

				'place_id' => $this->input->post('bm_search_room'),
				'booking_status' => $this->input->post('bm_search_status'),
				'booking_date_start' => $search_date_start,
				'booking_date_end' => $search_date_end
			);


		}else{

			$next14day = strtotime("+14 day");
			$search_date_start = date("d/m/Y");
			$search_date_end = date("d/m/Y",$next14day);

			$criterias = array(
				'place_id' => "",
				'booking_status' => "",
				'booking_date_start' => $search_date_start,
				'booking_date_end' => $search_date_end
			);

		}


		$conditions = array(
			'user_id'=>$this->global_data['user_id']
		);
		$data['room_info'] = $this->Sproom_model->list(array());

		// $data['rooms'] = $this->db->get('room_master')->result_array();
		$booking_lists = $this->Spbooking_model->list(array('conditions'=> $criterias));
		$data['booking_lists'] = $booking_lists;
		$data['criterias'] = $criterias;

		// print_r($booking_lists);

		// header('Content-Type: application/json');
		// echo json_encode($data);

		$this->data = $data;
		$this->content = 'space/list';
		$this->render_sp();
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
			$booking_lists = $this->Spbooking_model->check_freeroom_list(array('conditions'=> $conditions));

			header('Content-Type: application/json');
			echo json_encode($booking_lists);
	}

	public function event_update(){


		// if($this->input->post('action') == "drag"){}

		$conditions = array(
			'id'=>$this->input->post('id')
		);
		$booking = $this->Spbooking_model->list(array('conditions'=>  $conditions));
		if($booking[0]["booking_status"] == "pending"){

			$data = array(
				'booking_date_start' => $this->input->post('booking_date_start'),
				'booking_date_end' => $this->input->post('booking_date_end'),
				'modified_at' => $this->global_data['timestamp'],
				'modified_by' =>  $this->session->userdata('auth')['displayname'],
				'modified_by_ip' => $this->global_data['client_ip']
			);

			$event_update_result = $this->Spbooking_model->update($this->input->post('id'),$data);

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
			'place_id'=> $this->input->post('place_id'),
			'booking_status' => 'approved'
		);

		$booking_lists = $this->Spbooking_model->list_place(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> "กิจกรรม:".$booking["event_name"],
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
		$booking_lists = $this->Spbooking_model->list_place(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> "กิจกรรม:".$booking["event_name"],
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


		$conditions = array(
			'place_id'=> $this->input->post('place_id'),
			'booking_status' => 'approved',
			'service_user_id' => $this->session->userdata('auth')['hrcode']
		);

		$booking_lists = $this->Spbooking_model->list_place(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> "กิจกรรม:".$booking["event_name"],
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
			'place_id'=> $this->input->post('place_id'),
			'booking_status' => 'pending',
			'service_user_id' => $this->session->userdata('auth')['hrcode']
		);

		$booking_lists = $this->Spbooking_model->list_place(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> "กิจกรรม:".$booking["event_name"],
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


		$conditions = array(
			'place_id'=> $this->input->post('place_id'),
			'booking_status' => 'approved',
			'non_service_user_id' => $this->session->userdata('auth')['hrcode']
		);

		$booking_lists = $this->Spbooking_model->list_place(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> "กิจกรรม:".$booking["event_name"],
					"start"=> $datestart->format(DateTime::ATOM),
					"end"=> $dateend->format(DateTime::ATOM)
				);
				array_push($events,$obj);
			}

			header('Content-Type: application/json');
			echo json_encode($events);
		}

	}


	public function view_all_approved_event_json(){


		$conditions = array(
			'booking_status' => 'approved'
		);

		$booking_lists = $this->Spbooking_model->list(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> "กิจกรรม:".$booking["event_name"],
					"start"=> $datestart->format(DateTime::ATOM),
					"end"=> $dateend->format(DateTime::ATOM)
				);
				array_push($events,$obj);
			}

			header('Content-Type: application/json');
			echo json_encode($events);
		}

	}

	public function view_all_pending_event_json(){

		$conditions = array(
			'booking_status' => 'pending'
		);
		$booking_lists = $this->Spbooking_model->list(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> "กิจกรรม:".$booking["event_name"],
					"start"=> $datestart->format(DateTime::ATOM),
					"end"=> $dateend->format(DateTime::ATOM)
				);
				array_push($events,$obj);
			}

			header('Content-Type: application/json');
			echo json_encode($events);
		}

	}

	public function view_staff_approved_event_json(){

		$conditions = array(
			'booking_status' => 'approved',
			'service_user_id' => $this->session->userdata('auth')['hrcode']
		);

		$booking_lists = $this->Spbooking_model->list_place(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> "กิจกรรม:".$booking["event_name"],
					"start"=> $datestart->format(DateTime::ATOM),
					"end"=> $dateend->format(DateTime::ATOM)
				);
				array_push($events,$obj);
			}

			header('Content-Type: application/json');
			echo json_encode($events);
		}

	}

	public function view_otherstaff_approved_event_json(){

		$conditions = array(
			'booking_status' => 'approved',
			'non_service_user_id' => $this->session->userdata('auth')['hrcode']
		);

		$booking_lists = $this->Spbooking_model->list_place(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> "กิจกรรม:".$booking["event_name"],
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
		$res = $this->Spbooking_model->list(array('conditions'=>$conditions));

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
		$this->content = 'home/index-sp';
		$this->render_sp();
	}

	function room_info(){

		// $this->set_active_menu('200');

		// $data['title'] = "Room info";
		// $this->data = $data;
		// $this->content = 'dproom/index';
		// $this->render_sp();
	}

	function debug(){
		$conditions = array(
			'place_id'=> '501',
			'booking_status' => 'approved',
			'non_service_user_id' =>'2010-080'
		);

		$booking_lists = $this->Spbooking_model->list_place(array('conditions'=>  $conditions));

		if($booking_lists !== false){
			$events = array();
			foreach ($booking_lists as $booking) {

				$datestart = new DateTime($booking["booking_date_start"]);
				$dateend = new DateTime($booking["booking_date_end"]);
				$obj = array(
					"id"=> $booking["id"],
					"title"=> "กิจกรรม:".$booking["event_name"],
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
