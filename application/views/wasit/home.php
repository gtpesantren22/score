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
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_horizontal-navbar.html -->
        <div class="horizontal-menu">
            <nav class="navbar top-navbar col-lg-12 col-12 p-0">
                <div class="container">

                </div>
            </nav>

        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">

                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('ok') ?>"></div>
                <div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error') ?>"></div>

                <!-- ISI  -->
                <div class="content-wrapper d-flex align-items-center auth">
                    <div class="row flex-grow">
                        <?php
                        if ($jadwal) {
                            foreach ($jadwal as $jdwl) :
                                $juri1 = $this->db->query("SELECT * FROM wasit WHERE  id_wasit='$jdwl->juri1' ")->row();
                                $juri2 = $this->db->query("SELECT * FROM wasit WHERE  id_wasit='$jdwl->juri2' ")->row();
                                $juri3 = $this->db->query("SELECT * FROM wasit WHERE  id_wasit='$jdwl->juri3' ")->row();
                                $juri4 = $this->db->query("SELECT * FROM wasit WHERE  id_wasit='$jdwl->juri4' ")->row();
                                $juri5 = $this->db->query("SELECT * FROM wasit WHERE  id_wasit='$jdwl->juri5' ")->row();
                        ?>
                                <div class="col-lg-6 mx-auto">
                                    <div class="auth-form-light text-left p-5">
                                        <h4>Gelanggang <?= $jdwl->gel ?></h4>
                                        <h6 class="font-weight-light">Login halaman wasit pertandingan</h6>
                                        <form class="pt-3" method="post" action="<?= base_url('wasit/gogogo') ?>">
                                            <input type="hidden" name="id" value="<?= $jdwl->id_tanding ?>">
                                            <div class="form-group">
                                                <select name="id_wasit" id="" class="form-control" required>
                                                    <option value=""> -pilih wasit- </option>
                                                    <option value="<?= $juri1 ? $juri1->id_wasit : '' ?>">Juri 1 </option>
                                                    <option value="<?= $juri2 ? $juri2->id_wasit : '' ?>">Juri 2 </option>
                                                    <option value="<?= $juri3 ? $juri3->id_wasit : '' ?>">Juri 3 </option>
                                                    <!-- <option value="<?= $juri4 ? $juri4->id_wasit : '' ?>">Juri 4 ?></option> -->
                                                    <!-- <option value="<?= $juri5 ? $juri5->id_wasit : '' ?>">Juri 5 ?></option> -->
                                                </select>
                                            </div>
                                            <!-- <div class="form-group">
                                            <input type="password" name="pin" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="PIN Wasit">
                                        </div> -->
                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-semibold auth-form-btn">SIGN IN</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                        } else { ?>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 text-center">
                                <p>Tekan tombol dibawah jika tidak ada pertandingan yang muncul</p>
                                <button class="btn btn-primary" onclick="window.location='<?= base_url('wasit/' . $nomor) ?>'">REFRESH HALAMAN</button>
                            </div>
                            <div class="col-md-4"></div>
                        <?php } ?>
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

        // Membuka koneksi WebSocket
        function connectWebSocket() {
            socket = new WebSocket('<?= $socket ?>');

            socket.onopen = () => {
                console.log('Connected to WebSocket server');
            };

            socket.onmessage = (event) => {
                const data = JSON.parse(event.data);

                if (data.action === 'reloadPage') {
                    window.location.href = '<?= base_url('wasit/' . $nomor) ?>';
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