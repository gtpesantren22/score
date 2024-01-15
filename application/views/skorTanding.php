<!-- Juri 1 -->
<?php
$juri1 = $this->db->query("SELECT babak, 
SUM(IF(skor > 0 AND id_peserta = '$tanding->merah', skor, 0)) AS poinR, 
SUM(IF(skor < 0 AND id_peserta = '$tanding->merah', skor, 0)) AS foulR, 
SUM(IF(skor > 0 AND id_peserta = '$tanding->biru', skor, 0)) AS poinB, 
SUM(IF(skor < 0 AND id_peserta = '$tanding->biru', skor, 0)) AS foulB
FROM nilai WHERE id_tanding = '$tanding->id_tanding' AND id_wasit = '$tanding->juri1' AND babak = $babak ")->row();
?>
<tr>
    <th rowspan="2">
        <center><b>JURI 1</b></center>
    </th>
    <th style="color: black; background-color: #ff00005e; font-size: x-large; font-weight: bolder;"><?= $juri1 ? $juri1->poinR : 0  ?></th>
    <th style="color: black; background-color: #ff00005e; font-size: x-large; font-weight: bolder;"><?= $juri1 ? $juri1->foulR : 0  ?></th>
    <th style="color: white; background-color: red; font-size: x-large; font-weight: bolder;"><?= $juri1 ? $juri1->poinR + $juri1->foulR : 0  ?></th>
</tr>
<tr>
    <th style="color: black; background-color: #0000f254; font-size: x-large; font-weight: bolder;"><?= $juri1 ? $juri1->poinB : 0  ?></th>
    <th style="color: black; background-color: #0000f254; font-size: x-large; font-weight: bolder;"><?= $juri1 ? $juri1->foulB : 0  ?></th>
    <th style="color: white; background-color: blue; font-size: x-large; font-weight: bolder;"><?= $juri1 ? $juri1->poinB + $juri1->foulB : 0  ?></th>
</tr>

<!-- Juri 2 -->
<?php
$juri2 = $this->db->query("SELECT babak, 
SUM(IF(skor > 0 AND id_peserta = '$tanding->merah', skor, 0)) AS poinR, 
SUM(IF(skor < 0 AND id_peserta = '$tanding->merah', skor, 0)) AS foulR, 
SUM(IF(skor > 0 AND id_peserta = '$tanding->biru', skor, 0)) AS poinB, 
SUM(IF(skor < 0 AND id_peserta = '$tanding->biru', skor, 0)) AS foulB
FROM nilai WHERE id_tanding = '$tanding->id_tanding' AND id_wasit = '$tanding->juri2' AND babak = $babak ")->row();
?>
<tr>
    <th rowspan="2">
        <center><b>JURI 2</b></center>
    </th>
    <th style="color: black; background-color: #ff00005e; font-size: x-large; font-weight: bolder;"><?= $juri2 ? $juri2->poinR : 0  ?></th>
    <th style="color: black; background-color: #ff00005e; font-size: x-large; font-weight: bolder;"><?= $juri2 ? $juri2->foulR : 0  ?></th>
    <th style="color: white; background-color: red; font-size: x-large; font-weight: bolder;"><?= $juri2 ? $juri2->poinR + $juri2->foulR : 0  ?></th>
</tr>
<tr>
    <th style="color: black; background-color: #0000f254; font-size: x-large; font-weight: bolder;"><?= $juri2 ? $juri2->poinB : 0  ?></th>
    <th style="color: black; background-color: #0000f254; font-size: x-large; font-weight: bolder;"><?= $juri2 ? $juri2->foulB : 0  ?></th>
    <th style="color: white; background-color: blue; font-size: x-large; font-weight: bolder;"><?= $juri2 ? $juri2->poinB + $juri2->foulB : 0  ?></th>
</tr>

<!-- Juri 3 -->
<?php
$juri3 = $this->db->query("SELECT babak, 
SUM(IF(skor > 0 AND id_peserta = '$tanding->merah', skor, 0)) AS poinR, 
SUM(IF(skor < 0 AND id_peserta = '$tanding->merah', skor, 0)) AS foulR, 
SUM(IF(skor > 0 AND id_peserta = '$tanding->biru', skor, 0)) AS poinB, 
SUM(IF(skor < 0 AND id_peserta = '$tanding->biru', skor, 0)) AS foulB
FROM nilai WHERE id_tanding = '$tanding->id_tanding' AND id_wasit = '$tanding->juri3' AND babak = $babak ")->row();
?>
<tr>
    <th rowspan="2">
        <center><b>JURI 3</b></center>
    </th>
    <th style="color: black; background-color: #ff00005e; font-size: x-large; font-weight: bolder;"><?= $juri3 ? $juri3->poinR : 0  ?></th>
    <th style="color: black; background-color: #ff00005e; font-size: x-large; font-weight: bolder;"><?= $juri3 ? $juri3->foulR : 0  ?></th>
    <th style="color: white; background-color: red; font-size: x-large; font-weight: bolder;"><?= $juri3 ? $juri3->poinR + $juri3->foulR : 0  ?></th>
</tr>
<tr>
    <th style="color: black; background-color: #0000f254; font-size: x-large; font-weight: bolder;"><?= $juri3 ? $juri3->poinB : 0  ?></th>
    <th style="color: black; background-color: #0000f254; font-size: x-large; font-weight: bolder;"><?= $juri3 ? $juri3->foulB : 0  ?></th>
    <th style="color: white; background-color: blue; font-size: x-large; font-weight: bolder;"><?= $juri3 ? $juri3->poinB + $juri3->foulB : 0  ?></th>
</tr>

<!-- Juri 4 -->
<?php
$juri4 = $this->db->query("SELECT babak, 
SUM(IF(skor > 0 AND id_peserta = '$tanding->merah', skor, 0)) AS poinR, 
SUM(IF(skor < 0 AND id_peserta = '$tanding->merah', skor, 0)) AS foulR, 
SUM(IF(skor > 0 AND id_peserta = '$tanding->biru', skor, 0)) AS poinB, 
SUM(IF(skor < 0 AND id_peserta = '$tanding->biru', skor, 0)) AS foulB
FROM nilai WHERE id_tanding = '$tanding->id_tanding' AND id_wasit = '$tanding->juri4' AND babak = $babak ")->row();
?>
<tr>
    <th rowspan="2">
        <center><b>JURI 4</b></center>
    </th>
    <th style="color: black; background-color: #ff00005e; font-size: x-large; font-weight: bolder;"><?= $juri4 ? $juri4->poinR : 0  ?></th>
    <th style="color: black; background-color: #ff00005e; font-size: x-large; font-weight: bolder;"><?= $juri4 ? $juri4->foulR : 0  ?></th>
    <th style="color: white; background-color: red; font-size: x-large; font-weight: bolder;"><?= $juri4 ? $juri4->poinR + $juri4->foulR : 0  ?></th>
</tr>
<tr>
    <th style="color: black; background-color: #0000f254; font-size: x-large; font-weight: bolder;"><?= $juri4 ? $juri4->poinB : 0  ?></th>
    <th style="color: black; background-color: #0000f254; font-size: x-large; font-weight: bolder;"><?= $juri4 ? $juri4->foulB : 0  ?></th>
    <th style="color: white; background-color: blue; font-size: x-large; font-weight: bolder;"><?= $juri4 ? $juri4->poinB + $juri4->foulB : 0  ?></th>
</tr>

<!-- Juri 5 -->
<?php
$juri5 = $this->db->query("SELECT babak, 
SUM(IF(skor > 0 AND id_peserta = '$tanding->merah', skor, 0)) AS poinR, 
SUM(IF(skor < 0 AND id_peserta = '$tanding->merah', skor, 0)) AS foulR, 
SUM(IF(skor > 0 AND id_peserta = '$tanding->biru', skor, 0)) AS poinB, 
SUM(IF(skor < 0 AND id_peserta = '$tanding->biru', skor, 0)) AS foulB
FROM nilai WHERE id_tanding = '$tanding->id_tanding' AND id_wasit = '$tanding->juri5' AND babak = $babak ")->row();
?>
<tr>
    <th rowspan="2">
        <center><b>JURI 5</b></center>
    </th>
    <th style="color: black; background-color: #ff00005e; font-size: x-large; font-weight: bolder;"><?= $juri5 ? $juri5->poinR : 0  ?></th>
    <th style="color: black; background-color: #ff00005e; font-size: x-large; font-weight: bolder;"><?= $juri5 ? $juri5->foulR : 0  ?></th>
    <th style="color: white; background-color: red; font-size: x-large; font-weight: bolder;"><?= $juri5 ? $juri5->poinR + $juri5->foulR : 0  ?></th>
</tr>
<tr>
    <th style="color: black; background-color: #0000f254; font-size: x-large; font-weight: bolder;"><?= $juri5 ? $juri5->poinB : 0  ?></th>
    <th style="color: black; background-color: #0000f254; font-size: x-large; font-weight: bolder;"><?= $juri5 ? $juri5->foulB : 0  ?></th>
    <th style="color: white; background-color: blue; font-size: x-large; font-weight: bolder;"><?= $juri5 ? $juri5->poinB + $juri5->foulB : 0  ?></th>
</tr>