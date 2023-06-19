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
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Data Kendaraan</h4>
                        <a href="<?= base_url() ?>/master/add_kend" class="btn btn-success">Tambah Data</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped" style="width:2500px;">
                                <thead>
                                    <tr>
                                        <th class="bg-primary text-white" style="z-index: 4;">No.</th>
                                        <th>Stock Point</th>
                                        <th>No. Polisi</th>
                                        <th>No. STNK</th>
                                        <th>Nama STNK</th>
                                        <th>Exp. STNK</th>
                                        <th>No. Pajak</th>
                                        <th>Exp. Pajak</th>
                                        <th>Merk/Type</th>
                                        <th>Jenis Kendaraan</th>
                                        <th>Fungsi Kendaraan</th>
                                        <th>Tgl. Pembelian</th>
                                        <th>Thn. Pembuatan</th>
                                        <th>Isi Silinder</th>
                                        <th>Warna</th>
                                        <th>No. Rangka</th>
                                        <th>No. Mesin</th>
                                        <th>Status Kendaraan</th>
                                        <th class="bg-primary text-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>

                                    <?php foreach ($result as $r) : ?>
                                        <tr>
                                            <td class="bg-primary text-white" style="z-index: 4;"><?= $i++ ?></td>
                                            <td><?= sp($r->kdsp) ?></td>
                                            <td><?= $r->no_kend; ?></td>
                                            <td><?= $r->no_stnk; ?></td>
                                            <td><?= $r->nm_stnk; ?></td>
                                            <td><?= $r->exp_stnk; ?></td>
                                            <td><?= $r->no_pjk; ?></td>
                                            <td><?= $r->exp_pjk; ?></td>
                                            <td><?= $r->merk; ?> / <?= $r->type; ?></td>
                                            <td><?= $r->jenis; ?></td>
                                            <td><?= $r->fungsi; ?></td>
                                            <td><?= $r->tgl_beli; ?></td>
                                            <td><?= $r->thn_buat; ?></td>
                                            <td><?= $r->isi_slndr; ?></td>
                                            <td><?= $r->warna; ?></td>
                                            <td><?= $r->no_rangka; ?></td>
                                            <td><?= $r->no_mesin; ?></td>
                                            <td>
                                                <?php if ($r->sts == 0) : ?>
                                                    <span class="badge bg-danger">Sudah Dijual</span>
                                                <?php else : ?>
                                                    <span class="badge bg-success">Aktif</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="bg-primary text-white d-flex">
                                                <div class="btn-group dropstart">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li class="dropdown-item">
                                                            <button type="button" onclick="open_service('<?= $r->no_kend ?>')" class="badge bg-secondary block float-right" style="margin-right: 10px;" data-placement="top" title="Lihat data">
                                                                <i class="fas fa-eye"></i> Lihat Data
                                                            </button>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <form action="<?= base_url() ?>/master/edit_kend" method="get">
                                                                <input type="hidden" name="no_kend" value="<?= $r->no_kend ?>">
                                                                <?php if ($r->sts == 1) : ?>
                                                                    <button type="submit" class="badge bg-primary block float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#edit<?= $r->no_kend ?>" data-placement="top" title="Edit data">
                                                                        <i class="fas fa-pen"></i> Edit Data
                                                                    </button>
                                                                <?php endif; ?>
                                                            </form>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <button type="button" class="badge bg-danger block float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#delete<?= $r->no_kend ?>" data-placement="top" title="Hapus data">
                                                                <i class="fas fa-trash"></i> Hapus Data
                                                            </button>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <button type="button" class="badge bg-success block float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#mutasi<?= $r->no_kend ?>" data-placement="top" title="Mutasi Kendaraan">
                                                                <i class="fas fa-arrows-alt-h"></i> Mutasi Kendaraan
                                                            </button>
                                                        </li>
                                                        <?php if ($r->sts == 1) : ?>
                                                            <li class="dropdown-item">
                                                                <button type="button" class="badge bg-warning block float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#sell<?= $r->no_kend ?>" data-placement="top" title="Jual Kendaraan">
                                                                    <i class="fas fa-coins"></i> Jual Kendaraan
                                                                </button>
                                                            </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>

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
    </section>
</div>


<!-- Modal Hapus -->
<?php foreach ($result as $r) : ?>
    <div class="modal fade text-left" id="delete<?= $r->no_kend ?>" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
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
                <form action="<?= base_url() ?>/master/kend_delete" method="POST">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="no_kend">Nomor</label>
                                <input type="text" name="no_kend" id="no_kend" class="form-control" placeholder="Nomor" value="<?= $r->no_kend ?>" readonly>
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
<?php foreach ($result as $r) : ?>
    <div class="modal fade text-left" id="mutasi<?= $r->no_kend ?>" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Mutasi Data</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <form action="<?= base_url() ?>/master/kend_mutasi" method="POST">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="no_kend">Nomor</label>
                                <input type="text" name="no_kend" id="no_kend" class="form-control" placeholder="Nomor" value="<?= $r->no_kend ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="sp">Stock Point</label>
                                <input type="text" name="sp" id="sp" class="form-control" placeholder="Stock Point" value="<?= sp($r->kdsp) ?>" readonly>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kdsp">Mutasi</label>
                                    <select name="kdsp" id="kdsp" required class="form-control choices">
                                        <option value="" selected disabled>-- Pilih --</option>
                                        <?php foreach ($sp as $f) : ?>
                                            <option value="<?= $f->sp ?>" <?= ((old('kdsp') ? old('kdsp') : "") == $f->sp ? 'selected' : '') ?>><?= $f->nmsp ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tgl">Tanggal Mutasi</label>
                                <input type="datetime-local" name="tgl" id="tgl" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ket">Keterangan</label>
                                    <textarea name="ket" id="ket" cols="30" rows="5" class="form-control" placeholder="Keterangan"></textarea>
                                </div>
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
<?php foreach ($result as $r) : ?>
    <div class="modal fade text-left" id="sell<?= $r->no_kend ?>" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Jual Kendaraan</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <form action="<?= base_url() ?>/master/kend_sell" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="no_kend" value="<?= $r->no_kend ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="nm">Nama Pembeli</label>
                                    <input type="text" placeholder="Nama Pembeli" id="nm" required class="form-control" name="nm" value="<?= (old('nm') ? old('nm') : '') ?>" />
                                    <div class="text-danger">
                                        <small style="font-size:14px;"><?= $validation->getError('nm') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="nik">NIK Pembeli</label>
                                    <input type="text" id="nik" required placeholder="NIK Pembeli" class="form-control" name="nik" value="<?= (old('nik') ? old('nik') : '') ?>" />
                                    <div class="text-danger">
                                        <small style="font-size:14px;"><?= $validation->getError('nik') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="npwp">NPWP Pembeli</label>
                                    <input type="text" id="npwp" required placeholder="NPWP Pembeli" class="form-control" name="npwp" value="<?= (old('npwp') ? old('npwp') : '') ?>" />
                                    <div class="text-danger">
                                        <small style="font-size:14px;"><?= $validation->getError('npwp') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="alamat">Alamat Pembeli</label>
                                    <textarea name="alamat" id="alamat" cols="50" rows="2" class="form-control" placeholder="Alamat" required><?= (old('alamat') ? old('alamat') : '') ?></textarea>
                                    <div class="text-danger">
                                        <small style="font-size:14px;"><?= $validation->getError('alamat') ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="tgl_jual">Tanggal Jual</label>
                                    <input type="date" id="tgl_jual" required class="form-control" name="tgl_jual" value="<?= (old('tgl_jual') ? old('tgl_jual') : '') ?>" />
                                    <div class="text-danger">
                                        <small style="font-size:14px;"><?= $validation->getError('tgl_jual') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="ket">Keterangan</label>
                                    <textarea name="ket" id="ket" cols="50" rows="2" class="form-control" placeholder="Keterangan" required><?= (old('ket') ? old('ket') : '') ?></textarea>
                                    <div class="text-danger">
                                        <small style="font-size:14px;"><?= $validation->getError('ket') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="col-md-10">
                                    <label>Bukti Nota</label>
                                </div>
                                <div class="mb-3">
                                    <input required class="form-control" type="file" id="foto" name="foto" onchange="previewImg()" value="<?= (old('foto') ? old('foto') : '') ?>" />
                                    <div class="text-danger">
                                        <small style="font-size:14px;"><?= $validation->getError('foto') ?></small>
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
                        <button type="submit" class="btn btn-primary btn-submit me-1 mb-1">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script>
    function open_service(no_kend) {
        window.open('<?= base_url() ?>/master/show_kend/' + no_kend, '_blank');
    }
    
</script>
<?= $this->endSection() ?>