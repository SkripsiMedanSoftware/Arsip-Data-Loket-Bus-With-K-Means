<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Laporan
 * @category Controller
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

class Laporan extends CI_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function bus()
	{
		$this->template->pengguna('laporan/bus');
	}
}

/* End of file Laporan.php */
/* Location : ./application/controllers/Laporan.php */