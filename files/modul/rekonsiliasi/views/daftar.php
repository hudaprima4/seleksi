<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="text-center tebal">PENYESUAIAN KOREKSI</h4>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <form class="form-horizontal" action="#" method="post" id="collapseCari">
                    <div class="form-group">
                        <div class="col-md-offset-8 col-md-3">
                            <label for="unit">Kata Kunci Pencarian</label>
                            <input type="text" class="form-control" placeholder="Masukkan kata kunci pencarian...">
                        </div>
                        <div class="col-md-1">
                            <label for="keyword">&nbsp;</label>
                            <button type="submit" class="btn btn-info form-control" title="Cari Data Akun"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <div class="form-group">
                        <a class="btn btn-success pull-right fancybox.iframe pilih" title="Tambah" href="<?php echo site_url('rekonsiliasi/tambah') ?>"><i class="fa fa-plus"></i> Tambah Koreksi</a>
                    </div>
                    <div class="clearfix"></div><br/>
                    <table class="table table-bordered table-hover dTable">
                        <thead>
                            <tr>
                                <th class="text-center" width="15%" colspan="2">KODE REKENING</th>
                                <th class="text-center" width="auto" colspan="2">URAIAN</th>
                                <th class="text-center" width="15%">DEBIT (Rp)</th>
                                <th class="text-center" width="15%">KREDIT (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left" colspan="2">x.x.x.x.x</td>
                                <td class="text-left" colspan="2">Kas Di Bendahara Pengeluaran</td>
                                <td class="text-right">100.000.000</td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td width="3%">&nbsp;</td>
                                <td class="text-left">x.x.x.x.x</td>
                                <td width="3%">&nbsp;</td>
                                <td class="text-left">R/K PPKD</td>
                                <td class="text-right"></td>
                                <td class="text-right">100.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>