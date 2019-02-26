(function (i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function () {
        (i[r].q = i[r].q || []).push(arguments);
    }, i[r].l = 1 * new Date();
    a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m);
})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

ga('create', 'UA-104967725-1', 'auto');
ga('send', 'pageview');
$(function () {
    $('#info_user').webTicker({speed: 100, duplicate: true});
    $("table").dragOn();
    var first = $(location).attr('pathname');
    first.indexOf(1);
    first.toLowerCase();
    first = first.split("/")[1];
    var base_url = window.location.origin;
    window.notifikasi = function (pesan) {
        iziToast.show({
            class: 'test',
            color: 'dark',
            title: "Informasi",
            message: pesan,
            position: 'topCenter',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            progressBarColor: 'rgb(0, 255, 184)',
            image: base_url + '/themes/images/logo.png',
            imageWidth: 60,
            timeout: 10000,
            layout: 2,
            iconColor: 'rgb(0, 255, 184)'
        });
    }

    $.fn.dropdown_datatable = function (options) {
        var settings = $.extend({
            id: null,
            id2: null,
            id3: null,
            judul: null,
            alamat: null,
            dataTable: {id: null, data: null, cari_class: null, cari_id: [], kolom: []},
            chart: {id: null, nama: "Data Chart"},
            status: {satu: "Draft", dua: "Final", tiga: "Ditolak", empat: null},
            complete: null
        }, options);
        function init_datatable() {
            table = $(settings.dataTable.id).DataTable({
                "retrieve": true,
                "processing": true,
                "paging": true,
                "ordering": true,
                "bFilter": true,
                "bSortClasses": false,
                "language": {
                    "zeroRecords": "Maaf data tidak ditemukan!",
                    "sSearch": "Cari Data: ",
                    "searchPlaceholder": "Cari data.."
                },
                "aaSorting": [],
                "fnDrawCallback": function () {
                    $('div.dataTables_filter input').addClass('form-control');
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
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [-1]
                    }
                ]
            });
            if (settings.dataTable.cari_id) {
                var data = settings.dataTable.cari_id;
                for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                    var odd = data[i];
                    var even = data[i + 1];
                    //console.log("$(" + odd + ").change(function () { table.columns(" + even + ").search(this.value).draw();})");
                    $(odd).on("change", function () {
                        table.search($(this).val()).draw();
                    });
                }
            }

            if (settings.dataTable.cari_class) {
                $(settings.dataTable.cari_class).change(function () {
                    table.search(this.value).draw();
                });
            }

            if (settings.status.satu && settings.status.dua) {
                draft = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                total = draft + final;
                persen_draft = (draft / (draft + final)) * 100;
                persen_final = (final / (draft + final)) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draft, val: draft}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }];
            }
            if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga !== "") {
                draft = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = draft + final + ditolak;
                persen_draft = (draft / (draft + final + ditolak)) * 100;
                persen_final = (final / (draft + final + ditolak)) * 100;
                persen_ditolak = (ditolak / (draft + final + ditolak)) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draft, val: draft}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua !== "" && settings.status.tiga !== "") {
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = final + ditolak;
                persen_final = (final / (final + ditolak)) * 100;
                persen_ditolak = (ditolak / (final + ditolak)) * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }];
            }
            if (settings.status.satu && settings.status.dua && settings.status.tiga && settings.status.empat) {
                draft = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                persiapan = table.rows('tr:has(td.persiapan)').count();
                total = draft + final + ditolak + persiapan;
                persen_draft = (draft / (draft + final + ditolak + persiapan)) * 100;
                persen_final = (final / (draft + final + ditolak + persiapan)) * 100;
                persen_ditolak = (ditolak / (draft + final + ditolak + persiapan)) * 100;
                persen_persiapan = (persiapan / (draft + final + ditolak + persiapan)) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draft, val: draft}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_persiapan, val: persiapan}],
                        color: '#777'

                                //color: '#dcdcdc'
                    }];
            }
        }

        function init_chart() {
            var nama_skpd = '';
            if ($(settings.id + " :selected").text() == 'Anda Belum Mengampu SKPD') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == 'Data Unit Masih Kosong') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == '') {
                nama_skpd = '';
            } else {
                nama_skpd = $(settings.id + " :selected").text();
            }
            ;
            new Highcharts.Chart({
                chart: {
                    type: 'bar',
                    renderTo: settings.chart.id
                },
                title: {
                    text: settings.chart.nama + '<br>' + nama_skpd
                },
                xAxis: {
                    categories: ['Data']
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    tickInterval: 5,
                    title: {
                        text: 'Total Data : <b>' + total + ' < /b>' + settings.chart.nama
                    },
                    labels: {
                        formatter: function () {
                            return this.value + '%';
                        }
                    }
                },
                legend: {
                    reversed: true
                },
                plotOptions: {
                    series: {
                        stacking: 'normal',
                        pointWidth: 80
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    valueSuffix: '',
                    formatter: function () {
                        return "<b>" + this.point.val + " " + settings.chart.nama + " " + this.series.name + " (" + Math.round(this.point.y * 100) / 100 + "%)</b>";
                    }
                },
                series: series_data
            });
        }

        $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));
        var id = $(settings.id + " :selected").val();
        if (id === undefined) {
            id = "";
        }
        if (settings.alamat) {
            $(settings.dataTable.data).slideUp(500, function () {
                $(settings.dataTable.data).load(settings.alamat + "/" + id).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 2000);
                    if (settings.dataTable.cari_id) {
                        var data = settings.dataTable.cari_id;
                        for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                            var odd = data[i];
                            var even = data[i + 1];
                            $(odd).on("change", function () {
                                table.search($(this).val()).draw();
                            });
                        }
                    }
                    if (settings.dataTable.cari_class) {
                        $(settings.dataTable.cari_class).change(function () {
                            table.search(this.value).draw();
                        });
                    }
                });
            });
        }


        $(this).on("change", function () {
            $(settings.dataTable.data).empty();
            table.destroy();
            var id = $(settings.id + " :selected").val();
            var url = settings.alamat + "/" + id;
            if (settings.id2) {
                var id2 = $(settings.id2 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/";
            }
            if (settings.id2 && settings.id3) {
                var id2 = $(settings.id2 + " :selected").val();
                var id3 = $(settings.id3 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/" + id3;
            }
            if (settings.alamat && settings.dataTable.data) {
                $(settings.dataTable.data).load(url).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                });
            }
            if ($.isFunction(settings.complete)) {
                settings.complete.call(this);
            }
            $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));
        });
    };

    $.fn.dropdown_datatable_sp3b = function (options) {
        var sdraf = '#f0ad4e'; //draf
        var spending = '#dcdcdc'; //pending
        var sfinal = '#5cb85c'; //final
        var sditolak = '#d9534f'; //ditolak
        var sdiverifikasi = '#46b8da'; //diverifikasi

        var settings = $.extend({
            id: null,
            id2: null,
            id3: null,
            id4: null,
            id5: null,
            judul: null,
            alamat: null,
            dataTable: {id: null, data: null, cari_class: null, cari_id: [], kolom: []},
            chart: {id: null, nama: "Data Chart"},
            status: {satu: "Draf", dua: "Pending", tiga: "Final", empat: "Ditolak", lima: "Diverifikasi"},
            complete: null
        }, options);
        function init_datatable() {
            table = $(settings.dataTable.id).DataTable({
                "retrieve": true,
                "processing": true,
                "paging": true,
                "ordering": true,
                "bFilter": true,
                "bSortClasses": false,
                "language": {
                    "zeroRecords": "Maaf data tidak ditemukan!",
                    "sSearch": "Cari Data: ",
                    "searchPlaceholder": "Cari data.."
                },
                "aaSorting": [],
                "fnDrawCallback": function () {
                    $('div.dataTables_filter input').addClass('form-control');
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
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [-1]
                    }
                ]
            });
            if (settings.dataTable.cari_id) {
                var data = settings.dataTable.cari_id;
                for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                    var odd = data[i];
                    var even = data[i + 1];
                    //console.log("$(" + odd + ").change(function () { table.columns(" + even + ").search(this.value).draw();})");
                    $(odd).on("change", function () {
                        table.search($(this).val()).draw();
                    });
                }
            }

            if (settings.dataTable.cari_class) {
                $(settings.dataTable.cari_class).change(function () {
                    table.search(this.value).draw();
                });
            }
            //satu: "Draft", dua: "Pending", tiga: "Final", empat: 'Ditolak', lima: 'Diverifikasi'
            //draf
            if (settings.status.satu) {
                draf = table.rows('tr:has(td.draf)').count();
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: 100, val: draf}],
                        color: sdraf
                    }];
            }
            //pending
            if (settings.status.dua) {
                pending = table.rows('tr:has(td.pending)').count();
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: 100, val: pending}],
                        color: spending
                    }];
            }
            //final
            if (settings.status.tiga) {
                final = table.rows('tr:has(td.final)').count();
                series_data = [
                    {
                        name: settings.status.tiga,
                        data: [{y: 100, val: final}],
                        color: sfinal
                    }];
            }
            //ditolak
            if (settings.status.empat) {
                ditolak = table.rows('tr:has(td.ditolak)').count();
                series_data = [
                    {
                        name: settings.status.empat,
                        data: [{y: 100, val: ditolak}],
                        color: sditolak
                    }];
            }
            //diverifikasi
            if (settings.status.lima) {
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                series_data = [
                    {
                        name: settings.status.lima,
                        data: [{y: 100, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //draf dan diverifikasi
            if (settings.status.satu && settings.status.lima) {
                draf = table.rows('tr:has(td.draf)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = draf + diverifikasi;
                persen_draf = (draf / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: sdraf
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //pending dan diverifikasi
            if (settings.status.dua && settings.status.lima) {
                pending = table.rows('tr:has(td.pending)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = pending + diverifikasi;
                persen_pending = (pending / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_pending, val: pending}],
                        color: spending
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //final dan diverifikasi
            if (settings.status.tiga && settings.status.lima) {
                final = table.rows('tr:has(td.final)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = final + diverifikasi;
                persen_final = (final / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.tiga,
                        data: [{y: persen_final, val: final}],
                        color: sfinal
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //ditolak dan diverifikasi
            if (settings.status.empat && settings.status.lima) {
                ditolak = table.rows('tr:has(td.ditolak)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = ditolak + diverifikasi;
                persen_ditolak = (ditolak / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.empat,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: sditolak
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //draf, final, diverifikasi
            if (settings.status.satu && settings.status.tiga && settings.status.lima) {
                draf = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = draf + final + diverifikasi;
                persen_draf = (draf / total) * 100;
                persen_final = (final / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: sdraf
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_final, val: final}],
                        color: sfinal
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //pending, final dan diverifikasi
            if (settings.status.dua && settings.status.tiga && settings.status.lima) {
                pending = table.rows('tr:has(td.pending)').count();
                final = table.rows('tr:has(td.final)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = pending + final + diverifikasi;
                persen_pending = (pending / total) * 100;
                persen_final = (final / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_pending, val: pending}],
                        color: spending
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_final, val: final}],
                        color: sfinal
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //draf, ditolak, diverifikasi
            if (settings.status.satu && settings.status.empat && settings.status.lima) {
                draf = table.rows('tr:has(td.draf)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = draf + ditolak + diverifikasi;
                persen_draf = (draf / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: sdraf
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: sditolak
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //pending, ditolak, diverifikasi
            if (settings.status.dua && settings.status.empat && settings.status.lima) {
                pending = table.rows('tr:has(td.pending)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = pending + ditolak + diverifikasi;
                persen_pending = (pending / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_pending, val: pending}],
                        color: spending
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: sditolak
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //final, ditolak, diverifikasi
            if (settings.status.tiga && settings.status.empat && settings.status.lima) {
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = final + ditolak + diverifikasi;
                persen_final = (final / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.tiga,
                        data: [{y: persen_final, val: final}],
                        color: sfinal
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: sditolak
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //draf, pending, diverifikasi
            if (settings.status.satu && settings.status.dua && settings.status.lima) {
                draf = table.rows('tr:has(td.draf)').count();
                pending = table.rows('tr:has(td.pending)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = draf + pending + diverifikasi;
                persen_draf = (draf / total) * 100;
                persen_pending = (pending / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: sdraf
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_pending, val: pending}],
                        color: spending
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //final, pending, diverifikasi
            if (settings.status.tiga && settings.status.dua && settings.status.lima) {
                final = table.rows('tr:has(td.final)').count();
                pending = table.rows('tr:has(td.pending)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = final + pending + diverifikasi;
                persen_final = (final / total) * 100;
                persen_pending = (pending / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.tiga,
                        data: [{y: persen_final, val: final}],
                        color: sfinal
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_pending, val: pending}],
                        color: spending
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //draf, pending, final, diverifikasi
            if (settings.status.satu && settings.status.dua && settings.status.tiga && settings.status.lima) {
                draf = table.rows('tr:has(td.draf)').count();
                pending = table.rows('tr:has(td.pending)').count();
                final = table.rows('tr:has(td.final)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = draf + pending + final + diverifikasi;
                persen_draf = (draf / total) * 100;
                persen_pending = (pending / total) * 100;
                persen_final = (final / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: sdraf
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_pending, val: pending}],
                        color: spending
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_final, val: final}],
                        color: sfinal
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //draf, pending, ditolak, diverifikasi
            if (settings.status.satu && settings.status.dua && settings.status.empat && settings.status.lima) {
                draf = table.rows('tr:has(td.draf)').count();
                pending = table.rows('tr:has(td.pending)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = draf + pending + ditolak + diverifikasi;
                persen_draf = (draf / total) * 100;
                persen_pending = (pending / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: sdraf
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_pending, val: pending}],
                        color: spending
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: sditolak
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //draf, pending, final, ditolak, diverifikasi
            if (settings.status.satu && settings.status.dua && settings.status.tiga && settings.status.empat && settings.status.lima) {
                draf = table.rows('tr:has(td.draf)').count();
                pending = table.rows('tr:has(td.pending)').count();
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = draf + pending + final + ditolak + diverifikasi;
                persen_draf = (draf / total) * 100;
                persen_pending = (pending / total) * 100;
                persen_final = (final / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: sdraf
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_pending, val: pending}],
                        color: spending
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_final, val: final}],
                        color: sfinal
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: sditolak
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
        }

        function init_chart() {
            var nama_skpd = '';
            if ($(settings.id + " :selected").text() == 'Anda Belum Mengampu SKPD') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == 'Data Unit Masih Kosong') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == '') {
                nama_skpd = '';
            } else {
                nama_skpd = $(settings.id + " :selected").text();
            }
            new Highcharts.Chart({
                chart: {
                    type: 'bar',
                    renderTo: settings.chart.id
                },
                title: {
                    text: settings.chart.nama + '<br>' + nama_skpd
                },
                xAxis: {
                    categories: ['Data']
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    tickInterval: 5,
                    title: {
                        text: 'Total Data : <b>' + total + ' < /b>' + settings.chart.nama
                    },
                    labels: {
                        formatter: function () {
                            return this.value + '%';
                        }
                    }
                },
                legend: {
                    reversed: true
                },
                plotOptions: {
                    series: {
                        stacking: 'normal',
                        pointWidth: 80
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    valueSuffix: '',
                    formatter: function () {
                        return "<b>" + this.point.val + " " + settings.chart.nama + " " + this.series.name + " (" + Math.round(this.point.y * 100) / 100 + "%)</b>";
                    }
                },
                series: series_data
            });
        }

        $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));
        var id = $(settings.id + " :selected").val();
        var url = settings.alamat + "/" + id;
        if (settings.id2) {
            var id2 = $(settings.id2 + " :selected").val();
            var url = settings.alamat + "/" + id + "/" + id2 + "/";
        }
        if (settings.id2 && settings.id3) {
            var id2 = $(settings.id2 + " :selected").val();
            var id3 = $(settings.id3 + " :selected").val();
            var url = settings.alamat + "/" + id + "/" + id2 + "/" + id3;
        }
        if (settings.alamat) {
            $(settings.dataTable.data).slideUp(500, function () {
                $(settings.dataTable.data).load(url).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                    if (settings.dataTable.cari_id) {
                        var data = settings.dataTable.cari_id;
                        for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                            var odd = data[i];
                            var even = data[i + 1];
                            $(odd).on("change", function () {
                                table.search($(this).val()).draw();
                            });
                        }
                    }
                    if (settings.dataTable.cari_class) {
                        $(settings.dataTable.cari_class).change(function () {
                            table.search(this.value).draw();
                        });
                    }
                });
            });
        }


        $(this).on("change", function () {
            $(settings.dataTable.data).empty();
            table.destroy();
            var id = $(settings.id + " :selected").val();
            var url = settings.alamat + "/" + id;
            if (settings.id2) {
                var id2 = $(settings.id2 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/";
            }
            if (settings.id2 && settings.id3) {
                var id2 = $(settings.id2 + " :selected").val();
                var id3 = $(settings.id3 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/" + id3;
            }
            if (settings.alamat && settings.dataTable.data) {
                $(settings.dataTable.data).load(url).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                });
            }
            if ($.isFunction(settings.complete)) {
                settings.complete.call(this);
            }
            $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));
        });
    };

    $.fn.dropdown_datatable_koreksi_blud = function (options) {
        var sdraf = '#f0ad4e'; //draf
        var sfinal = '#5cb85c'; //final
        var sditolak = '#d9534f'; //ditolak
        var sdiverifikasi = '#46b8da'; //diverifikasi

        var settings = $.extend({
            id: null,
            id2: null,
            id3: null,
            id4: null,
            judul: null,
            alamat: null,
            dataTable: {id: null, data: null, cari_class: null, cari_id: [], kolom: []},
            chart: {id: null, nama: "Data Chart"},
            status: {satu: "Draf", dua: "Final", tiga: "Ditolak", empat: "Diverifikasi"},
            complete: null
        }, options);
        function init_datatable() {
            table = $(settings.dataTable.id).DataTable({
                "retrieve": true,
                "processing": true,
                "paging": true,
                "ordering": true,
                "bFilter": true,
                "bSortClasses": false,
                "language": {
                    "zeroRecords": "Maaf data tidak ditemukan!",
                    "sSearch": "Cari Data: ",
                    "searchPlaceholder": "Cari data.."
                },
                "aaSorting": [],
                "fnDrawCallback": function () {
                    $('div.dataTables_filter input').addClass('form-control');
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
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [-1]
                    }
                ]
            });
            if (settings.dataTable.cari_id) {
                var data = settings.dataTable.cari_id;
                for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                    var odd = data[i];
                    var even = data[i + 1];
                    //console.log("$(" + odd + ").change(function () { table.columns(" + even + ").search(this.value).draw();})");
                    $(odd).on("change", function () {
                        table.search($(this).val()).draw();
                    });
                }
            }

            if (settings.dataTable.cari_class) {
                $(settings.dataTable.cari_class).change(function () {
                    table.search(this.value).draw();
                });
            }

            //draf
            if (settings.status.satu) {
                draf = table.rows('tr:has(td.draf)').count();
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: 100, val: draf}],
                        color: sdraf
                    }];
            }
            //final
            if (settings.status.dua) {
                final = table.rows('tr:has(td.final)').count();
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: 100, val: final}],
                        color: sfinal
                    }];
            }
            //ditolak
            if (settings.status.tiga) {
                ditolak = table.rows('tr:has(td.ditolak)').count();
                series_data = [
                    {
                        name: settings.status.tiga,
                        data: [{y: 100, val: ditolak}],
                        color: sditolak
                    }];
            }
            //diverifikasi
            if (settings.status.empat) {
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                series_data = [
                    {
                        name: settings.status.empat,
                        data: [{y: 100, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //draf, final
            if (settings.status.satu && settings.status.dua) {
                draf = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                total = draf + final;
                persen_draf = (draf / total) * 100;
                persen_final = (final / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: sdraf
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: sfinal
                    }];
            }
            //draf, ditolak
            if (settings.status.satu && settings.status.tiga) {
                draf = table.rows('tr:has(td.draf)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = draf + ditolak;
                persen_draf = (draf / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: sdraf
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: sditolak
                    }];
            }
            //draf, diverifikasi
            if (settings.status.satu && settings.status.empat) {
                draf = table.rows('tr:has(td.draf)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = draf + diverifikasi;
                persen_draf = (draf / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: sdraf
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //final, ditolak
            if (settings.status.dua && settings.status.tiga) {
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = final + diverifikasi;
                persen_final = (final / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: sfinal
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: sditolak
                    }];
            }
            //final, diverifikasi
            if (settings.status.dua && settings.status.empat) {
                final = table.rows('tr:has(td.final)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = final + diverifikasi;
                persen_final = (final / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: sfinal
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //draf, final, ditolak
            if (settings.status.satu && settings.status.dua && settings.status.tiga) {
                draf = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = draf + final + ditolak;
                persen_draf = (draf / total) * 100;
                persen_final = (final / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: sdraf
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: sfinal
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: sditolak
                    }];
            }
            //draf, final, diverifikasi
            if (settings.status.satu && settings.status.dua && settings.status.empat) {
                draf = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = draf + final + diverifikasi;
                persen_draf = (draf / total) * 100;
                persen_final = (final / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: sdraf
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: sfinal
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //final, ditolak, diverifikasi
            if (settings.status.dua && settings.status.tiga && settings.status.empat) {
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = final + ditolak + diverifikasi;
                persen_final = (final / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: sfinal
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: sditolak
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
            //draf, final, ditolak, diverifikasi
            if (settings.status.satu && settings.status.dua && settings.status.tiga && settings.status.empat) {
                draf = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = draf + final + ditolak + diverifikasi;
                persen_draf = (draf / total) * 100;
                persen_final = (final / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: sdraf
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: sfinal
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: sditolak
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: sdiverifikasi
                    }];
            }
        }

        function init_chart() {
            var nama_skpd = '';
            if ($(settings.id + " :selected").text() == 'Anda Belum Mengampu SKPD') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == 'Data Unit Masih Kosong') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == '') {
                nama_skpd = '';
            } else {
                nama_skpd = $(settings.id + " :selected").text();
            }
            new Highcharts.Chart({
                chart: {
                    type: 'bar',
                    renderTo: settings.chart.id
                },
                title: {
                    text: settings.chart.nama + '<br>' + nama_skpd
                },
                xAxis: {
                    categories: ['Data']
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    tickInterval: 5,
                    title: {
                        text: 'Total Data : <b>' + total + ' < /b>' + settings.chart.nama
                    },
                    labels: {
                        formatter: function () {
                            return this.value + '%';
                        }
                    }
                },
                legend: {
                    reversed: true
                },
                plotOptions: {
                    series: {
                        stacking: 'normal',
                        pointWidth: 80
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    valueSuffix: '',
                    formatter: function () {
                        return "<b>" + this.point.val + " " + settings.chart.nama + " " + this.series.name + " (" + Math.round(this.point.y * 100) / 100 + "%)</b>";
                    }
                },
                series: series_data
            });
        }

        $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));
        var id = $(settings.id + " :selected").val();
        var url = settings.alamat + "/" + id;
        if (settings.id2) {
            var id2 = $(settings.id2 + " :selected").val();
            var url = settings.alamat + "/" + id + "/" + id2 + "/";
        }
        if (settings.id2 && settings.id3) {
            var id2 = $(settings.id2 + " :selected").val();
            var id3 = $(settings.id3 + " :selected").val();
            var url = settings.alamat + "/" + id + "/" + id2 + "/" + id3;
        }
        if (settings.alamat) {
            $(settings.dataTable.data).slideUp(500, function () {
                $(settings.dataTable.data).load(url).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                    if (settings.dataTable.cari_id) {
                        var data = settings.dataTable.cari_id;
                        for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                            var odd = data[i];
                            var even = data[i + 1];
                            $(odd).on("change", function () {
                                table.search($(this).val()).draw();
                            });
                        }
                    }
                    if (settings.dataTable.cari_class) {
                        $(settings.dataTable.cari_class).change(function () {
                            table.search(this.value).draw();
                        });
                    }
                });
            });
        }


        $(this).on("change", function () {
            $(settings.dataTable.data).empty();
            table.destroy();
            var id = $(settings.id + " :selected").val();
            var url = settings.alamat + "/" + id;
            if (settings.id2) {
                var id2 = $(settings.id2 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/";
            }
            if (settings.id2 && settings.id3) {
                var id2 = $(settings.id2 + " :selected").val();
                var id3 = $(settings.id3 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/" + id3;
            }
            if (settings.alamat && settings.dataTable.data) {
                $(settings.dataTable.data).load(url).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                });
            }
            if ($.isFunction(settings.complete)) {
                settings.complete.call(this);
            }
            $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));
        });
    };

    $.fn.dropdown_datatable_cp = function (options) {
        var settings = $.extend({
            id: null,
            id2: null,
            id3: null,
            judul: null,
            alamat: null,
            dataTable: {id: null, data: null, cari_class: null, cari_id: [], kolom: []},
            chart: {id: null, nama: "Data Chart"},
            status: {satu: "Draf", dua: "Disetorkan", tiga: "Diterima", empat: "Ditolak", lima: null},
            complete: null
        }, options);
        function init_datatable() {
            table = $(settings.dataTable.id).DataTable({
                "retrieve": true,
                "processing": true,
                "paging": true,
                "ordering": true,
                "bFilter": true,
                "bSortClasses": false,
                "language": {
                    "zeroRecords": "Maaf data tidak ditemukan!",
                    "sSearch": "Cari Data: ",
                    "searchPlaceholder": "Cari data.."
                },
                "aaSorting": [],
                "fnDrawCallback": function () {
                    $('div.dataTables_filter input').addClass('form-control');
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
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [-1]
                    }
                ]
            });
            if (settings.dataTable.cari_id) {
                var data = settings.dataTable.cari_id;
                for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                    var odd = data[i];
                    var even = data[i + 1];
                    $(odd).on("change", function () {
                        table.search($(this).val()).draw();
                    });
                }
            }

            if (settings.dataTable.cari_class) {
                $(settings.dataTable.cari_class).change(function () {
                    table.search(this.value).draw();
                });
            }

            if (settings.status.satu && settings.status.dua) {//1 dan 2
                draf = table.rows('tr:has(td.draf)').count();
                disetorkan = table.rows('tr:has(td.disetorkan)').count();
                total = draf + disetorkan;
                persen_draf = (draf / total) * 100;
                persen_disetorkan = (disetorkan / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_disetorkan, val: disetorkan}],
                        color: '#269abc'
                    }];
            }

            //f0ad4e
            //269abc
            //d43f3a
            //5cb85c
            if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga !== "" && settings.status.empat !== "") {//1, 2, 3, 4
                draf = table.rows('tr:has(td.draf)').count();
                disetorkan = table.rows('tr:has(td.disetorkan)').count();
                diterima = table.rows('tr:has(td.diterima)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = draf + disetorkan + diterima + ditolak;
                persen_draf = (draf / total) * 100;
                persen_disetorkan = (disetorkan / total) * 100;
                persen_diterima = (diterima / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_disetorkan, val: disetorkan}],
                        color: '#269abc'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_diterima, val: diterima}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }];
            } else if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga !== "" && settings.status.empat === "") {//1, 2, 3
                draf = table.rows('tr:has(td.draf)').count();
                disetorkan = table.rows('tr:has(td.disetorkan)').count();
                diterima = table.rows('tr:has(td.diterima)').count();
                total = draf + disetorkan + diterima;
                persen_draf = (draf / total) * 100;
                persen_disetorkan = (disetorkan / total) * 100;
                persen_diterima = (diterima / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_disetorkan, val: disetorkan}],
                        color: '#269abc'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_diterima, val: diterima}],
                        color: '#5cb85c'
                    }];
            } else if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga === "" && settings.status.empat !== "") {//1, 2, 4
                draf = table.rows('tr:has(td.draf)').count();
                disetorkan = table.rows('tr:has(td.disetorkan)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = draf + disetorkan + ditolak;
                persen_draf = (draf / total) * 100;
                persen_disetorkan = (disetorkan / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_disetorkan, val: disetorkan}],
                        color: '#269abc'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }];
            } else if (settings.status.satu !== "" && settings.status.dua === "" && settings.status.tiga !== "" && settings.status.empat !== "") {//1, 3, 4
                draf = table.rows('tr:has(td.draf)').count();
                diterima = table.rows('tr:has(td.diterima)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = draf + diterima + ditolak;
                persen_draf = (draf / total) * 100;
                persen_diterima = (diterima / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_diterima, val: diterima}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua !== "" && settings.status.tiga !== "" && settings.status.empat !== "") {//2, 3, 4
                disetorkan = table.rows('tr:has(td.disetorkan)').count();
                diterima = table.rows('tr:has(td.diterima)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = disetorkan + diterima + ditolak;
                persen_disetorkan = (disetorkan / total) * 100;
                persen_diterima = (diterima / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_disetorkan, val: disetorkan}],
                        color: '#269abc'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_diterima, val: diterima}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }];
            } else if (settings.status.satu !== "" && settings.status.dua === "" && settings.status.tiga !== "" && settings.status.empat === "") {//1, 3
                draf = table.rows('tr:has(td.draf)').count();
                diterima = table.rows('tr:has(td.diterima)').count();
                total = draf + diterima;
                persen_draf = (draf / total) * 100;
                persen_diterima = (diterima / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_diterima, val: diterima}],
                        color: '#5cb85c'
                    }];
            } else if (settings.status.satu !== "" && settings.status.dua === "" && settings.status.tiga === "" && settings.status.empat !== "") {//1, 4
                draf = table.rows('tr:has(td.draf)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = draf + ditolak;
                persen_draf = (draf / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua !== "" && settings.status.tiga !== "" && settings.status.empat === "") {//2, 3
                disetorkan = table.rows('tr:has(td.disetorkan)').count();
                diterima = table.rows('tr:has(td.diterima)').count();
                total = disetorkan + diterima;
                persen_disetorkan = (disetorkan / total) * 100;
                persen_diterima = (diterima / total) * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_disetorkan, val: disetorkan}],
                        color: '#269abc'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_diterima, val: diterima}],
                        color: '#5cb85c'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua !== "" && settings.status.tiga === "" && settings.status.empat !== "") {//2, 4
                disetorkan = table.rows('tr:has(td.disetorkan)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = disetorkan + ditolak;
                persen_disetorkan = (disetorkan / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_disetorkan, val: disetorkan}],
                        color: '#269abc'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua === "" && settings.status.tiga !== "" && settings.status.empat !== "") {//3, 4
                diterima = table.rows('tr:has(td.diterima)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = diterima + ditolak;
                persen_diterima = (diterima / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                series_data = [
                    {
                        name: settings.status.tiga,
                        data: [{y: persen_diterima, val: diterima}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }];
            }
        }

        function init_chart() {
            var nama_skpd = '';
            if ($(settings.id + " :selected").text() == 'Anda Belum Mengampu SKPD') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == 'Data Unit Masih Kosong') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == '') {
                nama_skpd = '';
            } else {
                nama_skpd = $(settings.id + " :selected").text();
            }
            ;
            new Highcharts.Chart({
                chart: {
                    type: 'bar',
                    renderTo: settings.chart.id
                },
                title: {
                    text: settings.chart.nama + '<br>' + nama_skpd
                },
                xAxis: {
                    categories: ['Data']
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    tickInterval: 5,
                    title: {
                        text: 'Total Data : <b>' + total + ' < /b>' + settings.chart.nama
                    },
                    labels: {
                        formatter: function () {
                            return this.value + '%';
                        }
                    }
                },
                legend: {
                    reversed: true
                },
                plotOptions: {
                    series: {
                        stacking: 'normal',
                        pointWidth: 80
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    valueSuffix: '',
                    formatter: function () {
                        return "<b>" + this.point.val + " " + settings.chart.nama + " " + this.series.name + " (" + Math.round(this.point.y * 100) / 100 + "%)</b>";
                    }
                },
                series: series_data
            });
        }

        $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));
        var id = $(settings.id + " :selected").val();
        if (id === undefined) {
            id = "";
        }
        if (settings.alamat) {
            $(settings.dataTable.data).slideUp(500, function () {
                $(settings.dataTable.data).load(settings.alamat + "/" + id).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                    if (settings.dataTable.cari_id) {
                        var data = settings.dataTable.cari_id;
                        for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                            var odd = data[i];
                            var even = data[i + 1];
                            $(odd).on("change", function () {
                                table.search($(this).val()).draw();
                            });
                        }
                    }
                    if (settings.dataTable.cari_class) {
                        $(settings.dataTable.cari_class).change(function () {
                            table.search(this.value).draw();
                        });
                    }
                });
            });
        }


        $(this).on("change", function () {
            $(settings.dataTable.data).empty();
            table.destroy();
            var id = $(settings.id + " :selected").val();
            var url = settings.alamat + "/" + id;
            if (settings.id2) {
                var id2 = $(settings.id2 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/";
            }
            if (settings.id2 && settings.id3) {
                var id2 = $(settings.id2 + " :selected").val();
                var id3 = $(settings.id3 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/" + id3;
            }
            if (settings.alamat && settings.dataTable.data) {
                $(settings.dataTable.data).load(url).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                });
            }
            if ($.isFunction(settings.complete)) {
                settings.complete.call(this);
            }
            $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));
        });
    };

    $.fn.dropdown_datatable_jurnal_koreksi = function (options) {
        var settings = $.extend({
            id: null,
            id2: null,
            id3: null,
            judul: null,
            alamat: null,
            dataTable: {id: null, data: null, cari_class: null, cari_id: [], kolom: []},
            chart: {id: null, nama: "Data Chart"},
            status: {satu: "Draf", dua: "Ditolak", tiga: "Final", empat: null},
            complete: null
        }, options);
        function init_datatable() {
            table = $(settings.dataTable.id).DataTable({
                "retrieve": true,
                "processing": true,
                "paging": true,
                "ordering": true,
                "bFilter": true,
                "bSortClasses": false,
                "language": {
                    "zeroRecords": "Maaf data tidak ditemukan!",
                    "sSearch": "Cari Data: ",
                    "searchPlaceholder": "Cari data.."
                },
                "aaSorting": [],
                "fnDrawCallback": function () {
                    $('div.dataTables_filter input').addClass('form-control');
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
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [-1]
                    }
                ]
            });
            if (settings.dataTable.cari_id) {
                var data = settings.dataTable.cari_id;
                for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                    var odd = data[i];
                    var even = data[i + 1];
                    $(odd).on("change", function () {
                        table.search($(this).val()).draw();
                    });
                }
            }

            if (settings.dataTable.cari_class) {
                $(settings.dataTable.cari_class).change(function () {
                    table.search(this.value).draw();
                });
            }

            if (settings.status.satu && settings.status.tiga) {//1 dan 3
                draf = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                total = draf + final;
                persen_draf = (draf / total) * 100;
                persen_final = (final / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }];
            }
            if (settings.status.satu !== "" && settings.status.dua === "" && settings.status.tiga === "") {//draf
                draf = table.rows('tr:has(td.draf)').count();
                persen_draf = draf * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#f0ad4e'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua !== "" && settings.status.tiga === "") {//ditolak
                ditolak = table.rows('tr:has(td.ditolak)').count();
                persen_ditolak = ditolak * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua === "" && settings.status.tiga !== "") {//final
                final = table.rows('tr:has(td.final)').count();
                persen_final = final * 100;
                series_data = [
                    {
                        name: settings.status.tiga,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }];
            } else if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga === "") {//draf dan ditolak
                draf = table.rows('tr:has(td.draf)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = draf + ditolak;
                persen_draf = (draf / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }];
            } else if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga !== "") {//draf, ditolak, final
                draf = table.rows('tr:has(td.draf)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                final = table.rows('tr:has(td.final)').count();
                total = draf + ditolak + final;
                persen_draf = (draf / total) * 100;
                persen_ditolak = (ditolak / total) * 100;
                persen_final = (final / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }];
            }
        }

        function init_chart() {
            var nama_skpd = '';
            if ($(settings.id + " :selected").text() == 'Anda Belum Mengampu SKPD') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == 'Data Unit Masih Kosong') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == '') {
                nama_skpd = '';
            } else {
                nama_skpd = $(settings.id + " :selected").text();
            }
            ;
            new Highcharts.Chart({
                chart: {
                    type: 'bar',
                    renderTo: settings.chart.id
                },
                title: {
                    text: settings.chart.nama + '<br>' + nama_skpd
                },
                xAxis: {
                    categories: ['Data']
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    tickInterval: 5,
                    title: {
                        text: 'Total Data : <b>' + total + ' < /b>' + settings.chart.nama
                    },
                    labels: {
                        formatter: function () {
                            return this.value + '%';
                        }
                    }
                },
                legend: {
                    reversed: true
                },
                plotOptions: {
                    series: {
                        stacking: 'normal',
                        pointWidth: 80
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    valueSuffix: '',
                    formatter: function () {
                        return "<b>" + this.point.val + " " + settings.chart.nama + " " + this.series.name + " (" + Math.round(this.point.y * 100) / 100 + "%)</b>";
                    }
                },
                series: series_data
            });
        }

        $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));
        var id = $(settings.id + " :selected").val();
        if (id === undefined) {
            id = "";
        }
        if (settings.alamat) {
            $(settings.dataTable.data).slideUp(500, function () {
                $(settings.dataTable.data).load(settings.alamat + "/" + id).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                    if (settings.dataTable.cari_id) {
                        var data = settings.dataTable.cari_id;
                        for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                            var odd = data[i];
                            var even = data[i + 1];
                            $(odd).on("change", function () {
                                table.search($(this).val()).draw();
                            });
                        }
                    }
                    if (settings.dataTable.cari_class) {
                        $(settings.dataTable.cari_class).change(function () {
                            table.search(this.value).draw();
                        });
                    }
                });
            });
        }


        $(this).on("change", function () {
            $(settings.dataTable.data).empty();
            table.destroy();
            var id = $(settings.id + " :selected").val();
            var url = settings.alamat + "/" + id;
            if (settings.id2) {
                var id2 = $(settings.id2 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/";
            }
            if (settings.id2 && settings.id3) {
                var id2 = $(settings.id2 + " :selected").val();
                var id3 = $(settings.id3 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/" + id3;
            }
            if (settings.alamat && settings.dataTable.data) {
                $(settings.dataTable.data).load(url).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                });
            }
            if ($.isFunction(settings.complete)) {
                settings.complete.call(this);
            }
            $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));
        });
    };

    $.fn.dropdown_datatable_bpen = function (options) {
        var settings = $.extend({
            id: null,
            id2: null,
            id3: null,
            judul: null,
            alamat: null,
            dataTable: {id: null, data: null, cari_class: null, cari_id: [], kolom: []},
            chart: {id: null, nama: "Data Chart"},
            status: {satu: "Draft", dua: "Final", tiga: "Ditolak", empat: null},
            complete: null
        }, options);
        function init_datatable() {
            table = $(settings.dataTable.id).DataTable({
                "retrieve": true,
                "processing": true,
                "paging": true,
                "ordering": true,
                "bFilter": true,
                "bSortClasses": false,
                scrollX: true,
                scrollCollapse: true,
                fixedColumns: {
                    leftColumns: 1,
                    rightColumns: 1
                },
                "language": {
                    "zeroRecords": "Maaf data tidak ditemukan!",
                    "sSearch": "Cari Data: ",
                    "searchPlaceholder": "Cari data.."
                },
                "aaSorting": [],
                "fnDrawCallback": function () {
                    $('div.dataTables_filter input').addClass('form-control');
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
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [-1]
                    }
                ],
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api(), data;
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                                i.replace(/[\$.]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                    };
                    pajak = api
                            .column(4)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                    retrubusi = api
                            .column(5)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                    lain = api
                            .column(6)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                    pageTotal = api
                            .column(4, {page: 'current'})
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                    $(api.column(4).footer()).html(
                            '<b>' + convertToRupiahJs(pajak) + '</b>'
                            );
                    $(api.column(5).footer()).html(
                            '<b>' + convertToRupiahJs(retrubusi) + '</b>'
                            );
                    $(api.column(6).footer()).html(
                            '<b>' + convertToRupiahJs(lain) + '</b>'
                            );
                }
            });
            if (settings.dataTable.cari_id) {
                var data = settings.dataTable.cari_id;
                for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                    var odd = data[i];
                    var even = data[i + 1];
                    //console.log("$(" + odd + ").change(function () { table.columns(" + even + ").search(this.value).draw();})");
                    $(odd).on("change", function () {
                        table.search($(this).val()).draw();
                    });
                }
            }

            if (settings.dataTable.cari_class) {
                $(settings.dataTable.cari_class).change(function () {
                    table.search(this.value).draw();
                });
            }

            if (settings.status.satu !== "" && settings.status.dua === "" && settings.status.tiga === "" && settings.status.empat === "" && settings.status.lima === "" && settings.status.enam === "" && settings.status.tujuh === "" && settings.status.delapan === "") {
                draf = table.rows('tr:has(td.draf)').count();
                total = draf;
                persen_draf = (draf / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#777'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua !== "" && settings.status.tiga === "" && settings.status.empat === "" && settings.status.lima === "" && settings.status.enam === "" && settings.status.tujuh === "" && settings.status.delapan === "") {
                pengajuan = table.rows('tr:has(td.pengajuan)').count();
                total = pengajuan;
                persen_pengajuan = (pengajuan / total) * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_pengajuan, val: pengajuan}],
                        color: '#286090'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua === "" && settings.status.tiga !== "" && settings.status.empat === "" && settings.status.lima === "" && settings.status.enam === "" && settings.status.tujuh === "" && settings.status.delapan === "") {
                pengajuan_disetujui = table.rows('tr:has(td.pengajuan_disetujui)').count();
                total = pengajuan_disetujui;
                persen_pengajuan_disetujui = (pengajuan_disetujui / total) * 100;
                series_data = [
                    {
                        name: settings.status.tiga,
                        data: [{y: persen_pengajuan_disetujui, val: pengajuan_disetujui}],
                        color: '#398439'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua === "" && settings.status.tiga === "" && settings.status.empat !== "" && settings.status.lima === "" && settings.status.enam === "" && settings.status.tujuh === "" && settings.status.delapan === "") {
                pengajuan_ditolak = table.rows('tr:has(td.pengajuan_ditolak)').count();
                total = pengajuan_ditolak;
                persen_pengajuan_ditolak = (pengajuan_ditolak / total) * 100;
                series_data = [
                    {
                        name: settings.status.empat,
                        data: [{y: persen_pengajuan_ditolak, val: pengajuan_ditolak}],
                        color: '#d43f3a'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua === "" && settings.status.tiga === "" && settings.status.empat === "" && settings.status.lima !== "" && settings.status.enam === "" && settings.status.tujuh === "" && settings.status.delapan === "") {
                rincian_tersimpan = table.rows('tr:has(td.rincian_tersimpan)').count();
                total = rincian_tersimpan;
                persen_rincian_tersimpan = (rincian_tersimpan / total) * 100;
                series_data = [
                    {
                        name: settings.status.lima,
                        data: [{y: persen_rincian_tersimpan, val: rincian_tersimpan}],
                        color: '#dff0d8'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua === "" && settings.status.tiga === "" && settings.status.empat === "" && settings.status.lima === "" && settings.status.enam !== "" && settings.status.tujuh === "" && settings.status.delapan === "") {
                menunggu_verifikasi = table.rows('tr:has(td.menunggu_verifikasi)').count();
                total = menunggu_verifikasi;
                persen_menunggu_verifikasi = (menunggu_verifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.enam,
                        data: [{y: persen_menunggu_verifikasi, val: menunggu_verifikasi}],
                        color: '#d58512'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua === "" && settings.status.tiga === "" && settings.status.empat === "" && settings.status.lima === "" && settings.status.enam === "" && settings.status.tujuh !== "" && settings.status.delapan === "") {
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                total = diverifikasi;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.tujuh,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: '#269abc'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua === "" && settings.status.tiga === "" && settings.status.empat === "" && settings.status.lima === "" && settings.status.enam === "" && settings.status.tujuh === "" && settings.status.delapan !== "") {
                rincian_ditolak = table.rows('tr:has(td.rincian_ditolak)').count();
                total = rincian_ditolak;
                persen_rincian_ditolak = (rincian_ditolak / total) * 100;
                series_data = [
                    {
                        name: settings.status.delapan,
                        data: [{y: persen_rincian_ditolak, val: rincian_ditolak}],
                        color: '#d43f3a'
                    }];
            } else if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga === "" && settings.status.empat === "" && settings.status.lima === "" && settings.status.enam === "" && settings.status.tujuh === "" && settings.status.delapan === "") {
                draf = table.rows('tr:has(td.draf)').count();
                pengajuan = table.rows('tr:has(td.pengajuan)').count();

                total = draf + pengajuan;

                persen_draf = (draf / total) * 100;
                persen_pengajuan = (pengajuan / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#777'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_pengajuan, val: pengajuan}],
                        color: '#286090'
                    }];
            } else if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga !== "" && settings.status.empat === "" && settings.status.lima === "" && settings.status.enam === "" && settings.status.tujuh === "" && settings.status.delapan === "") {
                draf = table.rows('tr:has(td.draf)').count();
                pengajuan = table.rows('tr:has(td.pengajuan)').count();
                pengajuan_disetujui = table.rows('tr:has(td.pengajuan_disetujui)').count();

                total = draf + pengajuan + pengajuan_disetujui;

                persen_draf = (draf / total) * 100;
                persen_pengajuan = (pengajuan / total) * 100;
                persen_pengajuan_disetujui = (pengajuan_disetujui / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#777'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_pengajuan, val: pengajuan}],
                        color: '#286090'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_pengajuan_disetujui, val: pengajuan_disetujui}],
                        color: '#398439'
                    }];
            } else if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga !== "" && settings.status.empat !== "" && settings.status.lima === "" && settings.status.enam === "" && settings.status.tujuh === "" && settings.status.delapan === "") {
                draf = table.rows('tr:has(td.draf)').count();
                pengajuan = table.rows('tr:has(td.pengajuan)').count();
                pengajuan_disetujui = table.rows('tr:has(td.pengajuan_disetujui)').count();
                pengajuan_ditolak = table.rows('tr:has(td.pengajuan_ditolak)').count();

                total = draf + pengajuan + pengajuan_disetujui + pengajuan_ditolak;

                persen_draf = (draf / total) * 100;
                persen_pengajuan = (pengajuan / total) * 100;
                persen_pengajuan_disetujui = (pengajuan_disetujui / total) * 100;
                persen_pengajuan_ditolak = (pengajuan_ditolak / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#777'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_pengajuan, val: pengajuan}],
                        color: '#286090'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_pengajuan_disetujui, val: pengajuan_disetujui}],
                        color: '#398439'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_pengajuan_ditolak, val: pengajuan_ditolak}],
                        color: '#d43f3a'
                    }];
            } else if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga !== "" && settings.status.empat !== "" && settings.status.lima !== "" && settings.status.enam === "" && settings.status.tujuh === "" && settings.status.delapan === "") {
                draf = table.rows('tr:has(td.draf)').count();
                pengajuan = table.rows('tr:has(td.pengajuan)').count();
                pengajuan_disetujui = table.rows('tr:has(td.pengajuan_disetujui)').count();
                pengajuan_ditolak = table.rows('tr:has(td.pengajuan_ditolak)').count();
                rincian_tersimpan = table.rows('tr:has(td.rincian_tersimpan)').count();

                total = draf + pengajuan + pengajuan_disetujui + pengajuan_ditolak + rincian_tersimpan;

                persen_draf = (draf / total) * 100;
                persen_pengajuan = (pengajuan / total) * 100;
                persen_pengajuan_disetujui = (pengajuan_disetujui / total) * 100;
                persen_pengajuan_ditolak = (pengajuan_ditolak / total) * 100;
                persen_rincian_tersimpan = (rincian_tersimpan / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#777'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_pengajuan, val: pengajuan}],
                        color: '#286090'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_pengajuan_disetujui, val: pengajuan_disetujui}],
                        color: '#398439'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_pengajuan_ditolak, val: pengajuan_ditolak}],
                        color: '#d43f3a'
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_rincian_tersimpan, val: rincian_tersimpan}],
                        color: '#dff0d8'
                    }];
            } else if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga !== "" && settings.status.empat !== "" && settings.status.lima !== "" && settings.status.enam !== "" && settings.status.tujuh === "" && settings.status.delapan === "") {
                draf = table.rows('tr:has(td.draf)').count();
                pengajuan = table.rows('tr:has(td.pengajuan)').count();
                pengajuan_disetujui = table.rows('tr:has(td.pengajuan_disetujui)').count();
                pengajuan_ditolak = table.rows('tr:has(td.pengajuan_ditolak)').count();
                rincian_tersimpan = table.rows('tr:has(td.rincian_tersimpan)').count();
                menunggu_verifikasi = table.rows('tr:has(td.menunggu_verifikasi)').count();

                total = draf + pengajuan + pengajuan_disetujui + pengajuan_ditolak + rincian_tersimpan + menunggu_verifikasi;

                persen_draf = (draf / total) * 100;
                persen_pengajuan = (pengajuan / total) * 100;
                persen_pengajuan_disetujui = (pengajuan_disetujui / total) * 100;
                persen_pengajuan_ditolak = (pengajuan_ditolak / total) * 100;
                persen_rincian_tersimpan = (rincian_tersimpan / total) * 100;
                persen_menunggu_verifikasi = (menunggu_verifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#777'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_pengajuan, val: pengajuan}],
                        color: '#286090'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_pengajuan_disetujui, val: pengajuan_disetujui}],
                        color: '#398439'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_pengajuan_ditolak, val: pengajuan_ditolak}],
                        color: '#d43f3a'
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_rincian_tersimpan, val: rincian_tersimpan}],
                        color: '#dff0d8'
                    }, {
                        name: settings.status.enam,
                        data: [{y: persen_menunggu_verifikasi, val: menunggu_verifikasi}],
                        color: '#d58512'
                    }];
            } else if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga !== "" && settings.status.empat !== "" && settings.status.lima !== "" && settings.status.enam !== "" && settings.status.tujuh !== "" && settings.status.delapan === "") {
                draf = table.rows('tr:has(td.draf)').count();
                pengajuan = table.rows('tr:has(td.pengajuan)').count();
                pengajuan_disetujui = table.rows('tr:has(td.pengajuan_disetujui)').count();
                pengajuan_ditolak = table.rows('tr:has(td.pengajuan_ditolak)').count();
                rincian_tersimpan = table.rows('tr:has(td.rincian_tersimpan)').count();
                menunggu_verifikasi = table.rows('tr:has(td.menunggu_verifikasi)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();

                total = draf + pengajuan + pengajuan_disetujui + pengajuan_ditolak + rincian_tersimpan + menunggu_verifikasi + diverifikasi;

                persen_draf = (draf / total) * 100;
                persen_pengajuan = (pengajuan / total) * 100;
                persen_pengajuan_disetujui = (pengajuan_disetujui / total) * 100;
                persen_pengajuan_ditolak = (pengajuan_ditolak / total) * 100;
                persen_rincian_tersimpan = (rincian_tersimpan / total) * 100;
                persen_menunggu_verifikasi = (menunggu_verifikasi / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#777'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_pengajuan, val: pengajuan}],
                        color: '#286090'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_pengajuan_disetujui, val: pengajuan_disetujui}],
                        color: '#398439'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_pengajuan_ditolak, val: pengajuan_ditolak}],
                        color: '#d43f3a'
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_rincian_tersimpan, val: rincian_tersimpan}],
                        color: '#dff0d8'
                    }, {
                        name: settings.status.enam,
                        data: [{y: persen_menunggu_verifikasi, val: menunggu_verifikasi}],
                        color: '#d58512'
                    }, {
                        name: settings.status.tujuh,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: '#269abc'
                    }];
            } else if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga !== "" && settings.status.empat !== "" && settings.status.lima !== "" && settings.status.enam !== "" && settings.status.tujuh !== "" && settings.status.delapan !== "") {
                draf = table.rows('tr:has(td.draf)').count();
                pengajuan = table.rows('tr:has(td.pengajuan)').count();
                pengajuan_disetujui = table.rows('tr:has(td.pengajuan_disetujui)').count();
                pengajuan_ditolak = table.rows('tr:has(td.pengajuan_ditolak)').count();
                rincian_tersimpan = table.rows('tr:has(td.rincian_tersimpan)').count();
                menunggu_verifikasi = table.rows('tr:has(td.menunggu_verifikasi)').count();
                diverifikasi = table.rows('tr:has(td.diverifikasi)').count();
                rincian_ditolak = table.rows('tr:has(td.rincian_ditolak)').count();

                total = draf + pengajuan + pengajuan_disetujui + pengajuan_ditolak + rincian_tersimpan + menunggu_verifikasi + diverifikasi + rincian_ditolak;

                persen_draf = (draf / total) * 100;
                persen_pengajuan = (pengajuan / total) * 100;
                persen_pengajuan_disetujui = (pengajuan_disetujui / total) * 100;
                persen_pengajuan_ditolak = (pengajuan_ditolak / total) * 100;
                persen_rincian_tersimpan = (rincian_tersimpan / total) * 100;
                persen_menunggu_verifikasi = (menunggu_verifikasi / total) * 100;
                persen_diverifikasi = (diverifikasi / total) * 100;
                persen_rincian_ditolak = (rincian_ditolak / total) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draf, val: draf}],
                        color: '#777'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_pengajuan, val: pengajuan}],
                        color: '#286090'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_pengajuan_disetujui, val: pengajuan_disetujui}],
                        color: '#398439'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_pengajuan_ditolak, val: pengajuan_ditolak}],
                        color: '#d43f3a'
                    }, {
                        name: settings.status.lima,
                        data: [{y: persen_rincian_tersimpan, val: rincian_tersimpan}],
                        color: '#dff0d8'
                    }, {
                        name: settings.status.enam,
                        data: [{y: persen_menunggu_verifikasi, val: menunggu_verifikasi}],
                        color: '#d58512'
                    }, {
                        name: settings.status.tujuh,
                        data: [{y: persen_diverifikasi, val: diverifikasi}],
                        color: '#269abc'
                    }, {
                        name: settings.status.delapan,
                        data: [{y: persen_rincian_ditolak, val: rincian_ditolak}],
                        color: '#d43f3a'
                    }];
            }

        }

        function init_chart() {
            var nama_skpd = '';
            if ($(settings.id + " :selected").text() == 'Anda Belum Mengampu SKPD') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == 'Data Unit Masih Kosong') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == '') {
                nama_skpd = '';
            } else {
                nama_skpd = $(settings.id + " :selected").text();
            }
            ;
            new Highcharts.Chart({
                chart: {
                    type: 'bar',
                    renderTo: settings.chart.id
                },
                title: {
                    text: settings.chart.nama + '<br>' + nama_skpd
                },
                xAxis: {
                    categories: ['Data']
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    tickInterval: 5,
                    title: {
                        text: 'Total Data : <b>' + total + ' < /b>' + settings.chart.nama
                    },
                    labels: {
                        formatter: function () {
                            return this.value + '%';
                        }
                    }
                },
                legend: {
                    reversed: true
                },
                plotOptions: {
                    series: {
                        stacking: 'normal',
                        pointWidth: 80
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    valueSuffix: '',
                    formatter: function () {
                        return "<b>" + this.point.val + " " + settings.chart.nama + " " + this.series.name + " (" + Math.round(this.point.y * 100) / 100 + "%)</b>";
                    }
                },
                series: series_data
            });
        }

        $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));
        var id = $(settings.id + " :selected").val();
        if (id === undefined) {
            id = "";
        }
        if (settings.alamat) {
            $(settings.dataTable.data).slideUp(500, function () {
                $(settings.dataTable.data).load(settings.alamat + "/" + id).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                    if (settings.dataTable.cari_id) {
                        var data = settings.dataTable.cari_id;
                        for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                            var odd = data[i];
                            var even = data[i + 1];
                            $(odd).on("change", function () {
                                table.search($(this).val()).draw();
                            });
                        }
                    }
                    if (settings.dataTable.cari_class) {
                        $(settings.dataTable.cari_class).change(function () {
                            table.search(this.value).draw();
                        });
                    }
                });
            });
        }


        $(this).on("change", function () {
            $(settings.dataTable.data).empty();
            table.destroy();
            var id = $(settings.id + " :selected").val();
            var url = settings.alamat + "/" + id;
            if (settings.id2) {
                var id2 = $(settings.id2 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/";
            }
            if (settings.id2 && settings.id3) {
                var id2 = $(settings.id2 + " :selected").val();
                var id3 = $(settings.id3 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/" + id3;
            }
            if (settings.alamat && settings.dataTable.data) {
                $(settings.dataTable.data).load(url).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                });
            }
            if ($.isFunction(settings.complete)) {
                settings.complete.call(this);
            }
// $(settings.judul).html($(settings.id + " :selected").text());
            $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));
        });
    };

    $.fn.dropdown_datatable_pajak = function (options) {
        var settings = $.extend({
            id: null,
            id2: null,
            id3: null,
            judul: null,
            alamat: null,
            dataTable: {id: null, data: null, cari_class: null, cari_id: [], kolom: []},
            chart: {id: null, nama: "Data Chart"},
            status: {satu: "Draft", dua: "Final", tiga: "Ditolak", empat: null},
            complete: null
        }, options);
        function init_datatable() {
            table = $(settings.dataTable.id).DataTable({
                "retrieve": true,
                "processing": true,
                "paging": true,
                "ordering": true,
                "bFilter": true,
                "bSortClasses": false,
                "language": {
                    "zeroRecords": "Maaf data tidak ditemukan!",
                    "sSearch": "Cari Data: ",
                    "searchPlaceholder": "Cari data.."
                },
                "aaSorting": [],
                "fnDrawCallback": function () {
                    $('div.dataTables_filter input').addClass('form-control');
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
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                                i.replace(/[\$.]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                            .column(5)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                    pageTotal = api
                            .column(5, {page: 'current'})
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                    // Update footer
                    $(api.column(5).footer()).html(
                            'Rp. ' + convertToRupiahJs(pageTotal) + " (Rp. " + convertToRupiahJs(total) + ') Total Semua'
                            );
                }
            });
            if (settings.dataTable.cari_id) {
                var data = settings.dataTable.cari_id;
                for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                    var odd = data[i];
                    var even = data[i + 1];
                    //console.log("$(" + odd + ").change(function () { table.columns(" + even + ").search(this.value).draw();})");
                    $(odd).on("change", function () {
                        table.search($(this).val()).draw();
                    });
                }
            }

            if (settings.dataTable.cari_class) {
                $(settings.dataTable.cari_class).change(function () {
                    table.search(this.value).draw();
                });
            }

            if (settings.status.satu && settings.status.dua) {
                draft = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                total = draft + final;
                persen_draft = (draft / (draft + final)) * 100;
                persen_final = (final / (draft + final)) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draft, val: draft}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }];
            }
            if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga !== "") {
                draft = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = draft + final + ditolak;
                persen_draft = (draft / (draft + final + ditolak)) * 100;
                persen_final = (final / (draft + final + ditolak)) * 100;
                persen_ditolak = (ditolak / (draft + final + ditolak)) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draft, val: draft}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua !== "" && settings.status.tiga !== "") {
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = final + ditolak;
                persen_final = (final / (final + ditolak)) * 100;
                persen_ditolak = (ditolak / (final + ditolak)) * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }];
            }
            if (settings.status.satu && settings.status.dua && settings.status.tiga && settings.status.empat) {
                draft = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                persiapan = table.rows('tr:has(td.persiapan)').count();
                total = draft + final + ditolak + persiapan;
                persen_draft = (draft / (draft + final + ditolak + persiapan)) * 100;
                persen_final = (final / (draft + final + ditolak + persiapan)) * 100;
                persen_ditolak = (ditolak / (draft + final + ditolak + persiapan)) * 100;
                persen_persiapan = (persiapan / (draft + final + ditolak + persiapan)) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draft, val: draft}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_persiapan, val: persiapan}],
                        color: '#777'

                                //color: '#dcdcdc'
                    }];
            }
        }

        function init_chart() {
            var nama_skpd = '';
            if ($(settings.id + " :selected").text() == 'Anda Belum Mengampu SKPD') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == 'Data Unit Masih Kosong') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == '') {
                nama_skpd = '';
            } else {
                nama_skpd = $(settings.id + " :selected").text();
            }
            ;
            new Highcharts.Chart({
                chart: {
                    type: 'bar',
                    renderTo: settings.chart.id
                },
                title: {
                    text: settings.chart.nama + '<br>' + nama_skpd
                },
                xAxis: {
                    categories: ['Data']
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    tickInterval: 5,
                    title: {
                        text: 'Total Data : <b>' + total + ' < /b>' + settings.chart.nama
                    },
                    labels: {
                        formatter: function () {
                            return this.value + '%';
                        }
                    }
                },
                legend: {
                    reversed: true
                },
                plotOptions: {
                    series: {
                        stacking: 'normal',
                        pointWidth: 80
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    valueSuffix: '',
                    formatter: function () {
                        return "<b>" + this.point.val + " " + settings.chart.nama + " " + this.series.name + " (" + Math.round(this.point.y * 100) / 100 + "%)</b>";
                    }
                },
                series: series_data
            });
        }

        $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));

        var id = $(settings.id + " :selected").val();
        var url = settings.alamat + "/" + id;
        if (settings.id2) {
            var id2 = $(settings.id2 + " :selected").val();
            var url = settings.alamat + "/" + id + "/" + id2 + "/";
        }
        if (settings.id2 && settings.id3) {
            var id2 = $(settings.id2 + " :selected").val();
            var id3 = $(settings.id3 + " :selected").val();
            var url = settings.alamat + "/" + id + "/" + id2 + "/" + id3;
        }
        if (settings.alamat) {
            $(settings.dataTable.data).slideUp(500, function () {
                $(settings.dataTable.data).load(url).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                    if (settings.dataTable.cari_id) {
                        var data = settings.dataTable.cari_id;
                        for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                            var odd = data[i];
                            var even = data[i + 1];
                            $(odd).on("change", function () {
                                table.search($(this).val()).draw();
                            });
                        }
                    }
                    if (settings.dataTable.cari_class) {
                        $(settings.dataTable.cari_class).change(function () {
                            table.search(this.value).draw();
                        });
                    }
                });
            });
        }


        $(this).on("change", function () {
            $(settings.dataTable.data).empty();
            table.destroy();
            var id = $(settings.id + " :selected").val();
            var url = settings.alamat + "/" + id;
            if (settings.id2) {
                var id2 = $(settings.id2 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/";
            }
            if (settings.id2 && settings.id3) {
                var id2 = $(settings.id2 + " :selected").val();
                var id3 = $(settings.id3 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/" + id3;
            }
            if (settings.alamat && settings.dataTable.data) {
                $(settings.dataTable.data).load(url).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                });
            }
            if ($.isFunction(settings.complete)) {
                settings.complete.call(this);
            }
// $(settings.judul).html($(settings.id + " :selected").text());
            $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));
        });
    };
    $.fn.dropdown_datatable_spm = function (options) {

        var spersiapan = '#f0ad4e'; //draf
        var sditolak = '#d9534f'; //ditolak
        var sdraf = '#5cb85c'; //final
        var sfinal = '#46b8da'; //diverifikasi

        var settings = $.extend({
            id: null,
            id2: null,
            id3: null,
            judul: null,
            alamat: null,
            dataTable: {id: null, data: null, cari_class: null, cari_id: [], kolom: []},
            chart: {id: null, nama: "Data Chart"},
            status: {satu: "Draft", dua: "Final", tiga: "Ditolak", empat: "Diverifikasi"},
            complete: null
        }, options);
        function init_datatable() {
            table = $(settings.dataTable.id).DataTable({
                "retrieve": true,
                "processing": true,
                "paging": true,
                "ordering": true,
                "bFilter": true,
                "bSortClasses": false,
                "language": {
                    "zeroRecords": "Maaf data tidak ditemukan!",
                    "sSearch": "Cari Data: ",
                    "searchPlaceholder": "Cari data.."
                },
                "aaSorting": [],
                "fnDrawCallback": function () {
                    $('div.dataTables_filter input').addClass('form-control');
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
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [-1]
                    }
                ]
            });
            if (settings.dataTable.cari_id) {
                var data = settings.dataTable.cari_id;
                for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                    var odd = data[i];
                    var even = data[i + 1];
                    //console.log("$(" + odd + ").change(function () { table.columns(" + even + ").search(this.value).draw();})");
                    $(odd).on("change", function () {
                        table.search($(this).val()).draw();
                    });
                }
            }

            if (settings.dataTable.cari_class) {
                $(settings.dataTable.cari_class).change(function () {
                    table.search(this.value).draw();
                });
            }

            if (settings.status.satu && settings.status.dua) {
                draft = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                total = draft + final;
                persen_draft = (draft / (draft + final)) * 100;
                persen_final = (final / (draft + final)) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draft, val: draft}],
                        color: spersiapan
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: sdraf
                    }];
            }
            if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga !== "") {
                draft = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = draft + final + ditolak;
                persen_draft = (draft / (draft + final + ditolak)) * 100;
                persen_final = (final / (draft + final + ditolak)) * 100;
                persen_ditolak = (ditolak / (draft + final + ditolak)) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draft, val: draft}],
                        color: spersiapan
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: sdraf
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: sditolak
                    }];
            } else if (settings.status.satu === "" && settings.status.dua !== "" && settings.status.tiga !== "") {
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = final + ditolak;
                persen_final = (final / (final + ditolak)) * 100;
                persen_ditolak = (ditolak / (final + ditolak)) * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: sdraf
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: sditolak
                    }];
            }
            if (settings.status.satu && settings.status.dua && settings.status.tiga && settings.status.empat) {
                draft = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                persiapan = table.rows('tr:has(td.diverifikasi)').count();
                total = draft + final + ditolak + persiapan;
                persen_draft = (draft / (draft + final + ditolak + persiapan)) * 100;
                persen_final = (final / (draft + final + ditolak + persiapan)) * 100;
                persen_ditolak = (ditolak / (draft + final + ditolak + persiapan)) * 100;
                persen_persiapan = (persiapan / (draft + final + ditolak + persiapan)) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draft, val: draft}],
                        color: spersiapan
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: sdraf
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: sditolak
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_persiapan, val: persiapan}],
                        color: sfinal

                                //color: '#dcdcdc'
                    }];
            }
        }

        function init_chart() {
            var nama_skpd = '';
            if ($(settings.id + " :selected").text() == 'Anda Belum Mengampu SKPD') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == 'Data Unit Masih Kosong') {
                nama_skpd = '';
            } else if ($(settings.id + " :selected").text() == '') {
                nama_skpd = '';
            } else {
                nama_skpd = $(settings.id + " :selected").text();
            }
            ;
            new Highcharts.Chart({
                chart: {
                    type: 'bar',
                    renderTo: settings.chart.id
                },
                title: {
                    text: settings.chart.nama + '<br>' + nama_skpd
                },
                xAxis: {
                    categories: ['Data']
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    tickInterval: 5,
                    title: {
                        text: 'Total Data : <b>' + total + ' < /b>' + settings.chart.nama
                    },
                    labels: {
                        formatter: function () {
                            return this.value + '%';
                        }
                    }
                },
                legend: {
                    reversed: true
                },
                plotOptions: {
                    series: {
                        stacking: 'normal',
                        pointWidth: 80
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    valueSuffix: '',
                    formatter: function () {
                        return "<b>" + this.point.val + " " + settings.chart.nama + " " + this.series.name + " (" + Math.round(this.point.y * 100) / 100 + "%)</b>";
                    }
                },
                series: series_data
            });
        }

        $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));
        var id = $(settings.id + " :selected").val();
        var url = settings.alamat + "/" + id;
        if (settings.id2) {
            var id2 = $(settings.id2 + " :selected").val();
            var url = settings.alamat + "/" + id + "/" + id2 + "/";
        }
        if (settings.id2 && settings.id3) {
            var id2 = $(settings.id2 + " :selected").val();
            var id3 = $(settings.id3 + " :selected").val();
            var url = settings.alamat + "/" + id + "/" + id2 + "/" + id3;
        }
        if (settings.alamat) {
            $(settings.dataTable.data).slideUp(500, function () {
                $(settings.dataTable.data).load(url).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                    if (settings.dataTable.cari_id) {
                        var data = settings.dataTable.cari_id;
                        for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                            var odd = data[i];
                            var even = data[i + 1];
                            $(odd).on("change", function () {
                                table.search($(this).val()).draw();
                            });
                        }
                    }
                    if (settings.dataTable.cari_class) {
                        $(settings.dataTable.cari_class).change(function () {
                            table.search(this.value).draw();
                        });
                    }
                });
            });
        }


        $(this).on("change", function () {
            $(settings.dataTable.data).empty();
            table.destroy();
            var id = $(settings.id + " :selected").val();
            var url = settings.alamat + "/" + id;
            if (settings.id2) {
                var id2 = $(settings.id2 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/";
            }
            if (settings.id2 && settings.id3) {
                var id2 = $(settings.id2 + " :selected").val();
                var id3 = $(settings.id3 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/" + id3;
            }
            if (settings.alamat && settings.dataTable.data) {
                $(settings.dataTable.data).load(url).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                });
            }
            if ($.isFunction(settings.complete)) {
                settings.complete.call(this);
            }
            $(settings.judul).html(($(settings.id2 + " :selected").text() ? $(settings.id2 + " :selected").text() : $(settings.id + " :selected").text()));
        });
    };

    $.fn.dropdown_datatable_lpj = function (options) {
        var settings = $.extend({
            id: null,
            id2: null,
            id3: null,
            judul: null,
            alamat: null,
            dataTable: {id: null, data: null, cari_class: null, cari_id: [], kolom: []},
            chart: {id: null, nama: "Data Chart"},
            status: {satu: "Draft", dua: "Final", tiga: "Ditolak", empat: null},
            complete: null
        }, options);
        function init_datatable() {
            table = $(settings.dataTable.id).DataTable({
                "retrieve": true,
                "processing": false,
                "paging": true,
                "ordering": true,
                "bFilter": true,
                "bSortClasses": false,
                "language": {
                    "zeroRecords": "Maaf data tidak ditemukan!",
                    "sSearch": "Cari Data: ",
                    "searchPlaceholder": "Cari data.."
                },
                "aaSorting": [],
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
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": false,
                        "searchable": true
                    }
                ],
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                                i.replace(/[\$.]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                            .column(3)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                    // Total over this page
                    pageTotal = api
                            .column(3, {page: 'current'})
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                    // Update footer
                    $(api.column(3).footer()).html(
                            'Rp. ' + convertToRupiahJs(pageTotal) + ' ( Rp. ' + convertToRupiahJs(total) + ' Total Semua)'
                            );
                }
            });
            if (settings.dataTable.cari_id) {
                var data = settings.dataTable.cari_id;
                for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                    var odd = data[i];
                    var even = data[i + 1];
                    //console.log("$(" + odd + ").change(function () { table.columns(" + even + ").search(this.value).draw();})");
                    $(odd).on("change", function () {
                        table.search($(this).val()).draw();
                    });
                }
            }

            if (settings.dataTable.cari_class) {
                $(settings.dataTable.cari_class).change(function () {
                    table.search(this.value).draw();
                });
            }

            if (settings.status.satu && settings.status.dua) {
                draft = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                total = draft + final;
                persen_draft = (draft / (draft + final)) * 100;
                persen_final = (final / (draft + final)) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draft, val: draft}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }];
            }
            if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga !== "") {
                draft = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = draft + final + ditolak;
                persen_draft = (draft / (draft + final + ditolak)) * 100;
                persen_final = (final / (draft + final + ditolak)) * 100;
                persen_ditolak = (ditolak / (draft + final + ditolak)) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draft, val: draft}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua !== "" && settings.status.tiga !== "") {
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                total = final + ditolak;
                persen_final = (final / (final + ditolak)) * 100;
                persen_ditolak = (ditolak / (final + ditolak)) * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }];
            }
            if (settings.status.satu && settings.status.dua && settings.status.tiga && settings.status.empat) {
                draft = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                ditolak = table.rows('tr:has(td.ditolak)').count();
                persiapan = table.rows('tr:has(td.persiapan)').count();
                total = draft + final + ditolak + persiapan;
                persen_draft = (draft / (draft + final + ditolak + persiapan)) * 100;
                persen_final = (final / (draft + final + ditolak + persiapan)) * 100;
                persen_ditolak = (ditolak / (draft + final + ditolak + persiapan)) * 100;
                persen_persiapan = (persiapan / (draft + final + ditolak + persiapan)) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draft, val: draft}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_ditolak, val: ditolak}],
                        color: '#d43f3a'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_persiapan, val: persiapan}],
                        color: '#777'

                                //color: '#dcdcdc'
                    }];
            }
        }

        function init_chart() {
            new Highcharts.Chart({
                chart: {
                    type: 'bar',
                    renderTo: settings.chart.id
                },
                title: {
                    text: settings.chart.nama + '<br>' + $(settings.id + " :selected").text()
                },
                xAxis: {
                    categories: ['Data']
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    tickInterval: 5,
                    title: {
                        text: 'Total Data : <b>' + total + ' < /b>' + settings.chart.nama
                    },
                    labels: {
                        formatter: function () {
                            return this.value + '%';
                        }
                    }
                },
                legend: {
                    reversed: true
                },
                plotOptions: {
                    series: {
                        stacking: 'normal',
                        pointWidth: 80
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    valueSuffix: '',
                    formatter: function () {
                        return "<b>" + this.point.val + " " + settings.chart.nama + " " + this.series.name + " (" + Math.round(this.point.y * 100) / 100 + "%)</b>";
                    }
                },
                series: series_data
            });
        }

        $(settings.judul).html($(settings.id + " :selected").text());
        var id = $(settings.id + " :selected").val();
        if (id === undefined) {
            id = "";
        }
        if (settings.alamat) {
            $(settings.dataTable.data).slideUp(500, function () {
                $(settings.dataTable.data).load(settings.alamat + "/" + id).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                    if (settings.dataTable.cari_id) {
                        var data = settings.dataTable.cari_id;
                        for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                            var odd = data[i];
                            var even = data[i + 1];
                            $(odd).on("change", function () {
                                table.search($(this).val()).draw();
                            });
                        }
                    }
                    if (settings.dataTable.cari_class) {
                        $(settings.dataTable.cari_class).change(function () {
                            table.search(this.value).draw();
                        });
                    }
                });
            });
        }


        $(this).on("change", function () {
            $(settings.dataTable.data).empty();
            table.destroy();
            var id = $(settings.id + " :selected").val();
            var url = settings.alamat + "/" + id;
            if (settings.id2) {
                var id2 = $(settings.id2 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/";
            }
            if (settings.id2 && settings.id3) {
                var id2 = $(settings.id2 + " :selected").val();
                var id3 = $(settings.id3 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/" + id3;
            }
            if (settings.alamat && settings.dataTable.data) {
                $(settings.dataTable.data).load(url).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                });
            }
            if ($.isFunction(settings.complete)) {
                settings.complete.call(this);
            }
            $(settings.judul).html($(settings.id + " :selected").text());
        });
    };

    $.fn.dropdown_datatable_bp = function (options) {
        var settings = $.extend({
            id: null,
            id2: null,
            id3: null,
            judul: null,
            alamat: null,
            dataTable: {id: null, data: null, cari_class: null, cari_id: [], kolom: []},
            chart: {id: null, nama: "Progres BP"},
            status: {satu: "Draft", dua: "Final", tiga: "Sudah di-LPJ-kan", empat: null},
            complete: null
        }, options);
        function init_datatable() {
            table = $(settings.dataTable.id).DataTable({
                "retrieve": true,
                "processing": true,
                "paging": true,
                "ordering": true,
                "bFilter": true,
                "bSortClasses": false,
                "language": {
                    "zeroRecords": "Maaf data tidak ditemukan!",
                    "sSearch": "Cari Data: ",
                    "searchPlaceholder": "Cari data.."
                },
                "aaSorting": [],
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
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": false,
                        "searchable": true
                    },
                    {
                        "targets": [1, 8],
                        "sortable": false
                    }
                ],
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                                i.replace(/[\$.]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                            .column(4)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                    // Total over this page
                    pageTotal = api
                            .column(4, {page: 'current'})
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                    // Update footer
                    $(api.column(4).footer()).html(
                            'Rp. ' + convertToRupiahJs(pageTotal) + ' ( Rp. ' + convertToRupiahJs(total) + ' Total Semua)'
                            );
                }
            });
            if (settings.dataTable.cari_id) {
                var data = settings.dataTable.cari_id;
                var kolom_ = settings.dataTable.kolom;
                $.each(data, function (index, val) {
                    // console.log("$("+val+").on(\"change\", function () { table.columns("+even+").search($(this).val()).draw(); });");
                    var even = kolom_[index];
                    $(val).on('change', function () {
                        table.columns(even).search(this.value).draw();
                    });
                });
            }

            if (settings.dataTable.cari_class) {
                $(settings.dataTable.cari_class).change(function () {
                    table.search(this.value).draw();
                });
            }

            if (settings.status.satu && settings.status.dua) {
                draft = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                total = draft + final;
                persen_draft = (draft / (draft + final)) * 100;
                persen_final = (final / (draft + final)) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draft, val: draft}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }];
            }
            if (settings.status.satu !== "" && settings.status.dua !== "" && settings.status.tiga !== "") {
                draft = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                LPJkan = table.rows('tr:has(td.sudah)').count();
                total = draft + final + LPJkan;
                persen_draft = (draft / (draft + final + LPJkan)) * 100;
                persen_final = (final / (draft + final + LPJkan)) * 100;
                persen_LPJkan = (LPJkan / (draft + final + LPJkan)) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draft, val: draft}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_LPJkan, val: LPJkan}],
                        color: '#5bc0de'
                    }];
            } else if (settings.status.satu === "" && settings.status.dua !== "" && settings.status.tiga !== "") {
                final = table.rows('tr:has(td.final)').count();
                LPJkan = table.rows('tr:has(td.LPJkan)').count();
                total = final + LPJkan;
                persen_final = (final / (final + LPJkan)) * 100;
                persen_LPJkan = (LPJkan / (final + LPJkan)) * 100;
                series_data = [
                    {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_LPJkan, val: LPJkan}],
                        color: '#5bc0de'
                    }];
            }
            if (settings.status.satu && settings.status.dua && settings.status.tiga && settings.status.empat) {
                draft = table.rows('tr:has(td.draf)').count();
                final = table.rows('tr:has(td.final)').count();
                LPJkan = table.rows('tr:has(td.LPJkan)').count();
                persiapan = table.rows('tr:has(td.persiapan)').count();
                total = draft + final + LPJkan + persiapan;
                persen_draft = (draft / (draft + final + LPJkan + persiapan)) * 100;
                persen_final = (final / (draft + final + LPJkan + persiapan)) * 100;
                persen_LPJkan = (LPJkan / (draft + final + LPJkan + persiapan)) * 100;
                persen_persiapan = (persiapan / (draft + final + LPJkan + persiapan)) * 100;
                series_data = [
                    {
                        name: settings.status.satu,
                        data: [{y: persen_draft, val: draft}],
                        color: '#f0ad4e'
                    }, {
                        name: settings.status.dua,
                        data: [{y: persen_final, val: final}],
                        color: '#5cb85c'
                    }, {
                        name: settings.status.tiga,
                        data: [{y: persen_LPJkan, val: LPJkan}],
                        color: '#5bc0de'
                    }, {
                        name: settings.status.empat,
                        data: [{y: persen_persiapan, val: persiapan}],
                        color: '#777'

                                //color: '#dcdcdc'
                    }];
            }
        }

        function init_chart() {
            new Highcharts.Chart({
                chart: {
                    type: 'bar',
                    renderTo: settings.chart.id
                },
                title: {
                    text: settings.chart.nama + '<br>' + $(settings.id + " :selected").text()
                },
                xAxis: {
                    categories: ['Data']
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    tickInterval: 5,
                    title: {
                        text: 'Total Data : <b>' + total + ' < /b>' + settings.chart.nama
                    },
                    labels: {
                        formatter: function () {
                            return this.value + '%';
                        }
                    }
                },
                legend: {
                    reversed: true
                },
                plotOptions: {
                    series: {
                        stacking: 'normal',
                        pointWidth: 80
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    valueSuffix: '',
                    formatter: function () {
                        return "<b>" + this.point.val + " " + settings.chart.nama + " " + this.series.name + " (" + Math.round(this.point.y * 100) / 100 + "%)</b>";
                    }
                },
                series: series_data
            });
        }

        $(settings.judul).html($(settings.id + " :selected").text());
        var id = $(settings.id + " :selected").val();
        if (id === undefined) {
            id = "";
        }
        if (settings.alamat) {
            $(settings.dataTable.data).slideUp(500, function () {
                $(settings.dataTable.data).load(settings.alamat + "/" + id).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                    if (settings.dataTable.cari_id) {
                        var data = settings.dataTable.cari_id;
                        for (var i = 0, l = settings.dataTable.cari_id.length; i < l; i += 2) {
                            var odd = data[i];
                            var even = data[i + 1];
                            $(odd).on("change", function () {
                                table.search($(this).val()).draw();
                            });
                        }
                    }
                    if (settings.dataTable.cari_class) {
                        $(settings.dataTable.cari_class).change(function () {
                            table.search(this.value).draw();
                        });
                    }
                });
            });
        }


        $(this).on("change", function () {
            $(settings.dataTable.data).empty();
            table.destroy();
            var id = $(settings.id + " :selected").val();
            var url = settings.alamat + "/" + id;
            if (settings.id2) {
                var id2 = $(settings.id2 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/";
            }
            if (settings.id2 && settings.id3) {
                var id2 = $(settings.id2 + " :selected").val();
                var id3 = $(settings.id3 + " :selected").val();
                var url = settings.alamat + "/" + id + "/" + id2 + "/" + id3;
            }
            if (settings.alamat && settings.dataTable.data) {
                $(settings.dataTable.data).load(url).show(function () {
                    var timerStart = new Date();
                    var curentTime = new Date() - timerStart + 2;
                    setTimeout(function () {
                        init_datatable();
                        init_chart();
                    }, curentTime + 1000);
                });
            }
            if ($.isFunction(settings.complete)) {
                settings.complete.call(this);
            }
            $(settings.judul).html($(settings.id + " :selected").text());
        });
    };

    $.fn.hari_ini = function () {
        $(this).datepicker({
            todayBtn: 1,
            format: 'dd-mm-yyyy',
            autoclose: true,
            endDate: '0d'
        });
    }
    $.fn.filtering = function () {
        $(this).datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true
        });
    }
    $.fn.hari_ini_kelengkapan = function () {
        $(this).datepicker({
            todayBtn: 1,
            format: 'yyyy-mm-dd',
            autoclose: true,
            endDate: '0d'
        });
    }

    $.fn.min_spp = function (date) {
        $(this).datepicker({
            todayBtn: 1,
            format: 'dd-mm-yyyy',
            autoclose: true,
            startDate: date
        });
    }

    $.fn.bulan_ini = function () {
        $(this).datepicker({
            format: "mm-yyyy",
            viewMode: "months",
            minViewMode: "months",
            endDate: '0m',
            autoclose: true
        });
    }

    $.fn.bulan_epen = function () {
        $(this).datepicker({
            format: "mm-yyyy",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });
    }

    window.readURL = function (input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    window.hapus_localstorage = function (id) {
        $(window).load(function () {
            var keys = Object.keys(localStorage),
                    prefix = id;
            for (var i = 0; i < keys.length; i += 1) {
                if (keys[i].indexOf(prefix) === 0) {
                    localStorage.removeItem(keys[i]);
                }
            }
        });
    }

    window.get_status = function (kode_jenis) {
        switch (kode_jenis) {
            case 1:
                return "up";
                break;
            case 2:
                return "gu";
                break;
            case 3:
                return "tu";
                break;
            case 4:
                return "ls_belanja_pegawai";
                break;
            case 5:
                return "ls_barang_jasa";
                break;
            case 6:
                return "ls_skpkd";
                break;
            case 7:
                return "gu_nihil";
                break;
            case 8:
                return "tu_nihil";
        }
    };
    window.paceOptions = {ajax: {trackMethods: ['GET', 'POST', 'PUT', 'DELETE', 'REMOVE']
        }
    };
    window.cek_email = function () {
        lscache.set('cek_email', '1', 60);
        var first = $(location).attr('pathname');
        first.indexOf(1);
        first.toLowerCase();
        first = first.split("/")[1];
        var base_url = window.location.origin;
        $.ajax({
            type: 'GET',
            url: base_url + '/user/profile/cek_email',
            dataType: 'json',
            success: function (data) {
                Pace.on("done", function () {
                    if (data.email === "") {
                        swal({
                            title: '<h3><b>Informasi.</b></h3>',
                            text: 'Maaf profil Anda belum ada e-mail, silahkan masukkan e-mail valid Anda untuk keperluan reset password.',
                            input: 'text',
                            showCancelButton: true,
                            confirmButtonText: 'Submit',
                            showLoaderOnConfirm: true,
                            inputPlaceholder: "Masukkan email",
                            preConfirm: function () {
                                email = $(".sweet-input").val();
                                $.ajax({
                                    url: base_url + '/user/profile/update_email',
                                    type: 'POST',
                                    dataType: "JSON",
                                    timeout: 10000,
                                    data: {emailnya: email},
                                    success: function (data) {
                                        if (data.back === true) {
                                            swal({
                                                title: 'Informasi',
                                                text: "E-mail verifikasi berhasil dikirim, silahkan buka e-mail Anda dan klik link yang ada di email untuk memverifikasi.",
                                                type: 'success',
                                                showCancelButton: false,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33'
                                            }).then(function () {
                                                $.fancybox.close();
                                            });
                                        } else {
                                            swal({
                                                title: 'Informasi',
                                                text: "Maaf email yang Anda masukkan tidak valid.",
                                                type: 'error',
                                                showCancelButton: false,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Ok!'
                                            }).then(function () {
                                                $.fancybox.close();
                                            });
                                        }
                                    }
                                });
                            },
                            allowOutsideClick: false
                        });
                    }
                });
            }
        });
    };
    window.convertToRupiahJs = function (angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 === 0)
                rupiah += angkarev.substr(i, 3) + '.';
        return rupiah.split('', rupiah.length - 1).reverse().join('');
    }

    window.set_cache = function (clas, efek) {
        var index = lscache.get(efek);
        $(clas).removeClass(efek);
        $(clas).eq(index).addClass(efek);
        $(clas).on('click', function (e) {
            e.preventDefault();
            $(clas).removeClass(efek);
            $(this).addClass(efek);
            lscache.set(efek, $(clas).index(this), 5);
        });
    }
    window.layar = function () {
        if ((document.fullScreenElement && document.fullScreenElement !== null) ||
                (!document.mozFullScreen && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {
                document.documentElement.requestFullScreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullScreen) {
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            }
        }
    }
}
);
(function ($, F) {     // Opening animation - fly from the top
    F.transitions.dropIn = function () {
        var endPos = F._getPosition(true);
        endPos.top = (parseInt(endPos.top, 10) - 200) + 'px';
        endPos.opacity = 0;
        F.wrap.css(endPos).show().animate({
            top: '+=200px',
            opacity: 1}, {duration: F.current.openSpeed,
            complete: F._afterZoomIn
        });
    };
    // Closing animation - fly to the top
    F.transitions.dropOut = function () {
        F.wrap.removeClass('fancybox-opened').animate({
            top: '-=200px',
            opacity: 0}, {duration: F.current.closeSpeed,
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
            opacity: 1}, {duration: F.current.nextSpeed,
            complete: F._afterZoomIn
        });
    };
    // Current gallery item - fly from center to the right
    F.transitions.slideOut = function () {
        F.wrap.removeClass('fancybox-opened').animate({
            left: '+=200px',
            opacity: 0}, {duration: F.current.prevSpeed,
            complete: function () {
                $(this).trigger('onReset').remove();
            }
        });
    };
}(jQuery, jQuery.fancybox));
$(document).ready(function () {
    var first = $(location).attr('pathname');
    first.indexOf(1);
    first.toLowerCase();
    first = first.split("/")[1];
    var baseurl = window.location.origin;
//    $("img").error(function () {
//        $(this).unbind("error").attr("src", baseurl + "/themes/images/logo.png");
//    });

    Pace.on("start", function () {
        $(".loading").show();
    });
    Pace.on("done", function () {
        $(".loading").hide();
    });
    $(".editor-disable").summernote('disable');
    $(".editor").summernote({
        toolbar: [['font', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['view', ['fullscreen']],
        ]
    });
    $('[id]').each(function () {
        var ids = $('[id="' + this.id + '"]');
        if (ids.length > 1 && ids[0] == this)
            console.warn('ID yang sama terdeteksi, yaitu : #' + this.id + " -- ada " + ids.length);
    });
    $(".tahun_tgl").datepicker({
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months",
        autoclose: true
    });
    $(".satu_tahun_tgl").datepicker({
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months",
//        changeYear: true,
//        yearRange: "2018:2018",
        yearRange: "-1:+0",
        autoclose: true
    });
    $('#tanggal').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });
    $('.date').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });
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
                $.fancybox(data, {helpers: {overlay: {// fancybox API options
                            fitToView: true,
                            minWidth: 600,
                            maxWidth: "80%",
                            minHeight: 600,
                            maxHeight: "80%",
                            autoSize: true,
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
        maxWidth: "90%",
        autoSize: true,
//        afterClose: function () {
//            parent.location.reload(true);
//        },
        keys: {close: null
        },
        helpers: {overlay: {closeClick: false}
        }
    });
    $(".fanBox_ping").fancybox({
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
        beforeClose: function () {
            clearInterval(interv);
        },
        keys: {close: null
        },
        helpers: {overlay: {closeClick: false}
        }
    });
    $(".fanBox_saran").fancybox({
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
        keys: {close: null
        },
        helpers: {overlay: {closeClick: false}
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
        "language": {"zeroRecords": "Maaf data tidak ditemukan!",
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

window.cetak = function (url) {
    var w = 812.598425197;
    var h = 1247.244094488;
    var left1 = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var top1 = window.screenTop != undefined ? window.screenTop : screen.top;
    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
    var left = ((width / 2) - (w / 2)) + left1;
    var top = ((height / 2) - (h / 2)) + top1;
    window.open(url, '_blank', 'bgcolor=white,fullscreen=yes,scrollbars=yes, location=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
}
function cetak_L(url) {
    var w = 1247.244094488;
    var h = 812.598425197;
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
    $(document).ready(function () {         /*==Left Navigation Accordion ==*/
        if ($.fn.dcAccordion) {
            $('#nav-accordion').dcAccordion({
                eventType: 'click',
                autoClose: true,
                saveState: true,
                disableLink: true,
                speed: 'fast',
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
            if ($(widgetElem).hasClass('fa fa-minus')) {
                $(widgetElem).removeClass('fa fa-minus');
                $(widgetElem).addClass('fa fa-plus');
            } else {
                $(widgetElem).removeClass('fa fa-plus');
                $(widgetElem).addClass('fa fa-minus');
            }
            e.preventDefault();
        });
        /*==Sidebar Toggle==*/
        $(".leftside-navigation .sub-menu > a").click(function () {
            var o = ($(this).offset());
            var diff = 80 - o.top;
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
        $('.panel .tools .fa-chevron-down').click(function () {
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
$(document).ready(function () {
    users_aktif = $("#jenis_user").val();
    users_parent = $("#jenis_parent").val();
    var first = $(location).attr('pathname');
    first.indexOf(1);
    first.toLowerCase();
    first = first.split("/")[1];
    var base_url = window.location.origin;
    var sound = document.createElement('audio');
    sound.setAttribute('src', base_url + '/files/Messenger.ogg');
    function tes() {
        $.ajax({
            type: 'GET',
            url: base_url + '/Notifikasi',
            dataType: 'json',
            success: function (data) {
                if (users_aktif === "bp" || users_aktif === "bpp") {
                    $('#item_sp2d').html('');
                    var item_sp2d = [];
                    item_sp2d.push('<li><p class="red">Notifikasi SP2D</p></li>')
                    $.each(data.data_sp2d, function (i, item) {
                        var id = parseInt(data.data_sp2d[i].jenis);
                        item_sp2d.push('<li><a target="_blank" href="' + base_url + '/sp2d_' + get_status(id) + '"><span class="label label-danger">' + data.data_sp2d[i].jumlah + '</span> ' + data.data_sp2d[i].uraian + ' - dicairkan</a></li>');
                    });
                    $('#item_sp2d').append(item_sp2d.join(''));
                    var sp2d = data.sp2d[0].jumlah_sp2d;
                    var cek_sp2d = localStorage.getItem('sp2d');
                    if (cek_sp2d === null) {
                        localStorage.setItem('sp2d', sp2d);
                        $("#sp2d_jum").text(sp2d);
                    } else {
                        var sp2d_baru = sp2d - cek_sp2d;
                        if (sp2d_baru !== 0) {
                            var sp2d_new = localStorage.setItem('sp2d', sp2d);
                            $("#sp2d_jum").text(sp2d_new);
                        } else {
                            $("#sp2d_jum").text(sp2d);
                        }
                    }

                    $('#item_spp').html('');
                    var item_spp = [];
                    item_spp.push('<li><p class="red">Notifikasi SPP</p></li>')
                    $.each(data.data_spp, function (i, item) {
                        var id = parseInt(data.data_spp[i].jns_spp_kode);
                        item_spp.push('<li><a target="_blank" href="' + base_url + '/spp_' + get_status(id) + '"><span class="label label-danger">' + data.data_spp[i].jumlah + '</span> ' + data.data_spp[i].uraian + ' - ditolak</a></li>');
                    });
                    $('#item_spp').append(item_spp.join(''));
                    var spp = data.spp[0].jumlah_spp;
                    var cek_spp = localStorage.getItem('spp');
                    if (cek_spp === null) {
                        localStorage.setItem('spp', spp);
                        $("#spp_jum").text(spp);
                    } else {
                        var spp_baru = spp - cek_spp;
                        if (spp_baru !== 0) {
                            var spp_new = localStorage.setItem('spp', spp);
                            $("#spp_jum").text(spp_new);
                        } else {
                            $("#spp_jum").text(spp);
                        }
                    }

                    $('#item_lpj').html('');
                    var item_lpj = [];
                    item_lpj.push('<li><p class="red">Notifikasi LPJ</p></li>')
                    $.each(data.data_lpj, function (i, item) {
                        var id = parseInt(data.data_lpj[i].jns_lpj_kode);
                        item_lpj.push('<li><a target="_blank" href="' + base_url + '/lpj_' + (id == 1 ? 'gu' : 'tu') + '"><span class="label label-danger">' + data.data_lpj[i].jumlah + '</span> ' + data.data_lpj[i].uraian + ' - ditolak</a></li>');
                    });
                    $('#item_lpj').append(item_lpj.join(''));
                    var lpj = data.lpj[0].jumlah_lpj;
                    var cek_lpj = localStorage.getItem('lpj');
                    if (cek_lpj === null) {
                        localStorage.setItem('lpj', lpj);
                        $("#lpj_jum").text(lpj);
                    } else {
                        var lpj_baru = lpj - cek_lpj;
                        if (lpj_baru !== 0) {
                            var lpj_new = localStorage.setItem('lpj', lpj);
                            $("#lpj_jum").text(lpj_new);
                        } else {
                            $("#lpj_jum").text(lpj);
                        }
                    }

                } else if (users_aktif === "bud") {
                    $('#item_spm').html('');
                    var item_spm = [];
                    item_spm.push('<li><p class="red">Notifikasi SPM</p></li>');
                    $.each(data.data_spm, function (i, item) {
                        var id = parseInt(data.data_spm[i].jns_spm_kode);
                        item_spm.push('<li><a target="_blank" href="' + base_url + '/spm_' + get_status(id) + '"><span class="label label-danger">' + data.data_spm[i].jumlah + '</span> ' + data.data_spm[i].uraian + '</a></li>');
                    });
                    $('#item_spm').append(item_spm.join(''));
                    var spm = data.spm[0].jumlah;
                    var cek_spm = localStorage.getItem('spm');
                    if (cek_spm === null) {
                        localStorage.setItem('spm', spm);
                        $("#spm_jum").text(spm);
                    } else {
                        var spm_baru = spm - cek_spm;
                        if (spm_baru !== 0) {
                            var spm_new = localStorage.setItem('spm', spm);
                            $("#spm_jum").text(spm_new);
                        } else {
                            $("#spm_jum").text(spm);
                        }
                    }
                } else if (users_aktif === "bpen" || users_aktif === "bpenp") {
                    $('#item_bpen').html('');
                    var item_bpen = [];
                    item_bpen.push('<li><p class="red">Notifikasi ' + users_aktif + '</p></li>')
                    $.each(data.bukti, function (i, item) {
                        item_bpen.push('<li><a target="_blank" href="' + base_url + '/bpen' + '"><span class="label label-danger">' + data.bukti[i].jumlah + '</span> ' + data.bukti[i].uraian + ' - baru</a></li>');
                    });
                    $.each(data.skpd, function (i, item) {
                        item_bpen.push('<li><a target="_blank" href="' + base_url + '/skp_d' + '"><span class="label label-danger">' + data.skpd[i].jumlah + '</span> ' + data.skpd[i].uraian + ' - baru</a></li>');
                    });
                    $.each(data.skrd, function (i, item) {
                        item_bpen.push('<li><a target="_blank" href="' + base_url + '/skr_d' + '"><span class="label label-danger">' + data.skrd[i].jumlah + '</span> ' + data.skrd[i].uraian + ' - baru</a></li>');
                    });
                    $.each(data.sts, function (i, item) {
                        item_bpen.push('<li><a target="_blank" href="' + base_url + '/sts' + '"><span class="label label-danger">' + data.sts[i].jumlah + '</span> ' + data.sts[i].uraian + ' - baru</a></li>');
                    });
                    $('#item_bpen').append(item_bpen.join(''));
                    var bpen = parseFloat(data.bukti[0].jumlah) + parseFloat(data.skpd[0].jumlah) + parseFloat(data.skrd[0].jumlah) + parseFloat(data.sts[0].jumlah);
                    var cek_bpen = localStorage.getItem('bpen');
                    if (cek_bpen === null) {
                        localStorage.setItem('bpen', bpen);
                        $("#bpen_jum").text(bpen);
                    } else {
                        var bpen_baru = bpen - cek_bpen;
                        if (bpen_baru !== 0) {
                            var bpen_new = localStorage.setItem('bpen', bpen);
                            $("#bpen_jum").text(bpen_new);
                        } else {
                            $("#bpen_jum").text(bpen);
                        }
                    }
                } else {
                    $('#item_spm_persiapan').html('');
                    var item_spm_persiapan = [];
                    item_spm_persiapan.push('<li><p class="red">Notifikasi SPM Draf</p></li>');
                    $.each(data.data_spm1, function (i, item) {
                        var id = parseInt(data.data_spm1[i].jns_spm_kode);
                        item_spm_persiapan.push('<li><a target="_blank" href="' + base_url + '/spm_' + get_status(id) + '"><span class="label label-danger">' + data.data_spm1[i].jumlah + '</span> ' + data.data_spm1[i].uraian + '</a></li>');
                    });
                    $('#item_spm_persiapan').append(item_spm_persiapan.join(''));
                    $('#item_spm_ditolak').html('');
                    var item_spm_ditolak = [];
                    item_spm_ditolak.push('<li><p class="red">Notifikasi SPM yang ditolak</p></li>');
                    $.each(data.data_spm2, function (i, item) {
                        var id = parseInt(data.data_spm2[i].jns_spm_kode);
                        item_spm_ditolak.push('<li><a target="_blank" href="' + base_url + '/spm_' + get_status(id) + '"><span class="label label-danger">' + data.data_spm2[i].jumlah + '</span> ' + data.data_spm2[i].uraian + '</a></li>');
                    });
                    $('#item_spm_ditolak').append(item_spm_ditolak.join(''))

                    var spm_persiapan = data.spm1[0].jumlah_spm;
                    var cek_spm_persiapan = localStorage.getItem('spm_persiapan');
                    if (cek_spm_persiapan === null) {
                        localStorage.setItem('spm_persiapan', cek_spm_persiapan);
                        $("#spm_persiapan_jum").text(spm);
                    } else {
                        var spm_baru = spm_persiapan - cek_spm_persiapan;
                        if (spm_baru !== 0) {
                            var spm_new = localStorage.setItem('spm_persiapan', spm_persiapan);
                            $("#spm_persiapan_jum").text(spm_new);
                        } else {
                            $("#spm_persiapan_jum").text(spm_persiapan);
                        }
                    }

                    var spm_ditolak = data.spm2[0].jumlah_spm;
                    var cek_spm_ditolak = localStorage.getItem('spm_ditolak');
                    if (cek_spm_ditolak === null) {
                        localStorage.setItem('spm_ditolak', cek_spm_ditolak);
                        $("#spm_ditolak_jum").text(spm_ditolak);
                    } else {
                        var spm_baru_t = spm_ditolak - cek_spm_ditolak;
                        if (spm_baru_t !== 0) {
                            var spm_new = localStorage.setItem('spm_ditolak', spm_ditolak);
                            $("#spm_ditolak_jum").text(spm_new);
                        } else {
                            $("#spm_ditolak_jum").text(spm_ditolak);
                        }
                    }

                    $('#item_spp').html('');
                    var item_spp = [];
                    item_spp.push('<li><p class="red">Notifikasi SPP</p></li>')
                    $.each(data.data_spp, function (i, item) {
                        var id = parseInt(data.data_spp[i].jns_spp_kode);
                        item_spp.push('<li><a target="_blank" href="' + base_url + '/spp_' + get_status(id) + '"><span class="label label-danger">' + data.data_spp[i].jumlah + '</span> ' + data.data_spp[i].uraian + ' - baru</a></li>');
                    });
                    $('#item_spp').append(item_spp.join(''));
                    var spp = data.spp[0].jumlah_spp;
                    var cek_spp = localStorage.getItem('spp');
                    if (cek_spp === null) {
                        localStorage.setItem('spp', spp);
                        $("#spp_jum").text(spp);
                    } else {
                        var spp_baru = spp - cek_spp;
                        if (spp_baru !== 0) {
                            var spp_new = localStorage.setItem('spp', spp);
                            $("#spp_jum").text(spp_new);
                        } else {
                            $("#spp_jum").text(spp);
                        }
                    }

                    $('#item_lpj').html('');
                    var item_lpj = [];
                    item_lpj.push('<li><p class="red">Notifikasi LPJ</p></li>')
                    $.each(data.data_lpj, function (i, item) {
                        var id = parseInt(data.data_lpj[i].jns_lpj_kode);
                        item_lpj.push('<li><a target="_blank" href="' + base_url + '/lpj_' + (id == 1 ? 'gu' : 'tu') + '"><span class="label label-danger">' + data.data_lpj[i].jumlah + '</span> ' + data.data_lpj[i].uraian + ' - baru</a></li>');
                    });
                    $('#item_lpj').append(item_lpj.join(''));
                    var lpj = data.lpj[0].jumlah_lpj;
                    var cek_lpj = localStorage.getItem('lpj');
                    if (cek_lpj === null) {
                        localStorage.setItem('lpj', lpj);
                        $("#lpj_jum").text(lpj);
                    } else {
                        var lpj_baru = lpj - cek_lpj;
                        if (lpj_baru !== 0) {
                            var lpj_new = localStorage.setItem('lpj', lpj);
                            $("#lpj_jum").text(lpj_new);
                        } else {
                            $("#lpj_jum").text(lpj);
                        }
                    }
                }
            }
        });
    }
    $("#kontak").click(function () {
        swal({
            title: "Informasi Kontak GRMS",
            width: 600,
            padding: 20,
            html:
                    '<div class="text-left">\n\
                      <i class="fa fa-phone" style="padding-bottom:10px"></i>&nbsp;&nbsp;(024) 3543494<br>' +
                    '<i class="fa fa-map-marker" style="padding-bottom:10px"></i>&nbsp;&nbsp;&nbsp;(Wisma Perdamaian) Jl. Imam Bonjol No. 209 Semarang<br>' +
                    '<i class="fa fa-envelope" style="padding-bottom:10px"></i>&nbsp;&nbsp;sekretariat@grms.jatengprov.go.id<br>' +
                    '<i class="fa fa-globe" style="padding-bottom:10px"></i>&nbsp;&nbsp;<a target="blank" href="http://grms.jatengprov.go.id">Website GRMS</a></div>',
            confirmButtonText:
                    '<i class="fa fa-close"></i> Tutup'
        });
    });
    /*
     Konfigurasi Tema
     */
    var color = lscache.get("color_brand");
    if (color === null) {
        $(".brand").addClass("bg-gradient-9");
    } else {
        $(".brand").addClass(color);
    }
    var color2 = lscache.get("color_header");
    if (color2 === null) {
        $(".header").css("background-color", "#fff");
    } else {
        $(".header").css("background-color", color2);
    }
    var panel = lscache.get("color_panel");
    if (panel === null) {
        $(".panel-info>.panel-heading").css("background-color", "#d9edf7");
        $(".panel-info>.panel-heading").css("color", "#28282e");
        $(".panel-info>.panel-heading").css("font-weight", "500px");
    } else {
        $(".panel-info>.panel-heading").css("background-color", panel);
        $(".panel-info>.panel-heading").css("color", "#fff");
        $(".panel-info>.panel-heading").css("font-weight", "500px");
    }
    var ukuran_huruf = lscache.get("ukuran_huruf");
    if (ukuran_huruf === null) {
        $("body").css("font-size", "12");
    } else {
        $("body").css("font-size", ukuran_huruf);
    }

    $("#layar").click(function () {
        layar();
    });

});