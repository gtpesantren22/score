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
                                                <!-- <b style="font-size: 55px;" id="timer">00:00</b> -->
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

                                    <div class="row mt-5">

                                        <div class="col-md-12 text-center">
                                            <h3 class="font-weight-bold" style="font-size: 50px;">WINNER</h3>
                                        </div>
                                        <?php if ($skorMerah > $skorBiru) { ?>
                                            <div class="col-md-9">
                                                <div class="card bg-red">
                                                    <div class="card-body text-center">
                                                        <b style="font-size: 50px; color: white;"><?= strtoupper($merah->nama) ?></b>
                                                        <hr style="background-color: white;">
                                                        <b style="font-size: 30px; color: white;"><?= strtoupper($merah->kontingen) ?></b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div class="card-body text-center">
                                                        <b>TOTAL SKOR</b><br><br>
                                                        <b style="font-size: 80px;"><?= $skorMerah ?></b>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="col-md-9">
                                                <div class="card bg-blue">
                                                    <div class="card-body text-center">
                                                        <b style="font-size: 50px; color: white;"><?= strtoupper($biru->nama) ?></b>
                                                        <hr style="background-color: white;">
                                                        <b style="font-size: 30px; color: white;"><?= strtoupper($biru->kontingen) ?></b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div class="card-body text-center">
                                                        <b>TOTAL SKOR</b><br><br>
                                                        <b style="font-size: 80px;"><?= $skorBiru ?></b>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
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
                    window.location.href = '<?= base_url('tampil/gel/' . $tanding->gel) ?>';
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