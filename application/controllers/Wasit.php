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
        // $pin = $this->input->post('pin', true);
        $id = $this->input->post('id', true);

        $cek = $this->model->getBy('wasit', 'id_wasit', $id_wasit)->row();
        if ($cek) {
            if ($cek->aktif === 'N') {
                $session_data = array(
                    'tandingID' => $id,
                    'wasitID' => $cek->id_wasit
                );

                $this->model->ubah('wasit', 'id_wasit', $cek->id_wasit, ['aktif' => 'Y']);
                $this->session->set_userdata($session_data);
                redirect('Wasittanding');
            } else {
                $this->session->set_flashdata('error', 'Wasit Masih Aktif di suatu pertandingan');
                redirect('wasit');
            }
        } else {
            $this->session->set_flashdata('error', 'Data wasit tidak ditemukan');
            redirect('wasit');
        }
    }

    public function logout()
    {
        $id = $this->session->userdata('wasitID');
        $this->model->ubah('wasit', 'id_wasit', $id, ['aktif' => 'N']);

        $this->session->unset_userdata('tandingID');
        $this->session->unset_userdata('wasitID');
        $this->session->sess_destroy();

        redirect('wasit');
    }
}
