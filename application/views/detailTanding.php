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

    #myButton .mdi-loading {
        display: inline-block;
        margin-right: 5px;
    }

    #myButton.loading .mdi-loading {
        display: inline-block;
    }

    #myButton.loading span:not(.mdi-loading) {
        display: none;
    }
</style>
<div class="content-wrapper">
    <div class="page-header flex-wrap">
        <div class="header-left">
            Detail Pertandingan
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
            <button class="btn btn-warning mt-2 mt-sm-0 btn-icon-text" onclick="window.location='<?= base_url('tanding') ?>' "><i class="mdi mdi-arrow-left"></i> Kembali</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Data Peserta Lomba</h4>
                    <p class="card-description"> Add class <code>.table</code></p> -->
                    <div class="row">
                        <div class="col-md-5">
                            <!-- <div class="card-title mb-2"></div> -->
                            <h3 class="mb-3"><?= $partai->babak ?> | Partai Ke - <?= $partai->urut ?></h3>
                            <span class="badge badge-dark"><?= 'Kelas ' . $merah->kelas . ' - ' . $merah->kategori ?></span>
                            <span class="badge badge-warning"><?= $merah->jkl == 'Laki-laki' ? 'Putra' : 'Putri' ?></span>
                            <hr>
                            <div class="d-flex border-bottom mb-4 pb-2">
                                <div class="hexagon">
                                    <div class="hex-mid hexagon-danger">
                                        <i class="mdi mdi-account-outline"></i>
                                    </div>
                                </div>
                                <div class="pl-4">
                                    <h4 class="font-weight-bold text-danger mb-0"><?= $merah->nama ?></h4>
                                    <h6 class="text-muted"><?= $merah->kontingen ?></h6>
                                </div>
                            </div>
                            <div class="d-flex border-bottom mb-4 pb-2">
                                <div class="d-flex">
                                    <div class="hexagon">
                                        <div class="hex-mid hexagon-primary">
                                            <i class="mdi mdi-timer-sand"></i>
                                        </div>
                                    </div>
                                    <div class="pl-4">
                                        <h4 class="font-weight-bold text-primary mb-0"> <?= $biru->nama ?></h4>
                                        <h6 class="text-muted mb-0"><?= $biru->kontingen ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card-title mb-2">Wasit Pertandingan</div>
                            <span class="badge badge-dark"><?= $ketua->nama ?></span>
                            <button class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#wasitTanding">Edit Wasit</button>
                            <button class="btn btn-primary btn-sm btn-rounded" data-toggle="modal" data-target="#juriTanding">Edit Juri</button>
                            <hr>
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Juri 1 : <?= $juri1 ? $juri1->nama : '-' ?></th>
                                    </tr>
                                    <tr>
                                        <th>Juri 2 : <?= $juri2 ? $juri2->nama : '-' ?></th>
                                    </tr>
                                    <tr>
                                        <th>Juri 3 : <?= $juri3 ? $juri3->nama : '-' ?></th>
                                    </tr>
                                    <tr>
                                        <th>Juri 4 : <?= $juri4 ? $juri4->nama : '-' ?></th>
                                    </tr>
                                    <tr>
                                        <th>Juri 5 : <?= $juri5 ? $juri5->nama : '-' ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="col-md-2">
                            <div class="card-title mb-2">Status Pertandingan</div>
                            <?php if ($tanding->aktif == 'N') { ?>
                                <span class="badge badge-danger">Belum Aktif</span>
                                <a href="<?= base_url('tanding/aktifkan/' . $tanding->id_tanding) ?>" class="btn btn-success btn-sm btn-rounded tbl-confirm" value="Pertandingan ini akan diaktifkan">Aktifkan</a>
                                <hr>
                                <div class="card-title mb-2">Proses Pertandingan</div>
                                <span class="badge badge-danger"><?= $tanding->status ?></span>
                            <?php } else { ?>
                                <span class="badge badge-success">Aktif</span>
                                <a href="<?= base_url('tanding/selesaikan/' . $tanding->id_tanding) ?>" class="btn btn-primary btn-sm btn-rounded tbl-confirm" value="Pertandingan ini akan diselesaikan">Selesaikan</a>
                                <hr>
                                <div class="card-title mb-2">Proses Pertandingan</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($tanding->aktif == 'Y') : ?>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <table class="table table-bordered text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="background-color: red; color: white;"><b>PESILAT SUDUT MERAH</b></th>
                                        </tr>
                                        <tr>
                                            <th><b style="font-size: large;"><u><?= $merah->nama ?></u></b><br><strong><?= $merah->kontingen ?></strong></th>
                                            <th><b>SKOR TOTAL</b> <br> <b style="font-size: x-large;" id="skorTotalMerah">0</b></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <center><b>FORM PENILAIAN WASIT JURI</b>
                                    <hr>
                                    <b><?= $partai->babak ?> | Partai Ke - <?= $partai->urut ?> | Gel : <?= $tanding->gel ?></b><br>
                                    <span class="badge badge-dark"><?= 'Kelas ' . $merah->kelas . ' - ' . $merah->kategori ?></span>
                                    <span class="badge badge-warning"><?= $merah->jkl == 'Laki-laki' ? 'Putra' : 'Putri' ?></span><br>

                                    <!-- BABAK 1 -->
                                    <?php if ($tanding->babak == 1) { ?>
                                        <button class="btn btn-success btn-rounded"> <span class="mdi mdi-loading mdi-spin"></span> BABAK 1</button>
                                    <?php } else {  ?>
                                        <a href="<?= base_url('tanding/pindahBabak/' . $tanding->id_tanding . '/1') ?>" class="btn btn-primary btn-rounded tbl-confirm" value="Mulai Babak ke 1">BABAK 1</a>
                                    <?php }  ?>
                                    <!-- BABAK 2 -->
                                    <?php if ($tanding->babak == 2) { ?>
                                        <button class="btn btn-success btn-rounded"> <span class="mdi mdi-loading mdi-spin"></span> BABAK 2</button>
                                    <?php } else {  ?>
                                        <a href="<?= base_url('tanding/pindahBabak/' . $tanding->id_tanding . '/2') ?>" class="btn btn-primary btn-rounded tbl-confirm" value="Mulai Babak ke 2">BABAK 2</a>
                                    <?php }  ?>
                                    <!-- BABAK 3 -->
                                    <?php if ($tanding->babak == 3) { ?>
                                        <button class="btn btn-success btn-rounded"> <span class="mdi mdi-loading mdi-spin"></span> BABAK 3</button>
                                    <?php } else {  ?>
                                        <a href="<?= base_url('tanding/pindahBabak/' . $tanding->id_tanding . '/3') ?>" class="btn btn-primary btn-rounded tbl-confirm" value="Mulai Babak ke 3">BABAK 3</a>
                                    <?php }  ?>

                                </center>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-bordered text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="background-color: blue; color: white;"><b>PESILAT SUDUT BIRU</b></th>
                                        </tr>
                                        <tr>
                                            <th><b style="font-size: large;"><u><?= $biru->nama ?></u></b><br><strong><?= $biru->kontingen ?></strong></th>
                                            <th><b>SKOR TOTAL</b> <br> <b style="font-size: x-large;" id="skorTotalbiru">0</b></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <!-- BABAK 1 -->
                                    <div class="col-md-4">
                                        <table class="table text-center table-bordered table-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="4" style="background-color: greenyellow;"><b>BABAK 1</b></th>
                                                </tr>
                                                <tr style="background-color: greenyellow;">
                                                    <th><b>JURI</b></th>
                                                    <th><b>POINT</b></th>
                                                    <th><b>FOULS</b></th>
                                                    <th><b>TOTAL</b></th>
                                                </tr>
                                            </thead>
                                            <tbody id="listSkor1"></tbody>
                                        </table>
                                    </div>
                                    <!-- BABAK 2 -->
                                    <div class="col-md-4">
                                        <table class="table text-center table-bordered table-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="4" style="background-color: greenyellow;"><b>BABAK 2</b></th>
                                                </tr>
                                                <tr style="background-color: greenyellow;">
                                                    <th><b>JURI</b></th>
                                                    <th><b>POINT</b></th>
                                                    <th><b>FOULS</b></th>
                                                    <th><b>TOTAL</b></th>
                                                </tr>
                                            </thead>
                                            <tbody id="listSkor2"></tbody>
                                        </table>
                                    </div>
                                    <!-- BABAK 3 -->
                                    <div class="col-md-4">
                                        <table class="table text-center table-bordered table-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="4" style="background-color: greenyellow;"><b>BABAK 3</b></th>
                                                </tr>
                                                <tr style="background-color: greenyellow;">
                                                    <th><b>JURI</b></th>
                                                    <th><b>POINT</b></th>
                                                    <th><b>FOULS</b></th>
                                                    <th><b>TOTAL</b></th>
                                                </tr>
                                            </thead>
                                            <tbody id="listSkor3"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>

<div class="modal fade" id="wasitTanding" tabindex="-1" role="dialog" aria-labellegdby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ganti Ketua Pertandingan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="<?= base_url('tanding/updateKetua') ?>" method="post" class="forms-sample" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $tanding->id_tanding ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Ketua Pertandingan</label>
                        <select name="wasit" id="" class="form-control form-control-sm slect2" required>
                            <option value=""> -pilih wasit-</option>
                            <?php foreach ($wasit as $psta) : ?>
                                <option <?= $psta->id_wasit == $tanding->wasit ? 'selected' : '' ?> value="<?= $psta->id_wasit ?>"><span class="text-danger"><?= $psta->nama ?></span></option>
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
<div class="modal fade" id="juriTanding" tabindex="-1" role="dialog" aria-labellegdby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Juri Pertandingan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="<?= base_url('tanding/updateJuri') ?>" method="post" class="forms-sample" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $tanding->id_tanding ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Juri 1</label>
                        <select name="juri1" id="" class="form-control form-control-sm slect2">
                            <option value=""> -pilih juri-</option>
                            <?php foreach ($wasit as $psta) : ?>
                                <option <?= $psta->id_wasit == $tanding->juri1 ? 'selected' : '' ?> value="<?= $psta->id_wasit ?>"><span class="text-danger"><?= $psta->nama ?></span></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Juri 2</label>
                        <select name="juri2" id="" class="form-control form-control-sm slect2">
                            <option value=""> -pilih juri-</option>
                            <?php foreach ($wasit as $psta) : ?>
                                <option <?= $psta->id_wasit == $tanding->juri2 ? 'selected' : '' ?> value="<?= $psta->id_wasit ?>"><span class="text-danger"><?= $psta->nama ?></span></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Juri 3</label>
                        <select name="juri3" id="" class="form-control form-control-sm slect2">
                            <option value=""> -pilih juri-</option>
                            <?php foreach ($wasit as $psta) : ?>
                                <option <?= $psta->id_wasit == $tanding->juri3 ? 'selected' : '' ?> value="<?= $psta->id_wasit ?>"><span class="text-danger"><?= $psta->nama ?></span></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Juri 4</label>
                        <select name="juri4" id="" class="form-control form-control-sm slect2">
                            <option value=""> -pilih juri-</option>
                            <?php foreach ($wasit as $psta) : ?>
                                <option <?= $psta->id_wasit == $tanding->juri4 ? 'selected' : '' ?> value="<?= $psta->id_wasit ?>"><span class="text-danger"><?= $psta->nama ?></span></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Juri 5</label>
                        <select name="juri5" id="" class="form-control form-control-sm slect2">
                            <option value=""> -pilih juri-</option>
                            <?php foreach ($wasit as $psta) : ?>
                                <option <?= $psta->id_wasit == $tanding->juri5 ? 'selected' : '' ?> value="<?= $psta->id_wasit ?>"><span class="text-danger"><?= $psta->nama ?></span></option>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var button = document.getElementById('myButton');

        // Simulasi proses yang memerlukan waktu
        setTimeout(function() {
            // Hentikan loading setelah proses selesai
            button.classList.remove('loading');
        }, 1000); // Contoh: loading selama 3 detik
    });
</script>

<script>
    function mainFunction() {
        merahTotal();
        biruTotal();
        skorBabak1();
        skorBabak2();
        skorBabak3();
    };


    function merahTotal() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('tanding/totalSkor/merah/' . $tanding->id_tanding); ?>',
            dataType: 'json',
            success: function(data) {
                $('#skorTotalMerah').text(data);
            },
            error: function(xhr, status, error) {
                alert('Gagal memuat data awal: ' + error);
            }
        });
    }

    function biruTotal() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('tanding/totalSkor/biru/' . $tanding->id_tanding); ?>',
            dataType: 'json',
            success: function(data) {
                $('#skorTotalbiru').text(data);
            },
            error: function(xhr, status, error) {
                alert('Gagal memuat data awal: ' + error);
            }
        });
    }

    function skorBabak1() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('tanding/skorBabak/1/' . $tanding->id_tanding); ?>',
            dataType: 'html',
            success: function(data) {
                $('#listSkor1').html(data);
            },
            error: function(xhr, status, error) {
                alert('Gagal memuat data awal: ' + error);
            }
        });
    }

    function skorBabak2() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('tanding/skorBabak/2/' . $tanding->id_tanding); ?>',
            dataType: 'html',
            success: function(data) {
                $('#listSkor2').html(data);
            },
            error: function(xhr, status, error) {
                alert('Gagal memuat data awal: ' + error);
            }
        });
    }

    function skorBabak3() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('tanding/skorBabak/3/' . $tanding->id_tanding); ?>',
            dataType: 'html',
            success: function(data) {
                $('#listSkor3').html(data);
            },
            error: function(xhr, status, error) {
                alert('Gagal memuat data awal: ' + error);
            }
        });
    }

    setInterval(mainFunction, 1000);
</script>