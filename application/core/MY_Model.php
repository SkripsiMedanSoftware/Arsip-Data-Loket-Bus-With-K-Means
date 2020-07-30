<?php
/**
 * @package Codeigniter
 * @subpackage Model
 * @category Libraries
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

class MY_Model extends \CI_Model
{
	protected $db;

	protected $table;

	public function __construct()
	{
		parent::__construct();

		$this->set_db();
	}

	/**
	 * Set database
	 */
	public function set_db($db_group = 'default')
	{
		$this->db = $this->load->database($db_group, TRUE);
	}

	/**
	 * Get database tables
	 * 
	 * @return array
	 */
	public function get_tables()
	{
		return $this->db->list_tables();
	}

	/**
	 * Table exists
	 * 
	 * @param  string $table
	 * @return boolean
	 */
	public function table_exists($table)
	{
		return $this->db->table_exists($table);
	}

	/**
	 * Get fields
	 * 
	 * @param  string $table
	 * @return array
	 */
	public function get_fields($table)
	{
		if ($this->db->table_exists($table))
		{
			return $this->db->list_fields($table);
		}

		return FALSE;
	}

	/**
	 * Field exists
	 * 
	 * @param  string $table
	 * @param  string $field
	 * @return boolean
	 */
	public function field_exists($table, $field)
	{
		if ($this->table_exists($table))
		{
			return $this->db->field_exists($field, $table);
		}

		return FALSE;
	}

	/**
	 * Table Action
	 */

	/**
	 * Get where
	 */
	public function get_where(array $where, $table = NULL)
	{
		$pengguna = $this->db->get_where(!empty($table)?$table:$this->table, $where);

		if ($pengguna->num_rows() > 0)
		{
			return $pengguna->result_array();
		}

		return array();
	}

	/**
	 * Count all
	 * 
	 * @return integer
	 */
	public function count_all($table = NULL)
	{
		return $this->db->count_all($this->table);
	}

	/**
	 * Count where
	 * 
	 * @param  array  $where
	 * @return integer
	 */
	public function count_where($where = array(), $table = NULL)
	{
		$this->db->where($where);
		$this->db->from(!empty($table)?$table:$this->table);
		return $this->db->count_all_results();
	}

	/**
	 * List Data
	 * 
	 * @return array
	 */
	public function list($table = NULL)
	{
		$pengguna = $this->db->get(!empty($table)?$table:$this->table);
		
		if ($pengguna->num_rows() > 0)
		{
			return $pengguna->result_array();
		}

		return array();
	}

	/**
	 * Create Data
	 * 
	 * @param  array  $data
	 * @return boolean
	 */
	public function create(array $data, $table = NULL)
	{
		return $this->db->insert(!empty($table)?$table:$this->table, $data);
	}

	/**
	 * View Data
	 * 
	 * @param  integer $value
	 * @return boolean on fail
	 */
	public function view($value, $field = 'id', $table = NULL)
	{
		$pengguna = $this->db->get_where(!empty($table)?$table:$this->table, array($field => $value));

		if ($pengguna->num_rows() >= 1)
		{
			return $pengguna->row_array();
		}

		return FALSE;
	}

	/**
	 * Update Data
	 * 
	 * @param  array  $data
	 * @param  array  $where
	 * @return boolean
	 */
	public function update(array $data, array $where, $table = NULL)
	{
		return $this->db->update(!empty($table)?$table:$this->table, $data, $where);
	}

	/**
	 * Menghapus Data
	 * 
	 * @param  array  $where
	 * @return boolean
	 */
	public function delete(array $where, $table = NULL)
	{
		return $this->db->delete(!empty($table)?$table:$this->table, $where);
	}
}

/* End of file MY_Model.php */
/* Location : ./application/core/MY_Model.php */