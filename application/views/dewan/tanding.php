<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pertandingan</title>
    <!-- Bootstrap 5 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="<?= base_url('assets/bootstrap-5/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <style>
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

<body class="bg-light">
    <header class="custom-header-full text-center py-1 shadow-sm">
        <span class="header-text uppercase"><?= $judul ?></span>
        <span class="mdi mdi-star-three-points"></span>
        <span class="header-text"><?= $deskripsi ?></span>
    </header>
    <div class="container py-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary mb-0">Dewan Pertandingan</h3>
            <a href="<?= base_url('dewan/tanding') ?>" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-arrow-clockwise"></i> Refresh
            </a>
        </div>

        <!-- Konten -->
        <div class="card shadow-sm border-0">
            <div class="card-body">

                <?php if ($tanding->result()) { ?>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle table-bordered mb-0">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Partai</th>
                                    <th>Pemimpin Pertandingan</th>
                                    <th>Aktif | Status | Gelanggang</th>
                                    <th style="width: 160px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($tanding->result() as $row): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td>Partai Ke - <?= $row->urut ?></td>
                                        <td><?= $row->nama ?></td>
                                        <td class="text-center">
                                            <span class="badge bg-warning text-dark">Aktif: <?= $row->aktif ?></span>
                                            <span class="badge bg-primary"><?= $row->status ?></span>
                                            <span class="badge bg-success">Gel: <?= $row->gel ?></span>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url('dewan/detail/' . $row->id_tanding) ?>" class="btn btn-sm btn-info me-1">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                            <a href="<?= base_url('dewan/delTanding/' . $row->id_tanding) ?>" class="btn btn-sm btn-danger tombol-hapus">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                <?php } else { ?>
                    <div class="text-center py-5">
                        <h5 class="text-muted mb-3">Belum ada pertandingan yang aktif, Silahkan tunggu.</h5>
                        <p class="text-secondary">Tekan tombol di bawah jika pertandingan sudah aktif tapi belum muncul.</p>
                        <button class="btn btn-primary px-4" onclick="window.location='<?= base_url('dewan/tanding') ?>'">
                            <i class="bi bi-arrow-clockwise"></i> Refresh Halaman
                        </button>
                    </div>
                <?php } ?>

            </div>
        </div>

    </div>

    <!-- Bootstrap Icons & JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="<?= base_url() ?>assets/js/jquery-3.7.1.min.js"></script>
<script src="<?= base_url('assets/bootstrap-5/js/bootstrap.bundle.min.js') ?>"></script>


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