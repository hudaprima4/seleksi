<div class="panel panel-info" style="min-width: 900px; width: auto;">
    <div class="panel-heading">
        <h4 class="text-center tebal">FORM [TAMBAH/EDIT] AKUN YANG BERPENGARUH</h4>
    </div>
    <div class="panel-body">
        <div class="col-lg-12">
            <form action="<?php echo site_url(); ?>jurnal/kondisi" method="post" class="form-horizontal">
                <div class="col-md-6">
                    <label for="Jenis Modul">Jenis Modul</label>
                    <select class="form-control" name="modul" id="modul" required="">
                        <option value="BP GU DRAF (Tunai & Bank)">BP GU - DRAF (Tunai)</option>
                    </select>
                </div>
                <div class="clearfix"></div><br/>
                <div class="form-horizontal">
                    <figure class="panel-body bg-info">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="40%" rowspan="2">AKUN PERMENDAGRI 64</th>
                                    <th class="text-center" width="40%" colspan="2">POSISI</th>
                                    <th class="text-center" width="20%" rowspan="2">AKSI</th>
                                </tr>
                                <tr>
                                    <th class="text-center" width="20%">DEBET</th>
                                    <th class="text-center" width="20%">KREDIT</th>
                                </tr>
                                <tr>
                                    <th class="text-center">
                                        <select class="form-control" name="posisi">
                                            <option value="xxx">Uraian Akun</option>
                                            <option value="xxx">Uraian Akun</option>
                                            <option value="xxx">Uraian Akun</option>
                                        </select>
                                    </th>
                                    <th class="text-center"><input type="radio" name="posisi" value="" class="form-control"></th>
                                    <th class="text-center"><input type="radio" name="posisi" value="" class="form-control"></th>
                                    <th class="text-center">
                                        <a href="#"><button type="button" class="btn btn-success" title="Tambah"><i class="fa fa-plus"></i></button></a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">Kode Unik 1 - Uraiannya</td>
                                    <td class="text-center"><i class="fa fa-check 2x" aria-hidden="true"></i></td>
                                    <td class="text-center"></td>
                                    <td class="text-center">
                                        <a href="#"><button type="button" class="btn btn-danger" title="Hapus"><i class="fa fa-remove"></i></button></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">Kode Unik 3 - Uraiannya</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"><i class="fa fa-check 2x" aria-hidden="true"></i></td>
                                    <td class="text-center">
                                        <a href="#"><button type="button" class="btn btn-danger" title="Hapus"><i class="fa fa-remove"></i></button></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">Kode Unik 2 - Uraiannya</td>
                                    <td class="text-center"><i class="fa fa-check 2x" aria-hidden="true"></i></td>
                                    <td class="text-center"></td>
                                    <td class="text-center">
                                        <a href="#"><button type="button" class="btn btn-danger" title="Hapus"><i class="fa fa-remove"></i></button></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">Kode Unik 4 - Uraiannya</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"><i class="fa fa-check 2x" aria-hidden="true"></i></td>
                                    <td class="text-center">
                                        <a href="#"><button type="button" class="btn btn-danger" title="Hapus"><i class="fa fa-remove"></i></button></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </figure>
                </div>
                <div class="clearfix"></div><br/>
                <div class="col-lg-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right" title="Simpan Data"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
                <!--Begin: Hapus-->
                <div class="col-lg-12">
                    <div class="form-group bg-danger">
                        <dl class="dl" style="padding: 10px 10px 0px 10px;">
                            <dt>Caranya</dt>
                            <dd>Seperti modul tambah pajak dulu</dd>
                            <br/>
                            <dt>Jenis Modul</dt>
                            <dd>Dari daftar master modul</dd>
                            <br/>
                            <dt>Dropdown AKUN PERMENDAGRI 64</dt>
                            <dd>Dari semua akun level 5, selain level 5 dari kondisi khusus.</dd>
                            <br/>
                        </dl>
                    </div>
                </div>
                <!--End: Hapus-->
            </form>
        </div>
    </div>
</div>