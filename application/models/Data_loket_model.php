<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_loket_model extends MY_Model {

	protected $table = 'data_loket';

	/**
	 * Menghitung jumlah bus total
	 * 
	 * @param  integer $id_loket
	 * @return integer
	 */
	public function jumlah_bus_total($id_loket = NULL) {
		$data_bus_loket = $this->db->where(array('loket' => $id_loket));
		return $this->db->count_all_results('data_bus_loket');
	}

	/**
	 * Menghitung jumlah penumpang total
	 * 
	 * @param  integer $id_loket
	 * @return integer
	 */
	public function jumlah_penumpang_total($id_loket = NULL) {
		$tujuan_loket = $this->data_tujuan_model->get_where(array('loket' => $id_loket));

		$list_tujuan = array_map(function($data){
			return $data['id'];
		}, $tujuan_loket);

		if (!empty($list_tujuan)) {
			$this->db->where_in('tujuan', $list_tujuan);
			return $this->db->count_all_results('data_penumpang');
		} else {
			return 0;
		}
	}

	public function jumlah_paket_total($id_loket = NULL) {
		$tujuan_loket = $this->data_tujuan_model->get_where(array('loket' => $id_loket));

		$list_tujuan = array_map(function($data){
			return $data['id'];
		}, $tujuan_loket);

		if (!empty($list_tujuan)) {
			$this->db->where_in('tujuan', $list_tujuan);
			return $this->db->count_all_results('data_paket');
		} else {
			return 0;
		}
		
	}
}

/* End of file Data_loket_model.php */
/* Location: ./application/models/Data_loket_model.php */