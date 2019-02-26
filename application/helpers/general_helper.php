<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/*
  |--------------------------------------------------------------------------
  | function of path css
  |--------------------------------------------------------------------------
 */
if (!function_exists('path_css')) {

    function css($file = '') {
        $CI = & get_instance();
        echo $CI->config->item('path_css') . $file;
    }

}

/*
  |--------------------------------------------------------------------------
  | function of path javascript
  |--------------------------------------------------------------------------
 */
if (!function_exists('path_js')) {

    function js($file = '') {
        $CI = & get_instance();
        echo $CI->config->item('path_js') . $file;
    }

}

/*
  |--------------------------------------------------------------------------
  | function of path images
  |--------------------------------------------------------------------------
 */
if (!function_exists('path_img')) {

    function image($file = '') {
        $CI = & get_instance();
        echo $CI->config->item('path_img') . $file;
    }

}

/*
  |--------------------------------------------------------------------------
  | function of path uploads
  |--------------------------------------------------------------------------
 */
if (!function_exists('path_upload')) {

    function path_upload($file = '') {
        $CI = & get_instance();
        echo $CI->config->item('path_upload') . $file;
    }

}

/*
  |--------------------------------------------------------------------------
  | function of name system
  |--------------------------------------------------------------------------
 */
if (!function_exists('system_name')) {

    function system_name($descript = '') {
        $CI = & get_instance();
        if ($descript != '') {
            return $CI->config->item('name_system') . ' - ' . $descript;
        }
        return $CI->config->item('name_system');
    }

}

/*
  |--------------------------------------------------------------------------
  | function of company
  |--------------------------------------------------------------------------
 */
if (!function_exists('company')) {

    function company() {
        $CI = & get_instance();
        return $CI->config->item('company');
    }

}
/*
  |--------------------------------------------------------------------------
  | function of print_r_pre
  |--------------------------------------------------------------------------
 */

/**
 *
 * @param array/object $data data yang akan ditampilkan
 */
if (!function_exists('print_r_pre')) {

    function print_r_pre($data = '', $die = false) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        if ($die)
            die();
    }

}

/*
  |--------------------------------------------------------------------------
  | function of Address
  |--------------------------------------------------------------------------
 */
if (!function_exists('address')) {

    function address() {
        $CI = & get_instance();
        return $CI->config->item('address');
    }

}

/*
  |--------------------------------------------------------------------------
  | function of telepon
  |--------------------------------------------------------------------------
 */
if (!function_exists('telepon')) {

    function telepon() {
        $CI = & get_instance();
        return $CI->config->item('telepon');
    }

}

/*
  |--------------------------------------------------------------------------
  | function of version
  |--------------------------------------------------------------------------
 */
if (!function_exists('version')) {

    function version() {
        $CI = & get_instance();
        return $CI->config->item('version');
    }

}


/*
  |--------------------------------------------------------------------------
  | function of developer
  |--------------------------------------------------------------------------
 */
if (!function_exists('developer')) {

    function developer() {
        $CI = & get_instance();
        return $CI->config->item('developer');
    }

}

/*
  |--------------------------------------------------------------------------
  | function of telepon
  |--------------------------------------------------------------------------
 */
if (!function_exists('telepon')) {

    function telepon() {
        $CI = & get_instance();
        return $CI->config->item('telepon');
    }

}

/**
 * -----------------------------------------------------------------------------
 * fungsi filter data
 * -----------------------------------------------------------------------------
 */
if (!function_exists('filter_data')) {

    function filter_data($data) {
        $data = trim($data);
        $back = strtoupper(stripslashes(strip_tags($data, ENT_QUOTES)));
        return $back;
    }

}

if (!function_exists('filter_numeric')) {

    function filter_numeric($no = '') {
        $no = str_replace(',', '', $no);
        $nomor = filter_data($no);
        if ($no == '') {
            return 0;
        }
        return $nomor;
    }

}

if (!function_exists('sentence_case')) {

    function sentence_case($string) {
        $sentences = preg_split('/([.?!]+)/', $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $new_string = '';
        foreach ($sentences as $key => $sentence) {
            $new_string .= ($key & 1) == 0 ?
                    ucfirst(strtolower(trim($sentence))) :
                    $sentence . ' ';
        }
        return trim($new_string);
    }

}

if (!function_exists('random_string')) {

    function random_string($str = "") {
        //$pengacak = "AJWKXLAJSCLWLWDAKDKSAJDADKEOIJEOQWENQWENQONEQWAJSNDKASO";
        $passEnkrip = md5($str);
        return $passEnkrip;
    }

}

if (!function_exists("format_idr")) {

    function format_idr($angka = '', $format = false) {
        $format = $format ? ',00' : '';
        if (strlen($angka) > 0) {
            return number_format($angka, 0, ',', '.') . $format;
        } else {
            return '0' . $format;
        }
    }

}

if (!function_exists("format_idr_excel")) {

    function format_idr_excel($angka = '', $format = false) {
        $format = $format ? ',00' : '';
        if (strlen($angka) > 0) {
            return number_format($angka, 0, '.', ',') . $format;
        } else {
            return '0' . $format;
        }
    }

}

if (!function_exists("format_idr_minus")) {

    function format_idr_minus($angka = '', $format = false, $no = 0) {
        $format = $format ? ',00' : '';
        if (strlen($angka) > 0) {
            if (substr(strval($angka), 0, 1) == "-") {
                return '(' . number_format(abs($angka), $no, ',', '.') . $format . ')';
            } else {
                return number_format($angka, $no, ',', '.') . $format;
            }
        } else {
            return '0' . $format;
        }
    }

}

if (!function_exists("format_angka")) {

    function format_angka($angka) {
        if (strlen($angka) > 0) {
            return number_format($angka, 0, ',', '.');
        } else {
            return '0';
        }
    }

}

if (!function_exists('enkripsi_numeric')) {

    function enkripsi_numeric($string = '') {
        $string = filter_numeric($string);
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, ENCRYPTION_KEY, $string, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }

}

if (!function_exists('enkripsi')) {

    function enkripsi($id) {
        $CI = & get_instance();
        $CI->load->library('encrypt');
        return $CI->encrypt->encode($id);
    }

}

if (!function_exists('dekripsi')) {

    function dekripsi($id) {
        $CI = & get_instance();
        $CI->load->library('encrypt');
        return $CI->encrypt->decode($id);
    }

}

if (!function_exists('dekripsi_numeric')) {

    function dekripsi_numeric($string = '') {
        $string = filter_numeric($string);
        if (strlen($string) > 1) {
            return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, ENCRYPTION_KEY, base64_decode($string), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
        } else {
            return $string;
        }
    }

}

if (!function_exists('gender')) {

    function gender($type = '') {
        if ($type == '') {
            $data = array(
                '' => '-- Pilih --',
                'L' => 'Laki - Laki',
                'P' => 'Perempuan'
            );
        } else {
            switch ($type) {
                case 'L' : $data = 'Laki - Laki';
                    break;
                case 'P' : $data = 'Perempuan';
                    break;
                default : $data = "";
            }
        }
        return $data;
    }

}

if (!function_exists('kebangsaan')) {

    function kebangsaan($type = '') {
        if ($type == '') {
            $data = array(
                '' => '-- Pilih --',
                'WNI' => 'Indonesia',
                'WNA' => 'Orang Asing'
            );
        } else {
            switch ($type) {
                case 'WNI' : $data = 'Indonesia';
                    break;
                case 'WNA' : $data = 'Orang Asing';
                    break;
                default : $data = "";
            }
        }
        return $data;
    }

}

if (!function_exists('pendidikan')) {

    function pendidikan($type = '') {
        $data = array(
            '' => '-- Pilih --',
            'SD' => 'SD',
            'SMP' => 'SMP',
            'SMA' => 'SMA',
            'SMK' => 'SMK',
            'D I' => 'D I',
            'D II' => 'D II',
            'D III' => 'D III',
            'S1' => 'S1',
            'S2' => 'S2',
            'S3' => 'S3'
        );
        return $data;
    }

}

if (!function_exists("gol_darah")) {

    function gol_darah() {
        $data = array(
            '' => '-- Pilih --',
            'O' => 'Gol. O',
            'A' => 'Gol. A',
            'B' => 'Gol. B',
            'AB' => 'Gol. AB'
        );
        return $data;
    }

}

if (!function_exists("marital")) {

    function marital($kode = '') {
        if ($kode == '') {
            $data = array(
                '' => '-- Pilih --',
                'KW' => 'Kawin',
                'BK' => 'Belum Kawin',
                'JN' => 'Janda',
                'DD' => 'Duda'
            );
        } else {
            switch ($kode) {
                case 'KW' : $data = 'Kawin';
                    break;
                case 'BK' : $data = 'Belum Kawin';
                    break;
                case 'JN' : $data = 'Janda';
                    break;
                case 'DD' : $data = 'Duda';
                    break;
                default : $data = "";
            }
        }
        return $data;
    }

}

if (!function_exists("agama")) {

    function agama() {
        $data = array(
            '' => '-- Pilih --',
            'ISLAM' => 'Islam',
            'KRISTEN' => 'kristen',
            'KATHOLIK' => 'Katholik',
            'HINDU' => 'Hindu',
            'BUDHA' => 'Budha'
        );
        return $data;
    }

}

if (!function_exists('dateToIndo')) {

    function dateToIndo($date = '') {
        $pecah = explode('-', $date);
        if (count($pecah) > 2) {
            $getDate = $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
        } else {
            $getDate = $date;
        }
        return $getDate;
    }

}

if (!function_exists("data_404")) {

    function data_404() {
        echo "<h2>Data Not Found</h2>";
    }

}

if (!function_exists('date_differ')) {

    function date_differ($data = array()) {
        if (is_array($data)) {
            $date_diff = (strtotime($data[0]) - strtotime($data[1])) / 86400;
        } else {
            $date_diff = "0";
        }
        return $date_diff;
    }

}

if (!function_exists('session')) {

    function session($name) {
        $CI = & get_instance();
        return $CI->session->userdata($name);
    }

}

if (!function_exists('status')) {

    function status($status) {
        if ($status == 'sesuai') {
            echo "Sudah LPJ";
        } else {
            echo "Belum LPJ";
        }
    }

}

if (!function_exists('get_user')) {

    function get_user() {
        $CI = & get_instance();
        return $CI->session->userdata('user');
    }

}

if (!function_exists('qrcode')) {

    function qrcode($data) {
        $data = ($data ? $data : 'www.grms.jatengprov.go.id');
        $size = '150x150';
        $logo = 'https://1.bp.blogspot.com/-wZVjzhJrYc0/UmgpGX_N5-I/AAAAAAAADFI/mklbUfdi7nI/s1600/Loog-propinsi-jawa-tengah-transparent-background.png';
/*         header('Content-type: image/png');
        $QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs=' . $size . '&chl=' . $data);
        if ($logo !== FALSE) {
            $logo = imagecreatefromstring(file_get_contents($logo));
            $QR_width = imagesx($QR);
            $QR_height = imagesy($QR);

            $logo_width = imagesx($logo);
            $logo_height = imagesy($logo);

            $logo_qr_width = $QR_width / 3;
            $scale = $logo_width / $logo_qr_width;
            $logo_qr_height = $logo_height / $scale;

            imagecopyresampled($QR, $logo, $QR_width / 3, $QR_height / 3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        }
        imagepng($QR);
        imagedestroy($QR); */
		
		return 'https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs=' . $size . '&chl=' . $data;
    }

}

if (!function_exists('get_bulan')) {

    function get_bulan($single = false) {
        $data = array(
            "" => "Pilih Bulan",
            "1" => "Januari",
            "2" => "Februari",
            "3" => "Maret",
            "4" => "April",
            "5" => "Mei",
            "6" => "Juni",
            "7" => "Juli",
            "8" => "Agustus",
            "9" => "September",
            "10" => "Oktober",
            "11" => "November",
            "12" => "Desember"
        );
        return (!$single) ? $data : $data[$single];
    }

}

if (!function_exists('get_pajak')) {

    function get_pajak() {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("select * from master_jenis_pajak");
        $data = array();
        if ($sql->num_rows() == 0) {
            $data[''] = "Data Pajak Kosong";
        } else {
            $data[''] = "Pilih Pajak";
            foreach ($sql->result() as $row) {
                $data[$row->uniq_kode] = $row->uraian_rekening;
            }
        }
        return $data;
    }

}

if (!function_exists('get_skpd_id')) {

    function get_skpd_id($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT
            *
        FROM
            kr_organisasi
        WHERE
            org_key = (
                SELECT
                    CASE
                WHEN kr_organisasi.parent_id IS NULL THEN
                    kr_organisasi.org_key
                ELSE
                    kr_organisasi.parent_id
                END AS org_key
                FROM
                    view_login_organisasi
                LEFT JOIN kr_organisasi ON kr_organisasi.org_key = view_login_organisasi.kr_organisasi_org_key
                WHERE
                    \"name\" = '$nip'
                GROUP BY
                    CASE
                WHEN kr_organisasi.parent_id IS NULL THEN
                    kr_organisasi.org_key
                ELSE
                    kr_organisasi.parent_id
                END
            )
        OR parent_id = (
            SELECT
                CASE
            WHEN kr_organisasi.parent_id IS NULL THEN
                kr_organisasi.org_key
            ELSE
                kr_organisasi.parent_id
            END AS org_key
            FROM
                view_login_organisasi
            LEFT JOIN kr_organisasi ON kr_organisasi.org_key = view_login_organisasi.kr_organisasi_org_key
            WHERE
                \"name\" = '$nip'
            GROUP BY
                CASE
            WHEN kr_organisasi.parent_id IS NULL THEN
                kr_organisasi.org_key
            ELSE
                kr_organisasi.parent_id
            END
        )
        AND uraian != 'Sekretaris'
        ORDER BY org_key");
        $data = array();
        if ($sql->num_rows() == 0) {
            $data[''] = "Data SKPD Masih Kosong";
        } else {
            $data[''] = "Semua Unit";
            foreach ($sql->result() as $row) {
                $data[enkripsi($row->org_key)] = $row->uraian;
            }
        }
        return $data;
    }

}

if (!function_exists('get_skpd')) {

    function get_skpd($encrypted = false, $bud = false) {
        $CI = & get_instance();
        $CI->load->database();
        $query = "SELECT * FROM kr_organisasi WHERE parent_id IS NULL ORDER BY uraian asc";
        if ($bud) {
            $query = "SELECT * FROM kr_organisasi WHERE parent_id IS NULL
                    AND org_key IN(
                        SELECT kr_organisasi_org_key FROM bud_organisasi WHERE nip = '$bud'
                    )";
        }
        $sql = $CI->db->query($query);
        $data = array();
        if ($sql->num_rows() == 0) {
            $data[''] = "Anda Belum Mengampu SKPD";
        } else {
            $data['0'] = "Semua SKPD";
            foreach ($sql->result() as $row) {
                $index = $encrypted ? enkripsi($row->org_key) : $row->org_key;
                $data[$index] = $row->uraian;
            }
        }
        return $data;
    }

}

if (!function_exists('get_skpd_jurnal_koreksi')) {

    function get_skpd_jurnal_koreksi($encrypted = false, $akuntansi = false) {
        $CI = & get_instance();
        $CI->load->database();
        $query = "SELECT * FROM kr_organisasi WHERE parent_id IS NULL ORDER BY uraian asc";
        if ($akuntansi) {
            $query = "SELECT * FROM kr_organisasi WHERE parent_id IS NULL
                    AND org_key IN(
                        SELECT kr_organisasi_org_key FROM akuntansi_organisasi WHERE nip = '$akuntansi'
                    )";
        }
        $sql = $CI->db->query($query);
        $data = array();
        if ($sql->num_rows() == 0) {
            $data[''] = "Anda Belum Mengampu SKPD";
        } else {
            $data['0'] = "Semua SKPD";
            foreach ($sql->result() as $row) {
                $index = $encrypted ? enkripsi($row->org_key) : $row->org_key;
                $data[$index] = $row->uraian;
            }
        }
        return $data;
    }

}

if (!function_exists('get_skpdnya')) {

    function get_skpdnya() {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                    *
            FROM
                    kr_organisasi
            WHERE
                    uraian NOT ILIKE'Sekretaris%'
                    AND parent_id IS NULL
                    AND org_key NOT IN (26, 29, 1093, 1094)
            ORDER BY
                    uraian");
        return $sql->result();
    }

}

if (!function_exists('get_unit')) {

    function get_unit($parent) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                *
            FROM
                kr_organisasi
            WHERE
                (org_key = $parent OR parent_id = $parent)
            AND uraian NOT ILIKE 'Sekretaris%'
            ORDER BY
                org_key;");
        $data = array();
        if ($sql->num_rows() == 0) {
            $data[''] = "Data Unit Masih Kosong";
        } else {
            $data = $sql->result();
        }
        return $data;
    }

}

if (!function_exists('get_nama_skpd')) {

    function get_nama_skpd($parent_id) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT uraian FROM kr_organisasi WHERE org_key = '$parent_id' LIMIT 1");
        if ($sql->num_rows() > 0) {
            return $sql->row()->uraian;
        } else {
            return false;
        }
    }

}
if (!function_exists('get_nama_unit')) {

    function get_nama_unit($korg) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT uraian FROM kr_organisasi WHERE org_key = '$korg' LIMIT 1");
        if ($sql->num_rows() > 0) {
            return $sql->row()->uraian;
        } else {
            return false;
        }
    }

}


if (!function_exists('get_sub_unit')) {

    function get_sub_unit($id, $encrypted = false) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT *
                FROM kr_organisasi
                WHERE org_key = '$id'
                OR parent_id = '$id'
                AND uraian !='Sekretaris'
                ORDER BY org_key");
        $data = array();
        if ($sql->num_rows() == 0) {
            $data['0'] = "Data Unit Masih Kosong";
        } else {
            $indexs = $encrypted ? enkripsi(0) : 0;
            $data[$indexs] = "Semua Unit";
            foreach ($sql->result() as $row) {
                $index = $encrypted ? enkripsi($row->org_key) : $row->org_key;
                $data[$index] = $row->uraian;
            }
        }
        return $data;
    }

}


if (!function_exists('get_sub_unit_cp')) {

    function get_sub_unit_cp($id, $encrypted = false) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT *
                FROM kr_organisasi
                WHERE org_key = '$id'
                OR parent_id = '$id'
                AND uraian !='Sekretaris'
                ORDER BY org_key");
        $data = array();
        if ($sql->num_rows() == 0) {
            $data['0'] = "Data Unit Masih Kosong";
        } else {
            $indexs = $encrypted ? enkripsi(0) : 0;
            $data[$indexs] = "Semua Unit";
            foreach ($sql->result() as $row) {
                $index = $encrypted ? enkripsi($row->org_key) : $row->org_key;
                $data[$index] = $row->uraian;
            }
        }
        return $data;
    }

}

if (!function_exists('get_sub_unit_new')) {

    function get_sub_unit_new($id, $encrypted = false) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT *
                FROM kr_organisasi
                WHERE org_key = '$id'
                OR parent_id = '$id'
                AND uraian != 'Sekretaris'
                ORDER BY org_key");
        $data = array();
        if ($sql->num_rows() == 0) {
            $data['0'] = "Data Unit Masih Kosong";
        } else {
            $indexs = $encrypted ? enkripsi(0) : 0;
            foreach ($sql->result() as $row) {
                $index = $encrypted ? enkripsi($row->org_key) : $row->org_key;
                $data[$index] = $row->uraian;
            }
        }
        return $data;
    }

}

if (!function_exists('get_program_id')) {

    function get_program_id($id, $encrypted = false, $head = false) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT
            kr_program.prog_key AS kode,
            kr_program.uraian
        FROM
                kr_program
        LEFT JOIN kr_kegiatan ON kr_program.prog_key = kr_kegiatan.kr_program_prog_key
        LEFT JOIN org_keg ON kr_kegiatan.keg_key = org_keg.kr_kegiatan_keg_key
        LEFT JOIN kr_organisasi ON org_keg.kr_organisasi_org_key = kr_organisasi.org_key
        WHERE
                org_keg.kr_organisasi_org_key = '$id'
        AND kdtahap = '" . TAHAP . "'
        AND tahun_anggaran = '" . TAHUN . "'
        AND org_keg.pagu != 0
        GROUP BY
                kr_program.uraian,
                kr_program.prog_key
        ORDER BY
            kr_program.prog_key ASC");
        $data = array();
        if ($sql->num_rows() == 0) {
            $data[''] = "Data Program Masih Kosong";
        } else {
            $head ? $data[''] = "Pilih Program" : "";
            foreach ($sql->result() as $row) {
                $index = $encrypted ? enkripsi($row->kode) : $row->kode;
                $data[$index] = $row->uraian;
            }
        }
        return $data;
    }

}

if (!function_exists('get_kegiatan_id')) {

    function get_kegiatan_id($org, $prog) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT
            kr_program.prog_key AS kode,
            kr_program.uraian,
                        kr_kegiatan.keg_key AS keg_key,
                        kr_kegiatan.uraian AS uraian_kegiatan
                    FROM
                            kr_program
                    JOIN kr_kegiatan ON kr_program.prog_key = kr_kegiatan.kr_program_prog_key
                    JOIN org_keg ON kr_kegiatan.keg_key = org_keg.kr_kegiatan_keg_key
                    JOIN kr_organisasi ON org_keg.kr_organisasi_org_key = kr_organisasi.org_key
                    WHERE
                            kr_organisasi.org_key = '$org' AND prog_key=$prog
                    GROUP BY
                            kr_program.uraian,
                            kr_program.prog_key,
                            kr_kegiatan.keg_key,
                            kr_kegiatan.uraian
                    ORDER BY
                            kr_program.prog_key ASC");
        $data = array();
        if ($sql->num_rows() == 0) {
            $data[''] = "Data Kegiatan Masih Kosong";
        } else {
            $data[''] = "Pilih Kegiatan";
            foreach ($sql->result() as $row) {
                $data[$row->keg_key] = $row->uraian_kegiatan;
            }
        }
        return $data;
    }

}

if (!function_exists('get_bank')) {

    function get_bank($id = false) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT * FROM master_bank");
        $data = array();
        if ($sql->num_rows() == 0) {
            $data[''] = "Data Bank Masih Kosong";
        } else {
            $data[''] = "Pilih Bank";
            foreach ($sql->result() as $row) {
                if ($id == true) {
                    $data[enkripsi($row->uniq_kode)] = $row->uraian;
                } else {
                    $data[enkripsi($row->uraian)] = $row->uraian;
                }
            }
        }
        return $data;
    }

}

if (!function_exists('get_bank1')) {

    function get_bank1($id = false) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT * FROM master_bank");
        $data = array();
        if ($sql->num_rows() == 0) {
            $data[''] = "Data Bank Masih Kosong";
        } else {
            $data[''] = "Pilih Bank";
            foreach ($sql->result() as $row) {
                if ($id == true) {
                    $data[$row->uniq_kode] = $row->uraian;
                } else {
                    $data[$row->uraian] = $row->uraian;
                }
            }
        }
        return $data;
    }

}


if (!function_exists('get_bank_uniq_kode')) {

    function get_bank_uniq_kode() {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT * FROM master_bank");
        $data = array();
        if ($sql->num_rows() == 0) {
            $data[''] = "Data Bank Masih Kosong";
        } else {
            $data[''] = "Pilih Bank";
            foreach ($sql->result() as $row) {
                $data[$row->uniq_kode] = $row->uraian;
            }
        }
        return $data;
    }

}


if (!function_exists('get_bank_uniq_kode_enkripsi')) {

    function get_bank_uniq_kode_enkripsi() {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT * FROM master_bank");
        $data = array();
        if ($sql->num_rows() == 0) {
            $data[''] = "Data Bank Masih Kosong";
        } else {
            $data[''] = "Pilih Bank";
            foreach ($sql->result() as $row) {
                $data[enkripsi($row->uniq_kode)] = $row->uraian;
            }
        }
        return $data;
    }

}

if (!function_exists('get_bank_id')) {

    function get_bank_id($id) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT uraian FROM master_bank WHERE uniq_kode='$id' LIMIT 1");
        if ($sql->num_rows() == 0) {
            $data = "Data Bank Masih Kosong";
        } else {
            foreach ($sql->result() as $row) {
                $data = $row->uraian;
            }
        }
        return $data;
    }

}

if (!function_exists('get_jenis_bpen')) {

    function get_jenis_bpen() {
        return array('1' => 'Bukti Pajak', '2' => 'Bukti Retribusi', '3' => 'Bukti PAD Lain', '4' => 'Bukti Tanpa Ketetapan');
    }

}

if (!function_exists('get_jenis_sp2d')) {

    function get_jenis_sp2d() {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT * FROM kr_organisasi WHERE kd_jns_organisasi = '5' AND parent_id = " . session('kr_organisasi_org_key') . "");
        if ($sql->num_rows() > 0) {
            return array(
                '0' => 'Jenis',
                'gu' => 'GU',
                'tu_nihil' => 'TU NIHIL',
                'ls_pegawai' => 'LS Pegawai',
                'ls_brg_js' => 'LS Barang Jasa',
                'sts_pendapatan' => 'STS');
        } else if (get_user() == 'ppk' AND session('kr_organisasi_org_key') != '26') {
            return array(
                '0' => 'Jenis',
                'gu' => 'GU',
                'tu_nihil' => 'TU NIHIL',
                'gu_nihil' => 'GU NIHIL',
                'ls_pegawai' => 'LS Pegawai',
                'ls_brg_js' => 'LS Barang Jasa',
                'sts_pendapatan' => 'STS');
        } else if (session('kr_organisasi_org_key') == '26') {
            return array(
                '0' => 'Jenis',
                'ls_skpkd_btl' => 'LS SKPKD BTL',
                'ls_skpkd_pembiayaan' => 'LS SKPKD PEMBIAYAAN');
        }
    }

}


if (!function_exists('get_jenis_sp2d_cp')) {

    function get_jenis_sp2d_cp() {
        if (get_user() == 'bp') {
            return array(
                '0' => 'Jenis',
                'gu' => 'GU',
                'tu_nihil' => 'TU NIHIL',
                'ls_pegawai' => 'LS Pegawai',
                'ls_brg_js' => 'LS Barang Jasa');
        } else if (session('kr_organisasi_org_key') == '26') {
            return array(
                '0' => 'Jenis',
                'ls_skpkd_btl' => 'LS SKPKD BTL',
                'ls_skpkd_pembiayaan' => 'LS SKPKD PEMBIAYAAN');
        }
    }

}

if (!function_exists('get_jenis_sp2d_jurnal_koreksi')) {

    function get_jenis_sp2d_jurnal_koreksi() {
        return array('0' => 'Pilih Jenis SP2D', 'up' => 'UP', 'gu' => 'GU', 'tu_nihil' => 'TU Nihil', 'ls_pegawai' => 'LS Pegawai', 'ls_brg_js' => 'LS Barang Jasa', 'ls_skpkd' => 'LS SKPKD', 'ls_blud' => 'LS BLUD');
    }

}

if (!function_exists('get_perusahaan')) {

    function get_perusahaan() {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT * FROM bentuk_perusahaan");
        $data = array();
        if ($sql->num_rows() == 0) {
            $data[''] = "Data Bentuk Perusahaan Masih Kosong";
        } else {
            $data[''] = "Pilih Bentuk Perusahaan";
            foreach ($sql->result() as $row) {
                $data[enkripsi($row->uniq_kode)] = $row->uraian_bentuk_perusahaan;
            }
        }
        return $data;
    }

}

if (!function_exists('get_bank_id')) {

    function get_perusahaan_id($id) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT uraian FROM bentuk_perusahaan WHERE uniq_kode='$id' LIMIT 1");
        if ($sql->num_rows() == 0) {
            $data = "Data Bentuk Perusahaan Masih Kosong";
        } else {
            foreach ($sql->result() as $row) {
                $data = $row->uraian_bentuk_perusahaan;
            }
        }
        return $data;
    }

}

if (!function_exists('get_jenis_register')) {

    function get_jenis_register($config = false) {
        $data = array(
            '0' => 'Semua Jenis',
            '1' => 'UP',
            '2' => 'GU',
            '3' => 'TU',
            '4' => 'LS Barang & Jasa',
            '5' => 'LS Belanja Pegawai',
        );
        if ($config == 'blud' || $config == 'bud') {
            $data['7'] = 'LS BLUD';
        }
        if ($config == 'ppkd' || $config == 'bud') {
            $data['6'] = 'LS SKPKD';
        }
        return $data;
    }

}

if (!function_exists('get_jenis_register_id')) {

    function get_jenis_register_id($id) {
        if ($id == 1) {
            return "up";
        } elseif ($id == 2) {
            return "gu";
        } else if ($id == 3) {
            return "tu";
        } elseif ($id == 4) {
            return "ls_belanja_pegawai";
        } elseif ($id == 5) {
            return "ls_barang_jasa";
        } elseif ($id == 6) {
            return "ls_skpkd";
        } elseif ($id == 7) {
            return "gu_nihil";
        } else {
            return "tu_nihil";
        }
    }

}

if (!function_exists('get_jenis_register_lpj')) {

    function get_jenis_register_lpj() {
        $data = array(
            '0' => 'Semua Jenis',
            '1' => 'GU',
            '2' => 'TU'
        );
        return $data;
    }

}

if (!function_exists('generate_barcode')) {

    function generate_barcode($kode) {
        return '<img src="' . site_url('cetak/qrcode/' . $kode) . '" />';
    }

}

if (!function_exists('generate_pdf')) {

    function generate_pdf($view, $options = false, $orientation = 'landscape', $paper = 'a4', $filename = '') {
        $CI = &get_instance();
        $CI->load->helper('url');
        $CI->load->library('Dompdf_gen');
        $nama = str_replace("_", " ", $CI->uri->segment(2));
        $ori = str_replace("print", "Pdf", $nama);
        $CI->dompdf->load_html($view);
        $CI->dompdf->set_paper($paper, $orientation);
        $CI->dompdf->render();
        if ($filename) {
            $CI->dompdf->stream($filename . ".pdf");
        } else {
            $CI->dompdf->stream(ucfirst($ori) . ".pdf");
        }
    }

}

if (!function_exists('get_ttd_pa')) {

    function get_ttd_pa($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                ps.jabatan
            FROM
                personil_struktur_organisasi ps
            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            WHERE
                ps.kr_organisasi_org_key = (
                    SELECT
                        CASE WHEN org.parent_id IS NULL OR parent_id = 29 THEN
			org.org_key
                        ELSE
                                org.parent_id
                        END AS org_key
                    FROM
                        daftar_pegawai pg
                    LEFT JOIN kr_organisasi org ON org.org_key = pg.kr_organisasi_org_key
                    WHERE
                        pg.nip = '$nip'
                    limit 1
                )
            AND ps.jabatan = 'Pengguna Anggaran';
        ");

        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}


if (!function_exists('get_ttd_kpa')) {

    function get_ttd_kpa($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                    org.uraian AS nama_skpd,
                    pg.nip,
                    pg.nama,
                    ps.jabatan
            FROM
                    anggota_kpa
            LEFT JOIN personil_struktur_organisasi ps ON ps.uniq_kode = anggota_kpa.personil_struktur_organisasi_uniq_kode
            LEFT JOIN anggota_pptk ap ON anggota_kpa.uniq_kode = ap.anggota_kpa_uniq_kode
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            LEFT JOIN daftar_pegawai pg ON ps.nip = pg.nip
            WHERE
                    ap.nip = '$nip'
             limit 1;
        ");

        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_ttd_kpa_by_org')) {

    function get_ttd_kpa_by_org($org_key = 0) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                    org.uraian AS nama_skpd,
                    pg.nip,
                    pg.nama,
                    ps.jabatan
            FROM
                    personil_struktur_organisasi ps
            LEFT JOIN anggota_kpa ON ps.uniq_kode = anggota_kpa.personil_struktur_organisasi_uniq_kode
            LEFT JOIN anggota_pptk ap ON anggota_kpa.uniq_kode = ap.anggota_kpa_uniq_kode
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            LEFT JOIN daftar_pegawai pg ON ps.nip = pg.nip
            WHERE
                    ps.kr_organisasi_org_key = $org_key and ps.jabatan = 'Kuasa Pengguna Anggaran'
            LIMIT 1;
        ");

        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}



if (!function_exists('get_ttd_pa_by_org')) {

    function get_ttd_pa_by_org($org) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
           SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                ps.jabatan
            FROM
                personil_struktur_organisasi ps
            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            WHERE ps.kr_organisasi_org_key = $org and ps.jabatan = 'Pengguna Anggaran'
        ");

        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_ttd_bp_by_org')) {

    function get_ttd_bp_by_org($org) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
           WITH parent_id AS (
                SELECT
                    org_key,
                    parent_id,
                    kd_flag
                FROM
                    kr_organisasi
                WHERE
                    org_key = $org
            ),
             org AS (
                SELECT
                    *
                FROM
                    kr_organisasi
                WHERE
                    org_key = CASE
                WHEN (SELECT kd_flag FROM parent_id) = 3 THEN
                    (
                        SELECT
                            parent_id
                        FROM
                            parent_id
                    )
                ELSE
                    (SELECT org_key FROM parent_id)
                END
            ) SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                ps.jabatan
            FROM
                personil_struktur_organisasi ps
            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            WHERE
                ps.kr_organisasi_org_key = (SELECT org_key FROM org)
            AND ps.jabatan = 'Bendahara Pengeluaran'
        ");

        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_ttd_bpp_by_org')) {

    function get_ttd_bpp_by_org($org) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
           SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                ps.jabatan
            FROM
                anggota_pptk ps
            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            WHERE ps.kr_organisasi_org_key = $org
            AND ps.jabatan = 'Bendahara Pengeluaran Pembantu'
        ");

        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_ttd_bpen_by_org')) {

    function get_ttd_bpen_by_org($org) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
           SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                ps.jabatan
            FROM
                personil_struktur_organisasi ps
            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            WHERE ps.kr_organisasi_org_key = $org
            AND ps.jabatan = 'Bendahara Penerimaan'
        ");

        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_ttd_kpa_backupppp')) {

    function get_ttd_kpa_backupppp($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                ps.jabatan
            FROM
                anggota_kpa
            LEFT JOIN personil_struktur_organisasi ps ON ps.uniq_kode = anggota_kpa.personil_struktur_organisasi_uniq_kode
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            LEFT JOIN daftar_pegawai pg ON ps.nip = pg.nip
            WHERE
                anggota_kpa.nip = '$nip';
        ");

        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('detail_nip')) {

    function detail_nip($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                pg.nip,
                pg.nama
            FROM
                daftar_pegawai pg
            WHERE nip = '$nip' LIMIT 1
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_ttd_bp')) {

    function get_ttd_bp($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                ko.uraian AS nama_skpd,
                ps.nip,
                dp.nama,
                ps.jabatan
            FROM
                personil_struktur_organisasi ps
            LEFT JOIN kr_organisasi ko ON ps.kr_organisasi_org_key = ko.org_key
            LEFT JOIN daftar_pegawai dp ON dp.nip = ps.nip
            WHERE
                ps.kr_organisasi_org_key = (
                        SELECT
                                ps.kr_organisasi_org_key
                        FROM
                                anggota_pptk ap
                        LEFT JOIN anggota_kpa ak ON ak.uniq_kode = ap.anggota_kpa_uniq_kode
                        LEFT JOIN personil_struktur_organisasi ps ON ps.uniq_kode = ak.personil_struktur_organisasi_uniq_kode
                        WHERE
                                ap.nip = '$nip'
                        LIMIT 1
                )
            AND ps.jabatan = 'Bendahara Pengeluaran'
            LIMIT 1
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_ttd_bp_backup')) {

    function get_ttd_bp_backup($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                ps.jabatan
            FROM
                personil_struktur_organisasi ps
            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            WHERE
                ps.kr_organisasi_org_key = (

		SELECT
			CASE
		WHEN parent_id IS NULL
		OR parent_id = 29 THEN
			org.org_key
		ELSE
			parent_id
		END AS org_key
		FROM
			daftar_pegawai pg
		LEFT JOIN kr_organisasi org ON org.org_key = pg.kr_organisasi_org_key
		LEFT JOIN \"user\" usr ON usr.\"name\" = pg.nip
		AND usr.daftar_peg_uniq_kode :: BIGINT = pg.uniq_kode :: BIGINT
		LEFT JOIN user_role usr_role ON usr_role.user_uniq_kode = usr.uniq_kode
		WHERE
			pg.nip = '$nip'
		AND usr_role.app_config_uniq_kode = 6
		LIMIT 1
                )
            AND ps.jabatan = 'Bendahara Pengeluaran'
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_ttd_bpp')) {

    function get_ttd_bpp($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
        SELECT
            org.uraian AS nama_skpd,
            pg.nip,
            pg.nama,
            ps.jabatan
        FROM
            anggota_pptk ps
        LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
        LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
        WHERE
            ps.nip = '$nip'
         limit 1
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_ttd_bpen')) {

    function get_ttd_bpen($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                ps.jabatan
            FROM
                personil_struktur_organisasi ps
            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            WHERE
                ps.kr_organisasi_org_key = (
                    SELECT
                        org.org_key
                    FROM
                        daftar_pegawai pg
                    LEFT JOIN kr_organisasi org ON org.org_key = pg.kr_organisasi_org_key
                    WHERE
                        pg.nip = '$nip'
                     limit 1
                )
            AND ps.jabatan = 'Bendahara Penerimaan'
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_ttd_bpen_p')) {

    function get_ttd_bpen_p($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
        SELECT
            org.uraian AS nama_skpd,
            pg.nip,
            pg.nama,
            ps.jabatan
        FROM
            anggota_kpa ps
        LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
        LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
        WHERE
            ps.nip = '$nip'
         limit 1
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_bud')) {

    function get_bud() {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT * FROM data_bud LIMIT 1");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}
if (!function_exists('get_ttd_bud')) {

    function get_ttd_bud($jns = 1) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                bud.jabatan,
                bud.kode_jenis,
                bud.uniq_kode
            FROM
                data_bud bud
            LEFT JOIN kr_organisasi org ON org.org_key = bud.kr_organisasi_org_key
            LEFT JOIN daftar_pegawai pg ON pg.nip = bud.nip
            WHERE
            bud.kode_jenis = $jns
             limit 1
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_ttd_kuasa_bud')) {

    function get_ttd_kuasa_bud() {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                'BUD' AS jabatan
            FROM
                data_bud bud
            LEFT JOIN kr_organisasi org ON org.org_key = bud.kr_organisasi_org_key
            LEFT JOIN daftar_pegawai pg ON pg.nip = bud.nip
            WHERE
            bud.kode_jenis = 2
             limit 1
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return NULL;
        }
    }

}

if (!function_exists('get_ttd_perbendaharaan')) {

    function get_ttd_perbendaharaan
    () {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
        SELECT
            org.uraian AS nama_skpd,
            pg.nip,
            pg.nama,
            'BUD' AS jabatan
        FROM
            data_bud bud
        LEFT JOIN kr_organisasi org ON org.org_key = bud.kr_organisasi_org_key
        LEFT JOIN daftar_pegawai pg ON pg.nip = bud.nip
        WHERE
            bud.kode_jenis = 2
             limit 1
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_ttd_ppk')) { //sekretaris dinas

    function get_ttd_ppk($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                ps.jabatan
            FROM
                personil_struktur_organisasi ps
            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            WHERE
                ps.kr_organisasi_org_key = (
                    SELECT
                        org.org_key
                    FROM
                        daftar_pegawai pg
                    LEFT JOIN kr_organisasi org ON org.org_key = pg.kr_organisasi_org_key
                    WHERE
                        pg.nip = '$nip'
                     limit 1
                )
            AND ps.jabatan = 'Sekretaris Dinas';
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_ttd_pptk')) { //sekretaris dinas

    function get_ttd_pptk($uniq_kode_spp) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
           SELECT
            org.uraian AS nama_skpd,
            pg.nip,
            pg.nama,
            'PPTK' jabatan
        FROM
            spp_ls_brg_js spp
        LEFT JOIN daftar_pegawai pg ON pg.nip = spp.nip_pptk
        LEFT JOIN kr_organisasi org ON org.org_key = pg.kr_organisasi_org_key
        WHERE
            spp.uniq_kode = $uniq_kode_spp
         limit 1
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_ttd_pptk_by_kgo_key')) { //sekretaris dinas

    function get_ttd_pptk_by_kgo_key($uniq_kode) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
           SELECT
                anggota_kpa.nip AS nip_pptk,
                nama AS nama_pptk,
                'Pejabat Pelaksana Teknis Kegiatan' AS uraian
            FROM
                anggota_kpa
            JOIN pekerjaan_pptk ON anggota_kpa.uniq_kode = pekerjaan_pptk.anggota_kpa_uniq_kode
            LEFT JOIN daftar_pegawai ON anggota_kpa.nip = daftar_pegawai.nip
            WHERE org_keg_kgo_key = $uniq_kode
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}


if (!function_exists('get_ttd_pptk_by_org')) { //sekretaris dinas

    function get_ttd_pptk_by_org($org_key) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
           SELECT
                ko.uraian AS nama_skpd,
                anggota_kpa.nip,
                dp.nama,
                'PPTK' jabatan
            FROM
                anggota_kpa
            LEFT JOIN kr_organisasi ko ON ko.org_key = anggota_kpa.kr_organisasi_org_key
            LEFT JOIN daftar_pegawai dp ON dp.nip = anggota_kpa.nip
            WHERE
                jabatan_kode = 2
            AND ko.org_key = $org_key
            LIMIT 1;
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('get_role')) { //sekretaris dinas

    function get_role($nip, $org = false, $jabatan = false) {
        $CI = & get_instance();
        $CI->load->database();

        $qry = "
            SELECT
                us.\"name\" as nip,
                rl.\"name\" AS jabatan
            FROM
                \"user\" us
            LEFT JOIN user_role ur ON ur.user_uniq_kode = us.uniq_kode
            LEFT JOIN \"role\" rl ON rl.uniq_kode = ur.role_uniq_kode
            WHERE
                us.\"name\" = '$nip'
            AND ur.app_config_uniq_kode = 6";
        $qry .= $org ? " AND ur.kr_organisasi_org_key = $org" : "";
        $qry .= $jabatan ? " AND rl.\"name\" ILIKE '%$jabatan%' " : "";
        $sql = $CI->db->query($qry);
        if ($sql->num_rows() > 0) {
            $a = $sql->row();
            return $a->jabatan;
        } else {
            return null;
        }
    }

}

// if (!function_exists('get_role')) { //sekretaris dinas

//     function get_role($nip, $org = false, $jabatan = false) {
//         $CI = & get_instance();
//         $CI->load->database();
        
//         $role = $CI->session->userdata('userrole');
        
//         $qry = "
//             SELECT
//                 us.\"name\" as nip,
//                 rl.\"name\" AS jabatan
//             FROM
//                 \"user\" us
//             LEFT JOIN user_role ur ON ur.user_uniq_kode = us.uniq_kode
//             LEFT JOIN \"role\" rl ON rl.uniq_kode = ur.role_uniq_kode
//             WHERE
//                 us.\"name\" = '$nip'
//             AND ur.app_config_uniq_kode = 6
//             AND rl.uniq_kode = $role";
//         $qry .= $org ? " AND ur.kr_organisasi_org_key = $org" : "";
//         $qry .= $jabatan ? " AND rl.\"name\" ILIKE '%$jabatan%' " : "";
//         $sql = $CI->db->query($qry);
//         if ($sql->num_rows() > 0) {
//             $a = $sql->row();
//             return $a->jabatan;
//         } else {
//             return null;
//         }
//     }

// }

if (!function_exists('convert_to_romawi')) {

    function convert_to_romawi($num) {
        $n = intval($num);
        $result = '';

        $lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);

        foreach ($lookup as $roman => $value) {
            $matches = intval($n / $value);
            $result .= str_repeat($roman, $matches);
            $n = $n % $value;
        }
        return $result;
    }

}

// BEGIN Tambahan Tri ==================== :)

if (!function_exists('get_nip_pa')) {

    function get_nip_pa($nip_penginput) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                    org.uraian AS nama_skpd,
                    pg.nip,
                    pg.nama,
                    ps.jabatan
            FROM
                    personil_struktur_organisasi ps
            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            WHERE
                    ps.kr_organisasi_org_key = (
                            SELECT
                                    CASE
                            WHEN parent_id IS NULL
                            OR parent_id = 29 THEN
                                    org.org_key
                            ELSE
                                    parent_id
                            END AS org_key
                            FROM
                                    daftar_pegawai pg
                            LEFT JOIN kr_organisasi org ON org.org_key = pg.kr_organisasi_org_key
                            LEFT JOIN \"user\" usr ON usr.\"name\" = pg.nip
                            AND usr.daftar_peg_uniq_kode :: BIGINT = pg.uniq_kode :: BIGINT
                            LEFT JOIN user_role usr_role ON usr_role.user_uniq_kode = usr.uniq_kode
                            WHERE
                                    pg.nip = '$nip_penginput'
                            AND usr_role.app_config_uniq_kode = 6
                            LIMIT 1
                    )
            AND ps.jabatan = 'Pengguna Anggaran';
        ");

        if ($sql->num_rows() > 0) {
            return $sql->row()->nip;
        } else {
            return NULL;
        }
    }

}

if (!function_exists('get_nip_kpa')) {

    function get_nip_kpa($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
        SELECT
                ko.uraian AS nama_skpd,
                ps.nip,
                peg.nama,
                ps.jabatan
        FROM
                personil_struktur_organisasi ps
        LEFT JOIN \"user\" usr ON usr.\"name\" = ps.nip
        LEFT JOIN daftar_pegawai peg ON peg.nip = usr.\"name\"
        LEFT JOIN user_role urole ON urole.user_uniq_kode = usr.uniq_kode
        AND urole.role_uniq_kode = 31
        LEFT JOIN kr_organisasi ko ON ko.org_key = urole.kr_organisasi_org_key
        WHERE
                urole.kr_organisasi_org_key = (
                        SELECT
                                urole.kr_organisasi_org_key
                        FROM
                                anggota_pptk ap
                        LEFT JOIN \"user\" usr ON usr.\"name\" = ap.nip
                        LEFT JOIN user_role urole ON urole.user_uniq_kode = usr.uniq_kode
                        AND urole.role_uniq_kode = 23
                        WHERE
                                ap.nip = '$nip'
                        limit 1
                );");

        if ($sql->num_rows() > 0) {
            return $sql->row()->nip;
        } else {
            return NULL;
        }
    }

}

if (!function_exists('backup_get_nip_kpa')) {

    function backup_get_nip_kpa($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                ps.jabatan
            FROM
                anggota_kpa
            LEFT JOIN personil_struktur_organisasi ps ON ps.uniq_kode = anggota_kpa.personil_struktur_organisasi_uniq_kode
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            LEFT JOIN daftar_pegawai pg ON ps.nip = pg.nip
            WHERE
                anggota_kpa.nip = '$nip';
        ");

        if ($sql->num_rows() > 0) {
            return $sql->row()->nip;
        } else {
            return NULL;
        }
    }

}

if (!function_exists('get_nip_ppk')) { //sekretaris dinas

    function get_nip_ppk($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                ps.jabatan
            FROM
                personil_struktur_organisasi ps
            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            WHERE
                ps.kr_organisasi_org_key = (
                    SELECT
                    DISTINCT
		CASE WHEN parent_id is NULL OR parent_id = 29 THEN
			ko.org_key
		ELSE
			ko.parent_id
		END AS org_key
		FROM
			daftar_pegawai pg
		LEFT JOIN kr_organisasi ko ON ko.org_key = pg.kr_organisasi_org_key
		WHERE
			pg.nip = '$nip'
                )
            AND ps.jabatan = 'Sekertaris Dinas';
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row()->nip;
        } else {
            return NULL;
        }
    }

}

if (!function_exists('get_nip_pptk')) { //sekretaris dinas

    function get_nip_pptk($uniq_kode_spp) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
           SELECT
            org.uraian AS nama_skpd,
            pg.nip,
            pg.nama,
            'PPTK' jabatan
        FROM
            spp_ls_brg_js spp
        LEFT JOIN daftar_pegawai pg ON pg.nip = spp.nip_pptk
        LEFT JOIN kr_organisasi org ON org.org_key = pg.kr_organisasi_org_key
        WHERE
            spp.uniq_kode = $uniq_kode_spp
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row()->nip;
        } else {
            return NULL;
        }
    }

}

if (!function_exists('get_nip_bp')) {

    function get_nip_bp($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                    org.uraian AS nama_skpd,
                    pg.nip,
                    pg.nama,
                    ps.jabatan
            FROM
                    personil_struktur_organisasi ps
            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            WHERE
                    ps.kr_organisasi_org_key = (
                            SELECT
                                    CASE
                            WHEN parent_id IS NULL
                            OR parent_id = 29 THEN
                                    org.org_key
                            ELSE
                                    parent_id
                            END AS org_key
                            FROM
                                    daftar_pegawai pg
                            LEFT JOIN kr_organisasi org ON org.org_key = pg.kr_organisasi_org_key
                            LEFT JOIN \"user\" usr ON usr.\"name\" = pg.nip
                            AND usr.daftar_peg_uniq_kode :: BIGINT = pg.uniq_kode :: BIGINT
                            LEFT JOIN user_role usr_role ON usr_role.user_uniq_kode = usr.uniq_kode
                            WHERE
                                    pg.nip = '$nip'
                            AND usr_role.app_config_uniq_kode = 6
                            LIMIT 1
                    )
            AND ps.jabatan = 'Bendahara Pengeluaran';
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row()->nip;
        } else {
            return NULL;
        }
    }

}

if (!function_exists('get_nip_bpp')) {

    function get_nip_bpp($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                ak.nip
            FROM
                anggota_kpa ak
            WHERE
                ak.nip = '$nip'
            AND ak.jabatan = 'Bendahara Pengeluaran Pembantu' LIMIT 1;
        ");
        if ($sql->num_rows() > 0) {
//            return $sql->row()->nip;
            return $nip;
        } else {
//            return NULL;
            return $nip;
        }
    }

}

if (!function_exists('get_nip_bpen')) {

    function get_nip_bpen($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                ps.jabatan
            FROM
                personil_struktur_organisasi ps
            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            WHERE
                ps.kr_organisasi_org_key = (
                    SELECT
                    DISTINCT
                        org.org_key
                    FROM
                        daftar_pegawai pg
                    LEFT JOIN kr_organisasi org ON org.org_key = pg.kr_organisasi_org_key
                    WHERE
                        pg.nip = '$nip'
                )
            AND ps.jabatan = 'Bendahara Penerimaan' LIMIT 1
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row()->nip;
        } else {
            return NULL;
        }
    }

}

if (!function_exists('get_nip_bpen_p')) {

    function get_nip_bpen_p($nip) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                ak.nip
            FROM
                anggota_kpa ak
            WHERE
                ak.nip = '$nip'
            AND ak.jabatan = 'Bendahara Penerimaan Pembantu' LIMIT 1;
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row()->nip;
        } else {
            return NULL;
        }
    }

}

if (!function_exists('get_nip_bud')) {

    function get_nip_bud() {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                'BUD' AS jabatan
            FROM
                data_bud bud
            LEFT JOIN kr_organisasi org ON org.org_key = bud.kr_organisasi_org_key
            LEFT JOIN daftar_pegawai pg ON pg.nip = bud.nip
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row()->nip;
        } else {
            return NULL;
        }
    }

}

if (!function_exists('get_nip_ppkd')) {

    function get_nip_ppkd() {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
                org.uraian AS nama_skpd,
                pg.nip,
                pg.nama,
                'BUD' AS jabatan
            FROM
                data_bud bud
            LEFT JOIN kr_organisasi org ON org.org_key = bud.kr_organisasi_org_key
            LEFT JOIN daftar_pegawai pg ON pg.nip = bud.nip
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row()->nip;
        } else {
            return NULL;
        }
    }

}



if (!function_exists('get_spp_by_spm')) {

    function get_spp_by_spm($jenis = false, $uniq_kode = 0) {
        $CI = & get_instance();
        $CI->load->database();

        if ($jenis != false AND $uniq_kode != 0) {
            if ($jenis == 'lsbj') {
                $jenis = 'ls_brg_js';
            } elseif ($jenis == 'lsbp') {
                $jenis = 'ls_pegawai';
            } elseif ($jenis == 'gu') {
                $jenis = 'gu';
            } elseif ($jenis == 'tunihil') {
                $jenis = 'tu_nihil';
            } elseif ($jenis == 'pp') {
                $jenis = 'pengembalian_penyetoran';
            } elseif ($jenis == 'gunihil') {
                $jenis = 'gu_nihil';
            }
            $sql = $CI->db->query("
            SELECT
                spp.*
            FROM
                spm_" . $jenis . " spm
            LEFT JOIN spp_" . $jenis . " spp ON spp.uniq_kode = spm.spp_" . $jenis . "_uniq_kode
            WHERE
                spm.uniq_kode = $uniq_kode
            ");

            if ($sql->num_rows() > 0) {
                return $sql->result();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}


if (!function_exists('get_spp_by_sp2d')) {

    function get_spp_by_sp2d($tabel_spp = false, $tabel_spm = false, $tabel_sp2d = FALSE, $sp2d_uniq_kode = FALSE) {
        $CI = & get_instance();
        $CI->load->database();

        if ($tabel_spp != false AND $tabel_spm != FALSE AND $tabel_sp2d != FALSE AND $sp2d_uniq_kode != FALSE) {
            $sql = $CI->db->query("
             SELECT
                spp.*
            FROM
                $tabel_sp2d sp2
            LEFT JOIN " . $tabel_spm . " spm ON sp2." . $tabel_spm . "_uniq_kode = spm.uniq_kode
            LEFT JOIN " . $tabel_spp . " spp ON spp.uniq_kode = spm." . $tabel_spp . "_uniq_kode
            WHERE
                sp2.uniq_kode = $sp2d_uniq_kode
            ");

            if ($sql->num_rows() > 0) {
                return $sql->result();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

if (!function_exists('get_ttd')) {

    function get_ttd($uniq_kode = 0, $jenis = 0, $sub_jenis = 0, $nip_penginput = '0') {
        $CI = & get_instance();
        $CI->load->database();

        if ($jenis == '1' AND $sub_jenis == '4') {
            $tambahan_ls_barang_jasa = "(SELECT nip_pptk FROM spp_ls_brg_js WHERE uniq_kode = $uniq_kode) AS nip_pptk,";
        } else {
            $tambahan_ls_barang_jasa = "NULL::TEXT AS nip_pptk,";
        }

        $sql = $CI->db->query("
            SELECT
                ttd.*,
                (SELECT nama FROM daftar_pegawai WHERE nip = ttd.nip_pa limit 1) AS nama_pa,
                (SELECT nama FROM daftar_pegawai WHERE nip = ttd.nip_kpa limit 1) AS nama_kpa,
                (SELECT nama FROM daftar_pegawai WHERE nip = ttd.nip_bp limit 1) AS nama_bp,
                (SELECT nama FROM daftar_pegawai WHERE nip = ttd.nip_bpp limit 1) AS nama_bpp,
                (SELECT nama FROM daftar_pegawai WHERE nip = ttd.nip_bpen limit 1) AS nama_bpen,
                (SELECT nama FROM daftar_pegawai WHERE nip = ttd.nip_bpen_p limit 1) AS nama_bpen_p,
                (SELECT nama FROM daftar_pegawai WHERE nip = ttd.nip_ppk limit 1) AS nama_ppk,
                (SELECT nama FROM daftar_pegawai WHERE nip = ttd.nip_pptk limit 1) AS nama_pptk,
                (SELECT nama FROM daftar_pegawai WHERE nip = ttd.nip_bud limit 1) AS nama_bud,
                (SELECT nama FROM daftar_pegawai WHERE nip = ttd.nip_ppkd limit 1) AS nama_ppkd
            FROM
                ttd_cetak_pntu ttd
            WHERE id_dokumen = $uniq_kode
            AND kode_jenis = $jenis
            AND kode_sub_jenis = $sub_jenis;
            ");
        if ($sql->num_rows() > 0) { //jika sudah ada di tabel ttd
            return $sql->row();
        } else { //jika belum ada di tabel cetak ttd
            $sql2 = $CI->db->query("
                    SELECT
                    nipnya.*,
                    (SELECT nama FROM daftar_pegawai WHERE nip = nipnya.nip_pa LIMIT 1) AS nama_pa,
                    (SELECT nama FROM daftar_pegawai WHERE nip = nipnya.nip_kpa LIMIT 1) AS nama_kpa,
                    (SELECT nama FROM daftar_pegawai WHERE nip = nipnya.nip_bp LIMIT 1) AS nama_bp,
                    (SELECT nama FROM daftar_pegawai WHERE nip = nipnya.nip_bpp LIMIT 1) AS nama_bpp,
                    (SELECT nama FROM daftar_pegawai WHERE nip = nipnya.nip_bpen LIMIT 1) AS nama_bpen,
                    (SELECT nama FROM daftar_pegawai WHERE nip = nipnya.nip_bpen_p LIMIT 1) AS nama_bpen_p,
                    (SELECT nama FROM daftar_pegawai WHERE nip = nipnya.nip_ppk LIMIT 1) AS nama_ppk,
                    (SELECT nama FROM daftar_pegawai WHERE nip = nipnya.nip_pptk LIMIT 1) AS nama_pptk,
                    (SELECT nama FROM daftar_pegawai WHERE nip = nipnya.nip_bud LIMIT 1) AS nama_bud,
                    (SELECT nama FROM daftar_pegawai WHERE nip = nipnya.nip_ppkd LIMIT 1) AS nama_ppkd
                    FROM
                        (SELECT
                        (
                            SELECT nip
                            FROM personil_struktur_organisasi
                            WHERE jabatan = 'Pengguna Anggaran'
                            AND kr_organisasi_org_key = pg.kr_organisasi_org_key
                        ) as nip_pa,

                        (
                            SELECT ps.nip
                            FROM anggota_kpa ang
                            LEFT JOIN personil_struktur_organisasi ps ON ps.uniq_kode = ang.personil_struktur_organisasi_uniq_kode
                            WHERE ang.nip = '" . $nip_penginput . "'
                                LIMIT 1
                        ) as nip_kpa,

                        (
                            SELECT
                                pg.nip
                            FROM
                                personil_struktur_organisasi ps
                            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
                            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
                            WHERE
                                ps.kr_organisasi_org_key = (
                                    SELECT
                                        CASE
                                        WHEN org.parent_id IS NULL
                                        OR parent_id = 29 THEN
                                            org.org_key
                                        ELSE
                                            parent_id
                                        END AS org_key
                                    FROM
                                        daftar_pegawai pg
                                    LEFT JOIN kr_organisasi org ON org.org_key = pg.kr_organisasi_org_key
                                    WHERE
                                        pg.nip = '" . $nip_penginput . "'
                                            LIMIT 1
                                )
                            AND ps.jabatan = 'Bendahara Pengeluaran'
                        ) as nip_bp,

                        CASE WHEN ps.jabatan = 'Bendahara Pengeluaran Pembantu' THEN
                            (
                                SELECT
                                    ps.nip
                                FROM
                                    daftar_pegawai pg
                                LEFT JOIN anggota_kpa ps ON ps.nip = pg.nip
                                LEFT JOIN kr_organisasi org ON org.org_key = pg.kr_organisasi_org_key
                                WHERE
                                    pg.nip = '" . $nip_penginput . "'
                                        LIMIT 1
                            )
                        ELSE
                            NULL
                        END as nip_bpp,

                        (
                            SELECT
                                pg.nip
                            FROM
                                personil_struktur_organisasi ps
                            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
                            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
                            WHERE
                                ps.kr_organisasi_org_key = (
                                    SELECT
                                        org.org_key
                                    FROM
                                        daftar_pegawai pg
                                    LEFT JOIN kr_organisasi org ON org.org_key = pg.kr_organisasi_org_key
                                    WHERE
                                        pg.nip = '" . $nip_penginput . "'
                                            LIMIT 1
                                )
                            AND ps.jabatan = 'Bendahara Penerimaan'
                        ) AS nip_bpen,

                        (
                            SELECT
                                pg.nip
                            FROM
                                anggota_kpa ps
                            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
                            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
                            WHERE
                                ps.nip = '" . $nip_penginput . "'
                            AND ps.jabatan = 'Bendahara Penerimaan Pembantu'
                            LIMIT 1
                        )
                        as nip_bpen_p,

                        (
                            SELECT
                                nip
                            FROM
                                personil_struktur_organisasi ps
                            WHERE
                                ps.kr_organisasi_org_key IN (
                                    SELECT
                                        org.org_key
                                    FROM
                                        daftar_pegawai pg
                                    LEFT JOIN kr_organisasi org ON org.org_key = pg.kr_organisasi_org_key
                                    WHERE
                                        pg.nip = '" . $nip_penginput . "'
                                            LIMIT 1
                                )
                            AND ps.jabatan = 'Sekertaris Dinas'
                        ) AS nip_ppk,
                        " . $tambahan_ls_barang_jasa . "
                        (SELECT nip FROM data_bud LIMIT 1) as nip_bud,
                        (SELECT nip FROM data_bud LIMIT 1) as nip_ppkd,
                        pg.nip,
                        pg.kr_organisasi_org_key,
                        org.uraian AS nama_skpd,
                        pg.nama,
                        CASE
                        WHEN (
                            SELECT
                                nip
                            FROM
                                personil_struktur_organisasi
                            WHERE
                                nip = '" . $nip_penginput . "'
                                    LIMIT 1
                        ) IS NULL THEN
                            (
                                SELECT
                                    jabatan
                                FROM
                                    anggota_kpa
                                WHERE
                                    nip = '" . $nip_penginput . "'
                                        LIMIT 1
                            )
                        ELSE
                            (
                                SELECT
                                    jabatan
                                FROM
                                    personil_struktur_organisasi
                                WHERE
                                    nip = '" . $nip_penginput . "'
                                        LIMIT 1
                            )
                        END AS jabatan_penginput
                    FROM daftar_pegawai pg
                    LEFT JOIN personil_struktur_organisasi ps ON ps.nip = pg.nip
                    LEFT JOIN kr_organisasi org ON org.org_key = pg.kr_organisasi_org_key
                    WHERE pg.nip = '" . $nip_penginput . "') AS nipnya
            ");
            if ($sql2->num_rows() > 0) {
                return $sql2->row();
            } else {
                return false;
            }
        }
    }

}

if (!function_exists('is_final')) {

    function is_final($jenis, $sub_jenis, $uniq_kode) {
        $CI = & get_instance();
        $CI->load->database();

        if ($jenis == 'spp' OR $jenis == 'spm') {
            $result = $CI->db->query("
                SELECT
                    *
                FROM
                    persetujuan_" . $jenis . "
                WHERE
                    jns_" . $jenis . "_kode = $sub_jenis
                AND " . $jenis . "_uniq_kode = $uniq_kode
                AND persetujuan = 'Final';
            ");

            if ($result->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

if (!function_exists('detail_organisasi')) {

    function detail_organisasi($org_key) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT
                                korg.uraian AS dinas,
                                org_baru.unit,
                                org_baru.parent_id,
                                org_baru.org_key,
                                org_baru.alamat_skpd,
                                org_baru.alamat_unit,
                                org_baru.kota_skpd,
                                org_baru.kota_unit,
                                org_baru.kode,
                                org_baru.parent_id,
                                org_baru.org_key
                               FROM
                                (
                                 SELECT
                                  orgnya.dinas,
                                  orgnya.unit,
                                  orgnya.parent_id,
                                  orgnya.org_key,
                                  orgnya.kode,
                                  (
                                   SELECT
                                    alamat
                                   FROM
                                    daftar_alamat_skpd
                                   WHERE
                                    kr_organisasi_org_key = orgnya.parent_id
                                  ) AS alamat_skpd,
                                  (
                                   SELECT
                                    alamat
                                   FROM
                                    daftar_alamat_skpd
                                   WHERE
                                    kr_organisasi_org_key = orgnya.org_key
                                  ) AS alamat_unit,
                                  (
                                   SELECT
                                    kota
                                   FROM
                                    daftar_alamat_skpd
                                   WHERE
                                    kr_organisasi_org_key = orgnya.parent_id
                                  ) AS kota_skpd,
                                  (
                                   SELECT
                                    kota
                                   FROM
                                    daftar_alamat_skpd
                                   WHERE
                                    kr_organisasi_org_key = orgnya.org_key
                                  ) AS kota_unit
                                 FROM
                                  (
                                   SELECT
                                    CASE
                                   WHEN parent_id IS NULL THEN
                                    uraian
                                   ELSE
                                    parent
                                   END AS dinas,
                                   uraian AS unit,
                                   CASE
                                  WHEN parent_id IS NULL THEN
                                   org_key
                                  ELSE
                                   parent_id
                                  END AS parent_id,
                                  org_key,
                                  CONCAT(kr_urusan_daerah_kode,'.',kode) kode
                                 FROM
                                  kr_organisasi
                                  WHERE org_key = $org_key
                                  ) orgnya
                                ) AS org_baru
                               JOIN kr_organisasi korg ON korg.org_key = org_baru.parent_id");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return NULL;
        }
    }

}

if (!function_exists('cek_user')) {

    function cek_user($p1, $sesi, $redirect = false) {
        $out = false;
        if (is_array($p1)) {
            if (in_array($sesi, $p1)) {
                $out = true;
            }
        } else {
            if ($p1 == $sesi) {
                $out = true;
            }
        }

        if ($out == false) {
            if ($redirect) {
                redirect($redirect);
            } else {
                return $out;
            }
        } else {
            return $out;
        }
    }

}

if (!function_exists('is_exist_nip')) {

    function is_exist_nip($nip, $tabel = false, $kolom_tabel = false) {
        $out = true;
        $CI = & get_instance();
        $CI->load->database();

        if ($tabel == false) {
            $query = "SELECT * FROM daftar_pegawai WHERE nip = '$nip'";
        } else {
            $query = "SELECT * FROM $tabel WHERE $kolom_tabel = '$nip'";
        }
        $result = $CI->db->query($query);

        if ($result->num_rows() > 0) {
            $out = true;
        } else {
            $out = false;
        }
        return $out;
    }

}

if (!function_exists('is_exist_data')) {

    function is_exist_data($data = false, $tabel = false, $kolom_tabel = false) {
        $out = true;
        $CI = & get_instance();
        $CI->load->database();

        if ($data == false || $tabel == false || $kolom_tabel == false) {
            return false;
        } else {
            $query = "SELECT * FROM $tabel WHERE $kolom_tabel = '$data'";
        }
        $result = $CI->db->query($query);

        if ($result->num_rows() > 0) {
            $out = true;
        } else {
            $out = false;
        }
        return $out;
    }

}


if (!function_exists('get_alamat_skpd')) {

    function get_alamat_org($org) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
            SELECT
	(
		SELECT
			uraian
		FROM
			kr_organisasi
		WHERE
			org_key = orgnya.parent_id
	) AS uraian_skpd,
	(
		SELECT
			uraian
		FROM
			kr_organisasi
		WHERE
			org_key = orgnya.org_key
	) AS uraian_unit,
	concat (
		orgnya.kr_urusan_daerah_kode,
		'.',
		split_part(orgnya.kode, '.', 1)
	) AS kode_skpd,
	concat (
		orgnya.kr_urusan_daerah_kode,
		'.',
		orgnya.kode
	) AS kode_balai,
	orgnya.parent_id,
	orgnya.org_key,
	(
		SELECT
			alamat
		FROM
			daftar_alamat_skpd
		WHERE
			kr_organisasi_org_key = orgnya.parent_id
	) AS alamat_skpd,
	(
		SELECT
			alamat
		FROM
			daftar_alamat_skpd
		WHERE
			kr_organisasi_org_key = orgnya.org_key
	) AS alamat_unit,
	(
		SELECT
			kota
		FROM
			daftar_alamat_skpd
		WHERE
			kr_organisasi_org_key = orgnya.parent_id
	) AS kota_skpd,
	(
		SELECT
			kota
		FROM
			daftar_alamat_skpd
		WHERE
			kr_organisasi_org_key = orgnya.parent_id
	) AS kota_unit
FROM
	(
		SELECT
			kr_organisasi.kr_urusan_daerah_kode,
			kr_organisasi.kode,
			kr_organisasi.uraian AS uraian_organisasi,
			CASE
		WHEN parent_id IS NULL THEN
			org_key
		ELSE
			parent_id
		END AS parent_id,
		org_key
	FROM
		kr_organisasi
	WHERE
		org_key = $org
	) AS orgnya
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

function trunc($phrase, $max_words) {
    $phrase_array = explode(' ', $phrase);
    if (count($phrase_array) > $max_words && $max_words > 0)
        $phrase = implode(' ', array_slice($phrase_array, 0, $max_words)) . '';
    return $phrase;
}

function save_image($inPath, $outPath) {
    $in = fopen($inPath, "rb");
    $out = fopen(base_url('themes/foto/' . $outPath), "wb");
    while ($chunk = fread($in, 8192)) {
        fwrite($out, $chunk, 8192);
    }
    fclose($in);
    fclose($out);
}

function get_pegawai_detail_bkd($param) {
    $CI = & get_instance();
    $CI->load->database();
    $CI->db_bkd = $CI->load->database('bkd', TRUE);

    $sql = "
        SELECT
                CONCAT(
                MASTFIP08.B_03A,
                ' ',
                MASTFIP08.B_03,
                ' ',
                MASTFIP08.B_03B
                    ) as nama,
                MASTFIP08.B_02B as nip,
                MASTFIP08.B_12 as alamat
        FROM
                MASTFIP08
        WHERE
         B_02B LIKE '%$param%'
        OR L_NAMA_NIK LIKE '%$param%'";
    $get = $CI->db_bkd->query($sql);
    if ($get->num_rows() > 0) {
        return $get->result();
    }
    return array();
}

function get_foto_skpd($id) {
    $filename = $id . ".png";
    if (file_exists(base_url('themes/foto/') . $filename)) {
        $src = base_url('themes/foto/' . $filename);
    } else {
        if (is_numeric($id)) {
            $c = curl_init('http://bkd.jatengprov.go.id/new/sotk/foto/' . $id);
        } else {
            $c = curl_init('http://bkd.jatengprov.go.id/new/sotk/foto/198609212009031002');
        }
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($c);
        if (curl_error($c))
            die(curl_error($c));
        $status = curl_getinfo($c, CURLINFO_HTTP_CODE);
        curl_close($c);
        $doc = new DOMDocument();
        $doc->loadHTML($html);
        $xpath = new DOMXPath($doc);
        $src = $xpath->evaluate("string(//img/@src)");
        // Cek Not Found Url
        $file_headers = @get_headers($src);
        if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {
            $src = base_url('themes/images/logo.png');
        } else {
            save_image($src, session("pegawai_nip") . ".png");
        }
    }
    return $src;
}

function get_aktiv($id, $uri = null, $issub = false) {
    $CI = & get_instance();
    $CI->load->helper('url');
    if ($uri == null) {
        $aktif = $CI->uri->segment(1);
    } else {
        $aktif = $CI->uri->segment($uri);
    }
    $aktif = $issub ? $CI->uri->uri_string() : $aktif;
    $div = explode("/", $aktif);
    $str = $aktif;
    if (sizeof($div) > 1) {
        $str = $div[0];
    }
    $kondisi = is_array($id) ? (in_array($aktif, $id)) ?: in_array($str, $id) : ($id == $aktif ?: $id == $str);
    if ($kondisi) {
        return "active";
    } else {
        return false;
    }
}

function get_user_akses($id) {
    $CI = & get_instance();
    $aktif = $CI->session->userdata('user');
    $kondisi = is_array($id) ? in_array($aktif, $id) : ($aktif == $id);
    if ($kondisi) {
        return true;
    } else {
        return false;
    }
}

function notifikasi_input() {
    if (file_exists('./files/session/' . enkripsi(session('parent_id')) . '.txt')) {
        return false;
    } else {
        $CI = & get_instance();
        $CI->load->library('ci_pusher');
        $pusher = $CI->ci_pusher->get_pusher();
        $data['id_keg'] = session('parent_id');
        $data['user_keg'] = session("nama");
        $data['org_keg'] = session("kr_organisasi_org_key");
        $event = $pusher->trigger('notif_rab', 'get_rab_event', $data);
        if ($event === TRUE) {
            $CI->session->set_userdata('aktiv', session('parent_id'));
            $fp = fopen(('./files/session/' . enkripsi(session('parent_id')) . '.txt'), "wb");
            fwrite($fp, "");
            fclose($fp);
            return $event;
        } else {
            return false;
        }
    }
}

function notifikasi_remove() {
    if (session('aktiv') == session('parent_id')) {
        $CI = & get_instance();
        $CI->load->library('ci_pusher');
        $pusher = $CI->ci_pusher->get_pusher();
        $data['parent'] = session("parent_id");
        $event = $pusher->trigger('notif_rab', 'del_rab_event', $data);
        if ($event === TRUE) {
            $CI->session->unset_userdata('aktiv');
            unlink('./files/session/' . enkripsi(session('parent_id')) . '.txt');
            return $event;
        } else {
            return false;
        }
    }
}

function notifikasi_ppk($pesan, $tipe) {
    $CI = & get_instance();
    $CI->load->library('ci_pusher');
    $pusher = $CI->ci_pusher->get_pusher();
    $data['message'] = $pesan;
    $data['user'] = session("user");
    $data['tipe'] = $tipe;
    $data['parent'] = session("parent_id");
    $event = $pusher->trigger('ppk_bp', 'ppk_bp_event', $data);
    if ($event === TRUE) {
        return $event;
    } else {
        return false;
    }
}

function notifikasi_ppk_bud($pesan, $tipe) {
    $CI = & get_instance();
    $CI->load->library('ci_pusher');
    $pusher = $CI->ci_pusher->get_pusher();
    $data['message'] = $pesan;
    $data['user'] = session("user");
    $data['tipe'] = $tipe;
    $data['parent'] = session("parent_id");
    $event = $pusher->trigger('ppk_bud', 'ppk_bud_event', $data);
    if ($event === TRUE) {
        return $event;
    } else {
        return false;
    }
}

function notifikasi_bud_bp($pesan, $tipe) {
    $CI = & get_instance();
    $CI->load->library('ci_pusher');
    $pusher = $CI->ci_pusher->get_pusher();
    $data['message'] = $pesan;
    $data['user'] = session("user");
    $data['tipe'] = $tipe;
    $data['parent'] = session("parent_id");
    $event = $pusher->trigger('bud_bp', 'bud_bp_event', $data);
    if ($event === TRUE) {
        return $event;
    } else {
        return false;
    }
}

function notifikasi_bud_ppk($pesan, $tipe) {
    $CI = & get_instance();
    $CI->load->library('ci_pusher');
    $pusher = $CI->ci_pusher->get_pusher();
    $data['message'] = $pesan;
    $data['user'] = session("user");
    $data['tipe'] = $tipe;
    $data['parent'] = session("parent_id");
    $event = $pusher->trigger('bud_ppk', 'bud_ppk_event', $data);
    if ($event === TRUE) {
        return $event;
    } else {
        return false;
    }
}

function notifikasi_bp_ppk($pesan, $tipe) {
    $CI = & get_instance();
    $CI->load->library('ci_pusher');
    $pusher = $CI->ci_pusher->get_pusher();
    $data['message'] = $pesan;
    $data['user'] = session("user");
    $data['tipe'] = $tipe;
    $data['parent'] = session("parent_id");
    $event = $pusher->trigger('bp_ppk', 'bp_ppk_event', $data);
    if ($event === TRUE) {
        return $event;
    } else {
        return false;
    }
}

function notifikasi_bp_bud($pesan, $tipe) {
    $CI = & get_instance();
    $CI->load->library('ci_pusher');
    $pusher = $CI->ci_pusher->get_pusher();
    $data['message'] = $pesan;
    $data['user'] = session("user");
    $data['tipe'] = $tipe;
    $data['parent'] = session("parent_id");
    $event = $pusher->trigger('bp_bud', 'bp_bud_event', $data);
    if ($event === TRUE) {
        return $event;
    } else {
        return false;
    }
}

if (!function_exists('has_blud')) {

    function has_blud($org_key) {
        $CI = & get_instance();
        $sql = "SELECT org_key FROM kr_organisasi WHERE org_key=$org_key AND org_key BETWEEN 3 AND 9";
        return $CI->db->query($sql)->row();
    }

}

if (!function_exists('is_ppkd')) {

    function is_ppkd($org_key) {
        $CI = & get_instance();
        $sql = "SELECT org_key FROM kr_organisasi WHERE org_key=$org_key AND uraian ILIKE '%SKPKD%'";
        return $CI->db->query($sql)->row();
    }

}
if (!function_exists('is_biro')) {

    function is_biro($org_key) {
        $CI = & get_instance();
        $sql = "SELECT org_key FROM kr_organisasi WHERE  org_key=$org_key AND parent_id=29 AND uraian ILIKE '%biro%'";
        return $CI->db->query($sql)->row();
    }

}
if (!function_exists('rand_password')) {

    function rand_password() {
        $possible = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $code = '';
        $i = 0;
        while ($i < 8) {
            $code .= substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            $i++;
        }
        return $code;
    }

}

if (!function_exists('cek_owner_spp_spm')) {

    function cek_owner_spp_spm($uniq_kode) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = "SELECT * FROM spm_ls_skpkd WHERE spp_ls_skpkd_uniq_kode = $uniq_kode;";
        return $CI->db->query($sql)->num_rows();
    }

}


if (!function_exists('get_data_pegawai_role')) {

    function get_data_pegawai_role($app_role = '0', $nip = '0', $org_key) {
        $CI = & get_instance();
        $CI->load->database();

        $sql = "
        SELECT
            dp.kr_organisasi_org_key AS kr_organisasi_org_key_dari_role,
            nip,
            CASE
        WHEN ko.parent_id IS NULL
        OR ko.parent_id = 29 THEN
            ko.org_key
        ELSE
            ko.parent_id
        END AS parent_id_dari_role,
         dp.nama
        FROM
            daftar_pegawai1('" . APP_CONFIG_UNIQ_KODE . "') dp
        LEFT JOIN kr_organisasi ko ON (
            ko.org_key = dp.kr_organisasi_org_key
        )
        WHERE
            dp.nip = '$nip'
        AND (
            ko.org_key = $org_key
            OR ko.parent_id = $org_key
        )";
        return $CI->db->query($sql)->result();
    }

}

function get_string($string, $tanda) {
    return substr($string, strpos($string, $tanda) + 1);
}

function after($this, $inthat) {
    if (!is_bool(strpos($inthat, $this)))
        return substr($inthat, strpos($inthat, $this) + strlen($this));
}

function after_last($this, $inthat) {
    if (!is_bool(strrevpos($inthat, $this)))
        return substr($inthat, strrevpos($inthat, $this) + strlen($this));
}

function before($this, $inthat) {
    return substr($inthat, 0, strpos($inthat, $this));
}

function before_last($this, $inthat) {
    return substr($inthat, 0, strrevpos($inthat, $this));
}

function between($this, $that, $inthat) {
    return before($that, after($this, $inthat));
}

function between_last($this, $that, $inthat) {
    return after_last($this, before_last($that, $inthat));
}

function strrevpos($instr, $needle) {
    $rev_pos = strpos(strrev($instr), strrev($needle));
    if ($rev_pos === false)
        return false;
    else
        return strlen($instr) - $rev_pos - strlen($needle);
}

if (!function_exists('get_today')) {

    function get_today() {
        $days = Array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");

        return $days[date("w")];
    }

}

if (!function_exists('get_no_bku_penerimaan')) {

    function get_no_bku_penerimaan() {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("

        SELECT
            CONCAT (
                'bku',
                (
                    RIGHT (
                        CONCAT ('000000',(nomor :: INT + 1)),
                        6
                    )
                )
            ) AS nomor_new
        FROM
            (
                SELECT
                    MAX (substr(no_urut_bku, 4, 10)) AS nomor
                FROM
                    ctk_bku_penerimaan
            ) AS cbp
        ");
        if ($sql->num_rows() > 0) {
            return $sql->row()->nomor_new;
        } else {
            return 'bku000001';
        }
    }

}

if (!function_exists('get_ttd_bpenp_by_org')) {

    function get_ttd_bpenp_by_org($org) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
           SELECT
                    org.uraian AS nama_skpd,
                    pg.nip,
                    pg.nama,
                    ps.jabatan
            FROM
                    anggota_kpa ps
            LEFT JOIN daftar_pegawai pg ON pg.nip = ps.nip
            LEFT JOIN kr_organisasi org ON org.org_key = ps.kr_organisasi_org_key
            WHERE
                    ps.kr_organisasi_org_key = $org
            AND ps.jabatan = 'Bendahara Penerimaan Pembantu'
        ");

        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

}

if (!function_exists('is_parent')) {

    function is_parent($org) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("SELECT * from kr_organisasi where org_key = $org");
        if ($sql->row()->parent_id == '') {
            return true;
        } else {
            return false;
        }
    }

}

if (!function_exists('generate_pencairan_sp2d')) {

    function generate_pencairan_sp2d() {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
           WITH persetujuan_spm AS (
    SELECT
        persetujuan_spm.*
    FROM
        (
            SELECT
                MAX (uniq_kode) AS uniq_kode_persetujuan,
                spm_uniq_kode
            FROM
                persetujuan_spm
            WHERE
                jns_spm_kode = 2
            GROUP BY
                spm_uniq_kode
        ) AS maxnya
    LEFT JOIN persetujuan_spm ON persetujuan_spm.uniq_kode = maxnya.uniq_kode_persetujuan
),
 spm_gu_final AS (
    SELECT
        spm_gu.*
    FROM
        spm_gu
    LEFT JOIN persetujuan_spm ON persetujuan_spm.spm_uniq_kode = spm_gu.uniq_kode
    WHERE
        persetujuan_spm.persetujuan = 'Final'
),
 sp2d AS (
    SELECT
        sd.*
    FROM
        spm_gu_final sm
    LEFT JOIN sp2d_gu sd ON sd.spm_gu_uniq_kode = sm.uniq_kode
) INSERT INTO pencairan_sp2d_gu (
    sp2d_gu_uniq_kode,
    no_pencairan_sp2d,
    status,
    tanggal_pencairan,
    nip_penginput,
    date_added,
    date_edited,
    jenis_tp
)(
    SELECT
        sp2d.uniq_kode AS sp2d_gu_uniq_kode,
        NULL AS no_pencairan_sp2d,
        'Belum dicairkan' AS status,
        NULL AS tanggal_pencairan,
        '196508271986032014' AS nip_penginput,
        sp2d.date_added,
        NULL AS date_edited,
        1 AS jenis_tp
    FROM
        sp2d
    LEFT JOIN pencairan_sp2d_gu pc ON pc.sp2d_gu_uniq_kode = sp2d.uniq_kode
    WHERE
        pc.sp2d_gu_uniq_kode IS NULL
);

WITH persetujuan_spm AS (
    SELECT
        persetujuan_spm.*
    FROM
        (
            SELECT
                MAX (uniq_kode) AS uniq_kode_persetujuan,
                spm_uniq_kode
            FROM
                persetujuan_spm
            WHERE
                jns_spm_kode = 5
            GROUP BY
                spm_uniq_kode
        ) AS maxnya
    LEFT JOIN persetujuan_spm ON persetujuan_spm.uniq_kode = maxnya.uniq_kode_persetujuan
),
 spm_final AS (
    SELECT
        spm_ls_brg_js.*
    FROM
        spm_ls_brg_js
    LEFT JOIN persetujuan_spm ON persetujuan_spm.spm_uniq_kode = spm_ls_brg_js.uniq_kode
    WHERE
        persetujuan_spm.persetujuan = 'Final'
),
 sp2d AS (
    SELECT
        sd.*
    FROM
        spm_final sm
    LEFT JOIN sp2d_ls_brg_js sd ON sd.spm_ls_brg_js_uniq_kode = sm.uniq_kode
) INSERT INTO pencairan_sp2d_ls_brg_js (
    sp2d_ls_brg_js_uniq_kode,
    no_pencairan_sp2d,
    status,
    tanggal_pencairan,
    nip_penginput,
    date_added,
    date_edited,
    jenis_tp
)(
    SELECT
        sp2d.uniq_kode AS sp2d_ls_brg_js_uniq_kode,
        NULL AS no_pencairan_sp2d,
        'Belum dicairkan' AS status,
        NULL AS tanggal_pencairan,
        '196508271986032014' AS nip_penginput,
        sp2d.date_added,
        NULL AS date_edited,
        1 AS jenis_tp
    FROM
        sp2d
    LEFT JOIN pencairan_sp2d_ls_brg_js pc ON pc.sp2d_ls_brg_js_uniq_kode = sp2d.uniq_kode
    WHERE
        pc.sp2d_ls_brg_js_uniq_kode IS NULL
);

WITH persetujuan_spm_nihil AS (
    SELECT
        persetujuan_spm_nihil.*
    FROM
        (
            SELECT
                MAX (uniq_kode) AS uniq_kode_persetujuan,
                spm_uniq_kode
            FROM
                persetujuan_spm_nihil
            WHERE
                jns_spm_kode = 2 -- TU Nihil
            GROUP BY
                spm_uniq_kode
        ) AS maxnya
    LEFT JOIN persetujuan_spm_nihil ON persetujuan_spm_nihil.uniq_kode = maxnya.uniq_kode_persetujuan
),
 spm_tu_nihil_final AS (
    SELECT
        spm_tu_nihil.*
    FROM
        spm_tu_nihil
    LEFT JOIN persetujuan_spm_nihil ON persetujuan_spm_nihil.spm_uniq_kode = spm_tu_nihil.uniq_kode
    WHERE
        persetujuan_spm_nihil.persetujuan = 'Final'
),
 sp2d AS (
    SELECT
        sd.*
    FROM
        spm_tu_nihil_final sm
    LEFT JOIN sp2d_tu_nihil sd ON sd.spm_tu_nihil_uniq_kode = sm.uniq_kode
) INSERT INTO pencairan_sp2d_tu_nihil (
    sp2d_tu_nihil_uniq_kode,
    no_pencairan_sp2d,
    status,
    tanggal_pencairan,
    nip_penginput,
    date_added,
    date_edited,
    jenis_tp
)(
    SELECT
        sp2d.uniq_kode AS sp2d_tu_nihil_uniq_kode,
        NULL AS no_pencairan_sp2d,
        'Belum dicairkan' AS status,
        NULL AS tanggal_pencairan,
        '196508271986032014' AS nip_penginput,
        sp2d.date_added,
        NULL AS date_edited,
        1 AS jenis_tp
    FROM
        sp2d
    LEFT JOIN pencairan_sp2d_tu_nihil pc ON pc.sp2d_tu_nihil_uniq_kode = sp2d.uniq_kode
    WHERE
        pc.sp2d_tu_nihil_uniq_kode IS NULL
)
        ");

        // if ($sql->row()->parent_id == '') {
        //     return true;
        // } else {
        //     return false;
        // }
    }

}

if (!function_exists('is_rsud')) {

    function is_rsud($org) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = $CI->db->query("
           SELECT
                    *
            FROM
                    kr_organisasi
            WHERE
                    (
                            uraian ILIKE 'RSUD%'
                            OR uraian ILIKE 'RSJD%'
                    )
            AND org_key = $org
        ");

        if ($sql->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}

if (!function_exists('tanggal')) {

    function tanggal($timestamp = '', $date_format = 'l, j F Y | H:i') {
        if (trim($timestamp) == '') {
            $timestamp = time();
        } elseif (!ctype_digit($timestamp)) {
            $timestamp = strtotime($timestamp);
        }
        # remove S (st,nd,rd,th) there are no such things in indonesia :p
        $date_format = preg_replace("/S/", "", $date_format);
        $pattern = array(
            '/Mon[^day]/', '/Tue[^sday]/', '/Wed[^nesday]/', '/Thu[^rsday]/',
            '/Fri[^day]/', '/Sat[^urday]/', '/Sun[^day]/', '/Monday/', '/Tuesday/',
            '/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/',
            '/Jan[^uary]/', '/Feb[^ruary]/', '/Mar[^ch]/', '/Apr[^il]/', '/May/',
            '/Jun[^e]/', '/Jul[^y]/', '/Aug[^ust]/', '/Sep[^tember]/', '/Oct[^ober]/',
            '/Nov[^ember]/', '/Dec[^ember]/', '/January/', '/February/', '/March/',
            '/April/', '/June/', '/July/', '/August/', '/September/', '/October/',
            '/November/', '/December/',
        );
        $replace = array('Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min',
            'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu',
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des',
            'Januari', 'Februari', 'Maret', 'April', 'Juni', 'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember',
        );
        $date = date($date_format, $timestamp);
        $date = preg_replace($pattern, $replace, $date);
        $date = "{$date}";
        return $date;
    }

}
