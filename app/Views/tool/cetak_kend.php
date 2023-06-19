<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Kendaraan</h3>
                <p class="text-subtitle text-muted">
                    Data Kendaraan
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>/data">Data</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Kendaraan
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4>Filter Data</h4>
                            <form action="<?= base_url() ?>/tool/cetak_kend_action" method="post">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="kdsp">Stock Point</label>
                                            <select name="kdsp" id="kdsp" required class="form-control choices">
                                                <option value="" selected disabled>-- Pilih --</option>
                                                <?php foreach ($sp as $f) : ?>
                                                    <option value="<?= $f->sp ?>" <?= ((old('kdsp') ? old('kdsp') : "") == $f->sp ? 'selected' : '') ?>><?= $f->nmsp ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('kdsp') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>