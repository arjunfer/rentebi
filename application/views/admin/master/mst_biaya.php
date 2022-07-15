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
                    <i class="fas fa-plus-circle"></i> Tambah Biaya
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="table-id">
                        <thead>
                            <th>#</th>
                            <th>Nama Biaya</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($list_biaya as $lu) : ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $lu['nama_biaya']; ?></td>
                                    <td>Rp. <?php echo rupiah($lu['nominal']); ?></td>
                                    <?php if ($lu['status_biaya'] == 1) : ?>
                                        <td>Aktif</td>
                                    <?php else : ?>
                                        <td class="text-danger">Tidak Aktif</td>
                                    <?php endif; ?>
                                    <td>
                                        <button type="button" class="tombol-edit btn btn-outline-info" data-id="<?php echo $lu['id_biaya']; ?>" data-toggle="modal" data-target="#edit-user"><i class="fas fa-edit"></i> Edit</button>
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
                <h4 class="modal-title">Tambah Biaya</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <?php echo form_open_multipart('admin/mst_biaya'); ?>
                    <div class="form-group">
                        <label>Nama Biaya</label>
                        <input type="text" class="form-control" name="nama_biaya" required>
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="number" class="form-control" name="nominal" required>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Simpan Data</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="edit-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Biaya</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <?php echo form_open_multipart('admin/edit_biaya'); ?>
                    <input type="hidden" name="id_biaya" id="id_biaya">
                    <div class="form-group">
                        <label>Nama Biaya</label>
                        <input type="text" class="form-control" name="nama_biaya" id="nama_biaya" required>
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="number" class="form-control" name="nominal" id="nominal" required>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_biaya" value="1" checked>
                            <label class="form-check-label">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_biaya" value="0">
                            <label class="form-check-label">
                                Tidak Aktif
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Simpan Perubahan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.tombol-edit').on('click', function() {
        const id_biaya = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_biaya'); ?>',
            data: {
                id_biaya: id_biaya
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nominal').val(data.nominal);
                $('#nama_biaya').val(data.nama_biaya);
                $('#id_biaya').val(data.id_biaya);
            }
        });
    });
</script>