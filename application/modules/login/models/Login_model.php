<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get($tablename) {
        $query = $this->db->get($tablename, 10);
        return $query->result();
    }

    function insert($tablename, $data) {
        $query = $this->db->insert($tablename, $data);

        return $query;
    }

    function update_entry() {
        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

    function cekLogin($tableName, $username, $password, $keyEnc) {
        $this->db->where('name', $username);
        $this->db->where('password', "crypt('$password','$keyEnc')", FALSE);
        $query = $this->db->get($tableName);

        return $query->result();
    }

    function cekLogin_fc($app_role, $username, $password, $keyEnc) {
        $sql = "
        SELECT * FROM
        (SELECT * FROM function_user_organisasi('$app_role') AS (
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
        ) WHERE uniq_kode_role IN (2,6,22,23,24,25,26,27,28,29,30,34,38,41,43,44)
        ) as aaa

        WHERE name = '$username'
        AND password = crypt('$password','$keyEnc')";
        $query = $this->db->query($sql);

        return $query->result();
    }

    function getPegSes($tablename, $data) {
        $this->db->where($data);
        $query = $this->db->get($tablename);

        return $query->result();
    }

    function get_modul_auth($uniq_kode, $org_key) {
        $sql = "
        SELECT * FROM (
        SELECT
            split_part(kolom, '#', 1) uk_org,
            split_part(kolom, '#', 2) kode_modul
        FROM
            (
                SELECT
                    UNNEST (
                        string_to_array(role_khusus, '~')
                    ) AS kolom
                FROM
                    daftar_pegawai
                WHERE
                    uniq_kode = $uniq_kode
            ) AS view_auth
        ) AS tabel
        LEFT JOIN kr_organisasi ON kr_organisasi.org_key::text = tabel.uk_org
        WHERE uk_org :: INT = $org_key
        ";
        $query = $this->db->query($sql);

        return $query->result();
    }

    function view_auth($uniq_kode) {
        $sql = "
        SELECT * FROM (
        SELECT
            split_part(kolom, '#', 1) uk_org,
            split_part(kolom, '#', 2) kode_modul
        FROM
            (
                SELECT
                    UNNEST (
                        string_to_array(role_khusus, '~')
                    ) AS kolom
                FROM
                    daftar_pegawai
                WHERE
                    uniq_kode = $uniq_kode
            ) AS view_auth
        ) AS tabel
        LEFT JOIN kr_organisasi ON kr_organisasi.org_key::text = tabel.uk_org
        ORDER BY kr_organisasi.uraian
        ";
        $query = $this->db->query($sql);

        return $query->result();
    }

    function getPegSes_fc_pertama($app_role, $username) {
        $sql = "
        SELECT * FROM
        (SELECT * FROM function_user_organisasi('$app_role') AS (
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
        ) WHERE uniq_kode_role IN (2,6,22,23,24,25,26,27,28,29,30,34,38,41,43,44)
        ) as aaa

        WHERE name = '$username'
        ORDER BY uniq_kode_pegawai";
        $query = $this->db->query($sql);

        return $query->result();
    }

    function getPegSes_fc_kedua($app_role, $username) {
        $sql = "SELECT
                login_all.uniq_kode,
                login_all. NAME,
                login_all. PASSWORD,
                login_all.nama,
                CASE
            WHEN org.parent_id IS NULL THEN
                login_all.parent_id
            ELSE
                --NULL
                org.parent_id
            END AS parent_id,
             --     login_all.parent_id,
            CASE
            WHEN org.org_key IS NULL THEN
                login_all.kr_organisasi_org_key
            ELSE
                org.parent_id
            END AS kr_organisasi_org_key,
             --     login_all.kr_organisasi_org_key,
            login_all.unit_kerja_simpeg,
             login_all.parent,
             login_all.uniq_kode_role,
             login_all.alias_role_name,
             login_all.status_id,
             login_all.set_status,
             login_all.uniq_kode_pegawai -- ,
            --  org.*
            FROM
                (
                    SELECT
                        *
                    FROM
                        function_user_organisasi ($app_role) AS (
                            uniq_kode BIGINT,
                            NAME VARCHAR,
                            PASSWORD VARCHAR,
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
                    WHERE
                        --          NAME = '196703041992011001'
                        NAME = '$username'
                ) AS login_all
            LEFT JOIN (
                SELECT
                    *
                FROM
                    kr_organisasi
                WHERE
                    uraian ILIKE 'SEKRETARIAT%'
                AND parent_id IS NOT NULL
                ORDER BY
                    org_key
            ) AS org ON org.org_key = login_all.kr_organisasi_org_key";
        $query = $this->db->query($sql);

        return $query->result();
    }

    function getPegSes_fc($app_role, $username) {
        $sql = "SELECT
                    uniq_kode,
                    NAME,
                    PASSWORD,
                    nama,
                     kr_organisasi_org_key,
                 unit_kerja_simpeg,
                 parent,
                 uniq_kode_role,
                 alias_role_name,
                 status_id,
                 set_status,
                 uniq_kode_pegawai
                FROM
                    function_user_organisasi ('$app_role') AS (
                        uniq_kode BIGINT,
                        NAME VARCHAR,
                        PASSWORD VARCHAR,
                        nama VARCHAR,
                        kr_organisasi_org_key BIGINT,
                        unit_kerja_simpeg VARCHAR,
                        parent VARCHAR,
                        uniq_kode_role BIGINT,
                        alias_role_name VARCHAR,
                        status_id BIGINT,
                        set_status BIGINT,
                        uniq_kode_pegawai BIGINT
                    )
                WHERE
                    NAME = '$username'";
        $query = $this->db->query($sql);

        return $query->result();
    }

    function cekDahLogin($nip, $app_conf, $role) {
        $sql = "select * from user_sessions";

        $query = $this->db->query($sql)->result();
        foreach ($query as $key => $value) {
            $original_array = unserialize($value->user_data);
            if ($original_array['pegawai_nip'] == $nip AND $original_array['app_config_uniq_kode'] == $app_conf AND $original_array['userrole'] == $role) {
                return 'ada_user';
            } else {
                return 'tidak_ada_user';
            }
        }
        // return $query->result();
    }

    function view($tablename, $data) {
        $this->db->where($data);
        $query = $this->db->get($tablename);

        return $query->result();
    }

    function update($tablename, $data, $yg_diedit) {
        $this->db->where($yg_diedit);
        $query = $this->db->update($tablename, $data);
        return $query;
    }

    function cek_password_lama($password_lama_encrypt, $username) {
        $this->db->where('name', $username);
        $this->db->where('password', $password_lama_encrypt);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_nip_pegawai($id) {
        $this->db->select("usr.name");
        $this->db->select("usr.user_failed_logins");
        $this->db->select("usr.user_active");
        $this->db->select("usr.user_has_avatar");
        $this->db->select("usr.user_rememberme_token");
        $this->db->select("usr.user_last_failed_login");
        $this->db->select("usr.user_active");
        $this->db->select("dp.email");
        $this->db->from("user as usr");
        $this->db->join("daftar_pegawai as dp", "dp.nip = usr.name", 'left');
        $this->db->limit('1');
        $this->db->where('usr.name', $id);
        return $this->db->get()->row();
    }

    function update_failed_login($id) {
        $time = time();
        $sql = "UPDATE public.user
                    SET user_failed_logins = user_failed_logins+1, user_last_failed_login = '$time'
                    WHERE name = '$id'";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function reset_failed_login($id) {
        $sql = "UPDATE public.user
                    SET user_failed_logins = 0, user_last_failed_login = NULL
                    WHERE name = '$id' AND user_failed_logins != 0";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function gen_remember_token($token, $id) {
        $sql = "UPDATE public.user SET user_rememberme_token = '$token' WHERE name = '$id'";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

}
