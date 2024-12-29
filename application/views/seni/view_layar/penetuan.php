<div id="content" class="text-center mt-5">
    <style>
        body {
            font-family: 'Roboto', sans-serif;

            /* Menggunakan font dari Google Fonts */
            .spaced-table td,
            .spaced-table th {
                border: 5px solid #ffffff;
                /* border-radius: 10%; */
                /* Atur padding sesuai kebutuhan Anda */
            }
        }
    </style>
    <?php $target_index = 2 ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Detail Points</th>
                <th colspan="2">Score Result</th>
            </tr>
            <tr>
                <th></th>
                <th style="background-color: red; color: #ffffff">Merah</th>
                <th style="background-color: blue; color: #ffffff">Biru</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Standart Deviasi</th>
                <td style="font-weight: bold; color: red;"><?= $deviasiMerah ?></td>
                <td style="font-weight: bold; color: blue;"><?= $deviasiBiru ?></td>
            </tr>
            <tr>
                <th>Waktu Perform</th>
                <td style="font-weight: bold; color: red;"><?= $detailmerah->waktu ?></td>
                <td style="font-weight: bold; color: blue;"><?= $detailbiru->waktu ?></td>
            </tr>
            <tr>
                <th>Hukuman</th>
                <td style="font-weight: bold; color: red;"><?= pembulatan($foulMerah->skor) ?></td>
                <td style="font-weight: bold; color: blue;"><?= pembulatan($foulBiru->skor) ?></td>
            </tr>
            <tr>
                <th style="font-weight: bold; font-size: x-large;">Total Points</th>
                <td style="font-weight: bold; font-size: x-large; color: red;">
                    <?php if (isset($totalMerah[$target_index])) : ?>
                        <?= pembulatan($totalMerah[$target_index]->skor + $foulMerah->skor) ?>
                    <?php endif; ?>
                </td>
                <td style="font-weight: bold; font-size: x-large; color: blue;">
                    <?php if (isset($totalBiru[$target_index])) : ?>
                        <?= pembulatan($totalBiru[$target_index]->skor + $foulBiru->skor) ?>
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>