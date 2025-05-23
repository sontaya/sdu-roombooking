<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mtbooking_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function save($data) {
       $result = $this->db->insert('mt_booking_info', $data);
        // $id = $this->db->insert_id();
        // return (isset($id)) ? $id : FALSE;
        return (isset($result)) ? $result : FALSE;
    }

    function log($id) {
       	$sql = "INSERT INTO mt_booking_info_log(
			id, user_id, booking_org, booking_email, booking_phone, internal_phone, room_id
			, usage_category, usage_software, participant, objective, booking_date_start, booking_date_end
			, require_staff, booking_status, booking_status_reason, approved_by, approved_date
			, created_at, created_by, created_by_ip, modified_at, modified_by, modified_by_ip
		) SELECT
			id, user_id, booking_org, booking_email, booking_phone, internal_phone, room_id
			, usage_category, usage_software, participant, objective, booking_date_start, booking_date_end
			, require_staff, booking_status, booking_status_reason, approved_by, approved_date
			, created_at, created_by, created_by_ip, modified_at, modified_by, modified_by_ip
		 FROM mt_booking_info WHERE id = '".$id."'";
        $this->db->query($sql);
    }

    function update($id, $data) {
        $this->db->where('id', $id);
        $result = $this->db->update('mt_booking_info', $data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        $result = $this->db->delete('mt_booking_info');
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
	  	$this->db->select('b.*, rm.room_tag, rm.name as room_name, rm.shortname as room_shortname , u.name, u.surname, u.academic_fullname, u.name_faculty, u.name_department, u.line_sub, u.line_iat, u.line_exp,
	  			(
					case
						when b.usage_category = "1" then "ออนไลน์ - การสอน (Live)"
						when b.usage_category = "2" then "ออนไลน์ - การประชุม (Live)"
						when b.usage_category = "3" then "ออนแอร์ (ถ่ายทำรายการในสตูดิโอ)"
						when b.usage_category = "4" then "ประชุมออนไซต์"
						when b.usage_category = "5" then "ประชุมออนไลน์"
						else ""
					end
				) as usage_category_desc,
				(
					case
						when b.booking_status = "approved" then "อนุมัติ"
						when b.booking_status = "rejected" then "ไม่อนุมัติ"
						when b.booking_status = "pending" then "รอการอนุมัติ"
						when b.booking_status = "canceled" then "ยกเลิกโดยผู้จอง"
						else ""
					end
				) as booking_status_desc,
				(
					case
						when b.usage_software = "None" then "ไม่ได้ใช้งาน"
						when b.usage_software = "Team" then "Microsoft Team"
						when b.usage_software = "Zoom" then "Zoom"
						when b.usage_software = "DingTalk" then "DingTalk"
						when b.usage_software = "Meet" then "Google Meet"
						when b.usage_software = "WebEx" then "WebEx"
						else ""
					end
				) as usage_software_desc
				', false);
		$this->db->from('mt_booking_info b');
		$this->db->join('mt_room_master rm', 'b.room_id = rm.id');
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
		}else{
			if (!empty($params['conditions']['room_in'])){
				$this->db->where_in('b.room_id', $params['conditions']['room_in']);
			}
		}

		if (!empty($params['conditions']['export_target'])){
			$this->db->where_in('b.id', $params['conditions']['export_target']);
		}

      	if (!empty($params['conditions']['not_user_id'])){

			$this->db->where_not_in('b.user_id', $params['conditions']['not_user_id']);
		}

      	if (!empty($params['conditions']['booking_date_start'])){


			if(date2_formatdb($params['conditions']['booking_date_start']) === date2_formatdb($params['conditions']['booking_date_end'])){
				$this->db->where('date(b.booking_date_start) = ', date2_formatdb($params['conditions']['booking_date_start']));
			}else{
				$this->db->where('b.booking_date_start >= ', date2_formatdb($params['conditions']['booking_date_start']));
				$this->db->where('b.booking_date_end <= ', date2_formatdb($params['conditions']['booking_date_end']));
			}
				// $this->db->where('b.booking_date_start BETWEEN "'. date('Y-m-d', strtotime($params['conditions']['booking_date_start'])). '" and "'. date('Y-m-d', strtotime($params['conditions']['booking_date_end'])).'"');
				// $this->db->or_where('b.booking_date_end BETWEEN "'. date('Y-m-d', strtotime($params['conditions']['booking_date_start'])). '" and "'. date('Y-m-d', strtotime($params['conditions']['booking_date_end'])).'"');

		}

		if (!empty($params['conditions']['calendar_start'])){
			$this->db->where('b.booking_date_start BETWEEN "'. date('Y-m-d', strtotime($params['conditions']['calendar_start'])). '" and "'. date('Y-m-d', strtotime($params['conditions']['calendar_end'])).'"');
		}


          $this->db->order_by('b.booking_date_start', 'ASC');
        //   $this->db->order_by('FILENAME_PDF', 'ASC');

          $query = $this->db->get();
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
        //   echo $this->db->get_compiled_select();


	}


	public function list_by_user($params = array())
  	{
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit'],$params['start']);
		}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit']);
		}

	  	$this->db->select('b.*, rm.room_tag, rm.name as room_name, rm.shortname as room_shortname , u.name, u.surname, u.academic_fullname, u.name_faculty, u.name_department, u.line_sub, u.line_iat, u.line_exp,
	  			(
					case
						when b.usage_category = "1" then "ออนไลน์ - การสอน (Live)"
						when b.usage_category = "2" then "ออนไลน์ - การประชุม (Live)"
						when b.usage_category = "3" then "ออนแอร์ (ถ่ายทำรายการในสตูดิโอ)"
						when b.usage_category = "4" then "ประชุมออนไซต์"
						when b.usage_category = "5" then "ประชุมออนไลน์"
						else ""
					end
				) as usage_category_desc,
				(
					case
						when b.booking_status = "approved" then "อนุมัติ"
						when b.booking_status = "rejected" then "ไม่อนุมัติ"
						when b.booking_status = "pending" then "รอการอนุมัติ"
						when b.booking_status = "canceled" then "ยกเลิกโดยผู้จอง"
						else ""
					end
				) as booking_status_desc,
				(
					case
						when b.usage_software = "None" then "ไม่ได้ใช้งาน"
						when b.usage_software = "Team" then "Microsoft Team"
						when b.usage_software = "Zoom" then "Zoom"
						when b.usage_software = "DingTalk" then "DingTalk"
						when b.usage_software = "Meet" then "Google Meet"
						when b.usage_software = "WebEx" then "WebEx"
						else ""
					end
				) as usage_software_desc
				', false);
		$this->db->from('mt_booking_info b');
		$this->db->join('mt_room_master rm', 'b.room_id = rm.id');
		$this->db->join('rb_users u', 'u.user_id = b.user_id');

      	if (!empty($params['conditions']['id'])){
        	$this->db->where('b.id', $params['conditions']['id']);
		}

			if (!empty($params['conditions']['booking_status'])){
				$this->db->where('b.booking_status', $params['conditions']['booking_status']);
			}

			if (!empty($params['conditions']['room_id'])){
					$this->db->where('b.room_id', $params['conditions']['room_id']);
			}else{
				if (!empty($params['conditions']['room_in'])){
					$this->db->where_in('b.room_id', $params['conditions']['room_in']);
				}
			}

			if (!empty($params['conditions']['booking_date_start'])){
					// $this->db->where('b.booking_date_start >= ', date2_formatdb($params['conditions']['booking_date_start']));
					// $this->db->where('b.booking_date_end <= ', date2_formatdb($params['conditions']['booking_date_end']));
					if(date2_formatdb($params['conditions']['booking_date_start']) === date2_formatdb($params['conditions']['booking_date_end'])){
						$this->db->where('date(b.booking_date_start) = ', date2_formatdb($params['conditions']['booking_date_start']));
					}else{
						$this->db->where('b.booking_date_start >= ', date2_formatdb($params['conditions']['booking_date_start']));
						$this->db->where('b.booking_date_end <= ', date2_formatdb($params['conditions']['booking_date_end']));
					}
			}



		if (!empty($params['conditions']['not_user_id'])){

			$this->db->group_start();
				if (!empty($params['conditions']['user_id'])){
					$this->db->where('b.user_id', $params['conditions']['user_id']);
				}

				$this->db->or_group_start();
					$this->db->where('b.booking_status', 'approved');
					$this->db->where_not_in('b.user_id', $params['conditions']['not_user_id']);
				$this->db->group_end();


			$this->db->group_end();


		}

          $this->db->order_by('b.booking_date_start', 'ASC');
        //   $this->db->order_by('FILENAME_PDF', 'ASC');

          $query = $this->db->get();
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
        //   echo $this->db->get_compiled_select();


	}

	public function check_freeroom_list($params = array())
  	{
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit'],$params['start']);
		}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit']);
		}


		$this->db->select('rb.*');
		$this->db->from('vw_mt_approved rb');
		$this->db->where('rb.room_id', $params['conditions']['room_id']);
		$this->db->group_start();
		$this->db->where('rb.booking_date_start between "'.$params['conditions']['free_date_start'] .'" and "'.$params['conditions']['free_date_end'].'"');
		$this->db->or_where('rb.booking_date_end between "'.$params['conditions']['free_date_start'] .'" and "'.$params['conditions']['free_date_end'].'"');
		$this->db->group_end();


          $query = $this->db->get();
		  return ($query->num_rows() > 0)?$query->result_array():FALSE;

					// echo $this->db->get_compiled_select();
					// return $query->result_array();


    }

	public function get_approved($params = array())
  	{
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit'],$params['start']);
		}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit']);
		}


		$this->db->select('rb.*');
		$this->db->from('vw_mt_approved rb');
		$this->db->where('rb.room_id', $params['conditions']['room_id']);
		$this->db->group_start();
		$this->db->where('rb.booking_date_start between "'.$params['conditions']['free_date_start'] .'" and "'.$params['conditions']['free_date_end'].'"');
		$this->db->group_end();


          $query = $this->db->get();
		  return ($query->num_rows() > 0)?$query->result_array():FALSE;

					// echo $this->db->get_compiled_select();
					// return $query->result_array();


    }

	public function dashboard_summary($params = array())
	{
		// SELECT COUNT(*) AS count_all
		// 	,COUNT(CASE WHEN booking_status = 'approved' THEN 1 END) AS count_approved
		// 	,COUNT(CASE WHEN booking_status = 'pending' THEN 1 END) AS count_pending
		// 	,COUNT(CASE WHEN booking_status = 'rejected' THEN 1 END) AS count_rejected
		// FROM mt_booking_info
		// WHERE user_id = '". $this->global_data['user_id'] ."'
	}

}

