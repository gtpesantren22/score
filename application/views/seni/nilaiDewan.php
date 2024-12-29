<?php

use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Base;

$this->load->view('dewan/head'); ?>
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
            <button class="btn btn-warning mt-2 mt-sm-0 btn-icon-text" onclick="window.location='<?= base_url('dewantgr1/tanding') ?>' "><i class="mdi mdi-arrow-left"></i> Kembali</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 pt-2" style="color: white; background-color: <?= $sudut ?>;">
                            <th><b style="font-size: large;"><?= strtoupper($peserta->nama) ?></b><br><strong><?= $peserta->kontingen ?></strong></th>
                        </div>
                        <div class="col-md-4">
                            <center>
                                <!-- <b>FORM PENILAIAN WASIT JURI</b>
                                    <hr> -->
                                <b>Partai</b>
                                <h2><?= $partai->urut ?></h2>
                                <!-- <span class="badge badge-dark"><?= 'Kelas ' . $peserta->kelas . ' - ' . $peserta->kategori ?></span>
                                <span class="badge badge-warning"><?= $peserta->jkl == 'Laki-laki' ? 'Putra' : 'Putri' ?></span><br> -->
                                <!-- <div id="babakShow"></div> -->
                            </center>
                        </div>
                        <div class="col-md-4 text-right">
                            <b><?= $peserta->kelas . ' ' . $peserta->kategori ?> <?= $peserta->jkl == 'Laki-laki' ? 'PA' : 'PI' ?></b><br>
                            <b><?= $partai->babak ?></b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($tanding->aktif == 'Y' && $detail->status != 'belum') { ?>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <th><b>Penampilan melebihi toleransi waktu</b></th>
                                        <?php if ($detail->status != 'selesai') { ?>
                                            <th>
                                                <form id="formD1">
                                                    <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                                    <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                                    <input type="hidden" name="id_wasit" value="<?= $user->id_user ?>">
                                                    <input type="hidden" name="skor" value="-0.50">
                                                    <input type="hidden" name="ket" value="foul">
                                                    <input type="hidden" name="kode" value="D1">
                                                    <button type="button" class="btn btn-lg btn-block btn-danger">- 0.50</button>
                                                </form>
                                            </th>
                                            <th><button class="btn btn-lg btn-block btn-dark" onclick="delSkor('<?= $tanding->id_tanding ?>', '<?= $peserta->id_peserta ?>','D1')">Hapus</button></th>
                                        <?php } else { ?>
                                            <th colspan="2">Penilaian telah selesai</th>
                                        <?php } ?>
                                        <th><button class="btn btn-lg btn-block btn-outline-dark" id="hasilD1">0</button></th>
                                    </tr>
                                    <tr>
                                        <th><b>Penampilan keluar gelanggang 10m x 10m</b></th>
                                        <?php if ($detail->status != 'selesai') { ?>
                                            <th>
                                                <form id="formD2">
                                                    <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                                    <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                                    <input type="hidden" name="id_wasit" value="<?= $user->id_user ?>">
                                                    <input type="hidden" name="skor" value="-0.50">
                                                    <input type="hidden" name="ket" value="foul">
                                                    <input type="hidden" name="kode" value="D2">
                                                    <button type="button" class="btn btn-lg btn-block btn-danger">- 0.50</button>
                                                </form>
                                            </th>
                                            <th><button class="btn btn-lg btn-block btn-dark" onclick="delSkor('<?= $tanding->id_tanding ?>', '<?= $peserta->id_peserta ?>','D2')">Hapus</button></th>
                                        <?php } else { ?>
                                            <th colspan="2">Penilaian telah selesai</th>
                                        <?php } ?>
                                        <th><button class="btn btn-lg btn-block btn-outline-dark" id="hasilD2">0</button></th>
                                    </tr>
                                    <tr>
                                        <th><b>Menjatuhkan senjata, menyentuh lantai</b></th>
                                        <?php if ($detail->status != 'selesai') { ?>
                                            <th>
                                                <form id="formD3">
                                                    <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                                    <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                                    <input type="hidden" name="id_wasit" value="<?= $user->id_user ?>">
                                                    <input type="hidden" name="skor" value="-0.50">
                                                    <input type="hidden" name="ket" value="foul">
                                                    <input type="hidden" name="kode" value="D3">
                                                    <button type="button" class="btn btn-lg btn-block btn-danger">- 0.50</button>
                                                </form>
                                            </th>
                                            <th><button class="btn btn-lg btn-block btn-dark" onclick="delSkor('<?= $tanding->id_tanding ?>', '<?= $peserta->id_peserta ?>','D3')">Hapus</button></th>
                                        <?php } else { ?>
                                            <th colspan="2">Penilaian telah selesai</th>
                                        <?php } ?>
                                        <th><button class="btn btn-lg btn-block btn-outline-dark" id="hasilD3">0</button></th>
                                    </tr>
                                    <tr>
                                        <th><b>Pakaian tidak sesuai aturan</b></th>
                                        <?php if ($detail->status != 'selesai') { ?>
                                            <th>
                                                <form id="formD4">
                                                    <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                                    <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                                    <input type="hidden" name="id_wasit" value="<?= $user->id_user ?>">
                                                    <input type="hidden" name="skor" value="-0.50">
                                                    <input type="hidden" name="ket" value="foul">
                                                    <input type="hidden" name="kode" value="D4">
                                                    <button type="button" class="btn btn-lg btn-block btn-danger">- 0.50</button>
                                                </form>
                                            </th>
                                            <th><button class="btn btn-lg btn-block btn-dark" onclick="delSkor('<?= $tanding->id_tanding ?>', '<?= $peserta->id_peserta ?>','D4')">Hapus</button></th>
                                        <?php } else { ?>
                                            <th colspan="2">Penilaian telah selesai</th>
                                        <?php } ?>
                                        <th><button class="btn btn-lg btn-block btn-outline-dark" id="hasilD4">0</button></th>
                                    </tr>
                                    <tr>
                                        <th><b>Atlet berhenti gerak selama 5 detik</b></th>
                                        <?php if ($detail->status != 'selesai') { ?>
                                            <th>
                                                <form id="formD5">
                                                    <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                                    <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                                    <input type="hidden" name="id_wasit" value="<?= $user->id_user ?>">
                                                    <input type="hidden" name="skor" value="-0.50">
                                                    <input type="hidden" name="ket" value="foul">
                                                    <input type="hidden" name="kode" value="D5">
                                                    <button type="button" class="btn btn-lg btn-block btn-danger">- 0.50</button>
                                                </form>
                                            </th>
                                            <th><button class="btn btn-lg btn-block btn-dark" onclick="delSkor('<?= $tanding->id_tanding ?>', '<?= $peserta->id_peserta ?>','D5')">Hapus</button></th>
                                        <?php } else { ?>
                                            <th colspan="2">Penilaian telah selesai</th>
                                        <?php } ?>
                                        <th><button class="btn btn-lg btn-block btn-outline-dark" id="hasilD5">0</button></th>
                                    </tr>
                                    <tr>
                                        <?php if ($detail->status != 'selesai') { ?>
                                            <th>
                                                <form action="<?= base_url('dewantgr1/proses_rekap') ?>" method="post" id="form-selesai">
                                                    <!-- <button class="btn btn-lg btn-primary" id="btnStartPerfom" onclick="">Mulai Perform</button>
                                                    <button class="btn btn-lg btn-danger">Diskualifikasi</button> -->
                                                    <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                                    <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                                    <input type="hidden" name="timer" id="timer">
                                                    <button class="btn btn-lg btn-dark" type="submit">Selesai</button>
                                                </form>
                                            </th>
                                        <?php } else { ?>
                                            <th></th>
                                        <?php } ?>
                                        <th colspan="2"><b>TOTAL POINTS</b></th>
                                        <th><button class="btn btn-lg btn-block btn-outline-dark" id="hasilAll">0</button>
                                        </th>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-12">
                                <?php if ($detail->status == 'selesai') : ?>
                                    <hr>
                                    <h3>Skor Akhir</h3>
                                    <div id="rekapHasil" class="mb-3"></div>
                                    <form action="<?= base_url('dewantgr1/tutupSesiPenilaian') ?>" method="post">
                                        <input type="hidden" name="id_peserta" value="<?= $detail->id_peserta ?>">
                                        <input type="hidden" name="id_tanding" value="<?= $detail->id_tanding ?>">
                                        <button type="submit" class="btn btn-lg btn-danger" id="tutup-sesi">Tutup sesi penilaian</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="<?= base_url('dewanTgr1/mulaiProsesPenilaian') ?>" method="post">
                                    <input type="hidden" name="id_peserta" value="<?= $detail->id_peserta ?>">
                                    <input type="hidden" name="id_tanding" value="<?= $detail->id_tanding ?>">
                                    <button type="submit" id="mulai-proses" class="btn btn-warning btn-lg">Mulai Proses Penilaian</button>
                                </form>
                                <?php if ($this->session->flashdata('error')) {
                                    echo '<b>' . $this->session->flashdata('error') . '<b>';
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- content-wrapper ends -->
    <?php $this->load->view('dewan/foot'); ?>
    <script src="<?= base_url('assets/js/timer.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/select2/select2.min.js') ?>"></script>
    <script src="<?= base_url() ?>assets/iziToast/dist/js/iziToast.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
            $(".slect2").select2({
                theme: "bootstrap"
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            mainFunction();

        });

        function mainFunction() {
            skorD1();
            skorD2();
            skorD3();
            skorD4();
            skorD5();
            totalScore();
            rekapHasil();
        };

        // setInterval(babakAktif, 2000);
        // setInterval(cekVerifikasi, 1000);

        function saveData(formData) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('dewanTgr1/addNilai'); ?>',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // alert(response.status);
                    if (response.status === 'success') {
                        mainFunction();
                    }
                },
                error: function(xhr, status, error) {
                    alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                    // console.error('AJAX error:', status, error);
                }
            });
        }

        function delSkor(id_tanding, id_peserta, kode) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('dewanTgr1/delNilai'); ?>',
                data: {
                    id_tanding: id_tanding,
                    id_peserta: id_peserta,
                    kode: kode,
                },
                dataType: 'json',
                success: function(response) {
                    // alert(response)
                    if (response.status === 'success') {
                        mainFunction();
                    } else {
                        mainFunction();
                        alert('Hapus nilai Gagal')
                    }
                },
                error: function(xhr, status, error) {
                    alert('Gagal mengDEL data. Kesalahan: ' + status + ' - ' + error);
                }
            });
        }

        function totalScore() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('dewanTgr1/getSkorAll/' . $tanding->id_tanding . '/' . $peserta->id_peserta); ?>',
                dataType: 'json',
                success: function(response) {
                    $('#hasilAll').empty();

                    $('#hasilAll').text(formatNumber(response));
                },
                error: function(xhr, status, error) {
                    alert('Gagal mengDEL data. Kesalahan: ' + status + ' - ' + error);
                }
            });
        }

        // Skor D1
        function skorD1() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('dewanTgr1/getSkor/D1/' . $tanding->id_tanding . '/' . $peserta->id_peserta); ?>',
                dataType: 'json',
                success: function(response) {
                    $('#hasilD1').empty();

                    $('#hasilD1').text(formatNumber(response));
                },
                error: function(xhr, status, error) {
                    alert('Gagal mengDEL data. Kesalahan: ' + status + ' - ' + error);
                }
            });
        }
        // Skor D2
        function skorD2() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('dewanTgr1/getSkor/D2/' . $tanding->id_tanding . '/' . $peserta->id_peserta); ?>',
                dataType: 'json',
                success: function(response) {
                    $('#hasilD2').empty();

                    $('#hasilD2').text(formatNumber(response));
                },
                error: function(xhr, status, error) {
                    alert('Gagal mengDEL data. Kesalahan: ' + status + ' - ' + error);
                }
            });
        }
        // Skor D3
        function skorD3() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('dewanTgr1/getSkor/D3/' . $tanding->id_tanding . '/' . $peserta->id_peserta); ?>',
                dataType: 'json',
                success: function(response) {
                    $('#hasilD3').empty();

                    $('#hasilD3').text(formatNumber(response));
                },
                error: function(xhr, status, error) {
                    alert('Gagal mengDEL data. Kesalahan: ' + status + ' - ' + error);
                }
            });
        }
        // Skor D4
        function skorD4() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('dewanTgr1/getSkor/D4/' . $tanding->id_tanding . '/' . $peserta->id_peserta); ?>',
                dataType: 'json',
                success: function(response) {
                    $('#hasilD4').empty();

                    $('#hasilD4').text(formatNumber(response));
                },
                error: function(xhr, status, error) {
                    alert('Gagal mengDEL data. Kesalahan: ' + status + ' - ' + error);
                }
            });
        }
        // Skor D5
        function skorD5() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('dewanTgr1/getSkor/D5/' . $tanding->id_tanding . '/' . $peserta->id_peserta); ?>',
                dataType: 'json',
                success: function(response) {
                    $('#hasilD5').empty();

                    $('#hasilD5').text(formatNumber(response));
                },
                error: function(xhr, status, error) {
                    alert('Gagal mengDEL data. Kesalahan: ' + status + ' - ' + error);
                }
            });
        }

        function rekapHasil() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('dewanTgr1/cekRekap/' . $tanding->id_tanding . '/' . $peserta->id_peserta); ?>',
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'selesai') {
                        $('#rekapHasil').load('<?= base_url("dewanTgr1/tampilRekap/" . $tanding->id_tanding . '/' . $peserta->id_peserta) ?> #content', function(response, status, xhr) {
                            if (status == "error") {
                                var msg = "Sorry but there was an error: ";
                                $("#rekapHasil").html(msg + xhr.status + " " + xhr.statusText);
                            }
                        });
                    } else {
                        console.log('Status belum berhasil')
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Gagal menampilkan hasil. Kesalahan: ' + status + ' - ' + error);
                }
            });
        }

        // MERAH
        $('#formD1 button').on('click', function() {
            var formData = $('#formD1').serialize();
            saveData(formData);
        });
        $('#formD2 button').on('click', function() {
            var formData = $('#formD2').serialize();
            saveData(formData);
        });
        $('#formD3 button').on('click', function() {
            var formData = $('#formD3').serialize();
            saveData(formData);
        });
        $('#formD4 button').on('click', function() {
            var formData = $('#formD4').serialize();
            saveData(formData);
        });
        $('#formD5 button').on('click', function() {
            var formData = $('#formD5').serialize();
            saveData(formData);
        });

        function formatNumber(num) {
            if (typeof num !== 'number') {
                num = parseFloat(num);
                if (isNaN(num)) {
                    throw new Error('Invalid number');
                }
            }
            return num.toFixed(2);
        }

        $('#form-selesai').on('submit', function(e) {
            e.preventDefault();
            const userConfirmed = confirm("Apakah Anda yakin akan menyelesaikan ini?");
            var formData = $(this).serialize();
            var actionUrl = $(this).attr('action');

            if (userConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: actionUrl,
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'ok') {
                            reloadPage()
                            window.location.reload()
                        } else {
                            console.log('Error Stop Perform')
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Gagal Form Selesai. Kesalahan: ' + status + ' - ' + error);
                    }
                });
            } else {
                console.log('User tidak mengkonfirmasi')
            }
        })

        $('#tutup-sesi').on('click', function() {
            reloadPage()
        })
        $('#mulai-proses').on('click', function() {
            reloadPage()
        })

        function reloadPage() {
            let socket;

            // Membuka koneksi WebSocket
            function connectWebSocket() {
                socket = new WebSocket('<?= $socket ?>');

                socket.onopen = () => {
                    sendMessage('reloadPage');
                    console.log('Connected to WebSocket server');
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
                    timerDisplay.value = `${minutes}:${seconds}`;
                } else if (data.action === 'resetTimer') {
                    timerDisplay.value = '00:00';
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