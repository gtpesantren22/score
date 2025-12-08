<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DWK Score</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/mdi/css/materialdesignicons.min.css">

    <style>
        .red-bg {
            background-color: #ff0000;
            color: #fff;
        }

        .blue-bg {
            background-color: #0033cc;
            color: #fff;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6 !important;
        }

        .card-title {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f8f9fa;
        }

        table tbody {
            font-weight: bold;
        }

        .btn-tall {
            height: auto;
            min-height: 50px;
            font-size: 1rem;
            padding: 0.5rem 1rem;
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

        .custom-header-full {
            background: linear-gradient(90deg, rgba(220, 53, 69, 0.9) 0%, rgba(0, 123, 255, 0.9) 100%);
            color: #fff;
            width: 100%;
            border-radius: 0;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        .header-text {
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* Jika perlu uppercase, tambahkan class tambahan di HTML */
        .header-text.uppercase {
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <header class="custom-header-full text-center py-1 shadow-sm">
        <span class="header-text uppercase"><?= $judul ?></span>
        <span class="mdi mdi-star-three-points"></span>
        <span class="header-text"><?= $deskripsi ?></span>
    </header>
    <div class="container-fluid py-2">
        <div class="row align-items-center mb-2">
            <!-- Sudut Merah -->
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="text-center p-3 red-bg rounded">
                    <h6 class="m-0">PESILAT SUDUT MERAH</h6>
                    <strong style="font-size: 1.35em;"><?= $merah->nama ?></strong><br>
                    <small><?= $merah->kontingen ?></small>
                </div>
            </div>

            <!-- Info Pertandingan -->
            <div class="col-md-4 text-center">
                <div class="border rounded p-3">
                    <p class="mb-1 fw-bold fs-6"><?= $partai->babak ?> | Partai Ke - <?= $partai->urut ?> | Gel : <?= $tanding->gel ?></p>
                    <span class="badge bg-secondary mb-2 fs-6"><?= 'Kelas ' . $merah->kelas . ' - ' . $merah->kategori ?></span>
                    <span class="badge bg-danger mb-2 fs-6"><?= $merah->jkl == 'Laki-laki' ? 'Putra' : 'Putri' ?></span>
                    <div class="btn-group w-100" role="group">
                        <div class="btn-group w-100" id="babakShow" role="group">
                            <!-- SHOW BABAK -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sudut Biru -->
            <div class="col-md-4">
                <div class="text-center p-3 blue-bg rounded">
                    <h6 class="m-0">PESILAT SUDUT BIRU</h6>
                    <strong style="font-size: 1.35em;"><?= $biru->nama ?></strong><br>
                    <small><?= $biru->kontingen ?></small>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-md-6">
                <h6 class="text-center red-bg p-1">SKOR PESILAT MERAH</h6>
                <table class="table table-bordered text-center">
                    <thead class="table-danger">
                        <tr>
                            <th>BABAK</th>
                            <th>HUKUMAN</th>
                            <th>BINAAN</th>
                            <th>JATUHAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td id="hukumanMerah1"></td>
                            <td id="binaanMerah1">0</td>
                            <td id="jatuhanMerah1"></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td id="hukumanMerah2"></td>
                            <td id="binaanMerah2">0</td>
                            <td id="jatuhanMerah2"></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td id="hukumanMerah3"></td>
                            <td id="binaanMerah3">0</td>
                            <td id="jatuhanMerah3"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <h6 class="text-center blue-bg p-1">SKOR PESILAT BIRU</h6>
                <table class="table table-bordered text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>BABAK</th>
                            <th>HUKUMAN</th>
                            <th>BINAAN</th>
                            <th>JATUHAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td id="hukumanBiru1"></td>
                            <td id="binaanBiru1">0</td>
                            <td id="jatuhanBiru1"></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td id="hukumanBiru2"></td>
                            <td id="binaanBiru2">0</td>
                            <td id="jatuhanBiru2"></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td id="hukumanBiru3"></td>
                            <td id="binaanBiru3">0</td>
                            <td id="jatuhanBiru3"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <?php if ($tanding->babak != 0) : ?>
            <div class="row mt-2">
                <!-- Kolom Kiri (Pesilat Merah) -->
                <div class="col-md-5">
                    <div class="row mb-2">
                        <div class="col-6">
                            <form id="formJatuhanMerah">
                                <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                <input type="hidden" name="id_user" value="<?= $user->id_user ?>">
                                <input type="hidden" name="id_peserta" value="<?= $partai->merah ?>">
                                <input type="hidden" name="babak" value="<?= $tanding->babak ?>">
                                <input type="hidden" name="skor" value="3">
                                <input type="hidden" name="ket" value="jatuhan">
                                <input type="hidden" name="sudut" value="merah">
                                <button type="button" class="btn btn-tall btn-danger w-100">JATUHAN</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-tall btn-secondary w-100" onclick="deletejatuhan('<?= htmlspecialchars($tanding->id_tanding) ?>','<?= htmlspecialchars($partai->merah) ?>','merah','jatuhan')">DEL JATUHAN</button>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <form id="formBinaanMerah">
                                <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                <input type="hidden" name="id_user" value="<?= $user->id_user ?>">
                                <input type="hidden" name="id_peserta" value="<?= $partai->merah ?>">
                                <input type="hidden" name="babak" value="<?= $tanding->babak ?>">
                                <input type="hidden" name="skor" value="0">
                                <input type="hidden" name="ket" value="binaan">
                                <input type="hidden" name="sudut" value="merah">
                                <button type="button" class="btn btn-tall btn-danger w-100">BINAAN</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <!-- Kosong -->
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <form id="formTeguranMerah">
                                <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                <input type="hidden" name="id_user" value="<?= $user->id_user ?>">
                                <input type="hidden" name="id_peserta" value="<?= $partai->merah ?>">
                                <input type="hidden" name="babak" value="<?= $tanding->babak ?>">
                                <input type="hidden" name="skor" value="0">
                                <input type="hidden" name="ket" value="teguran">
                                <input type="hidden" name="sudut" value="merah">
                                <button type="button" class="btn btn-tall btn-danger w-100">TEGURAN</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-tall btn-secondary w-100" onclick="deletejatuhan('<?= htmlspecialchars($tanding->id_tanding) ?>','<?= htmlspecialchars($partai->merah) ?>','merah','hukum')">DEL HUKUMAN</button>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <form id="formPeringatanMerah">
                                <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                <input type="hidden" name="id_user" value="<?= $user->id_user ?>">
                                <input type="hidden" name="id_peserta" value="<?= $partai->merah ?>">
                                <input type="hidden" name="babak" value="<?= $tanding->babak ?>">
                                <input type="hidden" name="skor" value="0">
                                <input type="hidden" name="ket" value="peringatan">
                                <input type="hidden" name="sudut" value="merah">
                                <button type="button" class="btn btn-tall btn-danger w-100">PERINGATAN</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <!-- Kosong -->
                        </div>
                    </div>
                </div>

                <!-- Kolom Tengah (Verifikasi) -->
                <div class="col-md-2 d-flex flex-column align-items-center">
                    <a href="<?= base_url('dewan/addVerf/jatuhan/' . $tanding->id_tanding) ?>" class="btn btn-tall btn-warning w-100 mb-3">VERIFIKASI JATUHAN ?</a>
                    <a href="<?= base_url('dewan/addVerf/pelanggaran/' . $tanding->id_tanding) ?>" class="btn btn-tall btn-warning w-100">VERIFIKASI PELANGGARAN ?</a>
                </div>

                <!-- Kolom Kanan (Pesilat Biru) -->
                <div class="col-md-5">
                    <div class="row mb-2">
                        <div class="col-6">
                            <button class="btn btn-tall btn-secondary w-100" onclick="deletejatuhan('<?= htmlspecialchars($tanding->id_tanding) ?>','<?= htmlspecialchars($partai->biru) ?>','biru','jatuhan')">DEL JATUHAN</button>

                        </div>
                        <div class="col-6">
                            <form id="formJatuhanBiru">
                                <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                <input type="hidden" name="id_user" value="<?= $user->id_user ?>">
                                <input type="hidden" name="id_peserta" value="<?= $partai->biru ?>">
                                <input type="hidden" name="babak" value="<?= $tanding->babak ?>">
                                <input type="hidden" name="skor" value="3">
                                <input type="hidden" name="ket" value="jatuhan">
                                <input type="hidden" name="sudut" value="biru">
                                <button type="button" class="btn btn-tall btn-primary w-100">JATUHAN</button>
                            </form>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <!-- Kosong -->
                        </div>
                        <div class="col-6">
                            <form id="formBinaanBiru">
                                <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                <input type="hidden" name="id_user" value="<?= $user->id_user ?>">
                                <input type="hidden" name="id_peserta" value="<?= $partai->biru ?>">
                                <input type="hidden" name="babak" value="<?= $tanding->babak ?>">
                                <input type="hidden" name="skor" value="0">
                                <input type="hidden" name="ket" value="binaan">
                                <input type="hidden" name="sudut" value="biru">
                                <button type="button" class="btn btn-tall btn-primary w-100">BINAAN</button>
                            </form>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <button class="btn btn-tall btn-secondary w-100" onclick="deletejatuhan('<?= htmlspecialchars($tanding->id_tanding) ?>','<?= htmlspecialchars($partai->biru) ?>','biru','hukum')">DEL HUKUMAN</button>
                        </div>
                        <div class="col-6">
                            <form id="formTeguranBiru">
                                <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                <input type="hidden" name="id_user" value="<?= $user->id_user ?>">
                                <input type="hidden" name="id_peserta" value="<?= $partai->biru ?>">
                                <input type="hidden" name="babak" value="<?= $tanding->babak ?>">
                                <input type="hidden" name="skor" value="0">
                                <input type="hidden" name="ket" value="teguran">
                                <input type="hidden" name="sudut" value="biru">
                                <button class="btn btn-tall btn-primary w-100" type="button">TEGURAN</button>
                            </form>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <!-- Kosong -->
                        </div>
                        <div class="col-6">
                            <form id="formPeringatanBiru">
                                <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                <input type="hidden" name="id_user" value="<?= $user->id_user ?>">
                                <input type="hidden" name="id_peserta" value="<?= $partai->biru ?>">
                                <input type="hidden" name="babak" value="<?= $tanding->babak ?>">
                                <input type="hidden" name="skor" value="0">
                                <input type="hidden" name="ket" value="peringatan">
                                <input type="hidden" name="sudut" value="biru">
                                <button class="btn btn-tall btn-primary w-100" type="button">PERINGATAN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>


    </div>

</body>

<script src="<?= base_url() ?>assets/js/jquery-3.7.1.min.js"></script>
<script src="<?= base_url('assets/bootstrap-5/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url() ?>assets/iziToast/dist/js/iziToast.min.js"></script>
<script src="<?= base_url() ?>assets/iziToast/my-notif.js"></script>


<!-- diapaki -->
<div class="modal fade" id="upModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Verifikasi Wasit Juri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="hasilVote"></div>
            </div>

            <div class="modal-footer">
                <form action="<?= base_url('dewan/selesaiVer') ?>" method="post">
                    <input type="hidden" id="idVr" name="id_verifikasi">
                    <button type="submit" class="btn btn-primary">Selesai</button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        mainFunction();
    });

    function mainFunction() {
        skorHukumMerah();
        skorHukumBiru();
        cekVerifikasi();
    };

    setInterval(babakAktif, 2000);
    setInterval(cekVerifikasi, 1000);

    function babakAktif() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('tampil/cekTanding/' . $tanding->id_tanding); ?>',
            dataType: 'json',
            success: function(response) {

                if (response == 1) {
                    $('#babakShow').empty();
                    $('#babakShow').append(`
                            <button class='btn fw-bold btn-primary btn-sm active'><span class='mdi mdi-loading mdi-spin'></span> BABAK 1</button>
                            <button class='btn fw-bold btn-outline-secondary btn-sm'>BABAK 2</button>
                            <button class='btn fw-bold btn-outline-secondary btn-sm'>BABAK 3</button>`);
                }

                if (response == 2) {
                    $('#babakShow').empty();
                    $('#babakShow').append(`
                    <button class='btn fw-bold btn-outline-secondary btn-sm'>BABAK 1</button>
                    <button class='btn fw-bold btn-primary btn-sm active'><span class='mdi mdi-loading mdi-spin'></span> BABAK 2</button>
                            <button class='btn fw-bold btn-outline-secondary btn-sm'>BABAK 3</button>`);
                }

                if (response == 3) {
                    $('#babakShow').empty();
                    $('#babakShow').append(`
                    <button class='btn fw-bold btn-outline-secondary btn-sm'>BABAK 1</button>
                    <button class='btn fw-bold btn-outline-secondary btn-sm'>BABAK 2</button>
                    <button class='btn fw-bold btn-primary btn-sm active'><span class='mdi mdi-loading mdi-spin'></span> BABAK 3</button>
                    `);
                }
            },
            error: function(xhr, status, error) {
                // alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                console.error('AJAX error:', status, error);
            }
        });
    }


    function skorHukumMerah() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('dewan/skorHukum/merah/' . $tanding->id_tanding); ?>',
            dataType: 'json',
            success: function(data) {
                $('#hukumanMerah1').empty();
                $('#binaanMerah1').empty();
                $('#jatuhanMerah1').empty();

                $('#hukumanMerah2').empty();
                $('#binaanMerah2').empty();
                $('#jatuhanMerah2').empty();

                $('#hukumanMerah3').empty();
                $('#binaanMerah3').empty();
                $('#jatuhanMerah3').empty();

                $.each(data.hukuman1, function(index, row) {
                    var newRow = row.skor + '&nbsp;';
                    $('#hukumanMerah1').append(newRow);
                });
                $.each(data.hukuman2, function(index, row) {
                    var newRow = row.skor + '&nbsp;';
                    $('#hukumanMerah2').append(newRow);
                });
                $.each(data.hukuman3, function(index, row) {
                    var newRow = row.skor + '&nbsp;';
                    $('#hukumanMerah3').append(newRow);
                });

                $.each(data.binaan1, function(index, row) {
                    var newRow = row.jumlah;
                    $('#binaanMerah1').append(newRow);
                });
                $.each(data.binaan2, function(index, row) {
                    var newRow = row.jumlah;
                    $('#binaanMerah2').append(newRow);
                });
                $.each(data.binaan3, function(index, row) {
                    var newRow = row.jumlah;
                    $('#binaanMerah3').append(newRow);
                });

                $.each(data.jatuhan1, function(index, row) {
                    var newRow = row.skor + '&nbsp;';
                    $('#jatuhanMerah1').append(newRow);
                });
                $.each(data.jatuhan2, function(index, row) {
                    var newRow = row.skor + '&nbsp;';
                    $('#jatuhanMerah2').append(newRow);
                });
                $.each(data.jatuhan3, function(index, row) {
                    var newRow = row.skor + '&nbsp;';
                    $('#jatuhanMerah3').append(newRow);
                });

                // console.log(data.jatuhan1)

            },
            error: function(xhr, status, error) {
                alert('Gagal memuat data awal: ' + error);
            }
        });
    }

    function skorHukumBiru() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('dewan/skorHukum/biru/' . $tanding->id_tanding); ?>',
            dataType: 'json',
            success: function(data) {
                $('#hukumanBiru1').empty();
                $('#binaanBiru1').empty();
                $('#jatuhanBiru1').empty();

                $('#hukumanBiru2').empty();
                $('#binaanBiru2').empty();
                $('#jatuhanBiru2').empty();

                $('#hukumanBiru3').empty();
                $('#binaanBiru3').empty();
                $('#jatuhanBiru3').empty();

                $.each(data.hukuman1, function(index, row) {
                    var newRow = row.skor + '&nbsp;';
                    $('#hukumanBiru1').append(newRow);
                });
                $.each(data.hukuman2, function(index, row) {
                    var newRow = row.skor + '&nbsp;';
                    $('#hukumanBiru2').append(newRow);
                });
                $.each(data.hukuman3, function(index, row) {
                    var newRow = row.skor + '&nbsp;';
                    $('#hukumanBiru3').append(newRow);
                });

                $.each(data.binaan1, function(index, row) {
                    var newRow = row.jumlah;
                    $('#binaanBiru1').append(newRow);
                });
                $.each(data.binaan2, function(index, row) {
                    var newRow = row.jumlah;
                    $('#binaanBiru2').append(newRow);
                });
                $.each(data.binaan3, function(index, row) {
                    var newRow = row.jumlah;
                    $('#binaanBiru3').append(newRow);
                });

                $.each(data.jatuhan1, function(index, row) {
                    var newRow = row.skor + '&nbsp;';
                    $('#jatuhanBiru1').append(newRow);
                });
                $.each(data.jatuhan2, function(index, row) {
                    var newRow = row.skor + '&nbsp;';
                    $('#jatuhanBiru2').append(newRow);
                });
                $.each(data.jatuhan3, function(index, row) {
                    var newRow = row.skor + '&nbsp;';
                    $('#jatuhanBiru3').append(newRow);
                });

                // console.log(data.jatuhan1)

            },
            error: function(xhr, status, error) {
                alert('Gagal memuat data awal: ' + error);
            }
        });
    }

    function saveData(formData) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('dewan/addNilai'); ?>',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // alert(response);

                if (response.status === 'success' && response.sudut == 'merah') {
                    skorHukumMerah();
                } else if (response.status === 'success' && response.sudut == 'biru') {
                    skorHukumBiru();
                }
            },
            error: function(xhr, status, error) {
                alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                // console.error('AJAX error:', status, error);
            }
        });
    }

    function deletejatuhan(idTanding, idPeserta, sudut, ket) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('dewan/delNilai'); ?>',
            data: {
                idTanding: idTanding,
                idPeserta: idPeserta,
                sudut: sudut,
                ket: ket,
            },
            dataType: 'json',
            success: function(response) {

                if (response.status === 'success' && response.sudut == 'merah') {
                    skorHukumMerah();
                } else if (response.status === 'success' && response.sudut == 'biru') {
                    skorHukumBiru();
                }
            },
            error: function(xhr, status, error) {
                alert('Gagal mengDEL data. Kesalahan: ' + status + ' - ' + error);
            }
        });
    }

    function cekVerifikasi() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('dewan/cekVerifikasi/' . $tanding->id_tanding); ?>',
            dataType: 'json',
            success: function(response) {
                if (response.status == 'benar') {
                    $("#upModal").modal('show');
                    $('#hasilVote').empty();
                    $('#idVr').val(response.idVr);

                    $.each(response.data, function(index, row) {
                        if (row.pilihan == 'merah') {
                            var newRow = "<button class='btn btn-danger btn-lg w-100 mb-1'>Pesilat Sudut Merah</button>";
                        } else if (row.pilihan == 'biru') {
                            var newRow = "<button class='btn btn-primary btn-lg w-100 mb-1'>Pesilat Sudut Biru</button>";
                        } else if (row.pilihan == 'netral') {
                            var newRow = "<button class='btn btn-warning btn-lg w-100 mb-1'>Pesilat Sudut NETRAL</button>";
                        }
                        $('#hasilVote').append(newRow);
                    });
                } else {
                    $("#upModal").modal('hide');
                }
            },
            error: function(xhr, status, error) {
                alert('Gagal mengDEL data. Kesalahan: ' + status + ' - ' + error);
            }
        });
    }

    // setInterval(mainFunction, 2000);

    // MERAH
    $('#formJatuhanMerah button').on('click', function() {
        var formData = $('#formJatuhanMerah').serialize();
        saveData(formData);
    });
    $('#formBinaanMerah button').on('click', function() {
        var formData = $('#formBinaanMerah').serialize();
        saveData(formData);
    });
    $('#formTeguranMerah button').on('click', function() {
        var formData = $('#formTeguranMerah').serialize();
        saveData(formData);
    });
    $('#formPeringatanMerah button').on('click', function() {
        var formData = $('#formPeringatanMerah').serialize();
        saveData(formData);
    });

    // BIRU
    $('#formJatuhanBiru button').on('click', function() {
        var formData = $('#formJatuhanBiru').serialize();
        saveData(formData);
    });
    $('#formBinaanBiru button').on('click', function() {
        var formData = $('#formBinaanBiru').serialize();
        saveData(formData);
    });
    $('#formTeguranBiru button').on('click', function() {
        var formData = $('#formTeguranBiru').serialize();
        saveData(formData);
    });
    $('#formPeringatanBiru button').on('click', function() {
        var formData = $('#formPeringatanBiru').serialize();
        saveData(formData);
    });
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

            if (data.action === 'reloadPage') {
                window.location.href = '<?= base_url('dewan/tanding') ?>';
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

</html>