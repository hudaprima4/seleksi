<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>E-Penatausahaan - 404 Error Page</title>
        <link rel="stylesheet" href="<?php echo css('bootstrap.min.css'); ?>">
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500,700' rel='stylesheet' type='text/css'>
        <link href="<?php echo css('font-awesome.min.css'); ?>" rel="stylesheet">  
        <link rel="stylesheet" href="<?php echo css('animate.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo css('404.css'); ?>">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="far-clouds" class="far-clouds stage"></div>
        <div id="near-clouds" class="near-clouds stage"></div>
        <section>    
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="balloon">
                            <h1 class="wow fadeInUp" data-wow-delay="0.5s">Error 404</h1>
                            <h2 class="wow fadeInDown">Halaman yang anda akses tidak ditemukan!</h2>
                            <div class="wow bounceIn" data-wow-delay="0.7s">
                                <img src="<?php echo image('balloon.png'); ?>" alt="balloon" >
                            </div>
                            <h4 class="wow fadeInUp" data-wow-delay="0.9s">Silahkan ke Home atau katakan "Home" untuk kembali ke halaman utama.</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="social-icons wow fadeInDown" data-wow-delay="1s">
                            <a href="<?php echo base_url(); ?>"><i class="fa fa-2x fa-home"></i></a>
                        </div>                     
                        <div class="copyrights wow fadeIn" data-wow-delay="1.2s"><p>©grms.jatengprov.go.id <?php echo date("Y") ?> - All Rights Reserved.</p></div>                                                    
                    </div>
                </div>            

            </div>
        </section>

        <!-- Al JS Plugins -->
        <script src="<?php echo js('jquery.min.js'); ?>"></script>
        <script src="<?php echo js('jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo js('bootstrap.min.js'); ?>"></script>
        <script src="<?php echo js('jquery.easing.min.js'); ?>"></script>
        <script src="<?php echo js('annyang.min.js'); ?>"></script>
        <script src="<?php echo js('jquery.spritely.js'); ?>"></script>
        <script src="<?php echo js('404.js'); ?>"></script>
        <script src="<?php echo js('wow.min.js'); ?>"></script>
        <script src="<?php echo js('prefixfree.min.js'); ?>"></script>

    </body>
</html>
