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
                            <a href="<?= base_url() ?>/approv">Approve</a>
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
                                            <td><?= number_format($r->nilai, ((int) $r->nilai == $r->nilai ? 0 : 0), '.', ',')  ?></td>
                                            <td>
                                                <span class="badge bg-<?= ($r->app1 == 1 ?  'success' : ($r->app1 == 2 ? 'danger' : 'secondary')) ?>">SPV</span>
                                                <span class="badge bg-<?= ($r->app2 == 1 ?  'success' : ($r->app2 == 2 ? 'danger' : 'secondary')) ?>">NSM</span>
                                            </td>
                                            <td class="bg-primary text-white d-flex">
                                                <form action="<?= base_url() ?>/approv/app_detail" method="get">
                                                    <input type="hidden" name="nosrv" value="<?= $r->nosrv ?>">
                                                    <button type="submit" class="badge bg-success block float-right" style="margin-right: 10px;" data-placement="top" title="Approve">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
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

<?= $this->endSection() ?>