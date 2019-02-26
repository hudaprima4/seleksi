<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('tgl_indo')) {

    function tgl_indo($tgl) {
        if (empty($tgl)) {
            return '';
        } else {
            $dt = new DateTime($tgl);
            $d = $dt->format("Y-m-d");
            $tanggal_ = format_date($d, 'id');
            return $tanggal_;
        }
    }

}

if (!function_exists('date_for_filtering')) {

    function date_for_filtering($tgl) {
        if (empty($tgl)) {
            return '';
        } else {
            $dt = new DateTime($tgl);
            $d = $dt->format("m/d/Y");
            return $d;
        }
    }

}

if (!function_exists('bulan2')) {

    function bulan2($bln) {
        switch ($bln) {
            case "Januari":
                return 1;
                break;
            case "Februari":
                return 2;
                break;
            case "Maret":
                return 3;
                break;
            case "April":
                return 4;
                break;
            case "Mei":
                return 5;
                break;
            case "Juni":
                return 6;
                break;
            case "Juli":
                return 7;
                break;
            case "Agustus":
                return 8;
                break;
            case "September":
                return 9;
                break;
            case "Oktober":
                return 10;
                break;
            case "November":
                return 11;
                break;
            case "Desember":
                return 12;
                break;
        }
    }

}

if (!function_exists('bulan')) {

    function bulan($bln) {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }

}

if (!function_exists('nama_hari')) {

    function nama_hari($tanggal) {
        $ubah = gmdate($tanggal, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tgl = $pecah[2];
        $bln = $pecah[1];
        $thn = $pecah[0];

        $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
        $nama_hari = "";
        if ($nama == "Sunday") {
            $nama_hari = "Minggu";
        } else if ($nama == "Monday") {
            $nama_hari = "Senin";
        } else if ($nama == "Tuesday") {
            $nama_hari = "Selasa";
        } else if ($nama == "Wednesday") {
            $nama_hari = "Rabu";
        } else if ($nama == "Thursday") {
            $nama_hari = "Kamis";
        } else if ($nama == "Friday") {
            $nama_hari = "Jumat";
        } else if ($nama == "Saturday") {
            $nama_hari = "Sabtu";
        }
        return $nama_hari;
    }

}

if (!function_exists('hitung_mundur')) {

    function hitung_mundur($wkt) {
        $waktu = array(365 * 24 * 60 * 60 => "tahun",
            30 * 24 * 60 * 60 => "bulan",
            7 * 24 * 60 * 60 => "minggu",
            24 * 60 * 60 => "hari",
            60 * 60 => "jam",
            60 => "menit",
            1 => "detik");

        $hitung = strtotime(gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8)) - $wkt;
        $hasil = array();
        if ($hitung < 5) {
            $hasil = 'kurang dari 5 detik yang lalu';
        } else {
            $stop = 0;
            foreach ($waktu as $periode => $satuan) {
                if ($stop >= 6 || ($stop > 0 && $periode < 60))
                    break;
                $bagi = floor($hitung / $periode);
                if ($bagi > 0) {
                    $hasil[] = $bagi . ' ' . $satuan;
                    $hitung -= $bagi * $periode;
                    $stop++;
                } else if ($stop > 0)
                    $stop++;
            }
            $hasil = implode(' ', $hasil) . ' yang lalu';
        }
        return $hasil;
    }

}

if (!function_exists('relative_date')) {

    function relativate($secs) {
        $second = 1;
        $minute = 60;
        $hour = 60 * 60;
        $day = 60 * 60 * 24;
        $week = 60 * 60 * 24 * 7;
        $month = 60 * 60 * 24 * 7 * 30;
        $year = 60 * 60 * 24 * 7 * 30 * 365;

        if ($secs <= 0) {
            $output = "now";
        } elseif ($secs > $second && $secs < $minute) {
            $output = round($secs / $second) . " second";
        } elseif ($secs > $minute && $secs < $hour) {
            $output = round($secs / $minute) . " minute";
        } elseif ($secs > $hour && $secs < $day) {
            $output = round($secs / $hour) . " hour";
        } elseif ($secs > $day && $secs < $week) {
            $output = round($secs / $day) . " day";
        } elseif ($secs > $week && $secs < $month) {
            $output = round($secs / $week) . " week";
        } elseif ($secs > $month && $secs < $year) {
            $output = round($secs / $month) . " month";
        } elseif ($secs > $year && $secs < $year * 10) {
            $output = round($secs / $year) . " year";
        } else {
            $output = "more than a decade'";
        }

        if ($output <> "now") {
            $output = (substr($output, 0, 2) == "1 ") ? $output . " ago" : $output . "s ago";
        }return $output;
    }

    if (isset($_GET['secs'])) {
        echo relativate($_GET['secs']);
    }
}

