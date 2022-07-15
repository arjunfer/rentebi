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
                    <i class="fas fa-plus-circle"></i> Buat Nota
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="table-id">
                        <thead>
                            <th>No</th>
                            <th>Tgl</th>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Telp</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($list_nota as $lu) : ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo format_indo($lu['tgl_nota']); ?></td>
                                    <td><?php echo $lu['no_nota']; ?></td>
                                    <td><?php echo $lu['nama_pelanggan']; ?></td>
                                    <td><?php echo $lu['no_telp']; ?></td>
                                    <td class="text-primary">Sewa</td>
                                    <td><a href="<?php echo base_url('user/detail/' . $lu['id_nota']); ?>" class="btn btn-outline-info btn-block"><i class="fas fa-edit"></i> Detail</a>
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
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('user/input'); ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tgl_nota" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No Nota</label>
                                    <input type="text" class="form-control" name="no_nota" value="<?php echo $no_nota; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input type="text" class="form-control" name="nama_pelanggan" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No Telp</label>
                                    <input type="number" class="form-control" name="no_telp" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jaminan</label>
                                    <input type="text" class="form-control" name="jaminan" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Sepeda</label>
                            <select class="form-control" name="sepeda_id" id="pilih" required>
                                <option value="">- Pilih Sepeda -</option>
                                <?php foreach ($list_sepeda as $k) : ?>
                                    <option value="<?php echo $k['id_sepeda']; ?>" data-othervalue="<?php echo $k['harga_sewa']; ?>"><?php echo $k['nama_sepeda']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" name="harga_sewa" id="otherValue">
                        <script>
                            $('#pilih').change(function() {
                                var otherValue = $(this).find('option:selected').attr('data-othervalue');
                                $('#otherValue').val(otherValue);
                            });
                        </script>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Durasi</label>
                                    <input type="number" class="form-control" name="durasi_sewa" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Durasi Sewa ( Start ) </label>
                                    <input type="time" class="form-control" name="durasi_sewa1" required>
                                </div>
                                </div>
                                <div class="col-md-5">
                                <div class="form-group">
                                <label>Durasi Sewa ( End )</label>
                                <input type="time" class="form-control" name="durasi_sewa2" required>
                                
                        </div>
                        </div>
                            </div>
                            <!--  -->
                        </div>
                        <button type=" submit" class="btn btn-primary mr-2">Simpan Data</button>
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
                <h4 class="modal-title">Edit User</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/edit_user'); ?>" method="post">
                        <input type="hidden" name="id_user" id="id_user">
                        <div class="form-group">
                            <label>Level</label>
                            <select class="form-control" name="level" id="level">.
                                <option value="">- Pilih Level -</option>
                                <option value="Admin">ADMINISTRATOR</option>
                                <option value="User">USER</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" id="nama" value="<?php set_value('nama'); ?>" required>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" value="1" checked>
                                <label class="form-check-label">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" value="0">
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
        const id_user = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_user'); ?>',
            data: {
                id_user: id_user
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama').val(data.nama);
                $('#level').val(data.level);
                $('#id_user').val(data.id_user);
            }
        });
    });
</script>