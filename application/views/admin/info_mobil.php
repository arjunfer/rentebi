<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/mst_mobil'); ?>" class="btn btn-info btn-sm">Kembali</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <img src="<?php echo base_url('assets/gambar/' . $detail['gambar']); ?>" class="img-fluid" alt="Responsive image">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h6 class="font-weight-bolder">Info Kendaraan : </h6>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Nama Mobil</b> <a class="float-right"><?php echo $detail['nama_mobil']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Warna Mobil</b> <a class="float-right"><?php echo $detail['warna_mobil']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Tahun Pembuatan</b> <a class="float-right"><?php echo $detail['tahun_mobil']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Jumlah Stok</b> <a class="float-right"><?php echo $detail['jml_mobil']; ?> Buah</a>
                            </li>
                            <li class="list-group-item">
                                <b>Kapasitas Penumpang</b> <a class="float-right"><?php echo $detail['kapasitas_mobil']; ?> Orang</a>
                            </li>
                            <li class="list-group-item">
                                <b>Bahan Bakar</b> <a class="float-right"><?php echo $detail['bbm']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Harga Sewa</b> <a class="float-right">Rp. <?php echo rupiah($detail['harga_sewa']); ?> / 24 Jam</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>