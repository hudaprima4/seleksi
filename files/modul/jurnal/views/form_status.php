<div class="panel panel-info" style="min-width: 600px;">
    <div class="panel-heading">
        <h4 class="text-center tebal">FORM [TAMBAH/EDIT] STATUS</h4>
    </div>
    <div class="panel-body">
        <div class="col-lg-12">
            <form action="<?php echo site_url(); ?>jurnal/master_status" method="post" class="form-horizontal">
                <div class="form-group">   
                    <div class="col-md-12">
                        <label for="Status">Status</label>
                        <input type="text" name="status" class="form-control" placeholder="Masukkan Status" required="">
                    </div>  
                </div>   
                <div class="clearfix"></div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right" title="Simpan Data"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>