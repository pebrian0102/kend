<nav class="main-navbar">
    <div class="container">
        <ul>
            <li class="menu-item  ">
                <a href="<?= base_url() ?>/home/dashboard" class='menu-link'>
                    <i class="fas fa-house-user"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php if (has_permission('manage-all')) : ?>
                <li class="menu-item  has-sub">
                    <a href="#" class='menu-link'>
                        <i class="fas fa-user-cog"></i>
                        <span>Administrator</span>
                    </a>
                    <div class="submenu">
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/admin/index" class='submenu-link'>Dashboard</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/admin/user" class='submenu-link'>User</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/admin/role" class='submenu-link'>Role</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/admin/role_perm" class='submenu-link'>Group and Permission</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
            <?php if (has_permission('audit') || has_permission('manage-all')) : ?>
                <li class="menu-item  has-sub">
                    <a href="#" class='menu-link'>
                        <i class="fas fa-folder"></i>
                        <span>Master</span>
                    </a>
                    <div class="submenu">
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/master/kend" class='submenu-link'>Data Kendaraan</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/master/service" class='submenu-link'>Service</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/master/fungsi" class='submenu-link'>Fungsi</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/master/jenis" class='submenu-link'>Jenis</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/master/info" class='submenu-link'>Informasi</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <?php if (has_permission('sp') || has_permission('audit') || has_permission('manage-all')) : ?>
                <li class="menu-item  has-sub">
                    <a href="#" class='menu-link'>
                        <i class="fas fa-file"></i>
                        <span>Pendataan</span>
                    </a>
                    <div class="submenu">
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">

                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/data/service" class='submenu-link'>Pengajuan Service</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/bbm/index" class='submenu-link'>Pendataan BBM</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/parkir/index" class='submenu-link'>Pendataan Parkir</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/data/history" class='submenu-link'>History Service</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <?php if (has_permission('spv') || has_permission('audit') || has_permission('nsm') || has_permission('manage-all')) : ?>
                <li class="menu-item  has-sub">
                    <a href="#" class='menu-link'>
                        <i class="fas fa-user-check"></i>
                        <span>Persetujuan</span>
                    </a>
                    <div class="submenu">
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/approv/index" class='submenu-link'>Persetujuan Service</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
            <?php if (has_permission('audit') || has_permission('nsm') || has_permission('manage-all')) : ?>
                <li class="menu-item  has-sub">
                    <a href="#" class='menu-link'>
                        <i class="fas fa-copy"></i>
                        <span>Laporan</span>
                    </a>
                    <div class="submenu">
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/laporan/sp" class='submenu-link'>Laporan Per SP</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/laporan/kend" class='submenu-link'>Laporan Per Kendaraan</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/laporan/kend_jual" class='submenu-link'>Laporan Penjualan</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/laporan/mutasi" class='submenu-link'>Laporan Mutasi</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
            <li class="menu-item  has-sub">
                <a href="#" class='menu-link'>
                    <i class="fas fa-tools"></i>
                    <span>Tool</span>
                </a>
                <div class="submenu">
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            <li class="submenu-item">
                                <a href="<?= base_url() ?>/tool/cek_nomor" class='submenu-link'>Cek Nomor Service</a>
                            </li>
                            <li class="submenu-item">
                                <a href="<?= base_url() ?>/tool/cek_kend" class='submenu-link'>Cek Kendaraan</a>
                            </li>
                            <?php if (has_permission('audit') || has_permission('manage-all')) : ?>
                                <li class="submenu-item">
                                    <a href="<?= base_url() ?>/tool/cetak_kend" class='submenu-link'>Cetak Data Kendaraan</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</nav>