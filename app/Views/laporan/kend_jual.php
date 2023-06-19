<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Penjualan Kendaraan</h3>
                <p class="text-subtitle text-muted">
                    Data Penjualan Kendaraan
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>/data">Data</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Penjualan Kendaraan
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
                        <h4 class="card-title">Data Penjualan Kendaraan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped" style="width:2800px;">
                                <thead>
                                    <tr>
                                        <th class="bg-primary text-white" style="z-index: 4;">No.</th>
                                        <th>Stock Point</th>
                                        <th>Nomor Polisi</th>
                                        <th>Nomor STNK</th>
                                        <th>Merk/Type</th>
                                        <th>Jenis Kendaraan</th>
                                        <th>Fungsi Kendaraan</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>Tahun Pembuatan</th>
                                        <th>Isi Silinder</th>
                                        <th>Warna</th>
                                        <th>Nomor Rangka</th>
                                        <th>Nomor Mesin</th>
                                        <th>Tanggal Penjualan</th>
                                        <th>Nama Pembeli</th>
                                        <th>Nik Pembeli</th>
                                        <th>NPWP Pembeli</th>
                                        <th>Alamat Pembeli</th>
                                        <th>Ket.</th>
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
                                            <td><?= $r->merk; ?> / <?= $r->type; ?></td>
                                            <td><?= $r->jenis; ?></td>
                                            <td><?= $r->fungsi; ?></td>
                                            <td><?= $r->tgl_beli; ?></td>
                                            <td><?= $r->thn_buat; ?></td>
                                            <td><?= $r->isi_slndr; ?></td>
                                            <td><?= $r->warna; ?></td>
                                            <td><?= $r->no_rangka; ?></td>
                                            <td><?= $r->no_mesin; ?></td>
                                            <td><?= $r->tgl_jual; ?></td>
                                            <td><?= $r->nm; ?></td>
                                            <td><?= $r->nik; ?></td>
                                            <td><?= $r->npwp; ?></td>
                                            <td><?= $r->alamat; ?></td>
                                            <td><?= $r->ket; ?></td>
                                            <td class="bg-primary text-white">
                                                <button type="button" class="badge bg-secondary block float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#show<?= $r->no_kend ?>" data-placement="top" title="Lihat data">
                                                    <i class="fas fa-eye"></i>
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
    </section>
</div>


<!-- Modal Hapus -->
<?php foreach ($result as $r) : ?>
    <div class="modal fade text-left" id="show<?= $r->no_kend ?>" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Lihat Foto</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div id="image<?= $r->no_kend ?>" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#image<?= $r->no_kend ?>" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#image<?= $r->no_kend ?>" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#image<?= $r->no_kend ?>" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                <button type="button" data-bs-target="#image<?= $r->no_kend ?>" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="<?= base_url() ?>/assets/img/foto_kendaraan/<?= $r->foto1 ?>" class="d-block w-100" alt="nampak depan">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Nampak Depan</h5>
                                    </div>
                                </div>
                                <div class="carousel-item ">
                                    <img src="<?= base_url() ?>/assets/img/foto_kendaraan/<?= $r->foto2 ?>" class="d-block w-100" alt="nampak belakang">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Nampak Belakang</h5>
                                    </div>
                                </div>
                                <div class="carousel-item ">
                                    <img src="<?= base_url() ?>/assets/img/foto_kendaraan/<?= $r->foto3 ?>" class="d-block w-100" alt="nampak samping kiri">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Nampak Samping Kiri</h5>
                                    </div>
                                </div>
                                <div class="carousel-item ">
                                    <img src="<?= base_url() ?>/assets/img/foto_kendaraan/<?= $r->foto4 ?>" class="d-block w-100" alt="nampak samping kanan">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Nampak Samping Kanan</h5>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#image<?= $r->no_kend ?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#image<?= $r->no_kend ?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
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
<?php endforeach; ?>
<?= $this->endSection() ?>