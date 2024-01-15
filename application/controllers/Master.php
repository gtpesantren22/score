<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require 'vendor/autoload.php';

class Master extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Modeldata', 'model');

		$this->load->model('Auth_model');
		$user = $this->Auth_model->current_user();

		if (!$this->Auth_model->current_user() && $user->level != 'admin') {
			redirect('login/logout');
		}
	}

	public function index()
	{
		echo "Homeini";
	}
	public function peserta()
	{
		$data['user'] = $this->Auth_model->current_user();

		$data['peserta'] = $this->model->getAll('peserta')->result();
		$this->load->view('peserta', $data);
	}

	public function addPeserta()
	{
		$data = [
			'id_peserta' => $this->uuid->v4(),
			'kategori' => $this->input->post('kategori', true),
			'kontingen' => $this->input->post('kontingen', true),
			'nama' => $this->input->post('nama', true),
			'tgl' => $this->input->post('tgl', true),
			'jkl' => $this->input->post('jkl', true),
			'kelas' => $this->input->post('kelas', true),
			'berat' => $this->input->post('berat', true),
			'pelatih' => $this->input->post('pelatih', true),
			'hp' => $this->input->post('hp', true),
		];

		$this->model->simpan('peserta', $data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('ok', 'Data peserta berhasil tersimpan');
			redirect('master/peserta');
		} else {
			$this->session->set_flashdata('error', 'Data gagal berhasil tersimpan');
			redirect('master/peserta');
		}
	}

	public function delPeserta($id)
	{
		$this->model->hapus('peserta', 'id_peserta', $id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('ok', 'Data peserta berhasil dihapus');
			redirect('master/peserta');
		} else {
			$this->session->set_flashdata('error', 'Data gagal berhasil dihapus');
			redirect('master/peserta');
		}
	}
	public function template()
	{
		force_download('assets/files/Template Upload Peserta.xlsx', NULL);
	}

	public function uploadPeserta()
	{
		// Load library dan helper
		$this->load->helper('file');

		// Konfigurasi upload file
		$config['upload_path'] = 'assets/files/uploads/'; // Direktori penyimpanan file
		$config['allowed_types'] = 'xls|xlsx'; // Jenis file yang diizinkan
		$config['max_size'] = 10240; // Ukuran maksimum file (dalam kilobytes)

		// echo $config['upload_path'];
		// Memuat library upload
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('peserta')) {
			// Jika upload gagal, tampilkan pesan error
			$error = $this->upload->display_errors();
			echo $error;
		} else {
			// Jika upload berhasil, dapatkan informasi file
			$data = $this->upload->data();
			$file_path = $data['full_path'];
			// Load file Excel menggunakan library PHPExcel
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$objPHPExcel = $reader->load($file_path);

			// Mendapatkan data dari worksheet pertama
			$worksheet = $objPHPExcel->getActiveSheet();
			$highestRow = $worksheet->getHighestDataRow();

			// echo $highestRow;

			// Mulai dari baris kedua (untuk melewati header)
			for ($row = 2; $row <= $highestRow; $row++) {

				$data = [
					'id_peserta' => $this->uuid->v4(),
					'kategori' => $worksheet->getCell('B' . $row)->getValue(),
					'kontingen' => $worksheet->getCell('C' . $row)->getValue(),
					'nama' => $worksheet->getCell('D' . $row)->getValue(),
					'tgl' => $worksheet->getCell('E' . $row)->getValue(),
					'jkl' => $worksheet->getCell('F' . $row)->getValue(),
					'kelas' => $worksheet->getCell('G' . $row)->getValue(),
					'berat' => $worksheet->getCell('H' . $row)->getValue(),
					'pelatih' => $worksheet->getCell('I' . $row)->getValue(),
					'hp' => $worksheet->getCell('J' . $row)->getValue(),
				];

				$this->model->simpan('peserta', $data);
			}

			unlink($file_path);

			$this->session->set_flashdata('ok', 'Upload Peserta Selesai');
			redirect('master/peserta');
		}
	}

	public  function wasit()
	{
		$data['user'] = $this->Auth_model->current_user();

		$data['wasit'] = $this->model->getAll('wasit')->result();
		$this->load->view('wasit', $data);
	}

	public function wasitAdd()
	{
		$data = [
			'id_wasit' => $this->uuid->v4(),
			'nama' => $this->input->post('nama', true),
			'alamat' => $this->input->post('alamat', true),
			'hp' => $this->input->post('hp', true),
			'pin' => random(6),
		];

		$this->model->simpan('wasit', $data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('ok', 'Data wasit berhasil tersimpan');
			redirect('master/wasit');
		} else {
			$this->session->set_flashdata('error', 'Data gagal berhasil tersimpan');
			redirect('master/wasit');
		}
	}
	public function delWasit($id)
	{
		$this->model->hapus('wasit', 'id_wasit', $id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('ok', 'Data wasit berhasil dihapus');
			redirect('master/wasit');
		} else {
			$this->session->set_flashdata('error', 'Data gagal berhasil dihapus');
			redirect('master/wasit');
		}
	}

	public function user()
	{
		$data['user'] = $this->Auth_model->current_user();

		$data['userData'] = $this->model->getAll('user')->result();
		$this->load->view('user', $data);
	}

	public function userAdd()
	{
		$data = [
			'id_user' => $this->uuid->v4(),
			'nama' => $this->input->post('nama', true),
			'username' => $this->input->post('username', true),
			'password' => password_hash($this->input->post('password', true), PASSWORD_BCRYPT),
			'level' => $this->input->post('level', true),
			'aktif' => 'Y',
		];

		$this->model->simpan('user', $data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('ok', 'Data User berhasil tersimpan');
			redirect('master/user');
		} else {
			$this->session->set_flashdata('error', 'Data gagal berhasil tersimpan');
			redirect('master/user');
		}
	}

	public function delUser($id)
	{
		$this->model->hapus('user', 'id_user', $id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('ok', 'Data user berhasil dihapus');
			redirect('master/user');
		} else {
			$this->session->set_flashdata('error', 'Data gagal berhasil dihapus');
			redirect('master/user');
		}
	}
}
