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
                    <i class="fas fa-plus-circle"></i> Tambah Cabang
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="table-id">
                        <thead>
                            <th>No</th>
                            <th>Nama Cabang</th>
                            <th>Alamat Cabang</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($list_cabang as $lu) : ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $lu['nama_cabang']; ?></td>
                                    <td><?php echo $lu['alamat_cabang']; ?></td>
                                    <td>
                                        <button type="button" class="tombol-delete btn btn-outline-info" data-id="<?php echo $lu['id_cabang']; ?>" data-toggle="modal" data-target="#delete-user"><i class="fas fa-trash"></i></button>
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
                <h4 class="modal-title">Tambah Cabang</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <?php echo form_open_multipart('admin/mst_cabang'); ?>
                    <div class="form-group">
                        <label>Nama Cabang</label>
                        <input type="text" class="form-control" name="nama_cabang" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat Cabang</label>
                        <input type="text" class="form-control" name="alamat_cabang" required>
                    </div>
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
        const id_cabang = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_cabang'); ?>',
            data: {
                id_cabang: id_cabang
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#alamat_cabang').val(data.alamat_cabang);
                $('#nama_cabang').val(data.nama_cabang);
                $('#id_cabang').val(data.id_cabang);
            }
        });
    });
</script>