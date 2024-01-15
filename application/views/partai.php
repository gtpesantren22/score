<?php $this->load->view('head'); ?>
<link rel="stylesheet" href="<?= base_url('assets/vendors/select2/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') ?>">
<style>
    /* CSS untuk mengatur jarak pada tag <br> */
    br {
        margin-bottom: 5px;
        /* Sesuaikan jarak sesuai kebutuhan */
        display: block;
        /* Pastikan <br> dianggap sebagai elemen blok */
        content: " ";
        /* Tambahkan konten agar <br> dapat menerima properti margin */
    }
</style>
<div class="content-wrapper">
    <div class="page-header flex-wrap">
        <div class="header-left">
            List Partai Pertandingan
        </div>
        <div class="header-right d-flex flex-wrap mt-md-2 mt-lg-0">
            <!-- <div class="d-flex align-items-center">
                <a href="#">
                    <p class="m-0 pr-3"></p>
                </a>
                <a class="pl-3 mr-4" href="#">
                    <p class="m-0">Daftar Wasit Juri</p>
                </a>
            </div> -->
            <button class="btn btn-primary mt-2 mt-sm-0 btn-icon-text" data-toggle="modal" data-target="#tambahPeserta">
                <i class="mdi mdi-plus-circle"></i> Tambah Data </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Data Peserta Lomba</h4>
                    <p class="card-description"> Add class <code>.table</code></p> -->
                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Partai</th>
                                    <th>Babak</th>
                                    <th class="text-center text-bold" style="background-color: red; color: white;">Pesilat Merah</th>
                                    <th class="text-center text-bold" style="background-color: blue; color: white;">Pesilat Biru</th>
                                    <th>Tanggal</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($partai as $row) :
                                    $merah = $this->db->query("SELECT * FROM peserta WHERE id_peserta = '$row->merah' ")->row();
                                    $biru = $this->db->query("SELECT * FROM peserta WHERE id_peserta = '$row->biru' ")->row();
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>Ke - <?= $row->urut ?></td>
                                        <td><?= $row->babak ?></td>
                                        <td class="text-center"><b><u><?= $merah->nama ?></u></b><br>Kelas <?= $merah->kelas . ' - ' . $merah->kategori . ' - ' . jenkel($merah->jkl) ?><br> Kontingen : <?= $merah->kontingen ?></td>
                                        <td class="text-center"><b><u><?= $biru->nama ?></u></b><br>Kelas <?= $biru->kelas . ' - ' . $biru->kategori . ' - ' . jenkel($biru->jkl) ?><br> Kontingen : <?= $biru->kontingen ?></td>
                                        <td><?= $row->tanggal ?></td>
                                        <td>
                                            <a href="<?= base_url('partai/delPartai/' . $row->id_partai) ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahPeserta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Wasit Juri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('partai/partaiAdd') ?>" method="post" class="forms-sample" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Jenis Pertandingan</label>
                        <select name="babak" id="" class="form-control form-control-sm" required>
                            <option value=""> -pilih jenis-</option>
                            <option value="Penyisihan">Penyisihan</option>
                            <option value="Semi Final">Semi Final</option>
                            <option value="Final">Final</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Tanding</label>
                        <input type="date" class="form-control form-control-sm" name="tanggal" placeholder="No. HP Wasit Juri" required>
                    </div>
                    <div class="form-group">
                        <label for="">Pesilat Sudut Merah</label>
                        <select name="merah" id="" class="form-control form-control-sm slect2" required>
                            <option value=""> -pilih peserta-</option>
                            <?php foreach ($peserta as $psta) : ?>
                                <option value="<?= $psta->id_peserta ?>"><span class="text-danger"><?= $psta->nama . ' | ' . $psta->kelas . ' - ' . $psta->kategori . ' | ' . $psta->jkl . ' | ' . $psta->kontingen  ?></span></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pesilat Sudut Biru</label>
                        <select name="biru" id="" class="form-control form-control-sm slect2" required>
                            <option value=""> -pilih peserta-</option>
                            <?php foreach ($peserta as $psta) : ?>
                                <option value="<?= $psta->id_peserta ?>"><span class="text-danger"><?= $psta->nama . ' | ' . $psta->kelas . ' - ' . $psta->kategori . ' | ' . $psta->jkl . ' | ' . $psta->kontingen  ?></span></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- content-wrapper ends -->
<?php $this->load->view('foot'); ?>
<script src="<?= base_url('assets/vendors/select2/select2.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
        $(".slect2").select2({
            theme: "bootstrap"
        });
    })
</script>