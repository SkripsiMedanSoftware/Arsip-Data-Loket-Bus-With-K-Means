<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Template
 * @category Library
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

class Template
{
	protected $ci;

	/**
	 * constructor
	 */
	public function __construct()
	{
		$this->ci =& get_instance();
	}

	public function pengguna($page = '', $data = array())
	{
		$data['page'] = $this->ci->load->view('pengguna/'.$page, $data, TRUE);
		$this->ci->load->view('pengguna/base', $data);
	}
}

/* End of file Template.php */
/* Location : ./application/libraries/Template.php */