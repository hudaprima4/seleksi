<?php

//if (!function_exists('konfirmasi_swal')) {
//
//    /**
//     *
//     * @param string $objek objek yang akan dihapus
//     * @param string $class class tombol,tuliskan tanpa titik default hapus_btn
//     * @param int $aksi tipe konfirmasi (1) hapus, default 1
//     */
//    function konfirmasi_swal($objek, $class = "hapus_btn", $tipe = 1) {
//        $tipetext = "menghapus";
//        if ($tipe == 2) {
//            //untuk kondisi lain
//        }
//        $alert = ' $(".' . $class . '").click(function(e){
//                    e.preventDefault();
//                    var url=$(this).attr("href");';
//        $alert.='swal({
//                    title:"Ingin ' . $tipetext . ' ' . $objek . '?",
//                    text:"Anda tidak dapat mengembalikan data yang telah dihapus",
//                    type: "warning",
//                    confirmButtonColor:"#d43f3a",
//                    showCancelButton:true,
//                    confirmButtonText:"Ya",
//                    cancelButtonText:"Batal",
//                    closeOnConfirm:false
//                },
//                 function(isConfirm){
//                     if(isConfirm){
//                         $.ajax({
//                            type:"POST",
//                            url: url,
//                            asynchronous: true,
//                            cache: false,
//                            beforeSend: function(){
//                              swal({
//                                title:"memproses...",
//                                imageUrl:"/epen/themes/images/ring.gif"
//                              });
//                            },
//                           success: function(result){
//                              if(result){
//                                swal({
//                                    title:"Berhasil",
//                                    text:"' . $objek . ' telah terhapus",
//                                    type:"success",
//                                    closeOnConfirm:false
//                                },
//                                function(ya){
//                                    window.location.reload(false);
//                                });
//                                //swal("Berhasil","' . $objek . ' telah terhapus","success");
//                              }else{
//                                swal("Gagal","' . $objek . ' gagal terhapus","error");
//                              }
//                           }
//                        });
//                     }
//                 }
//            );
//
//        });';
//        echo $alert;
//    }
//
//}

if (!function_exists('konfirmasi_swal')) {

    /**
     *
     * @param string $options array berisi index class, title, subtitle,subtitle_ok,subtitle_fail
     */
    function konfirmasi_swal($objek = '', $options = array()) {
        $options = (!$options) ?
                array("class" => 'hapus_btn',
            "title" => 'Ingin Menghapus ' . $objek . '?',
            "subtitle" => 'Anda tidak dapat mengembalikan data yang telah dihapus',
            "subtitle_ok" => $objek . ' telah terhapus',
            "subtitle_fail" => $objek . ' gagal terhapus'
                ) : $options;
        $alert = ' $(".' . $options['class'] . '").click(function(e){
                    e.preventDefault();
                    var url=$(this).attr("href");';
        $alert .= 'swal({
                    title:"' . $options['title'] . '",
                    text:"' . $options['subtitle'] . '",
                    type: "question",
                    confirmButtonColor:"#d43f3a",
                    width: "600px",
                    showCancelButton:true,
                    confirmButtonText:"Ya",
                    cancelButtonText:"Tidak",
                    closeOnConfirm:false
                }).then(function (isConfirm) {
                     if(isConfirm){
                         $.ajax({
                            type:"POST",
                            url: url,
                            asynchronous: true,
                            cache: false,
                            beforeSend: function(){
                              swal({
                                title:"memproses...",
                                imageUrl:"./themes/images/ring2.gif",
                                showConfirmButton:false
                              });
                            },
                           success: function(result){
                              if(result){
                                swal({
                                    title:"Berhasil",
                                    text:"' . $options['subtitle_ok'] . '",
                                    type:"success",
                                    showConfirmButton: false
                                });
                                setTimeout(function () {
                                 window.location.reload(false);
                                 }, 500);
                              }else{
                                swal("Gagal","' . $options['subtitle_fail'] . '","error");
                              }
                           }
                        });
                     }
                 }
            );

        });';
        echo $alert;
    }

}