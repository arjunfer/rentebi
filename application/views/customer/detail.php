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
                <h5 class="font-weight-bolder">
                    <?php echo $title; ?> Nota : <?php echo $nota['no_nota']; ?>
                    <br>
                    <?php if ($nota['status_nota'] == 1) : ?>
                        <div class="badge badge-primary">Mobil Sewa</div>
                    <?php else : ?>
                        <div class="badge badge-success">Mobil Kembali</div>
                    <?php endif; ?>

                    <?php if ($nota['status_nota'] == 1) : ?>
                        <a href="<?php echo base_url('customer/input'); ?>" class="btn btn-info btn-sm float-right"> Kembali</a>
                    <?php else : ?>
                        <a href="<?php echo base_url('customer/list_selesai'); ?>" class="btn btn-info btn-sm float-right"> Kembali</a>
                    <?php endif; ?>
                </h5>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Tanggal</b> <a class="float-right"><?php echo format_indo($nota['tgl_nota']); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Nama Pelanggan</b> <a class="float-right"><?php echo $nota['nama_pelanggan']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Alamat</b> <a class="float-right"><?php echo $nota['alamat_pelanggan']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>No Telp</b> <a class="float-right"><?php echo $nota['no_telp']; ?> Orang</a>
                            </li>
                            <li class="list-group-item">
                                <b>Jaminan</b> <a class="float-right"><?php echo $nota['jaminan']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Jumlah Hari</b> <a class="float-right"><?php echo $nota['jml_sewa']; ?> Hari</a>
                            </li>
                            <li class="list-group-item">
                                <b>Tgl Sewa</b> <a class="float-right"><?php echo format_indo($nota['tgl_sewa1']); ?> - <?php echo format_indo($nota['tgl_sewa2']); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Total Bayar</b> <a class="float-right">Rp <?php echo rupiah($nota['tot_bayar']); ?></a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Nama Mobil</b> <a class="float-right"><?php echo $nota['nama_mobil']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Warna Mobil</b> <a class="float-right"><?php echo $nota['warna_mobil']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Tahun Pembuatan</b> <a class="float-right"><?php echo $nota['tahun_mobil']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Jumlah Stok</b> <a class="float-right"><?php echo $nota['jml_mobil']; ?> Buah</a>
                            </li>
                            <li class="list-group-item">
                                <b>Kapasitas Penumpang</b> <a class="float-right"><?php echo $nota['kapasitas_mobil']; ?> Orang</a>
                            </li>
                            <li class="list-group-item">
                                <b>Bahan Bakar</b> <a class="float-right"><?php echo $nota['bbm']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Harga Sewa</b> <a class="float-right">Rp. <?php echo rupiah($nota['harga_sewa']); ?> / 24 Jam</a>
                            </li>
                            <li class="list-group-item">
                                <?php if ($grand_total == NULL) : ?>
                                    <b>Grand Total</b> <a class="float-right">Rp. 0</a>
                                <?php else : ?>
                                    <b>Grand Total</b> <a class="blink float-right font-weight-bolder">Rp. <?php echo rupiah($grand_total['grand_total']); ?></a>
                                <?php endif; ?>
                            </li>

                        </ul>
                    </div>
                </div>
                <hr>

                <h4 class="font-weight-bolder">
                    Biaya Tambahan
                </h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="table-id">
                        <thead>
                            <th>#</th>
                            <th>Nama Biaya</th>
                            <th>Nominal</th>
                            <th>QTY</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($detail_biaya as $lu) : ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $lu['nama_biaya']; ?></td>
                                    <td>Rp <?php echo rupiah($lu['harga_biaya']); ?></td>
                                    <td><?php echo $lu['qty']; ?></td>
                                    <td>Rp <?php echo rupiah($lu['sub_total']); ?></td>
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
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Biaya</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('user/detail_nota'); ?>" method="post">
                        <input type="hidden" name="nota_id" value="<?php echo $nota['id_nota']; ?>">
                        <div class="form-group">
                            <label>Biaya Tambahan</label>
                            <select class="form-control" name="biaya_id" id="pilih" required>
                                <option value="">- Pilih -</option>
                                <?php foreach ($list_biaya as $k) : ?>
                                    <option value="<?php echo $k['id_biaya']; ?>" data-othervalue="<?php echo $k['nominal']; ?>"><?php echo $k['nama_biaya']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <script>
                            $('#pilih').change(function() {
                                var otherValue = $(this).find('option:selected').attr('data-othervalue');
                                $('#otherValue').val(otherValue);
                            });
                        </script>
                        <input type="hidden" class="form-control" id="otherValue" name="harga_biaya" readonly />
                        <div class="form-group">
                            <label>Qty</label>
                            <input type="number" class="form-control" name="qty" required>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Simpan Data</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="selesai">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Selesai</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('user/selesai_nota'); ?>" method="post">
                        <input type="hidden" name="nota_id" value="<?php echo $nota['id_nota']; ?>">
                        <input type="hidden" name="nota_no" value="<?php echo $nota['no_nota']; ?>">
                        <input type="hidden" name="mobil_id_sewa" value="<?php echo $nota['mobil_id']; ?>">
                        <input type="hidden" name="jml_mobil_sewa" value="<?php echo $nota['jml_mobil']; ?>">
                        <input type="hidden" name="tot_bayar_sewa" value="<?php echo $nota['tot_bayar']; ?>">
                        <input type="hidden" name="tot_bayar_tambahan" value="<?php echo $tot_detail; ?>">
                        Total Sewa : Rp. <?php echo rupiah($nota['tot_bayar']); ?>
                        <br>
                        Total Biaya Tambahan : Rp. <?php echo rupiah($tot_detail); ?>

                </div>
                <hr>
                <button type="submit" class="btn btn-primary mr-2">Selesai</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>