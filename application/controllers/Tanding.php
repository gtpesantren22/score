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

        $data['tanding'] = $this->db->query("SELECT urut, nama, tanding.status AS status, aktif, id_tanding, gel FROM tanding JOIN partai ON tanding.id_partai=partai.id_partai JOIN wasit ON tanding.wasit=wasit.id_wasit ORDER BY urut DESC")->result();
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
        $data = ['aktif' => 'Y', 'status' => 'berjalan', 'babak' => 1];
        $tanding = $this->model->getBy('tanding', 'id_tanding', $id)->row();
        $cek = $this->model->getBy2('tanding', 'aktif', 'Y', 'gel', $tanding->gel)->row();
        if ($cek) {
            $this->session->set_flashdata('error', 'Ada pertandingan aktif di gelanggang ini');
            redirect('tanding/detail/' . $id);
        } else {
            $this->model->ubah('tanding', 'id_tanding', $id, $data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('ok', 'Data tanding berhasil diaktifkan');
                redirect('tanding/detail/' . $id);
            } else {
                $this->session->set_flashdata('error', 'Data gagal berhasil diaktifkan');
                redirect('tanding/detail/' . $id);
            }
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

    public function selesaikan($id_tanding)
    {
        $data = ['status' => 'selesai', 'aktif' => 'N', 'babak' => 0];
        $cek2 = $this->model->getBy('tanding', 'id_tanding', $id_tanding)->row();

        $this->model->ubah('wasit', 'id_wasit', $cek2->juri1, ['status' => 'N']);
        $this->model->ubah('wasit', 'id_wasit', $cek2->juri2, ['status' => 'N']);
        $this->model->ubah('wasit', 'id_wasit', $cek2->juri3, ['status' => 'N']);

        $this->model->ubah('tanding', 'id_tanding', $id_tanding, $data);
        if ($this->db->affected_rows() > 0) {
            redirect('tanding/winner/' . $id_tanding);
        } else {
            $this->session->set_flashdata('error', 'Update pertandingan gagal');
        }
    }

    public function winner($id)
    {
        $data['user'] = $this->Auth_model->current_user();
        $data['tanding'] = $this->model->getBy('tanding', 'id_tanding', $id)->row();
        $data['partai'] = $this->model->getBy('partai', 'id_partai', $data['tanding']->id_partai)->row();
        $merah = $data['partai']->merah;
        $biru = $data['partai']->biru;

        $data['merah'] = $this->model->getBy('peserta', 'id_peserta', $merah)->row();
        $data['biru'] = $this->model->getBy('peserta', 'id_peserta', $biru)->row();

        $pointJuriMerah = $this->db->query("SELECT SUM(skor) AS point FROM nilai_fix WHERE id_tanding = '$id' AND id_peserta = '$merah' ")->row();
        $pointMerah = $this->db->query("SELECT SUM(skor) AS point FROM hukuman WHERE id_tanding = '$id' AND id_peserta = '$merah' ")->row();

        $pointJuriBiru = $this->db->query("SELECT SUM(skor) AS point FROM nilai_fix WHERE id_tanding = '$id' AND id_peserta = '$biru' ")->row();
        $pointBiru = $this->db->query("SELECT SUM(skor) AS point FROM hukuman WHERE id_tanding = '$id' AND id_peserta = '$biru' ")->row();

        $data['skorMerah'] = $pointJuriMerah->point + $pointMerah->point;
        $data['skorBiru'] = $pointJuriBiru->point + $pointBiru->point;

        $this->load->view('tanding/winner', $data);
    }

    public function saveWin()
    {
        $id_tanding = $this->input->post('id_tanding', true);
        $id_peserta = $this->input->post('id_peserta', true);

        $cek = $this->model->getBy2('winner', 'id_tanding', $id_tanding, 'id_peserta',  $id_peserta)->row();

        if ($cek) {
            redirect('tanding');
        } else {
            $data = [
                'id_winner' => $this->uuid->v4(),
                'id_tanding' => $id_tanding,
                'id_peserta' => $id_peserta,
            ];

            $this->model->simpan('winner', $data);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('ok', 'Pertandingan Selesai');
                redirect('tanding');
            } else {
                $this->session->set_flashdata('error', 'Update pertandingan gagal');
                redirect('tanding');
            }
        }
    }
}
