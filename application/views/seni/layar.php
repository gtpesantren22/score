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
                                <div class="card-body" style="border: 1px solid #000000;">
                                    <div id="hasilView"></div>
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

    <script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
    <script src="<?= base_url() ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url() ?>assets/js/misc.js"></script>
    <script src="<?= base_url() ?>assets/js/settings.js"></script>
    <script src="<?= base_url() ?>assets/js/todolist.js"></script>
    <script src="<?= base_url() ?>assets/DataTables/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/iziToast/dist/js/iziToast.min.js"></script>
    <script src="<?= base_url() ?>assets/iziToast/my-notif.js"></script>

</body>

</html>

<script>
    $(document).ready(function() {
        // cekSesi()
    })
    // setInterval(mainFunction, 1000);
    // setInterval(cekSesi, 2000);

    // function mainFunction() {
    //     cekSesi()
    // };


    // function cekSesi() {
    //     $.ajax({
    //         type: 'GET',
    //         url: '<?= base_url('tampilseni1/cek/' . $tanding->id_tanding); ?>',
    //         dataType: 'json',
    //         success: function(response) {
    //             location.reload();
    //             if (response.aktif == 'Y' && response.detailtgr == 'tidak') {
    //                 $('#hasilView').load('<?= base_url("tampilseni1/load_tampilawal/" . $tanding->id_tanding) ?> #content', function(response, status, xhr) {
    //                     if (status == "error") {
    //                         var msg = "Error menampilkan awal : ";
    //                         $("#hasilView").html(msg + xhr.status + " " + xhr.statusText);
    //                     }
    //                 });
    //             } else if (response.aktif == 'Y' && response.detailtgr == 'ada' && response.status_tanding != 'selesai' && response.status_detail == 'proses' && response.tutup == 'belum') {
    //                 $('#hasilView').load('<?= base_url("tampilseni1/load_tampiprosesnilai/" . $tanding->id_tanding . '/') ?>' + response.id_detail + ' #content', function(response, status, xhr) {
    //                     if (status == "error") {
    //                         var msg = "Error tampil proses penilaian : ";
    //                         $("#hasilView").html(msg + xhr.status + " " + xhr.statusText);
    //                     }
    //                 });
    //             } else if (response.aktif == 'Y' && response.detailtgr == 'ada' && response.status_tanding != 'selesai' && response.status_detail == 'selesai' && response.tutup == 'belum') {
    //                 $('#hasilView').load('<?= base_url("tampilseni1/load_tampilrekapnilai/" . $tanding->id_tanding . '/') ?>' + response.id_detail + ' #content', function(response, status, xhr) {
    //                     if (status == "error") {
    //                         var msg = "Error tampil proses penilaian : ";
    //                         $("#hasilView").html(msg + xhr.status + " " + xhr.statusText);
    //                     }
    //                 });
    //             } else if (response.aktif == 'Y' && response.detailtgr == 'ada' && response.status_tanding == 'selesai') {
    //                 $('#hasilView').load('<?= base_url("tampilseni1/load_tampilpenentuan/" . $tanding->id_tanding . '/') ?>' + response.id_detail + ' #content', function(response, status, xhr) {
    //                     if (status == "error") {
    //                         var msg = "Error tampil proses penilaian : ";
    //                         $("#hasilView").html(msg + xhr.status + " " + xhr.statusText);
    //                     }
    //                 });
    //             } else if (response.aktif != 'Y') {
    //                 window.location.href = '<?= base_url('tampilseni1') ?>'
    //             }
    //             console.log(response)
    //         },
    //         error: function(xhr, status, error) {
    //             alert('Gagal load halaman. Kesalahan: ' + status + ' - ' + error);
    //             console.log('Gagal load halaman. Kesalahan: ' + status + ' - ' + error);
    //         }
    //     });
    // }
</script>