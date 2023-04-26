<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iframe</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.3/css/OverlayScrollbars.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
    <div class="wrapper">

        <!-- Navbar -->
        <nav style="background-color: #CBF1F5; color:#000;" class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-primary elevation-4" style="background-color: #CBF1F5; color:#000;">
            <!-- Brand Logo -->
            <a href="<?= base_url() ?>" class="brand-link text-center">
                <span class="brand-text font-weight-bold">API</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url() ?>/assets/img/user/<?= user()->image ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="<?= base_url() ?>/user" class="d-block"><?= user()->username ?></a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php if (has_permission('manage-all')) : ?>
                            <li class="nav-item  <?= ($uri->getSegment(1) == "admin") ? 'menu-open' : '' ?>">
                                <a href="<?= base_url() ?>/admin" class="nav-link  <?= ($uri->getSegment(1) == "admin") ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Administrator
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/admin/index" class="nav-link  <?= ($uri->getSegment(2) == "index") ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dashboard</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/admin/user" class="nav-link  <?= ($uri->getSegment(2) == "user") ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>User</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/admin/role" class="nav-link  <?= ($uri->getSegment(2) == "role") ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Role</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/admin/role_perm" class="nav-link  <?= ($uri->getSegment(2) == "role_perm") ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Group and Perm</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if (has_permission('sp') || has_permission('manage-all')) : ?>
                            <li class="nav-item  <?= ($uri->getSegment(1) == "adminsp") ? 'menu-open' : '' ?>">
                                <a href="<?= base_url() ?>/adminsp" class="nav-link  <?= ($uri->getSegment(1) == "adminsp") ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-address-card"></i>
                                    <p>
                                        Stock Point
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/adminsp/index" class="nav-link  <?= ($uri->getSegment(2) == "index") ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if (has_permission('adm-jbr') || has_permission('manage-all')) : ?>
                            <li class="nav-item  <?= ($uri->getSegment(1) == "adminjbr") ? 'menu-open' : '' ?>">
                                <a href="<?= base_url() ?>/adminjbr" class="nav-link  <?= ($uri->getSegment(1) == "adminjbr") ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-address-card"></i>
                                    <p>
                                        Admin Jabar
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/adminjbr/index" class="nav-link  <?= ($uri->getSegment(2) == "index") ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if (has_permission('acc') || has_permission('manage-all')) : ?>
                            <li class="nav-item  <?= ($uri->getSegment(1) == "acc") ? 'menu-open' : '' ?>">
                                <a href="<?= base_url() ?>/acc" class="nav-link  <?= ($uri->getSegment(1) == "acc") ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-address-card"></i>
                                    <p>
                                        ACC
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/acc/index" class="nav-link  <?= ($uri->getSegment(2) == "index") ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Debit Note</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/acc/rekap" class="nav-link <?= ($uri->getSegment(2) == "rekap") ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Rekap Nilai DN</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if (!has_permission('manage-user')) : ?>
                            <li class="nav-item <?= ($uri->getSegment(1) == "debitnote") ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= ($uri->getSegment(1) == "debitnote") ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-file-invoice"></i>
                                    <p>
                                        Debit Note
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/debitnote/barang" class="nav-link <?= ($uri->getSegment(2) == "barang") ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Barang</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/debitnote/biaya" class="nav-link <?= ($uri->getSegment(2) == "biaya") ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Biaya</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/debitnote/b2b" class="nav-link <?= ($uri->getSegment(2) == "b2b") ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>B2B</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item  <?= ($uri->getSegment(1) == "user") ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= ($uri->getSegment(1) == "user") ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-user-alt"></i>
                                <p>
                                    User
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>/user/index" class="nav-link <?= ($uri->getSegment(2) == "index") ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>/user/iframe" class="nav-link <?= ($uri->getSegment(2) == "iframe") ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Iframe</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>/logout" class="nav-link <?= ($uri->getSegment(1) == "logout") ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Logout</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
            <div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">
                <div class="nav-item dropdown">
                    <a class="nav-link bg-danger dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Close</a>
                    <div class="dropdown-menu mt-0">
                        <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all">Close All</a>
                        <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all-other">Close All Other</a>
                        <a class="dropdown-item" href="<?= base_url() ?>/user/index">Close Iframe</a>
                    </div>
                </div>
                <a class="nav-link bg-light" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a>
                <ul class="navbar-nav overflow-hidden" role="tablist"></ul>
                <a class="nav-link bg-light" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a>
                <a class="nav-link bg-light" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a>
            </div>
            <div class="tab-content">
                <div class="tab-empty">
                    <h2 class="display-4">No tab selected!</h2>
                </div>
                <div class="tab-loading">
                    <div>
                        <h2 class="display-4">Tab is loading <i class="fa fa-sync fa-spin"></i></h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                EDP
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; <?= gettime()->getYear(); ?></strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.3/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
</body>

</html>