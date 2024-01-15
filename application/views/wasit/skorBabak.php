<tr>
    <th rowspan="2">
        <center><b>BABAK <?= $skor->babak ?></b></center>
    </th>
    <th style="color: black; background-color: #ff00005e; font-size: x-large; font-weight: bolder;"><?= $skor->poinR ?></th>
    <th style="color: black; background-color: #ff00005e; font-size: x-large; font-weight: bolder;"><?= $skor->foulR ?></th>
    <th style="color: white; background-color: red; font-size: x-large; font-weight: bolder;"><?= $skor->poinR + $skor->foulR ?></th>
</tr>
<tr>
    <th style="color: black; background-color: #0000f254; font-size: x-large; font-weight: bolder;"><?= $skor->poinB ?></th>
    <th style="color: black; background-color: #0000f254; font-size: x-large; font-weight: bolder;"><?= $skor->foulB ?></th>
    <th style="color: white; background-color: blue; font-size: x-large; font-weight: bolder;"><?= $skor->poinB + $skor->foulB ?></th>
</tr>