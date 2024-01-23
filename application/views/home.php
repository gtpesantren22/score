<?php $this->load->view('head'); ?>
<div class="content-wrapper d-flex align-items-center auth text-center">
    <div class="row flex-grow">
        <div class="col-lg-8 mx-auto">
            <div class="auth-form-light text-left p-5">
                <h4>Selamat Datang <u><?= $user->nama ?></u>, Adiministrator</h4>
                <h6 class="font-weight-light">Anda login sebagai operator pertandingan</h6>
                <!-- <button class="btn btn-success" onclick="window.location='<?= base_url('dewan/tanding') ?>' ">Menuju Pertandingan <i class="mdi mdi-arrow-right"></i></button> -->
            </div>
        </div>
    </div>
</div>

<!-- content-wrapper ends -->
<?php $this->load->view('foot'); ?>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    })
</script>