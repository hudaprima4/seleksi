<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="text-center tebal">DAFTAR</h4>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <form class="form-horizontal" action="#" method="post">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div class="col-md-3">
                            <div class="btn-group pull-right">
                                <a href="javascript:void(0);" onclick="" class="btn btn-info" title="Tambah Kelompok"><i class="fa fa-info"></i> Info</a>
                                <a href="<?php echo $urlnya; ?>penerimaan/keluar" class="btn btn-success" title="Pengeluaran"><i class="fa fa-plus"></i> Pengeluaran</a>
                                <a href="<?php echo $urlnya; ?>penerimaan/tambah" class="btn btn-success" title="Penerimaan"><i class="fa fa-plus"></i> Penerimaan</a>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;" class="text-center">NO</th>
                                <th style="vertical-align: middle;" class="text-center">OPD</th>
                                <th style="vertical-align: middle;" class="text-center">Barang</th>
                                <th style="vertical-align: middle;" class="text-center">Jumlah</th>
                                <th style="vertical-align: middle;" class="text-center">harga satuan</th>
                                <th style="vertical-align: middle;" class="text-center" width="15%">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kel as $row) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $row->no; ?></td>
                                    <td class="text-center"><?php echo $row->nama_opd; ?></td>
                                    <td><?php echo $row->nama_barang; ?></td>
                                    <td><?php echo $row->jml; ?></td>
                                    <td><?php echo $row->harga; ?></td>
                                    <td><?php echo $row->total; ?></td>
                                </tr>
                                <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
</script>