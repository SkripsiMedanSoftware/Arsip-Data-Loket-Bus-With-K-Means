<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Pengguna
 * @category Helper
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

/**
 * Mengambil sesi pengguna yang aktif
 * 
 * @return array
 */
function aktif_sesi()
{
	$ci =& get_instance();
	return $ci->pengguna_model->view($ci->session->userdata('pengguna'));
}

/**
 * Mengambil data pengguna berdasarkan id
 * @param  integer $id
 * @return array|boolean
 */
function view_user($id = NULL)
{
	$ci =& get_instance();
	return $ci->pengguna_model->view($id);
}

/* End of file pengguna_helper.php */
/* Location : ./application/helpers/pengguna_helper.php */