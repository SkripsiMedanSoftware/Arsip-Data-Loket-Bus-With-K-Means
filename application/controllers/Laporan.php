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

		if (!$this->session->has_userdata('pengguna')) {
			if (!in_array($this->router->fetch_method(), ['daftar', 'masuk', 'keluar'])) {
				redirect(base_url('site/sign_in') ,'refresh');
			}
		}

		$this->load->library('fpdf182/fpdf');
	}

	public function bus()
	{
		$data['page_title'] = 'Daftar Data Bus';
		$data['bus'] = $this->data_bus_model->list();
		$this->template->pengguna('laporan/bus', $data);
	}

	public function bus_print()
	{
		$headers = array(
			array(
				'text' => 'No',
				'width' => 10
			),
			array(
				'text' => 'Merek Bus',
				'width' => 48
			),
			array(
				'text' => 'Kelas',
				'width' => 48
			),
			array(
				'text' => 'Jumlah Kursi',
				'width' => 26
			),
			array(
				'text' => 'Total Bus',
				'width' => 26
			)
		);

		$this->fpdf->SetTitle('Laporan Data Bus');
		$this->fpdf->SetFont('Times', '', 12);
		$this->fpdf->AddPage();

		$this->fpdf->Image('https://www.graphicsprings.com/filestorage/stencils/f794ad52bccba5259868672d8db49de5.png', 120, 1, 120);
		// Arial bold 15
		// $this->fpdf->SetFont('Arial','B',15);
		// Move to the right
		$this->fpdf->Cell(80);
		// Title
		// $this->fpdf->Cell(30,10,'Title',1,0,'C');
		// Line break
		$this->fpdf->Ln(48);

		foreach ($headers as $value) {
		    $this->fpdf->Cell($value['width'], 6, $value['text'], 1, 0, 'C');
		}

		$this->fpdf->Ln();

		$i = 1;
		foreach ($this->data_bus_model->list() as $value) {
		    $this->fpdf->Cell(10, 6, $i, 1, 0, 'C');
		    $this->fpdf->Cell(48, 6, $value['merk_bus'], 1, 0, 'C');
		    $this->fpdf->Cell(48, 6, $value['kelas_bus'], 1, 0, 'C');
		    $this->fpdf->Cell(26, 6, $value['jumlah_kursi'], 1, 0, 'C');
		    $this->fpdf->Cell(26, 6, $this->data_bus_loket_model->count_where(array('bus' => $value['id'])), 1, 1, 'C');
		    $i++;
		}

		$this->fpdf->Output();
	}

	public function paket()
	{
		$data['page_title'] = 'Daftar Data Paket';
		$data['paket'] = $this->data_paket_model->list();
		$this->template->pengguna('laporan/paket', $data);
	}

	public function paket_print()
	{
		$headers = array(
			array(
				'text' => 'No',
				'width' => 10
			),
			array(
				'text' => 'Tujuan',
				'width' => 60
			),
			array(
				'text' => 'Pengirim',
				'width' => 60
			),
			array(
				'text' => 'Penerima',
				'width' => 60
			)
		);

		$this->fpdf->SetTitle('Laporan Data Bus');
		$this->fpdf->SetFont('Times', '', 12);
		$this->fpdf->AddPage();

		foreach ($headers as $value) {
		    $this->fpdf->Cell($value['width'], 6, $value['text'], 1, 0, 'C');
		}

		$this->fpdf->Ln();

		$i = 1;
		foreach ($this->data_paket_model->list() as $value) {
		    $this->fpdf->Cell(10, 6, $i, 1, 0, 'C');
		    $this->fpdf->Cell(60, 6, $this->data_tujuan_model->view($value['tujuan'])['nama_tujuan'], 1, 0, 'C');
		    $this->fpdf->Cell(60, 6, $value['pengirim'], 1, 0, 'C');
		    $this->fpdf->Cell(60, 6, $value['penerima'], 1, 1, 'C');
		    $i++;
		}

		$this->fpdf->Output();
	}
}

/* End of file Laporan.php */
/* Location : ./application/controllers/Laporan.php */