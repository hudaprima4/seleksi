<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class base_global extends CI_Controller {

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
    public $parent_id_check;

    function __construct() {
        parent::__construct();
    }

    public function valid_login() {
        if ($this->session->userdata('login') <> 'true') {
            redirect(site_url('welcome/login'), 'refresh');
        } else {
            $this->sess = $this->session->all_userdata(); // all_userdata diambil dari Session di CI
        }
    }

    public function valid_admin() {
        if ($this->session->userdata('level') <> 'SU') {
            show_404();
        }
    }

    public function view() {
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

}

?>
