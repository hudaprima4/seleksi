<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="E-budgeting untuk Jawa Tengah">
        <meta name="author" content="Tim GRMS Jawa Tengah">
        <link rel="icon" type="image/png" href="<?php echo image('favicon.png'); ?>">
        <title>Let's Start GRMS</title>
        <!-- plugin CSS -->
        <link href="<?php echo css('bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('style.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('font-awesome.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo js('fancybox2/jquery.fancybox.css?v=2.1.5'); ?>" rel="stylesheet">
        <script src="<?php echo js('jquery-1.11.0.js'); ?>"></script>
        <script src="<?php echo js('pace.min.js'); ?>" defer="defer"></script>
        <script src="<?php echo js('bootstrap.min.js'); ?>" defer="defer"></script>
        <script src="<?php echo js('fancybox2/jquery.fancybox.js?v=2.1.5'); ?>"></script>
        <script src="<?php echo js('highcharts.js'); ?>"></script>
        <script src="<?php echo js('exporting.js'); ?>"></script>
        <script src="<?php echo js('jquery.bootstrap-growl.min.js'); ?>"></script>
        <script type="text/javascript">
            if (typeof jQuery === 'undefined')
                document.write(unescape("%3Cscript src='/path/jquery' type='text/javascript'%3E%3C/script%3E"));
        </script>
        <style type="text/css">
            .scroll-top {
                position:fixed;
                bottom: 10px;
                right:50%;
                z-index:100;
                font-size: 24px;
            }
            .scroll-top a:link,.scroll-top a:visited {
                color:#222;
            }
            .navv{
                padding-top: 10px;
                padding-left: 0;
                margin-bottom: 0;
                list-style: none;
            }
            .navv li a:hover{
                background-color: transparent;
            }
            .introjs-helperNumberLayer {
                position: absolute;
                top: -7px;
                left: -16px;
                z-index: 9999999999!important;
                padding: 5px;
                font-family: Arial,verdana,tahoma;
                font-size: 12px;
                font-weight: bold;
                color: white;
                text-align: center;
                text-shadow: 1px 1px 1px rgba(0,0,0,.3);
                background: #ff3019;
                background: -webkit-linear-gradient(top,#ff3019 0,#cf0404 100%);
                background: -webkit-gradient(linear,left top,left bottom,color-stop(0%,#ff3019),color-stop(100%,#cf0404));
                background: -moz-linear-gradient(top,#ff3019 0,#cf0404 100%);
                background: -ms-linear-gradient(top,#ff3019 0,#cf0404 100%);
                background: -o-linear-gradient(top,#ff3019 0,#cf0404 100%);
                background: linear-gradient(to bottom,#ff3019 0,#cf0404 100%);
                width: 30px;
                height: 30px;
                line-height: 15px;
                border: 2px solid white;
                border-radius: 50%;
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff3019',endColorstr='#cf0404',GradientType=0);
                filter: progid:DXImageTransform.Microsoft.Shadow(direction=135,strength=2,color=ff0000);
                box-shadow: 0 2px 5px rgba(0,0,0,.4);
            }
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }
            .introjs-bullets{
                display: inline;
            }
            .introjs-tooltip{min-width: 300px; text-align: center}
            .navbar-nav{font-size: 12px}
            .ui-pnotify.stack-bar-bottom{margin-left:15%; right:auto; bottom:0; top:auto; left:auto; text-align: center}
            .ui-pnotify.stack-bar-top{right:0;top:0;}
            #info li {
                color: #4E4E4E;
                white-space: nowrap;
                list-style: none;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        </style>
        <script type="text/javascript">
            var start = new Date().getTime();
            function onLoad() {
                //page size
                var pagebytes = $('html').html().length;
                var kbytes = pagebytes / 1024;
                var round = Math.round((kbytes * 100));
                var kb = round / 100;
                $(".info_server3").html(kb + " kb");
            }
        </script>
    </head>
    <body onload="onLoad()">
        <!--BEGIN INFO SERVER-->
        <button type="button" class="btn btn-primary btn_info_server" data-toggle="modal" data-target="#infoModal"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
        <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="width: 720px; margin: 0 auto;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="text-center">INFO SERVER</h3>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div id="spline_traffic" style="width: 530px !important; height: 200px; margin-left: -20px;"></div>
                            </div>
                            <div class="clearfix"></div><br/>
                            <div class="col-md-7">
                                <ul class="list-group">
                                    <li class="list-group-item text-center list-header">TENTANG</li>
                                    <li class="list-group-item">Ukuran halaman</li>
                                    <li class="list-group-item">Lama membuka halaman</li>
                                    <li class="list-group-item">Tes kualitas internet anda</li>
                                    <li class="list-group-item">Ping Jatengprov.go.id</li>
                                </ul>
                            </div>
                            <div class="col-md-5">
                                <ul class="list-group">
                                    <li class="list-group-item text-center list-header">KETERANGAN</li>
                                    <li class="list-group-item text-center"><span class="info_server3"></span></li>
                                    <li class="list-group-item text-center">
                                        <?php
                                        $start = microtime(true);
                                        $end = number_format(((microtime(true) - $start) * 1000), 4);
                                        echo $end, ' detik';
                                        ?>
                                    </li>
                                    <li class="list-group-item text-center"><a href="http://speedtest.jatengprov.go.id/" target="_blank">SpeedTest</a></li>
                                    <li class="list-group-item text-center">
                                        <?php

                                        function ping($host, $port, $timeout) {
                                            $tB = microtime(true);
                                            $fP = fSockOpen($host, $port, $errno, $errstr, $timeout);
                                            if (!$fP) {
                                                return "down";
                                            }
                                            $tA = microtime(true);
                                            return round((($tA - $tB) * 1000), 0) . " ms";
                                        }

                                        echo ping("www.jatengprov.go.id", 80, 10);
                                        ?>
                                    </li>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <p>Hasil dari ping (<?php echo ping("www.jatengprov.go.id", 80, 10); ?>) bergerak dinamis (menjadi titik-titik dalam chart yang tampil secara dimanis.)</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!--END INFO SERVER-->
        <?php
        $uri1 = $this->uri->segment(1);
        $user = $this->session->userdata('user');
        ?>
        <header class="header navbar navbar-fixed-top" role="banner">
            <div class="">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Logo -->
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">
                        <img src="<?php echo image('logo.png'); ?>" alt="logo" />
                        <strong>e-penata</strong>usahaan
                    </a>
                </div>
                <nav id="bs-navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav" role="menu" aria-labelledby="dLabel">
                        <li data-step="1" data-intro="Users">
                            <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <span>User <?php echo strtoupper($this->session->userdata('user')); ?></span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu sub-menu">
                                <li><a href="<?php echo site_url(); ?>user/set/ppk">PPK</a></li>
                                <li><a href="<?php echo site_url(); ?>user/set/bp">BP</a></li>
                                <li><a href="<?php echo site_url(); ?>user/set/bpp">BPP</a></li>
                                <li><a href="<?php echo site_url(); ?>user/set/skpkd">SKPKD</a></li>
                                <li><a href="<?php echo site_url(); ?>user/set/bud">BUD</a></li>
                                <li><a href="<?php echo site_url(); ?>user/set/bank">Bank Jateng</a></li>
                                <li><a href="<?php echo site_url(); ?>user/set/bpen">B.Penerimaan</a></li>
                                <li><a href="<?php echo site_url(); ?>user/set/bpenp">B.Penerimaan Pembantu</a></li>
                                <li><a href="<?php echo site_url(); ?>user/set/bkun">B.Akuntansi</a></li>
                                <li><a href="<?php echo site_url(); ?>user/set/admin_skpd">Admin SKPD</a></li>
                            </ul>
                        </li>
                        <li data-intro="Kembali ke Home" <?php
                        if ($uri1 == 'dashboard') {
                            echo 'class="active"';
                        }
                        ?>><a href="<?php echo site_url(); ?>dashboard">Home</a></li>
                            <?php
                            if ($user == 'bp' or $user == 'bpp' or $user == 'bpen' or $user == 'bpenp' or $user == 'bud' or $user == 'admin_skpd') {
                                ?>
                            <li data-intro="Data" class="<?php
                            if ($uri1 == 'rekanan' or $uri1 == 'penerima' or $uri1 == 'rekening' or $uri1 == 'set_wal' or $uri1 == 'bud') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>Data</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <?php
                                    if ($user == 'bp' or $user == 'bpp') {
                                        echo '<li><a href="' . site_url('rekanan') . '">Rekanan</a></li>
                                        <li><a href="' . site_url('penerima') . '">Penerima</a></li>';
                                    } else if ($user == 'admin_skpd') {
                                        echo '<li><a href="' . site_url('set_wal') . '">Setting Awal</a></li>';
                                    } else if ($user == 'bud') {
                                        echo '<li><a href="' . site_url('bud') . '">BUD</a></li>';
                                    } else {
                                        echo '<li><a href="' . site_url('penerima') . '">Penerima</a></li>
                                        <li><a href="' . site_url('rekening') . '">Rekening</a></li>';
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                        if ($user == 'ppk' or $user == 'bp' or $user == 'bpp' or $user == 'skpkd') {
                            ?>
                            <li data-intro="Kembali ke Kontrak" class="<?php
                            if ($uri1 == 'kontrak') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo site_url(); ?>kontrak">Kontrak</a></li>
                                <?php
                            }
                            if ($user == 'bp' or $user == 'bpp' or $user == 'skpkd' or $user == 'ppk') {
                                ?>
                            <li data-intro="Kembali ke BP" class="<?php
                            if ($uri1 == 'bp_gu' or $uri1 == 'bp_tu') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>BP</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <li><a href="<?php echo site_url(); ?>bp_gu">BP GU</a></li>
                                    <li><a href="<?php echo site_url(); ?>bp_tu">BP TU</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                        if ($user == 'bp' or $user == 'bpp' or $user == 'skpkd' or $user == 'ppk') {
                            ?>
                            <li data-intro="Kembali ke SPP" class="<?php
                            if ($uri1 == 'spp_up' or $uri1 == 'spp_gu' or $uri1 == 'spp_tu' or $uri1 == 'spp_ls_barang_jasa' or $uri1 == 'spp_ls_belanja_pegawai' or $uri1 == 'spp_ls_skpkd' or $uri1 == 'spp_gu_nihil' or $uri1 == 'spp_tu_nihil' or $uri1 == 'register_spp') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>SPP</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <li><a href="<?php echo site_url(); ?>spp_up">UP</a></li>
                                    <li><a href="<?php echo site_url(); ?>spp_gu">GU</a></li>
                                    <li><a href="<?php echo site_url(); ?>spp_gu_nihil">GU Nihil</a></li>
                                    <li><a href="<?php echo site_url(); ?>spp_tu">TU</a></li>
                                    <li><a href="<?php echo site_url(); ?>spp_tu_nihil">TU Nihil</a></li>
                                    <li><a href="<?php echo site_url(); ?>spp_ls_barang_jasa">LS Barang & Jasa</a></li>
                                    <li><a href="<?php echo site_url(); ?>spp_ls_belanja_pegawai">LS Belanja Pegawai</a></li>
                                    <li><a href="<?php echo site_url(); ?>spp_ls_skpkd">LS SKPKD</a></li>
                                    <li><a href="<?php echo site_url(); ?>register_spp/register/semua">Register</a></li>
                                    <li><a href="<?php echo site_url(); ?>register_spp/register_penolakan/semua">Register Penolakan</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                        if ($user == 'ppk' or $user == 'bp' or $user == 'bpp' or $user == 'skpkd' or $user == 'bud') {
                            ?>
                            <li data-intro="Kembali ke SPM" class="<?php
                            if ($uri1 == 'spm_up' or $uri1 == 'spm_gu' or $uri1 == 'spm_tu' or $uri1 == 'spm_ls_barang_jasa' or $uri1 == 'spm_ls_belanja_pegawai' or $uri1 == 'spm_ls_skpkd' or $uri1 == 'spm_gu_nihil' or $uri1 == 'spm_tu_nihil' or $uri1 == 'register_spm') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>SPM</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <li><a href="<?php echo site_url(); ?>spm_up">UP</a></li>
                                    <li><a href="<?php echo site_url(); ?>spm_gu">GU</a></li>
                                    <li><a href="<?php echo site_url(); ?>spm_gu_nihil">GU Nihil</a></li>
                                    <li><a href="<?php echo site_url(); ?>spm_tu">TU</a></li>
                                    <li><a href="<?php echo site_url(); ?>spm_tu_nihil">TU Nihil</a></li>
                                    <li><a href="<?php echo site_url(); ?>spm_ls_barang_jasa">LS Barang & Jasa</a></li>
                                    <li><a href="<?php echo site_url(); ?>spm_ls_belanja_pegawai">LS Belanja Pegawai</a></li>
                                    <li><a href="<?php echo site_url(); ?>spm_ls_skpkd">LS SKPKD</a></li>
                                    <li><a href="<?php echo site_url(); ?>register_spm/register/semua">Register</a></li>
                                    <li><a href="<?php echo site_url(); ?>register_spm/register_penolakan/semua">Register Penolakan</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                        if ($user == 'ppk' or $user == 'bp' or $user == 'bpp' or $user == 'skpkd' or $user == 'bud' or $user == 'bank') {
                            ?>
                            <li data-intro="Kembali ke SP2D" class="<?php
                            if ($uri1 == 'sp2d_up' or $uri1 == 'sp2d_gu' or $uri1 == 'sp2d_tu' or $uri1 == 'sp2d_ls_barang_jasa' or $uri1 == 'sp2d_ls_belanja_pegawai' or $uri1 == 'sp2d_ls_skpkd' or $uri1 == 'sp2d_gu_nihil' or $uri1 == 'sp2d_tu_nihil' or $uri1 == 'register_sp2d' or $uri1 == 'sp2d_pengujian') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>SP2D</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <li><a href="<?php echo site_url(); ?>sp2d_up">UP</a></li>
                                    <li><a href="<?php echo site_url(); ?>sp2d_gu">GU</a></li>
                                    <li><a href="<?php echo site_url(); ?>sp2d_gu_nihil">GU Nihil</a></li>
                                    <li><a href="<?php echo site_url(); ?>sp2d_tu">TU</a></li>
                                    <li><a href="<?php echo site_url(); ?>sp2d_tu_nihil">TU Nihil</a></li>
                                    <li><a href="<?php echo site_url(); ?>sp2d_ls_barang_jasa">LS Barang & Jasa</a></li>
                                    <li><a href="<?php echo site_url(); ?>sp2d_ls_belanja_pegawai">LS Belanja Pegawai</a></li>
                                    <li><a href="<?php echo site_url(); ?>sp2d_ls_skpkd">LS SKPKD</a></li>
                                    <li><a href="<?php echo site_url(); ?>register_sp2d/register/semua">Register</a></li>
                                    <li><a href="<?php echo site_url(); ?>register_sp2d/register_penolakan/semua">Register Penolakan</a></li>
                                    <li><a href="<?php echo site_url(); ?>sp2d_pengujian">Pengujian SP2D</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                        if ($user == 'bp' or $user == 'bpp' or $user == 'skpkd' or $user == 'ppk' or $user == 'bud') {
                            ?>
                            <li data-intro="Kembali ke LPJ" class="<?php
                            if ($uri1 == 'lpj_gu' or $uri1 == 'lpj_tu' or $uri1 == 'lpj_tu_pengembalian' or $uri1 == 'register_lpj') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>LPJ</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <li>
                                        <a class="trigger right-caret">LPJ GU</a>
                                        <ul class="dropdown-menu sub-menu">
                                            <li><a href="<?php echo site_url(); ?>lpj_gu">Daftar LPJ GU</a></li>
                                            <!--<li><a href="<?php echo site_url(); ?>lpj_gu_pengesahan">Pengesahan</a></li>-->
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="trigger right-caret">LPJ TU</a>
                                        <ul class="dropdown-menu sub-menu">
                                            <li><a href="<?php echo site_url(); ?>lpj_tu">Daftar LPJ TU</a></li>
                                            <!--<li><a href="<?php echo site_url(); ?>lpj_tu_pengesahan">Pengesahan</a></li>-->
                                            <li><a href="<?php echo site_url(); ?>lpj_tu_pengembalian">Pengembalian</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?php echo site_url(); ?>register_lpj/register/semua">Register</a></li>
                                    <li><a href="<?php echo site_url(); ?>register_lpj/register_penolakan/semua">Register Penolakan</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                        if ($user == 'bp' or $user == 'bpp' or $user == 'skpkd' or $user == 'ppk' or $user == 'bud') {
                            ?>
                            <li data-intro="Kembali ke SPJ" <?php
                            if ($uri1 == 'spj') {
                                echo 'class="active"';
                            }
                            ?>><a href="<?php echo site_url('spj'); ?>">SPJ</a></li>
                                <?php
                            }
                            if ($user == 'bp' or $user == 'bpp') {
                                ?>
                            <li data-step="1" data-intro="Kembali ke Panjar" class="<?php
                            if ($uri1 == 'panjar' or $uri1 == 'bp_panjar' or $uri1 == 'lpj_panjar' or $uri1 == 'pengembalian_panjar') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>Panjar</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <li><a href="<?php echo site_url('panjar'); ?>">Daftar Panjar</a></li>
                                    <li><a href="<?php echo site_url('bp_panjar'); ?>">Bukti Panjar</a></li>
                                    <li><a href="<?php echo site_url('lpj_panjar'); ?>">LPJ Panjar</a></li>
                                    <li><a href="<?php echo site_url('pengembalian_panjar'); ?>">Pengembalian Panjar</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                        if ($user == 'bpen' or $user == 'bpenp') {
                            ?>
                            <li data-intro="Kembali ke SKP-D" <?php
                            if ($uri1 == 'skp_d') {
                                echo 'class="active"';
                            }
                            ?>><a href="<?php echo site_url(); ?>skp_d">SKP-D</a></li>
                                <?php
                            }
                            if ($user == 'bpen' or $user == 'bpenp') {
                                ?>
                            <li data-intro="Kembali ke SKR-D" <?php
                            if ($uri1 == 'skr_d') {
                                echo 'class="active"';
                            }
                            ?>><a href="<?php echo site_url(); ?>skr_d">SKR-D</a></li>
                                <?php
                            }
                            if ($user == 'bpen' or $user == 'bpenp') {
                                ?>
                            <li data-intro="Kembali ke Bukti Penerimaan" <?php
                            if ($uri1 == 'bpen') {
                                echo 'class="active"';
                            }
                            ?>><a href="<?php echo site_url(); ?>bpen">Bukti Penerimaan</a></li>
                                <?php
                            }
                            if ($user == 'bpen' or $user == 'bpenp') {
                                ?>
                            <li data-intro="Kembali ke STS" <?php
                            if ($uri1 == 'sts') {
                                echo 'class="active"';
                            }
                            ?>><a href="<?php echo site_url(); ?>sts">STS</a></li>
                                <?php
                            }
                            if ($user == 'bud') {
                                ?>
                            <li data-step="1" data-intro="Kembali ke Akuntansi" class="<?php
                            if ($uri1 == 'akun') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>Akun</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <li><a href="<?php echo site_url('akun/get/semua'); ?>">Bagan Akun Standar</a></li>
                                    <li><a href="<?php echo site_url('akun/saldo_awal'); ?>">Saldo Awal</a></li>
                                    <li><a href="<?php echo site_url('akun/akrual'); ?>">Mapping Rek. Akrual</a></li>
                                </ul>
                            </li>
                            <!--                            <li class="sub-menu <?php
                            if ($uri1 == 'jurnal') {
                                echo 'active';
                            }
                            ?>">
                                                            <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                                                <span>Jurnal</span>
                                                                <i class="fa fa-angle-down"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li class="dropdown-submenu">
                                                                    <a tabindex="-1" href="#">Jurnal Khusus</a>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="<?php echo site_url('jurnal/penerimaan_kas'); ?>">Jurnal Penerimaan Kas</a></li>
                                                                        <li><a href="<?php echo site_url('jurnal/pengeluaran_kas'); ?>">Jurnal Pengeluaran Kas</a></li>
                                                                        <li><a href="<?php echo site_url('jurnal/pembelian'); ?>">Jurnal Pembelian</a></li>
                                                                        <li><a href="<?php echo site_url('jurnal/penjualan'); ?>">Jurnal Penjualan</a></li>
                                                                    </ul>
                                                                </li>
                                                                <li class="dropdown-submenu">
                                                                    <a tabindex="-1" href="#">Jurnal Umum</a>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="<?php echo site_url('jurnal/get_data/umum'); ?>">Jurnal Umum</a></li>
                                                                        <li class="dropdown-submenu">
                                                                            <a href="#">Jurnal Akrual</a>
                                                                            <ul class="dropdown-menu">
                                                                                <li><a href="<?php echo site_url('jurnal'); ?>">LO Penerimaan</a></li>
                                                                                <li><a href="<?php echo site_url('jurnal'); ?>">LO Pengeluaran</a></li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </li>-->
                            <li data-step="1" data-intro="Kembali ke Jurnal" class="<?php
                            if ($uri1 == 'laporan') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>Laporan Keuangan</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <li><a href="<?php echo site_url('jurnal'); ?>">Jurnal</a></li>
                                    <li><a href="<?php echo site_url('laporan/lo'); ?>">Laporan Operasional</a></li>
                                    <li><a href="<?php echo site_url('laporan/lpsal'); ?>">Laporan Perubahan SAL</a></li>
                                    <li><a href="<?php echo site_url('laporan/lra'); ?>">Laporan Realisasi Anggaran</a></li>
                                    <li><a href="<?php echo site_url('laporan/lpe'); ?>">Laporan Perubahan Ekuitas</a></li>
                                    <li><a href="<?php echo site_url('laporan/neraca'); ?>">Neraca</a></li>
                                    <li><a href="<?php echo site_url('laporan/lak'); ?>">Laporan Arus Kas</a></li>
                                    <li><a href="<?php echo site_url('laporan/calk'); ?>">Catatan Atas Lap. Keuangan</a></li>
                                    <li><a href="<?php echo site_url('laporan/buku_besar'); ?>">Buku Besar</a></li>
                                    <li><a href="<?php echo site_url('laporan/neraca_set_penyesuaian'); ?>">Neraca Setelah Penyesuaian</a></li>
                                    <li><a href="<?php echo site_url('laporan/neraca_set_penutupan'); ?>">Neraca Setelah Penutupan</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                        if ($user == 'bud' or $user == 'ppk') {
                            ?>
                            <li data-intro="Kembali ke Rekonsiliasi" <?php
                            if ($uri1 == 'rekonsiliasi') {
                                echo 'class="active"';
                            }
                            ?>><a href="<?php echo site_url('rekonsiliasi'); ?>">Rekonsiliasi</a></li>
                            <li data-step="1" data-intro="Kembali ke Jurnal" class="<?php
                            if ($uri1 == 'jurnal') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>Jurnal</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <?php
                                    if ($user == 'bud') {
                                        ?>
                                        <li><a href="<?php echo site_url('jurnal/master_status'); ?>">Master Status</a></li>
                                        <li><a href="<?php echo site_url('jurnal/master_modul'); ?>">Master Modul</a></li>
                                        <li><a href="<?php echo site_url('jurnal/master_kondisi'); ?>">Master Kondisi</a></li>
                                        <li><a href="<?php echo site_url('jurnal/master_kondisi_khusus'); ?>">Master Kondisi Khusus</a></li>
                                        <li><a href="<?php echo site_url('jurnal/akun_berpengaruh'); ?>">Akun Berpengaruh</a></li>
                                        <li><a href="<?php echo site_url('jurnal'); ?>">Jurnal Akrual</a></li>
                                        <li><a href="<?php echo site_url('jurnal/jurnal_lra'); ?>">Jurnal LRA PPKD</a></li>
                                        <li><a href="<?php echo site_url('jurnal/jurnal_lo'); ?>">Jurnal LO PPKD</a></li>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if ($user == 'ppk') {
                                        ?>
                                        <li><a href="<?php echo site_url('jurnal'); ?>">Jurnal Akrual</a></li>
                                        <li><a href="<?php echo site_url('jurnal/jurnal_lra'); ?>">Jurnal LRA SKPD</a></li>
                                        <li><a href="<?php echo site_url('jurnal/jurnal_lo'); ?>">Jurnal LO SKPD</a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                        if ($user == 'bp' or $user == 'bpp') {
                            ?>
                            <li data-step="1" data-intro="Kembali ke Cetak" class="<?php
                            if ($uri1 == 'cetak') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>Cetak Pengeluaran</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <li><a href="<?php echo site_url('cetak/preview/spjba'); ?>">1. SPJ Belanja Administratif</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/spjbf'); ?>">2. SPJ Belanja Fungsional</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/bku'); ?>">3. Buku Kas Umum</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/bpsb'); ?>">4. Buku Pembantu Simpanan Bank</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/bpp'); ?>">5. Buku Pembantu Pajak</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/popro'); ?>">6. Perincian Pengeluaran Per Rincian Obyek</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/bppj'); ?>">7. Buku Pembantu Panjar</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/kkk'); ?>">8. Kartu Kendali Kegiatan</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/bapk'); ?>">9. Berita Acara Pemeriksaan Kas</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                        if ($user == 'bpen' or $user == 'bpenp') {
                            ?>
                            <li data-step="1" data-intro="Kembali ke Cetak" class="<?php
                            if ($uri1 == 'cetak') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>Cetak Penerimaan</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <li><a href="<?php echo site_url('cetak/preview/bku'); ?>">1. Buku Kas Umum</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/bapk'); ?>">2. Berita Acara Pemeriksaan Kas</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/brph'); ?>">3. Buku Rekapitulasi Penerimaan Harian</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/spjp'); ?>">4. SPJ Pendapatan</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/pipro'); ?>">5. Perincian Penerimaan Per Rincian Obyek</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/rpp'); ?>">6. Register Penerimaan dan Penyetoran</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/rsts'); ?>">7. Register STS</a></li>
    <!--                                <li><a href="<?php echo site_url('cetak/preview/bsk'); ?>">Buku Simpanan Kas</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/bsb'); ?>">Buku Simpanan Bank</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/prop'); ?>">Buku Pembantu Per Rincian Obyek Penerimaan</a></li>
                                    <li><a href="<?php echo site_url('cetak/preview/bppbp'); ?>">Buku Penerimaan dan Penyetoran B.Pen.</a></li>-->
                                </ul>
                            </li>
                            <?php
                        }
                        if ($user == 'bp' or $user == 'bpp') {
                            ?>
                            <li data-intro="Kembali ke Kas" <?php
                            if ($uri1 == 'kas') {
                                echo 'class="active"';
                            }
                            ?>><a href="<?php echo site_url(); ?>kas">Kas</a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if ($user == 'bp' or $user == 'bpp') {
                                ?>
                            <li data-intro="Kembali ke Daftar Setoran Pajak" <?php
                            if ($uri1 == 'pajak') {
                                echo 'class="active"';
                            }
                            ?>><a href="<?php echo site_url(); ?>pajak">Pajak</a></li>
                                <?php
                            }
                            ?>
                        <li data-intro="Kembali ke Final Dokumen" <?php
                        if ($uri1 == 'final_dokumen') {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="<?php echo base_url('final_dokumen'); ?>">
                                Final Dokumen
                            </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        if ($user == 'bp' or $user == 'bpp') {
                            echo '<li><a href="#" style="background: #d9edf7; color: #31708f">9 SPP</a></li>';
                            echo '<li><a href="#" style="background: #bbfc98; color: #3c763d">9 SP2D</a></li>';
                            echo '<li><a href="#" style="background: #fcf8a3; color: #8a6d3b">9 LPJ</a></li>';
                        }
                        if ($user == 'ppk') {
                            echo '<li><a href="#" style="background: #d9edf7; color: #31708f">9 SPP</a></li>';
                            echo '<li><a href="#" style="background: #f7dede; color: #a94442">18 SPM</a></li>';
                            echo '<li><a href="#" style="background: #fcf8a3; color: #8a6d3b;">9 LPJ</a></li>';
                        }
                        if ($user == 'bud') {
                            echo '<li><a href="#" style="background: #f7dede; color: #a94442">9 SPM</a></li>';
                        }
                        ?>
                        <li class="dropdown" data-step="7" data-intro="Menu untuk Logout">
                            <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span class="username">Nama User <?php echo strtoupper($this->session->userdata('user')); ?></span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown dropdown-submenu"><a href="<?php echo base_url('login/ubah_password'); ?>" class="conbtn fancybox.ajax"><i class="fa fa-key"></i> Set Password</a></li>
                                <li class="dropdown dropdown-submenu"><a href="<?php echo base_url('login/logout'); ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="wrapper" ng-app="myApp" ng-controller="myCtrl">
            <div class="page-header">
                <div class="col-md-8" style="margin: -5px 0px 0px -55px; position: relative;">
                    <ul id="info">
                        <li><h3 class="page-title pull-left"><?php echo $this->session->userdata('namaunit'); ?></h3></li>
                        <li><h3 class="info" style="color: limegreen; font-size: 18px">Informasi Kontak Tim GRMS : </h3></li>
                        <li><h3 class="info" style="font-size: 18px">E-mail : sekretariat@grms.jatengprov.go.id</h3></li>
                    </ul>
                </div>
                <div class="breadcrumb-wrapper">
                    <span class="label">Navigasi:</span>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>dashboard">Dashboard</a></li>
                        <li><a href="#">Nama Menu</a></li>
                        <li class="active">Halaman Sekarang</li>
                    </ol>
                </div>
            </div>
            <?php $this->load->view($content); ?>
        </div>
        <!--        <div class="copyright">
                    <span>&copy <?php echo date("Y"); ?> <a href="http://jatengprov.go.id">Pemerintah Provinsi Jawa Tengah</a></span>
                </div>-->

        <script type="text/javascript">
            //popups CI
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus();
            });

            //menu
            $(function () {
                $(".dropdown-menu > li > a.trigger").on("click", function (e) {
                    var current = $(this).next();
                    var grandparent = $(this).parent().parent();
                    if ($(this).hasClass('left-caret') || $(this).hasClass('right-caret'))
                        $(this).toggleClass('right-caret left-caret');
                    grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
                    grandparent.find(".sub-menu:visible").not(current).hide();
                    current.toggle();
                    e.stopPropagation();
                });
                $(".dropdown-menu > li > a:not(.trigger)").on("click", function () {
                    var root = $(this).closest('.dropdown');
                    root.find('.left-caret').toggleClass('right-caret left-caret');
                    root.find('.sub-menu:visible').hide();
                });
            });

            //fancybox
            jQuery(function ($) {
                $('.pilih').on("click", function (e) {
                    $.fancybox.showLoading();
                    e.preventDefault(); // avoids calling preview.php
                    $.ajax({
                        type: "POST",
                        cache: false,
                        url: this.href, // preview.php
                        data: $(".form").serializeArray(), // all form fields
                        success: function (data) {
                            // on success, post (preview) returned data in fancybox
                            $.fancybox(data, {
                                helpers: {
                                    overlay: {
                                        // fancybox API options
                                        fitToView: false,
                                        minWidth: 900,
                                        maxWidth: "90%",
                                        minHeight: 300,
                                        maxHeight: "90%",
                                        height: 'auto',
                                        autoSize: false,
                                        openEffect: 'elastic',
                                        closeEffect: 'elastic',
                                        closeClick: false
                                    }
                                }
                            }); // fancybox
                        } // success
                    }); // ajax
                }); // on
            }); // ready
        </script>
        <script type="text/javascript">
            //chart
            $(function () {
                $(document).ready(function () {
                    Highcharts.setOptions({
                        global: {
                            useUTC: false
                        }
                    });

                    $('#spline_traffic').highcharts({
                        chart: {
                            type: 'spline',
                            animation: Highcharts.svg, // don't animate in old IE
                            marginRight: 10,
                            events: {
                                load: function () {
                                    // set up the updating of the chart each second
                                    var series = this.series[0];
                                    setInterval(function () {
                                        var x = (new Date()).getTime(), // current time
                                                y = Math.random();
                                        series.addPoint([x, y], true, true);
                                    }, 1000);
                                }
                            }
                        },
                        title: {
                            text: ''
                        },
                        xAxis: {
                            type: 'datetime',
                            tickPixelInterval: 150
                        },
                        yAxis: {
                            title: {
                                text: 'ms'
                            },
                            plotLines: [{
                                    value: 0,
                                    width: 1,
                                    color: '#808080'
                                }]
                        },
                        tooltip: {
                            formatter: function () {
                                return '<b>' + this.series.name + '</b><br/>' +
                                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                                        Highcharts.numberFormat(this.y, 2);
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        exporting: {
                            enabled: false
                        },
                        credits: {
                            enabled: false
                        },
                        series: [{
                                name: 'RX/TX',
                                data: (function () {
                                    // generate an array of random data
                                    var data = [],
                                            time = (new Date()).getTime(),
                                            i;
                                    for (i = -19; i <= 0; i += 1) {
                                        data.push({
                                            x: time + i * 1000,
                                            y: 2//ms --> diganti menggunakan ajax function, dynamic ping to jatengprov.go.id
                                        });
                                    }
                                    return data;
                                }())
                            }]
                    });
                });
            });
        </script>
    </body>

</html>