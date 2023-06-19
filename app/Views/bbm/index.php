<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data BBM</h3>
                <p class="text-subtitle text-muted">
                    Data BBM
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>/bbm">BBM</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Data BBM
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
                            <form action="<?= base_url() ?>/bbm/show" method="get">
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="no_kend">Kendaraan</label>
                                            <select name="no_kend" id="no_kend" required class="form-control choices">
                                                <option value="" selected disabled>-- Pilih --</option>
                                                <?php foreach ($kend as $k) : ?>
                                                    <option value="<?= $k->no_kend ?>" <?= (($no_kend ? $no_kend : "") == $k->no_kend ? 'selected' : '') ?>><?= $k->no_kend ?></option>
                                                <?php endforeach; ?>
                                            </select>
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

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Data BBM ( <?= ($no_kend) ? get_no($no_kend) : '' ?> )</h4>
                        <?php if ($no_kend) : ?>
                            <span class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add" data-placement="top" title="Tambah Data">Tambah Data</span>
                            <div class="modal fade text-left" id="add" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel1">Tambah Data</h5>
                                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </button>
                                        </div>
                                        <form action="<?= base_url() ?>/bbm/store" method="post">
                                            <div class="modal-body">
                                                <div class="modal-body">
                                                    <input type="hidden" value="<?= $no_kend ?>" name="no_kend">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="tglisi">Tanggal Pengisian</label>
                                                                <input type="date" name="tglisi" id="tglisi" class="form-control" placeholder="Tanggal Pengisian" required min="<?= get_tgl_ak($no_kend) ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="km">KM</label>
                                                                <input type="number" name="km" id="km" class="form-control" placeholder="Kilo Meter" required min="<?= get_km_ak($no_kend) ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="rp">Rupiah</label>
                                                                <input type="text" name="rp" id="rp" class="form-control" placeholder="Rupiah" required onchange="cek_nilai(this)">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="liter">Jumlah Liter</label>
                                                                <input type="number" step="0.01" name="liter" id="liter" class="form-control" placeholder="Jumlah Liter" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Tutup</span>
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Submit</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <?php if ($no_kend) : ?>
                                <h5>Rata-rata KM per tahun <?= gettime()->addYears(-1)->getYear() ?> : <?= km_tahun($no_kend, gettime()->addYears(-1)->getYear()) ?> </h5>
                            <?php endif; ?>
                            <table id="table1" class="table table-bordered table-striped" style="width:1100px;">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>KM</th>
                                        <th>Rupiah</th>
                                        <th>Jumlah Liter</th>
                                        <th>Rata-rata KM</th>
                                        <?php if (has_permission('audit') || has_permission('manage-all')) : ?>
                                            <th>Stock Point</th>
                                            <th>Action</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($bbm) : ?>
                                        <?php $i = 1 ?>

                                        <?php foreach ($bbm as $r) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $r->tglisi; ?></td>
                                                <td><?= $r->km; ?></td>
                                                <td><?= number_format($r->rp, ((int) $r->rp == $r->rp ? 0 : 0), '.', ',')  ?></td>
                                                <td><?= $r->liter; ?></td>
                                                <td><?= $r->avg; ?></td>
                                                <?php if (has_permission('audit') || has_permission('manage-all')) : ?>
                                                    <td><?= sp($r->kdsp) ?></td>
                                                    <td>
                                                        <span class="badge bg-success" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#edit<?= str_replace([' ', '-', ':', ';'], '', $r->inputby); ?>" data-placement="top" title="Edit Data">Edit</span>
                                                        <span class="badge bg-danger" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete<?= str_replace([' ', '-', ':', ';'], '', $r->inputby); ?>" data-placement="top" title="Hapus Data">Hapus</span>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?php if (has_permission('audit') || has_permission('manage-all')) : ?>
    <?php if ($bbm) : ?>
        <?php foreach ($bbm as $r) : ?>
            <div class="modal fade text-left" id="edit<?= str_replace([' ', '-', ':', ';'], '', $r->inputby); ?>" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">Edit Data</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>
                        <form action="<?= base_url() ?>/bbm/update" method="post">
                            <div class="modal-body">
                                <div class="modal-body">
                                    <input type="hidden" value="<?= $no_kend ?>" name="no_kend">
                                    <input type="hidden" value="<?= $r->inputby ?>" name="inputby">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tglisi">Tanggal Pengisian</label>
                                                <input type="date" name="tglisi" id="tglisi" class="form-control" placeholder="Tanggal Pengisian" required value="<?= $r->tglisi ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="km">KM</label>
                                                <input type="number" name="km" id="km" class="form-control" placeholder="Kilo Meter" required value="<?= $r->km ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="rp">Rupiah</label>
                                                <input type="text" name="rp" id="rp" class="form-control" placeholder="Rupiah" required onchange="cek_nilai(this)" value="<?= $r->rp ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="liter">Jumlah Liter</label>
                                                <input type="number" step="0.01" name="liter" id="liter" class="form-control" placeholder="Jumlah Liter" required value="<?= $r->liter ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Tutup</span>
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Submit</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade text-left" id="delete<?= str_replace([' ', '-', ':', ';'], '', $r->inputby); ?>" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">Hapus Data</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>
                        <form action="<?= base_url() ?>/bbm/remove" method="post">
                            <div class="modal-body">
                                <div class="modal-body">
                                    <input type="hidden" value="<?= $no_kend ?>" name="no_kend">
                                    <input type="hidden" value="<?= $r->inputby ?>" name="inputby">
                                    <div class="row">
                                        <h3>Apakah anda yakin ingin menghapusnya?</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Tutup</span>
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Submit</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    function open_service(nosrv) {
        window.open('<?= base_url() ?>/data/show_service/' + nosrv, '_blank');
    }

    function NumericInput(inp, locale) {
        var numericKeys = '0123456789';
        inp.addEventListener('keypress', function(e) {
            var event = e || window.event;
            var target = event.target;
            if (event.charCode == 0) {
                return;
            }
            if (-1 == numericKeys.indexOf(event.key)) {
                event.preventDefault();
                return;
            }
        });
        inp.addEventListener('blur', function(e) {
            var event = e || window.event;
            var target = event.target;

            var tmp = target.value.replace(/[,.]/g, '');
            var val = Number(tmp).toLocaleString(locale);

            if (tmp == '') {
                target.value = '';
            } else {
                target.value = val;
            }
        });

        inp.addEventListener('focus', function(e) {
            var event = e || window.event;
            var target = event.target;
            var val = target.value.replace(/[,.]/g, '');

            target.value = val;
        });
    }

    function cek_nilai(e) {
        var text = new NumericInput(e);
    }
</script>

<?= $this->endSection() ?>