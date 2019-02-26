<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifikasi_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function jumlah_spm_bud($tahun) {
        return $this->db->query("SELECT
            1 AS uniq_kode,
            (
                COALESCE (spm.jumlah_spm, 0) + COALESCE (
                    spm_nihil.jumlah_spm_nihil,
                    0
                )
            ) AS jumlah,
            'SPM' AS uraian
        FROM
            (
                SELECT
                    COUNT (*) AS jumlah_spm,
                    0 AS join_data
                FROM
                    (
                        SELECT DISTINCT
                            ON (spm_uniq_kode, jns_spm_kode) spm_uniq_kode,
                            jns_spm_kode,
                            catatan_verifikasi,
                            persetujuan,
                            date_added,
                            no_spm,
                            no_spm_asal
                        FROM
                            persetujuan_spm
                        WHERE date_part('YEAR', date_added) = '$tahun'
                        ORDER BY
                            spm_uniq_kode,
                            jns_spm_kode,
                            date_added DESC
                    ) AS spm
                WHERE
                    persetujuan = 'Draf'
            ) AS spm
        JOIN (
            SELECT
                COUNT (*) AS jumlah_spm_nihil,
                0 AS join_data
            FROM
                (
                    SELECT DISTINCT
                        ON (spm_uniq_kode, jns_spm_kode) spm_uniq_kode,
                        jns_spm_kode,
                        catatan_verifikasi,
                        persetujuan,
                        date_added,
                        no_spm,
                        no_spm_asal
                    FROM
                        persetujuan_spm_nihil
                    WHERE date_part('YEAR', date_added) = '$tahun'
                    ORDER BY
                        spm_uniq_kode,
                        jns_spm_kode,
                        date_added DESC
                ) AS spm
            WHERE
                persetujuan = 'Draf'
        ) AS spm_nihil ON spm_nihil.join_data = spm.join_data;")->result();
    }

    function detail_spm_bud($tahun) {
        return $this->db->query("SELECT
            *
        FROM
            (
                SELECT
                    COUNT (spm_uniq_kode) AS jumlah,
                    CASE WHEN jns_spm_kode = 7 THEN 
						9
					ELSE 
						jns_spm_kode
					END AS jns_spm_kode,
                    (
                        CASE
                            WHEN jns_spm_kode = 1 THEN
                                'SPM UP'
                            ELSE
                                CASE
                                    WHEN jns_spm_kode = 2 THEN
                                        'SPM GU'
                                    ELSE
                                        CASE
                                            WHEN jns_spm_kode = 3 THEN
                                                'SPM TU'
                                            ELSE
                                                CASE
                                                    WHEN jns_spm_kode = 4 THEN
                                                        'SPM LS Belanja Pegawai'
                                                    ELSE
                                                        CASE
                                                            WHEN jns_spm_kode = 5 THEN
                                                                'SPM LS Barang dan Jasa'
                                                            ELSE
                                                                CASE 
																	WHEN jns_spm_kode = 6 THEN
																		'SPM LS SKPKD'
																	ELSE
																		'SPM LS BLUD'
																END
                                                        END
                                                END
                                        END
                                END
                        END
                    ) AS uraian
                FROM
                    (
                        SELECT DISTINCT
                            ON (spm_uniq_kode, jns_spm_kode) spm_uniq_kode,
                            jns_spm_kode,
                            catatan_verifikasi,
                            persetujuan,
                            date_added,
                            no_spm,
                            no_spm_asal
                        FROM
                            persetujuan_spm
                        WHERE date_part('YEAR', date_added) = '$tahun'
                        ORDER BY
                            spm_uniq_kode,
                            jns_spm_kode,
                            date_added DESC
                    ) AS spm
                WHERE
                    persetujuan = 'Draf'
                GROUP BY
                    jns_spm_kode
            ) AS spm
        UNION
            SELECT
                *
            FROM
                (
                    SELECT
                        count(spm_uniq_kode) AS jumlah,
                        CASE
                    WHEN jns_spm_kode = 1 THEN
                        7
                    ELSE
                        8
                    END AS jenis,
                    (
                        CASE
                        WHEN jns_spm_kode = 1 THEN
                            'SPM GU NIHIL'
                        ELSE
                            'SPM TU NIHIL'
                        END
                    ) AS uraian
                FROM
                    (
                        SELECT DISTINCT
                            ON (spm_uniq_kode, jns_spm_kode) spm_uniq_kode,
                            jns_spm_kode,
                            catatan_verifikasi,
                            persetujuan,
                            date_added,
                            no_spm,
                            no_spm_asal
                        FROM
                            persetujuan_spm_nihil
                        WHERE date_part('YEAR', date_added) = '$tahun'
                        ORDER BY
                            spm_uniq_kode,
                            jns_spm_kode,
                            date_added DESC
                    ) AS spm
                WHERE
                    persetujuan = 'Draf'
                GROUP BY
                    jns_spm_kode
                ) AS spm_nihil
            ORDER BY
                jns_spm_kode;")->result();
    }

    function jumlah_spm_ditolak_ppk($org, $tahun) {
        return $this->db->query("SELECT
				3 AS id_spm,
				(
					COALESCE (spm.jumlah_spm, 0) + COALESCE (
						spm_nihil.jumlah_spm_nihil,
						0
					)
				) AS jumlah_spm,
				'SPM' AS uraian_spm,
				0 AS join_data
			FROM
				(
					SELECT
						COUNT (*) AS jumlah_spm,
						0 AS join_data
					FROM
						(
							SELECT DISTINCT
								ON (spm_uniq_kode, jns_spm_kode) spm_uniq_kode,
								jns_spm_kode,
								catatan_verifikasi,
								persetujuan,
								date_added,
								no_spm,
								no_spm_asal,
								kr_organisasi_org_key,
								parent_id
							FROM
								(
									SELECT
										spm.*, korg.parent_id
									FROM
										(
											SELECT
												ps.*, su.kr_organisasi_org_key
											FROM
												persetujuan_spm ps
											JOIN spm_up su ON su.uniq_kode = ps.spm_uniq_kode
											AND 1 = ps.jns_spm_kode
											UNION
												SELECT
													ps.*, sg.kr_organisasi_org_key
												FROM
													persetujuan_spm ps
												JOIN spm_gu sg ON sg.uniq_kode = ps.spm_uniq_kode
												AND 2 = ps.jns_spm_kode
												UNION
													SELECT
														ps.*, st.kr_organisasi_org_key
													FROM
														persetujuan_spm ps
													JOIN spm_tu st ON st.uniq_kode = ps.spm_uniq_kode
													AND 3 = ps.jns_spm_kode
													UNION
														SELECT
															ps.*, slp.kr_organisasi_org_key
														FROM
															persetujuan_spm ps
														JOIN spm_ls_pegawai slp ON slp.uniq_kode = ps.spm_uniq_kode
														AND 4 = ps.jns_spm_kode
														UNION
															SELECT
																ps.*, slbj.kr_organisasi_org_key
															FROM
																persetujuan_spm ps
															JOIN spm_ls_brg_js slbj ON slbj.uniq_kode = ps.spm_uniq_kode
															AND 5 = ps.jns_spm_kode
															UNION
																SELECT
																	ps.*, sls.kr_organisasi_org_key
																FROM
																	persetujuan_spm ps
																JOIN spm_ls_skpkd sls ON sls.uniq_kode = ps.spm_uniq_kode
																AND 6 = ps.jns_spm_kode
																UNION
																	SELECT
																		ps.*, sls.kr_organisasi_org_key
																	FROM
																		persetujuan_spm ps
																	JOIN spm_ls_blud sls ON sls.uniq_kode = ps.spm_uniq_kode
																	AND 7 = ps.jns_spm_kode
										) AS spm
									JOIN kr_organisasi korg ON korg.org_key = spm.kr_organisasi_org_key
									WHERE
										date_part('YEAR', date_added) = '$tahun'
									AND (
										spm.kr_organisasi_org_key = '$org'
										OR parent_id = '$org'
									)
								) AS spm_all
							ORDER BY
								spm_uniq_kode,
								jns_spm_kode,
								date_added DESC
						) AS spm
					WHERE
						persetujuan = 'Ditolak'
				) AS spm
			JOIN (
				SELECT
					COUNT (*) AS jumlah_spm_nihil,
					0 AS join_data
				FROM
					(
						SELECT DISTINCT
							ON (spm_uniq_kode, jns_spm_kode) spm_uniq_kode,
							jns_spm_kode,
							catatan_verifikasi,
							persetujuan,
							date_added,
							no_spm,
							no_spm_asal,
							kr_organisasi_org_key,
							parent_id
						FROM
							(
								SELECT
									spm_n.*, korg.parent_id
								FROM
									(
										SELECT
											psn.*, sg.kr_organisasi_org_key
										FROM
											persetujuan_spm_nihil psn
										JOIN spm_gu_nihil sg ON sg.uniq_kode = psn.spm_uniq_kode
										AND 1 = psn.jns_spm_kode
										UNION
											SELECT
												psn.*, st.kr_organisasi_org_key
											FROM
												persetujuan_spm_nihil psn
											JOIN spm_tu_nihil st ON st.uniq_kode = psn.spm_uniq_kode
											AND 2 = psn.jns_spm_kode
									) AS spm_n
								JOIN kr_organisasi korg ON korg.org_key = spm_n.kr_organisasi_org_key
								WHERE
									date_part('YEAR', date_added) = '$tahun'
								AND (
									spm_n.kr_organisasi_org_key = '$org'
									OR parent_id = '$org'
								)
							) AS spm_nihil_all
						ORDER BY
							spm_uniq_kode,
							jns_spm_kode,
							date_added DESC
					) AS spm
				WHERE
					persetujuan = 'Ditolak'
			) AS spm_nihil ON spm_nihil.join_data = spm.join_data;")->result();
    }

    function jumlah_spm_ditolak_detail_ppk($org, $tahun) {
        return $this->db->query("SELECT
				*
			FROM
				(
					SELECT
						CASE WHEN jns_spm_kode = 7 THEN 
							9
						ELSE 
							jns_spm_kode
						END AS jns_spm_kode,
						COUNT (spm_uniq_kode) AS jumlah,
						(
							CASE
								WHEN jns_spm_kode = 1 THEN
									'SPM UP'
								ELSE
									CASE
										WHEN jns_spm_kode = 2 THEN
											'SPM GU'
										ELSE
											CASE
												WHEN jns_spm_kode = 3 THEN
													'SPM TU'
												ELSE
													CASE
														WHEN jns_spm_kode = 4 THEN
															'SPM LS Belanja Pegawai'
														ELSE
															CASE
																WHEN jns_spm_kode = 5 THEN
																	'SPM LS Barang dan Jasa'
																ELSE
																	CASE 
																		WHEN jns_spm_kode = 6 THEN 
																			'SPM LS SKPKD' 
																		ELSE 
																			'SPM LS BLUD'
																	END
															END
													END
											END
									END
							END
						) AS uraian
					FROM
						(
							SELECT DISTINCT
								ON (spm_uniq_kode, jns_spm_kode) spm_uniq_kode,
								jns_spm_kode,
								catatan_verifikasi,
								persetujuan,
								date_added,
								no_spm,
								no_spm_asal,
								kr_organisasi_org_key,
								parent_id
							FROM
								(
									SELECT
										spm.*, korg.parent_id
									FROM
										(
											SELECT
												ps.*, su.kr_organisasi_org_key
											FROM
												persetujuan_spm ps
											JOIN spm_up su ON su.uniq_kode = ps.spm_uniq_kode
											AND 1 = ps.jns_spm_kode
											UNION
												SELECT
													ps.*, sg.kr_organisasi_org_key
												FROM
													persetujuan_spm ps
												JOIN spm_gu sg ON sg.uniq_kode = ps.spm_uniq_kode
												AND 2 = ps.jns_spm_kode
												UNION
													SELECT
														ps.*, st.kr_organisasi_org_key
													FROM
														persetujuan_spm ps
													JOIN spm_tu st ON st.uniq_kode = ps.spm_uniq_kode
													AND 3 = ps.jns_spm_kode
													UNION
														SELECT
															ps.*, slp.kr_organisasi_org_key
														FROM
															persetujuan_spm ps
														JOIN spm_ls_pegawai slp ON slp.uniq_kode = ps.spm_uniq_kode
														AND 4 = ps.jns_spm_kode
														UNION
															SELECT
																ps.*, slbj.kr_organisasi_org_key
															FROM
																persetujuan_spm ps
															JOIN spm_ls_brg_js slbj ON slbj.uniq_kode = ps.spm_uniq_kode
															AND 5 = ps.jns_spm_kode
															UNION
																SELECT
																	ps.*, sls.kr_organisasi_org_key
																FROM
																	persetujuan_spm ps
																JOIN spm_ls_skpkd sls ON sls.uniq_kode = ps.spm_uniq_kode
																AND 6 = ps.jns_spm_kode
																UNION
																	SELECT
																		ps.*, sls.kr_organisasi_org_key
																	FROM
																		persetujuan_spm ps
																	JOIN spm_ls_blud sls ON sls.uniq_kode = ps.spm_uniq_kode
																	AND 7 = ps.jns_spm_kode
										) AS spm
									JOIN kr_organisasi korg ON korg.org_key = spm.kr_organisasi_org_key
									WHERE
										date_part('YEAR', date_added) = '$tahun'
									AND (
										spm.kr_organisasi_org_key = '$org'
										OR parent_id = '$org'
									)
								) AS spm_all
							ORDER BY
								spm_uniq_kode,
								jns_spm_kode,
								date_added DESC
						) AS spm
					WHERE
						persetujuan = 'Ditolak'
					GROUP BY
						jns_spm_kode
				) AS spm
			UNION
				SELECT
					*
				FROM
					(
						SELECT
							CASE
						WHEN jns_spm_kode = 1 THEN
							7
						ELSE
							8
						END AS jenis,
						COUNT (spm_uniq_kode) AS jumlah,
						(
							CASE
							WHEN jns_spm_kode = 1 THEN
								'SPM GU NIHIL'
							ELSE
								'SPM TU NIHIL'
							END
						) AS uraian
					FROM
						(
							SELECT DISTINCT
								ON (spm_uniq_kode, jns_spm_kode) spm_uniq_kode,
								jns_spm_kode,
								catatan_verifikasi,
								persetujuan,
								date_added,
								no_spm,
								no_spm_asal,
								kr_organisasi_org_key,
								parent_id
							FROM
								(
									SELECT
										spm_n.*, korg.parent_id
									FROM
										(
											SELECT
												psn.*, sg.kr_organisasi_org_key
											FROM
												persetujuan_spm_nihil psn
											JOIN spm_gu_nihil sg ON sg.uniq_kode = psn.spm_uniq_kode
											AND 1 = psn.jns_spm_kode
											UNION
												SELECT
													psn.*, st.kr_organisasi_org_key
												FROM
													persetujuan_spm_nihil psn
												JOIN spm_tu_nihil st ON st.uniq_kode = psn.spm_uniq_kode
												AND 2 = psn.jns_spm_kode
										) AS spm_n
									JOIN kr_organisasi korg ON korg.org_key = spm_n.kr_organisasi_org_key
									WHERE
										date_part('YEAR', date_added) = '$tahun'
									AND (
										spm_n.kr_organisasi_org_key = '$org'
										OR parent_id = '$org'
									)
								) AS spm_nihil_all
							ORDER BY
								spm_uniq_kode,
								jns_spm_kode,
								date_added DESC
						) AS spm
					WHERE
						persetujuan = 'Ditolak'
					GROUP BY
						jns_spm_kode
					) AS spm_nihil
				ORDER BY
					jns_spm_kode;")->result();
    }

    function jumlah_spm_persiapan_ppk($org, $tahun) {
        return $this->db->query("SELECT
				2 AS id_spm,
				(
					COALESCE (spm.jumlah_spm, 0) + COALESCE (
						spm_nihil.jumlah_spm_nihil,
						0
					)
				) AS jumlah_spm,
				'SPM' AS uraian_spm,
				0 AS join_data
			FROM
				(
					SELECT
						COUNT (*) AS jumlah_spm,
						0 AS join_data
					FROM
						(
							SELECT DISTINCT
								ON (spm_uniq_kode, jns_spm_kode) spm_uniq_kode,
								jns_spm_kode,
								catatan_verifikasi,
								persetujuan,
								date_added,
								no_spm,
								no_spm_asal,
								kr_organisasi_org_key,
								parent_id
							FROM
								(
									SELECT
										spm.*, korg.parent_id
									FROM
										(
											SELECT
												ps.*, su.kr_organisasi_org_key
											FROM
												persetujuan_spm ps
											JOIN spm_up su ON su.uniq_kode = ps.spm_uniq_kode
											AND 1 = ps.jns_spm_kode
											UNION
												SELECT
													ps.*, sg.kr_organisasi_org_key
												FROM
													persetujuan_spm ps
												JOIN spm_gu sg ON sg.uniq_kode = ps.spm_uniq_kode
												AND 2 = ps.jns_spm_kode
												UNION
													SELECT
														ps.*, st.kr_organisasi_org_key
													FROM
														persetujuan_spm ps
													JOIN spm_tu st ON st.uniq_kode = ps.spm_uniq_kode
													AND 3 = ps.jns_spm_kode
													UNION
														SELECT
															ps.*, slp.kr_organisasi_org_key
														FROM
															persetujuan_spm ps
														JOIN spm_ls_pegawai slp ON slp.uniq_kode = ps.spm_uniq_kode
														AND 4 = ps.jns_spm_kode
														UNION
															SELECT
																ps.*, slbj.kr_organisasi_org_key
															FROM
																persetujuan_spm ps
															JOIN spm_ls_brg_js slbj ON slbj.uniq_kode = ps.spm_uniq_kode
															AND 5 = ps.jns_spm_kode
															UNION
																SELECT
																	ps.*, sls.kr_organisasi_org_key
																FROM
																	persetujuan_spm ps
																JOIN spm_ls_skpkd sls ON sls.uniq_kode = ps.spm_uniq_kode
																AND 6 = ps.jns_spm_kode
																UNION
																	SELECT
																		ps.*, sls.kr_organisasi_org_key
																	FROM
																		persetujuan_spm ps
																	JOIN spm_ls_blud sls ON sls.uniq_kode = ps.spm_uniq_kode
																	AND 7 = ps.jns_spm_kode
										) AS spm
									JOIN kr_organisasi korg ON korg.org_key = spm.kr_organisasi_org_key
									WHERE
										date_part('YEAR', date_added) = '$tahun'
									AND (
										spm.kr_organisasi_org_key = '$org'
										OR parent_id = '$org'
									)
								) AS spm_all
							ORDER BY
								spm_uniq_kode,
								jns_spm_kode,
								date_added DESC
						) AS spm
					WHERE
						persetujuan = 'Persiapan'
				) AS spm
			JOIN (
				SELECT
					COUNT (*) AS jumlah_spm_nihil,
					0 AS join_data
				FROM
					(
						SELECT DISTINCT
							ON (spm_uniq_kode, jns_spm_kode) spm_uniq_kode,
							jns_spm_kode,
							catatan_verifikasi,
							persetujuan,
							date_added,
							no_spm,
							no_spm_asal,
							kr_organisasi_org_key,
							parent_id
						FROM
							(
								SELECT
									spm_n.*, korg.parent_id
								FROM
									(
										SELECT
											psn.*, sg.kr_organisasi_org_key
										FROM
											persetujuan_spm_nihil psn
										JOIN spm_gu_nihil sg ON sg.uniq_kode = psn.spm_uniq_kode
										AND 1 = psn.jns_spm_kode
										UNION
											SELECT
												psn.*, st.kr_organisasi_org_key
											FROM
												persetujuan_spm_nihil psn
											JOIN spm_tu_nihil st ON st.uniq_kode = psn.spm_uniq_kode
											AND 2 = psn.jns_spm_kode
									) AS spm_n
								JOIN kr_organisasi korg ON korg.org_key = spm_n.kr_organisasi_org_key
								WHERE
									date_part('YEAR', date_added) = '$tahun'
								AND (
									spm_n.kr_organisasi_org_key = '$org'
									OR parent_id = '$org'
								)
							) AS spm_nihil_all
						ORDER BY
							spm_uniq_kode,
							jns_spm_kode,
							date_added DESC
					) AS spm
				WHERE
					persetujuan = 'Persiapan'
			) AS spm_nihil ON spm_nihil.join_data = spm.join_data;")->result();
    }

    function jumlah_spm_persiapan_detail_ppk($org, $tahun) {
        return $this->db->query("SELECT
				*
			FROM
				(
					SELECT
						CASE 
							WHEN jns_spm_kode = 7 THEN
								9
							ELSE 
								jns_spm_kode
							END AS jns_spm_kode,
						COUNT (spm_uniq_kode) AS jumlah,
						(
							CASE
								WHEN jns_spm_kode = 1 THEN
									'SPM UP'
								ELSE
									CASE
										WHEN jns_spm_kode = 2 THEN
											'SPM GU'
										ELSE
											CASE
												WHEN jns_spm_kode = 3 THEN
													'SPM TU'
												ELSE
													CASE
														WHEN jns_spm_kode = 4 THEN
															'SPM LS Belanja Pegawai'
														ELSE
															CASE
																WHEN jns_spm_kode = 5 THEN
																	'SPM LS Barang dan Jasa'
																ELSE
																	CASE
																		WHEN jns_spm_kode = 6 THEN
																			'SPM LS SKPKD'
																		ELSE
																			'SPM LS BLUD'
																	END
															END
													END
											END
									END
							END
						) AS uraian
					FROM
						(
							SELECT DISTINCT
								ON (spm_uniq_kode, jns_spm_kode) spm_uniq_kode,
								jns_spm_kode,
								catatan_verifikasi,
								persetujuan,
								date_added,
								no_spm,
								no_spm_asal,
								kr_organisasi_org_key,
								parent_id
							FROM
								(
									SELECT
										spm.*, korg.parent_id
									FROM
										(
											SELECT
												ps.*, su.kr_organisasi_org_key
											FROM
												persetujuan_spm ps
											JOIN spm_up su ON su.uniq_kode = ps.spm_uniq_kode
											AND 1 = ps.jns_spm_kode
											UNION
												SELECT
													ps.*, sg.kr_organisasi_org_key
												FROM
													persetujuan_spm ps
												JOIN spm_gu sg ON sg.uniq_kode = ps.spm_uniq_kode
												AND 2 = ps.jns_spm_kode
												UNION
													SELECT
														ps.*, st.kr_organisasi_org_key
													FROM
														persetujuan_spm ps
													JOIN spm_tu st ON st.uniq_kode = ps.spm_uniq_kode
													AND 3 = ps.jns_spm_kode
													UNION
														SELECT
															ps.*, slp.kr_organisasi_org_key
														FROM
															persetujuan_spm ps
														JOIN spm_ls_pegawai slp ON slp.uniq_kode = ps.spm_uniq_kode
														AND 4 = ps.jns_spm_kode
														UNION
															SELECT
																ps.*, slbj.kr_organisasi_org_key
															FROM
																persetujuan_spm ps
															JOIN spm_ls_brg_js slbj ON slbj.uniq_kode = ps.spm_uniq_kode
															AND 5 = ps.jns_spm_kode
															UNION
																SELECT
																	ps.*, sls.kr_organisasi_org_key
																FROM
																	persetujuan_spm ps
																JOIN spm_ls_skpkd sls ON sls.uniq_kode = ps.spm_uniq_kode
																AND 6 = ps.jns_spm_kode
																UNION
																	SELECT
																		ps.*, sls.kr_organisasi_org_key
																	FROM
																		persetujuan_spm ps
																	JOIN spm_ls_blud sls ON sls.uniq_kode = ps.spm_uniq_kode
																	AND 7 = ps.jns_spm_kode
										) AS spm
									JOIN kr_organisasi korg ON korg.org_key = spm.kr_organisasi_org_key
									WHERE
										date_part('YEAR', date_added) = '$tahun'
									AND (
										spm.kr_organisasi_org_key = '$org'
										OR parent_id = '$org'
									)
								) AS spm_all
							ORDER BY
								spm_uniq_kode,
								jns_spm_kode,
								date_added DESC
						) AS spm
					WHERE
						persetujuan = 'Persiapan'
					GROUP BY
						jns_spm_kode
				) AS spm
			UNION
				SELECT
					*
				FROM
					(
						SELECT
							CASE
						WHEN jns_spm_kode = 1 THEN
							7
						ELSE
							8
						END AS jenis,
						COUNT (spm_uniq_kode) AS jumlah,
						(
							CASE
							WHEN jns_spm_kode = 1 THEN
								'SPM GU NIHIL'
							ELSE
								'SPM TU NIHIL'
							END
						) AS uraian
					FROM
						(
							SELECT DISTINCT
								ON (spm_uniq_kode, jns_spm_kode) spm_uniq_kode,
								jns_spm_kode,
								catatan_verifikasi,
								persetujuan,
								date_added,
								no_spm,
								no_spm_asal,
								kr_organisasi_org_key,
								parent_id
							FROM
								(
									SELECT
										spm_n.*, korg.parent_id
									FROM
										(
											SELECT
												psn.*, sg.kr_organisasi_org_key
											FROM
												persetujuan_spm_nihil psn
											JOIN spm_gu_nihil sg ON sg.uniq_kode = psn.spm_uniq_kode
											AND 1 = psn.jns_spm_kode
											UNION
												SELECT
													psn.*, st.kr_organisasi_org_key
												FROM
													persetujuan_spm_nihil psn
												JOIN spm_tu_nihil st ON st.uniq_kode = psn.spm_uniq_kode
												AND 2 = psn.jns_spm_kode
										) AS spm_n
									JOIN kr_organisasi korg ON korg.org_key = spm_n.kr_organisasi_org_key
									WHERE
										date_part('YEAR', date_added) = '$tahun'
									AND (
										spm_n.kr_organisasi_org_key = '$org'
										OR parent_id = '$org'
									)
								) AS spm_nihil_all
							ORDER BY
								spm_uniq_kode,
								jns_spm_kode,
								date_added DESC
						) AS spm
					WHERE
						persetujuan = 'Persiapan'
					GROUP BY
						jns_spm_kode
					) AS spm_nihil
				ORDER BY
					jns_spm_kode;")->result();
    }

    function jumlah_lpj_ppk($org, $tahun) {
        return $this->db->query("SELECT
			4 AS id_lpj,
			COUNT (*) AS jumlah_lpj,
			'LPJ' AS uraian_lpj,
			0 AS join_data
		FROM
			(
				SELECT DISTINCT
					ON (lpj_uniq_kode, jns_lpj_kode) lpj_uniq_kode,
					jns_lpj_kode,
					catatan_verifikasi,
					persetujuan,
					-- 	nip_penginput,
					date_added,
					no_lpj,
					no_lpj_asal,
					kr_organisasi_org_key,
					parent_id
				FROM
					(
						SELECT
							lpj.*, korg.parent_id
						FROM
							(
								SELECT
									pl.*, lg.kr_organisasi_org_key
								FROM
									persetujuan_lpj pl
								JOIN lpj_gu lg ON lg.uniq_kode = pl.lpj_uniq_kode
								AND pl.jns_lpj_kode = 1
								UNION
									SELECT
										pl.*, lt.kr_organisasi_org_key
									FROM
										persetujuan_lpj pl
									JOIN lpj_tu lt ON lt.uniq_kode = pl.lpj_uniq_kode
									AND pl.jns_lpj_kode = 2
							) AS lpj
						JOIN kr_organisasi korg ON korg.org_key = lpj.kr_organisasi_org_key
						WHERE
							date_part('YEAR', date_added) = '$tahun'
						AND (
							lpj.kr_organisasi_org_key = '$org'
							OR parent_id = '$org'
						)
					) AS lpj_all
				ORDER BY
					lpj_uniq_kode,
					jns_lpj_kode,
					date_added DESC
			) AS lpj_new
		WHERE
			persetujuan = 'Draf';")->result();
    }

    function jumlah_lpj_detail_ppk($org, $tahun) {
        return $this->db->query("SELECT
				jns_lpj_kode,
				COUNT (*) AS jumlah,
				(
					CASE WHEN jns_lpj_kode = 1 THEN 'LPJ GU' ELSE 'LPJ TU' END
				)AS uraian
			FROM
				(
					SELECT DISTINCT
						ON (lpj_uniq_kode, jns_lpj_kode) lpj_uniq_kode,
						jns_lpj_kode,
						catatan_verifikasi,
						persetujuan,
						-- 	nip_penginput,
						date_added,
						no_lpj,
						no_lpj_asal,
						kr_organisasi_org_key,
						parent_id
					FROM
						(
							SELECT
								lpj.*, korg.parent_id
							FROM
								(
									SELECT
										pl.*, lg.kr_organisasi_org_key
									FROM
										persetujuan_lpj pl
									JOIN lpj_gu lg ON lg.uniq_kode = pl.lpj_uniq_kode
									AND pl.jns_lpj_kode = 1
									UNION
										SELECT
											pl.*, lt.kr_organisasi_org_key
										FROM
											persetujuan_lpj pl
										JOIN lpj_tu lt ON lt.uniq_kode = pl.lpj_uniq_kode
										AND pl.jns_lpj_kode = 2
								) AS lpj
							JOIN kr_organisasi korg ON korg.org_key = lpj.kr_organisasi_org_key
							WHERE
								date_part('YEAR', date_added) = '$tahun'
							AND (
								lpj.kr_organisasi_org_key = '$org'
								OR parent_id = '$org'
							)
						) AS lpj_all
					ORDER BY
						lpj_uniq_kode,
						jns_lpj_kode,
						date_added DESC
				) AS lpj_new
			WHERE
				persetujuan = 'Draf'
			GROUP BY
			jns_lpj_kode;")->result();
    }

    function jumlah_spp_ppk($org, $tahun) {
        return $this->db->query("SELECT
					1 AS id_spp,
				(
					COALESCE (spp_all.jumlah_spp, 0) + COALESCE (
						spp_nihil_all.jumlah_spp_nihil,
						0
					)
				) AS jumlah_spp,
				'SPP' AS uraian_spm
			-- ,
			-- 	0 AS join_data
			FROM
				(
					SELECT
						COUNT (*) AS jumlah_spp,
						0 AS join_data
					FROM
						(
							SELECT DISTINCT
								ON (spp_uniq_kode, jns_spp_kode) spp_uniq_kode,
								jns_spp_kode,
								catatan_verifikasi,
								persetujuan,
								date_added,
								no_spp,
								no_spp_asal,
								kr_organisasi_org_key,
								parent_id
							FROM
								(
									SELECT
										spp.*, korg.parent_id
									FROM
										(
											SELECT
												ps.*, spp.kr_organisasi_org_key
											FROM
												persetujuan_spp ps
											JOIN spp_up spp ON spp.uniq_kode = ps.spp_uniq_kode
											AND 1 = ps.jns_spp_kode
											UNION
												SELECT
													ps.*, spp.kr_organisasi_org_key
												FROM
													persetujuan_spp ps
												JOIN spp_gu spp ON spp.uniq_kode = ps.spp_uniq_kode
												AND 2 = ps.jns_spp_kode
												UNION
													SELECT
														ps.*, spp.kr_organisasi_org_key
													FROM
														persetujuan_spp ps
													JOIN spp_tu spp ON spp.uniq_kode = ps.spp_uniq_kode
													AND 3 = ps.jns_spp_kode
													UNION
														SELECT
															ps.*, spp.kr_organisasi_org_key
														FROM
															persetujuan_spp ps
														JOIN spp_ls_pegawai spp ON spp.uniq_kode = ps.spp_uniq_kode
														AND 4 = ps.jns_spp_kode
														UNION
															SELECT
																ps.*, spp.kr_organisasi_org_key
															FROM
																persetujuan_spp ps
															JOIN spp_ls_brg_js spp ON spp.uniq_kode = ps.spp_uniq_kode
															AND 5 = ps.jns_spp_kode
															UNION
																SELECT
																	ps.*, spp.kr_organisasi_org_key
																FROM
																	persetujuan_spp ps
																JOIN spp_ls_skpkd spp ON spp.uniq_kode = ps.spp_uniq_kode
																AND 6 = ps.jns_spp_kode
																UNION
																	SELECT
																		ps.*, spp.kr_organisasi_org_key
																	FROM
																		persetujuan_spp ps
																	JOIN spp_ls_blud spp ON spp.uniq_kode = ps.spp_uniq_kode
																	AND 7 = ps.jns_spp_kode
										) AS spp
									JOIN kr_organisasi korg ON korg.org_key = spp.kr_organisasi_org_key
									WHERE
										date_part('YEAR', date_added) = '$tahun'
									AND (
										spp.kr_organisasi_org_key = '$org'
										OR parent_id = '$org'
									)
								) AS spp2
							ORDER BY
								spp_uniq_kode,
								jns_spp_kode,
								date_added DESC
						) AS spp3
					WHERE
						persetujuan = 'Draf'
				) AS spp_all
			JOIN (
				SELECT
					COUNT (*) AS jumlah_spp_nihil,
					0 AS join_data
				FROM
					(
						SELECT DISTINCT
							ON (spp_uniq_kode, jns_spp_kode) spp_uniq_kode,
							jns_spp_kode,
							catatan_verifikasi,
							persetujuan,
							date_added,
							no_spp,
							no_spp_asal,
							kr_organisasi_org_key,
							parent_id
						FROM
							(
								SELECT
									spp_nihil.*, korg.parent_id
								FROM
									(
										SELECT
											psn.*, sgn.kr_organisasi_org_key
										FROM
											persetujuan_spp_nihil psn
										JOIN spp_gu_nihil sgn ON sgn.uniq_kode = psn.spp_uniq_kode
										AND 1 = psn.jns_spp_kode
										UNION
											SELECT
												psn.*, stn.kr_organisasi_org_key
											FROM
												persetujuan_spp_nihil psn
											JOIN spp_tu_nihil stn ON stn.uniq_kode = psn.spp_uniq_kode
											AND 2 = psn.jns_spp_kode
									) AS spp_nihil
								JOIN kr_organisasi korg ON korg.org_key = spp_nihil.kr_organisasi_org_key
								WHERE
									date_part('YEAR', date_added) = '$tahun'
								AND (
									spp_nihil.kr_organisasi_org_key = '$org'
									OR parent_id = '$org'
								)
							) AS spp_nihil2
						ORDER BY
							spp_uniq_kode,
							jns_spp_kode,
							date_added DESC
					) AS spp_nihil3
				WHERE
					persetujuan = 'Draf'
			) AS spp_nihil_all ON spp_nihil_all.join_data = spp_all.join_data;")->result();
    }

    function jumlah_spp_detail_ppk($org, $tahun) {
        return $this->db->query("SELECT
				*
			FROM
				(
					SELECT
						CASE
							WHEN jns_spp_kode = 7 THEN
								9
							ELSE
								jns_spp_kode
							END AS jns_spp_kode,
						COUNT (spp_uniq_kode) AS jumlah,
						(
							CASE
								WHEN jns_spp_kode = 1 THEN
									'SPP UP'
								ELSE
									CASE
										WHEN jns_spp_kode = 2 THEN
											'SPP GU'
										ELSE
											CASE
												WHEN jns_spp_kode = 3 THEN
													'SPP TU'
												ELSE
													CASE
														WHEN jns_spp_kode = 4 THEN
															'SPP LS Belanja Pegawai'
														ELSE
															CASE
																WHEN jns_spp_kode = 5 THEN
																	'SPP LS Barang dan Jasa'
																ELSE
																	CASE
																		WHEN jns_spp_kode = 6 THEN
																			'SPP LS SKPKD'
																		ELSE
																			'SPP LS BLUD'
																	END
															END
													END
											END
									END
							END
						) AS uraian
					FROM
						(
							SELECT DISTINCT
								ON (spp_uniq_kode, jns_spp_kode) spp_uniq_kode,
								jns_spp_kode,
								catatan_verifikasi,
								persetujuan,
								date_added,
								no_spp,
								no_spp_asal,
								kr_organisasi_org_key,
								parent_id
							FROM
								(
									SELECT
										spp.*, korg.parent_id
									FROM
										(
											SELECT
												ps.*, spp.kr_organisasi_org_key
											FROM
												persetujuan_spp ps
											JOIN spp_up spp ON spp.uniq_kode = ps.spp_uniq_kode
											AND 1 = ps.jns_spp_kode
											UNION
												SELECT
													ps.*, spp.kr_organisasi_org_key
												FROM
													persetujuan_spp ps
												JOIN spp_gu spp ON spp.uniq_kode = ps.spp_uniq_kode
												AND 2 = ps.jns_spp_kode
												UNION
													SELECT
														ps.*, spp.kr_organisasi_org_key
													FROM
														persetujuan_spp ps
													JOIN spp_tu spp ON spp.uniq_kode = ps.spp_uniq_kode
													AND 3 = ps.jns_spp_kode
													UNION
														SELECT
															ps.*, spp.kr_organisasi_org_key
														FROM
															persetujuan_spp ps
														JOIN spp_ls_pegawai spp ON spp.uniq_kode = ps.spp_uniq_kode
														AND 4 = ps.jns_spp_kode
														UNION
															SELECT
																ps.*, spp.kr_organisasi_org_key
															FROM
																persetujuan_spp ps
															JOIN spp_ls_brg_js spp ON spp.uniq_kode = ps.spp_uniq_kode
															AND 5 = ps.jns_spp_kode
															UNION
																SELECT
																	ps.*, spp.kr_organisasi_org_key
																FROM
																	persetujuan_spp ps
																JOIN spp_ls_skpkd spp ON spp.uniq_kode = ps.spp_uniq_kode
																AND 6 = ps.jns_spp_kode
																UNION
																	SELECT
																		ps.*, spp.kr_organisasi_org_key
																	FROM
																		persetujuan_spp ps
																	JOIN spp_ls_blud spp ON spp.uniq_kode = ps.spp_uniq_kode
																	AND 7 = ps.jns_spp_kode
										) AS spp
									JOIN kr_organisasi korg ON korg.org_key = spp.kr_organisasi_org_key
									WHERE
										date_part('YEAR', date_added) = '$tahun'
									AND (
										spp.kr_organisasi_org_key = '$org'
										OR parent_id = '$org'
									)
								) AS spp2
							ORDER BY
								spp_uniq_kode,
								jns_spp_kode,
								date_added DESC
						) AS spp3
					WHERE
						persetujuan = 'Draf'
					GROUP BY
						jns_spp_kode
				) AS spp_all
			UNION
			SELECT
				*
			FROM
				(
					SELECT
						CASE
					WHEN jns_spp_kode = 1 THEN
						7
					ELSE
						8
					END AS jenis,
					COUNT (spp_uniq_kode) AS jumlah,
					(
						CASE
						WHEN jns_spp_kode = 1 THEN
							'SPP GU NIHIL'
						ELSE
							'SPP TU NIHIL'
						END
					) AS uraian
				FROM
					(
						SELECT DISTINCT
							ON (spp_uniq_kode, jns_spp_kode) spp_uniq_kode,
							jns_spp_kode,
							catatan_verifikasi,
							persetujuan,
							date_added,
							no_spp,
							no_spp_asal,
							kr_organisasi_org_key,
							parent_id
						FROM
							(
								SELECT
									spp_nihil.*, korg.parent_id
								FROM
									(
										SELECT
											psn.*, sgn.kr_organisasi_org_key
										FROM
											persetujuan_spp_nihil psn
										JOIN spp_gu_nihil sgn ON sgn.uniq_kode = psn.spp_uniq_kode
										AND 1 = psn.jns_spp_kode
										UNION
											SELECT
												psn.*, stn.kr_organisasi_org_key
											FROM
												persetujuan_spp_nihil psn
											JOIN spp_tu_nihil stn ON stn.uniq_kode = psn.spp_uniq_kode
											AND 2 = psn.jns_spp_kode
									) AS spp_nihil
								JOIN kr_organisasi korg ON korg.org_key = spp_nihil.kr_organisasi_org_key
								WHERE
									date_part('YEAR', date_added) = '$tahun'
								AND (
									spp_nihil.kr_organisasi_org_key = '$org'
									OR parent_id = '$org'
								)
							) AS spp_nihil2
						ORDER BY
							spp_uniq_kode,
							jns_spp_kode,
							date_added DESC
					) AS spp_nihil3
				WHERE
					persetujuan = 'Draf'
				GROUP BY
					jns_spp_kode
				) AS spp_nihil_all;")->result();
    }

    function jumlah_lpj_bp_bpp($org, $tahun) {
        return $this->db->query("SELECT
				3 AS id_lpj,
				COUNT (*) AS jumlah_lpj,
				'LPJ' AS uraian_lpj,
				0 AS join_data
			FROM
				(
					SELECT DISTINCT
						ON (lpj_uniq_kode, jns_lpj_kode) lpj_uniq_kode,
						jns_lpj_kode,
						catatan_verifikasi,
						persetujuan,
						-- 	nip_penginput,
						date_added,
						no_lpj,
						no_lpj_asal,
						kr_organisasi_org_key,
						parent_id
					FROM
						(
							SELECT
								lpj.*, korg.parent_id
							FROM
								(
									SELECT
										pl.*, lg.kr_organisasi_org_key
									FROM
										persetujuan_lpj pl
									JOIN lpj_gu lg ON lg.uniq_kode = pl.lpj_uniq_kode
									AND pl.jns_lpj_kode = 1
									UNION
										SELECT
											pl.*, lt.kr_organisasi_org_key
										FROM
											persetujuan_lpj pl
										JOIN lpj_tu lt ON lt.uniq_kode = pl.lpj_uniq_kode
										AND pl.jns_lpj_kode = 2
								) AS lpj
							JOIN kr_organisasi korg ON korg.org_key = lpj.kr_organisasi_org_key
							WHERE
								date_part('YEAR', date_added) = '$tahun'
							AND (
								lpj.kr_organisasi_org_key = '$org'
								OR parent_id = '$org'
							)
						) AS lpj_all
					ORDER BY
						lpj_uniq_kode,
						jns_lpj_kode,
						date_added DESC
				) AS lpj_new
			WHERE
				persetujuan = 'Ditolak';")->result();
    }

    function jumlah_lpj_detail_bp_bpp($org, $tahun) {
        return $this->db->query("SELECT
				jns_lpj_kode,
				COUNT (*) AS jumlah,
				(
					CASE WHEN jns_lpj_kode = 1 THEN 'LPJ GU' ELSE 'LPJ TU' END
				)AS uraian
			FROM
				(
					SELECT DISTINCT
						ON (lpj_uniq_kode, jns_lpj_kode) lpj_uniq_kode,
						jns_lpj_kode,
						catatan_verifikasi,
						persetujuan,
						-- 	nip_penginput,
						date_added,
						no_lpj,
						no_lpj_asal,
						kr_organisasi_org_key,
						parent_id
					FROM
						(
							SELECT
								lpj.*, korg.parent_id
							FROM
								(
									SELECT
										pl.*, lg.kr_organisasi_org_key
									FROM
										persetujuan_lpj pl
									JOIN lpj_gu lg ON lg.uniq_kode = pl.lpj_uniq_kode
									AND pl.jns_lpj_kode = 1
									UNION
										SELECT
											pl.*, lt.kr_organisasi_org_key
										FROM
											persetujuan_lpj pl
										JOIN lpj_tu lt ON lt.uniq_kode = pl.lpj_uniq_kode
										AND pl.jns_lpj_kode = 2
								) AS lpj
							JOIN kr_organisasi korg ON korg.org_key = lpj.kr_organisasi_org_key
							WHERE
								date_part('YEAR', date_added) = '$tahun'
							AND (
								lpj.kr_organisasi_org_key = '$org'
								OR parent_id = '$org'
							)
						) AS lpj_all
					ORDER BY
						lpj_uniq_kode,
						jns_lpj_kode,
						date_added DESC
				) AS lpj_new
			WHERE
				persetujuan = 'Ditolak'
			GROUP BY
			jns_lpj_kode;")->result();
    }

    function jumlah_spp_bp_bpp($org, $tahun) {
        return $this->db->query("SELECT
					1 AS id_spp,
				(
					COALESCE (spp_all.jumlah_spp, 0) + COALESCE (
						spp_nihil_all.jumlah_spp_nihil,
						0
					)
				) AS jumlah_spp,
				'SPP' AS uraian_spm
			-- ,
			-- 	0 AS join_data
			FROM
				(
					SELECT
						COUNT (*) AS jumlah_spp,
						0 AS join_data
					FROM
						(
							SELECT DISTINCT
								ON (spp_uniq_kode, jns_spp_kode) spp_uniq_kode,
								jns_spp_kode,
								catatan_verifikasi,
								persetujuan,
								date_added,
								no_spp,
								no_spp_asal,
								kr_organisasi_org_key,
								parent_id
							FROM
								(
									SELECT
										spp.*, korg.parent_id
									FROM
										(
											SELECT
												ps.*, spp.kr_organisasi_org_key
											FROM
												persetujuan_spp ps
											JOIN spp_up spp ON spp.uniq_kode = ps.spp_uniq_kode
											AND 1 = ps.jns_spp_kode
											UNION
												SELECT
													ps.*, spp.kr_organisasi_org_key
												FROM
													persetujuan_spp ps
												JOIN spp_gu spp ON spp.uniq_kode = ps.spp_uniq_kode
												AND 2 = ps.jns_spp_kode
												UNION
													SELECT
														ps.*, spp.kr_organisasi_org_key
													FROM
														persetujuan_spp ps
													JOIN spp_tu spp ON spp.uniq_kode = ps.spp_uniq_kode
													AND 3 = ps.jns_spp_kode
													UNION
														SELECT
															ps.*, spp.kr_organisasi_org_key
														FROM
															persetujuan_spp ps
														JOIN spp_ls_pegawai spp ON spp.uniq_kode = ps.spp_uniq_kode
														AND 4 = ps.jns_spp_kode
														UNION
															SELECT
																ps.*, spp.kr_organisasi_org_key
															FROM
																persetujuan_spp ps
															JOIN spp_ls_brg_js spp ON spp.uniq_kode = ps.spp_uniq_kode
															AND 5 = ps.jns_spp_kode
															UNION
																SELECT
																	ps.*, spp.kr_organisasi_org_key
																FROM
																	persetujuan_spp ps
																JOIN spp_ls_skpkd spp ON spp.uniq_kode = ps.spp_uniq_kode
																AND 6 = ps.jns_spp_kode
																UNION
																	SELECT
																		ps.*, spp.kr_organisasi_org_key
																	FROM
																		persetujuan_spp ps
																	JOIN spp_ls_blud spp ON spp.uniq_kode = ps.spp_uniq_kode
																	AND 7 = ps.jns_spp_kode
										) AS spp
									JOIN kr_organisasi korg ON korg.org_key = spp.kr_organisasi_org_key
									WHERE
										date_part('YEAR', date_added) = '$tahun'
									AND (
										spp.kr_organisasi_org_key = '$org'
										OR parent_id = '$org'
									)
								) AS spp2
							ORDER BY
								spp_uniq_kode,
								jns_spp_kode,
								date_added DESC
						) AS spp3
					WHERE
						persetujuan = 'Ditolak'
				) AS spp_all
			JOIN (
				SELECT
					COUNT (*) AS jumlah_spp_nihil,
					0 AS join_data
				FROM
					(
						SELECT DISTINCT
							ON (spp_uniq_kode, jns_spp_kode) spp_uniq_kode,
							jns_spp_kode,
							catatan_verifikasi,
							persetujuan,
							date_added,
							no_spp,
							no_spp_asal,
							kr_organisasi_org_key,
							parent_id
						FROM
							(
								SELECT
									spp_nihil.*, korg.parent_id
								FROM
									(
										SELECT
											psn.*, sgn.kr_organisasi_org_key
										FROM
											persetujuan_spp_nihil psn
										JOIN spp_gu_nihil sgn ON sgn.uniq_kode = psn.spp_uniq_kode
										AND 1 = psn.jns_spp_kode
										UNION
											SELECT
												psn.*, stn.kr_organisasi_org_key
											FROM
												persetujuan_spp_nihil psn
											JOIN spp_tu_nihil stn ON stn.uniq_kode = psn.spp_uniq_kode
											AND 2 = psn.jns_spp_kode
									) AS spp_nihil
								JOIN kr_organisasi korg ON korg.org_key = spp_nihil.kr_organisasi_org_key
								WHERE
									date_part('YEAR', date_added) = '$tahun'
								AND (
									spp_nihil.kr_organisasi_org_key = '$org'
									OR parent_id = '$org'
								)
							) AS spp_nihil2
						ORDER BY
							spp_uniq_kode,
							jns_spp_kode,
							date_added DESC
					) AS spp_nihil3
				WHERE
					persetujuan = 'Ditolak'
			) AS spp_nihil_all ON spp_nihil_all.join_data = spp_all.join_data;")->result();
    }

    function jumlah_spp_detail_bp_bpp($org, $tahun) {
        return $this->db->query("SELECT
				*
			FROM
				(
					SELECT
						CASE 
							WHEN jns_spp_kode = 7 THEN
								9
							ELSE
								jns_spp_kode
						END AS jns_spp_kode,
						COUNT (spp_uniq_kode) AS jumlah,
						(
							CASE
								WHEN jns_spp_kode = 1 THEN
									'SPP UP'
								ELSE
									CASE
										WHEN jns_spp_kode = 2 THEN
											'SPP GU'
										ELSE
											CASE
												WHEN jns_spp_kode = 3 THEN
													'SPP TU'
												ELSE
													CASE
														WHEN jns_spp_kode = 4 THEN
															'SPP LS Belanja Pegawai'
														ELSE
															CASE
																WHEN jns_spp_kode = 5 THEN
																	'SPP LS Barang dan Jasa'
																ELSE
																	CASE 
																		WHEN jns_spp_kode = 6 THEN 
																			'SPP LS SKPKD' 
																		ELSE 
																			'SPP LS BLUD' 
																	END
															END
													END
											END
									END
							END
						) AS uraian
					FROM
						(
							SELECT DISTINCT
								ON (spp_uniq_kode, jns_spp_kode) spp_uniq_kode,
								jns_spp_kode,
								catatan_verifikasi,
								persetujuan,
								date_added,
								no_spp,
								no_spp_asal,
								kr_organisasi_org_key,
								parent_id
							FROM
								(
									SELECT
										spp.*, korg.parent_id
									FROM
										(
											SELECT
												ps.*, spp.kr_organisasi_org_key
											FROM
												persetujuan_spp ps
											JOIN spp_up spp ON spp.uniq_kode = ps.spp_uniq_kode
											AND 1 = ps.jns_spp_kode
											UNION
												SELECT
													ps.*, spp.kr_organisasi_org_key
												FROM
													persetujuan_spp ps
												JOIN spp_gu spp ON spp.uniq_kode = ps.spp_uniq_kode
												AND 2 = ps.jns_spp_kode
												UNION
													SELECT
														ps.*, spp.kr_organisasi_org_key
													FROM
														persetujuan_spp ps
													JOIN spp_tu spp ON spp.uniq_kode = ps.spp_uniq_kode
													AND 3 = ps.jns_spp_kode
													UNION
														SELECT
															ps.*, spp.kr_organisasi_org_key
														FROM
															persetujuan_spp ps
														JOIN spp_ls_pegawai spp ON spp.uniq_kode = ps.spp_uniq_kode
														AND 4 = ps.jns_spp_kode
														UNION
															SELECT
																ps.*, spp.kr_organisasi_org_key
															FROM
																persetujuan_spp ps
															JOIN spp_ls_brg_js spp ON spp.uniq_kode = ps.spp_uniq_kode
															AND 5 = ps.jns_spp_kode
															UNION
																SELECT
																	ps.*, spp.kr_organisasi_org_key
																FROM
																	persetujuan_spp ps
																JOIN spp_ls_skpkd spp ON spp.uniq_kode = ps.spp_uniq_kode
																AND 6 = ps.jns_spp_kode
																UNION
																	SELECT
																		ps.*, spp.kr_organisasi_org_key
																	FROM
																		persetujuan_spp ps
																	JOIN spp_ls_blud spp ON spp.uniq_kode = ps.spp_uniq_kode
																	AND 7 = ps.jns_spp_kode
										) AS spp
									JOIN kr_organisasi korg ON korg.org_key = spp.kr_organisasi_org_key
									WHERE
										date_part('YEAR', date_added) = '$tahun'
									AND (
										spp.kr_organisasi_org_key = '$org'
										OR parent_id = '$org'
									)
								) AS spp2
							ORDER BY
								spp_uniq_kode,
								jns_spp_kode,
								date_added DESC
						) AS spp3
					WHERE
						persetujuan = 'Ditolak'
					GROUP BY
						jns_spp_kode
				) AS spp_all
			UNION
			SELECT
				*
			FROM
				(
					SELECT
						CASE
					WHEN jns_spp_kode = 1 THEN
						7
					ELSE
						8
					END AS jenis,
					COUNT (spp_uniq_kode) AS jumlah,
					(
						CASE
						WHEN jns_spp_kode = 1 THEN
							'SPP GU NIHIL'
						ELSE
							'SPP TU NIHIL'
						END
					) AS uraian
				FROM
					(
						SELECT DISTINCT
							ON (spp_uniq_kode, jns_spp_kode) spp_uniq_kode,
							jns_spp_kode,
							catatan_verifikasi,
							persetujuan,
							date_added,
							no_spp,
							no_spp_asal,
							kr_organisasi_org_key,
							parent_id
						FROM
							(
								SELECT
									spp_nihil.*, korg.parent_id
								FROM
									(
										SELECT
											psn.*, sgn.kr_organisasi_org_key
										FROM
											persetujuan_spp_nihil psn
										JOIN spp_gu_nihil sgn ON sgn.uniq_kode = psn.spp_uniq_kode
										AND 1 = psn.jns_spp_kode
										UNION
											SELECT
												psn.*, stn.kr_organisasi_org_key
											FROM
												persetujuan_spp_nihil psn
											JOIN spp_tu_nihil stn ON stn.uniq_kode = psn.spp_uniq_kode
											AND 2 = psn.jns_spp_kode
									) AS spp_nihil
								JOIN kr_organisasi korg ON korg.org_key = spp_nihil.kr_organisasi_org_key
								WHERE
									date_part('YEAR', date_added) = '$tahun'
								AND (
									spp_nihil.kr_organisasi_org_key = '$org'
									OR parent_id = '$org'
								)
							) AS spp_nihil2
						ORDER BY
							spp_uniq_kode,
							jns_spp_kode,
							date_added DESC
					) AS spp_nihil3
				WHERE
					persetujuan = 'Ditolak'
				GROUP BY
					jns_spp_kode
				) AS spp_nihil_all;")->result();
    }

    function jumlah_sp2d_bp_bpp($org, $tahun) {
        return $this->db->query("SELECT
				2 AS id_sp2d,
				COUNT (*) AS jumlah_sp2d,
				'SP2D' AS uraian_sp2d
			FROM
				(
					SELECT
						-- 	pencairan.uniq_kode,
						1 AS jenis,
						'SP2D UP' AS uraian,
						pencairan.sp2d_up_uniq_kode AS sp2d_uniq_kode,
						pencairan.no_pencairan_sp2d,
						pencairan.status,
						pencairan.tanggal_pencairan,
						pencairan.date_added,
						sp2d.kr_organisasi_org_key
					FROM
						pencairan_sp2d_up pencairan
					JOIN sp2d_up sp2d ON sp2d.uniq_kode = pencairan.sp2d_up_uniq_kode -- WHERE
					-- 	status = 'Belum dicairkan'
					UNION
						SELECT
							2 AS jenis,
							'SP2D GU' AS uraian,
							-- 	pencairan.uniq_kode,
							pencairan.sp2d_gu_uniq_kode AS sp2d_uniq_kode,
							pencairan.no_pencairan_sp2d,
							pencairan.status,
							pencairan.tanggal_pencairan,
							pencairan.date_added,
							sp2d.kr_organisasi_org_key
						FROM
							pencairan_sp2d_gu pencairan
						JOIN sp2d_gu sp2d ON sp2d.uniq_kode = pencairan.sp2d_gu_uniq_kode -- 	WHERE
						-- 		status = 'Belum dicairkan'
						UNION
							SELECT
								3 AS jenis,
								'SP2D TU' AS uraian,
								-- 	pencairan.uniq_kode,
								pencairan.sp2d_tu_uniq_kode AS sp2d_uniq_kode,
								pencairan.no_pencairan_sp2d,
								pencairan.status,
								pencairan.tanggal_pencairan,
								pencairan.date_added,
								sp2d.kr_organisasi_org_key
							FROM
								pencairan_sp2d_tu pencairan
							JOIN sp2d_tu sp2d ON sp2d.uniq_kode = pencairan.sp2d_tu_uniq_kode -- 		WHERE
							-- 			status = 'Belum dicairkan'
							UNION
								SELECT
									4 AS jenis,
									'SP2D LS Belanja Pegawai' AS uraian,
									-- 	pencairan.uniq_kode,
									pencairan.sp2d_ls_pegawai_uniq_kode AS sp2d_uniq_kode,
									pencairan.no_pencairan_sp2d,
									pencairan.status,
									pencairan.tanggal_pencairan,
									pencairan.date_added,
									sp2d.kr_organisasi_org_key
								FROM
									pencairan_sp2d_ls_pegawai pencairan
								JOIN sp2d_ls_pegawai sp2d ON sp2d.uniq_kode = pencairan.sp2d_ls_pegawai_uniq_kode -- 			WHERE
								-- 				status = 'Belum dicairkan'
								UNION
									SELECT
										5 AS jenis,
										'SP2D LS Barang dan Jasa' AS uraian,
										-- 	pencairan.uniq_kode,
										pencairan.sp2d_ls_brg_js_uniq_kode AS sp2d_uniq_kode,
										pencairan.no_pencairan_sp2d,
										pencairan.status,
										pencairan.tanggal_pencairan,
										pencairan.date_added,
										sp2d.kr_organisasi_org_key
									FROM
										pencairan_sp2d_ls_brg_js pencairan
									JOIN sp2d_ls_brg_js sp2d ON sp2d.uniq_kode = pencairan.sp2d_ls_brg_js_uniq_kode -- 				WHERE
									-- 					status = 'Belum dicairkan'
									UNION
										SELECT
											6 AS jenis,
											'SP2D LS SKPKD' AS uraian,
											-- 	pencairan.uniq_kode,
											pencairan.sp2d_ls_skpkd_uniq_kode AS sp2d_uniq_kode,
											pencairan.no_pencairan_sp2d,
											pencairan.status,
											pencairan.tanggal_pencairan,
											pencairan.date_added,
											sp2d.kr_organisasi_org_key
										FROM
											pencairan_sp2d_ls_skpkd pencairan
										JOIN sp2d_ls_skpkd sp2d ON sp2d.uniq_kode = pencairan.sp2d_ls_skpkd_uniq_kode -- 					WHERE
										-- 						status = 'Belum dicairkan'
										UNION
											SELECT
												7 AS jenis,
												'SP2D GU NIHIL' AS uraian,
												-- 	pencairan.uniq_kode,
												pencairan.sp2d_gu_nihil_uniq_kode AS sp2d_uniq_kode,
												pencairan.no_pencairan_sp2d,
												pencairan.status,
												pencairan.tanggal_pencairan,
												pencairan.date_added,
												sp2d.kr_organisasi_org_key
											FROM
												pencairan_sp2d_gu_nihil pencairan
											JOIN sp2d_gu_nihil sp2d ON sp2d.uniq_kode = pencairan.sp2d_gu_nihil_uniq_kode -- 						WHERE
											-- 							status = 'Belum dicairkan'
											UNION
												SELECT
													8 AS jenis,
													'SP2D TU NIHIL' AS uraian,
													-- 	pencairan.uniq_kode,
													pencairan.sp2d_tu_nihil_uniq_kode AS sp2d_uniq_kode,
													pencairan.no_pencairan_sp2d,
													pencairan.status,
													pencairan.tanggal_pencairan,
													pencairan.date_added,
													sp2d.kr_organisasi_org_key
												FROM
													pencairan_sp2d_tu_nihil pencairan
												JOIN sp2d_tu_nihil sp2d ON sp2d.uniq_kode = pencairan.sp2d_tu_nihil_uniq_kode -- 							WHERE
												-- 								status = 'Belum dicairkan'
												UNION
													SELECT
														9 AS jenis,
														'SP2D LS BLUD' AS uraian,
														-- 	pencairan.uniq_kode,
														pencairan.sp2d_ls_blud_uniq_kode AS sp2d_uniq_kode,
														pencairan.no_pencairan_sp2d,
														pencairan.status,
														pencairan.tanggal_pencairan,
														pencairan.date_added,
														sp2d.kr_organisasi_org_key
													FROM
														pencairan_sp2d_ls_blud pencairan
													JOIN sp2d_ls_blud sp2d ON sp2d.uniq_kode = pencairan.sp2d_ls_blud_uniq_kode -- 							WHERE
													-- 								status = 'Belum dicairkan'
				) AS sp2d
			JOIN kr_organisasi korg ON korg.org_key = sp2d.kr_organisasi_org_key
			WHERE
				status = 'Belum dicairkan'
			AND (
				sp2d.kr_organisasi_org_key = '$org'
				OR korg.parent_id = '$org'
			)
			AND date_part('YEAR', date_added) = '$tahun';")->result();
    }

    function jumlah_sp2d_detail_bp_bpp($org, $tahun) {
        return $this->db->query("SELECT
				sp2d.jenis,
				COUNT (*) AS jumlah,
				sp2d.uraian
			FROM
				(
					SELECT
						-- 	pencairan.uniq_kode,
						1 AS jenis,
						'SP2D UP' AS uraian,
						pencairan.sp2d_up_uniq_kode AS sp2d_uniq_kode,
						pencairan.no_pencairan_sp2d,
						pencairan.status,
						pencairan.tanggal_pencairan,
						pencairan.date_added,
						sp2d.kr_organisasi_org_key
					FROM
						pencairan_sp2d_up pencairan
					JOIN sp2d_up sp2d ON sp2d.uniq_kode = pencairan.sp2d_up_uniq_kode -- WHERE
					-- 	status = 'Belum dicairkan'
					UNION
						SELECT
							2 AS jenis,
							'SP2D GU' AS uraian,
							-- 	pencairan.uniq_kode,
							pencairan.sp2d_gu_uniq_kode AS sp2d_uniq_kode,
							pencairan.no_pencairan_sp2d,
							pencairan.status,
							pencairan.tanggal_pencairan,
							pencairan.date_added,
							sp2d.kr_organisasi_org_key
						FROM
							pencairan_sp2d_gu pencairan
						JOIN sp2d_gu sp2d ON sp2d.uniq_kode = pencairan.sp2d_gu_uniq_kode -- 	WHERE
						-- 		status = 'Belum dicairkan'
						UNION
							SELECT
								3 AS jenis,
								'SP2D TU' AS uraian,
								-- 	pencairan.uniq_kode,
								pencairan.sp2d_tu_uniq_kode AS sp2d_uniq_kode,
								pencairan.no_pencairan_sp2d,
								pencairan.status,
								pencairan.tanggal_pencairan,
								pencairan.date_added,
								sp2d.kr_organisasi_org_key
							FROM
								pencairan_sp2d_tu pencairan
							JOIN sp2d_tu sp2d ON sp2d.uniq_kode = pencairan.sp2d_tu_uniq_kode -- 		WHERE
							-- 			status = 'Belum dicairkan'
							UNION
								SELECT
									4 AS jenis,
									'SP2D LS Belanja Pegawai' AS uraian,
									-- 	pencairan.uniq_kode,
									pencairan.sp2d_ls_pegawai_uniq_kode AS sp2d_uniq_kode,
									pencairan.no_pencairan_sp2d,
									pencairan.status,
									pencairan.tanggal_pencairan,
									pencairan.date_added,
									sp2d.kr_organisasi_org_key
								FROM
									pencairan_sp2d_ls_pegawai pencairan
								JOIN sp2d_ls_pegawai sp2d ON sp2d.uniq_kode = pencairan.sp2d_ls_pegawai_uniq_kode -- 			WHERE
								-- 				status = 'Belum dicairkan'
								UNION
									SELECT
										5 AS jenis,
										'SP2D LS Barang dan Jasa' AS uraian,
										-- 	pencairan.uniq_kode,
										pencairan.sp2d_ls_brg_js_uniq_kode AS sp2d_uniq_kode,
										pencairan.no_pencairan_sp2d,
										pencairan.status,
										pencairan.tanggal_pencairan,
										pencairan.date_added,
										sp2d.kr_organisasi_org_key
									FROM
										pencairan_sp2d_ls_brg_js pencairan
									JOIN sp2d_ls_brg_js sp2d ON sp2d.uniq_kode = pencairan.sp2d_ls_brg_js_uniq_kode -- 				WHERE
									-- 					status = 'Belum dicairkan'
									UNION
										SELECT
											6 AS jenis,
											'SP2D LS SKPKD' AS uraian,
											-- 	pencairan.uniq_kode,
											pencairan.sp2d_ls_skpkd_uniq_kode AS sp2d_uniq_kode,
											pencairan.no_pencairan_sp2d,
											pencairan.status,
											pencairan.tanggal_pencairan,
											pencairan.date_added,
											sp2d.kr_organisasi_org_key
										FROM
											pencairan_sp2d_ls_skpkd pencairan
										JOIN sp2d_ls_skpkd sp2d ON sp2d.uniq_kode = pencairan.sp2d_ls_skpkd_uniq_kode -- 					WHERE
										-- 						status = 'Belum dicairkan'
										UNION
											SELECT
												7 AS jenis,
												'SP2D GU NIHIL' AS uraian,
												-- 	pencairan.uniq_kode,
												pencairan.sp2d_gu_nihil_uniq_kode AS sp2d_uniq_kode,
												pencairan.no_pencairan_sp2d,
												pencairan.status,
												pencairan.tanggal_pencairan,
												pencairan.date_added,
												sp2d.kr_organisasi_org_key
											FROM
												pencairan_sp2d_gu_nihil pencairan
											JOIN sp2d_gu_nihil sp2d ON sp2d.uniq_kode = pencairan.sp2d_gu_nihil_uniq_kode -- 						WHERE
											-- 							status = 'Belum dicairkan'
											UNION
												SELECT
													8 AS jenis,
													'SP2D TU NIHIL' AS uraian,
													-- 	pencairan.uniq_kode,
													pencairan.sp2d_tu_nihil_uniq_kode AS sp2d_uniq_kode,
													pencairan.no_pencairan_sp2d,
													pencairan.status,
													pencairan.tanggal_pencairan,
													pencairan.date_added,
													sp2d.kr_organisasi_org_key
												FROM
													pencairan_sp2d_tu_nihil pencairan
												JOIN sp2d_tu_nihil sp2d ON sp2d.uniq_kode = pencairan.sp2d_tu_nihil_uniq_kode -- 							WHERE
												-- 								status = 'Belum dicairkan'
												UNION
													SELECT
														9 AS jenis,
														'SP2D LS BLUD' AS uraian,
														-- 	pencairan.uniq_kode,
														pencairan.sp2d_ls_blud_uniq_kode AS sp2d_uniq_kode,
														pencairan.no_pencairan_sp2d,
														pencairan.status,
														pencairan.tanggal_pencairan,
														pencairan.date_added,
														sp2d.kr_organisasi_org_key
													FROM
														pencairan_sp2d_ls_blud pencairan
													JOIN sp2d_ls_blud sp2d ON sp2d.uniq_kode = pencairan.sp2d_ls_blud_uniq_kode -- 							WHERE
													-- 								status = 'Belum dicairkan'
				) AS sp2d
			JOIN kr_organisasi korg ON korg.org_key = sp2d.kr_organisasi_org_key
			WHERE
				sp2d.status = 'Belum dicairkan'
			AND (
				sp2d.kr_organisasi_org_key = '$org'
				OR korg.parent_id = '$org'
			)
			AND date_part('YEAR', date_added) = '$tahun'
			GROUP BY
				sp2d.jenis,
				sp2d.uraian
			ORDER BY
				sp2d.jenis;")->result();
    }

    function jumlah_skp_d($org, $tahun) {
        return $this->db->query("SELECT
				COUNT (*) AS jumlah,
				'SKP-D' AS uraian
			FROM
				skp_d
			WHERE
				(
					kr_organisasi_org_key = $org
					OR parent_id = $org
				)
			AND date_part('YEAR', date_added) :: VARCHAR = '$tahun'
			AND status = 'Draf';"
                )->result();
    }

    function jumlah_skr_d($org, $tahun) {
        return $this->db->query("SELECT
				COUNT (*) AS jumlah,
				'SKR-D' AS uraian
			FROM
				skr_d
			WHERE
				(
					kr_organisasi_org_key = $org
					OR parent_id = $org
				)
			AND date_part('YEAR', date_added) :: VARCHAR = '$tahun'
			AND status = 'Draf';"
                )->result();
    }

    function jumlah_bukti($org, $tahun) {
        return $this->db->query("SELECT
				(
					jumlah_pad_lain + jumlah_pajak + jumlah_retribusi
				) AS jumlah,
				'Bukti Penerimaan' AS uraian
			FROM
				(
					SELECT
						COUNT (*) AS jumlah_pad_lain,
						0 AS join_data
					FROM
						bukti_pad_lain
					WHERE
						(
							kr_organisasi_org_key = $org
							OR parent_id = $org
						)
					AND date_part('YEAR', date_added) :: VARCHAR = '$tahun'
					AND status = 'Belum di-STS-kan'
				) AS pad_lain
			JOIN (
				SELECT
					COUNT (*) AS jumlah_pajak,
					0 AS join_data
				FROM
					bukti_penerimaan_pajak
				WHERE
					(
						kr_organisasi_org_key = $org
						OR parent_id = $org
					)
				AND date_part('YEAR', date_added) :: VARCHAR = '$tahun'
				AND status = 'Belum di-STS-kan'
			) AS pajak ON pajak.join_data = pad_lain.join_data
			JOIN (
				SELECT
					COUNT (*) AS jumlah_retribusi,
					0 AS join_data
				FROM
					bukti_penerimaan_retribusi
				WHERE
					(
						kr_organisasi_org_key = $org
						OR parent_id = $org
					)
				AND date_part('YEAR', date_added) :: VARCHAR = '$tahun'
				AND status = 'Belum di-STS-kan'
			) AS retribusi ON retribusi.join_data = pad_lain.join_data;
		")->result();
    }

    function jumlah_sts($org, $tahun) {
        return $this->db->query("SELECT
				COUNT (*) AS jumlah,
				'STS' AS uraian
			FROM
				sts
			WHERE
				(
					kr_organisasi_org_key = $org
					OR parent_id = $org
				)
			AND date_part('YEAR', date_added) :: VARCHAR = '$tahun'
			AND status = 'Draf';"
                )->result();
    }

}
