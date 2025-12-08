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
    <!-- <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.png" /> -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/DataTables/datatables.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/iziToast/dist/css/iziToast.min.css" />
</head>

<style>
    @font-face {
        font-family: 'Roboto';
        src: url('assets/fonts/Roboto-Regular.woff2') format('woff2'),
            /* Format lebih modern */
            url('assets/fonts/Roboto-Regular.woff') format('woff'),
            /* Fallback untuk browser lama */
            url('assets/fonts/Roboto-Regular.ttf') format('truetype');
        /* Fallback */
        font-weight: 400;
        /* Regular */
        font-style: normal;
    }

    body {
        font-family: 'Roboto', sans-serif;
        /* Menggunakan font dari Google Fonts */
    }
</style>

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
                        <!-- <ul class="navbar-nav mr-lg-2">
                            <li class="nav-item nav-search d-none d-lg-block">
                                <div class="input-group">
                                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                        <span class="input-group-text" id="search">
                                            <i class="mdi mdi-magnify"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="navbar-search-input" placeholder="Search" aria-label="search" aria-describedby="search" />
                                </div>
                            </li>
                        </ul> -->
                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item nav-profile dropdown">
                                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                    <div class="nav-profile-img">
                                        <!-- <img src="<?= base_url() ?>assets/images/faces/face1.jpg" alt="image" /> -->
                                    </div>
                                    <div class="nav-profile-text">
                                        <p class="text-black font-weight-semibold m-0"> <?= $user->nama ?> </p>
                                        <span class="font-13 online-color">online <i class="mdi mdi-chevron-down"></i></span>
                                    </div>
                                </a>
                                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url('login/logout') ?>">
                                        <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                                </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                            <span class="mdi mdi-menu"></span>
                        </button>
                    </div>
                </div>
            </nav>
            <nav class="bottom-navbar">
                <div class="container">
                    <ul class="nav page-navigation">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>">
                                <i class="mdi mdi-compass-outline menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                                <span class="menu-title">Master Data</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url('master/peserta') ?>">Data Peserta Tanding</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url('seni/peserta') ?>">Data Peserta Seni</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url('master/wasit') ?>">Data Wasit Juri</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url('master/user') ?>">Data User Aplikasi</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="mdi mdi-clipboard-text menu-icon"></i>
                                <span class="menu-title">Partai Pertandingan</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url('partai') ?>">Partai Tanding</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url('partaiTgr') ?>">Partai Seni Tunggal</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url('partai/winner') ?>">Winner</a>
                                    </li> -->
                                </ul>
                            </div>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('partai') ?>">
                                <i class="mdi mdi-clipboard-text menu-icon"></i>
                                <span class="menu-title">Partai Pertandingan</span>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="mdi mdi-contacts menu-icon"></i>
                                <span class="menu-title">Pertandingan</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url('tanding') ?>">Tanding</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url('tandingTgr1') ?>">Seni Tunggal</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('tanding') ?>">
                                <i class="mdi mdi-contacts menu-icon"></i>
                                <span class="menu-title">Pertandingan</span>
                            </a>
                        </li> -->

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="mdi mdi-table-large menu-icon"></i>
                                <span class="menu-title">Rekap Data</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url('winner') ?>">Rekap Pemenang</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="mdi mdi-cogs menu-icon"></i>
                                <span class="menu-title">Settings</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="nav-link d-flex">
                                <button class="btn btn-sm bg-danger text-white"> Trailing </button>
                                <div class="nav-item dropdown">

                                </div>
                                <!-- <a class="text-white" href="<?= base_url() ?>"><i class="mdi mdi-home-circle"></i></a> -->
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">

                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('ok') ?>"></div>
                <div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error') ?>"></div>

                <!-- ISI -->