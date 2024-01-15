<?php $this->load->view('head'); ?>
<div class="content-wrapper">
    <div class="page-header flex-wrap">
        <div class="header-left">
            Daftar User Aplikasi
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
                        <table class="table table-striped table-sm" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Aktif</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($userData as $row) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->nama ?></td>
                                        <td><?= $row->username ?></td>
                                        <td><?= $row->level ?></td>
                                        <td><?= $row->aktif ?></td>
                                        <td>
                                            <a href="<?= base_url('master/delUser/' . $row->id_user) ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Akun User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/userAdd') ?>" method="post" class="forms-sample" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control form-control-sm" name="nama" placeholder="Nama Akun" required>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control form-control-sm" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" class="form-control form-control-sm" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="">Level</label>
                        <select name="level" class="form-control form-control-sm" id="" required>
                            <option value=""> -pilih level- </option>
                            <option value="admin">Admin</option>
                            <option value="dewan">Dewan Pertandingan</option>
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

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    })
</script>