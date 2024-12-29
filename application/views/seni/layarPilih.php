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
                                    <?php
                                    $imgMerah = $merah->jkl == 'Laki-laki' ? 'male.png' : 'female.png';
                                    $imgBiru = $biru->jkl == 'Laki-laki' ? 'male.png' : 'female.png';

                                    $jkl = $merah->jkl == 'Laki-laki' ? 'Putra' : 'Putri';
                                    ?>
                                    <table class="table table-borderless text-center">
                                        <tr>
                                            <th style="font-weight: bolder; font-size: xx-large; background-color: skyblue;"><?= $tanding->gel . ' - ' . $partai->urut ?></th>
                                            <th style="font-weight: bolder; font-size: xx-large; background-color: skyblue;"><?= $partai->babak . ' - ' . $jkl ?></th>
                                            <th style="font-weight: bolder; font-size: xx-large; background-color: skyblue;"><?= $merah->kelas . ' - ' . $merah->kategori ?></th>
                                        </tr>
                                    </table>
                                    <!-- <hr> -->
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1 text-center">
                                            <img src="<?= base_url('assets/images/' . $imgMerah) ?>" width="50px">
                                        </div>
                                        <div class="col-md-5">
                                            <h1 style="color: red;"><?= $merah->nama ?></h1>
                                            <h4 style="color: red;"><?= $merah->kontingen ?></h4>
                                        </div>
                                        <div class="col-md-1 text-center">
                                            <img src="<?= base_url('assets/images/' . $imgBiru) ?>" width="50px">
                                        </div>
                                        <div class="col-md-5">
                                            <h1 style="color: blue;"><?= $biru->nama ?></h1>
                                            <h4 style="color: blue;"><?= $biru->kontingen ?></h4>
                                        </div>
                                        <div class="col-md-12">
                                            <table class="table table-bordered text-center table-fixed">
                                                <tr>
                                                    <!-- <th style="background: linear-gradient(to bottom, #ba5d00d1, #fdbc4eb0)"><img src="<?= base_url('assets/images/binaan1.png') ?>"></th> -->
                                                    <th id="binaan1Merah"><img src="<?= base_url('assets/images/binaan1.png') ?>"></th>
                                                    <th id="binaan2Merah"><img src="<?= base_url('assets/images/binaan2.png') ?>"></th>
                                                    <th style="width: 1px;" rowspan="3"></th>
                                                    <th rowspan="3" class="bg-red" style="font-size: 200px; color: white; width: 300px;" id="pointMerah">0</th>
                                                    <th style="width: 1px;" rowspan="3"></th>
                                                    <th style="width: 90px;" id="babak1">BABAK 1</th>
                                                    <th style="width: 1px;" rowspan="3"></th>
                                                    <th rowspan="3" class="bg-blue" style="font-size: 200px; color: white; width: 300px;" id="pointBiru">0</th>
                                                    <th style="width: 1px;" rowspan="3"></th>
                                                    <th id="binaan1Biru"><img src="<?= base_url('assets/images/binaan1.png') ?>"></th>
                                                    <th id="binaan2Biru"><img src="<?= base_url('assets/images/binaan2.png') ?>"></th>
                                                </tr>
                                                <tr>
                                                    <th id="teguran1Merah"><img src="<?= base_url('assets/images/teguran1.png') ?>"></th>
                                                    <th id="teguran2Merah"><img src="<?= base_url('assets/images/teguran2.png') ?>"></th>
                                                    <th style="width: 90px;" id="babak2">BABAK 2</th>

                                                    <th id="teguran1Biru"><img src="<?= base_url('assets/images/teguran1.png') ?>"></th>
                                                    <th id="teguran2Biru"><img src="<?= base_url('assets/images/teguran2.png') ?>"></th>
                                                </tr>
                                                <tr>
                                                    <th id="peringatan1Merah"><img src="<?= base_url('assets/images/P11.png') ?>"></th>
                                                    <th id="peringatan2Merah"><img src="<?= base_url('assets/images/P22.png') ?>"></th>

                                                    <th style="width: 90px;" id="babak3">BABAK 3</th>

                                                    <th id="peringatan1Biru"><img src="<?= base_url('assets/images/P11.png') ?>"></th>
                                                    <th id="peringatan2Biru"><img src="<?= base_url('assets/images/P22.png') ?>"></th>
                                                </tr>
                                            </table>
                                            <br>
                                            <table class="table table-bordered text-center">
                                                <tr>
                                                    <th id="j1MerahPukul">JURI 1</th>
                                                    <th id="j2MerahPukul">JURI 2</th>
                                                    <th id="j3MerahPukul">JURI 3</th>
                                                    <th><img src="<?= base_url() ?>assets/images/pukulan.png"></th>
                                                    <th id="j1BiruPukul">JURI 1</th>
                                                    <th id="j2BiruPukul">JURI 2</th>
                                                    <th id="j3BiruPukul">JURI 3</th>
                                                </tr>
                                                <tr>
                                                    <th id="j1MerahTendang">JURI 1</th>
                                                    <th id="j2MerahTendang">JURI 2</th>
                                                    <th id="j3MerahTendang">JURI 3</th>
                                                    <th><img src="<?= base_url() ?>assets/images/tendangan.png"></th>
                                                    <th id="j1BiruTendang">JURI 1</th>
                                                    <th id="j2BiruTendang">JURI 2</th>
                                                    <th id="j3BiruTendang">JURI 3</th>
                                                </tr>
                                            </table>
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
        // setInterval(cekInputan, 500);
        // setInterval(mainFunction, 1000);

        function mainFunction() {

        };



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
    </script>
</body>

</html>