<?php $this->load->view('head'); ?>
<div class="content-wrapper">
    <div class="page-header flex-wrap">
        <div class="header-left">
            <!-- <button class="btn btn-primary mb-2 mb-md-0 mr-2" data-toggle="modal" data-target="#uploadPeserta"> Import Data Peserta </button>
            <a href="<?= base_url('master/template') ?>" class="btn btn-outline-primary mb-2 mb-md-0"> Download Template </a> -->
        </div>
        <div class="header-right d-flex flex-wrap mt-md-2 mt-lg-0">
            <div class="d-flex align-items-center">
                <a href="#">
                    <p class="m-0 pr-3"></p>
                </a>
                <a class="pl-3 mr-4" href="#">
                    <!-- <p class="m-0">Daftar Peserta Pertandingan</p> -->
                </a>
            </div>
            <!-- <button class="btn btn-primary mt-2 mt-sm-0 btn-icon-text" data-toggle="modal" data-target="#tambahPeserta"><i class="mdi mdi-plus-circle"></i> Tambah Peserta </button> -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h5>Cari Data</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('drawing/show') ?>" method="post" id="form-show">
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select class="form-control form-control-sm" id="kelas" name="kelas" required>
                                <option value=""> -pilih kelas- </option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="kategori" id="" class="form-control form-control-sm" required>
                                <option value=""> -pilih kategori-</option>
                                <option value="USIA DINI">USIA DINI</option>
                                <option value="PRA REMAJA">PRA REMAJA</option>
                                <option value="REMAJA">REMAJA</option>
                                <option value="DEWASA">DEWASA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select name="jkl" id="" class="form-control form-control-sm" required>
                                <option value=""> -pilih jkl-</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">System</label>
                            <select name="system" id="" class="form-control form-control-sm" required>
                                <option value=""> -pilih-</option>
                                <option value="full-prestasi">Full Prestasi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Tampilkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div id="show-hasil">
                    <div class="card-header">
                        <h5>
                            <b id="">-</b> => <span id="" class="badge badge-dark">0</span>
                            <button class="btn btn-success float-right">Save & Schema</button>
                            <button class="btn btn-danger float-right">Drawing</button>
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
                                <tbody id=""></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">

        </div>
    </div>
</div>




<!-- content-wrapper ends -->
<?php $this->load->view('foot'); ?>

<script>
    $('#form-show').on('submit', function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: $(this).serialize(),
            dataType: 'html',
            success: function(response) {
                $('#show-hasil').empty()
                $('#show-hasil').html(response);
            }
        });
    });
</script>