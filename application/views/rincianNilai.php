<?php $this->load->view('head'); ?>
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

    .table-centered th,
    .table-centered td {
        padding: 5px;
        /* Sesuaikan padding sesuai kebutuhan */
        text-align: center;
        /* Mengatur teks di tengah secara vertical */
        border: 1px solid #000000;
        /* font-weight: bold; */
    }

    /* Opsional: Menambahkan garis pada sel tabel */
</style>
<div class="content-wrapper">
    <div class="page-header flex-wrap">
        <div class="header-left">
            Rincian Nilai Pertandingan
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
            <button class="btn btn-warning mt-2 mt-sm-0 btn-icon-text" onclick="window.location='<?= base_url('tanding') ?>' "><i class="mdi mdi-arrow-left"></i> Kembali</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div class="d-flex justify-content-center border-bottom">
                                <div class="hexagon">
                                    <div class="hex-mid hexagon-danger">
                                        <i class="mdi mdi-account-outline"></i>
                                    </div>
                                </div>
                                <div class="pl-4">
                                    <h4 class="font-weight-bold text-danger mb-0"><?= $merah->nama ?></h4>
                                    <h6 class="text-muted"><?= $merah->kontingen ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <h3 class="mb-3"><?= $partai->babak ?> | Partai Ke - <?= $partai->urut ?></h3>
                            <span class="badge badge-dark"><?= 'Kelas ' . $merah->kelas . ' - ' . $merah->kategori ?></span>
                            <span class="badge badge-warning"><?= $merah->jkl == 'Laki-laki' ? 'Putra' : 'Putri' ?></span>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="d-flex justify-content-center border-bottom">
                                <div class="hexagon">
                                    <div class="hex-mid hexagon-primary">
                                        <i class="mdi mdi-account-outline"></i>
                                    </div>
                                </div>
                                <div class="pl-4">
                                    <h4 class="font-weight-bold text-primary mb-0"><?= $biru->nama ?></h4>
                                    <h6 class="text-muted"><?= $biru->kontingen ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="table-responsive">
                                <table width="100%" class="table-centered">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #EB493A; color: white;" scope="col" colspan="4">POINT MERAH</th>
                                            <th scope="col" rowspan="2">BABAK</th>
                                            <th style="background-color: #0E82F2; color: white;" scope="col" colspan="4">POINT BIRU</th>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #EB493A; color: white;" scope="col">TOTAL</th>
                                            <th style="background-color: #EB493A; color: white;" scope="col" colspan="3">Detail Point</th>
                                            <th style="background-color: #0E82F2; color: white;" scope="col" colspan="3">Detail Point</th>
                                            <th style="background-color: #0E82F2; color: white;" scope="col">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 1; $i <= 3; $i++): ?>
                                            <tr>
                                                <td width="6%" rowspan="6"><b style="font-size: xx-large;" id="total-point-merah-<?= $i ?>"></b></td>
                                                <td width="4%" rowspan="4"><b id="point_juri_merah_<?= $i ?>"></b></td>
                                                <td width="27%" style="text-align: left; font-weight: bold;" id="list_point_merah_j1_<?= $i ?>"></td>
                                                <td width="9%">Juri 1</td>
                                                <td width="8%" rowspan="6"><b><?= $i ?></b></td>
                                                <td width="9%">Juri 1</td>
                                                <td width="27%" style="text-align: left; font-weight: bold;" id="list_point_biru_j1_<?= $i ?>"></td>
                                                <td width="4%" rowspan="4"><b id="point_juri_biru_<?= $i ?>"></b></td>
                                                <td width="6%" rowspan="6"><b style="font-size: xx-large;" id="total-point-biru-<?= $i ?>"></b></td>
                                            </tr>
                                            <tr>
                                                <td width="27%" style="text-align: left; font-weight: bold;" id="list_point_merah_j2_<?= $i ?>"></td> <!--20 angka -->
                                                <td width="9%">Juri 2</td>
                                                <td width="9%">Juri 2</td>
                                                <td width="27%" style="text-align: left; font-weight: bold;" id="list_point_biru_j2_<?= $i ?>"></td>
                                            </tr>
                                            <tr>
                                                <td width="27%" style="text-align: left; font-weight: bold;" id="list_point_merah_j3_<?= $i ?>"></td>
                                                <td width="9%">Juri 3</td>
                                                <td width="9%">Juri 3</td>
                                                <td width="27%" style="text-align: left; font-weight: bold;" id="list_point_biru_j3_<?= $i ?>"></td>
                                            </tr>
                                            <tr>
                                                <td width="27%" style="text-align: left; font-weight: bold;" id="list_point_merah_<?= $i ?>"></td>
                                                <td width="9%">Nilai</td>
                                                <td width="9%">Nilai</td>
                                                <td width="27%" style="text-align: left; font-weight: bold;" id="list_point_biru_<?= $i ?>"></td>
                                            </tr>
                                            <tr>
                                                <td width="4%"><b id="total_jatuhan_merah_<?= $i ?>"></b></td>
                                                <td width="27%" style="text-align: left; font-weight: bold;" id="list_jatuhan_merah_<?= $i ?>"></td>
                                                <td width="9%">Jatuhan</td>
                                                <td width="9%">Jatuhan</td>
                                                <td width="27%" style="text-align: left; font-weight: bold;" id="list_jatuhan_biru_<?= $i ?>"></td>
                                                <td width="4%"><b id="total_jatuhan_biru_<?= $i ?>"></b></td>
                                            </tr>
                                            <tr>
                                                <td width="4%"><b id="total_hukuman_merah_<?= $i ?>"></b></td>
                                                <td width="27%" style="text-align: left; font-weight: bold;" id="list_hukuman_merah_<?= $i ?>"></td>
                                                <td width="9%">Hukuman</td>
                                                <td width="9%">Hukuman</td>
                                                <td width="27%" style="text-align: left; font-weight: bold;" id="list_hukuman_biru_<?= $i ?>"></td>
                                                <td width="4%"><b id="total_hukuman_biru_<?= $i ?>"></b></td>
                                            </tr>
                                        <?php endfor ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- content-wrapper ends -->
<?php $this->load->view('foot'); ?>
<script src="<?= base_url('assets/vendors/select2/select2.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        loadNilai()
    })

    setInterval(loadNilai, 2000)

    function loadNilai() {

        for (let i = 1; i <= 3; i++) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('tanding/rincianNilai') ?>",
                dataType: 'json',
                data: {
                    id_tanding: '<?= $tanding->id_tanding ?>',
                    babak: i,
                },
                success: function(data) {
                    var countRows = 0;
                    // Merah Data List
                    let listJatuhanMerah = '';
                    let listHukumanMerah = '';
                    let listPointMerah = '';
                    let listPointMerahJ1 = '';
                    let listPointMerahJ2 = '';
                    let listPointMerahJ3 = '';
                    // Biru Data List
                    let listJatuhanBiru = '';
                    let listHukumanBiru = '';
                    let listPointBiru = '';
                    let listPointBiruJ1 = '';
                    let listPointBiruJ2 = '';
                    let listPointBiruJ3 = '';

                    // Merah list Data
                    $.each(data.list_jatuhan_merah, function(index, row) {
                        listJatuhanMerah += row.skor + ', ';
                    });
                    $.each(data.list_hukuman_merah, function(index, row) {
                        listHukumanMerah += row.skor + ', ';
                    });

                    $.each(data.list_point_merah, function(index, row) {
                        listPointMerah += '<u style="background-color: greenyellow;">' + row.skor + '</u>&nbsp;';
                        countRows++;
                        // if (countRows % 25 === 0) {
                        //     listPointMerah += '<br>';
                        // }
                    });
                    $.each(data.list_point_merah_j1, function(index, row) {
                        let newRow = '';
                        if (row.status === 'gagal') {
                            newRow = '<strike>' + row.skor + '</strike>' + '&nbsp;';
                        } else if (row.status === 'pakai') {
                            newRow = '<u style="background-color: greenyellow;">' + row.skor + '</u>' + '&nbsp;';
                        } else {
                            newRow = row.skor + '&nbsp;';
                        }

                        listPointMerahJ1 += newRow;
                        countRows++;

                        // if (countRows % 25 === 0) {
                        //     listPointMerahJ1 += '<br>';
                        // }
                    });
                    $.each(data.list_point_merah_j2, function(index, row) {
                        let newRow = '';
                        if (row.status === 'gagal') {
                            newRow = '<strike>' + row.skor + '</strike>' + '&nbsp;';
                        } else if (row.status === 'pakai') {
                            newRow = '<u style="background-color: greenyellow;">' + row.skor + '</u>' + '&nbsp;';
                        } else {
                            newRow = row.skor + '&nbsp;';
                        }

                        listPointMerahJ2 += newRow;
                        countRows++;

                        // if (countRows % 25 === 0) {
                        //     listPointMerahJ2 += '<br>';
                        // }
                    });
                    $.each(data.list_point_merah_j3, function(index, row) {
                        let newRow = '';
                        if (row.status === 'gagal') {
                            newRow = '<strike>' + row.skor + '</strike>' + '&nbsp;';
                        } else if (row.status === 'pakai') {
                            newRow = '<u style="background-color: greenyellow;">' + row.skor + '</u>' + '&nbsp;';
                        } else {
                            newRow = row.skor + '&nbsp;';
                        }

                        listPointMerahJ3 += newRow;
                        countRows++;

                        // if (countRows % 25 === 0) {
                        //     listPointMerahJ3 += '<br>';
                        // }
                    });

                    // Biru List Data
                    $.each(data.list_jatuhan_biru, function(index, row) {
                        listJatuhanBiru += row.skor + ', ';
                    });
                    $.each(data.list_hukuman_biru, function(index, row) {
                        listHukumanBiru += row.skor + ', ';
                    });

                    $.each(data.list_point_biru, function(index, row) {
                        listPointBiru += '<u style="background-color: greenyellow;">' + row.skor + '</u>&nbsp;';
                        countRows++;
                        // if (countRows % 25 === 0) {
                        //     listPointBiru += '<br>';
                        // }
                    });
                    $.each(data.list_point_biru_j1, function(index, row) {
                        let newRow = '';
                        if (row.status === 'gagal') {
                            newRow = '<strike>' + row.skor + '</strike>' + '&nbsp;';
                        } else if (row.status === 'pakai') {
                            newRow = '<u style="background-color: greenyellow;">' + row.skor + '</u>' + '&nbsp;';
                        } else {
                            newRow = row.skor + '&nbsp;';
                        }

                        listPointBiruJ1 += newRow;
                        countRows++;

                        // if (countRows % 25 === 0) {
                        //     listPointBiruJ1 += '<br>';
                        // }
                    });
                    $.each(data.list_point_biru_j2, function(index, row) {
                        let newRow = '';
                        if (row.status === 'gagal') {
                            newRow = '<strike>' + row.skor + '</strike>' + '&nbsp;';
                        } else if (row.status === 'pakai') {
                            newRow = '<u style="background-color: greenyellow;">' + row.skor + '</u>' + '&nbsp;';
                        } else {
                            newRow = row.skor + '&nbsp;';
                        }

                        listPointBiruJ2 += newRow;
                        countRows++;

                        // if (countRows % 25 === 0) {
                        //     listPointBiruJ2 += '<br>';
                        // }
                    });
                    $.each(data.list_point_biru_j3, function(index, row) {
                        let newRow = '';
                        if (row.status === 'gagal') {
                            newRow = '<strike>' + row.skor + '</strike>' + '&nbsp;';
                        } else if (row.status === 'pakai') {
                            newRow = '<u style="background-color: greenyellow;">' + row.skor + '</u>' + '&nbsp;';
                        } else {
                            newRow = row.skor + '&nbsp;';
                        }

                        listPointBiruJ3 += newRow;
                        countRows++;

                        // if (countRows % 25 === 0) {
                        //     listPointBiruJ3 += '<br>';
                        // }
                    });



                    $("#total-point-merah-" + i).text((parseInt(data.point_juri_merah) || 0) + (parseInt(data.point_merah) || 0));
                    $("#total-point-biru-" + i).text((parseInt(data.point_juri_biru) || 0) + (parseInt(data.point_biru) || 0));
                    $("#point_juri_merah_" + i).text(data.point_juri_merah);
                    $("#point_juri_biru_" + i).text(data.point_juri_biru);
                    $("#total_jatuhan_merah_" + i).text(data.data_merah.sum_jatuhan || 0);
                    $("#total_jatuhan_biru_" + i).text(data.data_biru.sum_jatuhan || 0);
                    $("#total_hukuman_merah_" + i).text(data.data_merah.sum_hukuman || 0);
                    $("#total_hukuman_biru_" + i).text(data.data_biru.sum_hukuman || 0);
                    // List Merah
                    $("#list_jatuhan_merah_" + i).text(listJatuhanMerah.slice(0, -2));
                    $("#list_hukuman_merah_" + i).text(listHukumanMerah.slice(0, -2));
                    $("#list_point_merah_" + i).html(listPointMerah);
                    $("#list_point_merah_j1_" + i).html(listPointMerahJ1);
                    $("#list_point_merah_j2_" + i).html(listPointMerahJ2);
                    $("#list_point_merah_j3_" + i).html(listPointMerahJ3);
                    // List Biru
                    $("#list_jatuhan_biru_" + i).text(listJatuhanBiru.slice(0, -2));
                    $("#list_hukuman_biru_" + i).text(listHukumanBiru.slice(0, -2));
                    $("#list_point_biru_" + i).html(listPointBiru);
                    $("#list_point_biru_j1_" + i).html(listPointBiruJ1);
                    $("#list_point_biru_j2_" + i).html(listPointBiruJ2);
                    $("#list_point_biru_j3_" + i).html(listPointBiruJ3);

                },
                error: function(xhr, status, error) {
                    console.error(`Error on babak ${i}:`, xhr, status, error);
                }
            });
        }
    }
</script>