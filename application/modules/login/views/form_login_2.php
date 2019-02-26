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
        <link href="<?php echo css('welcome.css'); ?>" rel="stylesheet">

        <script src="<?php echo js('jquery-1.11.0.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('bootstrap.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('flipclock.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('jquery.webticker.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo js('iziToast.min.js'); ?>" type="text/javascript"></script>
    </head>
    <body class="body-login">
        <div class="screen">
            <div class="row">
                <div class="col-xs-8 kiri">
                    <div class="circle-head">
                        <span class="s-circle"></span>
                        <span class="m-circle"></span>
                        <span class="b-circle"></span>
                    </div>
                    <header>
                        <img src="<?php echo image('jateng.png') ?>" alt="">
                        <h3>PEMERINTAH PROVINSI JAWA TENGAH <span>Government Resources Management System</span></h3>
                    </header>

                    <div class="content-kiri">
                        <span>epenatausahaan</span>
                        <h1>2018</h1>
                        <a href="<?php echo base_url() ?>" class="pindah hvr-bounce-in hidden">Ganti Tahun</a>
                    </div>

                    <div class="timer">
                        <div id="jams"></div>
                    </div>
                    <?php if (@$info->informasi != "") { ?>
                        <footer>
                            <ul id="infoApp" style="background-color: #eee;">
                                <?php
                                $infos = explode("#", $info->informasi);
                                if (@$info->informasi != "") {
                                    foreach ($infos as $row => $key) {
                                        ?>
                                        <li style="font-size: 22px; color: #008fe2"><?php echo $key; ?> &nbsp;&nbsp;<img width="17" height="17" src="<?php echo image('logo.png') ?>" /></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </footer>
                    <?php } ?>
                </div>
                <div class="col-xs-4 kanan">
                    <div class="content-kanan">
                        <div class="row">
                            <div class="col-xs-10 col-xs-offset-1">
                                <h1>LOGIN USER</h1>
                                <form role="form" id="LoginForm">
                                    <div class="form-group">
                                        <select name="jenis" class="form-control" id="jenis_login">
                                            <option data-url="<?php echo ($_SERVER['SERVER_NAME'] != 'localhost' ? 'https://' . $_SERVER['SERVER_NAME'] . "/" . date("Y") . '/login/' : 'http://localhost/epenv1/login/'); ?>" value="perubahan">Anggaran Perubahan</option>
                                            <option data-url="<?php echo ($_SERVER['SERVER_NAME'] != 'localhost' ? 'https://' . $_SERVER['SERVER_NAME'] . "/" . date("Y") . '/murni/login/' : 'http://localhost/epenv1/murni/login/'); ?>" value="Murni">Anggaran Murni (Cetak)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan NIP Anda">
                                    </div>
                                    <input type="hidden" id="capca" name="security_code" value="<?php echo session('security_code') ?>">
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                                        <label class="show-pass"><input type="checkbox" onclick="show(this)" id="show-me"> Show Password</label>
                                    </div>
                                    <div class="chaptca">
                                        <img class="img-responsive" alt="captcha" id="imgCapca"/>
                                        <a href="<?php echo base_url($urlnya); ?>">Ganti Kode Lain</a>
                                        <input type="text" name="captcha" class="form-control" placeholder="Masukkan Kode Disini">
                                    </div>
                                    <label class="remember-me"><input type="checkbox"> Remember me</label>
                                    <button type="submit" id="simpan" class="btn btn btn-login pull-right hvr-bounce-in">Log In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <footer>
                        <a href="https://grms.jatengprov.go.id" target="_blank">
                            <h5>Government Resources Management System</h5>
                        </a>
                    </footer>
                </div>
            </div>
        </div>
        <?php
        $now = date('Y-m-d H:i:s');
        $timefirst = strtotime($now);
        $timesecond = strtotime('2017-07-30 08:00:00');
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

            function load_session(url) {
                $.ajax({
                    type: "POST",
                    url: url,
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
                $('#infoApp').webTicker({speed: 100});
                var clock = $('#jam').FlipClock(<?php
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
                        }
                    }
                });

                setTimeout(function () {
                    url = $("#jenis_login :selected").attr("data-url");
                    load_session(url + "load_code");
                    $("#LoginForm").attr("action", url + "/proses_login");
                    setTimeout(function () {
                        d = new Date();
                        $("#imgCapca").attr("src", url + "/captcha?" + d.getTime());
                        $("#simpan").html('Login');
                    }, 500);
                }, 500);

                $("#jenis_login").change(function () {
                    url = $("#jenis_login :selected").attr("data-url");
                    $("#LoginForm").attr("action", url + "/proses_login");
                    setTimeout(function () {
                        load_session(url + "/load_code");
                        setTimeout(function () {
                            d = new Date();
                            $("#imgCapca").attr("src", url + "/captcha?" + d.getTime());
                        }, 1000);
                    }, 500);
                });

                $('#username').change(function () {
                    $(this).val($(this).val().replace(/ /g, ""));
                });
                $("#LoginForm").submit(function (event) {
                    $("#simpan").html('loading..');
                    event.preventDefault();
                    $.ajax({
                        url: $("#LoginForm").attr("action"),
                        type: 'POST',
                        dataType: "JSON",
                        timeout: 10000,
                        data: $(this).serialize(),
                        beforeSend: function () {
                            $('.screen').removeClass('animated shake');
                        },
                        success: function (data) {
                            if (data.back === 'captcha' || data.back === 'username' || data.back === "username_tidak_ada" || data.back === "errors") {
                                iziToast.error({
                                    title: 'Ops,',
                                    position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                                    message: data.msg,
                                    timeout: 30000
                                });
                                setTimeout(function () {
                                    url = $("#jenis_login :selected").attr("data-url");
                                    load_session(url + "load_code");
                                    $("#LoginForm").attr("action", url + "/proses_login");
                                    setTimeout(function () {
                                        d = new Date();
                                        $("#imgCapca").attr("src", url + "/captcha?" + d.getTime());
                                        $("#simpan").html('Login');
                                    }, 500);
                                }, 500);
                                $('.screen').addClass('animated shake');
                            } else if (data.back === 'user' || data.back === "admin") {
                                iziToast.success({
                                    title: 'Hi,',
                                    position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                                    message: data.msg
                                });
                                setTimeout(function () {
                                    url = $("#jenis_login :selected").attr("data-url");
                                    window.location.href = url;
                                }, 1000)
                            } else if (data.back === "gagal_3_kali") {
                                iziToast.error({
                                    title: 'Ops,',
                                    position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                                    message: data.msg
                                });
                                setTimeout(function () {
                                    url = $("#jenis_login :selected").attr("data-url");
                                    load_session(url + "load_code");
                                    $("#LoginForm").attr("action", url + "/proses_login");
                                    setTimeout(function () {
                                        d = new Date();
                                        $("#imgCapca").attr("src", url + "/captcha?" + d.getTime());
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
