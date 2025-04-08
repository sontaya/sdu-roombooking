<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Spbooking_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function save($data) {
        $result = $this->db->insert('sp_booking_info', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    function update($id, $data) {
        $this->db->where('id', $id);
        $result = $this->db->update('sp_booking_info', $data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        $result = $this->db->delete('sp_booking_info');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

	public function list($params = array()){
      if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit'],$params['start']);
      }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit']);
      }

	  	$this->db->select('b.*, u.name, u.surname, u.academic_fullname
								, u.name_faculty, u.name_department, u.line_sub, u.line_iat, u.line_exp, b.event_name
								, GROUP_CONCAT(DISTINCT pm.name SEPARATOR " | ") as place_names
								, GROUP_CONCAT(DISTINCT ar.academic_fullname SEPARATOR ", ") AS staff_names
								, GROUP_CONCAT(DISTINCT ar.user_id SEPARATOR ", ") AS staff_ids
								, GROUP_CONCAT(DISTINCT sm.name SEPARATOR ", ") AS service_names
						,(
							case
								when b.booking_status = "approved" then "อนุมัติ"
								when b.booking_status = "rejected" then "ไม่อนุมัติ"
								when b.booking_status = "pending" then "รอการอนุมัติ"
								else ""
							end
						) as booking_status_desc
				', false);
		$this->db->from('sp_booking_info b');
		$this->db->join('rb_users u', 'u.user_id = b.user_id', 'left');
		$this->db->join('sp_booking_place bp', 'b.id = bp.booking_id','left');
		$this->db->join('sp_place_master pm', 'bp.place_id = pm.id','left');
		$this->db->join('sp_booking_staff bs', 'b.id = bs.booking_id','left');
		$this->db->join('sp_booking_service sv', 'b.id = sv.booking_id','left');
		$this->db->join('sp_service_master sm', 'sm.id = sv.service_id','left');
		$this->db->join('rb_users ar', 'bs.user_id = ar.user_id','left');
		$this->db->group_by('b.id, u.user_id');

      if (!empty($params['conditions']['id'])){
        	$this->db->where('b.id', $params['conditions']['id']);
		  }

      if (!empty($params['conditions']['booking_status'])){
        	$this->db->where('b.booking_status', $params['conditions']['booking_status']);
		  }

      if (!empty($params['conditions']['user_id'])){
        	$this->db->where('b.user_id', $params['conditions']['user_id']);
		  }

      if (!empty($params['conditions']['place_id'])){
        	$this->db->where('bp.place_id', $params['conditions']['place_id']);
			}else{
				if (!empty($params['conditions']['room_in'])){
					$this->db->where_in('bp.place_id', $params['conditions']['room_in']);
				}
			}


      	if (!empty($params['conditions']['not_user_id'])){

			$this->db->where_not_in('b.user_id', $params['conditions']['not_user_id']);
		}

		if (!empty($params['conditions']['booking_date_start'])){

			$this->db->where('b.booking_date_start >= ', date2_formatdb($params['conditions']['booking_date_start']));
			$this->db->where('b.booking_date_end <= ', date2_formatdb($params['conditions']['booking_date_end']));

		}

          $this->db->order_by('b.booking_date_start', 'ASC');
        //   $this->db->order_by('FILENAME_PDF', 'ASC');

          $query = $this->db->get();
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
        //  echo $this->db->get_compiled_select();


	}

	public function list_place($params = array()){
      if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit'],$params['start']);
      }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit']);
      }

	  	// $this->db->select('b.*, u.name, u.surname, u.academic_fullname
		// 						, u.name_faculty, u.name_department, u.line_sub, u.line_iat, u.line_exp, b.event_name
		// 						, GROUP_CONCAT(DISTINCT pm.name SEPARATOR " | ") as place_names
		// 						, GROUP_CONCAT(DISTINCT ar.academic_fullname SEPARATOR ", ") AS staff_names
		// 						, GROUP_CONCAT(DISTINCT ar.user_id SEPARATOR ", ") AS staff_ids
		// 						, GROUP_CONCAT(DISTINCT sm.name SEPARATOR ", ") AS service_names
		// 				,(
		// 					case
		// 						when b.booking_status = "approved" then "อนุมัติ"
		// 						when b.booking_status = "rejected" then "ไม่อนุมัติ"
		// 						when b.booking_status = "pending" then "รอการอนุมัติ"
		// 						else ""
		// 					end
		// 				) as booking_status_desc
		// 		', false);
		// $this->db->from('sp_booking_info b');
		// $this->db->join('rb_users u', 'u.user_id = b.user_id', 'left');
		// $this->db->join('sp_booking_place bp', 'b.id = bp.booking_id','left');
		// $this->db->join('sp_place_master pm', 'bp.place_id = pm.id','left');
		// $this->db->join('sp_booking_staff bs', 'b.id = bs.booking_id','left');
		// $this->db->join('sp_booking_service sv', 'b.id = sv.booking_id','left');
		// $this->db->join('sp_service_master sm', 'sm.id = sv.service_id','left');
		// $this->db->join('rb_users ar', 'bs.user_id = ar.user_id','left');
		// $this->db->group_by('b.id, u.user_id');



	  	$this->db->select('*', false);
		$this->db->from('vw_sp_list');

      if (!empty($params['conditions']['id'])){
        	$this->db->where('id', $params['conditions']['id']);
		  }

      if (!empty($params['conditions']['booking_status'])){
        	$this->db->where('booking_status', $params['conditions']['booking_status']);
		  }

      if (!empty($params['conditions']['user_id'])){
        	$this->db->where('user_id', $params['conditions']['user_id']);
	  }

      if (!empty($params['conditions']['service_user_id'])){
        	$this->db->like('staff_ids', $params['conditions']['service_user_id']);
	  }

      if (!empty($params['conditions']['non_service_user_id'])){
        	$this->db->not_like('staff_ids', $params['conditions']['non_service_user_id']);
	  }

      if (!empty($params['conditions']['place_id'])){
        	$this->db->like('place_ids', $params['conditions']['place_id']);
	  }


      	if (!empty($params['conditions']['not_user_id'])){

			$this->db->where_not_in('user_id', $params['conditions']['not_user_id']);
		}


		if (!empty($params['conditions']['booking_date_start'])){

			$this->db->where('booking_date_start >= ', date2_formatdb($params['conditions']['booking_date_start']));
			$this->db->where('booking_date_end <= ', date2_formatdb($params['conditions']['booking_date_end']));

	}


          $this->db->order_by('booking_date_start', 'ASC');

          $query = $this->db->get();
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
        //  echo $this->db->get_compiled_select();


	}


		public function check_freeroom_list($params = array()){
			if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
				$this->db->limit($params['limit'],$params['start']);
			}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
				$this->db->limit($params['limit']);
			}

				$query = $this->db->query("select b.*, rm.room_tag, rm.name as room_name, u.name, u.surname, u.name_faculty, u.name_department
												from sp_booking_info b
													inner join dp_room_master rm on b.room_id = rm.id
													inner join rb_users u on u.user_id = b.user_id
												where booking_status = 'approved'
														and b.room_id = '".$params['conditions']['room_id']."'
														and (
																(b.booking_date_start between '".$params['conditions']['free_date_start']."' and '".$params['conditions']['free_date_end']."')
																or
																(b.booking_date_end between '".$params['conditions']['free_date_start']."' and '".$params['conditions']['free_date_end']."')
															)"
													);



        //  $query = $this->db->get();
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
					// echo $this->db->get_compiled_select();
					// return $query->result_array();


    	}

}

