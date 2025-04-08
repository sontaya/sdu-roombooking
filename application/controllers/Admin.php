<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{

	function __construct()
	{

		header('Access-Control-Allow-Origin: *');
    	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		parent::__construct();

		$this->load->model('User_model');
		$this->load->model('Room_model');
		$this->load->model('Hybridroom_model');
		$this->load->model('Mtroom_model');

        if(! $this->session->userdata('auth')['uid'])
        {
          $allowed = array();
          if(! in_array($this->router->fetch_method(), $allowed))
          {
            redirect('user/login');
          }
		}

	}

	public function index()
	{

		redirect('admin/list');
	}

	function list(){
		//

		$this->set_active_menu('500');

		$data['title'] = "จัดการผู้ดูแลระบบ (Admin)";

		$data['jsSrc'] = array(
			'assets/js/admin-list.js',
		);

		if($this->input->post('do_search') == '1'){

			$conditions = array(
				'role'=> 'delegate_admin',
				'search_key'=> $this->input->post('search_key'),
			);

		}else{

			$conditions = array(
				'role'=> 'delegate_admin',
			);

		}



		$admin_lists = $this->User_model->list_admin(array('conditions'=>  $conditions));
		$data['admin_lists'] = $admin_lists;
		$data['criteria'] = $conditions;


		$this->data = $data;
		$this->content = 'admin/list';
		$this->render_admin();


		// 	header('Content-Type: application/json');
    	// echo json_encode($data);

	}

	function user_edit($user_id){
		$data['title'] = "จัดการสิทธิ (Admin)";

		$data['jsSrc'] = array(
			'assets/js/admin-user.js',
		);

		$conditions = array(
			'role'=> 'delegate_admin',
			'user_id'=> $user_id
		);

		$data['profile'] = $this->User_model->list(array('conditions'=> $conditions ))[0];

		$ol_master_conditions = array();
		$data['room_online_info'] = $this->Room_model->list(array('conditions'=> $ol_master_conditions));
		$data['room_hybrid_info'] = $this->Hybridroom_model->list(array('conditions'=> array()));
		$data['room_meeting_info'] = $this->Mtroom_model->list(array('conditions'=> array()));


		$this->data = $data;
		$this->content = 'admin/edit';
		$this->render_admin();
	}

	function user_revoke($user_id){

		$data = array(
			'role' => null,
			'control_app_grant' =>  null,
			'control_room_grant' =>  null,
			'modified_at' => $this->global_data['timestamp'],
			'modified_by' =>  $this->session->userdata('auth')['displayname'],
			'modified_by_ip' => $this->global_data['client_ip']
		);

		$res = $this->User_model->update($user_id,$data);
		if($res != false){
			redirect('admin/list');
		}

	}

	function user_edit_store(){

		$app_online_array = array();
		$app_hybrid_array = array();
		$app_meeting_array = array();

		$room_online_array = array();
		$room_hybrid_array = array();
		$room_meeting_array = array();

		if($this->input->post('room_online') == ""){
			$room_online = "";
			$app_online_array = array();
		}else{
			$room_online = implode(",",$this->input->post('room_online'));
			$room_online_array = $this->input->post('room_online');
			$app_online_array = array("online");
		}

		if($this->input->post('room_hybrid') == ""){
			$room_hybrid = "";
			$app_hybrid_array = array();
		}else{
			$room_hybrid = implode(",",$this->input->post('room_hybrid'));
			$room_hybrid_array = $this->input->post('room_hybrid');
			$app_hybrid_array = array("hybrid");
		}

		if($this->input->post('room_meeting') == ""){
			$room_meeting = "";
			$app_meeting_array = array();
		}else{
			$room_meeting = implode(",",$this->input->post('room_meeting'));
			$room_meeting_array = $this->input->post('room_meeting');
			$app_meeting_array = array("meeting");
		}

		$room_grant_all = array_merge($room_online_array, $room_hybrid_array, $room_meeting_array);
		$control_app_all = array_merge($app_online_array, $app_hybrid_array, $app_meeting_array);

		// echo json_encode( $room_grant_all);


			$data = array(
				'name' => $this->input->post('name'),
				'surname' => $this->input->post('surname'),
				'mobile_phone_default' => $this->input->post('mobile_phone_default'),
				'internal_phone_default' => $this->input->post('internal_phone_default'),
				'email_default' => $this->input->post('email_default'),
				'control_app_grant' =>  json_encode( $control_app_all),
				'control_room_grant' =>  json_encode( $room_grant_all),
				'modified_at' => $this->global_data['timestamp'],
				'modified_by' =>  $this->session->userdata('auth')['displayname'],
				'modified_by_ip' => $this->global_data['client_ip']
			);

			$res = $this->User_model->update($this->input->post('user_id'),$data);
			if($res != false){
				redirect('admin/list');
		  	}


		// 	header('Content-Type: application/json');
    	// echo json_encode($data);

	}

	function user_promote(){
		$user_id = $this->input->post('user_id');
		$data = array(

			'role' => 'delegate_admin',
			'modified_at' => $this->global_data['timestamp'],
			'modified_by' =>  $this->session->userdata('auth')['displayname'],
			'modified_by_ip' => $this->global_data['client_ip']
		);

		$res = $this->User_model->update($user_id,$data);
		return $res;
		// if($res != false){
		// 	redirect('admin/user_edit/'.$user_id);
		//   }
	}




	function room_list(){
		//

		$this->set_active_menu('500');

		$data['title'] = "จัดการห้อง (Admin)";

		$data['jsSrc'] = array(
			'assets/js/admin-list.js',
		);

		$conditions = array(
			'role'=> 'delegate_admin',
		);
		$admin_lists = $this->User_model->list_admin(array('conditions'=>  $conditions));
		$data['admin_lists'] = $admin_lists;


		$this->data = $data;
		$this->content = 'room/manage';
		$this->render_admin();


		// 	header('Content-Type: application/json');
    	// echo json_encode($data);

	}


	function room_edit($room_id){
		$data['title'] = "จัดการห้อง (Admin)";

		$data['jsSrc'] = array(
			'assets/js/admin-room-edit.js',
		);

		$conditions = array(
			'id'=> $room_id
		);

		if(substr($room_id,0,1) == "3"){
			$data['room_app'] = "HB";
			$data['room'] = $this->Hybridroom_model->list(array('conditions'=> $conditions ))[0];
		}else{
			$data['room_app'] = "OL";
			$data['room'] = $this->Room_model->list(array('conditions'=> $conditions ))[0];
		}


		$this->data = $data;
		$this->content = 'admin/room_edit';
		$this->render_admin();
	}

	function room_edit_store(){

		// $room_online_array = array();
		// $room_hybrid_array = array();

		// if($this->input->post('room_online') == ""){
		// 	$room_online = "";
		// }else{
		// 	$room_online = implode(",",$this->input->post('room_online'));
		// 	$room_online_array = $this->input->post('room_online');
		// }

		// if($this->input->post('room_hybrid') == ""){
		// 	$room_hybrid = "";
		// }else{
		// 	$room_hybrid = implode(",",$this->input->post('room_hybrid'));
		// 	$room_hybrid_array = $this->input->post('room_hybrid');
		// }

		// $room_grant_all = array_merge($room_online_array, $room_hybrid_array);

		// echo json_encode( $room_grant_all);

			$room_app =  $this->input->post('room_app');
			$room_active =  $this->input->post('room_active');
			if($room_active == "Y"){
				$room_active_value = "Y";
			}else{
				$room_active_value = "C";
			}

			$data = array(
				'capacity' => $this->input->post('capacity'),
				'room_desc' => $this->input->post('room_desc'),
				'room_staff' => $this->input->post('room_staff'),
				'active' => $room_active_value,
				'active_desc' => $this->input->post('active_desc'),

			);

			if($room_app == "OL"){
				$res = $this->Room_model->update($this->input->post('room_id'),$data);
			}

			if($room_app == "HB"){
				$res = $this->Hybridroom_model->update($this->input->post('room_id'),$data);
			}

			if($res != false){
				redirect('admin/room_list');
		  	}


	}

	function debug(){

		$conditions = array(
			'user_id'=> '1005-053',
		);

		$rooms = $this->User_model->list_room_grant(array('conditions'=>  $conditions));

		// header('Content-Type: application/json');
		// print_r( json_decode($user[0]["control_room_grant"]));
		// json_decode($user[0]["control_room_grant"], true)
				header('Content-Type: application/json');
    	echo json_encode($rooms);

	}


}
