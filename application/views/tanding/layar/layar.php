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
        body {
            font-family: 'Roboto', sans-serif;
            /* Menggunakan font dari Google Fonts */
        }

        .bg-red {
            background: linear-gradient(to bottom, #8c0000, #ff0000b3);
        }

        .bg-blue {
            background: linear-gradient(to bottom, #0000b3, #56c7ff);
        }

        .table-fixed {
            width: 100%;
            table-layout: fixed;
        }

        .table-fixed th,
        .table-fixed td {
            overflow: hidden;
        }

        .button-red {
            background-color: red;
            color: white;
            border: 1px solid #000000;
        }

        .button-blue {
            background-color: blue;
            color: white;
            border: 1px solid #000000;
        }

        .button-netral {
            background-color: yellow;
            color: black;
            border: 1px solid #000000;
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
                        <!-- <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item nav-profile dropdown">
                                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                    <div class="nav-profile-img">
                                        <img src="<?= base_url() ?>assets/images/faces/face1.jpg" alt="image" />
                                    </div>
                                    <div class="nav-profile-text">
                                        <p class="text-black font-weight-semibold m-0"> Olson jass </p>
                                        <span class="font-13 online-color">online <i class="mdi mdi-chevron-down"></i></span>
                                    </div>
                                </a>
                                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">
                                        <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                                </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                            <span class="mdi mdi-menu"></span>
                        </button> -->
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
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="content">
                                        <?php
                                        $imgMerah = $merah->jkl == 'Laki-laki' ? 'male.png' : 'female.png';
                                        $imgBiru = $biru->jkl == 'Laki-laki' ? 'male.png' : 'female.png';

                                        $jkl = $merah->jkl == 'Laki-laki' ? 'PUTRA' : 'PUTRI';
                                        ?>
                                        <table class="table table-borderless text-center">
                                            <tr>
                                                <th colspan="5" style="font-weight: bold; font-size: large; background-color: #43536c; color: white;  padding: 10px; border: 1px solid #fff;border-radius: 30px 30px 0 0;">TANDING</th>
                                            </tr>
                                            <tr>
                                                <th style="font-weight: bolder; font-size: xx-large; background-color: #9baec4; color: white;"><img src="<?= base_url('assets/images/logoIPSI.png') ?>" alt="" srcset=""></th>
                                                <!-- <th style="font-weight: bolder; font-size: xx-large; background-color: #9baec4; color: white;">G<?= strtoupper($tanding->gel . ' - ' . $partai->urut) ?></th> -->
                                                <th style="font-weight: bolder; font-size: xx-large; background-color: #9baec4; color: white;">PARTAI <?= strtoupper($partai->urut) ?></th>
                                                <!-- <th style="font-weight: bolder; font-size: xx-large; background-color: #9baec4; color: white;"><?= strtoupper($partai->babak) ?></th> -->
                                                <th style="font-weight: bolder; font-size: xx-large; background-color: #9baec4; color: white;"><?= strtoupper($merah->kelas .  ' ' . $merah->kategori .  ' ' . $jkl) ?></th>
                                                <th style="font-weight: bolder; font-size: xx-large; background-color: #9baec4; color: white;"><img src="<?= base_url('assets/images/logoKab.png') ?>" alt="" srcset=""></th>
                                            </tr>
                                        </table>
                                        <!-- <hr> -->
                                        <br>
                                        <div class="row">
                                            <div class="col-md-2 text-center">
                                                <img src="<?= base_url('assets/images/merah.png') ?>" width="70px">
                                            </div>
                                            <div class="col-md-3">
                                                <h3 class="font-weight-bold" style="color: #eb493a;"><?= strtoupper($merah->nama) ?></h3>
                                                <h5 class="font-weight-bold"><?= strtoupper($merah->kontingen) ?></h5>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <b style="font-size: 55px;" id="timer">00:00</b>
                                            </div>
                                            <div class="col-md-3" style="text-align: right;">
                                                <h3 class="font-weight-bold" style="color: #047df2;"><?= strtoupper($biru->nama) ?></h3>
                                                <h5 class="font-weight-bold"><?= strtoupper($biru->kontingen) ?></h5>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <img src="<?= base_url('assets/images/biru.png') ?>" width="70px">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-2">
                                            <div class="card">
                                                <div class="card-body p-2">
                                                    <div class="mb-1"><img src="<?= base_url('assets/images/binaan1.png') ?>" height="20"> <b>Binaan</b></div>
                                                    <div class="mb-3 btn-group btn-xl btn-block" role="group" aria-label="Basic example">
                                                        <button id="binaan1Merah" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">1</button>
                                                        <button id="binaan2Merah" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">2</button>
                                                    </div>
                                                    <div class="mb-1"><img src="<?= base_url('assets/images/teguran1.png') ?>" height="20"> <b>Teguran</b></div>
                                                    <div class="mb-3 btn-group btn-xl btn-block" role="group" aria-label="Basic example">
                                                        <button id="teguran1Merah" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">1</button>
                                                        <button id="teguran2Merah" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">2</button>
                                                    </div>
                                                    <div class="mb-1"><img src="<?= base_url('assets/images/P11.png') ?>" height="20"> <b>Peringatan</b></div>
                                                    <div class="mb-3 btn-group btn-xl btn-block" role="group" aria-label="Basic example">
                                                        <button id="peringatan1Merah" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">1</button>
                                                        <button id="peringatan2Merah" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">2</button>
                                                    </div>
                                                    <div class="mb-1"><b>Jatuhan</b></div>
                                                    <div class="text-center">
                                                        <b class="text-primary" style="font-size: 55px;"><i id="jatuhanMerah">0</i></b>
                                                        <b class="text-secondary" style="font-size: 25px;"><i>x</i></b>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="card bg-red">
                                                <div class="card-body text-center">
                                                    <b style="font-size: 150px; color: white;" id="pointMerah">0</b>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <div class="btn-group btn-xl btn-block" role="group" aria-label="Basic example">
                                                    <button id="j1MerahPukul" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">J1</button>
                                                    <button id="j2MerahPukul" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">J2</button>
                                                    <button id="j3MerahPukul" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">J3</button>
                                                </div>
                                                <hr>
                                                <div class="btn-group btn-xl btn-block" role="group" aria-label="Basic example">
                                                    <button id="j1MerahTendang" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">J1</button>
                                                    <button id="j2MerahTendang" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">J2</button>
                                                    <button id="j3MerahTendang" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">J3</button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-2 text-center">

                                            <button class="btn btn-xl btn-block btn-light" style="font-size: 40px; font-weight: bolder;" id="babak1">1</button>
                                            <button class="btn btn-xl btn-block btn-light" style="font-size: 40px; font-weight: bolder;" id="babak2">2</button>
                                            <button class="btn btn-xl btn-block btn-light" style="font-size: 40px; font-weight: bolder;" id="babak3">3</button>
                                            <br>
                                            <b class="text-primary" style="font-size: larger;">ROUND</b>
                                            <div class="mt-3">
                                                <button class="btn btn-xl btn-block btn-light" style="font-size: 40px; font-weight: bolder;"><img height="50" src="<?= base_url() ?>assets/images/pukulan.png"></button>
                                                <button class="btn btn-xl btn-block btn-light" style="font-size: 40px; font-weight: bolder;"><img height="50" src="<?= base_url() ?>assets/images/tendangan.png"></button>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card bg-blue">
                                                <div class="card-body text-center">
                                                    <b style="font-size: 150px; color: white;" id="pointBiru">0</b>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <div class="btn-group btn-xl btn-block" role="group" aria-label="Basic example">
                                                    <button id="j1BiruPukul" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">J1</button>
                                                    <button id="j2BiruPukul" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">J2</button>
                                                    <button id="j3BiruPukul" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">J3</button>
                                                </div>
                                                <hr>
                                                <div class="btn-group btn-xl btn-block" role="group" aria-label="Basic example">
                                                    <button id="j1BiruTendang" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">J1</button>
                                                    <button id="j2BiruTendang" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">J2</button>
                                                    <button id="j3BiruTendang" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">J3</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="card">
                                                <div class="card-body p-2">
                                                    <div class="mb-1"><img src="<?= base_url('assets/images/binaan1.png') ?>" height="20"> <b>Binaan</b></div>
                                                    <div class="mb-3 btn-group btn-xl btn-block" role="group" aria-label="Basic example">
                                                        <button id="binaan1Biru" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">1</button>
                                                        <button id="binaan2Biru" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">2</button>
                                                    </div>
                                                    <div class="mb-1"><img src="<?= base_url('assets/images/teguran1.png') ?>" height="20"> <b>Teguran</b></div>
                                                    <div class="mb-3 btn-group btn-xl btn-block" role="group" aria-label="Basic example">
                                                        <button id="teguran1Biru" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">1</button>
                                                        <button id="teguran2Biru" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">2</button>
                                                    </div>
                                                    <div class="mb-1"><img src="<?= base_url('assets/images/P11.png') ?>" height="20"> <b>Peringatan</b></div>
                                                    <div class="mb-3 btn-group btn-xl btn-block" role="group" aria-label="Basic example">
                                                        <button id="peringatan1Biru" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">1</button>
                                                        <button id="peringatan2Biru" type="button" class="btn btn-light" style="font-size: 35px; font-weight: bolder;">2</button>
                                                    </div>
                                                    <div class="mb-1"><b>Jatuhan</b></div>
                                                    <div class="text-center">
                                                        <b class="text-primary" style="font-size: 55px;"><i id="jatuhanBiru">0</i></b>
                                                        <b class="text-secondary" style="font-size: 25px;"><i>x</i></b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-3 text-center">

                                        </div>
                                        <div class="col-md-2">

                                        </div>
                                        <div class="col-md-3">

                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                                </div>
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
    <div class="modal fade" id="upModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="staticBackdropLabel">Verifikasi Wasit Juri</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h2 id="jenisVerifkasi"></h2>
                        <img src="" id="v-img" alt="" srcset="">
                    </div>
                    <!-- <hr> -->
                    <br>
                    <div id="hasilVote"></div>
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-8">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- plugins:js -->
    <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
    <script src="<?= base_url() ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url() ?>assets/js/misc.js"></script>
    <script src="<?= base_url() ?>assets/js/settings.js"></script>
    <script src="<?= base_url() ?>assets/js/todolist.js"></script>
    <script src="<?= base_url() ?>assets/DataTables/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/iziToast/dist/js/iziToast.min.js"></script>
    <script src="<?= base_url() ?>assets/iziToast/my-notif.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->

    <script>
        setInterval(cekInputan, 500);
        setInterval(mainFunction, 1000);

        function mainFunction() {
            babakAktif();
            pointMerah();
            pointBiru();
            cekBinaan();
            cekTeguran();
            cekPeringatan();
            cekVerifikasi();
            cekJatuhan();
        };

        function pointMerah() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('tampil/point/' . $tanding->id_tanding . '/' . $merah->id_peserta); ?>',
                dataType: 'json',
                success: function(response) {
                    $('#pointMerah').empty();
                    if (response === null) {
                        $('#pointMerah').append(0);
                    } else {
                        $('#pointMerah').append(response);
                    }

                    // console.log(response)
                },
                error: function(xhr, status, error) {
                    alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                    // console.error('AJAX error:', status, error);
                }
            });
        }

        function pointBiru() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('tampil/point/' . $tanding->id_tanding . '/' . $biru->id_peserta); ?>',
                dataType: 'json',
                success: function(response) {
                    $('#pointBiru').empty();
                    if (response === null) {
                        $('#pointBiru').append(0);
                    } else {
                        $('#pointBiru').append(response);
                    }

                    // console.log(response)
                },
                error: function(xhr, status, error) {
                    alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                    // console.error('AJAX error:', status, error);
                }
            });
        }

        function cekJatuhan() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('tampil/jatuhan/' . $tanding->id_tanding); ?>',
                dataType: 'json',
                success: function(response) {
                    $('#jatuhanMerah').empty();
                    $('#jatuhanBiru').empty();
                    if (response === null) {
                        $('#jatuhanMerah').append(0);
                        $('#jatuhanBiru').append(0);
                    } else {
                        $('#jatuhanMerah').append(response.datamerah);
                        $('#jatuhanBiru').append(response.databiru);
                    }

                    // console.log(response)
                },
                error: function(xhr, status, error) {
                    alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                    // console.error('AJAX error:', status, error);
                }
            });
        }

        function babakAktif() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('tampil/cekTanding/' . $tanding->id_tanding); ?>',
                dataType: 'json',
                success: function(response) {

                    bgBabak1 = document.getElementById('babak1');
                    bgBabak2 = document.getElementById('babak2');
                    bgBabak3 = document.getElementById('babak3');

                    if (response == 1) {
                        bgBabak1.style.backgroundColor = 'green';
                        bgBabak1.style.color = 'white';
                    } else {
                        bgBabak1.style.backgroundColor = '';
                        bgBabak1.style.color = 'black';
                    }

                    if (response == 2) {
                        bgBabak2.style.backgroundColor = 'green';
                        bgBabak2.style.color = 'white';
                    } else {
                        bgBabak2.style.backgroundColor = '';
                        bgBabak2.style.color = 'black';
                    }

                    if (response == 3) {
                        bgBabak3.style.backgroundColor = 'green';
                        bgBabak3.style.color = 'white';
                    } else {
                        bgBabak3.style.backgroundColor = '';
                        bgBabak3.style.color = 'black';
                    }
                },
                error: function(xhr, status, error) {
                    // alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                    console.error('AJAX error:', status, error);
                }
            });
        }

        function cekBinaan() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('tampil/cekBinaan/' . $tanding->id_tanding); ?>',
                dataType: 'json',
                success: function(response) {

                    binaan1Merah = document.getElementById('binaan1Merah');
                    binaan2Merah = document.getElementById('binaan2Merah');
                    binaan1Biru = document.getElementById('binaan1Biru');
                    binaan2Biru = document.getElementById('binaan2Biru');

                    if (response.datamerah == 1) {
                        binaan1Merah.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        binaan2Merah.style.background = '';
                    } else if (response.datamerah == 2) {
                        binaan1Merah.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        binaan2Merah.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                    } else if (response.datamerah == 0) {
                        binaan1Merah.style.background = '';
                        binaan2Merah.style.background = '';
                    }

                    if (response.databiru == 1) {
                        binaan1Biru.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        binaan2Biru.style.background = '';
                    } else if (response.databiru == 2) {
                        binaan1Biru.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        binaan2Biru.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                    } else if (response.databiru == 0) {
                        binaan1Biru.style.background = '';
                        binaan2Biru.style.background = '';
                    }

                    // console.log(response.datamerah)
                    // console.log(response.databiru)


                },
                error: function(xhr, status, error) {
                    // alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                    console.error('AJAX error:', status, error);
                }
            });
        }

        function cekTeguran() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('tampil/cekTeguran/' . $tanding->id_tanding); ?>',
                dataType: 'json',
                success: function(response) {

                    teguran1Merah = document.getElementById('teguran1Merah');
                    teguran2Merah = document.getElementById('teguran2Merah');
                    teguran1Biru = document.getElementById('teguran1Biru');
                    teguran2Biru = document.getElementById('teguran2Biru');

                    if (response.datamerah == 1) {
                        teguran1Merah.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        teguran2Merah.style.background = '';
                    } else if (response.datamerah == 2) {
                        teguran1Merah.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        teguran2Merah.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                    } else if (response.datamerah == 0) {
                        teguran1Merah.style.background = '';
                        teguran2Merah.style.background = '';
                    }

                    if (response.databiru == 1) {
                        teguran1Biru.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        teguran2Biru.style.background = '';
                    } else if (response.databiru == 2) {
                        teguran1Biru.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        teguran2Biru.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                    } else if (response.databiru == 0) {
                        teguran1Biru.style.background = '';
                        teguran2Biru.style.background = '';
                    }

                    // console.log(response.datamerah)
                    // console.log(response.databiru)


                },
                error: function(xhr, status, error) {
                    // alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                    console.error('AJAX error:', status, error);
                }
            });
        }

        function cekPeringatan() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('tampil/cekPeringatan/' . $tanding->id_tanding); ?>',
                dataType: 'json',
                success: function(response) {

                    peringatan1Merah = document.getElementById('peringatan1Merah');
                    peringatan2Merah = document.getElementById('peringatan2Merah');
                    peringatan1Biru = document.getElementById('peringatan1Biru');
                    peringatan2Biru = document.getElementById('peringatan2Biru');

                    if (response.datamerah == 1) {
                        peringatan1Merah.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        peringatan2Merah.style.background = '';
                    } else if (response.datamerah == 2) {
                        peringatan1Merah.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        peringatan2Merah.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                    } else if (response.datamerah == 0) {
                        peringatan1Merah.style.background = '';
                        peringatan2Merah.style.background = '';
                    }

                    if (response.databiru == 1) {
                        peringatan1Biru.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        peringatan2Biru.style.background = '';
                    } else if (response.databiru == 2) {
                        peringatan1Biru.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        peringatan2Biru.style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                    } else if (response.databiru == 0) {
                        peringatan1Biru.style.background = '';
                        peringatan2Biru.style.background = '';
                    }

                },
                error: function(xhr, status, error) {
                    // alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                    console.error('AJAX error:', status, error);
                }
            });
        }

        function cekVerifikasi() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('tampil/cekVerifikasi/' . $tanding->id_tanding); ?>',
                dataType: 'json',
                success: function(response) {
                    if (response.status == 1) {
                        $("#upModal").modal('show');
                        $('#hasilVote').empty();
                        $('#jenisVerifkasi').empty();
                        $('#v-img').empty();


                        $.each(response.data, function(index, row) {
                            if (row.pilihan == 'merah') {
                                var newRow = "<button class='btn button-red btn-lg btn-block'>Pesilat Sudut Merah</button>";
                            } else if (row.pilihan == 'biru') {
                                var newRow = "<button class='btn button-blue btn-lg btn-block'>Pesilat Sudut Biru</button>";
                            } else if (row.pilihan == 'netral') {
                                var newRow = "<button class='btn button-netral btn-lg btn-block'>Pesilat Sudut NETRAL</button>";
                            }
                            $('#hasilVote').append(newRow);
                        });

                        $('#jenisVerifkasi').text('VERIFIKASI ' + response.jenis.toUpperCase());
                        if (response.jenis == 'jatuhan') {
                            $('#v-img').attr('src', '<?= base_url('assets/images/v-jatuhan.png') ?>');
                        } else {
                            $('#v-img').attr('src', '<?= base_url('assets/images/P11.png') ?>').attr('height', '250px');
                        }
                    } else {
                        $("#upModal").modal('hide');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Gagal mengDEL data. Kesalahan: ' + status + ' - ' + error);
                }
            });
        }

        function cekInputan() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('tampil/cekInputan/' . $tanding->id_tanding); ?>',
                dataType: 'json',
                success: function(response) {

                    if (response.j1MerahPukul == 1) {
                        document.getElementById('j1MerahPukul').style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        setTimeout(function() {
                            document.getElementById('j1MerahPukul').style.background = '';
                        }, 1000);
                    }
                    if (response.j2MerahPukul == 1) {
                        document.getElementById('j2MerahPukul').style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        setTimeout(function() {
                            document.getElementById('j2MerahPukul').style.background = '';
                        }, 1000);
                    }
                    if (response.j3MerahPukul == 1) {
                        document.getElementById('j3MerahPukul').style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        setTimeout(function() {
                            document.getElementById('j3MerahPukul').style.background = '';
                        }, 1000);
                    }

                    if (response.j1BiruPukul == 1) {
                        document.getElementById('j1BiruPukul').style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        setTimeout(function() {
                            document.getElementById('j1BiruPukul').style.background = '';
                        }, 1000);
                    }
                    if (response.j2BiruPukul == 1) {
                        document.getElementById('j2BiruPukul').style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        setTimeout(function() {
                            document.getElementById('j2BiruPukul').style.background = '';
                        }, 1000);
                    }
                    if (response.j3BiruPukul == 1) {
                        document.getElementById('j3BiruPukul').style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        setTimeout(function() {
                            document.getElementById('j3BiruPukul').style.background = '';
                        }, 1000);
                    }

                    // Tendangan
                    if (response.j1MerahTendang == 1) {
                        document.getElementById('j1MerahTendang').style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        setTimeout(function() {
                            document.getElementById('j1MerahTendang').style.background = '';
                        }, 1000);
                    }
                    if (response.j2MerahTendang == 1) {
                        document.getElementById('j2MerahTendang').style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        setTimeout(function() {
                            document.getElementById('j2MerahTendang').style.background = '';
                        }, 1000);
                    }
                    if (response.j3MerahTendang == 1) {
                        document.getElementById('j3MerahTendang').style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        setTimeout(function() {
                            document.getElementById('j3MerahTendang').style.background = '';
                        }, 1000);
                    }

                    if (response.j1BiruTendang == 1) {
                        document.getElementById('j1BiruTendang').style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        setTimeout(function() {
                            document.getElementById('j1BiruTendang').style.background = '';
                        }, 1000);
                    }
                    if (response.j2BiruTendang == 1) {
                        document.getElementById('j2BiruTendang').style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        setTimeout(function() {
                            document.getElementById('j2BiruTendang').style.background = '';
                        }, 1000);
                    }
                    if (response.j3BiruTendang == 1) {
                        document.getElementById('j3BiruTendang').style.background = 'linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)';
                        setTimeout(function() {
                            document.getElementById('j3BiruTendang').style.background = '';
                        }, 1000);
                    }
                },
                error: function(xhr, status, error) {
                    // alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                    console.error('AJAX error:', status, error);
                }
            });
        }
    </script>

    <script>
        let socket;

        // Elemen DOM
        const timerDisplay = document.getElementById('timer');

        // Membuka koneksi WebSocket
        function connectWebSocket() {
            socket = new WebSocket('<?= $socket ?>');

            socket.onopen = () => {
                console.log('Connected to WebSocket server');
            };

            socket.onmessage = (event) => {
                const data = JSON.parse(event.data);

                if (data.action === 'updateTimer') {
                    const minutes = data.minutes.toString().padStart(2, '0');
                    const seconds = data.seconds.toString().padStart(2, '0');
                    timerDisplay.textContent = `${minutes}:${seconds}`;
                } else if (data.action === 'resetTimer') {
                    timerDisplay.textContent = '00:00';
                } else if (data.action === 'reloadPage') {
                    window.location.href = '<?= base_url('tampil/winner/' . $tanding->id_tanding) ?>';
                }
            };

            socket.onclose = () => {
                console.log('Disconnected from WebSocket server');
            };
        }

        function sendMessage(action) {
            if (socket && socket.readyState === WebSocket.OPEN) {
                socket.send(JSON.stringify({
                    action: action
                }));
            }
        }

        connectWebSocket();
    </script>
</body>

</html>