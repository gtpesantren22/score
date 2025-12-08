<?php

use PHPUnit\Util\Json;

defined('BASEPATH') or exit('No direct script access allowed');

class DewanTgr1 extends CI_Controller
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

    public function index() {}

    public function tanding()
    {
        $tanding = $this->db->query("SELECT urut, nama, tandingtgr.status AS status, aktif, id_tanding, gel, merah, biru FROM tandingtgr JOIN partaitgr ON tandingtgr.id_partai=partaitgr.id_partai JOIN wasit ON tandingtgr.wasit=wasit.id_wasit WHERE tandingtgr.aktif = 'Y' AND partaitgr.jenis = 'Tunggal' ORDER BY partaitgr.urut DESC");
        $data['tanding'] = $tanding->result();
        $data['id_tanding'] = $tanding->row('id_tanding');
        $data['dtltanding'] = $tanding->row();
        $data['socket'] = $this->socket;

        $this->load->view('seni/tandingDewan', $data);
    }

    public function detail($id)
    {
        $data['wasit'] = $this->model->getAll('wasit')->result();
        $data['user'] = $this->Auth_model->current_user();

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

        $this->load->view('seni/detailTandingDewan', $data);
    }

    public function mulaiNilai($peserta, $tanding)
    {
        $data['user'] = $this->Auth_model->current_user();
        $data['peserta'] = $this->model->getBy('pesertatgr', 'id_peserta', $peserta)->row();
        $data['tanding'] = $this->model->getBy('tandingtgr', 'id_tanding', $tanding)->row();
        $data['partai'] = $this->model->getBy('partaitgr', 'id_partai', $data['tanding']->id_partai)->row();
        $data['detail'] = $this->model->getBy2('detailtgr', 'id_tanding', $tanding, 'id_peserta', $peserta)->row();
        $data['sudut'] = $peserta == $data['partai']->merah ? 'red' : 'blue';
        $data['socket'] = $this->socket;

        $dataInput = [
            'id_peserta' => $peserta,
            'id_tanding' => $tanding,
            'id_detail' => $this->uuid->v4(),
            'status' => 'belum',
            'tutup' => 'belum',
        ];

        $cek = $this->model->getBy2('detailtgr', 'id_tanding', $tanding, 'id_peserta', $peserta)->row();
        if ($cek) {
            $this->load->view('seni/nilaiDewan', $data);
        } else {
            $this->model->simpan('detailtgr', $dataInput);
            if ($this->db->affected_rows() > 0) {
                redirect('dewantgr1/mulaiNilai/' . $peserta . '/' . $tanding);
            } else {
                $this->session->set_flashdata('error', 'Gagal membuat detail data');
                redirect('dewantgr1/tanding');
            }
        }
    }

    public function mulaiProsesPenilaian()
    {
        $id_tanding = $this->input->post('id_tanding', true);
        $id_peserta = $this->input->post('id_peserta', true);

        $cek = $this->model->getBy3('detailtgr', 'id_tanding', $id_tanding, 'status', 'proses', 'tutup', 'belum')->row();
        $cek2 = $this->model->getBy3('detailtgr', 'id_tanding', $id_tanding, 'status', 'selesai', 'tutup', 'belum')->row();
        if ($cek || $cek2) {
            $this->session->set_flashdata('error', 'Harap tutup sesi penilaian pesilat sebelumnya');
            redirect('dewantgr1/mulaiNilai/' . $id_peserta . '/' . $id_tanding);
        } else {
            $this->db->where('id_tanding', $id_tanding);
            $this->db->where('id_peserta', $id_peserta);
            $this->db->update('detailtgr', ['status' => 'proses']);
            if ($this->db->affected_rows() > 0) {
                redirect('dewantgr1/mulaiNilai/' . $id_peserta . '/' . $id_tanding);
            } else {
                $this->session->set_flashdata('error', 'Mulai Proses penilaian gagal');
                redirect('dewantgr1/mulaiNilai/' . $id_peserta . '/' . $id_tanding);
            }
        }
    }
    public function tutupSesiPenilaian()
    {
        $id_tanding = $this->input->post('id_tanding', true);
        $id_peserta = $this->input->post('id_peserta', true);


        $this->db->where('id_tanding', $id_tanding);
        $this->db->where('id_peserta', $id_peserta);
        $this->db->update('detailtgr', ['tutup' => 'ya']);
        if ($this->db->affected_rows() > 0) {
            redirect('dewantgr1/tanding');
        } else {
            $this->session->set_flashdata('error', 'Tutup sesi penilaian gagal');
            redirect('dewantgr1/mulaiNilai/' . $id_peserta . '/' . $id_tanding);
        }
    }

    public function addNilai()
    {
        $id_tanding = $this->input->post('id_tanding', true);
        $id_peserta = $this->input->post('id_peserta', true);
        $id_wasit = $this->input->post('id_wasit', true);
        $skor = $this->input->post('skor', true);
        $ket = $this->input->post('ket', true);
        $kode = $this->input->post('kode', true);

        $data = [
            'id_nilai' => $this->uuid->v4(),
            'id_tanding' => $id_tanding,
            'id_peserta' => $id_peserta,
            'id_wasit' => $id_wasit,
            'skor' => $skor,
            'ket' => $ket,
            'kode' => $kode,
        ];
        $this->model->simpan('nilaitgr1', $data);
        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function getSkor($kode, $id_tanding, $id_peserta)
    {
        $skor = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND kode = '$kode' ")->row();
        echo json_encode($skor->skor ? $skor->skor : 0);
    }

    public function getSkorAll($id_tanding, $id_peserta)
    {
        $skor = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND kode LIKE 'D%' ")->row();
        echo json_encode($skor->skor ? $skor->skor : 0);
    }

    public function delNilai()
    {
        $id_tanding = $this->input->post('id_tanding', true);
        $id_peserta = $this->input->post('id_peserta', true);
        $kode = $this->input->post('kode', true);
        // echo json_encode($id_tanding);

        $this->db->query("DELETE FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND kode = '$kode' LIMIT 1 ");
        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success']);
        } else {
            log_message('error', 'Error in DELETE query: ' . $this->db->last_query());
            echo json_encode(['status' => 'error']);
        }
    }

    public function proses_rekap()
    {
        $id_tanding = $this->input->post('id_tanding', true);
        $id_peserta = $this->input->post('id_peserta', true);
        $timer = $this->input->post('timer', true);

        $tanding = $this->model->getBy('tandingtgr', 'id_tanding', $id_tanding)->row();

        $juri1A = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$tanding->juri1' AND kode != 'WpStmina' ")->row();
        $juri1B = $this->db->query("SELECT skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$tanding->juri1' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        $juri2A = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$tanding->juri2' AND kode != 'WpStmina' ")->row();
        $juri2B = $this->db->query("SELECT skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$tanding->juri2' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        $juri3A = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$tanding->juri3' AND kode != 'WpStmina' ")->row();
        $juri3B = $this->db->query("SELECT skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$tanding->juri3' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        $juri4A = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$tanding->juri4' AND kode != 'WpStmina' ")->row();
        $juri4B = $this->db->query("SELECT skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$tanding->juri4' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        $juri5A = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$tanding->juri5' AND kode != 'WpStmina' ")->row();
        $juri5B = $this->db->query("SELECT skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND id_wasit = '$tanding->juri5' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        $dewan = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND kode like 'D%' ")->row();

        $datajuri1 = ['id_tanding' => $id_tanding, 'id_peserta' => $id_peserta, 'skor' => 9.90 + (($juri1A ? $juri1A->skor : 0) + ($juri1B ? $juri1B->skor : 0)), 'juri' => 1, 'ket' => 'juri'];
        $datajuri2 = ['id_tanding' => $id_tanding, 'id_peserta' => $id_peserta, 'skor' => 9.90 + (($juri2A ? $juri2A->skor : 0) + ($juri2B ? $juri2B->skor : 0)), 'juri' => 2, 'ket' => 'juri'];
        $datajuri3 = ['id_tanding' => $id_tanding, 'id_peserta' => $id_peserta, 'skor' => 9.90 + (($juri3A ? $juri3A->skor : 0) + ($juri3B ? $juri3B->skor : 0)), 'juri' => 3, 'ket' => 'juri'];
        $datajuri4 = ['id_tanding' => $id_tanding, 'id_peserta' => $id_peserta, 'skor' => 9.90 + (($juri4A ? $juri4A->skor : 0) + ($juri4B ? $juri4B->skor : 0)), 'juri' => 4, 'ket' => 'juri'];
        $datajuri5 = ['id_tanding' => $id_tanding, 'id_peserta' => $id_peserta, 'skor' => 9.90 + (($juri5A ? $juri5A->skor : 0) + ($juri5B ? $juri5B->skor : 0)), 'juri' => 5, 'ket' => 'juri'];
        $datadewan = ['id_tanding' => $id_tanding, 'id_peserta' => $id_peserta, 'skor' => $dewan ? $dewan->skor : 0, 'juri' => 0, 'ket' => 'dewan'];

        $this->model->simpan('nilaitgr1_fix', $datajuri1);
        $this->model->simpan('nilaitgr1_fix', $datajuri2);
        $this->model->simpan('nilaitgr1_fix', $datajuri3);
        $this->model->simpan('nilaitgr1_fix', $datajuri4);
        $this->model->simpan('nilaitgr1_fix', $datajuri5);
        $this->model->simpan('nilaitgr1_fix', $datadewan);

        $this->db->where('id_tanding', $id_tanding);
        $this->db->where('id_peserta', $id_peserta);
        $this->db->update('detailtgr', ['status' => 'selesai', 'waktu' => $timer]);

        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'ok']);
            // redirect('dewantgr1/mulainilai/' . $id_peserta . '/' . $id_tanding);
        }
    }

    public function cekRekap($id_tanding, $id_peserta)
    {
        $detail = $this->model->getBy2('detailtgr', 'id_peserta', $id_peserta, 'id_tanding', $id_tanding)->row();
        echo json_encode(['status' => $detail->status]);
    }

    public function tampilRekap($id_tanding, $id_peserta)
    {
        $data['data'] = $this->model->getBy3Ord('nilaitgr1_fix', 'id_tanding', $id_tanding, 'id_peserta', $id_peserta, 'ket', 'juri', 'skor', 'ASC')->result();
        $data['penalti'] = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND kode like 'D%' ")->row();
        $data['detail'] = $this->model->getBy2('detailtgr', 'id_peserta', $id_peserta, 'id_tanding', $id_tanding)->row();


        $skorArray = [];
        // Iterasi melalui hasil query
        foreach ($data['data'] as $row) {
            // Ambil nilai skor dari setiap objek dan masukkan ke dalam array
            $skorArray[] = $row->skor;
        }

        $data['deviasi'] = $this->calculate_standard_deviation($skorArray);
        $this->load->view('seni/view_layar/rekap', $data);
    }

    function calculate_standard_deviation($numbers)
    {
        $n = count($numbers);
        if ($n == 0) {
            return 0;
        }

        // Hitung rata-rata
        $mean = array_sum($numbers) / $n;

        // Hitung variansi
        $variance = 0.0;
        foreach ($numbers as $number) {
            $variance += pow($number - $mean, 2);
        }
        $variance /= ($n - 1); // Menggunakan n-1 untuk sampel

        // Hitung standar deviasi
        $standard_deviation = sqrt($variance);

        return $standard_deviation;
    }

    public function penentuan()
    {
        $id_tanding = $this->input->post('id_tanding', true);
        $cek = $this->model->getBy2('detailtgr', 'id_tanding', $id_tanding, 'tutup', 'belum')->num_rows();
        if ($cek) {
            $this->session->set_flashdata('error', 'Ada penilian yang masih berjalan. Harap selesaikan dan tutup terlebih dahulu!');
            redirect('dewantgr1/tanding');
        } else {
            $this->model->ubah('tandingtgr', 'id_tanding', $id_tanding, ['status' => 'selesai']);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'ok']);
                // redirect('dewantgr1/tanding');
            } else {
                $this->session->set_flashdata('error', 'Penentuan gagal');
                echo json_encode(['status' => 'error']);
                // redirect('dewantgr1/tanding');
            }
        }
    }

    public function hasilPenentuan($id_tanding)
    {
        $data['tanding'] = $this->model->getBy('tandingtgr', 'id_tanding', $id_tanding)->row();
        $data['partai'] = $this->model->getBy('partaitgr', 'id_partai', $data['tanding']->id_partai)->row();
        $data['merah'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->merah)->row();
        $data['biru'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->biru)->row();

        $data['foulMerah'] = $this->model->getBy3('nilaitgr1_fix', 'id_tanding', $id_tanding, 'id_peserta', $data['partai']->merah, 'ket', 'dewan')->row();
        $data['foulBiru'] = $this->model->getBy3('nilaitgr1_fix', 'id_tanding', $id_tanding, 'id_peserta', $data['partai']->biru, 'ket', 'dewan')->row();

        $dataMerah = $this->model->getBy3Ord('nilaitgr1_fix', 'id_tanding', $id_tanding, 'id_peserta', $data['partai']->merah, 'ket', 'juri', 'skor', 'ASC')->result();
        $dataBiru = $this->model->getBy3Ord('nilaitgr1_fix', 'id_tanding', $id_tanding, 'id_peserta', $data['partai']->biru, 'ket', 'juri', 'skor', 'ASC')->result();

        $data['detailmerah'] = $this->model->getBy2('detailtgr', 'id_peserta', $data['partai']->merah, 'id_tanding', $id_tanding)->row();
        $data['detailbiru'] = $this->model->getBy2('detailtgr', 'id_peserta', $data['partai']->biru, 'id_tanding', $id_tanding)->row();

        $skorArrayMerah = [];
        $skorArrayBiru = [];
        foreach ($dataMerah as $row) {
            $skorArrayMerah[] = $row->skor;
        }
        foreach ($dataBiru as $row) {
            $skorArrayBiru[] = $row->skor;
        }

        $data['deviasiMerah'] = $this->calculate_standard_deviation($skorArrayMerah);
        $data['deviasiBiru'] = $this->calculate_standard_deviation($skorArrayBiru);

        $id_merah = $data['partai']->merah;
        $id_biru = $data['partai']->biru;

        $data['totalMerah'] = $this->model->getBy3Ord('nilaitgr1_fix', 'id_tanding', $id_tanding, 'id_peserta', $id_merah, 'ket', 'juri', 'skor', 'ASC')->result();
        $data['totalBiru'] = $this->model->getBy3Ord('nilaitgr1_fix', 'id_tanding', $id_tanding, 'id_peserta', $id_biru, 'ket', 'juri', 'skor', 'ASC')->result();


        $this->load->view('seni/view_layar/penetuan', $data);
    }

    public function startPerfom()
    {
        $id_tanding = $this->input->post('id_tanding');
        $id_peserta = $this->input->post('id_peserta');

        $this->db->where('id_peserta', $id_peserta);
        $this->db->where('id_tanding', $id_tanding);
        $this->db->update('detailtgr', ['mulai' => date('Y-m-d H:i:s')]);

        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'ok']);
        } else {
            // $this->session->set_flashdata('error', 'Penentuan gagal');
            echo json_encode(['status' => 'error']);
        }
    }
    public function stopPerfom()
    {
        $id_tanding = $this->input->post('id_tanding');
        $id_peserta = $this->input->post('id_peserta');

        $this->db->where('id_peserta', $id_peserta);
        $this->db->where('id_tanding', $id_tanding);
        $this->db->update('detailtgr', ['selesai' => date('Y-m-d H:i:s')]);

        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'ok']);
        } else {
            // $this->session->set_flashdata('error', 'Penentuan gagal');
            echo json_encode(['status' => 'error']);
        }
    }
}
