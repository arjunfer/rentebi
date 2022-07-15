<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <strong>Copyright &copy; 2022 <a href="https://elementbike.id">Element Bike</a>.</strong> All rights reserved.
    </div>
    Created By : <strong><a href="https://www.adoniasite.com/" target="_blank">Jun </a> @<?php echo date('Y'); ?></strong>
</footer>


<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>


<!-- jQuery -->
<script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/'); ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url('assets/'); ?>dist/js/demo.js"></script> -->
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/swal/'); ?>sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/swal/'); ?>myscript.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/'); ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= base_url('assets/'); ?>datatables/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>datatables/buttons.flash.min.js"></script>
<script src="<?= base_url('assets/'); ?>datatables/jszip.min.js"></script>
<script src="<?= base_url('assets/'); ?>datatables/pdfmake.min.js"></script>
<script src="<?= base_url('assets/'); ?>datatables/vfs_fonts.js"></script>
<script src="<?= base_url('assets/'); ?>datatables/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/'); ?>datatables/buttons.print.min.js"></script>

<script>
    $(function() {
        $("#table-id").DataTable();
        $("#table-table").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        $("#dataTable-id").DataTable();
        $("#datatable-id").DataTable();
        $('#id-table').DataTable();
    });
</script>

<script>
    $('.tombol-hapus').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Yakin untuk menghapus ?',
            text: 'Data akan dihapus',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });
</script>

<script>
    $('#tombol-logout').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Konfirmasi Sign Out',
            text: 'Klik Sign Out untuk mengakhiri session',
            type: 'danger',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sign Out'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });
</script>

<script>
    $('.tombol-reset').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Konfirmasi Reset',
            text: 'Klik reset untuk menghapus semua data',
            type: 'danger',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Reset'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });
</script>

</body>

</html>