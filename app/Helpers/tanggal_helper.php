<?php

if (!function_exists('bulan')) {
    function bulan($bulan)
    {
        $nama_bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        return $nama_bulan[$bulan];
    }
}

if (!function_exists('tanggal_indo')) {
    function tanggal_indo($tanggal)
    {
        return date('d/m/Y', strtotime($tanggal));
    }
}
