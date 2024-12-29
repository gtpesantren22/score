<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TandingTgr1 extends CI_Controller
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
        $this->socket = $this->model->getBy('settings', 'name', 'socket')->row('value');
    }

    public function index()
    {
        $data['user'] = $this->Auth_model->current_user();

        $data['tanding'] = $this->db->query("SELECT urut, nama, tandingtgr.status AS status, aktif, id_tanding, gel FROM tandingtgr JOIN partaitgr ON tandingtgr.id_partai=partaitgr.id_partai JOIN wasit ON tandingtgr.wasit=wasit.id_wasit WHERE partaitgr.jenis = 'Tunggal' ORDER BY urut DESC")->result();
        $data['partai'] = $this->model->getAll('partaitgr')->result();
        $data['wasit'] = $this->model->getAll('wasit')->result();

        $this->load->view('seni/tanding', $data);
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

        $cek = $this->model->getBy('tandingtgr', 'id_partai', $id_partai)->row();
        if ($cek) {
            $this->session->set_flashdata('error', 'Partai ini sudah ada');
            redirect('tanding');
        } else {
            $this->model->simpan('tandingtgr', $data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('ok', 'Data tanding berhasil tersimpan');
                redirect('tandingTgr1/detail/' . $id);
            } else {
                $this->session->set_flashdata('error', 'Data gagal berhasil tersimpan');
                redirect('tandingTgr1');
            }
        }
    }

    public function detail($id)
    {
        $data['user'] = $this->Auth_model->current_user();

        $data['wasit'] = $this->model->getAll('wasit')->result();

        $data['tanding'] = $this->model->getBy('tandingtgr', 'id_tanding', $id)->row();
        $data['partai'] = $this->model->getBy('partaitgr', 'id_partai', $data['tanding']->id_partai)->row();
        $data['merah'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->merah)->row();
        $data['biru'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->biru)->row();

        $data['ketua'] = $this->model->getBy('wasit', 'id_wasit', $data['tanding']->wasit)->row();
        $data['juri1'] = $this->model->getBy('wasit', 'id_wasit', $data['tanding']->juri1)->row();
        $data['juri2'] = $this->model->getBy('wasit', 'id_wasit', $data['tanding']->juri2)->row();
        $data['juri3'] = $this->model->getBy('wasit', 'id_wasit', $data['tanding']->juri3)->row();
        $data['juri4'] = $this->model->getBy('wasit', 'id_wasit', $data['tanding']->juri4)->row();
        $data['juri5'] = $this->model->getBy('wasit', 'id_wasit', $data['tanding']->juri5)->row();
        $data['socket'] = $this->socket;

        $this->load->view('seni/detailTanding', $data);
    }

    public function updateKetua()
    {
        $id = $this->input->post('id', true);
        $data = ['wasit' => $this->input->post('wasit', true)];

        $this->model->ubah('tandingtgr', 'id_tanding', $id, $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Update ketua berhasil ');
            redirect('tandingTgr1/detail/' . $id);
        } else {
            $this->session->set_flashdata('error', 'Update ketua berhasil ');
            redirect('tandingTgr1/detail/' . $id);
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

        $this->model->ubah('tandingtgr', 'id_tanding', $id, $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Update juri berhasil ');
            redirect('tandingTgr1/detail/' . $id);
        } else {
            $this->session->set_flashdata('error', 'Update juri berhasil ');
            redirect('tandingTgr1/detail/' . $id);
        }
    }

    public function aktifkan($id)
    {
        $data = ['aktif' => 'Y', 'status' => 'berjalan'];
        $tanding = $this->model->getBy('tandingtgr', 'id_tanding', $id)->row();
        $cek = $this->model->getBy2('tandingtgr', 'aktif', 'Y', 'gel', $tanding->gel)->row();
        if ($cek) {
            $this->session->set_flashdata('error', 'Ada pertandingan aktif di gelanggang ini');
            redirect('tandingTgr1/detail/' . $id);
        } else {
            $this->model->ubah('tandingtgr', 'id_tanding', $id, $data);
            if ($this->db->affected_rows() > 0) {
                // $this->session->set_flashdata('ok', 'Data tanding berhasil diaktifkan');
                // redirect('tandingTgr1/detail/' . $id);
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error']);
                // $this->session->set_flashdata('error', 'Data gagal berhasil diaktifkan');
                // redirect('tandingTgr1/detail/' . $id);
            }
        }
    }

    public function selesaikan($id_tanding)
    {
        $data = ['status' => 'selesai', 'aktif' => 'N', 'babak' => 0];
        $cek2 = $this->model->getBy('tandingtgr', 'id_tanding', $id_tanding)->row();

        $this->model->ubah('wasit', 'id_wasit', $cek2->juri1, ['status' => 'N']);
        $this->model->ubah('wasit', 'id_wasit', $cek2->juri2, ['status' => 'N']);
        $this->model->ubah('wasit', 'id_wasit', $cek2->juri3, ['status' => 'N']);
        $this->model->ubah('wasit', 'id_wasit', $cek2->juri4, ['status' => 'N']);
        $this->model->ubah('wasit', 'id_wasit', $cek2->juri5, ['status' => 'N']);

        $this->model->ubah('tandingtgr', 'id_tanding', $id_tanding, $data);
        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success']);
            // redirect('tandingTgr1');
        } else {
            echo json_encode(['status' => 'error']);
            // $this->session->set_flashdata('error', 'Update pertandingan gagal');
        }
    }
}
