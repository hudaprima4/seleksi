<div class="panel panel-info" style="width: 700px;">
    <div class="panel-heading">
        <h4 class="text-center tebal">FORM [TAMBAH/EDIT] KOREKSI</h4>
    </div>
    <div class="panel-body">
        <div class="col-lg-12">
            <form action="<?php echo site_url('rekonsiliasi'); ?>" method="post" class="form-horizontal">
                <div class="box-shadow--2dp">
                    <div class="panel-heading bg-info">Akun Debet</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="Kode Rekening Debet">Kode Rekening</label>
                                <input type="text" name="kode_rekening_debet" class="form-control" value="" placeholder="Masukkan Kode Rekening Debet">
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="Nama Rekening Debet">Nama Rekening</label>
                                <input type="text" name="nama_rekening_debet" class="form-control" value="" placeholder="Masukkan Nama Rekening Debet">
                            </div>         
                        </div>
                    </div>
                </div>
                <br/>
                <div class="box-shadow--2dp">
                    <div class="panel-heading bg-danger">Akun Kredit</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="Kode Rekening Kredit">Kode Rekening</label>
                                <input type="text" name="kode_rekening_kredit" class="form-control" value="" placeholder="Masukkan Kode Rekening Kredit">
                            </div>   
                        </div> 
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="Nama Rekening Kredit">Nama Rekening</label>
                                <input type="text" name="nama_rekening_kredit" class="form-control" value="" placeholder="Masukkan Nama Rekening Kredit">
                            </div>        
                        </div>
                    </div>
                </div>
                <br/>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="Keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control" placeholder="Masukkan Keterangan"></textarea>
                    </div>         
                </div>
                <br/>
                <div class="col-lg-12">
                    <div class="form-group">
                        <button onclick="Close()" type="button" class="btn btn-success pull-right" title="Simpan Data"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>