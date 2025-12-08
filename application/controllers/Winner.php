<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Winner extends CI_Controller
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

        $this->load->view('winner', $data);
    }

    public function datas()
    {
        $data = $this->db->query("SELECT winner.id_winner, partai.urut, partai.babak, peserta.* FROM winner JOIN tanding ON tanding.id_tanding=winner.id_tanding JOIN partai ON partai.id_partai=tanding.id_partai JOIN peserta ON winner.id_peserta=peserta.id_peserta WHERE winner.add != 1 ORDER BY partai.urut ASC")->result();

        echo json_encode($data);
    }
    public function partai()
    {
        $data = $this->model->getByOrd('partai_sm', 'ket', 'N', 'urut', 'ASC')->result();
        $dataview = [];
        foreach ($data as $row) {
            $merahdata = $row->merah ? $this->model->getBy('peserta', 'id_peserta', $row->merah)->row() : null;
            $birudata = $row->biru ? $this->model->getBy('peserta', 'id_peserta', $row->biru)->row() : null;
            $dataview[] = [
                'id_partai' => $row->id_partai,
                'urut' => $row->urut,
                'id_winner_merah' => $row->id_winner_merah,
                'id_winner_biru' => $row->id_winner_biru,
                'babak' => $row->babak,
                'merah' => $merahdata,
                'biru' => $birudata,
            ];
        }

        echo json_encode($dataview);
    }

    public function addWinner()
    {
        $id_winner = $this->input->post('id_winner');
        $windata = $this->model->getBy('winner', 'id_winner', $id_winner)->row();
        $cekPartai = $this->db->query("SELECT * FROM partai_sm WHERE ket = 'N' ORDER BY urut DESC LIMIT 1")->row();
        $rincianPeserta = $this->model->getBy('peserta', 'id_peserta', $windata->id_peserta)->row();
        if (!$cekPartai) {
            $cekPartai = $this->db->query("SELECT MAX(urut) AS max FROM partai_sm")->row();
            $datasave = [
                'id_partai' => $this->uuid->v4(),
                'urut' => $cekPartai->max + 1,
                'merah' => $windata->id_peserta,
                'babak' => '-',
                'ket' => 'N',
                'kelas' => $rincianPeserta->kelas,
                'kategori' => $rincianPeserta->kategori,
                'jkl' => $rincianPeserta->jkl,
                'id_winner_merah' => $id_winner,
            ];
            $this->model->simpan('partai_sm', $datasave);
            if ($this->db->affected_rows() > 0) {
                $this->model->ubah('winner', 'id_winner', $id_winner, ['add' => 1]);
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'error Add Partai']);
            }
        } elseif ($cekPartai && $cekPartai->merah == null && $cekPartai->biru == null) {
            $this->model->ubah('partai_sm', 'id_partai', $cekPartai->id_partai, ['merah' => $windata->id_peserta, 'id_winner_merah' => $id_winner]);
            if ($this->db->affected_rows() > 0) {
                $this->model->ubah('winner', 'id_winner', $id_winner, ['add' => 1]);
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'error update']);
            }
        } elseif ($cekPartai && $cekPartai->merah != null && $cekPartai->biru == null) {
            $this->model->ubah('partai_sm', 'id_partai', $cekPartai->id_partai, ['biru' => $windata->id_peserta, 'id_winner_biru' => $id_winner]);
            if ($this->db->affected_rows() > 0) {
                $this->model->ubah('winner', 'id_winner', $id_winner, ['add' => 1]);
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'error update']);
            }
        } elseif ($cekPartai && $cekPartai->merah != null && $cekPartai->biru != null) {
            $cekPartai = $this->db->query("SELECT MAX(urut) AS max FROM partai_sm")->row();
            $datasave = [
                'id_partai' => $this->uuid->v4(),
                'urut' => $cekPartai->max + 1,
                'merah' => $windata->id_peserta,
                'babak' => '-',
                'ket' => 'N',
                'kelas' => $rincianPeserta->kelas,
                'kategori' => $rincianPeserta->kategori,
                'jkl' => $rincianPeserta->jkl,
                'id_winner_merah' => $id_winner,
            ];
            $this->model->simpan('partai_sm', $datasave);
            if ($this->db->affected_rows() > 0) {
                $this->model->ubah('winner', 'id_winner', $id_winner, ['add' => 1]);
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'error update']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Logic not found']);
        }
    }
    public function updateWinner()
    {
        $id_winner = $this->input->post('id_winner', true);
        $id_partai = $this->input->post('id_partai', true);
        $sudut = $this->input->post('sudut', true);
        $cekpartai = $this->model->getBy('partai_sm', 'id_partai', $id_partai)->row();

        $this->model->ubah('winner', 'id_winner', $id_winner, ['add' => 0]);
        if ($this->db->affected_rows() > 0) {
            if ($cekpartai->merah == null || $cekpartai->biru == null) {
                $this->model->hapus('partai_sm', 'id_partai', $id_partai);
            } else {
                $this->model->ubah('partai_sm', 'id_partai', $id_partai, [$sudut => null]);
            }
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function updateBabak()
    {
        $babak = $this->input->post('babak', true);
        $this->model->ubah('partai_sm', 'ket', 'N', ['babak' => $babak]);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Berhasil update Babak');
            redirect('winner');
        } else {
            $this->session->set_flashdata('error', 'Gagal update Babak');
            redirect('winner');
        }
    }

    public function savePartai()
    {
        $data = $this->model->getBy('partai_sm', 'ket', 'N')->result();
        foreach ($data as $value) {
            $id = $value->id_partai;
            $dataUpdate = ['ket' => 'Y'];
            $dataSimpan = [
                'id_partai' => $id,
                'urut' => $value->urut,
                'babak' => $value->babak,
                'merah' => $value->merah,
                'biru' => $value->biru,
            ];
            $this->model->simpan('partai', $dataSimpan);
            $this->model->ubah('partai_sm', 'id_partai', $id, $dataUpdate);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Berhasil update Babak');
            redirect('winner');
        } else {
            $this->session->set_flashdata('error', 'Gagal update Babak');
            redirect('winner');
        }
    }
}
