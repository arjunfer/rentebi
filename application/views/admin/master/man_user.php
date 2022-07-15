    c<div class="content-wrapper">
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
                    <i class="fas fa-plus-circle"></i> Tambah User
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="table-id">
                        <thead>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Register</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($list_user as $lu) : ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $lu['nama']; ?></td>
                                    <td><?php echo $lu['email']; ?></td>
                                    <td><?php echo $lu['level']; ?></td>
                                    <?php if ($lu['is_active'] == 1) : ?>
                                        <td>Aktif</td>
                                    <?php else : ?>
                                        <td><button class="badge badge-danger" style="font-size:14px;">Tidak
                                                Aktif</button></td>
                                    <?php endif; ?>
                                    <td><?php echo format_indo($lu['date_created']); ?></td>
                                    <td><button type="button" class="tombol-edit btn btn-outline-info btn-block" data-id="<?php echo $lu['id_user']; ?>" data-toggle="modal" data-target="#edit-user"><i class="fas fa-edit"></i> Edit</button>
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
                <h4 class="modal-title">Tambah User</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/man_user'); ?>" method="post">
                        <div class="form-group">
                            <label>Level</label>
                            <select class="form-control" name="level">
                                <option value="">- Pilih Level -</option>
                                <option value="Admin">ADMINISTRATOR</option>
                                <option value="User">PETUGAS</option>
                                <option value="Customer">CUSTOMER</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password1" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Repeat Password</label>
                                    <input type="password" class="form-control" name="password2" placeholder="Ketik ulang password" required>
                                </div>
                            </div>
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
                                <option value="Customer">CUSTOMER</option>
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