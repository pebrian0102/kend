<nav class="main-navbar">
    <div class="container">
        <ul>
            <li class="menu-item  ">
                <a href="<?= base_url() ?>/home/dashboard" class='menu-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-item  has-sub">
                <a href="#" class='menu-link'>
                    <i class="bi bi-file-earmark-medical-fill"></i>
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
            <li class="menu-item  has-sub">
                <a href="#" class='menu-link'>
                    <i class="bi bi-file-earmark-medical-fill"></i>
                    <span>Pendataan</span>
                </a>
                <div class="submenu">
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            <li class="submenu-item">
                                <a href="<?= base_url() ?>/pendataan/service" class='submenu-link'>Pengajuan Service</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="menu-item  has-sub">
                <a href="#" class='menu-link'>
                    <i class="bi bi-file-earmark-medical-fill"></i>
                    <span>Persetujuan</span>
                </a>
                <div class="submenu">
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            <li class="submenu-item">
                                <a href="form-layout.html" class='submenu-link'>Persetujaun Service</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</nav>