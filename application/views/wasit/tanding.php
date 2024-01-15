<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>DIGITAL SCORING Apps</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/demo_2/style.css" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.png" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/DataTables/datatables.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/iziToast/dist/css/iziToast.min.css" />

    <style>
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
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_horizontal-navbar.html -->
        <div class="horizontal-menu">
            <nav class="navbar top-navbar col-lg-12 col-12 p-0">
                <div class="container">
                    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                        <a class="navbar-brand brand-logo" href="<?= base_url() ?>">
                            DIGITAL SCORING
                            <!-- <span class="font-13 d-block font-weight"> </span> -->
                            <span class="font-12 d-block font-weight">KH. AHMAD BAIDLOWI CUP 1 - Kejuaraan Pencak Silat Se-Tapal Kuda | PonPes Darul Lughah Wal Karomah </span>
                        </a>
                        <a class="navbar-brand brand-logo-mini" href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/images/logo-mini.svg" alt="logo" /></a>
                    </div>
                    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                        <button class="btn btn-sm btn-info" onclick="window.location='<?= base_url('wasittanding') ?>'"><span class="mdi mdi-refresh"></span> Refresh Halaman</button>
                        <button class="btn btn-sm btn-danger"><span class="mdi mdi-logout-variant"></span> LogOut</button>
                    </div>
                </div>
            </nav>

        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">

                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('ok') ?>"></div>
                <div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error') ?>"></div>

                <!-- ISI  -->
                <div class="row">
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
                                                    <th><b>SKOR TOTAL</b> <br> <b style="font-size: xx-large;" id="skorTotalMerah">0</b></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="col-md-4">
                                        <center><b>Wasit : <?= $wasit->nama ?></b>
                                            <hr>
                                            <b><?= $partai->babak ?> | Partai Ke - <?= $partai->urut ?> | Gel : <?= $tanding->gel ?></b><br>
                                            <span class="badge badge-dark"><?= 'Kelas ' . $merah->kelas . ' - ' . $merah->kategori ?></span>
                                            <span class="badge badge-warning"><?= $merah->jkl == 'Laki-laki' ? 'Putra' : 'Putri' ?></span><br>

                                            <!-- BABAK 1 -->
                                            <?php if ($tanding->babak == 1) { ?>
                                                <button class="btn btn-success btn-rounded"> <span class="mdi mdi-loading mdi-spin"></span> BABAK 1</button>
                                            <?php } else {  ?>
                                                <button class="btn btn-primary btn-rounded">BABAK 1</button>
                                            <?php }  ?>
                                            <!-- BABAK 2 -->
                                            <?php if ($tanding->babak == 2) { ?>
                                                <button class="btn btn-success btn-rounded"> <span class="mdi mdi-loading mdi-spin"></span> BABAK 2</button>
                                            <?php } else {  ?>
                                                <button class="btn btn-primary btn-rounded">BABAK 2</button>
                                            <?php }  ?>
                                            <!-- BABAK 3 -->
                                            <?php if ($tanding->babak == 3) { ?>
                                                <button class="btn btn-success btn-rounded"> <span class="mdi mdi-loading mdi-spin"></span> BABAK 3</button>
                                            <?php } else {  ?>
                                                <button class="btn btn-primary btn-rounded">BABAK 3</button>
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
                                                    <th><b>SKOR TOTAL</b> <br> <b style="font-size: xx-large;" id="skorTotalBiru">0</b></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <!-- MERAH -->
                                            <div class="col-md-4">
                                                <table class="table text-center table-bordered table-sm table-striped" id="dataMerah">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="5" style="background-color: red; color: white;"><b>SKOR PESILAT SUDUT MERAH</b></th>
                                                        </tr>
                                                        <tr style="background-color: red; color: white;">
                                                            <th><b>BABAK</b></th>
                                                            <th><b>SKOR</b></th>
                                                            <th><b>KET</b></th>
                                                            <th><b>WAKTU</b></th>
                                                            <th><b>#</b></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- TENGAH -->
                                            <div class="col-md-4">
                                                <table class="table text-center table-bordered table-sm table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="4" style="background-color: greenyellow;"><b>TOTAL SKOR</b></th>
                                                        </tr>
                                                        <tr style="background-color: greenyellow;">
                                                            <th><b>BABAK</b></th>
                                                            <th><b>POINT</b></th>
                                                            <th><b>FOULS</b></th>
                                                            <th><b>TOTAL</b></th>
                                                        </tr>
                                                    </thead>
                                                    <!-- Babak 1 -->
                                                    <tbody id="babak1"></tbody>
                                                    <!-- Babak 1 -->
                                                    <tbody id="babak2"></tbody>
                                                    <!-- Babak 1 -->
                                                    <tbody id="babak3"></tbody>
                                                </table>
                                            </div>
                                            <!-- BIRU -->
                                            <div class="col-md-4">
                                                <table class="table text-center table-bordered table-sm table-striped" id="dataBiru">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="5" style="background-color: blue; color: white;"><b>SKOR PESILAT SUDUT BIRU</b></th>
                                                        </tr>
                                                        <tr style="background-color: blue; color: white;">
                                                            <th><b>BABAK</b></th>
                                                            <th><b>SKOR</b></th>
                                                            <th><b>KET</b></th>
                                                            <th><b>WAKTU</b></th>
                                                            <th><b>#</b></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($tanding->babak != 0) : ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <form id="pukulMerah">
                                                    <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                                    <input type="hidden" name="id_wasit" value="<?= $wasit->id_wasit ?>">
                                                    <input type="hidden" name="id_peserta" value="<?= $partai->merah ?>">
                                                    <input type="hidden" name="babak" value="<?= $tanding->babak ?>">
                                                    <input type="hidden" name="skor" value="1">
                                                    <input type="hidden" name="ket" value="Pukulan">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-outline-danger">
                                                            <i class="mdi mdi-boxing-glove d-block mb-1"></i> Pukulan </button>
                                                    </div>
                                                </form>

                                                <form id="tendangMerah">
                                                    <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                                    <input type="hidden" name="id_wasit" value="<?= $wasit->id_wasit ?>">
                                                    <input type="hidden" name="id_peserta" value="<?= $partai->merah ?>">
                                                    <input type="hidden" name="babak" value="<?= $tanding->babak ?>">
                                                    <input type="hidden" name="skor" value="2">
                                                    <input type="hidden" name="ket" value="Tendangan">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-outline-danger">
                                                            <i class="mdi mdi-karate d-block mb-1"></i> Tendangan </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <form id="pukulBiru">
                                                    <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                                    <input type="hidden" name="id_wasit" value="<?= $wasit->id_wasit ?>">
                                                    <input type="hidden" name="id_peserta" value="<?= $partai->biru ?>">
                                                    <input type="hidden" name="babak" value="<?= $tanding->babak ?>">
                                                    <input type="hidden" name="skor" value="1">
                                                    <input type="hidden" name="ket" value="Pukulan">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-outline-primary">
                                                            <i class="mdi mdi-boxing-glove d-block mb-1"></i> Pukulan </button>
                                                    </div>
                                                </form>

                                                <form id="tendangBiru">
                                                    <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                                    <input type="hidden" name="id_wasit" value="<?= $wasit->id_wasit ?>">
                                                    <input type="hidden" name="id_peserta" value="<?= $partai->biru ?>">
                                                    <input type="hidden" name="babak" value="<?= $tanding->babak ?>">
                                                    <input type="hidden" name="skor" value="2">
                                                    <input type="hidden" name="ket" value="Tendangan">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-outline-primary">
                                                            <i class="mdi mdi-karate d-block mb-1"></i> Tendangan </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
    <script src="<?= base_url() ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url() ?>assets/DataTables/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/iziToast/dist/js/iziToast.min.js"></script>
    <script src="<?= base_url() ?>assets/iziToast/my-notif.js"></script>


    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('wasittanding/nilaiTandingMerah/' . $tanding->id_tanding . '/' . $wasit->id_wasit); ?>',
                dataType: 'json',
                success: function(data) {
                    updateTable(data);
                    merahTotal();
                    skorBabak1();
                    skorBabak2();
                    skorBabak3();
                },
                error: function(xhr, status, error) {
                    alert('Gagal memuat data awal merah: ' + error);
                }
            });
        });
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('wasittanding/nilaiTandingBiru/' . $tanding->id_tanding . '/' . $wasit->id_wasit); ?>',
                dataType: 'json',
                success: function(data) {
                    updateTableBiru(data);
                    biruTotal();
                },
                error: function(xhr, status, error) {
                    // alert('Gagal memuat data awal biru: ' + error);
                    console.log('Gagal memuat data awal biru: ' + error);
                }
            });
        });

        function saveData(formData, callback) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('wasittanding/addNilai'); ?>',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // alert(response);

                    if (response.status === 'success') {
                        // Panggil fungsi callback untuk menangani respons
                        // console.log('data berhasil masuk')
                        callback(response.new_data);
                        merahTotal();

                        skorBabak1();
                        skorBabak2();
                        skorBabak3();
                    }
                },
                error: function(xhr, status, error) {
                    alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                    // console.error('AJAX error:', status, error);
                }
            });
        }

        function saveData2(formData, callback) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('wasittanding/addNilai'); ?>',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // alert(response);

                    if (response.status === 'success') {
                        // Panggil fungsi callback untuk menangani respons
                        // console.log('data berhasil masuk')
                        callback(response.new_data2);
                        biruTotal();

                        skorBabak1();
                        skorBabak2();
                        skorBabak3();
                    }
                },
                error: function(xhr, status, error) {
                    alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                    // console.error('AJAX error:', status, error);
                }
            });
        }

        function updateTable(newData) {
            // Hapus semua baris dari tabel
            $('#dataMerah tbody').empty();

            // Tambahkan baris baru ke tabel
            $.each(newData, function(index, row) {
                var newRow = '<tr>' +
                    '<td>' + row.babak + '</td>' +
                    '<td>' + row.skor + '</td>' +
                    '<td>' + row.ket + '</td>' +
                    '<td>' + row.waktu + '</td>' +
                    '<td><button type="button" onclick="deleteData(\'' + row.id_tanding + '\', \'' + row.id_wasit + '\', ' + row.id_nilai + ')">del</button></td>' +
                    '</tr>';
                $('#dataMerah tbody').append(newRow);
            });
        }

        function updateTableBiru(newData) {
            // Hapus semua baris dari tabel
            $('#dataBiru tbody').empty();

            // Tambahkan baris baru ke tabel
            $.each(newData, function(index, row) {
                var newRow = '<tr>' +
                    '<td>' + row.babak + '</td>' +
                    '<td>' + row.skor + '</td>' +
                    '<td>' + row.ket + '</td>' +
                    '<td>' + row.waktu + '</td>' +
                    '<td><button type="button" onclick="deleteData(\'' + row.id_tanding + '\', \'' + row.id_wasit + '\', ' + row.id_nilai + ')">del</button></td>' +
                    '</tr>';
                $('#dataBiru tbody').append(newRow);
            });
        }

        function merahTotal() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('wasittanding/nilaiTotal/merah/' . $tanding->id_tanding . '/' . $wasit->id_wasit); ?>',
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
                url: '<?= base_url('wasittanding/nilaiTotal/biru/' . $tanding->id_tanding . '/' . $wasit->id_wasit); ?>',
                dataType: 'json',
                success: function(data) {
                    $('#skorTotalBiru').text(data);
                },
                error: function(xhr, status, error) {
                    alert('Gagal memuat data awal: ' + error);
                }
            });
        }

        function skorBabak1() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('wasittanding/skorBabak/1/' . $tanding->id_tanding . '/' . $wasit->id_wasit); ?>',
                dataType: 'html',
                success: function(data) {
                    $('#babak1').html(data);
                },
                error: function(xhr, status, error) {
                    alert('Gagal memuat data awal: ' + error);
                }
            });
        }

        function skorBabak2() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('wasittanding/skorBabak/2/' . $tanding->id_tanding . '/' . $wasit->id_wasit); ?>',
                dataType: 'html',
                success: function(data) {
                    $('#babak2').html(data);
                },
                error: function(xhr, status, error) {
                    alert('Gagal memuat data awal: ' + error);
                }
            });
        }

        function skorBabak3() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('wasittanding/skorBabak/3/' . $tanding->id_tanding . '/' . $wasit->id_wasit); ?>',
                dataType: 'html',
                success: function(data) {
                    $('#babak3').html(data);
                },
                error: function(xhr, status, error) {
                    alert('Gagal memuat data awal: ' + error);
                }
            });
        }

        function deleteData(idTanding, idWasit, idNilai) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('wasittanding/delNilai'); ?>',
                data: {
                    idTanding: idTanding,
                    idWasit: idWasit,
                    idNilai: idNilai,
                },
                dataType: 'json',
                success: function(response) {
                    // alert(response.message);

                    if (response.status === 'success') {
                        // Panggil fungsi callback untuk menangani respons
                        updateTable(response.new_data);
                        updateTableBiru(response.new_data2);

                        merahTotal();
                        biruTotal();

                        skorBabak1();
                        skorBabak2();
                        skorBabak3();
                    }
                },
                error: function(xhr, status, error) {
                    alert('Gagal menghapus data. Kesalahan: ' + status + ' - ' + error);
                }
            });
        }

        // Contoh penggunaan
        $('#pukulMerah button').on('click', function() {
            var formData = $('#pukulMerah').serialize();
            saveData(formData, updateTable);

            // console.log('Puklan');
        });
        $('#tendangMerah button').on('click', function() {
            var formData = $('#tendangMerah').serialize();
            saveData(formData, updateTable);

            // console.log('formData');
        });

        $('#pukulBiru button').on('click', function() {
            var formData = $('#pukulBiru').serialize();
            saveData2(formData, updateTableBiru);

            // console.log('Puklan');
        });
        $('#tendangBiru button').on('click', function() {
            var formData = $('#tendangBiru').serialize();
            saveData2(formData, updateTableBiru);

            // console.log('formData');
        });
    </script>

</body>

</html>