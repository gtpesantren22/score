<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tampil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modeldata', 'model');
    }

    public function index()
    {
        $data['jadwal'] = $this->db->query("SELECT * FROM tanding WHERE aktif = 'Y' ")->result();

        $this->load->view('tampil', $data);
    }

    public function gel($gel)
    {
        $data['tanding'] = $this->model->getBy2('tanding', 'aktif', 'Y', 'gel', $gel)->row();
        $data['partai'] = $this->model->getBy('partai', 'id_partai', $data['tanding']->id_partai)->row();
        $data['merah'] = $this->model->getBy('peserta', 'id_peserta', $data['partai']->merah)->row();
        $data['biru'] = $this->model->getBy('peserta', 'id_peserta', $data['partai']->biru)->row();

        $this->load->view('layar', $data);
    }

    public function point($id_tanding, $id_peserta)
    {
        $pointJuri = $this->db->query("SELECT SUM(skor) AS point FROM nilai_fix WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' ")->row();
        $point = $this->db->query("SELECT SUM(skor) AS point FROM hukuman WHERE id_tanding = '$id_tanding' AND id_peserta = '$id_peserta' ")->row();

        echo json_encode($point->point + $pointJuri->point);
    }

    public function cekTanding($id)
    {
        $data = $this->model->getBy('tanding', 'id_tanding', $id)->row();
        $data2 = $this->model->getBy('tanding', 'id_tanding', $id)->row();

        echo json_encode($data->babak);
    }

    public function cekBinaan($id_tanding)
    {
        $tanding = $this->model->getBy('tanding', 'id_tanding', $id_tanding)->row();
        $partai = $this->model->getBy('partai', 'id_partai', $tanding->id_partai)->row();

        $datamerah = $this->model->getBy4('hukuman', 'ket', 'binaan', 'id_tanding', $id_tanding, 'id_peserta', $partai->merah, 'babak', $tanding->babak)->num_rows();
        $databiru = $this->model->getBy4('hukuman', 'ket', 'binaan', 'id_tanding', $id_tanding, 'id_peserta', $partai->biru, 'babak', $tanding->babak)->num_rows();

        echo json_encode(array('datamerah' => $datamerah, 'databiru' => $databiru));
    }

    public function cekTeguran($id_tanding)
    {
        $tanding = $this->model->getBy('tanding', 'id_tanding', $id_tanding)->row();
        $partai = $this->model->getBy('partai', 'id_partai', $tanding->id_partai)->row();

        $datamerah = $this->model->getBy4('hukuman', 'ket', 'teguran', 'id_tanding', $id_tanding, 'id_peserta', $partai->merah, 'babak', $tanding->babak)->num_rows();
        $databiru = $this->model->getBy4('hukuman', 'ket', 'teguran', 'id_tanding', $id_tanding, 'id_peserta', $partai->biru, 'babak', $tanding->babak)->num_rows();

        echo json_encode(array('datamerah' => $datamerah, 'databiru' => $databiru));
    }

    public function cekInputan($id_tanding)
    {
        $tanding = $this->model->getBy('tanding', 'id_tanding', $id_tanding)->row();
        $partai = $this->model->getBy('partai', 'id_partai', $tanding->id_partai)->row();
        $timer = microtime(true) * 1000;

        $j1MerahPukul = $this->db->query("SELECT skor FROM nilai WHERE id_tanding = '$id_tanding' AND id_peserta = '$partai->merah' AND id_wasit = '$tanding->juri1' AND ket = 'Pukulan' AND ($timer - timer) <= 1500  ")->num_rows();
        $j2MerahPukul = $this->db->query("SELECT skor FROM nilai WHERE id_tanding = '$id_tanding' AND id_peserta = '$partai->merah' AND id_wasit = '$tanding->juri2' AND ket = 'Pukulan' AND ($timer - timer) <= 1500  ")->num_rows();
        $j3MerahPukul = $this->db->query("SELECT skor FROM nilai WHERE id_tanding = '$id_tanding' AND id_peserta = '$partai->merah' AND id_wasit = '$tanding->juri3' AND ket = 'Pukulan' AND ($timer - timer) <= 1500  ")->num_rows();

        $j1BiruPukul = $this->db->query("SELECT skor FROM nilai WHERE id_tanding = '$id_tanding' AND id_peserta = '$partai->biru' AND id_wasit = '$tanding->juri1' AND ket = 'Pukulan' AND ($timer - timer) <= 1500  ")->num_rows();
        $j2BiruPukul = $this->db->query("SELECT skor FROM nilai WHERE id_tanding = '$id_tanding' AND id_peserta = '$partai->biru' AND id_wasit = '$tanding->juri2' AND ket = 'Pukulan' AND ($timer - timer) <= 1500  ")->num_rows();
        $j3BiruPukul = $this->db->query("SELECT skor FROM nilai WHERE id_tanding = '$id_tanding' AND id_peserta = '$partai->biru' AND id_wasit = '$tanding->juri3' AND ket = 'Pukulan' AND ($timer - timer) <= 1500  ")->num_rows();

        $j1MerahTendang = $this->db->query("SELECT skor FROM nilai WHERE id_tanding = '$id_tanding' AND id_peserta = '$partai->merah' AND id_wasit = '$tanding->juri1' AND ket = 'Tendangan' AND ($timer - timer) <= 1500  ")->num_rows();
        $j2MerahTendang = $this->db->query("SELECT skor FROM nilai WHERE id_tanding = '$id_tanding' AND id_peserta = '$partai->merah' AND id_wasit = '$tanding->juri2' AND ket = 'Tendangan' AND ($timer - timer) <= 1500  ")->num_rows();
        $j3MerahTendang = $this->db->query("SELECT skor FROM nilai WHERE id_tanding = '$id_tanding' AND id_peserta = '$partai->merah' AND id_wasit = '$tanding->juri3' AND ket = 'Tendangan' AND ($timer - timer) <= 1500  ")->num_rows();

        $j1BiruTendang = $this->db->query("SELECT skor FROM nilai WHERE id_tanding = '$id_tanding' AND id_peserta = '$partai->biru' AND id_wasit = '$tanding->juri1' AND ket = 'Tendangan' AND ($timer - timer) <= 1500  ")->num_rows();
        $j2BiruTendang = $this->db->query("SELECT skor FROM nilai WHERE id_tanding = '$id_tanding' AND id_peserta = '$partai->biru' AND id_wasit = '$tanding->juri2' AND ket = 'Tendangan' AND ($timer - timer) <= 1500  ")->num_rows();
        $j3BiruTendang = $this->db->query("SELECT skor FROM nilai WHERE id_tanding = '$id_tanding' AND id_peserta = '$partai->biru' AND id_wasit = '$tanding->juri3' AND ket = 'Tendangan' AND ($timer - timer) <= 1500  ")->num_rows();


        echo json_encode(array(
            'j1MerahPukul' => $j1MerahPukul,
            'j2MerahPukul' => $j2MerahPukul,
            'j3MerahPukul' => $j3MerahPukul,
            'j1BiruPukul' => $j1BiruPukul,
            'j2BiruPukul' => $j2BiruPukul,
            'j3BiruPukul' => $j3BiruPukul,

            'j1MerahTendang' => $j1MerahTendang,
            'j2MerahTendang' => $j2MerahTendang,
            'j3MerahTendang' => $j3MerahTendang,
            'j1BiruTendang' => $j1BiruTendang,
            'j2BiruTendang' => $j2BiruTendang,
            'j3BiruTendang' => $j3BiruTendang,
        ));
    }
}
