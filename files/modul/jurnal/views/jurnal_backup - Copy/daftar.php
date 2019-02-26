<?php
$user = $this->session->userdata('user');
?>
<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="text-center tebal">JURNAL</h4>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <form class="form-horizontal" action="#" method="post" id="myform">
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-2">
                            <label for="jenis">Jenis</label>
                            <select class="form-control" name="jenis" id="jenis" required="">
                                <option value="" selected="">Pilih Jurnal</option>
                                <option value="lo">Jurnal LO</option>
                                <option value="lra">Jurnal LRA</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="bulan">Tanggal Awal</label>
                            <input type="text" class="form-control" id="tanggal_awal" placeholder="Masukkan tanggal awal...">
                        </div>
                        <div class="col-md-1 text-center" style="margin-top: 30px;">
                            <label>s/d</label>
                        </div>
                        <div class="col-md-2">
                            <label for="bulan">Tanggal Akhir</label>
                            <input type="text" class="form-control" id="tanggal_akhir" placeholder="Masukkan tanggal akhir...">
                        </div>
                        <div class="col-md-2">
                            <label for="keyword">&nbsp;</label>
                            <button type="submit" class="btn btn-info form-control" id="btnBuka" title="Tampilkan Jurnal"><i class="fa fa-eye"></i> Tampilkan</button>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div><br>
                <table class="table table-no-bordered" cellspacing="0" width="100%" border="0">
                    <tr>
                        <td class="text-center txt-b" style="font-size: 14px;">PROVINSI/KABUPATEN/KOTA ................</td>
                    </tr>
                    <tr>
                        <td class="text-center txt-b" style="font-size: 18px;">DINAS PENDAPATAN</td>
                    </tr>
                    <tr>
                        <td class="text-center txt-b" style="font-size: 14px;">DATA JURNAL TRANSAKSI</td>
                    </tr>
                    <tr>
                        <td class="text-center txt-b" style="font-size: 14px;">TAHUN ANGGARAN 2016</td>
                    </tr>
                </table>
                <div class="table-responsive">
                    <div class="form-group">
                        <a href="#">
                            <button type="button" class="btn btn-panjang btn-primary pull-right"><i class="fa fa-print"></i> Cetak</button>
                        </a>
                        <a href="#">
                            <button type="button" class="btn btn-panjang btn-success pull-right" style="margin-right: 10px"><i class="fa fa-file-excel-o"></i> EX. Excel</button>
                        </a>
                        <!--                        <a href="#">
                                                    <button type="button" class="btn btn-panjang btn-warning pull-right" style="margin-right: 10px"><i class="fa fa-file-pdf-o"></i> EX. PDF</button>
                                                </a>-->
                        <div class="h3 uppercase"><span id="jenisnya"></span> <span id="title_tanggal_awal"></span> <span id="title_tanggal_akhir"></span></div>
                    </div>
                    <div class="clearfix"></div><br/>
                    <div id="data"></div>
                    <div id="data2"></div>

                    <!--BEGIN: Hapus-->
                    <div class="row">
                        <div class="col-md-12 bg-danger" style="padding-top: 10px;">
                            <dt>TABEL</dt>
                            <dd>Select dari tabel "x"</dd>
                            <dd>Urut berdasar Tanggal dan Waktu (Jam, Menit, Detik)</dd>
                            <br/>
                            <dt>JENIS</dt>
                            <dd>JUDUL dan DATA berubah sesuai JENIS yang dipilih.</dd>
                            <br/>
                            <dt>Jurnal LO</dt>
                            <dd>Jurnal yang akan mencatat transaksi-transaksi secara akrual khususnya transaksi terkait akun <b>Neraca</b> dan <b>Laporan Operasional (LO)</b>.</dd>
                            <br/>
                            <dt>Jurnal LRA</dt>
                            <dd>Pendapatan-LRA, Penerimaan Pembiayaan, Belanja, Bank dan Pengeluaran Pembiayaan.</dd>
                            <dd>Jurnal LRA ini nantinya akan menghasilkan <b>Laporan Realisasi Anggaran (LRA)</b>. </dd>
                            <dd>Jurnal LRA ini digunakan untuk merekam anggaran dan realisasinya selama periode berjalan.</dd>
                            <br/>
                            <dt>TOTAL</dt>
                            <dd>Total Debet dan Kredit harus sebanding</dd>
                            <br/>
                            <dt>SALDO</dt>
                            <dd>Nominal narik dari saldo di akun</dd>
                            <br/>
                            <dt>Debet</dt>
                            <dd>Urutan didahulukan dari debet</dd>
                            <br/>
                        </div>
                    </div>
                    <!--END: Hapus-->
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#data").slideUp(100, function () {
            var jenis = $("#jenis :selected").val();
            $("#jenisnya").html(jenis);
            $("#data").load('<?php echo site_url('jurnal/data_jurnal'); ?>').slideDown(1000);
        });

        $("#tanggal_awal").on("keyup", function () {
            var text = this.value;
            $("#title_tanggal_awal").html(' - ' + text);
        });

        $("#tanggal_akhir").on("keyup", function () {
            var text = this.value;
            $("#title_tanggal_akhir").html(' s/d ' + text);
        });

        $("#jenis").on("change", function () {
            var jenis = $(this).val();
            get_data(jenis);
            if (jenis === 'lo') {
                var jenisnya = 'Jurnal LO';
            } else if (jenis === 'lra') {
                var jenisnya = 'Jurnal LRA';
            }
            $("#jenisnya").html(jenisnya);
        });

        function get_data(jenis) {
            $(this).each(function () {
                $("#data").slideUp(500, function () {
                    $("#data").load('<?php echo site_url('jurnal/data_jurnal'); ?>' + "/" + jenis).slideDown(1000);
                });
            });
        }

//        $('#btnBuka').click(function () {
//        });
    });
</script>