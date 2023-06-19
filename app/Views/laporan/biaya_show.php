<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between flex-column">
                        <h4 class="card-title">Data Service ( <?= ($no_kend) ? get_no($no_kend) : '' ?> )</h4>
                        <small>Tahun : <?= $thn ?></small>
                        <small>Periode : <?= get_nm_bln($bln) ?></small>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <table id="table1" class="table table-bordered table-striped" style="width:1200px;">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Stock Point</th>
                                        <th>Tanggal</th>
                                        <?php if ($jns == "01") : ?>
                                            <th>Parkir</th>
                                        <?php elseif ($jns == "02") : ?>
                                            <th>Kuli</th>
                                        <?php elseif ($jns == "03") : ?>
                                            <th>Tol</th>
                                        <?php elseif ($jns == "04") : ?>
                                            <th>Lain-lain</th>
                                        <?php endif; ?>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($result) : ?>
                                        <?php $i = 1 ?>

                                        <?php foreach ($result as $r) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= sp($r->kdsp) ?></td>
                                                <td><?= $r->tgl; ?></td>
                                                <?php if ($jns == "01") : ?>
                                                    <td><?= number_format($r->parkir, ((int) $r->parkir == $r->parkir ? 0 : 0), '.', ',')  ?></td>
                                                <?php elseif ($jns == "02") : ?>
                                                    <td><?= number_format($r->kuli, ((int) $r->kuli == $r->kuli ? 0 : 0), '.', ',')  ?></td>
                                                <?php elseif ($jns == "03") : ?>
                                                    <td><?= number_format($r->tol, ((int) $r->tol == $r->tol ? 0 : 0), '.', ',')  ?></td>
                                                <?php elseif ($jns == "04") : ?>
                                                    <td><?= number_format($r->lain, ((int) $r->lain == $r->lain ? 0 : 0), '.', ',')  ?></td>
                                                <?php endif; ?>
                                                <td><?= $r->ket; ?></td>
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