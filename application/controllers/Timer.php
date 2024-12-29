<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Timer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modeldata', 'model');

        $this->load->model('Auth_model');
        $user = $this->Auth_model->current_user();

        // if (!$this->Auth_model->current_user() && ($user->level != 'admin' || $user->level != 'timer')) {
        //     redirect('login/logout');
        // }

        $this->socket = $this->model->getBy('settings', 'name', 'socket')->row('value');
    }

    public function index()
    {
        $data['user'] = $this->Auth_model->current_user();

        $this->load->view('timer/home', $data);
    }
    public function seni()
    {
        $data['tanding'] = $this->model->getBy('tandingtgr', 'aktif', 'Y')->row();
        if ($data['tanding']) {
            $data['partai'] = $this->model->getBy('partaitgr', 'id_partai', $data['tanding']->id_partai)->row();
            $data['merah'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->merah)->row();
            $data['biru'] = $this->model->getBy('pesertatgr', 'id_peserta', $data['partai']->biru)->row();
            $data['socket'] = $this->socket;

            $this->load->view('timer/seni', $data);
        } else {
            redirect('timer');
        }
    }

    public function tanding()
    {
        $data['tanding'] = $this->model->getBy('tanding', 'aktif', 'Y')->row();
        if ($data['tanding']) {
            $data['partai'] = $this->model->getBy('partai', 'id_partai', $data['tanding']->id_partai)->row();
            $data['merah'] = $this->model->getBy('peserta', 'id_peserta', $data['partai']->merah)->row();
            $data['biru'] = $this->model->getBy('peserta', 'id_peserta', $data['partai']->biru)->row();
            $data['socket'] = $this->socket;
            $this->load->view('timer/tanding', $data);
        } else {
            redirect('timer');
        }
    }

    public function pindahBabak($id, $bbk)
    {
        $data = ['babak' => $bbk];
        $this->model->ubah('tanding', 'id_tanding', $id, $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Babak berhasil diaktifkan');
            redirect('timer/tanding');
        } else {
            $this->session->set_flashdata('error', 'Babak berhasil diaktifkan');
            redirect('timer/tanding');
        }
    }
}
