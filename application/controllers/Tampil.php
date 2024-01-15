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
        echo json_encode($data->babak);
    }
}
