<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skor Pencak Silat</title>
    <link href="<?= base_url('assets/bootstrap-5/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <style>
        body {
            background: #fff;
            font-family: "Segoe UI", sans-serif;
            font-size: 15px;
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

        .corner-red {
            background: #dc3545;
            color: white;
            padding: 8px;
            text-align: center;
            font-weight: bold;
        }

        .corner-blue {
            background: #007bff;
            color: white;
            padding: 8px;
            text-align: center;
            font-weight: bold;
        }

        .fighter-box {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            min-height: 70px;
        }

        .fighter-name {
            font-size: 18px;
            font-weight: bold;
        }

        .badge-class {
            font-size: 13px;
            margin-right: 5px;
            background-color: #343a40;
        }

        .badge-gender {
            font-size: 13px;
            background-color: #ff6b6b;
            color: white;
        }

        .score-table th,
        .score-table td {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #ccc !important;
        }

        .score-table {
            width: 100%;
            margin-bottom: 0;
            border-collapse: collapse !important;
        }

        /* Tombol */
        .btn-action {
            color: white;
            font-weight: bold;
            font-size: 20px;
            border: none;
            border-radius: 12px;
            transition: all 0.2s ease-in-out;
        }

        .btn-action i {
            margin-right: 8px;
            font-size: 22px;
        }

        .btn-red {
            background: #dc3545;
        }

        .btn-blue {
            background: #007bff;
        }

        .btn-del {
            background: #6c757d;
            color: white;
        }

        .btn-action:hover {
            opacity: 0.9;
            transform: scale(1.04);
        }

        .control-panel-kiri {
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-gap: 10px;
            align-items: stretch;
        }

        .control-panel-kanan {
            display: grid;
            grid-template-columns: 1fr 2fr;
            grid-gap: 10px;
            align-items: stretch;
        }

        .left-controls {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-tall {
            height: 100%;
            font-size: 22px;
            line-height: 1.4;
        }

        .btn-big {
            padding: 25px 10px;
        }

        .middle-label {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #555;
        }

        .score-table thead.thead-red th {
            background-color: #dc3545 !important;
            color: #ffffff !important;
            border-color: #c82333 !important;
            /* border header senada */
        }

        .score-table thead.thead-blue th {
            background-color: #007bff !important;
            color: #ffffff !important;
            border-color: #0056b3 !important;
        }

        @media (max-width: 992px) {
            .fighter-name {
                font-size: 16px;
            }

            .btn-action {
                font-size: 16px;
                padding: 18px 10px;
            }
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
    <!-- Header -->
    <header class="custom-header-full text-center py-2 shadow-sm">
        <span class="header-text uppercase"><?= $judul ?></span>
        <span class="mdi mdi-star-three-points-outline"></span>
        <span class="header-text"><?= $deskripsi ?></span>
    </header>

    <div class="container-fluid mt-2 mb-2">
        <!-- Header -->
        <div class="row">
            <div class="col-md-4">
                <div class="corner-red">PESILAT SUDUT MERAH</div>
                <div class="fighter-box">
                    <div class="fighter-name"><a href="#" class="text-decoration-none text-dark"><?= $merah->nama ?></a></div>
                    <div><?= $merah->kontingen ?></div>
                </div>
            </div>

            <div class="col-md-4 text-center d-flex flex-column justify-content-center">
                <div><strong>Wasit :</strong> <?= $wasit->nama ?></div>
                <div class="mt-2"><?= $partai->babak ?> | Partai Ke - <?= $partai->urut ?> | Gel : <?= $tanding->gel ?></div>
                <div class="mt-2">
                    <span class="badge badge-class"><?= 'Kelas ' . $merah->kelas . ' - ' . $merah->kategori ?></span>
                    <span class="badge badge-gender"><?= $merah->jkl == 'Laki-laki' ? 'Putra' : 'Putri' ?></span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="corner-blue">PESILAT SUDUT BIRU</div>
                <div class="fighter-box">
                    <div class="fighter-name"><a href="#" class="text-decoration-none text-dark"><?= $biru->nama ?></a></div>
                    <div><?= $biru->kontingen ?></div>
                </div>
            </div>
        </div>

        <!-- Skor -->
        <div class="row mt-2">
            <div class="col-md-5">
                <table class="table table-sm score-table">
                    <thead class="thead-red">
                        <tr>
                            <th>BABAK</th>
                            <th>SKOR PESILAT SUDUT MERAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td style="font-size: medium; font-weight: bold; color: #dc3545;" id="hasilMerah1"></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td style="font-size: medium; font-weight: bold; color: #dc3545;" id="hasilMerah2"></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td style="font-size: medium; font-weight: bold; color: #dc3545;" id="hasilMerah3"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-2 text-center" id="babakShow">
                <button class="btn btn-outline-primary btn-sm mt-1 mb-1 w-100 fw-bold">BABAK 1</button>
                <button class="btn btn-outline-secondary btn-sm mb-1 w-100 fw-bold">BABAK 2</button>
                <button class="btn btn-outline-secondary btn-sm mb-1 w-100 fw-bold">BABAK 3</button>
            </div>

            <div class="col-md-5">
                <table class="table table-sm score-table">
                    <thead class="thead-blue">
                        <tr>
                            <th>BABAK</th>
                            <th>SKOR PESILAT SUDUT BIRU</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td td style="font-size: medium; font-weight: bold; color: #007bff;" id="hasilBiru1"></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td style="font-size: medium; font-weight: bold; color: #007bff;" id="hasilBiru2"></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td style="font-size: medium; font-weight: bold; color: #007bff;" id="hasilBiru3"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tombol -->
        <?php if ($tanding->babak != 0) : ?>
            <div class="row mt-2">
                <!-- Merah -->
                <div class="col-md-5">
                    <div class="control-panel-kiri">
                        <div class="left-controls">
                            <form id="pukulMerah" style="display: contents;">
                                <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                <input type="hidden" name="id_wasit" value="<?= $wasit->id_wasit ?>">
                                <input type="hidden" name="id_peserta" value="<?= $partai->merah ?>">
                                <!-- <input type="hidden" name="babak" value="<?= $tanding->babak ?>"> -->
                                <input type="hidden" name="skor" value="1">
                                <input type="hidden" name="ket" value="Pukulan">
                                <button type="button" class="btn-action btn-red btn-big"><i class="mdi mdi-boxing-glove"></i> Pukulan</button>
                            </form>
                            <form id="tendangMerah" style="display: contents;">
                                <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                <input type="hidden" name="id_wasit" value="<?= $wasit->id_wasit ?>">
                                <input type="hidden" name="id_peserta" value="<?= $partai->merah ?>">
                                <!-- <input type="hidden" name="babak" value="<?= $tanding->babak ?>"> -->
                                <input type="hidden" name="skor" value="2">
                                <input type="hidden" name="ket" value="Tendangan">
                                <button type="button" class="btn-action btn-red btn-big"><i class="mdi mdi-karate"></i> Tendangan</button>
                            </form>
                        </div>
                        <button class="btn-action btn-del btn-tall" onclick="deleteData('<?= $tanding->id_tanding ?>','<?= $wasit->id_wasit ?>','<?= $partai->merah ?>')">DEL<br>SCORE</button>
                    </div>
                </div>

                <!-- Tengah -->
                <div class="col-md-2 middle-label">
                    Default
                </div>

                <!-- Biru -->
                <div class="col-md-5">
                    <div class="control-panel-kanan">
                        <!-- Tombol del score kiri -->
                        <button class="btn-action btn-del btn-tall" onclick="deleteData('<?= $tanding->id_tanding ?>','<?= $wasit->id_wasit ?>','<?= $partai->biru ?>')">DEL<br>SCORE</button>

                        <!-- Tombol biru kanan -->
                        <div class="left-controls">
                            <form id="pukulBiru" style="display: contents;">
                                <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                <input type="hidden" name="id_wasit" value="<?= $wasit->id_wasit ?>">
                                <input type="hidden" name="id_peserta" value="<?= $partai->biru ?>">
                                <!-- <input type="hidden" name="babak" value="<?= $tanding->babak ?>"> -->
                                <input type="hidden" name="skor" value="1">
                                <input type="hidden" name="ket" value="Pukulan">
                                <button type="button" class="btn-action btn-blue btn-big"><i class="mdi mdi-boxing-glove"></i> Pukulan</button>
                            </form>
                            <form id="tendangBiru" style="display: contents;">
                                <input type="hidden" name="id_tanding" value="<?= $tanding->id_tanding ?>">
                                <input type="hidden" name="id_wasit" value="<?= $wasit->id_wasit ?>">
                                <input type="hidden" name="id_peserta" value="<?= $partai->biru ?>">
                                <!-- <input type="hidden" name="babak" value="<?= $tanding->babak ?>"> -->
                                <input type="hidden" name="skor" value="2">
                                <input type="hidden" name="ket" value="Tendangan">
                                <button type="button" class="btn-action btn-blue btn-big"><i class="mdi mdi-karate"></i> Tendangan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="modal fade" id="upModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Verifikasi Wasit Juri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <label for="">Pilih Vote Pesilat</label><br> -->
                    <div class="text-center mb-3">
                        <h4 id="jenisVerifkasi"></h4>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <form action="<?= base_url('wasittanding/addVerf') ?>" method="post">
                                <input type="hidden" id="idVr" name="id_verifikasi">
                                <input type="hidden" name="id_wasit" value="<?= $wasit->id_wasit ?>">
                                <input type="hidden" name="pilihan" value="merah">
                                <button type="submit" class='btn btn-danger btn-lg w-100'>Pesilat Sudut Merah</button>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form action="<?= base_url('wasittanding/addVerf') ?>" method="post">
                                <input type="hidden" id="idVr2" name="id_verifikasi">
                                <input type="hidden" name="id_wasit" value="<?= $wasit->id_wasit ?>">
                                <input type="hidden" name="pilihan" value="netral">
                                <button type="submit" style="background-color: yellow; border: 1px solid #000000;" class='btn btn-lg w-100'>Pesilat Sudut Netral</button>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form action="<?= base_url('wasittanding/addVerf') ?>" method="post">
                                <input type="hidden" id="idVr3" name="id_verifikasi">
                                <input type="hidden" name="id_wasit" value="<?= $wasit->id_wasit ?>">
                                <input type="hidden" name="pilihan" value="biru">
                                <button type="submit" class='btn btn-primary btn-lg w-100'>Pesilat Sudut &nbsp;&nbsp;&nbsp;&nbsp;Biru</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

<script src="<?= base_url() ?>assets/js/jquery-3.7.1.min.js"></script>
<script src="<?= base_url('assets/bootstrap-5/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url() ?>assets/iziToast/dist/js/iziToast.min.js"></script>
<script src="<?= base_url() ?>assets/iziToast/my-notif.js"></script>

<script>
    function mainLoad() {
        hasilMerah1();
        hasilMerah2();
        hasilMerah3();
        hasilBiru1();
        hasilBiru2();
        hasilBiru3();
        cekVerifikasi();
    }

    setInterval(mainLoad, 1000);
    setInterval(babakAktif, 2000);

    setInterval(function() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('wasittanding/cekSesi/' . $wasit->id_wasit); ?>',
            dataType: 'json',
            success: function(response) {
                if (response == 'N') {
                    window.location = '<?= base_url('wasit/logout') ?>';
                }
            },
            error: function(xhr, status, error) {
                alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                // console.error('AJAX error:', status, error);
            }
        });
    }, 15000);

    $(document).ready(function() {
        mainLoad();
    });

    function saveData(formData) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('wasittanding/addNilai'); ?>',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // alert(response);

                if (response.status === 'success') {
                    // callback(response.new_data);
                    mainLoad();

                    setTimeout(function() {
                        updateStatusNilai(response.id_nilai);
                    }, 2000);
                }
            },
            error: function(xhr, status, error) {
                console.log('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                // console.error('AJAX error:', status, error);
            }
        });
    }

    function saveData2(formData) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('wasittanding/addNilai'); ?>',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // alert(response);

                if (response.status === 'success') {
                    // callback(response.new_data2);
                    mainLoad();
                    setTimeout(function() {
                        updateStatusNilai(response.id_nilai);
                    }, 2000);
                }
            },
            error: function(xhr, status, error) {
                console.log('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                // console.error('AJAX error:', status, error);
            }
        });
    }

    function updateStatusNilai(id_nilai) {
        $.ajax({
            url: '<?= base_url('wasittanding/updateNilai') ?>',
            method: 'POST',
            data: {
                id_nilai: id_nilai
            },
            success: function(response) {
                // console.log('Response dari server:', response);
                // updateTable(response.new_data);
                // updateTableBiru(response.new_data2);
                mainLoad();
            },
            error: function(error) {
                console.error('Gagal memperbarui data di server:', error);
            }
        });
    }

    function hasilMerah1() {

        $.ajax({
            type: 'GET',
            url: '<?= base_url('wasittanding/skorPakai/merah/' . $tanding->id_tanding . '/' . $wasit->id_wasit . '/' . '1'); ?>',
            dataType: 'json',
            success: function(newData) {
                // Hapus semua baris dari tabel
                $('#hasilMerah1').empty();

                var countRows = 0;
                // Tambahkan baris baru ke tabel
                $.each(newData, function(index, row) {
                    var newRow = '';
                    if (row.status === 'gagal') {
                        newRow = '<strike>' + row.skor + '</strike>' + '&nbsp;'
                    } else if (row.status === 'pakai') {
                        newRow = '<u style="background-color: greenyellow;">' + row.skor + '</u>' + '&nbsp;';
                    } else {
                        newRow = row.skor + '&nbsp;';
                    }
                    $('#hasilMerah1').append(newRow);
                    countRows++;
                    if (countRows % 25 === 0) {
                        $('#hasilMerah1').append('<br>');
                    }
                });
            },
            error: function(xhr, status, error) {
                alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                // console.error('AJAX error:', status, error);
            }
        });
    }

    function hasilBiru1() {

        $.ajax({
            type: 'GET',
            url: '<?= base_url('wasittanding/skorPakai/biru/' . $tanding->id_tanding . '/' . $wasit->id_wasit . '/' . '1'); ?>',
            dataType: 'json',
            success: function(newData) {
                // Hapus semua baris dari tabel
                $('#hasilBiru1').empty();

                var countRows = 0;
                // Tambahkan baris baru ke tabel
                $.each(newData, function(index, row) {
                    var newRow = '';
                    if (row.status === 'gagal') {
                        newRow = '<strike>' + row.skor + '</strike>' + '&nbsp;'
                    } else if (row.status === 'pakai') {
                        newRow = '<u style="background-color: greenyellow;">' + row.skor + '</u>' + '&nbsp;';
                    } else {
                        newRow = row.skor + '&nbsp;';
                    }
                    $('#hasilBiru1').append(newRow);
                    countRows++;
                    if (countRows % 25 === 0) {
                        $('#hasilBiru1').append('<br>');
                    }
                });
            },
            error: function(xhr, status, error) {
                alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                // console.error('AJAX error:', status, error);
            }
        });
    }

    function hasilMerah2() {

        $.ajax({
            type: 'GET',
            url: '<?= base_url('wasittanding/skorPakai/merah/' . $tanding->id_tanding . '/' . $wasit->id_wasit . '/' . '2'); ?>',
            dataType: 'json',
            success: function(newData) {
                // Hapus semua baris dari tabel
                $('#hasilMerah2').empty();

                var countRows = 0;
                // Tambahkan baris baru ke tabel
                $.each(newData, function(index, row) {
                    var newRow = '';
                    if (row.status === 'gagal') {
                        newRow = '<strike>' + row.skor + '</strike>' + '&nbsp;'
                    } else if (row.status === 'pakai') {
                        newRow = '<u style="background-color: greenyellow;">' + row.skor + '</u>' + '&nbsp;';
                    } else {
                        newRow = row.skor + '&nbsp;';
                    }
                    $('#hasilMerah2').append(newRow);
                    countRows++;
                    if (countRows % 25 === 0) {
                        $('#hasilMerah2').append('<br>');
                    }
                });
            },
            error: function(xhr, status, error) {
                alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                // console.error('AJAX error:', status, error);
            }
        });
    }

    function hasilBiru2() {

        $.ajax({
            type: 'GET',
            url: '<?= base_url('wasittanding/skorPakai/biru/' . $tanding->id_tanding . '/' . $wasit->id_wasit . '/' . '2'); ?>',
            dataType: 'json',
            success: function(newData) {
                // Hapus semua baris dari tabel
                $('#hasilBiru2').empty();

                var countRows = 0;
                // Tambahkan baris baru ke tabel
                $.each(newData, function(index, row) {
                    var newRow = '';
                    if (row.status === 'gagal') {
                        newRow = '<strike>' + row.skor + '</strike>' + '&nbsp;'
                    } else if (row.status === 'pakai') {
                        newRow = '<u style="background-color: greenyellow;">' + row.skor + '</u>' + '&nbsp;';
                    } else {
                        newRow = row.skor + '&nbsp;';
                    }
                    $('#hasilBiru2').append(newRow);
                    countRows++;
                    if (countRows % 25 === 0) {
                        $('#hasilBiru2').append('<br>');
                    }
                });
            },
            error: function(xhr, status, error) {
                alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                // console.error('AJAX error:', status, error);
            }
        });
    }

    function hasilMerah3() {

        $.ajax({
            type: 'GET',
            url: '<?= base_url('wasittanding/skorPakai/merah/' . $tanding->id_tanding . '/' . $wasit->id_wasit . '/' . '3'); ?>',
            dataType: 'json',
            success: function(newData) {
                // Hapus semua baris dari tabel
                $('#hasilMerah3').empty();

                var countRows = 0;
                // Tambahkan baris baru ke tabel
                $.each(newData, function(index, row) {
                    var newRow = '';
                    if (row.status === 'gagal') {
                        newRow = '<strike>' + row.skor + '</strike>' + '&nbsp;'
                    } else if (row.status === 'pakai') {
                        newRow = '<u style="background-color: greenyellow;">' + row.skor + '</u>' + '&nbsp;';
                    } else {
                        newRow = row.skor + '&nbsp;';
                    }
                    $('#hasilMerah3').append(newRow);
                    countRows++;
                    if (countRows % 25 === 0) {
                        $('#hasilMerah3').append('<br>');
                    }
                });
            },
            error: function(xhr, status, error) {
                alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                // console.error('AJAX error:', status, error);
            }
        });
    }

    function hasilBiru3() {

        $.ajax({
            type: 'GET',
            url: '<?= base_url('wasittanding/skorPakai/biru/' . $tanding->id_tanding . '/' . $wasit->id_wasit . '/' . '3'); ?>',
            dataType: 'json',
            success: function(newData) {
                // Hapus semua baris dari tabel
                $('#hasilBiru3').empty();

                var countRows = 0;
                // Tambahkan baris baru ke tabel
                $.each(newData, function(index, row) {
                    var newRow = '';
                    if (row.status === 'gagal') {
                        newRow = '<strike>' + row.skor + '</strike>' + '&nbsp;'
                    } else if (row.status === 'pakai') {
                        newRow = '<u style="background-color: greenyellow;">' + row.skor + '</u>' + '&nbsp;';
                    } else {
                        newRow = row.skor + '&nbsp;';
                    }
                    $('#hasilBiru3').append(newRow);
                    countRows++;
                    if (countRows % 25 === 0) {
                        $('#hasilBiru3').append('<br>');
                    }
                });
            },
            error: function(xhr, status, error) {
                alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                // console.error('AJAX error:', status, error);
            }
        });
    }


    function deleteData(idTanding, idWasit, idPeserta) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('wasittanding/delNilai'); ?>',
            data: {
                idTanding: idTanding,
                idWasit: idWasit,
                idPeserta: idPeserta,
            },
            dataType: 'json',
            success: function(response) {
                // alert(response.message);

                if (response.status === 'success') {
                    // Panggil fungsi callback untuk menangani respons
                    // updateTable(response.new_data);
                    // updateTableBiru(response.new_data2);
                    mainLoad();
                }
            },
            error: function(xhr, status, error) {
                alert('Gagal menghapus data. Kesalahan: ' + status + ' - ' + error);
            }
        });
    }

    function babakAktif() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('tampil/cekTanding/' . $tanding->id_tanding); ?>',
            dataType: 'json',
            success: function(response) {

                if (response == 1) {
                    $('#babakShow').empty();
                    $('#babakShow').append(`
                        <button class="btn btn-warning btn-sm mt-1 mb-1 w-100 fw-bold"><span class='mdi mdi-loading mdi-spin'></span> BABAK 1</button>
                        <button class="btn btn-outline-secondary btn-sm mb-1 w-100 fw-bold">BABAK 2</button>
                        <button class="btn btn-outline-secondary btn-sm mb-1 w-100 fw-bold">BABAK 3</button>
                    `);
                }

                if (response == 2) {
                    $('#babakShow').empty();
                    $('#babakShow').append(`
                    <button class="btn btn-outline-secondary btn-sm mb-1 w-100 fw-bold">BABAK 1</button>
                    <button class="btn btn-warning btn-sm mt-1 mb-1 w-100 fw-bold"><span class='mdi mdi-loading mdi-spin'></span> BABAK 2</button>
                        <button class="btn btn-outline-secondary btn-sm mb-1 w-100 fw-bold">BABAK 3</button>
                    `);
                }

                if (response == 3) {
                    $('#babakShow').empty();
                    $('#babakShow').append(`
                    <button class="btn btn-outline-secondary btn-sm mb-1 w-100 fw-bold">BABAK 1</button>
                    <button class="btn btn-outline-secondary btn-sm mb-1 w-100 fw-bold">BABAK 2</button>
                    <button class="btn btn-warning btn-sm mt-1 mb-1 w-100 fw-bold"><span class='mdi mdi-loading mdi-spin'></span> BABAK 3</button>
                    `);
                }
            },
            error: function(xhr, status, error) {
                // alert('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                console.error('AJAX error:', status, error);
            }
        });
    }

    function cekVerifikasi() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('wasittanding/cekVerifikasi/' . $tanding->id_tanding); ?>',
            dataType: 'json',
            success: function(response) {
                if (response.status == 'benar') {
                    $("#upModal").modal('show');
                    $('#jenisVerifkasi').empty();

                    $('#idVr').val(response.idVr);
                    $('#idVr2').val(response.idVr);
                    $('#idVr3').val(response.idVr);
                    $('#jenisVerifkasi').text('VERIFIKASI ' + response.jenis.toUpperCase());
                } else {
                    $("#upModal").modal('hide');
                }
            },
            error: function(xhr, status, error) {
                alert('Gagal cek Veridikasi data. Kesalahan: ' + status + ' - ' + error);
                // console.log('Error cek verifikasi Kesalahan: ' + status + ' - ' + error);
            }
        });
    }


    // Contoh penggunaan
    $('#pukulMerah button').on('click', function() {
        var formData = $('#pukulMerah').serialize();
        saveData(formData);

        // console.log('Puklan');
    });

    $('#tendangMerah button').on('click', function() {
        var formData = $('#tendangMerah').serialize();
        saveData(formData);

        // console.log('formData');
    });

    $('#pukulBiru button').on('click', function() {
        var formData = $('#pukulBiru').serialize();
        saveData2(formData);

        // console.log('Puklan');
    });

    $('#tendangBiru button').on('click', function() {
        var formData = $('#tendangBiru').serialize();
        saveData2(formData);

        // console.log('formData');
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
                window.location.href = '<?= base_url('wasit/logout/' . $nomor) ?>';
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