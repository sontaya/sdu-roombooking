<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spacebackoffice extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model('Spbooking_model');
		$this->load->model('Sproom_model');
		$this->load->model('User_model');
		// $this->load->library('encryption');

        if(! $this->session->userdata('auth')['uid'])
        {
          $allowed = array('test_api');
          if(! in_array($this->router->fetch_method(), $allowed))
          {
            redirect('user/login');
          }
		}

		$this->set_active_menu('500');


	}

	function index(){
		redirect('spacebackoffice/booking_manage');
	}

	function form_admin($id = null){
		$data['title'] = "Booking by Admin";

		$data['cssSrc'] = array();

		$data['jsSrc'] = array(
			'assets/js/space/sp-booking-init.js',
			'assets/js/space/sp-backoffice-form-admin.js',
			'assets/vendors/jquery-validation/dist/jquery.validate.min.js'
		);

		$data['place_info'] = $this->Sproom_model->place_list(array('conditions'=> array()));
		$data['service_info'] = $this->Sproom_model->service_list(array('conditions'=> array()));
		$data['arit_members'] = $this->User_model->list_arit_member(array('conditions'=> array()));

		if($id != null){

			$conditions = array(
				'id'=> $id
			);
			$data['booking'] = $this->Spbooking_model->list(array('conditions'=>  $conditions))[0];

			// Get selected spaces for this booking
			$this->db->select('place_id');
			$this->db->from('sp_booking_place');
			$this->db->where('booking_id', $id);
			$selected_spaces = $this->db->get()->result_array();

			// Convert to simple array of place_ids
            $data['selected_spaces'] = array_column($selected_spaces, 'place_id');


			// Get selected staff for this booking
			$this->db->select('user_id');
			$this->db->from('sp_booking_staff');
			$this->db->where('booking_id', $id);
			$selected_staff = $this->db->get()->result_array();

			// Convert to simple array of user_ids
			$data['selected_staff'] = array_column($selected_staff, 'user_id');

			// Get selected service for this booking
			$this->db->select('service_id');
			$this->db->from('sp_booking_service');
			$this->db->where('booking_id', $id);
			$selected_service = $this->db->get()->result_array();

			// Convert to simple array of service_ids
			$data['selected_service'] = array_column($selected_service, 'service_id');

			$data['form_mode'] = "update";

		}else{
			$data['selected_spaces'] = array();
			$data['selected_staff'] = array();
			$data['form_mode'] = "insert";
		}

		$this->data = $data;
		$this->content = 'spacebackoffice/form_admin';
		$this->render_sp();

		// header('Content-Type: application/json');
    	// echo json_encode($data);
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

            // Begin transaction
            $this->db->trans_start();

            $data = array(
                'user_id' => $this->input->post('user_id'),
                'booking_email' => $this->input->post('booking_email'),
                'booking_phone' => $this->input->post('booking_phone'),
                'internal_phone' => $this->input->post('internal_phone'),
                'event_name' => $this->input->post('event_name'),
                'event_note' => $this->input->post('event_note'),
                'room_id' => $this->input->post('room_id'),
                'usage_person' => $this->input->post('usage_person'),
                'booking_date_start' => $this->input->post('booking_date_start'),
                'booking_date_end' => $this->input->post('booking_date_end'),
                'require_staff' => $this->input->post('require_staff'),
                'booking_status' => $this->input->post('booking_status'),
                'created_at' => $this->global_data['timestamp'],
                'created_by' => $this->session->userdata('auth')['displayname'],
                'created_by_ip' => $this->global_data['client_ip']
            );

            // Insert main booking record
            $booking_id = $this->Spbooking_model->save($data);

            // Handle multiple space selections
            $space_ids = $this->input->post('space_id');
            if ($booking_id && !empty($space_ids)) {
                $space_data = array();
                foreach ($space_ids as $space_id) {
                    $space_data[] = array(
                        'booking_id' => $booking_id,
                        'place_id' => $space_id
                    );
                }
                // Batch insert space bookings
                if (!empty($space_data)) {
                    $this->db->insert_batch('sp_booking_place', $space_data);
                }
            }


			// Handle staff selections from dual-listbox
			$selected_staff = $this->input->post('selected_staff'); // Array of selected user IDs
			if ($booking_id && !empty($selected_staff)) {
				$staff_data = array();
				foreach ($selected_staff as $user_id) {
					$staff_data[] = array(
						'booking_id' => $booking_id,
						'user_id' => $user_id
					);
				}
				// Batch insert staff bookings
				if (!empty($staff_data)) {
					$this->db->insert_batch('sp_booking_staff', $staff_data);
				}
			}


				// Handle multiple service selections
				$service_ids = $this->input->post('service_info');
				if ($booking_id && !empty($service_ids)) {
					$service_data = array();
					foreach ($service_ids as $service_info) {
						$service_data[] = array(
							'booking_id' => $booking_id,
							'service_id' => $service_info
						);
					}
					// Batch insert service bookings
					if (!empty($service_data)) {
						$this->db->insert_batch('sp_booking_service', $service_data);
					}
				}


            // Complete transaction
            $this->db->trans_complete();


			if($booking_id != false){
				redirect('spacebackoffice/booking_manage');
		  	}

		}
		if($this->input->post('form_mode') == "update"){

            // Begin transaction
            $this->db->trans_start();

            $data = array(
                'user_id' => $this->input->post('user_id'),
                'booking_email' => $this->input->post('booking_email'),
                'booking_phone' => $this->input->post('booking_phone'),
                'internal_phone' => $this->input->post('internal_phone'),
                'event_name' => $this->input->post('event_name'),
                'event_note' => $this->input->post('event_note'),
				'usage_person' => $this->input->post('usage_person'),
                'room_id' => $this->input->post('room_id'),
                'booking_date_start' => $this->input->post('booking_date_start'),
                'booking_date_end' => $this->input->post('booking_date_end'),
                'require_staff' => $this->input->post('require_staff'),
                'booking_status' => $this->input->post('booking_status'),
                'modified_at' => $this->global_data['timestamp'],
                'modified_by' => $this->session->userdata('auth')['displayname'],
                'modified_by_ip' => $this->global_data['client_ip']
            );

            $booking_id = $this->input->post('form_id');

            // Update main booking record
            $res = $this->Spbooking_model->update($booking_id, $data);

            // Handle multiple space selections for update
            if ($res) {
                // Delete existing space bookings
                $this->db->where('booking_id', $booking_id);
                $this->db->delete('sp_booking_place');

                // Insert new space bookings
                $space_ids = $this->input->post('space_id');
                if (!empty($space_ids)) {
                    $space_data = array();
                    foreach ($space_ids as $space_id) {
                        $space_data[] = array(
                            'booking_id' => $booking_id,
                            'place_id' => $space_id
                        );
                    }
                    if (!empty($space_data)) {
                        $this->db->insert_batch('sp_booking_place', $space_data);
                    }
                }


				// Handle staff selections update
				// First, delete existing staff assignments
				$this->db->where('booking_id', $booking_id);
				$this->db->delete('sp_booking_staff');

				// Then insert new staff assignments
				$selected_staff = $this->input->post('selected_staff');
				if (!empty($selected_staff)) {
					$staff_data = array();
					foreach ($selected_staff as $user_id) {
						$staff_data[] = array(
							'booking_id' => $booking_id,
							'user_id' => $user_id
						);
					}
					if (!empty($staff_data)) {
						$this->db->insert_batch('sp_booking_staff', $staff_data);
					}
				}


				$this->db->where('booking_id', $booking_id);
				$this->db->delete('sp_booking_service');
				// Handle multiple service selections
				$service_ids = $this->input->post('service_info');
				if ($booking_id && !empty($service_ids)) {
					$service_data = array();
					foreach ($service_ids as $service_info) {
						$service_data[] = array(
							'booking_id' => $booking_id,
							'service_id' => $service_info
						);
					}
					// Batch insert service bookings
					if (!empty($service_data)) {
						$this->db->insert_batch('sp_booking_service', $service_data);
					}
				}
            }

            // Complete transaction
            $this->db->trans_complete();

			$res = $this->Spbooking_model->update($this->input->post('form_id'),$data);
			if($res != false){
				redirect('spacebackoffice/booking_manage');
		  	}
			//   header('Content-Type: application/json');
			//   echo json_encode($data);
		}

	}

	function booking_manage(){
		//
		$data['title'] = "Booking Manage";

		$data['jsSrc'] = array(
			'assets/js/space/sp-backoffice-init.js',
			'assets/js/space/sp-backoffice-booking-manage.js'
		);

		if($this->input->post('md_search') == '1'){

			$search_date_start = $this->input->post('start');
			$search_date_end = $this->input->post('end');

			$criterias = array(
				'user_role' => $this->session->userdata('auth')['role'],
				'place_id' => $this->input->post('bm_search_room'),
				'room_in' => $this->session->userdata('auth')['manage_room'],
				'booking_status' => $this->input->post('bm_search_status'),
				'booking_date_start' => $search_date_start,
				'booking_date_end' => $search_date_end
			);


		}else{

			$next7day = strtotime("+15 day");
			$search_date_start = date("d/m/Y");
			$search_date_end = date("d/m/Y",$next7day);

			$criterias = array(
				'user_role' => $this->session->userdata('auth')['role'],
				'room_in' => $this->session->userdata('auth')['manage_room'],
				'place_id' => "",
				'booking_status' => "",
				'booking_date_start' => $search_date_start,
				'booking_date_end' => $search_date_end
			);

		}

		$room_master_conditions = array(
			'active' => 'Y',
			'room_in' => $this->session->userdata('auth')['manage_room']
		);
		$data['room_info'] = $this->Sproom_model->list(array('conditions'=> $room_master_conditions));

		$data['criterias'] = $criterias;
		$data['booking_lists'] = $this->Spbooking_model->list(array('conditions'=> $criterias));
		$this->data = $data;
		$this->content = 'spacebackoffice/manage_booking';
		$this->render_sp();

		// header('Content-Type: application/json');
		// echo json_encode($data['criterias']);

	}

	function booking_calendar($room_id = null){

		if($room_id == null){
			$room_id = $this->global_data['default_sp_room'];
		}

		$data['title'] = "calendar view";
		$data['cssSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.3'
		);

		$data['jsSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js',
			'assets/js/space/sp-backoffice-init.js',
			'assets/js/space/sp-backoffice-booking-calendar.js'
		);

		//--Begin:: รายละเอียดห้อง
			$room_conditions = array(
				'id' => $room_id
			);
			$data['room'] = $this->Sproom_model->list(array('conditions'=> $room_conditions ));

		//--End:: รายละเอียดห้อง


		//--Begin:: เงื่อนไขในการเลือกห้อง

			$room_master_conditions1 = array(
				'active' => 'Y',
				'room_in' => $this->session->userdata('auth')['manage_room']
			);
			$data['room_info1'] = $this->Sproom_model->list(array('conditions'=> $room_master_conditions1));


		//--End:: เงื่อนไขในการเลือกห้อง


		$this->data = $data;

		$this->content = 'spacebackoffice/manage_booking_calendar';
		$this->render_sp();

		// header('Content-Type: application/json');
    	// echo json_encode($data);
	}

	function booking_calendar_event(){



		$data['title'] = "calendar event view";
		$data['cssSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.3'
		);

		$data['jsSrc'] = array(
			'assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js',
			'assets/js/space/sp-backoffice-init.js',
			'assets/js/space/sp-backoffice-booking-calendar-event.js'
		);

		$this->data = $data;

		$this->content = 'spacebackoffice/manage_booking_calendar_event';
		$this->render_sp();

		// header('Content-Type: application/json');
    	// echo json_encode($data);
	}

	function get_booking_request(){

		if($_POST){
			$data['params'] = $_POST["query"];

			$lists = $this->Spbooking_model->list(array('conditions'=>  $_POST["query"]));


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

			$lists = $this->Spbooking_model->list();
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

		$res = $this->Spbooking_model->update($target_id, $data);

		header('Content-Type: application/json');
    	echo json_encode($res);
	}

	function booking_delete(){

		$target_id = $this->input->post('id');

		$res = $this->Spbooking_model->delete($target_id);

		header('Content-Type: application/json');
    	echo json_encode($res);
	}

	function get_booking_info($id){

		$conditions = array(
			'id' => $id
		);
		$res = $this->Spbooking_model->list(array('conditions'=>$conditions));

		header('Content-Type: application/json');
    	echo json_encode($res);

	}


	function test_api(){
		//
		$data['title'] = "Test API";

		$data['jsSrc'] = array(
			'assets/js/space/sp-backoffice-init.js',
			'assets/js/space/sp-backoffice-api.js'
		);


		$this->data = $data;
		$this->content = 'spacebackoffice/api';
		$this->render_sp();



	}



}
