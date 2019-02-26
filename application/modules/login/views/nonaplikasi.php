<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="refresh" content="3;<?php echo base_url('login'); ?>">

        <title>Let's start GRMS</title>

        <link href="<?php echo css('bootstrap.min.css'); ?>" rel="stylesheet">
        <link rel="icon" type="image/png" href="<?php echo image('favicon.png'); ?>">
        <link href="<?php echo css('font-awesome.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('style.css'); ?>" rel="stylesheet">

        <script src="<?php echo js('jquery-1.11.0.js'); ?>"></script>
        <script src="<?php echo js('bootstrap.min.js'); ?>"></script>
    </head>
    <body>
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
                        <li><a href="http://e-budgeting.jatengprov.go.id">e-budgeting</a></li>
                        <li><a href="http://eproject.jatengprov.go.id/">e-project</a></li>
                        <li><a href="#">e-procurement</a></li>
                        <li><a href="http://jgrms.jatengprov.go.id/edelivery">e-delivery</a></li>
                        <li><a href="http://econtrolling.jatengprov.go.id">e-controlling</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="wrap">
            <div class="container">
                <div class="col-lg-12">
                    <div class="login-box">
                        <div class="judul">
                            <h1>User Tidak Terdaftar</h1>
                            <ul class="sub-judul">
                                <li><a href="<?php echo base_url('login/logout'); ?>"><i class="fa fa-sitemap"></i>Maaf User anda tidak memiliki hak akses ke dalam aplikasi ini</a></li>
                            </ul>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <div class="copyright">
            <span>&copy 2014 <a href="http://jatengprov.go.id">Pemerintah Provinsi Jawa Tengah</a></span>
        </div>
    </div>

    <script src="<?php echo js('jquery-1.11.0.js'); ?>"></script>
    <script src="<?php echo js('bootstrap.min.js'); ?>"></script>

</body>

</html>
