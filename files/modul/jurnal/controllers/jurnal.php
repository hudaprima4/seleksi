<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal extends Base_Controller {

    //jurnal LRA PPKD

    public function jurnal_lra() {
        $this->content = 'jurnal_lra';
        $this->view();
    }

    //jurnal LO PPKD

    public function jurnal_lo() {
        $this->content = 'jurnal_lo';
        $this->view();
    }

    //begin: laporan jurnal

    public function index() {
        $this->content = 'daftar';
        $this->view();
    }

//    function data_jurnal($jenis = '') {
//        if ($jenis == 'lo') {
//            $this->dataTema = 'data_jurnal_lo';
//        } else if ($jenis == 'lra') {
//            $this->dataTema = 'data_jurnal_lra';
//        } else {
//            $this->dataTema = 'data_jurnal';
//        }
//        $this->noview();
//    }

    //end: laporan jurnal
    //master status

    public function master_status() {
        $this->content = 'daftar_master_status';
        $this->view();
    }

    public function tambah_status() {
        $this->load->view('jurnal/form_status');
    }

    public function edit_status() {
        $this->load->view('jurnal/form_status');
    }

    public function hapus_status() {
        
    }

    //master modul status

    public function master_modul() {
        $this->content = 'daftar_master_modul';
        $this->view();
    }

    public function tambah_modul() {
        $this->load->view('jurnal/form_modul');
    }

    public function edit_modul() {
        $this->load->view('jurnal/form_modul');
    }

    public function hapus_modul() {
        
    }

    //akun berpengaruh

    public function akun_berpengaruh() {
        $this->content = 'daftar_akun_berpengaruh';
        $this->view();
    }

    public function tambah_akun_berpengaruh() {
        $this->load->view('jurnal/form_akun_berpengaruh');
    }

    public function edit_akun_berpengaruh() {
        $this->load->view('akun/form_akun_berpengaruh');
    }

    public function hapus_akun_berpengaruh() {
        
    }

    //master kondisi

    public function master_kondisi() {
        $this->content = 'daftar_master_kondisi';
        $this->view();
    }

    public function tambah_kondisi() {
        $this->load->view('jurnal/form_kondisi');
    }

    public function edit_kondisi() {
        $this->load->view('jurnal/form_kondisi');
    }

    public function hapus_kondisi() {
        
    }

    //master kondisi khusus persediaan

    public function master_kondisi_khusus() {
        $this->content = 'daftar_master_kondisi_khusus';
        $this->view();
    }

    public function tambah_kondisi_khusus() {
        $this->load->view('jurnal/form_kondisi_khusus');
    }

    public function edit_kondisi_khusus() {
        $this->load->view('jurnal/form_kondisi_khusus');
    }

}
