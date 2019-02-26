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
                        <div class="col-md-offset-5 col-md-2">
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
                        <div class="h3 uppercase"><span id="jenisnya"></span> <span id="title_tanggal_awal"></span> <span id="title_tanggal_akhir"></span></div>
                    </div>
                    <div class="clearfix"></div><br/>

                    <table class="table table-bordered table-hover dTable">
                        <thead>
                            <tr>
                                <th class="text-center" width="10%">TANGGAL</th>
                                <th class="text-center" width="10%">NO. BUKTI</th>
                                <th class="text-center" width="15%">KODE REKENING</th>
                                <th class="text-center" colspan="2" width="auto">URAIAN</th>
                                <th class="text-center" width="5%">REF</th>
                                <th class="text-center" width="15%">DEBET</th>
                                <th class="text-center" width="15%">KREDIT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1 Januari 2013</td>
                                <td class="text-left">xxx</td>
                                <td class="text-center">1.1.3.05.01</td>
                                <td class="text-left" colspan="2">Piutang Bagi Hasil Pajak</td>
                                <td></td>
                                <td class="text-right">300.000.000</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-left">xxx</td>
                                <td class="text-center">8.2.1.01.04</td>
                                <td></td>
                                <td class="text-left">Pendapatan Bagi Hasil dari PPh 21-LO</td>
                                <td></td>
                                <td></td>
                                <td class="text-right">300.000.000</td>
                            </tr>
                            <tr>
                                <td class="text-center">3 Januari 2013</td>
                                <td class="text-left">xxx</td>
                                <td class="text-center">1.1.1.01.01</td>
                                <td class="text-left" colspan="2">Kas di Kas Daerah</td>
                                <td></td>
                                <td class="text-right">300.000.000</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-left">xxx</td>
                                <td class="text-center">1.1.3.05.01</td>
                                <td></td>
                                <td class="text-left">Piutang Bagi Hasil Pajak</td>
                                <td></td>
                                <td></td>
                                <td class="text-right">300.000.000</td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-left">xxx</td>
                                <td class="text-center text-i">3.1.2.05.01</td>
                                <td class="text-left text-i" colspan="2">Estimasi Perubahan SAL</td>
                                <td></td>
                                <td class="text-right text-i">300.000.000</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-left">xxx</td>
                                <td class="text-center text-i">4.2.1.01.04</td>
                                <td></td>
                                <td class="text-left text-i">Pendapatan Bagi Hasil dari PPh 21-LRA</td>
                                <td></td>
                                <td></td>
                                <td class="text-right text-i">300.000.000</td>
                            </tr>
                            <tr>
                                <td class="text-center">4 Januari 2013</td>
                                <td class="text-left">xxx</td>
                                <td class="text-center">9.1.5.05.03</td>
                                <td class="text-left" colspan="2">Beban Hibah kepada Organisasi Kepemudaan</td>
                                <td></td>
                                <td class="text-right">15.000.000</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-left">xxx</td>
                                <td class="text-center">2.1.5.06.03</td>
                                <td></td>
                                <td class="text-left">Utang Belanja Hibah</td>
                                <td></td>
                                <td></td>
                                <td class="text-right">15.000.000</td>
                            </tr>
                            <tr>
                                <td class="text-center">5 Januari 2013</td>
                                <td class="text-left">xxx</td>
                                <td class="text-center">1.1.8.01.09</td>
                                <td class="text-left" colspan="2">RK SKPD - Dinas Pendapatan</td>
                                <td></td>
                                <td class="text-right">20.000.000</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-left">xxx</td>
                                <td class="text-center">1.1.1.01.01</td>
                                <td></td>
                                <td class="text-left">Kas di Kas Daerah</td>
                                <td></td>
                                <td></td>
                                <td class="text-right">20.000.000</td>
                            </tr>
                            <tr>
                                <td class="text-center">7 Januari 2013</td>
                                <td class="text-left">xxx</td>
                                <td class="text-center">2.1.5.06.03</td>
                                <td class="text-left" colspan="2">Utang Belanja Hibah</td>
                                <td></td>
                                <td class="text-right">15.000.000</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-left">xxx</td>
                                <td class="text-center">1.1.1.01.01</td>
                                <td></td>
                                <td class="text-left">Kas di Kas Daerah</td>
                                <td></td>
                                <td></td>
                                <td class="text-right">15.000.000</td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-left">xxx</td>
                                <td class="text-center text-i">5.1.5.05.03</td>
                                <td class="text-left text-i" colspan="2">Belanja Hibah kepada Organisasi Kepemudaan</td>
                                <td></td>
                                <td class="text-right text-i">15.000.000</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-left">xxx</td>
                                <td class="text-center text-i">3.1.2.05.01</td>
                                <td></td>
                                <td class="text-left text-i">Estimasi Perubahan SAL</td>
                                <td></td>
                                <td></td>
                                <td class="text-right text-i">15.000.000</td>
                            </tr>
                            <tr>
                                <td class="text-center">8 Januari 2013</td>
                                <td class="text-left">xxx</td>
                                <td class="text-center">1.1.8.01.09</td>
                                <td class="text-left" colspan="2">RK SKPD - Dinas Pendapatan</td>
                                <td></td>
                                <td class="text-right">30.000.000</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-left">xxx</td>
                                <td class="text-center">1.1.1.01.01</td>
                                <td></td>
                                <td class="text-left">Kas di Kas Daerah</td>
                                <td></td>
                                <td></td>
                                <td class="text-right">30.000.000</td>
                            </tr>
                            <tr>
                                <td class="text-center">13 Januari 2013</td>
                                <td class="text-left">xxx</td>
                                <td class="text-center">1.1.1.01.01</td>
                                <td class="text-left" colspan="2">Kas di Kas Daerah</td>
                                <td></td>
                                <td class="text-right">25.000.000</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-left">xxx</td>
                                <td class="text-center">1.1.8.01.09</td>
                                <td></td>
                                <td class="text-left">RK SKPD - Dinas Pendapatan</td>
                                <td></td>
                                <td></td>
                                <td class="text-right">25.000.000</td>
                            </tr>
                        </tbody>
                    </table>

                    <!--BEGIN: Hapus-->
                    <div class="row">
                        <div class="col-md-12 bg-danger" style="padding-top: 10px;">
                            <dt>TABEL</dt>
                            <dd>Select dari tabel "x"</dd>
                            <dd>Urut berdasar Tanggal dan Waktu (Jam, Menit, Detik)</dd>
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
        $("#tanggal_awal").on("keyup", function () {
            var text = this.value;
            $("#title_tanggal_awal").html(' - ' + text);
        });

        $("#tanggal_akhir").on("keyup", function () {
            var text = this.value;
            $("#title_tanggal_akhir").html(' s/d ' + text);
        });
    });
</script>