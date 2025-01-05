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
    <link rel="stylesheet" href="<?= base_url() ?>assets/DataTables/datatables.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/iziToast/dist/css/iziToast.min.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/demo_2/style.css" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.png" />

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

        .col-md-5 .colData {
            height: 170px;
            /* Ganti nilai sesuai kebutuhan */
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
                            <?php
                            $judul = $this->db->query("SELECT * FROM settings WHERE name = 'judul' ")->row();
                            echo $judul->value;
                            ?>
                            <!-- <span class="font-13 d-block font-weight"> </span> -->
                            <span class="font-12 d-block font-weight"><?php
                                                                        $desk = $this->db->query("SELECT * FROM settings WHERE name = 'deskripsi' ")->row();
                                                                        echo $desk->value;
                                                                        ?> </span>
                        </a>
                        <a class="navbar-brand brand-logo-mini" href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/images/logo-mini.svg" alt="logo" /></a>
                    </div>
                    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                        <button class="btn btn-sm btn-info" onclick="window.location='<?= base_url('senitanding1') ?>'"><span class="mdi mdi-refresh"></span> Refresh Halaman</button>
                        <button class="btn btn-sm btn-danger" onclick="window.location='<?= base_url('wasitseni/logout') ?>' "><span class="mdi mdi-logout-variant"></span> LogOut</button>
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
                                <div class="col-md-12 ">
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="">
                                                <thead>
                                                    <tr>
                                                        <th class="fs-3">Partai Ke - <?= $partai->urut ?></th>
                                                        <th><?= $partai->babak ?> - <?= $merah->kelas . ' ' . $merah->kategori ?> <?= $merah->jkl == 'Laki-laki' ? 'PA' : 'PI' ?></th>
                                                        <th><span class="badge badge-warning">Aktif : <?= $tanding->aktif ?></span> | <span class="badge badge-primary"><?= $tanding->status ?></span> | <span class="badge badge-success">Gelanggang : <?= $tanding->gel ?></span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    <tr>
                                                        <td><b class="text-primary">Pesilat Sudut Biru</b></td>
                                                        <td>
                                                            <p class="fw-bolder"><?= $biru->nama ?></p>
                                                        </td>
                                                        <td><button class="btn btn-warning btn-block" type="" onclick="window.location.href='<?= base_url('senitanding1/mulaiNilai/' . $biru->id_peserta . '/' . $tanding->id_tanding) ?>' ">Mulai Penilaian</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b class="text-danger">Pesilat Sudut Merah</b></td>
                                                        <td>
                                                            <p class="fw-bolder"><?= $merah->nama ?></p>
                                                        </td>
                                                        <td><button class="btn btn-warning btn-block" type="" onclick="window.location.href='<?= base_url('senitanding1/mulaiNilai/' . $merah->id_peserta . '/' . $tanding->id_tanding) ?>' ">Mulai Penilaian</button></td>
                                                    </tr>

                                                </tbody>
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


</body>

</html>