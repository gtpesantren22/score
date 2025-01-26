<?php

use PHPUnit\Util\Json;

defined('BASEPATH') or exit('No direct script access allowed');

class Drawing extends CI_Controller
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

    public function index()
    {
        $data['user'] = $this->Auth_model->current_user();
        $this->load->view('drawing/index', $data);
    }

    public function show()
    {
        $data['kelas'] = $this->input->post('kelas', true);
        $data['kategori'] = $this->input->post('kategori', true);
        $data['jkl'] = $this->input->post('jkl', true);

        $hasil = [];
        $dataPeserta = $this->model->getBy3('peserta', 'kelas', $data['kelas'], 'kategori', $data['kategori'], 'jkl', $data['jkl']);
        foreach ($dataPeserta->result() as $key) {
            $undian = $this->model->getBy('undian', 'id_peserta', $key->id_peserta)->row();
            $hasil[] = [
                'id_peserta' => $key->id_peserta,
                'nama' => $key->nama,
                'kontingen' => $key->kontingen,
                'nomor' => $undian ? $undian->nomor : 0,

            ];
        }
        $data['hasil'] = $hasil;
        $data['total'] = $dataPeserta->num_rows();
        // echo json_encode(['data' => $hasil, 'kelas' => $kelas, 'kategori' => $kategori, 'jkl' => $jkl == 'Laki-laki' ? 'Putra' : 'Putri', 'total' => $data->num_rows()]);
        $this->load->view('drawing/hasil', $data);
    }
    public function showTable()
    {
        $data['kelas'] = $this->input->post('kelas', true);
        $data['kategori'] = $this->input->post('kategori', true);
        $data['jkl'] = $this->input->post('jkl', true);

        $hasil = [];
        $dataPeserta = $this->model->getBy3('peserta', 'kelas', $data['kelas'], 'kategori', $data['kategori'], 'jkl', $data['jkl']);
        foreach ($dataPeserta->result() as $key) {
            $undian = $this->model->getBy('undian', 'id_peserta', $key->id_peserta)->row();
            $hasil[] = [
                'id_peserta' => $key->id_peserta,
                'nama' => $key->nama,
                'kontingen' => $key->kontingen,
                'nomor' => $undian ? $undian->nomor : 0,

            ];
        }
        // $data['hasil'] = $hasil;
        // $data['total'] = $dataPeserta->num_rows();
        echo json_encode(['data' => $hasil]);
        // $this->load->view('drawing/hasil', $data);
    }

    public function mulai()
    {
        $kelas = $this->input->post('kelas', true);
        $kategori = $this->input->post('kategori', true);
        $jkl = $this->input->post('jkl', true);

        $siswa = $this->model->getBy3('peserta', 'kelas', $kelas, 'kategori', $kategori, 'jkl', $jkl);

        $totalSiswa = $siswa->num_rows();

        $uniqueNumbers = range(1, $totalSiswa);
        shuffle($uniqueNumbers); // Acak angka

        $index = 0;
        foreach ($siswa->result() as $key) {
            $cek = $this->model->getBy('undian', 'id_peserta', $key->id_peserta)->row();
            $data = [
                'id_peserta' => $key->id_peserta,
                'nomor' => $uniqueNumbers[$index],
            ];
            if ($cek) {
                $this->model->ubah('undian', 'id_peserta', $key->id_peserta, ['nomor' => $uniqueNumbers[$index]]);
            } else {
                $this->model->simpan('undian', $data);
            }

            $index++;
        }
        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'gagal']);
        }
    }

    public function schema()
    {
        $kelas = $this->input->post('kelas', true);
        $kategori = $this->input->post('kategori', true);
        $jkl = $this->input->post('jkl', true);

        $cek = $this->model->getBy3('partai_sm', 'kelas', $kelas, 'kategori', $kategori, 'jkl', $jkl)->row();
        if ($cek) {
            $this->db->where('kelas', $kelas);
            $this->db->where('kategori', $kategori);
            $this->db->where('jkl', $jkl);
            $this->db->delete('partai_sm');

            if ($this->db->affected_rows() > 0) {
                $peserta = $this->db->query("SELECT * FROM undian WHERE kelas = '$kelas' AND kategori = '$kategori' AND jkl = '$jkl' ORDER BY nomor ASC")->result_array();

                for ($i = 0; $i < count($peserta); $i += 2) {
                    $jml = $this->db->query("SELECT MAX(urut) AS urut FROM partai_sm")->row();
                    $peserta_merah = $peserta[$i]['id_peserta'];
                    $peserta_biru = isset($peserta[$i + 1]) ? $peserta[$i + 1]['id_peserta'] : NULL; // Jika ganjil, peserta_biru NULL

                    $dataInput = [
                        'id_partai' => $this->uuid->v4(),
                        'urut' => $jml ? $jml->urut + 1 : 1,
                        'babak' => 'Penyisihan',
                        'merah' => $peserta_merah,
                        'biru' => $peserta_biru,
                        'ket' => 'N',
                        'kelas' => $kelas,
                        'kategori' => $kategori,
                        'jkl' => $jkl,
                    ];

                    $this->model->simpan('partai_sm', $dataInput);
                }
                if ($this->db->affected_rows() > 0) {
                    echo json_encode(['status' => 'success']);
                }
            }
        } else {
            $peserta = $this->db->query("SELECT undian.* FROM undian JOIN peserta ON undian.id_peserta=peserta.id_peserta WHERE peserta.kelas = '$kelas' AND peserta.kategori = '$kategori' AND peserta.jkl = '$jkl' ORDER BY undian.nomor ASC")->result_array();

            for ($i = 0; $i < count($peserta); $i += 2) {
                $jml = $this->db->query("SELECT MAX(urut) AS urut FROM partai_sm")->row();
                $peserta_merah = $peserta[$i]['id_peserta'];
                $peserta_biru = isset($peserta[$i + 1]) ? $peserta[$i + 1]['id_peserta'] : NULL; // Jika ganjil, peserta_biru NULL

                $dataInput = [
                    'id_partai' => $this->uuid->v4(),
                    'urut' => $jml ? $jml->urut + 1 : 1,
                    'babak' => 'Penyisihan',
                    'merah' => $peserta_merah,
                    'biru' => $peserta_biru,
                    'ket' => 'N',
                    'kelas' => $kelas,
                    'kategori' => $kategori,
                    'jkl' => $jkl,
                ];

                $this->model->simpan('partai_sm', $dataInput);
            }
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success']);
            }
        }
    }
}
