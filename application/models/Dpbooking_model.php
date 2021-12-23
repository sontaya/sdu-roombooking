<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dpbooking_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function save($data) {
       $result = $this->db->insert('dp_booking_info', $data);
        // $id = $this->db->insert_id();
        // return (isset($id)) ? $id : FALSE;
        return (isset($result)) ? $result : FALSE;
    }

    function update($id, $data) {
        $this->db->where('id', $id);
        $result = $this->db->update('dp_booking_info', $data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        $result = $this->db->delete('dp_booking_info');
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

	  	$this->db->select('b.*, rm.room_tag, rm.name as room_name, rm.shortname as room_shortname , u.name, u.surname
		  				, u.name_faculty, u.name_department, u.line_sub, u.line_iat, u.line_exp
						, b.usage_scale, rs.room_scale as usage_scale_desc, b.usage_format,
						(
							case
								when b.booking_status = "approved" then "อนุมัติ"
								when b.booking_status = "rejected" then "ไม่อนุมัติ"
								when b.booking_status = "pending" then "รอการอนุมัติ"
								else ""
							end
						) as booking_status_desc
				', false);
		$this->db->from('dp_booking_info b');
		$this->db->join('dp_room_master rm', 'b.room_id = rm.id', 'left');
		$this->db->join('rb_users u', 'u.user_id = b.user_id', 'left');
		$this->db->join('dp_room_scale rs', 'rs.id = b.usage_scale', 'left');


      if (!empty($params['conditions']['id'])){
        	$this->db->where('b.id', $params['conditions']['id']);
		  }

      if (!empty($params['conditions']['booking_status'])){
        	$this->db->where('b.booking_status', $params['conditions']['booking_status']);
		  }

      if (!empty($params['conditions']['user_id'])){
        	$this->db->where('b.user_id', $params['conditions']['user_id']);
		  }

      if (!empty($params['conditions']['room_id'])){
        	$this->db->where('b.room_id', $params['conditions']['room_id']);
			}else{
				if (!empty($params['conditions']['room_in'])){
					$this->db->where_in('b.room_id', $params['conditions']['room_in']);
				}
			}


      	if (!empty($params['conditions']['not_user_id'])){

			$this->db->where_not_in('b.user_id', $params['conditions']['not_user_id']);
		}

      	if (!empty($params['conditions']['booking_date_start'])){

				$this->db->where('b.booking_date_start >= ', date2_formatdb($params['conditions']['booking_date_start']));
				$this->db->where('b.booking_date_end <= ', date2_formatdb($params['conditions']['booking_date_end']));

				// $this->db->where('b.booking_date_start BETWEEN "'. date('Y-m-d', strtotime($params['conditions']['booking_date_start'])). '" and "'. date('Y-m-d', strtotime($params['conditions']['booking_date_end'])).'"');
				// $this->db->or_where('b.booking_date_end BETWEEN "'. date('Y-m-d', strtotime($params['conditions']['booking_date_start'])). '" and "'. date('Y-m-d', strtotime($params['conditions']['booking_date_end'])).'"');

		}

          $this->db->order_by('b.booking_date_start', 'ASC');
        //   $this->db->order_by('FILENAME_PDF', 'ASC');

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
												from dp_booking_info b
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

