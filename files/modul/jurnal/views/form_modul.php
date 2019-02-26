<div class="panel panel-info" style="min-width: 900px; width: auto;">
    <div class="panel-heading">
        <h4 class="text-center tebal">FORM [TAMBAH/EDIT] MODUL</h4>
    </div>
    <div class="panel-body">
        <div class="col-lg-12">
            <form action="<?php echo site_url('jurnal/master_modul'); ?>" method="post" class="form-horizontal">
                <div class="form-group">      
                    <div class="col-md-2">
                        <label for="No.">No.</label>
                        <input type="text" name="no_modul" class="form-control" value="2" readonly="">
                    </div>  
                    <div class="col-md-4">
                        <label for="Modul">Modul</label>
                        <input type="text" name="modul" class="form-control" value="BP GU" placeholder="Masukkan Modul">
                    </div>  
                </div>
                <div class="form-group">    
                    <div class="col-md-2">
                        <label for="Status">Status</label><br/>
                    </div>
                    <div class="col-md-2">
                        <input type="checkbox" name="status[]" value="x"> Persiapan<br/>
                        <input type="checkbox" name="status[]" value="2" checked=""> Draf
                    </div>
                    <div class="col-md-2">
                        <input type="checkbox" name="status[]" value="x"> Ditolak<br/>
                        <input type="checkbox" name="status[]" value="4" checked=""> Final
                    </div>
                    <div class="col-md-2">
                        <input type="checkbox" name="status[]" value="x"> Belum SPP<br/>
                        <input type="checkbox" name="status[]" value="x"> Sudah SPP
                    </div>
                    <div class="col-md-2">
                        <input type="checkbox" name="status[]" value="x"> Belum LPJ<br/>
                        <input type="checkbox" name="status[]" value="6" checked=""> Sudah LPJ
                    </div>
                    <div class="col-md-2">
                        <input type="checkbox" name="status[]" value="x"> Belum dicairkan<br/>
                        <input type="checkbox" name="status[]" value="x"> Sudah dicairkan
                    </div>
                </div>
                <div class="form-group">    
                    <div class="col-md-2">
                        <label for="Metode">Metode</label><br/>
                    </div>
                    <div class="col-md-10">
                        <input type="radio" name="metode" value="Y" checked=""> Ada Pilihan Tunai & Bank<br/>
                        <input type="radio" name="metode" value="N"> Tidak Ada Pilihan Tunai & Bank
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right" title="Simpan Data"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
                <!--Begin: Hapus-->
                <div class="col-lg-12">
                    <div class="form-group bg-danger">
                        <dl class="dl" style="padding: 10px 10px 0px 10px;">
                            <dt>No.</dt>
                            <dd>Urutan setelah nomer terakhir di tabel</dd>
                            <br/>
                            <dt>Modul</dt>
                            <dd>Wajib mengisi, ada validasi apakah inputan sudah ada di tabel master atau belum.</dd>
                            <br/>
                            <dt>Status</dt>
                            <dd>Banyak sedikitnya pilihan status, ini dari daftar Master Status</dd>
                            <dd>Wajib memilih salah satunya</dd>
                            <br/>
                            <dt>Metode</dt>
                            <dd>Wajib memilih salah satunya</dd>
                            <br/>
                        </dl>
                    </div>
                </div>
                <!--End: Hapus-->
            </form>
        </div>
    </div>
</div>