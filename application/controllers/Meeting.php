<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meeting extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Mtbooking_model');
		$this->load->model('User_model');
		$this->load->model('Mtroom_model');
		// $this->load->library('encryption');

        if(! $this->session->userdata('auth')['uid'])
        {
          $allowed = array('view_json','check_free_room','debug','debug_freeroom');
          if(! in_array($this->router->fetch_method(), $allowed))
          {
            redirect('meetingbackoffice');
          }
		}


		if($this->session->userdata('auth')['role'] == "delegate_admin" or $this->session->userdata('auth')['role'] == "admin"){

			if (in_array("online", $this->session->userdata('auth')['manage_app'])) {
				$this->set_active_menu('500');
			}else{
				$this->set_active_menu('300');
			}

		}else{
			$this->set_active_menu('300');
		}


	}



	function index(){
		$data['title'] = "Meeting Room";
		$this->data = $data;
		$this->content = 'meeting/index';
		$this->render_mt();
	}

	function home(){
		$this->set_active_menu('100');

		$data['title'] = "หน้าแรก";
		$this->data = $data;
		$this->content = 'home/index-mt';
		$this->render_mt();
	}

	function view($room_id = "401"){

		$this->set_active_menu('300');

		$data['title'] = "มุมมองปฏิทิน ห้องประชุม";

		$data['cssSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.3'
		);

		$data['jsSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js',
			'assets/js/meeting/mt-booking-view.js'
		);

		$room_conditions = array(
			'id' => $room_id
		);
		$data['room'] = $this->Mtroom_model->list(array('conditions'=> $room_conditions ));

		$this->data = $data;
		$this->content = 'meeting/view';
		$this->render_mt();
	}

	function form($id = null){

		$this->set_active_menu('300');

		$data['title'] = "จองห้องประชุม";

		$data['cssSrc'] = array();

		$data['jsSrc'] = array(
			'assets/js/meeting/mt-booking-form.js',
			'assets/vendors/jquery-validation/dist/jquery.validate.min.js'
		);

		if($id != null){

			$conditions = array(
				'id'=> $id
			);
			$data['booking'] = $this->Mtbooking_model->list(array('conditions'=>  $conditions))[0];
			$data['form_mode'] = "update";

		}else{ 

			$data['default_contact'] = $this->User_model->list(array('conditions'=>array('user_id'=>$this->global_data['user_id'])))[0];
			$data['form_mode'] = "insert";
		}

		$this->data = $data;
		$this->content = 'meeting/form';
		$this->render_mt();

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
				'usage_software' => $this->input->post('usage_software'),
				'objective' => $this->input->post('objective'),
				'booking_date_start' => $this->input->post('booking_date_start'),
				'booking_date_end' => $this->input->post('booking_date_end'),
				'booking_status' => 'pending',
				'created_at' => $this->global_data['timestamp'],
				'created_by' =>  $this->session->userdata('auth')['displayname'],
				'created_by_ip' => $this->global_data['client_ip']
			);

			$res = $this->Mtbooking_model->save($data);
			if($res != false){
				redirect('meeting/list');
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
				'usage_software ' => $this->input->post('usage_software '),
				'objective' => $this->input->post('objective'),
				'booking_date_start' => $this->input->post('booking_date_start'),
				'booking_date_end' => $this->input->post('booking_date_end'),
				'booking_status' => 'pending',
				'modified_at' => $this->global_data['timestamp'],
				'modified_by' =>  $this->session->userdata('auth')['displayname'],
				'modified_by_ip' => $this->global_data['client_ip']
			);

			$res = $this->Mtbooking_model->update($this->input->post('form_id'),$data);
			if($res != false){
				redirect('meeting/list');
		  	}
		}

	}

	public function list(){
		$this->set_active_menu('300');

		$data['title'] = "รายการจองห้อง Online";

		$data['cssSrc'] = array();

		$data['jsSrc'] = array(
			'assets/js/meeting/mt-booking-list.js'
		);

		if($this->input->post('md_search') == '1'){

			$search_date_start = $this->input->post('start');
			$search_date_end = $this->input->post('end');

			$criterias = array(

				'room_id' => $this->input->post('bm_search_room'),
				'booking_status' => $this->input->post('bm_search_status'),
				'booking_date_start' => $search_date_start,
				'booking_date_end' => $search_date_end,
				'user_id' => $this->global_data['user_id'],
				'not_user_id' => $this->global_data['user_id']
			);


		}else{

			$next14day = strtotime("+14 day");
			$search_date_start = date("d/m/Y");
			$search_date_end = date("d/m/Y",$next14day);

			$criterias = array(
				'room_id' => "",
				'booking_status' => "",
				'booking_date_start' => $search_date_start,
				'booking_date_end' => $search_date_end,
				'user_id' => $this->global_data['user_id'],
				'not_user_id' => $this->global_data['user_id']
			);

		}


		$conditions = array(
			'user_id'=>$this->global_data['user_id']
		);
		$data['room_info'] = $this->Mtroom_model->list(array());

		// $data['rooms'] = $this->db->get('room_master')->result_array();
		$booking_lists = $this->Mtbooking_model->list_by_user(array('conditions'=> $criterias));
		$data['booking_lists'] = $booking_lists;
		$data['criterias'] = $criterias;

		$this->data = $data;
		$this->content = 'meeting/list';
		$this->render_mt();
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

			$booking_lists = $this->Mtbooking_model->check_freeroom_list(array('conditions'=> $conditions));

			header('Content-Type: application/json');
			echo json_encode($booking_lists);
	}

	public function event_update(){


		// if($this->input->post('action') == "drag"){}

		$conditions = array(
			'id'=>$this->input->post('id')
		);
		$booking = $this->Mtbooking_model->list(array('conditions'=>  $conditions));
		if($booking[0]["booking_status"] == "pending"){

			$data = array(
				'booking_date_start' => $this->input->post('booking_date_start'),
				'booking_date_end' => $this->input->post('booking_date_end'),
				'modified_at' => $this->global_data['timestamp'],
				'modified_by' =>  $this->session->userdata('auth')['displayname'],
				'modified_by_ip' => $this->global_data['client_ip']
			);

			$event_update_result = $this->Mtbooking_model->update($this->input->post('id'),$data);

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

		$calendar_start =  $this->input->post('start');
		$calendar_end = $this->input->post('end');

		$calendar_start_criteria = date('Y-m-d', strtotime(substr($calendar_start,0,10)));
		$calendar_end_criteria = date('Y-m-d', strtotime(substr($calendar_end,0,10)));

		$conditions = array(
			'room_id'=> $this->input->post('room_id'),
			'booking_status' => 'approved',
			'calendar_start' => $calendar_start_criteria,
			'calendar_end' => $calendar_end_criteria
		);

		$booking_lists = $this->Mtbooking_model->list(array('conditions'=>  $conditions));

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

		$calendar_start =  $this->input->post('start');
		$calendar_end = $this->input->post('end');

		$calendar_start_criteria = date('Y-m-d', strtotime(substr($calendar_start,0,10)));
		$calendar_end_criteria = date('Y-m-d', strtotime(substr($calendar_end,0,10)));

		$conditions = array(
			'room_id'=> $this->input->post('room_id'),
			'booking_status' => 'pending',
			'calendar_start' => $calendar_start_criteria,
			'calendar_end' => $calendar_end_criteria
		);
		$booking_lists = $this->Mtbooking_model->list(array('conditions'=>  $conditions));

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

		$calendar_start =  $this->input->post('start');
		$calendar_end = $this->input->post('end');

		$calendar_start_criteria = date('Y-m-d', strtotime(substr($calendar_start,0,10)));
		$calendar_end_criteria = date('Y-m-d', strtotime(substr($calendar_end,0,10)));

		$conditions = array(
			'room_id'=> $this->input->post('room_id'),
			'booking_status' => 'approved',
			'user_id' => $this->session->userdata('auth')['hrcode'],
			'calendar_start' => $calendar_start_criteria,
			'calendar_end' => $calendar_end_criteria
		);
		// $data['rooms'] = $this->db->get('room_master')->result_array();
		$booking_lists = $this->Mtbooking_model->list(array('conditions'=>  $conditions));

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

		$calendar_start =  $this->input->post('start');
		$calendar_end = $this->input->post('end');

		$calendar_start_criteria = date('Y-m-d', strtotime(substr($calendar_start,0,10)));
		$calendar_end_criteria = date('Y-m-d', strtotime(substr($calendar_end,0,10)));


		$conditions = array(
			'room_id'=> $this->input->post('room_id'),
			'booking_status' => 'pending',
			'user_id' => $this->session->userdata('auth')['hrcode'],
			'calendar_start' => $calendar_start_criteria,
			'calendar_end' => $calendar_end_criteria
		);
		$booking_lists = $this->Mtbooking_model->list(array('conditions'=>  $conditions));

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

		$calendar_start =  $this->input->post('start');
		$calendar_end = $this->input->post('end');

		$calendar_start_criteria = date('Y-m-d', strtotime(substr($calendar_start,0,10)));
		$calendar_end_criteria = date('Y-m-d', strtotime(substr($calendar_end,0,10)));


		$conditions = array(
			'room_id'=> $this->input->post('room_id'),
			'booking_status' => 'approved',
			'not_user_id' => $this->session->userdata('auth')['hrcode'],
			'calendar_start' => $calendar_start_criteria,
			'calendar_end' => $calendar_end_criteria
		);
		// print_r($conditions);
		// $data['rooms'] = $this->db->get('room_master')->result_array();
		$booking_lists = $this->Mtbooking_model->list(array('conditions'=>  $conditions));

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

	public function debug(){
		// $conditions = array(
		// 	'free_date_end'=> '2021-10-01 11:10',
		// 	'free_date_start'=> '2021-10-01 08:40',
		// 	'room_id'=> '01'
		// );
		// $booking_lists = $this->Mtbooking_model->check_freeroom_list(array('conditions'=> $conditions));

		//--working hours
		$start = '07:00:00';
		$end = '08:00:00';
		$start = strtotime($start);
		$end = strtotime($end);

		//--end-start divided by 300 sec to create a 5 min block
		$timesegments = ($end-$start)/300;
		$block=array_fill_keys(range(0,$timesegments,5),0);

		//-- an appointment
		$app_start = '07:30:00';
		$app_end = '09:30:00';

		$obj['stt_start'] = $start;
		$obj['stt_end'] = $end;
		$obj['timesegments'] = $timesegments;
		$obj['stt_app_start'] = strtotime($app_start);
		$obj['stt_app_end'] = strtotime($app_end);

		//-- make 5 minute blocks (note that workday start is 0!)
		$app_start = (strtotime($app_start)-$start)/300;
		$app_end = (strtotime($app_end)-$start)/300;


		//-- put it in the blocks-array (+2 for 10 minute break)
		for($i = $app_start; $i<$app_end+2; ++$i){
			$block[$i] = 1;
			$iloop[$i] = $i;
		}


		$obj['block'] = $block;
		$obj['iloop'] = $iloop;

		header('Content-Type: application/json');
		echo json_encode($obj);

		// echo '<pre>'. print_r($block, true).'</pre>';
	}


	public function debug_freeroom(){

		// $conditions = array(
		// 	'free_date_end'=> '2021-07-20 08:00',
		// 	'free_date_start'=> '2021-07-20 12:00',
		// 	'room_id'=> '01'
		// );
		// $booking_lists = $this->Mtbooking_model->check_freeroom_list(array('conditions'=> $conditions));


		$booking_date_start = '2021-10-01';
		$booking_date_end = '2021-10-01';
		$conditions = array(

			'calendar_start' => $booking_date_start,
			'calendar_end' => $booking_date_end,
			'booking_status' => 'approved',
			'room_id'=> '01'
		);

		$booking_lists = $this->Mtbooking_model->list(array('conditions'=> $conditions));
		// 	'free_date_start'=> '2021-07-20 12:00',
		// date('Y-m-d', strtotime($params['conditions']['calendar_start']))

		header('Content-Type: application/json');
		echo json_encode($booking_lists);
	}
	function room_info(){

		$this->set_active_menu('200');

		$data['title'] = "รายละเอียดห้อง Online";
		$data['cssSrc'] = array(
			'assets/vendors/ekko-lightbox/ekko-lightbox.css'
		);
		$data['jsSrc'] = array(
			'assets/vendors/ekko-lightbox/ekko-lightbox.min.js',
			'assets/js/meeting/mt-room-info.js'
		);
		$data['rooms'] = $this->Mtroom_model->list(array('conditions'=>  array()));

		// header('Content-Type: application/json');
		// echo json_encode($data);
		$this->data = $data;
		$this->content = 'room/index-mt';
		$this->render_mt();

		// json_decode($user[0]["control_room_grant"], true)
	}

}
