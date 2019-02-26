<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="text-center tebal">FORM [TAMBAH/EDIT] AKUN</h4>
            <h4 class="text-center tebal">DINAS KEHUTANAN</h4>
            <h5 class="text-center tebal">Unit Dinas Kehutanan</h5>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <form action="<?php echo site_url('akun'); ?>" method="post" id="xxx">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="Parent">Jenis Akun</label>
                            <select class="form-control" name="jenis" required="">
                                <option value="0">-</option>
                                <option value="1">Aset Lancar</option>
                                <option value="2">Investasi Jangka Panjang</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="No.Akun">No.Akun</label>
                            <input type="text" name="no_akun" class="form-control" value="">
                        </div>
                        <div class="col-md-3">
                            <label for="Nama Akun">Nama Akun</label>
                            <input type="text" name="nama_akun" class="form-control" value="" placeholder="Masukkan Nama Akun...">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="Keterangan">Keterangan</label>
                            <textarea name="xxx" class="form-control" placeholder="[Optional] Masukkan Keterangan..."></textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div><br/>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button id="btn-submit" type="submit" class="btn btn-success pull-right" title="Simpan Data Akun"><i class="fa fa-save"></i> Simpan</button>
                            <button onclick="history.go(-1);" class="btn btn-default pull-right"  title="Kembali ke Daftar Akun" style="margin-right: 10px;"><i class="fa fa-backward"></i> Kembali</button>
                        </div>
                    </div>
                </form>
            </div>
            <!--BEGIN: HAPUS-->
            <div class="col-md-12 bg-danger">
                <dt>Jenis Akun</dt>
                <dd>Jika tidak dipilih menjadi data Induk, jika dipilih maka data akun itu masuk subjenis dari akun yang dipilih.</dd>
                <br/>
                <dt>Keterangan</dt>
                <dd>Optional</dd>
                <br/>
            </div>
            <!--END: HAPUS-->
        </div>
    </div>
</div>