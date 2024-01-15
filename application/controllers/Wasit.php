<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wasit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modeldata', 'model');
    }

    public function index()
    {
        $data['jadwal'] = $this->model->getBy('tanding', 'aktif', 'Y')->result();

        $this->load->view('wasit/home', $data);
    }

    public function gogogo()
    {
        $id_wasit = $this->input->post('id_wasit', true);
        $pin = $this->input->post('pin', true);
        $id = $this->input->post('id', true);

        $cek = $this->model->getBy('wasit', 'id_wasit', $id_wasit)->row();
        if ($cek) {
            if ($pin === $cek->pin) {
                $session_data = array(
                    'tandingID' => $id,
                    'wasitID' => $cek->id_wasit
                );
                $this->session->set_userdata($session_data);
                redirect('Wasittanding');
            } else {
                $this->session->set_flashdata('error', 'PIN anda salah');
                redirect('wasit');
            }
        } else {
            $this->session->set_flashdata('error', 'Data wasit tidak ditemukan');
            redirect('wasit');
        }
    }
}
