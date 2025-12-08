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
</style>

<div class="row mt-2">
    <div class="col-lg-5 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="card-title">Daftar Winner Tanding <button class="btn btn-sm btn-success">Update Babak</button></h4> -->
                <!-- <p class="card-description">Daftar Winner Tanding</p> -->
                <div class="table-responsive">
                    <table class="table table-striped table-sm table-bordered" id="dataWinner">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Babak-Partai</th>
                                <th>Nama Peserta</th>
                                <th>Kelas</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">Daftar Partai Baru
                    <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#editBabak">Update Babak</button>
                    <a href="<?= base_url('winner/savePartai') ?>" class="btn btn-sm btn-warning float-right tbl-confirm" value="Data sementara akan ditambahkan ke partai">Simpan Partai</a>
                </h4>
                <!-- <h4 class="card-title"></h4> -->
                <!-- <p class="card-description"> Add class <code>.table</code></p> -->
                <div class="table-responsive">
                    <table class="table table-striped table-sm table-bordered" id="dataPartai">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Partai</th>
                                <th>Babak</th>
                                <th class="text-center text-bold" style="background-color: red; color: white;">Pesilat Merah</th>
                                <th class="text-center text-bold" style="background-color: blue; color: white;">Pesilat Biru</th>
                                <!-- <th>#</th> -->
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editBabak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Babak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('winner/updateBabak') ?>" method="post" class="forms-sample" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Babak</label>
                        <select name="babak" id="" class="form-control form-control-sm" required>
                            <option value=""> -pilih jenis-</option>
                            <option value="Penyisihan">Penyisihan</option>
                            <option value="Babak 32 Besar">Babak 32 Besar</option>
                            <option value="Babak 16 Besar">Babak 16 Besar</option>
                            <option value="Babak 8 Besar">Babak 8 Besar</option>
                            <option value="Perempat Final">Perempat Final</option>
                            <option value="Semi Final">Semi Final</option>
                            <option value="Final">Final</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- content-wrapper ends -->
<?php $this->load->view('foot'); ?>
<script>
    $(document).ready(function() {
        // $('#dataTable').DataTable();
        // $(".slect2").select2({
        //     theme: "bootstrap"
        // });
        loadWinner();
        loadPartai();
    })

    function loadWinner() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('winner/datas') ?>",
            dataType: "json",
            success: function(data) {
                var html = '';
                $.each(data, function(index, item) {
                    const hasilJk = item.jkl == 'Laki-laki' ? 'Putra' : 'Putri';
                    html += '<tr>';
                    html += '<td>' + (index + 1) + '</td>';
                    html += '<td>' + item.babak + ' - ke ' + item.urut + '</td>';
                    html += '<td class="text-center"><u><b>' + item.nama + '</b></u><br>' + item.kontingen + '</td>';
                    html += '<td>' + item.kelas + ' - ' + item.kategori + ' - ' + hasilJk + '</td>';
                    html += '<td><button class="btn btn-sm btn-primary" onclick="addWinner(\'' + item.id_winner + '\')"><i class="mdi mdi-check-circle"></i></button></td>';
                    html += '</tr>';
                });
                $('#dataWinner').find('tbody').html(html);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function loadPartai() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('winner/partai') ?>",
            dataType: "json",
            success: function(datas) {
                var html = '';
                $.each(datas, function(index, item) {
                    var merahNama = item.merah && item.merah.nama ? '<b><u>' + item.merah.nama + '</u></b><br>' : '-';
                    var biruNama = item.biru && item.biru.nama ? '<b><u>' + item.biru.nama + '</u></b><br>' : '-';
                    var merahK = item.merah && item.merah.kontingen ? item.merah.kontingen : '';
                    var biruK = item.biru && item.biru.kontingen ? item.biru.kontingen : '';
                    var merahDel = item.merah && (index === datas.length - 1) ? '<i class="mdi mdi-delete text-danger" onclick="deleteWinner(\'' + item.id_winner_merah + '\', \'merah\', \'' + item.id_partai + '\')"></i> ' : '';
                    var biruDel = item.biru && (index === datas.length - 1) ? '<i class="mdi mdi-delete text-danger" onclick="deleteWinner(\'' + item.id_winner_biru + '\', \'biru\', \'' + item.id_partai + '\')"></i> ' : '';

                    html += '<tr>';
                    html += '<td>' + (index + 1) + '</td>';
                    html += '<td>Ke - ' + item.urut + '</td>';
                    html += '<td>' + item.babak + '</td>';
                    html += '<td class="text-center">' + merahDel + merahNama + merahK + '</td>';
                    html += '<td class="text-center">' + biruDel + biruNama + biruK + '</td>';
                    // html += '<td><button class="btn btn-sm btn-danger" onclick="loadDetail(' + item.id_partai + ')"><i class="mdi mdi-delete"></i></button></td>';
                    html += '</tr>';
                });
                $('#dataPartai').find('tbody').html(html);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function addWinner(id_winner) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('winner/addWinner ') ?>",
            data: {
                id_winner: id_winner
            },
            dataType: "json",
            success: function(datas) {
                if (datas.status == 'success') {
                    loadWinner();
                    loadPartai();
                } else {
                    alert(datas.message);
                }
            },
            error: function(xhr, status, error) {
                console.log('Error: ' + error); // Tambahkan pesan error yang lebih informatif
                console.log(xhr.responseText);
            }
        });
        // alert(id_winner);
    }

    function deleteWinner(id_winner, sudut, id_partai) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('winner/updateWinner ') ?>",
            data: {
                id_winner: id_winner,
                sudut: sudut,
                id_partai: id_partai
            },
            dataType: "json",
            success: function(datas) {
                if (datas.status == 'success') {
                    loadWinner();
                    loadPartai();
                } else {
                    alert('error add winner');
                }
            },
            error: function(xhr, status, error) {
                console.log('Error: ' + error);
                console.log(xhr.responseText);
            }
        });
    }
</script>