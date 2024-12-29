<div id="content" class="text-center mt-5">
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
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <table class="table text-center table-bordered table-sm spaced-table" style="color: white; background-color: #047ef4; font-size: 1400px;">
                <tr>
                    <th>
                        <h2 class="font-weight-bold">1</h2>
                    </th>
                    <th>
                        <h2 class="font-weight-bold">2</h2>
                    </th>
                    <th>
                        <h2 class="font-weight-bold">3</h2>
                    </th>
                    <th>
                        <h2 class="font-weight-bold">4</h2>
                    </th>
                    <th>
                        <h2 class="font-weight-bold">5</h2>
                    </th>
                </tr>
                <tr>
                    <th>
                        <h1 class="font-weight-bold"><?= $juri1 ? number_format(9.90 + $juri1, 2) : number_format(9.90, 2)  ?></h1>
                    </th>
                    <th>
                        <h1 class="font-weight-bold"><?= $juri2 ? number_format(9.90 + $juri2, 2) : number_format(9.90, 2)  ?></h1>
                    </th>
                    <th>
                        <h1 class="font-weight-bold"><?= $juri3 ? number_format(9.90 + $juri3, 2) : number_format(9.90, 2)  ?></h1>
                    </th>
                    <th>
                        <h1 class="font-weight-bold"><?= $juri4 ? number_format(9.90 + $juri4, 2) : number_format(9.90, 2)  ?></h1>
                    </th>
                    <th>
                        <h1 class="font-weight-bold"><?= $juri5 ? number_format(9.90 + $juri5, 2) : number_format(9.90, 2)  ?></h1>
                    </th>
                </tr>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>