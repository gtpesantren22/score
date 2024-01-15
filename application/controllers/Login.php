<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Modeldata', 'model');
        $this->load->model('Auth_model');
    }

    public function index()
    {

        // $data['daftar'] = $this->DataModel->data()->result();

        // $this->load->view('layout/head');
        $this->load->view('login');
        // $this->load->view('layout/foot');
    }

    public function gogogo()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // $rules = $this->Auth_model->rules();
        // $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        }

        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        // Guanakan untuk Cek jika error
        // $result = $this->Auth_model->login($username, $password);
        // if ($result === FALSE) {
        //     // Menangani kondisi jika login gagal
        //     $user = $this->model->getBy('user', 'username', $username)->row(); // Ganti dengan metode yang sesuai
        //     if (!$user) {
        //         // Username tidak ditemukan
        //         echo "Username tidak ditemukan.";
        //     } elseif (!password_verify($password, $user->password)) {
        //         // Password tidak cocok
        //         echo "Password tidak cocok.";
        //     } elseif ($user->aktif === 'T') {
        //         // Akun tidak aktif
        //         echo "Akun tidak aktif.";
        //     } else {
        //         // Kasus lain yang mungkin Anda tangani
        //         echo "Login gagal.";
        //     }
        // } else {
        //     // Login berhasil, lakukan redirect atau tindakan lainnya
        //     echo "Login Berhasil.";
        // }

        if ($this->Auth_model->login($username, $password)) {
            $user = $this->Auth_model->current_user();
            $this->session->set_flashdata('ok', 'Login Berhasil');

            if ($user->level === 'admin') {
                redirect('welcome');
            } elseif ($user->level === 'dewan') {
                redirect('dewan');
            }
            // echo 'login Ok';
        } else {
            // echo 'login gagal';
            $this->session->set_flashdata('error', 'Maaf username atau password salah');
            redirect('login');
        }
    }

    public function register()
    {
        $this->load->view('daftar');
    }

    public function daftarAct()
    {
        $kode = $this->input->post('kode', true);
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        $password2 = $this->input->post('password2', true);

        $passOk = password_hash($password, PASSWORD_BCRYPT);

        $cekGuru = $this->model->getBy('guru', 'kode_guru', $kode);
        $cekAkunGuru = $this->model->getBy('user', 'kode_guru', $kode);

        if ($cekGuru->num_rows() < 1) {
            $this->session->set_flashdata('error', 'Maaf. Kode guru anda tidak terdaftar');
            redirect('login/register');
        } else {
            if ($cekAkunGuru->num_rows() > 0) {
                $this->session->set_flashdata('error', 'Maaf. Anda sudah pernah melakukan pendaftaran. silahkan hub Admin');
                redirect('login/register');
            } else {
                if ($password != $password2) {
                    $this->session->set_flashdata('error', 'Maaf. Password yang anda masukan tidak sama');
                    redirect('login/register');
                } else {
                    $data = [
                        'id_user' => $this->uuid->v4(),
                        'nama' => $cekGuru->row('nama_guru'),
                        'jabatan' => 'Guru',
                        'username' => $username,
                        'password' => $passOk,
                        'aktif' => 'Y',
                        'level' => 'guru',
                        'kode_guru' => $kode,

                    ];

                    $this->model->simpan('user', $data);
                    if ($this->db->affected_rows()) {
                        $this->session->set_flashdata('ok', 'Akun sudah dibuat. Anda sudah bisa menggunakannya');
                        redirect('login');
                    }
                }
            }
        }
    }

    public function logout()
    {
        // $this->load->model('Auth_model');
        if ($this->Auth_model->logout()) {
            // $this->session->set_flashdata('ok', 'Anda Berhasil Keluar');
            redirect('login');
        }
    }
}
