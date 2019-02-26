<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_Model {

    public $variable;

    public function __construct() {
        parent::__construct();
    }

    function data_penerimaan($tahap, $org, $tahun) {
        return $this->db->query("SELECT * FROM view_pembiayaan_penerimaan
            LEFT JOIN (SELECT
                                 *
                FROM
                function_view_pembiayaan ($org,'$tahap','$tahun')
                AS (
                 kr_organisasi_org_key BIGINT,
                 kr_akun_level3_uniq_kode BIGINT,
                 kode_level3 text,
                 total_ppas NUMERIC,
                 kr_organisasi_org_key_rab BIGINT,
                 kode_level3_rab text,
                 total_rab NUMERIC,
                 keterangan text
                 )
        where kr_organisasi_org_key = '$org'
        ) as view_pembiayaan
        ON view_pembiayaan.kode_level3 = view_pembiayaan_penerimaan.kode_level
        AND view_pembiayaan.kr_akun_level3_uniq_kode = view_pembiayaan_penerimaan.uniq_kode_level
        AND view_pembiayaan_penerimaan.kode_level is NOT NULL
        AND view_pembiayaan_penerimaan.uniq_kode_level is NOT NULL
        ORDER BY urutan(kode_level, 9);")->result();
    }

    function data_pengeluaran($tahap, $org, $tahun) {
        return $this->db->query("SELECT * FROM view_pembiayaan_pengeluaran
            LEFT JOIN (SELECT
                                 *
                FROM
                function_view_pembiayaan ($org,'$tahap','$tahun')
                AS (
                 kr_organisasi_org_key BIGINT,
                 kr_akun_level3_uniq_kode BIGINT,
                 kode_level3 text,
                 total_ppas NUMERIC,
                 kr_organisasi_org_key_rab BIGINT,
                 kode_level3_rab text,
                 total_rab NUMERIC,
                 keterangan text
                 )
        where kr_organisasi_org_key = '$org'
        ) as view_pembiayaan
        ON view_pembiayaan.kode_level3 = view_pembiayaan_pengeluaran.kode_level
        AND view_pembiayaan.kr_akun_level3_uniq_kode = view_pembiayaan_pengeluaran.uniq_kode_level
        AND view_pembiayaan_pengeluaran.kode_level is NOT NULL
        AND view_pembiayaan_pengeluaran.uniq_kode_level is NOT NULL
        ORDER BY urutan(kode_level, 9);")->result();
    }

    function list_programskpd($org, $tahap, $tahun) {
        $this->db->select('kr_program_prog_key');
        $this->db->select('program');
        $this->db->select_sum('pagu');
        $this->db->from('ebudget_listkegiatanskpd');
        $this->db->where('kdtahap', $tahap);
        $this->db->where('tahun_anggaran', $tahun);
        $this->db->where('kr_organisasi_org_key', $org);
        $this->db->group_by(array("kr_program_prog_key", "program"));
        $this->db->order_by("kr_program_prog_key");
        $query = $this->db->get();
        return $query->result();
    }

    function list_programskpd_kegiatan($org, $prog, $tahap, $tahun) {
        $this->db->select('kgo_key');
        $this->db->select('kodekegiatan');
        $this->db->select('namakegiatan');
        $this->db->select('pagu');
        $this->db->from('ebudget_listkegiatanskpd');
        $this->db->where('kr_program_prog_key', $prog);
        $this->db->where('kr_organisasi_org_key', $org);
        $this->db->where('kdtahap', $tahap);
        $this->db->where('tahun_anggaran', $tahun);
        $this->db->order_by("kodekegiatan");
        $query = $this->db->get();
        return $query->result();
    }

    function genrab1($unitkey, $tahap, $tahun) {
        $query = $this->db->query("SELECT * FROM showrab1structure({$unitkey},'{$tahap}','{$tahun}') AS (
         kode VARCHAR,
         uraian TEXT,
         ekspresi TEXT,
         volume bigint,
         satuan VARCHAR (50),
         hargasatuan NUMERIC (30, 2),
         subtotal NUMERIC (30, 2),
         uniq_kode BIGINT,
         tipe VARCHAR
         ) ORDER BY kode");
        return $query->result();
    }

    function genrab21($unitkey, $tahap, $tahun) {
        $query = $this->db->query("SELECT * FROM showrab21structure({$unitkey},'{$tahap}','{$tahun}') AS (
         kode VARCHAR,
         uraian TEXT,
         ekspresi TEXT,
         volume BIGINT,
         satuan VARCHAR (50),
         hargasatuan NUMERIC (30, 2),
         subtotal NUMERIC (30, 2),
         uniq_kode BIGINT,
         tipe VARCHAR
         ) ORDER BY kode");
        return $query->result();
    }

    function infoSKPD($unitkey) {
        $this->db->select('kr_organisasi.kr_urusan_daerah_kode AS kodeurusan,kr_organisasi.kode as kodeunit,kr_organisasi.uraian as namaunit, kr_urusan_daerah.uraian as urusan');
        $this->db->where('org_key', $unitkey);
        $this->db->join('kr_urusan_daerah', 'kr_organisasi.kr_urusan_daerah_kode = kr_urusan_daerah.kode');
        $query = $this->db->get('kr_organisasi');
        return $query->result();
    }

    function proses_kegiatan($kgokey) {
        $query = $this->db->query("SELECT pagu,SUM (rka22.nilai) as nilai FROM org_keg INNER JOIN rka22 ON rka22.org_keg_kgo_key = org_keg.kgo_key WHERE	kgo_key = {$kgokey} GROUP BY kgo_key,	org_keg.pagu;");
        return $query->result();
    }

    function top10($unitkey, $tahap, $tahun) {
        $query = $this->db->query("SELECT concat(kr_kegiatan.kr_urusan_daerah_kode,'.',kr_kegiatan.kode) as kode, kr_kegiatan.uraian, pagu FROM org_keg INNER JOIN kr_kegiatan ON kr_kegiatan.keg_key = org_keg.kr_kegiatan_keg_key WHERE kr_organisasi_org_key={$unitkey} AND kdtahap='{$tahap}' AND tahun_anggaran = '{$tahun}' ORDER BY pagu DESC LIMIT 10");
        return $query->result();
    }

    function insert($table, $data) {
        return $this->db->insert($table, $data);
    }

    function insert_btc($table, $data) {
        return $this->db->insert_batch($table, $data);
    }

    function view_kepala_dinas($data) {
//            $this->db->where($data);
        $query = $this->db->get_where('view_kepala_dinas', array('kr_organisasi_org_key' => $data));
        return $query->result();
    }

    function view_kepala_dpa(){
        $query = $this->db->query("SELECT
            uniq_kode, kr_organisasi_org_key, daftar_pegawai_uniq_kode, nip, nama,
            alamat, golongan, pendidikan, jabatan, organisasi as organisasi_kepala_dinas,
            email, date_added, date_update, kode, uraian, kr_urusan_daerah_kode, parent,
            'Pejabat Pengelola Keuangan Daerah'::VARCHAR as organisasi
        FROM
            view_kepala_dinas
        WHERE
            kr_organisasi_org_key = 94");
        return $query->result();
    }
    
    function get($tablename) {
        return $this->db->get($tablename)->result();
    }

    function jumlah_kegiatan($unitkey, $kdt){
        $query = $this->db->query("SELECT count(kr_kegiatan_keg_key) as jumlah FROM org_keg where kr_organisasi_org_key = '$unitkey' and kdtahap ='$kdt'");
        return $query->result();
    }

}

/* End of file  */
/* Location: ./application/models/ */