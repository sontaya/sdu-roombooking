<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Subject_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }


	public function list($params = array())
  	{

	  	$this->db->select('s.*', false);
		$this->db->from('rb_subject s');

		// if (!empty($params['conditions']['active_in'])) {
		// 	$this->db->where_in('b.active', $params['conditions']['active_in']);
		// }
		if (!empty($params['conditions']['subject_id'])){
        	$this->db->where('s.subject_id', $params['conditions']['subject_id']);
		}
		if (!empty($params['conditions']['search_key'])){
        	$this->db->like('s.subject_name_th',$params['conditions']['search_key']);
        	$this->db->or_like('s.subject_code',$params['conditions']['search_key']);
		}



        //   $this->db->order_by('b.booking_date_start', 'ASC');
        //   $this->db->order_by('FILENAME_PDF', 'ASC');

		$query = $this->db->get();
		return ($query->num_rows() > 0)?$query->result_array():FALSE;
        //   echo $this->db->get_compiled_select();


	}



}

