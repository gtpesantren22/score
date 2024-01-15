<?php $this->load->view('head'); ?>
<div class="content-wrapper">
    <div class="page-header flex-wrap">
        <div class="header-left">
            <button class="btn btn-primary mb-2 mb-md-0 mr-2" data-toggle="modal" data-target="#uploadPeserta"> Import Data Peserta </button>
            <a href="<?= base_url('master/template') ?>" class="btn btn-outline-primary mb-2 mb-md-0"> Download Template </a>
        </div>
        <div class="header-right d-flex flex-wrap mt-md-2 mt-lg-0">
            <div class="d-flex align-items-center">
                <a href="#">
                    <p class="m-0 pr-3"></p>
                </a>
                <a class="pl-3 mr-4" href="#">
                    <p class="m-0">Daftar Peserta Pertandingan</p>
                </a>
            </div>
            <button class="btn btn-primary mt-2 mt-sm-0 btn-icon-text" data-toggle="modal" data-target="#tambahPeserta">
                <i class="mdi mdi-plus-circle"></i> Tambah Peserta </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Data Peserta Lomba</h4>
                    <p class="card-description"> Add class <code>.table</code></p> -->
                    <div class="table-responsive">
                        <table class="table table-striped table-sm" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kls/Kategori</th>
                                    <th>Kontingen</th>
                                    <th>JKL</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($peserta as $row) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->nama ?></td>
                                        <td><?= $row->kelas . ' - ' . $row->kategori ?></td>
                                        <td><?= $row->kontingen ?></td>
                                        <td><?= $row->jkl ?></td>
                                        <td>
                                            <a href="<?= base_url('master/delPeserta/' . $row->id_peserta) ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Peserta Lomba</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/addPeserta') ?>" method="post" class="forms-sample">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="kategori" id="" class="form-control form-control-sm" required>
                                    <option value=""> -pilih kategori-</option>
                                    <option value="USIA DINI">USIA DINI</option>
                                    <option value="PRA REMAJA">PRA REMAJA</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Kontingen</label>
                                <input type="text" class="form-control form-control-sm" name="kontingen" placeholder="Nama Kontingen" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-sm" name="nama" placeholder="Nama Lengkap Peserta" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" class="form-control form-control-sm" name="tgl" placeholder="Tanggal Lahir" required>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <select name="jkl" id="" class="form-control form-control-sm" required>
                                    <option value=""> -pilih jkl-</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Kelas Tanding</label>
                                <select name="kelas" id="" class="form-control form-control-sm" required>
                                    <option value=""> -pilih kelas-</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Berat Badan</label>
                                <input type="number" class="form-control form-control-sm" name="berat" placeholder="Berat Badan Peserta" required>
                            </div>
                            <div class="form-group">
                                <label for="">Official/Pelatih</label>
                                <input type="text" class="form-control form-control-sm" name="pelatih" placeholder="Official/Pelatih Peserta" required>
                            </div>
                            <div class="form-group">
                                <label for="">No.HP Official/Pelatih</label>
                                <input type="text" class="form-control form-control-sm" name="hp" placeholder="No.HP Official/Pelatih Peserta" required>
                            </div>
                            <!-- <div class="form-group">
                                <label for="">Foto Peserta <i class="text-danger">(opsional)</i></label>
                                <input type="file" class="form-control form-control-sm" name="foto">
                            </div> -->
                        </div>
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
<div class="modal fade" id="uploadPeserta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Peserta Lomba</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/uploadPeserta') ?>" method="post" class="forms-sample" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Upload file</label>
                        <input type="file" class="form-control form-control-sm" name="peserta" placeholder="Nama Kontingen" required>
                        <small class="text-danger">* Upload data berdasarkan file yang telah didownload</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- content-wrapper ends -->
<?php $this->load->view('foot'); ?>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    })
</script>