<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array("Notifikasi_model"));

        $this->nip_login = $this->session->userdata('pegawai_nip');
        $this->org_key = $this->session->userdata('kr_organisasi_org_key');
        $this->parent_id = $this->session->userdata('parent_id');
        $this->user = $this->session->userdata('user');

        $this->tahun = TAHUN;
        $this->tahap = '2';
    }

    public function index() {
        $this->load->library('ci_pusher');
        $pusher = $this->ci_pusher->get_pusher();
        $data = array();
        if (get_user() == 'bud') {
            $this->data['spm'] = $this->Notifikasi_model->jumlah_spm_bud($this->tahun);
            $this->data['data_spm'] = $this->Notifikasi_model->detail_spm_bud($this->tahun);

            echo json_encode(array("spm" => $this->data['spm'], "data_spm" => $this->data['data_spm']));
        } elseif (get_user() == 'ppk') {
            $this->data['spm_ditolak'] = $this->Notifikasi_model->jumlah_spm_ditolak_ppk($this->parent_id, $this->tahun);
            $this->data['spm_persiapan'] = $this->Notifikasi_model->jumlah_spm_persiapan_ppk($this->parent_id, $this->tahun);
            $this->data['lpj'] = $this->Notifikasi_model->jumlah_lpj_ppk($this->parent_id, $this->tahun);
            $this->data['spp'] = $this->Notifikasi_model->jumlah_spp_ppk($this->parent_id, $this->tahun);

            $this->data['data_spm_ditolak'] = $this->Notifikasi_model->jumlah_spm_ditolak_detail_ppk($this->parent_id, $this->tahun);
            $this->data['data_spm_persiapan'] = $this->Notifikasi_model->jumlah_spm_persiapan_detail_ppk($this->parent_id, $this->tahun);
            $this->data['data_lpj'] = $this->Notifikasi_model->jumlah_lpj_detail_ppk($this->parent_id, $this->tahun);
            $this->data['data_spp'] = $this->Notifikasi_model->jumlah_spp_detail_ppk($this->parent_id, $this->tahun);

            echo json_encode(array("lpj" => $this->data['lpj'], "data_lpj" => $this->data['data_lpj'], "spp" => $this->data['spp'], "data_spp" => $this->data['data_spp'], "data_spm1" => $this->data['data_spm_persiapan'], "spm1" => $this->data['spm_persiapan'], "spm2" => $this->data['spm_ditolak'], "data_spm2" => $this->data['data_spm_ditolak']));
        } elseif (get_user() == 'bp' or get_user() == 'bpp') {
            $this->data['lpj'] = $this->Notifikasi_model->jumlah_lpj_bp_bpp($this->parent_id, $this->tahun);
            $this->data['spp'] = $this->Notifikasi_model->jumlah_spp_bp_bpp($this->parent_id, $this->tahun);
            $this->data['sp2d'] = $this->Notifikasi_model->jumlah_sp2d_bp_bpp($this->parent_id, $this->tahun);

            $this->data['data_lpj'] = $this->Notifikasi_model->jumlah_lpj_detail_bp_bpp($this->parent_id, $this->tahun);
            $this->data['data_sp2d'] = $this->Notifikasi_model->jumlah_sp2d_detail_bp_bpp($this->parent_id, $this->tahun);
            $this->data['data_spp'] = $this->Notifikasi_model->jumlah_spp_detail_bp_bpp($this->parent_id, $this->tahun);

            echo json_encode(array("lpj" => $this->data['lpj'], "data_lpj" => $this->data['data_lpj'], "spp" => $this->data['spp'], "data_spp" => $this->data['data_spp'], "data_sp2d" => $this->data['data_sp2d'], "sp2d" => $this->data['sp2d']));
        } else if (get_user() == "bpen" or get_user() == "bpenp") {
            if (get_user() == "bpen") {
                $id = $this->session->userdata('parent_id');
            } else {
                $id = $this->session->userdata('kr_organisasi_org_key');
            }
            $this->data['skpd'] = $this->Notifikasi_model->jumlah_skp_d($id, $this->tahun);
            $this->data['skrd'] = $this->Notifikasi_model->jumlah_skr_d($id, $this->tahun);
            $this->data['bukti'] = $this->Notifikasi_model->jumlah_bukti($id, $this->tahun);
            $this->data['sts'] = $this->Notifikasi_model->jumlah_sts($id, $this->tahun);

            echo json_encode(array("skpd" => $this->data['skpd'], "skrd" => $this->data['skrd'], "bukti" => $this->data['bukti'], "sts" => $this->data['sts']));
        }

        //$data['message'] = 'COBAAA NOTIFIKASIII ' . date('Y-m-d H:i:s');
        //$event = $pusher->trigger('test_channel', 'my_event', $data);
    }

    function detail_notifikasi() {
        if (get_user() == 'bud') {
            $this->data['det_spm'] = $this->Notifikasi_model->detail_spm_bud($this->tahun);

            echo json_encode($this->data['det_spm']);
        } elseif (get_user() == 'ppk') {
            $this->data['det_spm_ditolak'] = $this->Notifikasi_model->jumlah_spm_ditolak_detail_ppk($this->parent_id, $this->tahun);
            $this->data['det_spm_persiapan'] = $this->Notifikasi_model->jumlah_spm_persiapan_detail_ppk($this->parent_id, $this->tahun);
            $this->data['det_lpj'] = $this->Notifikasi_model->jumlah_lpj_detail_ppk($this->parent_id, $this->tahun);
            $this->data['det_spp'] = $this->Notifikasi_model->jumlah_spp_detail_ppk($this->parent_id, $this->tahun);

            echo json_encode($this->data['det_spm_ditolak']);
            echo json_encode($this->data['det_spm_persiapan']);
            echo json_encode($this->data['det_lpj']);
            echo json_encode($this->data['det_spp']);
        } elseif (get_user() == 'bp') {

            $this->data['data'] = $this->Notifikasi_model->jumlah_lpj_detail_bp_bpp($this->parent_id, $this->tahun);
            $this->data['data'] = $this->Notifikasi_model->jumlah_sp2d_detail_bp_bpp($this->parent_id, $this->tahun);
            $this->data['data'] = $this->Notifikasi_model->jumlah_spp_detail_bp_bpp($this->parent_id, $this->tahun);

            echo json_encode($this->data['data']);
        } elseif (get_user() == 'bpp') {
            $this->data['det_lpj'] = $this->Notifikasi_model->jumlah_lpj_detail_bp_bpp($this->org_key, $this->tahun);
            $this->data['det_spp'] = $this->Notifikasi_model->jumlah_spp_detail_bp_bpp($this->org_key, $this->tahun);
            $this->data['det_sp2d'] = $this->Notifikasi_model->jumlah_sp2d_detail_bp_bpp($this->org_key, $this->tahun);

            echo json_encode($this->data['det_lpj']);
            echo json_encode($this->data['det_spp']);
            echo json_encode($this->data['det_sp2d']);
        }
    }

}

/* End of file  */
/* Location: ./application/controllers/ */