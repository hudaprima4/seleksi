<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="E-penatausahaan untuk Jawa Tengah">
        <meta name="author" content="Tim GRMS Jawa Tengah">
        <link rel="icon" type="image/png" href="<?php echo image('favicon.png'); ?>">
        <title>Let's Start GRMS</title>
        <!-- plugin CSS -->
        <link href="<?php echo css('bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('jquery-ui-1.10.3.custom.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('animate.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('formValidation.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('bootstrap3-wysihtml5.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('font-awesome.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('sweetalert.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('dataTables.bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('datepicker.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('jquery.fancybox.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('bootstrap-formhelpers.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('style.css'); ?>" rel="stylesheet">

        <script src="<?php echo js('jquery-1.12.3.min.js'); ?>"></script>
        <script src="<?php echo js('jquery-ui-1.10.3.custom.js'); ?>"></script>
        <script src="<?php echo js('ifvisible.min.js'); ?>"></script>
        <script src="<?php echo js('bootstrap.min.js'); ?>"></script>
        <script src="<?php echo js('bootstrap-wysiwyg.js'); ?>"></script>
        <script src="<?php echo js('sweetalert.min.js'); ?>"></script>
        <script src="<?php echo js('formValidation.min.js'); ?>"></script>
        <script src="<?php echo js('bootstrapValidation.min.js'); ?>"></script>
        <script src="<?php echo js('bootstrap-formhelpers.min.js'); ?>"></script>
        <script src="<?php echo js('jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo js('dataTables.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo js('jquery.fancybox.js'); ?>"></script>
        <script src="<?php echo js('highcharts.js'); ?>"></script>
        <script src="<?php echo js('pusher.min.js'); ?>"></script>
        <script src="<?php echo js('pace.min.js'); ?>"></script>
        <script src="<?php echo js('bootstrap-datepicker.js'); ?>"></script>
        <script src="<?php echo js('socket.io.js'); ?>"></script>
        <script src="<?php echo js('autoNumeric.js'); ?>"></script>
        <script src="<?php echo js('custom.js'); ?>"></script>
        <script src="<?php echo js('bootstrap-filestyle.min.js'); ?>"></script>

    </head>
    <body>
        <?php echo "<input type='hidden' id='jenis_user' value='" . session("user") . "'>" ?>
        <?php echo "<input type='hidden' id='jenis_parent' value='" . session("parent_id") . "'>" ?>
        <div id="loader-wrapper" class="loading">
            <div id="loaders"></div>
        </div>
        <?php
        $uri1 = $this->uri->segment(1);
        $user = $this->session->userdata('user');
        ?>
        <nav class="navbar navbar-fixed-top bg-gradient-9" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-animations">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">
                        <img src="<?php echo image('logo_text.png'); ?>" alt="logo" />
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-animations" data-hover="dropdowns" data-animations="fadeInUp fadeInUp fadeInUp fadeInRight">
                    <ul class="nav navbar-nav">
                        <li <?php
                        if ($uri1 == 'dashboard') {
                            echo 'class="dropdown active"';
                        }
                        ?>><a href="<?php echo site_url("dashboard/data_dashboard/" . enkripsi(session("parent_id"))); ?>"><i class="fa fa-home"></i></a></li>

                        <?php
                        if ($user == 'bp' or $user == 'bpp' or $user == 'skpkd' or $user == 'bpen' or $user == 'bpen' or $user == 'bud') {
                            ?>
                            <li class="dropdown <?php
                            if ($uri1 == 'rekanan' or $uri1 == 'penerima' or $uri1 == 'rekening') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>Data</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <?php if ($user == 'bpen') { ?>
                                        <li><a href="<?php echo site_url(); ?>penerima">Penerima</a></li>
                                    <?php } ?>
                                    <?php if ($user == 'bp' or $user == 'bpp' or $user == 'skpkd') { ?>
                                        <li><a href="<?php echo site_url(); ?>rekanan">Rekanan</a></li>
                                    <?php } ?>
                                    <?php if ($user == 'bpen' or $user == 'bpen') { ?>
                                        <li><a href="<?php echo site_url(); ?>rekening">Rekening</a></li>
                                    <?php } ?>
                                    <?php if ($user == 'bud') { ?>
                                        <li><a href="<?php echo site_url(); ?>data_bud">Data BUD</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php
                        }
                        if ($user == 'ppk' or $user == 'bp' or $user == 'bpp' or $user == 'skpkd') {
                            ?>
                            <li class="dropdown <?php
                            if ($uri1 == 'kontrak') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo site_url(); ?>kontrak">Kontrak</a></li>

                            <?php
                        }
                        if ($user == 'bp' or $user == 'bpp' or $user == 'skpkd' or $user == 'ppk') {
                            ?>
                            <li class="dropdown <?php
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
                            <li class="dropdown <?php
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
                            <li class="dropdown <?php
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
                        if ($user == 'ppk' or $user == 'bp' or $user == 'bpp' or $user == 'bank' or $user == 'skpkd' or $user == 'bud') {
                            ?>
                            <li class="dropdown <?php
                            if ($uri1 == 'sp2d_up' or $uri1 == 'sp2d_gu' or $uri1 == 'sp2d_tu' or $uri1 == 'sp2d_ls_barang_jasa' or $uri1 == 'sp2d_ls_belanja_pegawai' or $uri1 == 'sp2d_ls_skpkd' or $uri1 == 'sp2d_gu_nihil' or $uri1 == 'sp2d_tu_nihil' or $uri1 == 'register_sp2d') {
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
                        if ($user == 'bud') {
                            ?>
                            <li class="dropdown <?php
                            if ($uri1 == 'akun') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>Akun</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <li><a href="<?php echo site_url('akun/saldo_awal'); ?>">Saldo Awal</a></li>
                                    <li><a href="<?php echo site_url('akun'); ?>">Mapping Rek. Akrual</a></li>
                                </ul>
                            </li>
                            <?php
                        }


                        if ($user == 'bp' or $user == 'skpkd' or $user == 'ppk') {
                            ?>
                            <li class="dropdown <?php
                            if ($uri1 == 'lpj_gu' or $uri1 == 'lpj_gu_pengesahan' or $uri1 == 'lpj_tu' or $uri1 == 'lpj_tu_pengembalian' or $uri1 == 'lpj_tu_pengesahan') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>LPJ</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <li class="dropdown-submenu">
                                        <a  tabindex="-1" href="#">LPJ GU</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo site_url(); ?>lpj_gu">Daftar LPJ GU</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a  tabindex="-1" href="#">LPJ TU</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo site_url(); ?>lpj_tu">Daftar LPJ TU</a></li>
                                            <li><a href="<?php echo site_url(); ?>lpj_tu_pengembalian">Pengembalian</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?php echo site_url(); ?>register_lpj/register/semua">Register</a></li>
                                    <li><a href="<?php echo site_url(); ?>register_lpj/register_penolakan/semua">Register Penolakan</a></li>
                                </ul>
                            </li>
                            <?php
                        }

                        if ($user == 'bp' or $user == 'bpp' or $user == 'ppk') {
                            ?>
                            <li class="dropdown <?php
                            if ($uri1 == 'spj') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo site_url(); ?>spj">SPJ</a></li>
                            <li class="dropdown <?php
                            if ($uri1 == 'panjar' or $uri1 == 'bp_panjar' or $uri1 == 'lpj_panjar' or $uri1 == 'pengembalian_panjar') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>Panjar</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <?php
                                    if ($user == 'bp' || $user == 'bpp') {
                                        ?>
                                        <li><a href="<?php echo site_url(); ?>panjar">Daftar Panjar</a></li>
                                        <li><a href="<?php echo site_url(); ?>bp_panjar">Bukti Panjar</a></li>
                                        <li><a href="<?php echo site_url(); ?>lpj_panjar">LPJ Panjar</a></li>
                                        <li><a href="<?php echo site_url(); ?>pengembalian_panjar">Pengembalian Panjar</a></li>
                                        <?php
                                    } elseif ($user == 'ppk') {
                                        ?>
                                        <li><a href="<?php echo site_url(); ?>lpj_panjar">LPJ Panjar</a></li>
                                        <?php
                                    }
                                    ?>

                                </ul>
                            </li>
                            <?php
                            if ($user == 'bp' or $user == 'bpp') {
                                ?>
                                <li class="dropdown <?php
                                if ($uri1 == 'pembukuan') {
                                    echo 'active';
                                }
                                ?>">
                                    <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                        <span>Cetak Pengeluaran</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu sub-menu">
                                        <li><a href="<?php echo site_url('pembukuan/pengeluaran'); ?>/bapk">Berita Acara Pemeriksaan Kas</a></li>
                                        <li><a href="<?php echo site_url('pembukuan/pengeluaran'); ?>/bku">Buku Kas Umum</a></li>
                                        <li><a href="<?php echo site_url('pembukuan/pengeluaran'); ?>/bpp">Buku Pembantu Pajak</a></li>
                                        <li><a href="<?php echo site_url('pembukuan/pengeluaran'); ?>/bppj">Buku Pembantu Panjar</a></li>
                                        <li><a href="<?php echo site_url('pembukuan/pengeluaran'); ?>/bpsb">Buku Pembantu Simpanan Bank</a></li>
                                        <li><a href="<?php echo site_url('pembukuan/pengeluaran'); ?>/kkk">Kartu Kendali Kegiatan</a></li>
                                        <li><a href="<?php echo site_url('pembukuan/pengeluaran'); ?>/popro">Perincian Pengeluaran Per Rincian Obyek</a></li>
                                        <li><a href="<?php echo site_url('pembukuan/pengeluaran'); ?>/spjb">SPJ Belanja</a></li>
                                        <li><a href="<?php echo site_url('pembukuan/pengeluaran'); ?>/brp">Buku Rincian Pajak</a></li>
                                    </ul>
                                </li>
                                <?php
                            }
                        }

                        if ($user == 'bp' or $user == 'bpp') {
                            ?>
                            <li class="dropdown <?php
                            if ($uri1 == 'kas') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo site_url(); ?>kas">KAS</a></li>
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
                            if ($user == 'bpen' or $user == 'bpenp') {
                                ?>
                            <li class="dropdown <?php
                            if ($uri1 == 'pembukuan') {
                                echo 'active';
                            }
                            ?>">
                                <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>Cetak Penerimaan</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <li><a href="<?php echo site_url('pembukuan/penerimaan'); ?>/bku">Buku Kas Umum</a></li>
                                    <li><a href="<?php echo site_url('pembukuan/penerimaan'); ?>/bapk">Berita Acara Pemeriksaan Kas</a></li>
                                    <li><a href="<?php echo site_url('pembukuan/penerimaan'); ?>/brph">Buku Rekapitulasi Penerimaan Harian</a></li>
                                    <li><a href="<?php echo site_url('pembukuan/penerimaan'); ?>/spjp">SPJ Pendapatan</a></li>
                                    <li><a href="<?php echo site_url('pembukuan/penerimaan'); ?>/pipro">Perincian Penerimaan Per Rincian Obyek</a></li>
                                    <li><a href="<?php echo site_url('pembukuan/penerimaan'); ?>/rpp">Register Penerimaan dan Penyetoran</a></li>
                                    <li><a href="<?php echo site_url('pembukuan/penerimaan'); ?>/rsts">Register STS</a></li>
                                </ul>
                            </li>
                            <?php
                        }

                        if ($user == 'Admin SKPD') {
                            ?>
                            <li data-intro="Kembali ke Struktur Organisasi" <?php
                            if ($uri1 == 'struktur_organisasi') {
                                echo 'class="active"';
                            }
                            ?>><a href="<?php echo site_url(); ?>struktur_organisasi">Struktur Organisasi</a></li>
                            <?php }
                            ?>
                            <?php
                            if ($user == 'bp' or $user == 'bpp') {
                                ?>
                            <li data-intro="Kembali ke Pajak" <?php
                            if ($uri1 == 'pajak') {
                                echo 'class="active"';
                            }
                            ?>><a href="<?php echo site_url(); ?>pajak">Pajak</a></li>
                            <?php }
                            ?>

                        <li class="dropdown hidden">
                            <a href="<?php echo base_url('/files/panduan.pdf'); ?>" target="_blank">
                                Panduan
                            </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown <?php echo (get_user() === "bud") ? "hidden" : ""; ?>">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                SPP
                                <span class="badge badge-success badge-notify" id="spp_jum"></span>
                            </a>
                        </li>
                        <li class="dropdown <?php echo (get_user() === "bud" or get_user() === "ppk") ? "" : "hidden"; ?>">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                SPM
                                <span class="badge badge-success badge-notify" id="spm_jum"></span>
                            </a>
                        </li>
                        <li class="dropdown <?php echo (get_user() === "bp") ? "" : "hidden"; ?>">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                SP2D
                                <span class="badge badge-success badge-notify" id="sp2d_jum"></span>
                            </a>
                        </li>
                        <li class="dropdown <?php echo (get_user() === "bud") ? "hidden" : ""; ?>">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                LPJ
                                <span class="badge badge-success badge-notify" id="lpj_jum"></span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript.void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="fa fa-user"></i> <?php echo trunc(session('nama'), 1) . ' (' . strtoupper(session('user')) . ')'; ?></a></li>
                                <li><a class="fanBox fancybox.ajax" href="<?php echo base_url('login/edit_profil/' . session('pegawai_nip')); ?>"><i class="fa fa-edit"></i> Edit Profil</a></li>
                                <li><a href="<?php echo base_url('login/logout'); ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="wrapper" id="main-wrapper">
            <div class="page-header">
                <span id="jam" class="label label-info">0</span> <span class="label label-danger hidden" id="seconds">00</span>
                <a href="/epen/dashboard/infoserver" class="button fanBox fancybox.ajax"><span class="label label-info"><i class="fa fa-cog"></i> Info Server</span></a>
                <div class="breadcrumb-wrapper">
                    <?php if ($this->uri->segment(1) != '') { ?>
                        <ol class="breadcrumb">
                            <span class="label">Navigasi:</span>
                            <?php
                            $uri1 = $this->uri->segment(1);
                            $uri2 = $this->uri->segment(2);
                            $uri3 = $this->uri->segment(3);
                            $one = titleCase(str_replace('_', '&nbsp;', $uri1));
                            $two = titleCase(str_replace('_', '&nbsp;', $uri2));
                            $tri = titleCase(str_replace('_', '&nbsp;', $uri3));
                            if ($this->uri->segment(3) != '') {
                                echo "<li><a href='" . base_url("$uri1") . "'>" . $one . "</a></li>";
                                echo "<li><a href='" . base_url("$uri1/$uri2") . "'>" . $two . "</a></li>";
                            } else if ($this->uri->segment(2) != '') {
                                echo "<li><a href='" . base_url("$uri1") . "'>" . $one . "</a></li>";
                                echo "<li class='active'><a href='" . base_url("$uri1/$uri2") . "'>$two</a></li>";
                            } else {
                                echo "<li class='active'><a href='" . base_url("$uri1") . "'>$one</a></li>";
                            }
                            ?>                
                        </ol>    
                    <?php } ?>
                </div>
            </div>
            <?php $this->load->view($content); ?>
        </div>
        <!--        <div class="copyright">
                    <span>&copy <?php echo date("Y"); ?> <a href="http://jatengprov.go.id">Pemerintah Provinsi Jawa Tengah</a></span>
                </div>-->
    </body>
</html>



