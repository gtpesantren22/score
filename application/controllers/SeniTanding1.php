<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SeniTanding1 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modeldata', 'model');
        $this->load->model('Auth_model');

        if (!$this->session->userdata('tandingID') && !$this->session->userdata('wasitID')) {
            redirect('wasit/logout');
        }

        $this->idTanding = $this->session->userdata('tandingID');
        $this->idWasit = $this->session->userdata('wasitID');
    }

    public function index()
    {
        $data['wasit'] = $this->model->getBy('wasit', 'id_wasit', $this->idWasit)->row();

        $data['tanding'] = $this->model->getBy('tandingtgr', 'id_tanding', $this->idTanding)->row();
        $data['partai'] = $this->model->getBy('partaitgr', 'id_partai', $data['tanding']->id_partai)->row();
        $data['merah'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->merah)->row();
        $data['biru'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->biru)->row();



        $this->load->view('seni/wasitTanding', $data);
    }

    public function mulaiNilai($id_peserta, $id_tanding)
    {
        $data['user'] = $this->Auth_model->current_user();
        $data['peserta'] = $this->model->getBy('pesertatgr', 'id_peserta', $id_peserta)->row();
        $data['tanding'] = $this->model->getBy('tandingtgr', 'id_tanding', $id_tanding)->row();
        $data['partai'] = $this->model->getBy('partaitgr', 'id_partai', $data['tanding']->id_partai)->row();
        $data['wasit'] = $this->idWasit;
        $data['sudut'] = $data['partai']->merah == $id_peserta ? '#ff0854' : '#057df1';

        $this->load->view('seni/wasitTandingDetail', $data);
    }

    public function addNilai()
    {
        $id_tanding = $this->input->post('id_tanding', true);
        $id_peserta = $this->input->post('id_peserta', true);
        // $id_wasit = $this->input->post('id_wasit', true);
        $skor = $this->input->post('skor', true);
        $ket = $this->input->post('ket', true);
        $kode = $this->input->post('kode', true);
        // echo json_encode($id_tanding);

        $data = [
            'id_nilai' => $this->uuid->v4(),
            'id_tanding' => $id_tanding,
            'id_peserta' => $id_peserta,
            'id_wasit' => $this->idWasit,
            'skor' => $skor,
            'ket' => $ket,
            'kode' => $kode,
            'created' => date('Y-m-d H:i:s'),
        ];
        $this->model->simpan('nilaitgr1', $data);
        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function getSkorStamina($id_tanding, $id_peserta)
    {
        $hasil = $this->db->query("SELECT * FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$this->idWasit' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();
        echo json_encode($hasil ? $hasil->skor : 0);
    }
    public function getSkorWrong($id_tanding, $id_peserta)
    {
        $hasilPlus = $this->db->query("SELECT * FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$this->idWasit' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        $hasil = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$this->idWasit' AND kode = 'WfWrong' ")->row();

        echo json_encode(['wrong' => $hasil ? $hasil->skor : 0, 'plus' => $hasilPlus ? $hasilPlus->skor : 0]);
    }

    public function showJurus($id_tanding, $id_peserta)
    {
        $cek = $this->db->query("SELECT * FROM jurus_pakai WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$this->idWasit' ")->row();
        if (!$cek) {
            $data = [
                'id_tanding' => $id_tanding,
                'id_peserta' => $id_peserta,
                'id_wasit' => $this->idWasit,
                'urut' => 1,
            ];

            $this->model->simpan('jurus_pakai', $data);

            if ($this->db->affected_rows() > 0) {
                $cek = $this->db->query("SELECT * FROM jurus_pakai WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$this->idWasit' ")->row();
                $hasil = $this->db->query("SELECT * FROM jurus WHERE urut = $cek->urut ")->row();
                echo json_encode(['status' => 'success', 'nomor' => $hasil->nomor, 'nama' => $hasil->nama, 'jumlah' => $hasil->jumlah]);
            } else {
                echo json_encode(['status' => 'error']);
            }
        } else {
            $cek = $this->db->query("SELECT * FROM jurus_pakai WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$this->idWasit' ")->row();
            $hasil = $this->db->query("SELECT * FROM jurus WHERE urut = $cek->urut ")->row();
            echo json_encode(['status' => 'success', 'nomor' => $hasil->nomor, 'nama' => $hasil->nama, 'jumlah' => $hasil->jumlah]);
        }
    }

    public function updateJurus()
    {
        $id_tanding = $this->input->post('id_tanding', true);
        $id_peserta = $this->input->post('id_peserta', true);

        $cek = $this->model->getBy3('jurus_pakai', 'id_peserta', $id_peserta, 'id_tanding', $id_tanding, 'id_wasit', $this->idWasit)->row();
        $berikutnya = $cek->urut == 14 ? 14 : $cek->urut + 1;
        $data = ['urut' => $berikutnya];

        $this->db->where('id_peserta', $id_peserta);
        $this->db->where('id_tanding', $id_tanding);
        $this->db->where('id_wasit', $this->idWasit);
        $this->db->update('jurus_pakai', $data);

        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
}
