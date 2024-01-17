<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wasittanding extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modeldata', 'model');

        if (!$this->session->userdata('tandingID') && !$this->session->userdata('wasitID')) {
            redirect('wasit/logout');
        }

        $this->idTanding = $this->session->userdata('tandingID');
        $this->idWasit = $this->session->userdata('wasitID');
    }

    // public function index()
    // {
    //     $data['jadwal'] = $this->model->getBy('tanding', 'aktif', 'Y')->result();

    //     $this->load->view('wasit/tading', $data);
    // }
    public function index()
    {
        $data['wasit'] = $this->model->getBy('wasit', 'id_wasit', $this->idWasit)->row();

        $data['tanding'] = $this->model->getBy('tanding', 'id_tanding', $this->idTanding)->row();
        $data['partai'] = $this->model->getBy('partai', 'id_partai', $data['tanding']->id_partai)->row();
        $data['merah'] = $this->model->getBy('peserta', 'id_peserta', $data['partai']->merah)->row();
        $data['biru'] = $this->model->getBy('peserta', 'id_peserta', $data['partai']->biru)->row();


        $this->load->view('wasit/tanding2', $data);
    }

    public function nilaiTandingMerah($idTanding, $id_wasit)
    {
        $tandng = $this->db->query("SELECT merah FROM tanding JOIN partai ON tanding.id_partai=partai.id_partai WHERE tanding.id_tanding = '$idTanding' ")->row();
        $nilai = $this->db->query("SELECT * FROM nilai WHERE id_tanding = '$idTanding' AND id_wasit = '$id_wasit' AND id_peserta = '$tandng->merah' AND status = 'proses' ORDER BY timer DESC LIMIT 4 ")->result();
        echo json_encode($nilai);
    }
    public function nilaiTandingBiru($idTanding, $id_wasit)
    {
        $tandng = $this->db->query("SELECT biru FROM tanding JOIN partai ON tanding.id_partai=partai.id_partai WHERE tanding.id_tanding = '$idTanding' ")->row();
        $nilai = $this->db->query("SELECT * FROM nilai WHERE id_tanding = '$idTanding' AND id_wasit = '$id_wasit' AND id_peserta = '$tandng->biru' AND status = 'proses' ORDER BY timer DESC LIMIT 4 ")->result();
        echo json_encode($nilai);
        // echo $nilai;
    }

    public function nilaiTotal($pslt, $idTanding, $id_wasit)
    {
        $tandng = $this->db->query("SELECT merah, biru FROM tanding JOIN partai ON tanding.id_partai=partai.id_partai WHERE tanding.id_tanding = '$idTanding' ")->row();
        $idPeserta = $pslt == 'merah' ? $tandng->merah : $tandng->biru;

        $nilai = $this->db->query("SELECT SUM(skor) as total FROM nilai WHERE id_tanding = '$idTanding' AND id_wasit = '$id_wasit' AND id_peserta = '$idPeserta'")->row();
        $total = $nilai ? $nilai->total : 0;
        echo json_encode($total);
    }

    public function skorPakai($pslt, $idTanding, $id_wasit, $babak)
    {
        $tandng = $this->db->query("SELECT merah, biru FROM tanding JOIN partai ON tanding.id_partai=partai.id_partai WHERE tanding.id_tanding = '$idTanding' ")->row();
        $idPeserta = $pslt == 'merah' ? $tandng->merah : $tandng->biru;

        $nilai = $this->db->query("SELECT * FROM nilai WHERE id_tanding = '$idTanding' AND id_wasit = '$id_wasit' AND id_peserta = '$idPeserta' AND status != 'proses' AND babak = $babak ORDER BY timer ASC ")->result();
        // $nilai = $this->db->query("SELECT * FROM nilai WHERE id_tanding = '$idTanding' AND id_wasit = '$id_wasit' AND id_peserta = '$idPeserta' ")->result();
        // $total = $nilai ? $nilai->total : 0;
        echo json_encode($nilai);
    }

    public function skorBabak($babk, $idTanding, $id_wasit)
    {
        $tandng = $this->db->query("SELECT merah, biru FROM tanding JOIN partai ON tanding.id_partai=partai.id_partai WHERE tanding.id_tanding = '$idTanding' ")->row();

        $data['skor'] = $this->db->query("SELECT babak, 
SUM(IF(skor > 0 AND id_peserta = '$tandng->merah', skor, 0)) AS poinR, 
SUM(IF(skor < 0 AND id_peserta = '$tandng->merah', skor, 0)) AS foulR, 
SUM(IF(skor > 0 AND id_peserta = '$tandng->biru', skor, 0)) AS poinB, 
SUM(IF(skor < 0 AND id_peserta = '$tandng->biru', skor, 0)) AS foulB
FROM nilai WHERE id_tanding = '$idTanding' AND id_wasit = '$id_wasit' AND babak = $babk ")->row();

        $this->load->view('wasit/skorBabak', $data);
    }

    public function addNilai()
    {
        $id_tanding = $this->input->post('id_tanding', true);
        $id_wasit = $this->input->post('id_wasit', true);
        $tandng = $this->db->query("SELECT merah, biru, tanding.babak AS babak FROM tanding JOIN partai ON tanding.id_partai=partai.id_partai WHERE tanding.id_tanding = '$id_tanding' ")->row();

        $id_nilai = $this->uuid->v4();
        $id_peserta = $this->input->post('id_peserta', true);
        // $babak = $this->input->post('babak', true);
        $babak = $tandng->babak;
        $skor = $this->input->post('skor', true);
        $timer = microtime(true) * 1000;

        $cek = $this->db->query("SELECT * FROM nilai WHERE id_tanding = '$id_tanding' AND id_wasit != '$id_wasit' AND id_peserta = '$id_peserta' AND babak = $babak AND skor = $skor AND status = 'proses' ");

        if ($cek->num_rows() > 0) {
            foreach ($cek->result() as $hslCek) {
                $selisih = $timer - $hslCek->timer;
                $selisih_detik = $selisih / 1000;

                if ($selisih_detik < 2) {
                    $this->model->ubah('nilai', 'id_nilai', $hslCek->id_nilai, ['status' => 'pakai']);
                }
            }

            $data = [
                'id_nilai' => $id_nilai,
                'id_tanding' => $id_tanding,
                'id_wasit' => $id_wasit,
                'id_peserta' => $id_peserta,
                'babak' => $babak,
                'skor' => $skor,
                'ket' => $this->input->post('ket', true),
                'waktu' => date('H:i:s'),
                'timer' => $timer,
                'status' => 'pakai',
            ];
            $data2 = [
                'id_nilai' => $id_nilai,
                'id_tanding' => $id_tanding,
                'id_peserta' => $id_peserta,
                'babak' => $babak,
                'skor' => $skor,
                'ket' => $this->input->post('ket', true),
                'waktu' => date('H:i:s'),
            ];

            $this->model->simpan('nilai', $data);
            $this->model->simpan('nilai_fix', $data2);

            if ($this->db->affected_rows() > 0) {
                $new_data = $this->db->query("SELECT * FROM nilai WHERE id_tanding = '$id_tanding' AND id_wasit = '$id_wasit' AND id_peserta = '$tandng->merah' AND status = 'proses' ORDER BY timer DESC LIMIT 4 ")->result();
                $new_data2 = $this->db->query("SELECT * FROM nilai WHERE id_tanding = '$id_tanding' AND id_wasit = '$id_wasit' AND id_peserta = '$tandng->biru' AND status = 'proses' ORDER BY timer DESC LIMIT 4 ")->result();
                echo json_encode(array('status' => 'success', 'message' => 'Data berhasil disimpan', 'new_data' => $new_data, 'new_data2' => $new_data2, 'id_nilai' => $id_nilai));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Gagal menyimpan data'));
            }
        } else {
            $data = [
                'id_nilai' => $id_nilai,
                'id_tanding' => $id_tanding,
                'id_wasit' => $id_wasit,
                'id_peserta' => $id_peserta,
                'babak' => $babak,
                'skor' => $skor,
                'ket' => $this->input->post('ket', true),
                'waktu' => date('H:i:s'),
                'timer' => $timer,
            ];

            $this->model->simpan('nilai', $data);

            if ($this->db->affected_rows() > 0) {
                $new_data = $this->db->query("SELECT * FROM nilai WHERE id_tanding = '$id_tanding' AND id_wasit = '$id_wasit' AND id_peserta = '$tandng->merah' AND status = 'proses' ORDER BY timer DESC LIMIT 4 ")->result();
                $new_data2 = $this->db->query("SELECT * FROM nilai WHERE id_tanding = '$id_tanding' AND id_wasit = '$id_wasit' AND id_peserta = '$tandng->biru' AND status = 'proses' ORDER BY timer DESC LIMIT 4 ")->result();
                echo json_encode(array('status' => 'success', 'message' => 'Data berhasil disimpan', 'new_data' => $new_data, 'new_data2' => $new_data2, 'id_nilai' => $id_nilai));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Gagal menyimpan data'));
            }
        }
    }

    public function delNilai()
    {
        $idTanding = $this->input->post('idTanding', true);
        $idWasit = $this->input->post('idWasit', true);
        $idNilai = $this->input->post('idNilai', true);
        $tandng = $this->db->query("SELECT merah, biru FROM tanding JOIN partai ON tanding.id_partai=partai.id_partai WHERE tanding.id_tanding = '$idTanding' ")->row();

        $this->model->hapus('nilai', 'id_nilai', $idNilai);

        if ($this->db->affected_rows() > 0) {
            $new_data = $this->db->query("SELECT * FROM nilai WHERE id_tanding = '$idTanding' AND id_wasit = '$idWasit' AND id_peserta = '$tandng->merah' AND status = 'proses' ORDER BY timer DESC LIMIT 4 ")->result();
            $new_data2 = $this->db->query("SELECT * FROM nilai WHERE id_tanding = '$idTanding' AND id_wasit = '$idWasit' AND id_peserta = '$tandng->biru' AND status = 'proses' ORDER BY timer DESC LIMIT 4 ")->result();
            echo json_encode(array('status' => 'success', 'message' => 'Data berhasil dihapus.', 'new_data' => $new_data, 'new_data2' => $new_data2));
            // echo json_encode($idNilai);
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Gagal menghapus data.'));
        }
    }

    public function updateNilai()
    {
        $id_nilai = $this->input->post('id_nilai', true);
        $tandng = $this->model->getBy('nilai', 'id_nilai', $id_nilai)->row();

        $cek = $this->model->getBy('nilai', 'id_nilai', $id_nilai)->row();
        if ($cek->status == 'proses') {
            $data = ['status' => 'gagal'];
        } else {
            $data = ['status' => $cek->status];
        }
        $this->model->ubah('nilai', 'id_nilai', $id_nilai, $data);
        if ($this->db->affected_rows() > 0) {
            $tandng = $this->db->query("SELECT merah, biru FROM tanding JOIN partai ON tanding.id_partai=partai.id_partai WHERE tanding.id_tanding = '$tandng->id_tanding' ")->row();
            $new_data = $this->db->query("SELECT * FROM nilai WHERE id_tanding = '$tandng->id_tanding' AND id_wasit = '$tandng->id_wasit' AND id_peserta = '$tandng->merah' AND status = 'proses' ORDER BY timer DESC LIMIT 4 ")->result();
            $new_data2 = $this->db->query("SELECT * FROM nilai WHERE id_tanding = '$tandng->id_tanding' AND id_wasit = '$tandng->id_wasit' AND id_peserta = '$tandng->biru' AND status = 'proses' ORDER BY timer DESC LIMIT 4 ")->result();
            echo json_encode(array('status' => 'success', 'new_data' => $new_data));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
}
