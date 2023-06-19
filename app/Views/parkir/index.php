<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Parkir</h3>
                <p class="text-subtitle text-muted">
                    Data Parkir
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>/parkir">Parkir</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Data Parkir
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
                            <form action="<?= base_url() ?>/parkir/show" method="get">
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

            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Data Parkir ( <?= ($no_kend) ? get_no($no_kend) : '' ?> )</h4>
                        <?php if ($no_kend) : ?>
                            <span class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add" data-placement="top" title="Tambah Data">Tambah Data</span>
                            <div class="modal fade text-left" id="add" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
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
                                        <form action="<?= base_url() ?>/parkir/store" method="post">
                                            <div class="modal-body">
                                                <div class="modal-body">
                                                    <input type="hidden" value="<?= $no_kend ?>" name="no_kend">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="tgl">Tanggal</label>
                                                                <input type="date" name="tgl" id="tgl" class="form-control" placeholder="Tanggal" required min="<?= get_tgl_ak_parkir($no_kend) ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="parkir">Parkir</label>
                                                                <input type="text" name="parkir" id="parkir" class="form-control" placeholder="Parkir" required onchange="cek_nilai(this)">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="kuli">Kuli</label>
                                                                <input type="text" name="kuli" id="kuli" class="form-control" placeholder="Kuli" required onchange="cek_nilai(this)">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="tol">Tol</label>
                                                                <input type="text" name="tol" id="tol" class="form-control" placeholder="Tol" required onchange="cek_nilai(this)">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="lain">Lain-lain</label>
                                                                <input type="text" name="lain" id="lain" class="form-control" placeholder="Lain-lain" required onchange="cek_nilai(this)">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="ket">Keterangan</label>
                                                                <textarea name="ket" id="ket" cols="30" rows="4" class="form-control" placeholder="Keterangan"></textarea>
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
                            <table id="table1" class="table table-bordered table-striped" style="width:1500px;">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Parkir</th>
                                        <th>Kuli</th>
                                        <th>Tol</th>
                                        <th>Lain-lain</th>
                                        <th>Keterangan</th>
                                        <?php if (has_permission('audit') || has_permission('manage-all')) : ?>
                                            <th>Action</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($parkir) : ?>
                                        <?php $i = 1 ?>

                                        <?php foreach ($parkir as $r) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $r->tgl; ?></td>
                                                <td><?= number_format($r->parkir, ((int) $r->parkir == $r->parkir ? 0 : 0), '.', ',')  ?></td>
                                                <td><?= number_format($r->kuli, ((int) $r->kuli == $r->parkir ? 0 : 0), '.', ',')  ?></td>
                                                <td><?= number_format($r->tol, ((int) $r->tol == $r->parkir ? 0 : 0), '.', ',')  ?></td>
                                                <td><?= number_format($r->lain, ((int) $r->lain == $r->parkir ? 0 : 0), '.', ',')  ?></td>
                                                <td><?= $r->ket; ?></td>
                                                <?php if (has_permission('audit') || has_permission('manage-all')) : ?>
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
    <?php if ($parkir) : ?>
        <?php foreach ($parkir as $r) : ?>
            <div class="modal fade text-left" id="edit<?= str_replace([' ', '-', ':', ';'], '', $r->inputby); ?>" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
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
                        <form action="<?= base_url() ?>/parkir/update" method="post">
                            <div class="modal-body">
                                <div class="modal-body">
                                    <input type="hidden" value="<?= $no_kend ?>" name="no_kend">
                                    <input type="hidden" value="<?= $r->inputby ?>" name="inputby">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="tgl">Tanggal</label>
                                                <input type="date" name="tgl" id="tgl" class="form-control" placeholder="Tanggal" required value="<?= $r->tgl ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="parkir">Parkir</label>
                                                <input type="text" name="parkir" id="parkir" class="form-control" placeholder="Parkir" required onchange="cek_nilai(this)" value="<?= $r->parkir ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="kuli">Kuli</label>
                                                <input type="text" name="kuli" id="kuli" class="form-control" placeholder="Kuli" required onchange="cek_nilai(this)" value="<?= $r->kuli ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="tol">Tol</label>
                                                <input type="text" name="tol" id="tol" class="form-control" placeholder="Tol" required onchange="cek_nilai(this)" value="<?= $r->tol ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="lain">Lain-lain</label>
                                                <input type="text" name="lain" id="lain" class="form-control" placeholder="Lain-lain" required onchange="cek_nilai(this)" value="<?= $r->lain ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="ket">Keterangan</label>
                                                <textarea name="ket" id="ket" cols="30" rows="4" class="form-control" placeholder="Keterangan"><?= $r->ket ?></textarea>
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
                        <form action="<?= base_url() ?>/parkir/remove" method="post">
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