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
            <div class="card-header">
                <form class="form-inline" action="<?php echo base_url('admin/filter_laporan'); ?>" method="post">
                    <label class="mb-2 mr-sm-2">Tanggal : </label>
                    <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="tanggal_awal" required>
                    <label class="mb-2 mr-sm-2"> s/d </label>
                    <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="tanggal_akhir" required>
                    <button type="submit" class="btn btn-primary btn-sm mb-2">Filter</button>
                </form>
            </div>
            <div class="card-body">
                <h5><?php echo $title; ?></h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="table-table">
                        <thead>
                            <th>#</th>
                            <th>Tgl</th>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Telp</th>
                            <th>Status</th>
                            <th>Grand Total</th>
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
                                    <?php if ($lu['status_nota'] == 1) : ?>
                                        <td class="text-primary">Sewa</td>
                                    <?php else : ?>
                                        <td class="text-success">Selesai</td>
                                    <?php endif; ?>
                                    <td>Rp. <?php echo rupiah($lu['grand_total']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>