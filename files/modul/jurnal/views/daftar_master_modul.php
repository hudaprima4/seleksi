<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="text-center tebal">DAFTAR MASTER MODUL</h4>
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
                            <button type="submit" class="btn btn-info form-control" title="Cari Data Kondisi"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <div class="form-group">
                        <a href="<?php echo site_url('jurnal/tambah_modul') ?>" class="btn btn-success pull-right fancybox.iframe pilih" title="Tambah" style="margin-left: 10px;"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                    <div class="clearfix"></div><br/>
                    <table class="table table-bordered table-hover dTable">
                        <thead>
                            <tr>
                                <th class="text-center" width="10%">NO.</th>
                                <th class="text-center" width="auto">MODUL</th>
                                <th class="text-center" width="15%">STATUS</th>
                                <th class="text-center" width="15%">METODE</th>
                                <th class="text-center" width="15%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-left">BP GU</td>
                                <td class="text-center">Draf, Final, Sudah LPJ</td>
                                <td class="text-center">Y</td>
                                <td class="text-center">
                                    <?php
                                    echo '<a href="' . site_url('jurnal/edit_modul/1') . '" class="btn btn-primary fancybox.iframe pilih" title="Edit Modul"><i class="fa fa-edit"></i></a>
                                    <a href="' . site_url('jurnal/hapus_modul/1') . '"><button type="button" class="btn btn-danger" title="Hapus Modul"><i class="fa fa-remove"></i></button></a>';
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td class="text-left">SP2D</td>
                                <td class="text-center">Draf, Final, Sudah dicairkan</td>
                                <td class="text-center">N</td>
                                <td class="text-center">
                                    <?php
                                    echo '<a href="' . site_url('jurnal/edit_modul/1') . '" class="btn btn-primary fancybox.iframe pilih" title="Edit Modul"><i class="fa fa-edit"></i></a>
                                    <a href="' . site_url('jurnal/hapus_modul/1') . '"><button type="button" class="btn btn-danger" title="Hapus Modul"><i class="fa fa-remove"></i></button></a>';
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--BEGIN: Hapus-->
                    <div class="row">
                        <div class="col-md-12 bg-danger" style="padding-top: 10px;">
                            <dt>TABEL</dt>
                            <dd>Select dari tabel "xxx"</dd>
                            <br/>
                            <dt>AKSI</dt>
                            <dd>Tambah dan Edit pakai popups</dd>
                            <dd>Hapus dengan konfirmasi</dd>
                            <br/>
                        </div>
                    </div>
                    <!--END: Hapus-->
                </div>
            </div>
        </div>
    </div>
</div>