<?php $this->load->view('head'); ?>
<div class="content-wrapper">
    <div class="page-header flex-wrap">
        <div class="header-left">
            Daftar Wasit Juri
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
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th>PIN</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($wasit as $row) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->nama ?></td>
                                        <td><?= $row->alamat ?></td>
                                        <td><?= $row->hp ?></td>
                                        <td><?= $row->pin ?></td>
                                        <td>
                                            <a href="<?= base_url('master/delWasit/' . $row->id_wasit) ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Wasit Juri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/wasitAdd') ?>" method="post" class="forms-sample" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control form-control-sm" name="nama" placeholder="Nama Wasit Juri" required>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea class="form-control form-control-sm" name="alamat" placeholder="Alamat Wasit Juri" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">No. HP</label>
                        <input type="text" class="form-control form-control-sm" name="hp" placeholder="No. HP Wasit Juri" required>
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