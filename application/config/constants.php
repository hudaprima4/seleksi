<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Display Debug backtrace
  |--------------------------------------------------------------------------
  |
  | If set to TRUE, a backtrace will be displayed along with php errors. If
  | error_reporting is disabled, the backtrace will not display, regardless
  | of this setting
  |
 */
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESCTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
  |--------------------------------------------------------------------------
  | Exit Status Codes
  |--------------------------------------------------------------------------
  |
  | Used to indicate the conditions under which the script is exit()ing.
  | While there is no universal standard for error codes, there are some
  | broad conventions.  Three such conventions are mentioned below, for
  | those who wish to make use of them.  The CodeIgniter defaults were
  | chosen for the least overlap with these conventions, while still
  | leaving room for others to be defined in future versions and user
  | applications.
  |
  | The three main conventions used for determining exit status codes
  | are as follows:
  |
  |    Standard C/C++ Library (stdlibc):
  |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
  |       (This link also contains other GNU-specific conventions)
  |    BSD sysexits.h:
  |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
  |    Bash scripting:
  |       http://tldp.org/LDP/abs/html/exitcodes.html
  |
 */
define('COOKIE_RUNTIME', 1209600);
define('COOKIE_DOMAIN', '.localhost');
define('TAHUN', '2018');

define('KODE_PROVINSI', 33);
define('TAHAP', '2');
define('BATAS_LPJ_GU', 60);

//define('BLOCK_STATUS',FALSE);
//const UNBLOCKED_MODUL = array('spp','spm','sp2d','pengeluaran');
//const UNBLOCKED_SUBMODUL = array('ls_belanja_pegawai','register');

define('ROLE_UNIQ_PPK', '6');
define('ROLE_UNIQ_BP', '22');
define('ROLE_UNIQ_BPP', '23');
define('ROLE_UNIQ_BUD', '24');
define('ROLE_UNIQ_SUPER_ADMIN', '2');
define('ROLE_UNIQ_BPEN', '25');
define('ROLE_UNIQ_BPENP', '26');
define('ROLE_UNIQ_ADMIN_SKPD', '27');
define('ROLE_UNIQ_AKUNTANSI', '28');
define('ROLE_UNIQ_PERBENDAHARAAN', '29');
define('ROLE_UNIQ_KASDA', '30');
define('ROLE_UNIQ_PPKP', '34');
define('ROLE_UNIQ_RKM', '38');
define('ROLE_UNIQ_SPV', '41');
define('ROLE_UNIQ_BLUD', '43');
define('ROLE_UNIQ_SPV_PL', '44');


//konstan KODE
//KODE MODUL
define('SPP', '1');
define('SPM', '2');
define('SP2D', '3');
define('LPJ', '4');
define('KONTRAK', '5');
define('BP', '6');
define('SKP_D', '7');
define('SKR_D', '8');
define('BPEN', '9');
define('STS', '10');
define('SP2D_UJI', '11');
define('SPJ', '12');
define('KAS', '13');
define('PAJAK', '14');
define('PANJAR', '15');
define('BUKTI_PENERIMAAN_PANJAR', '16');
define('LPJ_PANJAR', '17');
define('STS_P', '18');
define('SP3B', '19');
define('PENGEMBALIAN_LPJ', '20');
define('PENGEMBALIAN_LPJ_PANJAR', '21');
define('SP2B', '22');
define('STS_CP', '23');
//KODE MODUL CETAK
/**
 * Buku Kas Umum Pengeluaran
 */
define('PENGELUARAN_BKU', '101');
/**
 * Buku Pajak Pengeluaran
 */
define('PENGELUARAN_BPAJAK', '102');
/**
 * Buku Simpanan Bank
 */
define('PENGELUARAN_BSB', '103');
/**
 * Buku Rekapitulasi Perincian Per Obyek
 */
define('PENGELUARAN_POPRO', '104');
/**
 * Berita Acara Pemeriksaan Kas
 */
define('PENGELUARAN_BAPK', '105');
/**
 * Buku Panjar
 */
define('PENGELUARAN_BPANJAR', '106');
/**
 * LPJ Administratif/Fungsional
 */
define('PENGELUARAN_LPJ', '107');


//KODE SUB MODUL
define('KODE_UP', '1');
define('KODE_GU', '2');
define('KODE_TU', '3');
define('KODE_LS_BP', '4');
define('KODE_LS_BJ', '5');
define('KODE_TU_NIHIL', '6');
define('KODE_GU_NIHIL', '7');
define('KODE_LS_SKPKD', '8');
define('KODE_PP', '9');
define('KODE_PAJAK', '1');
define('KODE_RETRIBUSI', '2');
define('KODE_PAD_LAIN', '3');
define('KODE_TANPA_KETETAPAN', '4');

//konstan status
define('STATUS_PERSIAPAN', '0');
define('STATUS_DRAF', '1');
define('STATUS_DITOLAK', '2');
define('STATUS_FINAL', '3');
define('STATUS_BELUM_SPP', '4');
define('STATUS_SUDAH_SPP', '5');
define('STATUS_BELUM_DICAIRKAN', '6');
define('STATUS_SUDAH_DICAIRKAN', '7');
define('STATUS_BELUM_DISETORKAN', '8');
define('STATUS_SUDAH_DISETORKAN', '9');
define('STATUS_BELUM_DISTSKAN', '10');
define('STATUS_SUDAH_DISTSKAN', '11');
define('STATUS_BELUM_DIKEMBALIKAN', '12');
define('STATUS_SUDAH_DIKEMBALIKAN', '13');
define('STATUS_BELUM_LPJ', '14');
define('STATUS_SUDAH_LPJ', '15');


define('DATA_KOSONG', 'Tidak ada data');

//REKOMENDASI
define('MAX_RKM_INDIVIDU', 4);
define('MAX_RKM_KELOMPOK', 1);

define('VERSION_BUILD', '2016-GRMS');
define('APP_CONFIG_UNIQ_KODE', '6');


//TOMBOL
/**
 * Tombol tambah ex: Tambah SPP,SPM,SP2D, dll.
 */
define('BUTTON_ADD', 1);
/**
 * Tombol edit ex: Edit SPP,SPM,SP2D, dll.
 */
define('BUTTON_EDIT', 2);
/**
 * Tombol hapus ex: Hapus SPP,SPM,SP2D, dll.
 */
define('BUTTON_DELETE', 3);
/**
 * Tombol Detail/View ex: Detail SPP,SPM,SP2D, dll.
 */
define('BUTTON_DETAIL', 4);
/**
 * Tombol Cetak ex: Cetak LPJ,SP2D, dll.
 */
define('BUTTON_PRINT', 5);
/**
 * Tombol Kirim ex: Kirim SP2D
 */
define('BUTTON_SEND', 6);
/**
 * Tombol pengajuan ulang ex: Pengajuan SPP,SPM dll.
 */
define('BUTTON_RESUBMIT', 7);
/**
 * Tombol Verifikasi/Persetujuan ex: Persetujuan SPP,Verifikasi SPM, dll.
 */
define('BUTTON_VERIFY', 8);
/**
 * Tombol Penundaan/Drafkan kembali ex: Drafkan SPP, Tunda SP2D, dll.
 */
define('BUTTON_DELAY', 9);
/**
 * Tombol Update Rekanan/Penerima ex: Update Rekanan di SPP LS Barang & Jasa, Update Penerima GU, dll.
 */
define('BUTTON_UPDATE_RECEIVER', 10);
/**
 * Tombol Pengembalian ex: Pengembalian LPJ, dll.
 */
define('BUTTON_RETURN', 11);


defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
