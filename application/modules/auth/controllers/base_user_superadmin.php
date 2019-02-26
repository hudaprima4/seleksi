<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(APPPATH . 'modules/auth/controllers/Base_global.php');
class base_user_superadmin extends base_global {

    function __construct() {
        parent::__construct();

        // if (ROLE_UNIQ_SUPER_ADMIN == $this->session->userdata('userrole')) {
            
        // } else {
        //     // redirect('nonapl');
        // }
    }

}

?>
