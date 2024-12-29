<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TampilSeni1 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modeldata', 'model');

        $this->socket = $this->model->getBy('settings', 'name', 'socket')->row('value');
    }

    public function index()
    {
        $data['jadwal'] = $this->db->query("SELECT * FROM tandingtgr WHERE aktif = 'Y' ")->result();
        $data['socket'] = $this->socket;

        $this->load->view('seni/tampil', $data);
    }

    public function gel($gel)
    {
        // $data['tanding'] = $this->db->query("SELECT tandingtgr.* FROM tandingtgr JOIN detailtgr ON tandingtgr.id_tanding=detailtgr.id_tanding WHERE tandingtgr.aktif = 'Y' AND tandingtgr.gel = '$gel' AND detailtgr.tutup = 'belum'")->row();
        $data['tanding'] = $this->model->getBy2('tandingtgr', 'aktif', 'Y', 'gel', $gel)->row();


        // $data['partai'] = $this->model->getBy('partaitgr', 'id_partai', $data['tanding']->id_partai)->row();
        // $data['merah'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->merah)->row();
        // $data['biru'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->biru)->row();

        $data['detail'] = $this->model->getBy2('detailtgr', 'id_tanding', $data['tanding']->id_tanding, 'tutup', 'belum')->row();
        // $data['peserta'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['detail']->id_peserta)->row();

        // $this->load->view('seni/layar', $data);
        if ($data['tanding']) {
            redirect('tampilseni1/cek/' . $data['tanding']->id_tanding);
        } else {
            redirect('tampilseni1');
        }
    }

    public function cek($id)
    {
        $tanding = $this->model->getBy('tandingtgr', 'id_tanding', $id)->row();
        $cekDetail = $this->model->getBy('detailtgr', 'id_tanding', $tanding->id_tanding);
        if ($cekDetail->num_rows() > 0) {
            $detailPilih = $this->model->getBy3('detailtgr', 'id_tanding', $id, 'status !=', 'belum', 'tutup', 'belum');
            $status_detail = $detailPilih->row('status');
            $detailtgr = 'ada';
            $tutup = $detailPilih->row('tutup');
            $id_detail = $detailPilih->row('id_detail');
        } else {
            $detailtgr = 'tidak';
            $status_detail = 'kosong';
            $tutup = 'ksong';
            $id_detail = '';
        }

        // echo json_encode(['aktif' => $tanding->aktif, 'detailtgr' => $detailtgr, 'status_tanding' => $tanding->status, 'status_detail' => $status_detail, 'tutup' => $tutup, 'id_detail' => $id_detail]);
        if ($tanding->aktif == 'Y' && $detailtgr == 'tidak') {
            redirect("tampilseni1/load_tampilawal/" . $tanding->id_tanding);
        } else if ($tanding->aktif == 'Y' && $detailtgr == 'ada' && $tanding->status != 'selesai' && $status_detail == 'proses' && $tutup == 'belum') {
            redirect('tampilseni1/load_tampiprosesnilai/' . $tanding->id_tanding . '/' . $id_detail);
        } else if ($tanding->aktif == 'Y' && $detailtgr == 'ada' && $tanding->status != 'selesai' && $status_detail == 'selesai' && $tutup == 'belum') {
            redirect("tampilseni1/load_tampilrekapnilai/" . $tanding->id_tanding . '/' . $id_detail);
        } else if ($tanding->aktif == 'Y' && $detailtgr == 'ada' && $tanding->status == 'selesai') {
            redirect("tampilseni1/load_tampilpenentuan/" . $tanding->id_tanding);
        } else if ($tanding->aktif == 'Y' && $detailtgr == 'ada' && !$detailPilih->row()) {
            redirect("tampilseni1/load_tampilawal/" . $tanding->id_tanding);
        } else if ($tanding->aktif != 'Y') {
            redirect('tampilseni1');
        } else {
            redirect('tampilseni1');
        }
    }

    public function load_proses($id)
    {
        $dta = $this->model->getBy('detailtgr', 'id_detail', $id)->row();
        $tanding = $this->model->getBy('tandingtgr', 'id_tanding', $dta->id_tanding)->row();
        // $partai = $this->model->getBy('partaitgr', 'id_partai', $tanding->id_partai)->row();

        $juri1A = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri1' AND kode != 'WpStmina' ")->row();
        $juri1B = $this->db->query("SELECT skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri1' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        $juri2A = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri2' AND kode != 'WpStmina' ")->row();
        $juri2B = $this->db->query("SELECT skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri2' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        $juri3A = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri3' AND kode != 'WpStmina' ")->row();
        $juri3B = $this->db->query("SELECT skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri3' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        $juri4A = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri4' AND kode != 'WpStmina' ")->row();
        $juri4B = $this->db->query("SELECT skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri4' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        $juri5A = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri5' AND kode != 'WpStmina' ")->row();
        $juri5B = $this->db->query("SELECT skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri5' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        // $dewan = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND kode like 'D%' ")->row();


        $data['juri1'] = $juri1A->skor + $juri1B->skor;
        $data['juri2'] = $juri2A->skor + $juri2B->skor;
        $data['juri3'] = $juri3A->skor + $juri3B->skor;
        $data['juri4'] = $juri4A->skor + $juri4B->skor;
        $data['juri5'] = $juri5A->skor + $juri5B->skor;

        $this->load->view('seni/view_layar/proses', $data);
    }

    public function tampilRekap($id_tanding, $id_peserta)
    {
        $data['data'] = $this->model->getBy3Ord('nilaitgr1_fix', 'id_tanding', $id_tanding, 'id_peserta', $id_peserta, 'ket', 'juri', 'skor', 'ASC')->result();
        $data['penalti'] = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' AND kode like 'D%' ")->row();


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

    public function load_tampilawal($id_tanding)
    {
        $data['tanding'] = $this->model->getBy('tandingtgr', 'id_tanding', $id_tanding)->row();
        $data['partai'] = $this->model->getBy('partaitgr', 'id_partai', $data['tanding']->id_partai)->row();
        $data['merah'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->merah)->row();
        $data['biru'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->biru)->row();
        $data['socket'] = $this->socket;

        $this->load->view('seni/view_layar/tampil_awal', $data);
    }

    public function load_tampiprosesnilai($id_tanding, $id_detail)
    {
        $data['tanding'] = $this->model->getBy('tandingtgr', 'id_tanding', $id_tanding)->row();
        $data['partai'] = $this->model->getBy('partaitgr', 'id_partai', $data['tanding']->id_partai)->row();
        $data['merah'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->merah)->row();
        $data['biru'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->biru)->row();
        $data['id_detailtgr'] = $id_detail;
        $data['socket'] = $this->socket;

        $dta = $this->model->getBy('detailtgr', 'id_detail', $id_detail)->row();


        if ($dta->id_peserta == $data['merah']->id_peserta) {
            $data['sudut'] = 'merah';
        } else {
            $data['sudut'] = 'biru';
        }
        $data['detail'] = $dta;

        $this->load->view('seni/view_layar/tampil_proses', $data);
    }

    public function hasil_tampiprosesnilai($id_detail)
    {
        $dta = $this->model->getBy('detailtgr', 'id_detail', $id_detail)->row();
        $tanding = $this->model->getBy('tandingtgr', 'id_tanding', $dta->id_tanding)->row();

        $juri1A = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri1' AND kode != 'WpStmina' ")->row();
        $juri1B = $this->db->query("SELECT skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri1' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        $juri2A = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri2' AND kode != 'WpStmina' ")->row();
        $juri2B = $this->db->query("SELECT skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri2' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        $juri3A = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri3' AND kode != 'WpStmina' ")->row();
        $juri3B = $this->db->query("SELECT skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri3' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        $juri4A = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri4' AND kode != 'WpStmina' ")->row();
        $juri4B = $this->db->query("SELECT skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri4' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        $juri5A = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri5' AND kode != 'WpStmina' ")->row();
        $juri5B = $this->db->query("SELECT skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND id_wasit = '$tanding->juri5' AND kode = 'WpStmina' ORDER BY created DESC LIMIT 1 ")->row();

        // $dewan = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$dta->id_tanding' AND id_peserta = '$dta->id_peserta' AND kode like 'D%' ")->row();

        $juri1 = ($juri1A ? $juri1A->skor : 0) + ($juri1B ? $juri1B->skor : 0);
        $juri2 = ($juri2A ? $juri2A->skor : 0) + ($juri2B ? $juri2B->skor : 0);
        $juri3 = ($juri3A ? $juri3A->skor : 0) + ($juri3B ? $juri3B->skor : 0);
        $juri4 = ($juri4A ? $juri4A->skor : 0) + ($juri4B ? $juri4B->skor : 0);
        $juri5 = ($juri5A ? $juri5A->skor : 0) + ($juri5B ? $juri5B->skor : 0);

        echo json_encode([
            'juri1' => $juri1 ? number_format(9.90 + $juri1, 2) : number_format(9.90, 2),
            'juri2' => $juri2 ? number_format(9.90 + $juri2, 2) : number_format(9.90, 2),
            'juri3' => $juri3 ? number_format(9.90 + $juri3, 2) : number_format(9.90, 2),
            'juri4' => $juri4 ? number_format(9.90 + $juri4, 2) : number_format(9.90, 2),
            'juri5' => $juri5 ? number_format(9.90 + $juri5, 2) : number_format(9.90, 2),
        ]);
    }

    public function load_tampilrekapnilai($id_tanding, $id_detail)
    {
        $data['tanding'] = $this->model->getBy('tandingtgr', 'id_tanding', $id_tanding)->row();
        $data['partai'] = $this->model->getBy('partaitgr', 'id_partai', $data['tanding']->id_partai)->row();
        $data['merah'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->merah)->row();
        $data['biru'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->biru)->row();
        $data['socket'] = $this->socket;

        $dta = $this->model->getBy('detailtgr', 'id_detail', $id_detail)->row();

        if ($dta->id_peserta == $data['merah']->id_peserta) {
            $data['sudut'] = 'merah';
        } else {
            $data['sudut'] = 'biru';
        }

        $data['data'] = $this->model->getBy3Ord('nilaitgr1_fix', 'id_tanding', $id_tanding, 'id_peserta', $dta->id_peserta, 'ket', 'juri', 'skor', 'ASC')->result();
        $data['penalti'] = $this->db->query("SELECT SUM(skor) as skor FROM nilaitgr1 WHERE id_tanding = '$id_tanding' AND id_peserta = '$dta->id_peserta' AND kode like 'D%' ")->row();
        $data['detail'] = $this->model->getBy2('detailtgr', 'id_peserta', $dta->id_peserta, 'id_tanding', $id_tanding)->row();


        $skorArray = [];
        // Iterasi melalui hasil query
        foreach ($data['data'] as $row) {
            // Ambil nilai skor dari setiap objek dan masukkan ke dalam array
            $skorArray[] = $row->skor;
        }

        $data['deviasi'] = $this->calculate_standard_deviation($skorArray);
        $this->load->view('seni/view_layar/tampil_rekap', $data);
    }

    public function load_tampilpenentuan($id_tanding)
    {
        $data['tanding'] = $this->model->getBy('tandingtgr', 'id_tanding', $id_tanding)->row();
        $data['partai'] = $this->model->getBy('partaitgr', 'id_partai', $data['tanding']->id_partai)->row();
        $data['merah'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->merah)->row();
        $data['biru'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->biru)->row();

        $data['foulMerah'] = $this->model->getBy3('nilaitgr1_fix', 'id_tanding', $id_tanding, 'id_peserta', $data['partai']->merah, 'ket', 'dewan')->row();
        $data['foulBiru'] = $this->model->getBy3('nilaitgr1_fix', 'id_tanding', $id_tanding, 'id_peserta', $data['partai']->biru, 'ket', 'dewan')->row();

        $dataMerah = $this->model->getBy3Ord('nilaitgr1_fix', 'id_tanding', $id_tanding, 'id_peserta', $data['partai']->merah, 'ket', 'juri', 'skor', 'ASC')->result();
        $dataBiru = $this->model->getBy3Ord('nilaitgr1_fix', 'id_tanding', $id_tanding, 'id_peserta', $data['partai']->biru, 'ket', 'juri', 'skor', 'ASC')->result();
        $data['socket'] = $this->socket;

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

        $data['detailmerah'] = $this->model->getBy2('detailtgr', 'id_peserta', $data['partai']->merah, 'id_tanding', $id_tanding)->row();
        $data['detailbiru'] = $this->model->getBy2('detailtgr', 'id_peserta', $data['partai']->biru, 'id_tanding', $id_tanding)->row();

        $this->load->view('seni/view_layar/tampil_penetuan', $data);
    }

    public function cekDetail($id_detail)
    {
        $xcek = $this->model->getBy('detailtgr', 'id_detail', $id_detail)->row();

        echo json_encode(['mulai' => $xcek->mulai, 'selesai' => $xcek->selesai]);
    }
}
