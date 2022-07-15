<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">

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
                <h4><?php echo $title; ?></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="table-id">
                        <thead>
                            <th>#</th>
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
                                    <td class="text-success">Selesai</td>
                                    <td><a href="<?php echo base_url('customer/detail/' . $lu['id_nota']); ?>" class="btn btn-outline-info btn-block"><i class="fas fa-edit"></i> Detail</a>
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