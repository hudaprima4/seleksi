<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'modules/auth/controllers/Base_global.php');

class Penerimaan extends base_global {

    function __construct() {
        parent::__construct();
        $this->load->model(array("Penerimaan_m"));
    }

     public function index() {
        date_default_timezone_set('Asia/Jakarta');

        $awal_parkir = '2019-01-16 18:00:00';
        $akhir_parkir = date('Y-m-d H:i:s');

        $lama_parkir  = round((strtotime($akhir_parkir) - strtotime($awal_parkir))/3600, 0);
        if($lama_parkir <= 2){
            $bayar = 2000;
        }else{
            $bayar = 2000 + ($lama_parkir-2)*500;
        }
        echo 'Total Pembayaran ='.$bayar;

        die();
        $this->data['foldernya'] = $this->uri->segment(1);
        $this->data['classnya'] = $this->uri->segment(2);
        $this->data['urlnya'] = base_url();

        $this->data['kel'] = $this->Penerimaan_m->get_daftar();
        $this->content = 'daftar';
        $this->view();
    }

    public function tambah() {
        $this->data['foldernya'] = $this->uri->segment(1);
        $this->data['classnya'] = $this->uri->segment(2);
        $this->data['urlnya'] = base_url();

        $this->data['barang'] = $this->Penerimaan_m->get('kategori');
        $this->data['toko'] = $this->Penerimaan_m->get('toko');
        $this->data['merk'] = $this->Penerimaan_m->get('merk');
        $this->data['opd'] = $this->Penerimaan_m->get('opd');
        $this->content = 'form_tambah';
        $this->view();
    }

     public function keluar() {
        $this->data['foldernya'] = $this->uri->segment(1);
        $this->data['classnya'] = $this->uri->segment(2);
        $this->data['urlnya'] = base_url();

        $this->data['barang'] = $this->Penerimaan_m->get('kategori');
        $this->data['toko'] = $this->Penerimaan_m->get('toko');
        $this->data['merk'] = $this->Penerimaan_m->get('merk');
        $this->data['opd'] = $this->Penerimaan_m->get('opd');
        $this->content = 'form_keluar';
        $this->view();
    }

    function get_barang() {
        $post = $this->input->post();
        $kategori = ($post) ? dekripsi($this->input->post('kategori')) : false;
        $kat = $this->Penerimaan_m->view_1('barang', array('kategori_id'=>$kategori));
        $data = "<option value='0'>Pilih Barang</option>";
        foreach ($kat as $u) {
            $data .= "<option value='" . enkripsi($u->id) . "'>$u->nama</option>\n";
        }
        echo $data;
    }

    public function proses_tambah() {
        $out = true;
        $this->data['foldernya'] = $this->uri->segment(1);
        $this->data['classnya'] = $this->uri->segment(2);
        $this->data['urlnya'] = base_url() . $this->data['foldernya'] . '/' . $this->data['classnya'];
        $post = $this->input->post();
        $back = "false";
        $msg = "gagal disimpan.!";

        $dta = $this->Penerimaan_m->get_max();
        $month = date('m', strtotime($post['tanggal_bukti']));


        $data_ins = array('id_opd' => dekripsi($post['opd']),
            'id_barang' => dekripsi($post['barang']),
            'id_toko' => dekripsi($post['toko']),
            'id_merk' => dekripsi($post['merk']),
            'tanggal' =>  $formated_date = date('Y-m-d', strtotime($post['tanggal_bukti'])),
            'jumlah' => $post['jumlah'],
            'satuan' => $post['satuan'],
            'harga' => $post['nilai'],
            'keterangan' => $post['keterangan']
        );
        $id = $this->uri->segment(4);
        $this->db->trans_begin();

        $this->Penerimaan_m->save('penerimaan', $data_ins);
        $last_id = $this->db->insert_id();

        $get_no = $this->Penerimaan_m->get_kode($last_id);

        $this->Penerimaan_m->update('penerimaan',array('id'=>$last_id),array('no'=>$get_no[0]->no));
            
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $back = "true";
            $msg = "berhasil disimpan";
        }
        

        echo json_encode(array('back' => $back, 'msg' => $msg));
    }

    public function proses_keluar() {
        $out = true;
        $this->data['foldernya'] = $this->uri->segment(1);
        $this->data['classnya'] = $this->uri->segment(2);
        $this->data['urlnya'] = base_url() . $this->data['foldernya'] . '/' . $this->data['classnya'];
        $post = $this->input->post();
        $back = "false";
        $msg = "gagal disimpan.!";


        $data_ins = array('id_opd' => dekripsi($post['opd']),
            'id_barang' => dekripsi($post['barang']),
            'id_merk' => dekripsi($post['merk']),
            'tanggal' =>  $formated_date = date('Y-m-d', strtotime($post['tanggal_bukti'])),
            'jumlah' => $post['jumlah'],
            'pegawai' => $post['pegawai'],
            'keterangan' => $post['keterangan']
        );
        $id = $this->uri->segment(4);
        $this->db->trans_begin();

        $this->Penerimaan_m->save('pengeluaran', $data_ins);
        $last_id = $this->db->insert_id();

        $get_no = $this->Penerimaan_m->get_kode_pengeluaran($last_id);

        $this->Penerimaan_m->update('pengeluaran',array('id'=>$last_id),array('no'=>$get_no[0]->no));
            
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $back = "true";
            $msg = "berhasil disimpan";
        }
        

        echo json_encode(array('back' => $back, 'msg' => $msg));
    }

}
