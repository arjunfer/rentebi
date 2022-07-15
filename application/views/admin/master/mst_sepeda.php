<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
            <?php if (validation_errors()) { ?>
            <div class="alert alert-danger">
                <a class="close" data-dismiss="alert">x</a>
                <strong><?php echo strip_tags(validation_errors()); ?></strong>
            </div>
            <?php } ?>
            <div class="card-header">
                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#add-user">
                    <i class="fas fa-plus-circle"></i> Tambah Kendaraan
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="table-id">
                        <thead>
                            <th>No</th>
                            <th>Sepeda</th>
                            <th>Tahun</th>
                            <th>Jumlah</th>
                            <th>No Barcode</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($list_sepeda as $lu) : ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $lu['nama_sepeda']; ?></td>
                                <td><?php echo $lu['tahun_sepeda']; ?></td>
                                <td><?php echo $lu['jml_sepeda']; ?> Buah</td>
                                <td><?php echo $lu['kode_barcode']; ?></td>
                                <td>Rp. <?php echo rupiah($lu['harga_sewa']); ?>/ Jam</td>
                                <?php if ($lu['status_sepeda'] == 1) : ?>
                                <td>Ready</td>
                                <?php else : ?>
                                <td class="text-danger">Tidak Ready</td>
                                <?php endif; ?>
                                <td>
                                    <button type="button" class="tombol-delete btn btn-outline-info"
                                        data-id="<?php echo $lu['id_sepeda']; ?>" data-toggle="modal"
                                        data-target="#delete-user"><i class="fas fa-trash"></i></button>
                                    <a href="<?php echo base_url('admin/info_sepeda/' . $lu['id_sepeda']); ?>"
                                        class="btn btn-outline-info"><i class="fas fa-info-circle"></i></a>
                                    <a href="<?php echo base_url('admin/barcode_qrcode/' . $lu['id_sepeda']); ?>"
                                        class="btn btn-outline-info"><i class="fas fa-barcode"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="add-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Sepeda</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <?php echo form_open_multipart('admin/mst_sepeda'); ?>
                    <div class="form-group">
                        <label>Nama Sepeda</label>
                        <input type="text" class="form-control" name="nama_sepeda" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" class="form-control" name="tahun_sepeda" required>
                            </div>
                        </div>
                    
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jumlah Sepeda</label>
                                <input type="number" class="form-control" name="jml_sepeda" required>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No Barcode</label>
                                <input type="number" class="form-control" name="kode_barcode" required>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <label>Harga Sewa (/ Jam)</label>
                            <input type="number" class="form-control" name="harga_sewa" required>
                        </div>
                        </div>
                    <div class="form-group">
                        <label>Gambar Sepeda</label>
                        <input type="file" class="form-control-file" name="gambar" required>
                    </div>
                    <small>* Ekstensi file jpg, jpeg, png dan max size 10 MB</small>
                    <hr>
                    <button type="submit" class="btn btn-primary mr-2">Simpan Data</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$('.tombol-edit').on('click', function() {
    const id_sepeda = $(this).data('id');
    $.ajax({
        url: '<?php echo base_url('admin/get_sepeda'); ?>',
        data: {
            id_sepeda: id_sepeda
        },
        method: 'post',
        dataType: 'json',
        success: function(data) {
            $('#harga_sewa').val(data.harga_sewa);
            $('#kode_barcode').val(data.kode_barcode);
            $('#jml_sepeda').val(data.jml_sepeda);
            $('#tahun_sepeda').val(data.tahun_sepeda);
            $('#nama_sepeda').val(data.nama_sepeda);
            $('#id_sepeda').val(data.id_sepeda);
        }
    });
});
</script>