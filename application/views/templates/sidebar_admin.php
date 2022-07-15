<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('admin/index'); ?>" class="brand-link">
        <img src="<?php echo base_url('assets/'); ?>dist/img/rentebi.jpg" alt="EBI Logo"
            class="brand-image img-circle elevation-5" style="opacity: .8">
        <span class="brand-text font-weight-light font-weight-bolder"><i class="fas fa-bike"></i> RENT EBI</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url('assets/dist/img/profile/' . $user['image']); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo base_url('admin/index'); ?>" class="d-block"><?php echo $user['nama']; ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header"><?php echo $user['level']; ?></li>
                <li class="nav-item">
                    <a href="<?php echo base_url('admin/index'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Beranda</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clone"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/man_user'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Management User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/mst_sepeda'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Master Sepeda</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/mst_cabang'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Master Cabang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/mst_biaya'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Master Biaya</p>
                            </a>
                        </li>
                    </ul>

                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url('admin/laporan'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Laporan</p>
                    </a>
                </li>













                <li class="nav-item">
                    <a href="<?php echo base_url('auth/logout'); ?>" class="nav-link" id="tombol-logout">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p>Sign Out</p>
                    </a>
                </li>










            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>