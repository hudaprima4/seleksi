<?php

if (!function_exists('get_last_data')) {

    function get_last_data($table_name, $uniq_kode, $kode_asal, $org, $kolom) {
        $CI = & get_instance();
        $CI->load->database();

        $sql = "SELECT
	*
FROM
	(
		SELECT
			*, COUNT (uniq_kode) OVER (

				ORDER BY
					kr_organisasi_org_key,
					tgl_data,
					date_added,
					uniq_kode
			) AS urutan
		FROM
			$table_name
		WHERE
			kr_organisasi_org_key = $org
	) AS dasar
WHERE
	urutan < (
		SELECT
			nilai_tambahan
		FROM
			(
				SELECT
					COUNT (uniq_kode) OVER (

						ORDER BY
							kr_organisasi_org_key,
							tgl_data,
							date_added,
							uniq_kode
					) AS nilai_tambahan ,*
				FROM
					$table_name
				WHERE
					kr_organisasi_org_key = $org
				ORDER BY
					kr_organisasi_org_key,
					tgl_data,
					date_added,
					uniq_kode
			) AS foo
		JOIN (
			SELECT
				*
			FROM
				$table_name
			WHERE
				uniq_kode_refrensi = $uniq_kode
                                AND $kolom = $kode_asal
                                AND kr_organisasi_org_key = $org
		) AS fol ON foo.uniq_kode = fol.uniq_kode
                LIMIT 1
	) ORDER BY urutan DESC LIMIT 1;";
        return $CI->db->query($sql)->result();
    }

}


if (!function_exists('get_urutan_by_tgl')) {

    function get_urutan_by_tgl($table_name, $org, $uniq_kode, $kode_asal, $kolom) {
        $CI = & get_instance();
        $CI->load->database();

        $sql = "SELECT
	*
FROM
	(
		SELECT
			*, COUNT (uniq_kode) OVER (

				ORDER BY
					kr_organisasi_org_key,
					tgl_data,
					date_added,
					uniq_kode
			) AS urutan
		FROM
			$table_name
		WHERE
			kr_organisasi_org_key = $org
	) AS dasar
WHERE
	urutan >= (
		SELECT
			nilai_tambahan
		FROM
			(
				SELECT
					COUNT (uniq_kode) OVER (

						ORDER BY
							kr_organisasi_org_key,
							tgl_data,
							date_added,
							uniq_kode
					) AS nilai_tambahan ,*
				FROM
					$table_name
				WHERE
					kr_organisasi_org_key = $org
				ORDER BY
					kr_organisasi_org_key,
					tgl_data,
					date_added,
					uniq_kode
			) AS foo
		JOIN (
			SELECT
				*
			FROM
				$table_name
			WHERE
				uniq_kode_refrensi = $uniq_kode
                                AND $kolom = $kode_asal
                                    AND kr_organisasi_org_key = $org
		) AS fol ON foo.uniq_kode = fol.uniq_kode
                LIMIT 1
	) ORDER BY urutan;";
        return $CI->db->query($sql)->result();
    }

}


if (!function_exists('get_urutan_by_tgl_parent')) {

    function get_urutan_by_tgl_parent($table_name, $org, $uniq_kode, $kode_asal, $kolom) {
        $CI = & get_instance();
        $CI->load->database();

        $sql = "SELECT
	*
FROM
	(
		SELECT
			*, COUNT (uniq_kode) OVER (

				ORDER BY
					parent_id,
					tgl_data,
					date_added,
					uniq_kode
			) AS urutan
		FROM
			$table_name
		WHERE
			parent_id = $org
	) AS dasar
WHERE
	urutan >= (
		SELECT
			nilai_tambahan
		FROM
			(
				SELECT
					COUNT (uniq_kode) OVER (

						ORDER BY
							parent_id,
							tgl_data,
							date_added,
							uniq_kode
					) AS nilai_tambahan ,*
				FROM
					$table_name
				WHERE
					parent_id = $org
				ORDER BY
					parent_id,
					tgl_data,
					date_added,
					uniq_kode
			) AS foo
		JOIN (
			SELECT
				*
			FROM
				$table_name
			WHERE
				uniq_kode_refrensi = $uniq_kode
                                AND $kolom = $kode_asal
                                    AND parent_id = $org
		) AS fol ON foo.uniq_kode = fol.uniq_kode
                LIMIT 1
	) ORDER BY urutan;";
        return $CI->db->query($sql)->result();
    }

}


if (!function_exists('get_urutan_by_tgl_same')) {

    function get_urutan_by_tgl_same($table_name, $org, $tahun) {
        $CI = & get_instance();
        $CI->load->database();

        $sql = "SELECT
                *
        FROM
                $table_name
        WHERE
                kr_organisasi_org_key = $org AND
        date_part('year', tgl_data) = $tahun
         
        ORDER BY
                kr_organisasi_org_key,
                tgl_data,
                date_added,
                uniq_kode ";
        return $CI->db->query($sql)->result();
    }

}


if (!function_exists('update')) {

    function update($tablename, $where, $kolom) {
        $CI = & get_instance();
        $CI->load->database();

        $CI->db->where($where);
        return $CI->db->update($tablename, $kolom);
    }

}


if (!function_exists('get_parent')) {

    function get_parent($org,$single=false) {
        $CI = & get_instance();
        $CI->load->database();

        $sql = "SELECT
                CASE
        WHEN parent_id IS NULL THEN
                org_key
        ELSE
                parent_id
        END AS parent
        FROM
                kr_organisasi
        WHERE
                org_key = $org";
        if($single){
          $out= $CI->db->query($sql)->row();
          return $out->parent;
        }else{
          return $CI->db->query($sql)->result();
        }
    }

}

if (!function_exists('get_urutan_by_tgl_same_parent')) {

    function get_urutan_by_tgl_same_parent($table_name, $org) {
        $CI = & get_instance();
        $CI->load->database();

        $sql = "SELECT
                *
        FROM
                $table_name
        WHERE
                parent_id = $org
        ORDER BY
                parent_id,
                tgl_data,
                date_added,
                uniq_kode ";
        return $CI->db->query($sql)->result();
    }

}

if (!function_exists('views')) {

    function views($table_name, $uniq_kode, $kode_asal, $org, $kolom) {
        $CI = & get_instance();
        $CI->load->database();
        $sql = "SELECT
				*
			FROM
				$table_name
			WHERE
				kr_organisasi_org_key = $org AND $kolom=$kode_asal AND uniq_kode_refrensi = $uniq_kode";

        return $CI->db->query($sql)->result();
    }

}

if (!function_exists('ctk_bku_pengeluaran1')) {

    function ctk_bku_pengeluaran1($table_name, $uniq_kode_ref, $kode_asal, $org, $kolom) {
        $get_parent = get_parent($org);
        $get_last_data = get_last_data($table_name, $uniq_kode_ref, $kode_asal, $org, $kolom);
//        print_r_pre($get_last_data);echo '////////////';die();
//        $data_update = get_urutan_by_tgl($table_name, $org, $uniq_kode_ref, $kode_asal,$kolom);
//        $data_skpd = get_urutan_by_tgl_parent($table_name, $get_parent[0]->parent, $uniq_kode_ref, $kode_asal,$kolom);

        $data_update = get_urutan_by_tgl_same($table_name, $org,TAHUN);
//        $data_skpd = get_urutan_by_tgl_same_parent($table_name,$get_parent[0]->parent);
        if (count($get_last_data) > 0) {
            $saldo_unit = 0; //$get_last_data[0]->saldo_unit;
            $saldo_skpd = $get_last_data[0]->saldo_skpd;
        } else {
            $saldo_unit = 0;
            $saldo_skpd = 0;
        }


//        echo $saldo_unit;
//        print_r_pre($data_update);
        if ($table_name != 'ctk_buku_pajak_pengeluaran') {
            if (count($data_update) > 0) {
                foreach ($data_update AS $row) {
//                    echo 'a '.$row->uniq_kode.'<br>';
                    $saldo_unit = ($saldo_unit + ((($row->penerimaan == null) ? 0 : $row->penerimaan) - (($row->pengeluaran == null) ? 0 : $row->pengeluaran)));
                    update($table_name, array('uniq_kode' => $row->uniq_kode), array('saldo_unit' => $saldo_unit));
                }
            }
        } else {
            if (count($data_update) > 0) {
                foreach ($data_update AS $row) {

                    $saldo_unit = ($saldo_unit + ((($row->pemotongan == null) ? 0 : $row->pemotongan) - (($row->penyetoran == null) ? 0 : $row->penyetoran)));
                    update($table_name, array('uniq_kode' => $row->uniq_kode), array('saldo_unit' => $saldo_unit));
                }
            }
        }
    }

}

//ini lho
if (!function_exists('ctk_bku_pengeluaran')) {

    function ctk_bku_pengeluaran($table_name, $uniq_kode_ref, $kode_asal, $org, $kolom, $tgl = null) {
       //  $get_parent = get_parent($org);
       //  $get_detail = views($table_name, $uniq_kode_ref, $kode_asal, $org, $kolom);
       // // echo '...1..';
       // // print_r_pre($get_detail);
       //  if (count($get_detail) > 0) {
       //      $get_last_saldo = get_last_saldo($get_detail[0]->tgl_data, $org, $table_name);
       //      if (count($get_last_saldo) > 0) {
       //          $data_update = get_data($get_last_saldo[0]->tgl_data, $org, $table_name);
       //          $saldo_unit = $get_last_saldo[0]->saldo_unit;
       //      }else{
       //          $data_update = get_urutan_by_tgl_same($table_name, $org,TAHUN);
       //          $saldo_unit = 0;
       //      }
            
       //  } else {
       //      // echo "a...";
       //      // print_r($get_last_saldo);
       //      if ($tgl != null) {
       //          $get_last_saldo = get_last_saldo($tgl, $org, $table_name);
       //         // echo '...11..';
       //         // print_r_pre($get_detail);
       //          $data_update = get_data($get_last_saldo[0]->tgl_data, $org, $table_name);
       //          $saldo_unit = $get_last_saldo[0]->saldo_unit;
       //      } else {
       //          $data_update = get_urutan_by_tgl_same($table_name, $org,TAHUN);
       //          $saldo_unit = 0;
       //      }
       //  }
       //  if ($table_name != 'ctk_buku_pajak_pengeluaran') {
       //      if (count($data_update) > 0) {
       //          foreach ($data_update AS $row) {
       //              $saldo_unit = ($saldo_unit + ((($row->penerimaan == null) ? 0 : $row->penerimaan) - (($row->pengeluaran == null) ? 0 : $row->pengeluaran)));
       //              update($table_name, array('uniq_kode' => $row->uniq_kode), array('saldo_unit' => $saldo_unit));
       //          }
       //      }
       //  } else {
       //      if (count($data_update) > 0) {
       //          foreach ($data_update AS $row) {
       //              $saldo_unit = ($saldo_unit + ((($row->pemotongan == null) ? 0 : $row->pemotongan) - (($row->penyetoran == null) ? 0 : $row->penyetoran)));
       //              update($table_name, array('uniq_kode' => $row->uniq_kode), array('saldo_unit' => $saldo_unit));
       //          }
       //      }
       //  }
    }

}

if (!function_exists('get_last_saldo')) {

    function get_last_saldo($tgl_data, $org, $table_name) {
        $CI = & get_instance();
        $CI->load->database();

        $sql = "SELECT
            *
        FROM
	(
		SELECT
			*, COUNT (uniq_kode) OVER (

				ORDER BY
					kr_organisasi_org_key,
					tgl_data,
					date_added,
					uniq_kode
			) AS urutan
		FROM
			$table_name
		WHERE
			kr_organisasi_org_key = $org
                ) AS dasar
        WHERE
                tgl_data < '$tgl_data'
        ORDER BY
                urutan DESC
        LIMIT 1;";
        return $CI->db->query($sql)->result();
    }

}

if (!function_exists('get_data')) {

    function get_data($tgl_data, $org, $table_name) {
        $CI = & get_instance();
        $CI->load->database();

        $sql = "SELECT
            *
        FROM
	(
		SELECT
			*, COUNT (uniq_kode) OVER (

				ORDER BY
					kr_organisasi_org_key,
					tgl_data,
					date_added,
					uniq_kode
			) AS urutan
		FROM
			$table_name
		WHERE
			kr_organisasi_org_key = $org
                ) AS dasar
        WHERE
                tgl_data > '$tgl_data'
        ORDER BY
	urutan;";
        return $CI->db->query($sql)->result();
    }

}




if (!function_exists('get_datanya')) {

    function get_datanya($table_name, $org, $tahun) {
        $CI = & get_instance();
        $CI->load->database();

        $sql = "SELECT
                *
        FROM
                $table_name
        WHERE
                kr_organisasi_org_key = $org
        AND date_part('year', tgl_data) = '$tahun'
        ORDER BY
                kr_organisasi_org_key,
                tgl_data,
                date_added,
                uniq_kode ";
        return $CI->db->query($sql)->result();
    }

}

if (!function_exists('calculate')) {

    function calculate($table_name, $org, $tahun) {

        $data_update = get_datanya($table_name, $org, $tahun);

        $saldo_unit = 0;



//        echo $saldo_unit;
//        print_r_pre($data_update);
        if ($table_name != 'ctk_buku_pajak_pengeluaran') {
            if (count($data_update) > 0) {
                foreach ($data_update AS $row) {
//                    echo 'a '.$row->uniq_kode.'<br>';
                    $saldo_unit = ($saldo_unit + ((($row->penerimaan == null) ? 0 : $row->penerimaan) - (($row->pengeluaran == null) ? 0 : $row->pengeluaran)));
                    update($table_name, array('uniq_kode' => $row->uniq_kode), array('saldo_unit' => $saldo_unit));
                }
            }
        } else {
            if (count($data_update) > 0) {
                foreach ($data_update AS $row) {

                    $saldo_unit = ($saldo_unit + ((($row->pemotongan == null) ? 0 : $row->pemotongan) - (($row->penyetoran == null) ? 0 : $row->penyetoran)));
                    update($table_name, array('uniq_kode' => $row->uniq_kode), array('saldo_unit' => $saldo_unit));
                }
            }
        }
    }

}


if (!function_exists('order_uniq_kode')) {

    function order_uniq_kode($table_name, $org) {
        $CI = & get_instance();
        $CI->load->database();

        $sql = "SELECT
                *
        FROM
                $table_name
        WHERE
                kr_organisasi_org_key = $org
        ORDER BY
                uniq_kode ASC";
        return $CI->db->query($sql)->result();
    }

}

if (!function_exists('order_uniq_kode_all')) {

    function order_uniq_kode_all($table_name) {
        $CI = & get_instance();
        $CI->load->database();

        $sql = "SELECT
                *
        FROM
                $table_name
        ORDER BY
                uniq_kode";
        return $CI->db->query($sql)->result();
    }

}

if (!function_exists('orderby_uniq_kode')) {

    function orderby_uniq_kode($table_name, $org) {
//        echo $table_name . '/' . $uniq_kode_ref . '/' . $kode_asal . '/' . $org . '/' . $kolom;
//        $get_last_data = get_last_data($table_name, $uniq_kode_ref, $kode_asal, $org, $kolom);
//        print_r_pre($get_last_data);echo '////////////';
//        $data_update = get_urutan_by_tgl($table_name, $org, $uniq_kode_ref, $kode_asal,$kolom);
        $data_update = order_uniq_kode($table_name, $org);
//        if (count($get_last_data) > 0) {
//            $saldo_unit = 0;//$get_last_data[0]->saldo_unit;
//        } else {
//            $saldo_unit = 0;
//        }
        $saldo_unit = 0;
//        echo $saldo_unit;
//        print_r_pre($data_update);
        if ($table_name != 'ctk_buku_pajak_pengeluaran') {
            if (count($data_update) > 0) {
                foreach ($data_update AS $row) {
//                    echo 'a '.$row->uniq_kode.'<br>';
                    $saldo_unit = ($saldo_unit + ((($row->penerimaan == null) ? 0 : $row->penerimaan) - (($row->pengeluaran == null) ? 0 : $row->pengeluaran)));
                    update($table_name, array('uniq_kode' => $row->uniq_kode), array('saldo_unit' => $saldo_unit));
                }
            }
        } else {
            if (count($data_update) > 0) {
                foreach ($data_update AS $row) {

                    $saldo_unit = ($saldo_unit + ((($row->pemotongan == null) ? 0 : $row->pemotongan) - (($row->penyetoran == null) ? 0 : $row->penyetoran)));
                    update($table_name, array('uniq_kode' => $row->uniq_kode), array('saldo_unit' => $saldo_unit));
                }
            }
        }
    }

}

if (!function_exists('orderby_uniq_kode_all')) {

    function orderby_uniq_kode_all($table_name) {
//        echo $table_name . '/' . $uniq_kode_ref . '/' . $kode_asal . '/' . $org . '/' . $kolom;
//        $get_last_data = get_last_data($table_name, $uniq_kode_ref, $kode_asal, $org, $kolom);
//        print_r_pre($get_last_data);echo '////////////';
//        $data_update = get_urutan_by_tgl($table_name, $org, $uniq_kode_ref, $kode_asal,$kolom);
        $data_update = order_uniq_kode_all($table_name);
//        if (count($get_last_data) > 0) {
//            $saldo_unit = 0;//$get_last_data[0]->saldo_unit;
//        } else {
//            $saldo_unit = 0;
//        }
        $saldo_unit = 0;
//        echo $saldo_unit;
//        print_r_pre($data_update);
        if ($table_name != 'ctk_buku_pajak_pengeluaran') {
            if (count($data_update) > 0) {
                foreach ($data_update AS $row) {
//                    echo 'a '.$row->uniq_kode.'<br>';
                    $saldo_unit = ($saldo_unit + ((($row->penerimaan == null) ? 0 : $row->penerimaan) - (($row->pengeluaran == null) ? 0 : $row->pengeluaran)));
                    update($table_name, array('uniq_kode' => $row->uniq_kode), array('saldo_unit' => $saldo_unit));
                }
            }
        } else {
            if (count($data_update) > 0) {
                foreach ($data_update AS $row) {

                    $saldo_unit = ($saldo_unit + ((($row->pemotongan == null) ? 0 : $row->pemotongan) - (($row->penyetoran == null) ? 0 : $row->penyetoran)));
                    update($table_name, array('uniq_kode' => $row->uniq_kode), array('saldo_unit' => $saldo_unit));
                }
            }
        }
    }

}
