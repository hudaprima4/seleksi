function tutorial(_slides, cm = null, lebar) {
    $.tutorialize({
        slides: _slides,
        overlayMode: 'focus',
        showButtonNext: true,
        showButtonPrevious: false,
        width: lebar,
        onStart: function () {
            $(cm).find('a.dcjq-parent').trigger('click');
        },
        onStop: function () {
            $(cm).find('a.dcjq-parent').trigger('click');
        }
    });

    $.tutorialize.start();
}
$(document).ready(function () {
    var first = $(location).attr('pathname');
    first.indexOf(1);
    first.toLowerCase();
    first = first.split("/")[1];
    var base_url = window.location.origin;
    $('#data_master1').on('click', function (e) {
        e.preventDefault();
        var _slides = [{
                content: 'Panduan Mengisi Data Master',
                position: 'center-center',
                selector: '.data_master1',
                title: 'Cara Mengisi Data PNS / Bendahara'
            },
            {
                title: 'Data PNS / Bendahara',
                content: 'Klik Menu Data Master',
                position: 'right-top',
                selector: '.data_master'
            }, {
                title: 'Data PNS / Bendahara',
                content: 'Click Menu Bendahara/PNS',
                position: 'right-top',
                selector: '.data_master_bendahara_pns'
            }];
        tutorial(_slides, ".data_master", 250);
    });

    $('#data_master2').on('click', function (e) {
        e.preventDefault();
        var _slides = [{
                content: 'Panduan Mengisi Data Master',
                position: 'center-center',
                selector: '.data_master2',
                title: 'Cara Mengisi Data Rekanan'
            },
            {
                title: 'Data Rekanan',
                content: 'Klik Menu Data Master',
                position: 'right-top',
                selector: '.data_master'
            }, {
                title: 'Data Rekening',
                content: 'Click Menu Rekanan',
                position: 'right-top',
                selector: '.data_master_rekanan'
            }];

        tutorial(_slides, ".data_master", 250);
    });

    $('#data_master3').on('click', function (e) {
        e.preventDefault();
        var _slides = [{
                content: 'Panduan Mengisi Data Master',
                position: 'center-center',
                selector: '.data_master3',
                title: 'Cara Mengisi Data Rekening'
            },
            {
                title: 'Data Rekening',
                content: 'Klik Menu Data Master',
                position: 'right-top',
                selector: '.data_master'
            }, {
                title: 'Data Rekening',
                content: 'Click Menu Rekanan',
                position: 'right-top',
                selector: '.data_master_rekening'
            }];

        tutorial(_slides, ".data_master", 250);
    });

    $('#spp_tu').on('click', function (e) {
        e.preventDefault();
        var _slides = [{
                content: 'Berikut ini adalah langkah untuk mengajukan SPP TU. ',
                position: 'center-center',
                selector: '.mspp_tu',
                title: 'Alur Mengajukan TU (Tambah Uang)'
            },
            {
                title: 'Langkah Pertama (Buat SPP TU)',
                content: 'Buat SPP TU dengan cara Klik Menu SPP.<br>Perlu diketahui SPP TU hanya bisa dibuat oleh user BP atau BPP',
                position: 'right-top',
                selector: '.spp'
            },
            {
                title: 'Langkah Pertama (Buat SPP TU)',
                content: 'Kemudian klik SPP TU, kemudian buat SPP TU.<br> Setelah SPP TU dibuat PPK akan MENOLAK atau SETUJUI SPP TU yang dibuat, jika disetujui status akan jadi Final, jika ditolak status menjadi diTolak dan dapat diajukan lagi.',
                position: 'right-top',
                selector: '.spp_tu',
                onNext: function () {
                    $(".spp").find('a.dcjq-parent').trigger('click');
                    setTimeout(function () {
                        $.tutorialize.next();
                    }, 500);
                }
            },
            {
                title: 'Langkah Kedua (Buat SPM TU)',
                content: 'Setelah SPP TU dibuat selanjutnya PPK akan membuat SPM TU.<br> Untuk membuuat SPM TU dengan cara Klik Menu SPM.<br>Perlu diketahui SPM TU hanya bisa dibuat oleh user PPK',
                position: 'right-top',
                selector: '.spm',
                onNext: function () {
                    $(".spm").find('a.dcjq-parent').trigger('click');
                    setTimeout(function () {
                        $.tutorialize.next();
                    }, 500);
                }
            },
            {
                title: 'Langkah Kedua (Buat SPM TU)',
                content: 'Kemudian klik SPM TU, kemudian buat SPM TU.<br> Setelah SPM TU dibuat status awal akan menjadi Draft.Kemudian PPK dapat mengajukan SPM TU kepada BUD jika data atau kelengkapan dokumen sudah benar.',
                position: 'right-top',
                selector: '.spm_tu',
                onNext: function () {
                    $(".spm").find('a.dcjq-parent').trigger('click');
                    setTimeout(function () {
                        $.tutorialize.next();
                    }, 500);
                }
            },
            {
                title: 'Langkah Ketiga (Buat SP2D TU)',
                content: 'Setelah SPM TU diajukan ke BUD. Selanjutnya BUD akan Mencairkan atau Menolak SPM TU yang dibuat. Kemudian klik SPM TU, kemudian buat SPM TU.<br> Setelah SPM TU dibuat status awal akan menjadi Draft.Kemudian PPK dapat mengajukan SPM TU kepada BUD jika data atau kelengkapan dokumen sudah benar.',
                position: 'right-top',
                selector: '.spm_tu',
                onNext: function () {
                    $(".spm").find('a.dcjq-parent').trigger('click');
                    setTimeout(function () {
                        $.tutorialize.next();
                    }, 500);
                }
            }
        ];

        tutorial(_slides, ".spp", 450);
    });

});