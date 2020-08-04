<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Pengguna
 * @category Controller
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

class Pengguna extends CI_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->has_userdata('pengguna')) {
			if (!in_array($this->router->fetch_method(), ['daftar', 'masuk', 'keluar'])) {
				redirect(base_url('site/sign_in') ,'refresh');
			}
		}
	}

	/**
	 * User dashboard
	 */
	public function index()
	{
		$data['page_title'] = 'Dashboard';
		$data['count_all'] = array(
			'bus' => $this->data_bus_model->count_all(),
			'loket' => $this->data_loket_model->count_all(),
			'paket' => $this->data_paket_model->count_all(),
			'tujuan' => $this->data_tujuan_model->count_all(),
			'penumpang' => $this->data_penumpang_model->count_all(),
			'pengguna' => $this->pengguna_model->count_all()
		);
		$this->template->pengguna('home', $data);
	}

	/**
	 * Pengguna
	 */
	public function pengguna()
	{
		$data['page_title'] = 'Dashboard';
		$data['pengguna'] = $this->pengguna_model->list();
		$this->template->pengguna('pengguna/list', $data);
	}

	/**
	 * User sign in
	 */
	public function masuk()
	{
		if ($this->input->method(TRUE) == 'POST')
		{
			$this->form_validation->set_rules('identitas', 'Nama Pengguna / Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == TRUE)
			{
				$masuk = $this->pengguna_model->masuk($this->input->post('identitas'), $this->input->post('password'));

				if ($masuk)
				{
					if ($masuk['status'] == 'aktif')
					{
						$this->session->set_userdata('pengguna', $masuk['id']);
						redirect(base_url('pengguna'), 'refresh');
					}
					else
					{
						$status = ($masuk['status'] == 'non-aktif')?'non-aktifkan':'blokir';
						$this->session->set_userdata('masuk', 'Maaf akun anda telah di'.$status.' silahkan hubungi admin untuk keterangan lebih lanjut');
						redirect(base_url('pengguna'), 'refresh');
					}
				}
				else
				{
					$this->session->set_flashdata('masuk', 'Email / Kata Sandi yang digunakan tidak sesuai');
					redirect('site/sign_in', 'refresh');
				}
			}
			else
			{
				$this->load->view('pengguna/masuk');
			}
		}
		else
		{
			$this->load->view('pengguna/masuk');
		}
	}

	/**
	 * User profile
	 * 
	 * @param  integer $id
	 */
	public function profil($id = NULL)
	{
		$this->template->pengguna('pengguna/profile');
	}

	/**
	 * User logout
	 */
	public function keluar()
	{
		session_destroy();
		redirect(base_url('site/sign_in'), 'refresh');
	}
}

/* End of file Pengguna.php */
/* Location : ./application/controllers/Pengguna.php */