<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wasit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modeldata', 'model');
        $this->socket = $this->model->getBy('settings', 'name', 'socket')->row('value');
    }

    public function index($nojuri = null)
    {
        $qrJadwal = $this->model->getBy('tanding', 'aktif', 'Y');
        $data['jadwal'] = $qrJadwal->result();
        $data['nomor'] = $nojuri;
        $data['socket'] = $this->socket;
        if ($qrJadwal->row() && $nojuri != null) {
            $nojr =  'juri' . $nojuri;
            $id_wasit = $qrJadwal->row($nojr);
            $id_tanding = $qrJadwal->row('id_tanding');
            redirect('wasit/gogogo/' . $id_wasit . '/' . $id_tanding . '/' . $nojuri);
        } else {
            $this->load->view('wasit/home', $data);
        }
    }

    public function gogogo($id_wasit, $id, $no)
    {
        // $id_wasit = $this->input->post('id_wasit', true);
        // $pin = $this->input->post('pin', true);
        // $id = $this->input->post('id', true);

        $cek = $this->model->getBy('wasit', 'id_wasit', $id_wasit)->row();
        if ($cek) {
            if ($cek->status === 'N') {
                $session_data = array(
                    'tandingID' => $id,
                    'wasitID' => $cek->id_wasit,
                    'nomor' => $no
                );

                $this->model->ubah('wasit', 'id_wasit', $cek->id_wasit, ['status' => 'Y']);
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

    public function logout($nomor)
    {
        $id = $this->session->userdata('wasitID');
        $this->model->ubah('wasit', 'id_wasit', $id, ['status' => 'N']);

        $this->session->unset_userdata('tandingID');
        $this->session->unset_userdata('wasitID');
        $this->session->sess_destroy();

        redirect('wasit/' . $nomor);
    }
}
