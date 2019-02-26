<?php
header("Access-Control-Allow-Origin: *");
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class login extends Base_Controller {

    function __construct() {
        parent::__construct();echo 'a';die();
    }

    public function index() {
        $this->valid_login();
        $data['classnya'] = 'login';
        $data['urlnya'] = $data['classnya'] . '/index';

        //print_r($this->session->userdata('security_code'));
        $data['info'] = $this->Sql->select_row("Select waktu_aplikasi, informasi,status from buka_tutup_aplikasi where app_config_uniq_kode = 6");
        $this->load->view('login/form_login', $data);
    }
	
	public function form_login() {
        $this->valid_login();
        $data['classnya'] = 'login';
        $data['urlnya'] = $data['classnya'] . '/index';

        //print_r($this->session->userdata('security_code'));
        $data['info'] = $this->Sql->select_row("Select waktu_aplikasi, informasi,status from buka_tutup_aplikasi where app_config_uniq_kode = 6");
        $this->load->view('login/form_login_2', $data);
    }

    function load_code() {
        $code = $this->generateCode(5);
        $this->session->set_userdata('security_code', $code);
        echo json_encode(enkripsi($code));
    }

    function cek_tanggal_antara($start_date, $end_date, $todays_date) {
        $start_timestamp = strtotime($start_date);
        $end_timestamp = strtotime($end_date);
        $today_timestamp = strtotime($todays_date);
        return (($today_timestamp >= $start_timestamp) && ($today_timestamp <= $end_timestamp));
    }

    function proses_login() {
        $back = "errors";
        $msg = "Maaf untuk sementara aplikasi ditutup untuk proses penyesuaian dengan anggaran perubahan.";

        if ($this->cek_tanggal_antara('2018-10-23 16:15:00', '2018-10-23  23:59:59', date("Y-m-d H:i:s"))) {
            $this->session->sess_destroy();
            $back = "errors";
            $msg = "Maaf untuk sementara aplikasi ditutup untuk proses penyesuaian dengan anggaran perubahan.";
            echo json_encode(array('back' => $back, 'msg' => $msg));
            return false;
        }
        $data['keyEnc'] = $this->Config_model->getKey('key');
        $cek_nip = $this->Login_model->get_nip_pegawai($this->input->post('username'));
        $count = count($cek_nip);
        // Cek Jika NIP yang di Inputkan Tidak ADA
        if ($count != 1) {
            $back = "username_tidak_ada";
            $msg = "Username atau NIP yang Anda input tidak ditemukan.";
            echo json_encode(array('back' => $back, 'msg' => $msg));
            return false;
        }
        // Cek Jika Sudah GAGAL 3 KALI INPUT PASSWORD
        if ($cek_nip->user_failed_logins >= 3 AND ( $cek_nip->user_last_failed_login > (time() - 30))) {
            $back = "gagal_3_kali";
            $msg = "You have typed in a wrong password 3 or more times already. Please wait 30 seconds to try again.";
            echo json_encode(array('back' => $back, 'msg' => $msg));
            return false;
        }
        if ($this->input->post('captcha') == dekripsi($this->input->post('security_code'))) {
            // if ($this->input->post('username') == "superadmin2") {
            $cekLogin = $this->Login_model->cekLogin_fc(APP_CONFIG_UNIQ_KODE, $this->input->post('username'), $this->input->post('password'), $data['keyEnc'][0]->value);
            // print_r($this->db->last_query());die();
            if ($cekLogin == null) {
                $back = "username";
                $msg = "Username atau password yang Anda input salah.";
                $this->Login_model->update_failed_login($this->input->post('username'));
                echo json_encode(array('back' => $back, 'msg' => $msg));
            } else {
                // Reset Counter Failed Login
                if ($cek_nip->user_failed_logins >= 3) {
                    $this->Login_model->reset_failed_login($this->input->post('username'));
                }
                $this->session->unset_userdata('security_code');

                $data['search'] = array(
                    'name' => $cekLogin[0]->name
                );
                $data['dataUser'] = $this->Login_model->getPegSes_fc_pertama(APP_CONFIG_UNIQ_KODE, $cekLogin[0]->name);
                $peg_ = $this->Login_model->view('daftar_pegawai', array('nip' => $cekLogin[0]->name));
                //multi roles
                $roles = array();
                for ($i = 1; $i < sizeof($data['dataUser']); $i++) {
                    $roles[] = $data['dataUser'][$i]->alias_role_name;
                }

                //$cekDahLogin = $this->Login_model->cekDahLogin($this->input->post('username'), APP_CONFIG_UNIQ_KODE, $data['dataUser'][0]->uniq_kode_role);
                $newdataSes = array(
                    "logged_in" => TRUE,
                    "pegawai_nip" => $data['dataUser'][0]->name,
                    "nama" => $data['dataUser'][0]->nama,
                    "peg_uniq_kode" => $data['dataUser'][0]->uniq_kode,
                    "parent_id" => $data['dataUser'][0]->parent_id,
                    "kr_organisasi_org_key" => $data['dataUser'][0]->kr_organisasi_org_key,
                    "uk_pegawai" => $peg_[0]->uniq_kode,
                    "userrole" => $data['dataUser'][0]->uniq_kode_role,
                    "app_config_uniq_kode" => 6,
                    "user" => $data['dataUser'][0]->alias_role_name
                );
                if ($data['dataUser'][0]->alias_role_name == 'superadmin') {
                    $newdataSes['sprData'] = array(
                        "user" => $data['dataUser'][0]->name,
                        "nama" => $data['dataUser'][0]->nama,
                        "uniq" => $data['dataUser'][0]->uniq_kode_pegawai
                    );
                }
                $serialized_data = serialize($newdataSes);
                $user_data_session = array(
                    "nip" => $data['dataUser'][0]->name,
                    "date_added" => 'NOW()',
                    "date_updated" => 'NOW()',
                    "user_data" => $serialized_data,
                );

                $this->Login_model->insert('user_sessions', $user_data_session);
                $this->session->set_userdata($newdataSes);

                // JIKA REMEMBER ME di CENTANG
                if (isset($_POST['user_rememberme'])) {
                    $random_token_string = hash('sha256', mt_rand());
                    $this->Login_model->gen_remember_token($random_token_string, $cek_nip->name);
                    $cookie_string_first_part = $cek_nip->name . ':' . $random_token_string;
                    $cookie_string_hash = hash('sha256', $cookie_string_first_part);
                    $cookie_string = $cookie_string_first_part . ':' . $cookie_string_hash;
                    // set cookie
                    setcookie('rememberme', $cookie_string, time() + COOKIE_RUNTIME, "/", COOKIE_DOMAIN);
                }

                $config = $this->Pegawai_model->get('configuration');
                if ($config[10]->value == '2' or $config[10]->value == '4') {
                    if ($this->session->userdata('userrole') == ROLE_UNIQ_SUPER_ADMIN) {
                        $back = "admin";
                        $msg = "Selamat Datang Admin " . session('nama');
                    } else {
                        $back = "user";
                        $msg = "Selamat Datang kembali " . session('nama');
                    }
                } else {
                    if ($this->session->userdata('userrole') == ROLE_UNIQ_SUPER_ADMIN) {
                        $back = "admin";
                        $msg = "Selamat Datang Admin " . session('nama');
                    } else {
                        $back = "user";
                        $msg = "Selamat Datang kembali " . session('nama');
                    }
                }
                echo json_encode(array('back' => $back, 'msg' => $msg));
            }
            // } else {
            //     $back = "errors";
            //     $msg = "Maaf untuk sementara aplikasi ditutup untuk proses penyesuaian dengan anggaran perubahan.";
            //     echo json_encode(array('back' => $back, 'msg' => $msg));
            // }
        } else {
            $back = "captcha";
            $msg = "Captcha code salah.";
            echo json_encode(array('back' => $back, 'msg' => $msg));
        }
    }

    function denied() {
        $this->load->view('root/header');
        $this->load->view('sorry');
        $this->load->view('root/footer');
        $this->output->set_header('refresh:2; url=' . base_url('login/logout')); //redirect
    }

    function auth() {
        // print_r($this->session->all_userdata());
        $uk_pegawai = $this->session->userdata('uk_pegawai');
        $org_key = $this->session->userdata('kr_organisasi_org_key');
        $data['role'] = $this->Login_model->view_auth($uk_pegawai);

        $data_mdl = $this->Login_model->get_modul_auth($uk_pegawai, $org_key);
        // print_r($this->db->last_query());die();
        $newdata = array(
            "modul_dipilih" => $data_mdl[0]->kode_modul
        );

        // $data['jenis'] = explode('~', $data['role'][0]->role_khusus);
        // print_r($this->db->last_query());die();
        $data['urlnya'] = 'login/index';

        $data['submit'] = array(
            'name' => 'submit',
            'id' => 'idsubmit',
            'class' => 'btn',
            'data-anim' => 'la-anim-1',
            'value' => 'Login',
        );

        $data['atts_submit'] = array(
            'class' => 'btn',
            'data-anim' => 'la-anim-1',
            'onClick' => 'this.form.submit()'
        );


        $this->session->set_userdata($newdata);

        // $data['auth_code'] = $md5;
        $this->load->view('login/auth', $data);
    }

    function logout() {
//        $this->load->helper('cookie');
        $data['role'] = $this->uri->segment(1);
        $data['classnya'] = 'index';
        $data['urlnya'] = $data['role'];
        //$this->input->set_cookie('rememberme', false, time() - (3600 * 3650), '/', COOKIE_DOMAIN);

        $this->session->sess_destroy();
        redirect(base_url());
    }

    function generateCode($characters) {
        /* list all possible characters, similar looking characters and vowels have been removed */
        $possible = '23456789bcdfghjkmnpqrstvwxyz';
        $code = '';
        $i = 0;
        while ($i < $characters) {
            $code .= substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            $i++;
        }
        return $code;
    }

    function checkCaptcha($post) {
        if ($post['captcha'] = $post['ccode']) {
            return 'Success';
        } else {
            return 'Mismatch, try again';
        }
    }

    function nonaplikasi() {
        $this->session->sess_destroy();
        $this->load->view("login/nonaplikasi");
    }

    function ubah_password() {
        $data['pegawai_nip'] = $this->session->userdata['pegawai_nip'];
        $this->load->view("login/ubah_password", $data);
    }

    function proses_ubah_password() {
        $nip = $this->session->userdata['pegawai_nip'];
        $data['keyEnc'] = $this->Config_model->getKey('key');
        $keyEncnya = $data['keyEnc'][0]->value;
        if ($this->input->post('targetData') == false) {
            $data['array'] = array();
            $this->load->view("login/ubah_password", $data);
        } else {//edit_password
            $data['keyEnc'] = $this->Config_model->getKey('key');
            $keyEncnya = $data['keyEnc'][0]->value;
            $pass_baru_enc = crypt($this->input->post('password_baru'), $keyEncnya);
            $data['update_user'] = array(
                "password" => $pass_baru_enc
            );
            $this->Login_model->update('user', $data['update_user'], array('name' => $nip));
            $ref = $_SERVER["HTTP_REFERER"];
            redirect($ref, 'refresh');
            echo '<script>history.back(1)</script>';
        }
    }

    private function password_lama_check() {
        // allow only Ajax request
        if ($this->input->is_ajax_request()) {
            $username = $this->session->userdata['pegawai_nip'];
            $data['keyEnc'] = $this->Config_model->getKey('key');
            $keyEncnya = $data['keyEnc'][0]->value;
            // grab the password_lama value from the post variable.
            $password_lama_encrypt = crypt($this->input->post('password_lama'), $keyEncnya);
            // check in database - table name : user  , Field name in the table : password
            $cek = $this->Login_model->cek_password_lama($password_lama_encrypt, $username);
            if ($cek == FALSE) {
                echo json_encode(array('message' => false));
            } else {
                echo json_encode(array('message' => true));
            }
        }
    }

    public function mobile($id) {
        $this->load->view("login/mobile");
    }

    public function edit_profil($id) {
        $this->dataTema = 'edit_profil';
        $this->noview();
    }

    function tes_reset() {
        $code = rand_password();
        echo $code;
    }

}
