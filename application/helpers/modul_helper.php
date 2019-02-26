<?php

if (!function_exists('get_modul')) {

    function get_modul($idx = -1) {
        $modul = array("SPP", "SPM", "SP2D", "LPJ", "KONTRAK", "BP", "SKP-D", "SKR-D", "BPEN", "STS", "SP2D-UJI", "SPJ", "KAS", "PAJAK", "PANJAR", "BP-PJR", "LPJ-PJR", "STS_P", "SP3B", "PENGEMBALIAN_LPJ", "PENGEMBALIAN_LPJ_PANJAR","SP2B","STS_CP");
        if ($idx >= 0) {
            return $modul[$idx];
        }
        return $modul;
    }

}
if (!function_exists('get_modul_pembukuan')) {

    function get_modul_pembukuan($idx = -1) {
        $modul = array('PENGELUARAN_BKU', 'PENGELUARAN_BPAJAK', 'PENGELUARAN_BSB', 'PENGELUARAN_POPRO', 'PENGELUARAN_BAPK', 'PENGELUARAN_BPANJAR', 'PENGELUARAN_LPJ');
        if ($idx >= 0) {
            return $modul[$idx];
        }
        return $modul;
    }

}
if (!function_exists('get_list_status')) {

    function get_list_status($idx = -1) {
        $stat = array("persiapan", "draf", "ditolak", "final", "belum_spp", "sudah_spp", "belum_dicairkan", "sudah_dicairkan", "belum_disetorkan", "sudah_disetorkan", "belum_distskan", "sudah_distskan", "belum_dikembalikan", "sudah_dikembalikan", "belum_lpj", "sudah_lpj");
        if ($idx >= 0) {
            return $stat[$idx];
        }
        return $stat;
    }

}
if (!function_exists('get_submodul')) {

    function get_submodul($modul) {
        $out = array();
        if (strtolower($modul) == 'spp' || strtolower($modul) == 'spm' || strtolower($modul) == 'sp2d') {
            $out = array('up', 'gu', 'tu', 'lsbp', 'lsbj', 'tunihil', 'gunihil', 'lsskpkd', 'pp');
        } else if (strtolower($modul) == 'bp') {
            $out = array('gu', 'tu');
        } else if (strtolower($modul) == 'bpen') {
            $out = array('pajak', 'retribusi', 'pad_lain','tanpa_ketetapan');
        }
        return $out;
    }

}


if (!function_exists('get_submodul_id')) {

    /**
     * 
     * @param INT $modul diisi dengan Constant sesuai nama Modul Misal: SPP,SKP_D
     * @param String $submodul diisi dengan string modul persis seperti cetak (up,gu,gunihil)
     * @return boolean
     */
    function get_submodul_id($modul, $submodul) {
        if ($modul && $submodul) {
            $mdl = get_modul();
            $mdl = $mdl[$modul - 1];
            $smdl = get_submodul($mdl);
            $out = array_search(strtolower($submodul), $smdl);
            return (is_numeric($out)) ? ($out + 1) : false;
        }
        return false;
    }

}

if (!function_exists('cek_jenis_sp_exist')) {

    function cek_jenis_sp_exist($jenis_spp) {
        $exist = false;
        if (is_numeric($jenis_spp)) {
            if ($jenis_spp >= 1 && $jenis_spp <= 9) {
                $exist = true;
            }
        } else {
            $index_jns = get_submodul('spp');
            foreach ($index_jns as $row) {
                $exist = strtolower($jenis_spp) == $row;
                if ($exist) {
                    break;
                }
            }
        }
        return $exist;
    }

}

if (!function_exists('get_modul_properties_by_jenis')) {

    function get_modul_properties_by_jenis($jenis) {

        if ($jenis > 100) {
            //modul pembukuan
            $index_jns = get_modul_pembukuan();
            $jenis = !is_numeric($jenis) ? $jenis : $index_jns[($jenis - 101)];
            $out = array(
                'PENGELUARAN_BKU' => array('name_short' => 'PENGELUARAN_BKU', 'tabel' => 'ctk_bku_pengeluaran'),
                'PENGELUARAN_BPAJAK' => array('name_short' => 'PENGELUARAN_BPAJAK', 'tabel' => 'ctk_buku_pajak_pengeluaran'),
                'PENGELUARAN_BSB' => array('name_short' => 'PENGELUARAN_BSB', 'tabel' => 'ctk_buku_simpanan_bank'),
                'PENGELUARAN_POPRO' => array('name_short' => 'PENGELUARAN_POPRO', 'tabel' => 'ctk_bku_pengeluaran'),
                'PENGELUARAN_BAPK' => array('name_short' => 'PENGELUARAN_BAPK', 'tabel' => 'berita_acara_pemeriksaan_kas'),
                'PENGELUARAN_BPANJAR' => array('name_short' => 'PENGELUARAN_BPANJAR', 'tabel' => 'ctk_buku_panjar'),
                'PENGELUARAN_LPJ' => array('name_short' => 'PENGELUARAN_LPJ', 'tabel' => 'ctk_lpj_pengeluaran')
            );
        } else {
            $index_jns = get_modul();
            $jenis = !is_numeric($jenis) ? $jenis : $index_jns[($jenis - 1)];
            $out = array(
                'SPP' => array('name_short' => 'SPP', 'nomor_field' => 'no_spp', 'value_field' => 'jumlah_spp'),
                'SPM' => array('name_short' => 'SPM', 'nomor_field' => 'no_spm', 'value_field' => 'jumlah_spm'),
                'SP2D' => array('name_short' => 'SP2D', 'nomor_field' => 'no_sp2d', 'value_field' => 'jumlah_sp2d'),
                'LPJ' => array('name_short' => 'LPJ', 'nomor_field' => 'no_lpj', 'value_field' => 'nilai_lpj'),
                'KONTRAK' => array('name_short' => 'KONTRAK', 'tabel' => 'kontrak_pntu'),
                'BP' => array('name_short' => 'BP', 'nomor_field' => 'no_bukti', 'value_field' => 'nilai_bukti_pengeluaran'),
                'SKP-D' => array('name_short' => 'SKR-D', 'nomor_field' => 'no_skp_d', 'value_field' => 'nilai', 'tanggal_field' => 'tanggal_skp_d', 'tabel' => 'skp_d', 'nomor' => 'SKP-D'),
                'SKR-D' => array('name_short' => 'SKP-D', 'nomor_field' => 'no_skr_d', 'value_field' => 'nilai', 'tanggal_field' => 'tanggal_skr_d', 'tabel' => 'skr_d', 'nomor' => 'SKR-D'),
                'BPEN' => array('name_short' => 'BPEN', 'nomor_field' => 'no_bukti', 'value_field' => 'nilai'),
                'STS' => array('name_short' => 'STS', 'nomor_field' => 'no_sts', 'value_field' => 'nilai', 'tanggal_field' => 'tanggal_sts', 'tabel' => 'sts', 'nomor' => 'STS'),
                'SP2D-UJI' => array('name_short' => 'SP2D-UJI', 'nomor_field' => 'no_penguji_sp2d', 'value_field' => 'nilai', 'tanggal_field' => 'tanggal', 'tabel' => 'penguji_sp2d', 'nomor' => 'SP2D-UJI'),
                'SPJ' => array('name_short' => 'SPJ', 'nomor_field' => 'no_spj', 'value_field' => 'nilai_spj', 'tanggal_field' => 'tanggal_spj', 'tabel' => 'spj', 'nomor' => 'SPJ'),
                'KAS' => array('name_short' => 'KAS', 'nomor_field' => 'no_bukti', 'value_field' => 'nilai', 'tanggal_field' => 'tgl_bukti', 'tabel' => 'mutasi_kas_bank', 'nomor' => 'KAS'),
                'PAJAK' => array('name_short' => 'PAJAK', 'nomor_field' => 'no_bukti_setoran', 'value_field' => 'nilai', 'tanggal_field' => 'tgl_setoran', 'tabel' => 'setoran_pajak', 'nomor' => 'PAJAK'),
                'PANJAR' => array('name_short' => 'PANJAR', 'nomor_field' => 'no_panjar', 'value_field' => 'nilai_panjar', 'tanggal_field' => 'tanggal_panjar', 'tabel' => 'panjar', 'nomor' => 'PANJAR'),
                'BP-PJR' => array('name_short' => 'BP_PANJAR', 'nomor_field' => 'no_bukti', 'value_field' => 'nilai_bukti_pengeluaran', 'tanggal_field' => 'tanggal_bukti', 'tabel' => 'bp_panjar', 'nomor' => 'BP-PJR'),
                'LPJ-PJR' => array('name_short' => 'LPJ_PANJAR', 'nomor_field' => 'no_lpj', 'value_field' => 'nilai_lpj', 'tanggal_field' => 'tanggal_lpj', 'tabel' => 'lpj_panjar', 'nomor' => 'LPJ-PJR'),
                'STS_P' => array('name_short' => 'STS-P', 'nomor_field' => 'nomor_sts', 'tabel' => 'pengembalian_lpj_tu', 'nomor' => 'STS-P'),
                'SP3B' => array('name_short' => 'SP3B', 'nomor_field' => 'no_sp3b', 'tabel' => 'sp3b', 'nomor' => 'SP3B'),
                'PENGEMBALIAN_LPJ' => array('name_short' => 'PENGEMBALIAN LPJ', 'nomor_field' => '', 'tabel' => 'pengembalian_lpj_tu', 'nomor' => 'PENGEMBALIAN_LPJ'),
                'PENGEMBALIAN_LPJ_PANJAR' => array('name_short' => 'PENGEMBALIAN LPJ PANJAR', 'tabel' => 'pengembalian_panjar', 'nomor' => 'PENGEMBALIAN_LPJ_PANJAR'),
                'SP2B' => array('name_short' => 'SP2B', 'nomor_field' => 'no_sp2b', 'tabel' => 'sp2b', 'nomor' => 'SP2B'),
                'STS_CP' => array('name_short' => 'STS-CP', 'nomor_field' => 'no_sts_cp', 'tabel' => 'sts_contra_post', 'nomor' => 'STS-CP')
            );
        }
        return $out[$jenis];
    }

}

if (!function_exists('get_submodul_properties_by_jenis')) {

    function get_submodul_properties_by_jenis($jenis, $modul = 'spp') {
        if (cek_jenis_sp_exist($jenis)) {
            $index_jns = get_submodul($modul);
            $jenis = !is_numeric($jenis) ? $jenis : $index_jns[($jenis - 1)];
            $out = array();
            $modul = strtolower($modul);
            if ($modul == 'spp' || $modul == 'bp' || $modul == 'sp2d') {
                $out = array(
                    'up' => array('name_short' => 'UP', 'name_long' => 'Uang Persediaan', 'tabel_spp' => 'spp_up', 'tabel_spm' => 'spm_up', 'tabel_sp2d' => 'sp2d_up', 'tabel_sp2d_pencairan' => 'pencairan_sp2d_up', 'persetujuan_jns_kode' => 1, 'nomor_spp' => 'SPP-UP', 'nomor_spm' => 'SPM-UP', 'kode_sp2d' => 1, 'nomor_sp2d' => 'SP2D-UP'),
                    'gu' => array('name_short' => 'GU', 'name_long' => 'Ganti Uang Persediaan', 'tabel_spp' => 'spp_gu', 'tabel_spm' => 'spm_gu', 'tabel_sp2d' => 'sp2d_gu', 'tabel_sp2d_pencairan' => 'pencairan_sp2d_gu', 'tabel_lpj' => 'lpj_gu', 'tabel_bp' => 'bp_gu', 'persetujuan_jns_kode' => 2, 'nomor_spp' => 'SPP-GU', 'nomor_spm' => 'SPM-GU', 'kode_sp2d' => 2, 'nomor_sp2d' => 'SP2D-GU', 'nomor_bp' => 'BP-GU', 'nomor_lpj' => 'LPJ-GU'),
                    'tu' => array('name_short' => 'TU', 'name_long' => 'Tambahan Uang Persediaan', 'tabel_spp' => 'spp_tu', 'tabel_spm' => 'spm_tu', 'tabel_sp2d' => 'sp2d_tu', 'tabel_sp2d_pencairan' => 'pencairan_sp2d_tu', 'tabel_lpj' => 'lpj_tu', 'tabel_bp' => 'bp_tu', 'persetujuan_jns_kode' => 3, 'nomor_spp' => 'SPP-TU', 'nomor_spm' => 'SPM-TU', 'kode_sp2d' => 3, 'nomor_sp2d' => 'SP2D-TU', 'nomor_bp' => 'BP-TU', 'nomor_lpj' => 'LPJ-TU'),
                    'lsbp' => array('name_short' => 'LS Belanja Pegawai', 'name_long' => 'Pembayaran Langsung Pegawai', 'tabel_spp' => 'spp_ls_pegawai', 'tabel_spm' => 'spm_ls_pegawai', 'tabel_sp2d' => 'sp2d_ls_pegawai', 'tabel_sp2d_pencairan' => 'pencairan_sp2d_ls_pegawai', 'persetujuan_jns_kode' => 4, 'nomor_spp' => 'SPP-LS', 'nomor_spm' => 'SPM-LS', 'kode_sp2d' => 4, 'nomor_sp2d' => 'SP2D-LS'),
                    'lsbj' => array('name_short' => 'LS Barang & Jasa', 'name_long' => 'Pembayaran Langsung Barang & Jasa', 'tabel_spp' => 'spp_ls_brg_js', 'tabel_spm' => 'spm_ls_brg_js', 'tabel_sp2d' => 'sp2d_ls_brg_js', 'tabel_sp2d_pencairan' => 'pencairan_sp2d_ls_brg_js', 'persetujuan_jns_kode' => 5, 'nomor_spp' => 'SPP-LS', 'nomor_spm' => 'SPM-LS', 'kode_sp2d' => 5, 'nomor_sp2d' => 'SP2D-LS'),
                    'tunihil' => array('name_short' => 'TU NIHIL', 'name_long' => 'Laporan Penggunaan TU', 'tabel_spp' => 'spp_tu_nihil', 'tabel_spm' => 'spm_tu_nihil', 'tabel_sp2d' => 'sp2d_tu_nihil', 'tabel_sp2d_pencairan' => 'pencairan_sp2d_tu_nihil', 'persetujuan_jns_kode' => 2, 'nomor_spp' => 'SPP-TU-NIHIL', 'nomor_spm' => 'SPM-TU-NIHIL', 'kode_sp2d' => 7, 'nomor_sp2d' => 'SP2D-TU-NIHIL'),
                    'gunihil' => array('name_short' => 'GU NIHIL', 'name_long' => 'Laporan Penggunaan GU', 'tabel_spp' => 'spp_gu_nihil', 'tabel_spm' => 'spm_gu_nihil', 'tabel_sp2d' => 'sp2d_gu_nihil', 'tabel_sp2d_pencairan' => 'pencairan_sp2d_gu_nihil', 'persetujuan_jns_kode' => 1, 'nomor_spp' => 'SPP-GU-NIHIL', 'nomor_spm' => 'SPM-GU-NIHIL', 'kode_sp2d' => 8, 'nomor_sp2d' => 'SP2D-GU-NIHIL'),
                    'lsskpkd' => array('name_short' => 'LS SKPKD', 'name_long' => 'Pembayaran Langsung Belanja di SKPKD', 'tabel_spp' => 'spp_ls_skpkd', 'tabel_spm' => 'spm_ls_skpkd', 'tabel_sp2d' => 'sp2d_ls_skpkd', 'tabel_sp2d_pencairan' => 'pencairan_sp2d_ls_skpkd', 'persetujuan_jns_kode' => 6, 'nomor_spp' => 'SPP-LS', 'nomor_spm' => 'SPM-LS', 'kode_sp2d' => 6, 'nomor_sp2d' => 'SP2D-LS'),
                    'pp' => array('name_short' => 'PP', 'name_long' => 'Pengembalian Penyetoran', 'tabel_spp' => 'spp_pengembalian_penyetoran', 'tabel_spm' => 'spm_pengembalian_penyetoran', 'tabel_sp2d' => 'sp2d_pengembalian_penyetoran', 'tabel_sp2d_pencairan' => 'pencairan_sp2d_pengembalian_penyetoran', 'persetujuan_jns_kode' => 9, 'nomor_spp' => 'SPP-PP', 'nomor_spm' => 'SPM-PP', 'kode_sp2d' => 9, 'nomor_sp2d' => 'SP2D-PP')
                );
            } else if ($modul = 'bpen') {
                $out = array(
                    'pajak' => array('name_short' => 'PAJAK', 'tabel' => 'bukti_penerimaan_pajak'),
                    'retribusi' => array('name_short' => 'RETRIBUSI', 'tabel' => 'bukti_penerimaan_retribusi'),
                    'pad_lain' => array('name_short' => 'PAD-LAIN', 'tabel' => 'bukti_pad_lain'),
                    'tanpa_ketetapan' => array('name_short' => 'TK', 'tabel' => 'bukti_penerimaan_tk')
                );
            }
            return $out[$jenis];
        }
        return false;
    }

}



if (!function_exists('get_status_properties')) {

    function get_status_properties($status) {
        $status = is_numeric($status) ? get_list_status($status) : $status;
        $prop = array(
            "persiapan" => array("status_value" => "Persiapan"),
            "draf" => array("status_value" => "Draf"),
            "ditolak" => array("status_value" => "Ditolak"),
            "final" => array("status_value" => "Final"),
            "belum_spp" => array("status_value" => "Belum SPP"),
            "sudah_spp" => array("status_value" => "Sudah SPP"),
            "belum_dicairkan" => array("status_value" => "Belum dicairkan"),
            "sudah_dicairkan" => array("status_value" => "Sudah dicairkan"),
            "belum_disetorkan" => array("status_value" => "Belum Disetorkan"),
            "sudah_disetorkan" => array("status_value" => "Sudah Disetorkan"),
            "belum_distskan" => array("status_value" => "Belum di-STS-kan"),
            "sudah_distskan" => array("status_value" => "Sudah di-STS-kan"),
            "belum_dikembalikan" => array("status_value" => "Belum Dikembalikan"),
            "sudah_dikembalikan" => array("status_value" => "Sudah Dikembalikan"),
            "belum_lpj" => array("status_value" => "Belum LPJ"),
            "sudah_lpj" => array("status_value" => "Sudah LPJ")
        );
        return $prop[$status];
    }

}
if (!function_exists('cek_spp_kontrak_ditolak')) {

    function cek_spp_kontrak_ditolak($uniqkode, $jnsnya) {
        $CI = & get_instance();
        $CI->load->database();
        // $redirect = KONTRAK;
        $sql = "
            SELECT 
                jumlah_spp
            FROM ( 
                SELECT
                 CASE 
                WHEN kontrak_pntu.status IN ('Sudah SPP', 'Belum SPP')
                THEN 
                    COALESCE (
                    (
                        SELECT SUM(jumlah_spp) as total
                        FROM spp_ls_brg_js  
                        WHERE kontrak_pntu_uniq_kode = kontrak_pntu.uniq_kode
                    ), 0)
                    ELSE
                    null
                END jumlah_spp
                FROM
                    kontrak_pntu
                LEFT JOIN spp_ls_brg_js spp ON spp.kontrak_pntu_uniq_kode = kontrak_pntu.uniq_kode
                                
                WHERE
                    kontrak_pntu.uniq_kode = $uniqkode
                AND spp.jumlah_spp < kontrak_pntu.nilai
                GROUP BY kontrak_pntu.uniq_kode
            ) as tabl";
        
        $out = $CI->db->query($sql)->num_rows();
        
        if (!$out) {
            return false;
            
        } else {
            $out = $CI->db->query($sql)->row()->jumlah_spp;
            return $out;
        }
    }
}

if (!function_exists('cek_status_data')) {

    /**
     * Fungsi untuk mengecek/membandingkan status setiap data
     * @param INT $uniqkode uniqkode setiap data
     * @param INT $status konstan status dimulai dengan `STATUS_` ex: `STATUS_DRAF`, `STATUS_PERSIAPAN` dll
     * @param INT $modul konstan modul ex: `SPP`, `SPM` dll
     * @param INT $submodul konstan submodul dimulai dengan KODE_ ex: `KODE_UP`,`KODE_TU` dll
     * @param STRING $redirect secara default bernilai false akan mengembalikan nilai jika terisi maka me-redirect ke URL yang diinputkan 
     * @return BOOLEAN jika parameter redirect terisi tidak mengembalikan nilai
     */
    function cek_status_data($uniqkode, $status, $modul, $submodul = false, $redirect = false) {
        $CI = & get_instance();
        $CI->load->database();
        $status = get_status_properties($status);
        $status = $status['status_value'];
        $stat_tbl = "";
        $tbl = "";
        $status_field = "status";
        $uniq_field = "uniq_kode";
        $jns_field = "";
        if ($modul == BP) {
            $prop = get_submodul_properties_by_jenis($submodul);
            $stat_tbl = $prop['tabel_bp'];
        } else if ($modul == BPEN) {
            $prop = get_submodul_properties_by_jenis($submodul, 'bpen');
            $stat_tbl = $prop['tabel'];
        } else if ($modul == SP2D) {
            $prop = get_submodul_properties_by_jenis($submodul);
            $stat_tbl = $prop['tabel_sp2d_pencairan'];
            $uniq_field = substr($stat_tbl, 10) . '_uniq_kode';
        } else if (in_array($modul, array(SPP, SPM, LPJ, SPJ, LPJ_PANJAR))) {
            $mdl = get_modul(($modul - 1));
            $mprop = get_modul_properties_by_jenis($mdl);
            if (in_array($modul, array(SPP, SPM, LPJ))) {
                $jns_field = 'jns_' . strtolower($mprop['name_short']) . "_kode";
                $sprop = get_submodul_properties_by_jenis($submodul);
                $kdjns = $sprop['persetujuan_jns_kode'];
                if ($modul == LPJ) {
                    $kdjns--;
                }
            }
            $stat_tbl = 'persetujuan_' . strtolower($mprop['name_short']) . (($submodul == KODE_GU_NIHIL || $submodul == KODE_TU_NIHIL) ? '_nihil' : '');
            $uniq_field = strtolower($mprop['name_short']) . "_uniq_kode";
            $status_field = 'persetujuan';
        } else {
            if ($modul == PENGEMBALIAN_LPJ_PANJAR) {
                $uniq_field = 'lpj_panjar_uniq_kode';
            }
            $prop = get_modul_properties_by_jenis($modul);
            $stat_tbl = $prop['tabel'];
        }

//        $where = array($uniq_field => $uniqkode, $status_field => $status);
        $where = array($uniq_field => $uniqkode);
        if ($jns_field != '') {
            $where[$jns_field] = $kdjns;
        }
        $field = array($uniq_field, $status_field);
        $CI->db->select($field);
        $CI->db->from($stat_tbl);
        $CI->db->where($where);
        $CI->db->limit(1);
        $CI->db->order_by('date_added', 'DESC');
        $out = $CI->db->get()->row();
        $out = ($status == (($out) ? $out->$status_field : false));
        if ($redirect) {
            if (!$out) {
                redirect($redirect);
            }
        } else {
            return $out;
        }
    }

}
if (!function_exists('cek_is_data_owner')) {

    /**
     * Fungsi untuk mengecek bahwa data adalah milik nip tertentu
     * @param INT $uniqkode uniqkode setiap data 
     * @param INT $nip NIP penginput data
     * @param INT $modul konstan modul ex: `SPP`, `SPM` dll
     * @param INT $submodul konstan submodul dimulai dengan KODE_ ex: `KODE_UP`,`KODE_TU` dll
     * @param STRING $redirect secara default bernilai false akan mengembalikan nilai jika terisi maka me-redirect ke URL yang diinputkan 
     * @return BOOLEAN jika parameter redirect terisi tidak mengembalikan nilai
     */
    function cek_is_data_owner($uniqkode, $nip, $modul, $submodul = false, $redirect = false) {
        $CI = & get_instance();
        $CI->load->database();
        $tabel = "";
        $mprop = get_modul_properties_by_jenis($modul);

        if (in_array($modul, array(SPP, SPM, SP2D, LPJ, BP)) && $submodul) {
            $sprop = get_submodul_properties_by_jenis($submodul);
            $tabel = $sprop['tabel_' . strtolower($mprop['name_short'])];
        } else if ($modul == BPEN && $submodul) {
            $sprop = get_submodul_properties_by_jenis($submodul, 'bpen');
            $tabel = $sprop['tabel'];
        } else {
            $tabel = $mprop['tabel'];
        }
        $where = array('uniq_kode' => $uniqkode, 'nip_penginput' => $nip);
        $field = array('uniq_kode');
        $CI->db->select($field);
        $CI->db->from($tabel);
        $CI->db->where($where);
        $CI->db->limit(1);
        $out = $CI->db->get()->num_rows();
        if ($redirect) {
            if (!$out) {
                redirect($redirect);
            }
        } else {
            return $out;
        }
    }

}
if (!function_exists('cek_is_data_org_owner')) {

    /**
     * Fungsi untuk mengecek bahwa data adalah milik org tertentu
     * @param INT $uniqkode uniqkode setiap data 
     * @param INT $org_key Organisasi key penginput data
     * @param INT $modul konstan modul ex: `SPP`, `SPM` dll
     * @param INT $submodul konstan submodul dimulai dengan KODE_ ex: `KODE_UP`,`KODE_TU` dll
     * @param STRING $redirect secara default bernilai false akan mengembalikan nilai jika terisi maka me-redirect ke URL yang diinputkan 
     * @return BOOLEAN jika parameter redirect terisi tidak mengembalikan nilai
     */
    function cek_is_data_org_owner($uniqkode, $org_key, $modul, $submodul = false, $redirect = false) {
        $CI = & get_instance();
        $CI->load->database();
        $tabel = "";
        $mprop = get_modul_properties_by_jenis($modul);

        if (in_array($modul, array(SPP, SPM, SP2D, LPJ, BP)) && $submodul) {
            $sprop = get_submodul_properties_by_jenis($submodul);
            $tabel = $sprop['tabel_' . strtolower($mprop['name_short'])];
        } else if ($modul == BPEN && $submodul) {
            $sprop = get_submodul_properties_by_jenis($submodul, 'bpen');
            $tabel = $sprop['tabel'];
        } else {
            $tabel = $mprop['tabel'];
        }
        $where = array('uniq_kode' => $uniqkode, 'kr_organisasi_org_key' => $org_key);
        $field = array('uniq_kode');
        $CI->db->select($field);
        $CI->db->from($tabel);
        $CI->db->where($where);
        $CI->db->limit(1);
        $out = $CI->db->get()->num_rows();
        if ($redirect) {
            if (!$out) {
                redirect($redirect);
            }
        } else {
            return $out;
        }
    }

}
if (!function_exists('cek_is_data_parent_owner')) {

    /**
     * Fungsi untuk mengecek bahwa data adalah milik skpd tertentu
     * @param INT $uniqkode uniqkode setiap data 
     * @param INT $parent_id parent_id penginput data
     * @param INT $modul konstan modul ex: `SPP`, `SPM` dll
     * @param INT $submodul konstan submodul dimulai dengan KODE_ ex: `KODE_UP`,`KODE_TU` dll
     * @param STRING $redirect secara default bernilai false akan mengembalikan nilai jika terisi maka me-redirect ke URL yang diinputkan 
     * @return BOOLEAN jika parameter redirect terisi tidak mengembalikan nilai
     */
    function cek_is_data_parent_owner($uniqkode, $parent_id, $modul, $submodul = false, $redirect = false) {
        $CI = & get_instance();
        $CI->load->database();
        $tabel = "";
        $mprop = get_modul_properties_by_jenis($modul);
        $parent_sql = "k.parent_id= " . $parent_id;
        if (in_array($modul, array(SPP, SPM, SP2D, LPJ, BP)) && $submodul) {
            $sprop = get_submodul_properties_by_jenis($submodul);
            $tabel = $sprop['tabel_' . strtolower($mprop['name_short'])];
//            if($submodul==KODE_LS_BLUD && $modul == SPP){
            $parent_sql = "(k.parent_id IS NULL OR k.parent_id =" . $parent_id . ")";
//            }
        } else if ($modul == BPEN && $submodul) {
            $sprop = get_submodul_properties_by_jenis($submodul, 'bpen');
            $tabel = $sprop['tabel'];
        } else {
            $tabel = $mprop['tabel'];
        }
        $sql = "SELECT t.uniq_kode FROM " . $tabel . " t ";
        $sql .= "INNER JOIN kr_organisasi k ";
        $sql .= "ON t.kr_organisasi_org_key = k.org_key ";
        $sql .= "WHERE " . $parent_sql;
        $sql .= " AND ";
        $sql .= " t.uniq_kode =" . $uniqkode;
        $out = $CI->db->query($sql)->num_rows();
        if ($redirect) {
            if (!$out) {
                redirect($redirect);
            }
        } else {
            return $out;
        }
    }

}
if (!function_exists('cek_org_is_child')) {

    /**
     * Fungsi untuk mengecek bahwa sebuah Unit adalah anak dari SKPD
     * @param INT $orgkey Orgkey unit
     * @param INT $parent_id Orgkey parent/skpd 
     * @param STRING $redirect secara default bernilai false akan mengembalikan nilai, jika terisi maka me-redirect ke URL yang diinputkan 
     */
    function cek_org_is_child($orgkey, $parent_id, $redirect = false) {
        $CI = & get_instance();
        $CI->load->database();
        $CI->db->select('org_key');
        $CI->db->from('kr_organisasi');
        if ($orgkey == $parent_id) {
            $CI->db->where('org_key', $parent_id);
        } else {
            $CI->db->where(array('parent_id' => $parent_id, 'org_key' => $orgkey));
        }
        $out = $CI->db->get()->row();
        if ($redirect) {
            if (!$out) {
                redirect($redirect);
            }
        } else {
            return $out;
        }
    }

}

if (!function_exists('cek_is_not_selected')) {

    function cek_is_not_selected($uniqkode, $modul_a_a, $submodul_a = false, $modul_a_b = false) {
//        $CI = & get_instance();
//        $CI->load->database();
//        $tabel = "";
//        $mprop = get_modul_properties_by_jenis($modul_a);
//
//        //berdasarkan eksistensi di modul lain
//        if (in_array($modul_a, array(SPP, SPM, SP2D, LPJ, BP, SKP_D, SKR_D, KAS, STS, SP2D_UJI,)) && $submodul) {
//            $sprop = get_submodul_properties_by_jenis($submodul);
//            $tabel = $sprop['tabel_' . strtolower($mprop['name_short'])];
//        } else if ($modul_a == BPEN && $submodul) {
//            $sprop = get_submodul_properties_by_jenis($submodul, 'bpen');
//            $tabel = $sprop['tabel'];
//        } else {
//            $tabel = $mprop['tabel'];
//        }
//        $where = array('uniq_kode' => $uniqkode, 'nip_penginput' => $nip);
//        $field = array('uniq_kode');
//        $CI->db->select($field);
//        $CI->db->from($tabel);
//        $CI->db->where($where);
//        $CI->db->limit(1);
//        $out = $CI->db->get()->num_rows();
//        if ($redirect) {
//            if (!$out) {
//                redirect($redirect);
//            }
//        } else {
//            return $out;
//        }
        return true;
    }

}
if (!function_exists('cek_is_selected')) {

    /**
     * Fungsi pengecekan apakah data sebuah modul terdapat pada modul lain
     * @param INT $uniqkode uniq_kode dari modul asal
     * @param type $modul_asal modul asal yang akan dicari pada modul cari
     * @param type $modul_cari modul tujuan pencarian data
     * @param type $submodul_asal submodul asal
     * @param type $submodul_cari submodul cari
     * @return boolean
     */
    function cek_is_selected($uniqkode, $modul_asal, $modul_tujuan, $submodul_a = false, $submodul_b = false, $redirect = false) {
        $CI = & get_instance();
        $CI->load->database();
        $tabel = "";
        $mprop = get_modul_properties_by_jenis($modul_asal);
        $tabel_tujuan = "";
        $kolom_tujuan = "";
        $custom_query = "";
        if (in_array($modul_tujuan, array(SPM))) {
//            $sprop = get_submodul_properties_by_jenis($submodul_a);
//            $alias ="spm";
//            $tabel_tujuan = $sprop['tabel_spm']." spm";
//            $kolom_tujuan = $sprop['tabel_spp']."_uniq_kode";
            $custom_query = "SELECT (CASE
                                        WHEN p.persetujuan = 'Dihapus' THEN 0
                                        ELSE 1
                                    END) output
                            FROM spm_ls_blud s
                            LEFT JOIN
                              (SELECT spm_uniq_kode,
                                      date_added,
                                      persetujuan
                               FROM persetujuan_spm
                               WHERE jns_spm_kode=7) p ON s.uniq_kode=p.spm_uniq_kode
                            WHERE spp_ls_blud_uniq_kode = $uniqkode ORDER BY p.date_added DESC LIMIT 1";
        }
        if ($custom_query) {
            $out = $CI->db->query($custom_query)->row();
            $out = $out->output;
        } else {
            $where = array($kolom_tujuan => $uniqkode);
            $field = array('uniq_kode');
            $CI->db->select($field);
            $CI->db->from($tabel_tujuan);
            $CI->db->where($where);
            $CI->db->limit(1);
            $out = $CI->db->get()->num_rows();
        }
        if ($redirect) {
            if (!$out) {
                redirect($redirect);
            }
        } else {
            return $out;
        }
        return $out;
    }

}
if (!function_exists('cek_is_mengampu_org')) {

    /**
     * Cek apakah BUD Mengampu organisasi
     * @param type $nip NIP BUD
     * @param type $org_key Org Key organisasi yang diampu
     */
    function cek_is_mengampu_org($nip, $org_key, $redirect = false) {
        $CI = & get_instance();
        $where = array('nip' => $nip, 'kr_organisasi_org_key' => $org_key);
        $field = array('uniq_kode');
        $CI->db->select($field);
        $CI->db->from('bud_organisasi');
        $CI->db->where($where);
        $CI->db->limit(1);
        $out = $CI->db->get()->num_rows();
        if ($redirect) {
            if (!$out) {
                redirect($redirect);
            }
        } else {
            return $out;
        }
        return $out;
    }

}

if (!function_exists('generate_nomor')) {

    /**
     * Fungsi untuk men-generate nomor modul dan submodul pada sistem E-Penatausahaan
     * @param INT $korg kr_organisasi_org_key
     * @param INT $kode_modul diisi dengan Constant sesuai nama Modul Misal: SPP,SKP_D
     * @param INT $kode_sub diisi jika modul mempunyai submodul(SPP,SPM,SP2D,LPJ,BP) 
     * isi dengan Constant sesuai nama Submodul diawali dengan 'KODE_' Misal: KODE_UP,KODE_TU
     * @return String
     */
    function generate_nomor($korg, $kode_modul, $kode_sub = false, $tanggal_data = false) {
        $CI = & get_instance();
        $CI->load->database();

        $tanggal_data = $tanggal_data ? "TIMESTAMP '" . $tanggal_data . "'" : 'NOW()';
        $properties = array();
        $modul_properties = get_modul_properties_by_jenis($kode_modul);
        $properties['nomor_field'] = $modul_properties['nomor_field'];
        $sub_properties = array();
        if ((in_array($kode_modul, array(SPP, SPM, SP2D, LPJ, BP))) && $kode_sub) {
            $sub_properties = get_submodul_properties_by_jenis($kode_sub);
//            print_r_pre(get_submodul_properties_by_jenis(9),true);
            $properties['tabel'] = $sub_properties['tabel_' . strtolower($modul_properties['name_short'])];
            $properties['series_no'] = $sub_properties['nomor_' . strtolower($modul_properties['name_short'])];
            if ($sub_properties['persetujuan_jns_kode'] >= 4 && $sub_properties['persetujuan_jns_kode'] <= 7) {
                $properties['tabel'] = "(SELECT uniq_kode, " . $modul_properties['nomor_field'] . ",kr_organisasi_org_key FROM " . strtolower($modul_properties['name_short']) . "_ls_skpkd
                                        UNION
                                        SELECT uniq_kode," . $modul_properties['nomor_field'] . ",kr_organisasi_org_key FROM " . strtolower($modul_properties['name_short']) . "_ls_brg_js
                                        UNION
                                        SELECT uniq_kode," . $modul_properties['nomor_field'] . ",kr_organisasi_org_key FROM " . strtolower($modul_properties['name_short']) . "_ls_blud
                                        UNION 
                                        SELECT uniq_kode," . $modul_properties['nomor_field'] . ",kr_organisasi_org_key FROM " . strtolower($modul_properties['name_short']) . "_ls_pegawai) data_ls";
            }
        } else if (in_array($kode_modul, array(SKP_D, SKR_D, STS, SP2D_UJI, SPJ, KAS, PANJAR, BUKTI_PENERIMAAN_PANJAR, LPJ_PANJAR, PAJAK, STS_P, SP3B, SP2B, STS_CP))) {
            $properties['tabel'] = $modul_properties['tabel'];
            $properties['series_no'] = $modul_properties['nomor'];
        } else if ($kode_modul == BPEN && $kode_sub) {
            $sub_properties = get_submodul_properties_by_jenis($kode_sub, 'bpen');
            $properties['tabel'] = $sub_properties['tabel'];
            $properties['series_no'] = 'BPEN-' . $sub_properties['name_short'];
        }
        if ($kode_modul == SP2D) {
            $properties['tabel'] = $sub_properties['tabel_sp2d'];
            $sql = "SELECT CONCAT(
                    " . KODE_PROVINSI . "," .
                    $sub_properties['kode_sp2d'] . ",
                        CASE WHEN MAX (
                            CASE WHEN no_sp2d ~ E'^\[0-9]+$' THEN RIGHT (no_sp2d, 5) ELSE NULL END
                        ) IS NULL THEN '00001'
			ELSE RIGHT (CONCAT ('00000',
                                    (SELECT CASE WHEN new_series IS NULL THEN (SELECT (MAX(RIGHT(no_sp2d,5))::INT) + 1 FROM " . $properties['tabel'] . ") ELSE new_series END
                                    FROM (
                                    SELECT MIN(series) new_series FROM(
                                            SELECT
                                                    uniq_kode,s.series
                                            FROM
                                                    " . $properties['tabel'] . " 
                                            RIGHT JOIN 
                                            (SELECT generate_series(1,(SELECT max(RIGHT(no_sp2d,5))::INT FROM  " . $properties['tabel'] . " )) series) s
                                            ON s.series=(RIGHT(no_sp2d,5))::INT
                                    ) kosong
                                    WHERE uniq_kode IS NULL
                                    ) ns)
                        ),5) END 
                    )
                nomor_baru";
            $sql .= " FROM " . $properties['tabel'];
        } else if (in_array($kode_modul, array(STS, BPEN, SKP_D, SKR_D))) {
            //generate nomor model 2, terus mengisi nomor yang kosong
            $sql = "
                SELECT
                    (SELECT 
                CASE 
                        WHEN
                            (SELECT " . $properties['nomor_field'] . "
                                    FROM " . $properties['tabel'] . "
                            WHERE kr_organisasi_org_key=$korg
                            LIMIT 1) IS NULL 
                        THEN '00001'
                        ELSE
                            (SELECT RIGHT (CONCAT ('00000',
                                (SELECT 
                                    CASE 
                                        WHEN new_series IS NULL 
                                                THEN (SELECT (MAX(SUBSTR(" . $properties['nomor_field'] . ",1,5))::INT) + 1 FROM " . $properties['tabel'] . " WHERE kr_organisasi_org_key=$korg) 
                                        ELSE new_series 
                                    END
                                FROM (
                                SELECT MIN(series) new_series FROM(
                                    SELECT
                                            tabel.uniq_kode,s.series
                                    FROM
                                            (SELECT * FROM " . $properties['tabel'] . " WHERE kr_organisasi_org_key=$korg) tabel
                                            RIGHT JOIN
                                            (SELECT generate_series(1,(SELECT max(substr(" . $properties['nomor_field'] . ",1,5))::INT FROM  " . $properties['tabel'] . " WHERE kr_organisasi_org_key=$korg)) series) s 
                                    ON s.series=((substr(" . $properties['nomor_field'] . ",1,5))::INT)
                                ) kosong
                                WHERE uniq_kode IS NULL
                                    ) ns)
                                ),5)
                            )
                END
		) 
		||'/'|| '" . $properties['series_no'] . "'
		||'/'||(SELECT CONCAT(kr_urusan_daerah_kode,'.',kode) kdorg FROM kr_organisasi WHERE org_key=$korg) 
		||'/'||(SELECT RIGHT(CONCAT('0',DATE_PART('month',$tanggal_data)),2))
		||'/'||(SELECT DATE_PART('year',$tanggal_data) :: INT) nomor_baru";
        } else {
            $sql = "SELECT CONCAT(
                (CASE WHEN MAX(LEFT(" . $properties['nomor_field'] . ",5)) IS NULL THEN '00001' ELSE RIGHT(CONCAT('00000',(MAX(LEFT(" . $properties['nomor_field'] . ",5)):: INT +1)),5) END),
                '/',
                '" . $properties['series_no'] . "',
                '/',
                (SELECT CONCAT(kr_urusan_daerah_kode,'.',kode) kdorg FROM kr_organisasi WHERE org_key=$korg),
                '/',
                (SELECT RIGHT(CONCAT('0',DATE_PART('month',$tanggal_data)),2)),
                '/',
                (SELECT DATE_PART('year',$tanggal_data) :: INT)
                )
                nomor_baru";
            $sql .= " FROM " . $properties['tabel'];
            if(!in_array($kode_modul, array(SP2B))){
                $sql .= " WHERE kr_organisasi_org_key=$korg";
            }
        }


        $no = $CI->db->query($sql)->row();
        return $no->nomor_baru;
    }

}

//    function get_unblocked_sub_modules() {
//        $unblocked = array('ls_belanja_pegawai', 'register', 'bku', 'dth', 'bpp', 'rth');
//        return $unblocked;
//    }
//
//    function get_unblocked_modules() {
//        $unblocked = array('dashboard', 'spp', 'spm', 'sp2d', 'pembukuan/pengeluaran', 'data', 'pengampu');
//        return $unblocked;
//    }
//
//    function is_unblocked($modul, $submodul = false) {
//        $is_blocked = in_array($modul, get_unblocked_modules());
//        if ($submodul) {
//            $is_blocked = $is_blocked && in_array($submodul, get_unblocked_sub_modules());
//        }
//        $is_blocked = !BLOCK_STATUS? : $is_blocked;
//        return $is_blocked;
//    }
//
//    function cek_blocked_menu($uri, $url = '') {
//        $data_uri = explode('_', $uri);
//        $modul = "";
//        $submodul = "";
//        if (in_array($data_uri[0], get_unblocked_modules())) {
//            $modul = $data_uri[0];
//            array_splice($data_uri, 0, 1);
//            $submodul = implode("_", $data_uri);
//        }
//        if (!is_unblocked($modul, $submodul)) {
//            redirect($url);
//        }
//    }
    if (!function_exists('get_menu')) {

        function get_menu() {
            $CI = & get_instance();
            $CI->db->order_by('position', 'ASC');
            return $CI->db->get('epen_menu')->result();
        }

    }
    if (!function_exists('get_sub_menu')) {

        function get_sub_menu($menu_uniq_kode) {
            $CI = & get_instance();
            $CI->db->where('menu_uniq_kode', $menu_uniq_kode);
            $CI->db->order_by('position', 'ASC');
            return $CI->db->get('epen_submenu')->result();
        }

    }
    if (!function_exists('get_all_menu')) {

        function get_all_menu($roles = false, $other_cond = false) {
            $CI = & get_instance();
            $sql = "SELECT * FROM epen_menu";
            $sql.= $roles ? " WHERE array['$roles'] <@ string_to_array(roles,';')" : "";
            $sql.= $other_cond ? " AND string_to_array(other_condition,';') @> array['$other_cond']" : ($roles == 'bud' ? "" : " AND (other_condition_only IS NULL OR other_condition_only ='0')");
            $sql.= " ORDER BY position";
            return $CI->db->query($sql)->result();
        }

    }
    if (!function_exists('get_all_sub_menu')) {

        function get_all_sub_menu($menu_uniq_kode, $roles = false, $other_cond = false) {
            $CI = & get_instance();
            $sql = "SELECT *
                    FROM epen_submenu WHERE menu_uniq_kode=$menu_uniq_kode";
            $sql.= $roles ? " AND CASE WHEN roles IS NOT NULL THEN (array['$roles'] <@ string_to_array(roles,';')) ELSE true END" : "";
            $sql.= $other_cond ? " AND string_to_array(other_condition,';') @> array['$other_cond']" : ($roles == 'bud' ? "" : " AND (other_condition_only IS NULL OR other_condition_only ='0')");
            $sql.= " ORDER BY position";
            return $CI->db->query($sql)->result();
        }

    }
    if (!function_exists('get_url_sub_menu')) {

        function get_url_sub_menu($menu_uniq_kode, $roles = false, $other_cond = false) {
            $CI = & get_instance();
            $query = get_all_sub_menu($menu_uniq_kode, $roles, $other_cond);
            $out = array();
            foreach ($query as $row) {
                $divide = explode('/', $row->url);
                $out[] = $divide[0];
            }
            return $out;
        }

    }
    if (!function_exists('get_field_sub_menu')) {

        function get_field_sub_menu($menu_uniq_kode, $field) {
            $CI = & get_instance();
            $CI->db->select($field);
            $CI->db->where(array('menu_uniq_kode' => $menu_uniq_kode));
            $out = array();
            $query = $CI->db->get('epen_submenu')->result();
            foreach ($query as $row) {
                $divide = explode('/', $row->$field);
                $out[] = $divide[0];
            }
            return $out;
        }

    }
    if (!function_exists('get_menu_url')) {

        function get_menu_url($rawurl) {
            $CI = & get_instance();
            $sql = "SELECT url FROM 
                    (
                        SELECT  
                            CASE WHEN (TRIM(m .url) = '' OR m.url IS NULL) 
                            THEN s.url ELSE m.url END url 
                        FROM epen_menu m 
                        LEFT JOIN epen_submenu s  
                        ON s.menu_uniq_kode = m.uniq_kode
                   ) dat
                    WHERE '$rawurl' LIKE 
                    '%' || 
                    (CASE WHEN url LIKE 'register%' THEN (string_to_array(url,'/'))[1] ELSE url END )
                    ||'%' 
                    ORDER BY LENGTH(url) DESC;";
//                    WHERE '$rawurl' LIKE '%' || url ||'%' ORDER BY LENGTH(url) DESC;";
            $out = $CI->db->query($sql)->row();
            return $out ? $out->url : false;
        }

    }
    if (!function_exists('menu_blocking_properties')) {

        function menu_blocking_properties($url) {
            $url = get_menu_url($url);
            if (!$url) {
                $divide = explode('/', $url);
                $url = $divide[0];
            }
            $CI = & get_instance();
            $sql = "SELECT 
                        CASE WHEN (TRIM(m .url) = '' OR m.url IS NULL) THEN s.url ELSE m.url END menu_url,
                        CASE WHEN (TRIM(s .roles) = '' OR s.roles IS NULL) THEN m.roles ELSE s.roles END menu_roles,
            m.blocked mblock,
            s.blocked sblock,
                        CASE WHEN m .blocked::INT = 0 AND s.uniq_kode IS NOT NULL THEN s.blocked ELSE m.blocked END,
                        s.uniq_kode s_uniq_kode
                    FROM 
                        epen_menu m
                    LEFT JOIN epen_submenu s ON m .uniq_kode = s.menu_uniq_kode
                    WHERE m .url LIKE '$url%' OR s.url LIKE '$url' ";
            $out = $CI->db->query($sql)->row();
            return $out;
        }

    }
    if (!function_exists('block_menu')) {

        function block_menu($url, $role, $parent) {
            $menu = menu_blocking_properties($url);
            $is_role_allowed = array();
            $blocked = false;
            $allowed = $menu->s_uniq_kode?is_sub_menu_allowed($parent, $menu->s_uniq_kode):true;
            if ($menu) {
                $roles = explode(";", $menu->menu_roles);
                $blocked = $menu->blocked;
                $is_role_allowed = in_array($role, $roles);
            }
            if ($blocked || !$is_role_allowed) {
                //cek diperbolehkan
                if (!$allowed) {
                    redirect(base_url());
                }
            }
        }

    }
    if (!function_exists('is_sub_menu_allowed')) {

        function is_sub_menu_allowed($parent, $uniq) {
            $parent_id="";
            if(is_array($parent)){
                $p_sz =sizeof($parent);
                for($i=0;$i<$p_sz;$i++){
                    $parent_id.="'".$parent[$i]."'";
                    if($i<$p_sz-1){
                        $parent_id.=",";
                    }
                } 
            }else{
                $parent_id = "'".$parent."'";
            }
            $CI = & get_instance();
            $sql = "SELECT ep.uniq_kode FROM
                    epen_advance_menu_blocking ep 
                    INNER JOIN 
                    epen_submenu es
                    ON ep.source_uniq_kode = es.uniq_kode
                    WHERE ep.source_tipe=2 AND array[$parent_id] && string_to_array(allowed_parent, ';')
                    AND es.uniq_kode='$uniq';";
            $out = $CI->db->query($sql)->row();
            $out = $out ? $out->uniq_kode : false;
            return $out;
        }

    }

    if (!function_exists('get_user_role_list')) {

        function get_user_role_list($username, $role, $org, $rolesonly = false) {
            $CI = & get_instance();

            $sql = "
        SELECT uniq_kode,kr_organisasi_org_key org,unit_kerja_simpeg,alias_role_name FROM function_user_organisasi(6) AS (
            uniq_kode BIGINT,
            \"name\" VARCHAR,
            \"password\" VARCHAR,
            nama VARCHAR,
            parent_id BIGINT,
            kr_organisasi_org_key BIGINT,
            unit_kerja_simpeg VARCHAR,
            parent VARCHAR,
            uniq_kode_role BIGINT,
            alias_role_name VARCHAR,
            status_id BIGINT,
            set_status BIGINT,
            uniq_kode_pegawai BIGINT
        )

        WHERE name = '$username'";
            $roles = array();
            $detail = '';
            $i = 0;
            foreach ($data = $CI->db->query($sql)->result() as $row) {
                $roles[$i] = $row->alias_role_name;
                $data[$i++]->org_en = enkripsi($row->org);
            }
//        print_r_pre($data);
            if (sizeof($roles) > 1 && in_array($role, $roles)) {
                $out = array();
                $i = 0;
                foreach ($roles as $row) {
                    if ($row == $role && $org == $data[$i]->org) {
                        unset($roles[$i]);
                        unset($data[$i]);
                    }
                    $i++;
                }
                $out = $data;
                if ($rolesonly) {
                    $out = $roles;
                }
                return $out;
            } else {
                return false;
            }
        }

    }

    if (!function_exists('get_user_role_detail')) {

        function get_user_role_detail($username, $role, $org, $uniq=false) {
            $uro=false;
            if(($uro= $username && $role && $org) || $uniq){
                $CI = & get_instance();
                $sql = "
                SELECT uniq_kode,name,nama,parent_id,kr_organisasi_org_key,uniq_kode_role,alias_role_name FROM function_user_organisasi(6) AS (
                    uniq_kode BIGINT,
                    \"name\" VARCHAR,
                    \"password\" VARCHAR,
                    nama VARCHAR,
                    parent_id BIGINT,
                    kr_organisasi_org_key BIGINT,
                    unit_kerja_simpeg VARCHAR,
                    parent VARCHAR,
                    uniq_kode_role BIGINT,
                    alias_role_name VARCHAR,
                    status_id BIGINT,
                    set_status BIGINT,
                    uniq_kode_pegawai BIGINT
                )

                WHERE";
               $sql.=($uro)?" name = '$username' AND alias_role_name='$role' AND kr_organisasi_org_key ='$org'":($uniq?" uniq_kode_pegawai='$uniq'":"");

                return $CI->db->query($sql)->row();
            }else{
                return false;
            }
        }

    }

//    if (!function_exists('cek_roles')) {
//
//        function cek_roles($username, $role, $rolesonly = false) {
//            $CI = & get_instance();
//
//            $sql = "
//        SELECT * FROM function_user_organisasi(6) AS (
//            uniq_kode BIGINT,
//            \"name\" VARCHAR,
//            \"password\" VARCHAR,
//            nama VARCHAR,
//            parent_id BIGINT,
//            kr_organisasi_org_key BIGINT,
//            unit_kerja_simpeg VARCHAR,
//            parent VARCHAR,
//            uniq_kode_role BIGINT,
//            alias_role_name VARCHAR,
//            status_id BIGINT,
//            set_status BIGINT,
//            uniq_kode_pegawai BIGINT
//        )
//
//        WHERE name = '$username'";
//            $roles = array();
//            $detail = '';
//            foreach ($data = $CI->db->query($sql)->result() as $row) {
//                $roles[] = $row->alias_role_name;
//            }
////        print_r_pre($data);
//            if (sizeof($roles) > 1 && in_array($role, $roles)) {
//                $out = array();
//                $i = 0;
//                foreach ($roles as $row) {
//                    if ($row == $role) {
//                        unset($roles[$i]);
//                        $detail = $data[$i];
//                    }
//                    $i++;
//                }
//                $out['roles'] = $roles;
//                $out['detail'] = $detail;
//                if ($rolesonly) {
//                    $out = $roles;
//                }
//                return $out;
//            } else {
//                return false;
//            }
//        }
//
//    }
    /**
     * Fungsi untu cek apakah BUD mengampu RS/BLUD
     * @param string $nip NIP BUD
     * @return boolean true jika mengampu RS
     */
    function is_pengampu_blud($nip) {
        $CI = & get_instance();
        $sql = "SELECT org_key,uraian nama_skpd,bud_organisasi.user_uniq_kode
                FROM (SELECT org_key,uraian FROM kr_organisasi WHERE parent_id IS NULL) org
                LEFT JOIN bud_organisasi ON org.org_key = bud_organisasi.kr_organisasi_org_key
        WHERE  bud_organisasi.nip='$nip' AND (uraian ILIKE '%RSUD%' OR uraian ILIKE '%RSJD%')";
        return $CI->db->query($sql)->num_rows();
    }

    /**
     * Fungsi untu cek apakah BUD mengampu SKPKD
     * @param string $nip NIP BUD
     * @return boolean true jika mengampu SKPKD
     */
    function is_pengampu_skpkd($nip) {
        $CI = & get_instance();
        $sql = "SELECT org_key,uraian nama_skpd,bud_organisasi.user_uniq_kode
                FROM (SELECT org_key,uraian FROM kr_organisasi WHERE parent_id IS NULL) org
                LEFT JOIN bud_organisasi ON org.org_key = bud_organisasi.kr_organisasi_org_key
        WHERE  bud_organisasi.nip='$nip' AND uraian ILIKE '%SKPKD%'";
        return $CI->db->query($sql)->num_rows();
    }
    
    function get_org_key_bud($nip){
        $CI = & get_instance();
        $sql = "SELECT kr_organisasi_org_key FROM bud_organisasi WHERE nip='$nip'";
        $que =$CI->db->query($sql);
        $out = "";
        $jml_row =$que->num_rows();
        if($jml_row>1){
            foreach($que->result() as $row){
                $out[]= $row->kr_organisasi_org_key;
            }
        }else if($jml_row==1){
            $out = $que->row();
            $out =$out->kr_organisasi_org_key;
        }
        return $out;
    }
    /*
     * Fungsi untuk generate ulang NO dengan tanggal baru 
     * @param string $no Nomor dokumen
     * @param string $tanggal tanggal format Y-m-d
     * @return string Nomor baru
     */
    function revisi_no_bulan($no,$tanggal){
        $xno = explode('/',$no);
        $blnpos = sizeof($xno)-2;
        $xno[$blnpos] = date('m',strtotime($tanggal));
        $out = implode("/", $xno);
        return $out;
    }
    
    /**
     * Fungsi untuk cek status seluruh tombol 'Aksi' yang terdapat pada daftar
     * @param type $btn Constant jenis tombol ex: BUTTON_ADD, BUTTON_EDIT, BUTTON_PRINT, dll.
     * @param type $menu Constant Menu ex: SP2D, SPP , dll.
     * @param type $sub Constant SubMenu ex: KODE_UP, KODE_GU
     */
    function button_status($btn,$menu,$sub=false){
        //nanti semua setting di-Database-kan
        $btn_delete_status=false;
        
        if($menu==SP2D){
            if($btn==BUTTON_DELETE){
                return $btn_delete_status;
            }
        }
        return true;
    }



