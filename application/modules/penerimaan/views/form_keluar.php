<div class=" col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="text-center tebal">FORM TAMBAH PENGELUARAN BARANG</h4>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <form id="penerima_form" class="form-horizontal" action="<?php echo $urlnya . 'penerimaan/proses_keluar' ?>" method="post">
                    <div class="panel panel-default">
                        <div class="text-center tebal h4">
                            PENGELUARAN
                        </div>
                        <hr class="style14">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label>Tanggal</label>
                                    <div class="input-group input-append">
                                        <div class="input-group-addon unclick"><i class="fa fa-calendar"></i></div>
                                        <input type="text" required="" name="tanggal_bukti" id="tanggal_bukti" class="form-control" placeholder="Masukkan Tanggal">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label name="Program" id="kategori">Opd</label>
                                    <select class="form-control chosen-select" name="opd">
                                        <option value="0">Pilih OPD</option>
                                        <?php foreach ($opd as $value) { ?>
                                            <option value="<?php echo enkripsi($value->id); ?>"><?php echo $value->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label name="Program" id="kategori">Kategori</label>
                                    <select class="form-control chosen-select" name="kategori" id="kat">
                                        <option value="0">Pilih Barang</option>
                                        <?php foreach ($barang as $value) { ?>
                                            <option value="<?php echo enkripsi($value->id); ?>"><?php echo $value->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="Kegiatan">Barang</label>
                                    <select class="form-control" name="barang" id="barang">
                                        <option value="0">Pilih Kegiatan</option>
                                    </select>
                                </div>
                            </div>   
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label name="Program" id="kategori">Merk</label>
                                    <select class="form-control chosen-select" name="merk" id="merk" disabled="">
                                        <option value="0">Pilih Merk</option>
                                        <?php foreach ($merk as $value) { ?>
                                            <option value="<?php echo enkripsi($value->id); ?>"><?php echo $value->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>                                                  
                        </div>
                    </div>  
                    <div class="panel panel-warning ">
                        <div class="panel-body">
                            <div class="collapsed in" id="collapsePajak">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label for="Nilai">Jumlah</label>
                                        <input type="number" class="form-control" name = "jumlah" placeholder="Jumlah">
                                    </div>
                                     <div class="col-md-4">
                                        <label for="Nilai">Pegawai</label>
                                        <input type="text" class="form-control" name = "pegawai" placeholder="pegawai">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br>                                 
                                     <div class="col-md-8">
                                        <label for="Keterangan">Keterangan</label>
                                        <textarea required="" name="keterangan" id="keterangan" rows="2" class="form-control" placeholder="Masukkan Keterangan"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button id="btn-submit" type="submit" class="btn btn-success pull-right" title="Simpan"><i class="fa fa-save"></i> Simpan</button>
                            <button type="button" onclick="history.go(-1);" class="btn btn-default pull-right" title="Kembali ke Daftar" style="margin-right: 10px;"><i class="fa fa-backward"></i> Kembali</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $("#kat").change(function () {
            var kategori = $("#kat :selected").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('/penerimaan/get_barang'); ?>",
                data: "kategori=" + kategori,
                success: function (data) {
                    $("#barang").html(data);
                }
            });
            
        });

        $("#barang").change(function () {
            $("#merk").prop('disabled', false);
        });

        var getYear = <?php echo TAHUN?>;
        var start = '01-01-'+getYear;


        $('#tanggal_bukti').datepicker({
            todayBtn: 1,
            format: 'dd-mm-yyyy',
            autoclose: true,
            startDate : start,
            endDate: '0d'
        }).on('changeDate', function (e) {
            $('#penerima_form').formValidation('revalidateField', 'tanggal_bukti');
        });

        $('#penerima_form').formValidation('destroy').formValidation({
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)'],
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            locale: 'id_ID'
        }).on('success.form.fv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            swal({
                title: 'Konfirmasi Simpan!',
                text: "Apakah anda yakin akan menyimpan data ini?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then(function (tes) {
                if (tes) {
                    $.ajax({
                        url: $('#penerima_form').attr('action'),
                        type: 'POST',
                        data: $('#penerima_form').serialize(),
                        beforeSend: function () {
                            swal({
                                title: "memproses...",
                                imageUrl: "<?php echo base_url("themes/images/ring2.gif"); ?>",
                                showConfirmButton: false
                            });
                        },
                        success: function (data) {
                            swal({title: 'Informasi simpan!',
                                            text: "Data berhasil disimpan.",
                                            type: "success",
                                            showConfirmButton: false
                                        });
                                        setTimeout(function () {
                                            window.location.href = "<?php echo site_url('penerimaan'); ?>";
                                        }, 500);
                        }
                    });
                }
            });
        }).on('success.field.fv', function (e, data) {
            if (data.fv.getSubmitButton()) {
                data.fv.disableSubmitButtons(false);
            }
        });
    });
</script>