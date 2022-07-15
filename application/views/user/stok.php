<div class="content-wrapper">
    <section class="content-header">

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
                <h5 class="font-weight-bolder"><?php echo $title; ?></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($list_sepeda as $lu) : ?>
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <img class="card-img-top" src="<?php echo base_url('assets/gambar/' . $lu['gambar']); ?>" style="width:288px;height:200px;">
                                <div class="card-body">
                                    <h5 class="text-center font-weight-bolder"><?php echo $lu['nama_sepeda']; ?></h5>
                                    <p class="card-text text-center">
                                        Rp <?php echo rupiah($lu['harga_sewa']); ?> / 24 Jam
                                        <br><span class="font-weight-bolder text-large">Stock : <?php echo $lu['jml_sepeda']; ?></span></br>
                                        <a href="<?php echo base_url('user/info_sepeda/' . $lu['id_sepeda']); ?>" class="btn btn-light btn-sm btn-block">Info</a>
                                    </p>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</div>