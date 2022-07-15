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
                    <i class="fas fa-plus-circle"></i> Tambah Kendaraan
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="table-id">
                        <thead>
                            <th>No</th>
                            <th>Nama Sepeda</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($list_mobil as $lu) : ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $lu['nama_mobil']; ?></td>
                                    <td><?php echo $lu['warna_mobil']; ?></td>
                                    <td><?php echo $lu['tahun_mobil']; ?></td>
                                    <td><?php echo $lu['jml_mobil']; ?> Buah</td>
                                    <td>Rp. <?php echo rupiah($lu['harga_sewa']); ?>/24 Jam</td>
                                    <?php if ($lu['status_mobil'] == 1) : ?>
                                        <td>Ready</td>
                                    <?php else : ?>
                                        <td class="text-danger">Tidak Ready</td>
                                    <?php endif; ?>
                                    <td>
                                        <button type="button" class="tombol-edit btn btn-outline-info" data-id="<?php echo $lu['id_mobil']; ?>" data-toggle="modal" data-target="#edit-user"><i class="fas fa-edit"></i> Edit</button>
                                        <a href="<?php echo base_url('admin/info_mobil/' . $lu['id_mobil']); ?>" class="btn btn-outline-secondary"><i class="fas fa-info-circle"></i> Info</a>
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
                <h4 class="modal-title">Tambah Kendaraan</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <?php echo form_open_multipart('admin/mst_mobil'); ?>
                    <div class="form-group">
                        <label>Nama Kendaraan</label>
                        <input type="text" class="form-control" name="nama_mobil" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Warna</label>
                                <input type="text" class="form-control" name="warna_mobil" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" class="form-control" name="tahun_mobil" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" name="jml_mobil" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kapasitas (Orang)</label>
                                <input type="number" class="form-control" name="kapasitas_mobil" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>BBM</label>
                                <input type="text" class="form-control" name="bbm" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Harga Sewa (/Hari)</label>
                            <input type="number" class="form-control" name="harga_sewa" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Gambar Kendaraan</label>
                        <input type="file" class="form-control-file" name="gambar" required>
                    </div>
                    <small>* Ekstensi file jpg, jpeg, png dan max size 10 MB</small>
                    <hr>
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
                <h4 class="modal-title">Edit Kendaraan</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <?php echo form_open_multipart('admin/edit_mobil'); ?>
                    <input type="hidden" name="id_mobil" id="id_mobil">
                    <div class="form-group">
                        <label>Nama Kendaraan</label>
                        <input type="text" class="form-control" name="nama_mobil" id="nama_mobil" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Warna</label>
                                <input type="text" class="form-control" name="warna_mobil" id="warna_mobil" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" class="form-control" name="tahun_mobil" id="tahun_mobil" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" name="jml_mobil" id="jml_mobil" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kapasitas (Orang)</label>
                                <input type="number" class="form-control" name="kapasitas_mobil" id="kapasitas_mobil" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>BBM</label>
                                <input type="text" class="form-control" name="bbm" id="bbm" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Harga Sewa (/Hari)</label>
                            <input type="number" class="form-control" name="harga_sewa" id="harga_sewa" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gambar Kendaraan</label>
                                <input type="file" class="form-control-file" name="gambar">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_mobil" id="inlineRadio1" value="1" checked>
                                    <label class="form-check-label" for="inlineRadio1">Ready</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_mobil" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">Tidak Ready</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <small>* Ekstensi file jpg, jpeg, png dan max size 10 MB</small>
                    <hr>
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
        const id_mobil = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_mobil'); ?>',
            data: {
                id_mobil: id_mobil
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#harga_sewa').val(data.harga_sewa);
                $('#bbm').val(data.bbm);
                $('#kapasitas_mobil').val(data.kapasitas_mobil);
                $('#jml_mobil').val(data.jml_mobil);
                $('#tahun_mobil').val(data.tahun_mobil);
                $('#warna_mobil').val(data.warna_mobil);
                $('#nama_mobil').val(data.nama_mobil);
                $('#id_mobil').val(data.id_mobil);
            }
        });
    });
</script>