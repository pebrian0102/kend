<div class="header-top">
    <div class="container">
        <div class="logo">
            <a href="index.html"><img src="<?= base_url() ?>/assets/img/logo.png" alt="Logo" style="height:40px;"></a>
        </div>
        <div class="header-top-right">

            <div class="dropdown">
                <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar avatar-md2">
                        <img src="<?= base_url() ?>/assets/img/user/<?= user()->image ?>" alt="Avatar">
                    </div>
                    <div class="text">
                        <h6 class="user-dropdown-name"><?= user()->username ?></h6>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                    <li><a class="dropdown-item" href="<?= base_url() ?>/user/index"">My Account</a></li>
                    <li>
                        <hr class=" dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="<?= base_url() ?>/logout">Logout</a></li>
                </ul>
            </div>

            <!-- Burger button responsive -->
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </div>
    </div>
</div>