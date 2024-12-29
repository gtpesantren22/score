<?php $this->load->view('seni/head'); ?>
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

    .button-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        /* Optional: adds space between buttons */
    }

    .button-container form {
        margin: 0;
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
            <button class="btn btn-warning mt-2 mt-sm-0 btn-icon-text" onclick="window.location='<?= base_url('senitanding1') ?>' "><i class="mdi mdi-arrow-left"></i> Kembali</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="color: white; background-color: <?= $sudut ?>;">
                        <div class="col-md-4 mt-3">
                            <th><b style="font-size: large;"><u><?= $peserta->nama ?></u></b><br><strong><?= $peserta->kontingen ?></strong></th>
                        </div>
                        <div class="col-md-4 mt-3">
                            <center>
                                <!-- <b>FORM PENILAIAN WASIT JURI</b>
                                    <hr> -->
                                <b>Partai</b>
                                <h2 class="font-weight-bold"><?= $partai->urut ?></h2>
                                <!-- <span class="badge badge-dark"><?= 'Kelas ' . $peserta->kelas . ' - ' . $peserta->kategori ?></span>
                                <span class="badge badge-warning"><?= $peserta->jkl == 'Laki-laki' ? 'Putra' : 'Putri' ?></span><br> -->
                                <!-- <div id="babakShow"></div> -->
                            </center>
                        </div>
                        <div class="col-md-4 mt-3 text-right">
                            <b class="text-uppercase font-weight-bold"><?= $peserta->kelas . ' ' . $peserta->kategori ?> <?= $peserta->jkl == 'Laki-laki' ? 'PA' : 'PI' ?></b><br>
                            <b class="text-uppercase font-weight-bold"><?= $partai->babak ?></b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($tanding->aktif == 'Y') :
            if ($tanding->juri1 == $wasit) {
                $juri = 1;
            } else if ($tanding->juri2 == $wasit) {
                $juri = 2;
            } else if ($tanding->juri3 == $wasit) {
                $juri = 3;
            } else if ($tanding->juri4 == $wasit) {
                $juri = 4;
            } else if ($tanding->juri5 == $wasit) {
                $juri = 5;
            }

        ?>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <h1 class="font-weight-bold"><b class="text-primary">9.90</b> <b class="text-danger" id="hasilWrongAtas">0.00</b> &nbsp;&nbsp;&nbsp; <b class="text-success" id="hasilSisa1">9.90</b></h1>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <table class="table table-bordered text-center">
                                    <tr style="background-color: darkblue; color: white;">
                                        <th>Nomor Jurus</th>
                                        <th>Nama Jurus</th>
                                        <th>Jumlah Gerakan</th>
                                    </tr>
                                    <tr>
                                        <th id="no_jurus"></th>
                                        <th id="nama_jurus"></th>
                                        <th id="jumlah_jurus"></th>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-5">
                                <form class="ajax-form" id="form13">
                                    <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                    <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                    <input type="hidden" name="ket" value="foul">
                                    <input type="hidden" name="skor" value="-0.01">
                                    <input type="hidden" name="kode" value="WfWrong">
                                    <button class="btn btn-danger btn-lg btn-block submit-button" type="button" style="height: 200px;">
                                        <h1>Salah Gerakan</h1>
                                        <h4>(- 0.01)</h4>
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-2 text-center">
                                <h3 class="font-weight-bold">Juri</h3>
                                <h1 class="font-weight-bold"><?= $juri ?></h1>
                                <hr>
                                <p class="font-weight-bold">Total nilai koreksi jurus</p>
                                <button class="btn btn-outline-dark btn-lg btn-block" id="hasilSisa2">0.00</button>
                            </div>
                            <div class="col-md-5">
                                <form id="updateJurus">
                                    <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                    <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">

                                    <button class="btn btn-primary btn-lg btn-block" type="button" style="height: 200px;">
                                        <h1>Next >></h1>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-8">
                                <p class="font-weight-bold">Nilai Kemantapan / Stamina (0.01 - 0.10)</p>
                                <div class="button-container">
                                    <form id="form1" class="ajax-form">
                                        <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                        <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                        <input type="hidden" name="ket" value="point">
                                        <input type="hidden" name="skor" value="0.01">
                                        <input type="hidden" name="kode" value="WpStmina">
                                        <button class="btn btn-lg btn-dark submit-button" type="button">0.01</button>
                                    </form>
                                    <form id="form2" class="ajax-form">
                                        <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                        <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                        <input type="hidden" name="ket" value="point">
                                        <input type="hidden" name="skor" value="0.02">
                                        <input type="hidden" name="kode" value="WpStmina">
                                        <button class="btn btn-lg btn-dark submit-button" type="button">0.02</button>
                                    </form>
                                    <form id="form3" class="ajax-form">
                                        <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                        <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                        <input type="hidden" name="ket" value="point">
                                        <input type="hidden" name="skor" value="0.03">
                                        <input type="hidden" name="kode" value="WpStmina">
                                        <button class="btn btn-lg btn-dark submit-button" type="button">0.03</button>
                                    </form>
                                    <form id="form4" class="ajax-form">
                                        <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                        <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                        <input type="hidden" name="ket" value="point">
                                        <input type="hidden" name="skor" value="0.04">
                                        <input type="hidden" name="kode" value="WpStmina">
                                        <button class="btn btn-lg btn-dark submit-button" type="button">0.04</button>
                                    </form>
                                    <form id="form5" class="ajax-form">
                                        <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                        <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                        <input type="hidden" name="ket" value="point">
                                        <input type="hidden" name="skor" value="0.05">
                                        <input type="hidden" name="kode" value="WpStmina">
                                        <button class="btn btn-lg btn-dark submit-button" type="button">0.05</button>
                                    </form>
                                    <form id="form6" class="ajax-form">
                                        <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                        <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                        <input type="hidden" name="ket" value="point">
                                        <input type="hidden" name="skor" value="0.06">
                                        <input type="hidden" name="kode" value="WpStmina">
                                        <button class="btn btn-lg btn-dark submit-button" type="button">0.06</button>
                                    </form>
                                    <form id="form7" class="ajax-form">
                                        <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                        <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                        <input type="hidden" name="ket" value="point">
                                        <input type="hidden" name="skor" value="0.07">
                                        <input type="hidden" name="kode" value="WpStmina">
                                        <button class="btn btn-lg btn-dark submit-button" type="button">0.07</button>
                                    </form>
                                    <form id="form8" class="ajax-form">
                                        <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                        <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                        <input type="hidden" name="ket" value="point">
                                        <input type="hidden" name="skor" value="0.08">
                                        <input type="hidden" name="kode" value="WpStmina">
                                        <button class="btn btn-lg btn-dark submit-button" type="button">0.08</button>
                                    </form>
                                    <form id="form9" class="ajax-form">
                                        <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                        <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                        <input type="hidden" name="ket" value="point">
                                        <input type="hidden" name="skor" value="0.09">
                                        <input type="hidden" name="kode" value="WpStmina">
                                        <button class="btn btn-lg btn-dark submit-button" type="button">0.09</button>
                                    </form>
                                    <form id="form10" class="ajax-form">
                                        <input type="hidden" name="id_peserta" value="<?= $peserta->id_peserta ?>">
                                        <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                        <input type="hidden" name="ket" value="point">
                                        <input type="hidden" name="skor" value="0.10">
                                        <input type="hidden" name="kode" value="WpStmina">
                                        <button class="btn btn-lg btn-dark submit-button" type="button">0.10</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p class="font-weight-bold">-</p>
                                <button class="btn btn-outline-dark btn-lg btn-block mb-3" id="hasilStamina">0.00</button>
                                <h2 class="font-weight-bold text-right">Skor akhir &nbsp;&nbsp; <b class="text-warning" id="hasilSisa3">9.78</b></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>


    <!-- content-wrapper ends -->
    <?php $this->load->view('dewan/foot'); ?>
    <script src="<?= base_url('assets/vendors/select2/select2.min.js') ?>"></script>
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
            skorStamina();
            skorWrong();
            showJurus()
        };


        $('.submit-button').click(function() {
            var form = $(this).closest('form'); // Find the closest form
            var formData = form.serialize(); // Serialize form data
            $.ajax({
                type: 'POST',
                url: '<?= base_url('seniTanding1/addNilai'); ?>',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // alert(response);
                    if (response.status === 'success') {
                        mainFunction();
                    }
                },
                error: function(xhr, status, error) {
                    alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                    // console.error('AJAX error:', status, error);
                }
            });
        });


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
                    alert('Gagal Load skor stamina. Kesalahan: ' + status + ' - ' + error);
                }
            });
        }

        // Skor D1
        function skorStamina() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('senitanding1/getSkorStamina/' . $tanding->id_tanding . '/' . $peserta->id_peserta); ?>',
                dataType: 'json',
                success: function(response) {
                    // $('#hasilStamina').empty();

                    $('#hasilStamina').text(formatNumber(response));
                    mainFunction()
                },
                error: function(xhr, status, error) {
                    alert('Gagal Load skor stamina. Kesalahan: ' + status + ' - ' + error);
                }
            });
        }

        function skorWrong() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('senitanding1/getSkorWrong/' . $tanding->id_tanding . '/' . $peserta->id_peserta); ?>',
                dataType: 'json',
                success: function(response) {

                    var hasil_awal = 9.90 + Number(response.wrong);
                    var hasil_nilai = hasil_awal + Number(response.plus);

                    // $('#hasilWrongAtas').empty();
                    // $('#hasilSisa1').empty();
                    // $('#hasilSisa2').empty();
                    // $('#hasilSisa3').empty();

                    $('#hasilWrongAtas').text(formatNumber(response.wrong));
                    $('#hasilSisa1').text(formatNumber(hasil_awal));
                    $('#hasilSisa2').text(formatNumber(hasil_awal));
                    $('#hasilSisa3').text(formatNumber(hasil_nilai));
                },
                error: function(xhr, status, error) {
                    alert('Gagal Load skor salah gerakan. Kesalahan: ' + status + ' - ' + error);
                }
            });
        }

        function showJurus() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('senitanding1/showJurus/' . $tanding->id_tanding . '/' . $peserta->id_peserta); ?>',
                dataType: 'json',
                success: function(response) {

                    $('#no_jurus').text(response.nomor);
                    $('#nama_jurus').text(response.nama);
                    $('#jumlah_jurus').text(response.jumlah);
                },
                error: function(xhr, status, error) {
                    alert('Gagal Load jurus terpakai. Kesalahan: ' + status + ' - ' + error);
                }
            });
        }

        $('#updateJurus button').click(function() {

            var formData = $('#updateJurus').serialize();
            $.ajax({
                type: 'POST',
                url: '<?= base_url('seniTanding1/updateJurus'); ?>',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // alert(response);
                    if (response.status === 'success') {
                        showJurus();
                    } else {
                        alert('Jurus sudah selesai');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                    // console.error('AJAX error:', status, error);
                }
            });
        });


        // MERAH
        // $('#WpInput button').on('click', function() {
        //     var formData = $('#WpInput').serialize();
        //     saveData(formData);
        // });

        function formatNumber(num) {
            if (typeof num !== 'number') {
                num = parseFloat(num);
                if (isNaN(num)) {
                    throw new Error('Invalid number');
                }
            }
            return num.toFixed(2);
        }
    </script>