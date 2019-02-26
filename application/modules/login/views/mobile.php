<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Let's start GRMS</title>

        <link href="<?php echo css('bootstrap.min.css'); ?>" rel="stylesheet">
        <link rel="icon" type="image/png" href="<?php echo image('favicon.png'); ?>">
        <link href="<?php echo css('login.css'); ?>" rel="stylesheet">
        <script src="<?php echo js('ifvisible.min.js'); ?>"></script>
    </head>
    <body class="bg-gradient-9">
        <div class="container-fluid">
            <nav class="navbar navbar-fixed-top bg-gradient-9" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo base_url(); ?>">
                            <img src="<?php echo image('logo_text.png'); ?>" alt="logo" />
                        </a>
                    </div>
                </div>
            </nav>
            <div class="col-lg-12" style="margin-top: 35%">
                <?php
                $id = $this->uri->segment(3);
                if ($id == 'phone') {
                    ?>
                    <h2 class="text-center">Maaf sistem ini tidak support dengan perangkat anda.</h2>
                <?php } else { ?>
                    <h2 class="text-center">Maaf sistem ini tidak support dengan browser anda. Silahkan update browser anda terlebih dahulu.</h2>
                <?php } ?>
            </div>
        </div>
        <div class="copyright">
            <span>&copy <?php echo date("Y"); ?> <a href="http://jatengprov.go.id">Pemerintah Provinsi Jawa Tengah</a></span>
        </div>
    </body>
</html>