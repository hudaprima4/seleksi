<div class="panel panel-info" style="min-width: 900px; width: auto;">
    <div class="panel-heading">
        <h4 class="text-center tebal">FORM [TAMBAH/EDIT] KONDISI</h4>
    </div>
    <div class="panel-body">
        <div class="col-lg-12">
            <form action="<?php echo site_url('jurnal/master_kondisi'); ?>" method="post" class="form-horizontal">
                <div class="form-group">   
                    <div class="col-md-4">
                        <label for="Modul">Modul</label>
                        <select name="modul" class="form-control">
                            <option value="1">BP GU</option>
                            <option value="2">BP TU</option>
                            <option value="3">SP2D GU</option>
                        </select>
                    </div>   
                    <div class="col-md-4">
                        <label for="Status">Status</label>
                        <select name="status" class="form-control">
                            <option value="2">Draf</option>
                            <option value="4">BP TU</option>
                            <option value="6">SP2D GU</option>
                        </select>
                    </div> 
                    <div class="col-md-4">
                        <label for="Metode">Metode</label>
                        <select name="metode" class="form-control">
                            <option value="Tunai">Tunai</option>
                            <option value="Bank">Bank</option>
                        </select>
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
                            <dt>Metode Muncul dan Tidak</dt>
                            <dd>Metode Muncul dan Tidaknya berdasar ada dan tidaknya transaksi.</dd>
                            <dd>Misalnya: pilih SP2D maka dropdown Metode hilang.</dd>
                            <br/>
                        </dl>
                    </div>
                </div>
                <!--End: Hapus-->
            </form>
        </div>
    </div>
</div>