<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Master Jenis</h3>
                <p class="text-subtitle text-muted">
                    Data Master Jenis
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>/master">Master</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Jenis
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
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Master Jenis</h4>
                        <span class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data</span>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nomor</th>
                                        <th>Jenis</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>

                                    <?php foreach ($result as $r) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $r->no; ?></td>
                                            <td><?= $r->jenis; ?></td>
                                            <td>
                                                <button type="button" class="badge bg-primary block float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#edit<?= $r->no ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="badge bg-danger block float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#delete<?= $r->no ?>">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nomor</th>
                                        <th>Jenis</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal Tambah -->
<div class="modal fade text-left" id="tambah" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
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
            <form action="<?= base_url() ?>/master/jenis_store" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="no">Nomor</label>
                            <input type="text" name="no" id="no" class="form-control" placeholder="Nomor">
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis</label>
                            <input type="text" name="jenis" id="jenis" class="form-control" placeholder="Jenis">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($result as $r) : ?>
    <div class="modal fade text-left" id="edit<?= $r->no ?>" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
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
                <form action="<?= base_url() ?>/master/jenis_update" method="POST">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="no">Nomor</label>
                                <input type="text" name="no" id="no" class="form-control" placeholder="Nomor" value="<?= $r->no ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="jenis">Jenis</label>
                                <input type="text" name="jenis" id="jenis" class="form-control" placeholder="Jenis" value="<?= $r->jenis ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tutup</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- Modal Hapus -->
<?php foreach ($result as $r) : ?>
    <div class="modal fade text-left" id="delete<?= $r->no ?>" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
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
                <form action="<?= base_url() ?>/master/jenis_delete" method="POST">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="no">Nomor</label>
                                <input type="text" name="no" id="no" class="form-control" placeholder="Nomor" value="<?= $r->no ?>" readonly>
                            </div>
                            <p>Apakah anda yakin ingin menghapusnya?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tutup</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Hapus</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?= $this->endSection() ?>