$(function () {
    window.paceOptions = {
        ajax: {
            trackMethods: ['GET', 'POST', 'PUT', 'DELETE', 'REMOVE']
        }
    };
    window.convertToRupiahJs = function (angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 === 0)
                rupiah += angkarev.substr(i, 3) + '.';
        return rupiah.split('', rupiah.length - 1).reverse().join('');
    }

});
function tes() {
    $.ajax({
        type: 'GET',
        url: 'http://localhost/epen/Notifikasi',
        data: {get_param: 'value'},
        dataType: 'json',
        success: function (data) {
            var spp = data.spp[0].jumlah_spp;
            var sp2d = data.sp2d[0].jumlah_sp2d;
            var lpj = data.lpj[0].jumlah_lpj;
            var cek_spp = localStorage.getItem('spp');
            if (cek_spp === null) {
                localStorage.setItem('spp', spp);
            } else {
                var spp_baru = spp - cek_spp;
                if (spp_baru !== 0) {
                    localStorage.setItem('spp', spp);
                }
            }
            var cek_sp2d = localStorage.getItem('sp2d');
            var cek_lpj = localStorage.getItem('lpj');
            localStorage.setItem('sp2d', sp2d);
            localStorage.setItem('lpj', lpj);
            
             var cek_spp = localStorage.getItem('spp');
                if (cek_spp === null) {
                    localStorage.setItem('spp', spp);
                    $("#spp_jum").text(localStorage.getItem('spp'));
                } else {
                    var spp_baru = spp - cek_spp;
                    if (spp_baru !== 0) {
                        localStorage.setItem('spp', spp);
                        $("#spp_jum").text(localStorage.getItem('spp'));
                    }
                }

                var cek_sp2d = localStorage.getItem('sp2d');
                if (cek_sp2d === null) {
                    localStorage.setItem('sp2d', sp2d);
                    $("#sp2d_jum").text(localStorage.getItem('sp2d'));
                } else {
                    var sp2d_baru = sp2d - cek_sp2d;
                    if (sp2d_baru !== 0) {
                        localStorage.setItem('sp2d', sp2d);
                        $("#sp2d_jum").text(localStorage.getItem('sp2d'));
                    }
                }

                var cek_lpj = localStorage.getItem('lpj');
                if (cek_lpj === null) {
                    localStorage.setItem('lpj', lpj);
                    $("#lpj_jum").text(localStorage.getItem('lpj'));
                } else {
                    var lpj_baru = lpj - cek_lpj;
                    if (lpj !== 0) {
                        localStorage.setItem('lpj', lpj);
                        $("#lpj_jum").text(localStorage.getItem('lpj'));
                    }
                }


//            $.notify({
//                title: "<strong>Info</strong>",
//                message: "Hai, Selamat Datang di <b>E-Penatausahaan</b>",
//                animate: {
//                    enter: 'animated bounceInDown',
//                    exit: 'animated bounceOutUp'
//                },
//                allow_dismiss: true,
//                offset: {
//                    x: 0,
//                    y: 0
//                }
//            });
        }
    });
}
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('9b98690532b2cac5c23b', {
    encrypted: true
});
var channel = pusher.subscribe('test_channel');

channel.bind('pusher:subscription_succeeded', function () {
    setInterval(function () {
        tes();
    }, 5000);
});
(function ($, F) {
    // Opening animation - fly from the top
    F.transitions.dropIn = function () {
        var endPos = F._getPosition(true);

        endPos.top = (parseInt(endPos.top, 10) - 200) + 'px';
        endPos.opacity = 0;

        F.wrap.css(endPos).show().animate({
            top: '+=200px',
            opacity: 1
        }, {
            duration: F.current.openSpeed,
            complete: F._afterZoomIn
        });
    };

    // Closing animation - fly to the top
    F.transitions.dropOut = function () {
        F.wrap.removeClass('fancybox-opened').animate({
            top: '-=200px',
            opacity: 0
        }, {
            duration: F.current.closeSpeed,
            complete: F._afterZoomOut
        });
    };

    // Next gallery item - fly from left side to the center
    F.transitions.slideIn = function () {
        var endPos = F._getPosition(true);

        endPos.left = (parseInt(endPos.left, 10) - 200) + 'px';
        endPos.opacity = 0;

        F.wrap.css(endPos).show().animate({
            left: '+=200px',
            opacity: 1
        }, {
            duration: F.current.nextSpeed,
            complete: F._afterZoomIn
        });
    };

    // Current gallery item - fly from center to the right
    F.transitions.slideOut = function () {
        F.wrap.removeClass('fancybox-opened').animate({
            left: '+=200px',
            opacity: 0
        }, {
            duration: F.current.prevSpeed,
            complete: function () {
                $(this).trigger('onReset').remove();
            }
        });
    };

}(jQuery, jQuery.fancybox));
$(document).ready(function () {
    Pace.on("start", function () {
        $(".loading").show();
    });

    Pace.on("done", function () {
        $(".loading").hide();
    });

    $(".editor-disable").summernote('disable');
    $(".editor").summernote({
        toolbar: [
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['view', ['fullscreen', 'codeview']],
        ]
    });
    $('[id]').each(function () {
        var ids = $('[id="' + this.id + '"]');
        if (ids.length > 1 && ids[0] == this)
            console.warn('ID yang sama terdeteksi, yaitu : #' + this.id + " -- ada " + ids.length);
    });
//    $(".btn").tooltipster({
//            animation: 'grow',
//            delay: 200,
//            maxWidth: 800,
//            side: 'top'
//        });
    $(".tahun_tgl").datepicker({
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months",
        autoclose: true
    });

    $('#tanggal').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });
//
//    $('.tooltip').tooltipster({
//        animation: 'swing'
//    });
//    $('.tooltipicon').tooltipster({
//        iconDesktop: true,
//        iconTouch: true,
//        animation: 'swing'
//    });
    $('#nip').on('keyup', function () {
        var urlbaru = $('#url').data('alamat');
        $("#nip").autocomplete({
            minLength: 2,
            source:
                    function (req, add) {
                        $.ajax({
                            url: urlbaru,
                            dataType: 'json',
                            type: 'POST',
                            data: req,
                            success: function (data) {
                                if (data.response === "true") {
                                    add(data.message);
                                } else {
                                    add(data.value);
                                }
                            }
                        });
                    }, select: function (event, ui) {
                $("#nip").val(ui.item.value);
                $("#nama").val(ui.item.nama);
                $("#skpd").val(ui.item.skpd);
                $("#unit").val(ui.item.unit);
                $("#org_key").val(ui.item.org_key);
            }
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li>")
                    .append("<a><strong>" + item.value + "</strong><br>" + "<span style='margin-left:20px'>" + item.nama + "</span>" + "</a>")
                    .appendTo(ul);
        };
    });

    $('#nama').on('keyup', function () {
        var urlbaru = $('#url').data('alamat');
        $("#nama").autocomplete({
            minLength: 2,
            source:
                    function (req, add) {
                        $.ajax({
                            url: urlbaru,
                            dataType: 'json',
                            type: 'POST',
                            data: req,
                            success: function (data) {
                                if (data.response === "true") {
                                    add(data.message);
                                } else {
                                    add(data.value);
                                }
                            }
                        });
                    }, select: function (event, ui) {
                $("#nama").val(ui.item.value);
                $("#bentuk").val(ui.item.bentuk);
                $("#alamat").val(ui.item.alamat);
                $("#pimpinan").val(ui.item.pimpinan);
                $("#npwp").val(ui.item.npwp);
                $("#nama_bank").val(ui.item.nama_bank);
                $("#kantor_cabang").val(ui.item.kantor_cabang);
                $("#nama_pemilik").val(ui.item.nama_pemilik);
                $("#norek").val(ui.item.norek);
            }
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li>")
                    .append("<a><strong>" + item.value + "</strong><br>" + "<span style='margin-left:20px'>" + item.value + "</span>" + "</a>")
                    .appendTo(ul);
        };
    });

    $('.pilih').on("click", function (e) {
        $.fancybox.showLoading();
        e.preventDefault();
        $.ajax({
            type: "POST",
            cache: false,
            url: this.href,
            data: $(this).serializeArray(),
            success: function (data) {
                $.fancybox(data, {
                    helpers: {
                        overlay: {
                            // fancybox API options
                            fitToView: false,
                            minWidth: 600,
                            maxWidth: "80%",
                            minHeight: 600,
                            maxHeight: "80%",
                            autoSize: false,
                            openMethod: 'dropIn',
                            openSpeed: 250,
                            closeMethod: 'dropOut',
                            closeSpeed: 250,
                            nextMethod: 'slideIn',
                            nextSpeed: 250,
                            prevMethod: 'slideOut',
                            prevSpeed: 250,
                            closeClick: false
                        }
                    }
                });
            }
        });
    });

    $(".fanBox").fancybox({
        openMethod: 'dropIn',
        openSpeed: 250,
        closeMethod: 'dropOut',
        closeSpeed: 250,
        nextMethod: 'slideIn',
        nextSpeed: 250,
        prevMethod: 'slideOut',
        prevSpeed: 250,
//        afterClose: function () {
//            parent.location.reload(true);
//        },
        keys: {
            close: null
        },
        helpers: {
            overlay: {closeClick: false}
        }
    });

    var oTable = $('.dTable').DataTable({
        "processing": true,
        "paging": true,
        "ordering": true,
        "info": false,
        "bFilter": true,
        "bLengthChange": false,
        "iDisplayLength": 8,
        "deferLoading": 57,
        "language": {
            "zeroRecords": "Maaf data tidak ditemukan!",
            "infoEmpty": "Data yang dicari tidak ditemukan!"
        },
        "fnDrawCallback": function () {
            if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1) {
                $('.dataTables_paginate').css("display", "block");
                $('.dataTables_length').css("display", "block");
                $('.dataTables_filter').css("display", "block");
            } else {
                $('.dataTables_paginate').css("display", "none");
                $('.dataTables_length').css("display", "none");
                $('.dataTables_filter').css("display", "none");
            }
        },
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                    );

                            column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                        });

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        }
    });

    $('input[name=cari]').keyup(function (e) {
        value = $(this).val();
        var minlength = 3;
        if (value.length >= minlength && e.keyCode === 13) {
            oTable.search(this.value).draw();
        } else if (value.length === 0) {
            oTable.search(this.value).draw();
        }
    });

    $('.tanggal').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });

    $('#dp1').datepicker({autoclose: true});
    $('#dp2').datepicker({autoclose: true});
    $('#dpTahun').datepicker({autoclose: true, startView: 2});

    // disabling dates
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var checkin = $('#dpd1').datepicker({
        onRender: function (date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function (ev) {
        if (ev.date.valueOf() > checkout.viewDate.valueOf()) {
            var newDate = new Date(ev.date);
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
        }
        checkin.hide();
        $('#dpd2')[0].focus();
    }).data('datepicker');

    var checkout = $('#dpd2').datepicker({
        onRender: function (date) {
            return date.valueOf() <= checkin.viewDate.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function (ev) {
        checkout.hide();
    }).data('datepicker');
});

function cetak2(url, width) {
    var params = 'width=' + width;
    params += ', height=' + screen.height;
    params += ', fullscreen=yes,scrollbars=yes';
    window.open(url, '_blank', params);
}

function cetak(url) {
    var w = 793.700787402;
    var h = 982.677165354;
    var left1 = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var top1 = window.screenTop != undefined ? window.screenTop : screen.top;
    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
    var left = ((width / 2) - (w / 2)) + left1;
    var top = ((height / 2) - (h / 2)) + top1;
    window.open(url, '_blank', 'bgcolor=white,fullscreen=yes,scrollbars=yes, location=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
}
function cetak_L(url) {
    var w = 982.677165354;
    var h = 793.700787402;
    var left1 = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var top1 = window.screenTop != undefined ? window.screenTop : screen.top;
    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
    var left = ((width / 2) - (w / 2)) + left1;
    var top = ((height / 2) - (h / 2)) + top1;
    window.open(url, '_blank', 'bgcolor=white,fullscreen=yes,scrollbars=yes, location=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
}

(function ($) {
    "use strict";
    $(document).ready(function () {
        /*==Left Navigation Accordion ==*/
        if ($.fn.dcAccordion) {
            $('#nav-accordion').dcAccordion({
                eventType: 'click',
                autoClose: true,
                saveState: true,
                disableLink: true,
                speed: 'slow',
                showCount: false,
                autoExpand: true,
                classExpand: 'dcjq-current-parent'
            });
        }
        /*==Slim Scroll ==*/
        if ($.fn.slimScroll) {
            $('.event-list').slimscroll({
                height: '305px',
                wheelStep: 20
            });
            $('.conversation-list').slimscroll({
                height: '360px',
                wheelStep: 35
            });
            $('.to-do-list').slimscroll({
                height: '300px',
                wheelStep: 35
            });
        }
        /*==Nice Scroll ==*/
        if ($.fn.niceScroll) {
            $(".leftside-navigation").niceScroll({
                cursorcolor: "#1FB5AD",
                cursorborder: "0px solid #fff",
                cursorborderradius: "0px",
                cursorwidth: "3px"
            });
            $(".leftside-navigation").getNiceScroll().resize();
            if ($('#sidebar').hasClass('hide-left-bar')) {
                $(".leftside-navigation").getNiceScroll().hide();
            }
            $(".leftside-navigation").getNiceScroll().show();
            $(".right-stat-bar").niceScroll({
                cursorcolor: "#1FB5AD",
                cursorborder: "0px solid #fff",
                cursorborderradius: "0px",
                cursorwidth: "3px"
            });
        }


        /*==Collapsible==*/
        $('.widget-head').click(function (e) {
            var widgetElem = $(this).children('.widget-collapse').children('i');

            $(this)
                    .next('.widget-container')
                    .slideToggle('slow');
            if ($(widgetElem).hasClass('ico-minus')) {
                $(widgetElem).removeClass('ico-minus');
                $(widgetElem).addClass('ico-plus');
            } else {
                $(widgetElem).removeClass('ico-plus');
                $(widgetElem).addClass('ico-minus');
            }
            e.preventDefault();
        });

        /*==Sidebar Toggle==*/
        $(".leftside-navigation .sub-menu > a").click(function () {
            var o = ($(this).offset());
            var diff = 80 - o.top;
            if (diff > 0)
                $(".leftside-navigation").scrollTo("-=" + Math.abs(diff), 500);
            else
                $(".leftside-navigation").scrollTo("+=" + Math.abs(diff), 500);
        });

        $('.sidebar-toggle-box .fa-bars').click(function (e) {
            $(".leftside-navigation").niceScroll({
                cursorcolor: "#1FB5AD",
                cursorborder: "0px solid #fff",
                cursorborderradius: "0px",
                cursorwidth: "3px"
            });

            $('#sidebar').toggleClass('hide-left-bar');
            if ($('#sidebar').hasClass('hide-left-bar')) {
                $(".leftside-navigation").getNiceScroll().hide();
            }
            $(".leftside-navigation").getNiceScroll().show();
            $('#main-content').toggleClass('merge-left');
            e.stopPropagation();
            if ($('#container').hasClass('open-right-panel')) {
                $('#container').removeClass('open-right-panel');
            }
            if ($('.right-sidebar').hasClass('open-right-bar')) {
                $('.right-sidebar').removeClass('open-right-bar');
            }

            if ($('.header').hasClass('merge-header')) {
                $('.header').removeClass('merge-header');
            }
        });

        $('.toggle-right-box .fa-bars').click(function (e) {
            $('#container').toggleClass('open-right-panel');
            $('.right-sidebar').toggleClass('open-right-bar');
            $('.header').toggleClass('merge-header');

            e.stopPropagation();
        });

        $('.header,#main-content,#sidebar').click(function () {
            if ($('#container').hasClass('open-right-panel')) {
                $('#container').removeClass('open-right-panel');
            }
            if ($('.right-sidebar').hasClass('open-right-bar')) {
                $('.right-sidebar').removeClass('open-right-bar');
            }

            if ($('.header').hasClass('merge-header')) {
                $('.header').removeClass('merge-header');
            }
        });


        $('.panel .tools .fa').click(function () {
            var el = $(this).parents(".panel").children(".panel-body");
            if ($(this).hasClass("fa-chevron-down")) {
                $(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
                el.slideUp(200);
            } else {
                $(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
                el.slideDown(200);
            }
        });

        $('.panel .tools .fa-times').click(function () {
            $(this).parents(".panel").parent().remove();
        });

        $('.tooltips').tooltip();
        $('.popovers').popover();


    });


})(jQuery);