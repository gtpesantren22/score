<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dewan extends CI_Controller
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

        $this->load->view('dewan/home', $data);
    }

    public function tanding()
    {
        $data['tanding'] = $this->db->query("SELECT urut, nama, tanding.status AS status, aktif, id_tanding, gel FROM tanding JOIN partai ON tanding.id_partai=partai.id_partai JOIN wasit ON tanding.wasit=wasit.id_wasit")->result();
        $data['partai'] = $this->model->getAll('partai')->result();
        $data['wasit'] = $this->model->getAll('wasit')->result();

        $this->load->view('dewan/tanding', $data);
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
            redirect('dewan/tanding');
        } else {
            $this->model->simpan('tanding', $data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('ok', 'Data tanding berhasil tersimpan');
                redirect('dewan/detail/' . $id);
            } else {
                $this->session->set_flashdata('error', 'Data gagal berhasil tersimpan');
                redirect('dewan/tanding');
            }
        }
    }

    public function detail($id)
    {
        $data['wasit'] = $this->model->getAll('wasit')->result();
        $data['user'] = $this->Auth_model->current_user();

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

        $this->load->view('dewan/detailTanding', $data);
    }

    public function delTanding($id)
    {
        $this->model->hapus('tanding', 'id_tanding', $id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Data tanding berhasil dihapus');
            redirect('dewan/tanding');
        } else {
            $this->session->set_flashdata('error', 'Data gagal berhasil dihapus');
            redirect('dewan/tanding');
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
            redirect('dewan/detail/' . $id);
        } else {
            $this->session->set_flashdata('error', 'Update juri berhasil ');
            redirect('dewan/detail/' . $id);
        }
    }

    public function aktifkan($id)
    {
        $data = ['aktif' => 'Y', 'status' => 'berjalan', 'babak' => 1];
        $tanding = $this->model->getBy('tanding', 'id_tanding', $id)->row();
        $cek = $this->model->getBy2('tanding', 'aktif', 'Y', 'gel', $tanding->gel)->row();
        if ($cek) {
            $this->session->set_flashdata('error', 'Ada pertandingan aktif di gelanggang ini');
            redirect('dewan/detail/' . $id);
        } else {
            $this->model->ubah('tanding', 'id_tanding', $id, $data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('ok', 'Data tanding berhasil diaktifkan');
                redirect('dewan/detail/' . $id);
            } else {
                $this->session->set_flashdata('error', 'Data gagal berhasil diaktifkan');
                redirect('dewan/detail/' . $id);
            }
        }
    }

    public function pindahBabak($id, $bbk)
    {
        $data = ['babak' => $bbk];
        $this->model->ubah('tanding', 'id_tanding', $id, $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Babak berhasil diaktifkan');
            redirect('dewan/detail/' . $id);
        } else {
            $this->session->set_flashdata('error', 'Babak berhasil diaktifkan');
            redirect('dewan/detail/' . $id);
        }
    }

    public function skorHukum($pslt, $idTanding)
    {
        $tandng = $this->db->query("SELECT merah, biru FROM tanding JOIN partai ON tanding.id_partai=partai.id_partai WHERE tanding.id_tanding = '$idTanding' ")->row();
        $idPeserta = $pslt == 'merah' ? $tandng->merah : $tandng->biru;

        $jatuhan1 = $this->db->query("SELECT * FROM hukuman WHERE ket = 'jatuhan' AND id_tanding = '$idTanding' AND id_peserta = '$idPeserta' AND babak = 1 ")->result();
        $jatuhan2 = $this->db->query("SELECT * FROM hukuman WHERE ket = 'jatuhan' AND id_tanding = '$idTanding' AND id_peserta = '$idPeserta' AND babak = 2 ")->result();
        $jatuhan3 = $this->db->query("SELECT * FROM hukuman WHERE ket = 'jatuhan' AND id_tanding = '$idTanding' AND id_peserta = '$idPeserta' AND babak = 3 ")->result();

        $binaan1 = $this->db->query("SELECT COUNT(*) AS jumlah FROM hukuman WHERE ket = 'binaan' AND id_tanding = '$idTanding' AND id_peserta = '$idPeserta' AND babak = 1 ")->result();
        $binaan2 = $this->db->query("SELECT COUNT(*) AS jumlah FROM hukuman WHERE ket = 'binaan' AND id_tanding = '$idTanding' AND id_peserta = '$idPeserta' AND babak = 2 ")->result();
        $binaan3 = $this->db->query("SELECT COUNT(*) AS jumlah FROM hukuman WHERE ket = 'binaan' AND id_tanding = '$idTanding' AND id_peserta = '$idPeserta' AND babak = 3 ")->result();

        $teguran1 = $this->db->query("SELECT * FROM hukuman WHERE (ket = 'teguran' OR ket = 'peringatan') AND id_tanding = '$idTanding' AND id_peserta = '$idPeserta' AND babak = 1 ORDER BY waktu ASC ")->result();
        $teguran2 = $this->db->query("SELECT * FROM hukuman WHERE (ket = 'teguran' OR ket = 'peringatan') AND id_tanding = '$idTanding' AND id_peserta = '$idPeserta' AND babak = 2 ORDER BY waktu ASC ")->result();
        $teguran3 = $this->db->query("SELECT * FROM hukuman WHERE (ket = 'teguran' OR ket = 'peringatan') AND id_tanding = '$idTanding' AND id_peserta = '$idPeserta' AND babak = 3 ORDER BY waktu ASC ")->result();

        echo json_encode(array(
            'jatuhan1' => $jatuhan1,
            'jatuhan2' => $jatuhan2,
            'jatuhan3' => $jatuhan3,
            'binaan1' => $binaan1,
            'binaan2' => $binaan2,
            'binaan3' => $binaan3,
            'hukuman1' => $teguran1,
            'hukuman2' => $teguran2,
            'hukuman3' => $teguran3,
        ));
    }

    public function addNilai()
    {
        $id_hukuman = $this->uuid->v4();
        $id_tanding = $this->input->post('id_tanding', true);
        $id_peserta = $this->input->post('id_peserta', true);
        $id_user = $this->input->post('id_user', true);
        $babak = $this->input->post('babak', true);
        $skor = $this->input->post('skor', true);
        $ket = $this->input->post('ket', true);
        $sudut = $this->input->post('sudut', true);

        if ($ket == 'jatuhan' || $ket == 'binaan') {
            $data = [
                'id_hukuman' => $id_hukuman,
                'id_tanding' => $id_tanding,
                'id_peserta' => $id_peserta,
                'id_user' => $id_user,
                'ket' => $ket,
                'skor' => $skor,
                'babak' => $babak,
                'waktu' => date('Y-m-d H:i:s'),
            ];

            $this->model->simpan('hukuman', $data);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'sudut' => $sudut]);
            } else {
                echo json_encode(['status' => 'gagal']);
            }
        } elseif ($ket == 'teguran') {
            $cek = $this->db->query("SELECT * FROM hukuman WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND babak = $babak AND ket = 'teguran' ")->row();
            $skorPakai = $cek ? -2 : -1;

            $data = [
                'id_hukuman' => $id_hukuman,
                'id_tanding' => $id_tanding,
                'id_peserta' => $id_peserta,
                'id_user' => $id_user,
                'ket' => $ket,
                'skor' => $skorPakai,
                'babak' => $babak,
                'waktu' => date('Y-m-d H:i:s'),
            ];

            $this->model->simpan('hukuman', $data);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'sudut' => $sudut]);
            } else {
                echo json_encode(['status' => 'gagal']);
            }
        } elseif ($ket == 'peringatan') {
            $cek = $this->db->query("SELECT * FROM hukuman WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta'  AND ket = 'peringatan' ")->row();
            $skorPakai = $cek ? -10 : -5;

            $data = [
                'id_hukuman' => $id_hukuman,
                'id_tanding' => $id_tanding,
                'id_peserta' => $id_peserta,
                'id_user' => $id_user,
                'ket' => $ket,
                'skor' => $skorPakai,
                'babak' => $babak,
                'waktu' => date('Y-m-d H:i:s'),
            ];

            $this->model->simpan('hukuman', $data);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'sudut' => $sudut]);
            } else {
                echo json_encode(['status' => 'gagal']);
            }
        }
    }

    public function delNilai()
    {
        $idTanding = $this->input->post('idTanding', true);
        $idPeserta = $this->input->post('idPeserta', true);
        $sudut = $this->input->post('sudut', true);

        $kukum = $this->db->query("SELECT * FROM hukuman WHERE id_tanding = '$idTanding' AND id_peserta = '$idPeserta' ORDER BY waktu DESC LIMIT 1 ")->row();

        $this->model->hapus('hukuman', 'id_hukuman', $kukum->id_hukuman);

        if ($this->db->affected_rows() > 0) {
            echo json_encode(array('status' => 'success', 'sudut' => $sudut));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Gagal menghapus data.'));
        }
    }

    public function selesaikan($id_tanding)
    {
        $data = ['status' => 'selesai', 'aktif' => 'N', 'babak' => 0];

        $this->model->ubah('tanding', 'id_tanding', $id_tanding, $data);
        if ($this->db->affected_rows() > 0) {
            redirect('dewan/winner/' . $id_tanding);
        } else {
            $this->session->set_flashdata('error', 'Update pertandingan gagal');
        }
    }

    public function winner($id)
    {
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

        $this->load->view('dewan/winner', $data);
    }

    public function saveWin()
    {
        $id_tanding = $this->input->post('id_tanding', true);
        $id_peserta = $this->input->post('id_peserta', true);

        $cek = $this->model->getBy2('winner', 'id_tanding', $id_tanding, 'id_peserta', $id_peserta)->row();

        if ($cek) {
            redirect('dewan/tanding');
        } else {
            $data = [
                'id_winner' => $this->uuid->v4(),
                'id_tanding' => $id_tanding,
                'id_peserta' => $id_peserta,
            ];

            $this->model->simpan('winner', $data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('ok', 'Pertandingan Selesai');
                redirect('dewan/tanding');
            } else {
                $this->session->set_flashdata('error', 'Update pertandingan gagal');
                redirect('dewan/tanding');
            }
        }
    }
}
