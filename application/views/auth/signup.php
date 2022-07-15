<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url('assets/login/'); ?>fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?php echo base_url('assets/login/'); ?>css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/login/'); ?>css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/login/'); ?>css/style.css">

    <title>Registration</title>
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                <?php if (validation_errors()) { ?>
                    <div class="alert alert-danger">
                        <a class="close" data-dismiss="alert">x</a>
                        <strong><?php echo strip_tags(validation_errors()); ?></strong>
                    </div>
                <?php } ?>
                <div class="col-md-6">
                    <img src="<?php echo base_url('assets/login/'); ?>images/tree.jpg" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Registration Form</h3>
                                <p class="mb-4">Silahkan Isi form dibawah untuk pendaftaran</p>
                            </div>
                            <?php echo $this->session->flashdata('msg'); ?>
                            <form action="<?php echo base_url('auth/signup'); ?>" method="post">
                                <div class="form-group first">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="form-group first">
                                    <label for="email">Alamat Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group last">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password1" required>
                                </div>
                                <div class="form-group last">
                                    <label for="password">Repeat Password</label>
                                    <input type="password" class="form-control" id="password" name="password2" required>
                                </div>
                                <input type="submit" value="Register" class="btn btn-block btn-primary mt-2 mb-3">
                            </form>
                            <a href="<?php echo base_url('auth/index'); ?>" class="font-weight-bold text-decoration-none" style="margin-top:25px;">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="<?php echo base_url('assets/login/'); ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url('assets/login/'); ?>js/main.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/swal/'); ?>sweetalert2.all.min.js"></script>
    <script src="<?= base_url('assets/swal/'); ?>myscript.js"></script>
</body>

</html>