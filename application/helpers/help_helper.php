<?php
function translateDay($englishDay, $language)
{
    $translations = array(
        "Sunday" => array(
            "id" => "Ahad",
            "es" => "Domingo",
            // Tambahkan terjemahan ke bahasa lain di sini
        ),
        "Monday" => array(
            "id" => "Senin",
            "es" => "Lunes",
            // Tambahkan terjemahan ke bahasa lain di sini
        ),
        "Tuesday" => array(
            "id" => "Selasa",
            "es" => "Martes",
            // Tambahkan terjemahan ke bahasa lain di sini
        ),
        "Wednesday" => array(
            "id" => "Rabu",
            "es" => "Miércoles",
            // Tambahkan terjemahan ke bahasa lain di sini
        ),
        "Thursday" => array(
            "id" => "Kamis",
            "es" => "Jueves",
            // Tambahkan terjemahan ke bahasa lain di sini
        ),
        "Friday" => array(
            "id" => "Jum'at",
            "es" => "Viernes",
            // Tambahkan terjemahan ke bahasa lain di sini
        ),
        "Saturday" => array(
            "id" => "Sabtu",
            "es" => "Sábado",
            // Tambahkan terjemahan ke bahasa lain di sini
        )
    );

    return $translations[$englishDay][$language] ?? $englishDay;
}

function bulan($bulan)
{
    switch ($bulan) {
        case 0:
            $bulan = "";
            break;
        case 1:
            $bulan = "Januari";
            break;
        case 2:
            $bulan = "Februari";
            break;
        case 3:
            $bulan = "Maret";
            break;
        case 4:
            $bulan = "April";
            break;
        case 5:
            $bulan = "Mei";
            break;
        case 6:
            $bulan = "Juni";
            break;
        case 7:
            $bulan = "Juli";
            break;
        case 8:
            $bulan = "Agustus";
            break;
        case 9:
            $bulan = "September";
            break;
        case 10:
            $bulan = "Oktober";
            break;
        case 11:
            $bulan = "November";
            break;
        case 12:
            $bulan = "Desember";
            break;
        default:
            $bulan = Date('F');
            break;
    }
    return $bulan;
}

function colorCell($grid)
{
    if ($grid > 48) {
        return '990000';
    } elseif ($grid > 24 && $grid <= 48) {
        return 'FF0000';
    } elseif ($grid > 16 && $grid <= 24) {
        return 'FFFF00';
    } elseif ($grid > 8 && $grid <= 16) {
        return '009999';
    } elseif ($grid > 0 && $grid <= 8) {
        return '0099FF';
    } elseif ($grid < 1) {
        return 'FFFFFF';
    }
}

function jenkel($jkl)
{
    if ($jkl == 'Laki-laki') {
        $jen = 'Putra';
    } else {
        $jen = 'Putri';
    }

    return $jen;
}

function random($panjang)
{
    // $karakter = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $karakter = '0123456789';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
        $pos = rand(0, strlen($karakter) - 1);
        $string .= $karakter[$pos];
    }
    return $string;
}


function calculate_standard_deviation($numbers)
{
    $n = count($numbers);
    if ($n == 0) {
        return 0;
    }

    // Hitung rata-rata
    $mean = array_sum($numbers) / $n;

    // Hitung variansi
    $variance = 0.0;
    foreach ($numbers as $number) {
        $variance += pow($number - $mean, 2);
    }
    $variance /= ($n - 1); // Menggunakan n-1 untuk sampel

    // Hitung standar deviasi
    $standard_deviation = sqrt($variance);

    return $standard_deviation;
}

function pembulatan($angka)
{
    return number_format(round($angka, 2), 2);
}


function kalkulasiWaktu_detik($mulai, $selesai)
{
    // Konversi string datetime menjadi objek DateTime
    $date1 = new DateTime($mulai);
    $date2 = new DateTime($selesai);

    // Hitung selisih waktu
    $interval = $date1->diff($date2);

    // Konversi selisih waktu ke detik
    $secondsDifference = ($interval->days * 24 * 60 * 60) +
        ($interval->h * 60 * 60) +
        ($interval->i * 60) +
        $interval->s;

    return $secondsDifference;
}

function convertDetiksKeMenit($seconds)
{
    $minutes = floor($seconds / 60);
    $remainingSeconds = $seconds % 60;

    // Format hasil dalam mm:ss
    return sprintf('%02d:%02d', $minutes, $remainingSeconds);
}
