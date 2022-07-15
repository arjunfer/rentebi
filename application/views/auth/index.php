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

    <title>Login - EBI</title>
    <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      body {
  font-family: "Open Sans", sans-serif;
  height: 100vh;
  background: url("https://i.imgur.com/VqtLavt.jpg") 50% fixed;
  background-size: cover;
}
    </style>
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
                
                <div class="col-md-8 contents" style="margin-bottom:5%;">
                    <div class="row justify-content-left">
                    <div class="col-md-6">
                            <div class="mb-3">
                            <h3 class="text-dark font-weight-normal min-300">Sign In</h3> 
                                <span class="font-weight-bold">Selamat Datang Kembali di Aplikasi Rent Bike</span>
                            </div>
                            <?php echo $this->session->flashdata('msg'); ?>
                            <form action="<?php echo base_url('auth/index'); ?>" method="post">
                                <div class="form-group first">
                                    <label for="email">Alamat Email</label>
                                    <input type="text" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group last mb-2">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <input type="submit" value="Sign In" class="btn btn-block btn-primary mt-2 mb-2">
                            </form>
                            
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