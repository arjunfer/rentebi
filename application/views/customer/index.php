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
        <div class="alert alert-light" role="alert">
            <div class="row">
                <div class="col-md-12">
                    <h5>Selamat Datang, <strong><?php echo $user['nama']; ?></strong></h5>
                </div>
            </div>
        </div>

        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
        <?php echo $this->session->flashdata('msg'); ?>
        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger">
                <a class="close" data-dismiss="alert">x</a>
                <strong><?php echo strip_tags(validation_errors()); ?></strong>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/dist/img/profile/' . $user['image']); ?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?php echo $user['nama']; ?></h3>

                        <p class="text-muted text-center"><?php echo $user['email']; ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Register</b> <a class="float-right"><?php echo format_indo($user['date_created']); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Status</b> <a class="float-right">Online</a>
                            </li>
                            <li class="list-group-item">
                                <b>Level</b> <a class="float-right"><?php echo $user['level']; ?></a>
                            </li>
                        </ul>
                        <button type="button" class="btn btn-outline-primary btn-sm btn-block" data-toggle="modal" data-target="#profile"><i class="fas fa-edit"></i> Ubah Profil</button>
                        <button type="button" class="btn btn-outline-primary btn-sm btn-block" data-toggle="modal" data-target="#ubah-pass"><i class="fa fa-key"></i> Ubah Password</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">

                <?php if ($user['register'] == 1) : ?>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            Silahkan isi data di bawah ini untuk mendapatkan akses ke semua fitur
                        </div>
                        <div class="card-body">
                            <form action="<?php echo base_url('customer/registrasi'); ?>" method="post">
                                <div class="form-group">
                                    <label>Alamat Lengkap</label>
                                    <textarea class="form-control" name="alamat_customer" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>No Telp / HP</label>
                                    <input type="number" class="form-control" name="telp_customer" required>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Kirim Data</button>
                            </form>
                        </div>
                    <?php else : ?>
                        <div class="card card-primary card-outline">
                            <div class="card-header ">
                                <h6 class="m-0 font-weight-bold">Activity <a href="<?php echo base_url('customer/reset/' . $user['id_user']); ?>" class="tombol-reset btn btn-secondary btn-sm float-right"><i class="fa fa-spinner"></i> Reset Activity</a></h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-sm" id="table-id">
                                        <thead>
                                            <th>#</th>
                                            <th>Tgl</th>
                                            <th>Jam</th>
                                            <th>Activity</th>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($activity as $lu) : ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo format_indo($lu['date_activity']); ?></td>
                                                    <td><?php echo $lu['time_activity']; ?></td>
                                                    <td><?php echo $lu['activity']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    </div>
            </div>
    </section>
</div>


<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Profil</h5>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('customer/edit_profile'); ?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo $user['email']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" value="<?php echo $user['nama']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 font-weight-bolder">Photo</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?php echo base_url('assets/dist/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image">
                                    <label class="custom-file-label" for="image">Pilih File</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan </button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ubah-pass">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Password</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('customer/ubah_password'); ?>" method="post">
                        <div class="form-group">
                            <label for="current_password">Password Lama</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password1">Password Baru</label>
                            <input type="password" class="form-control" id="new_password1" name="new_password1" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password2">Ulang Password Baru</label>
                            <input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="Ketik ulang password baru" required>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Simpan Perubahan </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>