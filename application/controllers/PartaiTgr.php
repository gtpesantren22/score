<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PartaiTgr extends CI_Controller
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

        $data['partai'] = $this->model->getOrd('partaitgr', 'urut', 'DESC')->result();
        $data['peserta'] = $this->model->getAll('pesertatgr')->result();
        $this->load->view('seni/partai', $data);
    }

    public function partaiAdd()
    {
        $jml = $this->db->query("SELECT MAX(urut) AS urut FROM partaitgr")->row();
        $merah = $this->input->post('merah', true);
        $biru = $this->input->post('biru', true);
        $babak = $this->input->post('babak', true);
        $jenis = $this->input->post('jenis', true);

        $cekmerah = $this->model->getBy('pesertatgr', 'id_peserta', $merah)->row();
        $cekbiru = $this->model->getBy('pesertatgr', 'id_peserta', $biru)->row();
        $cekAda = $this->db->query("SELECT * FROM partaitgr WHERE babak = '$babak' AND (merah = '$merah' OR biru = '$biru') ")->row();

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
            'jenis' => $jenis,
        ];

        if ($cekAda) {
            $this->session->set_flashdata('error', 'Salah satu peserta sudah ada');
            redirect('partaiTgr');
        } else {
            if ($cekmerah->jkl != $cekbiru->jkl) {
                $this->session->set_flashdata('error', 'Gender peserta tidak sama');
                redirect('partaiTgr');
            } else {
                if ($cekmerah->kelas != $cekbiru->kelas) {
                    $this->session->set_flashdata('error', 'Jenis Seni tidak sama');
                    redirect('partaiTgr');
                } else {
                    if ($cekmerah->kategori != $cekbiru->kategori) {
                        $this->session->set_flashdata('error', 'Kategori tanding peserta tidak sama');
                        redirect('partaiTgr');
                    } else {
                        $this->model->simpan('partaitgr', $data);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('ok', 'Data partai berhasil tersimpan');
                            redirect('partaiTgr');
                        } else {
                            $this->session->set_flashdata('error', 'Data gagal berhasil tersimpan');
                            redirect('partaiTgr');
                        }
                    }
                }
            }
        }
    }

    public function delPartai($id)
    {
        $this->model->hapus('partaitgr', 'id_partai', $id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Data partai berhasil dihapus');
            redirect('partaiTgr');
        } else {
            $this->session->set_flashdata('error', 'Data gagal berhasil dihapus');
            redirect('partaiTgr');
        }
    }
}
