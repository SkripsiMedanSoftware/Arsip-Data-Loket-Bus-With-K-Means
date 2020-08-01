<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Data_variable
 * @category Controller
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

class Data_variable extends CI_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Bus view
	 * 
	 * @param  integer $id
	 */
	public function bus($id = NULL)
	{
		if ($id == 'add')
		{
			if ($this->input->method(TRUE) == 'POST')
			{
				$this->form_validation->set_rules('merek', 'Merek', 'trim|required');
				$this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');
				$this->form_validation->set_rules('jumlah_kursi', 'Jumlah Kursi', 'trim|integer|max_length[2]|required');

				if ($this->form_validation->run() == TRUE)
				{
					$this->data_bus_model->create(array(
						'merk_bus' => $this->input->post('merek'),
						'kelas_bus' => $this->input->post('kelas'),
						'jumlah_kursi' => $this->input->post('jumlah_kursi')
					));

					$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data bus telah ditambahkan'));
					redirect(base_url('data_variable/bus'), 'refresh');
				}
				else
				{
					$data['page_title'] = 'Tambah Data Bus';
					$this->template->pengguna('data_variable/bus/add', $data);	
				}
			}
			else
			{
				$data['page_title'] = 'Tambah Data Bus';
				$this->template->pengguna('data_variable/bus/add', $data);	
			}
		}
		else
		{
			if (!empty($id))
			{
				$data['page_title'] = 'Detail Data Bus';
				$data['bus'] = $this->data_bus_model->view($id);
				$this->template->pengguna('data_variable/bus/view', $data);
			}
			else
			{
				$data['page_title'] = 'Daftar Data Bus';
				$data['bus'] = $this->data_bus_model->list();
				$this->template->pengguna('data_variable/bus/list', $data);
			}
		}
	}

	/**
	 * Bus option
	 * 
	 * @param  integer $id
	 * @param  string $option
	 */
	public function bus_option($id = NULL, $option = 'delete')
	{
		$id = $this->data_bus_model->view($id);

		if (!empty($id))
		{
			switch ($option) {
				case 'update':
					if ($this->input->method(TRUE) == 'POST')
					{
						$this->form_validation->set_rules('merek', 'Merek', 'trim|required');
						$this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');
						$this->form_validation->set_rules('jumlah_kursi', 'Jumlah Kursi', 'trim|integer|max_length[2]|required');

						if ($this->form_validation->run() == TRUE)
						{
							$this->data_bus_model->update(array(
								'merk_bus' => $this->input->post('merek'),
								'kelas_bus' => $this->input->post('kelas'),
								'jumlah_kursi' => $this->input->post('jumlah_kursi')
							), array('id' => $id['id']));

							$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data bus telah diperbaharui'));
							redirect(base_url('data_variable/bus') ,'refresh');
						}
						else
						{
							$data['page_title'] = 'Edit Data Bus';
							$data['bus'] = $id;
							$this->template->pengguna('data_variable/bus/edit', $data);
						}
					}
					else
					{
						$data['page_title'] = 'Edit Data Bus';
						$data['bus'] = $id;
						$this->template->pengguna('data_variable/bus/edit', $data);
					}
				break;

				case 'delete':
					if ($this->data_bus_model->delete(array('id' => $id['id'])))
					{
						$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data bus telah dihapus'));
						redirect(base_url('data_variable/bus') ,'refresh');
					}
					else
					{
						$this->session->set_flashdata('flash_message', array('status' => 'danger', 'message' => 'Gagal menghapus data bus'));
						redirect(base_url('data_variable/bus') ,'refresh');
					}
				break;
				
				default:
					show_404();
				break;
			}
		}
		else
		{
			$this->session->set_flashdata('flash_message', array('status' => 'warning', 'message' => 'Data bus tidak ditemukan'));
			redirect(base_url('pengguna/data_variable/bus'), 'refresh');
		}
	}

	/**
	 * Loket view
	 * 
	 * @param  integer $id
	 */
	public function loket($id = NULL)
	{
		if ($id == 'add')
		{
			if ($this->input->method(TRUE) == 'POST')
			{
				$this->form_validation->set_rules('nama_loket', 'Nama Loket', 'trim|required');

				if ($this->form_validation->run() == TRUE)
				{
					$this->data_loket_model->create(array(
						'nama_loket' => $this->input->post('nama_loket')
					));

					$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data loket telah ditambahkan'));
					redirect(base_url('data_variable/loket'), 'refresh');
				}
				else
				{
					$data['page_title'] = 'Tambah Data Loket';
					$this->template->pengguna('data_variable/loket/add', $data);
				}
			}
			else
			{
				$data['page_title'] = 'Tambah Data Loket';
				$this->template->pengguna('data_variable/loket/add', $data);	
			}
		}
		else
		{
			if (!empty($id))
			{
				$data['page_title'] = 'Detail Data Loket';
				$data['loket'] = $this->data_loket_model->view($id);
				$this->template->pengguna('data_variable/loket/view', $data);
			}
			else
			{
				$data['page_title'] = 'Daftar Data Loket';
				$data['loket'] = $this->data_loket_model->list();
				$this->template->pengguna('data_variable/loket/list', $data);
			}
		}
	}

	/**
	 * Loket option
	 * 
	 * @param  integer $id
	 * @param  string $option
	 */
	public function loket_option($id = NULL, $option = 'delete')
	{
		$id = $this->data_loket_model->view($id);

		if (!empty($id))
		{
			switch ($option) {
				case 'update':
					if ($this->input->method(TRUE) == 'POST')
					{
						$this->form_validation->set_rules('nama_loket', 'Nama Loket', 'trim|required');

						if ($this->form_validation->run() == TRUE)
						{
							$this->data_loket_model->update(array(
								'nama_loket' => $this->input->post('nama_loket')
							), array('id' => $id['id']));

							$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data loket telah diperbaharui'));
							redirect(base_url('data_variable/loket') ,'refresh');
						}
						else
						{
							$data['page_title'] = 'Edit Data Loket';
							$data['loket'] = $id;
							$this->template->pengguna('data_variable/loket/edit', $data);
						}
					}
					else
					{
						$data['page_title'] = 'Edit Data Loket';
						$data['loket'] = $id;
						$this->template->pengguna('data_variable/loket/edit', $data);
					}
				break;

				case 'delete':
					if ($this->data_loket_model->delete(array('id' => $id['id'])))
					{
						$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data loket telah dihapus'));
						redirect(base_url('data_variable/loket') ,'refresh');
					}
					else
					{
						$this->session->set_flashdata('flash_message', array('status' => 'danger', 'message' => 'Gagal menghapus data loket'));
						redirect(base_url('data_variable/loket') ,'refresh');
					}
				break;
				
				default:
					show_404();
				break;
			}
		}
		else
		{
			show_404();
		}
	}

	/**
	 * Paket view
	 * 
	 * @param  integer $id
	 */
	public function paket($id = NULL)
	{
		if ($id == 'add')
		{
			if ($this->input->method(TRUE) == 'POST')
			{
				$this->form_validation->set_rules('tujuan', 'Tujuan', 'trim|required');
				$this->form_validation->set_rules('pengirim', 'Pengirim', 'trim|required');
				$this->form_validation->set_rules('penerima', 'Penerima', 'trim|required');

				if ($this->form_validation->run() == TRUE)
				{
					$this->data_paket_model->create(array(
						'tujuan' => $this->input->post('tujuan'),
						'pengirim' => $this->input->post('pengirim'),
						'penerima' => $this->input->post('penerima')
					));

					$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data paket telah ditambahkan'));
					redirect(base_url('data_variable/paket'), 'refresh');
				}
				else
				{
					$data['page_title'] = 'Tambah Data Paket';
					$this->template->pengguna('data_variable/paket/add', $data);	
				}
			}
			else
			{
				$data['page_title'] = 'Tambah Data Paket';
				$this->template->pengguna('data_variable/paket/add', $data);	
			}
		}
		else
		{
			if (!empty($id))
			{
				$data['page_title'] = 'Detail Data Paket';
				$data['paket'] = $this->data_paket_model->view($id);
				$this->template->pengguna('data_variable/paket/view', $data);
			}
			else
			{
				$data['page_title'] = 'Daftar Data Paket';
				$data['paket'] = $this->data_paket_model->list();
				$this->template->pengguna('data_variable/paket/list', $data);
			}
		}
	}

	/**
	 * Paket option
	 * 
	 * @param  integer $id
	 * @param  string $option
	 */
	public function paket_option($id = NULL, $option = 'delete')
	{
		$id = $this->data_paket_model->view($id);

		if (!empty($id))
		{
			switch ($option) {
				case 'update':
					if ($this->input->method(TRUE) == 'POST')
					{
						$this->form_validation->set_rules('tujuan', 'Tujuan', 'trim|required');
						$this->form_validation->set_rules('pengirim', 'Pengirim', 'trim|required');
						$this->form_validation->set_rules('penerima', 'Penerima', 'trim|required');

						if ($this->form_validation->run() == TRUE)
						{
							$this->data_paket_model->update(array(
								'tujuan' => $this->input->post('tujuan'),
								'pengirim' => $this->input->post('pengirim'),
								'penerima' => $this->input->post('penerima')
							), array('id' => $id['id']));

							$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data paket telah diperbaharui'));
							redirect(base_url('data_variable/paket') ,'refresh');
						}
						else
						{
							$data['page_title'] = 'Edit Data Paket';
							$data['paket'] = $id;
							$this->template->pengguna('data_variable/paket/edit', $data);
						}
					}
					else
					{
						$data['page_title'] = 'Edit Data Paket';
						$data['paket'] = $id;
						$this->template->pengguna('data_variable/paket/edit', $data);
					}
				break;

				case 'delete':
					if ($this->data_paket_model->delete(array('id' => $id['id'])))
					{
						$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data paket telah dihapus'));
						redirect(base_url('data_variable/paket') ,'refresh');
					}
					else
					{
						$this->session->set_flashdata('flash_message', array('status' => 'danger', 'message' => 'Gagal menghapus data paket'));
						redirect(base_url('data_variable/paket') ,'refresh');
					}
				break;
				
				default:
					show_404();
				break;
			}
		}
		else
		{
			show_404();
		}
	}

	/**
	 * Tujuan view
	 * 
	 * @param  integer $id
	 */
	public function tujuan($id = NULL)
	{
		if ($id == 'add')
		{
			if ($this->input->method(TRUE) == 'POST')
			{
				$this->form_validation->set_rules('nama_tujuan', 'Nama Tujuan', 'trim|required');

				if ($this->form_validation->run() == TRUE)
				{
					$check_double_data = $this->data_tujuan_model->get_where(array('loket' => $this->input->post('loket'), 'nama_tujuan' => $this->input->post('nama_tujuan'), 'bus_loket_id' => $this->input->post('bus_loket_id')));

					if (empty($check_double_data))
					{
						$this->data_tujuan_model->create(array(
							'nama_tujuan' => $this->input->post('nama_tujuan'),
							'loket' => $this->input->post('loket'),
							'bus' => $this->input->post('bus'),
							'bus_loket_id' => $this->input->post('bus_loket_id')
						));

						$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data tujuan telah ditambahkan'));
						redirect(base_url('data_variable/tujuan'), 'refresh');
					}
					else
					{
						$this->session->set_flashdata('flash_message', array('status' => 'warning', 'message' => 'Data tujuan telah sudah pernah ditambahkan'));
						redirect(base_url('data_variable/tujuan'), 'refresh');	
					}
				}
				else
				{
					$data['page_title'] = 'Tambah Data Tujuan';
					$this->template->pengguna('data_variable/tujuan/add', $data);
				}
			}
			else
			{
				$data['page_title'] = 'Tambah Data Tujuan';
				$this->template->pengguna('data_variable/tujuan/add', $data);
			}
		}
		else
		{
			if (!empty($id))
			{
				$data['page_title'] = 'Daftar Data Tujuan';
				$data['tujuan'] = $this->data_tujuan_model->view($id);
				$this->template->pengguna('data_variable/tujuan/view', $data);
			}
			else
			{
				$data['page_title'] = 'Daftar Data Tujuan';
				$data['tujuan'] = $this->data_tujuan_model->list();
				$this->template->pengguna('data_variable/tujuan/list', $data);
			}
		}
	}

	public function tujuan_option($id = NULL, $option = 'delete')
	{
		$id = $this->data_tujuan_model->view($id);

		if (!empty($id))
		{
			switch ($option) {
				case 'update':
					if ($this->input->method(TRUE) == 'POST')
					{
						$this->form_validation->set_rules('nama_tujuan', 'Nama Tujuan', 'trim|required');

						if ($this->form_validation->run() == TRUE)
						{
							$check_double_data = $this->data_tujuan_model->get_where(array('loket' => $this->input->post('loket'), 'nama_tujuan' => $this->input->post('nama_tujuan'), 'bus_loket_id' => $this->input->post('bus_loket_id')));

							if (empty($check_double_data))
							{
								$this->data_tujuan_model->update(array(
									'nama_tujuan' => $this->input->post('nama_tujuan'),
									'loket' => $this->input->post('loket'),
									'bus' => $this->input->post('bus'),
									'bus_loket_id' => $this->input->post('bus_loket_id')
								), array('id' => $id['id']));

								$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data tujuan telah diperbaharui'));
								redirect(base_url('data_variable/tujuan') ,'refresh');
							}
							else
							{
								$this->session->set_flashdata('flash_message', array('status' => 'warning', 'message' => 'Data tujuan sudah pernah ditambahkan'));
								redirect(base_url('data_variable/tujuan'), 'refresh');	
							}
						}
						else
						{
							$data['page_title'] = 'Edit Data Tujuan';
							$data['tujuan'] = $id;
							$this->template->pengguna('data_variable/tujuan/edit', $data);
						}
					}
					else
					{
						$data['page_title'] = 'Edit Data Tujuan';
						$data['tujuan'] = $id;
						$this->template->pengguna('data_variable/tujuan/edit', $data);
					}
				break;

				case 'delete':
					if ($this->data_tujuan_model->delete(array('id' => $id['id'])))
					{
						$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data tujuan telah dihapus'));
						redirect(base_url('data_variable/tujuan') ,'refresh');
					}
					else
					{
						$this->session->set_flashdata('flash_message', array('status' => 'danger', 'message' => 'Gagal menghapus data tujuan'));
						redirect(base_url('data_variable/tujuan') ,'refresh');
					}
				break;
				
				default:
					show_404();
				break;
			}
		}
		else
		{

		}
	}

	public function penumpang($id = NULL)
	{
		if ($id == 'add')
		{
			if ($this->input->method(TRUE) == 'POST')
			{
				$this->form_validation->set_rules('nama_penumpang', 'Nama Penumpang', 'trim|required');
				$this->form_validation->set_rules('tujuan', 'Tujuan', 'trim|required');

				if ($this->form_validation->run() == TRUE)
				{
					$tanggal = explode('/', $this->input->post('tanggal'));

					$this->data_penumpang_model->create(array(
						'nama_penumpang' => $this->input->post('nama_penumpang'),
						'tujuan' => $this->input->post('tujuan'),
						'tanggal' => $tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0]
					));

					$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data penumpang telah ditambahkan'));
					redirect(base_url('data_variable/penumpang'), 'refresh');
				}
				else
				{
					$data['page_title'] = 'Tambah Data Penumpang';
					$this->template->pengguna('data_variable/penumpang/add', $data);	
				}
			}
			else
			{
				$data['page_title'] = 'Tambah Data Penumpang';
				$this->template->pengguna('data_variable/penumpang/add', $data);	
			}
		}
		else
		{
			if (!empty($id))
			{
				$data['page_title'] = 'Detail Data Penumpang';
				$data['penumpang'] = $this->data_penumpang_model->view($id);
				$this->template->pengguna('data_variable/penumpang/view', $data);
			}
			else
			{
				$data['page_title'] = 'Daftar Data Penumpang';
				$data['penumpang'] = $this->data_penumpang_model->list();
				$this->template->pengguna('data_variable/penumpang/list', $data);
			}
		}
	}

	public function bus_loket($id = NULL, $option = NULL)
	{
		if ($option == 'add')
		{
			if ($this->input->method(TRUE) == 'POST')
			{
				$this->form_validation->set_rules('bus', 'Bus', 'trim|required');
				$this->form_validation->set_rules('loket', 'Loket', 'trim|required');

				if ($this->form_validation->run() == TRUE)
				{
					$this->data_bus_loket_model->create(array(
						'loket' => $this->input->post('loket'),
						'bus' => $this->input->post('bus')
					));

					$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data bus telah ditambahkan'));
					redirect(base_url('data_variable/bus_loket/'.$id), 'refresh');
				}
				else
				{
					$data['page_title'] = 'Tambah Data Bus Loket';
					$data['loket'] = $id;
					$this->template->pengguna('data_variable/bus_loket/add', $data);
				}
			}
			else
			{
				$data['page_title'] = 'Tambah Data Bus Loket';
				$data['loket'] = $id;
				$this->template->pengguna('data_variable/bus_loket/add', $data);
			}
		}
		else
		{
			if (!empty($id))
			{
				$data['page_title'] = 'Daftar Data Bus Loket';
				$data['loket'] = $this->data_loket_model->view($id);
				$data['bus_loket'] = $this->data_bus_loket_model->get_where(array('loket' => $id));
				$this->template->pengguna('data_variable/bus_loket/list', $data);
			}
			else
			{
				show_404();
			}
		}
	}

	public function ajax_bus_loket($id = NULL)
	{

		$data = array();

		$bus_loket = $this->data_bus_loket_model->get_where(array('loket' => $id));

		if (!empty($bus_loket)) {
			foreach ($bus_loket as $value) {
				$bus = $this->data_bus_model->view($value['bus']);

				if (!empty($bus)) {
					$data[] = array(
						'loket_bus_id' => $value['id'],
						'bus_id' => $bus['id'],
						'merk_bus' => $bus['merk_bus'],
						'kelas_bus' => $bus['kelas_bus'],
						'jumlah_kursi' => $bus['jumlah_kursi'],
					);
				}
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function ajax_tujuan($id = NULL)
	{
		$data = array();

		$tujuan = $this->data_tujuan_model->view($id);

		if (!empty($tujuan))
		{
			$loket = $this->data_loket_model->view($tujuan['loket']);
			$bus = $this->data_bus_model->view($tujuan['bus']);
			$bus_loket = $this->data_bus_loket_model->view($tujuan['bus_loket_id']);

			if (!empty($loket) && !empty($bus) && !empty($bus_loket))
			{
				$data = array(
					'loket' => $loket,
					'bus' => $bus,
					'bus_loket' => $bus_loket
				);
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function bus_loket_option($id = NULL, $option = 'delete')
	{
		$id = $this->data_bus_loket_model->view($id);
		if (!empty($id))
		{
			switch ($option) {

				case 'delete':
					$loket = $this->data_loket_model->view($id['loket']);
					if ($this->data_bus_loket_model->delete(array('id' => $id['id'])))
					{
						$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data bus pada loket '.$loket['nama_loket'].' telah dihapus'));
						redirect(base_url('data_variable/bus_loket/'.$id['loket']) ,'refresh');
					}
					else
					{
						$this->session->set_flashdata('flash_message', array('status' => 'danger', 'message' => 'Gagal menghapus data bus pada loket '.$loket['nama_loket']));
						redirect(base_url('data_variable/bus_loket/'.$id['loket']) ,'refresh');
					}
				break;
				
				default:
					show_404();
				break;
			}
		}
		else
		{
			show_404();
		}
	}

	/**
	 * Kmeans
	 */
	public function kmeans()
	{
		$this->load->library('kmeans');
		$data['loket'] = $this->data_loket_model->list();
		$this->template->pengguna('data_variable/kmeans', $data);
	}
}

/* End of file Data_variable.php */
/* Location : ./application/controllers/Data_variable.php */