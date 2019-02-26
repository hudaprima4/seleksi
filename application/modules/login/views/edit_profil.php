<style type="text/css">
    body {background: #EAEAEA;}
    .user-details {position: relative; padding: 0;}
    .user-details .user-image {position: relative;  z-index: 1; width: 100%; text-align: center;}
    .user-image img { clear: both; margin: auto; position: relative;}

    .user-details .user-info-block {width: 100%; position: absolute; top: 55px; background: rgb(255, 255, 255); z-index: 0; padding-top: 35px;}
    .user-info-block .user-heading {width: 100%; text-align: center; margin: 10px 0 0;}
    .user-info-block .navigation {float: left; width: 100%; margin: 0; padding: 0; list-style: none; border-bottom: 1px solid #428BCA; border-top: 1px solid #428BCA;}
    .navigation li {margin: 0; padding: 0;}
    .navigation li a {padding: 20px 30px; float: left;}
    .navigation li.active a {background: #428BCA; color: #fff;}
    .user-info-block .user-body {float: left; padding: 5%; width: 90%;}
    .user-body .tab-content > div {float: left; width: 100%;}
    .user-body .tab-content h4 {width: 100%; margin: 10px 0; color: #333;}
    .fancybox-close{display: none;}
    .glyphicon {  margin-bottom: 10px;margin-right: 10px;}
</style>
<div class="col-sm-4 col-md-4 user-details" style="min-width: 600px; min-height: 500px">
    <div class="user-image">
        <img width="100" height="100" src="<?php echo image('profil.jpg'); ?>" alt="Karan Singh Sisodia" title="Karan Singh Sisodia" class="img-circle">
    </div>
    <div class="user-info-block">
        <div class="user-heading">
            <h3><?php echo session('nama'); ?></h3>
            <span class="help-block"><?php echo session('pegawai_nip'); ?></span>
        </div>
        <ul class="navigation">
            <li class="active">
                <a data-toggle="tab" href="#information">
                    <span class="glyphicon glyphicon-user"></span>
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#settings">
                    <span class="glyphicon glyphicon-cog"></span>
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#email">
                    <span class="glyphicon glyphicon-envelope"></span>
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#events">
                    <span class="glyphicon glyphicon-calendar"></span>
                </a>
            </li>
            <li class="pull-right">
                <a data-toggle="tab" title="Close" onclick="$.fancybox.close()">
                    <span class="fa fa-close"></span>
                </a>
            </li>
        </ul>
        <div class="user-body">
            <div class="tab-content">
                <div id="information" class="tab-pane active">
                    <h4>
                        <?php echo session('nama'); ?></h4>
                    <small><cite title="San Francisco, USA">San Francisco, USA <i class="glyphicon glyphicon-map-marker">
                            </i></cite></small>
                    <p>
                        <i class="glyphicon glyphicon-envelope"></i>email@example.com
                        <br />
                        <i class="glyphicon glyphicon-globe"></i><a href="http://www.jquery2dotnet.com">www.jquery2dotnet.com</a>
                        <br />
                        <i class="glyphicon glyphicon-gift"></i>June 02, 1988</p>
                    <!-- Split button -->
                </div>
                <div id="settings" class="tab-pane">
                    <h4>Settings</h4>
                </div>
                <div id="email" class="tab-pane">
                    <h4>Send Message</h4>
                </div>
                <div id="events" class="tab-pane">
                    <h4>Events</h4>
                </div>
            </div>
        </div>
    </div>
</div>