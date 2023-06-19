<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Data History Service Kendaraan (<?= get_no($srv->no_kend) ?>)</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <table id="table2" class="table table-bordered table-striped" style="width:2200px;">
                                <thead>
                                    <tr>
                                        <th class="bg-primary text-white" style="z-index: 4;">No.</th>
                                        <th>Stock Point</th>
                                        <th>Nomor Service</th>
                                        <th>Jenis Service</th>
                                        <th>Kilometer</th>
                                        <th>Rincian Masalah</th>
                                        <th>Rincian Perbaikan</th>
                                        <th>Tanggal Service</th>
                                        <th>Tempat Service</th>
                                        <th>Alamat Service</th>
                                        <th>Pengajuan Biaya</th>
                                        <th>Biaya Service</th>
                                        <th class="bg-primary text-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>

                                    <?php foreach ($history as $r) : ?>
                                        <tr>
                                            <td class="bg-primary text-white" style="z-index: 4;"><?= $i++ ?></td>
                                            <td><?= sp($r->kdsp) ?></td>
                                            <td><?= $r->nosrv; ?></td>
                                            <td><?= $r->service; ?></td>
                                            <td><?= $r->km; ?></td>
                                            <td><?= $r->detail; ?></td>
                                            <td><?= $r->detail2; ?></td>
                                            <td><?= $r->tglsrv; ?></td>
                                            <td><?= $r->nm_srv; ?></td>
                                            <td><?= $r->alm_srv; ?></td>
                                            <td><?= number_format($r->nilai, ((int) $r->nilai == $r->nilai ? 0 : 0), '.', ',')  ?></td>
                                            <td><?= number_format($r->nilai2, ((int) $r->nilai2 == $r->nilai2 ? 0 : 0), '.', ',')  ?></td>
                                            <td class="bg-primary text-white d-flex">
                                                <button type="submit" class="badge bg-secondary" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#show" data-placement="top" title="Lihat Nota">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Data Service Kendaraan (<?= get_no($srv->no_kend) ?>)</h4>
                        <h5>No. <?= $srv->nosrv ?></h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <?php foreach ($srv_d as $d) : ?>
                                <div class="row p-2 rounded mb-2">
                                    <div class="col-md-3">
                                        <h5>Jenis Service</h5>
                                        <p style="border-bottom: 2px solid black;"><?= $d->nosrv ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Rincian Masalah</h5>
                                        <p style="border-bottom: 2px solid black;"><?= $d->detail ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>Nilai Service</h5>
                                        <p style="border-bottom: 2px solid black;"><?= number_format($d->nilai, ((int) $d->nilai == $d->nilai ? 0 : 0), '.', ',')  ?></p>
                                    </div>
                                    <?php if ($d->kdjns == "R06") : ?>
                                        <div class="col-md-2">
                                            <h5>Kilometer</h5>
                                            <p style="border-bottom: 2px solid black;"><?= $d->km ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <hr>
                            <?php endforeach; ?>
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <h5>Total Biaya Service</h5>
                                    <p style="border-bottom: 2px solid black;"><?= number_format($srv->nilai_awal, ((int) $srv->nilai_awal == $srv->nilai_awal ? 0 : 0), '.', ',')  ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end ">
                <button type="submit" class="btn btn-danger" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#danied">Danied</button>
                <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approve">Approve</button>
            </div>
        </div>
    </section>
</div>

<!-- Modal App -->
<div class="modal fade text-left" id="approve" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Approve Data</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <form action="<?= base_url() ?>/approv/app" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nosrv">Nomor</label>
                            <input type="text" name="nosrv" id="nosrv" class="form-control" placeholder="Nomor" value="<?= $srv->nosrv ?>" readonly>
                        </div>
                        <p>Apakah anda yakin ingin menyetujuinya?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Approve</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Danied -->
<div class="modal fade text-left" id="danied" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Danied Data</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <form action="<?= base_url() ?>/approv/danied" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nosrv">Nomor</label>
                            <input type="text" name="nosrv" id="nosrv" class="form-control" placeholder="Nomor" value="<?= $srv->nosrv ?>" readonly>
                        </div>
                        <p>Apakah anda yakin ingin tidak menyetujuinya?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
                    </button>
                    <button type="submit" class="btn btn-danger ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Danied</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Show -->
<div class="modal fade text-left" id="show" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Show Data</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div id="Gallerycarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="<?= base_url() ?>/assets/img/nota/<?= $srv->foto ?>" />
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
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>