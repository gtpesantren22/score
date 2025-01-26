<style>
    .iziToast-progressbar.animated {
        animation: progressBarAnimation 2s linear infinite;
    }

    @keyframes progressBarAnimation {
        from {
            width: 0%;
        }

        to {
            width: 100%;
        }
    }
</style>

<div class="card-header">
    <h5>
        <?php $jkOk = $jkl == 'Laki-laki' ? 'Putra' : 'Putri' ?>
        <b><?= $kelas . ' - ' . $kategori . ' - ' . $jkOk ?></b> => <span class="badge badge-dark"><?= $total ?></span>
        <button class="btn btn-success float-right" data-kelas="<?= $kelas ?>" data-kategori="<?= $kategori ?>" data-jkl="<?= $jkl ?>" id="tbl-schema">Cek Schema</button>
        <button class="btn btn-danger float-right" data-toggle="modal" data-target="#modal-drawing">Drawing</button>
    </h5>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered table-hover" id="">
            <thead>
                <tr class="text-center">
                    <th style="background-color: lightblue;">No</th>
                    <th style="background-color: lightblue;">Nama</th>
                    <th style="background-color: lightblue;">Perguruan</th>
                    <th style="background-color: lightcoral;">No Undian</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php
                $no = 1;
                foreach ($hasil as $row) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['kontingen'] ?></td>
                        <td class="text-center" style="background-color: lightpink; font-weight: bold;"><?= $row['nomor'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="modal-drawing" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Drawing Peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('drawing/mulai') ?>" method="post" class="forms-sample" id="form-drawing">
                    <!-- <label for="">Kelas</label> -->
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-sm" name="fr-kelas" value="<?= $kelas ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-sm" name="fr-kategori" value="<?= $kategori ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" class="form-control form-control-sm" name="fr-jkl" value="<?= $jkl ?>" readonly>
                        </div>
                        <div class="col-md-12 mt-3 text-center">
                            <img src="<?= base_url('assets/images/done3.gif') ?>" alt="" height="100px" id="done" style="display: none;">
                            <p id="doneText" style="display: none; font-size: larger; font-weight: bolder; color: #00cc73;">Drawing Selesai</p>
                            <img src="<?= base_url('assets/images/prog-angka.gif') ?>" alt="" height="170px" id="proses" style="display: none;">
                        </div>
                        <div class="col-md-12 mt-3">
                            <button class="btn btn-danger btn-block" id="bt-mulai" type="submit"><span class="mdi mdi-timer-sand"></span> Mulai Drawing</button>
                            <button class="btn btn-dark btn-block" id="bt-stop" type="button" disabled><span class="mdi mdi-stop-circle-outline"></span> Stop Drawing</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <!-- <button type="submit" class="btn btn-primary">Upload Data</button> -->
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
<script>
    $('#form-drawing').on('submit', function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        // var datas = $(this).serialize();
        var kelas = $('#form-drawing input[name="fr-kelas"]').val();
        var kategori = $('#form-drawing input[name="fr-kategori"]').val();
        var jkl = $('#form-drawing input[name="fr-jkl"]').val();


        iziToast.question({
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: 'Yakin ?',
            message: 'Proses drwaing akan dimulai',
            position: 'topCenter',
            appendTo: 'body',
            zindex: 9999,
            buttons: [
                ['<button><b>YES</b></button>', function(instance, toast) {
                    $('#proses').show();
                    // document.location.href = hreh
                    iziToast.hide({}, toast);
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            kelas: kelas,
                            kategori: kategori,
                            jkl: jkl
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 'success') {
                                document.getElementById('bt-mulai').disabled = true;
                                var tbl_stop = $('#bt-stop');;
                                tbl_stop.prop('disabled', false);
                                tbl_stop.attr('data-kelas', kelas).attr('data-kategori', kategori).attr('data-jkl', jkl);
                            } else {
                                alert('gagal Drawing');
                            }

                        }
                    })
                }, true],
                ['<button>NO</button>', function(instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOut'
                    }, toast, 'button');
                }],
            ],
        });
    })

    $('#bt-stop').on('click', function(e) {
        e.preventDefault();
        $('#proses').hide();
        $('#done').show();
        $('#doneText').show();

        var kelas = $(this).data('kelas');
        var kategori = $(this).data('kategori');
        var jkl = $(this).data('jkl');

        $.ajax({
            type: 'POST',
            url: '<?= base_url('drawing/showTable') ?>',
            data: {
                kelas: kelas,
                kategori: kategori,
                jkl: jkl
            },
            dataType: 'json',
            success: function(response) {
                $('#table-body').empty();
                populateTableBody(response.data, 'table-body')
            }
        });

    })

    $('#tbl-schema').on('click', function(e) {
        e.preventDefault();
        var kelas = $(this).data('kelas')
        var kategori = $(this).data('kategori')
        var jkl = $(this).data('jkl')

        iziToast.question({
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: 'Yakin ?',
            message: 'Schema akan dibuat dan',
            position: 'center',
            buttons: [
                ['<button><b>YES</b></button>', function(instance, toast) {
                    iziToast.hide({}, toast);

                    iziToast.show({
                        title: 'Processing...',
                        message: 'Proses Schema sedang berlangsung.',
                        timeout: false, // Tidak ada timeout
                        progressBar: true, // Progress bar aktif
                        progressBarColor: 'white', // Warna progress bar
                        position: 'center', // Posisi toast
                        theme: 'dark', // Tema gelap
                        onOpening: function(instance, toast) {
                            const progressBar = toast.querySelector('.iziToast-progressbar');
                            progressBar.classList.add('animated');
                        },
                    });

                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('drawing/schema') ?>',
                        data: {
                            kelas: kelas,
                            kategori: kategori,
                            jkl: jkl
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 'success') {
                                iziToast.hide({}, toast);
                            } else {
                                alert('gagal Drawing');
                            }

                        }
                    })
                }, true],
                ['<button>NO</button>', function(instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOut'
                    }, toast, 'button');
                }],
            ],
        });
    })


    function populateTableBody(data, tableBodyId) {
        $('#' + tableBodyId).empty();
        var tbodyContent = '';

        $.each(data, function(index, item) {
            tbodyContent += '<tr>';
            tbodyContent += '<td>' + (index + 1) + '</td>'; // No (index + 1 untuk nomor urut)
            tbodyContent += '<td>' + item.nama + '</td>'; // Nama peserta
            tbodyContent += '<td>' + item.kontingen + '</td>'; // Nama perguruan
            tbodyContent += '<td class="text-center" style="background-color: lightpink; font-weight: bold;">' + item.nomor + '</td>'; // Nomor undian
            tbodyContent += '</tr>';
        });

        $('#' + tableBodyId).html(tbodyContent); // Isi tbody dengan konten
    }
</script>