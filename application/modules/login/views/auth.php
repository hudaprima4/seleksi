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
    <link href="<?php echo css('sweetalert2.css'); ?>" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700,400,600' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/ico" href="<?php echo base_url('themes/images/logo.png'); ?>">
    <style type="text/css">
        input[type="password"] {
            width: 100% !important;
            font-size: 50px;
            height: 80px !important;
            text-align: center !important;
        }
    </style>
</head>

<body>
    <script src="<?php echo js('jquery-1.11.0.js'); ?>"></script>
    <script src="<?php echo js('sweetalert2.min.js'); ?>"></script>
    <script src="<?php echo js('browser.min.js'); ?>"></script>
    <script src="<?php echo js('md5.js'); ?>"></script>
    <script src="<?php echo js('bootstrap.min.js'); ?>"></script>
    <script>

        $(window).on("load", function() {
            localStorage.removeItem("ebudgeting");
            swal({
                title: 'Pilih',
                html: '<select class="form-control" name="selunit" id="selunit"><option value="">Pilih Unit</option><?php foreach($role as $value){echo '<option value="'.$value->uk_org.'">'.$value->uraian.'</option>';}?></select>',
                confirmButtonText: 'Submit',
                showCancelButton: true,
                allowOutsideClick: false,
                closeOnConfirm: false
            }, function(isConfirm) {
                swal.disableButtons();
                if (isConfirm) {
                    setTimeout(function() {
                        var value = $('#selunit').val();
                            // alert(value);
                            localStorage.setItem("ebudgeting", <?php echo json_encode(@$auth_code); ?>);
                            swal('Login Berhasil', 'Anda akan diredirect ke Epenatausahaan', 'success');
                            setTimeout(function() {
                                window.location.href = "<?php echo base_url('dashboard/auth/'); ?>"+'/'+value;
                            }, 1500);
                        
                    }, 2000);
                } else {
                    window.location.href = "<?php echo base_url('login/logout'); ?>";
                };
            });
            return false;
        });
        $(document).on("contextmenu", function(e) {
            return false;
        });
    </script>
</body>

</html>