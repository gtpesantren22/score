<?php $this->load->view('dewan/head'); ?>
<link rel="stylesheet" href="<?= base_url('assets/vendors/select2/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') ?>">
<div class="content-wrapper">
    <div class="page-header flex-wrap">
        <div class="header-left">
            Daftar Pertandingan (Seni Tunggal)
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
            <button class="btn btn-warning mt-2 mt-sm-0 btn-icon-text" onclick="window.location='<?= base_url('dewan') ?>' "><i class="mdi mdi-arrow-left"></i> Kembali</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Data Peserta Lomba</h4>
                    <p class="card-description"> Add class <code>.table</code></p> -->
                    <?php if ($tanding) { ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Partai</th>
                                        <th>Pemimpin Pertandingan</th>
                                        <th>Aktif|Status|Gelanggang</th>
                                        <!-- <th>#</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($tanding as $row) :
                                        $merah = $this->db->query("SELECT * FROM pesertatgr WHERE id_peserta = '$row->merah' ")->row();
                                        $biru = $this->db->query("SELECT * FROM pesertatgr WHERE id_peserta = '$row->biru' ")->row();
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td>Partai Ke - <?= $row->urut ?></td>
                                            <td><?= $row->nama ?></td>
                                            <td><span class="badge badge-warning">Aktif : <?= $row->aktif ?></span> | <span class="badge badge-dark"><?= $row->status ?></span> | <span class="badge badge-success">Gel : <?= $row->gel ?></span></td>
                                            <!-- <td>
                                                <a href="<?= base_url('dewan/delTanding/' . $row->id_tanding) ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
                                                <a href="<?= base_url('dewantgr1/detail/' . $row->id_tanding) ?>" class="btn btn-sm btn-info">Detail</a>
                                            </td> -->
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><b class="text-primary">Pesilat Sudut Biru</b></td>
                                            <td class="font-weight-bold text-primary"><?= $biru->nama ?></td>
                                            <td><button class="btn btn-primary btn-block" type="" onclick="window.location.href='<?= base_url('dewantgr1/mulaiNilai/' . $biru->id_peserta . '/' . $row->id_tanding) ?>' ">Proses Penilaian</button></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><b class="text-danger">Pesilat Sudut Merah</b></td>
                                            <td class="font-weight-bold text-danger"><?= $merah->nama ?></td>
                                            <td><button class="btn btn-danger btn-block" type="" onclick="window.location.href='<?= base_url('dewantgr1/mulaiNilai/' . $merah->id_peserta . '/' . $row->id_tanding) ?>' ">Proses Penilaian</button></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <form action="<?= base_url('dewantgr1/penentuan') ?>" method="post" id="penentuan">
                            <input type="hidden" name="id_tanding" value="<?= $id_tanding ?>">
                            <button class="btn btn-dark btn-lg btn-block">Penentuan Pemenang</button>
                        </form>
                        <?php if ($this->session->flashdata('error')) {
                            echo "<p class='text-center mt-2 text-danger'><b>" . $this->session->flashdata('error') . '</b></p>';
                        } ?>
                        <?php if ($dtltanding->status == 'selesai' and $dtltanding->aktif == 'Y') : ?>
                            <div id="penetuan"></div>
                        <?php endif ?>
                    <?php } else { ?>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-center">
                            <p>Tekan tombol dibawah jika tidak ada pertandingan yang muncul</p>
                            <button class="btn btn-primary" onclick="window.location='<?= base_url('dewantgr1/tanding') ?>'">REFRESH HALAMAN</button>
                        </div>
                        <div class="col-md-4"></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
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

        penentuan()
    })

    function penentuan() {
        $.ajax({
            url: "<?= base_url('dewantgr1/hasilPenentuan/' . $id_tanding) ?>",
            type: "GET",
            success: function(data) {
                $('#penetuan').html(data);
            }

        });
    }

    $('#penentuan').on('submit', function(e) {
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
                        alert('Penentuan Stop Perform')
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