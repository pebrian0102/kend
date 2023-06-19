<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between flex-column">
                        <h4 class="card-title">Data Service ( <?= ($no_kend) ? get_no($no_kend) : sp($kdsp) ?> )</h4>
                        <small>Tahun : <?= $thn ?></small>
                        <small>Periode : <?= get_nm_bln($bln) ?></small>
                        <small>Jenis Service : <?= jns_service($kdjns) ?></small>
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
                                        <th>Tanggal Service</th>
                                        <th>Tempat Service</th>
                                        <th>Alamat Service</th>
                                        <th>Biaya Service</th>
                                        <th>Detail Service</th>
                                        <th>Status Approval</th>
                                        <th class="bg-primary text-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php if ($result) : ?>
                                        <?php foreach ($result as $r) : ?>
                                            <tr>
                                                <td class="bg-primary text-white" style="z-index: 4;"><?= $i++ ?></td>
                                                <td><?= sp($r->kdsp) ?></td>
                                                <td><?= $r->nosrv; ?></td>
                                                <td><?= $r->no_kend; ?></td>
                                                <td><?= $r->tglsrv; ?></td>
                                                <td><?= $r->nm_srv; ?></td>
                                                <td><?= $r->alm_srv; ?></td>
                                                <td><?= number_format($r->nilai_real, ((int) $r->nilai_real == $r->nilai_real ? 0 : 0), '.', ',')  ?></td>
                                                <td><?= $r->detail; ?></td>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    function open_service(nosrv) {
        window.open('<?= base_url() ?>/data/show_service/' + nosrv, '_blank');
    }
</script>

<?= $this->endSection() ?>