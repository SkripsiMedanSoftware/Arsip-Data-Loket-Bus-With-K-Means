<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_model extends MY_Model {

	protected $table = 'pengguna';

	/**
	 * Sign In
	 * 
	 * @param  string $identity
	 * @param  string $password
	 * @return boolean on fail
	 */
	public function masuk($identity, $password)
	{
		$this->db->where('email', $identity);
		$this->db->or_where('username =', $identity, TRUE);
		$this->db->or_where('seluler =', $identity, TRUE);

		$pengguna = $this->db->get('pengguna');

		if ($pengguna->num_rows() >= 1)
		{
			if ($pengguna->row()->password == md5($password))
			{
				return $pengguna->row_array();
			}
		}

		return FALSE;
	}
}

/* End of file Pengguna_model.php */
/* Location: ./application/models/Pengguna_model.php */