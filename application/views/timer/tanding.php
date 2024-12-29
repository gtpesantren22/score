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

        #timer {
            font-size: 7em;
            margin: 20px 0;
            font-weight: bold;
        }

        .btn-extra-large {
            font-size: 2rem;
            padding: 40px 50px;
        }

        .btn-large {
            font-size: 2rem;
            padding: 20px 30px;
        }

        .btn-reset {
            font-size: 2rem;
            padding: 20px 30px;
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
                                <div class="card-body" style="border: 1px solid #000000;">
                                    <?php
                                    $imgMerah = $merah->jkl == 'Laki-laki' ? 'male.png' : 'female.png';
                                    $imgBiru = $biru->jkl == 'Laki-laki' ? 'male.png' : 'female.png';

                                    $jkl = $merah->jkl == 'Laki-laki' ? 'PA' : 'PI';
                                    ?>
                                    <table class="table table-borderless text-center">
                                        <tr>
                                            <th colspan="5" style="font-weight: bold; font-size: large; background-color: #43536c; color: white;  padding: 10px; border: 1px solid #fff;border-radius: 30px 30px 0 0;">TANDING</th>
                                        </tr>
                                        <tr>
                                            <th style="font-weight: bolder; font-size: xx-large; background-color: #9baec4; color: white;"><img src="<?= base_url('assets/images/logoIPSI.png') ?>" alt="" srcset=""></th>
                                            <th style="font-weight: bolder; font-size: xx-large; background-color: #9baec4; color: white;">G<?= strtoupper($tanding->gel . ' - ' . $partai->urut) ?></th>
                                            <th style="font-weight: bolder; font-size: xx-large; background-color: #9baec4; color: white;"><?= strtoupper($partai->babak) ?></th>
                                            <th style="font-weight: bolder; font-size: xx-large; background-color: #9baec4; color: white;"><?= strtoupper($merah->kelas .  ' - ' . $jkl) ?></th>
                                            <th style="font-weight: bolder; font-size: xx-large; background-color: #9baec4; color: white;"><img src="<?= base_url('assets/images/logoKab.png') ?>" alt="" srcset=""></th>
                                        </tr>
                                    </table>
                                    <!-- <hr> -->
                                    <br>

                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h3 class="font-weight-bold" style="color: #eb493a;"><?= strtoupper($merah->nama) ?></h3>
                                                    <h5 class="font-weight-bold"><?= strtoupper($merah->kontingen) ?></h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <h3 class="font-weight-bold" style="color: #047df2;"><?= strtoupper($biru->nama) ?></h3>
                                                    <h5 class="font-weight-bold"><?= strtoupper($biru->kontingen) ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="text-center mt-2">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mt-4 text-center">
                                                                <h3>BABAK</h3><br>
                                                                <div class="row">
                                                                    <!-- BABAK 1 -->
                                                                    <?php if ($tanding->babak == 1) { ?>
                                                                        <div class="col-md-4">
                                                                            <button class="btn btn-info btn-large"> <span class="mdi mdi-progress-upload mdi-spin"></span> 1</button>
                                                                        </div>
                                                                    <?php } else {  ?>
                                                                        <div class="col-md-4">
                                                                            <a href="<?= base_url('timer/pindahBabak/' . $tanding->id_tanding . '/1') ?>" class="btn btn-light btn-block btn-large tbl-confirm" value="Mulai Babak ke 1">1</a>
                                                                        </div>
                                                                    <?php }  ?>
                                                                    <!-- BABAK 2 -->
                                                                    <?php if ($tanding->babak == 2) { ?>
                                                                        <div class="col-md-4">
                                                                            <button class="btn btn-info btn-large"> <span class="mdi mdi-progress-upload mdi-spin"></span> 2</button>
                                                                        </div>
                                                                    <?php } else {  ?>
                                                                        <div class="col-md-4">
                                                                            <a href="<?= base_url('timer/pindahBabak/' . $tanding->id_tanding . '/2') ?>" class="btn btn-light btn-block btn-large tbl-confirm" value="Mulai Babak ke 2">2</a>
                                                                        </div>
                                                                    <?php }  ?>
                                                                    <!-- BABAK 3 -->
                                                                    <?php if ($tanding->babak == 3) { ?>
                                                                        <div class="col-md-4">
                                                                            <button class="btn btn-info btn-large"> <span class="mdi mdi-progress-upload mdi-spin"></span> 3</button>
                                                                        </div>
                                                                    <?php } else {  ?>
                                                                        <div class="col-md-4">
                                                                            <a href="<?= base_url('timer/pindahBabak/' . $tanding->id_tanding . '/3') ?>" class="btn btn-light btn-block btn-large tbl-confirm" value="Mulai Babak ke 3">3</a>
                                                                        </div>
                                                                    <?php }  ?>
                                                                </div>
                                                                <button id="resetButton" class="btn btn-secondary mt-5 btn-reset">Reset Timer</button><br>
                                                                <small class="text-danger">Pastikan anda tidak menekan tombol reset jika pertandingan sedang berjalan!</small>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div id="timer" class="text-primary">00:00</div>
                                                                <div>
                                                                    <button id="startButton" class="btn btn-success btn-extra-large">START</button>
                                                                    <button id="stopButton" class="btn btn-danger btn-extra-large">STOP</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

    <!-- plugins:js -->
    <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
    <script src="<?= base_url() ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url() ?>assets/js/misc.js"></script>
    <script src="<?= base_url() ?>assets/iziToast/dist/js/iziToast.min.js"></script>
    <script src="<?= base_url() ?>assets/iziToast/my-notif.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->

    <script>
        let socket;

        // Elemen DOM
        const timerDisplay = document.getElementById('timer');
        const startButton = document.getElementById('startButton');
        const stopButton = document.getElementById('stopButton');
        const resetButton = document.getElementById('resetButton');

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
                    timerDisplay.textContent = '00:00'; // Reset tampilan timer
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

        startButton.addEventListener('click', () => sendMessage('startTimer'));
        stopButton.addEventListener('click', () => sendMessage('stopTimer'));
        resetButton.addEventListener('click', () => {
            sendMessage('resetTimer'); // Kirim pesan reset ke server
        });


        connectWebSocket();
    </script>
</body>

</html>