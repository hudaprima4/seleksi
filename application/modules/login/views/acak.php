<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Let's start GRMS</title>
        <link href="<?php echo css('bootstrap.min.css'); ?>" rel="stylesheet">
        <link rel="icon" type="image/png" href="<?php echo image('favicon.png'); ?>">
        <link href="<?php echo css('font-awesome.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo css('style.css'); ?>" rel="stylesheet">
        <script type=text/javascript src=https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js></script>
        <script type=text/javascript>
            shuffle = function (o) {
                for (var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
                return o;
            };

            String.prototype.hashCode = function () {
                var hash = 5381;
                for (i = 0; i < this.length; i++) {
                    char = this.charCodeAt(i);
                    hash = ((hash << 5) + hash) + char;
                    hash = hash & hash; // Convert to 32bit integer
                }
                return hash;
            };

            Number.prototype.mod = function (n) {
                return ((this % n) + n) % n;
            };
        </script>
        <script type=text/javascript>
            venues = {
                "116208": "Wande",
                "66271": "Ahmad Baund",
                "5518": "Tri Purnomo",
                "392360": "Afita",
                "2210952": "Putar",
                "207306": "Huda Prima",
                "41457": "Umar Ashidiqi",
                "101161": "Nur Zakaria",
                "257424": "Harjuna",
                "512060": "Mas Galih",
                "66244": "Mas Susi",
                "352867": "Kiki",
                "22493": "Angga Reza",
                "268052": "Pak Hono",
                "5665": "Mas Ardho",
                "129724": "Pak Habibi",
                "42599": "Cahya"
            };

            $(function () {
                var venueContainer = $('#venues ul');
                $.each(venues, function (key, item) {
                    venueContainer.append(
                            $(document.createElement("li"))
                            .append(
                                    $(document.createElement("input")).attr({
                                id: 'venue-' + key
                                , name: item
                                , value: item
                                , type: 'checkbox'
                                , checked: true
                            })
                                    .change(function () {
                                        var cbox = $(this)[0];
                                        var segments = wheel.segments;
                                        var i = segments.indexOf(cbox.value);

                                        if (cbox.checked && i == -1) {
                                            segments.push(cbox.value);

                                        } else if (!cbox.checked && i != -1) {
                                            segments.splice(i, 1);
                                        }

                                        segments.sort();
                                        wheel.update();
                                    })

                                    ).append(
                            $(document.createElement('label')).attr({
                        'for': 'venue-' + key
                    })
                            .text(item)
                            )
                            )
                });

                $('#venues ul>li').tsort("input", {attr: "value"});
            });
        </script>
        <script type=text/javascript>// WHEEL!
            var wheel = {
                timerHandle: 0,
                timerDelay: 33,
                angleCurrent: 0,
                angleDelta: 0,
                size: 240,
                canvasContext: null,
                colors: ['#ffff00', '#ffc700', '#ff9100', '#ff6301', '#ff0000', '#c6037e',
                    '#713697', '#444ea1', '#2772b2', '#0297ba', '#008e5b', '#8ac819'],
                //segments : [ 'Andrew', 'Bob', 'Fred', 'John', 'China', 'Steve', 'Jim', 'Sally', 'Andrew', 'Bob', 'Fred', 'John', 'China', 'Steve', 'Jim'],
                segments: [],
                seg_colors: [], // Cache of segments to colors

                maxSpeed: Math.PI / 16,
                upTime: 2000, // How long to spin up for (in ms)
                downTime: 27000, // How long to slow down for (in ms)

                spinStart: 0,
                frames: 0,
                centerX: 300,
                centerY: 300,
                spin: function () {
                    // Start the wheel only if it's not already spinning
                    if (wheel.timerHandle == 0) {
                        wheel.spinStart = new Date().getTime();
                        wheel.maxSpeed = Math.PI / (16 + Math.random()); // Randomly vary how hard the spin is
                        wheel.frames = 0;
                        wheel.sound.play();

                        wheel.timerHandle = setInterval(wheel.onTimerTick, wheel.timerDelay);
                    }
                },
                onTimerTick: function () {
                    wheel.frames++;
                    wheel.draw();

                    var duration = (new Date().getTime() - wheel.spinStart);
                    var progress = 0;
                    var finished = false;

                    if (duration < wheel.upTime) {
                        progress = duration / wheel.upTime;
                        wheel.angleDelta = wheel.maxSpeed
                                * Math.sin(progress * Math.PI / 2);
                    } else {
                        progress = duration / wheel.downTime;
                        wheel.angleDelta = wheel.maxSpeed
                                * Math.sin(progress * Math.PI / 2 + Math.PI / 2);
                        if (progress >= 1)
                            finished = true;
                    }

                    wheel.angleCurrent += wheel.angleDelta;
                    while (wheel.angleCurrent >= Math.PI * 2)
                        // Keep the angle in a reasonable range
                        wheel.angleCurrent -= Math.PI * 2;

                    if (finished) {
                        clearInterval(wheel.timerHandle);
                        wheel.timerHandle = 0;
                        wheel.angleDelta = 0;

                        $("#counter").html((wheel.frames / duration * 1000) + " FPS");
                        wheel.sound.pause();
                        wheel.sound.currentTime = 0;
                    }


                    // Display RPM
                    var rpm = (wheel.angleDelta * (1000 / wheel.timerDelay) * 60) / (Math.PI * 2);
                    $("#counter").html(Math.round(rpm) + " RPM");

                },
                init: function (optionList) {
                    try {
                        wheel.initWheel();
                        wheel.initAudio();
                        wheel.initCanvas();
                        wheel.draw();

                        $.extend(wheel, optionList);

                    } catch (exceptionData) {
                        alert('Wheel is not loaded ' + exceptionData);
                    }

                },
                initAudio: function () {
                    var sound = document.createElement('audio');
                    sound.setAttribute('src', '<?php echo base_url('files/drum.mp3') ?>');
                    wheel.sound = sound;
                },
                initCanvas: function () {
                    var canvas = $('#wheel #canvas').get(0);

                    if ($.browser.msie) {
                        canvas = document.createElement('canvas');
                        $(canvas).attr('width', 1000).attr('height', 600).attr('id', 'canvas').appendTo('.wheel');
                        canvas = G_vmlCanvasManager.initElement(canvas);
                    }

                    canvas.addEventListener("click", wheel.spin, false);
                    wheel.canvasContext = canvas.getContext("2d");
                },
                initWheel: function () {
                    shuffle(wheel.colors);
                },
                // Called when segments have changed
                update: function () {
                    // Ensure we start mid way on a item
                    //var r = Math.floor(Math.random() * wheel.segments.length);
                    var r = 0;
                    wheel.angleCurrent = ((r + 0.5) / wheel.segments.length) * Math.PI * 2;

                    var segments = wheel.segments;
                    var len = segments.length;
                    var colors = wheel.colors;
                    var colorLen = colors.length;

                    // Generate a color cache (so we have consistant coloring)
                    var seg_color = new Array();
                    for (var i = 0; i < len; i++)
                        seg_color.push(colors [ segments[i].hashCode().mod(colorLen) ]);

                    wheel.seg_color = seg_color;

                    wheel.draw();
                },
                draw: function () {
                    wheel.clear();
                    wheel.drawWheel();
                    wheel.drawNeedle();
                },
                clear: function () {
                    var ctx = wheel.canvasContext;
                    ctx.clearRect(0, 0, 1000, 800);
                },
                drawNeedle: function () {
                    var ctx = wheel.canvasContext;
                    var centerX = wheel.centerX;
                    var centerY = wheel.centerY;
                    var size = wheel.size;

                    ctx.lineWidth = 1;
                    ctx.strokeStyle = '#5bc0de';
                    ctx.fileStyle = '#ffffff';

                    ctx.beginPath();

                    ctx.moveTo(centerX + size - 40, centerY);
                    ctx.lineTo(centerX + size + 20, centerY - 10);
                    ctx.lineTo(centerX + size + 20, centerY + 10);
                    ctx.closePath();

                    ctx.stroke();
                    ctx.fill();

                    // Which segment is being pointed to?
                    var i = wheel.segments.length - Math.floor((wheel.angleCurrent / (Math.PI * 2)) * wheel.segments.length) - 1;

                    // Now draw the winning name
                    ctx.textAlign = "left";
                    ctx.textBaseline = "middle";
                    ctx.fillStyle = '#d9534f';
                    ctx.font = "3em Arial";
                    ctx.fillText(wheel.segments[i], centerX + size + 25, centerY);
                },
                drawSegment: function (key, lastAngle, angle) {
                    var ctx = wheel.canvasContext;
                    var centerX = wheel.centerX;
                    var centerY = wheel.centerY;
                    var size = wheel.size;

                    var segments = wheel.segments;
                    var len = wheel.segments.length;
                    var colors = wheel.seg_color;

                    var value = segments[key];

                    ctx.save();
                    ctx.beginPath();

                    // Start in the centre
                    ctx.moveTo(centerX, centerY);
                    ctx.arc(centerX, centerY, size, lastAngle, angle, false); // Draw a arc around the edge
                    ctx.lineTo(centerX, centerY); // Now draw a line back to the centre

                    // Clip anything that follows to this area
                    //ctx.clip(); // It would be best to clip, but we can double performance without it
                    ctx.closePath();

                    ctx.fillStyle = colors[key];
                    ctx.fill();
                    ctx.stroke();

                    // Now draw the text
                    ctx.save(); // The save ensures this works on Android devices
                    ctx.translate(centerX, centerY);
                    ctx.rotate((lastAngle + angle) / 2);

                    ctx.fillStyle = '#fff';
                    ctx.fillText(value.substr(0, 20), size / 2 + 20, 0);
                    ctx.restore();

                    ctx.restore();
                },
                drawWheel: function () {
                    var ctx = wheel.canvasContext;

                    var angleCurrent = wheel.angleCurrent;
                    var lastAngle = angleCurrent;

                    var segments = wheel.segments;
                    var len = wheel.segments.length;
                    var colors = wheel.colors;
                    var colorsLen = wheel.colors.length;

                    var centerX = wheel.centerX;
                    var centerY = wheel.centerY;
                    var size = wheel.size;

                    var PI2 = Math.PI * 2;

                    ctx.lineWidth = 1;
                    ctx.strokeStyle = '#5bc0de';
                    ctx.textBaseline = "middle";
                    ctx.textAlign = "center";
                    ctx.font = "1.4em Arial";

                    for (var i = 1; i <= len; i++) {
                        var angle = PI2 * (i / len) + angleCurrent;
                        wheel.drawSegment(i - 1, lastAngle, angle);
                        lastAngle = angle;
                    }
                    // Draw a center circle
                    ctx.beginPath();
                    ctx.arc(centerX, centerY, 20, 0, PI2, false);
                    ctx.closePath();

                    ctx.fillStyle = '#ffffff';
                    ctx.strokeStyle = '#5bc0de';
                    ctx.fill();
                    ctx.stroke();

                    // Draw outer circle
                    ctx.beginPath();
                    ctx.arc(centerX, centerY, size, 0, PI2, false);
                    ctx.closePath();

                    ctx.lineWidth = 10;
                    ctx.strokeStyle = '#5bc0de';
                    ctx.stroke();
                },
            }

            window.onload = function () {
                wheel.init();

                var segments = new Array();
                $.each($('#venues input:checked'), function (key, cbox) {
                    segments.push(cbox.value);
                });

                wheel.segments = segments;
                wheel.update();

                // Hide the address bar (for mobile devices)!
                setTimeout(function () {
                    window.scrollTo(0, 1);
                }, 0);
            };
        </script>
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
                        <img src="<?php echo image('logo_text.png'); ?>" alt="logo" /> <h3></h3>
                    </a>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-12" style="width: 100%;">
                    <center>
                        <h2>Who will be the next speaker at Sharing of Technology ?</h2>
                    </center>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div id="venues" style="margin-top: 35%;">
                        <div class="checkbox checkbox-success">
                            <ul/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 text-center">
                    <div id="wheel" style="margin-top: -4%; text-align: center;">
                        <canvas id="canvas" width=900 height=600></canvas>
                    </div>
                </div>
                <div id="stats">
                    <div id="counter"></div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <span>&copy 2014 <a href="http://jatengprov.go.id">Pemerintah Provinsi Jawa Tengah</a></span>
        </div>
    </body>
</html>
