<div id="content" class="text-center">
    <?php $target_index = 2; ?>
    <style>
        body {
            font-family: 'Roboto', sans-serif;

            /* Menggunakan font dari Google Fonts */
            .spaced-table td,
            .spaced-table th {
                border: 5px solid #ffffff;
                border-radius: 10%;
                /* Atur padding sesuai kebutuhan Anda */
            }
        }
    </style>

    <div class="row">

        <div class="col-md-7">
            <table class="table text-center table-bordered table-sm spaced-table" style="color: white; background-color: #047ef4; font-size: 100px;">
                <tr>
                    <?php foreach ($data as $index => $row1) : ?>
                        <th <?php if ($index == 2) echo 'style="background-color: #34c357;"'; ?>>
                            <h3 class="font-weight-bold"><?= $row1->juri ?></h3>
                        </th>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <?php foreach ($data as $index => $row2) : ?>
                        <th <?php if ($index == 2) echo 'style="background-color: #34c357;"'; ?>>
                            <h3 class="font-weight-bold"><?= number_format(round($row2->skor, 2), 2) ?></h3>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </table>
        </div>
        <div class="col-md-5">
            <table class="table text-center table-bordered table-sm">
                <tr style="color: white; background-color: #34c357; ">
                    <th>Median</th>
                    <th>Penalty</th>
                    <th>Waktu Perform</th>
                    <th>Total</th>
                </tr>
                <tr>
                    <?php if (isset($data[$target_index])) : ?>
                        <th>
                            <?= number_format(round($data[$target_index]->skor, 2), 2) ?>
                        </th>
                    <?php endif; ?>
                    <th><?= number_format(round($penalti->skor, 2), 2) ?></th>
                    <th><?= $detail->waktu ?></th>
                    <?php if (isset($data[$target_index])) : ?>
                        <th>
                            <?= number_format(round($data[$target_index]->skor + $penalti->skor, 2), 2) ?>
                        </th>
                    <?php endif; ?>
                </tr>
                <tr style="color: white; background-color: #34c357; ">
                    <th colspan="4">Standart Deviation</th>
                </tr>
                <tr>
                    <th colspan="4"><?= $deviasi ?></th>
                </tr>
            </table>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>