<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Seleksi">
        <meta name="author" content="Seleksi">
        <link rel="icon" type="image/png" href="">
        <title>Seleksi</title>
        <!-- plugin CSS -->
        <link href="<?php echo css('bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('animate.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('dataTables.bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('jquery-ui-1.10.3.custom.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('animate.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('formValidation.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('bootstrap3-wysihtml5.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('font-awesome.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('sweetalert.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('iziToast.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('datepicker.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('chosen.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('jquery.fancybox.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('style_baru.css'); ?>" rel="stylesheet">

        <script src="<?php echo js('jquery-1.12.3.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('jquery-ui-1.10.3.custom.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('ifvisible.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('bootstrap.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('bootstrap-wysiwyg.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('sweetalert.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('formValidation.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('id_ID.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('bootstrapValidation.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('bootstrap-formhelpers.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('dataTables.bootstrap.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('jquery.fancybox.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('highcharts.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('iziToast.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('chosen.jquery.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('pace.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('bootstrap-datepicker.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('autoNumeric.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('bootstrap-filestyle.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('jquery.webticker.min.js'); ?>"></script>
        <script src="<?php echo js('custom.js'); ?>" type="text/javascript"></script>
    </head>
    <body>
        <section id="container">
        
                
            <section id="main-content">
                <section class="wrapper">

                    <div class="row">
                        <?php //echo get_foto_skpd(session("pegawai_nip")); ?>
                        <?php $this->load->view($content); ?>
                    </div>
                </section>
            </section>
        </section>
    </body>
</html>
