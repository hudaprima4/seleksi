<?php

$config = array(
    'login/register' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|is_unique[users.username]'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        ),
        array(
            'field' => 'passconf',
            'label' => 'PasswordConfirmation',
            'rules' => 'required|matches[password]'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[users.email]'
        )
    ),
    'login/index' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required'
        ),
        array(
            'field' => 'captcha',
            'label' => 'captcha',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        )
    ),
    'config/insert' => array(
        array(
            'field' => 'config',
            'label' => 'config',
            'rules' => 'required|is_unique[configuration.config]'
        ),
        array(
            'field' => 'value',
            'label' => 'value',
            'rules' => 'required'
        )
    ),
    'config/edit' => array(
        array(
            'field' => 'config',
            'label' => 'config',
            'rules' => 'required'
        ),
        array(
            'field' => 'value',
            'label' => 'value',
            'rules' => 'required'
        )
    ),
    'master_golongan/add' => array(
        array(
            'field' => 'golonganin[]',
            'label' => 'golongan',
            'rules' => ''
        ),
        array(
            'field' => 'pangkatin[]',
            'label' => 'pangkat',
            'rules' => ''
        )
    ),
    'master_golongan/edit' => array(
        array(
            'field' => 'golonganin[]',
            'label' => 'golongan',
            'rules' => ''
        ),
        array(
            'field' => 'uniq_kodein[]',
            'label' => 'unik kode',
            'rules' => ''
        ),
        array(
            'field' => 'pangkatin[]',
            'label' => 'pangkat',
            'rules' => ''
        )
    ),
    'role/add' => array(
        array(
            'field' => 'namein[]',
            'label' => 'role name',
            'rules' => ''
        )
    ),
    'role/edit' => array(
        array(
            'field' => 'uniq_kodein[]',
            'label' => 'unik kode',
            'rules' => ''
        ),
        array(
            'field' => 'namein[]',
            'label' => 'role name',
            'rules' => ''
        )
    ),
    'master_jabatan/add' => array(
        array(
            'field' => 'jabatanin[]',
            'label' => 'jabatan',
            'rules' => 'required|is_unique[master_jabatan|.jabatan]'
        ),
        array(
            'field' => 'kodein[]',
            'label' => 'kode',
            'rules' => 'required|is_unique[master_jabatan.kode]'
        ),
        array(
            'field' => 'singkatin[]',
            'label' => 'jabatan singkat',
            'rules' => ''
        )
    ),
    'master_jabatan/edit' => array(
        array(
            'field' => 'jabatanin[]',
            'label' => 'jabatan',
            'rules' => ''
        ),
        array(
            'field' => 'uniq_kodein[]',
            'label' => 'unik kode',
            'rules' => ''
        ),
        array(
            'field' => 'kodein[]',
            'label' => 'kode',
            'rules' => ''
        ),
        array(
            'field' => 'singkatin[]',
            'label' => 'jabatan singkat',
            'rules' => ''
        )
    ),
    'master_pendidikan/add' => array(
        array(
            'field' => 'kodein[]',
            'label' => 'kode',
            'rules' => ''
        ),
        array(
            'field' => 'pendidikan[]',
            'label' => 'pendidikan',
            'rules' => ''
        )
    ),
    'master_pendidikan/edit' => array(
        array(
            'field' => 'uniq_kodein[]',
            'label' => 'unik kode',
            'rules' => ''
        ),
        array(
            'field' => 'kodein[]',
            'label' => 'kode',
            'rules' => ''
        ),
        array(
            'field' => 'pendidikan[]',
            'label' => 'pendidikan',
            'rules' => ''
        )
    ),
    'master_status_kepegawaian/add' => array(
        array(
            'field' => 'kodein[]',
            'label' => 'kode',
            'rules' => ''
        ),
        array(
            'field' => 'statusin[]',
            'label' => 'statusin',
            'rules' => ''
        )
    ),
    'master_status_kepegawaian/edit' => array(
        array(
            'field' => 'uniq_kodein[]',
            'label' => 'unik kode',
            'rules' => ''
        ),
        array(
            'field' => 'kodein[]',
            'label' => 'kode',
            'rules' => ''
        ),
        array(
            'field' => 'statusin[]',
            'label' => 'statusin',
            'rules' => ''
        )
    ),
    'app_config/add' => array(
        array(
            'field' => 'app_namein',
            'label' => 'Nama Applikasi',
            'rules' => 'required|is_unique[app_config.app_nama]'
        ),
        array(
            'field' => 'app_titlein',
            'label' => 'Judul Applikasi',
            'rules' => 'required|is_unique[app_config.app_title]'
        ),
        array(
            'field' => 'app_ipin',
            'label' => 'IP Applikasi',
            'rules' => 'required|valid_ip'
        ),
        array(
            'field' => 'app_urlin',
            'label' => 'URL Applikasi',
            'rules' => 'required|is_unique[app_config.app_title]|valid|url'
        )
    ),
    'app_config/edit' => array(
        array(
            'field' => 'app_namein',
            'label' => 'Nama Applikasi',
            'rules' => 'required'
        ),
        array(
            'field' => 'app_titlein',
            'label' => 'Judul Applikasi',
            'rules' => 'required'
        ),
        array(
            'field' => 'app_ipin',
            'label' => 'IP Applikasi',
            'rules' => 'required|valid_ip'
        ),
        array(
            'field' => 'app_urlin',
            'label' => 'URL Applikasi',
            'rules' => 'required|valid_url'
        )
    ),
    'pegawai/add' => array(
        array(
            'field' => 'nipin',
            'label' => 'NIP',
            'rules' => 'required|is_unique[pegawai.nip]'
        ),
        array(
            'field' => 'nama_pegawaiin',
            'label' => 'Nama Pegawai',
            'rules' => 'required'
        ),
        array(
            'field' => 'alamatin',
            'label' => 'Alamat',
            'rules' => 'required'
        ),
        array(
            'field' => 'alamatin',
            'label' => 'Alamat',
            'rules' => 'required'
        ),
        array(
            'field' => 'pendidikanin',
            'label' => 'Pendidikan',
            'rules' => 'required'
        ),
        array(
            'field' => 'tahun_pendin',
            'label' => 'Tahun pendidikan',
            'rules' => 'required'
        ),
        array(
            'field' => 'jabatanin',
            'label' => 'Jabatan',
            'rules' => 'required'
        ),
        array(
            'field' => 'tahun_jabin',
            'label' => 'Tahun Jabatan',
            'rules' => 'required'
        ),
        array(
            'field' => 'golin',
            'label' => 'Golongan',
            'rules' => 'required'
        ),
        array(
            'field' => 'tahun_golin',
            'label' => 'Tahun Golongan',
            'rules' => 'required'
        ),
        array(
            'field' => 'stat_kepegin',
            'label' => 'Status Kepegawaian',
            'rules' => 'required'
        )
    ),
    'pegawai/edit' => array(
        array(
            'field' => 'nipin',
            'label' => 'NIP',
            'rules' => 'required|is_unique[pegawai.nip]'
        ),
        array(
            'field' => 'nama_pegawaiin',
            'label' => 'Nama Pegawai',
            'rules' => 'required'
        ),
        array(
            'field' => 'alamatin',
            'label' => 'Alamat',
            'rules' => 'required'
        ),
        array(
            'field' => 'alamatin',
            'label' => 'Alamat',
            'rules' => 'required'
        ),
        array(
            'field' => 'pendidikanin',
            'label' => 'Pendidikan',
            'rules' => 'required'
        ),
        array(
            'field' => 'tahun_pendin',
            'label' => 'Tahun pendidikan',
            'rules' => 'required'
        ),
        array(
            'field' => 'jabatanin',
            'label' => 'Jabatan',
            'rules' => 'required'
        ),
        array(
            'field' => 'tahun_jabin',
            'label' => 'Tahun Jabatan',
            'rules' => 'required'
        ),
        array(
            'field' => 'golin',
            'label' => 'Golongan',
            'rules' => 'required'
        ),
        array(
            'field' => 'tahun_golin',
            'label' => 'Tahun Golongan',
            'rules' => 'required'
        ),
        array(
            'field' => 'stat_kepegin',
            'label' => 'Status Kepegawaian',
            'rules' => 'required'
        )
    ),
    'pegawai/addGol' => array(
        array(
            'field' => 'golin',
            'label' => 'Golongan',
            'rules' => 'required'
        ),
        array(
            'field' => 'tahunin',
            'label' => 'Tahun Golongan',
            'rules' => 'required'
        )
    ),
    'pegawai/addPend' => array(
        array(
            'field' => 'pendin',
            'label' => 'Pendidikan',
            'rules' => 'required'
        ),
        array(
            'field' => 'tahunin',
            'label' => 'Tahun Tamat',
            'rules' => 'required'
        )
    ),
    'pegawai/addJab' => array(
        array(
            'field' => 'jabin',
            'label' => 'Jabatan',
            'rules' => 'required'
        ),
        array(
            'field' => 'tahunin',
            'label' => 'Tahun Menjabat',
            'rules' => 'required'
        )
    ),
    'pegawai/addAUR' => array(
        array(
            'field' => 'appin',
            'label' => 'Applikasi',
            'rules' => 'required'
        ),
        array(
            'field' => 'rolein',
            'label' => 'Role',
            'rules' => 'required'
        )
    ),
    'pegawai/addOrPeg' => array(
        array(
            'field' => 'orpegin',
            'label' => 'Organisasi',
            'rules' => 'required'
        ),
    ),
    'pegawai/editPass' => array(
        array(
            'field' => 'newPassin',
            'label' => 'Password Baru',
            'rules' => 'required|matches[cPassin]'
        ),
        array(
            'field' => 'cPassin',
            'label' => 'Konfirmasi Password Baru',
            'rules' => 'required'
        ),
        array(
            'field' => 'oldPassin',
            'label' => 'Password Lama',
            'rules' => 'required'
        )
    ),
    'pegawai/editPeg' => array(
        array(
            'field' => 'nipin',
            'label' => 'NIP',
            'rules' => 'required'
        ),
        array(
            'field' => 'nama_pegawaiin',
            'label' => 'Nama',
            'rules' => 'required'
        ),
        array(
            'field' => 'alamatin',
            'label' => 'Alamat',
            'rules' => ''
        ),
        array(
            'field' => 'tahun_statkepegin',
            'label' => 'Tahun Status Kepegawaian',
            'rules' => 'required'
        )
    ),
    'pegawai/editGol' => array(
        array(
            'field' => 'nipin',
            'label' => 'NIP',
            'rules' => 'required'
        ),
        array(
            'field' => 'tahunin',
            'label' => 'Tahun',
            'rules' => 'required'
        )
    ),
    'pegawai/editJab' => array(
        array(
            'field' => 'nipin',
            'label' => 'NIP',
            'rules' => 'required'
        ),
        array(
            'field' => 'tahunin',
            'label' => 'Tahun',
            'rules' => 'required'
        )
    ),
    'pegawai/editPend' => array(
        array(
            'field' => 'nipin',
            'label' => 'NIP',
            'rules' => 'required'
        ),
        array(
            'field' => 'tahunin',
            'label' => 'Tahun',
            'rules' => 'required'
        )
    ),
    'pegawai/editOrPeg' => array(
        array(
            'field' => 'nipin',
            'label' => 'NIP',
            'rules' => 'required'
        ),
        array(
            'field' => 'orpegin',
            'label' => 'Oraganisasi',
            'rules' => 'required'
        )
    ),
    'pegawai/editAUR' => array(
        array(
            'field' => 'appin',
            'label' => 'Applikasi',
            'rules' => 'required'
        ),
        array(
            'field' => 'rolein',
            'label' => 'Role',
            'rules' => 'required'
        )
    ),
    'tahapan/add' => array(
        array(
            'field' => 'nama_tahapanin',
            'label' => 'Nama Tahapan',
            'rules' => 'required'
        ),
        array(
            'field' => 'idin',
            'label' => 'ID Tahapan',
            'rules' => 'required'
        ),
        array(
            'field' => 'mulaiin',
            'label' => 'Mulai',
            'rules' => ''
        ),
        array(
            'field' => 'selesaiin',
            'label' => 'Selesai',
            'rules' => ''
        ),
        array(
            'field' => 'appin',
            'label' => 'Applikasi',
            'rules' => 'required'
        )
    ),
    'tahapan/edit' => array(
        array(
            'field' => 'nama_tahapanin',
            'label' => 'Nama Tahapan',
            'rules' => 'required'
        ),
        array(
            'field' => 'idin',
            'label' => 'ID Tahapan',
            'rules' => 'required'
        ),
        array(
            'field' => 'mulaiin',
            'label' => 'Mulai',
            'rules' => ''
        ),
        array(
            'field' => 'selesaiin',
            'label' => 'Selesai',
            'rules' => ''
        ),
        array(
            'field' => 'appin',
            'label' => 'Applikasi',
            'rules' => 'required'
        )
    ),
    'rka/addBelanja21' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => ''
        )
    )
);
