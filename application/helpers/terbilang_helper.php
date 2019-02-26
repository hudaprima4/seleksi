<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('number_to_words')) {

    function number_to_words($number) {
        $before_comma = trim(to_word($number));
        $after_comma = trim(comma($number));
        return ucwords($results = $before_comma . $after_comma . " Rupiah ");
    }

    function pecahBilangan($x) {
        $x=  abs($x);
        $kata = array('', 'satu ', 'dua ', 'tiga ', 'empat ', 'lima ', 'enam ', 'tujuh ', 'delapan ', 'sembilan ');
        $string = '';

        $angka = str_split($x);
        $n = count($angka);

        $ratusan = floor($x / 100);
        $x = $x % 100;

        if ($ratusan > 1)
            $string .= $kata[$ratusan] . "ratus ";
        else if ($ratusan == 1)
            $string .= "seratus ";

        $puluhan = floor($x / 10);

        $sebelas = 2;
        if ($puluhan == 1) {
            if ($angka[$n - 1] == 1 && $angka[$n - 2] == 1) {
                $sebelas = 1;
            }
        }

        $x = $x % 10;
        if ($puluhan > 1) {
            $string .= $kata[$puluhan] . "puluh ";
            $string .= $kata[$x];
        } else if (($puluhan == 1) && ($x == 0))
            $string .= $kata[$x] . "sepuluh ";
        else if (($puluhan == 1) && ($sebelas == 1))
            $string .= "sebelas ";
        else if (($puluhan == 1) && ($sebelas == 2))
            $string .= $kata[$x] . "belas ";
        else if ($puluhan == 0)
            $string .= $kata[$x];

        return $string;
    }

    function to_word($x) {
        //$this->auto_render = false;

        $x = number_format($x, 0, "", ".");
        $pecah = explode(".", $x);
        $string = "";

        for ($i = 0; $i <= count($pecah) - 1; $i++) {
            if ((count($pecah) - $i == 5) && ($pecah[$i] != 0))
                $string .= pecahBilangan($pecah[$i]) . "trilyun ";
            else if ((count($pecah) - $i == 4) && ($pecah[$i] != 0))
                $string .= pecahBilangan($pecah[$i]) . "milyar ";
            else if ((count($pecah) - $i == 3) && ($pecah[$i] != 0))
                $string .= pecahBilangan($pecah[$i]) . "juta ";
            else if ((count($pecah) - $i == 2) && ($pecah[$i] == 1))
                $string .= "seribu ";
            else if ((count($pecah) - $i == 2) && ($pecah[$i] != 0))
                $string .= pecahBilangan($pecah[$i]) . "ribu ";
            else if ((count($pecah) - $i == 1) && ($pecah[$i] != 0))
                $string .= pecahBilangan($pecah[$i]);
        }
        $out = strtoupper($string);
        $out.= ($string) ? "RUPIAH" : "NOL RUPIAH";
        return $out;
    }

    function to_word2($number) {
        $words = "";
        $arr_number = array(
            "",
            "satu",
            "dua",
            "tiga",
            "empat",
            "lima",
            "enam",
            "tujuh",
            "delapan",
            "sembilan",
            "sepuluh",
            "sebelas");

        if ($number < 12) {
            $words = " " . $arr_number[$number];
        } else if ($number < 20) {
            $words = to_word($number - 10) . " belas";
        } else if ($number < 100) {
            $words = to_word($number / 10) . " puluh " . to_word($number % 10);
        } else if ($number < 200) {
            $words = "seratus " . to_word($number - 100);
        } else if ($number < 1000) {
            $words = to_word($number / 100) . " ratus " . to_word($number % 100);
        } else if ($number < 2000) {
            $words = "seribu " . to_word($number - 1000);
        } else if ($number < 1000000) {
            $words = to_word($number / 1000) . " ribu " . to_word($number % 1000);
        } else if ($number < 1000000000) {
            $words = to_word($number / 1000000) . " juta " . to_word($number % 1000000);
        } else if ($number < 1000000000000) {
            $words = to_word($number / 1000000000) . " miliyar " . to_word($number % 1000000000);
        } else {
            $words = "undefined";
        }
        return $words;
    }

    function comma($number) {
        $after_comma = stristr($number, ',');
        $arr_number = array(
            "nol",
            "satu",
            "dua",
            "tiga",
            "empat",
            "lima",
            "enam",
            "tujuh",
            "delapan",
            "sembilan");

        $results = "";
        $length = strlen($after_comma);
        $i = 1;
        while ($i < $length) {
            $get = substr($after_comma, $i, 1);
            $results .= " " . $arr_number[$get];
            $i++;
        }
        return $results;
    }

    function format_date($time, $lang) {

        if ($time != "") {
            $temp_time = $time;

            if ($lang == '') {
                $lang = 'id';
            } else {
                $lang = $lang;
            }

            $exploding = explode("-", $time);

            $numm = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');

            $month_id = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                'September', 'Oktober', 'November', 'Desember');

            $month_en = array('January', 'February', 'March', 'April', 'Mey', 'June', 'July', 'August',
                'September', 'October', 'November', 'December');

            if ($lang == 'id') {

                for ($i = 0; $i <= 11; $i++) {

                    if ($exploding[1] == $numm[$i]) {

                        $time = $exploding[2] . ' ' . $month_id[$i] . ' ' . $exploding[0];
                    }
                }
            }

            if ($lang == 'en') {

                for ($i = 0; $i <= 11; $i++) {

                    if ($exploding[1] == $numm[$i]) {

                        $time = $exploding[2] . ' ' . $month_en[$i] . ' ' . $exploding[0];
                    }
                }
            }
        } else {
            $time = " ";
        }
        return $time;
    }

    function titleCase($string, $delimiters = array(" ", "-", ".", "'", "O'", "Mc"), $exceptions = array("and", "to", "of", "das", "dos", "I", "II", "III", "IV", "V", "VI", "dan", "SiLPA", "dr", "Dr.", "RSUD", "RSJD", "RM", "SKPKD", "DPRD", "yang", "atau", "dari", "sah")) {
        $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
        foreach ($delimiters as $dlnr => $delimiter) {
            $words = explode($delimiter, $string);
            $newwords = array();
            foreach ($words as $wordnr => $word) {
                if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtoupper($word, "UTF-8");
                } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtolower($word, "UTF-8");
                } elseif (!in_array($word, $exceptions)) {
                    // convert to uppercase (non-utf8 only)
                    $word = ucfirst($word);
                }
                array_push($newwords, $word);
            }
            $string = join($delimiter, $newwords);
        }//foreach
        return $string;
    }

    function konversi_nip($nip, $batas = " ") {
        $nip = trim($nip, " ");
        $panjang = strlen($nip);

        if ($panjang == 18) {
            $sub[] = substr($nip, 0, 8); // tanggal lahir
            $sub[] = substr($nip, 8, 6); // tanggal pengangkatan
            $sub[] = substr($nip, 14, 1); // jenis kelamin
            $sub[] = substr($nip, 15, 3); // nomor urut

            return $sub[0] . $batas . $sub[1] . $batas . $sub[2] . $batas . $sub[3];
        } elseif ($panjang == 15) {
            $sub[] = substr($nip, 0, 8); // tanggal lahir
            $sub[] = substr($nip, 8, 6); // tanggal pengangkatan
            $sub[] = substr($nip, 14, 1); // jenis kelamin

            return $sub[0] . $batas . $sub[1] . $batas . $sub[2];
        } elseif ($panjang == 9) {
            $sub = str_split($nip, 3);

            return $sub[0] . $batas . $sub[1] . $batas . $sub[2];
        } else {
            return $nip;
        }
    }

    function number_format2($number) {
        if ($number < 0) {
            $koma = substr($number, strpos($number, ".") + 1);
            $hasil_koma = substr($koma, 0, 2);
            $nilai = substr($number, 0, strpos($number, '.'));
            $final = $nilai . "." . $hasil_koma;
            return $final;
        } else if ($number > 0) {
            $final = number_format($number, 2, '.', ',');
            return $final;
        } else {
            $final = 0;
            return $final;
        }
    }

}
