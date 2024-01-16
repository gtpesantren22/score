<?php $this->load->view('dewan/head'); ?>
<link rel="stylesheet" href="<?= base_url('assets/vendors/select2/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') ?>">
<style>
    br {
        margin-bottom: 15px;
        /* Sesuaikan jarak sesuai kebutuhan */
        display: block;
        /* Pastikan <br> dianggap sebagai elemen blok */
        content: " ";
        /* Tambahkan konten agar <br> dapat menerima properti margin */
    }

    .table-centered {
        width: 100%;
        text-align: center;
        /* Mengatur teks di tengah secara horizontal */
    }

    .table-centered th,
    .table-centered td {
        padding: 10px;
        /* Sesuaikan padding sesuai kebutuhan */
        vertical-align: middle;
        /* Mengatur teks di tengah secara vertical */
    }

    /* Opsional: Menambahkan garis pada sel tabel */
    .table-centered tr {
        border-bottom: 1px solid #ddd;
    }
</style>
<div class="content-wrapper">
    <div class="page-header flex-wrap">
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body text-center">
                    <!-- <h4 class="card-title">Data Peserta Lomba</h4>
                    <p class="card-description"> Add class <code>.table</code></p> -->
                    <h3>Pada Partai ke-<?= $partai->urut ?> ini dimenangkan oleh</h3>
                    <div class="row">

                        <div class="col-md-11">
                            <table class="table table-bordered table-centered" style="width: 100%;">
                                <thead>
                                    <?php if ($skorMerah > $skorBiru) { ?>
                                        <tr>
                                            <th colspan="3" style="background-color: red; color: white;"><b>PESILAT SUDUT MERAH</b></th>
                                        </tr>
                                        <tr>
                                            <th><b style="font-size: xx-large;"><u><?= $merah->nama ?></u></b><br><b style="font-size: x-large;"><?= $merah->kontingen ?></b></th>
                                            <th>Dengan Skor <br> <b style="font-size: 70px;"><?= $skorMerah ?></b></th>
                                            <th>
                                                <form action="<?= base_url('dewan/saveWin') ?>" method="post">
                                                    <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                                    <input type="hidden" name="id_peserta" value="<?= $merah->id_peserta ?>">
                                                    <button type="submit" class="btn btn-danger">Simpan Hasil</button>
                                                </form>
                                            </th>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <th colspan="3" style="background-color: blue; color: white;"><b>PESILAT SUDUT BIRU</b></th>
                                        </tr>
                                        <tr>
                                            <th><b style="font-size: xx-large;"><u><?= $biru->nama ?></u></b><br><b style="font-size: x-large;"><?= $biru->kontingen ?></b></th>
                                            <th>Dengan Skor <br> <b style="font-size: 70px;"><?= $skorBiru ?></b></th>
                                            <th>
                                                <form action="<?= base_url('dewan/saveWin') ?>" method="post">
                                                    <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                                    <input type="hidden" name="id_peserta" value="<?= $biru->id_peserta ?>">
                                                    <button type="submit" class="btn btn-primary">Simpan Hasil</button>
                                                </form>
                                            </th>
                                        </tr>
                                    <?php } ?>
                                </thead>
                            </table>
                        </div>

                    </div>
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