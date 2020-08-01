<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_bus_model extends MY_Model {

	protected $table = 'data_bus';

	/**
	 * Jumlah tujuan bus
	 * 
	 * @param  integer $id_bus
	 * @return integer
	 */
	public function jumlah_tujuan($id_bus = NULL) {
		$this->db->where('bus', $id_bus);
		return $this->db->count_all_results('data_tujuan');
	}

}

/* End of file Data_bus_model.php */
/* Location: ./application/models/Data_bus_model.php */