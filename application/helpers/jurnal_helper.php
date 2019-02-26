<?php

if (!function_exists('cek_kondisi_jurnal_akrual')) {

    function cek_kondisi_jurnal_akrual($namamodul, $status, $jns_transaksi) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = "SELECT kondisi.uniq_kode
                FROM master_kondisi_jurnal_akrual kondisi
                JOIN master_modul_jurnal_akrual modul 
                ON kondisi.master_modul_jurnal_akrual_uniq_kode = modul.uniq_kode
                JOIN master_status_jurnal_akrual status 
                ON kondisi.master_status_jurnal_akrual_uniq_kode = status.uniq_kode
                WHERE (modul.uraian = lower('$namamodul') OR modul.uraian = '$namamodul') AND status.uraian ILIKE '%$status%' AND kondisi.jenis_transaksi ILIKE '%$jns_transaksi%';";
        return $CI->db->query($sql)->result();
    }

}

if (!function_exists('get_data_nominal_for_jurnal')) {

    function get_data_nominal_for_jurnal($namamodul = '', $submodul = '', $uniq_kode = 0) {
        $CI = & get_instance();
        $CI->load->database();
        if ($namamodul == 'bp') {

            $sql = "
            SELECT
            all_bp.*,
            CONCAT(akun5.kr_akun_level1_kode, '.', akun5.kr_akun_level2_kode, '.', akun5.kr_akun_level3_kode, '.', akun5.kr_akun_level4_kode, '.', akun5.kode) AS kode_level5,
            CASE
           WHEN rp64.uniq_kode IS NOT NULL THEN
            rp64.uniq_kode
           ELSE
            0
           END AS uniq_kode_64
           FROM
            (
             SELECT
              bp.uniq_kode,
              bp.kr_organisasi_org_key,
              korg.parent_id,
              bp.no_bukti,
              bp_rinci.kr_akun_level5_uniq_kode,
              SUM (
               bp_rinci.anggaran_dialokasikan
              ) AS anggaran_dialokasikan
             FROM
              (
               SELECT
                *
               FROM
                " . $namamodul . "_" . $submodul . "
               WHERE
                date_part('YEAR', date_added) :: VARCHAR = '" . TAHUN . "'
              ) bp
             JOIN bp_rinci_" . $submodul . " bp_rinci ON bp_rinci." . $namamodul . "_" . $submodul . "_uniq_kode = bp.uniq_kode
             JOIN kr_organisasi korg ON korg.org_key = bp.kr_organisasi_org_key
             GROUP BY
              bp.uniq_kode,
              bp.kr_organisasi_org_key,
              korg.parent_id,
              bp.no_bukti,
              bp_rinci.bp_" . $submodul . "_uniq_kode,
              bp_rinci.kr_akun_level5_uniq_kode
             ORDER BY
              bp.uniq_kode
            ) AS all_bp
           LEFT JOIN (
            SELECT
             *
            FROM
             rekening_permen_64
            WHERE
             rek1 != ''
            AND rek2 != ''
            AND rek3 != ''
            AND rek4 != ''
            AND rek5 != ''
           ) rp64 ON rp64.kr_akun_level_1_sampai_5_uniq_kode = all_bp.kr_akun_level5_uniq_kode
           JOIN kr_akun_level5 akun5 ON akun5.uniq_kode = all_bp.kr_akun_level5_uniq_kode
           WHERE all_bp.uniq_kode = $uniq_kode;
            ";
        } else if ($namamodul == 'spp' AND $submodul == 'tu') {
            $sql = "
              SELECT
	spp.uniq_kode,
	spp.kr_organisasi_org_key,
	spp.no_spp AS no_bukti,
	spp.uraian,
	spp_rinci.kr_akun_level5_uniq_kode,
	CASE
WHEN rp64.uniq_kode IS NOT NULL THEN
	rp64.uniq_kode
ELSE
	0
END AS uniq_kode_64,
 CONCAT (
	akun5.kr_akun_level1_kode,
	'.',
	akun5.kr_akun_level2_kode,
	'.',
	akun5.kr_akun_level3_kode,
	'.',
	akun5.kr_akun_level4_kode,
	'.',
	akun5.kode
) AS kode_level5,
 SUM (
	spp_rinci.anggaran_dialokasikan
) AS anggaran_dialokasikan,
 CASE WHEN korg.parent_id IS NULL THEN korg.org_key ELSE korg.parent_id END parent_id
FROM
	(
		SELECT
			*
		FROM
			spp_tu
		
	) spp
JOIN prog_keg_spp_tu pk_spp ON pk_spp.spp_tu_uniq_kode = spp.uniq_kode
JOIN spp_rinci_tu spp_rinci ON spp_rinci.prog_keg_spp_tu_uniq_kode = pk_spp.uniq_kode
JOIN kr_organisasi korg ON korg.org_key = spp.kr_organisasi_org_key
JOIN kr_akun_level5 akun5 ON akun5.uniq_kode = spp_rinci.kr_akun_level5_uniq_kode
LEFT JOIN (
	SELECT
		*
	FROM
		rekening_permen_64
	WHERE
		rek1 != ''
	AND rek2 != ''
	AND rek3 != ''
	AND rek4 != ''
	AND rek5 != ''
) rp64 ON rp64.kr_akun_level_1_sampai_5_uniq_kode = akun5.uniq_kode
WHERE spp.uniq_kode = '$uniq_kode'
GROUP BY
	spp.uniq_kode,
	spp.kr_organisasi_org_key,
	spp.no_spp,
	spp.uraian,
	spp_rinci.kr_akun_level5_uniq_kode,
	akun5.kr_akun_level1_kode,
	akun5.kr_akun_level2_kode,
	akun5.kr_akun_level3_kode,
	akun5.kr_akun_level4_kode,
	akun5.kode,
	CASE WHEN korg.parent_id IS NULL THEN korg.org_key ELSE korg.parent_id END,
	rp64.uniq_kode
ORDER BY
	spp.uniq_kode;
            ";
        } else if (($namamodul == 'spp') AND ( $submodul == 'brg_js' || $submodul == 'pegawai' || $submodul == 'skpkd' )) {
            $sql = "SELECT
	spp.uniq_kode,
	spp.kr_organisasi_org_key,
        spp.no_spp as no_bukti,
	korg.parent_id,
	spp.no_spp AS no_bukti,
	spp.uraian,
	spp_rinci.kr_akun_level5_uniq_kode,
	CASE
WHEN rp64.uniq_kode IS NOT NULL THEN
	rp64.uniq_kode
ELSE
	0
END AS uniq_kode_64,
 CONCAT (
	akun5.kr_akun_level1_kode,
	'.',
	akun5.kr_akun_level2_kode,
	'.',
	akun5.kr_akun_level3_kode,
	'.',
	akun5.kr_akun_level4_kode,
	'.',
	akun5.kode
) AS kode_level5,
 SUM (
	spp_rinci.anggaran_dialokasikan
) AS anggaran_dialokasikan
FROM
	(
		SELECT
			*
		FROM
			" . $namamodul . "_ls_" . $submodul . "
	) AS spp
JOIN " . $namamodul . "_ls_rinci_" . $submodul . " spp_rinci ON spp_rinci.spp_ls_" . $submodul . "_uniq_kode = spp.uniq_kode
JOIN kr_organisasi korg ON korg.org_key = spp.kr_organisasi_org_key
JOIN kr_akun_level5 akun5 ON akun5.uniq_kode = spp_rinci.kr_akun_level5_uniq_kode
LEFT JOIN (
	SELECT
		*
	FROM
		rekening_permen_64
	WHERE
		rek1 != ''
	AND rek2 != ''
	AND rek3 != ''
	AND rek4 != ''
	AND rek5 != ''
) rp64 ON rp64.kr_akun_level_1_sampai_5_uniq_kode = akun5.uniq_kode
WHERE
	spp.uniq_kode = '$uniq_kode'
GROUP BY
	spp.uniq_kode,
	spp.kr_organisasi_org_key,
	korg.parent_id,
	spp.no_spp,
	spp.uraian,
	spp_rinci.kr_akun_level5_uniq_kode,
	akun5.kr_akun_level1_kode,
	akun5.kr_akun_level2_kode,
	akun5.kr_akun_level3_kode,
	akun5.kr_akun_level4_kode,
	akun5.kode,
	rp64.uniq_kode
ORDER BY
	spp.uniq_kode;

";
        } else if ($namamodul == 'spm' AND $submodul == 'tu') {
            $sql = "SELECT
	spm.uniq_kode,
	spm.kr_organisasi_org_key,
	spp_new.parent_id,
	spm.no_spm AS no_bukti,
	spm.uraian,
	spp_new.kr_akun_level5_uniq_kode,
	CASE
WHEN rp64.uniq_kode IS NOT NULL THEN
	rp64.uniq_kode
ELSE
	0
END AS uniq_kode_64,
	spp_new.kode_level5,
	spp_new.anggaran_dialokasikan
FROM
	(
		SELECT
			spp.uniq_kode,
			spp.kr_organisasi_org_key,
			spp.no_spp,
			spp.uraian,
			spp_rinci.kr_akun_level5_uniq_kode,
			CONCAT (
				akun5.kr_akun_level1_kode,
				'.',
				akun5.kr_akun_level2_kode,
				'.',
				akun5.kr_akun_level3_kode,
				'.',
				akun5.kr_akun_level4_kode,
				'.',
				akun5.kode
			) AS kode_level5,
			SUM (
				spp_rinci.anggaran_dialokasikan
			) AS anggaran_dialokasikan,
			korg.parent_id
		FROM
			(
				SELECT
					*
				FROM
					spp_tu
			) spp
		JOIN prog_keg_spp_tu pk_spp ON pk_spp.spp_tu_uniq_kode = spp.uniq_kode
		JOIN spp_rinci_tu spp_rinci ON spp_rinci.prog_keg_spp_tu_uniq_kode = pk_spp.uniq_kode
		JOIN kr_organisasi korg ON korg.org_key = spp.kr_organisasi_org_key
		JOIN kr_akun_level5 akun5 ON akun5.uniq_kode = spp_rinci.kr_akun_level5_uniq_kode
		GROUP BY
			spp.uniq_kode,
			spp.kr_organisasi_org_key,
			spp.no_spp,
			spp.uraian,
			spp_rinci.kr_akun_level5_uniq_kode,
			akun5.kr_akun_level1_kode,
			akun5.kr_akun_level2_kode,
			akun5.kr_akun_level3_kode,
			akun5.kr_akun_level4_kode,
			akun5.kode,
			korg.parent_id
		ORDER BY
			spp.uniq_kode
	) AS spp_new
JOIN (SELECT * FROM spm_tu) spm ON spm.spp_tu_uniq_kode = spp_new.uniq_kode
LEFT JOIN (
	SELECT
		*
	FROM
		rekening_permen_64
	WHERE
		rek1 != ''
	AND rek2 != ''
	AND rek3 != ''
	AND rek4 != ''
	AND rek5 != ''
) rp64 ON rp64.kr_akun_level_1_sampai_5_uniq_kode = spp_new.kr_akun_level5_uniq_kode
WHERE spm.uniq_kode = '$uniq_kode';";
        } else if ($namamodul == 'spm' AND ( $submodul == 'brg_js' || $submodul == 'pegawai' || $submodul == 'skpkd' )) {
            $sql = "SELECT
	spp_ls.kr_organisasi_org_key,
	spp_ls.parent_id,
	spp_ls.kr_akun_level5_uniq_kode,
	CASE
WHEN rp64.uniq_kode IS NOT NULL THEN
	rp64.uniq_kode
ELSE
	0
END AS uniq_kode_64,
	spp_ls.kode_level5,
	spp_ls.anggaran_dialokasikan,
	spm.uniq_kode AS spm_uniq_kode,
	spm.spp_ls_" . $submodul . "_uniq_kode,
	spm.no_spm AS no_bukti,
	spm.uraian
FROM
	(
		SELECT
			spp.uniq_kode,
			spp.kr_organisasi_org_key,
			korg.parent_id,
			spp.no_spp,
			spp.uraian,
			spp_rinci.kr_akun_level5_uniq_kode,
			CONCAT (
				akun5.kr_akun_level1_kode,
				'.',
				akun5.kr_akun_level2_kode,
				'.',
				akun5.kr_akun_level3_kode,
				'.',
				akun5.kr_akun_level4_kode,
				'.',
				akun5.kode
			) AS kode_level5,
			SUM (
				spp_rinci.anggaran_dialokasikan
			) AS anggaran_dialokasikan
		FROM
			(
				SELECT
					*
				FROM
					spp_ls_" . $submodul . "
			) AS spp
		JOIN spp_ls_rinci_" . $submodul . " spp_rinci ON spp_rinci.spp_ls_" . $submodul . "_uniq_kode = spp.uniq_kode
		JOIN kr_organisasi korg ON korg.org_key = spp.kr_organisasi_org_key
		JOIN kr_akun_level5 akun5 ON akun5.uniq_kode = spp_rinci.kr_akun_level5_uniq_kode
		GROUP BY
			spp.uniq_kode,
			spp.kr_organisasi_org_key,
			korg.parent_id,
			spp.no_spp,
			spp.uraian,
			spp_rinci.kr_akun_level5_uniq_kode,
			akun5.kr_akun_level1_kode,
			akun5.kr_akun_level2_kode,
			akun5.kr_akun_level3_kode,
			akun5.kr_akun_level4_kode,
			akun5.kode
		ORDER BY
			spp.uniq_kode
	) AS spp_ls
JOIN (
	SELECT
		*
	FROM
		" . $namamodul . "_ls_" . $submodul . "
) AS spm ON spm.spp_ls_" . $submodul . "_uniq_kode = spp_ls.uniq_kode
LEFT JOIN (
	SELECT
		*
	FROM
		rekening_permen_64
	WHERE
		rek1 != ''
	AND rek2 != ''
	AND rek3 != ''
	AND rek4 != ''
	AND rek5 != ''
) rp64 ON rp64.kr_akun_level_1_sampai_5_uniq_kode = spp_ls.kr_akun_level5_uniq_kode
WHERE spm.uniq_kode = '$uniq_kode';";
        } else if ($namamodul == 'sp2d' AND ( $submodul == 'brg_js' || $submodul == 'pegawai' || $submodul == 'skpkd')) {
            $sql = "SELECT
	spp_ls.kr_organisasi_org_key,
	spp_ls.parent_id,
	spp_ls.kr_akun_level5_uniq_kode,
	CASE
WHEN rp64.uniq_kode IS NOT NULL THEN
	rp64.uniq_kode
ELSE
	0
END AS uniq_kode_64,
 spp_ls.kode_level5,
 spp_ls.anggaran_dialokasikan,
 sp2d.uniq_kode AS sp2d_uniq_kode,
 sp2d.spm_ls_" . $submodul . "_uniq_kode,
 sp2d.no_sp2d AS no_bukti,
 sp2d.uraian
FROM
	(
		SELECT
			spp.uniq_kode,
			spp.kr_organisasi_org_key,
                        CASE WHEN korg.parent_id IS NULL THEN korg.org_key ELSE korg.parent_id END AS parent_id,
			spp.no_spp,
			spp.uraian,
			spp_rinci.kr_akun_level5_uniq_kode,
			CONCAT (
				akun5.kr_akun_level1_kode,
				'.',
				akun5.kr_akun_level2_kode,
				'.',
				akun5.kr_akun_level3_kode,
				'.',
				akun5.kr_akun_level4_kode,
				'.',
				akun5.kode
			) AS kode_level5,
			SUM (
				spp_rinci.anggaran_dialokasikan
			) AS anggaran_dialokasikan
		FROM
			(SELECT * FROM spp_ls_" . $submodul . ") AS spp
		JOIN spp_ls_rinci_" . $submodul . " spp_rinci ON spp_rinci.spp_ls_" . $submodul . "_uniq_kode = spp.uniq_kode
		JOIN kr_organisasi korg ON korg.org_key = spp.kr_organisasi_org_key
		JOIN kr_akun_level5 akun5 ON akun5.uniq_kode = spp_rinci.kr_akun_level5_uniq_kode
		GROUP BY
			spp.uniq_kode,
			spp.kr_organisasi_org_key,
			korg.parent_id,
                        korg.org_key,
			spp.no_spp,
			spp.uraian,
			spp_rinci.kr_akun_level5_uniq_kode,
			akun5.kr_akun_level1_kode,
			akun5.kr_akun_level2_kode,
			akun5.kr_akun_level3_kode,
			akun5.kr_akun_level4_kode,
			akun5.kode
		ORDER BY
			spp.uniq_kode
	) AS spp_ls
JOIN (SELECT * FROM spm_ls_" . $submodul . ") AS spm ON spm.spp_ls_" . $submodul . "_uniq_kode = spp_ls.uniq_kode
JOIN (SELECT * FROM " . $namamodul . "_ls_" . $submodul . ") AS sp2d ON sp2d.spm_ls_" . $submodul . "_uniq_kode = spm.uniq_kode
LEFT JOIN (
	SELECT
		*
	FROM
		rekening_permen_64
	WHERE
		rek1 != ''
	AND rek2 != ''
	AND rek3 != ''
	AND rek4 != ''
	AND rek5 != ''
) rp64 ON rp64.kr_akun_level_1_sampai_5_uniq_kode = spp_ls.kr_akun_level5_uniq_kode
WHERE
	sp2d.uniq_kode = '$uniq_kode';";
        } else if ($namamodul == 'sp2d' AND $submodul == 'tu') {
            $sql = "SELECT
	sp2d.uniq_kode,
	sp2d.kr_organisasi_org_key,
	spp_new.parent_id,
	sp2d.no_sp2d AS no_bukti,
	sp2d.uraian,
	spp_new.kr_akun_level5_uniq_kode,
	CASE
WHEN rp64.uniq_kode IS NOT NULL THEN
	rp64.uniq_kode
ELSE
	0
END AS uniq_kode_64,
	spp_new.kode_level5,
	spp_new.anggaran_dialokasikan
FROM
	(
		SELECT
			spp.uniq_kode,
			spp.kr_organisasi_org_key,
			spp.no_spp,
			spp.uraian,
			spp_rinci.kr_akun_level5_uniq_kode,
			CONCAT (
				akun5.kr_akun_level1_kode,
				'.',
				akun5.kr_akun_level2_kode,
				'.',
				akun5.kr_akun_level3_kode,
				'.',
				akun5.kr_akun_level4_kode,
				'.',
				akun5.kode
			) AS kode_level5,
			SUM (
				spp_rinci.anggaran_dialokasikan
			) AS anggaran_dialokasikan,
			korg.parent_id
		FROM
			(
				SELECT
					*
				FROM
					spp_tu
			) spp
		JOIN prog_keg_spp_tu pk_spp ON pk_spp.spp_tu_uniq_kode = spp.uniq_kode
		JOIN spp_rinci_tu spp_rinci ON spp_rinci.prog_keg_spp_tu_uniq_kode = pk_spp.uniq_kode
		JOIN kr_organisasi korg ON korg.org_key = spp.kr_organisasi_org_key
		JOIN kr_akun_level5 akun5 ON akun5.uniq_kode = spp_rinci.kr_akun_level5_uniq_kode
		GROUP BY
			spp.uniq_kode,
			spp.kr_organisasi_org_key,
			spp.no_spp,
			spp.uraian,
			spp_rinci.kr_akun_level5_uniq_kode,
			akun5.kr_akun_level1_kode,
			akun5.kr_akun_level2_kode,
			akun5.kr_akun_level3_kode,
			akun5.kr_akun_level4_kode,
			akun5.kode,
			korg.parent_id
		ORDER BY
			spp.uniq_kode
	) AS spp_new
JOIN (SELECT * FROM spm_tu) spm ON spm.spp_tu_uniq_kode = spp_new.uniq_kode
JOIN (SELECT * FROM sp2d_tu) sp2d ON sp2d.spm_tu_uniq_kode = spm.uniq_kode
LEFT JOIN (
	SELECT
		*
	FROM
		rekening_permen_64
	WHERE
		rek1 != ''
	AND rek2 != ''
	AND rek3 != ''
	AND rek4 != ''
	AND rek5 != ''
) rp64 ON rp64.kr_akun_level_1_sampai_5_uniq_kode = spp_new.kr_akun_level5_uniq_kode
WHERE sp2d.uniq_kode = '$uniq_kode';";
        } else if ($namamodul == 'lpj') {
            $sql = "SELECT
	all_lpj.*, CONCAT (
		akun5.kr_akun_level1_kode,
		'.',
		akun5.kr_akun_level2_kode,
		'.',
		akun5.kr_akun_level3_kode,
		'.',
		akun5.kr_akun_level4_kode,
		'.',
		akun5.kode
	) AS kode_level5,
	CASE
WHEN rp64.uniq_kode IS NOT NULL THEN
	rp64.uniq_kode
ELSE
	0
END AS uniq_kode_64
FROM
	(
		SELECT
			lpj.uniq_kode,
			lpj.kr_organisasi_org_key,
			korg.parent_id,
			lpj.no_lpj AS no_bukti,
			bp_rinci.kr_akun_level5_uniq_kode,
			SUM (
				bp_rinci.anggaran_dialokasikan
			) AS anggaran_dialokasikan
		FROM
			lpj_" . $submodul . " lpj
		JOIN bp_lpj_" . $submodul . " bp_lpj ON lpj.uniq_kode = bp_lpj.lpj_" . $submodul . "_uniq_kode
		JOIN bp_" . $submodul . " bp ON bp_lpj.bp_" . $submodul . "_uniq_kode = bp.uniq_kode
		JOIN bp_rinci_" . $submodul . " bp_rinci ON bp_rinci.bp_" . $submodul . "_uniq_kode = bp.uniq_kode
		JOIN kr_organisasi korg ON korg.org_key = lpj.kr_organisasi_org_key
		GROUP BY
			lpj.uniq_kode,
			lpj.kr_organisasi_org_key,
			korg.parent_id,
			lpj.no_lpj,
			bp_rinci.bp_" . $submodul . "_uniq_kode,
			bp_rinci.kr_akun_level5_uniq_kode
	) AS all_lpj
LEFT JOIN (
	SELECT
		*
	FROM
		rekening_permen_64
	WHERE
		rek1 != ''
	AND rek2 != ''
	AND rek3 != ''
	AND rek4 != ''
	AND rek5 != ''
) rp64 ON rp64.kr_akun_level_1_sampai_5_uniq_kode = all_lpj.kr_akun_level5_uniq_kode
JOIN kr_akun_level5 akun5 ON akun5.uniq_kode = all_lpj.kr_akun_level5_uniq_kode
WHERE all_lpj.uniq_kode = '$uniq_kode';";
        } else if ($namamodul == 'skp d') {
            $sql = "
                SELECT
	all_data.*, CONCAT (
		akun5.kr_akun_level1_kode,
		'.',
		akun5.kr_akun_level2_kode,
		'.',
		akun5.kr_akun_level3_kode,
		'.',
		akun5.kr_akun_level4_kode,
		'.',
		akun5.kode
	) AS kode_level5,
	CASE
WHEN rp64.uniq_kode IS NOT NULL THEN
	rp64.uniq_kode
ELSE
	0
END AS uniq_kode_64
FROM
	(
		SELECT
                        (SELECT CASE WHEN parent_id IS NULL THEN org_key ELSE parent_id END FROM kr_organisasi WHERE org_key = sk.kr_organisasi_org_key) AS parent_id,
			sk.kr_organisasi_org_key,
			kode_jenis,
			skp_skr_uniq_kode,
			kr_akun_level5_uniq_kode,
                        sk.no_skp_d AS no_bukti,
			SUM (anggaran_dialokasikan) AS anggaran_dialokasikan
		FROM
			skp_d sk
		LEFT JOIN skp_skr_rinci rinci ON sk.uniq_kode = rinci.skp_skr_uniq_kode
		AND rinci.kode_jenis = 1
		GROUP BY
                        sk.kr_organisasi_org_key,
			kode_jenis,
			skp_skr_uniq_kode,
			kr_akun_level5_uniq_kode,
                        sk.no_skp_d
		ORDER BY
			kode_jenis,
			skp_skr_uniq_kode,
			kr_akun_level5_uniq_kode
	) AS all_data
LEFT JOIN (
	SELECT
		*
	FROM
		rekening_permen_64
	WHERE
		rek1 != ''
	AND rek2 != ''
	AND rek3 != ''
	AND rek4 != ''
	AND rek5 != ''
) rp64 ON rp64.kr_akun_level_1_sampai_5_uniq_kode = all_data.kr_akun_level5_uniq_kode
JOIN kr_akun_level5 akun5 ON akun5.uniq_kode = all_data.kr_akun_level5_uniq_kode
WHERE
	all_data.skp_skr_uniq_kode = '$uniq_kode';
                ";
        } else if ($namamodul == 'skr d') {
            $sql = "
            SELECT
	all_data.*, CONCAT (
		akun5.kr_akun_level1_kode,
		'.',
		akun5.kr_akun_level2_kode,
		'.',
		akun5.kr_akun_level3_kode,
		'.',
		akun5.kr_akun_level4_kode,
		'.',
		akun5.kode
	) AS kode_level5,
	CASE
WHEN rp64.uniq_kode IS NOT NULL THEN
	rp64.uniq_kode
ELSE
	0
END AS uniq_kode_64
FROM
	(
		SELECT
			(
				SELECT
					CASE
				WHEN parent_id IS NULL THEN
					org_key
				ELSE
					parent_id
				END
				FROM
					kr_organisasi
				WHERE
					org_key = sk.kr_organisasi_org_key
			) AS parent_id,
			sk.kr_organisasi_org_key,
			kode_jenis,
			skp_skr_uniq_kode,
			kr_akun_level5_uniq_kode,
			sk.no_skr_d AS no_bukti,
			SUM (anggaran_dialokasikan) AS anggaran_dialokasikan
		FROM
			skr_d sk
		LEFT JOIN skp_skr_rinci rinci ON sk.uniq_kode = rinci.skp_skr_uniq_kode
		AND rinci.kode_jenis = 2
		GROUP BY
			sk.kr_organisasi_org_key,
			kode_jenis,
			skp_skr_uniq_kode,
			kr_akun_level5_uniq_kode,
			sk.no_skr_d
		ORDER BY
			kode_jenis,
			skp_skr_uniq_kode,
			kr_akun_level5_uniq_kode
	) AS all_data
LEFT JOIN (
	SELECT
		*
	FROM
		rekening_permen_64
	WHERE
		rek1 != ''
	AND rek2 != ''
	AND rek3 != ''
	AND rek4 != ''
	AND rek5 != ''
) rp64 ON rp64.kr_akun_level_1_sampai_5_uniq_kode = all_data.kr_akun_level5_uniq_kode
JOIN kr_akun_level5 akun5 ON akun5.uniq_kode = all_data.kr_akun_level5_uniq_kode
WHERE
	all_data.skp_skr_uniq_kode = '$uniq_kode';    
            ";
        } elseif ($namamodul == 'bpen' && $submodul == '1') { //skp - pajak
            $sql = "
        SELECT
	all_data.*, CONCAT (
		akun5.kr_akun_level1_kode,
		'.',
		akun5.kr_akun_level2_kode,
		'.',
		akun5.kr_akun_level3_kode,
		'.',
		akun5.kr_akun_level4_kode,
		'.',
		akun5.kode
	) AS kode_level5,
	CASE
WHEN rp64.uniq_kode IS NOT NULL THEN
	rp64.uniq_kode
ELSE
	0
END AS uniq_kode_64
FROM
	(
		SELECT
			(
				SELECT
					CASE
				WHEN parent_id IS NULL THEN
					org_key
				ELSE
					parent_id
				END
				FROM
					kr_organisasi
				WHERE
					org_key = sk.kr_organisasi_org_key
			) AS parent_id,
			bpen.uniq_kode AS bpen_uniq_kode,
			sk.kr_organisasi_org_key,
			kode_jenis,
			skp_skr_uniq_kode,
			kr_akun_level5_uniq_kode,
			sk.no_skp_d AS no_bukti,
			bpen.nilai AS anggaran_dialokasikan
		FROM
			skp_d sk
		RIGHT JOIN bukti_penerimaan_pajak bpen ON bpen.skp_d_uniq_kode = sk.uniq_kode
		LEFT JOIN skp_skr_rinci rinci ON sk.uniq_kode = rinci.skp_skr_uniq_kode
		AND rinci.kode_jenis = 1
		GROUP BY
			bpen.uniq_kode,
			sk.kr_organisasi_org_key,
			kode_jenis,
			skp_skr_uniq_kode,
			kr_akun_level5_uniq_kode,
			sk.no_skp_d
		ORDER BY
			kode_jenis,
			skp_skr_uniq_kode,
			kr_akun_level5_uniq_kode
	) AS all_data
LEFT JOIN (
	SELECT
		*
	FROM
		rekening_permen_64
	WHERE
		rek1 != ''
	AND rek2 != ''
	AND rek3 != ''
	AND rek4 != ''
	AND rek5 != ''
) rp64 ON rp64.kr_akun_level_1_sampai_5_uniq_kode = all_data.kr_akun_level5_uniq_kode
JOIN kr_akun_level5 akun5 ON akun5.uniq_kode = all_data.kr_akun_level5_uniq_kode
WHERE
	all_data.bpen_uniq_kode = '$uniq_kode';
        ";
        } elseif ($namamodul == 'bpen' && $submodul == '2') { //skp - retribusi
            $sql = "
               SELECT
	all_data.*, CONCAT (
		akun5.kr_akun_level1_kode,
		'.',
		akun5.kr_akun_level2_kode,
		'.',
		akun5.kr_akun_level3_kode,
		'.',
		akun5.kr_akun_level4_kode,
		'.',
		akun5.kode
	) AS kode_level5,
	CASE
WHEN rp64.uniq_kode IS NOT NULL THEN
	rp64.uniq_kode
ELSE
	0
END AS uniq_kode_64
FROM
	(
		SELECT
			(
				SELECT
					CASE
				WHEN parent_id IS NULL THEN
					org_key
				ELSE
					parent_id
				END
				FROM
					kr_organisasi
				WHERE
					org_key = sk.kr_organisasi_org_key
			) AS parent_id,
			bpen.uniq_kode AS bpen_uniq_kode,
			sk.kr_organisasi_org_key,
			kode_jenis,
			skp_skr_uniq_kode,
			kr_akun_level5_uniq_kode,
			sk.no_skr_d AS no_bukti,
			bpen.nilai AS anggaran_dialokasikan
		FROM
			skr_d sk
		RIGHT JOIN bukti_penerimaan_retribusi bpen ON bpen.skr_d_uniq_kode = sk.uniq_kode
		LEFT JOIN skp_skr_rinci rinci ON sk.uniq_kode = rinci.skp_skr_uniq_kode
		AND rinci.kode_jenis = 2
		GROUP BY
			bpen.uniq_kode,
			sk.kr_organisasi_org_key,
			kode_jenis,
			skp_skr_uniq_kode,
			kr_akun_level5_uniq_kode,
			sk.no_skr_d
		ORDER BY
			kode_jenis,
			skp_skr_uniq_kode,
			kr_akun_level5_uniq_kode
	) AS all_data
LEFT JOIN (
	SELECT
		*
	FROM
		rekening_permen_64
	WHERE
		rek1 != ''
	AND rek2 != ''
	AND rek3 != ''
	AND rek4 != ''
	AND rek5 != ''
) rp64 ON rp64.kr_akun_level_1_sampai_5_uniq_kode = all_data.kr_akun_level5_uniq_kode
JOIN kr_akun_level5 akun5 ON akun5.uniq_kode = all_data.kr_akun_level5_uniq_kode
WHERE
	all_data.bpen_uniq_kode = '$uniq_kode';     
            ";
        } elseif ($namamodul == 'sts' && $submodul == '1') {
            $sql = "
             SELECT
	all_data.*, CONCAT (
		akun5.kr_akun_level1_kode,
		'.',
		akun5.kr_akun_level2_kode,
		'.',
		akun5.kr_akun_level3_kode,
		'.',
		akun5.kr_akun_level4_kode,
		'.',
		akun5.kode
	) AS kode_level5,
	CASE
WHEN rp64.uniq_kode IS NOT NULL THEN
	rp64.uniq_kode
ELSE
	0
END AS uniq_kode_64
FROM
	(
		SELECT
                (
				SELECT
					CASE
				WHEN parent_id IS NULL THEN
					org_key
				ELSE
					parent_id
				END
				FROM
					kr_organisasi
				WHERE
					org_key = sk.kr_organisasi_org_key
			) AS parent_id,
			bpen.uniq_kode AS bpen_uniq_kode,
			sk.kr_organisasi_org_key,
			kode_jenis,
			skp_skr_uniq_kode,
			kr_akun_level5_uniq_kode,
			sts.no_sts AS no_bukti,
			sts.nilai AS anggaran_dialokasikan
		FROM
			sts
		LEFT JOIN bukti_penerimaan_pajak bpen ON bpen.uniq_kode = sts.bukti_penerimaan_uniq_kode
		LEFT JOIN skp_d sk ON sk.uniq_kode = bpen.skp_d_uniq_kode
		LEFT JOIN skp_skr_rinci rinci ON sk.uniq_kode = rinci.skp_skr_uniq_kode
		AND rinci.kode_jenis = 1
		WHERE
			sts.uniq_kode = '$uniq_kode'
	) AS all_data
LEFT JOIN (
	SELECT
		*
	FROM
		rekening_permen_64
	WHERE
		rek1 != ''
	AND rek2 != ''
	AND rek3 != ''
	AND rek4 != ''
	AND rek5 != ''
) rp64 ON rp64.kr_akun_level_1_sampai_5_uniq_kode = all_data.kr_akun_level5_uniq_kode
JOIN kr_akun_level5 akun5 ON akun5.uniq_kode = all_data.kr_akun_level5_uniq_kode
                 ";
        } elseif ($namamodul == 'sts' && $submodul == '2') {
            $sql = "
             SELECT
	all_data.*, CONCAT (
		akun5.kr_akun_level1_kode,
		'.',
		akun5.kr_akun_level2_kode,
		'.',
		akun5.kr_akun_level3_kode,
		'.',
		akun5.kr_akun_level4_kode,
		'.',
		akun5.kode
	) AS kode_level5,
	CASE
WHEN rp64.uniq_kode IS NOT NULL THEN
	rp64.uniq_kode
ELSE
	0
END AS uniq_kode_64
FROM
	(
		SELECT
                (
				SELECT
					CASE
				WHEN parent_id IS NULL THEN
					org_key
				ELSE
					parent_id
				END
				FROM
					kr_organisasi
				WHERE
					org_key = sk.kr_organisasi_org_key
			) AS parent_id,
			bpen.uniq_kode AS bpen_uniq_kode,
			sk.kr_organisasi_org_key,
			kode_jenis,
			skp_skr_uniq_kode,
			kr_akun_level5_uniq_kode,
			sts.no_sts AS no_bukti,
			sts.nilai AS anggaran_dialokasikan
		FROM
			sts
		LEFT JOIN bukti_penerimaan_retribusi bpen ON bpen.uniq_kode = sts.bukti_penerimaan_uniq_kode
		LEFT JOIN skr_d sk ON sk.uniq_kode = bpen.skr_d_uniq_kode
		LEFT JOIN skp_skr_rinci rinci ON sk.uniq_kode = rinci.skp_skr_uniq_kode
		AND rinci.kode_jenis = 2
		WHERE
			sts.uniq_kode = '$uniq_kode'
	) AS all_data
LEFT JOIN (
	SELECT
		*
	FROM
		rekening_permen_64
	WHERE
		rek1 != ''
	AND rek2 != ''
	AND rek3 != ''
	AND rek4 != ''
	AND rek5 != ''
) rp64 ON rp64.kr_akun_level_1_sampai_5_uniq_kode = all_data.kr_akun_level5_uniq_kode
JOIN kr_akun_level5 akun5 ON akun5.uniq_kode = all_data.kr_akun_level5_uniq_kode
                 ";
        }
        return $CI->db->query($sql)->result();
//        return $sql;
    }

}

if (!function_exists('get_kode')) {

    function get_kode($uniq_kode) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = "SELECT
	concat (
		kr_akun_level1_kode,
		'.',
		kr_akun_level2_kode,
		'.',
		kr_akun_level3_kode,
		'.',
		kr_akun_level4_kode,
		'.',
		kode
	)AS kode
FROM
	kr_akun_level5 WHERE uniq_kode= '$uniq_kode'";
        return $CI->db->query($sql)->row();
    }

}



if (!function_exists('get_khusus')) {

    function get_khusus($kode_lv5) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = "SELECT * 
FROM (SELECT * FROM kondisi_khusus_jurnal_akrual
WHERE CASE WHEN array_length(string_to_array(kode,'.'),1) >= 1 THEN split_part(kode,'.' ,1) = split_part('$kode_lv5','.' ,1) ELSE TRUE END
AND (CASE WHEN array_length(string_to_array(kode,'.'),1) >= 2 THEN CONCAT(split_part(kode,'.' ,1),'.',split_part(kode,'.' ,2))= CONCAT(split_part('$kode_lv5','.' ,1),'.',split_part('$kode_lv5','.' ,2))  ELSE TRUE END)
AND (CASE WHEN array_length(string_to_array(kode,'.'),1) >= 3 THEN CONCAT(split_part(kode,'.' ,1),'.',split_part(kode,'.' ,2),'.',split_part(kode,'.' ,3))= CONCAT(split_part('$kode_lv5','.' ,1),'.',split_part('$kode_lv5','.' ,2),'.',split_part('$kode_lv5','.' ,3)) ELSE TRUE END)
AND (CASE WHEN array_length(string_to_array(kode,'.'),1) >= 4 THEN CONCAT(split_part(kode,'.' ,1),'.',split_part(kode,'.' ,2),'.',split_part(kode,'.' ,3),'.',split_part(kode,'.' ,4))= CONCAT(split_part('$kode_lv5','.' ,1),'.',split_part('$kode_lv5','.' ,2),'.',split_part('$kode_lv5','.' ,3),'.',split_part('$kode_lv5','.' ,4)) ELSE TRUE END)
AND (CASE WHEN array_length(string_to_array(kode,'.'),1) >= 5 THEN CONCAT(split_part(kode,'.' ,1),'.',split_part(kode,'.' ,2),'.',split_part(kode,'.' ,3),'.',split_part(kode,'.' ,4),'.',split_part(kode,'.' ,5))= CONCAT(split_part('$kode_lv5','.' ,1),'.',split_part('$kode_lv5','.' ,2),'.',split_part('$kode_lv5','.' ,3),'.',split_part('$kode_lv5','.' ,4),'.',split_part('$kode_lv5','.' ,5)) ELSE TRUE END)
ORDER BY kode DESC LIMIT 1) AS dasar 

UNION

SELECT * FROM kondisi_khusus_jurnal_akrual
WHERE uniq_kode = (
(SELECT CASE WHEN pasangan_uniq_kode IS NOT NULL THEN pasangan_uniq_kode ELSE 0 END  FROM kondisi_khusus_jurnal_akrual
WHERE CASE WHEN array_length(string_to_array(kode,'.'),1) >= 1 THEN split_part(kode,'.' ,1) = split_part('$kode_lv5','.' ,1) ELSE TRUE END
AND (CASE WHEN array_length(string_to_array(kode,'.'),1) >= 2 THEN CONCAT(split_part(kode,'.' ,1),'.',split_part(kode,'.' ,2))= CONCAT(split_part('$kode_lv5','.' ,1),'.',split_part('$kode_lv5','.' ,2))  ELSE TRUE END)
AND (CASE WHEN array_length(string_to_array(kode,'.'),1) >= 3 THEN CONCAT(split_part(kode,'.' ,1),'.',split_part(kode,'.' ,2),'.',split_part(kode,'.' ,3))= CONCAT(split_part('$kode_lv5','.' ,1),'.',split_part('$kode_lv5','.' ,2),'.',split_part('$kode_lv5','.' ,3)) ELSE TRUE END)
AND (CASE WHEN array_length(string_to_array(kode,'.'),1) >= 4 THEN CONCAT(split_part(kode,'.' ,1),'.',split_part(kode,'.' ,2),'.',split_part(kode,'.' ,3),'.',split_part(kode,'.' ,4))= CONCAT(split_part('$kode_lv5','.' ,1),'.',split_part('$kode_lv5','.' ,2),'.',split_part('$kode_lv5','.' ,3),'.',split_part('$kode_lv5','.' ,4)) ELSE TRUE END)
AND (CASE WHEN array_length(string_to_array(kode,'.'),1) >= 5 THEN CONCAT(split_part(kode,'.' ,1),'.',split_part(kode,'.' ,2),'.',split_part(kode,'.' ,3),'.',split_part(kode,'.' ,4),'.',split_part(kode,'.' ,5))= CONCAT(split_part('$kode_lv5','.' ,1),'.',split_part('$kode_lv5','.' ,2),'.',split_part('$kode_lv5','.' ,3),'.',split_part('$kode_lv5','.' ,4),'.',split_part('$kode_lv5','.' ,5)) ELSE TRUE END)
ORDER BY kode DESC LIMIT 1))";
        return $CI->db->query($sql)->result();
    }

}

if (!function_exists('insert_pengaruh_langsung')) {

    function insert_pengaruh_langsung($uniq_kode_kondisi, $level5, $nominal, $parent, $org, $tahun, $referensi) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = "
        INSERT INTO jurnal_akrual (
	nomor_refrensi,
	rekening_permen_64_uniq_kode,
	kode_akun,
	uraian_akun,
	posisi,
	nominal,
	date_added,
	date_edited,
	tahun_anggaran,
	parent_id,
	kr_organisasi_org_key
)(
SELECT 
	'$referensi' AS nomor_refrensi,
	kode_akun_jurnal_akrual.rekening_permen_64_uniq_kode,
	CONCAT(rek1,'.',rek2,'.',rek3,'.',rek4,'.',rek5) AS kode_akun,
	rekening_permen_64.uraian AS uraian_akun,
	kode_akun_jurnal_akrual.posisi,
	'$nominal' AS nominal,
	NOW() AS date_added,
	NOW() AS date_eddited,
	'$tahun' AS tahun_anggaran,
	'$parent' AS parent_id,
	'$org' AS kr_organisasi_org_key
FROM (SELECT 
	* 
FROM 
(SELECT
	master_akun_berpengaruh.uniq_kode,
	CONCAT(rek1,'.',rek2,'.',rek3,'.',rek4,'.',rek5) AS kode,
	master_kondisi_jurnal_akrual_uniq_kode,
        rekening_permen_64_uniq_kode
FROM
	master_akun_berpengaruh
JOIN rekening_permen_64 ON master_akun_berpengaruh.rekening_permen_64_uniq_kode = rekening_permen_64.uniq_kode) AS dasar
WHERE dasar.rekening_permen_64_uniq_kode= '$level5' AND master_kondisi_jurnal_akrual_uniq_kode = '$uniq_kode_kondisi') AS akun_berpengaruh
JOIN kode_akun_jurnal_akrual ON akun_berpengaruh.uniq_kode = kode_akun_jurnal_akrual.master_akun_berpengaruh_uniq_kode
JOIN rekening_permen_64 ON kode_akun_jurnal_akrual.rekening_permen_64_uniq_kode = rekening_permen_64.uniq_kode
);";
        return $CI->db->query($sql);
//       return $sql;   
    }

}

if (!function_exists('insert_pengaruh_khusus')) {

    function insert_pengaruh_khusus($uniq_kode_kondisi, $uniq_kode_64, $nominal, $parent, $org, $tahun, $referensi, $kode) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = "
        INSERT INTO jurnal_akrual (
	nomor_refrensi,
	rekening_permen_64_uniq_kode,
	kode_akun,
	uraian_akun,
	posisi,
	nominal,
	date_added,
	date_edited,
	tahun_anggaran,
	parent_id,
	kr_organisasi_org_key
)(
	SELECT
		'$referensi' AS nomor_refrensi,
		rekening.uniq_kode,
		kode_akun,
		rekening.uraian AS uraian_akun,
		kotak.posisi,
		'$nominal' AS nominal,
		NOW() AS date_added,
		NOW() AS date_eddited,
		'$tahun' AS tahun_anggaran,
		'$parent' AS parent_id,
		'$org' AS kr_organisasi_org_key
	FROM
		(
			SELECT
				'' AS nomor_refrensi,
				kode_akun_jurnal_akrual.rekening_permen_64_uniq_kode,
				CASE
			WHEN rek1 != ''
			AND rek2 = '' THEN
				CONCAT (
					rek1,
					'.',
					split_part('$kode', '.', 2),
					'.',
					split_part('$kode', '.', 3),
					'.',
					CASE
				WHEN split_part('$kode', '.', 4) :: INTEGER < 10 THEN
					CONCAT (
						'0',
						RIGHT(split_part('$kode', '.', 4),1)
					)
				ELSE
					split_part('$kode', '.', 4)
				END,
				'.',
				CASE
			WHEN split_part('$kode', '.', 5) :: INTEGER < 10 THEN
				CONCAT (
					'0',
					RIGHT(split_part('$kode', '.', 5),1)
				)
			ELSE
				split_part('$kode', '.', 5)
			END
				)
			WHEN rek1 != ''
			AND rek2 != ''
			AND rek3 = '' THEN
				CONCAT (
					rek1,
					'.',
					rek2,
					'.',
					split_part('$kode', '.', 3),
					'.',
					CASE
				WHEN split_part('$kode', '.', 4) :: INTEGER < 10 THEN
					CONCAT (
						'0',
						RIGHT(split_part('$kode', '.', 4),1)
					)
				ELSE
					split_part('$kode', '.', 4)
				END,
				'.',
				CASE
			WHEN split_part('$kode', '.', 5) :: INTEGER < 10 THEN
				CONCAT (
					'0',
					RIGHT(split_part('$kode', '.', 5),1)
				)
			ELSE
				split_part('$kode', '.', 5)
			END
				)
			WHEN rek1 != ''
			AND rek2 != ''
			AND rek3 != ''
			AND rek4 = '' THEN
				CONCAT (
					rek1,
					'.',
					rek2,
					'.',
					rek3,
					'.',
					CASE
				WHEN split_part('$kode', '.', 4) :: INTEGER < 10 THEN
					CONCAT (
						'0',
						RIGHT(split_part('$kode', '.', 4),1)
					)
				ELSE
					split_part('$kode', '.', 4)
				END,
				'.',
				CASE
			WHEN split_part('$kode', '.', 5) :: INTEGER < 10 THEN
				CONCAT (
					'0',
					RIGHT(split_part('$kode', '.', 5),1)
				)
			ELSE
				split_part('$kode', '.', 5)
			END
				)
			WHEN rek1 != ''
			AND rek2 != ''
			AND rek3 != ''
			AND rek4 != ''
			AND rek5 = '' THEN
				CONCAT (
					rek1,
					'.',
					rek2,
					'.',
					rek3,
					'.',
					rek4,
					'.',
					CASE
				WHEN split_part('$kode', '.', 5) :: INTEGER < 10 THEN
					CONCAT (
						'0',
						RIGHT(split_part('$kode', '.', 5),1)
					)
				ELSE
					split_part('$kode', '.', 5)
				END
				)
			WHEN rek1 != ''
			AND rek2 != ''
			AND rek3 != ''
			AND rek4 != ''
			AND rek5 != '' THEN
				CONCAT (
					rek1,
					'.',
					rek2,
					'.',
					rek3,
					'.',
					rek4,
					'.',
					rek5
				)
			END AS kode_akun,
			rekening_permen_64.uraian AS uraian_akun,
			kode_akun_jurnal_akrual.posisi,
			'' AS nominal,
			NOW() AS date_added,
			'' AS date_eddited,
			'' AS tahun_anggaran,
			'' AS parent_id,
			'' AS kr_organisasi_org_key
		FROM
			master_akun_berpengaruh
		LEFT JOIN kode_akun_jurnal_akrual ON master_akun_berpengaruh.uniq_kode = kode_akun_jurnal_akrual.master_akun_berpengaruh_uniq_kode
		LEFT JOIN rekening_permen_64 ON kode_akun_jurnal_akrual.rekening_permen_64_uniq_kode = rekening_permen_64.uniq_kode
		WHERE
			master_kondisi_jurnal_akrual_uniq_kode = $uniq_kode_kondisi
		AND master_akun_berpengaruh.rekening_permen_64_uniq_kode = $uniq_kode_64
		) AS kotak
	LEFT JOIN (
		SELECT
			CONCAT (
				rek1,
				'.',
				rek2,
				'.',
				rek3,
				'.',
				rek4,
				'.',
				rek5
			) AS kode,
			uniq_kode,
			uraian
		FROM
			rekening_permen_64
	) AS rekening ON kotak.kode_akun = rekening.kode
);
        "
        ;
        return $CI->db->query($sql);
//       return $sql;   
    }

}

if (!function_exists('proses_jurnal_akrual')) { // proses inti (belum)

    function proses_jurnal_akrual($modul, $sub_modul, $uniq_kode, $uniq_kode_kondisi) {
//        echo $modul.'/'.$sub_modul.'/'.$uniq_kode;die();
        $datanya = get_data_nominal_for_jurnal($modul, $sub_modul, $uniq_kode);
//        echo $this->db->last_query(); die();
        $hasil = false;
        if (!empty($datanya)) { //Jika ada level 5 nya
            foreach ($datanya as $datane) {
                $kode = get_kode($datane->kr_akun_level5_uniq_kode);
//                 print_r_pre($kode);
                $hasil_khusus = get_khusus($datane->kode_level5);
//                print_r_pre($hasil_khusus);die();
                if (!empty($hasil_khusus)) { //jika ada diakun berpengaruh
                    foreach ($hasil_khusus AS $row) {
                        if (insert_pengaruh_khusus($uniq_kode_kondisi, $row->rekening_permen_64_uniq_kode, $datane->anggaran_dialokasikan, $datane->parent_id, $datane->kr_organisasi_org_key, TAHUN, $datane->no_bukti, $kode->kode)) {
                            $hasil = true;
                        }
                    }
                } else {
                    if (insert_pengaruh_langsung($uniq_kode_kondisi, $datane->uniq_kode_64, $datane->anggaran_dialokasikan, $datane->parent_id, $datane->kr_organisasi_org_key, TAHUN, $datane->no_bukti)) {
                        $hasil = true;
                    }
                }
            }
        } else {
            //jika tidak ada level 5
        }
        return $hasil;
    }

}
?>