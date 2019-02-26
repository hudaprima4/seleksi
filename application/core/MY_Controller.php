<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
  |--------------------------------------------------------------------------
  | Class Application
  | Parent class from this application
  |--------------------------------------------------------------------------
 */
class Base_Controller extends CI_Controller {

    protected $subTitle;
    protected $data;
    protected $dataContent;
    protected $content;
    protected $sess;
    protected $theme = 'template';
    protected $linkPage;
    protected $segment = 3;
    protected $totalPage = 0;
    protected $perPage = 10;

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function valid_login() {
        $app_config_uniq_kode = APP_CONFIG_UNIQ_KODE;
        $this->session->set_userdata('app_config_uniq_kode', $app_config_uniq_kode);
        $role_redirect_to_dashboard = array(ROLE_UNIQ_BP, ROLE_UNIQ_BPP, ROLE_UNIQ_BUD, ROLE_UNIQ_PPK, ROLE_UNIQ_BPEN, ROLE_UNIQ_BPENP, ROLE_UNIQ_AKUNTANSI, ROLE_UNIQ_PERBENDAHARAAN, ROLE_UNIQ_KASDA, ROLE_UNIQ_PPKP, ROLE_UNIQ_SPV, ROLE_UNIQ_SPV_PL, ROLE_UNIQ_BLUD);
        if (isset($this->session->userdata['pegawai_nip'])) {
            if ($this->session->userdata('userrole') == ROLE_UNIQ_SUPER_ADMIN) {
                redirect('admin/data_user');
            } else if (in_array($this->session->userdata('userrole'), $role_redirect_to_dashboard)) {
                if (has_blud($this->session->userdata('kr_organisasi_org_key')) && ($this->session->userdata('userrole') == ROLE_UNIQ_BLUD)) {
                    redirect('sp3b');
                } else {
                    redirect('dashboard');
                }
            } else if ($this->session->userdata('userrole') == ROLE_UNIQ_ADMIN_SKPD) {
                redirect('struktur_organisasi');
            } else if ($this->session->userdata('userrole') == ROLE_UNIQ_RKM) {
                redirect('rkm');
            }
        }
    }

    public function valid_admin() {
        if ($this->session->userdata('level') <> 'SU') {
            show_404();
        }
    }

    public function view() {
        $this->data['info'] = $this->Sql->select_row("Select waktu_aplikasi, informasi,status from buka_tutup_aplikasi where app_config_uniq_kode = 6");
        if (isset($this->subTitle)) {
            $this->data['title'] = $this->subTitle;
        } else {
            $this->data['title'] = system_name();
        }
        $this->data['subTitle'] = $this->subTitle;
        $this->data['data'] = $this->dataContent;
        $this->data['content'] = $this->content;

        return $this->load->view($this->theme, $this->data);
    }

    public function noview() {
        $this->data['info'] = $this->Sql->select_row("Select waktu_aplikasi, informasi,status from buka_tutup_aplikasi where app_config_uniq_kode = 6");
        if (isset($this->subTitle)) {
            $this->data['title'] = $this->subTitle;
        } else {
            $this->data['title'] = system_name();
        }
        $this->data['subTitle'] = $this->subTitle;
        $this->data['data'] = $this->dataContent;
        $this->data['content'] = $this->content;
        $this->data['Tema'] = $this->dataTema;

        return $this->load->view($this->data['Tema'], $this->data);
    }

    protected function encrypt($str = "") {
        $pengacak = "AJWKXLAJSCLWLWDAKDKSAJDADKEOIJEOQWENQWENQONEQWAJSNDKASO";
        $passEnkrip = md5($pengacak . md5($str) . $pengacak);
        return $passEnkrip;
    }

    protected function pagination() {
        $config = array();
        $config['uri_segment'] = $this->segment;
        $config['base_url'] = $this->linkPage;
        $config['total_rows'] = $this->totalPage;
        $config['per_page'] = $this->perPage;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li class='active'><span><b>";
        $config['cur_tag_close'] = "</b></span></li>";

        $this->pagination->initialize($config);

        return $this->pagination->create_links();
    }

    protected function start_page($uri) {
        if ($this->uri->segment($uri) > 0) {
            $start = $this->uri->segment($uri);
            $this->data['no'] = $start + 1;
        } else {
            $start = 0;
            $this->data['no'] = $start + 1;
        }
        return $start;
    }

}
