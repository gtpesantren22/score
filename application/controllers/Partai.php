<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Partai extends CI_Controller
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
        $data['user'] = $this->Auth_model->current_user();

        $data['partai'] = $this->model->getOrd('partai', 'urut', 'DESC')->result();
        $data['peserta'] = $this->model->getAll('peserta')->result();
        $this->load->view('partai', $data);
    }

    public function partaiAdd()
    {
        $jml = $this->db->query("SELECT MAX(urut) AS urut FROM partai")->row();
        $merah = $this->input->post('merah', true);
        $biru = $this->input->post('biru', true);
        $babak = $this->input->post('babak', true);

        $cekmerah = $this->model->getBy('peserta', 'id_peserta', $merah)->row();
        $cekbiru = $this->model->getBy('peserta', 'id_peserta', $biru)->row();
        $cekAda = $this->db->query("SELECT * FROM partai WHERE babak = '$babak' AND (merah = '$merah' OR biru = '$biru') ")->row();

        if ($cekAda) {
            echo 'data ada';
        } else {
            echo 'data ksonh';
        }

        $data = [
            'id_partai' => $this->uuid->v4(),
            'urut' => $jml->urut + 1,
            'babak' => $babak,
            'merah' => $merah,
            'biru' => $biru,
            'tanggal' => $this->input->post('tanggal', true),
        ];

        if ($cekAda) {
            $this->session->set_flashdata('error', 'Salah satu peserta sudah ada');
            redirect('partai');
        } else {
            if ($cekmerah->jkl != $cekbiru->jkl) {
                $this->session->set_flashdata('error', 'Gender peserta tidak sama');
                redirect('partai');
            } else {
                if ($cekmerah->kelas != $cekbiru->kelas) {
                    $this->session->set_flashdata('error', 'Kelas peserta tidak sama');
                    redirect('partai');
                } else {
                    if ($cekmerah->kategori != $cekbiru->kategori) {
                        $this->session->set_flashdata('error', 'Kategori tanding peserta tidak sama');
                        redirect('partai');
                    } else {
                        $this->model->simpan('partai', $data);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('ok', 'Data partai berhasil tersimpan');
                            redirect('partai');
                        } else {
                            $this->session->set_flashdata('error', 'Data gagal berhasil tersimpan');
                            redirect('partai');
                        }
                    }
                }
            }
        }
    }

    public function delPartai($id)
    {
        $this->model->hapus('partai', 'id_partai', $id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Data partai berhasil dihapus');
            redirect('partai');
        } else {
            $this->session->set_flashdata('error', 'Data gagal berhasil dihapus');
            redirect('partai');
        }
    }
}
