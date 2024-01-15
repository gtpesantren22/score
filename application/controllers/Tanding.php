<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tanding extends CI_Controller
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

        $data['tanding'] = $this->db->query("SELECT urut, nama, status, aktif, id_tanding, gel FROM tanding JOIN partai ON tanding.id_partai=partai.id_partai JOIN wasit ON tanding.wasit=wasit.id_wasit")->result();
        $data['partai'] = $this->model->getAll('partai')->result();
        $data['wasit'] = $this->model->getAll('wasit')->result();

        $this->load->view('tanding', $data);
    }

    public function tandingAdd()
    {
        $id_partai = $this->input->post('id_partai', true);
        $id = $this->uuid->v4();
        $data = [
            'id_tanding' => $id,
            'wasit' => $this->input->post('wasit', true),
            'gel' => $this->input->post('gel', true),
            'id_partai' => $id_partai,
        ];

        $cek = $this->model->getBy('tanding', 'id_partai', $id_partai)->row();
        if ($cek) {
            $this->session->set_flashdata('error', 'Partai ini sudah ada');
            redirect('tanding');
        } else {
            $this->model->simpan('tanding', $data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('ok', 'Data tanding berhasil tersimpan');
                redirect('tanding/detail/' . $id);
            } else {
                $this->session->set_flashdata('error', 'Data gagal berhasil tersimpan');
                redirect('tanding');
            }
        }
    }

    public function delTanding($id)
    {
        $this->model->hapus('tanding', 'id_tanding', $id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Data tanding berhasil dihapus');
            redirect('tanding');
        } else {
            $this->session->set_flashdata('error', 'Data gagal berhasil dihapus');
            redirect('tanding');
        }
    }

    public function detail($id)
    {
        $data['user'] = $this->Auth_model->current_user();

        $data['wasit'] = $this->model->getAll('wasit')->result();

        $data['tanding'] = $this->model->getBy('tanding', 'id_tanding', $id)->row();
        $data['partai'] = $this->model->getBy('partai', 'id_partai', $data['tanding']->id_partai)->row();
        $data['merah'] = $this->model->getBy('peserta', 'id_peserta', $data['partai']->merah)->row();
        $data['biru'] = $this->model->getBy('peserta', 'id_peserta', $data['partai']->biru)->row();

        $data['ketua'] = $this->model->getBy('wasit', 'id_wasit', $data['tanding']->wasit)->row();
        $data['juri1'] = $this->model->getBy('wasit', 'id_wasit', $data['tanding']->juri1)->row();
        $data['juri2'] = $this->model->getBy('wasit', 'id_wasit', $data['tanding']->juri2)->row();
        $data['juri3'] = $this->model->getBy('wasit', 'id_wasit', $data['tanding']->juri3)->row();
        $data['juri4'] = $this->model->getBy('wasit', 'id_wasit', $data['tanding']->juri4)->row();
        $data['juri5'] = $this->model->getBy('wasit', 'id_wasit', $data['tanding']->juri5)->row();

        $this->load->view('detailTanding', $data);
    }

    public function updateKetua()
    {
        $id = $this->input->post('id', true);
        $data = ['wasit' => $this->input->post('wasit', true)];

        $this->model->ubah('tanding', 'id_tanding', $id, $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Update ketua berhasil ');
            redirect('tanding/detail/' . $id);
        } else {
            $this->session->set_flashdata('error', 'Update ketua berhasil ');
            redirect('tanding/detail/' . $id);
        }
    }
    public function updateJuri()
    {
        $id = $this->input->post('id', true);
        $data = [
            'juri1' => $this->input->post('juri1', true),
            'juri2' => $this->input->post('juri2', true),
            'juri3' => $this->input->post('juri3', true),
            'juri4' => $this->input->post('juri4', true),
            'juri5' => $this->input->post('juri5', true),
        ];

        $this->model->ubah('tanding', 'id_tanding', $id, $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Update juri berhasil ');
            redirect('tanding/detail/' . $id);
        } else {
            $this->session->set_flashdata('error', 'Update juri berhasil ');
            redirect('tanding/detail/' . $id);
        }
    }
    public function aktifkan($id)
    {
        $data = ['aktif' => 'Y', 'status' => 'berjalan'];
        $cek = $this->model->getBy2('tanding', 'aktif', 'Y',);
        $this->model->ubah('tanding', 'id_tanding', $id, $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Data tanding berhasil diaktifkan');
            redirect('tanding/detail/' . $id);
        } else {
            $this->session->set_flashdata('error', 'Data gagal berhasil diaktifkan');
            redirect('tanding/detail/' . $id);
        }
    }

    public function pindahBabak($id, $bbk)
    {
        $data = ['babak' => $bbk];
        $this->model->ubah('tanding', 'id_tanding', $id, $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Babak berhasil diaktifkan');
            redirect('tanding/detail/' . $id);
        } else {
            $this->session->set_flashdata('error', 'Babak berhasil diaktifkan');
            redirect('tanding/detail/' . $id);
        }
    }

    public function totalSkor($pslt, $id_tanding)
    {
        $tandng = $this->db->query("SELECT merah, biru FROM tanding JOIN partai ON tanding.id_partai=partai.id_partai WHERE tanding.id_tanding = '$id_tanding' ")->row();
        $idPeserta = $pslt == 'merah' ? $tandng->merah : $tandng->biru;

        $nilai = $this->db->query("SELECT SUM(skor) as total FROM nilai WHERE id_tanding = '$id_tanding' AND id_peserta = '$idPeserta' ")->row();

        echo json_encode($nilai->total);
    }

    public function skorBabak($babk, $idTanding)
    {
        $data['user'] = $this->Auth_model->current_user();

        $data['tanding'] = $this->db->query("SELECT * FROM tanding JOIN partai ON tanding.id_partai=partai.id_partai WHERE tanding.id_tanding = '$idTanding' ")->row();
        $data['babak'] = $babk;

        $this->load->view('skorTanding', $data);
    }
}
