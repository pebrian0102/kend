<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Service Kendaraan</h3>
                <p class="text-subtitle text-muted">
                    Data Service Kendaraan
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>/data">Data</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Service Kendaraan
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
                            <form action="<?= base_url() ?>/tool/cek_nomor_action" method="post">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="nosrv">Nomor Service</label>
                                            <input type="text" name="nosrv" id="nosrv" class="form-control" required value="<?= ($nosrv) ? $nosrv : '' ?>" placeholder="Nomor Service">
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
            <?php if ($result) : ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Data Service Kendaraan</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <table id="table" class="table table-bordered table-striped" style="width:2000px;">
                                    <thead>
                                        <tr>
                                            <th class="bg-primary text-white" style="z-index: 4;">No.</th>
                                            <th>Stock Point</th>
                                            <th>Nomor Service</th>
                                            <th>Nomor Polisi</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Fungsi Kendaraan</th>
                                            <th>Merk/Type</th>
                                            <th>Warna</th>
                                            <th>Tanggal Service</th>
                                            <th>Tempat Service</th>
                                            <th>Alamat Service</th>
                                            <th>Biaya Service</th>
                                            <th>Status Approval</th>
                                            <th class="bg-primary text-white">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>

                                        <?php foreach ($result as $r) : ?>
                                            <tr>
                                                <td class="bg-primary text-white" style="z-index: 4;"><?= $i++ ?></td>
                                                <td><?= sp($r->kdsp) ?></td>
                                                <td><?= $r->nosrv; ?></td>
                                                <td><?= $r->no_kend; ?></td>
                                                <td><?= $r->jenis; ?></td>
                                                <td><?= $r->fungsi; ?></td>
                                                <td><?= $r->merk; ?> / <?= $r->type; ?></td>
                                                <td><?= $r->warna; ?></td>
                                                <td><?= $r->tglsrv; ?></td>
                                                <td><?= $r->nm_srv; ?></td>
                                                <td><?= $r->alm_srv; ?></td>
                                                <td><?= number_format($r->nilai_real, ((int) $r->nilai_real == $r->nilai_real ? 0 : 0), '.', ',')  ?></td>
                                                <td>
                                                    <span class="badge bg-<?= ($r->app1 == 1 ?  'success' : ($r->app1 == 2 ? 'danger' : 'secondary')) ?>">SPV</span>
                                                    <span class="badge bg-<?= ($r->app2 == 1 ?  'success' : ($r->app2 == 2 ? 'danger' : 'secondary')) ?>">NSM</span>
                                                </td>
                                                <td class="bg-primary text-white">
                                                    <button type="button" onclick="open_service('<?= $r->nosrv ?>')" class="badge bg-secondary block float-right" style="margin-right: 10px;" data-placement="top" title="Lihat data">
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
                <?php foreach ($result as $r) : ?>
                    <div class="modal fade text-left" id="show<?= $r->nosrv ?>" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
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
                                                    <img class="d-block w-100" src="<?= base_url() ?>/assets/img/nota/<?= $r->foto ?>" />
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
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</div>
<script>
    function open_service(nosrv) {
        window.open('<?= base_url() ?>/data/show_service/' + nosrv, '_blank');
    }
</script>


<?= $this->endSection() ?>