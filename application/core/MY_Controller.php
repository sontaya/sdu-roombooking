<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
	private $aTemplate = array();
	var $data = array();

	var $global_data;

	function __construct()
	{
		parent::__construct();

		if($this->session->userdata('auth')['role'] == "delegate_admin"){
			$rooms = $this->session->userdata('auth')['manage_room'];
			$default_room = $rooms[0];
			$default_hb_room = $rooms[0];
			$default_dp_room = $rooms[0];
		}else{
			$default_room = "01";
			$default_hb_room = "301";
			$default_dp_room = "201";
		}

		$this->global_data = array(
			'timestamp'=> date('Y-m-d H:i:s'),
			'client_ip' => get_client_ip(),
			'user_id' => $this->session->userdata('auth')['hrcode'],
			'default_room' => $default_room,
			'default_hb_room' => $default_hb_room
		);
	}

	public function set_active_menu($target)
	{
		$sessionmenu = array(
			'active'=> $target
		);
		$this->session->set_userdata('menu',$sessionmenu);
	}

	public function render()
	{
		$this->aTemplate['header'] = $this->load->view('template/header', $this->data, true);
		$this->aTemplate['user_profile'] = $this->load->view('template/user_profile', $this->data, true);
		$this->aTemplate['user_panel'] = $this->load->view('template/user_panel', $this->data, true);
		$this->aTemplate['content'] = $this->load->view($this->content, $this->data, true);
		$this->aTemplate['footer'] = $this->load->view('template/footer', $this->data, true);
		$this->load->view('template/index', $this->aTemplate);
    }

	public function render_nomenu()
	{
		$this->aTemplate['header'] = $this->load->view('template/header', $this->data, true);
		$this->aTemplate['user_profile'] = $this->load->view('template/user_profile', $this->data, true);
		$this->aTemplate['user_panel'] = $this->load->view('template/user_panel', $this->data, true);
		$this->aTemplate['content'] = $this->load->view($this->content, $this->data, true);
		$this->aTemplate['footer'] = $this->load->view('template/footer', $this->data, true);
		$this->load->view('template/index-nomenu', $this->aTemplate);
    }

	public function render_admin()
	{
		$this->aTemplate['header'] = $this->load->view('template/header', $this->data, true);
		$this->aTemplate['user_profile'] = $this->load->view('template/user_profile', $this->data, true);
		$this->aTemplate['user_panel'] = $this->load->view('template/user_panel', $this->data, true);
		$this->aTemplate['content'] = $this->load->view($this->content, $this->data, true);
		$this->aTemplate['footer'] = $this->load->view('template/footer', $this->data, true);
		$this->load->view('template/index-admin', $this->aTemplate);
    }

	public function render_dp()
	{
		$this->aTemplate['header'] = $this->load->view('template/header', $this->data, true);
		$this->aTemplate['user_profile'] = $this->load->view('template/user_profile', $this->data, true);
		$this->aTemplate['user_panel'] = $this->load->view('template/user_panel', $this->data, true);
		$this->aTemplate['content'] = $this->load->view($this->content, $this->data, true);
		$this->aTemplate['footer'] = $this->load->view('template/footer', $this->data, true);
		$this->load->view('template/index-dp', $this->aTemplate);
    }

	public function render_hb()
	{
		$this->aTemplate['header'] = $this->load->view('template/header', $this->data, true);
		$this->aTemplate['user_profile'] = $this->load->view('template/user_profile', $this->data, true);
		$this->aTemplate['user_panel'] = $this->load->view('template/user_panel', $this->data, true);
		$this->aTemplate['content'] = $this->load->view($this->content, $this->data, true);
		$this->aTemplate['footer'] = $this->load->view('template/footer', $this->data, true);
		$this->load->view('template/index-hb', $this->aTemplate);
    }

}
