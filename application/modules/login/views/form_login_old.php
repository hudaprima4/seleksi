<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="<?php echo image('favicon.png'); ?>">

        <title>Let's start GRMS</title>
        <link href="<?php echo css('bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('animate.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('iziToast.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('font-awesome.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('flipclock.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('login.css'); ?>" rel="stylesheet">

        <script src="<?php echo js('jquery-1.11.0.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('bootstrap.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('flipclock.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('iziToast.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('ifvisible.min.js'); ?>" type="text/javascript"></script>
    </head>
    <body>
        <nav class="navbar navbar-fixed-top bg-gradient-9" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-animations">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">
                        <img src="<?php echo image('logo.png'); ?>" alt="logo" />
                        <strong>grms</strong>jateng
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-animations" data-hover="dropdowns" data-animations="fadeInUp fadeInUp fadeInUp fadeInRight">
                    <ul class="nav navbar-nav">
                        <li><a href="http://ebudgeting.jatengprov.go.id">eBudgeting</a></li>
                        <li><a href="http://eproject.jatengprov.go.id">eProjectplanning</a></li>
                        <li class="active"><a href="http://epenatausahaan.jatengprov.go.id">ePenatausahaan</a></li>
                        <li><a href="http://edelivery.jatengprov.go.id">eDelivery</a></li>
                        <li><a href="http://econtrolling.jatengprov.go.id">eControlling</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="col-md-8">
                <!--<h1 class="tlt enjoy-css" data-in-effect="rollIn">ePenatausahaan</h1>-->
                <h1 class="tlt enjoy-css">
                    e-penatausahaan
                </h1>
                <ul class="sub-judul">
                    <li><a href="#"><i class="fa fa-sitemap"></i>Alur</a></li>
                    <li> <div class="btn-group">
                            <button id="lab" data-content="Download Panduan dan Materi Epenatausahaan" rel="popover" data-placement="top" type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #e74c3c; font-weight: bold; font-size: 16px"> <i class="fa fa-university"></i> Manual <span class="caret"></span> </button>
                            <ul class="dropdown-menu">
                                <li><a title="Download Panduan User Staff" href="<?php echo base_url('files/panduan/E-penatausahaan_BP_BPP.pdf') ?>" download> <i class="fa fa-download"></i> Download Manual User BP / BPP</a></li>

                                <li><a title="Download Panduan User Staff" href="<?php echo base_url('files/panduan/E-Penatausahaan_PPK.pdf') ?>" download> <i class="fa fa-download"></i> Download Manual User PPK</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <div class="konten text-center">
                    <!--<h3>Apa itu epenatausahaan?</h3>-->
                    <p>epenatausahaan adalah sistem yang dipakai dalam proses penatausahaan keuangan yang terintegrasi dengan sistem Rencana Kerja Operasional yaitu eprojectplanning dan sistem Pengendalian yaitu econtrolling.</p>
                </div>
                <br>
                <br>
                <center><h2 id="infonya" class="animated fadeIn infinite hidden" style="color: #3498DB; font-weight: bold; font-weight: 900">Aplikasi telah dibuka <br>dan menggunakan Database Asli</h2></center>
                <div class="col-lg-offset-1 col-lg-10 hidden">
                    <br>
                    <div class="clock"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="login animated bounceIn">
                    <div class="login-screen border-top-blue">
                        <h3 class="sub-judul2">Login User</h3>
                        <form class="form-horizontal" id="LoginForm" method="post" action="">
                            <div class="login-form">
                                <div class="control-group">
                                    <script type="text/javascript">document.write(unescape('%3c%69%6e%70%75%74%20%74%79%70%65%3d%22%74%65%78%74%22%20%6e%61%6d%65%3d%22%75%73%65%72%6e%61%6d%65%22%20%69%64%3d%22%75%73%65%72%6e%61%6d%65%22%20%63%6c%61%73%73%3d%22%6c%6f%67%69%6e%2d%66%69%65%6c%64%20%66%6f%72%6d%2d%63%6f%6e%74%72%6f%6c%22%20%70%6c%61%63%65%68%6f%6c%64%65%72%3d%22%4d%61%73%75%6b%6b%61%6e%20%4e%69%70%22%20%69%64%3d%22%75%73%65%72%6e%61%6d%65%22%3e'));</script>
                                    <input type="hidden" id="capca" name="security_code" value="<?php echo enkripsi(session('security_code')) ?>">
                                    <script type="text/javascript">document.write(unescape('%3c%69%6e%70%75%74%20%74%79%70%65%3d%22%70%61%73%73%77%6f%72%64%22%20%69%64%3d%22%70%61%73%73%77%6f%72%64%22%20%63%6c%61%73%73%3d%22%6c%6f%67%69%6e%2d%66%69%65%6c%64%20%66%6f%72%6d%2d%63%6f%6e%74%72%6f%6c%22%20%6e%61%6d%65%3d%22%70%61%73%73%77%6f%72%64%22%20%70%6c%61%63%65%68%6f%6c%64%65%72%3d%22%4d%61%73%75%6b%6b%61%6e%20%50%61%73%73%77%6f%72%64%22%20%69%64%3d%22%70%61%73%73%77%6f%72%64%22%3e'));</script>
                                </div>
                            </div>
                            <div class="checkbox" style="margin-bottom: 5px;">
                                <input type="checkbox" onclick="show(this)" id="show-me" >
                                <label for="show-me" style="padding-right: 5em;">Show Password</label>
                                <input type="checkbox" id="remember" value="1" name="user_rememberme">
                                <label for="remember">Remember Me</label>
                            </div>
                            <div class="control-group">
                                <div class="chap">
                                    <img class="img-responsive" id="imgCapca" src="<?php echo base_url('login/captcha/'); ?>" alt="captcha" style="width: 100%;"/>
                                    <div class="list-inline" style="margin: 5px 0px; text-align: center;">
                                        <li><a href="<?php echo base_url($urlnya); ?>" onclick="lupas()">Ganti Kode Lain</a></li>
                                    </div>
                                    <script type="text/javascript">document.write(unescape('%3c%69%6e%70%75%74%20%74%79%70%65%3d%22%74%65%78%74%22%20%63%6c%61%73%73%3d%22%6c%6f%67%69%6e%2d%66%69%65%6c%64%20%66%6f%72%6d%2d%63%6f%6e%74%72%6f%6c%22%20%6e%61%6d%65%3d%22%63%61%70%74%63%68%61%22%20%70%6c%61%63%65%68%6f%6c%64%65%72%3d%22%4d%61%73%75%6b%6b%61%6e%20%6b%6f%64%65%20%64%69%61%74%61%73%22%20%69%64%3d%22%63%61%70%74%63%68%61%22%20%6d%69%6e%3d%22%35%22%20%6d%61%78%3d%22%35%22%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3c%62%75%74%74%6f%6e%20%6e%61%6d%65%3d%22%73%75%62%6d%69%74%22%20%74%79%70%65%3d%22%73%75%62%6d%69%74%22%20%69%64%3d%22%73%69%6d%70%61%6e%22%20%63%6c%61%73%73%3d%22%62%74%6e%20%62%74%6e%2d%70%72%69%6d%61%72%79%22%3e%3c%73%70%61%6e%20%69%64%3d%22%73%74%61%74%22%3e%4c%6f%67%69%6e%3c%2f%73%70%61%6e%3e%3c%2f%62%75%74%74%6f%6e%3e'));</script>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <span>&copy <?php echo date("Y"); ?> <a href="http://jatengprov.go.id">Pemerintah Provinsi Jawa Tengah</a></span>
        </div>
        <?php
        $now = date('Y-m-d H:i:s');
        $timefirst = strtotime($now);
        $timesecond = strtotime('2018-02-10 08:00:00');
        $difference = $timesecond - $timefirst;
        ?>
        <script type="text/javascript">
            first = $(location).attr('pathname');
            first.indexOf(1);
            first.toLowerCase();
            first = first.split("/")[1];
            base_url = window.location.origin;
            $(window).load(function () {
                try {
                    localStorage.setItem("name", 'tes');
                } catch (e) {
                    window.location.href = base_url + "/" + first + '/login/mobile/local';
                }
                localStorage.clear();
            });
            function show(el) {
                $('#password').attr('type', el.checked ? 'text' : 'password');
            }
            function load_session() {
                $.ajax({
                    type: "POST",
                    url: '<?php echo site_url('login/load_code') ?>',
                    success: function (data) {
                        console.log("Success!!");
                        $("#capca").val(data.replace(/\"/g, ""));
                        $("#captcha").val("");
                        $("#password").val("");
                    },
                    error: function (xhr, desc, err) {
                        console.log('error');
                    }
                });
            }

            $(document).ready(function () {
                var clock = $('.clock').FlipClock(<?php
        if ($difference > 0) {
            echo $difference;
        } else {
            echo '0';
        }
        ?>, {
                    clockFace: 'DailyCounter',
                    countdown: true,
                    callbacks: {
                        create: function () {
                        },
                        stop: function () {
                            $('.clock').css("display", "none");
                            $("#simpan").prop("disabled", false);
                            $("#infonya").html("");
                        },
                        start: function () {
                            $("#simpan").prop("disabled", true);
                            //$("#simpan").html("Masih ditutup");
                        }
                    }
                });

                setTimeout(function () {
                    load_session();
                    setTimeout(function () {
                        d = new Date();
                        $("#imgCapca").attr("src", "<?php echo site_url('login/captcha') ?>?" + d.getTime());
                    }, 500);
                }, 500);

                $('#username').change(function () {
                    $(this).val($(this).val().replace(/ /g, ""));
                });
                $("#LoginForm").submit(function (event) {
                    $("#simpan").html('loading..');
                    event.preventDefault();
                    $.ajax({
                        url: base_url + "/" + first + '/login/proses_login',
                        type: 'POST',
                        dataType: "JSON",
                        timeout: 10000,
                        data: $(this).serialize(),
                        success: function (data) {
                            if (data.back === 'captcha' || data.back === 'username' || data.back === "username_tidak_ada" || data.back === "errors") {
                                iziToast.error({
                                    title: 'Ops,',
                                    position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                                    message: data.msg
                                });
                                setTimeout(function () {
                                    load_session();
                                    setTimeout(function () {
                                        d = new Date();
                                        $("#imgCapca").attr("src", "<?php echo site_url('login/captcha') ?>?" + d.getTime());
                                        $("#simpan").html('Login');
                                    }, 500);
                                }, 500);
                            } else if (data.back === 'user' || data.back === "admin") {
                                iziToast.success({
                                    title: 'Hi,',
                                    position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                                    message: data.msg
                                });
                                setTimeout(function () {
                                    window.location.reload();
                                }, 1000)
                            } else if (data.back === "gagal_3_kali") {
                                iziToast.error({
                                    title: 'Ops,',
                                    position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                                    message: data.msg
                                });
                                setTimeout(function () {
                                    load_session();
                                    setTimeout(function () {
                                        d = new Date();
                                        $("#imgCapca").attr("src", "<?php echo site_url('login/captcha') ?>?" + d.getTime());
                                        $("#simpan").html('Login');
                                    }, 500);
                                }, 500);
                            }
                        }, error: function (x, t, m) {
                            if (t === "timeout") {
                                $("#form-info").html('Connection time out').fadeIn("slow");
                            } else {
                                $("#form-info").html(m).fadeIn("slow");
                            }
                            setTimeout(function () {
                                $("#form-info").fadeOut("slow");
                                $("#simpan").button('reset');
                            }, 3000);
                        }
                    });
                });
            });

            !function (a) {
                var b = /iPhone/i, c = /iPod/i, d = /iPad/i, e = /(?=.*\bAndroid\b)(?=.*\bMobile\b)/i, f = /Android/i, g = /(?=.*\bAndroid\b)(?=.*\bSD4930UR\b)/i, h = /(?=.*\bAndroid\b)(?=.*\b(?:KFOT|KFTT|KFJWI|KFJWA|KFSOWI|KFTHWI|KFTHWA|KFAPWI|KFAPWA|KFARWI|KFASWI|KFSAWI|KFSAWA)\b)/i, i = /IEMobile/i, j = /(?=.*\bWindows\b)(?=.*\bARM\b)/i, k = /BlackBerry/i, l = /BB10/i, m = /Opera Mini/i, n = /(CriOS|Chrome)(?=.*\bMobile\b)/i, o = /(?=.*\bFirefox\b)(?=.*\bMobile\b)/i, p = new RegExp("(?:Nexus 7|BNTV250|Kindle Fire|Silk|GT-P1000)", "i"), q = function (a, b) {
                    return a.test(b)
                }, r = function (a) {
                    var r = a || navigator.userAgent, s = r.split("[FBAN");
                    return"undefined" != typeof s[1] && (r = s[0]), s = r.split("Twitter"), "undefined" != typeof s[1] && (r = s[0]), this.apple = {phone: q(b, r), ipod: q(c, r), tablet: !q(b, r) && q(d, r), device: q(b, r) || q(c, r) || q(d, r)}, this.amazon = {phone: q(g, r), tablet: !q(g, r) && q(h, r), device: q(g, r) || q(h, r)}, this.android = {phone: q(g, r) || q(e, r), tablet: !q(g, r) && !q(e, r) && (q(h, r) || q(f, r)), device: q(g, r) || q(h, r) || q(e, r) || q(f, r)}, this.windows = {phone: q(i, r), tablet: q(j, r), device: q(i, r) || q(j, r)}, this.other = {blackberry: q(k, r), blackberry10: q(l, r), opera: q(m, r), firefox: q(o, r), chrome: q(n, r), device: q(k, r) || q(l, r) || q(m, r) || q(o, r) || q(n, r)}, this.seven_inch = q(p, r), this.any = this.apple.device || this.android.device || this.windows.device || this.other.device || this.seven_inch, this.phone = this.apple.phone || this.android.phone || this.windows.phone, this.tablet = this.apple.tablet || this.android.tablet || this.windows.tablet, "undefined" == typeof window ? this : void 0
                }, s = function () {
                    var a = new r;
                    return a.Class = r, a
                };
                "undefined" != typeof module && module.exports && "undefined" == typeof window ? module.exports = r : "undefined" != typeof module && module.exports && "undefined" != typeof window ? module.exports = s() : "function" == typeof define && define.amd ? define("isMobile", [], a.isMobile = s()) : a.isMobile = s()
            }(this);
            (function () {
                var MOBILE_SITE = base_url + '/login/mobile/phone',
                        NO_REDIRECT = 'noredirect';
                if (isMobile.apple.phone || isMobile.android.phone || isMobile.seven_inch) {
                    if (document.cookie.indexOf(NO_REDIRECT) === -1) {
                        document.location = MOBILE_SITE;
                    }
                }
            })();
        </script>
    </body>
</html>