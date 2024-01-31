<?php $this->load->view('dewan/head'); ?>
<link rel="stylesheet" href="<?= base_url('assets/vendors/select2/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') ?>">
<div class="content-wrapper">
    <div class="page-header flex-wrap">
        <div class="header-left">
            Daftar Pertandingan
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
            <!-- <button class="btn btn-primary mt-2 mt-sm-0 btn-icon-text" data-toggle="modal" data-target="#tambahPeserta"><i class="mdi mdi-plus-circle"></i> Data </button> -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Data Peserta Lomba</h4>
                    <p class="card-description"> Add class <code>.table</code></p> -->
                    <?php if ($tanding) { ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Partai</th>
                                        <th>Pemimpin Pertandingan</th>
                                        <th>Aktif|Status|Gelanggang</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($tanding as $row) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>Partai Ke - <?= $row->urut ?></td>
                                            <td><?= $row->nama ?></td>
                                            <td><span class="badge badge-warning">Aktif : <?= $row->aktif ?></span> | <span class="badge badge-primary"><?= $row->status ?></span> | <span class="badge badge-success">Gel : <?= $row->gel ?></span></td>
                                            <td>
                                                <a href="<?= base_url('dewan/delTanding/' . $row->id_tanding) ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
                                                <a href="<?= base_url('dewan/detail/' . $row->id_tanding) ?>" class="btn btn-sm btn-info">Detail</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-center">
                            <p>Tekan tombol dibawah jika tidak ada pertandingan yang muncul</p>
                            <button class="btn btn-primary" onclick="window.location='<?= base_url('dewan/tanding') ?>'">REFRESH HALAMAN</button>
                        </div>
                        <div class="col-md-4"></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- content-wrapper ends -->
<?php $this->load->view('dewan/foot'); ?>
<script src="<?= base_url('assets/vendors/select2/select2.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
        $(".slect2").select2({
            theme: "bootstrap"
        });
    })
</script>