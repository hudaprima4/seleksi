<div class="panel panel-info" style="min-width: 900px; width: auto;">
    <div class="panel-heading">
        <h4 class="text-center tebal">FORM [TAMBAH/EDIT] KONDISI KHUSUS</h4>
    </div>
    <div class="panel-body">
        <div class="col-lg-12">
            <form class="form-horizontal" action="<?php echo site_url('jurnal/kondisi'); ?>" method="post">
                <div class="form-group">
                    <div class="col-md-3">
                        <label for="Level">Pilih Kode Level</label>
                        <select name="level" class="form-control">
                            <option value="1">Kode Level 1</option>
                            <option value="2">Kode Level 2</option>
                            <option value="3" selected="">Kode Level 3</option>
                            <option value="4">Kode Level 4</option>
                            <option value="5">Kode Level 5</option>
                        </select>
                    </div>
                    <div class="col-md-7">
                        <label for="unit">Kata Kunci Pencarian</label>
                        <input type="text" class="form-control" placeholder="Masukkan kata kunci pencarian...">
                    </div>
                    <div class="col-md-2">
                        <label for="keyword">&nbsp;</label>
                        <button type="submit" class="btn btn-info form-control" title="Cari Data Kondisi"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
            </form>
            <table class="table table-bordered table-hover dTable">
                <thead>
                    <tr>
                        <th class="text-center" width="10%">NO.</th>
                        <!--<th class="text-center" width="15%">KODE UNIK 64</th>-->
                        <th class="text-center" width="auto">NAMA AKUN</th>
                        <th class="text-center" width="15%">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <!--<td class="text-left">35</td>-->
                        <td class="text-center">1.1.7 - Persediaan</td>
                        <td class="text-center">
                            <input type="radio" name="pilih" value="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="clearfix"></div>
            <button type="submit" class="btn btn-success pull-right" title="Simpan Data"><i class="fa fa-save"></i> Simpan</button>
        </div>
        <!--Begin: Hapus-->
        <div class="clearfix"></div><br/>
        <div class="col-lg-12">
            <div class="bg-danger">
                <dl class="dl" style="padding: 10px 10px 0px 10px;">
                    <dt>Level</dt>
                    <dd>Jika pilih level 1, maka data di Tabel hanya daftar dengan akun level 1 saja.</dd>
                    <dd>Jika pilih level 2, maka data di Tabel hanya daftar dengan akun level 2 saja.</dd>
                    <dd>Jika pilih level 3, maka data di Tabel hanya daftar dengan akun level 3 saja.</dd>
                    <dd>Jika pilih level 4, maka data di Tabel hanya daftar dengan akun level 4 saja.</dd>
                    <dd>Jika pilih level 5, maka data di Tabel hanya daftar dengan akun level 5 saja.</dd>
                    <dd>dst.</dd>
                    <br/>
                </dl>
            </div>
        </div>
        <!--End: Hapus-->
    </div>
</div>