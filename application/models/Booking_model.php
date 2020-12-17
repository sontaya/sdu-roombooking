<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Booking_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function save($data) {
       $result = $this->db->insert('rb_booking_info', $data);
        // $id = $this->db->insert_id();
        // return (isset($id)) ? $id : FALSE;
        return (isset($result)) ? $result : FALSE;
    }

    function update($id, $data) {
        $this->db->where('id', $id);
        $result = $this->db->update('rb_booking_info', $data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        $result = $this->db->delete('rb_booking_info');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

	public function list($params = array())
    {
      if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit'],$params['start']);
      }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit']);
      }

	  	$this->db->select('b.*, rm.name as room_name, u.name, u.surname, u.name_faculty, u.name_department,
	  			(
					case
						when b.usage_category = "1" then "ออนไลน์ - การสอน (Live)"
						when b.usage_category = "2" then "ออนไลน์ - การประชุม (Live)"
						when b.usage_category = "3" then "ออนแอร์ (ถ่ายทำรายการในสตูดิโอ)"
						else ""
					end
				) as usage_category_desc ', false);
		$this->db->from('rb_booking_info b');
		$this->db->join('rb_room_master rm', 'b.room_id = rm.id');
		$this->db->join('rb_users u', 'u.user_id = b.user_id');


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
		  }

      if (!empty($params['conditions']['not_user_id'])){

			$this->db->where_not_in('b.user_id', $params['conditions']['not_user_id']);
		}

      if (!empty($params['conditions']['booking_date_start'])){

			$this->db->where('b.booking_date_start >= ', date2_formatdb($params['conditions']['booking_date_start']));
			$this->db->where('b.booking_date_end <= ', date2_formatdb($params['conditions']['booking_date_end']));
	}


		//   if (!empty($params['conditions']['generalSearch'])){
		// 	$where_like = "(firstname LIKE '%".$params['conditions']['generalSearch']."%'
		// 					  OR lastname LIKE '%".$params['conditions']['generalSearch']."%'
		// 					  OR email LIKE '%".$params['conditions']['generalSearch']."%'
		// 					)";
		// 	$this->db->where($where_like);

		//   }


        //   if (!empty($params['conditions']['CATEGORY'])){
        //     $this->db->where('CATEGORY', $params['conditions']['CATEGORY']);
        //   }

          $this->db->order_by('b.booking_date_start', 'ASC');
        //   $this->db->order_by('FILENAME_PDF', 'ASC');

          $query = $this->db->get();
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
        //   echo $this->db->get_compiled_select();


    }


}

